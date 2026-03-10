<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\OrderItem;
use App\Models\FinalOrder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function inventoryIndex()
{
    $query = Inventory::query()->with('product.category');

    // Search filter
    if ($search = request('search')) {
        $query->whereHas('product', function ($q) use ($search) {
            $q->where('Name', 'like', "%$search%")
              ->orWhere('Description', 'like', "%$search%");
        });
    }

    // Category filter
    if ($categoryId = request('category_id')) {
        $query->whereHas('product.category', function ($q) use ($categoryId) {
            $q->where('ProductCategory_ID', $categoryId);
        });
    }

    $inventories = $query->get();

    $lowStockItems = $inventories->filter(function ($item) {
        return $item->Quantity <= $item->Threshold;
    });

    $categories = \App\Models\ProductCategory::all();

    return view('admin.inventory.index', compact(
        'inventories',
        'lowStockItems',
        'categories'
    ));
}

    /* Show customers list */
    public function showCustomers()
    {
        $customers = \App\Models\Customer::with('user')->get();

        return view('admin.customers.index', compact('customers'));
    }

    /* Show single customer details */
    public function viewCustomer($id)
    {
        $customer = Customer::with('user')->findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    public function editCustomer($id)
    {
        $customer = Customer::with('user')->findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
    }
    
    /* Update customer details and associated user email */
    public function updateCustomer(Request $request, $id)
    
    {
        $customer = Customer::with('user')->findOrFail($id);
        $user = $customer->user;

        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,email,' . $user->id,
            'Mobile Number' => 'required|string|max:20',
            ]);
            
            DB::transaction(function () use ($validated, $customer, $user) {

            // Update login email
            $user->update([
            'email' => $validated['Email'],
            ]);

            // Update profile
            $customer->update([
                'Name' => $validated['Name'],
                'Email' => $validated['Email'],
                'Mobile Number' => $validated['Mobile Number'],
                ]);
                });
                
                return redirect()->route('admin.customers.index')
                ->with('success', 'Customer updated successfully.');
                }

                public function destroyCustomer($id)
                {
                    $customer = Customer::with('user')->findOrFail($id);
                    
                    DB::transaction(function () use ($customer) {
                        $customer->user->delete();   // deletes login
                        $customer->delete();         // deletes profile
                    });
                    
                    return redirect()->route('admin.customers.index')
                    ->with('success', 'Customer deleted successfully.');
                    }


    /* Inventory report with total products, total stock, and low stock count */
    public function generateReport()
{
    // Inventory overview
    $totalProducts = Inventory::count();
    $totalStock = Inventory::sum('Quantity');
    $lowStockItems = Inventory::with('product')
        ->whereColumn('Quantity', '<=', 'Threshold')
        ->get();
    $lowStockCount = $lowStockItems->count();
    $lowStockValue = $lowStockItems->sum(fn($item) =>
        $item->Quantity * $item->product->Price
    );
    $outOfStock = Inventory::where('Quantity', 0)->count();


    // Outgoing orders
    $totalOrders = FinalOrder::count();
    $topSelling = OrderItem::with('product')
    ->select('Product_ID', DB::raw('SUM(Quantity) as total_sold'))
    ->groupBy('Product_ID')
    ->orderByDesc('total_sold')
    ->take(5)
    ->get();
    $totalUnitsSold = OrderItem::sum('Quantity');
    $totalRevenue = OrderItem::sum(DB::raw('Quantity * Unit_Price'));
    $ordersByStatus = FinalOrder::select('Status', DB::raw('count(*) as count'))
        ->groupBy('Status')
        ->get();


    // Incoming restocks and returns
    $restocks = InventoryLog::where('Action_Type', 'restock')->get();
    $returns = InventoryLog::where('Action_Type', 'return')->get();

    $totalRestockedUnits = $restocks->sum('Quantity_Changed');
    $totalReturnedUnits = $returns->sum('Quantity_Changed');

    $incomingValue = $restocks->sum(fn($log) =>
        $log->Quantity_Changed * $log->product->Price
    ) + $returns->sum(fn($log) =>
        $log->Quantity_Changed * $log->product->Price
    );


    // Inventory adjustments
    $adjustments = InventoryLog::where('Action_Type', 'adjustment')->get();
    $totalAdjustments = $adjustments->count();
    $adjustmentsByProduct = InventoryLog::where('Action_Type', 'adjustment')
        ->select('Product_ID', DB::raw('SUM(Quantity_Changed) as total_adjusted'))
        ->groupBy('Product_ID')
        ->get();
    $negativeAdjustments = $adjustments->where('Quantity_Changed', '<', 0)->count();
    $positiveAdjustments = $adjustments->where('Quantity_Changed', '>', 0)->count();


    return view('admin.inventory.report', compact(
        'totalProducts',
        'totalStock',
        'lowStockItems',
        'lowStockCount',
        'lowStockValue',
        'outOfStock',
        'topSelling',
        'totalOrders',
        'totalUnitsSold',
        'totalRevenue',
        'ordersByStatus',
        'totalRestockedUnits',
        'totalReturnedUnits',
        'incomingValue',
        'totalAdjustments',
        'adjustmentsByProduct',
        'negativeAdjustments',
        'positiveAdjustments'
    ));
}

    /* Inventory restock and product management methods */
    public function restock(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    DB::transaction(function () use ($request, $id) {

        $inventory = Inventory::lockForUpdate()->findOrFail($id);

        $addedQty = $request->quantity;

        $inventory->Quantity += $addedQty;
        $inventory->save();

        $adminId = null;
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $adminId = $admin->Admin_ID ?? null;
        }

        InventoryLog::create([
            'Product_ID' => $inventory->Product_ID,
            'Admin_ID' => $adminId,
            'Action_Type' => 'restock',
            'Quantity_Changed' => $addedQty,
        ]);
    });

    return back()->with('success', 'Product restocked successfully.');
}
    /* Product deletion with cascading inventory and logs */
    public function destroy($id)
{
    DB::transaction(function () use ($id) {

        $inventory = Inventory::with('product')->lockForUpdate()->findOrFail($id);

        $product = $inventory->product;

        $adminId = null;
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $adminId = $admin->Admin_ID ?? null;
        }

        InventoryLog::create([
            'Product_ID' => $inventory->Product_ID,
            'Admin_ID' => $adminId,
            'Action_Type' => 'adjustment',
            'Quantity_Changed' => -$inventory->Quantity,
        ]);

        $product->delete(); // cascades inventory + logs
    });

    return back()->with('success', 'Product removed completely from system.');
}

    /* Product creation and editing */
    public function createProduct()
    {
        $categories = ProductCategory::all();
        return view('admin.inventory.create', compact('categories'));
    }
    
    /* Show edit form for a product */
    public function editProduct($id)
    {
    $inventory = Inventory::with('product.category')->findOrFail($id);

    return view('admin.inventory.edit', compact('inventory'));
    }

    /* Store new product and inventory */
    public function storeProduct(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'threshold' => 'required|integer|min:0',
        'category_id' => 'required|exists:product_categories,ProductCategory_ID',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product = Product::create([
        'Name' => $validated['name'],
        'Description' => $validated['description'],
        'Price' => $validated['price'],
        'Image_URL' => $imagePath,
        'ProductCategory_ID' => $validated['category_id'],
    ]);

    Inventory::create([
        'Product_ID' => $product->Product_ID,
        'Quantity' => $validated['quantity'],
        'Threshold' => $validated['threshold'],
    ]);

    InventoryLog::create([
        'Product_ID' => $product->Product_ID,
        'Admin_ID' => Auth::guard('admin')->id(),
        'Action_Type' => 'adjustment',
        'Quantity_Changed' => $validated['quantity'],
    ]);

    return redirect()->route('admin.inventory.index')
        ->with('success', 'Product created successfully.');
}

    /* Update existing product and inventory */
    public function updateProduct(Request $request, $id)
{
    $inventory = Inventory::with('product')->lockForUpdate()->findOrFail($id);
    $product = $inventory->product;

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:product_categories,ProductCategory_ID',
        'quantity' => 'required|integer|min:0',
        'threshold' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    DB::transaction(function () use ($validated, $request, $inventory, $product) {

    $oldQuantity = $inventory->Quantity;

    $imagePath = $product->Image_URL;

    if ($request->hasFile('image')) {
        if ($product->Image_URL) {
            Storage::disk('public')->delete($product->Image_URL);
        }

        $imagePath = $request->file('image')->move(
    public_path('images/products'),
    time().'_'.$request->file('image')->getClientOriginalName()
);
    }

    $product->update([
        'Name' => $validated['name'],
        'Description' => $validated['description'],
        'Price' => $validated['price'],
        'ProductCategory_ID' => $validated['category_id'],
        'Image_URL' => $imagePath,
    ]);

    $inventory->update([
        'Quantity' => $validated['quantity'],
        'Threshold' => $validated['threshold'],
    ]);

    $quantityChange = $validated['quantity'] - $oldQuantity;

    InventoryLog::create([
        'Product_ID' => $product->Product_ID,
        'Admin_ID' => Auth::guard('admin')->id(),
        'Action_Type' => 'adjustment',
        'Quantity_Changed' => $quantityChange,
    ]);
});

    return redirect()->route('admin.inventory.index')
        ->with('success', 'Product and inventory updated successfully.');
}
}

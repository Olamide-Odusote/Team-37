<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
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
        $customer = \App\Models\Customer::with('user')->findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    /* Inventory report with total products, total stock, and low stock count */
    public function generateReport()
    {
    $totalProducts = Inventory::count();
    $totalStock = Inventory::sum('Quantity');
    $lowStockCount = Inventory::whereColumn('Quantity', '<=', 'Threshold')->count();

    return view('admin.inventory.report', compact(
        'totalProducts',
        'totalStock',
        'lowStockCount'
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
            'Action_Type' => 'delete',
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
        'Action_Type' => 'create',
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

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($product->Image_URL) {
                Storage::disk('public')->delete($product->Image_URL);
            }
            $product->Image_URL = $request->file('image')->store('products', 'public');
        }

        // Update product
        $product->update([
            'Name' => $validated['name'],
            'Description' => $validated['description'],
            'Price' => $validated['price'],
            'ProductCategory_ID' => $validated['category_id'],
        ]);

        // Update inventory
        $inventory->update([
            'Quantity' => $validated['quantity'],
            'Threshold' => $validated['threshold'],
        ]);

        // Log quantity change
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

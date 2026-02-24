<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function inventoryIndex()
    {
        // Fetch all inventories with product and category details
        $inventories = Inventory::with('product.category')->get();

        // Get low stock items (quantity <= threshold)
        $lowStockItems = $inventories->filter(function($item) {
            return $item->Quantity <= $item->Threshold;
        });

        return view('admin.inventory.index', [
            'inventories' => $inventories,
            'lowStockItems' => $lowStockItems
        ]);
    }

    public function generateReport()
    {
        // Stub: In future, generate and export inventory report
        return back()->with('success', 'Report generated successfully.');
    }

    public function restock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $inventory = Inventory::findOrFail($id);
        $oldQty = $inventory->Quantity;
        $addedQty = $request->quantity;
        $inventory->Quantity += $addedQty;
        $inventory->save();

        // Log the incoming stock using InventoryLog model fields
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

        return back()->with('success', $inventory->product->Name . ' restocked successfully. Added ' . $addedQty . ' units.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $productName = $inventory->product->Name;
        $inventory->delete();

        return back()->with('success', $productName . ' removed from inventory.');
    }
}

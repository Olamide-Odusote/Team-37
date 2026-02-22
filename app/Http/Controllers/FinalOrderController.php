<?php

namespace App\Http\Controllers;

use App\Models\FinalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalOrderController extends Controller
{
   
    /**
     * Display a list of previous orders for all users
     */

    public function index()
    {
        // Admin sees all orders, users see only their own
        if (auth('admin')->check()) {
            $orders = FinalOrder::with('items.product')
            ->orderBy('OrderDate', 'desc')
            ->get();
            } else {
                $user = auth()->guard('web')->user();
                // Ensure user is logged in
                if (!$user) {
                    return redirect()->route('signin')
                    ->with('error', 'You must log in first.');
                    }

                    // Get only orders for the logged-in user
                    $orders = FinalOrder::where('Customer_ID', $user->Customer_ID)
                    ->with('items.product')
                    ->orderBy('OrderDate', 'desc')
                    ->get();
                    }
                    return view('orders.index', compact('orders'));
   }


     /**
     * Display a list of previous orders for one user
     */

    public function show($id)
    {
        $user = Auth::user();

        $order = FinalOrder::with('items.product.inventory', 'items.return')->findOrFail($id);

        // Ensure user is allowed to view this order (owner or admin)
        if (!auth()->guard('admin')->check()) {
            if (!$user || $order->Customer_ID != $user->Customer_ID) {
                return redirect()->route('orders.index')->with('error', 'Order not found or access denied.');
            }
        }

        return view('orders.show', compact('order'));
    }

    // Admin view of all orders
    public function adminIndex()
    {
        $orders = FinalOrder::with('items.product')
            ->orderBy('OrderDate', 'desc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // Admin view of a single order
    public function adminShow(FinalOrder $order)
    {
        $order->load('items.product.inventory', 'items.return');

        return view('admin.orders.show', compact('order'));
    }

    // Admin update order status
    public function updateStatus(Request $request, FinalOrder $order)
    {        $request->validate([
            'status' => 'required|in:pending,shipped,delivered,returned',
        ]);

        $order->Status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully.');
    }
}

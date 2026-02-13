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
        if (auth('admin')->check()) {
            $orders = FinalOrder::with('items.product')
            ->orderBy('OrderDate', 'desc')
            ->get();
            } else {
                $user = auth()->guard('web')->user();
                
                if (!$user) {
                    return redirect()->route('signin')
                    ->with('error', 'You must log in first.');
                    }

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
}

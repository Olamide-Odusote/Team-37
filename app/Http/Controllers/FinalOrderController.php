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

        $orders = FinalOrder::with([
                'items.product'   
            ])
            ->orderBy('Date', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

     /**
     * Display a list of previous orders for one user
     */

    public function show() {
        $id = Auth::user()->id; // current logged-in user

        // Load orders with their items and products
        $orders = FinalOrder::where('Customer_ID', $id)
            ->with([
                'items.product'   // eager-load items AND product for each item
            ])
            ->orderBy('Date', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }
}

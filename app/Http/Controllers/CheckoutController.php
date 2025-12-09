<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Checkout page logic here
        return view('checkout');
    }

    public function showCheckoutForm()
    {
        return view('checkout');
    }   

    public function success()
    {
        // Order success page logic here
        return view('order.success');
    }

    public function process(Request $request)
    {
        // Process checkout logic here
        // e.g., validate request, create order, process payment, etc.

        return redirect()->route('order.success');
    }
}

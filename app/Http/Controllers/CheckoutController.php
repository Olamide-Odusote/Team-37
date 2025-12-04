<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function index()
    {
        return view('checkout/index');
    }

    /**
     * Show the order confirmation page.
     */
    public function confirm()
    {
        return view('checkout/confirm');
    }

    /**
     * Show the payment page.
     */
    public function payment()
    {
        return view('checkout/payment');
    }
}

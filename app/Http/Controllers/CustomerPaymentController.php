<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPayment;

class CustomerPaymentController extends Controller
{
    /**
     * Display the specified customer payment.
     */
    public function show($id) {
        $payment = CustomerPayment::find($id);
        return view('/show', array('payment' => $payment));
    }
    /**
     * Display a listing of all customer payments.
     */
    public function list() {
        return view('/list', array('payments'=>CustomerPayment::all()));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display the specified customer.
     */
    public function show($id) {
        $customer = Customer::find($id);
        return view('/show', array('customer' => $customer));
    }
    /**
     * Display a listing of all customers.
     */
    public function list() {
        return view('/list', array('customers'=>Customer::all()));
    }
}

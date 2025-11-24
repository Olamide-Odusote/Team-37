<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function show($id) {
        $customer = Customer::find($id);
        return view('/show', array('customer' => $customer));
    }

    public function list() {
        return view('/list', array('customers'=>Customer::all()));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAddress;

class CustomerAddressController extends Controller
{
    public function show($id) {
        $address = CustomerAddress::find($id);
        return view('/show', array('address' => $address));
    }

    public function list() {
        return view('/list', array('adresses'=>CustomerAddress::all()));
    }
}

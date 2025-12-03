<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnRequest;

class ReturnRequestController extends Controller
{
    public function show($id) {
        $request = ReturnRequest::find($id);
        return view('/show', array('request' => $request));
    }

    public function list() {
        return view('/list', array('requests'=>ReturnRequest::all()));
    }

    // Other resource methods (index, create, store, edit, update, destroy) can be added here as needed.
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinalOrder;

class FinalOrderController extends Controller
{
    /**
     * Display the specified final order.
     */
    public function show($id) {
        $order = FinalOrder::find($id);
        return view('/show', array('order' => $order));
    }
    /**
     * Display a listing of all final orders.
     */
    public function list() {
        return view('/list', array('orders'=>FinalOrder::all()));
    } 

}

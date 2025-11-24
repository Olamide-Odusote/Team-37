<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function show($id) {
        $order_item = OrderItem::find($id);
        return view('/show', array('order_item' => $order_item));
    }

    public function list() {
        return view('/list', array('order_items'=>OrderItem::all()));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    /**
     * Display the specified order item.
     */
    public function show($id) {
        $order_item = OrderItem::find($id);
        return view('/show', array('order_item' => $order_item));
    }
    /**
     * Display a listing of all order items.
     */
    public function list() {
        return view('/list', array('order_items'=>OrderItem::all()));
    }
}

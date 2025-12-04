<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    /**
     * Display the specified inventory item.
     */
    public function show($id) {
        $item = Inventory::find($id);
        return view('/show', array('item' => $item));
    }
    /**
     * Display a listing of all inventory items.
     */
    public function list() {
        return view('/list', array('items'=>Inventory::all()));
    }
}

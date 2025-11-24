<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function show($id) {
        $item = Inventory::find($id);
        return view('/show', array('item' => $item));
    }

    public function list() {
        return view('/list', array('items'=>Inventory::all()));
    }
}

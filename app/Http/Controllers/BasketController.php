<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;

class BasketController extends Controller
{
    public function show($id) {
        $basket = Basket::find($id);
        return view('/show', array('basket' => $basket));
    }

    public function list() {
        return view('/list', array('baskets'=>Basket::all()));
    }
}

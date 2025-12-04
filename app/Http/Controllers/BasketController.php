<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;

class BasketController extends Controller
{
    /**
     * Display the specified basket.
     */
    public function show($id) {
        $basket = Basket::find($id);
        return view('/show', array('basket' => $basket));
    }
    /**
     * Display a listing of all baskets.
     */
    public function list() {
        return view('/list', array('baskets'=>Basket::all()));
    }
}

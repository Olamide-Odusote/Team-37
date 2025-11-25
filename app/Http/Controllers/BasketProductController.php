<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketProduct;

class BasketProductController extends Controller
{
    public function show($id) {
        $basket_product = BasketProduct::find($id);
        return view('/show', array('basket_product' => $basket_product));
    }

    public function list() {
        return view('/list', array('basket_products'=>BasketProduct::all()));
    }
}

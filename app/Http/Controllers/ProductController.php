<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::find($id);
        return view('/show', array('product' => $product));
    }

    public function list() {
        return view('/list', array('products'=>Product::all()));
    }
}

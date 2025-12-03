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

    public function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$query%")
                            ->orWhere('description', 'LIKE', "%$query%")
                            ->get();
        return view('products.search_results', ['products' => $products, 'query' => $query]);
    }

    // Other resource methods (index, create, store, edit, update, destroy) can be added here as needed.
}

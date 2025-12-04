<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show($id) {
        $product = Product::find($id);
        return view('/show', array('product' => $product));
    }

    /**
     * Display a listing of all products.
     */
    public function list() {
        return view('/list', array('products'=>Product::all()));
    }

    /**
     * Search for products based on a query.
     */
    public function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$query%")
                            ->orWhere('description', 'LIKE', "%$query%")
                            ->get();
        return view('products.search_results', ['products' => $products, 'query' => $query]);
    }

    public static function orderBy($column, $direction) {
        return Product::orderBy($column, $direction);
    }
}

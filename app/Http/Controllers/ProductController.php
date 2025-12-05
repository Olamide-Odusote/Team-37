<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Display a specific product.
     */
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Search for products based on a query.
     */
    public function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('Name', 'LIKE', "%$query%")
                            ->orWhere('Description', 'LIKE', "%$query%")
                            ->get();
        return view('products.search_results', ['products' => $products, 'query' => $query]);
    }
}

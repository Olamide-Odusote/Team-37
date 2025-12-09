<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller{
    /**
     * Display products under a specific category.
     */
    public function show(Request $request, $id) {
        $category = ProductCategory::findOrFail($id);

        $query = Product::where('ProductCategory_ID', $id);

        // Price filtering via query string: ?min=10&max=50
        $min = $request->query('min');
        $max = $request->query('max');
        if ($min !== null && $max !== null) {
            if (is_numeric($min) && is_numeric($max)) {
                $query->whereBetween('Price', [(float)$min, (float)$max]);
            }
        } elseif ($min !== null) {
            if (is_numeric($min)) {
                $query->where('Price', '>=', (float)$min);
            }
        } elseif ($max !== null) {
            if (is_numeric($max)) {
                $query->where('Price', '<=', (float)$max);
            }
        }

        // Paginate and preserve query string so filters persist
        $products = $query->paginate(12)->withQueryString();

        return view('categories.show', compact('category', 'products'));
    }

    /**
     * Display a listing of all categories.
     */
    public function index() {
        $categories = ProductCategory::all();
        return view('categories.index', compact('categories'));
    }


}

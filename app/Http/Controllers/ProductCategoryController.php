<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller{

    /**
     * Display products under a specific category.
     */
    public function show($id) {
        
        $category = ProductCategory::findOrFail($id);
        
        $products = Product::where('ProductCategory_ID', $id)->paginate(12);
        
        $categories = ProductCategory::all(); 
        
        return view('categories.show', compact(
            'category',
            'products',
            'categories'
        ));
    }


    /**
     * Display a listing of all categories.
     */
    public function index() {
        $categories = ProductCategory::all();
        return view('categories.index', compact('categories'));
    }


}

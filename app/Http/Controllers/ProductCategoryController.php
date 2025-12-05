<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function show($id)
    {
        // Get the category
        $category = ProductCategory::findOrFail($id);

        // Get all products in that category
        $products = Product::where('ProductCategory_ID', $id)->get();

        return view('categories.show', compact('category', 'products'));
    }
}

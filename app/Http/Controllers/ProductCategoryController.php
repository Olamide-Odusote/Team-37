<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Show the list of all categories
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show category by ID
     */
    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('categories.show', compact('category'));
    }
}

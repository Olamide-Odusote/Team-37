<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function show($id) {
        $category = ProductCategory::find($id);
        return view('/show', array('category' => $category));
    }

    public function list() {
        return view('/list', array('categories'=>ProductCategory::all()));
    }

    // Other resource methods (index, create, store, edit, update, destroy) can be added here as needed.

}

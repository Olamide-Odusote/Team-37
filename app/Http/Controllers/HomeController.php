<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $categories = ProductCategory::all(); // Fetch categories if needed

        return view('home/home', compact('categories'));
    }
}

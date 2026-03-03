<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
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

    public function homepage()
{

/** Fetch top 3 most bought products  
 *   $topProducts = DB::table('products as p')
   *      ->join('order_items as oi', 'p.Product_ID', '=', 'oi.Product_ID')
   *      ->join('final_orders as fo', 'oi.FinalOrder_ID', '=', 'fo.FinalOrder_ID')
   *      ->where('fo.Status', 'completed')   only completed orders 
   *      ->select('p.Product_ID', 'p.Name', 'p.Image_URL', 'p.Price', DB::raw('SUM(oi.Quantity) as total_sold'))
   *      ->groupBy('p.Product_ID', 'p.Name', 'p.Image_URL', 'p.Price')
  *       ->orderByDesc('total_sold')
   *      ->limit(4)   show top 3 
   *      ->get();*
*/
 
  // Fake top 3 products
    $topProducts = [
        (object)[
            'Product_ID' => 1,
            'Name' => 'Dell Latitude 6300U Laptop',
            'Image_URL' => 'Laptop.jpg', // put your image file here
            'Price' => 229.00,
            'total_sold' => 100 // fake quantity sold
        ],
        (object)[
            'Product_ID' => 2,
            'Name' => 'Wireless Mouse',
            'Image_URL' => 'Mouse.jpeg',
            'Price' => 14.99,
            'total_sold' => 75
        ],


        (object)[
            'Product_ID' => 3,
            'Name' => 'Running Shoes',
            'Image_URL' => 'sportsshoes.jpeg',
            'Price' => 59.99,
            'total_sold' => 50
        ],

 
        (object)[
            'Product_ID' => 4,
            'Name' => 'Smartphone',
            'Image_URL' => 'football.jpeg',
            'Price' => 499.99,
            'total_sold' => 25
        ],


    ];


     return view('home.homepage', compact('topProducts')); // points to resources/views/homepage.blade.php
}


}

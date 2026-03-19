<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FinalOrder;
use App\Models\OrderItem;
use App\Models\InventoryLog;
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
    $topProducts = OrderItem::with('product')
    ->join('final_orders', 'order_items.FinalOrder_ID', '=', 'final_orders.FinalOrder_ID')
    ->where('final_orders.Status', 'delivered')
    ->select(
        'order_items.Product_ID',
        DB::raw('SUM(order_items.Quantity) as total_sold')
    )
    ->groupBy('order_items.Product_ID')
    ->orderByDesc('total_sold')
    ->take(4)
    ->get()
    ->filter(fn($item) => $item->product) // avoid null products
    ->map(function ($item) {
        return (object)[
            'Product_ID' => $item->Product_ID,
            'Name'       => $item->product->Name,
            'Image_URL'  => $item->product->Image_URL,
            'Price'      => $item->product->Price,
            'total_sold' => $item->total_sold
        ];
    });

    return view('home.homepage', compact('topProducts'));
    }
}

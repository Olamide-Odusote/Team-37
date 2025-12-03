<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function viewBasket()
    {
        $id = Auth::user()->id;

        // Get current user's basket
        $basket = Basket::find($id);

        if (!$basket) {
            return view('basket.view', [
                'basket_size' => 0,
                'products' => [],
                'basket_products' => [],
                'basket' => null
            ]);
        }

        // Count the number of product rows in the basket
        $basket_size = $basket->products()->count();

        // Load products + pivot data
        $products = $basket->products()
            ->with('basketProducts')
            ->get();

        // Load BasketProduct rows with product eager-loaded
        $basket_products = $basket->basketProducts()
            ->with('product')
            ->get();

        return view('basket', compact(
            'basket',
            'basket_size',
            'products',
            'basket_products'
        ));
    }
}

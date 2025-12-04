<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function viewBasket()
{
    // Check if user is NOT logged in
    if (!Auth::check()) {
        return view('basket.view', [
            'basket_size' => 0,
            'products' => [],
            'basket_products' => [],
            'basket' => null,
            'need_login' => true
        ]);
    }

    // If logged in, proceed
    $id = Auth::user()->id;

    $basket = Basket::where('Customer_ID', $id)->first();

    if (!$basket) {
        return view('basket.view', [
            'basket_size' => 0,
            'products' => [],
            'basket_products' => [],
            'basket' => null,
            'need_login' => false
        ]);
    }

    $basket_size = $basket->products()->count();
    $products = $basket->products()->with('basketProducts')->get();
    $basket_products = $basket->basketProducts()->with('product')->get();

    return view('basket', compact(
        'basket.view',
        'basket_size',
        'products',
        'basket_products'
    ) + ['need_login' => false]);
}
    /**
     * Add product to basket or increase quantity
     */

    public function addProduct(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must log in first.');
        }

        $id = Auth::user()->id;

        $basket = Basket::findOrFail(['Customer_ID' => $id]); // update as needed
        $product = Product::findOrFail($productId);

        $current = $basket->products()
            ->where('Product_ID', $productId)
            ->first();

        if ($current) {
            // If already in basket, increase quantity
            $basket->products()->updateExistingPivot($productId, [
                'quantity' => $current->pivot->quantity + 1,
            ]);
        } else {
            // If not in basket, create pivot entry
            $basket->products()->attach($productId, [
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to basket.');
    }

    /**
     * Remove or decrease product quantity
     */
    public function removeProduct(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must log in first.');
        }

        $id = Auth::user()->id;

        $basket = Basket::findOrFail($id);
        $product = Product::findOrFail($productId);

        $pivot = $basket->products()
            ->where('Product_ID', $productId)
            ->first();

        if (!$pivot) {
            return redirect()->back()->with('warning', 'Product not in basket.');
        }

        $newQty = $pivot->pivot->quantity - 1;

        if ($newQty <= 0) {
            // Remove pivot row entirely
            $basket->products()->detach($productId);
        } else {
            // Decrease quantity
            $basket->products()->updateExistingPivot($productId, [
                'quantity' => $newQty,
            ]);
        }

        return redirect()->back()->with('success', 'Product updated.');
    }
}
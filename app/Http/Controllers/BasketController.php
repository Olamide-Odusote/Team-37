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
        $id = Auth::user()->id;
    
        // Get current user's basket
        $basket = Basket::find(['Customer_ID' => $id]);

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

    public function addProduct(Request $request, $productId)
    {
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

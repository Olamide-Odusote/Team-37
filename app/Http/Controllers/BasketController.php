<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * Show basket page
     */
    public function viewBasket()
    {
        // Not logged in
        if (!Auth::check()) {
            return view('basket.view', [
                'basket' => null,
                'basket_products' => [],
                'basket_size' => 0,
                'need_login' => true
            ]);
        }

        $user = Auth::user();
        $customer = $user->customer;

        // User exists but no customer profile
        if (!$customer) {
            return view('basket.view', [
                'basket' => null,
                'basket_products' => [],
                'basket_size' => 0,
                'need_login' => false
            ]);
        }

        $basket = Basket::where('Customer_ID', $customer->Customer_ID)->first();

        if (!$basket) {
            return view('basket.view', [
                'basket' => null,
                'basket_products' => [],
                'basket_size' => 0,
                'need_login' => false
            ]);
        }

        $basket_products = $basket->basketProducts()->with('product')->get();
        $basket_size = $basket_products->sum('Quantity');

        return view('basket.view', [
            'basket' => $basket,
            'basket_products' => $basket_products,
            'basket_size' => $basket_size,
            'need_login' => false
        ]);
    }

    /**
     * Add product to basket
     */
    public function addToBasket(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must log in first.');
        }

        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            // Create customer record if it doesn't exist
            $customer = Customer::create([
                'user_id'   => $user->id,
                'Name'      => $user->name,
                'Email'     => $user->email,
                'Password'  => $user->password,
                'Mobile Number' => 0,
            ]);
        }

        // Get or create basket
        $basket = Basket::firstOrCreate([
            'Customer_ID' => $customer->Customer_ID
        ]);

        $product = Product::findOrFail($productId);
        $qty = max(1, (int) $request->input('qty', 1));

        $existing = $basket->products()
            ->where('products.Product_ID', $productId)
            ->first();

        if ($existing) {
            $basket->products()->updateExistingPivot($productId, [
                'Quantity' => $existing->pivot->Quantity + $qty
            ]);
        } else {
            $basket->products()->attach($productId, [
                'Quantity' => $qty
            ]);
        }

        return redirect()->back()->with('success', 'Product added to basket.');
    }

    /**
     * Remove or decrease quantity
     */
    public function removeFromBasket($productId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must log in first.');
        }

        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            // Create customer record if it doesn't exist
            $customer = Customer::create([
                'user_id'   => $user->id,
                'Name'      => $user->name,
                'Email'     => $user->email,
                'Password'  => $user->password,
                'Mobile Number' => 0,
            ]);
        }

        $basket = Basket::where('Customer_ID', $customer->Customer_ID)->first();

        if (!$basket) {
            return redirect()->back()->with('warning', 'Basket not found.');
        }

        $product = $basket->products()
            ->where('products.Product_ID', $productId)
            ->first();

        if (!$product) {
            return redirect()->back()->with('warning', 'Product not in basket.');
        }

        $newQty = $product->pivot->Quantity - 1;

        if ($newQty <= 0) {
            $basket->products()->detach($productId);
        } else {
            $basket->products()->updateExistingPivot($productId, [
                'Quantity' => $newQty
            ]);
        }

        return redirect()->back()->with('success', 'Basket updated.');
    }
}

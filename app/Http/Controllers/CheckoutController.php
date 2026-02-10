<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Basket;
use App\Models\CustomerAddress;
use App\Models\CustomerPayment;
use App\Models\FinalOrder;
use App\Models\OrderItem;
use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('signin')->with('error', 'You must log in first.');
        }

        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('basket.view')->with('error', 'Customer profile not found.');
        }

        $basket = Basket::where('Customer_ID', $customer->Customer_ID)->first();

        if (!$basket) {
            return redirect()->route('basket.view')->with('warning', 'Basket is empty.');
        }

        $basket_products = $basket->basketProducts()->with('product')->get();

        if (count($basket_products) === 0) {
            return redirect()->route('basket.view')->with('warning', 'Basket is empty.');
        }

        return view('checkout.checkout', [
            'basket_products' => $basket_products,
            'basket' => $basket
        ]);
    }

    public function showCheckoutForm()
    {
        return $this->index();
    }

   public function success(FinalOrder $order)
{
    // Security: ensure customer owns this order
    $user = Auth::user();

    if (!$user || $order->Customer_ID !== $user->Customer_ID) {
        return redirect()->route('orders.index')
            ->with('error', 'Access denied.');
    }

    $order->load('items.product');

    return view('checkout.success', compact('order'));
}


    public function process(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('signin')->with('error', 'You must log in first.');
    }

    $user = Auth::user();
    $customer = $user->customer;

    if (!$customer) {
        return redirect()->route('basket.view')->with('error', 'Customer profile not found.');
    }

    $basket = Basket::where('Customer_ID', $customer->Customer_ID)->first();
    if (!$basket) {
        return redirect()->route('basket.view')->with('warning', 'Basket is empty.');
    }

    $basket_products = $basket->basketProducts()->with('product')->get();
    if ($basket_products->isEmpty()) {
        return redirect()->route('basket.view')->with('warning', 'Basket is empty.');
    }

    $data = $request->validate([
        'email' => 'required|email',
        'cardnum' => 'required',
        'cardname' => 'required',
        'cvv' => 'required',
        'exp-month' => 'required',
        'exp-year' => 'required',
        'fname' => 'required',
        'lname' => 'required',
        'address' => 'required',
        'city' => 'required',
        'postcode' => 'required',
        'country' => 'required',
    ]);

    // Check stock
    foreach ($basket_products as $bp) {
        $inventory = Inventory::where('Product_ID', $bp->Product_ID)->first();
        if (!$inventory || $inventory->Quantity < $bp->Quantity) {
            return redirect()->route('basket.view')
                ->with('error', 'Insufficient stock for ' . $bp->product->Name);
        }
    }

    DB::beginTransaction();

    try {
        // Address
        $address = CustomerAddress::create([
            'Customer_ID' => $customer->Customer_ID,
            'Street' => $data['address'],
            'City' => $data['city'],
            'Post_Code' => $data['postcode'],
            'Country' => $data['country'],
        ]);

        // Payment
        $card = preg_replace('/\D/', '', $data['cardnum']);
        $masked = str_repeat('X', max(strlen($card) - 4, 0)) . substr($card, -4);

        $payment = CustomerPayment::create([
            'Customer_ID' => $customer->Customer_ID,
            'CardHolder_Name' => $data['cardname'],
            'MaskedCardNumber' => $masked,
            'ExpiryDate' => $data['exp-year'] . '-' . $data['exp-month'] . '-01',
        ]);

        // Total
        $total = $basket_products->sum(fn ($bp) =>
            $bp->product->Price * $bp->Quantity
        );

        // Order
        $order = FinalOrder::create([
            'Customer_ID' => $customer->Customer_ID,
            'CustomerAddress_ID' => $address->CustomerAddress_ID,
            'CustomerPayment_ID' => $payment->CustomerPayment_ID,
            'OrderDate' => now()->toDateString(),
            'Total_Price' => $total,
            'Status' => 'pending',
        ]);

        // Order items + inventory
        foreach ($basket_products as $bp) {
            OrderItem::create([
                'FinalOrder_ID' => $order->FinalOrder_ID,
                'Product_ID' => $bp->Product_ID,
                'Quantity' => $bp->Quantity,
                'Unit_Price' => $bp->product->Price,
            ]);

            Inventory::where('Product_ID', $bp->Product_ID)
                ->decrement('Quantity', $bp->Quantity);

            InventoryLog::create([
                'Product_ID' => $bp->Product_ID,
                'Admin_ID' => null,
                'Action_Type' => 'adjustment',
                'Quantity_Changed' => -$bp->Quantity,
            ]);

            $bp->delete(); // clear basket item
        }

        DB::commit();

        // Store last order ID in session for success page
        Mail::to($customer->Email)->send(new OrderConfirmation($order));
        return redirect()->route('checkout.success', ['order' => $order->FinalOrder_ID])
            ->with('success', 'Order placed successfully!');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Could not create order: ' . $e->getMessage());
            }
            }
            }

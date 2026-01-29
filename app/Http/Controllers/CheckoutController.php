<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Basket;
use App\Models\CustomerAddress;
use App\Models\CustomerPayment;
use App\Models\FinalOrder;
use App\Models\OrderItem;
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

    public function success()
    {
        return view('checkout.success');
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
        if (count($basket_products) === 0) {
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

        DB::beginTransaction();
        try {
            // save address
            $address = CustomerAddress::create([
                'Customer_ID' => $customer->Customer_ID,
                'Street' => $data['address'],
                'City' => $data['city'],
                'PostalCode' => $data['postcode'],
                'Country' => $data['country'],
            ]);

            // save payment (store masked number)
            $card = preg_replace('/\D/', '', $data['cardnum']);
            $masked = strlen($card) > 4 ? str_repeat('X', strlen($card) - 4) . substr($card, -4) : $card;
            $payment = CustomerPayment::create([
                'Customer_ID' => $customer->Customer_ID,
                'CardHolder_Name' => $data['cardname'],
                'CardNumber' => $masked,
                'ExpiryDate' => $data['exp-month'] . '/' . $data['exp-year'],
            ]);

            // create order
            $total = 0;
            foreach ($basket_products as $bp) {
                $total += ($bp->product->Price * $bp->Quantity);
            }

            $order = FinalOrder::create([
                'Customer_ID' => $customer->Customer_ID,
                'CustomerAddress_ID' => $address->CustomerAddress_ID,
                'CustomerPayment_ID' => $payment->CustomerPayment_ID,
                'OrderDate' => now()->toDateString(),
                'Total_Price' => $total,
                'Status' => 'pending',
            ]);

            // create order items
            foreach ($basket_products as $bp) {
                OrderItem::create([
                    'FinalOrder_ID' => $order->FinalOrder_ID,
                    'Product_ID' => $bp->Product_ID,
                    'Quantity' => $bp->Quantity,
                    'Unit_Price' => $bp->product->Price,
                ]);
            }

            // clear basket items
            foreach ($basket_products as $bp) {
                $bp->delete();
            }

            DB::commit();

            // Send order confirmation email
            Mail::to($data['email'])->send(new OrderConfirmation($order));

            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Could not create order: ' . $e->getMessage());
        }
    }
}

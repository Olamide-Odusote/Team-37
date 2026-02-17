@extends('layouts.app')

@section('title', 'Checkout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
<script>
var gbpTotal = {{ $basket_products && count($basket_products) > 0 ? $basket_products->sum(function($item) { return $item->product->Price * $item->Quantity; }) : 0 }};
var usdTotal = (gbpTotal / 0.78).toFixed(2);

function changeCurrency() {
    var curr = document.getElementById('currency').value;
    var totalElem = document.getElementById('total-amount');
    if (curr === 'gbp') {
        totalElem.textContent = '£' + gbpTotal.toFixed(2);
    } else {
        totalElem.textContent = '$' + usdTotal;
    }
}

function validatePayment() {
    var email = document.getElementById('email').value.trim();
    var card = document.getElementById('cardnum').value.trim();
    var cardname = document.getElementById('cardname').value.trim();
    var cvv = document.getElementById('cvv').value.trim();
    var expm = document.getElementById('exp-month').value;
    var expy = document.getElementById('exp-year').value;
    var fname = document.getElementById('fname').value.trim();
    var lname = document.getElementById('lname').value.trim();
    var address = document.getElementById('address').value.trim();
    var city = document.getElementById('city').value.trim();
    var postcode = document.getElementById('postcode').value.trim();
    var country = document.getElementById('country').value.trim();
    
    if (!email) {
        alert('Email is required');
        return false;
    }
    if (!/\S+@\S+\.\S+/.test(email)) {
        alert('Invalid email format');
        return false;
    }
    if (!card || card.length !== 16) {
        alert('Card number must be 16 digits');
        return false;
    }
    if (!cardname) {
        alert('Name on card is required');
        return false;
    }
    if (!cvv || cvv.length !== 3) {
        alert('CVV must be 3 digits');
        return false;
    }
    if (!expm) {
        alert('Please select expiry month');
        return false;
    }
    if (!expy) {
        alert('Please select expiry year');
        return false;
    }
    if (!fname) {
        alert('First name is required');
        return false;
    }
    if (!lname) {
        alert('Last name is required');
        return false;
    }
    if (!address) {
        alert('Street address is required');
        return false;
    }
    if (!city) {
        alert('City is required');
        return false;
    }
    if (!postcode) {
        alert('Post code is required');
        return false;
    }
    if (!country) {
        alert('Country is required');
        return false;
    }
    
    return true;
}

function cardFilter(e) {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 16);
}

function cvvFilter(e) {
    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 3);
}
</script>
@endsection

@section('content')

<div class="checkout-wrapper">
    <div class="checkout-container">

        <!-- LEFT: PAYMENT FORM -->
        <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <div class="payment-section">
            <h2>Payment Method</h2>

            <div class="payment-method-selector">
                <label>
                    <input type="radio" name="cardtype" value="credit" checked>
                    Credit Card
                </label>
                <label>
                    <input type="radio" name="cardtype" value="debit">
                    Debit Card
                </label>
            </div>

            <h3>Card Information</h3>

            <input type="email" class="input-field" id="email" name="email" placeholder="Email" required>
            <input type="text" class="input-field" id="cardnum" name="cardnum" placeholder="Card Number" maxlength="16" oninput="cardFilter(event)">
            <input type="text" class="input-field" id="cardname" name="cardname" placeholder="Name on Card">

            <div class="expiry-group">
                <label>Expiry Date & CVV</label>
                <div class="expiry-row">
                    <select class="input-field expiry-select" id="exp-month" name="exp-month">
                        <option value="">MM</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <select class="input-field expiry-select" id="exp-year" name="exp-year">
                        <option value="">Year</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                        <option value="2033">2033</option>
                        <option value="2034">2034</option>
                        <option value="2035">2035</option>
                        <option value="2036">2036</option>
                        <option value="2037">2037</option>
                    </select>

                    <input type="text" class="input-field expiry-select" id="cvv" name="cvv" placeholder="CVV" maxlength="3" oninput="cvvFilter(event)">
                </div>
            </div>

            <h3>Shipping Address</h3>

            <input type="text" class="input-field" id="fname" name="fname" placeholder="First Name">
            <input type="text" class="input-field" id="lname" name="lname" placeholder="Last Name">
            <input type="text" class="input-field" id="address" name="address" placeholder="Street Address">
            <input type="text" class="input-field" id="city" name="city" placeholder="City">
            <input type="text" class="input-field" id="postcode" name="postcode" placeholder="Post Code">
            <input type="text" class="input-field" id="country" name="country" placeholder="Country">

            <div class="button-group">
                <a href="{{ route('basket.view') }}" class="btn-back">Back</a>
                <button type="button" class="btn-pay" onclick="if (validatePayment()) { document.getElementById('checkout-form').submit(); }">Pay Now</button>
            </div>
            </div>
        </form>
        </div>

        <!-- RIGHT: ORDER SUMMARY -->
        <div class="order-summary">
            <h2>Order Summary</h2>

            <div class="summary-items">
                @if($basket_products && count($basket_products) > 0)
                    @foreach($basket_products as $item)
                    <div class="summary-item">
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->Name }}</div>
                            <div class="item-meta">{{ $item->Quantity }} × £{{ number_format($item->product->Price, 2) }}</div>
                        </div>
                        <div class="item-price">£{{ number_format($item->product->Price * $item->Quantity, 2) }}</div>
                    </div>
                    @endforeach
                @else
                    <p style="text-align: center; color: #999;">No items in basket</p>
                @endif
            </div>

            <div class="summary-divider"></div>

            <div class="summary-currency">
                <label>Currency:</label>
                <select id="currency" class="input-field" onchange="changeCurrency()">
                    <option value="gbp" selected>GBP (£)</option>
                    <option value="usd">USD ($)</option>
                </select>
            </div>

            <div class="summary-total">
                <span>Total:</span>
                <strong id="total-amount">£{{ number_format($basket_products && count($basket_products) > 0 ? $basket_products->sum(function($item) { return $item->product->Price * $item->Quantity; }) : 0, 2) }}</strong>
            </div>
        </div>

    </div>
</div>

@endsection

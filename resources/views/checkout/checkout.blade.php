@extends('layouts.app')

@section('title', 'Checkout Page')

@section('content')

<link rel="stylesheet" href="{{ asset('Checkout.css') }}">

<div class="top-bar">
    <img src="{{ asset('ologo.png') }}" class="logo-left" alt="Left Logo">
    <img src="{{ asset('vlogo.png') }}" class="logo-right" alt="Right Logo">
</div>

<div class="page-wrapper">

    <div class="container">

        <div class="title">Payment Method</div>

        <div class="card-type-selector">
            <label>
                <input type="radio" name="cardtype" value="credit" checked>
                 Credit Card
            </label>
            <label>
                <input type="radio" name="cardtype" value="debit">
                Debit Card
            </label>
        </div>

        <div class="title">Card Information</div>

        <input type="email" class="input-box" id="email" placeholder="Email" required>
        <input type="text" class="input-box" id="cardnum" placeholder="Card Number" maxlength="16">
        <input type="text" class="input-box" placeholder="Name on Card">

        <div class="expiry-wrapper">
            <label class="expiry-label">Expiry Date & CVV</label>

            <div class="expiry-row">
                <select class="expiry-select" id="exp-month">
                    <option value="">MM</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                            {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                        </option>
                    @endfor
                </select>

                <select class="expiry-select" id="exp-year">
                    <option value="">YYYY</option>
                </select>

                <input type="text" class="expiry-select" id="cvv" placeholder="CVV" maxlength="3">
            </div>

        </div>

        <div class="title">Shipping Address</div>

        <input type="text" class="input-box" placeholder="First Name">
        <input type="text" class="input-box" placeholder="Last Name">
        <input type="text" class="input-box" placeholder="Street Address">
        <input type="text" class="input-box" placeholder="City">
        <input type="text" class="input-box" placeholder="Post Code">
        <input type="text" class="input-box" placeholder="Country">

        <div class="button-row">
            <button class="button back-btn">Back</button>
            <button class="button next-btn">Pay Now</button>
        </div>

    </div>

    <!-- ORDER BOX -->
    <div class="order-box">
        <h2>Your Order</h2>

        <div id="cart"></div>

        <select id="currency" class="input-box" style="margin-top: 20px;">
            <option value="usd" selected>USD</option>
            <option value="gbp">GBP</option>
        </select>

        <div class="order-total">
            <span>Total:</span>
            <strong id="total">$0.00</strong>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
document.getElementById("cardnum").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, "").slice(0, 16);
});
</script>

<script>
var items = [
    { name: "Item A", price: 19.99, qty: 1 },
    { name: "Item B", price: 9.99, qty: 2 }
];

var rate = 0.78;
var currency = "usd";

function updateCart() {
    var c = document.getElementById("cart");
    c.innerHTML = "";
    var total = 0;

    items.forEach((item, i) => {
        var p = item.price * item.qty;
        total += p;

        c.innerHTML += `
            <div style="margin-bottom:10px;">
                <div>${item.name}</div>
                <div>
                    <button onclick="dec(${i})">-</button>
                    ${item.qty}
                    <button onclick="inc(${i})">+</button>
                    <button onclick="rem(${i})">Remove</button>
                </div>
            </div>
        `;
    });

    if (currency === "usd") {
        total = "$" + total.toFixed(2);
    } else {
        total = "£" + (total * rate).toFixed(2);
    }

    document.getElementById("total").textContent = total;
}

function inc(i) { items[i].qty++; updateCart(); }
function dec(i) { if (items[i].qty > 1) items[i].qty--; updateCart(); }
function rem(i) { items.splice(i, 1); updateCart(); }

document.getElementById("currency").addEventListener("change", function() {
    currency = this.value;
    updateCart();
});

updateCart();
</script>

<script>
var email = document.getElementById("email");
var pay = document.querySelector(".next-btn");
var card = document.getElementById("cardnum");
var cvv = document.getElementById("cvv");
var expm = document.getElementById("exp-month");
var expy = document.getElementById("exp-year");

var current = new Date().getFullYear();
for (var i = 0; i < 12; i++) {
    var op = document.createElement("option");
    op.value = current + i;
    op.textContent = current + i;
    expy.appendChild(op);
}

pay.addEventListener("click", function(e) {
    var valid =
        /\S+@\S+\.\S+/.test(email.value) &&
        card.value.length === 16 &&
        cvv.value.length === 3 &&
        expm.value &&
        expy.value;

    if (!valid) {
        e.preventDefault();
    }
});
</script>

@endsection

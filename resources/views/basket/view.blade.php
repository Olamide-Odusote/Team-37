@extends('layouts.app')

@section('title', 'Your Basket')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/basket.css') }}">
@endsection

@section('content')

<body>
    <!-- BASKET CONTENT -->
    <div class="wrapper">
        <br/>
        <!-- ORDER HISTORY BUTTON -->
        @guest
        <!-- Not visible until the user signs in -->
        @else
            <button class="checkout-button">
                <a href="{{ route('orders.index') }}">Order History</a>
            </button>
        @endguest
        <div class="basket">
                <h1>Your Cart ({{ $basket_size }})</h1>

                @guest
                    <div class="guest-warning" style="border:1px solid #f5c6cb;background:#fff3f3;padding:12px;border-radius:6px;margin:12px 0;color:#721c24;">
                        You are not signed in. <a href="{{ route('signin') }}">Sign in</a> to save your basket and proceed to checkout.
                    </div>
                @endguest
    
            <div class="basket-header">
                <div class="header-item">Items</div>
                <div class="header-price">Price</div>
                <div class="header-quantity">Quantity</div>
                <div class="header-total">Total</div>
            </div>
            <!-- LOOP THROUGH PRODUCTS IN BASKET -->
            @if($basket_products && count($basket_products) > 0)
                @foreach ($basket_products as $item)
            <div class="basket-product">

            <div class="item">
                <img src="{{ asset('images/products/' . $item->product->Image_URL) }}"style="max-height:100px; max-width:100px;">
                <span>{{ $item->product->Name }}</span>
            </div>
            
            <div class="price">
                £{{ number_format($item->product->Price, 2) }}
            </div>

            <div class="quantity">
                <form action="{{ route('basket.adjust', [$item->Product_ID, 'dec']) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-qty">−</button>
                </form>
                <span class="qty-value">{{ $item->Quantity }}</span>
                <form action="{{ route('basket.adjust', [$item->Product_ID, 'inc']) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-qty">+</button>
                </form>
            </div>
            
            <div class="total">
                £{{ number_format($item->product->Price * $item->Quantity, 2) }}
            </div>
            
            <div class="actions">
                <form action="{{ route('basket.remove', $item->Product_ID) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-remove">Remove</button>
                </form>
            </div>

        </div>
        @endforeach
            @else
                <p>Your basket is empty</p>
            @endif

            <!-- SUBTOTAL ROW -->
            @if($basket_products && count($basket_products) > 0)
            <div class="basket-subtotal">
                <div class="subtotal-label">Subtotal:</div>
                <div class="subtotal-value">£{{ number_format($basket_products->sum(function($item) { return $item->product->Price * $item->Quantity; }), 2) }}</div>
            </div>
            @endif

            <div style="border-top:1px solid"></div>

        </div>

        <br/><br/><br/>

        <!-- CHECKOUT BUTTON -->
        @guest
            <a class="checkout-button checkout-login" href="{{ route('signin') }}">Sign in to Checkout</a>
        @else
            <button class="checkout-button">
                <a href="{{ route('checkout.checkout') }}">Checkout</a>
            </button>
        @endguest

    </div>
    
</body>
@endsection

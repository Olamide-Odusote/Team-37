<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/basket.css') }}">
    <title>Basket</title>
</head>

<body>
    <!-- NAVIGATION BAR -->
    <header>
        @include('layouts.app')
    </header>
    <!-- BASKET CONTENT -->
    <div class="wrapper">
        <div class="basket">
                <h1>Your Cart ({{ $basket_size }})</h1>

                @guest
                    <div class="guest-warning" style="border:1px solid #f5c6cb;background:#fff3f3;padding:12px;border-radius:6px;margin:12px 0;color:#721c24;">
                        You are not signed in. <a href="{{ route('signin') }}">Sign in</a> to save your basket and proceed to checkout.
                    </div>
                @endguest
    
            <div class="heading" style="width: 30%; text-align: left;">Items</div>
            <div class="heading" style="width: 20%;">Price</div>
            <div class="heading" style="width: 30%;">Quantity</div>
            <div class="heading" style="width: 20%;">Total</div>

            <br/>
            <!-- LOOP THROUGH PRODUCTS IN BASKET -->
            @foreach ($products as $product)
                <div class="product">

                <!-- GET QUANTITY OF THIS PRODUCT IN BASKET -->
                @php $basket_product = $basket->products->where('id', $product->id)->first(); @endphp
                    <div class="item">
                        <img src="{{ $product->Image_URL }}" style="max-height:100px; max-width:100px;">
                        <span>{{ $product->Name }}</span>
                    </div>
                    <!-- PRICE PER UNIT -->

                    <div class="price">
                        <span>£{{ $product->Price }}</span>
                    </div>

                    <!-- QUANTITY CONTROLS -->
                    <div class="quantity">
                        <form action="{{ route('basket.remove', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-remove">-</button>
                        </form>

                            <span>{{ optional($basket_product)->Quantity ?? ($basket_product['Quantity'] ?? 0) }}</span>

                            <!-- ADD QUANTITY BUTTON -->
                        <form action="{{ route('basket.add', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-add">+</button>
                        </form>
                    </div>

                    <!-- TOTAL PRICE FOR THIS PRODUCT -->
                    <div class="total">
                        <span>£{{ $product->Price * (optional($basket_product)->Quantity ?? ($basket_product['Quantity'] ?? 0)) }}</span>
                    </div>
                </div>
            @endforeach

            <div style="border-top:1px solid"></div>

        </div>

        <br/><br/><br/>

        <!-- CHECKOUT BUTTON -->
        @guest
            <a class="checkout-button checkout-login" href="{{ route('signin') }}">Sign in to Checkout</a>
        @else
            <button class="checkout-button">
                <a href="{{ route('checkout') }}">Checkout</a>
            </button>
        @endguest

    </div>
    
</body>
</html>

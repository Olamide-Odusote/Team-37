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

    <header>
        @include('layouts.navbar')
    </header>

    <div class="wrapper">
        <div class="basket">
            <h1>Your Cart ({{ $basket_size }})</h1>
    
            <div class="heading" style="width: 30%; text-align: left;">Items</div>
            <div class="heading" style="width: 20%;">Price</div>
            <div class="heading" style="width: 30%;">Quantity</div>
            <div class="heading" style="width: 20%;">Total</div>

            <br/>

            @foreach ($products as $product)
                <div class="product">

                    <div class="item">
                        <img src="{{ $product->Image_URL }}" style="max-height:100px; max-width:100px;">
                        <span>{{ $product->Name }}</span>
                    </div>

                    <div class="price">
                        <span>£{{ $product->Price }}</span>
                    </div>

                    <div class="quantity">
                        <form action="{{ route('basket.remove', $item->product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-remove">-</button>
                        </form>

                            <span><?= $basket_product["Quantity"] ?></span>
                            
                        <form action="{{ route('basket.add', $item->product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-add">+</button>
                        </form>
                    </div>

                    <div class="total">
                        <span>£{{ $product->Price * $basket_product->Quantity }}</span>
                    </div>
                </div>
            @endforeach

            <div style="border-top:1px solid"></div>

        </div>

        <br/><br/><br/>

        <button class="checkout-button">
            <a href="{{ route('checkout') }}">Checkout</a>
        </button>

    </div>
    
</body>
</html>

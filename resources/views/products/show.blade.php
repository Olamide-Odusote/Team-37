@extends('layouts.app')

@section('title', $product->Name)

@section('content')
<link rel="stylesheet" href="{{ asset('css/product-show.css') }}">

<div class="product-container">

    <!-- LEFT (Product Image) -->
    <div class="product-left">
        <img src="{{ asset('images/products/' . $product->Image_URL) }}" 
             alt="{{ $product->Name }}" class="product-main-img">
    </div>

    <!-- CENTER (Details) -->
    <div class="product-middle">
        <h2 class="product-title">{{ $product->Name }}</h2>
        <p class="product-description">{{ $product->Description }}</p>

        <p class="product-meta">
            ✔️ FREE Returns <br>
            🚚 Fast Delivery Available <br>
            📦 In Stock
        </p>
    </div>

    <!-- RIGHT (BUY BOX) -->
    <div class="product-right">
        <h3 class="product-price">£{{ number_format($product->Price, 2) }}</h3>

        <form action="{{ route('basket.add', $product->Product_ID) }}" method="POST">
            @csrf
            
            <label>Quantity:</label>
            <select name="qty" class="qty-select">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <button type="submit" class="btn-add">Add to Basket</button>
        </form>

        <div class="extra-info">
            Dispatches from OmniCart <br>
            Sold by OmniCart <br>
            Secure Transaction 🔒
        </div>
    </div>

</div>

@endsection

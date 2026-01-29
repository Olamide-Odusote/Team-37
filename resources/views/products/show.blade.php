@extends('layouts.app')

@section('title', $product->Name)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products-show.css') }}">
@endsection

@section('content')

<div class="product-container">

    <!-- LEFT: Product Image -->
    <div class="product-left">
        <img src="{{ asset('images/products/' . $product->Image_URL) }}" 
             alt="{{ $product->Name }}" class="product-main-img">
    </div>

    <!-- CENTER: Product Details -->
    <div class="product-middle">
        <h1 class="product-title">{{ $product->Name }}</h1>

        <p class="product-description">{{ $product->Description }}</p>

        <ul class="product-meta">
            <li>✔️ <strong>FREE Returns</strong></li>
            <li>🚚 <strong>Fast Delivery Available</strong></li>
            <li>📦 <strong>In Stock</strong></li>
        </ul>
    </div>

    <!-- RIGHT: Buy Box -->
    <aside class="product-right">
        <div class="buy-box">
            <h2 class="product-price">£{{ number_format($product->Price, 2) }}</h2>

            <form action="{{ route('basket.add', $product->Product_ID) }}" method="POST">
                @csrf
                <label for="qty">Quantity:</label>
                <select name="qty" id="qty" class="qty-select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <button type="submit" class="btn-add">Add to Basket</button>
            </form>

            <div class="extra-info">
                <p><strong>Dispatches from:</strong> OmniCart</p>
                <p><strong>Sold by:</strong> OmniCart</p>
                <p><strong>Secure Transaction</strong> 🔒</p>
            </div>
        </div>
    </aside>

</div>

@endsection

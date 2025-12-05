@extends('layouts.app')

@section('title', $category->CategoryName)

@section('content')
<link rel="stylesheet" href="{{ asset('css/product-index.css') }}">

<h1 style="margin: 20px 0; text-align:center;">
    {{ $category->CategoryName }}
</h1>

@if ($products->count() == 0)
    <p style="text-align:center;">No products found in this category.</p>
@endif

<div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('products.show', $product->Product_ID) }}" class="product-media">
                <img src="{{ asset('images/products/' . $product->Image_URL) }}" alt="{{ $product->Name }}">
            </a>

            <div class="product-info">
                <h3 class="product-title">{{ $product->Name }}</h3>
                <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->Description, 100) }}</p>

                <div class="price">£{{ number_format($product->Price, 2) }}</div>

                <a class="product-cta" href="{{ route('products.show', $product->Product_ID) }}">
                    View Product
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection

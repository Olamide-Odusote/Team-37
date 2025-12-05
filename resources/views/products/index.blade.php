@extends('layouts.app')

@section('title', 'Products')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="page">

    <div class="products-page-header">
        <h1>Products</h1>
    </div>

    @if($products->isEmpty())
        <p class="no-products">No products found.</p>
    @else

        <section class="product-grid" role="list" aria-live="polite">
            @foreach($products as $product)
            <article class="product-card" role="listitem">
                
                <a class="product-media" 
                   href="{{ route('products.show', $product->Product_ID) }}"
                   aria-label="{{ $product->Name }}">
                    <img src="{{ asset('images/products/' . $product->Image_URL) }}" 
                         alt="{{ $product->Name }}">
                </a>

                <div class="product-info">
                    <h3 class="product-title">{{ $product->Name }}</h3>

                    <p class="product-desc">
                        {{ Str::limit($product->Description, 110) }}
                    </p>

                    <div class="product-meta">
                        <div class="price">£{{ number_format($product->Price, 2) }}</div>
                    </div>

                    <a class="product-cta"
                       href="{{ route('products.show', $product->Product_ID) }}">
                        View product
                    </a>
                </div>
            </article>
            @endforeach
        </section>

    @endif

</div>
@endsection

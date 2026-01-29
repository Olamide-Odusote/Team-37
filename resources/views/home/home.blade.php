@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <h1>Smart Shopping, Smarter Living</h1>
            <p>Discover a wide range of products that fit your style, budget, and lifestyle. Shop effortlessly and enjoy the convenience of OmniCart.</p>
            <a class="hero-cta" href="{{ route('products.index') }}">Browse Products</a>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/hero.jpg') }}" alt="OmniCart Shopping"/>
        </div>
    </div>
</section>

{{-- CATEGORIES SECTION --}}
<section class="categories-section">
    <h2>Browse by Category</h2>
    <div class="categories-grid">
        <a class="cat" href="{{ route('categories.show', 1) }}">
            <div class="cat-icon">
                <img src="{{ asset('images/categories/Laptop.png') }}" alt="Computers & Accessories">
            </div>
            <span>Computers & Accessories</span>
        </a>

        <a class="cat" href="{{ route('categories.show', 2) }}">
            <div class="cat-icon">
                <img src="{{ asset('images/categories/wardrobe.png') }}" alt="Wardrobe">
            </div>
            <span>Wardrobe</span>
        </a>

        <a class="cat" href="{{ route('categories.show', 3) }}">
            <div class="cat-icon">
                <img src="{{ asset('images/categories/sport.png') }}" alt="Sports">
            </div>
            <span>Sports</span>
        </a>

        <a class="cat" href="{{ route('categories.show', 4) }}">
            <div class="cat-icon">
                <img src="{{ asset('images/categories/education.png') }}" alt="Education & Equipment">
            </div>
            <span>Education & Equipment</span>
        </a>

        <a class="cat" href="{{ route('categories.show', 5) }}">
            <div class="cat-icon">
                <img src="{{ asset('images/categories/ph.png') }}" alt="Personal Healthcare">
            </div>
            <span>Personal Healthcare</span>
        </a>
    </div>
</section>

{{-- TOP PRODUCTS (placeholder until DB logic applies) --}}
<section class="products-section">
    <h2>Top Rated Products</h2>

    <div class="product-grid">
        @foreach ($topProducts ?? [] as $product)
        <a href="{{ route('products.show', $product->id) }}" class="product">
            <div class="product-media">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <div class="product-info">
                <p>{{ $product->name }}</p>
                <p class="price">£{{ number_format($product->price, 2) }}</p>
            </div>
        </a>
        @endforeach

        @if(empty($topProducts) || count($topProducts) === 0)
            <p style="color:white; margin-top: 15px;">Top-rated products will appear here soon.</p>
        @endif
    </div>
</section>

{{-- FEATURES SECTION --}}
<section class="features-section">
    <div class="features-grid">
        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/TruckIcon.png') }}" alt="Fast Shipping">
            </div>
            <h3>Fast Shipping</h3>
            <p>We deliver within 4–5 working days.</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/ReturnIcon.png') }}" alt="Returns">
            </div>
            <h3>Easy Returns</h3>
            <p>Return within 30 days hassle-free.</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/SaveMoneyIcon.png') }}" alt="Save Money">
            </div>
            <h3>Affordable Prices</h3>
            <p>Shop smart, save more on every item.</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/SupportIcon.png') }}" alt="Support">
            </div>
            <h3>24/7 Support</h3>
            <p>Help anytime you need it.</p>
        </div>
    </div>
</section>

@endsection

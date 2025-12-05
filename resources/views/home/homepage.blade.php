@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<header>

<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
        <h1>Smart Shopping, Smarter Living</h1>
        Discover a wide range of electronics and everyday essentials that fit your lifestyle and budget.
        <p></p>
        <a class="hero-cta" href="">Learn More</a> 
        </div>
        <div class="hero-image">
        <img src="{{ asset('images/hero.jpg') }}" alt="Gaming Gear">
        </div>
    </div>
</section>

<section class="categories-section">
    <h2>Browse by Category</h2>
    <div class="categories-grid">
        <a class="cat" href=""><div class="cat-icon"><img src="{{ asset('images/Laptop.png') }}" alt=""></div><span>Computers & Accessories</span></a>
        <a class="cat" href=""><div class="cat-icon"><img src="{{ asset('images/wardrobe.png') }}" alt=""></div><span>Wardrobe</span></a>
        <a class="cat" href=""><div class="cat-icon"><img src="{{ asset('images/sport.png') }}" alt=""></div><span>Sports</span></a>
        <a class="cat" href=""><div class="cat-icon"><img src="{{ asset('images/education.png') }}" alt=""></div><span>Education & Equipment</span></a>
        <a class="cat" href=""><div class="cat-icon"><img src="{{ asset('images/ph.png') }}" alt=""></div><span>Personal Healthcare</span></a>
    </div>
</section>

<section class="products-section">
    <h2>Top Rated Products</h2>
    <div class="product-grid">
        
      <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/bluetoothspeaker.jpeg') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">$35</p>
            </div>
        </div>


        <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/football.jpeg') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">$20</p>
            </div>
        </div>

        <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/hoodie.png') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">$70</p>
            </div>
        </div>
    </div>
</section>

<section class="features-section">
    <div class="features-grid">
        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/TruckIcon.png') }}" alt="Feature 1">
            </div>
            <h3>Super fast shipping</h3>
            <p>We deliver within 4-5 days</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/ReturnIcon.png') }}" alt="Feature 2">
            </div>
            <h3>Return Policy</h3>
            <p>Flexible returns so you buy with confidence.</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/SaveMoneyIcon.png') }}" alt="Feature 3">
            </div>
            <h3>Save Money</h3>
            <p>Competitive prices and regular promotions.</p>
        </div>

        <div class="feature">
            <div class="feature-icon">
                <img src="{{ asset('images/SupportIcon.png') }}" alt="Feature 4">
            </div>
            <h3>Support 24/7</h3>
            <p>Dedicated support to help with orders and questions.</p>
        </div>
    </div>
</section>

<footer>
    <div class="footer-inner">
        <p></p>
    </div>
</footer>

@endsection

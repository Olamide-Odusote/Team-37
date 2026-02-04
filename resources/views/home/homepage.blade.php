@extends('layouts.app') <!-- TRUE HOMEPGE -->

@section('title', 'OmniCart - Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')

{{-- HERO SECTION --}} 
<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <h1>Smart Shopping, Smarter Living</h1>
            <p>Discover a wide range of electronics and everyday essentials that fit your lifestyle and budget.</p>
            <a class="hero-cta" href="{{ route('products.index') }}">Browse Products</a>
        </div>

        <div class="hero-image">
            <div class="carousel" id="hero-carousel">
                <img src="{{ asset('images/hero.jpg') }}" class="active" alt="Hero Image 1">
                <img src="{{ asset('images/hero2.png') }}" alt="Hero Image 2">
                <img src="{{ asset('images/hero3.png') }}" alt="Hero Image 3">
                <img src="{{ asset('images/hero4.png') }}" alt="Hero Image 4">
                <img src="{{ asset('images/hero5.jpg') }}" alt="Hero Image 5">
            </div>
        </div>
    </div>
</section>

{{-- Carousel JS --}}
<script>
    const heroImages = document.querySelectorAll('#hero-carousel img');
    let currentHero = 0;

    function nextHeroImage() {
        heroImages[currentHero].classList.remove('active');
        heroImages[currentHero].classList.add('leave-left');

        currentHero = (currentHero + 1) % heroImages.length;

        heroImages[currentHero].classList.remove('leave-left');
        heroImages[currentHero].classList.add('active');
    }

    setInterval(nextHeroImage, 5000); // 5 seconds per image
</script>



<section class="categories-section">
    <h2>Browse by Category</h2>
    <div class="categories-grid">
        <a class="cat" href="{{ route('categories.show', 1) }}">
    <div class="cat-icon"><img src="{{ asset('images/Laptop.png') }}" alt=""></div>
    <span>Computers & Accessories</span>
</a>

<a class="cat" href="{{ route('categories.show', 2) }}">
    <div class="cat-icon"><img src="{{ asset('images/wardrobe.png') }}" alt=""></div>
    <span>Wardrobe</span>
</a>

<a class="cat" href="{{ route('categories.show', 3) }}">
    <div class="cat-icon"><img src="{{ asset('images/sport.png') }}" alt=""></div>
    <span>Sports</span>
</a>

<a class="cat" href="{{ route('categories.show', 4) }}">
    <div class="cat-icon"><img src="{{ asset('images/education.png') }}" alt=""></div>
    <span>Education & Equipment</span>
</a>

<a class="cat" href="{{ route('categories.show', 5) }}">
    <div class="cat-icon"><img src="{{ asset('images/ph.png') }}" alt=""></div>
    <span>Personal Healthcare</span>
</a>
    </div>
</section>

<section class="products-section">
    <h2>Top Rated Products</h2>
    <div class="product-grid">
        
      <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/products/bluetoothspeaker.jpeg') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">£35</p>
            </div>
        </div>


        <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/products/football.jpeg') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">£20</p>
            </div>
        </div>

        <div class="product">
            <div class="product-media">
                <img src="{{ asset('images/products/hoodie.png') }}" alt="">
            </div>
            <div class="product-info">
                <p></p>
                <p class="price">£70</p>
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

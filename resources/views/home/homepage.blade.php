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
            <div class="carousel-text" id="hero-text-carousel">
                <!-- The moving title and descriptions -->
                <div class="text-item active">
                    <h1>Smart Shopping Smarter Living</h1>
                    <p>Discover a wide range of electronics and everyday essentials that fit your lifestyle and budget.</p>
                    <a class="hero-cta" href="{{ route('products.index') }}">Browse Products</a>
                </div>
                <div class="text-item">
                    <h1>Competitive Prices</h1>
                    <p>Save up to 20% on the newest gadgets, laptops, and accessories.</p>
                    <a class="hero-cta" href="{{ route('products.index') }}">Shop Now</a>
                </div>
                <div class="text-item">
                    <h1>Lightning-Fast Delivery</h1>
                    <p>Get your order quickly with free delivery on purchases over £50 and easy 30-day returns.</p>
                    <a class="hero-cta" href="{{ route('products.index') }}">Learn More</a>
                </div>
                <div class="text-item">
                    <h1>New Arrivals Weekly</h1>
                    <p>Be the first to discover our latest products and exclusive collections.</p>
                    <a class="hero-cta" href="{{ route('products.index') }}">View New Items</a>
                </div>
                <div class="text-item">
                    <h1>Customer Support</h1>
                    <p>Need help? Email us at support.monicart@gmail.com and our team will get back to you as soon as possible.</p>
                    <a class="hero-cta" href="{{ route('products.index') }}">Join Free</a>
                </div>
            </div>
        </div>
         <!-- The moving images  -->
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
<!-- The moving js Script for the effect -->
{{-- Carousel JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroImages = document.querySelectorAll('#hero-carousel img');
        const textItems = document.querySelectorAll('#hero-text-carousel .text-item');
        let currentHero = 0;

        function nextHeroImage() {
            // Remove active from current image and add leave-right
            heroImages[currentHero].classList.remove('active');
            heroImages[currentHero].classList.add('leave-right');
            
            // Remove active from current text and add leave-right
            textItems[currentHero].classList.remove('active');
            textItems[currentHero].classList.add('leave-right');

            // Move to next index
            currentHero = (currentHero + 1) % heroImages.length;

            // Prepare next image - start from left
            heroImages[currentHero].classList.remove('leave-right');
            heroImages[currentHero].classList.add('active');
            
            // Prepare next text - start from left
            textItems[currentHero].classList.remove('leave-right');
            textItems[currentHero].classList.add('active');

            // Clean up leave-right class from previous items after animation
            setTimeout(() => {
                heroImages.forEach((img, index) => {
                    if (index !== currentHero) {
                        img.classList.remove('leave-right');
                    }
                });
                textItems.forEach((item, index) => {
                    if (index !== currentHero) {
                        item.classList.remove('leave-right');
                    }
                });
            }, 800);
        }

        setInterval(nextHeroImage, 5000); // 5 seconds per image
    });
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
            <div class="cat-icon"><img src="{{ asset('images/personalHC.png') }}" alt=""></div>
            <span>Personal Healthcare</span>
        </a>
    </div>
    <div id="peekobot-container">
    <div id="peekobot-inner">
        <div id="peekobot"></div>
    </div>
</div>
</section>

<section class="products-section">
    <h2>Most Bought Products</h2>
    <div class="product-grid">
        @foreach($topProducts as $product)
            <div class="product">
                <div class="product-media">
                    <img src="{{ asset('images/products/' . $product->Image_URL) }}" alt="{{ $product->Name }}">
                </div>
                <div class="product-info">
                    <p>{{ $product->Name }}</p>
                    <p class="price">£{{ $product->Price }} ({{ $product->total_sold }} sold)</p>
                </div>
            </div>
        @endforeach
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
            <p>Competitive prices</p>
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
@endsection
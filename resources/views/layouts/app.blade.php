<!DOCTYPE html>
<html lang="en">
<!--
    Main Layout Template
    Includes navigation bar, footer, and main content area.
-->
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('styles')
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar">
        <div class="navbar-top">
            <div class="nav-left">
                <a href="{{ route ('home') }}">
                    <img src="{{ asset('images/OmniCart_Logo.png') }}" class="logo" alt="OmniCart logo - online shopping marketplace">
                </a>
            </div>
            <!-- CENTER SEARCH BAR -->
            <div class="nav-center">
                <div class="category">
                    <div class="search-container">
                        <button type="button" class="category-btn" id="categoryBtn" aria-label="Search category">
                            <span class="category-text">All</span>
                            <span class="category-arrow">▼</span>
                        </button>
                        <div class="category-dropdown" id="categoryDropdown" style="display: none;">
                            <div class="category-option" data-value="all" data-name="All" style="display: block; padding: 10px 15px; text-decoration: none; color: #fff; cursor: pointer; border-bottom: 1px solid #0044aa; background: #0055C0;">All Products</div>
                            @foreach(\App\Models\ProductCategory::all() as $cat)
                                <div class="category-option" data-value="{{ $cat->ProductCategory_ID }}" data-name="{{ $cat->Name }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #fff; cursor: pointer; border-bottom: 1px solid #0044aa; background: #0055C0;">{{ $cat->Name }}</div>
                            @endforeach
                        </div>
                        <form method="GET" action="{{ route('products.search') }}" style="display: flex; flex: 1; gap: 0;">
                            <input type="text" class="search-input" name="query" placeholder="Search OmniCart" aria-label="Search OmniCart">
                            <input type="hidden" name="category" id="categoryInput" value="">
                            <button type="submit" class="search-btn" aria-label="Search">
                                <img src="{{ asset('images/search_icon.png') }}" class="search-icon" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- RIGHT NAV ITEMS -->
            <div class="nav-right">
                @auth
                    <div class="nav-item user-dropdown">
                        <button class="user-btn">
                            {{ Auth::user()->name }}
                            <span class="caret">▼</span>
                        </button>

                        <div class="user-menu">
                            <a href="{{ route('account.index') }}" class="dropdown-item">Profile</a>
                            <form action="{{ route('signout.post') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Sign Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="nav-item">
                        <a class="signin" href="{{ route('signin') }}">Sign In</a>
                    </div>
                @endauth

                <a href="{{ route('basket.view') }}" class="basket-link">
                    <div class="basket-wrapper">
                        <img src="{{ asset('images/cart.png') }}" class="basket-icon" alt="Cart">
                        <span class="basket-count">
                            @auth
                                @php
                                    $basketCount = 0;
                                    if (Auth::user()->customer) {
                                        $basket = \App\Models\Basket::where('Customer_ID', Auth::user()->customer->Customer_ID)->first();
                                        if ($basket) {
                                            $basketCount = $basket->basketProducts()->sum('Quantity');
                                        }
                                    }
                                @endphp
                                {{ $basketCount }}
                            @else
                                0
                            @endauth
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!-- BOTTOM NAV LINKS -->
        <div class="nav-bottom">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @if (session('success'))
            <div class="alert alert-success">
                <span class="alert-icon"></span>
                <span class="alert-message">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <span class="alert-icon"></span>
                <span class="alert-message">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                <span class="alert-icon"></span>
                <span class="alert-message">{{ session('warning') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                <span class="alert-icon"></span>
                <span class="alert-message">{{ session('info') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#">Conditions Of Use & Sale</a>
            <a href="#">Privacy Notice</a>
            <a href="#">Cookies Notice</a>
        </div>

        <p class="copyright">
            © 2025– , OmniCart.Co.Uk
        </p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryBtn = document.getElementById('categoryBtn');
            const categoryDropdown = document.getElementById('categoryDropdown');
            const categoryOptions = document.querySelectorAll('.category-option');
            const categoryText = document.querySelector('.category-text');
            const categoryInput = document.getElementById('categoryInput');

            // Toggle dropdown on button click
            categoryBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                categoryDropdown.style.display = categoryDropdown.style.display === 'none' ? 'block' : 'none';
            });

            // Handle category selection
            categoryOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const value = this.getAttribute('data-value');
                    const name = this.getAttribute('data-name');
                    categoryText.textContent = name;

                    // Set the hidden form field for search
                    if (value === 'all') {
                        categoryInput.value = '';
                    } else {
                        categoryInput.value = value;
                    }

                    sessionStorage.setItem('selectedCategory', value);
                    sessionStorage.setItem('selectedCategoryName', name);
                    categoryDropdown.style.display = 'none';
                });
            });

            // Restore selected category on page load
            const savedCategory = sessionStorage.getItem('selectedCategoryName');
            const savedCategoryId = sessionStorage.getItem('selectedCategory');
            if (savedCategory) {
                categoryText.textContent = savedCategory;
                if (savedCategoryId && savedCategoryId !== 'all') {
                    categoryInput.value = savedCategoryId;
                } else {
                    categoryInput.value = '';
                }
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!document.querySelector('.category').contains(e.target)) {
                    categoryDropdown.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>

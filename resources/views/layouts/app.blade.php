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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" /> 

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
                {{-- If ADMIN is logged in --}}
                @if(Auth::guard('admin')->check())
                <div class="nav-item user-dropdown">
                    <button class="user-btn">
                        Admin
                        <span class="caret">▼</span>
                    </button>
                    
                    <div class="user-menu">
                        <a href="{{ route('admin.inventory.index') }}" class="dropdown-item">Dashboard</a>
                        
                        <form action="{{ route('signout.post') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign Out</button>
                        </form>
                    </div>
                </div>
                @endif
                
                {{-- If CUSTOMER is logged in --}}
                @if(Auth::check() && !Auth::guard('admin')->check())
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
    @endif


    {{-- If NO ONE is logged in --}}
    @if(!Auth::check() && !Auth::guard('admin')->check())
        <div class="nav-item">
            <a href="{{ route('auth.login') }}" class="signin-btn">Sign In</a>
        </div>
    @endif
                 <!-- DARK MODE BUTTON -->
                  <button id="darkModeToggle" class="darkmode-btn" aria-label="Toggle Dark Mode">
                  <i class="fas fa-moon"></i> <!-- initial icon -->
                  </button>
            

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
    </div> <!-- END NAVBAR TOP -->

        <!-- BOTTOM NAV LINKS -->
        <div class="nav-bottom">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                @if (Auth::guard('admin')->check())
                    <li><a href="{{ route('admin.inventory.index') }}">Admin Dashboard</a></li>
                @endif
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

    // CATEGORY DROPDOWN (keep your existing code)
    const categoryBtn = document.getElementById('categoryBtn');
    const categoryDropdown = document.getElementById('categoryDropdown');
    const categoryOptions = document.querySelectorAll('.category-option');
    const categoryText = document.querySelector('.category-text');
    const categoryInput = document.getElementById('categoryInput');

    categoryBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        categoryDropdown.style.display =
            categoryDropdown.style.display === 'none' ? 'block' : 'none';
    });

    categoryOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            const value = this.getAttribute('data-value');
            const name = this.getAttribute('data-name');
            categoryText.textContent = name;
            categoryInput.value = (value === 'all') ? '' : value;

            sessionStorage.setItem('selectedCategory', value);
            sessionStorage.setItem('selectedCategoryName', name);
            categoryDropdown.style.display = 'none';
        });
    });

    document.addEventListener('click', function(e) {
        if (!document.querySelector('.category').contains(e.target)) {
            categoryDropdown.style.display = 'none';
        }
    });

    // DARK MODE
    const toggleBtn = document.getElementById('darkModeToggle');
    if (!toggleBtn) return;

    // Load dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        toggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
    }

    // Toggle dark mode
    toggleBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
        toggleBtn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    });

});
</script>

</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ config('app.name', 'OmniCart') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="oc-nav">
        <div class="oc-nav__inner">
            <!-- Left: Logo -->
            <a href="{{ url('/') }}" class="oc-logo">
                <img src="{{ asset('images/OmniCart_Logo.png') }}" alt="OmniCart logo" class="oc-logo__img" />
            </a>

            <!-- Center: Search -->
            <form action="{{ route('search') ?? url('/search') }}" method="GET" class="oc-search" role="search" aria-label="Search OmniCart">
                <button type="button" class="oc-search__menu">V</button>
                <input class="oc-search__input" name="q" type="search" placeholder="Search OmniCart" aria-label="Search" />
                <button type="submit" class="oc-search__submit" aria-label="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 21l-4.35-4.35" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="11" cy="11" r="6" stroke="#fff" stroke-width="2"/></svg>
                </button>
            </form>

            <!-- Right: Sign in + Cart -->
            <div class="oc-actions">
                <a href="{{ route('login') }}" class="oc-actions__signin">Sign In</a>
                <a href="{{ route('cart') }}" class="oc-actions__cart" aria-label="View cart">
                    <img src="{{ asset('images/cart.png') }}" alt="Cart" class="oc-actions__cartimg" />
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        {{-- optional footer --}}
    </footer>
</body>
</html>
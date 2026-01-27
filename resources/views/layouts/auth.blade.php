<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    {{-- Shared auth styles --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    {{-- Page-specific styles --}}
    @yield('styles')
</head>

<body class="auth-body">

    <div class="auth-logo-container">
              <a href="{{ route ('home') }}">
      <img src="{{ asset('images/OmniCart_Logo.png') }}" class="logo" alt="OmniCart logo - online shopping marketplace">
      </a>
    </div>

    <main class="auth-main">
        @yield('content')
    </main>

    <footer class="auth-footer">
        <div class="footer-links">
            <a href="#">Conditions Of Use & Sale</a>
            <a href="#">Privacy Notice</a>
            <a href="#">Cookies Notice</a>
        </div>
        <p class="copyright">© 2025 – OmniCart.Co.Uk</p>
    </footer>

</body>
</html>

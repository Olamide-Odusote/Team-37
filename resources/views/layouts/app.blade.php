<!DOCTYPE html>
<html lang="en">

<head>
    <link rel=preconnect href="https://fonts.googleapis.com">
    <link rel=preconnect href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}">
    <!-- bootstrap css -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar">
  <div class="navbar-top">
    <div class="nav-left">
      <img src="{{ asset('images/OmniCart_Logo.png') }}" class="logo" alt="OmniCart logo">
    </div>

    <div class="nav-center">
        <div class="category">
            <div class="search-container">
                <select class="category-select" aria-label="Search category">
          <option value="all">All</option>
          <option value="computers-and-accessories">Computers & Accessories</option>
          <option value="wardobe">Wardrobe</option>
          <option value="sports">Sports</option>
          <option value="education-and-equipment">Education & Equipment</option>
          <option value="personal-healthcare">Personal Healthcare</option>
        </select>
        <input type="text" class="search-input" placeholder="Search OmniCart" aria-label="Search OmniCart">
        <button class="search-btn" aria-label="Search">
          <img src="{{ asset('images/search_icon.png') }}" class="search-icon" alt="">
        </button>
      </div>
      </div>
    </div>

    <div class="nav-right">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->username }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <form action="{{ route('signout.post') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Sign Out</button>
              </form>
            </li>
          </ul>
        </li>
      @else
        <li class="nav-item">
          <a class="signin" href="{{ route('signin') }}">Sign In</a>
        </li>
      @endauth
      <img src="{{ asset('images/cart.png') }}" class="basket-icon" alt="Cart">
    </div>
  </div>

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


</body>

</html>
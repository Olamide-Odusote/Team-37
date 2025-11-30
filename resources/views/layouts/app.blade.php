<!DOCTYPE html>
<html lang="en">

<head>
    <link rel=preconnect href="https://fonts.googleapis.com">
    <link rel=preconnect href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}">
    <!-- bootstrap css -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
    <!-- NAVIGATION BAR -->
    <nav class="navbar">
        <div class="nav-left">
            <img src="{{ asset('images/OmniCart_Logo.png') }}" class="logo">
        </div>

        <div class="nav-center">
            <div class="search-container">
                <select class="category-select">
                    <option value="all">V</option>
                </select>
                <input type="text" class="search-input" placeholder="Search OmniCart">
                <button class="search-btn">
                    <img src="{{ asset('images/search_icon.png') }}" class="search-icon">
                </button>
            </div>
        </div>

        <div class="nav-right">
            @auth
                <!--User is logged in, show their username-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->username }} <!--Show username -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <!-- Logout form -->
                            <form action="{{ route('signout.post') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <!-- User is not logged in, show Sign In Link -->
                <li class="nav-item">
                    <a class="signin" href="{{ route('signin') }}">Sign In</a>
                </li>
            @endauth
            <img src="{{ asset('images/cart.png') }}" class="basket-icon">
        </div>
    </nav>

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
@extends('layouts.app')

@section('title', 'Checkout Success')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="signInText">Checkout Successful</div>

    <div class="success-message">
        Thank you for your purchase! Your order has been successfully processed.
    </div>

    <a href="{{ route('home') }}" class="continue-shopping-link">Continue Shopping</a> 
</div>
@endsection
            placeholder="Re-enter new password"
            required
        >

        <button type="submit" class="signInButton">Reset Password</button>
    </form>
</div>
@endsection
            <a href="{{ route('signin') }}" class="signInLink">Sign In</a>
        </div>
      @endauth
      <div class="nav-item">
        <a href="{{ route('cart') }}">
          <img src="{{ asset('images/cart_icon.png') }}" class="cart-icon" alt="Shopping cart icon">
        </a>
      </div>
    </div>
  </div>
/* BOTTOM NAV LINKS */
  <div class="nav-bottom">
    <ul class="nav-links">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('shop') }}">Shop</a></li>
      <li><a href="{{ route('deals') }}">Deals</a></li>
      <li><a href="{{ route('contact') }}">Contact Us</a></li>
    </ul>
    </div>
</nav>    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Help Center</a>
        </div>
        <p class="copyright">
            © 2024– , OmniCart.Co.Uk
        </p>
    </footer>
</body>
</html>

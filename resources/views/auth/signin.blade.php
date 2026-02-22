@extends('layouts.auth')

@section('title', 'Sign In')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

<!-- SIGN IN FORM -->

@section('content')
<div class="login">
    <div class="signInText">Sign in to your account</div>

    @include('components.errors')

    <form method="POST" action="{{ route('signin.post') }}">
        @csrf
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="signInButton" type="submit">Sign In</button>
    </form>
    
     <!-- Link to Password Reset -->

    <p class="forgotPassword">
        Forgot your password?
        <a href="{{ route('password.reset') }}">Click here ></a>
    </p>
    <!-- Link to Registration -->
    
    <p class="newToOmni">New to Omni?</p>
    <a href="{{ route('register') }}"><button class="registerInButton">Create account</button></a>

    <hr style="margin:20px 0;border:none;border-top:1px solid #ddd;">
    <p style="text-align:center;margin:0;font-size:13px;">
        <a href="{{ route('admin.signin') }}" style="color:#0055c0;text-decoration:none;font-weight:600;">Admin Sign In →</a>
    </p>
</div>
@endsection

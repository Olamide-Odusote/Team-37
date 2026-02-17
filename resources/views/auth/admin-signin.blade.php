@extends('layouts.auth')

@section('title', 'Admin Sign In')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="signInText">Admin Sign In</div>

    @include('components.errors')

    <form method="POST" action="{{ route('signin.post') }}">
        @csrf
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="signInButton" type="submit">Sign In</button>
    </form>
    
    <p class="forgotPassword">
        Forgot your password?
        <a href="{{ route('password.reset') }}">Click here ></a>
    </p>

    <p class="newToOmni">New Admin?</p>
    <a href="{{ route('admin.register') }}"><button class="registerInButton">Register as Admin</button></a>

    <hr style="margin:20px 0;border:none;border-top:1px solid #ddd;">
    <p style="text-align:center;margin:0;">
        <a href="{{ route('auth.login') }}" style="color:#0055c0;text-decoration:none;font-weight:600;">← Back to Login Options</a>
    </p>
</div>
@endsection

@extends('layouts.auth')

@section('title', 'Admin Registration')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="signInText">Admin Registration</div>

    @include('components.errors')

    <form method="POST" action="{{ route('admin.register.post') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button class="signInButton" type="submit">Register</button>
    </form>

    <p class="newToOmni">Already have an admin account?</p>
    <a href="{{ route('admin.signin') }}"><button class="registerInButton">Sign In as Admin</button></a>

    <hr style="margin:20px 0;border:none;border-top:1px solid #ddd;">
    <p style="text-align:center;margin:0;">
        <a href="{{ route('auth.login') }}" style="color:#0055c0;text-decoration:none;font-weight:600;">← Back to Login Options</a>
    </p>
</div>
@endsection
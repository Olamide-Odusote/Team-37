@extends('layouts.auth')

@section('title', 'Sign In')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

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

    <p class="forgotPassword">
        Forgot your password?
        <a href="{{ route('password.reset') }}">Click here ></a>
    </p>

    <p class="newToOmni">New to Omni?</p>
    <a href="{{ route('register') }}"><button class="registerInButton">Create account</button></a>
</div>
@endsection

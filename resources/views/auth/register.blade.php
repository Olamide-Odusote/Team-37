@extends('layouts.auth')

@section('title', 'Create Account')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

/* REGISTRATION FORM */
@section('content')
<div class="login">
    <div class="signInText">Create Account</div>

    @include('components.errors')

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <input type="text" name="name" placeholder="Your name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Re-enter Password" required>

        <button class="signInButton" type="submit">Continue</button>
    </form>
    /* Link to Sign In */
    <p class="forgotPassword">
        Already have an account?
        <a href="{{ route('signin') }}">Sign in ></a>
    </p>
</div>
@endsection

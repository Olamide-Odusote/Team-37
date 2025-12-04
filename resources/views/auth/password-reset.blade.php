@extends('layouts.auth')

@section('title', 'Reset Password')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
@endsection

@section('content')
/* PASSWORD RESET FORM */

<div class="login">
    <div class="signInText">Change Password</div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGES --}}
    @if($errors->any())
        <div class="alert error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.reset.submit') }}" method="POST" class="input">
        @csrf

        <div class="text">Email Address</div>
        <input 
            type="email" 
            name="email"
            class="inputbox"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            required
        >

        /* New Password Fields */
        <div class="text">New Password</div>
        <input 
            type="password" 
            name="password"
            class="inputbox"
            placeholder="Enter new password"
            required
        >
        /* Confirm New Password Field */
        <div class="text">Re-enter Password</div>
        <input 
            type="password" 
            name="password_confirmation"
            class="inputbox"
            placeholder="Confirm new password"
            required
        >

        <button type="submit" class="continue">Continue</button>
    </form>
    /* Link to Sign In */
    <p class="already">
        Already have an account? 
        <a href="{{ route('signin') }}">Sign in ></a>
    </p>
</div>

@endsection

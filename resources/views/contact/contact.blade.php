@extends('layouts.app')

@section('content')

<div class="header">

    <div class="header-left">
        <img src="{{ asset('images/OC-logo.png') }}" class="logo" alt="OmniCart Logo">
    </div>

    <div class="header-center">
        <input type="text" placeholder="Search OmniCart" class="search-box">
        <button class="search-btn">GO</button>
    </div>

    <div class="header-right">
        <button class="sign-in-btn">Sign In</button>
    </div>

</div>

<div class="contact-form-container">
    <h1>Contact Us</h1>
    <p>Any queries? Just leave us a message and we’ll respond to you as soon as possible.</p>

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-input" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-input" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" class="form-input" required></textarea>

        <button type="submit" class="submit-button">Submit</button>
    </form>
</div>

@endsection
<!-- temp change -->
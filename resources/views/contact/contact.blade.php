@extends('layouts.app')

@section('title', 'Contact Us')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<div class="contact-form-container">
    <h1>Contact Us</h1>
    <p>Any queries? Just leave us a message and we'll respond to you as soon as possible.</p>

    @if ($errors->any())
        <div class="error-alert">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        @error('name')
            <span style="color:#721c24;font-size:0.875rem;">{{ $message }}</span>
        @enderror

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        @error('email')
            <span style="color:#721c24;font-size:0.875rem;">{{ $message }}</span>
        @enderror

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" class="form-input @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
        @error('message')
            <span style="color:#721c24;font-size:0.875rem;">{{ $message }}</span>
        @enderror

        <button type="submit" class="submit-button">Submit</button>
    </form>

<div class="contact-social">
    <h3>Follow OmniCart</h3>
    <div class="social-links">
        <a class="social-btn" href="https://www.instagram.com/omnicart37/" target="_blank" rel="noopener noreferrer" aria-label="OmniCart on Instagram">
            <img src="{{ asset('images1/social/instagram.svg') }}" alt="Instagram">
        </a>

        <a class="social-btn" href="https://x.com/OmniCart37" target="_blank" rel="noopener noreferrer" aria-label="OmniCart on X">
            <img src="{{ asset('images1/social/x.svg') }}" alt="X">
        </a>
    </div>
</div>

</div>
@endsection
@extends('layouts.auth')

@section('title', 'Sign In - OmniCart')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
<style>
.auth-hub {
    max-width: 600px;
    margin: 60px auto;
    padding: 0 20px;
}

.auth-title {
    text-align: center;
    font-size: 28px;
    color: #0055c0;
    margin-bottom: 40px;
    font-weight: 700;
}

.auth-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.auth-card {
    background: #fff;
    border: 2px solid #0055c0;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    text-decoration: none;
    transition: all 160ms ease;
}

.auth-card:hover {
    background: #0055c0;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 85, 192, 0.3);
}

.auth-card h3 {
    margin: 0 0 12px 0;
    font-size: 18px;
}

.auth-card p {
    margin: 0;
    font-size: 13px;
    opacity: 0.8;
}

.auth-card-icon {
    font-size: 32px;
    margin-bottom: 12px;
}

.auth-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 30px 0;
    color: #999;
}

.auth-divider::before,
.auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #ddd;
}

.already-account {
    text-align: center;
    color: #666;
    font-size: 14px;
}

.already-account a {
    color: #0055c0;
    text-decoration: none;
    font-weight: 600;
}

@media (max-width: 640px) {
    .auth-options {
        grid-template-columns: 1fr;
    }
    
    .auth-title {
        font-size: 22px;
        margin-bottom: 30px;
    }
}
</style>
@endsection

@section('content')
<div class="auth-hub">
    <h1 class="auth-title">Welcome to OmniCart</h1>

    <div class="auth-options">
        <!-- Customer Sign In -->
        <a href="{{ route('signin') }}" class="auth-card">
            <div class="auth-card-icon">👤</div>
            <h3>Customer Sign In</h3>
            <p>Sign in to your shopping account</p>
        </a>

        <!-- Admin Sign In -->
        <a href="{{ route('admin.signin') }}" class="auth-card">
            <div class="auth-card-icon">⚙️</div>
            <h3>Admin Sign In</h3>
            <p>Sign in to admin dashboard</p>
        </a>
    </div>

    <div class="auth-divider">Or</div>

    <!-- Create Account -->
    <div style="text-align:center;">
        <p style="margin-bottom:16px;color:#666;font-size:15px;">New to OmniCart?</p>
        <a href="{{ route('register') }}" style="display:inline-block;padding:12px 30px;background:#0055c0;color:#fff;text-decoration:none;border-radius:20px;font-weight:600;margin-bottom:12px;">Create Customer Account</a>
        <p style="margin:16px 0 0 0;color:#666;font-size:13px;">or <a href="{{ route('admin.register') }}" style="color:#0055c0;text-decoration:none;font-weight:600;">register as admin</a></p>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Admin Account Settings')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('content')

<div class="account-container">
    <div class="account-card">

        <h2 class="account-title">Admin Account Settings</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="account-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="account-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Change Password --}}
        <div class="account-section">
            <h3>Change Password</h3>

            <form method="POST" action="{{ route('admin.change-password') }}">
                @csrf
                @method('PUT')

                <div class="account-grid">

                    <div class="form-group">
                        <label>Current Password *</label>
                        <input type="password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label>New Password *</label>
                        <input type="password" name="new_password" required>
                    </div>

                </div>

                <div class="form-group">
                    <label>Confirm New Password *</label>
                    <input type="password" name="new_password_confirmation" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-action">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
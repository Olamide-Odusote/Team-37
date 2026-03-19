@extends('layouts.app')

@section('title', 'Account Settings')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('content')

<div class="account-container">
    <div class="account-card">

        <h2 class="account-title">Account Settings</h2>

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

        {{-- Personal Details --}}
        <div class="account-section">
            <h3>Personal Details</h3>

            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                @method('PUT')

                <div class="account-grid">

                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="Name"
                               value="{{ old('Name', $customer->Name ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="Email"
                               value="{{ old('Email', $customer->Email ?? '') }}">
                    </div>

                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="Mobile_Number"
                           value="{{ old('Mobile Number', $customer->{'Mobile Number'} ?? '') }}">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-action">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="account-section">
            <h3>Change Password</h3>

            <form method="POST" action="{{ route('account.change-password') }}">
                @csrf
                @method('PUT')
                <div class="account-grid">

                    <div class="form-group">
                        <label>Current Password *</label>
                        <input type="password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label>New Password *</label>
                        <input type="password" name="new_password">
                    </div>

                </div>

                <div class="form-group">
                    <label>Confirm New Password *</label>
                    <input type="password" name="new_password_confirmation">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-action">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        {{-- Deactivate Account --}}
        <div class="account-section account-danger">
            <h3>Deactivate Account</h3>

            <p class="danger-text">
                Deactivating your account will disable access. 
                You can contact support to reactivate it.
            </p>

            <form method="POST" action="{{ route('account.delete') }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-danger">
                    Deactivate Account
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
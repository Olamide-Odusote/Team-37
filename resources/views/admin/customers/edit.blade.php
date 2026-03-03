@extends('layouts.app')

@section('title', 'Admin - Edit Customer')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-customers.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Edit Customer</h2>

    <form method="POST" action="{{ route('admin.customers.update', $customer->Customer_ID) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="Name" value="{{ old('Name', $customer->Name) }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="Email" value="{{ old('Email', $customer->Email) }}" required>
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" name="Mobile_Number" value="{{ old('Mobile Number', $customer->Mobile_Number) }}" required>
        </div>

        <button type="submit" class="btn-action">Update Customer</button>
    </form>
</div>
@endsection
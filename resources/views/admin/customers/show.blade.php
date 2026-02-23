@extends('layouts.app')

@section('title', 'Admin - Customer Details')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-customers.css') }}">
@endsection

@section('content')

<div class="admin-container">

    <h1>Customer Details</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <h2>Customer Information</h2>

        <div class="info-grid">
            <div><strong>Name:</strong> {{ $customer->Name }}</div>
            <div><strong>Email:</strong> {{ $customer->Email }}</div>
            <div><strong>Mobile Number:</strong> {{ $customer->{'Mobile Number'} }}</div>
            <div><strong>Registered At:</strong> {{ $customer->created_at->format('d M Y, H:i') }}</div>
        </div>
    </div>

    <a href="{{ route('admin.customers.index') }}" class="btn-action">← Back to Customers</a>
</div>

@endsection
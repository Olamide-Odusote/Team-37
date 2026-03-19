@extends('layouts.app')

@section('title', 'Order History')

@section('content')
<link rel="stylesheet" href="{{ asset('css/customer-orders.css') }}">

<div class="orders-container">
    <div class="orders-header">
        <h1>Order History</h1>
        <div class="orders-header-controls">
            <div class="orders-search">
                <input type="text" placeholder="Search orders by ID or date...">
            </div>
            <a href="{{ route('home') }}" class="btn-back-to-shop">← Back to Shop</a>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="empty-state">
            <p><strong>No orders found.</strong></p>
            <p>You haven't placed any orders yet. Start shopping to see your order history here.</p>
            <a href="{{ route('products.index') }}">Browse Products</a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-card-header">
                        <div>
                            <div class="order-card-number">Order <span>#</span>{{ $order->FinalOrder_ID ?? $order->id }}</div>
                        </div>
                        <div class="order-card-header-right">
                            <div class="order-card-detail">
                                <span class="order-card-detail-label">Total</span>
                                <span class="order-card-detail-value">£{{ number_format($order->Total_Price ?? 0, 2) }}</span>
                            </div>
                            <div class="order-card-detail">
                                <span class="order-card-detail-label">Status</span>
                                <span class="status-badge {{ strtolower($order->Status ?? 'pending') }}">
                                    {{ ucfirst($order->Status ?? 'pending') }}
                                </span>
                            </div>
                            <div class="order-card-detail">
                                <span class="order-card-detail-label">Placed</span>
                                <span class="order-card-date">{{ $order->OrderDate ? \Carbon\Carbon::parse($order->OrderDate)->format('d M Y') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="order-card-body">
                        <span class="order-card-detail-label">View order details and items →</span>
                        <a href="{{ route('orders.show', $order->FinalOrder_ID ?? $order->id) }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

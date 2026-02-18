@extends('layouts.app')

@section('title', 'Admin - Order Details')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-orders.css') }}">
@endsection

@section('content')

<div class="admin-container">

    <h1>Order Details</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Order Info -->
    <div class="admin-card">
        <h2>Order Information</h2>

        <div class="info-grid">
            <div><strong>Order ID:</strong> {{ $order->FinalOrder_ID }}</div>
            <div><strong>Customer:</strong> {{ $order->customer->Name }}</div>
            <div><strong>Total:</strong> £{{ number_format($order->Total_Price, 2) }}</div>
            <div>
                <strong>Status:</strong>
                <span class="status-badge 
                    @if($order->Status == 'pending') status-pending
                    @elseif($order->Status == 'shipped') status-shipped
                    @elseif($order->Status == 'delivered') status-delivered
                    @elseif($order->Status == 'returned') status-returned
                    @endif">
                    {{ ucfirst($order->Status) }}
                </span>
            </div>
            <div><strong>Created:</strong> {{ $order->created_at->format('d M Y, H:i') }}</div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="admin-card">
        <h2>Order Items</h2>

        <div class="table-wrapper">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->Name }}</td>
                            <td>{{ $item->Quantity }}</td>
                            <td>£{{ number_format($item->product->Price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update Status -->
    <div class="admin-card">
        <h2>Update Status</h2>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
            @csrf

            <div class="form-group">
                <select name="status" class="form-select">
                    <option value="pending" {{ $order->Status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipped" {{ $order->Status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->Status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="returned" {{ $order->Status == 'returned' ? 'selected' : '' }}>Returned</option>
                </select>
            </div>

            <button type="submit" class="btn-action">
                Update Status
            </button>
        </form>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn-action">
        ← Back to Orders
    </a>

</div>

@endsection

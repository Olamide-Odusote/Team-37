@extends('layouts.app')

@section('title', 'Admin - Orders Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-orders.css') }}">
@endsection

@section('content')

<div class="admin-container">
    <div class='orders-header'>
            <h1>Orders</h1>
            <div class="admin-buttons">
                <a href="{{ route('admin.inventory.index') }}" class="btn-action">
                    ← Back to Inventory
                </a>
            </div>
        </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <div class="table-wrapper">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->FinalOrder_ID }}</td>
                    <td>{{ $order->customer->Name }}</td>
                    <td>£{{ number_format($order->Total_Price, 2) }}</td>
                    
                    <td>
                        <span class="status-badge 
                        @if($order->Status == 'pending') status-pending
                        @elseif($order->Status == 'shipped') status-shipped
                        @elseif($order->Status == 'delivered') status-delivered
                        @elseif($order->Status == 'returned') status-returned
                        @endif">
                        {{ ucfirst($order->Status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                
                <td class="actions-cell">
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn-action">
                        View Details
                    </a>
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection


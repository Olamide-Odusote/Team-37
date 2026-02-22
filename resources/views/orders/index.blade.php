@extends('layouts.app')

@section('title', 'Order History')

@section('content')
<div class="container">
    <h1>Order History</h1>

    @if($orders->isEmpty())
        <p>No orders found. <a href="{{ route('products.index') }}">Shop now</a>.</p>
    @else
        @foreach($orders as $order)
            <div class="order-card" style="border:1px solid #ddd;padding:12px;border-radius:6px;margin-bottom:10px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <strong>Order #</strong> {{ $order->FinalOrder_ID ?? $order->id }}
                        <div style="font-size:13px;color:#666">Placed: {{ $order->OrderDate ?? $order->created_at }}</div>
                    </div>
                    <div>
                        <div><strong>Total:</strong> £{{ number_format($order->Total_Price ?? 0, 2) }}</div>
                        <div style="margin-top:6px">Status: {{ ucfirst($order->Status ?? 'n/a') }}</div>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <a href="{{ route('orders.show', $order->FinalOrder_ID ?? $order->id) }}">View details</a>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection

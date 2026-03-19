@extends('layouts.app')

@section('title', 'Checkout Success')

@section('content')
<div class="container" style="padding:40px 0;">
  <div class="checkout-success" style="max-width:720px;margin:0 auto;text-align:center;">
    <h1 style="font-size:28px;margin-bottom:12px;">✓ Payment Successful</h1>
    <p style="color:#555;margin-bottom:18px;">Thank you for your purchase! (Demo — no charge)</p>
    
    @if($order)
      <div style="background:#f0f8ff;padding:20px;border-radius:8px;margin-bottom:24px;text-align:left;">
        <p><strong>Order #:</strong> {{ $order->FinalOrder_ID }}</p>
        <p><strong>Date:</strong> {{ $order->OrderDate }}</p>
        <p><strong>Total:</strong> £{{ number_format($order->Total_Price, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->Status) }}</p>
      </div>
      <p style="color:#666;margin-bottom:24px;">Your order has been received and will be processed shortly. A confirmation email has been sent.</p>
    @else
      <p style="color:#666;margin-bottom:24px;">Your order has been received and will be processed shortly. A confirmation email would normally be sent.</p>
    @endif
    
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="{{ route('home') }}" style="display:inline-block;padding:12px 28px;border-radius:30px;border:2px solid #0055c0;color:#0055c0;text-decoration:none;font-weight:600;">Continue Shopping</a>
      <a href="{{ route('orders.index') }}" style="display:inline-block;padding:12px 28px;border-radius:30px;background:#0055c0;color:#fff;text-decoration:none;font-weight:600;">View My Orders</a>
      <a href="{{ route('account.index') }}" style="display:inline-block;padding:12px 28px;border-radius:30px;border:2px solid #666;color:#666;text-decoration:none;font-weight:600;">My Account</a>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Checkout Success')

@section('content')
<div class="container" style="padding:40px 0;">
  <div class="checkout-success" style="max-width:720px;margin:0 auto;text-align:center;">
    <h1 style="font-size:28px;margin-bottom:12px;">Payment Successful</h1>
    <p style="color:#555;margin-bottom:18px;">Thank you for your purchase! (Demo — no charge)</p>
    <p style="color:#666;margin-bottom:24px;">Your order has been received and will be processed shortly. A confirmation email would normally be sent.</p>
    <div style="display:flex;gap:12px;justify-content:center;">
      <a href="{{ route('home') }}" style="display:inline-block;padding:12px 28px;border-radius:30px;border:2px solid #0055c0;color:#0055c0;text-decoration:none;font-weight:600;">Continue Shopping</a>
      <a href="{{ url('/account') }}" style="display:inline-block;padding:12px 28px;border-radius:30px;background:#0055c0;color:#fff;text-decoration:none;font-weight:600;">View Account</a>
    </div>
  </div>
</div>
@endsection

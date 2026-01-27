<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
    <title>Order History</title>
</head>

<body>

<header>
    <!-- Insert navbar here -->
    @include('layouts.navbar') {{-- Assuming you have a navbar layout --}}
</header>

<div class="wrapper">
    <h1>Order History</h1>

    @foreach ($orders as $order)
    <!-- 
    Order boxes contain information about each order 
    The code loops through the Order table and creates a new order box for each order 
    -->
    <div class="order-box">
        <div class="order-box-header">
            <div class="orderno">
                <span>Order {{ $order->Order_ID }}</span>
            </div>
            <div class="status">
                <span>Status</span>
                <br/>

                <!-- Check the status of the delivery to determine the color of the text -->
                @switch($order->Status)
                    @case('shipped')
                        <span style="color:#0055C0">{{ ucfirst($order->Status) }}</span>
                        @break
                    @case('pending')
                        <span style="color:#FFB300">{{ ucfirst($order->Status) }}</span>
                        @break
                    @case('returned')
                        <span style="color:red">{{ ucfirst($order->Status) }}</span>
                        @break
                    @default
                        <span>{{ ucfirst($order->Status) }}</span>
                @endswitch
            </div>
            <div class="date">
                <span>Order Placed</span>
                <br/>
                <span>{{ $order->Date }}</span>
            </div>
            <div class="total">
                <span>Total</span>
                <br/>
                <span>£{{ $order->Total_Price }}</span>
            </div>
        </div>

        <div class="order-box-main">
           @foreach ($order->items as $item)
                
                @if($item->product)
                    <img src="{{ $item->product->Image_URL }}" alt="Product Image">
                @endif
            @endforeach
        </div>

    </div>
    <br/>
    @endforeach
</div>
</body>
</html>

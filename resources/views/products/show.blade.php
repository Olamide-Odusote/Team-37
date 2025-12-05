@extends('layouts.app')

@section('content')

<div class="product-page">

    {{-- LEFT — ZOOM IMAGE --}}
    <div class="product-image">
        <img src="{{ asset($product->Image_URL) }}">
    </div>

    {{-- MIDDLE — INFO --}}
    <div class="product-details">
        <h2>{{ $product->Name }}</h2>
        <p>{{ $product->Description }}</p>

        <hr>
        <p><strong>Category:</strong> {{ $product->category->Name }}</p>
        <p><strong>Price:</strong> £{{ number_format($product->Price, 2) }}</p>
    </div>

    {{-- RIGHT — BUY BOX --}}
    <div class="buy-box">
        <p class="price">£{{ number_format($product->Price, 2) }}</p>
        <p>FREE Returns</p>
        <p>FAST Delivery Available</p>
        <p>In Stock</p>

        <form action="{{ route('basket.add', $product->id) }}" method="POST">
            @csrf

            <label>Quantity:</label>
            <select name="qty">
                @for ($i=1; $i<=10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <button type="submit" class="btn-add">Add to Basket</button>
        </form>
    </div>

</div>
@endsection

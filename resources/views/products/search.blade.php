@extends('layouts.app')

@section('title', 'Search Results')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<div class="products-page">

    {{-- LEFT FILTERS --}}
    @include('partials.filters')

    {{-- RIGHT: Search results --}}
    <section class="product-results">
        <h2>Search Results @if(request()->has('query')): "{{ request()->query('query') }}"@endif</h2>

        @if(empty($products) || $products->isEmpty())
            <p>No products found. Try a different search term.</p>
        @else
            @foreach($products as $product)
                <div class="product-row">

                    <div class="product-image">
                        <a href="{{ route('products.show', $product->Product_ID) }}">
                            <img src="{{ asset('images/products/' . $product->Image_URL) }}" alt="{{ $product->Name }}">
                        </a>
                    </div>

                    <div class="product-details">
                        <h3><a href="{{ route('products.show', $product->Product_ID) }}">{{ $product->Name }}</a></h3>

                        <p class="desc">{{ Str::limit($product->Description ?? '', 85) }}</p>

                        <p class="price">£{{ number_format($product->Price, 2) }}</p>

                        @php $available = $product->inventory ? (int)$product->inventory->Quantity : 0; @endphp
                        <div class="meta-row">
                            <a class="view-btn" href="{{ route('products.show', $product->Product_ID) }}">View product</a>
                            <form action="{{ route('basket.add', $product->Product_ID) }}" method="POST" style="display:contents;">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="add-basket" {{ $available <= 0 ? 'disabled' : '' }}>{{ $available > 0 ? 'Add to basket' : 'Out of stock' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </section>

</div>

@endsection
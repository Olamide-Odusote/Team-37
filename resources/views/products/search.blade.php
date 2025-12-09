@extends('layouts.app')

@section('title', 'Search Results')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<div class="products-page">

    {{-- LEFT: Price filters --}}
    <aside class="filters">
        <h3>Filters</h3>

        <div class="filter-group">
            <h4>Price</h4>
            <ul>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['min' => 0, 'max' => 10]) }}" class="{{ (request()->query('min') == 0 && request()->query('max') == 10) ? 'active' : '' }}">£0 - £10</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['min' => 10, 'max' => 25]) }}" class="{{ (request()->query('min') == 10 && request()->query('max') == 25) ? 'active' : '' }}">£10 - £25</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['min' => 25, 'max' => 50]) }}" class="{{ (request()->query('min') == 25 && request()->query('max') == 50) ? 'active' : '' }}">£25 - £50</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['min' => 50, 'max' => 100]) }}" class="{{ (request()->query('min') == 50 && request()->query('max') == 100) ? 'active' : '' }}">£50 - £100</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['min' => 100, 'max' => 1000000]) }}" class="{{ (request()->query('min') == 100 && request()->query('max') == 1000000) ? 'active' : '' }}">£100+</a>
                </li>
            </ul>
        </div>
    </aside>

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

                        <div class="meta-row">
                            <a class="view-btn" href="{{ route('products.show', $product->Product_ID) }}">View product</a>
                            <form action="{{ route('basket.add', $product->Product_ID) }}" method="POST" style="display:contents;">
                                @csrf
                                <button type="submit" class="add-basket">Add to basket</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </section>

</div>

@endsection
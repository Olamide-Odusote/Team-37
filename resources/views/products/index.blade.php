@extends('layouts.app')

@section('title', 'Products')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products-page">

    @php
        $curMin = request()->query('min');
        $curMax = request()->query('max');
        $curCategory = request()->query('category');
    @endphp

    {{-- LEFT FILTERS --}}
    @include('partials.filters')


    {{-- RIGHT PRODUCT LIST --}}
    <section class="product-results">

        <h2>Results</h2>

        

        @if($products->isEmpty())
            <p>No results found.</p>
        @else
            @foreach($products as $product)
                <div class="product-row">

                    <div class="product-image">
                        <a href="{{ route('products.show', $product->Product_ID) }}">
                            <img src="{{ asset('images/products/' . $product->Image_URL) }}" 
                                 alt="{{ $product->Name }}">
                        </a>
                    </div>

                    <div class="product-details">
                        <h3><a href="{{ route('products.show', $product->Product_ID) }}">{{ $product->Name }}</a></h3>

                        <p class="desc">
                            {{ Str::limit($product->Description, 85) }}
                        </p>

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

            <div style="text-align: center;">
                {!! $products->links() !!}
            </div>
        @endif

    </section>

</div>
@endsection

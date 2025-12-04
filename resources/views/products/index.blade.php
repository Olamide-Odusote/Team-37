@extends('layouts.app')

@section('content')
<div class="products-page">

    {{-- LEFT FILTERS --}}
    <aside class="filters">
        <h3>Filters</h3>

        <form method="GET" action="{{ route('products.index') }}">
            <p><strong>Category</strong></p>
            @foreach($categories as $cat)
                <div>
                    <input 
                        type="checkbox" 
                        name="category[]" 
                        value="{{ $cat->id }}"
                        {{ in_array($cat->id, request('category', [])) ? 'checked' : '' }}>
                    {{ $cat->name }}
                </div>
            @endforeach

            <hr>

            <p><strong>Price</strong></p>
            <input type="number" name="min_price" placeholder="Min"> -
            <input type="number" name="max_price" placeholder="Max">

            <button type="submit">Apply</button>
        </form>
    </aside>


    {{-- RIGHT PRODUCTS LIST --}}
    <section class="products-list">
        <h2>{{ $title ?? 'Products' }}</h2>

        @foreach($products as $product)
            <div class="product-row">

                {{-- LEFT IMAGE --}}
                <div class="product-img">
                    <img src="{{ asset($product->Image_URL) }}">
                </div>

                {{-- CENTER DESCRIPTION --}}
                <div class="product-info">
                    <h3>
                        <a href="{{ route('products.show', $product->id) }}">
                            {{ $product->Name }}
                        </a>
                    </h3>
                    <p>{{ $product->Description }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                </div>

                {{-- RIGHT PRICE + BUTTON --}}
                <div class="product-buy">
                    <p class="price">£{{ number_format($product->Price, 2) }}</p>

                    <form method="POST" action="{{ route('basket.add', $product->id) }}">
                        @csrf
                        <button type="submit">Add to Basket</button>
                    </form>
                </div>

            </div>
        @endforeach
    </section>
</div>
@endsection

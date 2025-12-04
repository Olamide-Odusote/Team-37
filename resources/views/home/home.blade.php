@extends('layouts.app')

@section('title', 'Welcome to OmniCart')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<div class="homepage">

    {{-- CATEGORY GRID --}}
    <h2 class="section-title">Shop By Category</h2>

    <div class="category-grid">
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', ['category' => $category->ProductCategory_ID]) }}" class="category-card">
                <img src="{{ asset($category->image_url) }}" class="cat-img">
                <p class="cat-title">{{ $category->Name }}</p>
            </a>
        @endforeach
    </div>
    
</div>

@endsection

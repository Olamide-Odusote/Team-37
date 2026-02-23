@extends('layouts.app')

@section('title', 'Add Inventory Item')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-add-edit.css') }}">
@endsection

@section('content')

<div class="admin-container">
    <div class="form-card">
        <h2>Add New Product</h2>

        <form action="{{ route('admin.inventory.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf

            <div class="section">
                <h3>Product Details</h3>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->ProductCategory_ID }}">
                                    {{ $category->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" required>
                    </div>

                    <div class="form-group">
                        <label>Initial Quantity</label>
                        <input type="number" name="quantity" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Low Stock Threshold</label>
                    <input type="number" name="threshold" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin">Create Product</button>
            </div>
        </form>
    </div>
</div>

@endsection
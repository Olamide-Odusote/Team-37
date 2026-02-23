@extends('layouts.app')

@section('title', 'Edit Product')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-add-edit.css') }}">
@endsection

@section('content')

<div class="admin-container">
    <div class="form-card">
        <h2>Edit Product</h2>

        <form action="{{ route('admin.inventory.update', $inventory->Inventory_ID) }}"
              method="POST"
              enctype="multipart/form-data"
              class="inventory-form">
            @csrf
            @method('PUT')

            <div class="section">
                <h3>Product Details</h3>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', $inventory->product->Name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" required>
                            @foreach(\App\Models\ProductCategory::all() as $category)
                                <option value="{{ $category->ProductCategory_ID }}"
                                    {{ $inventory->product->ProductCategory_ID == $category->ProductCategory_ID ? 'selected' : '' }}>
                                    {{ $category->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" required>
                        {{ old('description', $inventory->product->Description) }}
                    </textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price"
                               value="{{ old('price', $inventory->product->Price) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        @if($inventory->product->Image_URL)
                        <p>{{ $inventory->product->Image_URL }}</p>
                        <img src="{{ asset('storage/' . $inventory->product->Image_URL) }}" width="120">
                        @endif
                        <input type="file" name="image">
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>Inventory Details</h3>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity"
                               value="{{ old('quantity', $inventory->Quantity) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Low Stock Threshold</label>
                        <input type="number" name="threshold"
                               value="{{ old('threshold', $inventory->Threshold) }}" required>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin">Update Product</button>
            </div>
        </form>
    </div>
</div>

@endsection
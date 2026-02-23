@extends('layouts.app')

@section('title', 'Admin - Inventory Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection

@section('content')

<div class="admin-container">

    <!-- Low Stock Warnings -->
    @if($lowStockItems->count() > 0)
        @foreach($lowStockItems as $item)
        <div class="stock-warning">
            <strong>Low Stock Warning:</strong> {{ $item->product->Name }}, {{ $item->Quantity }} Left. Consider Restocking
        </div>
        @endforeach
    @endif

    <!-- Inventory Management Section -->
    <div class="inventory-section">
        <div class="section-header">
            <div class='admin-actions'>
            <h2>Inventory Management</h2>
            <div class="admin-buttons">
            <form action="{{ route('admin.inventory.report') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-admin">Generate Report</button>
            </form>

                <a href="{{ route('admin.orders.index') }}" class="btn-admin">View Orders</a>

                <a href="{{ route('admin.inventory.create') }}" class="btn-admin">Add Product</a>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.inventory.index') }}" class="filter-form">

    <input type="text" 
           name="search" 
           placeholder="Search product name or description"
           value="{{ request('search') }}">

    <select name="category_id">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->ProductCategory_ID }}"
                {{ request('category_id') == $category->ProductCategory_ID ? 'selected' : '' }}>
                {{ $category->Name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn-admin">Filter</button>
</form>
        <!-- Inventory Table -->
        <div class="table-wrapper">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Stock Level</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $item)
                    <tr>
                        <td>{{ $item->product->Product_ID }}</td>
                        <td>{{ $item->product->Name }}</td>
                        <td>@if($item->product->Image_URL)
                            <img src="{{ asset('images/products/' . $item->product->Image_URL) }}" alt="{{ $item->product->Name }}" class="product-image">
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            <span class="stock-badge 
                            @if($item->Quantity == 0) out
                            @elseif($item->Quantity <= $item->Threshold) low
                            @else normal
                            @endif">
                            {{ $item->Quantity }}
                            @if($item->Quantity == 0)
                            (Out of Stock)
                            @elseif($item->Quantity <= $item->Threshold)
                            (Low)
                            @endif
                        </span>
                    </td>
                    <td>{{ $item->product->category->Name ?? 'N/A' }}</td>
                    <td>£{{ number_format($item->product->Price, 2) }}</td>
                    <td class="actions-cell">
                        @if($item->Quantity <= $item->Threshold)
                        <button class="btn-action btn-restock" onclick="openRestockModal({{ $item->Inventory_ID }}, '{{ $item->product->Name }}')">Restock</button>
                        @else
                        <a href="{{ route('admin.inventory.edit', $item->Inventory_ID) }}" class="btn-action btn-edit">Edit</a>
                        @endif
                        <form action="{{ route('admin.inventory.delete', $item->Inventory_ID) }}" method="POST" style="display:inline;" onsubmit="return confirm('This will permanently delete the product and all inventory logs');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Restock Modal -->
<div id="restockModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeRestockModal()">&times;</span>
        <h3>Restock Product</h3>
        <form id="restockForm" method="POST">
            @csrf
            <label for="quantity">Quantity to Add:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
            <button type="submit" class="btn-primary">Confirm Restock</button>
            <button type="button" class="btn-secondary" onclick="closeRestockModal()">Cancel</button>
        </form>
    </div>
</div>

<script>
function openRestockModal(inventoryId, productName) {
    const modal = document.getElementById('restockModal');
    const form = document.getElementById('restockForm');
    form.action = `/admin/inventory/${inventoryId}/restock`;
    document.querySelector('.modal-content h3').textContent = `Restock: ${productName}`;
    modal.style.display = 'block';
}

function closeRestockModal() {
    document.getElementById('restockModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('restockModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

@endsection
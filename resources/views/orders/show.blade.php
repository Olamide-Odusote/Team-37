@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<link rel="stylesheet" href="{{ asset('css/customer-orders.css') }}">

<div class="order-details-container">
    <h1 style="font-size:32px;color:#333;margin-bottom:24px;font-weight:700;">Order #{{ $order->FinalOrder_ID ?? $order->id }}</h1>

    <!-- Order Information Box -->
    <div class="order-info-box">
        <div class="order-info-header">Order Information</div>
        <div class="order-info-grid">
            <div class="order-info-item">
                <span class="order-info-label">Order ID</span>
                <span class="order-info-value">{{ $order->FinalOrder_ID ?? $order->id }}</span>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Order Date</span>
                <span class="order-info-value">{{ $order->OrderDate ? \Carbon\Carbon::parse($order->OrderDate)->format('d M Y, H:i') : 'N/A' }}</span>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Status</span>
                <div>
                    <span class="status-badge {{ strtolower($order->Status ?? 'pending') }}">
                        {{ ucfirst($order->Status ?? 'pending') }}
                    </span>
                </div>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Total Amount</span>
                <span class="order-info-value" style="color:#0055C0;">£{{ number_format($order->Total_Price ?? 0, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Order Items Section -->
    <div class="order-items-section">
        <div class="order-items-title">Order Items</div>
        
        @if($order->items && $order->items->count() > 0)
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align:center;">Unit Price</th>
                        <th style="text-align:center;">Quantity</th>
                        <th style="text-align:center;">Subtotal</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        @php 
                            $p = $item->product;
                            $return = $item->return;
                        @endphp
                        <tr>
                            <td>
                                @if($p)
                                    <a href="{{ route('products.show', $p->Product_ID) }}" class="product-name">{{ $p->Name }}</a>
                                @else 
                                    <span>N/A</span>
                                @endif
                            </td>
                            <td style="text-align:center;">£{{ number_format($item->Unit_Price ?? ($p->Price ?? 0), 2) }}</td>
                            <td style="text-align:center;">{{ $item->Quantity }}</td>
                            <td style="text-align:center;"><strong>£{{ number_format(($item->Unit_Price ?? ($p->Price ?? 0)) * $item->Quantity, 2) }}</strong></td>
                            <td style="text-align:center;">
                                <div class="item-action">
                                    @if($return)
                                        <span class="return-status">Return {{ ucfirst($return->Status ?? 'pending') }}</span>
                                    @else
                                        <button class="btn-request-return" onclick="openReturnModal({{ $item->OrderItem_ID }}, '{{ $p->Name ?? 'Product' }}')">Request Return</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#999;padding:20px;text-align:center;">No items in this order.</p>
        @endif
    </div>

    <a href="{{ route('orders.index') }}" class="btn-back">← Back to Order History</a>


<!-- Return Request Modal -->
<div id="returnModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">Request Return</div>
        <div class="modal-product-name" id="modalProductName"></div>
        
        <form method="POST" id="returnForm">
            @csrf
            <div class="modal-form-group">
                <label for="reason">Reason for return:</label>
                <textarea 
                    id="reason"
                    name="reason" 
                    required 
                    placeholder="Please explain why you want to return this item...
                    
Examples:
• Defective or broken
• Not as described
• Wrong item received
• Changed mind
• Better price elsewhere"></textarea>
            </div>
            
            <div class="modal-actions">
                <button type="submit" class="btn-submit-return">Submit Return Request</button>
                <button type="button" class="btn-cancel" onclick="closeReturnModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openReturnModal(itemId, productName) {
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('returnForm').action = '{{ url("/orders") }}/' + itemId + '/return';
    document.getElementById('reason').value = '';
    document.getElementById('returnModal').classList.add('show');
}

function closeReturnModal() {
    document.getElementById('returnModal').classList.remove('show');
    document.getElementById('returnForm').reset();
}

// Handle form submission
document.getElementById('returnForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('.btn-submit-return');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
});

// Close modal when clicking outside
document.getElementById('returnModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReturnModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReturnModal();
    }
});
</script>
@endsection

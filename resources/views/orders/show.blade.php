@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <h1>Order #{{ $order->FinalOrder_ID ?? $order->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <div style="background:#f9f9f9;padding:12px;border-radius:6px;margin-bottom:12px;">
        <p><strong>Date:</strong> {{ $order->OrderDate ?? $order->created_at }}</p>
        <p><strong>Status:</strong> 
            @switch($order->Status ?? 'n/a')
                @case('pending')
                    <span style="color:#FFB300;">Pending</span>
                    @break
                @case('shipped')
                    <span style="color:#0055C0;">Shipped</span>
                    @break
                @case('delivered')
                    <span style="color:#28a745;">Delivered</span>
                    @break
                @case('returned')
                    <span style="color:#dc3545;">Returned</span>
                    @break
                @default
                    {{ ucfirst($order->Status ?? 'n/a') }}
            @endswitch
        </p>
        <p><strong>Total:</strong> £{{ number_format($order->Total_Price ?? 0, 2) }}</p>
    </div>

    <h2>Items</h2>
    <table style="width:100%;border-collapse:collapse;margin-bottom:12px;">
        <thead>
            <tr style="background:#f0f0f0;">
                <th style="text-align:left;padding:8px">Product</th>
                <th style="padding:8px">Unit Price</th>
                <th style="padding:8px">Quantity</th>
                <th style="padding:8px">Subtotal</th>
                <th style="padding:8px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                @php 
                    $p = $item->product;
                    $return = $item->return;
                @endphp
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px">@if($p)<a href="{{ route('products.show', $p->Product_ID) }}">{{ $p->Name }}</a>@else N/A @endif</td>
                    <td style="padding:8px">£{{ number_format($item->Unit_Price ?? ($p->Price ?? 0), 2) }}</td>
                    <td style="padding:8px">{{ $item->Quantity }}</td>
                    <td style="padding:8px">£{{ number_format(($item->Unit_Price ?? ($p->Price ?? 0)) * $item->Quantity, 2) }}</td>
                    <td style="padding:8px">
                        @if($return)
                            <span style="color:#666;font-size:13px;">Return: {{ ucfirst($return->Status ?? 'pending') }}</span>
                        @else
                            <button class="btn-small" onclick="openReturnModal({{ $item->OrderItem_ID }}, '{{ $p->Name ?? 'Product' }}')">Request return</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px;">
        <a href="{{ route('orders.index') }}" class="btn">Back to Orders</a>
    </div>
</div>

<!-- Return Request Modal -->
<div id="returnModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:white;padding:20px;border-radius:6px;width:90%;max-width:500px;">
        <h2>Request Return</h2>
        <p><strong id="modalProductName"></strong></p>
        <form method="POST" id="returnForm">
            @csrf
            <label><strong>Reason for return:</strong></label>
            <textarea name="reason" style="width:100%;height:100px;padding:8px;border:1px solid #ddd;border-radius:4px;margin-bottom:12px;" required placeholder="Please explain why you want to return this item..."></textarea>
            <div style="display:flex;gap:8px;">
                <button type="submit" class="btn btn-primary">Submit Return Request</button>
                <button type="button" class="btn" onclick="closeReturnModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openReturnModal(itemId, productName) {
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('returnForm').action = '{{ url("/orders") }}/' + itemId + '/return';
    document.getElementById('returnModal').style.display = 'block';
}

function closeReturnModal() {
    document.getElementById('returnModal').style.display = 'none';
}

window.onclick = function(event) {
    var modal = document.getElementById('returnModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

@endsection

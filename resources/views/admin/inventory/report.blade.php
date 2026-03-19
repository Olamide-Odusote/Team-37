@extends('layouts.app')

@section('title', 'Inventory & Orders Report')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
@endsection

@section('content')

<div class="report-container">

    <h1 class="mb-4">Inventory & Orders Report</h1>

    {{-- INVENTORY SUMMARY --}}
    <div class="report-card">
        <h3>Inventory Summary</h3>

        <p><strong>Total Products:</strong> {{ $totalProducts }}</p>
        <p><strong>Total Stock Units:</strong> {{ $totalStock }}</p>
        <p><strong>Low Stock Items:</strong> {{ $lowStockCount }}</p>
        <p><strong>Out of Stock Items:</strong> {{ $outOfStock }}</p>
        <p><strong>Low Stock Value:</strong> £{{ number_format($lowStockValue, 2) }}</p>
    </div>

    {{-- LOW STOCK TABLE --}}
    <h3 class="section-title">Low Stock Products</h3>

    @if($lowStockItems->isEmpty())
        <p>No low stock products.</p>
    @else
        <div class="report-table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Current Quantity</th>
                        <th>Threshold</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockItems as $item)
                    <tr>
                        <td>{{ $item->product->Name }}</td>
                        <td>{{ $item->Quantity }}</td>
                        <td>{{ $item->Threshold }}</td>
                        <td>£{{ number_format($item->product->Price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif


    {{-- INCOMING STOCK --}}
    <div class="report-card mt-5">
        <h3>Incoming Stock</h3>

        <p><strong>Total Restocked Units:</strong> {{ $totalRestockedUnits }}</p>
        <p><strong>Total Returned Units:</strong> {{ $totalReturnedUnits }}</p>
        <p><strong>Total Incoming Stock Value:</strong> £{{ number_format($incomingValue, 2) }}</p>
    </div>


    {{-- OUTGOING ORDERS --}}
    <div class="report-card">
        <h3>Outgoing Orders (Sales)</h3>

        <p><strong>Total Orders:</strong> {{ $totalOrders }}</p>
        <p><strong>Total Units Sold:</strong> {{ $totalUnitsSold }}</p>
        <p><strong>Total Revenue:</strong> £{{ number_format($totalRevenue, 2) }}</p>

        <h5 class="mt-3">Orders by Status</h5>
        <ul>
            @foreach($ordersByStatus as $status)
                <li>{{ $status->Status }}: {{ $status->count }}</li>
            @endforeach
        </ul>

        <h5 class="mt-3">Top Selling Products</h5>
        <div class="report-table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topSelling as $item)
                    <tr>
                        <td>{{ $item->product->Name ?? 'N/A' }}</td>
                        <td>{{ $item->total_sold }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- ADJUSTMENTS --}}
    <div class="report-card">
        <h3>Inventory Adjustments</h3>

        <p><strong>Total Adjustments:</strong> {{ $totalAdjustments }}</p>
        <p><strong>Negative Adjustments:</strong> {{ $negativeAdjustments }}</p>
        <p><strong>Positive Adjustments:</strong> {{ $positiveAdjustments }}</p>

        <h5 class="mt-3">Adjustments by Product</h5>
        <div class="report-table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Adjustment Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adjustmentsByProduct as $adj)
                    <tr>
                        <td>{{ $adj->product->Name }}</td>
                        <td>{{ $adj->total_adjusted }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
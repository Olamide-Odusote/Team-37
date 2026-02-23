@extends('layouts.app')

@section('title', 'Admin - Customers Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-customers.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <div class='customers-header'>
        <h1>Customers</h1>
        <div class="admin-buttons">
            <a href="{{ route('admin.inventory.index') }}" class="btn-action">
                ← Back to Inventory
            </a>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <div class="table-wrapper">
        <table class="customers-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->Customer_ID }}</td>
                    <td>{{ $customer->Name }}</td>
                    <td>{{ $customer->Email }}</td>
                    <td>{{ $customer->{'Mobile Number'} }}</td>
                    <td>
                        <a href="{{ route('admin.customers.show', $customer->Customer_ID) }}" class="btn-action">View</a>
                        <a href="{{ route('admin.customers.edit', $customer->Customer_ID) }}" class="btn-action">Edit</a>
                        <form action="{{ route('admin.customers.destroy', $customer->Customer_ID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="container" style="padding:30px 0;">
    <h2 style="margin-bottom:16px;">Account Settings</h2>

    <div class="account-accordion" style="max-width:760px;margin:0 auto;">

        <details open style="margin-bottom:12px;border-radius:8px;padding:12px;background:#f7f7f7;">
            <summary style="font-weight:600;cursor:pointer;padding:8px;">Personal Details</summary>
            <div style="padding:12px;">
                <form method="POST" action="#">
                    @csrf
                    <label>Name*</label>
                    <input type="text" name="first_name" value="{{ optional($customer)->Name ?? '' }}" class="form-control" />
                    <div style="margin-top:12px;display:flex;gap:8px;">
                        <button class="btn btn-outline-secondary" type="button">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </details>

        <details style="margin-bottom:12px;border-radius:8px;padding:12px;background:#f7f7f7;">
            <summary style="font-weight:600;cursor:pointer;padding:8px;">Sign In Details</summary>
            <div style="padding:12px;">
                <p>Change your email or password here.</p>
                <a href="#" class="btn btn-primary">Update Sign In</a>
            </div>
        </details>

        <details style="margin-bottom:12px;border-radius:8px;padding:12px;background:#f7f7f7;">
            <summary style="font-weight:600;cursor:pointer;padding:8px;">Address & Telephone</summary>
            <div style="padding:12px;">
                <p>Manage your saved addresses and contact numbers.</p>
                <a href="#" class="btn btn-primary">Manage Addresses</a>
            </div>
        </details>

        <details style="margin-bottom:12px;border-radius:8px;padding:12px;background:#f7f7f7;">
            <summary style="font-weight:600;cursor:pointer;padding:8px;">Payment Details</summary>
            <div style="padding:12px;">
                <p>Manage stored cards and payment preferences.</p>
                <a href="#" class="btn btn-primary">Manage Payments</a>
            </div>
        </details>

    </div>
</div>
@endsection

@component('mail::message')
# Order Confirmation

Hello {{ $customer->FirstName ?? 'Valued Customer' }},

Thank you for your purchase! Your order has been received and will be processed shortly.

**Order Number:** #{{ $order->FinalOrder_ID }}  
**Order Date:** {{ $order->OrderDate->format('F j, Y') }}  
**Total:** £{{ number_format($order->Total_Price, 2) }}

## Order Summary

@component('mail::table')
| Product | Qty | Unit Price | Total |
|---------|-----|------------|-------|
@foreach($order->items as $item)
| {{ $item->product->Name }} | {{ $item->Quantity }} | £{{ number_format($item->Unit_Price, 2) }} | £{{ number_format($item->Unit_Price * $item->Quantity, 2) }} |
@endforeach
@endcomponent

## Shipping Address

{{ $order->address->Street }}  
{{ $order->address->City }}, {{ $order->address->PostalCode }}  
{{ $order->address->Country }}

We'll send you a tracking number once your order ships. If you have any questions, please contact our support team.

@component('mail::button', ['url' => route('account.index')])
View Your Account
@endcomponent

Thanks,  
**The OmniCart Team**
@endcomponent

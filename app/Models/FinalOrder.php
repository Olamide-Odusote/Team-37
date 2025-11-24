<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalOrder extends Model
{
    protected $fillable = [
        'Customer_ID',
        'CustomerAddress_ID',
        'CustomerPayment_ID',
        'OrderDate',
        'Total_Price',
        'Status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class, 'Address_ID');
    }  

    public function payment()
    {
        return $this->belongsTo(CustomerPayment::class, 'Payment_ID');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'FinalOrder_ID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'FinalOrder_ID',
        'Product_ID',
        'Quantity',
        'Unit_Price',
    ];

    public function order()
    {
        return $this->belongsTo(FinalOrder::class, 'FinalOrder_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }

    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class, 'OrderItem_ID');
    }
}

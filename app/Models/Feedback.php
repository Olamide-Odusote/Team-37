<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'Customer_ID',
        'Product_ID',
        'Comments',
        'Rating',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'Customer_ID',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'basket_products', 'Basket_ID', 'Product_ID')
                    ->withPivot('Quantity')
                    ->withTimestamps();
    }
}

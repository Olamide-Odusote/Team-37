<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    protected $table = 'basket_products';

    protected $fillable = [
        'Basket_ID',
        'Product_ID',
        'Quantity',
    ];

    public function basket()
    {
        return $this->belongsTo(Basket::class, 'Basket_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
}

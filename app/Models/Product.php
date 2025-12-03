<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'Name',
        'Description',
        'ProductCategory_ID',
        'Inventory_ID',
        'Price',
        'ImageURL',

    ];

    public function BasketProduct()
    {
        return $this->hasMany(BasketProduct::class, 'Product_ID');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'ProductCategory_ID');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'Product_ID');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'Product_ID');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'Product_ID');
    }
}

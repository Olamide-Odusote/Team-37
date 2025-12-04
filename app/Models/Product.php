<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Description',
        'ProductCategory_ID',
        'Inventory_ID',
        'Price',
        'ImageURL',

    ];
    /**
     * Get the basket products for the product.
     */
    public function BasketProduct()
    {
        return $this->hasMany(BasketProduct::class, 'Product_ID');
    }
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'ProductCategory_ID');
    }
    /**
     * Get the inventory associated with the product.
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'Product_ID');
    }
    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'Product_ID');
    }
    /**
     * Get the feedbacks for the product.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'Product_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}

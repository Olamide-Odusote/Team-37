<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'basket_products';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'BasketProduct_ID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Basket_ID',
        'Product_ID',
        'Quantity',
    ];

    /**
     * Get the basket that owns the basket product.
     */
    public function basket()
    {
        return $this->belongsTo(Basket::class, 'Basket_ID');
    }
    /**
     * Get the product that owns the basket product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'Basket_ID';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'Customer_ID',
    ];
    /**
     * Get the customer that owns the basket.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }

    /**
     * The products that belong to the basket.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'basket_products', 'Basket_ID', 'Product_ID')
                    ->withPivot('Quantity')
                    ->withTimestamps();
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

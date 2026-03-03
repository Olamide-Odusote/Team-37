<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_items';
    protected $primaryKey = 'OrderItem_ID';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'FinalOrder_ID',
        'Product_ID',
        'Quantity',
        'Unit_Price',
    ];
    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo(FinalOrder::class, 'FinalOrder_ID');
    }
    /**
     * Get the product that the item refers to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
    /**
     * Get the return request associated with the order item.
     */
    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class, 'OrderItem_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}

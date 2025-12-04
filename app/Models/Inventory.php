<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Product_ID',
        'Quantity',
        'Threshold',
    ];
    /**
     * Get the product that owns the inventory.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
    /**
     * Get the inventory logs for the inventory.
     */
    public function logs()
    {
        return $this->hasMany(InventoryLog::class, 'Inventory_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'Product_ID',
        'Quantity',
        'Threshold',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }

    public function logs()
    {
        return $this->hasMany(InventoryLog::class, 'Inventory_ID');
    }
}

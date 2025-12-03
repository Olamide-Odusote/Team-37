<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = [
        'Product_ID',
        'Admin_ID',
        'Action_Type',
        'Quantity_Changed',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'Admin_ID');
    }
}

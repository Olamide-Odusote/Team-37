<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'inventory_logs';
    protected $primaryKey = 'InventoryLog_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Product_ID',
        'Admin_ID',
        'Action_Type',
        'Quantity_Changed',
    ];
    /**
     * Get the product that owns the inventory log.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
    /**
     * Get the admin that performed the action.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'Admin_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;

}

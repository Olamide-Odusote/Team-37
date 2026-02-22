<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OrderItem_ID',
        'Reason',
        'Status',
    ];
    /**
     * Get the order item that owns the return request.
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'OrderItem_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    protected $fillable = [
        'OrderItem_ID',
        'Reason',
        'Status',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'OrderItem_ID');
    }
}

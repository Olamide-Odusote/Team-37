<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'Customer_ID',
        'Street',
        'City',
        'PostalCode',
        'Country',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }
}

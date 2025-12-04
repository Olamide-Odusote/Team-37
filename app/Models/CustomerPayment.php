<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Customer_ID',
        'CardHolder_Name',
        'CardNumber',
        'ExpiryDate',
    ];
    /**
     * Get the customer that owns the payment.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}
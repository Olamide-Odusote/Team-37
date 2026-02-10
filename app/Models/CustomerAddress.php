<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'CustomerAddress_ID';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'Customer_ID',
        'Street',
        'City',
        'Post_Code',
        'Country',
    ];
    /**
     * Get the customer that owns the address.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

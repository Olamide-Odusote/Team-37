<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'Mobile_Number',
    ];

    /* Password hash for serialisation */

    protected $hidden = [
        'Password',
        'remember_token',
    ];
    /**
     * Get the addresses for the customer.
     */
    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'Customer_ID');
    }
    /**
     * Get the baskets for the customer.
     */
    public function baskets()
    {
        return $this->hasMany(Basket::class, 'Customer_ID');
    }
    /**
     * Get the orders for the customer.
     */
    public function orders()
    {
        return $this->hasMany(FinalOrder::class, 'Customer_ID');
    }
    /**
     * Get the feedbacks for the customer.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'Customer_ID');
    }
    /**
     * Get the payments for the customer.
     */
    public function payments()
    {
        return $this->hasMany(CustomerPayment::class, 'Customer_ID');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

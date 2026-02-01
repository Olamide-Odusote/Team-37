<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'Customer_ID';
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'Name',
        'Email',
        'Password',
        'Mobile Number',
    ];

    /**
     *  Get the User 
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

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
    public function basket()
    {
        return $this->hasOne(Basket::class, 'Customer_ID', 'Customer_ID');
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

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

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'Customer_ID');
    }

    public function baskets()
    {
        return $this->hasMany(Basket::class, 'Customer_ID');
    }

    public function orders()
    {
        return $this->hasMany(FinalOrder::class, 'Customer_ID');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'Customer_ID');
    }

    public function payments()
    {
        return $this->hasMany(CustomerPayment::class, 'Customer_ID');
    }
}

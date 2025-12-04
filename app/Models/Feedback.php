<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Customer_ID',
        'Product_ID',
        'Comments',
        'Rating',
    ];
    /**
     * Get the customer that owns the feedback.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }
    /**
     * Get the product that the feedback is about.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
}

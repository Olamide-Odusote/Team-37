<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'Feedback_ID';

    protected $fillable = [
        'Customer_ID',
        'Product_ID',
        'Comments',
        'Rating',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID', 'Customer_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID', 'Product_ID');
    }
}
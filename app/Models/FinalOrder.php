<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'final_orders';

    protected $primaryKey = 'FinalOrder_ID';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $casts = [
        'OrderDate' => 'date',
    ];
    
    protected $fillable = [
        'Customer_ID',
        'CustomerAddress_ID',
        'CustomerPayment_ID',
        'OrderDate',
        'Total_Price',
        'Status',
    ];
    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID');
    }
    /**
     * Get the address associated with the order.
     */
    public function address()
    {
        return $this->belongsTo(CustomerAddress::class, 'CustomerAddress_ID');
    }  
    /**
     * Get the payment associated with the order.
     */
    public function payment()
    {
        return $this->belongsTo(CustomerPayment::class, 'CustomerPayment_ID');
    }
    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'FinalOrder_ID');
    }

    /**
     * Get the return requests for the order.
    */

    public function returnRequests()
    {
        return $this->hasMany(ReturnRequest::class, 'FinalOrder_ID');
    }
    
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'FinalOrder_ID';
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

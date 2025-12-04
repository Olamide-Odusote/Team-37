<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Description',
    ];
    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'ProductCategory_ID');
    }
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'Name',
        'Description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'ProductCategory_ID');
    }
}

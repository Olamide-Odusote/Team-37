<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    protected $primaryKey = 'ProductCategory_ID';
    protected $table = 'product_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Description',
        'ImageURL',
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'ProductCategory_ID');
    }
// Enable timestamps
    public $timestamps = true;
}

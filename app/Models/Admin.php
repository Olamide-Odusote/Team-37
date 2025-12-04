<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Email',
        'Password',
    ];
    /**
     * Get the inventory logs for the admin.
     */
    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'Admin_ID');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'Name',
        'Email',
        'Password',
    ];

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'Admin_ID');
    }
}

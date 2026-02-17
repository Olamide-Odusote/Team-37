<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable 
{

    use Notifiable;
    
    protected $table = 'admins';
    protected $primaryKey = 'Admin_ID';
    
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

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'Admin_ID';
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    /**
     * Override getAuthIdentifier to use Admin_ID
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }
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

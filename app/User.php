<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    public function scopeNotUsername($query, $username)
    {
        return $query->where('username', '!=', $username);
    }
}

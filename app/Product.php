<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

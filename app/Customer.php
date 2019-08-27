<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];



    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function customerAddress()
    {
        return $this->hasMany('App\CustomerAddress');
    }

}

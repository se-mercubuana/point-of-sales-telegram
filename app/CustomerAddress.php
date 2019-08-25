<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];



    public function scopeCustomerId($query, $id)
    {
        return $query->where('customer_id', $id);
    }



    public function user()
    {
        $this->belongsTo('App\User');
    }



}

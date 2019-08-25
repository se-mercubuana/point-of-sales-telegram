<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionAddress extends Model
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

    public function scopeFullName($query, $name)
    {
        return $query->where('full_name', $name);
    }

    public function scopeAddress($query, $address)
    {
        return $query->where('address', $address);
    }

    public function scopeCity($query, $city)
    {
        return $query->where('city', $city);
    }


    public function scopeCustomerAddressId($query, $customer_address_id)
    {
        return $query->where('customer_address_id', $customer_address_id);
    }


}

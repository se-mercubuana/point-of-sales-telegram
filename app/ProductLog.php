<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopeProductId($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeModal($query, $modal)
    {
        return $query->where('modal', $modal);
    }

    public function scopePrice($query, $price)
    {
        return $query->where('price', $price);
    }


}

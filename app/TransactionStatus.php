<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopeMenungguPembayaran($query)
    {
        return $query->where('name', 'Menunggu Pembayaran');
    }


    public function scopePacking($query)
    {
        return $query->where('name', 'Packing');
    }

    public function scopeDikirim($query)
    {
        return $query->where('name', 'Dikirim');
    }


}

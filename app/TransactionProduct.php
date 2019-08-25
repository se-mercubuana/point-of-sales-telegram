<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopeTransactionNumber($query, $transactionNumber)
    {
        return $query->where('transaction_number', $transactionNumber);
    }



    public function product_log()
    {
        return $this->belongsTo(ProductLog::class);
    }

}

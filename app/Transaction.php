<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{


    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function scopeTransactionStatusId($query, $statusId)
    {
        return $query->where('transaction_status_id', $statusId);
    }


    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function transaction_address()
    {
        return $this->belongsTo(TransactionAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

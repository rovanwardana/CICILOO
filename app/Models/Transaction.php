<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_name', 'with', 'date', 'status', 'bill_id', 'amount', 'user_id'];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
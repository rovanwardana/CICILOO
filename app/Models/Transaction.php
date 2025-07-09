<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_name',
        'with', // ✅ tambahkan ini
        'date',
        'status',
        'bill_id',
        'amount',
        'user_id',
    ];
}

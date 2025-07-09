<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
    protected $fillable = [
        'date',
        'due_date',
        'bill_type',
        'customer_id',
        'bill_number',
        'split_method',
        'notes'
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function participants() {
        return $this->belongsToMany(User::class, 'bill_user');
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
    protected $fillable = [...];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function participants() {
        return $this->belongsToMany(User::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
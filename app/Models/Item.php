<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $fillable = [...];

    public function bill() {
        return $this->belongsTo(Bill::class);
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
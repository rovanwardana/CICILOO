<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['bill_id', 'name', 'qty', 'price', 'assigned_to'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'bill_participant_items', 'item_id', 'bill_user_id')
            ->withPivot('qty');
    }
}
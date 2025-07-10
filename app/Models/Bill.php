<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['date', 'due_date', 'bill_type', 'bill_number', 'customer_id', 'split_method', 'notes', 'total_amount'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'bill_user', 'bill_id', 'user_id')
            ->withPivot('id', 'amount_to_pay', 'payment_status');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'bill_id');
    }

    public function participantItems()
    {
        return $this->hasManyThrough(
            BillParticipantItem::class,
            BillUser::class,
            'bill_id', // Foreign key di bill_user yang menunjuk ke bills
            'bill_user_id', // Foreign key di bill_participant_items yang menunjuk ke bill_user
            'id', // Primary key di bills
            'id' // Primary key di bill_user
        )->with('item');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BillUser extends Pivot
{
    protected $table = 'bill_user';
    public $incrementing = true;
    protected $fillable = ['bill_id', 'user_id', 'payment_status', 'amount_to_pay'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function participantItems()
    {
        return $this->hasMany(BillParticipantItem::class, 'bill_user_id');
        // Perbaiki: gunakan hasMany, bukan hasManyThrough
    }
}
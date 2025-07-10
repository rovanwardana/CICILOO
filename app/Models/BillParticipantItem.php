<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillParticipantItem extends Model
{
    protected $table = 'bill_participant_items';
    protected $fillable = ['bill_user_id', 'item_id', 'qty'];

    public function billUser()
    {
        return $this->belongsTo(BillUser::class, 'bill_user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
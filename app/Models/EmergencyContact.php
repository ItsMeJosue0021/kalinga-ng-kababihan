<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $fillable = [
        'member_id',
        'contact_person',
        'address',
        'contact_number',
        'fb_messenger_account',
        'relationship'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class GCashDonation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'amount',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donation) {
            if (empty($donation->donation_tracking_number)) {
                $donation->donation_tracking_number = 'GDN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

}

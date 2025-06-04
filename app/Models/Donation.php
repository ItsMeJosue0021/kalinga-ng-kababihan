<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'amount',
        'reference',
        'proof',
        'year',
        'month',
        'address'
    ];
}

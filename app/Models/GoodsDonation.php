<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsDonation extends Model
{
    protected $fillable = [
        'name', 'email', 'type', 'description', 'address', 'year', 'month', 'status'
    ];
    protected $casts = [
    'type' => 'array',
];
}

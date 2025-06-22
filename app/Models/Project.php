<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'date',
        'location',
        'description',
        'image',
        'is_event',
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['text', 'project_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}

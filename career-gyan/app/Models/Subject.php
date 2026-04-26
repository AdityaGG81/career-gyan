<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = ['name', 'slug'];

    public function careers(): BelongsToMany
    {
        return $this->belongsToMany(Career::class, 'career_subjects');
    }
}

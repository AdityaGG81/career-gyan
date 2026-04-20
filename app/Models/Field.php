<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'color', 'bg_color'];

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }

    public function colleges(): HasMany
    {
        return $this->hasMany(College::class);
    }
}

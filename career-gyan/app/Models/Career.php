<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Career extends Model
{
    protected $fillable = [
        'name', 'slug', 'field_id', 'description',
        'qualification', 'stream', 'salary_range',
        'demand_level', 'roadmap', 'icon',
    ];

    protected $casts = [
        'roadmap' => 'array',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'career_subjects');
    }
}

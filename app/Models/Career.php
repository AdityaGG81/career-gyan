<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Career extends Model
{
    protected $fillable = [
        'name', 'slug', 'field_id', 'sub_domain', 'description',
        'qualification', 'stream', 'salary_range',
        'demand_level', 'roadmap', 'icon',
        'skills', 'future_scope', 'entrance_exams',
        'job_opportunities', 'related_careers', 'image', 'video_url'
    ];

    protected $casts = [
        'roadmap' => 'array',
        'skills' => 'array',
        'entrance_exams' => 'array',
        'job_opportunities' => 'array',
        'related_careers' => 'array'
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

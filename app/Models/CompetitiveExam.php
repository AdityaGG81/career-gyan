<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitiveExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'conducting_body',
        'purpose',
        'eligibility',
        'age_limit',
        'exam_pattern',
        'difficulty_level',
        'career_outcome',
        'description',
        'roadmap',
        'prep_tips',
        'icon',
    ];

    protected $casts = [
        'roadmap' => 'array',
        'prep_tips' => 'array',
    ];
}

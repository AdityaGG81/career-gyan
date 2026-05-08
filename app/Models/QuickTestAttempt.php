<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickTestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'student_name',
        'student_email',
        'answers',
        'section_scores',
        'total_score',
        'recommended_careers',
    ];

    protected $casts = [
        'answers' => 'array',
        'section_scores' => 'array',
        'recommended_careers' => 'array',
    ];
}

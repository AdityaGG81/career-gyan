<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    protected $fillable = [
        'uuid',
        'user_inputs',
        'aptitude_scores',
        'recommended_careers',
        'recommended_fields'
    ];

    protected $casts = [
        'user_inputs' => 'array',
        'aptitude_scores' => 'array',
        'recommended_careers' => 'array',
        'recommended_fields' => 'array'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonTraditionalCareer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'required_skills',
        'learning_path',
        'tools_platforms',
        'duration',
        'income_potential',
        'work_type',
        'risk_level',
        'icon',
    ];

    protected $casts = [
        'learning_path' => 'array',
    ];
}

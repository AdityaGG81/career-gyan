<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializedCourse extends Model
{
    use HasFactory;

    protected $table = 'specialized_courses';

    protected $fillable = [
        'category',
        'title',
        'slug',
        'duration',
        'level',
        'eligibility',
        'description',
        'key_skills',
        'top_colleges',
        'career_roles',
        'salary_range',
        'average_fees',
        'is_featured'
    ];

    protected $casts = [
        'key_skills' => 'array',
        'top_colleges' => 'array',
        'career_roles' => 'array',
        'is_featured' => 'boolean'
    ];

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', strtolower(trim($category)));
    }
}

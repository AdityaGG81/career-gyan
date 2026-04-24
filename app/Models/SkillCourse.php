<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'field_id',
        'category_title',
        'description',
        'tools',
        'duration',
        'difficulty',
        'salary_potential',
        'job_roles',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializedTestAttempt extends Model
{
    use HasFactory;

    protected $table = 'specialized_test_attempts';

    protected $fillable = [
        'uuid',
        'user_id',
        'category',
        'student_name',
        'student_email',
        'student_phone',
        'total_questions',
        'correct_answers',
        'score_percentage',
        'aptitude_level',
        'answers',
        'question_details',
        'recommended_courses',
    ];

    protected $casts = [
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'score_percentage' => 'float',
        'answers' => 'array',
        'question_details' => 'array',
        'recommended_courses' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', strtolower(trim($category)));
    }

    /**
     * Human-friendly Category Name.
     */
    public function getCategoryLabelAttribute(): string
    {
        return match (strtolower($this->category)) {
            'spiritual' => 'Spiritual Aptitude',
            'artistic' => 'Artistic Aptitude',
            'sports' => 'Sports Aptitude',
            'business' => 'Business Aptitude',
            default => ucfirst($this->category) . ' Aptitude',
        };
    }

    /**
     * Category Icon.
     */
    public function getCategoryIconAttribute(): string
    {
        return match (strtolower($this->category)) {
            'spiritual' => 'fa-solid fa-spa',
            'artistic' => 'fa-solid fa-palette',
            'sports' => 'fa-solid fa-medal',
            'business' => 'fa-solid fa-briefcase',
            default => 'fa-solid fa-brain',
        };
    }

    /**
     * Category Color.
     */
    public function getCategoryColorAttribute(): string
    {
        return match (strtolower($this->category)) {
            'spiritual' => '#8b5cf6',
            'artistic' => '#ec4899',
            'sports' => '#10b981',
            'business' => '#f59e0b',
            default => '#3b82f6',
        };
    }

    /**
     * Category Light Background Color.
     */
    public function getCategoryBgAttribute(): string
    {
        return match (strtolower($this->category)) {
            'spiritual' => '#f5f3ff',
            'artistic' => '#fdf2f8',
            'sports' => '#ecfdf5',
            'business' => '#fffbeb',
            default => '#eff6ff',
        };
    }
}


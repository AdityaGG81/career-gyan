<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyQuizQuestion extends Model
{
    protected $fillable = [
        'quiz_date',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'explanation',
        'category',
        'difficulty',
        'points',
        'is_active',
    ];

    protected $casts = [
        'quiz_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function attempts()
    {
        return $this->hasMany(DailyQuizAttempt::class, 'question_id');
    }

    public function getOptionTextAttribute($option)
    {
        return $this->{'option_' . $option} ?? '';
    }

    public static function todaysQuestion()
    {
        return static::whereDate('quiz_date', today())
            ->where('is_active', true)
            ->first();
    }

    public static function todaysQuestions()
    {
        return static::whereDate('quiz_date', today())
            ->where('is_active', true)
            ->get();
    }

    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty) {
            'easy'   => '#22c55e',
            'medium' => '#f59e0b',
            'hard'   => '#ef4444',
            default  => '#6b7280',
        };
    }

    public function getCategoryIconAttribute()
    {
        return match($this->category) {
            'engineering'  => 'fa-gears',
            'science'      => 'fa-flask',
            'arts'         => 'fa-palette',
            'commerce'     => 'fa-chart-line',
            'technology'   => 'fa-microchip',
            default        => 'fa-brain',
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyQuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'selected_option',
        'is_correct',
        'points_earned',
        'time_taken_seconds',
        'attempted_at',
    ];

    protected $casts = [
        'is_correct'   => 'boolean',
        'attempted_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(DailyQuizQuestion::class, 'question_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuizStat extends Model
{
    protected $fillable = [
        'user_id',
        'total_points',
        'current_streak',
        'longest_streak',
        'quizzes_taken',
        'correct_answers',
        'speed_bonuses',
        'badges',
        'last_attempt_date',
    ];

    protected $casts = [
        'badges'            => 'array',
        'last_attempt_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function forUser($userId)
    {
        return static::firstOrCreate(
            ['user_id' => $userId],
            [
                'total_points'    => 0,
                'current_streak'  => 0,
                'longest_streak'  => 0,
                'quizzes_taken'   => 0,
                'correct_answers' => 0,
                'speed_bonuses'   => 0,
                'badges'          => [],
            ]
        );
    }

    public function getAccuracyAttribute()
    {
        if ($this->quizzes_taken === 0) return 0;
        return round(($this->correct_answers / $this->quizzes_taken) * 100);
    }

    public static function allBadgeDefinitions(): array
    {
        return [
            'first_step'   => ['label' => 'First Step',    'emoji' => '🌟', 'desc' => 'Completed your first daily quiz'],
            'on_fire'      => ['label' => 'On Fire',       'emoji' => '🔥', 'desc' => '7-day streak achieved'],
            'quiz_master'  => ['label' => 'Quiz Master',   'emoji' => '🧠', 'desc' => '50 correct answers'],
            'speed_demon'  => ['label' => 'Speed Demon',   'emoji' => '⚡', 'desc' => '10 speed bonuses earned'],
            'champion'     => ['label' => 'Champion',      'emoji' => '🏆', 'desc' => 'Reached top 10 on leaderboard'],
            'diamond'      => ['label' => 'Diamond',       'emoji' => '💎', 'desc' => '30-day streak achieved'],
            'week_warrior' => ['label' => 'Week Warrior',  'emoji' => '⚔️',  'desc' => 'Completed quizzes for 7 days'],
            'centurion'    => ['label' => 'Centurion',     'emoji' => '💯', 'desc' => '100 total points earned'],
        ];
    }

    public function checkAndAwardBadges(): array
    {
        $current  = $this->badges ?? [];
        $newBadges = [];

        if ($this->quizzes_taken >= 1 && !in_array('first_step', $current)) {
            $newBadges[] = 'first_step';
        }
        if ($this->current_streak >= 7 && !in_array('on_fire', $current)) {
            $newBadges[] = 'on_fire';
        }
        if ($this->correct_answers >= 50 && !in_array('quiz_master', $current)) {
            $newBadges[] = 'quiz_master';
        }
        if ($this->speed_bonuses >= 10 && !in_array('speed_demon', $current)) {
            $newBadges[] = 'speed_demon';
        }
        if ($this->current_streak >= 30 && !in_array('diamond', $current)) {
            $newBadges[] = 'diamond';
        }
        if ($this->total_points >= 100 && !in_array('centurion', $current)) {
            $newBadges[] = 'centurion';
        }

        if (!empty($newBadges)) {
            $this->badges = array_merge($current, $newBadges);
            $this->save();
        }

        return $newBadges;
    }
}

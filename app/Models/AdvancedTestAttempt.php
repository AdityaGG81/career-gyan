<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvancedTestAttempt extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'test_type',
        'scores',
        'answers',
        'recommendations'
    ];

    protected $casts = [
        'scores' => 'array',
        'answers' => 'array',
        'recommendations' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

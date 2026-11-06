<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get candidate display name from user relation or inputs.
     */
    public function getCandidateNameAttribute(): string
    {
        if ($this->user) {
            $name = trim(($this->user->first_name ?? '') . ' ' . ($this->user->last_name ?? ''));
            return $name ?: ($this->user->name ?? 'Registered Student');
        }

        $inputs = $this->user_inputs ?? [];
        return $inputs['name'] ?? $inputs['full_name'] ?? 'Candidate #' . $this->id;
    }

    /**
     * Get candidate email from user relation or inputs.
     */
    public function getCandidateEmailAttribute(): string
    {
        return $this->user->email ?? $this->user_inputs['email'] ?? 'Not provided';
    }
}

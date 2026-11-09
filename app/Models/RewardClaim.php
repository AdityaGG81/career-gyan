<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reward_type',
        'reference_id',
        'points_awarded',
    ];

    protected function casts(): array
    {
        return [
            'points_awarded' => 'integer',
            'reference_id' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


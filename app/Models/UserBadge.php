<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tier_level',
        'points_milestone',
        'badge_name',
        'badge_slug',
        'badge_icon',
        'badge_color',
        'badge_bg',
        'badge_description',
        'unlocked_at',
    ];

    protected $casts = [
        'unlocked_at' => 'datetime',
        'tier_level' => 'integer',
        'points_milestone' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

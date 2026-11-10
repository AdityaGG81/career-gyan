<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'votable_type',
        'votable_id',
        'user_id',
        'session_id',
        'ip_address',
        'vote_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

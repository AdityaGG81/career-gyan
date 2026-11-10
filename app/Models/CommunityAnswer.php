<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'post_id',
        'user_id',
        'author_name',
        'author_persona',
        'author_headline',
        'author_badge',
        'content',
        'upvotes_count',
        'is_accepted',
        'is_expert_answer',
        'guest_session_id',
        'ip_address',
    ];

    protected $casts = [
        'is_accepted' => 'boolean',
        'is_expert_answer' => 'boolean',
    ];

    public function post()
    {
        return $this->belongsTo(CommunityPost::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(CommunityVote::class, 'votable_id')->where('votable_type', 'answer');
    }
}

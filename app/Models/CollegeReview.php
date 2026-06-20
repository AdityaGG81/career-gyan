<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'user_id',
        'rating',
        'review'
    ];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

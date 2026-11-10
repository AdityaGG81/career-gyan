<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializedAptitudeQuestion extends Model
{
    use HasFactory;

    protected $table = 'specialized_aptitude_questions';

    protected $fillable = [
        'category',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'explanation'
    ];

    /**
     * Scope query by category: spiritual, artistic, sports, business.
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', strtolower(trim($category)));
    }
}


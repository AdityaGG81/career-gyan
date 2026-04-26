<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'dimension_id',
        'question_type',
        'question_text',
        'question_images',
        'options_type',
        'options',
        'correct_answer'
    ];

    protected $casts = [
        'question_images' => 'array',
        'options' => 'array'
    ];

    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }
}

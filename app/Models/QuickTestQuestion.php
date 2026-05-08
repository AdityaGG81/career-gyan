<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickTestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'question_text',
        'question_image',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_a_image',
        'option_b_image',
        'option_c_image',
        'option_d_image',
        'correct_option',
        'marks',
    ];
}

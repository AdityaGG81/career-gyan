<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessIdea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'field_id',
        'description',
        'investment',
        'profit_margin',
        'risk_level',
        'start_time',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

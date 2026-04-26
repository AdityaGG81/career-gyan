<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

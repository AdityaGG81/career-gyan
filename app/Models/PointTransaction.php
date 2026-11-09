<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_type',
        'points',
        'description',
        'reference_type',
        'reference_id',
        'admin_id',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
            'reference_id' => 'integer',
            'admin_id' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


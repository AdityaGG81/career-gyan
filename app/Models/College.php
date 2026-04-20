<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class College extends Model
{
    protected $fillable = [
        'name', 'field_id', 'location', 'state',
        'fees_range', 'type', 'website',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}

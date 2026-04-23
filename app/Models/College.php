<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class College extends Model
{
    protected $fillable = [
        'name', 'field_id', 'location', 'state',
        'fees_range', 'type', 'website',
        'rank', 'popular_branches', 'cutoff', 
        'placement_support', 'facilities', 'description',
        'affiliated_hospital', 'seats', 'clinical_exposure',
        'tier', 'duration', 'internship_opportunities',
        'specializations', 'average_package',
        'research_support'
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}

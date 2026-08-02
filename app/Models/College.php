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
        'research_support', 'youtube_url', 'naac_grade', 'government_rank'
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function reviews()
    {
        return $this->hasMany(CollegeReview::class);
    }

    public function getMapQueryAttribute(): string
    {
        $cleanName = trim($this->name);
        $parts = array_filter([
            $cleanName,
            $this->location,
            $this->state ?: 'India',
            'India'
        ]);
        return implode(', ', array_unique($parts));
    }

    public function getGoogleMapEmbedUrlAttribute(): string
    {
        return 'https://maps.google.com/maps?q=' . urlencode($this->map_query) . '&z=15&output=embed';
    }

    public function getGoogleMapDirectionsUrlAttribute(): string
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . urlencode($this->map_query);
    }
}

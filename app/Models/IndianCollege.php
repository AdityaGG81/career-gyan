<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndianCollege extends Model
{
    protected $fillable = [
        'college_name', 'state', 'district', 'taluka',
        'university_type', 'university_name', 'college_type',
        'affiliation', 'management', 'website',
        'year_of_establishment', 'address', 'city', 'pin_code',
        'total_enrollment', 'faculty_count',
        'course_name', 'course_type', 'is_professional',
        'course_aided_unaided', 'course_duration_months', 'course_category',
    ];

    protected $casts = [
        'year_of_establishment' => 'integer',
        'total_enrollment' => 'integer',
        'faculty_count' => 'integer',
        'course_duration_months' => 'integer',
    ];

    /* ─── Scopes ─── */

    public function scopeInState($query, $state)
    {
        return $query->where('state', $state);
    }

    public function scopeInDistrict($query, $district)
    {
        return $query->where('district', $district);
    }

    public function scopeOfManagement($query, $management)
    {
        return $query->where('management', $management);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('college_type', $type);
    }

    public function scopeOfUniversity($query, $university)
    {
        return $query->where('university_name', $university);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('college_name', 'like', "%{$term}%")
              ->orWhere('city', 'like', "%{$term}%")
              ->orWhere('district', 'like', "%{$term}%")
              ->orWhere('university_name', 'like', "%{$term}%")
              ->orWhere('course_name', 'like', "%{$term}%")
              ->orWhere('course_category', 'like', "%{$term}%");
        });
    }

    /* ─── Accessors ─── */

    public function getFormattedEnrollmentAttribute()
    {
        if (!$this->total_enrollment) return 'N/A';
        if ($this->total_enrollment >= 1000) {
            return number_format($this->total_enrollment / 1000, 1) . 'K';
        }
        return number_format($this->total_enrollment);
    }

    public function getLocationStringAttribute()
    {
        $parts = array_filter([$this->city, $this->district, $this->state]);
        return implode(', ', $parts) ?: 'India';
    }

    public function getManagementBadgeColorAttribute()
    {
        return match(strtolower($this->management ?? '')) {
            'central government' => '#059669',
            'state government'   => '#2563eb',
            'private un-aided'   => '#7c3aed',
            'private aided'      => '#0891b2',
            default              => '#64748b',
        };
    }

    public function getMapQueryAttribute(): string
    {
        $cleanName = trim(preg_replace('/\(Id:\s*[^\)]+\)/i', '', $this->college_name));
        $parts = array_filter([
            $cleanName,
            $this->address,
            $this->city,
            $this->taluka,
            $this->district,
            $this->state ?: 'Maharashtra',
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

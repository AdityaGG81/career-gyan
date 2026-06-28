<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'company_name',
        'job_title',
        'job_type',
        'category',
        'qualification',
        'location',
        'last_date',
        'apply_link',
        'notification_file',
        'description',
        'status',
    ];


    protected $casts = [
        'last_date' => 'date',
    ];

    /**
     * Scope to only include active jobs (not archived and last date not passed).
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('last_date', '>=', now()->startOfDay());
    }

    /**
     * Scope to include archived or expired jobs.
     */
    public function scopeArchived($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'archived')
              ->orWhere('last_date', '<', now()->startOfDay());
        });
    }

    /**
     * Determine if the job listing was posted recently (last 7 days).
     */
    public function isRecent(): bool
    {
        return $this->created_at >= now()->subDays(7);
    }

    /**
     * Determine if the job listing is expired.
     */
    public function isExpired(): bool
    {
        return $this->last_date < now()->startOfDay();
    }
}

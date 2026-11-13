<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGuruLead extends Model
{
    use HasFactory;

    protected $table = 'careerguru_leads';

    protected $fillable = [
        'careerguru_id',
        'student_name',
        'phone',
        'email',
        'standard',
        'parent_name',
        'parent_phone',
        'city',
        'school_college',
        'interested_course',
        'lead_status',
        'registered_user_id',
        'registered_at',
        'premium_purchased_at',
        'additional_notes',
        'next_followup_at',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'premium_purchased_at' => 'datetime',
        'next_followup_at' => 'date',
    ];

    public const STANDARDS = [
        'Class 8',
        'Class 9',
        'Class 10',
        'Class 11',
        'Class 12',
        'Diploma',
        'Undergraduate',
        'Postgraduate',
        'Other'
    ];

    public const STATUSES = [
        'New Lead',
        'Contacted',
        'Interested',
        'Follow-up Required',
        'Registered on CareerGyan',
        'Premium Purchased',
        'Not Interested'
    ];

    // ==================== Relationships ====================

    public function careerguru()
    {
        return $this->belongsTo(CareerGuru::class, 'careerguru_id');
    }

    public function registeredUser()
    {
        return $this->belongsTo(User::class, 'registered_user_id');
    }

    public function activities()
    {
        return $this->hasMany(CareerGuruLeadActivity::class, 'lead_id')->latest();
    }

    public function commissions()
    {
        return $this->hasMany(CareerGuruCommission::class, 'lead_id');
    }

    // ==================== Helpers ====================

    public function isRegistered(): bool
    {
        return !empty($this->registered_user_id) || $this->lead_status === 'Registered on CareerGyan' || $this->lead_status === 'Premium Purchased';
    }

    public function isPremium(): bool
    {
        if ($this->lead_status === 'Premium Purchased' || !empty($this->premium_purchased_at)) {
            return true;
        }
        if ($this->registeredUser && $this->registeredUser->hasActiveMembership()) {
            return true;
        }
        return false;
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->lead_status) {
            'New Lead' => 'badge-blue',
            'Contacted' => 'badge-indigo',
            'Interested' => 'badge-emerald',
            'Follow-up Required' => 'badge-amber',
            'Registered on CareerGyan' => 'badge-purple',
            'Premium Purchased' => 'badge-gold',
            'Not Interested' => 'badge-zinc',
            default => 'badge-slate'
        };
    }
}


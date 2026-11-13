<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGuruLeadActivity extends Model
{
    use HasFactory;

    protected $table = 'careerguru_lead_activities';

    protected $fillable = [
        'lead_id',
        'careerguru_id',
        'activity_type',
        'title',
        'description',
    ];

    public function lead()
    {
        return $this->belongsTo(CareerGuruLead::class, 'lead_id');
    }

    public function careerguru()
    {
        return $this->belongsTo(CareerGuru::class, 'careerguru_id');
    }

    public function getIconAttribute(): string
    {
        return match($this->activity_type) {
            'lead_created' => 'fa-solid fa-user-plus text-blue-500',
            'status_change' => 'fa-solid fa-arrows-rotate text-purple-500',
            'note_added' => 'fa-solid fa-comment-dots text-emerald-500',
            'student_registered' => 'fa-solid fa-id-card text-indigo-500',
            'premium_purchased' => 'fa-solid fa-crown text-amber-500',
            'followup_scheduled' => 'fa-solid fa-calendar-check text-rose-500',
            default => 'fa-solid fa-circle-info text-slate-400'
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGuruCommission extends Model
{
    use HasFactory;

    protected $table = 'careerguru_commissions';

    protected $fillable = [
        'careerguru_id',
        'lead_id',
        'student_user_id',
        'membership_id',
        'payment_id',
        'membership_plan',
        'membership_amount',
        'commission_type',
        'commission_rate',
        'commission_amount',
        'status',
        'approved_at',
        'paid_at',
        'payment_reference',
        'rejection_reason',
        'admin_remarks',
    ];

    protected $casts = [
        'membership_amount' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function careerguru()
    {
        return $this->belongsTo(CareerGuru::class, 'careerguru_id');
    }

    public function lead()
    {
        return $this->belongsTo(CareerGuruLead::class, 'lead_id');
    }

    public function studentUser()
    {
        return $this->belongsTo(User::class, 'student_user_id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'pending' => ['label' => 'Pending Approval', 'class' => 'bg-amber-50 text-amber-700 border-amber-200', 'icon' => 'fa-clock'],
            'approved' => ['label' => 'Approved / Unpaid', 'class' => 'bg-blue-50 text-blue-700 border-blue-200', 'icon' => 'fa-check'],
            'paid' => ['label' => 'Paid Out', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'icon' => 'fa-circle-check'],
            'rejected' => ['label' => 'Rejected', 'class' => 'bg-rose-50 text-rose-700 border-rose-200', 'icon' => 'fa-circle-xmark'],
            default => ['label' => ucfirst($this->status), 'class' => 'bg-gray-50 text-gray-700 border-gray-200', 'icon' => 'fa-circle-question']
        };
    }
}

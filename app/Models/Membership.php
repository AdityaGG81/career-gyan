<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
        'amount_paid',
        'currency',
        'status', // active, expired, cancelled, pending
        'starts_at',
        'expires_at'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class, 'plan_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && ($this->expires_at === null || $this->expires_at->isFuture());
    }

    public function daysRemaining(): int
    {
        if ($this->expires_at === null) {
            return 9999;
        }
        if (!$this->isActive()) {
            return 0;
        }
        return max(0, (int) now()->diffInDays($this->expires_at));
    }
}

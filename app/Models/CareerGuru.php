<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareerGuru extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'careergurus';

    protected $fillable = [
        'guru_id',
        'name',
        'email',
        'phone',
        'password',
        'referral_code',
        'commission_type',
        'commission_value',
        'status',
        'payout_upi_id',
        'payout_bank_details',
        'notes',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'commission_value' => 'decimal:2',
        'password' => 'hashed',
    ];

    // ==================== Relationships ====================

    public function leads()
    {
        return $this->hasMany(CareerGuruLead::class, 'careerguru_id');
    }

    public function registeredStudents()
    {
        return $this->hasMany(User::class, 'careerguru_id');
    }

    public function commissions()
    {
        return $this->hasMany(CareerGuruCommission::class, 'careerguru_id');
    }

    public function activities()
    {
        return $this->hasMany(CareerGuruLeadActivity::class, 'careerguru_id');
    }

    // ==================== Helper Methods & Stats ====================

    public function getCommissionPercentageAttribute(): float
    {
        return (float) ($this->commission_value ?? 20.00);
    }

    public function setCommissionPercentageAttribute($value): void
    {
        $this->attributes['commission_value'] = (float) $value;
    }

    public function getPayoutBankNameAttribute(): ?string
    {
        $details = json_decode($this->payout_bank_details ?? '', true);
        return is_array($details) ? ($details['bank_name'] ?? null) : $this->payout_bank_details;
    }

    public function getPayoutAccountNumberAttribute(): ?string
    {
        $details = json_decode($this->payout_bank_details ?? '', true);
        return is_array($details) ? ($details['account_number'] ?? null) : null;
    }

    public function getPayoutIfscCodeAttribute(): ?string
    {
        $details = json_decode($this->payout_bank_details ?? '', true);
        return is_array($details) ? ($details['ifsc_code'] ?? null) : null;
    }

    public function getPayoutAccountHolderNameAttribute(): ?string
    {
        $details = json_decode($this->payout_bank_details ?? '', true);
        return is_array($details) ? ($details['account_holder_name'] ?? null) : null;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getReferralUrlAttribute(): string
    {
        return route('careerguru.ref', $this->referral_code);
    }

    public function getDirectSignupUrlAttribute(): string
    {
        return route('signup', ['guru' => $this->referral_code]);
    }

    public function totalLeadsCount(): int
    {
        return $this->leads()->count();
    }

    public function registeredCount(): int
    {
        return $this->registeredStudents()->count();
    }

    public function notYetRegisteredCount(): int
    {
        return $this->leads()
            ->whereNull('registered_user_id')
            ->where('lead_status', '!=', 'Registered on CareerGyan')
            ->where('lead_status', '!=', 'Premium Purchased')
            ->count();
    }

    public function premiumCount(): int
    {
        return $this->commissions()
            ->whereIn('status', ['pending', 'approved', 'paid'])
            ->distinct('student_user_id')
            ->count('student_user_id');
    }

    public function pendingPremiumConversionsCount(): int
    {
        // Students who are registered but haven't bought premium yet
        return $this->registeredStudents()
            ->where('is_member', false)
            ->count();
    }

    public function totalCommissionEarned(): float
    {
        return (float) $this->commissions()
            ->whereIn('status', ['approved', 'paid'])
            ->sum('commission_amount');
    }

    public function pendingCommission(): float
    {
        return (float) $this->commissions()
            ->where('status', 'pending')
            ->sum('commission_amount');
    }

    public function approvedCommission(): float
    {
        return (float) $this->commissions()
            ->where('status', 'approved')
            ->sum('commission_amount');
    }

    public function paidCommission(): float
    {
        return (float) $this->commissions()
            ->where('status', 'paid')
            ->sum('commission_amount');
    }

    public function leadConversionRate(): float
    {
        $total = $this->totalLeadsCount();
        if ($total === 0) return 0.0;
        $registered = $this->registeredCount();
        return round(($registered / $total) * 100, 1);
    }

    public function registrationToPremiumRate(): float
    {
        $reg = $this->registeredCount();
        if ($reg === 0) return 0.0;
        $prem = $this->premiumCount();
        return round(($prem / $reg) * 100, 1);
    }
}

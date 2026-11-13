<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'points_balance' => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'email_otp',
        'email_verified_at',
        'email_otp_expires_at',
        'last_otp_sent_at',
        'is_member',
        'membership_expires_at',
        'referral_code',
        'referred_by',
        'points_balance',
        'careerguru_id',
        'careerguru_registered_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'email_otp_expires_at' => 'datetime',
            'last_otp_sent_at' => 'datetime',
            'membership_expires_at' => 'datetime',
            'is_member' => 'boolean',
            'points_balance' => 'integer',
            'password' => 'hashed',
        ];
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function careerguru()
    {
        return $this->belongsTo(CareerGuru::class, 'careerguru_id');
    }

    public function careerguruLead()
    {
        return $this->hasOne(CareerGuruLead::class, 'registered_user_id');
    }

    public function careerguruCommissions()
    {
        return $this->hasMany(CareerGuruCommission::class, 'student_user_id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function successfulReferrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id')->where('status', 'completed');
    }

    public function directReferredUsers()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class)->latest();
    }

    public function rewardClaims()
    {
        return $this->hasMany(RewardClaim::class);
    }

    public function badges()
    {
        return $this->hasMany(UserBadge::class)->orderBy('tier_level', 'asc');
    }

    public function latestBadge()
    {
        return $this->hasOne(UserBadge::class)->latestOfMany('tier_level');
    }

    public function getCurrentBadgeAttribute(): ?array
    {
        $badge = $this->badges()->orderByDesc('tier_level')->first();
        if ($badge) {
            return [
                'tier_level' => $badge->tier_level,
                'points_milestone' => $badge->points_milestone,
                'badge_name' => $badge->badge_name,
                'badge_icon' => $badge->badge_icon,
                'badge_color' => $badge->badge_color,
                'badge_bg' => $badge->badge_bg,
                'badge_description' => $badge->badge_description,
                'unlocked_at' => $badge->unlocked_at,
            ];
        }

        $tier = intdiv((int) $this->points_balance, 1000);
        if ($tier >= 1) {
            return app(\App\Services\RewardPointsService::class)->getBadgeDefinitionForTier($tier);
        }

        return null;
    }

    public function getBadgesCountAttribute(): int
    {
        $dbCount = $this->badges()->count();
        if ($dbCount > 0) {
            return $dbCount;
        }
        return intdiv((int) $this->points_balance, 1000);
    }

    public function getReferralLinkAttribute(): string
    {
        $code = urlencode($this->referral_code ?? '');
        $host = null;

        if (!app()->runningInConsole() && request()) {
            $reqHost = request()->getHttpHost();
            if ($reqHost && !str_contains($reqHost, 'localhost') && !str_contains($reqHost, '127.0.0.1')) {
                $host = 'https://' . $reqHost;
            }
        }

        if (!$host) {
            $appUrl = env('APP_URL');
            if ($appUrl && !str_contains($appUrl, 'localhost') && !str_contains($appUrl, '127.0.0.1')) {
                $host = rtrim($appUrl, '/');
                if (!str_starts_with($host, 'http://') && !str_starts_with($host, 'https://')) {
                    $host = 'https://' . $host;
                }
            }
        }

        if (!$host) {
            $host = 'https://careergyan.in';
        }

        if (str_starts_with($host, 'http://') && !str_contains($host, 'localhost')) {
            $host = 'https://' . substr($host, 7);
        }

        return rtrim($host, '/') . '/signup?ref=' . $code;
    }

    public function getReferralShareTextAttribute(): string
    {
        $link = $this->referral_link;
        return "Hey! I found a useful platform for students where you can explore your career options, take aptitude tests and analyze your skills.\n\nJoin using my referral link and get 100 reward points!\n\n" . $link;
    }

    public function getWhatsappShareUrlAttribute(): string
    {
        return 'https://api.whatsapp.com/send?text=' . rawurlencode($this->referral_share_text);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function activeMembership()
    {
        return $this->hasOne(Membership::class)->where('status', 'active')->where(function ($query) {
            $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
        })->latest();
    }

    public function hasActiveMembership(): bool
    {
        return (bool) $this->is_member && ($this->membership_expires_at === null || $this->membership_expires_at->isFuture());
    }

    public function aiChatLogs()
    {
        return $this->hasMany(AiChatLog::class);
    }

    public function studentAnalyses()
    {
        return $this->hasMany(StudentAnalysis::class);
    }

    public function testSessions()
    {
        return $this->hasMany(TestSession::class);
    }

    public function latestTestSession()
    {
        return $this->hasOne(TestSession::class)->latestOfMany();
    }

    public function latestStudentAnalysis()
    {
        return $this->hasOne(StudentAnalysis::class)->latestOfMany();
    }

    public function quickTestAttempts()
    {
        return $this->hasMany(QuickTestAttempt::class, 'student_email', 'email');
    }

    public function specializedTestAttempts()
    {
        return $this->hasMany(SpecializedTestAttempt::class)->latest();
    }

    public function hasAnyTestResults(): bool
    {
        return $this->testSessions()->exists()
            || $this->studentAnalyses()->exists()
            || QuickTestAttempt::where('student_email', $this->email)->exists();
    }
}

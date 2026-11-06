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
            'password' => 'hashed',
        ];
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

    public function hasAnyTestResults(): bool
    {
        return $this->testSessions()->exists()
            || $this->studentAnalyses()->exists()
            || QuickTestAttempt::where('student_email', $this->email)->exists();
    }
}

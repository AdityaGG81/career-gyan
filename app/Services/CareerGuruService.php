<?php

namespace App\Services;

use App\Models\CareerGuru;
use App\Models\CareerGuruLead;
use App\Models\CareerGuruLeadActivity;
use App\Models\CareerGuruCommission;
use App\Models\CareerGuruSetting;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CareerGuruService
{
    /**
     * Generate unique CareerGuru ID e.g. CG-1001.
     */
    public function generateGuruId(): string
    {
        $lastGuru = CareerGuru::orderBy('id', 'desc')->first();
        $nextNum = $lastGuru ? ($lastGuru->id + 1001) : 1001;
        
        $candidate = 'CG-' . $nextNum;
        while (CareerGuru::where('guru_id', $candidate)->exists()) {
            $nextNum++;
            $candidate = 'CG-' . $nextNum;
        }

        return $candidate;
    }

    /**
     * Generate clean, unique referral code like GURU7821 or based on name.
     */
    public function generateReferralCode(string $name): string
    {
        $clean = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', explode(' ', trim($name))[0] ?? 'GURU'));
        if (strlen($clean) < 3) {
            $clean = 'GURU';
        }
        $prefix = substr($clean, 0, 5);

        do {
            $code = $prefix . random_int(1000, 9999);
        } while (CareerGuru::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Record an audit activity for a lead.
     */
    public function recordLeadActivity(int $leadId, int $guruId, string $type, string $title, ?string $description = null): CareerGuruLeadActivity
    {
        return CareerGuruLeadActivity::create([
            'lead_id' => $leadId,
            'careerguru_id' => $guruId,
            'activity_type' => $type,
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Associate a registering user with a CareerGuru and link any existing lead.
     */
    public function handleStudentRegistration(User $user, ?string $refCode = null): ?CareerGuru
    {
        $refCode = strtoupper(trim((string) ($refCode ?? session('careerguru_ref') ?? request()->cookie('careerguru_ref') ?? '')));
        
        $guru = null;
        if (!empty($refCode)) {
            $guru = CareerGuru::where('referral_code', $refCode)->where('status', 'active')->first();
        }

        // If no referral code provided, check if an existing lead matches by email or phone
        if (!$guru) {
            $existingLead = CareerGuruLead::where(function ($q) use ($user) {
                $q->where('email', strtolower(trim($user->email)))
                  ->orWhere('phone', preg_replace('/[^0-9]/', '', $user->phone));
            })->latest()->first();

            if ($existingLead && $existingLead->careerguru && $existingLead->careerguru->isActive()) {
                $guru = $existingLead->careerguru;
            }
        }

        if (!$guru) {
            return null;
        }

        // Attribute user to guru if not already attributed
        if (!$user->careerguru_id) {
            $user->careerguru_id = $guru->id;
            $user->careerguru_registered_at = now();
            $user->save();
        }

        // Look for matching lead under this guru
        $lead = CareerGuruLead::where('careerguru_id', $guru->id)
            ->where(function ($q) use ($user) {
                $q->where('email', strtolower(trim($user->email)))
                  ->orWhere('phone', preg_replace('/[^0-9]/', '', $user->phone));
            })->first();

        if ($lead) {
            $lead->registered_user_id = $user->id;
            $lead->registered_at = now();
            if ($lead->lead_status !== 'Premium Purchased') {
                $lead->lead_status = 'Registered on CareerGyan';
            }
            $lead->save();

            $this->recordLeadActivity(
                $lead->id,
                $guru->id,
                'student_registered',
                'Student Completed CareerGyan Registration',
                "Student successfully registered as User #{$user->id} ({$user->name}, {$user->email})."
            );
        } else {
            // Student registered directly through Guru's referral link without prior lead record
            $lead = CareerGuruLead::create([
                'careerguru_id' => $guru->id,
                'student_name' => $user->name,
                'phone' => $user->phone ?: 'N/A',
                'email' => strtolower(trim($user->email)),
                'standard' => 'Other',
                'lead_status' => 'Registered on CareerGyan',
                'registered_user_id' => $user->id,
                'registered_at' => now(),
                'additional_notes' => 'Registered directly via CareerGuru referral link: ' . $guru->referral_code,
            ]);

            $this->recordLeadActivity(
                $lead->id,
                $guru->id,
                'student_registered',
                'Direct Referral Registration',
                "Student signed up directly on CareerGyan using your referral link (User #{$user->id})."
            );
        }

        // Clean up session referral code
        session()->forget('careerguru_ref');

        return $guru;
    }

    /**
     * Triggered when a student successfully purchases a premium membership.
     * Calculates and creates a CareerGuruCommission record.
     */
    public function handlePremiumPurchase(Membership $membership): ?CareerGuruCommission
    {
        $user = $membership->user;
        if (!$user || !$user->careerguru_id) {
            return null;
        }

        $guru = CareerGuru::find($user->careerguru_id);
        if (!$guru) {
            return null;
        }

        // Prevent duplicate commission record for the same membership transaction
        $existing = CareerGuruCommission::where('membership_id', $membership->id)->first();
        if ($existing) {
            return $existing;
        }

        // Eligible membership amount in Rupees (membership->amount_paid is stored in paise)
        $paidRupees = $membership->amount_paid ? round($membership->amount_paid / 100, 2) : 0.00;

        // Skip zero-value complimentary grants
        if ($paidRupees <= 0) {
            return null;
        }

        $commissionType = $guru->commission_type ?? 'percentage';
        $commissionRate = (float) ($guru->commission_value ?? 20.00);

        if ($commissionType === 'fixed') {
            $commissionAmount = $commissionRate;
        } else {
            $commissionAmount = round(($paidRupees * $commissionRate) / 100, 2);
        }

        // Find associated lead if any
        $lead = CareerGuruLead::where('registered_user_id', $user->id)
            ->where('careerguru_id', $guru->id)
            ->first();

        return DB::transaction(function () use ($guru, $lead, $user, $membership, $paidRupees, $commissionType, $commissionRate, $commissionAmount) {
            $planName = $membership->plan ? $membership->plan->name : 'Pro Membership';

            $commission = CareerGuruCommission::create([
                'careerguru_id' => $guru->id,
                'lead_id' => $lead?->id,
                'student_user_id' => $user->id,
                'membership_id' => $membership->id,
                'payment_id' => $membership->razorpay_payment_id ?? $membership->razorpay_order_id,
                'membership_plan' => $planName,
                'membership_amount' => $paidRupees,
                'commission_type' => $commissionType,
                'commission_rate' => $commissionRate,
                'commission_amount' => $commissionAmount,
                'status' => 'pending', // Pending admin approval
            ]);

            // Update lead status to Premium Purchased
            if ($lead) {
                $lead->lead_status = 'Premium Purchased';
                $lead->premium_purchased_at = now();
                $lead->save();

                $this->recordLeadActivity(
                    $lead->id,
                    $guru->id,
                    'premium_purchased',
                    'Premium Membership Purchased',
                    "Student purchased {$planName} (₹{$paidRupees}). Eligible commission: ₹{$commissionAmount} (Status: Pending Approval)."
                );
            }

            Log::info("CareerGuru commission generated: ID #{$commission->id} for Guru #{$guru->id} (₹{$commissionAmount}) on student #{$user->id}");

            return $commission;
        });
    }

    /**
     * Handle membership cancellation or refund.
     */
    public function handleMembershipCancelledOrRefunded(Membership $membership, string $reason = 'Membership refunded/cancelled'): void
    {
        $commission = CareerGuruCommission::where('membership_id', $membership->id)->first();
        if ($commission && in_array($commission->status, ['pending', 'approved'])) {
            $commission->status = 'rejected';
            $commission->rejection_reason = $reason;
            $commission->admin_remarks = 'Auto-rejected due to membership cancellation or refund.';
            $commission->save();

            if ($commission->lead_id) {
                $this->recordLeadActivity(
                    $commission->lead_id,
                    $commission->careerguru_id,
                    'status_change',
                    'Commission Reversal',
                    "Commission for {$commission->membership_plan} was rejected: {$reason}."
                );
            }
        }
    }
}

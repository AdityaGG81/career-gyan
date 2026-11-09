<?php

namespace App\Services;

use App\Models\User;
use App\Models\Referral;
use App\Models\PointTransaction;
use App\Models\RewardClaim;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RewardPointsService
{
    /**
     * Generate a unique, memorable referral code for a user (e.g., "VEDANT2026").
     */
    public function generateUniqueReferralCode(User $user): string
    {
        $firstName = preg_replace('/[^A-Za-z]/', '', $user->first_name ?: $user->name);
        $base = strtoupper(substr($firstName ?: 'STUDENT', 0, 7));
        if (strlen($base) < 3) {
            $base = 'CG' . $base;
        }

        $year = date('Y');
        $candidate = $base . $year;

        // If candidate already exists, try variations
        if (!User::where('referral_code', $candidate)->where('id', '!=', $user->id)->exists()) {
            return $candidate;
        }

        // Try candidate with random 2-4 digits
        for ($i = 0; $i < 20; $i++) {
            $candidate = $base . random_int(100, 9999);
            if (!User::where('referral_code', $candidate)->where('id', '!=', $user->id)->exists()) {
                return $candidate;
            }
        }

        // Fallback: 8 char alphanumeric
        do {
            $candidate = 'CG' . strtoupper(Str::random(6));
        } while (User::where('referral_code', $candidate)->where('id', '!=', $user->id)->exists());

        return $candidate;
    }

    /**
     * Ensure all users have a referral code.
     */
    public function ensureReferralCodesForExistingUsers(): int
    {
        $usersWithoutCode = User::whereNull('referral_code')->orWhere('referral_code', '')->get();
        $count = 0;

        foreach ($usersWithoutCode as $u) {
            $code = $this->generateUniqueReferralCode($u);
            $u->update(['referral_code' => $code]);
            $count++;
        }

        return $count;
    }

    /**
     * Record a pending referral when a user registers with a referral code.
     */
    public function recordPendingReferral(User $newUser, ?string $referralCode): ?Referral
    {
        if (empty($referralCode)) {
            return null;
        }

        $cleanedCode = strtoupper(trim($referralCode));

        // Find referrer by code
        $referrer = User::where('referral_code', $cleanedCode)->first();

        if (!$referrer) {
            return null;
        }

        // Fraud prevention 1: Cannot refer oneself
        if ($referrer->id === $newUser->id) {
            Log::warning("Self-referral attempt blocked for user {$newUser->id}");
            return null;
        }

        // Fraud prevention 2: User already has a sponsor
        if ($newUser->referred_by) {
            return null;
        }

        // Check if referral already recorded
        $existing = Referral::where('referred_user_id', $newUser->id)->first();
        if ($existing) {
            return $existing;
        }

        return DB::transaction(function () use ($referrer, $newUser, $cleanedCode) {
            $newUser->update([
                'referred_by' => $referrer->id
            ]);

            return Referral::create([
                'referrer_id' => $referrer->id,
                'referred_user_id' => $newUser->id,
                'referral_code' => $cleanedCode,
                'status' => 'pending',
                'referrer_points' => 0,
                'referred_user_points' => 0,
            ]);
        });
    }

    /**
     * Complete referral reward once user verifies their account.
     * Both referrer (+100) and new student (+100) receive points.
     */
    public function completeReferralReward(User $newUser): bool
    {
        if (!$newUser->referred_by) {
            return false;
        }

        return DB::transaction(function () use ($newUser) {
            $referral = Referral::where('referred_user_id', $newUser->id)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->first();

            if (!$referral) {
                return false;
            }

            // Check if new user already claimed referral signup bonus
            $alreadyClaimed = RewardClaim::where('user_id', $newUser->id)
                ->where('reward_type', 'referred_signup')
                ->exists();

            if ($alreadyClaimed) {
                return false;
            }

            $referrer = User::where('id', $referral->referrer_id)->lockForUpdate()->first();
            if (!$referrer) {
                return false;
            }

            // 1. Credit 100 points to Referrer
            PointTransaction::create([
                'user_id' => $referrer->id,
                'transaction_type' => 'referral_bonus',
                'points' => 100,
                'description' => 'Friend Joined Using Your Link (' . $newUser->name . ')',
                'reference_type' => 'referral',
                'reference_id' => $referral->id,
            ]);
            $referrer->increment('points_balance', 100);

            // Record claim for referrer specific to this referral
            RewardClaim::create([
                'user_id' => $referrer->id,
                'reward_type' => 'referral_bonus_ref_' . $referral->id,
                'reference_id' => $referral->id,
                'points_awarded' => 100,
            ]);

            // 2. Credit 100 points to New Student
            PointTransaction::create([
                'user_id' => $newUser->id,
                'transaction_type' => 'referred_signup',
                'points' => 100,
                'description' => 'Referral Bonus - Joined via ' . $referrer->name,
                'reference_type' => 'referral',
                'reference_id' => $referral->id,
            ]);
            $newUser->increment('points_balance', 100);

            // Record unique claim for new user
            RewardClaim::create([
                'user_id' => $newUser->id,
                'reward_type' => 'referred_signup',
                'reference_id' => $referral->id,
                'points_awarded' => 100,
            ]);

            // 3. Update Referral record
            $referral->update([
                'status' => 'completed',
                'referrer_points' => 100,
                'referred_user_points' => 100,
                'completed_at' => now(),
            ]);

            return true;
        });
    }

    /**
     * Award Aptitude Test completion reward (+10 points once).
     */
    public function awardAptitudeTestReward(User $user, $referenceId = null): ?int
    {
        return DB::transaction(function () use ($user, $referenceId) {
            // Check if already awarded
            $exists = RewardClaim::where('user_id', $user->id)
                ->where('reward_type', 'aptitude_test')
                ->lockForUpdate()
                ->exists();

            if ($exists) {
                return null;
            }

            try {
                RewardClaim::create([
                    'user_id' => $user->id,
                    'reward_type' => 'aptitude_test',
                    'reference_id' => $referenceId,
                    'points_awarded' => 10,
                ]);
            } catch (\Exception $e) {
                // Caught duplicate constraint
                return null;
            }

            PointTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'aptitude_test',
                'points' => 10,
                'description' => 'Aptitude Test Completed',
                'reference_type' => 'test_session',
                'reference_id' => $referenceId,
            ]);

            $user->increment('points_balance', 10);

            return 10;
        });
    }

    /**
     * Award Student Analysis Test completion reward (+10 points once).
     */
    public function awardStudentAnalysisReward(User $user, $referenceId = null): ?int
    {
        return DB::transaction(function () use ($user, $referenceId) {
            // Check if already awarded
            $exists = RewardClaim::where('user_id', $user->id)
                ->where('reward_type', 'student_analysis')
                ->lockForUpdate()
                ->exists();

            if ($exists) {
                return null;
            }

            try {
                RewardClaim::create([
                    'user_id' => $user->id,
                    'reward_type' => 'student_analysis',
                    'reference_id' => $referenceId,
                    'points_awarded' => 10,
                ]);
            } catch (\Exception $e) {
                // Caught duplicate constraint
                return null;
            }

            PointTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'student_analysis',
                'points' => 10,
                'description' => 'Student Analysis Completed',
                'reference_type' => 'student_analysis',
                'reference_id' => $referenceId,
            ]);

            $user->increment('points_balance', 10);

            return 10;
        });
    }

    /**
     * Admin manual point adjustments (+/- points with reason).
     */
    public function adjustUserPoints(User $user, int $points, string $reason, $adminId = null): PointTransaction
    {
        return DB::transaction(function () use ($user, $points, $reason, $adminId) {
            $user = User::where('id', $user->id)->lockForUpdate()->first();

            $tx = PointTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'admin_adjustment',
                'points' => $points,
                'description' => 'Admin Adjustment: ' . $reason,
                'reference_type' => 'admin_manual',
                'admin_id' => $adminId,
            ]);

            $user->points_balance = max(0, $user->points_balance + $points);
            $user->save();

            return $tx;
        });
    }

    /**
     * Get aggregated statistics for user's points wallet & referrals.
     */
    public function getUserWalletStats(User $user): array
    {
        $totalEarned = (int) PointTransaction::where('user_id', $user->id)
            ->where('points', '>', 0)
            ->sum('points');

        $referralPoints = (int) PointTransaction::where('user_id', $user->id)
            ->whereIn('transaction_type', ['referral_bonus', 'referred_signup'])
            ->where('points', '>', 0)
            ->sum('points');

        $testPoints = (int) PointTransaction::where('user_id', $user->id)
            ->whereIn('transaction_type', ['aptitude_test', 'student_analysis'])
            ->sum('points');

        $totalInvited = Referral::where('referrer_id', $user->id)->count();
        $successful = Referral::where('referrer_id', $user->id)->where('status', 'completed')->count();
        $pending = Referral::where('referrer_id', $user->id)->where('status', 'pending')->count();

        $aptitudeClaimed = RewardClaim::where('user_id', $user->id)->where('reward_type', 'aptitude_test')->exists();
        $analysisClaimed = RewardClaim::where('user_id', $user->id)->where('reward_type', 'student_analysis')->exists();
        $referralBonusClaimed = RewardClaim::where('user_id', $user->id)->where('reward_type', 'referred_signup')->exists();

        return [
            'available_points' => (int) $user->points_balance,
            'total_earned_points' => $totalEarned,
            'referral_points' => $referralPoints,
            'test_points' => $testPoints,
            'total_invited' => $totalInvited,
            'successful_referrals' => $successful,
            'pending_referrals' => $pending,
            'aptitude_claimed' => $aptitudeClaimed,
            'analysis_claimed' => $analysisClaimed,
            'referral_bonus_claimed' => $referralBonusClaimed,
        ];
    }

    /**
     * Build referral genealogy / tree for admin.
     * Computes direct referrals count and total descendant chain count for each user.
     */
    public function getReferralTreeData(?int $rootUserId = null, ?string $searchQuery = null, int $maxDepth = 6): array
    {
        if ($searchQuery) {
            $matchedUser = User::where('name', 'like', "%{$searchQuery}%")
                ->orWhere('email', 'like', "%{$searchQuery}%")
                ->orWhere('referral_code', 'like', "%{$searchQuery}%")
                ->orWhere('id', $searchQuery)
                ->first();

            if ($matchedUser) {
                return [$this->buildUserNode($matchedUser, 1, $maxDepth)];
            }
            return [];
        }

        if ($rootUserId) {
            $user = User::find($rootUserId);
            return $user ? [$this->buildUserNode($user, 1, $maxDepth)] : [];
        }

        // Get top-level sponsors: users who have direct referrals and were either not referred by anyone, or all users with referrals
        $rootUserIds = User::whereHas('directReferredUsers')
            ->where(function ($q) {
                $q->whereNull('referred_by')->orWhereColumn('referred_by', 'id');
            })
            ->pluck('id');

        // Fallback: if all users have a sponsor or none, pick users with the most referrals
        if ($rootUserIds->isEmpty()) {
            $rootUserIds = User::withCount('directReferredUsers')
                ->having('direct_referred_users_count', '>', 0)
                ->orderByDesc('direct_referred_users_count')
                ->take(10)
                ->pluck('id');
        }

        $tree = [];
        foreach ($rootUserIds as $id) {
            $user = User::find($id);
            if ($user) {
                $tree[] = $this->buildUserNode($user, 1, $maxDepth);
            }
        }

        return $tree;
    }

    /**
     * Recursively build node with descendant count.
     */
    protected function buildUserNode(User $user, int $currentDepth, int $maxDepth): array
    {
        $directChildren = User::where('referred_by', $user->id)
            ->where('id', '!=', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $childrenNodes = [];
        $totalDescendants = $directChildren->count();

        if ($currentDepth < $maxDepth) {
            foreach ($directChildren as $child) {
                $childNode = $this->buildUserNode($child, $currentDepth + 1, $maxDepth);
                $totalDescendants += ($childNode['descendants_count'] ?? 0);
                $childrenNodes[] = $childNode;
            }
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'referral_code' => $user->referral_code ?? 'N/A',
            'created_at' => $user->created_at ? $user->created_at->format('d M Y') : 'N/A',
            'points_balance' => (int) $user->points_balance,
            'direct_count' => $directChildren->count(),
            'descendants_count' => $totalDescendants,
            'children' => $childrenNodes,
        ];
    }
}


<?php

namespace App\Services;

use App\Models\User;
use App\Models\Referral;
use App\Models\PointTransaction;
use App\Models\RewardClaim;
use App\Models\UserBadge;
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

            $this->syncUserMilestoneBadges($referrer);
            $this->syncUserMilestoneBadges($newUser);

            return true;
        });
    }

    /**
     * Award Aptitude Test completion reward (+50 points once).
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
                    'points_awarded' => 50,
                ]);
            } catch (\Exception $e) {
                // Caught duplicate constraint
                return null;
            }

            PointTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'aptitude_test',
                'points' => 50,
                'description' => 'Aptitude Test Completed',
                'reference_type' => 'test_session',
                'reference_id' => $referenceId,
            ]);

            $user->increment('points_balance', 50);

            $this->syncUserMilestoneBadges($user);

            return 50;
        });
    }

    /**
     * Award Student Analysis Test completion reward (+50 points once).
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
                    'points_awarded' => 50,
                ]);
            } catch (\Exception $e) {
                // Caught duplicate constraint
                return null;
            }

            PointTransaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'student_analysis',
                'points' => 50,
                'description' => 'Student Analysis Completed',
                'reference_type' => 'student_analysis',
                'reference_id' => $referenceId,
            ]);

            $user->increment('points_balance', 50);

            $this->syncUserMilestoneBadges($user);

            return 50;
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

            $this->syncUserMilestoneBadges($user);

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

    /**
     * Standard milestone badge catalog for every 1,000 points.
     */
    public function getBadgeDefinitions(): array
    {
        return [
            1 => [
                'tier_level' => 1,
                'points_milestone' => 1000,
                'badge_name' => 'Bronze Explorer',
                'badge_slug' => 'bronze-explorer',
                'badge_icon' => 'fa-solid fa-award',
                'badge_color' => '#b45309',
                'badge_bg' => '#fef3c7',
                'badge_border' => '#fde68a',
                'badge_gradient' => 'linear-gradient(135deg, #f59e0b, #b45309)',
                'badge_description' => 'Unlocked at 1,000 Points. Commenced your career roadmap with active participation.',
            ],
            2 => [
                'tier_level' => 2,
                'points_milestone' => 2000,
                'badge_name' => 'Silver Scholar',
                'badge_slug' => 'silver-scholar',
                'badge_icon' => 'fa-solid fa-medal',
                'badge_color' => '#475569',
                'badge_bg' => '#f1f5f9',
                'badge_border' => '#cbd5e1',
                'badge_gradient' => 'linear-gradient(135deg, #94a3b8, #475569)',
                'badge_description' => 'Unlocked at 2,000 Points. Consistently mastering assessments and expanding your network.',
            ],
            3 => [
                'tier_level' => 3,
                'points_milestone' => 3000,
                'badge_name' => 'Gold Champion',
                'badge_slug' => 'gold-champion',
                'badge_icon' => 'fa-solid fa-trophy',
                'badge_color' => '#ca8a04',
                'badge_bg' => '#fef9c3',
                'badge_border' => '#fef08a',
                'badge_gradient' => 'linear-gradient(135deg, #eab308, #ca8a04)',
                'badge_description' => 'Unlocked at 3,000 Points. A recognized campus champion empowering friends and classmates.',
            ],
            4 => [
                'tier_level' => 4,
                'points_milestone' => 4000,
                'badge_name' => 'Platinum Leader',
                'badge_slug' => 'platinum-leader',
                'badge_icon' => 'fa-solid fa-star',
                'badge_color' => '#0891b2',
                'badge_bg' => '#ecfeff',
                'badge_border' => '#a5f3fc',
                'badge_gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                'badge_description' => 'Unlocked at 4,000 Points. Demonstrating outstanding leadership in career guidance.',
            ],
            5 => [
                'tier_level' => 5,
                'points_milestone' => 5000,
                'badge_name' => 'Diamond Master',
                'badge_slug' => 'diamond-master',
                'badge_icon' => 'fa-solid fa-gem',
                'badge_color' => '#7c3aed',
                'badge_bg' => '#f5f3ff',
                'badge_border' => '#ddd6fe',
                'badge_gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                'badge_description' => 'Unlocked at 5,000 Points. Half-way to 10k! Exceptional dedication and peer influence.',
            ],
            6 => [
                'tier_level' => 6,
                'points_milestone' => 6000,
                'badge_name' => 'Crown Ambassador',
                'badge_slug' => 'crown-ambassador',
                'badge_icon' => 'fa-solid fa-crown',
                'badge_color' => '#db2777',
                'badge_bg' => '#fdf2f8',
                'badge_border' => '#fbcfe8',
                'badge_gradient' => 'linear-gradient(135deg, #ec4899, #db2777)',
                'badge_description' => 'Unlocked at 6,000 Points. Official student community ambassador across Maharashtra.',
            ],
            7 => [
                'tier_level' => 7,
                'points_milestone' => 7000,
                'badge_name' => 'Elite Pioneer',
                'badge_slug' => 'elite-pioneer',
                'badge_icon' => 'fa-solid fa-fire',
                'badge_color' => '#ea580c',
                'badge_bg' => '#fff7ed',
                'badge_border' => '#fed7aa',
                'badge_gradient' => 'linear-gradient(135deg, #f97316, #ea580c)',
                'badge_description' => 'Unlocked at 7,000 Points. Blazing a trail of academic curiosity and peer mentorship.',
            ],
            8 => [
                'tier_level' => 8,
                'points_milestone' => 8000,
                'badge_name' => 'Grand Mentor',
                'badge_slug' => 'grand-mentor',
                'badge_icon' => 'fa-solid fa-bolt',
                'badge_color' => '#e11d48',
                'badge_bg' => '#fff1f2',
                'badge_border' => '#fecdd3',
                'badge_gradient' => 'linear-gradient(135deg, #f43f5e, #e11d48)',
                'badge_description' => 'Unlocked at 8,000 Points. Pillar of our platform helping dozens find career direction.',
            ],
            9 => [
                'tier_level' => 9,
                'points_milestone' => 9000,
                'badge_name' => 'Apex Vanguard',
                'badge_slug' => 'apex-vanguard',
                'badge_icon' => 'fa-solid fa-shield-halved',
                'badge_color' => '#059669',
                'badge_bg' => '#ecfdf5',
                'badge_border' => '#a7f3d0',
                'badge_gradient' => 'linear-gradient(135deg, #10b981, #059669)',
                'badge_description' => 'Unlocked at 9,000 Points. Standing in the top 0.1% of all registered students.',
            ],
            10 => [
                'tier_level' => 10,
                'points_milestone' => 10000,
                'badge_name' => 'Hall of Fame Titan',
                'badge_slug' => 'hall-of-fame-titan',
                'badge_icon' => 'fa-solid fa-dragon',
                'badge_color' => '#4f46e5',
                'badge_bg' => '#eef2ff',
                'badge_border' => '#c7d2fe',
                'badge_gradient' => 'linear-gradient(135deg, #6366f1, #4f46e5)',
                'badge_description' => 'Unlocked at 10,000 Points. Inducted permanently into the CareerGyan Hall of Fame.',
            ],
        ];
    }

    /**
     * Get or dynamically compute definition for any tier (every 1000 points).
     */
    public function getBadgeDefinitionForTier(int $tier): array
    {
        $defs = $this->getBadgeDefinitions();
        if (isset($defs[$tier])) {
            return $defs[$tier];
        }

        $milestone = $tier * 1000;
        return [
            'tier_level' => $tier,
            'points_milestone' => $milestone,
            'badge_name' => 'Titan Tier ' . $tier,
            'badge_slug' => 'titan-tier-' . $tier,
            'badge_icon' => 'fa-solid fa-crown',
            'badge_color' => '#4f46e5',
            'badge_bg' => '#eef2ff',
            'badge_border' => '#c7d2fe',
            'badge_gradient' => 'linear-gradient(135deg, #6366f1, #4f46e5)',
            'badge_description' => 'Unlocked at ' . number_format($milestone) . ' Points. Unstoppable legend of CareerGyan.',
        ];
    }

    /**
     * Sync user's earned badges in database according to their points.
     * Awards 1 badge for every 1,000 points achieved.
     */
    public function syncUserMilestoneBadges(User $user): array
    {
        $user = User::where('id', $user->id)->first();
        if (!$user) {
            return [];
        }

        $totalEarned = (int) PointTransaction::where('user_id', $user->id)
            ->where('points', '>', 0)
            ->sum('points');

        $qualifyingPoints = max((int) $user->points_balance, $totalEarned);
        $earnedTiersCount = intdiv($qualifyingPoints, 1000);

        $newlyUnlocked = [];

        for ($tier = 1; $tier <= $earnedTiersCount; $tier++) {
            $existing = UserBadge::where('user_id', $user->id)
                ->where('tier_level', $tier)
                ->first();

            if (!$existing) {
                $def = $this->getBadgeDefinitionForTier($tier);
                $badge = UserBadge::create([
                    'user_id' => $user->id,
                    'tier_level' => $tier,
                    'points_milestone' => $def['points_milestone'],
                    'badge_name' => $def['badge_name'],
                    'badge_slug' => $def['badge_slug'],
                    'badge_icon' => $def['badge_icon'],
                    'badge_color' => $def['badge_color'],
                    'badge_bg' => $def['badge_bg'],
                    'badge_description' => $def['badge_description'],
                    'unlocked_at' => now(),
                ]);
                $newlyUnlocked[] = $badge;
            }
        }

        return $newlyUnlocked;
    }

    /**
     * Get full badge summary and showcase data for user rewards page.
     */
    public function getUserBadgeSummary(User $user): array
    {
        $this->syncUserMilestoneBadges($user);

        $totalEarned = (int) PointTransaction::where('user_id', $user->id)
            ->where('points', '>', 0)
            ->sum('points');

        $qualifyingPoints = max((int) $user->points_balance, $totalEarned);
        $currentTierLevel = intdiv($qualifyingPoints, 1000);

        $unlockedBadges = UserBadge::where('user_id', $user->id)
            ->orderBy('tier_level', 'asc')
            ->get();

        $currentBadge = $currentTierLevel >= 1 ? $this->getBadgeDefinitionForTier($currentTierLevel) : null;
        $nextTierLevel = $currentTierLevel + 1;
        $nextBadge = $this->getBadgeDefinitionForTier($nextTierLevel);

        $pointsInCurrentTier = $qualifyingPoints % 1000;
        $progressPercent = min(100, round(($pointsInCurrentTier / 1000) * 100));
        $pointsNeeded = 1000 - $pointsInCurrentTier;

        $maxDisplayTier = max(10, $currentTierLevel + 2);
        $unlockedMap = $unlockedBadges->keyBy('tier_level');

        $displayTiers = [];
        for ($t = 1; $t <= $maxDisplayTier; $t++) {
            $def = $this->getBadgeDefinitionForTier($t);
            $isUnlocked = isset($unlockedMap[$t]) || ($t <= $currentTierLevel);
            $unlockedAt = isset($unlockedMap[$t]) ? $unlockedMap[$t]->unlocked_at : null;

            $displayTiers[] = array_merge($def, [
                'is_unlocked' => $isUnlocked,
                'unlocked_at' => $unlockedAt,
                'is_current' => ($t === $currentTierLevel),
                'is_next' => ($t === $nextTierLevel),
            ]);
        }

        return [
            'qualifying_points' => $qualifyingPoints,
            'badges_earned_count' => $currentTierLevel,
            'current_badge' => $currentBadge,
            'next_badge' => $nextBadge,
            'points_in_tier' => $pointsInCurrentTier,
            'points_needed' => $pointsNeeded,
            'progress_percent' => $progressPercent,
            'unlocked_badges' => $unlockedBadges,
            'display_tiers' => $displayTiers,
        ];
    }
}


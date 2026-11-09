<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Referral;
use App\Models\PointTransaction;
use App\Services\RewardPointsService;

class RewardPointsController extends Controller
{
    protected RewardPointsService $rewardService;

    public function __construct(RewardPointsService $rewardService)
    {
        $this->rewardService = $rewardService;
    }

    /**
     * Display the My Rewards & Points Wallet dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ensure user has a referral code
        if (!$user->referral_code) {
            $user->referral_code = $this->rewardService->generateUniqueReferralCode($user);
            $user->save();
        }

        // Wallet and Referral Statistics
        $stats = $this->rewardService->getUserWalletStats($user);

        // Milestone Badges Summary (Every 1,000 points)
        $badgeSummary = $this->rewardService->getUserBadgeSummary($user);

        // User's Referrals (only display safe public data for privacy)
        $referrals = Referral::with('referredUser:id,name,first_name,last_name,created_at')
            ->where('referrer_id', $user->id)
            ->latest()
            ->get();

        // Points Transactions with optional filtering
        $filter = $request->query('filter', 'all');
        $query = PointTransaction::where('user_id', $user->id);

        if ($filter === 'referral') {
            $query->whereIn('transaction_type', ['referral_bonus', 'referred_signup']);
        } elseif ($filter === 'aptitude') {
            $query->where('transaction_type', 'aptitude_test');
        } elseif ($filter === 'student_analysis') {
            $query->where('transaction_type', 'student_analysis');
        } elseif ($filter === 'adjustment') {
            $query->where('transaction_type', 'admin_adjustment');
        }

        $transactions = $query->latest()->paginate(15)->withQueryString();

        return view('rewards.index', compact('user', 'stats', 'referrals', 'transactions', 'filter', 'badgeSummary'));
    }
}


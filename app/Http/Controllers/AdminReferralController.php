<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Referral;
use App\Models\PointTransaction;
use App\Models\RewardClaim;
use App\Services\RewardPointsService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminReferralController extends Controller
{
    protected RewardPointsService $rewardService;

    public function __construct(RewardPointsService $rewardService)
    {
        $this->rewardService = $rewardService;
    }

    /**
     * Admin Overview Dashboard & All Referrals Table
     */
    public function index(Request $request)
    {
        // 1. Dynamic Summary Metrics
        $totalUsers = User::count();
        $totalReferralLinks = User::whereNotNull('referral_code')->where('referral_code', '!=', '')->count();
        $totalSuccessfulReferrals = Referral::where('status', 'completed')->count();
        $totalPendingReferrals = Referral::where('status', 'pending')->count();
        $totalReferralPointsDistributed = (int) PointTransaction::whereIn('transaction_type', ['referral_bonus', 'referred_signup'])
            ->where('points', '>', 0)
            ->sum('points');
        $totalAptitudeRewards = (int) PointTransaction::where('transaction_type', 'aptitude_test')->sum('points');
        $totalStudentAnalysisRewards = (int) PointTransaction::where('transaction_type', 'student_analysis')->sum('points');
        $totalPointsDistributed = (int) PointTransaction::where('points', '>', 0)->sum('points');

        // 2. All Referrals Query with Search, Filters, and Sorting
        $query = Referral::with(['referrer', 'referredUser']);

        // Search by student name, email, referral code or ID
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('referral_code', 'like', "%{$search}%")
                  ->orWhereHas('referrer', function ($rq) use ($search) {
                      $rq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('id', $search);
                  })
                  ->orWhereHas('referredUser', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('id', $search);
                  });
            });
        }

        // Filter by referral status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->query('sort', 'desc');
        $query->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

        $referrals = $query->paginate(20)->withQueryString();

        return view('admin.referrals.index', compact(
            'totalUsers',
            'totalReferralLinks',
            'totalSuccessfulReferrals',
            'totalPendingReferrals',
            'totalReferralPointsDistributed',
            'totalAptitudeRewards',
            'totalStudentAnalysisRewards',
            'totalPointsDistributed',
            'referrals'
        ));
    }

    /**
     * Interactive Referral Genealogy / Tree Tracking
     */
    public function tree(Request $request)
    {
        $search = $request->query('search');
        $rootUserId = $request->query('user_id');

        $treeData = $this->rewardService->getReferralTreeData(
            $rootUserId ? (int) $rootUserId : null,
            $search ? trim($search) : null
        );

        $allUsersList = User::select('id', 'name', 'email', 'referral_code')
            ->orderBy('name')
            ->take(100)
            ->get();

        return view('admin.referrals.tree', compact('treeData', 'search', 'allUsersList'));
    }

    /**
     * User Reward Management: Search, View Details & Manual Adjustments
     */
    public function userRewards(Request $request)
    {
        $search = $request->query('search');
        $selectedUser = null;

        if ($search) {
            $selectedUser = User::where('id', $search)
                ->orWhere('email', $search)
                ->orWhere('referral_code', strtoupper($search))
                ->orWhere('name', 'like', "%{$search}%")
                ->first();
        }

        if (!$selectedUser && $request->filled('user_id')) {
            $selectedUser = User::find($request->user_id);
        }

        if (!$selectedUser) {
            $selectedUser = User::latest()->first();
        }

        $userDetails = null;
        if ($selectedUser) {
            $directReferralsCount = User::where('referred_by', $selectedUser->id)->count();
            
            // Total descendants in referral chain
            $descendantsCount = $this->calculateTotalDescendants($selectedUser->id);

            $walletStats = $this->rewardService->getUserWalletStats($selectedUser);

            $transactions = PointTransaction::where('user_id', $selectedUser->id)
                ->latest()
                ->paginate(15)
                ->withQueryString();

            $userDetails = [
                'user' => $selectedUser,
                'direct_referrals' => $directReferralsCount,
                'chain_members' => $descendantsCount,
                'stats' => $walletStats,
                'transactions' => $transactions,
            ];
        }

        return view('admin.referrals.user-rewards', compact('userDetails', 'search'));
    }

    /**
     * AJAX Endpoint for User Quick Preview in Tree Modal
     */
    public function userDetailsJson($id)
    {
        $user = User::with('referrer')->findOrFail($id);
        $directReferrals = User::where('referred_by', $user->id)->count();
        $descendants = $this->calculateTotalDescendants($user->id);
        $stats = $this->rewardService->getUserWalletStats($user);
        $recentTransactions = PointTransaction::where('user_id', $user->id)->latest()->take(5)->get();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'referral_code' => $user->referral_code,
            'referred_by' => $user->referrer ? $user->referrer->name . ' (' . $user->referrer->email . ')' : 'None (Direct)',
            'direct_referrals' => $directReferrals,
            'chain_members' => $descendants,
            'points_balance' => (int) $user->points_balance,
            'total_earned' => $stats['total_earned_points'],
            'aptitude_claimed' => $stats['aptitude_claimed'],
            'analysis_claimed' => $stats['analysis_claimed'],
            'created_at' => $user->created_at ? $user->created_at->format('d M Y') : 'N/A',
            'recent_transactions' => $recentTransactions,
        ]);
    }

    /**
     * Handle Admin Manual Point Adjustments (+ / - points)
     */
    public function adjustPoints(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|in:add,deduct',
            'points' => 'required|integer|min:1|max:100000',
            'reason' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);
        $points = (int) $request->points;
        if ($request->action === 'deduct') {
            $points = -$points;
        }

        $adminId = session('admin_id') ?? 1;

        $this->rewardService->adjustUserPoints($user, $points, $request->reason, $adminId);

        return back()->with('success', 'Points adjusted successfully for ' . $user->name . '.');
    }

    /**
     * Export All Referrals to CSV
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $fileName = 'careergyan_referrals_' . date('Y-m-d_His') . '.csv';

        $query = Referral::with(['referrer', 'referredUser'])->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, [
                'Referral ID',
                'Referrer Name',
                'Referrer Email',
                'Referrer User ID',
                'Referral Code',
                'Referred Student Name',
                'Referred Student Email',
                'Referred Student User ID',
                'Registration Date',
                'Referral Status',
                'Referrer Reward (PTS)',
                'Referred User Reward (PTS)',
                'Completed Date',
            ]);

            $query->chunk(200, function ($referrals) use ($handle) {
                foreach ($referrals as $ref) {
                    fputcsv($handle, [
                        $ref->id,
                        $ref->referrer->name ?? 'N/A',
                        $ref->referrer->email ?? 'N/A',
                        $ref->referrer_id,
                        $ref->referral_code,
                        $ref->referredUser->name ?? 'N/A',
                        $ref->referredUser->email ?? 'N/A',
                        $ref->referred_user_id,
                        $ref->created_at ? $ref->created_at->format('Y-m-d H:i:s') : 'N/A',
                        ucfirst($ref->status),
                        $ref->referrer_points,
                        $ref->referred_user_points,
                        $ref->completed_at ? $ref->completed_at->format('Y-m-d H:i:s') : 'N/A',
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Admin Reports & Analytics
     */
    public function reports()
    {
        // 1. Top Referrers Leaderboard
        $topReferrers = User::withCount(['successfulReferrals'])
            ->having('successful_referrals_count', '>', 0)
            ->orderByDesc('successful_referrals_count')
            ->take(10)
            ->get();

        // 2. Activity Distribution
        $activityStats = [
            'referrals' => (int) PointTransaction::whereIn('transaction_type', ['referral_bonus', 'referred_signup'])->sum('points'),
            'aptitude' => (int) PointTransaction::where('transaction_type', 'aptitude_test')->sum('points'),
            'student_analysis' => (int) PointTransaction::where('transaction_type', 'student_analysis')->sum('points'),
            'adjustments' => (int) PointTransaction::where('transaction_type', 'admin_adjustment')->where('points', '>', 0)->sum('points'),
        ];

        // 3. Last 7 Days Referrals Trend
        $dates = [];
        $trendCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('d M');
            $trendCounts[] = Referral::whereDate('created_at', $day)->count();
        }

        // 4. Referral Conversion Metrics
        $totalInvited = Referral::count();
        $totalCompleted = Referral::where('status', 'completed')->count();
        $conversionRate = $totalInvited > 0 ? round(($totalCompleted / $totalInvited) * 100, 1) : 0;

        return view('admin.referrals.reports', compact(
            'topReferrers',
            'activityStats',
            'dates',
            'trendCounts',
            'totalInvited',
            'totalCompleted',
            'conversionRate'
        ));
    }

    /**
     * Helper to recursively count descendants in a referral tree.
     */
    protected function calculateTotalDescendants($userId, $currentDepth = 1, $maxDepth = 6): int
    {
        if ($currentDepth > $maxDepth) {
            return 0;
        }

        $children = User::where('referred_by', $userId)->where('id', '!=', $userId)->pluck('id');
        $count = $children->count();

        foreach ($children as $childId) {
            $count += $this->calculateTotalDescendants($childId, $currentDepth + 1, $maxDepth);
        }

        return $count;
    }
}


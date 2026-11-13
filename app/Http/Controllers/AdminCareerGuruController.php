<?php

namespace App\Http\Controllers;

use App\Models\CareerGuru;
use App\Models\CareerGuruLead;
use App\Models\CareerGuruLeadActivity;
use App\Models\CareerGuruCommission;
use App\Models\CareerGuruSetting;
use App\Models\User;
use App\Services\CareerGuruService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminCareerGuruController extends Controller
{
    /**
     * Admin check middleware / session enforcement.
     */
    protected function checkAdminAuth()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Sub-section B: All CareerGuru Accounts Table & Overview
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status', 'all');

        $query = CareerGuru::withCount(['leads', 'registeredStudents', 'commissions'])->latest();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('guru_id', 'like', "%{$search}%")
                  ->orWhere('referral_code', 'like', "%{$search}%");
            });
        }

        if ($status !== 'all' && in_array($status, ['active', 'inactive', 'revoked'])) {
            $query->where('status', $status);
        }

        $gurus = $query->paginate(15)->withQueryString();

        // Platform-wide Summary Stats
        $totalGurus = CareerGuru::count();
        $activeGurus = CareerGuru::where('status', 'active')->count();
        $totalLeads = CareerGuruLead::count();
        $totalRegistered = User::whereNotNull('careerguru_id')->count();
        $totalPremiumConversions = CareerGuruCommission::whereIn('status', ['approved', 'paid'])->count();
        $totalCommissionEarned = (float) CareerGuruCommission::whereIn('status', ['approved', 'paid'])->sum('commission_amount');
        $totalCommissionPaid = (float) CareerGuruCommission::where('status', 'paid')->sum('commission_amount');
        $pendingCommissionLiability = (float) CareerGuruCommission::where('status', 'pending')->sum('commission_amount');

        return view('admin.careerguru.index', compact(
            'gurus',
            'search',
            'status',
            'totalGurus',
            'activeGurus',
            'totalLeads',
            'totalRegistered',
            'totalPremiumConversions',
            'totalCommissionEarned',
            'totalCommissionPaid',
            'pendingCommissionLiability'
        ));
    }

    /**
     * Sub-section A: Form to Create a CareerGuru Account
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $defaultCommission = (float) CareerGuruSetting::get('default_commission_percentage', 20.00);

        return view('admin.careerguru.create', compact('defaultCommission'));
    }

    /**
     * Store new CareerGuru account.
     */
    public function store(Request $request, CareerGuruService $service)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:careergurus,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'commission_type' => 'nullable|in:percentage,fixed',
            'commission_value' => 'nullable|numeric|min:0',
            'commission_percentage' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string|max:2000',
        ]);

        $guruId = $service->generateGuruId();
        $referralCode = $service->generateReferralCode($request->name);
        $plainPassword = $request->password;

        $commType = $request->input('commission_type', 'percentage');
        $commVal = $request->input('commission_value', $request->input('commission_percentage', 20.00));

        $guru = CareerGuru::create([
            'guru_id' => $guruId,
            'name' => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'phone' => trim($request->phone),
            'password' => Hash::make($plainPassword),
            'referral_code' => $referralCode,
            'commission_type' => $commType,
            'commission_value' => $commVal,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.careergurus.index')
            ->with('new_guru_created', [
                'guru_id' => $guru->guru_id,
                'name' => $guru->name,
                'email' => $guru->email,
                'password' => $plainPassword,
                'referral_code' => $guru->referral_code,
                'referral_url' => $guru->referral_url,
                'login_url' => route('careerguru.login'),
            ])
            ->with('success', "CareerGuru partner account for '{$guru->name}' was created successfully.");
    }

    /**
     * Sub-section C: Individual CareerGuru Performance Tracking & Profile Page
     */
    public function show($id, Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);

        // Date Filter
        $dateFilter = $request->query('date_range', '30_days');
        $customStart = $request->query('start_date');
        $customEnd = $request->query('end_date');

        $now = Carbon::now();
        $startDate = match ($dateFilter) {
            'today' => $now->copy()->startOfDay(),
            '7_days' => $now->copy()->subDays(7)->startOfDay(),
            '30_days' => $now->copy()->subDays(30)->startOfDay(),
            'this_month' => $now->copy()->startOfMonth(),
            'last_month' => $now->copy()->subMonth()->startOfMonth(),
            'custom' => !empty($customStart) ? Carbon::parse($customStart)->startOfDay() : $now->copy()->subDays(30)->startOfDay(),
            default => $now->copy()->subDays(30)->startOfDay(),
        };

        $endDate = match ($dateFilter) {
            'last_month' => $now->copy()->subMonth()->endOfMonth(),
            'custom' => !empty($customEnd) ? Carbon::parse($customEnd)->endOfDay() : $now->copy()->endOfDay(),
            default => $now->copy()->endOfDay(),
        };

        // Filtered Metrics
        $filteredLeadsCount = $guru->leads()->whereBetween('created_at', [$startDate, $endDate])->count();
        $filteredRegistrationsCount = $guru->registeredStudents()->whereBetween('careerguru_registered_at', [$startDate, $endDate])->count();
        $filteredPremiumCount = $guru->commissions()->whereIn('status', ['approved', 'paid'])->whereBetween('created_at', [$startDate, $endDate])->count();
        $filteredRevenueGenerated = (float) $guru->commissions()->whereIn('status', ['approved', 'paid'])->whereBetween('created_at', [$startDate, $endDate])->sum('membership_amount');
        $filteredCommissionEarned = (float) $guru->commissions()->whereIn('status', ['approved', 'paid'])->whereBetween('created_at', [$startDate, $endDate])->sum('commission_amount');

        // All-Time Metrics
        $totalLeads = $guru->totalLeadsCount();
        $totalRegistrations = $guru->registeredCount();
        $totalPremium = $guru->premiumCount();
        $totalRevenue = (float) $guru->commissions()->whereIn('status', ['approved', 'paid'])->sum('membership_amount');
        $totalCommissionEarned = $guru->totalCommissionEarned();
        $totalCommissionPaid = $guru->paidCommission();
        $pendingCommission = $guru->pendingCommission();

        $leadConversionRate = $guru->leadConversionRate();
        $regToPremiumRate = $guru->registrationToPremiumRate();

        // Monthly trends for chart (last 6 months)
        $chartMonths = [];
        $monthlyLeads = [];
        $monthlyRegistrations = [];
        $monthlyConversions = [];
        $monthlyCommissions = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $chartMonths[] = $monthDate->format('M Y');
            $mStart = $monthDate->copy()->startOfMonth();
            $mEnd = $monthDate->copy()->endOfMonth();

            $monthlyLeads[] = $guru->leads()->whereBetween('created_at', [$mStart, $mEnd])->count();
            $monthlyRegistrations[] = $guru->registeredStudents()->whereBetween('careerguru_registered_at', [$mStart, $mEnd])->count();
            $monthlyConversions[] = $guru->commissions()->whereIn('status', ['approved', 'paid'])->whereBetween('created_at', [$mStart, $mEnd])->count();
            $monthlyCommissions[] = (float) $guru->commissions()->whereIn('status', ['approved', 'paid'])->whereBetween('created_at', [$mStart, $mEnd])->sum('commission_amount');
        }

        // Recent leads and commissions for this guru
        $leads = $guru->leads()->latest()->take(10)->get();
        $commissions = $guru->commissions()->with('studentUser')->latest()->take(10)->get();

        return view('admin.careerguru.show', compact(
            'guru',
            'dateFilter',
            'startDate',
            'endDate',
            'filteredLeadsCount',
            'filteredRegistrationsCount',
            'filteredPremiumCount',
            'filteredRevenueGenerated',
            'filteredCommissionEarned',
            'totalLeads',
            'totalRegistrations',
            'totalPremium',
            'totalRevenue',
            'totalCommissionEarned',
            'totalCommissionPaid',
            'pendingCommission',
            'leadConversionRate',
            'regToPremiumRate',
            'chartMonths',
            'monthlyLeads',
            'monthlyRegistrations',
            'monthlyConversions',
            'monthlyCommissions',
            'leads',
            'commissions'
        ));
    }

    /**
     * Edit CareerGuru Details.
     */
    public function edit($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);
        return view('admin.careerguru.edit', compact('guru'));
    }

    /**
     * Update CareerGuru Details.
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:careergurus,email,' . $guru->id,
            'phone' => 'required|string|max:20',
            'commission_type' => 'nullable|in:percentage,fixed',
            'commission_value' => 'nullable|numeric|min:0',
            'commission_percentage' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive,revoked',
            'payout_upi_id' => 'nullable|string|max:255',
            'payout_bank_details' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        if (isset($validated['commission_percentage']) && !isset($validated['commission_value'])) {
            $validated['commission_value'] = $validated['commission_percentage'];
        }
        if (!isset($validated['commission_type'])) {
            $validated['commission_type'] = 'percentage';
        }

        $guru->update($validated);

        return redirect()->route('admin.careergurus.show', $guru->id)
            ->with('success', 'CareerGuru partner details updated successfully.');
    }

    /**
     * Admin Password Reset for CareerGuru.
     */
    public function resetPassword(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $guru->update(['password' => Hash::make($request->password)]);

        return back()->with('success', "Password for {$guru->name} has been updated successfully.");
    }

    /**
     * Toggle CareerGuru status (Activate / Deactivate).
     */
    public function toggleStatus(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);
        $newStatus = $guru->status === 'active' ? 'inactive' : 'active';
        $guru->update(['status' => $newStatus]);

        $verb = $newStatus === 'active' ? 'activated' : 'deactivated';
        return back()->with('success', "CareerGuru '{$guru->name}' has been {$verb}.");
    }

    /**
     * Revoke CareerGuru partner access.
     */
    public function revokeAccess(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);
        $guru->update(['status' => 'revoked']);

        return back()->with('success', "Access for CareerGuru '{$guru->name}' has been permanently revoked. Historical records remain preserved.");
    }

    /**
     * Sub-section D: Centralized Table of All Student Leads
     */
    public function allLeads(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $query = CareerGuruLead::with(['careerguru', 'registeredUser'])->latest();

        // Search
        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('student_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('city', 'like', "%{$s}%");
            });
        }

        // Filter by CareerGuru
        if ($request->filled('careerguru_id') && $request->careerguru_id !== 'all') {
            $query->where('careerguru_id', $request->careerguru_id);
        }

        // Filter by Standard
        if ($request->filled('standard') && $request->standard !== 'all') {
            $query->where('standard', $request->standard);
        }

        // Filter by Lead Status
        if ($request->filled('lead_status') && $request->lead_status !== 'all') {
            $query->where('lead_status', $request->lead_status);
        }

        // Filter by Registration Status
        if ($request->filled('reg_status') && $request->reg_status !== 'all') {
            if ($request->reg_status === 'registered') {
                $query->whereNotNull('registered_user_id');
            } elseif ($request->reg_status === 'not_registered') {
                $query->whereNull('registered_user_id');
            }
        }

        $leads = $query->paginate(20)->withQueryString();

        $allGurus = CareerGuru::select('id', 'guru_id', 'name')->orderBy('name')->get();
        $standards = CareerGuruLead::STANDARDS;
        $statuses = CareerGuruLead::STATUSES;

        return view('admin.careerguru.leads', compact('leads', 'allGurus', 'standards', 'statuses'));
    }

    /**
     * View lead details modal / page for admin.
     */
    public function leadDetails($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $lead = CareerGuruLead::with(['careerguru', 'registeredUser', 'activities', 'commissions'])->findOrFail($id);
        return view('admin.careerguru.lead-details', compact('lead'));
    }

    /**
     * Sub-section E: Centralized Premium Conversion & Commission Management
     */
    public function commissions(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $query = CareerGuruCommission::with(['careerguru', 'studentUser', 'lead', 'membership'])->latest();

        // Search
        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('payment_id', 'like', "%{$s}%")
                  ->orWhere('payment_reference', 'like', "%{$s}%")
                  ->orWhereHas('studentUser', function ($sq) use ($s) {
                      $sq->where('name', 'like', "%{$s}%")
                         ->orWhere('email', 'like', "%{$s}%")
                         ->orWhere('phone', 'like', "%{$s}%");
                  })
                  ->orWhereHas('careerguru', function ($gq) use ($s) {
                      $gq->where('name', 'like', "%{$s}%")
                         ->orWhere('guru_id', 'like', "%{$s}%");
                  });
            });
        }

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by Guru
        if ($request->filled('careerguru_id') && $request->careerguru_id !== 'all') {
            $query->where('careerguru_id', $request->careerguru_id);
        }

        $commissions = $query->paginate(20)->withQueryString();

        // Metric Totals
        $pendingCount = CareerGuruCommission::where('status', 'pending')->count();
        $pendingAmount = (float) CareerGuruCommission::where('status', 'pending')->sum('commission_amount');
        $approvedAmount = (float) CareerGuruCommission::where('status', 'approved')->sum('commission_amount');
        $paidAmount = (float) CareerGuruCommission::where('status', 'paid')->sum('commission_amount');
        $allGurus = CareerGuru::select('id', 'guru_id', 'name')->orderBy('name')->get();

        return view('admin.careerguru.commissions', compact(
            'commissions',
            'pendingCount',
            'pendingAmount',
            'approvedAmount',
            'paidAmount',
            'allGurus'
        ));
    }

    /**
     * Approve pending commission.
     */
    public function approveCommission(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $commission = CareerGuruCommission::findOrFail($id);
        $commission->status = 'approved';
        $commission->approved_at = now();
        $commission->admin_remarks = $request->input('remarks', $commission->admin_remarks);
        $commission->save();

        return back()->with('success', "Commission #{$commission->id} for ₹{$commission->commission_amount} approved successfully.");
    }

    /**
     * Reject commission with reason.
     */
    public function rejectCommission(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate(['reason' => 'required|string|max:500']);

        $commission = CareerGuruCommission::findOrFail($id);
        $commission->status = 'rejected';
        $commission->rejection_reason = $request->reason;
        $commission->admin_remarks = $request->remarks ?? 'Rejected by Admin';
        $commission->save();

        return back()->with('success', "Commission #{$commission->id} marked as rejected.");
    }

    /**
     * Mark commission payout as paid.
     */
    public function markCommissionPaid(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate([
            'payment_reference' => 'required|string|max:255',
            'paid_at' => 'required|date',
            'admin_remarks' => 'nullable|string|max:500',
        ]);

        $commission = CareerGuruCommission::findOrFail($id);
        $commission->status = 'paid';
        $commission->paid_at = Carbon::parse($request->paid_at);
        $commission->payment_reference = trim($request->payment_reference);
        $commission->admin_remarks = $request->admin_remarks;
        if (!$commission->approved_at) {
            $commission->approved_at = now();
        }
        $commission->save();

        return back()->with('success', "Commission #{$commission->id} (₹{$commission->commission_amount}) recorded as paid.");
    }

    /**
     * Sub-section F: Admin Commission Settings
     */
    public function settings()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $defaultPercentage = (float) CareerGuruSetting::get('default_commission_percentage', 20.00);
        $minPayout = (float) CareerGuruSetting::get('minimum_payout_amount', 500.00);
        $payoutInstructions = CareerGuruSetting::get('payout_instructions', 'Payouts are processed weekly via UPI or IMPS/NEFT bank transfer.');

        // Total Commission Liability
        $unpaidLiability = (float) CareerGuruCommission::whereIn('status', ['pending', 'approved'])->sum('commission_amount');
        $approvedUnpaid = (float) CareerGuruCommission::where('status', 'approved')->sum('commission_amount');
        $totalPaidOut = (float) CareerGuruCommission::where('status', 'paid')->sum('commission_amount');

        return view('admin.careerguru.settings', compact(
            'defaultPercentage',
            'minPayout',
            'payoutInstructions',
            'unpaidLiability',
            'approvedUnpaid',
            'totalPaidOut'
        ));
    }

    /**
     * Update Admin Commission Settings.
     */
    public function updateSettings(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate([
            'default_commission_percentage' => 'required|numeric|min:0|max:100',
            'minimum_payout_amount' => 'required|numeric|min:0',
            'payout_instructions' => 'nullable|string|max:2000',
        ]);

        CareerGuruSetting::set('default_commission_percentage', (string) $request->default_commission_percentage);
        CareerGuruSetting::set('minimum_payout_amount', (string) $request->minimum_payout_amount);
        CareerGuruSetting::set('payout_instructions', (string) $request->payout_instructions);

        return back()->with('success', 'CareerGuru program settings updated successfully.');
    }

    /**
     * Performance Comparison Leaderboard across all CareerGurus.
     */
    public function comparison()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $gurus = CareerGuru::withCount(['leads', 'registeredStudents'])
            ->with(['commissions' => function ($q) {
                $q->whereIn('status', ['approved', 'paid']);
            }])
            ->get()
            ->map(function ($guru) {
                $revenue = (float) $guru->commissions->sum('membership_amount');
                $commEarned = (float) $guru->commissions->sum('commission_amount');
                $paid = (float) $guru->commissions->where('status', 'paid')->sum('commission_amount');
                $conversionRate = $guru->leads_count > 0 ? round(($guru->registered_students_count / $guru->leads_count) * 100, 1) : 0;
                $premiumCount = $guru->commissions->count();

                return [
                    'guru' => $guru,
                    'leads_count' => $guru->leads_count,
                    'registered_count' => $guru->registered_students_count,
                    'premium_count' => $premiumCount,
                    'conversion_rate' => $conversionRate,
                    'revenue' => $revenue,
                    'commission_earned' => $commEarned,
                    'commission_paid' => $paid,
                ];
            })
            ->sortByDesc('revenue')
            ->values();

        return view('admin.careerguru.comparison', compact('gurus'));
    }

    /**
     * Export CareerGurus CSV
     */
    public function exportGurus()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $filename = 'careergurus_export_' . date('Y-m-d_His') . '.csv';
        $gurus = CareerGuru::withCount(['leads', 'registeredStudents', 'commissions'])->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($gurus) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Guru ID', 'Name', 'Email', 'Phone', 'Referral Code', 'Commission Type', 'Commission Value', 'Status', 'Total Leads', 'Registered Students', 'Commission Earned (INR)', 'Commission Paid (INR)', 'Created At']);

            foreach ($gurus as $g) {
                fputcsv($handle, [
                    $g->guru_id,
                    $g->name,
                    $g->email,
                    $g->phone,
                    $g->referral_code,
                    $g->commission_type,
                    $g->commission_value,
                    $g->status,
                    $g->leads_count,
                    $g->registered_students_count,
                    $g->totalCommissionEarned(),
                    $g->paidCommission(),
                    $g->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export Leads CSV
     */
    public function exportLeads()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $filename = 'careerguru_student_leads_' . date('Y-m-d_His') . '.csv';
        $leads = CareerGuruLead::with(['careerguru', 'registeredUser'])->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($leads) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Lead ID', 'Student Name', 'Phone', 'Email', 'Standard', 'City', 'School/College', 'Lead Status', 'CareerGuru Name', 'CareerGuru ID', 'CareerGyan User ID', 'Registered At', 'Date Added']);

            foreach ($leads as $l) {
                fputcsv($handle, [
                    $l->id,
                    $l->student_name,
                    $l->phone,
                    $l->email,
                    $l->standard,
                    $l->city ?? 'N/A',
                    $l->school_college ?? 'N/A',
                    $l->lead_status,
                    $l->careerguru->name ?? 'N/A',
                    $l->careerguru->guru_id ?? 'N/A',
                    $l->registered_user_id ?? 'N/A',
                    $l->registered_at ? $l->registered_at->format('Y-m-d H:i:s') : 'Not Registered',
                    $l->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export Commissions CSV
     */
    public function exportCommissions()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $filename = 'careerguru_commissions_' . date('Y-m-d_His') . '.csv';
        $commissions = CareerGuruCommission::with(['careerguru', 'studentUser'])->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($commissions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Commission ID', 'CareerGuru Name', 'Guru ID', 'Student Name', 'Student Email', 'Membership Plan', 'Membership Amount (INR)', 'Commission Rate (%)', 'Commission Amount (INR)', 'Status', 'Payment Reference / UTR', 'Approved At', 'Paid At', 'Created At']);

            foreach ($commissions as $c) {
                fputcsv($handle, [
                    $c->id,
                    $c->careerguru->name ?? 'N/A',
                    $c->careerguru->guru_id ?? 'N/A',
                    $c->studentUser->name ?? 'N/A',
                    $c->studentUser->email ?? 'N/A',
                    $c->membership_plan,
                    $c->membership_amount,
                    $c->commission_rate,
                    $c->commission_amount,
                    $c->status,
                    $c->payment_reference ?? 'N/A',
                    $c->approved_at ? $c->approved_at->format('Y-m-d H:i:s') : 'N/A',
                    $c->paid_at ? $c->paid_at->format('Y-m-d H:i:s') : 'N/A',
                    $c->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete CareerGuru and purge all associated partner data.
     */
    public function destroy($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $guru = CareerGuru::findOrFail($id);
        $name = $guru->name;
        $guruId = $guru->guru_id;

        DB::transaction(function () use ($guru) {
            // 1. Remove attribution from registered users (preserve student user accounts)
            User::where('careerguru_id', $guru->id)->update([
                'careerguru_id' => null,
                'careerguru_registered_at' => null,
            ]);

            // 2. Delete all lead activities
            CareerGuruLeadActivity::where('careerguru_id', $guru->id)->delete();

            // 3. Delete all student leads
            CareerGuruLead::where('careerguru_id', $guru->id)->delete();

            // 4. Delete commissions
            CareerGuruCommission::where('careerguru_id', $guru->id)->delete();

            // 5. Delete password reset tokens
            DB::table('careerguru_password_resets')->where('email', $guru->email)->delete();

            // 6. Delete CareerGuru partner account
            $guru->delete();
        });

        return redirect()->route('admin.careergurus.index')
            ->with('success', "CareerGuru partner '{$name}' ({$guruId}) and all associated partner data have been permanently deleted.");
    }
}

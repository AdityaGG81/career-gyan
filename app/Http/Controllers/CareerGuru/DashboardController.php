<?php

namespace App\Http\Controllers\CareerGuru;

use App\Http\Controllers\Controller;
use App\Models\CareerGuru;
use App\Models\CareerGuruLead;
use App\Models\CareerGuruCommission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Get current authenticated CareerGuru.
     */
    protected function guru(): CareerGuru
    {
        return Auth::guard('careerguru')->user();
    }

    /**
     * CareerGuru Main Dashboard.
     */
    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $guru = $this->guru();

        // 8 Key Statistics
        $totalLeads = $guru->totalLeadsCount();
        $registeredStudents = $guru->registeredCount();
        $notYetRegistered = $guru->notYetRegisteredCount();
        $premiumPurchased = $guru->premiumCount();
        $pendingPremium = $guru->pendingPremiumConversionsCount();
        $totalCommissionEarned = $guru->totalCommissionEarned();
        $pendingCommission = $guru->pendingCommission();
        $totalCommissionPaid = $guru->paidCommission();

        // Conversion Rates
        $leadConversionRate = $guru->leadConversionRate();
        $regToPremiumRate = $guru->registrationToPremiumRate();

        // Recent Activity Lists
        $recentLeads = $guru->leads()->latest()->take(5)->get();
        $recentRegistered = $guru->registeredStudents()->latest('careerguru_registered_at')->take(5)->get();
        $recentPremium = $guru->commissions()->with('studentUser')->latest()->take(5)->get();
        $recentCommissions = $guru->commissions()->latest()->take(6)->get();

        // Monthly Trend Data for Charts (Last 6 months)
        $chartMonths = [];
        $monthlyLeads = [];
        $monthlyRegistrations = [];
        $monthlyConversions = [];
        $monthlyCommissions = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthLabel = $monthDate->format('M Y');
            $start = $monthDate->copy()->startOfMonth();
            $end = $monthDate->copy()->endOfMonth();

            $chartMonths[] = $monthLabel;

            $monthlyLeads[] = $guru->leads()
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $monthlyRegistrations[] = $guru->registeredStudents()
                ->whereBetween('careerguru_registered_at', [$start, $end])
                ->count();

            $monthlyConversions[] = $guru->commissions()
                ->whereIn('status', ['pending', 'approved', 'paid'])
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $monthlyCommissions[] = (float) $guru->commissions()
                ->whereIn('status', ['approved', 'paid'])
                ->whereBetween('created_at', [$start, $end])
                ->sum('commission_amount');
        }

        return view('careerguru.dashboard', compact(
            'guru',
            'totalLeads',
            'registeredStudents',
            'notYetRegistered',
            'premiumPurchased',
            'pendingPremium',
            'totalCommissionEarned',
            'pendingCommission',
            'totalCommissionPaid',
            'leadConversionRate',
            'regToPremiumRate',
            'recentLeads',
            'recentRegistered',
            'recentPremium',
            'recentCommissions',
            'chartMonths',
            'monthlyLeads',
            'monthlyRegistrations',
            'monthlyConversions',
            'monthlyCommissions'
        ));
    }

    /**
     * Referral Link Hub.
     */
    public function referralLink()
    {
        $guru = $this->guru();
        $referralUrl = $guru->referral_url;
        $directSignupUrl = $guru->direct_signup_url;

        // WhatsApp message template
        $whatsappMessage = "Hello! I recommend CareerGyan (careergyan.in) for choosing the right career path, discovering college cutoffs, and taking aptitude assessments. Register for free using my link: " . $referralUrl;
        $whatsappUrl = "https://api.whatsapp.com/send?text=" . urlencode($whatsappMessage);

        return view('careerguru.referral-link', compact('guru', 'referralUrl', 'directSignupUrl', 'whatsappMessage', 'whatsappUrl'));
    }

    /**
     * Send student invitation email.
     */
    public function sendInvite(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'email' => 'required|email',
            'standard' => 'nullable|string',
        ]);

        $guru = $this->guru();
        $email = strtolower(trim($request->email));
        $name = trim($request->student_name);
        $referralUrl = $guru->referral_url;

        // Optionally create as lead if not already present
        $lead = CareerGuruLead::firstOrCreate(
            ['careerguru_id' => $guru->id, 'email' => $email],
            [
                'student_name' => $name,
                'phone' => 'Pending',
                'standard' => $request->input('standard', 'Other'),
                'lead_status' => 'Contacted',
                'additional_notes' => 'Sent invitation email via CareerGuru Referral Portal on ' . now()->format('d M, Y'),
            ]
        );

        try {
            Mail::raw("Dear {$name},\n\nYour CareerGuru mentor, {$guru->name}, has invited you to join CareerGyan — India's premier AI career guidance and college predictor platform.\n\nTake standardized aptitude tests, predict college cutoffs, and chart your career roadmap!\n\nClick here to create your free account:\n{$referralUrl}\n\nBest regards,\nCareerGyan Team", function ($msg) use ($email, $name, $guru) {
                $msg->to($email, $name)
                    ->subject("Invitation from {$guru->name} to join CareerGyan");
            });
            $statusMsg = "Invitation email sent successfully to {$name} ({$email})!";
        } catch (\Throwable $e) {
            $statusMsg = "Lead created, but email could not be delivered. Please share your link directly: " . $referralUrl;
        }

        return back()->with('success', $statusMsg);
    }

    /**
     * CareerGuru Profile & Settings.
     */
    public function profile()
    {
        $guru = $this->guru();
        return view('careerguru.profile', compact('guru'));
    }

    /**
     * Update Profile & Payout Details.
     */
    public function updateProfile(Request $request)
    {
        $guru = $this->guru();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payout_upi_id' => 'nullable|string|max:255',
            'payout_bank_name' => 'nullable|string|max:255',
            'payout_account_number' => 'nullable|string|max:50',
            'payout_ifsc_code' => 'nullable|string|max:20',
            'payout_account_holder_name' => 'nullable|string|max:255',
        ]);

        $bankDetails = [
            'bank_name' => $request->payout_bank_name,
            'account_number' => $request->payout_account_number,
            'ifsc_code' => strtoupper($request->payout_ifsc_code ?? ''),
            'account_holder_name' => $request->payout_account_holder_name,
        ];

        $guru->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'payout_upi_id' => $validated['payout_upi_id'] ?? null,
            'payout_bank_details' => json_encode($bankDetails),
        ]);

        return back()->with('success', 'Profile and payout information updated successfully.');
    }

    /**
     * Change Password.
     */
    public function changePassword(Request $request)
    {
        return $this->updatePassword($request);
    }

    public function updatePassword(Request $request)
    {
        $guru = $this->guru();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, $guru->password)) {
            return back()->withErrors(['current_password' => 'Your current password does not match our records.']);
        }

        $guru->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully!');
    }
}

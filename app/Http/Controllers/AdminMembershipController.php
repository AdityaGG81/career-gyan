<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Membership;
use App\Models\User;

class AdminMembershipController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $plan = MembershipPlan::getDefaultPlan();

        $stats = [
            'active_members' => User::where('is_member', true)->count(),
            'total_transactions' => Membership::count(),
            'active_memberships' => Membership::where('status', 'active')->count(),
            'total_revenue' => (Membership::where('status', 'active')->sum('amount_paid') ?: 0) / 100,
        ];

        $recentMembers = Membership::with('user')
            ->latest()
            ->take(8)
            ->get();

        $registeredUsers = User::select('id', 'name', 'first_name', 'last_name', 'email', 'is_member')
            ->orderBy('email')
            ->get();

        return view('admin.membership.index', compact('plan', 'stats', 'recentMembers', 'registeredUsers'));
    }

    public function update(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'currency_symbol' => 'required|string|max:10',
            'symbol' => 'required|string|max:100',
            'badge_text' => 'nullable|string|max:50',
            'duration_days' => 'required|integer|min:1',
            'billing_period' => 'required|string|max:20',
            'color_theme' => 'nullable|string|max:30',
            'description' => 'nullable|string|max:1000',
            'features' => 'nullable',
            'is_active' => 'nullable',
        ]);

        $plan = MembershipPlan::getDefaultPlan();

        // Convert features from lines or array
        $features = [];
        if (is_array($request->features)) {
            $features = array_values(array_filter(array_map('trim', $request->features)));
        } elseif (is_string($request->features)) {
            $rawLines = preg_split('/\r\n|\r|\n/', $request->features);
            $features = array_values(array_filter(array_map('trim', $rawLines)));
        }

        // Default features if none provided
        if (empty($features)) {
            $features = [
                'Advanced Personality Profiler Test',
                'Career Deep-Dive Roadmaps & Insights',
                'Leadership & Entrepreneurship Assessment',
                'Unlimited AI Chatbot Career Counseling',
                'Private Mentor WhatsApp Group Access',
                '1-on-1 Direct Career Session Booking',
                'Premium PDF Downloadable Reports',
                'Gold Pro Badge on Leaderboards'
            ];
        }

        $priceInPaise = (int) round($request->price * 100);
        $originalPriceInPaise = $request->filled('original_price') ? (int) round($request->original_price * 100) : null;

        $plan->update([
            'name' => $request->name,
            'price' => $priceInPaise,
            'original_price' => $originalPriceInPaise,
            'currency_symbol' => $request->currency_symbol ?: '₹',
            'symbol' => $request->symbol ?: 'fa-solid fa-crown',
            'badge_text' => $request->badge_text ?: 'MOST POPULAR',
            'duration_days' => (int) $request->duration_days,
            'billing_period' => $request->billing_period ?: 'yr',
            'color_theme' => $request->color_theme ?: 'amber',
            'description' => $request->description,
            'features' => $features,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : false,
        ]);

        return redirect()->route('admin.membership.index')
            ->with('success', 'Premium Membership settings, amount, and symbol updated successfully!');
    }

    /**
     * Grant premium membership directly to any email from the admin panel.
     */
    public function grant(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'email' => 'required|email|max:255',
            'duration_days' => 'nullable|integer|min:1',
            'is_lifetime' => 'nullable|boolean',
            'admin_note' => 'nullable|string|max:255',
        ]);

        $email = trim(strtolower($request->email));
        $user = User::where('email', $email)->first();

        // If user does not exist yet, auto-create an account so when they register or login, Pro is already active
        if (!$user) {
            $parts = explode('@', $email);
            $firstName = ucwords(str_replace(['.', '_', '-'], ' ', $parts[0]));
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => '',
                'name' => $firstName,
                'email' => $email,
                'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(16)),
                'is_member' => true,
            ]);
        }

        $plan = MembershipPlan::getDefaultPlan();
        $isLifetime = (bool) $request->input('is_lifetime', false);
        $durationDays = $isLifetime ? null : (int) $request->input('duration_days', $plan->duration_days ?: 365);
        $expiresAt = $durationDays ? now()->addDays($durationDays) : null;

        $user->is_member = true;
        $user->membership_expires_at = $expiresAt;
        $user->save();

        // Create a transaction record in memberships table for auditing
        $note = $request->input('admin_note') ?: 'Granted manually via Admin Panel';
        Membership::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'razorpay_order_id' => 'admin_grant_' . uniqid(),
            'razorpay_payment_id' => 'admin_manual_' . uniqid(),
            'razorpay_signature' => 'admin_memo: ' . substr($note, 0, 100),
            'amount_paid' => 0,
            'currency' => 'INR',
            'status' => 'active',
            'starts_at' => now(),
            'expires_at' => $expiresAt,
        ]);

        $durationLabel = $isLifetime ? 'Lifetime Access' : "{$durationDays} days (until " . $expiresAt->format('d M, Y') . ")";

        return redirect()->back()
            ->with('success', "👑 Premium Pro Membership successfully granted to {$user->email} for {$durationLabel}!");
    }

    /**
     * Revoke premium membership access for a user.
     */
    public function revoke($userId)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($userId);
        $user->is_member = false;
        $user->membership_expires_at = null;
        $user->save();

        Membership::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled']);

        return redirect()->back()
            ->with('success', "Pro membership has been revoked for {$user->email}.");
    }
}

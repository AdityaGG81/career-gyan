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

        return view('admin.membership.index', compact('plan', 'stats', 'recentMembers'));
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
}

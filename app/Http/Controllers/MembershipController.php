<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MembershipController extends Controller
{
    public function index()
    {
        $plan = MembershipPlan::where('slug', 'pro-member')->first();
        if (!$plan) {
            $plan = new MembershipPlan([
                'name' => 'Pro Member',
                'slug' => 'pro-member',
                'description' => 'Unlock premium tools, advanced tests, 1-on-1 counseling, and expert WhatsApp group access.',
                'price' => 99900,
                'duration_days' => 365,
                'features' => [
                    '🧠 Advanced Personality Profiler Test',
                    '🎯 Career Deep-Dive Roadmaps & Insights',
                    '👑 Leadership & Entrepreneurship Assessment',
                    '⚡ Unlimited AI Chatbot Career Counseling',
                    '💬 Private Mentor WhatsApp Group Access',
                    '🤝 1-on-1 Direct Career Session Booking',
                    '📊 Premium PDF Downloadable Reports',
                    '🏅 Gold Pro Badge on Leaderboards'
                ],
                'is_active' => true
            ]);
        }
        
        $isMember = Auth::check() ? Auth::user()->hasActiveMembership() : false;
        
        return view('membership.index', compact('plan', 'isMember'));
    }

    public function checkout(Request $request)
    {
        $plan = MembershipPlan::where('slug', 'pro-member')->firstOrFail();
        
        $keyId = env('RAZORPAY_KEY_ID');
        $keySecret = env('RAZORPAY_KEY_SECRET');
        
        $isSimulation = empty($keyId) || empty($keySecret);
        
        $orderId = null;
        
        if (!$isSimulation) {
            try {
                $response = Http::withBasicAuth($keyId, $keySecret)
                    ->post('https://api.razorpay.com/v1/orders', [
                        'amount' => $plan->price,
                        'currency' => 'INR',
                        'receipt' => 'receipt_order_' . Auth::id() . '_' . time(),
                    ]);
                    
                if ($response->successful()) {
                    $orderId = $response->json()['id'];
                } else {
                    Log::error('Razorpay Order Creation Failed: ' . $response->body());
                    $isSimulation = true;
                }
            } catch (\Exception $e) {
                Log::error('Razorpay Exception: ' . $e->getMessage());
                $isSimulation = true;
            }
        }
        
        Membership::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'razorpay_order_id' => $orderId ?? 'order_mock_' . uniqid(),
            'amount_paid' => $plan->price,
            'currency' => 'INR',
            'status' => 'pending',
        ]);
        
        return view('membership.checkout', compact('plan', 'orderId', 'keyId', 'isSimulation'));
    }

    public function verifyPayment(Request $request)
    {
        $plan = MembershipPlan::where('slug', 'pro-member')->firstOrFail();
        
        $orderId = $request->input('razorpay_order_id');
        $paymentId = $request->input('razorpay_payment_id');
        $signature = $request->input('razorpay_signature');
        $isSimulation = (bool) $request->input('is_simulation', false);
        
        $verified = false;
        
        if ($isSimulation) {
            $verified = true;
        } else {
            $keySecret = env('RAZORPAY_KEY_SECRET');
            $expectedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $keySecret);
            if ($expectedSignature === $signature) {
                $verified = true;
            }
        }
        
        if ($verified) {
            $membership = Membership::where('razorpay_order_id', $orderId)->first();
            if (!$membership) {
                $membership = new Membership([
                    'user_id' => Auth::id(),
                    'plan_id' => $plan->id,
                    'razorpay_order_id' => $orderId,
                    'amount_paid' => $plan->price,
                    'currency' => 'INR',
                ]);
            }
            
            $membership->status = 'active';
            $membership->razorpay_payment_id = $paymentId ?? 'pay_mock_' . uniqid();
            $membership->razorpay_signature = $signature ?? 'sig_mock_' . uniqid();
            $membership->starts_at = now();
            $membership->expires_at = now()->addDays($plan->duration_days);
            $membership->save();
            
            $user = Auth::user();
            $user->is_member = true;
            $user->membership_expires_at = $membership->expires_at;
            $user->save();
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Payment signature verification failed.']);
    }

    public function success()
    {
        return view('membership.success');
    }

    public function dashboard()
    {
        $user = Auth::user();
        if (!$user->hasActiveMembership()) {
            return redirect()->route('membership.index')->with('error', 'Please upgrade to premium to access this dashboard.');
        }
        
        $membership = $user->activeMembership;
        $plan = $membership ? $membership->plan : MembershipPlan::where('slug', 'pro-member')->first();
        
        return view('membership.dashboard', compact('user', 'membership', 'plan'));
    }

    public function whatsapp()
    {
        $user = Auth::user();
        if (!$user->hasActiveMembership()) {
            return redirect()->route('membership.index')->with('error', 'Please upgrade to premium to access the WhatsApp group.');
        }
        
        $link = env('MEMBERSHIP_WHATSAPP_LINK', 'https://chat.whatsapp.com/demo-careergyan-group');
        return redirect()->away($link);
    }
}

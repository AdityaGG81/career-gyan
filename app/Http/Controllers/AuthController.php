<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && !$user->email_verified_at) {
            if (Hash::check($request->password, $user->password)) {
                session(['verification_user_id' => $user->id]);
                return redirect()->route('verify.email')->with('success', 'Please verify your email to log in.');
            }
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    /**
     * Show signup form
     */
    public function showSignup()
    {
        return view('auth.signup');
    }

    /**
     * Register user + send OTP
     */
    public function signup(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // OTP generate
     $otp = (string) random_int(100000, 999999);

$user->update([
    'email_otp' => $otp,
    'email_otp_expires_at' => now()->addMinutes(10),
    'last_otp_sent_at' => now(),
]);

        // send email
        try {
            Mail::raw(
                "Your CareerGyan email verification code is: {$otp}\n\nThis code expires in 10 minutes.",
                function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Verify Your Email - CareerGyan');
                }
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Signup Mail Error: ' . $e->getMessage());
            // Don't block registration even if mail fails
        }

        session(['verification_user_id' => $user->id]);

        return redirect()->route('verify.email');
    }

    /**
     * RESEND OTP (FIXED)
     */
   public function resendEmailOtp(Request $request)
{
    $userId = session('verification_user_id');

    if (!$userId) {
        return redirect()->route('signup')
            ->with('error', 'Session expired. Please sign up again.');
    }

    $user = User::find($userId);

    if (!$user) {
        return redirect()->route('signup')
            ->with('error', 'User not found.');
    }

    // ⛔ HARD COOLDOWN (reliable)
    if ($user->last_otp_sent_at &&
        $user->last_otp_sent_at->copy()->addSeconds(60)->isFuture()) {
        $secondsLeft = max(1, (int)now()->diffInSeconds($user->last_otp_sent_at->copy()->addSeconds(60), false));
        return back()->with('error', "Wait {$secondsLeft} seconds before resending OTP.");
    }

    $otp = (string) random_int(100000, 999999);

    $user->update([
        'email_otp' => $otp,
        'email_otp_expires_at' => now()->addMinutes(10),
        'last_otp_sent_at' => now(),
    ]);

    try {
        Mail::raw(
            "Your CareerGyan OTP is: {$otp}\n\nThis code expires in 10 minutes.",
            function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verify Your Email - CareerGyan');
            }
        );
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Resend OTP Mail Error: ' . $e->getMessage());
        return back()->with('error', 'Failed to send email. Please try again later.');
    }

    return back()->with('success', 'OTP sent successfully.');
}

    /**
     * Verify email OTP
     */
    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $userId = session('verification_user_id');

        if (!$userId) {
            return redirect()->route('signup')
                ->with('error', 'Session expired or invalid. Please sign up again.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('signup')
                ->with('error', 'User not found.');
        }

        if ($user->email_otp_expires_at && now()->gt($user->email_otp_expires_at)) {
            return back()->with('error', 'Verification code has expired. Please request a new OTP.');
        }

        if ((string) $user->email_otp !== (string) $request->otp) {
            return back()->with('error', 'Invalid verification code.');
        }

        // Mark email as verified
        $user->update([
            'email_verified_at' => now(),
            'email_otp' => null,
            'email_otp_expires_at' => null,
        ]);

        // Clear verification session
        session()->forget('verification_user_id');

        // Log the user in
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Email verified successfully! Welcome to CareerGyan.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show profile
     */
    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'avatar_preset' => ['nullable', 'string'],
            'photo_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->phone = $request->phone;

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $path = public_path('uploads/avatars');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);

            $user->profile_photo = 'uploads/avatars/' . $filename;
        } elseif ($request->filled('avatar_preset')) {
            $user->profile_photo = $request->avatar_preset;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
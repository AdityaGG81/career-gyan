<?php

namespace App\Http\Controllers\CareerGuru;

use App\Http\Controllers\Controller;
use App\Models\CareerGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show CareerGuru Login page.
     */
    public function showLoginForm()
    {
        return $this->showLogin();
    }

    public function showLogin()
    {
        if (Auth::guard('careerguru')->check()) {
            return redirect()->route('careerguru.dashboard');
        }

        return view('careerguru.auth.login');
    }

    /**
     * Process CareerGuru Login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = (bool) $request->input('remember', false);

        // Check if CareerGuru account exists
        $guru = CareerGuru::where('email', strtolower(trim($credentials['email'])))->first();

        if (!$guru) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'No CareerGuru account found with this email address.']);
        }

        // Account status check
        if ($guru->status === 'inactive') {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Your CareerGuru account is currently inactive. Please contact administration for activation.']);
        }

        if ($guru->status === 'revoked') {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Your CareerGuru partner access has been revoked by administration.']);
        }

        // Attempt authentication using careerguru guard
        if (Auth::guard('careerguru')->attempt([
            'email' => strtolower(trim($credentials['email'])),
            'password' => $credentials['password'],
        ], $remember)) {
            $request->session()->regenerate();

            // Track login activity
            $guru->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            return redirect()->intended(route('careerguru.dashboard'))
                ->with('success', "Welcome back, {$guru->name}!");
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['password' => 'The provided password is incorrect.']);
    }

    /**
     * CareerGuru Logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('careerguru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('careerguru.login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show Forgot Password Form.
     */
    public function showForgotPasswordForm()
    {
        return $this->showForgotPassword();
    }

    public function showForgotPassword()
    {
        return view('careerguru.auth.forgot-password');
    }

    /**
     * Handle Forgot Password submission.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = strtolower(trim($request->email));

        $guru = CareerGuru::where('email', $email)->first();

        if (!$guru) {
            return back()->with('error', 'We could not find a CareerGuru account with that email address.');
        }

        if (!$guru->isActive()) {
            return back()->with('error', 'Your account is inactive. Please contact administration for password recovery.');
        }

        // Generate token
        $token = Str::random(64);

        DB::table('careerguru_password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $resetUrl = route('careerguru.password.reset', ['token' => $token, 'email' => $email]);

        // Attempt sending email
        try {
            Mail::raw("Hello {$guru->name},\n\nYou requested a password reset for your CareerGuru Partner account.\n\nPlease reset your password using the following link:\n{$resetUrl}\n\nThis link will expire in 60 minutes.\n\nIf you did not request this, please ignore this email.\n\nRegards,\nCareerGyan Team", function ($message) use ($email) {
                $message->to($email)
                        ->subject('Reset Your CareerGuru Password - CareerGyan');
            });
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('CareerGuru password reset email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Password reset instructions have been dispatched. Check your email inbox.');
    }

    /**
     * Show Reset Password Form.
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('careerguru.auth.reset-password', compact('token', 'email'));
    }

    /**
     * Handle Password Reset submission.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $email = strtolower(trim($request->email));

        $record = DB::table('careerguru_password_resets')
            ->where('email', $email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Invalid or expired password reset token.']);
        }

        // Check 60 minute expiry
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('careerguru_password_resets')->where('email', $email)->delete();
            return back()->withErrors(['email' => 'Password reset token has expired. Please request a new link.']);
        }

        $guru = CareerGuru::where('email', $email)->first();
        if (!$guru) {
            return back()->withErrors(['email' => 'CareerGuru account not found.']);
        }

        $guru->password = Hash::make($request->password);
        $guru->save();

        DB::table('careerguru_password_resets')->where('email', $email)->delete();

        return redirect()->route('careerguru.login')
            ->with('success', 'Your password has been reset successfully. Please log in with your new credentials.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\CareerGuru;
use App\Models\User;
use App\Services\CareerGuruService;
use App\Services\RewardPointsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect regular user / student to Google's OAuth 2.0 authorization page.
     */
    public function redirectToGoogle(Request $request)
    {
        session(['google_auth_type' => 'student']);
        return $this->buildGoogleRedirect($request, route('login'));
    }

    /**
     * Redirect CareerGuru to Google's OAuth 2.0 authorization page.
     */
    public function redirectToGoogleGuru(Request $request)
    {
        session(['google_auth_type' => 'careerguru']);
        return $this->buildGoogleRedirect($request, route('careerguru.login'));
    }

    /**
     * Build the Google OAuth redirect URL.
     */
    protected function buildGoogleRedirect(Request $request, string $fallbackRoute)
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUri = config('services.google.redirect');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect($fallbackRoute)->withErrors([
                'email' => 'Google Login is currently not configured. Please add GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET to your .env file or contact support.',
            ]);
        }

        // Generate CSRF state token
        $state = Str::random(40);
        session(['google_oauth_state' => $state]);

        // Retain referral context if available
        if ($request->filled('ref')) {
            session(['referral_code' => strtoupper(trim($request->ref))]);
        }
        if ($request->filled('guru')) {
            session(['careerguru_ref' => strtoupper(trim($request->guru))]);
        }

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'access_type' => 'online',
            'state' => $state,
            'prompt' => 'select_account',
        ]);

        return redirect("https://accounts.google.com/o/oauth2/v2/auth?{$query}");
    }

    /**
     * Handle the callback returned by Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        $authType = session('google_auth_type', 'student');
        $returnRoute = ($authType === 'careerguru') ? route('careerguru.login') : route('login');

        // 1. Check if user cancelled or Google returned an error
        if ($request->has('error')) {
            $errorMsg = $request->input('error_description', $request->input('error', 'Google sign-in was canceled.'));
            return redirect($returnRoute)->withErrors(['email' => 'Google sign-in was canceled: ' . $errorMsg]);
        }

        // 2. Validate state token to protect against CSRF
        $storedState = session('google_oauth_state');
        session()->forget('google_oauth_state');

        $receivedState = $request->input('state');
        if ($storedState && $receivedState && !hash_equals($storedState, $receivedState)) {
            return redirect($returnRoute)->withErrors(['email' => 'Authentication state mismatch. Please try signing in again.']);
        }

        $code = $request->input('code');
        if (empty($code)) {
            return redirect($returnRoute)->withErrors(['email' => 'No authorization code received from Google.']);
        }

        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUri = config('services.google.redirect');

        // 3. Exchange authorization code for access token
        try {
            $tokenResponse = Http::asForm()->timeout(15)->post('https://oauth2.googleapis.com/token', [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
            ]);

            if (!$tokenResponse->successful()) {
                Log::error('Google OAuth token exchange failed: ' . $tokenResponse->body());
                return redirect($returnRoute)->withErrors(['email' => 'Unable to connect to Google servers. Please try again.']);
            }

            $tokenData = $tokenResponse->json();
            $accessToken = $tokenData['access_token'] ?? null;

            if (!$accessToken) {
                return redirect($returnRoute)->withErrors(['email' => 'Google access token could not be obtained.']);
            }

            // 4. Retrieve user profile information from Google
            $userInfoResponse = Http::withToken($accessToken)
                ->timeout(15)
                ->get('https://www.googleapis.com/oauth2/v3/userinfo');

            if (!$userInfoResponse->successful()) {
                Log::error('Google OAuth userinfo fetch failed: ' . $userInfoResponse->body());
                return redirect($returnRoute)->withErrors(['email' => 'Unable to retrieve user information from Google.']);
            }

            $googleData = $userInfoResponse->json();
            $googleId = $googleData['sub'] ?? null;
            $email = $googleData['email'] ?? null;
            $name = $googleData['name'] ?? 'Google User';
            $givenName = $googleData['given_name'] ?? '';
            $familyName = $googleData['family_name'] ?? '';
            $picture = $googleData['picture'] ?? null;

            if (empty($email)) {
                return redirect($returnRoute)->withErrors(['email' => 'Your Google account did not provide an email address.']);
            }

            // Branch by authentication type: CareerGuru vs Student
            if ($authType === 'careerguru') {
                return $this->handleCareerGuruLogin($request, $email, $name);
            }

            return $this->handleStudentLogin($request, $googleId, $email, $name, $givenName, $familyName, $picture);

        } catch (\Throwable $e) {
            Log::error('Google OAuth callback exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect($returnRoute)->withErrors(['email' => 'An unexpected error occurred during Google sign-in. Please try again.']);
        }
    }

    /**
     * Handle CareerGuru partner login through Google.
     */
    protected function handleCareerGuruLogin(Request $request, string $email, string $name)
    {
        $guru = CareerGuru::where('email', strtolower(trim($email)))->first();

        if (!$guru) {
            return redirect()->route('careerguru.login')->withErrors([
                'email' => "No CareerGuru account was found for Google email '{$email}'. CareerGuru accounts are created by the administrator.",
            ]);
        }

        if ($guru->status !== 'active') {
            return redirect()->route('careerguru.login')->withErrors([
                'email' => 'Your CareerGuru account is currently inactive or deactivated. Please contact the administrator.',
            ]);
        }

        // Update login metadata
        $guru->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        Auth::guard('careerguru')->login($guru, true);
        $request->session()->regenerate();
        session()->forget('google_auth_type');

        return redirect()->intended(route('careerguru.dashboard'))->with('success', "Welcome back, {$guru->name}!");
    }

    /**
     * Handle standard student / user login through Google.
     */
    protected function handleStudentLogin(Request $request, ?string $googleId, string $email, string $name, string $givenName, string $familyName, ?string $picture)
    {
        $user = User::where('google_id', $googleId)
            ->orWhere('email', strtolower(trim($email)))
            ->first();

        $isNewUser = false;

        if ($user) {
            $updates = [];
            if (empty($user->google_id) && $googleId) {
                $updates['google_id'] = $googleId;
            }
            if (empty($user->profile_photo) && $picture) {
                $updates['profile_photo'] = $picture;
            }
            if (empty($user->google_avatar) && $picture) {
                $updates['google_avatar'] = $picture;
            }
            if (empty($user->email_verified_at)) {
                $updates['email_verified_at'] = now();
            }
            if (!empty($updates)) {
                $user->update($updates);
            }
        } else {
            $isNewUser = true;

            // Split name if given/family are blank
            if (empty($givenName) && empty($familyName)) {
                $nameParts = explode(' ', trim($name));
                $givenName = $nameParts[0] ?? 'Student';
                $familyName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';
            }

            $user = User::create([
                'name' => $name,
                'first_name' => $givenName ?: 'Student',
                'last_name' => $familyName,
                'email' => strtolower(trim($email)),
                'google_id' => $googleId,
                'profile_photo' => $picture,
                'google_avatar' => $picture,
                'password' => Hash::make(Str::random(32)),
                'email_verified_at' => now(),
                'points_balance' => 0,
            ]);

            // Generate unique referral code for user
            try {
                $rewardService = app(RewardPointsService::class);
                $userCode = $rewardService->generateUniqueReferralCode($user);
                $user->update(['referral_code' => $userCode]);

                // Process referral bonus if code was in session
                $referralCode = session('referral_code');
                if (!empty($referralCode)) {
                    $rewardService->recordPendingReferral($user, $referralCode);
                    session()->forget('referral_code');
                }
            } catch (\Throwable $e) {
                Log::error('Reward points referral error on Google signup: ' . $e->getMessage());
            }

            // Attribute to CareerGuru if student arrived through partner link
            try {
                $guruRef = session('careerguru_ref') ?? session('referral_code');
                if ($guruRef) {
                    $careerGuruService = app(CareerGuruService::class);
                    $careerGuruService->handleStudentRegistration($user, $guruRef);
                    session()->forget('careerguru_ref');
                }
            } catch (\Throwable $e) {
                Log::error('CareerGuru attribution error on Google signup: ' . $e->getMessage());
            }
        }

        Auth::login($user, true);
        $request->session()->regenerate();
        session()->forget('google_auth_type');

        $welcomeMsg = $isNewUser
            ? "Welcome to CareerGyan, {$user->name}! Your account has been created with Google."
            : "Welcome back, {$user->name}!";

        return redirect()->intended(route('home'))->with('success', $welcomeMsg);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Read from .env, falling back to config cache, falling back to default
        $envEmail = env('ADMIN_EMAIL') ?? config('services.admin.email') ?? 'dkakad.dk@gmail.com';
        $envPassword = env('ADMIN_PASSWORD') ?? config('services.admin.password') ?? 'Sudarshan131275#';

        if (trim($email) === trim($envEmail) && trim($password) === trim($envPassword)) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    public function users()
    {
        // Simple authentication check based on existing pattern
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $users = \App\Models\User::with(['testSessions', 'studentAnalyses'])->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function dashboard()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $userCount = \App\Models\User::count();
        $careerCount = \App\Models\Career::count();
        
        // Handle blog count safely in case migrations are not run yet
        $blogCount = 0;
        try {
            if (class_exists(\App\Models\Blog::class)) {
                $blogCount = \App\Models\Blog::count();
            }
        } catch (\Exception $e) {
            // Table doesn't exist yet
        }

        $suggestionCount = \App\Models\Suggestion::count();
        $fieldCount = \App\Models\Field::count();
        $collegeCount = \App\Models\College::count();
        $recentUsers = \App\Models\User::latest()->take(5)->get();
        $recentSuggestions = \App\Models\Suggestion::latest()->take(5)->get();

        $quizAttemptCount = 0;
        try {
            if (class_exists(\App\Models\DailyQuizAttempt::class)) {
                $quizAttemptCount = \App\Models\DailyQuizAttempt::count();
            }
        } catch (\Exception $e) {}

        $jobCount = 0;
        try {
            if (class_exists(\App\Models\JobListing::class)) {
                $jobCount = \App\Models\JobListing::count();
            }
        } catch (\Exception $e) {}

        $memberCount = 0;
        try {
            if (class_exists(\App\Models\User::class)) {
                $memberCount = \App\Models\User::where('is_member', true)->count();
            }
        } catch (\Exception $e) {}

        $businessCount = 0;
        try {
            if (class_exists(\App\Models\BusinessIdea::class)) {
                $businessCount = \App\Models\BusinessIdea::count();
            }
        } catch (\Exception $e) {}

        $chatQueryCount = 0;
        $todayChatQueryCount = 0;
        $recentChatQueries = collect();
        try {
            if (class_exists(\App\Models\AiChatLog::class)) {
                $chatQueryCount = \App\Models\AiChatLog::count();
                $todayChatQueryCount = \App\Models\AiChatLog::whereDate('created_at', today())->count();
                $recentChatQueries = \App\Models\AiChatLog::with('user')->latest()->take(5)->get();
            }
        } catch (\Exception $e) {}

        $studentAnalysisCount = 0;
        try {
            if (class_exists(\App\Models\StudentAnalysis::class)) {
                $studentAnalysisCount = \App\Models\StudentAnalysis::count();
            }
        } catch (\Exception $e) {}

        $totalTestResultCount = 0;
        try {
            $aptCount = class_exists(\App\Models\TestSession::class) ? \App\Models\TestSession::count() : 0;
            $saCount = class_exists(\App\Models\StudentAnalysis::class) ? \App\Models\StudentAnalysis::count() : 0;
            $qtCount = class_exists(\App\Models\QuickTestAttempt::class) ? \App\Models\QuickTestAttempt::count() : 0;
            $totalTestResultCount = $aptCount + $saCount + $qtCount;
        } catch (\Exception $e) {}

        return view('admin.dashboard', compact(
            'userCount',
            'careerCount',
            'blogCount',
            'suggestionCount',
            'fieldCount',
            'collegeCount',
            'recentUsers',
            'recentSuggestions',
            'quizAttemptCount',
            'jobCount',
            'memberCount',
            'businessCount',
            'chatQueryCount',
            'todayChatQueryCount',
            'recentChatQueries',
            'studentAnalysisCount',
            'totalTestResultCount'
        ));
    }
}

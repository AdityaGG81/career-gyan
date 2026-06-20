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
        $envEmail = env('ADMIN_EMAIL') ?? config('services.admin.email') ?? 'admin@careergyan.in';
        $envPassword = env('ADMIN_PASSWORD') ?? config('services.admin.password') ?? 'admin123';

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

        $users = \App\Models\User::latest()->get();
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

        return view('admin.dashboard', compact(
            'userCount',
            'careerCount',
            'blogCount',
            'suggestionCount',
            'fieldCount',
            'collegeCount',
            'recentUsers',
            'recentSuggestions',
            'quizAttemptCount'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.suggestions');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Read from .env, falling back to config cache, falling back to default
        $envUsername = env('ADMIN_USERNAME') ?? config('services.admin.username') ?? 'admin';
        $envPassword = env('ADMIN_PASSWORD') ?? config('services.admin.password') ?? 'admin123';

        if (trim($username) === trim($envUsername) && trim($password) === trim($envPassword)) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.suggestions');
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvancedTestController extends Controller
{
    /**
     * Display the Advanced Test module for Pro Members.
     * Left clean/empty as requested until member specifies the exact modules to include.
     */
    public function index()
    {
        $user = Auth::user();

        // Enforce membership check
        $isMember = $user && $user->hasActiveMembership();

        return view('advanced-test.index', compact('user', 'isMember'));
    }
}

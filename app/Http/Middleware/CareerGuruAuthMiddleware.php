<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CareerGuruAuthMiddleware
{
    /**
     * Handle an incoming request for CareerGuru panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('careerguru');

        if (!$guard->check()) {
            return redirect()->route('careerguru.login')
                ->with('error', 'Please log in to access the CareerGuru Partner Panel.');
        }

        $guru = $guard->user();

        // If admin deactivates or revokes access, immediately terminate session
        if (!$guru || $guru->status !== 'active') {
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $msg = ($guru && $guru->status === 'revoked')
                ? 'Your CareerGuru partner access has been revoked. Please contact CareerGyan administration.'
                : 'Your CareerGuru account is currently inactive. Please contact administration for approval.';

            return redirect()->route('careerguru.login')->with('error', $msg);
        }

        return $next($request);
    }
}

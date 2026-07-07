<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MemberOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->hasActiveMembership()) {
            return redirect()->route('membership.index')->with('error', 'This feature is exclusive to Pro members. Upgrade now to get access!');
        }

        return $next($request);
    }
}

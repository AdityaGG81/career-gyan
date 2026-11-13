<?php

namespace App\Http\Controllers\CareerGuru;

use App\Http\Controllers\Controller;
use App\Models\CareerGuru;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * Handle public referral redirect: /careerguru/ref/{code}
     */
    public function handleRedirect(Request $request, string $code)
    {
        $code = strtoupper(trim($code));
        $guru = CareerGuru::where('referral_code', $code)->first();

        if ($guru && $guru->isActive()) {
            session(['careerguru_ref' => $code, 'careerguru_id' => $guru->id]);
            cookie()->queue(cookie('careerguru_ref', $code, 60 * 24 * 30)); // 30 days cookie
            
            return redirect()->route('signup', ['guru' => $code])
                ->with('partner_referral', "Welcome! You were referred by CareerGuru partner: {$guru->name}. Register below to access all CareerGyan features.");
        }

        return redirect()->route('signup')
            ->with('warning', 'Referral link was invalid or no longer active. You can still register directly.');
    }
}

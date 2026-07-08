<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InaugurationController extends Controller
{
    /**
     * Public JSON API — returns current inauguration state.
     * Polled by all clients every 2 seconds during the event.
     */
    public function getState()
    {
        $state = DB::table('site_settings')
            ->where('key', 'inauguration_state')
            ->value('value') ?? 'ribbon_hidden';

        return response()->json(['state' => $state]);
    }

    /**
     * Admin action — show the ribbon on the landing page for all visitors.
     */
    public function showRibbon()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        DB::table('site_settings')
            ->where('key', 'inauguration_state')
            ->update(['value' => 'ribbon_visible', 'updated_at' => now()]);

        return redirect()->route('admin.inauguration')->with('success', '🎀 Ribbon is now visible to all visitors!');
    }

    /**
     * Admin action — cut the ribbon! Triggers confetti on all screens.
     */
    public function cutRibbon()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        DB::table('site_settings')
            ->where('key', 'inauguration_state')
            ->update(['value' => 'ribbon_cut', 'updated_at' => now()]);

        return redirect()->route('admin.inauguration')->with('success', '✂️ Ribbon has been CUT! Confetti is blasting on all screens! 🎉');
    }

    /**
     * Admin action — reset back to hidden (for rehearsal/testing).
     */
    public function resetRibbon()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        DB::table('site_settings')
            ->where('key', 'inauguration_state')
            ->update(['value' => 'ribbon_hidden', 'updated_at' => now()]);

        return redirect()->route('admin.inauguration')->with('success', '🔄 Inauguration state reset. Ribbon is now hidden.');
    }

    /**
     * Admin page — inauguration control panel.
     */
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $state = DB::table('site_settings')
            ->where('key', 'inauguration_state')
            ->value('value') ?? 'ribbon_hidden';

        return view('admin.inauguration', compact('state'));
    }
}

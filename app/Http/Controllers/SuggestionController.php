<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function create()
    {
        return view('suggestions.create');
    }

    public function store(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'role' => 'required|string',
            'message' => 'required|string|min:5',
            'website' => 'nullable|string' // Honeypot field for spam protection
        ]);

        // 2. Spam Check
        if (!empty($validated['website'])) {
            return redirect()->back()->with('error', 'Spam detected.');
        }

        // 3. Save Data
        $suggestion = Suggestion::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'message' => $validated['message'],
        ]);

        // 4. Temporary Debug (Remove after testing)
        // if ($suggestion) { dd("Saved successfully", $suggestion->toArray()); }

        return redirect()->back()->with('success', 'Thank you! Your suggestion has been submitted successfully.');
    }

    public function index()
    {
        $suggestions = Suggestion::latest()->get();
        return view('admin.suggestions', compact('suggestions'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BusinessIdea;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBusinessIdeaController extends Controller
{
    /**
     * Display a listing of businesses for admin.
     */
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = BusinessIdea::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('skills_required', 'like', "%{$search}%")
                  ->orWhere('soft_skills', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Risk filter
        if ($request->filled('risk') && $request->risk !== 'all') {
            $query->where('risk_level', $request->risk);
        }

        $businesses = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $categories = BusinessIdea::select('category')->distinct()->pluck('category')->filter()->values();
        $totalCount = BusinessIdea::count();
        $categoryCount = $categories->count();

        return view('admin.businesses.index', compact('businesses', 'categories', 'totalCount', 'categoryCount'));
    }

    /**
     * Show form to create a new business idea.
     */
    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $standardCategories = BusinessIdea::getStandardCategories();
        $fields = Field::orderBy('name')->get();

        return view('admin.businesses.create', compact('standardCategories', 'fields'));
    }

    /**
     * Store newly created business idea.
     */
    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_select' => 'required|string',
            'category_custom' => 'required_if:category_select,Other|nullable|string|max:255',
            'initial_investment' => 'required|string|max:255',
            'profit_margin' => 'nullable|string|max:255',
            'risk_level' => 'required|string|in:Low,Medium,High',
            'start_time' => 'nullable|string|max:255',
            'break_even_period' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string|max:255',
            'description' => 'required|string',
            'skills_required' => 'required|string',
            'soft_skills' => 'required|string',
            'opportunities' => 'nullable|string',
            'equipment_needed' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'status' => 'required|string|in:active,inactive',
        ]);

        $category = $request->input('category_select');
        if ($category === 'Other') {
            $category = trim($request->input('category_custom') ?: 'Retail');
        }

        // Generate a unique slug
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;
        while (BusinessIdea::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        // Default or find field
        $field = Field::where('slug', 'small-scale')->first() 
            ?? Field::where('slug', 'business')->first() 
            ?? Field::first();

        BusinessIdea::create([
            'name' => $request->name,
            'slug' => $slug,
            'field_id' => $request->input('field_id', $field ? $field->id : 1),
            'category' => $category,
            'initial_investment' => $request->initial_investment,
            'investment' => $request->initial_investment,
            'profit_margin' => $request->profit_margin ?: '20% - 35%',
            'risk_level' => $request->risk_level,
            'start_time' => $request->start_time ?: '2-4 Weeks',
            'break_even_period' => $request->break_even_period ?: '3 - 6 Months',
            'target_audience' => $request->target_audience,
            'description' => $request->description,
            'skills_required' => $request->skills_required,
            'soft_skills' => $request->soft_skills,
            'opportunities' => $request->opportunities,
            'equipment_needed' => $request->equipment_needed,
            'icon' => $request->icon ?: 'fa-store',
            'status' => $request->status,
        ]);

        return redirect()->route('admin.businesses.index')->with('success', 'Business opportunity added successfully to Business Corner!');
    }

    /**
     * Show form to edit existing business idea.
     */
    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $business = BusinessIdea::findOrFail($id);
        $standardCategories = BusinessIdea::getStandardCategories();
        $fields = Field::orderBy('name')->get();

        $isCustomCategory = !in_array($business->category, $standardCategories);
        $selectedCategory = $isCustomCategory ? 'Other' : $business->category;
        $customCategoryVal = $isCustomCategory ? $business->category : '';

        return view('admin.businesses.edit', compact('business', 'standardCategories', 'selectedCategory', 'customCategoryVal', 'fields'));
    }

    /**
     * Update existing business idea.
     */
    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $business = BusinessIdea::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_select' => 'required|string',
            'category_custom' => 'required_if:category_select,Other|nullable|string|max:255',
            'initial_investment' => 'required|string|max:255',
            'profit_margin' => 'nullable|string|max:255',
            'risk_level' => 'required|string|in:Low,Medium,High',
            'start_time' => 'nullable|string|max:255',
            'break_even_period' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string|max:255',
            'description' => 'required|string',
            'skills_required' => 'required|string',
            'soft_skills' => 'required|string',
            'opportunities' => 'nullable|string',
            'equipment_needed' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'status' => 'required|string|in:active,inactive',
        ]);

        $category = $request->input('category_select');
        if ($category === 'Other') {
            $category = trim($request->input('category_custom') ?: 'Retail');
        }

        // If name changed, update slug
        if ($business->name !== $request->name) {
            $baseSlug = Str::slug($request->name);
            $slug = $baseSlug;
            $counter = 1;
            while (BusinessIdea::where('slug', $slug)->where('id', '!=', $business->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $business->slug = $slug;
        }

        $business->update([
            'name' => $request->name,
            'category' => $category,
            'initial_investment' => $request->initial_investment,
            'investment' => $request->initial_investment,
            'profit_margin' => $request->profit_margin ?: '20% - 35%',
            'risk_level' => $request->risk_level,
            'start_time' => $request->start_time ?: '2-4 Weeks',
            'break_even_period' => $request->break_even_period ?: '3 - 6 Months',
            'target_audience' => $request->target_audience,
            'description' => $request->description,
            'skills_required' => $request->skills_required,
            'soft_skills' => $request->soft_skills,
            'opportunities' => $request->opportunities,
            'equipment_needed' => $request->equipment_needed,
            'icon' => $request->icon ?: 'fa-store',
            'status' => $request->status,
        ]);

        return redirect()->route('admin.businesses.index')->with('success', 'Business opportunity updated successfully!');
    }

    /**
     * Delete business idea.
     */
    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $business = BusinessIdea::findOrFail($id);
        $business->delete();

        return redirect()->route('admin.businesses.index')->with('success', 'Business opportunity deleted successfully.');
    }
}

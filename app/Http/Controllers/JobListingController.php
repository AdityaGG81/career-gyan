<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobListing::orderBy('last_date', 'asc');

        // Apply keyword search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('job_title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter by qualification
        if ($request->filled('qualification')) {
            $query->where('qualification', $request->input('qualification'));
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%" . $request->input('location') . "%");
        }

        // Filter by job sector (govt/pvt)
        $sector = $request->input('sector', 'all');
        if ($sector === 'govt') {
            $query->whereIn('job_type', ['govt', 'both']);
        } elseif ($sector === 'pvt') {
            $query->whereIn('job_type', ['pvt', 'both']);
        }

        // Determine if we should show Active (default) or Archived/Expired jobs
        $type = $request->input('type', 'active');
        if ($type === 'archived') {
            $query->where(function ($q) {
                $q->where('status', 'archived')
                  ->orWhere('last_date', '<', now()->startOfDay());
            });
        } else {
            $query->where('status', 'active')
                  ->where('last_date', '>=', now()->startOfDay());
        }

        $jobs = $query->paginate(6)->withQueryString();

        // Get values for filtering options dynamically
        $categories = JobListing::distinct()->pluck('category')->filter()->values()->all();
        $qualifications = ['10th Pass', '12th Pass', 'Graduate', 'Post Graduate', 'Diploma'];

        return view('job-corner.index', compact('jobs', 'categories', 'qualifications', 'type', 'sector'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = JobListing::findOrFail($id);
        return view('job-corner.show', compact('job'));
    }
}

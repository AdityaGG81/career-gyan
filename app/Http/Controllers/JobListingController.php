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

        // Apply keyword search (fuzzy search if search parameter is present)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $allJobs = $query->get();
            $matchedJobs = [];
            
            foreach ($allJobs as $j) {
                $titleScore = $this->fuzzyMatch($search, $j->job_title);
                $companyScore = $this->fuzzyMatch($search, $j->company_name);
                $descScore = $this->fuzzyMatch($search, $j->description ?: '');
                $categoryScore = $this->fuzzyMatch($search, $j->category ?: '');
                
                $maxScore = max($titleScore, $companyScore, $descScore, $categoryScore);
                if ($maxScore > 0) {
                    $j->fuzzy_score = $maxScore;
                    $matchedJobs[] = $j;
                }
            }
            
            // Sort by fuzzy score descending
            usort($matchedJobs, function ($a, $b) {
                return $b->fuzzy_score <=> $a->fuzzy_score;
            });
            
            // Paginate manually
            $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
            $perPage = 6;
            $currentItems = array_slice($matchedJobs, ($currentPage - 1) * $perPage, $perPage);
            
            $jobs = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems,
                count($matchedJobs),
                $perPage,
                $currentPage,
                [
                    'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $request->query(),
                ]
            );
        } else {
            $jobs = $query->paginate(6)->withQueryString();
        }

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

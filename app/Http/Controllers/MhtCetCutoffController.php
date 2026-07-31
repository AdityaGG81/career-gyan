<?php

namespace App\Http\Controllers;

use App\Models\MhtCetCutoff;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MhtCetCutoffController extends Controller
{
    /**
     * Main cutoff search page
     */
    public function index(Request $request)
    {
        $cacheTtl = 3600;

        $colleges = Cache::remember('mht_cet_colleges', $cacheTtl, function () {
            return MhtCetCutoff::select('college_name')->distinct()->orderBy('college_name')->pluck('college_name');
        });

        $branches = Cache::remember('mht_cet_branches', $cacheTtl, function () {
            return MhtCetCutoff::select('branch_name')->distinct()->orderBy('branch_name')->pluck('branch_name');
        });

        $categories = Cache::remember('mht_cet_categories', $cacheTtl, function () {
            return MhtCetCutoff::select('category')->distinct()->orderBy('category')->pluck('category');
        });

        $totalRecords = Cache::remember('mht_cet_total_records', $cacheTtl, function () {
            return MhtCetCutoff::count();
        });
        $totalColleges = Cache::remember('mht_cet_total_colleges', $cacheTtl, function () {
            return MhtCetCutoff::distinct('college_name')->count('college_name');
        });
        $totalBranches = Cache::remember('mht_cet_total_branches', $cacheTtl, function () {
            return MhtCetCutoff::distinct('branch_name')->count('branch_name');
        });

        return view('tools.maharashtra-cutoff', compact(
            'colleges', 'branches', 'categories',
            'totalRecords', 'totalColleges', 'totalBranches'
        ));
    }

    /**
     * AJAX endpoint returning filtered cutoff results as JSON
     */
    public function search(Request $request): JsonResponse
    {
        $query = MhtCetCutoff::query();

        if ($request->filled('q')) {
            $query->forCollege($request->input('q'));
        }

        if ($request->filled('branch')) {
            $query->where('branch_name', $request->input('branch'));
        }

        if ($request->filled('category')) {
            $query->forCategory($request->input('category'));
        }

        $sortBy = $request->input('sort_by', 'percentile');
        $sortDir = $request->input('sort_dir', 'desc');
        
        $allowedSorts = ['college_name', 'branch_name', 'category', 'percentile', 'merit_no'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('percentile', 'desc');
        }

        $perPage = $request->input('per_page', 50);
        
        $results = $query->paginate($perPage);

        $results->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'college_code' => $item->college_code,
                'college_name' => $item->college_name,
                'branch_name' => $item->branch_name,
                'category' => $item->category,
                'category_full' => $item->category_full,
                'percentile' => $item->percentile,
                'formatted_percentile' => $item->formatted_percentile ?? number_format($item->percentile, 7),
                'merit_no' => $item->merit_no,
                'percentile_band' => $item->percentile_band,
                'round' => $item->round,
                'year' => $item->year,
            ];
        });

        return response()->json($results);
    }

    /**
     * AJAX autocomplete endpoint
     */
    public function apiColleges(Request $request): JsonResponse
    {
        $q = $request->input('q');
        
        $query = MhtCetCutoff::select('college_name')->distinct();
        
        if ($q) {
            $query->where('college_name', 'like', '%' . $q . '%');
        }
        
        $colleges = $query->orderBy('college_name')
            ->limit(20)
            ->pluck('college_name');

        return response()->json($colleges);
    }

    /**
     * AJAX endpoint to get branches for a college
     */
    public function apiBranches(Request $request): JsonResponse
    {
        $college = $request->input('college');
        
        $query = MhtCetCutoff::select('branch_name')->distinct();
        
        if ($college) {
            $query->where('college_name', $college);
        }
        
        $branches = $query->orderBy('branch_name')->pluck('branch_name');

        return response()->json($branches);
    }

    /**
     * Download the CSV file
     */
    public function download()
    {
        $filePath = public_path('downloads/Maharashtra_MHT_CET_Engineering_Cutoffs_2025.csv');
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        
        return response()->download($filePath, 'Maharashtra_MHT_CET_Engineering_Cutoffs_2025.csv');
    }
}

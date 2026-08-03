<?php

namespace App\Http\Controllers;

use App\Models\MhtCetCutoff;
use App\Services\CollegeCutoffService;
use App\Services\CollegeSynonymService;
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
        try {
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

            $years = Cache::remember('mht_cet_years', $cacheTtl, function () {
                return MhtCetCutoff::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
            });
            $latestYear = $years->first() ?? 2025;

            $totalRecords = Cache::remember('mht_cet_total_records', $cacheTtl, function () {
                return MhtCetCutoff::count();
            });
            $totalColleges = Cache::remember('mht_cet_total_colleges', $cacheTtl, function () {
                return MhtCetCutoff::distinct('college_name')->count('college_name');
            });
            $totalBranches = Cache::remember('mht_cet_total_branches', $cacheTtl, function () {
                return MhtCetCutoff::distinct('branch_name')->count('branch_name');
            });

            $popularAcronyms = CollegeSynonymService::getPopularAcronyms();

            $initialCutoffs = MhtCetCutoff::where('year', $latestYear)->orderBy('percentile', 'desc')->take(50)->get();
            $initialTotal = MhtCetCutoff::where('year', $latestYear)->count();

            return view('tools.maharashtra-cutoff', compact(
                'colleges', 'branches', 'categories', 'years', 'latestYear',
                'totalRecords', 'totalColleges', 'totalBranches',
                'popularAcronyms', 'initialCutoffs', 'initialTotal'
            ));
        } catch (\Exception $e) {
            return response('<h1 style="color:red; text-align:center; margin-top:50px;">Database Table Missing!<br>Please visit <a href="/run-cutoff-setup-migration-2025">/run-cutoff-setup-migration-2025</a> to set up the live database.</h1>', 500);
        }
    }

    /**
     * AJAX endpoint returning filtered cutoff results as JSON
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = MhtCetCutoff::query();

            $latestYear = MhtCetCutoff::max('year') ?? 2025;
            $year = $request->input('year', $latestYear);
            if ($year) {
                $query->where('year', $year);
            }

            if ($request->filled('q')) {
                $q = trim($request->input('q'));
                $synonyms = CollegeSynonymService::resolveQuery($q);

                $query->where(function ($qb) use ($q, $synonyms) {
                    $qb->where('college_name', 'like', "%{$q}%")
                       ->orWhere('college_code', 'like', "%{$q}%");
                    
                    foreach ($synonyms as $syn) {
                        if (strlen($syn) >= 2) {
                            $qb->orWhere('college_name', 'like', "%{$syn}%");
                        }
                    }
                });
            }
            if ($request->filled('branch')) {
                $query->forBranch($request->input('branch'));
            }
            if ($request->filled('category')) {
                $query->forCategory($request->input('category'));
            }

            // Defaults
            $sortBy = $request->input('sort_by', 'percentile');
            $sortDir = $request->input('sort_dir', 'desc');
            $perPage = $request->input('per_page', 50);

            // Validations for sort to prevent SQL injection
            $allowedSorts = ['percentile', 'college_name', 'merit_no', 'branch_name'];
            if (!in_array($sortBy, $allowedSorts)) {
                $sortBy = 'percentile';
            }
            $sortDir = strtolower($sortDir) === 'asc' ? 'asc' : 'desc';

            $query->orderBy($sortBy, $sortDir);

            // Fetch results
            $results = $query->paginate($perPage);

            // Format results
            $results->getCollection()->transform(function ($cutoff) {
                return [
                    'id' => $cutoff->id,
                    'college_code' => $cutoff->college_code,
                    'college_name' => $cutoff->college_name,
                    'branch_name' => $cutoff->branch_name,
                    'category' => $cutoff->category,
                    'category_full' => $cutoff->category_full,
                    'percentile' => $cutoff->percentile,
                    'formatted_percentile' => $cutoff->formatted_percentile,
                    'merit_no' => $cutoff->merit_no,
                    'percentile_band' => $cutoff->percentile_band,
                    'round' => $cutoff->round,
                    'year' => $cutoff->year,
                ];
            });

            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Database Table Missing! Please visit /run-cutoff-setup-migration-2025 to set up the live database.'], 500);
        }
    }

    /**
     * AJAX autocomplete endpoint with acronym expansion
     */
    public function apiColleges(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));
        
        $query = MhtCetCutoff::select('college_name')->distinct();
        
        if (!empty($q)) {
            $synonyms = CollegeSynonymService::resolveQuery($q);
            $query->where(function ($qb) use ($q, $synonyms) {
                $qb->where('college_name', 'like', "%{$q}%")
                   ->orWhere('college_code', 'like', "%{$q}%");
                
                foreach ($synonyms as $syn) {
                    if (strlen($syn) >= 2) {
                        $qb->orWhere('college_name', 'like', "%{$syn}%");
                    }
                }
            });
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
     * AJAX endpoint to get combined institutional profile for a cutoff college
     */
    public function apiCollegeProfile(Request $request): JsonResponse
    {
        $collegeName = $request->input('college_name', '');
        $collegeCode = $request->input('college_code', '');

        if (empty($collegeName) && empty($collegeCode)) {
            return response()->json(['error' => 'College identifier is required.'], 400);
        }

        $profile = CollegeCutoffService::getCollegeProfileForCutoff($collegeName, $collegeCode);
        return response()->json($profile);
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

<?php

namespace App\Http\Controllers;

use App\Models\IndianCollege;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class IndianCollegeController extends Controller
{
    /**
     * Get a cached list of unique college names for fuzzy matching.
     * Uses caching to avoid re-querying 90k+ rows on every search.
     */
    private function getCollegeNameCandidates(): array
    {
        return Cache::remember('indian_college_names', 3600, function () {
            return IndianCollege::select('college_name')
                ->distinct()
                ->pluck('college_name')
                ->toArray();
        });
    }

    /**
     * GET /colleges — Browse/search/filter all Indian colleges
     */
    public function index(Request $request)
    {
        // Build a base query that applies all filters
        $baseQuery = IndianCollege::query();

        // Apply filters
        if ($request->filled('state')) {
            $baseQuery->where('state', $request->state);
        }
        if ($request->filled('district')) {
            $baseQuery->where('district', $request->district);
        }
        if ($request->filled('management')) {
            $baseQuery->where('management', $request->management);
        }
        if ($request->filled('college_type')) {
            $baseQuery->where('college_type', $request->college_type);
        }
        if ($request->filled('university')) {
            $baseQuery->where('university_name', $request->university);
        }
        if ($request->filled('course_category')) {
            $baseQuery->where('course_category', $request->course_category);
        }
        if ($request->filled('course_type')) {
            $baseQuery->where('course_type', $request->course_type);
        }

        $didYouMean = null;
        $fuzzyUsed = false;

        if ($request->filled('q')) {
            $q = trim($request->q);

            // Phase 1: Try exact LIKE search first
            $testQuery = (clone $baseQuery)->where(function ($qb) use ($q) {
                $qb->where('college_name', 'like', "%{$q}%")
                   ->orWhere('city', 'like', "%{$q}%")
                   ->orWhere('district', 'like', "%{$q}%")
                   ->orWhere('state', 'like', "%{$q}%")
                   ->orWhere('university_name', 'like', "%{$q}%")
                   ->orWhere('course_name', 'like', "%{$q}%");
            });

            $exactCount = (clone $testQuery)
                ->select(DB::raw('MIN(id) as id'))
                ->groupBy('college_name', 'district', 'state')
                ->get()
                ->count();

            if ($exactCount > 0) {
                // Exact matches found — use them
                $baseQuery = $testQuery;
            } else {
                // Phase 2: Fuzzy search fallback
                $candidates = $this->getCollegeNameCandidates();
                $fuzzyResults = $this->fuzzySearchCandidates($q, $candidates, 30, 50);

                if (!empty($fuzzyResults)) {
                    $fuzzyUsed = true;
                    // Get the best match as "Did you mean?" suggestion
                    $didYouMean = $fuzzyResults[0]['text'];

                    // Get all fuzzy-matched college names
                    $matchedNames = array_map(fn($r) => $r['text'], $fuzzyResults);

                    $baseQuery->whereIn('college_name', $matchedNames);
                }
                // If no fuzzy results either, the query stays unmodified
                // which will return 0 results with the empty state
            }
        }

        // Build query for unique colleges (MIN(id) grouped by college_name, district, state)
        $uniqueQuery = (clone $baseQuery)
            ->select('college_name', 'district', 'state', DB::raw('MIN(id) as id'))
            ->groupBy('college_name', 'district', 'state');

        // Total count of unique colleges for pagination
        $totalUnique = DB::table(DB::raw("({$uniqueQuery->toSql()}) as sub"))
            ->mergeBindings($uniqueQuery->getQuery())
            ->count();

        $perPage = 30;
        $currentPage = (int) $request->input('page', 1);
        $offset = max(0, ($currentPage - 1) * $perPage);

        // Fetch only the unique college IDs for the CURRENT PAGE (ordered by college_name)
        $pageUniqueIds = (clone $uniqueQuery)
            ->orderBy('college_name')
            ->skip($offset)
            ->take($perPage)
            ->pluck('id');

        if ($pageUniqueIds->isNotEmpty()) {
            // Fetch the 30 college models for the current page
            $collegesPage = IndianCollege::whereIn('id', $pageUniqueIds)
                ->orderBy('college_name')
                ->get();

            // Fetch course counts for the colleges on this page only
            $namesOnPage = $collegesPage->pluck('college_name')->unique();
            $courseCounts = IndianCollege::select('college_name', 'district', 'state', DB::raw('COUNT(DISTINCT course_name) as course_count'))
                ->whereIn('college_name', $namesOnPage)
                ->whereNotNull('course_name')
                ->where('course_name', '!=', '')
                ->groupBy('college_name', 'district', 'state')
                ->get()
                ->keyBy(function ($item) {
                    return $item->college_name . '|' . $item->district . '|' . $item->state;
                });

            // Attach course_count to each college
            foreach ($collegesPage as $college) {
                $key = $college->college_name . '|' . $college->district . '|' . $college->state;
                $college->course_count = $courseCounts->has($key) ? $courseCounts->get($key)->course_count : 0;
            }
        } else {
            $collegesPage = collect();
        }

        // Create a manual paginator
        $colleges = new \Illuminate\Pagination\LengthAwarePaginator(
            $collegesPage,
            $totalUnique,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Get filter options
        $states = IndianCollege::select('state')
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->distinct()
            ->orderBy('state')
            ->pluck('state');

        $managementTypes = IndianCollege::select('management')
            ->whereNotNull('management')
            ->where('management', '!=', '')
            ->distinct()
            ->orderBy('management')
            ->pluck('management');

        $collegeTypes = IndianCollege::select('college_type')
            ->whereNotNull('college_type')
            ->where('college_type', '!=', '')
            ->distinct()
            ->orderBy('college_type')
            ->pluck('college_type');

        $courseCategories = IndianCollege::select('course_category')
            ->whereNotNull('course_category')
            ->where('course_category', '!=', '')
            ->distinct()
            ->orderBy('course_category')
            ->pluck('course_category');

        $courseTypes = IndianCollege::select('course_type')
            ->whereNotNull('course_type')
            ->where('course_type', '!=', '')
            ->distinct()
            ->orderBy('course_type')
            ->pluck('course_type');

        // Stats — show unique college count, not row count
        $totalColleges = DB::table(DB::raw("(SELECT DISTINCT college_name, district, state FROM indian_colleges) as sub"))->count();
        $totalStates = IndianCollege::whereNotNull('state')->where('state', '!=', '')->distinct('state')->count('state');

        return view('indian-colleges.index', compact(
            'colleges', 'states', 'managementTypes', 'collegeTypes',
            'courseCategories', 'courseTypes', 'totalColleges', 'totalStates',
            'didYouMean', 'fuzzyUsed'
        ));
    }

    /**
     * GET /colleges/{id} — Individual college detail page
     */
    public function show($id)
    {
        $college = IndianCollege::findOrFail($id);

        // Related colleges from same university
        $relatedByUniversity = collect();
        if ($college->university_name) {
            $relatedByUniversity = IndianCollege::where('university_name', $college->university_name)
                ->where('id', '!=', $college->id)
                ->select('id', 'college_name', 'district', 'state', 'college_type', 'management')
                ->distinct('college_name')
                ->limit(8)
                ->get();
        }

        // Related colleges from same district
        $relatedByDistrict = collect();
        if ($college->district) {
            $relatedByDistrict = IndianCollege::where('district', $college->district)
                ->where('state', $college->state)
                ->where('id', '!=', $college->id)
                ->select('id', 'college_name', 'district', 'state', 'college_type', 'management')
                ->distinct('college_name')
                ->limit(6)
                ->get();
        }

        // Courses offered (for Maharashtra data with course info)
        $courses = collect();
        if ($college->course_name) {
            $courses = IndianCollege::where('college_name', $college->college_name)
                ->where('district', $college->district)
                ->whereNotNull('course_name')
                ->where('course_name', '!=', '')
                ->select('course_name', 'course_type', 'course_category', 'course_duration_months', 'is_professional', 'course_aided_unaided')
                ->distinct()
                ->get();
        }

        return view('indian-colleges.show', compact('college', 'relatedByUniversity', 'relatedByDistrict', 'courses'));
    }

    /**
     * GET /colleges/districts?state=X — AJAX: Get districts for a state
     */
    public function districts(Request $request): JsonResponse
    {
        $state = $request->input('state', '');

        if (empty($state)) {
            return response()->json([]);
        }

        $districts = IndianCollege::where('state', $state)
            ->whereNotNull('district')
            ->where('district', '!=', '')
            ->distinct()
            ->orderBy('district')
            ->pluck('district');

        return response()->json($districts);
    }

    /**
     * GET /colleges/api-search?q= — AJAX search for global search integration
     * Enhanced with fuzzy/typo-tolerant matching
     */
    public function apiSearch(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json([]);
        }

        // Phase 1: Try exact LIKE search
        $results = IndianCollege::where('college_name', 'like', "%{$q}%")
            ->orWhere('city', 'like', "%{$q}%")
            ->orWhere('university_name', 'like', "%{$q}%")
            ->select('id', 'college_name', 'district', 'state', 'college_type', 'management', 'university_name')
            ->limit(12)
            ->get()
            ->unique('college_name')
            ->values();

        $didYouMean = null;

        // Phase 2: If no exact results, try fuzzy matching
        if ($results->isEmpty()) {
            $candidates = $this->getCollegeNameCandidates();
            $fuzzyResults = $this->fuzzySearchCandidates($q, $candidates, 30, 8);

            if (!empty($fuzzyResults)) {
                $matchedNames = array_map(fn($r) => $r['text'], $fuzzyResults);
                $didYouMean = $fuzzyResults[0]['text'];

                $results = IndianCollege::whereIn('college_name', $matchedNames)
                    ->select('id', 'college_name', 'district', 'state', 'college_type', 'management', 'university_name')
                    ->limit(12)
                    ->get()
                    ->unique('college_name')
                    ->values();
            }
        }

        $formatted = $results->map(function ($c) {
            return [
                'id'         => $c->id,
                'name'       => $c->college_name,
                'location'   => trim(($c->district ? $c->district . ', ' : '') . ($c->state ?? '')),
                'type'       => $c->college_type ?? 'College',
                'management' => $c->management ?? '',
                'university' => $c->university_name ?? '',
                'url'        => url('/colleges/' . $c->id),
            ];
        });

        $response = ['results' => $formatted];
        if ($didYouMean) {
            $response['did_you_mean'] = $didYouMean;
        }

        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IndianCollege;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class IndianCollegeController extends Controller
{
    /**
     * GET /colleges — Browse/search/filter all Indian colleges
     */
    public function index(Request $request)
    {
        $query = IndianCollege::query();

        // Apply filters
        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }
        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }
        if ($request->filled('management')) {
            $query->where('management', $request->management);
        }
        if ($request->filled('college_type')) {
            $query->where('college_type', $request->college_type);
        }
        if ($request->filled('university')) {
            $query->where('university_name', $request->university);
        }
        if ($request->filled('course_category')) {
            $query->where('course_category', $request->course_category);
        }
        if ($request->filled('course_type')) {
            $query->where('course_type', $request->course_type);
        }
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($qb) use ($q) {
                $qb->where('college_name', 'like', "%{$q}%")
                   ->orWhere('city', 'like', "%{$q}%")
                   ->orWhere('district', 'like', "%{$q}%")
                   ->orWhere('state', 'like', "%{$q}%")
                   ->orWhere('university_name', 'like', "%{$q}%")
                   ->orWhere('course_name', 'like', "%{$q}%");
            });
        }

        $colleges = $query->orderBy('college_name')->paginate(30)->withQueryString();

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

        // Stats
        $totalColleges = IndianCollege::count();
        $totalStates = IndianCollege::whereNotNull('state')->where('state', '!=', '')->distinct('state')->count('state');

        return view('indian-colleges.index', compact(
            'colleges', 'states', 'managementTypes', 'collegeTypes',
            'courseCategories', 'courseTypes', 'totalColleges', 'totalStates'
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
     */
    public function apiSearch(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = IndianCollege::where('college_name', 'like', "%{$q}%")
            ->orWhere('city', 'like', "%{$q}%")
            ->orWhere('university_name', 'like', "%{$q}%")
            ->select('id', 'college_name', 'district', 'state', 'college_type', 'management', 'university_name')
            ->limit(8)
            ->get()
            ->unique('college_name')
            ->values()
            ->map(function ($c) {
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

        return response()->json($results);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\College;
use App\Models\Field;
use App\Models\Subject;
use App\Models\BusinessIdea;
use App\Models\SkillCourse;
use App\Models\CompetitiveExam;
use App\Models\NonTraditionalCareer;
use App\Models\TraditionalCareer;
use App\Models\SportCareer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExploreController extends Controller
{
    /* ─────────────────────────────────────────────
     | GET /explore  — main page load
     ────────────────────────────────────────────── */
    public function index(): View
    {
        $fields   = Field::where('slug', '!=', 'others')->withCount('careers')->get();
        $subjects = Subject::orderBy('name')->get();
        $careers  = Career::with('field', 'subjects')
                          ->orderBy('name')
                          ->get();

        return view('explore', compact('fields', 'subjects', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/field/{field}
     | Returns careers for a single field (AJAX)
     ────────────────────────────────────────────── */
    public function byField(Field $field): JsonResponse
    {
        $careers  = Career::with('field', 'subjects')
                          ->where('field_id', $field->id)
                          ->orderBy('name')
                          ->get()
                          ->map(fn($c) => $this->formatCareer($c));

        $colleges = College::where('field_id', $field->id)
                           ->orderBy('name')
                           ->get();

        return response()->json([
            'careers'  => $careers,
            'colleges' => $colleges,
            'field'    => $field,
        ]);
    }

    /* ─────────────────────────────────────────────
     | POST /explore/subjects
     | Body: { subject_ids: [1, 3, 5] }
     | Returns careers sorted by match count (AJAX)
     ────────────────────────────────────────────── */
    public function bySubjects(Request $request): JsonResponse
    {
        $ids = $request->input('subject_ids', []);

        if (empty($ids)) {
            $careers = Career::with('field', 'subjects')->orderBy('name')->get()
                             ->map(fn($c) => $this->formatCareer($c, 0));
            return response()->json(['careers' => $careers]);
        }

        // Count how many of the selected subjects each career matches
        $careers = Career::with('field', 'subjects')
            ->whereHas('subjects', fn($q) => $q->whereIn('subjects.id', $ids))
            ->get()
            ->map(function (Career $c) use ($ids) {
                $matchCount = $c->subjects->whereIn('id', $ids)->count();
                return $this->formatCareer($c, $matchCount);
            })
            ->sortByDesc('match_count')
            ->values();

        return response()->json(['careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | GET /explore/career/{career}
     | Full career detail: roadmap + subjects + colleges (AJAX)
     ────────────────────────────────────────────── */
    public function careerDetail(Career $career): JsonResponse
    {
        $career->load('field', 'subjects');

        $colleges = College::where('field_id', $field->id)->orderBy('name', 'asc')->get();

        return response()->json([
            'career'   => $this->formatCareer($career),
            'colleges' => $colleges,
        ]);
    }

    /* ─────────────────────────────────────────────
     | GET /explore/search?q=
     | Full-text search on career name & description (AJAX)
     ────────────────────────────────────────────── */
    public function search(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json(['careers' => []]);
        }

        $careers = Career::with('field', 'subjects')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->get()
            ->map(fn($c) => $this->formatCareer($c));

        return response()->json(['careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | Private helper — uniform career shape for JSON
     ────────────────────────────────────────────── */
    private function formatCareer(Career $career, int $matchCount = 0): array
    {
        return [
            'id'            => $career->id,
            'name'          => $career->name,
            'slug'          => $career->slug,
            'description'   => $career->description,
            'qualification' => $career->qualification,
            'stream'        => $career->stream,
            'salary_range'  => $career->salary_range,
            'demand_level'  => $career->demand_level,
            'roadmap'       => $career->roadmap,
            'icon'          => $career->icon,
            'match_count'   => $matchCount,
            'field'         => [
                'id'       => $career->field->id,
                'name'     => $career->field->name,
                'color'    => $career->field->color,
                'bg_color' => $career->field->bg_color,
            ],
            'subjects'      => $career->subjects->pluck('name'),
        ];
    }
    /* ─────────────────────────────────────────────
     | GET /explore/engineering-colleges
     | Dedicated interactive page for top engineering colleges
     ────────────────────────────────────────────── */
    public function engineeringColleges()
    {
        $field = Field::where('slug', 'technology-engineering')->firstOrFail();
        
        // Fetch all colleges in this field (which our seeder just populated)
$colleges = College::where('field_id', $field->id)->orderBy('name', 'asc')->get();        // Get unique districts/locations for the filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        
        // Types
        $types = $colleges->pluck('type')->unique()->sort()->values();

        return view('colleges.index', compact('field', 'colleges', 'districts', 'types'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/medical-colleges
     | Dedicated interactive page for top medical colleges
     ────────────────────────────────────────────── */
    public function medicalColleges()
    {
        $field = Field::where('slug', 'medical')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Get unique districts/locations for the filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        
        // Types
        $types = $colleges->pluck('type')->unique()->sort()->values();

        return view('colleges.medical', compact('field', 'colleges', 'districts', 'types'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/hotel-management-colleges
     | Dedicated interactive page for top HM colleges
     ────────────────────────────────────────────── */
    public function hotelColleges()
    {
        $field = Field::where('slug', 'hotel-management')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Get unique districts/locations for the filter
        $locations = $colleges->pluck('location')->unique()->sort()->values();
        
        // Tiers for filtering
        $tiers = ['Tier 1', 'Tier 2', 'Tier 3'];

        return view('colleges.hotel', compact('field', 'colleges', 'locations', 'tiers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/management-colleges
     | Dedicated interactive page for top Management colleges
     ────────────────────────────────────────────── */
    public function managementColleges()
    {
        $field = Field::where('slug', 'business')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Get unique districts/locations for the filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        
        // Types
        $types = $colleges->pluck('type')->unique()->sort()->values();

        return view('colleges.management', compact('field', 'colleges', 'districts', 'types'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/pharmacy-colleges
     | Dedicated interactive page for top Pharmacy colleges
     ────────────────────────────────────────────── */
    public function pharmacyColleges()
    {
        $field = Field::where('slug', 'pharmacy')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Get unique districts/locations for the filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        
        // Types
        $types = $colleges->pluck('type')->unique()->sort()->values();

        return view('colleges.pharmacy', compact('field', 'colleges', 'districts', 'types'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/non-mbbs-colleges
     | Dedicated interactive page for AYUSH & Allied
     ────────────────────────────────────────────── */
    public function nonMbbsColleges()
    {
        $field = Field::where('slug', 'ayush-allied')->first();
        if(!$field) {
             $field = Field::where('slug', 'medical')->firstOrFail();
        }
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Unique courses based on branch prefix in popular_branches or similar
        $courses = ['BAMS', 'BHMS', 'BUMS', 'BNYS', 'BPT', 'BDS'];

        return view('colleges.non_mbbs', compact('field', 'colleges', 'courses'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/science-colleges
     | Dedicated interactive page for Pure Sciences
     ────────────────────────────────────────────── */
    public function scienceColleges()
    {
        $field = Field::where('slug', 'science')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Districts for filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();

        return view('colleges.science', compact('field', 'colleges', 'districts'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/arts-humanities-colleges
     | Dedicated interactive page for Arts & Humanities
     ────────────────────────────────────────────── */
    public function artsColleges()
    {
        $field = Field::where('slug', 'arts-humanities')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Districts for filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();

        return view('colleges.arts', compact('field', 'colleges', 'districts'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/commerce-colleges
     | Dedicated interactive page for Commerce & Finance
     ────────────────────────────────────────────── */
    public function commerceColleges()
    {
        $field = Field::where('slug', 'commerce')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Districts for filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();

        return view('colleges.commerce', compact('field', 'colleges', 'districts'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/agriculture-colleges
     | Dedicated interactive page for Agri Sciences
     ────────────────────────────────────────────── */
    public function agricultureColleges()
    {
        $field = Field::where('slug', 'agriculture')->firstOrFail();
        
        // Fetch all colleges in this field
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Districts for filter
        $districts = $colleges->pluck('location')->unique()->sort()->values();

        return view('colleges.agriculture', compact('field', 'colleges', 'districts'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/skill-development
     | Focused on courses, skills, and outcomes
     ────────────────────────────────────────────── */
    public function skillDevelopment()
    {
        $field = Field::where('slug', 'skill-development')->firstOrFail();
        
        $skillCourses = SkillCourse::where('field_id', $field->id)->get();
        
        // Group by category_title for the view
        $categories = $skillCourses->groupBy('category_title')->map(function ($items, $title) {
            return [
                'title' => $title,
                'icon' => $this->getCategoryIcon($title),
                'skills' => $items->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'desc' => $item->description,
                        'tools' => $item->tools,
                        'duration' => $item->duration,
                        'diff' => $item->difficulty,
                        'salary' => $item->salary_potential,
                        'jobs' => $item->job_roles,
                    ];
                })
            ];
        })->values();

        return view('colleges.skills', compact('field', 'categories'));
    }

    private function getCategoryIcon($title)
    {
        return match($title) {
            'Programming & IT' => 'fa-code',
            'Design & Creative' => 'fa-palette',
            'Business & Finance' => 'fa-chart-pie',
            'Digital Marketing' => 'fa-bullhorn',
            default => 'fa-star',
        };
    }

    /* ─────────────────────────────────────────────
     | GET /explore/sports-careers
     | Focused on athletics, training, and academies
     ────────────────────────────────────────────── */
    public function sportsCareers()
    {
        $field = Field::where('slug', 'sports')->firstOrFail();

        $sports = SportCareer::all();

        $careers = Career::where('field_id', $field->id)->get()->map(function($c) {
            return [
                'role' => $c->name,
                'salary' => $c->salary_range,
                'scope' => $c->qualification . ' | ' . $c->description,
            ];
        });

        return view('colleges.sports', compact('field', 'sports', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/small-scale-business
     | Focused on entrepreneurship and ideas
     ────────────────────────────────────────────── */
    public function smallScaleBusiness()
    {
        $field = Field::where('slug', 'small-scale')->firstOrFail();

        $ideas = BusinessIdea::where('field_id', $field->id)->get();
        
        // Mock categories for the view logic
        $businessCategories = [
            [
                'title' => 'Food & Catering',
                'icon' => 'fa-utensils',
                'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Homemade Cloud Kitchen', 'Stall / Food Truck']))->values()
            ],
            [
                'title' => 'Digital & Online',
                'icon' => 'fa-globe',
                'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['E-Commerce Reselling', 'Content Creation Studio']))->values()
            ],
            [
                'title' => 'Fashion & Clothing',
                'icon' => 'fa-shirt',
                'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Custom Embroidery/Tailoring', 'Print-on-Demand Store']))->values()
            ],
            [
                'title' => 'Education & Services',
                'icon' => 'fa-book-reader',
                'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Tutoring Center', 'Event Planning']))->values()
            ]
        ];

        return view('colleges.business_ideas', compact('field', 'businessCategories'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/traditional-careers
     | Focused on stable, established paths
     ────────────────────────────────────────────── */
    public function traditionalCareers()
    {
        $field = Field::where('slug', 'traditional')->firstOrFail();

        $careers = TraditionalCareer::all();
        $careerPaths = $careers->groupBy('category')->map(function($items, $cat) {
            return [
                'category' => $cat,
                'icon' => $items->first()->icon,
                'paths' => $items->map(function($item) {
                    return [
                        'name' => $item->name,
                        'edu' => $item->education,
                        'exam' => $item->exam,
                        'duration' => $item->duration,
                        'salary' => $item->salary,
                        'stability' => $item->stability,
                    ];
                })
            ];
        })->values();

        return view('colleges.traditional', compact('field', 'careerPaths'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/competitive-exams
     | Comprehensive guide to Government, Banking, etc.
     ────────────────────────────────────────────── */
    public function competitiveExams()
    {
        $field = Field::where('slug', 'traditional')->first() ?? Field::first();
        
        $exams = CompetitiveExam::all();
        $categories = $exams->groupBy('category');

        return view('colleges.exams', compact('field', 'categories'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/non-traditional-careers
     | Guide to Digital, Creative, and Modern paths
     ────────────────────────────────────────────── */
    /* ─────────────────────────────────────────────
     | GET /explore/government-defence
     ────────────────────────────────────────────── */
    public function governmentDefence()
    {
        $field = Field::where('slug', 'government-defence')->firstOrFail();
        $careers = TraditionalCareer::where('category', 'Government & Defence')->get();
        return view('colleges.traditional_detail', compact('field', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/teaching-law
     ────────────────────────────────────────────── */
    public function teachingLaw()
    {
        $field = Field::where('slug', 'teaching-law')->firstOrFail();
        $careers = TraditionalCareer::where('category', 'Teaching & Law')->get();
        return view('colleges.traditional_detail', compact('field', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | Non-Traditional Sub-Categories
     ────────────────────────────────────────────── */
    public function modernTech()
    {
        $field = Field::where('slug', 'modern-tech')->firstOrFail();
        $careers = NonTraditionalCareer::where('category', 'Tech & Digital Careers')->get();
        return view('colleges.non_traditional_detail', compact('field', 'careers'));
    }

    public function creativeCareers()
    {
        $field = Field::where('slug', 'creative-careers')->firstOrFail();
        $careers = NonTraditionalCareer::where('category', 'Creative Careers')->get();
        return view('colleges.non_traditional_detail', compact('field', 'careers'));
    }

    public function socialMedia()
    {
        $field = Field::where('slug', 'social-media')->firstOrFail();
        $careers = NonTraditionalCareer::where('category', 'Social Media Careers')->get();
        return view('colleges.non_traditional_detail', compact('field', 'careers'));
    }

    public function gamingCareers()
    {
        $field = Field::where('slug', 'gaming-careers')->firstOrFail();
        $careers = NonTraditionalCareer::where('category', 'Gaming Careers')->get();
        return view('colleges.non_traditional_detail', compact('field', 'careers'));
    }

    public function freelancing()
    {
        $field = Field::where('slug', 'freelancing')->firstOrFail();
        $careers = NonTraditionalCareer::where('category', 'Freelancing & Remote Work')->get();
        return view('colleges.non_traditional_detail', compact('field', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/career-path/{field}
     ────────────────────────────────────────────── */
    public function careerPath(Field $field)
    {
        // Only arts-humanities is implemented for now
        if ($field->slug === 'arts-humanities') {
            return view('career_paths.arts', compact('field'));
        }

        return back()->with('info', 'Career path guide for ' . $field->name . ' is coming soon!');
    }
}

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
    public function byField($field)
    {
        // 1. Normalize slug / alias mapping
        $slug = is_numeric($field) ? null : strtolower(trim($field));
        
        $aliasMap = [
            'technology' => 'technology-engineering',
            'engineering' => 'technology-engineering',
            'technology-engineering' => 'technology-engineering',
            'technology-/-engineering' => 'technology-engineering',
            'technology-and-engineering' => 'technology-engineering',
            
            'commerce' => 'commerce',
            'commerce-banking-corporate' => 'commerce',
            'commerce,-banking-&-corporate' => 'commerce',
            'banking' => 'commerce',
            'corporate' => 'commerce',
            
            'arts' => 'arts-humanities',
            'arts-humanities' => 'arts-humanities',
            'humanities' => 'arts-humanities',
            
            'business' => 'business',
            'business-administration' => 'business',
            'management' => 'business',
            
            'medical' => 'medical',
            'medicine' => 'medical',
            'doctor' => 'medical',
            
            'agriculture' => 'agriculture',
            'sports' => 'sports',
            'skill-development' => 'skill-development',
            'hotel-management' => 'hotel-management',
            'pharmacy' => 'pharmacy',
            'ayush-allied' => 'ayush-allied',
            'small-scale' => 'small-scale',
            'government-defence' => 'government-defence',
            'teaching-law' => 'teaching-law',
            'modern-tech' => 'modern-tech',
            'creative-careers' => 'creative-careers',
            'social-media' => 'social-media',
            'gaming-careers' => 'gaming-careers',
            'freelancing' => 'freelancing',
            'competitive-exams' => 'competitive-exams',
        ];

        $targetSlug = $aliasMap[$slug] ?? $slug;

        // 2. Fetch the Field model
        if (is_numeric($field)) {
            $fieldModel = Field::find($field);
        } else {
            $fieldModel = Field::where('slug', $targetSlug)->first();
        }

        // 3. Fallback if slug is unknown/not found in DB
        if (!$fieldModel) {
            $searchQuery = \Illuminate\Support\Str::title(str_replace('-', ' ', $field));
            return redirect()->route('explore.index', ['search' => $searchQuery]);
        }

        // 4. If it's a browser request (not AJAX), redirect to the user-facing page
        if (!request()->ajax() && !request()->wantsJson()) {
            $careerPathRoutes = [
                'technology-engineering' => '/career-path/technology-engineering',
                'medical' => '/career-path/medical',
                'business' => '/career-path/business',
                'science' => '/career-path/science',
                'arts-humanities' => '/career-path/arts-humanities',
                'commerce' => '/career-path/commerce',
                'agriculture' => '/career-path/agriculture',
                'sports' => '/career-path/sports',
                'skill-development' => '/career-path/skill-development',
                'modern-tech' => '/career-path/modern-tech-ai',
                'creative-careers' => '/career-path/creative-careers',
                'social-media' => '/career-path/social-media-content',
                'gaming-careers' => '/career-path/gaming-esports',
                'freelancing' => '/career-path/freelancing-remote',
                'government-defence' => '/explore/government-defence',
                'teaching-law' => '/explore/teaching-law',
                'hotel-management' => '/explore/hotel-management-colleges',
                'pharmacy' => '/explore/pharmacy-colleges',
                'ayush-allied' => '/explore/non-mbbs-colleges',
                'small-scale' => '/explore/small-scale-business',
                'competitive-exams' => '/explore/competitive-exams',
            ];

            $url = $careerPathRoutes[$fieldModel->slug] ?? '/career-path/' . $fieldModel->slug;
            return redirect(url($url));
        }

        // 5. If it's AJAX, return JSON
        $careers  = Career::with('field', 'subjects')
                          ->where('field_id', $fieldModel->id)
                          ->orderBy('name')
                          ->get()
                          ->map(fn($c) => $this->formatCareer($c));

        $colleges = College::where('field_id', $fieldModel->id)
                           ->orderBy('name')
                           ->get();

        return response()->json([
            'careers'  => $careers,
            'colleges' => $colleges,
            'field'    => $fieldModel,
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

        $colleges = College::where('field_id', $career->field_id)
                           ->limit(5)
                           ->get();

        return response()->json([
            'career'   => $this->formatCareer($career),
            'colleges' => $colleges,
        ]);
    }

    /* ─────────────────────────────────────────────
     | GET /career/{slug}
     | Dedicated career detail page
     ────────────────────────────────────────────── */
    public function careerDetailPage($slug)
    {
        $career = Career::where('slug', $slug)->with('field')->firstOrFail();
        
        $related = Career::where('field_id', $career->field_id)
                         ->where('id', '!=', $career->id)
                         ->inRandomOrder()
                         ->limit(3)
                         ->get();

        return view('career.detail', compact('career', 'related'));
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
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhereHas('field', function($qField) use ($q) {
                          $qField->where('name', 'like', "%{$q}%");
                      });
            })
            ->orderBy('name')
            ->get()
            ->map(fn($c) => $this->formatCareer($c));

        return response()->json(['careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | GET /explore/field-search?q=
     | Search for career fields and careers with autocomplete
     ────────────────────────────────────────────── */
    public function fieldSearch(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json(['fields' => [], 'careers' => []]);
        }

        // Search fields
        $fields = Field::where('slug', '!=', 'others')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('slug', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->limit(5) // Limit fields to avoid overwhelming results
            ->get()
            ->map(function ($field) {
                return [
                    'id' => $field->id,
                    'name' => $field->name,
                    'slug' => $field->slug,
                    'icon' => $field->icon ?? 'fa-folder',
                    'color' => $field->color ?? '#4f46e5',
                    'bg_color' => $field->bg_color ?? '#e0e7ff',
                    'type' => 'field',
                    'has_career_path' => in_array($field->slug, [
                        'technology-engineering', 'medical', 'business', 'science', 
                        'arts-humanities', 'commerce', 'agriculture', 'sports',
                        'skill-development', 'modern-tech', 'creative-careers',
                        'social-media', 'gaming-careers', 'freelancing',
                        'government-defence', 'teaching-law', 'hotel-management',
                        'pharmacy', 'ayush-allied', 'small-scale'
                    ])
                ];
            });

        // Search careers
        $careers = Career::with('field')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('slug', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->limit(10) // Limit careers to avoid overwhelming results
            ->get()
            ->map(function ($career) {
                return [
                    'id' => $career->id,
                    'name' => $career->name,
                    'slug' => $career->slug,
                    'icon' => $career->icon ?? 'fa-briefcase',
                    'description' => $career->description,
                    'field_id' => $career->field_id,
                    'field_name' => $career->field ? $career->field->name : 'General',
                    'field_slug' => $career->field ? $career->field->slug : 'general',
                    'field_color' => $career->field ? $career->field->color : '#4f46e5',
                    'field_bg_color' => $career->field ? $career->field->bg_color : '#e0e7ff',
                    'type' => 'career'
                ];
            });

        return response()->json(['fields' => $fields, 'careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | GET /global-search?q=
     | Global search for DB Careers and Config Paths
     ────────────────────────────────────────────── */
    public function globalSearch(Request $request): JsonResponse
    {
        $q = trim(strtolower($request->input('q', '')));

        if (strlen($q) < 2) {
            return response()->json(['db_careers' => [], 'config_careers' => [], 'colleges' => [], 'blogs' => []]);
        }

        // 1. Search Fields (Main fields and sub-fields)
        $careerPathRoutes = [
            'technology-engineering' => '/career-path/technology-engineering',
            'medical' => '/career-path/medical',
            'business' => '/career-path/business',
            'science' => '/career-path/science',
            'arts-humanities' => '/career-path/arts-humanities',
            'commerce' => '/career-path/commerce',
            'agriculture' => '/career-path/agriculture',
            'sports' => '/career-path/sports',
            'skill-development' => '/career-path/skill-development',
            'modern-tech' => '/career-path/modern-tech-ai',
            'creative-careers' => '/career-path/creative-careers',
            'social-media' => '/career-path/social-media-content',
            'gaming-careers' => '/career-path/gaming-esports',
            'freelancing' => '/career-path/freelancing-remote',
            'government-defence' => '/explore/government-defence',
            'teaching-law' => '/explore/teaching-law',
            'hotel-management' => '/explore/hotel-management-colleges',
            'pharmacy' => '/explore/pharmacy-colleges',
            'ayush-allied' => '/explore/non-mbbs-colleges',
            'small-scale' => '/explore/small-scale-business',
            'competitive-exams' => '/explore/competitive-exams',
        ];

        $fields = \App\Models\Field::where('name', 'like', "%{$q}%")
            ->limit(5)
            ->get()
            ->map(function ($f) use ($careerPathRoutes) {
                $path = $careerPathRoutes[$f->slug] ?? '/career-path/' . $f->slug;
                return [
                    'slug' => $f->slug,
                    'name' => $f->name,
                    'icon' => $f->icon ?? 'fa-folder',
                    'bg_color' => $f->bg_color ?? '#e0e7ff',
                    'color' => $f->color ?? '#4f46e5',
                    'url' => url($path),
                ];
            });

        // 2. Search Database Careers
        $dbCareers = Career::with('field')
            ->where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->limit(8)
            ->get()
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'slug' => $c->slug,
                    'description' => substr($c->description, 0, 100) . '...',
                    'icon' => $c->icon ?? 'fa-briefcase',
                    'field' => $c->field ? $c->field->name : 'General',
                    'bg_color' => $c->field ? $c->field->bg_color : '#f1f5f9',
                    'color' => $c->field ? $c->field->color : '#64748b',
                    'url' => url('/career/' . $c->slug),
                ];
            });

        // 3. Search Colleges
        $colleges = College::with('field')
            ->where('name', 'like', "%{$q}%")
            ->orWhere('location', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->orWhere('popular_branches', 'like', "%{$q}%")
            ->limit(5)
            ->get()
            ->map(function ($c) {
                $slug = $c->field ? $c->field->slug : '';
                $url = route('explore.index');
                if ($slug === 'technology-engineering') $url = route('explore.engineering-colleges');
                elseif ($slug === 'medical') $url = route('explore.medical-colleges');
                elseif ($slug === 'hotel-management') $url = route('explore.hotel-management-colleges');
                elseif ($slug === 'business') $url = route('explore.management-colleges');
                elseif ($slug === 'pharmacy') $url = route('explore.pharmacy-colleges');
                elseif ($slug === 'ayush-allied') $url = route('explore.non-mbbs-colleges');
                elseif ($slug === 'science') $url = route('explore.science-colleges');
                elseif ($slug === 'arts-humanities') $url = route('explore.arts-humanities-colleges');
                elseif ($slug === 'commerce') $url = route('explore.commerce-colleges');
                elseif ($slug === 'agriculture') $url = route('explore.agriculture-colleges');

                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'location' => $c->location . ', ' . $c->state,
                    'type' => $c->type,
                    'branches' => substr($c->popular_branches ?? 'General', 0, 80),
                    'url' => $url . '?college_id=' . $c->id,
                    'field' => $c->field ? $c->field->name : 'Institute',
                ];
            });

        // 4. Search Blogs
        $blogs = \App\Models\Blog::where('title', 'like', "%{$q}%")
            ->orWhere('excerpt', 'like', "%{$q}%")
            ->orWhere('content', 'like', "%{$q}%")
            ->orWhere('category', 'like', "%{$q}%")
            ->limit(5)
            ->get()
            ->map(function ($b) {
                return [
                    'title' => $b->title,
                    'slug' => $b->slug,
                    'category' => $b->category,
                    'excerpt' => substr(strip_tags($b->excerpt ?: $b->content), 0, 80) . '...',
                    'url' => route('blog.show', $b->slug),
                ];
            });

        return response()->json([
            'db_careers' => $dbCareers,
            'config_careers' => $fields,
            'colleges' => $colleges,
            'blogs' => $blogs,
        ]);
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
            'image'         => $career->image,
            'field'         => [
                'id'       => $career->field->id,
                'name'     => $career->field->name,
                'color'    => $career->field->color,
                'bg_color' => $career->field->bg_color,
                'slug'     => $career->field->slug,
            ],
            'subjects'      => $career->subjects->pluck('name'),
        ];
    }

    public function engineeringColleges(Request $request)
    {
        $field = Field::where('slug', 'technology-engineering')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $types = $colleges->pluck('type')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.index', compact('field', 'colleges', 'districts', 'types', 'states'));
    }

    public function medicalColleges(Request $request)
    {
        $field = Field::where('slug', 'medical')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $types = $colleges->pluck('type')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.medical', compact('field', 'colleges', 'districts', 'types', 'states'));
    }

    public function hotelColleges(Request $request)
    {
        $field = Field::where('slug', 'hotel-management')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $locations = $colleges->pluck('location')->unique()->sort()->values();
        $tiers = ['Tier 1', 'Tier 2', 'Tier 3'];
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.hotel', compact('field', 'colleges', 'locations', 'tiers', 'states'));
    }

    public function managementColleges(Request $request)
    {
        $field = Field::where('slug', 'business')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $types = $colleges->pluck('type')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.management', compact('field', 'colleges', 'districts', 'types', 'states'));
    }

    public function pharmacyColleges(Request $request)
    {
        $field = Field::where('slug', 'pharmacy')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $types = $colleges->pluck('type')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.pharmacy', compact('field', 'colleges', 'districts', 'types', 'states'));
    }

    public function nonMbbsColleges(Request $request)
    {
        $field = Field::where('slug', 'ayush-allied')->first() ?? Field::where('slug', 'medical')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $courses = ['BAMS', 'BHMS', 'BUMS', 'BNYS', 'BPT', 'BDS'];
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.non_mbbs', compact('field', 'colleges', 'courses', 'districts', 'states'));
    }

    public function scienceColleges(Request $request)
    {
        $field = Field::where('slug', 'science')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.science', compact('field', 'colleges', 'districts', 'states'));
    }

    public function artsColleges(Request $request)
    {
        $field = Field::where('slug', 'arts-humanities')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.arts', compact('field', 'colleges', 'districts', 'states'));
    }

    public function commerceColleges(Request $request)
    {
        $field = Field::where('slug', 'commerce')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.commerce', compact('field', 'colleges', 'districts', 'states'));
    }

    public function agricultureColleges(Request $request)
    {
        $field = Field::where('slug', 'agriculture')->firstOrFail();
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();
        if ($request->has('college_id')) {
            $selected = College::find($request->input('college_id'));
            if ($selected && $selected->field_id == $field->id) {
                if (!$colleges->contains('id', $selected->id)) {
                    $colleges->prepend($selected); $colleges = $colleges->values();
                }
            }
        }
        $districts = $colleges->pluck('location')->unique()->sort()->values();
        $states = $colleges->pluck('state')->unique()->sort()->values();
        return view('colleges.agriculture', compact('field', 'colleges', 'districts', 'states'));
    }

    public function skillDevelopment()
    {
        $field = Field::where('slug', 'skill-development')->firstOrFail();
        $skillCourses = SkillCourse::where('field_id', $field->id)->get();
        $categories = $skillCourses->groupBy('category_title')->map(function ($items, $title) {
            return [
                'title' => $title,
                'icon' => $this->getCategoryIcon($title),
                'skills' => $items->map(fn($item) => [
                    'name' => $item->name,
                    'desc' => $item->description,
                    'tools' => $item->tools,
                    'duration' => $item->duration,
                    'diff' => $item->difficulty,
                    'salary' => $item->salary_potential,
                    'jobs' => $item->job_roles,
                ])
            ];
        })->values();
        return view('colleges.skills', compact('field', 'categories'));
    }

    public function sportsCareers()
    {
        $field = Field::where('slug', 'sports')->firstOrFail();
        $sports = SportCareer::all();
        $careers = Career::where('field_id', $field->id)->get()->map(fn($c) => [
            'role' => $c->name,
            'salary' => $c->salary_range,
            'scope' => $c->qualification . ' | ' . $c->description,
        ]);
        return view('colleges.sports', compact('field', 'sports', 'careers'));
    }

    public function smallScaleBusiness()
    {
        $field = Field::where('slug', 'small-scale')->firstOrFail();
        $ideas = BusinessIdea::where('field_id', $field->id)->get();
        $businessCategories = [
            ['title' => 'Food & Catering', 'icon' => 'fa-utensils', 'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Homemade Cloud Kitchen', 'Stall / Food Truck']))->values()],
            ['title' => 'Digital & Online', 'icon' => 'fa-globe', 'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['E-Commerce Reselling', 'Content Creation Studio']))->values()],
            ['title' => 'Fashion & Clothing', 'icon' => 'fa-shirt', 'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Custom Embroidery/Tailoring', 'Print-on-Demand Store']))->values()],
            ['title' => 'Education & Services', 'icon' => 'fa-book-reader', 'ideas' => $ideas->filter(fn($i) => in_array($i->name, ['Tutoring Center', 'Event Planning']))->values()]
        ];
        return view('colleges.business_ideas', compact('field', 'businessCategories'));
    }

    public function traditionalCareers()
    {
        $field = Field::where('slug', 'traditional')->firstOrFail();
        $careers = TraditionalCareer::all();
        $careerPaths = $careers->groupBy('category')->map(fn($items, $cat) => [
            'category' => $cat,
            'icon' => $items->first()->icon,
            'paths' => $items->map(fn($item) => [
                'name' => $item->name,
                'edu' => $item->education,
                'exam' => $item->exam,
                'duration' => $item->duration,
                'salary' => $item->salary,
                'stability' => $item->stability,
            ])
        ])->values();
        return view('colleges.traditional', compact('field', 'careerPaths'));
    }

    public function competitiveExams()
    {
        $field = Field::where('slug', 'traditional')->first() ?? Field::first();
        $exams = CompetitiveExam::all();
        $categories = $exams->groupBy('category');
        return view('colleges.exams', compact('field', 'categories'));
    }

    public function nonTraditionalCareers()
    {
        return redirect()->route('career.path', 'non-traditional-careers');
    }

    public function governmentDefence()
    {
        $field = Field::where('slug', 'government-defence')->firstOrFail();
        $careers = Career::where('field_id', $field->id)
                         ->orderBy('sub_domain')
                         ->orderBy('name')
                         ->get();
        
        $categories = $careers->groupBy('sub_domain');
        
        return view('colleges.government_defence', compact('field', 'categories'));
    }

    public function teachingLaw()
    {
        $field = Field::where('slug', 'teaching-law')->firstOrFail();
        $careers = TraditionalCareer::where('category', 'Teaching & Law')->get();
        return view('colleges.traditional_detail', compact('field', 'careers'));
    }

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

    public function careerPath(Field $field)
    {
        return back()->with('info', 'Career path guide for ' . $field->name . ' is coming soon!');
    }

    /**
     * Get FontAwesome icon class for skill category
     */
    private function getCategoryIcon($title)
    {
        $iconMap = [
            'Technical Skills' => 'fa-solid fa-laptop-code',
            'Vocational Skills' => 'fa-solid fa-tools',
            'Digital Skills' => 'fa-solid fa-computer',
            'Creative Skills' => 'fa-solid fa-palette',
            'Business Skills' => 'fa-solid fa-briefcase',
            'Communication Skills' => 'fa-solid fa-comments',
            'Healthcare Skills' => 'fa-solid fa-heart-pulse',
            'Agriculture Skills' => 'fa-solid fa-seedling',
            'Hospitality Skills' => 'fa-solid fa-hotel',
        ];

        return $iconMap[$title] ?? 'fa-solid fa-star';
    }
}

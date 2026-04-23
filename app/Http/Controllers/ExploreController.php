<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\College;
use App\Models\Field;
use App\Models\Subject;
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

        $colleges = College::where('field_id', $career->field_id)
                           ->orderBy('type')
                           ->get();

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
        $colleges = College::where('field_id', $field->id)->orderByRaw('-rank DESC')->orderBy('name')->get();

        // Get unique districts/locations for the filter
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
        
        $categories = [
            [
                'title' => 'Programming & IT',
                'icon' => 'fa-code',
                'skills' => [
                    ['name' => 'Web Development', 'desc' => 'Building websites and web apps', 'tools' => 'HTML, CSS, JS, React, PHP', 'duration' => '4-6 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹12L', 'jobs' => 'Frontend, Backend, Fullstack Developer'],
                    ['name' => 'Python for Data Science', 'desc' => 'Analyzing data and building AI models', 'tools' => 'Python, Pandas, NumPy, Scikit-learn', 'duration' => '6 Months', 'diff' => 'Intermediate', 'salary' => '₹5L - ₹15L', 'jobs' => 'Data Analyst, ML Engineer'],
                ]
            ],
            [
                'title' => 'Design & Creative',
                'icon' => 'fa-palette',
                'skills' => [
                    ['name' => 'Graphic Design', 'desc' => 'Visual communication and branding', 'tools' => 'Photoshop, Illustrator, Canva', 'duration' => '3 Months', 'diff' => 'Beginner', 'salary' => '₹3L - ₹8L', 'jobs' => 'UI Designer, Brand Identity Artist'],
                    ['name' => 'Video Editing', 'desc' => 'Creating and polishing video content', 'tools' => 'Premiere Pro, After Effects', 'duration' => '3-4 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹10L', 'jobs' => 'Video Editor, Motion Graphics Designer'],
                ]
            ],
            [
                'title' => 'Business & Finance',
                'icon' => 'fa-chart-pie',
                'skills' => [
                    ['name' => 'Tally & GST', 'desc' => 'Modern accounting and taxation', 'tools' => 'Tally Prime, Excel, GST Portal', 'duration' => '2 Months', 'diff' => 'Beginner', 'salary' => '₹2.5L - ₹6L', 'jobs' => 'Accountant, GST Consultant'],
                    ['name' => 'Stock Market Trading', 'desc' => 'Technical analysis and investment', 'tools' => 'TradingView, Zerodha', 'duration' => '3 Months', 'diff' => 'Advanced', 'salary' => 'Profit-based', 'jobs' => 'Portfolio Manager, Trader'],
                ]
            ],
            [
                'title' => 'Digital Marketing',
                'icon' => 'fa-bullhorn',
                'skills' => [
                    ['name' => 'Social Media Marketing', 'desc' => 'Growing brands on FB, IG, LinkedIn', 'tools' => 'Meta Ads, Buffer, Analytics', 'duration' => '3 Months', 'diff' => 'Beginner', 'salary' => '₹3L - ₹9L', 'jobs' => 'SMM Specialist, Content Planner'],
                    ['name' => 'SEO Specialist', 'desc' => 'Ranking websites on Google', 'tools' => 'Ahrefs, Semrush, Console', 'duration' => '4 Months', 'diff' => 'Intermediate', 'salary' => '₹4L - ₹10L', 'jobs' => 'SEO Strategist, Web Analyst'],
                ]
            ]
        ];

        return view('colleges.skills', compact('field', 'categories'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/sports-careers
     | Focused on athletics, training, and academies
     ────────────────────────────────────────────── */
    public function sportsCareers()
    {
        $field = Field::where('slug', 'sports')->firstOrFail();

        $sports = [
            ['name' => 'Cricket', 'icon' => 'fa-baseball-bat-ball', 'desc' => 'The most popular sport in India with vast career scope in IPL and National teams.'],
            ['name' => 'Football', 'icon' => 'fa-futbol', 'desc' => 'Rapidly growing with ISL and local leagues, offering paths for players and coaches.'],
            ['name' => 'Badminton', 'icon' => 'fa-shuttlecock', 'desc' => 'Highly competitive with strong international presence from India.'],
            ['name' => 'Hockey', 'icon' => 'fa-hockey-puck', 'desc' => 'Our national pride with dedicated academies across the country.'],
            ['name' => 'Athletics', 'icon' => 'fa-person-running', 'desc' => 'Focus on Track & Field, Sprinting, and Olympics-based training.'],
            ['name' => 'Martial Arts', 'icon' => 'fa-user-ninja', 'desc' => 'Self-defense, Mixed Martial Arts (MMA), and Karate-based careers.'],
        ];

        $careers = [
            ['role' => 'Professional Athlete', 'salary' => '₹5L - ₹50Cr+', 'scope' => 'Leagues, National Teams, Sponsorships'],
            ['role' => 'Sports Coach', 'salary' => '₹3L - ₹15L', 'scope' => 'Schools, Clubs, Private Academies'],
            ['role' => 'Sports Manager', 'salary' => '₹4L - ₹20L', 'scope' => 'Event Management companies, Talent agencies'],
            ['role' => 'Sports Analyst', 'salary' => '₹4L - ₹12L', 'scope' => 'Broadcasting channels, Team scouting'],
            ['role' => 'Physiotherapist', 'salary' => '₹3L - ₹10L', 'scope' => 'Hospitals, Sports Teams, Rehabilitation Centers'],
        ];

        return view('colleges.sports', compact('field', 'sports', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/small-scale-business
     | Focused on entrepreneurship and ideas
     ────────────────────────────────────────────── */
    public function smallScaleBusiness()
    {
        $field = Field::where('slug', 'small-scale')->firstOrFail();

        $businessCategories = [
            [
                'title' => 'Food & Catering',
                'icon' => 'fa-utensils',
                'ideas' => [
                    ['name' => 'Homemade Cloud Kitchen', 'invest' => '₹20K - 50K', 'profit' => '20-40%', 'risk' => 'Low', 'desc' => 'Start a food delivery business from your own home kitchen using Zomato/Swiggy.'],
                    ['name' => 'Stall / Food Truck', 'invest' => '₹1L - 3L', 'profit' => '30-50%', 'risk' => 'Medium', 'desc' => 'Sell specialized snacks (Momo, Burgers, Chai) in high-traffic areas.'],
                ]
            ],
            [
                'title' => 'Digital & Online',
                'icon' => 'fa-globe',
                'ideas' => [
                    ['name' => 'E-Commerce Reselling', 'invest' => '₹5K - 20K', 'profit' => '15-30%', 'risk' => 'Low', 'desc' => 'Sell products via Instagram or WhatsApp Business by sourcing from wholesalers.'],
                    ['name' => 'Content Creation Studio', 'invest' => '₹50K - 1L', 'profit' => 'High', 'risk' => 'Low', 'desc' => 'Offer video editing or social media management services to local brands.'],
                ]
            ],
            [
                'title' => 'Fashion & Clothing',
                'icon' => 'fa-shirt',
                'ideas' => [
                    ['name' => 'Custom Embroidery/Tailoring', 'invest' => '₹10K - 30K', 'profit' => '40-60%', 'risk' => 'Low', 'desc' => 'Offer personalized boutique services or alterations from an at-home studio.'],
                    ['name' => 'Print-on-Demand Store', 'invest' => '₹15K - 40K', 'profit' => '20-30%', 'risk' => 'Low', 'desc' => 'Design custom t-shirts or hoodies and sell them via your own online brand.'],
                ]
            ],
            [
                'title' => 'Education & Services',
                'icon' => 'fa-book-reader',
                'ideas' => [
                    ['name' => 'Tutoring Center', 'invest' => '₹5K - 15K', 'profit' => 'High', 'risk' => 'Very Low', 'desc' => 'Start teaching school subjects or specialized skills like coding from home.'],
                    ['name' => 'Event Planning', 'invest' => '₹20K - 50K', 'profit' => '25-40%', 'risk' => 'Medium', 'desc' => 'Manage birthdays, small weddings, or corporate meetups in your city.'],
                ]
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

        $careerPaths = [
            [
                'category' => 'Engineering & Tech',
                'icon' => 'fa-microchip',
                'paths' => [
                    ['name' => 'Civil/Mech/Comp Engineering', 'edu' => 'B.E. / B.Tech', 'exam' => 'JEE Main/Adv, MHT-CET', 'duration' => '4 Years', 'salary' => '₹4L - ₹25L+', 'stability' => 'High'],
                ]
            ],
            [
                'category' => 'Medical Sciences',
                'icon' => 'fa-user-doctor',
                'paths' => [
                    ['name' => 'Doctor (MBBS)', 'edu' => 'MBBS', 'exam' => 'NEET UG', 'duration' => '5.5 Years', 'salary' => '₹8L - ₹30L+', 'stability' => 'Very High'],
                    ['name' => 'Dentistry / Nursing', 'edu' => 'BDS / B.Sc Nursing', 'exam' => 'NEET', 'duration' => '4 Years', 'salary' => '₹3L - ₹12L', 'stability' => 'High'],
                ]
            ],
            [
                'category' => 'Commerce & Finance',
                'icon' => 'fa-money-bill-trend-up',
                'paths' => [
                    ['name' => 'Chartered Accountant (CA)', 'edu' => 'CA Foundation/Inter/Final', 'exam' => 'ICAI Exams', 'duration' => '5 Years', 'salary' => '₹7L - ₹20L+', 'stability' => 'Very High'],
                    ['name' => 'Banking / IBPS', 'edu' => 'Any Graduate', 'exam' => 'IBPS PO/Clerk, SBI', 'duration' => '1 Year Prep', 'salary' => '₹4L - ₹10L', 'stability' => 'Very High'],
                ]
            ],
            [
                'category' => 'Government & Defence',
                'icon' => 'fa-shield-halved',
                'paths' => [
                    ['name' => 'Civil Services (IAS/IPS)', 'edu' => 'Any Graduate', 'exam' => 'UPSC / MPSC', 'duration' => '1-3 Years Prep', 'salary' => '₹7L - ₹15L', 'stability' => 'Absolute'],
                    ['name' => 'Military Officer', 'edu' => 'NDA / CDS', 'exam' => 'NDA, CDS Exams', 'duration' => '3-4 Years TRG', 'salary' => '₹8L - ₹18L', 'stability' => 'Absolute'],
                ]
            ],
            [
                'category' => 'Teaching & Law',
                'icon' => 'fa-graduation-cap',
                'paths' => [
                    ['name' => 'Legal Professional', 'edu' => 'LLB / Integrated LLB', 'exam' => 'CLAT, MH-CET Law', 'duration' => '3-5 Years', 'salary' => '₹5L - ₹30L', 'stability' => 'Medium-High'],
                    ['name' => 'Professor / Teacher', 'edu' => 'B.Ed / NET / SET', 'exam' => 'TET, NET', 'duration' => '2-4 Years', 'salary' => '₹3L - ₹12L', 'stability' => 'High'],
                ]
            ]
        ];

        return view('colleges.traditional', compact('field', 'careerPaths'));
    }
}

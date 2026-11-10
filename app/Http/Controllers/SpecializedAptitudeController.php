<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecializedAptitudeQuestion;
use App\Models\SpecializedCourse;
use App\Models\SpecializedTestAttempt;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SpecializedAptitudeController extends Controller
{
    /**
     * Supported specialized aptitude categories.
     */
    protected array $categories = [
        'spiritual' => [
            'key' => 'spiritual',
            'name' => 'Spiritual Aptitude',
            'tagline' => 'Mindfulness, Philosophical Ethics & Holistic Counseling',
            'icon' => 'fa-solid fa-spa',
            'color' => '#8b5cf6',
            'color_dark' => '#6d28d9',
            'bg_light' => '#f5f3ff',
            'badge_bg' => '#ede9fe',
            'description' => 'Evaluates conscience-driven decision making, existential contemplation, emotional equilibrium, empathy, and ethical leadership.',
            'focus_traits' => ['Philosophical Dialectics', 'Equanimity & Mindfulness', 'Compassionate Empathy', 'Integrative Health & Yoga', 'Ethical Leadership'],
        ],
        'artistic' => [
            'key' => 'artistic',
            'name' => 'Artistic Aptitude',
            'tagline' => 'Visual Aesthetics, Spatial Design & Creative Expression',
            'icon' => 'fa-solid fa-palette',
            'color' => '#ec4899',
            'color_dark' => '#be185d',
            'bg_light' => '#fdf2f8',
            'badge_bg' => '#fce7f3',
            'description' => 'Measures color theory instincts, spatial composition, visual storytelling, design hierarchy, and multimedia creative problem solving.',
            'focus_traits' => ['Color Harmony & Contrast', 'Visual Hierarchy & UI/UX', 'Storyboarding & Direction', 'Spatial Geometry & Lighting', 'Creative Originality'],
        ],
        'sports' => [
            'key' => 'sports',
            'name' => 'Sports Aptitude',
            'tagline' => 'Athletic Intelligence, Kinesiology & Tactical Strategy',
            'icon' => 'fa-solid fa-medal',
            'color' => '#10b981',
            'color_dark' => '#047857',
            'bg_light' => '#ecfdf5',
            'badge_bg' => '#d1fae5',
            'description' => 'Assesses spatial game awareness, biomechanics, physiological recovery, athletic leadership, sports psychology, and coaching strategy.',
            'focus_traits' => ['Kinetic Chain Biomechanics', 'Spatial & Tactical Anticipation', 'Sports Psychology & Focus', 'Conditioning & Periodization', 'Coaching & Game Management'],
        ],
        'business' => [
            'key' => 'business',
            'name' => 'Business Aptitude',
            'tagline' => 'Venture Strategy, Commercial Acumen & Enterprise Growth',
            'icon' => 'fa-solid fa-briefcase',
            'color' => '#f59e0b',
            'color_dark' => '#b45309',
            'bg_light' => '#fffbeb',
            'badge_bg' => '#fef3c7',
            'description' => 'Evaluates entrepreneurial instincts, customer value discovery, cash flow management, negotiation leverage, and strategic execution.',
            'focus_traits' => ['Product-Market Fit & MVP', 'Unit Economics & Margins', 'High-Stakes Negotiation (BATNA)', 'Marketing & Social Proof', 'Transformational Leadership'],
        ],
    ];

    /**
     * Ensure questions and courses are auto-seeded if missing.
     */
    private function ensureDataSeeded(): void
    {
        if (SpecializedAptitudeQuestion::count() < 160 || SpecializedCourse::count() < 24) {
            try {
                (new \Database\Seeders\SpecializedAptitudeSeeder())->run();
            } catch (\Exception $e) {
                // Silently continue if duplicate keys exist
            }
        }
    }

    /**
     * Landing hub for all 4 Specialized Aptitude Evaluations.
     */
    public function index()
    {
        $this->ensureDataSeeded();
        $categories = $this->categories;
        $courses = SpecializedCourse::where('is_featured', true)->get()->groupBy('category');

        $latestAttempt = null;
        if (Auth::check()) {
            $latestAttempt = SpecializedTestAttempt::where('user_id', Auth::id())->latest()->first();
        }

        return view('specialized-aptitude.index', compact('categories', 'courses', 'latestAttempt'));
    }

    /**
     * Dedicated Section Landing Page for a single category.
     */
    public function show($category)
    {
        $this->ensureDataSeeded();
        $category = strtolower(trim($category));
        if (!isset($this->categories[$category])) {
            return redirect()->route('specialized-aptitude.index');
        }

        $meta = $this->categories[$category];
        $courses = SpecializedCourse::where('category', $category)->get();
        $questionsCount = SpecializedAptitudeQuestion::where('category', $category)->count();

        $userAttempt = null;
        if (Auth::check()) {
            $userAttempt = SpecializedTestAttempt::where('user_id', Auth::id())
                ->where('category', $category)
                ->latest()
                ->first();
        }

        return view('specialized-aptitude.show', compact('meta', 'courses', 'questionsCount', 'userAttempt'));
    }

    /**
     * 20-Question Randomized Assessment Quiz.
     */
    public function quiz($category)
    {
        $this->ensureDataSeeded();
        $category = strtolower(trim($category));
        if (!isset($this->categories[$category])) {
            return redirect()->route('specialized-aptitude.index');
        }

        $meta = $this->categories[$category];

        // Fetch 20 randomized questions for this domain
        $questions = SpecializedAptitudeQuestion::where('category', $category)
            ->inRandomOrder()
            ->take(20)
            ->get();

        if ($questions->isEmpty()) {
            return redirect()->route('specialized-aptitude.index')->with('error', 'Questions for this section are being prepared.');
        }

        return view('specialized-aptitude.quiz', compact('meta', 'questions'));
    }

    /**
     * Submit and evaluate the 20-question test.
     */
    public function submit(Request $request, $category)
    {
        $this->ensureDataSeeded();
        $category = strtolower(trim($category));
        if (!isset($this->categories[$category])) {
            return response()->json(['success' => false, 'message' => 'Invalid category.'], 400);
        }

        $answers = $request->input('answers', []);
        $studentName = $request->input('student_name', Auth::check() ? Auth::user()->name : 'Student Candidate');
        $studentEmail = $request->input('student_email', Auth::check() ? Auth::user()->email : 'candidate@careergyan.in');
        $studentPhone = $request->input('student_phone', Auth::check() ? Auth::user()->phone : null);

        // Fetch questions that were answered
        $questionIds = array_keys($answers);
        $questions = SpecializedAptitudeQuestion::where('category', $category)
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        $correctCount = 0;
        $totalQuestions = count($questionIds) > 0 ? count($questionIds) : 20;
        $questionDetails = [];

        foreach ($answers as $qId => $selectedOption) {
            $question = $questions->get($qId);
            if ($question) {
                $isCorrect = (strtoupper(trim($selectedOption)) === strtoupper(trim($question->correct_option)));
                if ($isCorrect) {
                    $correctCount++;
                }

                $questionDetails[] = [
                    'question_id' => $question->id,
                    'question_text' => $question->question_text,
                    'option_a' => $question->option_a,
                    'option_b' => $question->option_b,
                    'option_c' => $question->option_c,
                    'option_d' => $question->option_d,
                    'correct_option' => $question->correct_option,
                    'chosen_option' => $selectedOption,
                    'is_correct' => $isCorrect,
                    'explanation' => $question->explanation,
                ];
            }
        }

        $scorePercentage = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;

        // Determine qualitative aptitude level
        $aptitudeLevel = match (true) {
            $scorePercentage >= 80 => 'Advanced Domain Mastery',
            $scorePercentage >= 60 => 'Proficient & High Potential',
            $scorePercentage >= 40 => 'Promising Explorer',
            default => 'Emerging Trainee',
        };

        // Recommended Courses for this field
        $recommendedCourses = SpecializedCourse::where('category', $category)
            ->where('is_featured', true)
            ->get()
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'title' => $c->title,
                    'slug' => $c->slug,
                    'level' => $c->level,
                    'duration' => $c->duration,
                    'salary_range' => $c->salary_range,
                    'top_colleges' => array_slice($c->top_colleges ?? [], 0, 3),
                    'career_roles' => array_slice($c->career_roles ?? [], 0, 3),
                ];
            })
            ->toArray();

        // Create the attempt record
        $attempt = SpecializedTestAttempt::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'category' => $category,
            'student_name' => $studentName,
            'student_email' => $studentEmail,
            'student_phone' => $studentPhone,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctCount,
            'score_percentage' => $scorePercentage,
            'aptitude_level' => $aptitudeLevel,
            'answers' => $answers,
            'question_details' => $questionDetails,
            'recommended_courses' => $recommendedCourses,
        ]);

        // Award reward points for completing test if user is logged in
        $rewardMessage = null;
        if (Auth::check()) {
            try {
                $rewardService = app(\App\Services\RewardPointsService::class);
                $awarded = $rewardService->awardAptitudeTestReward(Auth::user(), $attempt->id);
                if ($awarded) {
                    $rewardMessage = "Congratulations! You earned {$awarded} reward points for completing your {$this->categories[$category]['name']} assessment.";
                    session()->flash('reward_notification', $rewardMessage);
                }
            } catch (\Exception $e) {
                // Ignore if already claimed
            }
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('specialized-aptitude.results', $attempt->uuid),
            'reward_message' => $rewardMessage,
        ]);
    }

    /**
     * Display Results Scorecard & Answersheet.
     */
    public function results($uuid)
    {
        $attempt = SpecializedTestAttempt::where('uuid', $uuid)->firstOrFail();
        $meta = $this->categories[strtolower($attempt->category)] ?? [
            'key' => $attempt->category,
            'name' => ucfirst($attempt->category) . ' Aptitude',
            'tagline' => 'Specialized Assessment',
            'icon' => 'fa-solid fa-brain',
            'color' => '#2563eb',
            'color_dark' => '#1d4ed8',
            'bg_light' => '#eff6ff',
            'badge_bg' => '#dbeafe',
        ];

        // Fetch full course models for recommendation
        $courses = SpecializedCourse::where('category', $attempt->category)->get();

        return view('specialized-aptitude.results', compact('attempt', 'meta', 'courses'));
    }

    /**
     * Browse Courses for all or specific categories.
     */
    public function courses(Request $request, $category = null)
    {
        $this->ensureDataSeeded();
        $selectedCategory = $category ? strtolower(trim($category)) : 'all';
        $query = SpecializedCourse::query();

        if ($selectedCategory !== 'all' && isset($this->categories[$selectedCategory])) {
            $query->where('category', $selectedCategory);
        }

        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%")
                  ->orWhere('eligibility', 'like', "%{$s}%");
            });
        }

        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        $courses = $query->orderBy('is_featured', 'desc')->paginate(12)->withQueryString();
        $categories = $this->categories;

        return view('specialized-aptitude.courses', compact('courses', 'categories', 'selectedCategory'));
    }
}


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
     * Supported individual sports for Sports Aptitude specialization.
     */
    public static array $sportsList = [
        'cricket' => [
            'slug' => 'cricket',
            'name' => 'Cricket',
            'tagline' => 'Aerodynamics of Swing, Fielding Placements, Pitch Dynamics & Decision Making',
            'icon' => 'fa-solid fa-baseball-bat-ball',
            'color' => '#0284c7',
            'color_dark' => '#0369a1',
            'bg_light' => '#e0f2fe',
            'description' => 'Evaluates batting biomechanics, swing & spin aerodynamics, field geometry, DRS decision-making, and tactical captaincy.',
        ],
        'football' => [
            'slug' => 'football',
            'name' => 'Football (Soccer)',
            'tagline' => 'Spatial Formations, High-Press Gegenpressing, Offside Trap & Kinetic Agility',
            'icon' => 'fa-solid fa-futbol',
            'color' => '#16a34a',
            'color_dark' => '#15803d',
            'bg_light' => '#dcfce7',
            'description' => 'Tests tactical shape anticipation, counter-pressing triggers, spatial half-space runs, set-piece execution, and player positioning.',
        ],
        'badminton' => [
            'slug' => 'badminton',
            'name' => 'Badminton',
            'tagline' => 'Split-Step Footwork, Shuttle Aerodynamics, Deceptive Drops & Wrist Mechanics',
            'icon' => 'fa-solid fa-feather',
            'color' => '#d97706',
            'color_dark' => '#b45309',
            'bg_light' => '#fef3c7',
            'description' => 'Assesses fast-twitch reaction time, pronation/supination smash mechanics, rally pacing, net control, and deceptive shot selection.',
        ],
        'athletics' => [
            'slug' => 'athletics',
            'name' => 'Athletics (Track & Field)',
            'tagline' => 'Triple Extension, VO2 Max Energy Systems, Hurdle Rhythm & Periodization',
            'icon' => 'fa-solid fa-person-running',
            'color' => '#dc2626',
            'color_dark' => '#b91c1c',
            'bg_light' => '#fee2e2',
            'description' => 'Measures track sprint drive phases, ground reaction force, lactic acid buffering, relay baton exchanges, and pacing economy.',
        ],
        'kabaddi' => [
            'slug' => 'kabaddi',
            'name' => 'Kabaddi',
            'tagline' => 'Corner-In Ankle Holds, Bonus Line Dynamics, Cant Breath Control & Chain Tackling',
            'icon' => 'fa-solid fa-hand-fist',
            'color' => '#ea580c',
            'color_dark' => '#c2410c',
            'bg_light' => '#ffedd5',
            'description' => 'Evaluates raider escape mechanics, corner chain coordination, super tackle positioning, do-or-die raid strategy, and cant control.',
        ],
        'basketball' => [
            'slug' => 'basketball',
            'name' => 'Basketball',
            'tagline' => 'Pick-and-Roll Reads, Fast-Break Transition, Zone Defenses & Shooting Arc',
            'icon' => 'fa-solid fa-basketball',
            'color' => '#f97316',
            'color_dark' => '#c2410c',
            'bg_light' => '#ffedd5',
            'description' => 'Assesses floor spacing, half-court pick-and-roll dissection, help-side rotation, shot contest biomechanics, and 24-second clock management.',
        ],
        'tennis' => [
            'slug' => 'tennis',
            'name' => 'Tennis',
            'tagline' => 'Topspin Angular Momentum, Kinetic Forehand Loading, Serve Placement & Break Points',
            'icon' => 'fa-solid fa-table-tennis-paddle-ball',
            'color' => '#65a30d',
            'color_dark' => '#4d7c0f',
            'bg_light' => '#ecfccb',
            'description' => 'Tests unit turn shoulder coils, Magnus topspin clearance, serve target variation, surface transition adaptations, and tie-break pressure play.',
        ],
        'volleyball' => [
            'slug' => 'volleyball',
            'name' => 'Volleyball',
            'tagline' => 'Rotational Overlap, Approach Step Vertical Jump, Float Serve & Block Defense',
            'icon' => 'fa-solid fa-volleyball',
            'color' => '#0d9488',
            'color_dark' => '#0f766e',
            'bg_light' => '#ccfbf1',
            'description' => 'Measures 3-step spike approach mechanics, float serve aerodynamic drift, double-block seam closure, libero coverage, and rotational rules.',
        ],
        'table-tennis' => [
            'slug' => 'table-tennis',
            'name' => 'Table Tennis',
            'tagline' => 'Brush Contact RPM, High-Frequency Footwork, Reverse Pendulum & Banana Flick',
            'icon' => 'fa-solid fa-table-tennis-paddle-ball',
            'color' => '#0891b2',
            'color_dark' => '#0e7490',
            'bg_light' => '#cffafe',
            'description' => 'Tests short-pip vs inverted rubber dynamics, banana flick over-the-table wrist snaps, heavy backspin push returns, and third-ball attack setups.',
        ],
        'hockey' => [
            'slug' => 'hockey',
            'name' => 'Field Hockey',
            'tagline' => 'Penalty Corner Drag-Flick Velocity, Aerial Passing, Low-Slung Tackling & Self-Pass',
            'icon' => 'fa-solid fa-hockey-puck',
            'color' => '#2563eb',
            'color_dark' => '#1d4ed8',
            'bg_light' => '#dbeafe',
            'description' => 'Assesses stick-face fulcrum drag-flick physics, circle entry angles, jab tackling without foot contact, aerial ball trapping, and self-pass exploitation.',
        ],
        'boxing' => [
            'slug' => 'boxing',
            'name' => 'Boxing & Combat Sports',
            'tagline' => 'Kinetic Chain Punch Power, Slip & Pivot Angles, 10-Point Must Scoring & Gas Tank',
            'icon' => 'fa-solid fa-hand-fist',
            'color' => '#991b1b',
            'color_dark' => '#7f1d1d',
            'bg_light' => '#fee2e2',
            'description' => 'Measures ground-up torque generation, bob-and-weave head movement angles, ring generalship, distance measuring jabs, and weight cut recovery.',
        ],
        'swimming' => [
            'slug' => 'swimming',
            'name' => 'Swimming & Aquatics',
            'tagline' => 'Hydrodynamic Streamlining, Dolphin Kick Core Waves, Stroke DPS & Turn Transitions',
            'icon' => 'fa-solid fa-person-swimming',
            'color' => '#0284c7',
            'color_dark' => '#0369a1',
            'bg_light' => '#e0f2fe',
            'description' => 'Tests frontal drag reduction, underwater 15m breakout regulation, stroke rate vs distance-per-stroke balance, bilateral breathing, and flip-turn propulsion.',
        ],
        'chess' => [
            'slug' => 'chess',
            'name' => 'Chess (Mind Sports)',
            'tagline' => 'Calculation Depth, Pawn Structure Imbalances, Zugzwang & Time Management',
            'icon' => 'fa-solid fa-chess-knight',
            'color' => '#4f46e5',
            'color_dark' => '#4338ca',
            'bg_light' => '#e0e7ff',
            'description' => 'Assesses multi-move tree calculation, prophylaxis against opponent plans, endgame lucena/philidor positions, pawn island analysis, and time-trouble composure.',
        ],
        'shooting' => [
            'slug' => 'shooting',
            'name' => 'Shooting & Archery',
            'tagline' => 'Trigger Squeeze Disassociation, Heart-Rate Bradycardia, Wind Drift & Nock Alignment',
            'icon' => 'fa-solid fa-bullseye',
            'color' => '#7c3aed',
            'color_dark' => '#6d28d9',
            'bg_light' => '#ede9fe',
            'description' => 'Evaluates respiratory pause trigger breaks, isometric skeletal stability, archer paradox compensation, wind flag mirage reading, and fine motor discipline.',
        ],
        'wrestling' => [
            'slug' => 'wrestling',
            'name' => 'Wrestling (Kushti)',
            'tagline' => 'Center of Gravity Control, Underhook Tie-Ups, Par Terre Defense & Level Changes',
            'icon' => 'fa-solid fa-shield-halved',
            'color' => '#b45309',
            'color_dark' => '#92400e',
            'bg_light' => '#fef3c7',
            'description' => 'Measures low penetration step mechanics, hip sprawl weight distribution, par terre gut-wrench defense, passivity shot clocks, and clay vs mat leverage.',
        ],
    ];

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

        if (SpecializedAptitudeQuestion::where('category', 'sports')->whereNotNull('sport')->where('sport', '!=', 'general')->count() < 150) {
            try {
                (new \Database\Seeders\SportsSpecificAptitudeSeeder())->run();
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
        $sportsList = ($category === 'sports') ? self::$sportsList : [];

        $userAttempt = null;
        if (Auth::check()) {
            $userAttempt = SpecializedTestAttempt::where('user_id', Auth::id())
                ->where('category', $category)
                ->latest()
                ->first();
        }

        return view('specialized-aptitude.show', compact('meta', 'courses', 'questionsCount', 'userAttempt', 'sportsList'));
    }

    /**
     * 20-Question Randomized Assessment Quiz.
     * For Sports Aptitude: 10 General Sports questions + 10 Sport-Specific questions for the chosen sport.
     */
    public function quiz(Request $request, $category)
    {
        $this->ensureDataSeeded();
        $category = strtolower(trim($category));
        if (!isset($this->categories[$category])) {
            return redirect()->route('specialized-aptitude.index');
        }

        $meta = $this->categories[$category];
        $sportsList = self::$sportsList;
        $sport = null;
        $sportMeta = null;

        if ($category === 'sports') {
            $chosenSport = strtolower(trim($request->query('sport', '')));
            if (!empty($chosenSport) && isset(self::$sportsList[$chosenSport])) {
                $sport = $chosenSport;
                $sportMeta = self::$sportsList[$sport];

                // 10 General athletic foundation questions
                $generalQuestions = SpecializedAptitudeQuestion::where('category', 'sports')
                    ->where(function ($q) {
                        $q->where('sport', 'general')->orWhereNull('sport');
                    })
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                // 10 Sport-specific questions
                $sportQuestions = SpecializedAptitudeQuestion::where('category', 'sports')
                    ->where('sport', $sport)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                // Fallback if sport questions count is less than 10
                if ($sportQuestions->count() < 10) {
                    $needed = 10 - $sportQuestions->count();
                    $extraGeneral = SpecializedAptitudeQuestion::where('category', 'sports')
                        ->where(function ($q) {
                            $q->where('sport', 'general')->orWhereNull('sport');
                        })
                        ->whereNotIn('id', $generalQuestions->pluck('id'))
                        ->inRandomOrder()
                        ->take($needed)
                        ->get();
                    $sportQuestions = $sportQuestions->concat($extraGeneral);
                }

                $questions = $generalQuestions->concat($sportQuestions);
                $needsSportSelection = false;
            } else {
                // User hasn't selected a sport yet: prompt sport selection
                $questions = collect();
                $needsSportSelection = true;
            }
        } else {
            // General 20 randomized questions for spiritual, artistic, business
            $questions = SpecializedAptitudeQuestion::where('category', $category)
                ->inRandomOrder()
                ->take(20)
                ->get();
            $needsSportSelection = false;
        }

        if (!$needsSportSelection && $questions->isEmpty()) {
            return redirect()->route('specialized-aptitude.index')->with('error', 'Questions for this section are being prepared.');
        }

        return view('specialized-aptitude.quiz', compact('meta', 'questions', 'sportsList', 'sport', 'sportMeta', 'needsSportSelection'));
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

        $sport = $request->input('sport');
        if ($category === 'sports' && (!empty($sport) && isset(self::$sportsList[$sport]))) {
            $sport = strtolower(trim($sport));
        } else {
            $sport = null;
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
        $generalCorrect = 0;
        $generalTotal = 0;
        $sportCorrect = 0;
        $sportTotal = 0;
        $totalQuestions = count($questionIds) > 0 ? count($questionIds) : 20;
        $questionDetails = [];

        foreach ($answers as $qId => $selectedOption) {
            $question = $questions->get($qId);
            if ($question) {
                $isCorrect = (strtoupper(trim($selectedOption)) === strtoupper(trim($question->correct_option)));
                if ($isCorrect) {
                    $correctCount++;
                }

                $isSportSpecific = ($category === 'sports' && $question->sport && $question->sport !== 'general');
                if ($isSportSpecific) {
                    $sportTotal++;
                    if ($isCorrect) $sportCorrect++;
                } else {
                    $generalTotal++;
                    if ($isCorrect) $generalCorrect++;
                }

                $questionDetails[] = [
                    'question_id' => $question->id,
                    'question_text' => $question->question_text,
                    'sport' => $question->sport ?? 'general',
                    'is_sport_specific' => $isSportSpecific,
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
            'sport' => $sport,
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

        $sportsList = self::$sportsList;
        $sportMeta = ($attempt->sport && isset(self::$sportsList[$attempt->sport]))
            ? self::$sportsList[$attempt->sport]
            : null;

        // Fetch full course models for recommendation
        $courses = SpecializedCourse::where('category', $attempt->category)->get();

        return view('specialized-aptitude.results', compact('attempt', 'meta', 'courses', 'sportsList', 'sportMeta'));
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


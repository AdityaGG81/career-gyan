<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Dimension;
use App\Models\Question;
use App\Models\AdvancedTestAttempt;
use App\Models\Career;

class AdvancedTestController extends Controller
{
    /**
     * Display the Advanced Test landing page for Pro Members.
     */
    public function index()
    {
        $user = Auth::user();
        $isMember = $user && $user->hasActiveMembership();

        $latestAttempt = null;
        if ($user) {
            $latestAttempt = AdvancedTestAttempt::where('user_id', $user->id)->latest()->first();
        }

        return view('advanced-test.index', compact('user', 'isMember', 'latestAttempt'));
    }

    /**
     * Start the Advanced Career Assessment.
     */
    public function start()
    {
        return redirect()->route('advanced-test.quiz');
    }

    /**
     * Display the 20-question randomized Advanced Assessment quiz.
     */
    public function quiz()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please log in to access the Advanced Career Assessment.');
        }

        $user = Auth::user();
        if (!$user->hasActiveMembership()) {
            return redirect()->route('membership.index')->with('info', 'The Advanced Career Assessment is exclusive to CareerGyan Pro members.');
        }

        if (Question::count() < 100 && class_exists(\Database\Seeders\TamannaQuestionsExpansionSeeder::class)) {
            try {
                (new \Database\Seeders\TamannaQuestionsExpansionSeeder())->run();
            } catch (\Exception $e) {}
        }

        // 20 questions distributed across the 7 dimensions:
        $dimensionLimits = [
            'language-aptitude' => 3,
            'verbal-reasoning' => 3,
            'numerical-aptitude' => 3,
            'abstract-reasoning' => 3,
            'mechanical-reasoning' => 3,
            'spatial-aptitude' => 3,
            'perceptual-aptitude' => 2,
        ];

        $dimensions = Dimension::all();
        $questions = [];

        foreach ($dimensions as $dim) {
            $limit = $dimensionLimits[$dim->slug] ?? 3;
            $dimQuestions = $dim->questions()->inRandomOrder()->take($limit)->get();

            foreach ($dimQuestions as $q) {
                $q->dimension_name = $dim->name;
                $questions[] = $q;
            }
        }

        shuffle($questions);

        // Ensure exactly 20 random questions
        $questions = array_slice($questions, 0, 20);

        session(['advanced_quiz_questions' => collect($questions)->pluck('id')->toArray()]);

        return view('advanced-test.quiz', compact('questions'));
    }

    /**
     * Submit and evaluate the 20 Advanced Assessment questions.
     */
    public function submit(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $answers = $request->input('answers', []);
        $dimensions = Dimension::all();

        $dimStats = [];
        foreach ($dimensions as $dim) {
            $dimStats[$dim->slug] = ['correct' => 0, 'total' => 0, 'name' => $dim->name];
        }

        foreach ($answers as $questionId => $userAnswer) {
            $q = Question::with('dimension')->find($questionId);
            if ($q && $q->dimension) {
                $slug = $q->dimension->slug;
                $dimStats[$slug]['total']++;
                if (trim(strtolower($userAnswer)) === trim(strtolower($q->correct_answer))) {
                    $dimStats[$slug]['correct']++;
                }
            }
        }

        // Compute percentage score per dimension (0 to 100)
        $percentageScores = [];
        foreach ($dimStats as $slug => $data) {
            if ($data['total'] > 0) {
                $percentageScores[$slug] = round(($data['correct'] / $data['total']) * 100);
            } else {
                $percentageScores[$slug] = 50; // default baseline
            }
        }

        // Determine top strength dimensions
        arsort($percentageScores);
        $topDimensions = array_slice(array_keys($percentageScores), 0, 2);

        // Archetype profiling logic
        $archetype = 'Strategic Problem Solver';
        $strengths = 'Well-rounded cognitive flexibility, strong analytical reasoning, and steady decision velocity.';
        $advice = 'Leverage cross-disciplinary competencies; focus on lead roles bridging engineering, data, and business.';
        $matchedCareers = [
            'Artificial Intelligence Specialist',
            'Data Scientist & Analytics Lead',
            'Strategy & Operations Consultant',
            'Product Architect',
            'Robotics & Systems Engineer'
        ];

        if (in_array('abstract-reasoning', $topDimensions) && in_array('numerical-aptitude', $topDimensions)) {
            $archetype = 'Analytical Architect & Algorithmic Pioneer';
            $strengths = 'Unmatched quantitative rigor, deep pattern recognition, and systemic problem-solving under complexity.';
            $advice = 'Specialize in algorithmic intelligence, computational science, quantitative finance, or machine learning infrastructure.';
            $matchedCareers = ['AI/ML Engineer', 'Quantitative Researcher', 'Data Architect', 'Computational Scientist', 'Cryptographer'];
        } elseif (in_array('mechanical-reasoning', $topDimensions) || in_array('spatial-aptitude', $topDimensions)) {
            $archetype = 'Applied Systems & Industrial Innovator';
            $strengths = 'Strong spatial visualization, physical intuition for mechanisms, and structural logic.';
            $advice = 'Excel in hardware engineering, aerospace, robotics, architecture, or manufacturing systems.';
            $matchedCareers = ['Aerospace Engineer', 'Robotics Systems Designer', 'Automotive R&D Specialist', 'Architectural Engineer', 'Mechatronics Lead'];
        } elseif (in_array('verbal-reasoning', $topDimensions) || in_array('language-aptitude', $topDimensions)) {
            $archetype = 'Executive Strategist & High-Impact Communicator';
            $strengths = 'Articulate verbal synthesis, persuasive structuring of ideas, and high semantic precision.';
            $advice = 'Thrive in corporate strategy, legal counsel, venture capital, high-stakes diplomacy, or media direction.';
            $matchedCareers = ['Management Consultant', 'Corporate Counsel / Legal Advisor', 'Venture Strategist', 'Brand Director', 'Public Policy Analyst'];
        } elseif (in_array('perceptual-aptitude', $topDimensions)) {
            $archetype = 'Precision Analyst & Operations Commander';
            $strengths = 'Exceptional perceptual speed, rapid pattern verification, error-free auditing, and keen attention to detail.';
            $advice = 'Direct operational security, financial fraud detection, high-frequency logistics, or systems auditing.';
            $matchedCareers = ['FinTech Compliance Lead', 'Cybersecurity Threat Hunter', 'Operations Research Analyst', 'Clinical Research Manager', 'Logistics Director'];
        }

        $attempt = AdvancedTestAttempt::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'test_type' => 'tamanna_advanced_aptitude',
            'scores' => $percentageScores,
            'answers' => $answers,
            'recommendations' => [
                'archetype' => $archetype,
                'strengths' => $strengths,
                'advice' => $advice,
                'careers' => $matchedCareers,
            ]
        ]);

        session()->forget('advanced_quiz_questions');

        // Automatically award reward points for advanced test if reward service exists
        $rewardMessage = null;
        if (class_exists(\App\Services\RewardPointsService::class)) {
            try {
                $rewardService = app(\App\Services\RewardPointsService::class);
                $points = $rewardService->awardAptitudeTestReward(Auth::user(), $attempt->id);
                if ($points) {
                    $rewardMessage = 'Congratulations! You earned 50 reward points for completing your Advanced Assessment.';
                    session()->flash('reward_notification', $rewardMessage);
                }
            } catch (\Exception $e) {
                // Silently continue if already rewarded
            }
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('advanced-test.results', $attempt->uuid),
            'reward_message' => $rewardMessage,
        ]);
    }

    /**
     * Display results for a specific assessment attempt.
     */
    public function results($uuid)
    {
        $attempt = AdvancedTestAttempt::where('uuid', $uuid)->firstOrFail();

        $answeredIds = array_keys($attempt->answers ?? []);
        if (!empty($answeredIds)) {
            $questions = Question::with('dimension')->whereIn('id', $answeredIds)->get();
        } else {
            $questions = Question::with('dimension')->take(20)->get();
        }

        return view('advanced-test.results', compact('attempt', 'questions'));
    }

    /**
     * View or print Certificate of Completion for Advanced Assessment.
     */
    public function certificate($uuid)
    {
        $attempt = AdvancedTestAttempt::where('uuid', $uuid)->firstOrFail();
        $user = $attempt->user ?? Auth::user();

        $name = $user ? $user->name : 'Pro Member';
        $testTitle = 'Advanced Career & Cognitive Assessment';
        $date = $attempt->created_at ? $attempt->created_at->format('d F Y') : now()->format('d F Y');
        $topCareer = $attempt->recommendations['archetype'] ?? 'Advanced Cognitive Achiever';

        return view('certificate.show', compact('name', 'testTitle', 'date', 'uuid', 'topCareer'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSession;
use App\Models\Dimension;
use App\Models\Question;
use App\Models\Career;
use App\Models\Field;
use App\Services\AptitudeAiAnalysisService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function start()
    {
        if (Auth::check()) {
            $existing = TestSession::where('user_id', Auth::id())->first();
            if ($existing) {
                return redirect()->route('test.results', $existing->uuid);
            }
        }
        return redirect()->route('test.quiz');
    }

    public function quiz()
    {
        if (Auth::check()) {
            $existing = TestSession::where('user_id', Auth::id())->first();
            if ($existing) {
                return redirect()->route('test.results', $existing->uuid);
            }
        }

        if (Question::count() < 100 && class_exists(\Database\Seeders\TamannaQuestionsExpansionSeeder::class)) {
            try {
                (new \Database\Seeders\TamannaQuestionsExpansionSeeder())->run();
            } catch (\Exception $e) {}
        }

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

            // Fetch random questions for this dimension based on the specified limit
            $dimQuestions = $dim->questions()->inRandomOrder()->take($limit)->get();

            foreach ($dimQuestions as $q) {
                $q->dimension_name = $dim->name;
                $questions[] = $q;
            }
        }
        
        shuffle($questions);

        // Ensure exactly 20 random questions per test attempt
        $questions = array_slice($questions, 0, 20);

        session(['aptitude_quiz_questions' => collect($questions)->pluck('id')->toArray()]);

        return view('test.quiz', compact('questions'));
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers', []);
        $profile = $request->input('profile', []);

        $scores = [];
        $rawScores = [];
        $dimensions = Dimension::all();
        foreach ($dimensions as $dim) {
            $scores[$dim->slug] = ['correct' => 0, 'total' => 0];
            $rawScores[$dim->slug] = ['correct' => 0, 'total' => 0];
        }

        foreach ($answers as $questionId => $userAnswer) {
            $q = Question::with('dimension')->find($questionId);
            if ($q && $q->dimension) {
                $slug = $q->dimension->slug;
                $scores[$slug]['total']++;
                $rawScores[$slug]['total']++;
                if (trim(strtolower($userAnswer)) === trim(strtolower($q->correct_answer))) {
                    $scores[$slug]['correct']++;
                    $rawScores[$slug]['correct']++;
                }
            }
        }

        $finalScores = [];
        foreach ($scores as $slug => $data) {
            if ($data['total'] > 0) {
                // Score out of 10
                $finalScores[$slug] = round(($data['correct'] / $data['total']) * 10, 2); 
            } else {
                $finalScores[$slug] = 5.0;
            }
        }

        $profile['raw_scores'] = $rawScores;
        $profile['answers'] = $answers;

        $session = TestSession::create([
            'user_id' => Auth::id(),
            'uuid' => Str::uuid(),
            'user_inputs' => $profile,
            'aptitude_scores' => $finalScores
        ]);

        $this->calculateRecommendations($session);

        // Precompute AI Cognitive & Performance Analysis
        try {
            app(AptitudeAiAnalysisService::class)->analyze($session);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('AI Analysis precompute warning: ' . $e->getMessage());
        }

        session(['last_test_uuid' => $session->uuid]);
        session()->forget('aptitude_quiz_questions');

        // Automatically award 50 reward points upon successful test completion (once per user)
        $rewardMessage = null;
        if (Auth::check()) {
            $rewardService = app(\App\Services\RewardPointsService::class);
            $points = $rewardService->awardAptitudeTestReward(Auth::user(), $session->id);
            if ($points) {
                $rewardMessage = 'Congratulations! You earned 50 reward points for completing your Aptitude Test.';
                session()->flash('reward_notification', $rewardMessage);
            }
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('test.results', $session->uuid),
            'reward_message' => $rewardMessage,
        ]);
    }

    public function results($uuid)
    {
        $session = TestSession::where('uuid', $uuid)->firstOrFail();
        
        $recommendedIds = $session->recommended_careers ?? [];
        
        $careers = Career::whereIn('id', array_keys($recommendedIds))
            ->get()
            ->sortByDesc(function ($career) use ($recommendedIds) {
                return $recommendedIds[$career->id];
            });

        $recommendedFields = $session->recommended_fields ?? [];
        $fields = [];
        if (!empty($recommendedFields)) {
            $fields = Field::whereIn('id', array_keys($recommendedFields))
                ->get()
                ->sortByDesc(function ($field) use ($recommendedFields) {
                    return $recommendedFields[$field->id];
                });
        }

        $answeredIds = array_keys($session->user_inputs['answers'] ?? []);
        if (!empty($answeredIds)) {
            $questions = \App\Models\Question::with('dimension')->whereIn('id', $answeredIds)->get();
        } else {
            $questions = \App\Models\Question::with('dimension')->take(20)->get();
        }

        $aiAnalysis = app(AptitudeAiAnalysisService::class)->analyze($session);

        return view('test.results', compact('session', 'careers', 'recommendedIds', 'fields', 'recommendedFields', 'questions', 'aiAnalysis'));
    }

    private function calculateRecommendations(TestSession $session)
    {
        $careers = Career::all();
        $userScores = $session->aptitude_scores; 
        
        $results = [];

        foreach ($careers as $career) {
            $score = 0;
            $reqAptitudes = $career->required_aptitudes ?? []; 

            $matchScore = 0;
            $totalWeight = 0;

            foreach ($userScores as $slug => $uScore) {
                $reqScore = $reqAptitudes[$slug] ?? 5; // Default center score if not set
                $diff = abs($uScore - $reqScore);
                $matchScore += (10 - $diff);
                $totalWeight += 10;
            }

            if ($totalWeight > 0) {
                $score = round(($matchScore / $totalWeight) * 100, 2);
            }

            $results[$career->id] = $score;
        }

        arsort($results);
        $top5 = array_slice($results, 0, 5, true); 

        // Calculate Fields
        $allFields = Field::all();
        $fieldProfiles = [
            'Arts & Humanities' => ['language-aptitude' => 8, 'verbal-reasoning' => 8, 'spatial-aptitude' => 6],
            'Commerce' => ['numerical-aptitude' => 8, 'perceptual-aptitude' => 7, 'language-aptitude' => 6],
            'Science' => ['abstract-reasoning' => 8, 'mechanical-reasoning' => 8, 'verbal-reasoning' => 7, 'numerical-aptitude' => 7],
            'Technology / Engineering' => ['abstract-reasoning' => 8, 'mechanical-reasoning' => 8, 'numerical-aptitude' => 8, 'spatial-aptitude' => 7],
            'Medical' => ['abstract-reasoning' => 8, 'verbal-reasoning' => 8],
            'Business Administration' => ['verbal-reasoning' => 8, 'language-aptitude' => 7, 'perceptual-aptitude' => 7],
            'Skill Development' => ['mechanical-reasoning' => 8, 'spatial-aptitude' => 7, 'perceptual-aptitude' => 7],
            'Sports' => ['perceptual-aptitude' => 8, 'spatial-aptitude' => 8],
            'Agriculture' => ['perceptual-aptitude' => 7, 'mechanical-reasoning' => 6, 'spatial-aptitude' => 6],
            'Small Scale Businesses' => ['numerical-aptitude' => 7, 'language-aptitude' => 6],
            'Traditional Careers' => [],
            'Others' => []
        ];

        $fieldScores = [];
        foreach ($allFields as $field) {
            $reqAptitudes = $fieldProfiles[$field->name] ?? [];
            if (empty($reqAptitudes)) {
                $fieldScores[$field->id] = 50; // default medium match
                continue;
            }

            $mScore = 0;
            $tWeight = 0;
            foreach ($reqAptitudes as $slug => $reqScore) {
                $uScore = $userScores[$slug] ?? 5;
                $diff = abs($uScore - $reqScore);
                $mScore += (10 - $diff);
                $tWeight += 10;
            }

            if ($tWeight > 0) {
                $fieldScores[$field->id] = round(($mScore / $tWeight) * 100, 2);
            }
        }
        arsort($fieldScores);
        $topFields = array_slice($fieldScores, 0, 5, true);

        $session->update([
            'recommended_careers' => $top5,
            'recommended_fields'  => $topFields
        ]);
    }

    public function certificate($uuid)
    {
        $session = TestSession::where('uuid', $uuid)->firstOrFail();
        
        $name = Auth::user()->name;
        $testTitle = 'Career Aptitude Assessment';
        $date = $session->created_at ? $session->created_at->format('d F Y') : now()->format('d F Y');
        
        $recommendedIds = $session->recommended_careers ?? [];
        $topCareer = 'N/A';
        if (!empty($recommendedIds)) {
            $careerId = key($recommendedIds);
            $careerObj = Career::find($careerId);
            if ($careerObj) {
                $topCareer = $careerObj->title;
            }
        }
        
        return view('certificate.show', compact('name', 'testTitle', 'date', 'uuid', 'topCareer'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSession;
use App\Models\Dimension;
use App\Models\Question;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function start()
    {
        return view('test.start');
    }

    public function quiz()
    {
        // Random 3 questions per dimension to keep test manageable
        $dimensions = Dimension::with(['questions' => function ($q) {
            $q->inRandomOrder()->take(3); 
        }])->get();

        $questions = [];
        foreach ($dimensions as $dim) {
            foreach ($dim->questions as $q) {
                $q->dimension_name = $dim->name;
                $questions[] = $q;
            }
        }
        
        shuffle($questions);

        return view('test.quiz', compact('questions'));
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers', []);
        $profile = $request->input('profile', []);

        $scores = [];
        $dimensions = Dimension::all();
        foreach ($dimensions as $dim) {
            $scores[$dim->slug] = ['correct' => 0, 'total' => 0];
        }

        foreach ($answers as $questionId => $userAnswer) {
            $q = Question::with('dimension')->find($questionId);
            if ($q) {
                $slug = $q->dimension->slug;
                $scores[$slug]['total']++;
                if (trim(strtolower($userAnswer)) === trim(strtolower($q->correct_answer))) {
                    $scores[$slug]['correct']++;
                }
            }
        }

        $finalScores = [];
        foreach ($scores as $slug => $data) {
            if ($data['total'] > 0) {
                // Score out of 10
                $finalScores[$slug] = round(($data['correct'] / $data['total']) * 10, 2); 
            } else {
                $finalScores[$slug] = 0;
            }
        }

        $session = TestSession::create([
            'uuid' => Str::uuid(),
            'user_inputs' => $profile,
            'aptitude_scores' => $finalScores
        ]);

        $this->calculateRecommendations($session);

        return response()->json([
            'success' => true,
            'redirect_url' => route('test.results', $session->uuid)
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

        return view('test.results', compact('session', 'careers', 'recommendedIds', 'fields', 'recommendedFields'));
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
            'Arts & Humanities' => ['language-aptitude' => 8, 'verbal-reasoning' => 8, 'abstract-reasoning' => 5],
            'Commerce' => ['numerical-aptitude' => 8, 'language-aptitude' => 6, 'verbal-reasoning' => 6],
            'Science' => ['numerical-aptitude' => 8, 'abstract-reasoning' => 8, 'spatial-aptitude' => 6],
            'Technology / Engineering' => ['numerical-aptitude' => 8, 'mechanical-reasoning' => 8, 'spatial-aptitude' => 7, 'abstract-reasoning' => 7],
            'Medical' => ['verbal-reasoning' => 8, 'perceptual-aptitude' => 8, 'abstract-reasoning' => 7],
            'Business Administration' => ['language-aptitude' => 7, 'verbal-reasoning' => 8, 'numerical-aptitude' => 7],
            'Skill Development' => ['mechanical-reasoning' => 7, 'spatial-aptitude' => 7],
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
}

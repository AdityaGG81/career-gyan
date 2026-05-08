<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuickTestQuestion;
use App\Models\QuickTestAttempt;
use Illuminate\Support\Str;

class QuickTestController extends Controller
{
    public function start()
    {
        return view('quick-test.start');
    }

    public function quiz()
    {
        $questions = QuickTestQuestion::all();
        return view('quick-test.quiz', compact('questions'));
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers', []);
        $questions = QuickTestQuestion::all();
        
        $sectionScores = [
            'Language Aptitude' => 0,
            'Abstract Reasoning' => 0,
            'Verbal Reasoning' => 0,
            'Mechanical Reasoning' => 0,
            'Numerical Aptitude' => 0,
            'Spatial Aptitude' => 0,
            'Perceptual Aptitude' => 0,
        ];
        
        $totalScore = 0;
        
        foreach ($questions as $q) {
            $userAnswer = $answers[$q->id] ?? null;
            if ($userAnswer === $q->correct_option) {
                $sectionScores[$q->section] += $q->marks;
                $totalScore += $q->marks;
            }
        }
        
        $recommendations = $this->getAptitudeRecommendations($sectionScores);
        
        $attempt = QuickTestAttempt::create([
            'uuid' => (string) Str::uuid(),
            'student_name' => $request->input('student_name'),
            'student_email' => $request->input('student_email'),
            'answers' => $answers,
            'section_scores' => $sectionScores,
            'total_score' => $totalScore,
            'recommended_careers' => $recommendations,
        ]);
        
        return redirect()->route('quick-test.results', $attempt->uuid);
    }

    public function results($uuid)
    {
        $attempt = QuickTestAttempt::where('uuid', $uuid)->firstOrFail();
        
        // Categorize based on aptitude levels
        $highAptitude = [];
        $averageAptitude = [];
        $lowAptitude = [];
        
        $sectionMax = [
            'Language Aptitude' => 2,
            'Abstract Reasoning' => 2,
            'Verbal Reasoning' => 2,
            'Mechanical Reasoning' => 2,
            'Numerical Aptitude' => 2,
            'Spatial Aptitude' => 2,
            'Perceptual Aptitude' => 4,
        ];

        foreach ($attempt->section_scores as $section => $score) {
            $max = $sectionMax[$section];
            $percent = ($score / $max) * 100;
            
            if ($percent >= 75) {
                $highAptitude[] = $section;
            } elseif ($percent >= 40) {
                $averageAptitude[] = $section;
            } else {
                $lowAptitude[] = $section;
            }
        }
        
        // Generate Profile Paragraph
        $profileParagraph = $this->generateProfileParagraph($highAptitude, $averageAptitude);
        
        $questions = \App\Models\QuickTestQuestion::all();
        
        return view('quick-test.results', compact('attempt', 'highAptitude', 'averageAptitude', 'lowAptitude', 'profileParagraph', 'questions'));
    }

    private function getAptitudeRecommendations($scores)
    {
        $sectionMax = [
            'Language Aptitude' => 2,
            'Abstract Reasoning' => 2,
            'Verbal Reasoning' => 2,
            'Mechanical Reasoning' => 2,
            'Numerical Aptitude' => 2,
            'Spatial Aptitude' => 2,
            'Perceptual Aptitude' => 4,
        ];

        // Mappings based on career guidelines
        $mappings = [
            'Language Aptitude' => [
                'areas' => ['Journalism', 'Advertising', 'Law', 'Business Development'],
                'occupations' => ['Writer', 'Journalist', 'Copywriter', 'Lawyer', 'Librarian', 'Stenographer'],
                'icon' => 'fa-pen-nib'
            ],
            'Abstract Reasoning' => [
                'areas' => ['Mathematics', 'Architecture', 'Engineering', 'Economics'],
                'occupations' => ['Mathematician', 'Computer Programmer', 'Architect', 'Engineer', 'Doctor', 'Economist'],
                'icon' => 'fa-microchip'
            ],
            'Verbal Reasoning' => [
                'areas' => ['Psychology', 'Education', 'Public Relations', 'Linguistics'],
                'occupations' => ['Counsellor', 'Speech Therapist', 'Teacher', 'Public Relations Officer', 'Legal Professional'],
                'icon' => 'fa-comments'
            ],
            'Mechanical Reasoning' => [
                'areas' => ['Mechanical Engineering', 'Technical Trades', 'Applied Sciences'],
                'occupations' => ['Mechanical Engineer', 'Electrician', 'Machine Operator', 'Carpenter', 'Physicist'],
                'icon' => 'fa-gears'
            ],
            'Numerical Aptitude' => [
                'areas' => ['Banking', 'Statistics', 'Health Sciences', 'Oceanography'],
                'occupations' => ['Banker', 'Statistician', 'Meteorologist', 'Geologist', 'Data Analyst'],
                'icon' => 'fa-calculator'
            ],
            'Spatial Aptitude' => [
                'areas' => ['Designing', 'Urban Planning', 'Fashion Design', 'Astronomy'],
                'occupations' => ['Designer', 'Draftsman', 'Fashion Designer', 'Interior Designer', 'Urban Planner'],
                'icon' => 'fa-compass-drafting'
            ],
            'Perceptual Aptitude' => [
                'areas' => ['Accounting', 'Record Keeping', 'Data Entry', 'Administrative Services'],
                'occupations' => ['Accountant', 'Bookkeeper', 'Computer Operator', 'Detective', 'File Clerk'],
                'icon' => 'fa-table-list'
            ],
        ];

        // Sort sections by percentage score
        $percentages = [];
        foreach ($scores as $section => $score) {
            $percentages[$section] = ($score / $sectionMax[$section]) * 100;
        }
        arsort($percentages);

        $topSections = array_slice(array_keys($percentages), 0, 3);
        $recommendations = [];

        foreach ($topSections as $section) {
            if ($percentages[$section] >= 50) { // Only recommend if score is decent
                $recommendations[] = [
                    'section' => $section,
                    'areas' => $mappings[$section]['areas'],
                    'occupations' => $mappings[$section]['occupations'],
                    'icon' => $mappings[$section]['icon']
                ];
            }
        }

        return $recommendations;
    }

    private function generateProfileParagraph($high, $average)
    {
        if (empty($high) && empty($average)) {
            return "The test results indicate a developing aptitude profile. Focused exploration in various fields is recommended to identify natural strengths.";
        }

        $highText = !empty($high) ? implode(", ", $high) : "";
        $para = "";

        if (!empty($high)) {
            $para .= "The student shows a **high aptitude** in " . $highText . ". ";
            $para .= "This indicates strong potential for success in careers requiring analytical thinking, specialized skills, or creative problem-solving in these specific domains. ";
        }

        if (!empty($average)) {
            $para .= "An **average aptitude** is observed in " . implode(", ", $average) . ", suggesting that with consistent effort and training, the student can achieve proficiency in related vocational areas.";
        }

        return $para;
    }
}

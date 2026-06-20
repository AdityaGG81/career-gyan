<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Validate: only require name/email for guests
        $rules = [
            'answers' => 'array',
        ];

        if (!Auth::check()) {
            $rules['student_name']  = 'required|string|max:255';
            $rules['student_email'] = 'required|email|max:255';
        }

        $request->validate($rules);

        // Resolve student identity
        if (Auth::check()) {
            $studentName  = Auth::user()->name;
            $studentEmail = Auth::user()->email;
        } else {
            $studentName  = $request->input('student_name', $request->input('name'));
            $studentEmail = $request->input('student_email', $request->input('email'));
        }

        $answers   = $request->input('answers', []);
        $questions = QuickTestQuestion::all();
        
        $sectionScores = [
            'Language Aptitude'    => 0,
            'Abstract Reasoning'   => 0,
            'Verbal Reasoning'     => 0,
            'Mechanical Reasoning' => 0,
            'Numerical Aptitude'   => 0,
            'Spatial Aptitude'     => 0,
            'Perceptual Aptitude'  => 0,
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
            'uuid'               => (string) Str::uuid(),
            'student_name'       => $studentName,
            'student_email'      => $studentEmail,
            'answers'            => $answers,
            'section_scores'     => $sectionScores,
            'total_score'        => $totalScore,
            'recommended_careers'=> $recommendations,
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

        // Build clickable recommendation links
        $linkedRecommendedCareers = [];
        if ($attempt->recommended_careers) {
            foreach ($attempt->recommended_careers as $rec) {
                $linkedRecommendedCareers[] = [
                    'section' => $rec['section'],
                    'icon' => $rec['icon'],
                    'areas' => $this->buildRecommendationLinks($rec['areas'], 'field'),
                    'occupations' => $this->buildRecommendationLinks($rec['occupations'], 'occupation'),
                ];
            }
        }
        
        return view('quick-test.results', compact('attempt', 'highAptitude', 'averageAptitude', 'lowAptitude', 'profileParagraph', 'questions', 'linkedRecommendedCareers'));
    }

    private function buildRecommendationLinks(array $items, string $type): array
    {
        $linkedItems = [];
        $seen = [];
        
        foreach ($items as $item) {
            if (!$item) continue;
            
            $slug = \Illuminate\Support\Str::slug($item);
            
            if ($type === 'field') {
                $fieldMappings = [
                    'engineering' => ['slug' => 'technology-engineering', 'label' => 'Technology / Engineering'],
                    'mechanical-engineering' => ['slug' => 'technology-engineering', 'label' => 'Technology / Engineering'],
                    'architecture' => ['slug' => 'technology-engineering', 'label' => 'Technology / Engineering'],
                    
                    'mathematics' => ['slug' => 'science', 'label' => 'Science'],
                    'applied-sciences' => ['slug' => 'science', 'label' => 'Science'],
                    'statistics' => ['slug' => 'science', 'label' => 'Science'],
                    'oceanography' => ['slug' => 'science', 'label' => 'Science'],
                    'astronomy' => ['slug' => 'science', 'label' => 'Science'],
                    
                    'economics' => ['slug' => 'commerce', 'label' => 'Commerce, Banking & Corporate'],
                    'banking' => ['slug' => 'commerce', 'label' => 'Commerce, Banking & Corporate'],
                    'accounting' => ['slug' => 'commerce', 'label' => 'Commerce, Banking & Corporate'],
                    'record-keeping' => ['slug' => 'commerce', 'label' => 'Commerce, Banking & Corporate'],
                    
                    'psychology' => ['slug' => 'arts-humanities', 'label' => 'Arts & Humanities'],
                    'journalism' => ['slug' => 'arts-humanities', 'label' => 'Arts & Humanities'],
                    'linguistics' => ['slug' => 'arts-humanities', 'label' => 'Arts & Humanities'],
                    'education' => ['slug' => 'arts-humanities', 'label' => 'Arts & Humanities'],
                    
                    'law' => ['slug' => 'teaching-law', 'label' => 'Teaching & Law'],
                    
                    'public-relations' => ['slug' => 'business', 'label' => 'Business Administration'],
                    'business-development' => ['slug' => 'business', 'label' => 'Business Administration'],
                    'administrative-services' => ['slug' => 'business', 'label' => 'Business Administration'],
                    
                    'doctor' => ['slug' => 'medical', 'label' => 'Medical'],
                    'health-sciences' => ['slug' => 'medical', 'label' => 'Medical'],
                    'speech-therapist' => ['slug' => 'medical', 'label' => 'Medical'],
                    
                    'agriculture' => ['slug' => 'agriculture', 'label' => 'Agriculture'],
                    'sports' => ['slug' => 'sports', 'label' => 'Sports'],
                    'designing' => ['slug' => 'creative-careers', 'label' => 'Creative Careers'],
                    'fashion-design' => ['slug' => 'creative-careers', 'label' => 'Creative Careers'],
                    'technical-trades' => ['slug' => 'skill-development', 'label' => 'Skill Development'],
                    'data-entry' => ['slug' => 'skill-development', 'label' => 'Skill Development'],
                    'urban-planning' => ['slug' => 'technology-engineering', 'label' => 'Technology / Engineering'],
                ];
                
                $mapped = $fieldMappings[$slug] ?? null;
                
                // If mapping doesn't exist, try to check if the slug is already a valid field in db
                if (!$mapped) {
                    $fieldExists = \App\Models\Field::where('slug', $slug)->first();
                    if ($fieldExists) {
                        $mapped = ['slug' => $fieldExists->slug, 'label' => $fieldExists->name];
                    }
                }
                
                if ($mapped && !isset($seen[$mapped['slug']])) {
                    $seen[$mapped['slug']] = true;
                    $linkedItems[] = [
                        'label' => $mapped['label'],
                        'url' => route('explore.field', ['field' => $mapped['slug']]),
                    ];
                }
            } else {
                // Occupations
                $careerMapping = [
                    'writer' => 'content-writer',
                    'journalist' => 'journalist',
                    'copywriter' => 'copywriter',
                    'lawyer' => 'lawyer',
                    'librarian' => 'librarian',
                    'stenographer' => 'stenographer-typist',
                    'mathematician' => 'mathematician',
                    'computer-programmer' => 'software-developer',
                    'architect' => 'architect',
                    'engineer' => 'software-engineer',
                    'doctor' => 'general-physician',
                    'counsellor' => 'career-counsellor',
                    'speech-therapist' => 'speech-therapist',
                    'teacher' => 'school-teacher-humanities',
                    'public-relations-officer' => 'public-relations-pr-specialist',
                    'legal-professional' => 'lawyer',
                    'mechanical-engineer' => 'mechanical-engineer',
                    'electrician' => 'electrician',
                    'machine-operator' => 'machine-operator',
                    'carpenter' => 'carpenter-artisan',
                    'physicist' => 'physicist',
                    'banker' => 'banker',
                    'statistician' => 'statistician',
                    'meteorologist' => 'meteorologist',
                    'geologist' => 'geologist',
                    'data-analyst' => 'data-analyst',
                    'designer' => 'graphic-designer',
                    'draftsman' => 'draftsperson',
                    'fashion-designer' => 'fashion-designer',
                    'interior-designer' => 'interior-designer',
                    'urban-planner' => 'urban-planner',
                    'accountant' => 'chartered-accountant',
                    'bookkeeper' => 'bookkeeper',
                    'computer-operator' => 'computer-operator-data-entry-operator',
                    'detective' => 'private-detective',
                    'file-clerk' => 'file-clerk-administrative-assistant',
                    'economist' => 'economist',
                ];
                
                $careerSlug = $careerMapping[$slug] ?? $slug;
                
                $career = \App\Models\Career::where('slug', $careerSlug)->first();
                if ($career && !isset($seen[$career->slug])) {
                    $seen[$career->slug] = true;
                    $linkedItems[] = [
                        'label' => $career->name, // Use actual career name
                        'url' => route('career.detail.page', ['slug' => $career->slug]),
                    ];
                }
            }
        }
        
        return $linkedItems;
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

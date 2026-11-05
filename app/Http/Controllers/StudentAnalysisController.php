<?php

namespace App\Http\Controllers;

use App\Models\StudentAnalysis;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentAnalysisController extends Controller
{
    /**
     * Show the Student Analysis questionnaire form.
     */
    public function create()
    {
        $user = Auth::user();
        return view('student-analysis.form', compact('user'));
    }

    /**
     * Handle submission of the Student Analysis questionnaire.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Section 1: Basic & Academic Profile
            'full_name' => 'required|string|max:150',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'current_class' => 'required|string|max:50',
            'current_stream' => 'required|string|max:50',
            'city_district' => 'required|string|max:100',
            'exam_results_last_3_years' => 'required|string|max:2000',
            'top_subjects_last_3_years' => 'required|string|max:2000',
            'desired_admission_course' => 'required|string|max:255',

            // Section 2: Subject Preferences & Aptitude
            'enjoyed_subjects' => 'nullable|array',
            'difficult_subjects' => 'nullable|array',
            'completed_aptitude_test' => 'nullable|string|max:10',
            'aptitude_test_scores' => 'nullable|string|max:1000',
            'strongest_aptitude_areas' => 'nullable|array',
            'aptitude_report_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',

            // Section 3: Personal Interests & Activities
            'personal_interests' => 'required|string|max:2000',
            'special_hobbies_talents' => 'nullable|string|max:2000',
            'enjoyed_activities' => 'nullable|array',
            'free_day_preference' => 'nullable|string|max:2000',

            // Section 4: Skills & Work Personality
            'strongest_skills' => 'nullable|array|max:5',
            'work_with_preference' => 'nullable|string|max:100',
            'work_style' => 'nullable|string|max:100',
            'personality_descriptions' => 'nullable|array|max:3',
            'problem_solving_rating' => 'nullable|integer|between:1,5',
            'learning_tech_rating' => 'nullable|integer|between:1,5',

            // Section 5: Career Fields & Environment
            'interested_career_fields' => 'nullable|array|max:5',
            'dream_career' => 'nullable|string|max:255',
            'dream_career_reason' => 'nullable|string|max:2000',
            'career_priorities' => 'nullable|array|max:3',
            'business_startup_interest' => 'nullable|string|max:20',
            'preferred_work_environments' => 'nullable|array',
            'people_interaction_comfort' => 'nullable|integer|between:1,5',
            'machines_tools_comfort' => 'nullable|integer|between:1,5',

            // Section 6: Higher Education & Preferences
            'higher_studies_willingness' => 'nullable|string|max:50',
            'study_outside_city' => 'nullable|string|max:10',
            'preferred_study_location' => 'nullable|string|max:100',
            'annual_education_budget' => 'nullable|string|max:100',
            'need_scholarship_loan_info' => 'nullable|string|max:10',
            'top_three_careers_courses' => 'required|string|max:2000',
            'parent_suggested_career' => 'nullable|string|max:255',
            'parent_preference_alignment' => 'nullable|string|max:50',

            // Section 7: Limitations & Help
            'limitations_constraints' => 'nullable|string|max:2000',
            'dream_career_no_limitations' => 'nullable|string|max:255',
            'no_limitations_reason' => 'nullable|string|max:2000',
            'biggest_career_confusion' => 'nullable|string|max:2000',
            'help_requested' => 'nullable|array',
            'additional_info' => 'nullable|string|max:2000',
        ]);

        // Handle report file upload if present
        $uploadedFilePath = null;
        if ($request->hasFile('aptitude_report_file')) {
            $file = $request->file('aptitude_report_file');
            $fileName = 'aptitude_report_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/aptitude_reports');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $uploadedFilePath = 'uploads/aptitude_reports/' . $fileName;
        }

        $analysis = new StudentAnalysis();
        $analysis->uuid = (string) Str::uuid();
        $analysis->user_id = Auth::id() ?? null;
        $analysis->fill($validated);
        if ($uploadedFilePath) {
            $analysis->aptitude_report_file = $uploadedFilePath;
        }
        $analysis->save();

        return redirect()->route('student-analysis.show', $analysis->uuid)
            ->with('success', 'Your Student Analysis assessment has been successfully submitted!');
    }

    /**
     * Show the detailed Student Analysis profile & recommendation report.
     */
    public function show($uuid)
    {
        $analysis = StudentAnalysis::where('uuid', $uuid)->firstOrFail();

        // Infer archetype from answers
        $archetype = $this->determineArchetype($analysis);

        // Fetch matched careers from database based on user's selected fields
        $matchedCareers = collect();
        if (!empty($analysis->interested_career_fields) && is_array($analysis->interested_career_fields)) {
            $keywords = array_slice($analysis->interested_career_fields, 0, 3);
            $query = Career::query();
            foreach ($keywords as $kw) {
                $term = trim(explode('&', explode('-', $kw)[0])[0]);
                $query->orWhere('title', 'like', "%{$term}%")
                      ->orWhere('skills_required', 'like', "%{$term}%");
            }
            $matchedCareers = $query->take(6)->get();
        }

        if ($matchedCareers->isEmpty()) {
            $matchedCareers = Career::latest()->take(6)->get();
        }

        return view('student-analysis.show', compact('analysis', 'archetype', 'matchedCareers'));
    }

    /**
     * List user's previous student analysis assessments.
     */
    public function myAnalyses()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $analyses = StudentAnalysis::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('student-analysis.my-analyses', compact('analyses'));
    }

    /**
     * Helper to determine student archetype based on personality ratings & skills.
     */
    protected function determineArchetype(StudentAnalysis $analysis): array
    {
        $rating = ($analysis->problem_solving_rating + $analysis->learning_tech_rating) / 2;
        $workWith = strtolower((string) $analysis->work_with_preference);

        if (str_contains($workWith, 'computer') || str_contains($workWith, 'data') || str_contains($workWith, 'machine')) {
            return [
                'title' => 'Technical Innovator & Systems Thinker',
                'badge' => 'High Technical & Analytical Aptitude',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
                'icon' => 'fa-solid fa-microchip',
                'summary' => 'You show high analytical curiosity, interest in technology, and comfort working with complex systems, problem-solving, and structured data.',
            ];
        }

        if (str_contains($workWith, 'people') || str_contains($workWith, 'team')) {
            return [
                'title' => 'People Leader & Strategic Communicator',
                'badge' => 'Strong Social & Leadership Aptitude',
                'color' => '#059669',
                'bg' => '#ecfdf5',
                'icon' => 'fa-solid fa-users-gear',
                'summary' => 'You thrive in collaborative environments, value interaction, social empathy, and have strong potential for leadership, management, and consulting.',
            ];
        }

        if (str_contains($workWith, 'art') || str_contains($workWith, 'design') || str_contains($workWith, 'idea')) {
            return [
                'title' => 'Creative Visionary & Design Strategist',
                'badge' => 'High Creative & Conceptual Aptitude',
                'color' => '#d97706',
                'bg' => '#fffbeb',
                'icon' => 'fa-solid fa-palette',
                'summary' => 'You enjoy creative expression, conceptualizing original ideas, and finding unconventional solutions to real-world challenges.',
            ];
        }

        return [
            'title' => 'Versatile Multi-Disciplinary Achiever',
            'badge' => 'Balanced Practical & Analytical Aptitude',
            'color' => '#7c3aed',
            'bg' => '#faf5ff',
            'icon' => 'fa-solid fa-compass',
            'summary' => 'You have a well-rounded profile balancing practical skills, scientific thinking, and adaptability across dynamic career sectors.',
        ];
    }
}

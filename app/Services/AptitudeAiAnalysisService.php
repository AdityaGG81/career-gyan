<?php

namespace App\Services;

use App\Models\TestSession;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AptitudeAiAnalysisService
{
    /**
     * Dimension human-readable labels.
     */
    protected array $dimensionLabels = [
        'numerical-aptitude' => 'Numerical Aptitude',
        'verbal-reasoning' => 'Verbal Reasoning',
        'abstract-reasoning' => 'Abstract Reasoning',
        'mechanical-reasoning' => 'Mechanical Reasoning',
        'spatial-aptitude' => 'Spatial Aptitude',
        'language-aptitude' => 'Language Aptitude',
        'perceptual-aptitude' => 'Perceptual Aptitude',
    ];

    /**
     * Analyze a TestSession and generate a comprehensive AI performance analysis.
     */
    public function analyze(TestSession $session, bool $forceRefresh = false): array
    {
        $inputs = $session->user_inputs ?? [];
        if (!$forceRefresh && !empty($inputs['ai_analysis']) && is_array($inputs['ai_analysis'])) {
            return $inputs['ai_analysis'];
        }

        $analysis = $this->generateHeuristicAnalysis($session);

        // Attempt external AI enrichment if scraper is available
        $enriched = $this->attemptExternalEnrichment($session, $analysis);
        if ($enriched) {
            $analysis = array_merge($analysis, $enriched);
        }

        // Cache inside session user_inputs
        try {
            $inputs['ai_analysis'] = $analysis;
            $session->user_inputs = $inputs;
            $session->save();
        } catch (\Throwable $e) {
            Log::warning('Failed to persist AI analysis in TestSession: ' . $e->getMessage());
        }

        return $analysis;
    }

    /**
     * Generate an intelligent, structured cognitive performance analysis.
     */
    public function generateHeuristicAnalysis(TestSession $session): array
    {
        $scores = $session->aptitude_scores ?? [];
        $rawScores = $session->user_inputs['raw_scores'] ?? [];
        $userAnswers = $session->user_inputs['answers'] ?? [];

        // Sort dimensions by score descending
        arsort($scores);
        $sortedDims = $scores;

        $topDims = array_slice($sortedDims, 0, 3, true);
        $growthDims = array_slice($sortedDims, -2, 2, true);

        // Calculate aggregate metrics
        $scoreValues = array_values($scores);
        $avgScore = count($scoreValues) > 0 ? round(array_sum($scoreValues) / count($scoreValues), 1) : 5.0;

        $totalQuestions = count($userAnswers);
        $correctCount = 0;
        foreach ($rawScores as $dim => $data) {
            $correctCount += (int) ($data['correct'] ?? 0);
            if ($totalQuestions === 0) {
                $totalQuestions += (int) ($data['total'] ?? 0);
            }
        }
        $accuracyPct = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : round(($avgScore / 10) * 100);

        // Determine Archetype
        $archetype = $this->determineArchetype($sortedDims, $avgScore);

        // Determine Strengths Commentary
        $strengths = [];
        foreach ($topDims as $dim => $sc) {
            $strengths[] = $this->getDimensionStrengthData($dim, (float) $sc);
        }

        // Determine Growth Opportunities
        $growthAreas = [];
        foreach ($growthDims as $dim => $sc) {
            $growthAreas[] = $this->getDimensionGrowthData($dim, (float) $sc);
        }

        // Academic Stream Fit
        $streamFit = $this->determineStreamFit($sortedDims, $session);

        // Target Competitive Exams
        $targetExams = $this->determineTargetExams($sortedDims, $avgScore);

        // 90-Day Action Roadmap
        $roadmap = $this->generate90DayRoadmap($sortedDims, $growthDims);

        // Executive Synthesis
        $executiveSummary = $this->generateExecutiveSummary($session, $archetype, $avgScore, $topDims, $accuracyPct);

        return [
            'archetype_title' => $archetype['title'],
            'archetype_subtitle' => $archetype['subtitle'],
            'archetype_badge' => $archetype['badge'],
            'archetype_icon' => $archetype['icon'],
            'archetype_color' => $archetype['color'],
            'overall_score' => $avgScore,
            'accuracy_percentage' => $accuracyPct,
            'correct_count' => $correctCount,
            'total_questions' => $totalQuestions,
            'readiness_grade' => $this->getReadinessGrade($avgScore),
            'executive_summary' => $executiveSummary,
            'strengths' => $strengths,
            'growth_areas' => $growthAreas,
            'stream_fit' => $streamFit,
            'target_exams' => $targetExams,
            'roadmap_90_days' => $roadmap,
            'counselor_notes' => $this->generateCounselorNotes($session, $archetype, $topDims, $growthDims),
            'generated_at' => now()->toIso8601String()
        ];
    }

    /**
     * Determine student's cognitive archetype based on top scoring faculties.
     */
    protected function determineArchetype(array $sortedDims, float $avgScore): array
    {
        $keys = array_keys($sortedDims);
        $top1 = $keys[0] ?? '';
        $top2 = $keys[1] ?? '';

        $isStem = in_array($top1, ['numerical-aptitude', 'abstract-reasoning', 'mechanical-reasoning']) &&
                  in_array($top2, ['numerical-aptitude', 'abstract-reasoning', 'mechanical-reasoning', 'spatial-aptitude']);

        $isSpatialDesign = in_array($top1, ['spatial-aptitude', 'perceptual-aptitude']) ||
                           in_array($top2, ['spatial-aptitude', 'mechanical-reasoning']);

        $isVerbalLegal = in_array($top1, ['verbal-reasoning', 'language-aptitude']) ||
                         in_array($top2, ['verbal-reasoning', 'language-aptitude']);

        if ($avgScore >= 8.5) {
            return [
                'title' => 'Strategic Analytical Architect',
                'subtitle' => 'High-Order Deductive Logic & Cognitive Fluency',
                'badge' => 'Tier 1 Top 5% Cognitive Talent',
                'icon' => 'fa-solid fa-brain-circuit',
                'color' => '#2563eb'
            ];
        }

        if ($isStem) {
            return [
                'title' => 'Systems Thinker & Quantitative Innovator',
                'subtitle' => 'Strong Mathematical Modeling & Computational Problem Solving',
                'badge' => 'STEM & Engineering Specialist',
                'icon' => 'fa-solid fa-microchip',
                'color' => '#059669'
            ];
        }

        if ($isSpatialDesign) {
            return [
                'title' => 'Spatial Visionary & Creative Architect',
                'subtitle' => 'Exceptional 3D Mental Rotation, Mechanical Mechanics & Perception',
                'badge' => 'Design, Robotics & Spatial Specialist',
                'icon' => 'fa-solid fa-shapes',
                'color' => '#7c3aed'
            ];
        }

        if ($isVerbalLegal) {
            return [
                'title' => 'Verbal Strategist & Executive Communicator',
                'subtitle' => 'Advanced Linguistic Synthesis, Critical Discourse & Persuasion',
                'badge' => 'Law, Management & Humanities Specialist',
                'icon' => 'fa-solid fa-scale-balanced',
                'color' => '#d97706'
            ];
        }

        return [
            'title' => 'Adaptive Multidisciplinary Thinker',
            'subtitle' => 'Balanced Cognitive Equilibrium Across Analytical & Intuitive Domains',
            'badge' => 'Versatile Professional Profile',
            'icon' => 'fa-solid fa-compass-drafting',
            'color' => '#0284c7'
        ];
    }

    /**
     * Detailed strength breakdown for a top dimension.
     */
    protected function getDimensionStrengthData(string $dim, float $score): array
    {
        $label = $this->dimensionLabels[$dim] ?? ucwords(str_replace('-', ' ', $dim));

        $details = [
            'numerical-aptitude' => [
                'headline' => 'Rapid Quantitative Modeling & Arithmetic Precision',
                'description' => 'You exhibit strong numerical fluency, quickly identifying proportions, percentages, and data patterns without cognitive fatigue.',
                'real_world' => 'Essential for Software Algorithms, Data Science, Quantitative Finance, and Engineering Mechanics.',
                'icon' => 'fa-solid fa-calculator',
                'color' => '#2563eb'
            ],
            'abstract-reasoning' => [
                'headline' => 'High-Order Pattern Recognition & Inductive Logic',
                'description' => 'Your mind naturally decouples complex problem statements into underlying rule systems, excelling at sequence completion and novel puzzles.',
                'real_world' => 'Fundamental for Machine Learning, Competitive Programming, Strategic Consulting, and Research Architecture.',
                'icon' => 'fa-solid fa-cubes',
                'color' => '#7c3aed'
            ],
            'spatial-aptitude' => [
                'headline' => '3D Mental Projection & Geometric Manipulation',
                'description' => 'You demonstrate superior visual-spatial imagination, mentally rotating 3D objects, assessing cross-sections, and understanding spatial volume.',
                'real_world' => 'Critical for Aerospace Engineering, CAD Design, Robotic Kinematics, Architecture, and Surgical Navigation.',
                'icon' => 'fa-solid fa-vr-cardboard',
                'color' => '#0ea5e9'
            ],
            'mechanical-reasoning' => [
                'headline' => 'Physical Intuition & Kinetic Systems Comprehension',
                'description' => 'You possess an instinctive grasp of practical physics principles—levers, gears, hydraulics, pressure, and electrical equilibrium.',
                'real_world' => 'Pivotal for Mechanical, Automobile, Mechatronics, and Industrial Automation engineering.',
                'icon' => 'fa-solid fa-gears',
                'color' => '#f97316'
            ],
            'verbal-reasoning' => [
                'headline' => 'Critical Syllogistic Inference & Conceptual Deduction',
                'description' => 'You excel at evaluating argument validity, identifying semantic analogies, and drawing logically sound conclusions from complex textual premises.',
                'real_world' => 'Key for Corporate Law, Public Policy, Corporate Strategy, Management, and Executive Leadership.',
                'icon' => 'fa-solid fa-comments',
                'color' => '#10b981'
            ],
            'language-aptitude' => [
                'headline' => 'Lexical Mastery & Structured Linguistic Formulation',
                'description' => 'Strong command over vocabulary nuances, grammatical structure, and concise communication of complex concepts.',
                'real_world' => 'Crucial for Publishing, International Diplomacy, Brand Communication, and High-Impact Documentation.',
                'icon' => 'fa-solid fa-book-open',
                'color' => '#ec4899'
            ],
            'perceptual-aptitude' => [
                'headline' => 'Visual Speed, Verification Accuracy & Error Detection',
                'description' => 'You spot micro-discrepancies, alphanumeric anomalies, and audit details with remarkable speed and minimal oversight.',
                'real_world' => 'Indispensable for Cybersecurity Analysis, Quality Assurance, Financial Auditing, and Medical Diagnostics.',
                'icon' => 'fa-solid fa-bullseye',
                'color' => '#eab308'
            ],
        ];

        $fallback = [
            'headline' => 'Strong Cognitive Competence in ' . $label,
            'description' => 'Demonstrates consistent accuracy and methodical problem resolution in ' . $label . '.',
            'real_world' => 'Valuable across professional disciplines requiring structured focus and analytical rigor.',
            'icon' => 'fa-solid fa-circle-check',
            'color' => '#3b82f6'
        ];

        $item = $details[$dim] ?? $fallback;
        $item['dimension'] = $dim;
        $item['label'] = $label;
        $item['score'] = $score;

        return $item;
    }

    /**
     * Constructive guidance for lower scoring dimensions.
     */
    protected function getDimensionGrowthData(string $dim, float $score): array
    {
        $label = $this->dimensionLabels[$dim] ?? ucwords(str_replace('-', ' ', $dim));

        $coaching = [
            'numerical-aptitude' => [
                'observation' => 'Numerical processing speed can be accelerated with mental math frameworks.',
                'coaching' => 'Practice Vedic Math multiplication shortcuts, percentage-to-fraction conversions, and timed 10-minute arithmetic sprints.',
                'drills' => ['Vedic Math speed tables', 'Data interpretation graphs', 'Quick mental estimation']
            ],
            'abstract-reasoning' => [
                'observation' => 'Abstract sequences can sometimes feel unintuitive under tight test constraints.',
                'coaching' => 'Deconstruct matrix patterns into individual visual parameters: count changes, angle rotations, and color alternation rules.',
                'drills' => ['Raven\'s Progressive Matrices', 'Rule-isolation diagramming', 'Spatial symmetry drills']
            ],
            'spatial-aptitude' => [
                'observation' => 'Visualizing unfolded 2D nets into 3D isometric solids requires systematic practice.',
                'coaching' => 'Work with origami folding, 3D modelling tools like Blender/Tinkercad, or paper cube rotation exercises.',
                'drills' => ['Orthographic to isometric projection', 'Cross-sectional slicing puzzles', 'Mental rotation benchmarks']
            ],
            'mechanical-reasoning' => [
                'observation' => 'Theoretical physics concepts need more hands-on practical intuition.',
                'coaching' => 'Review everyday mechanics principles—pulley advantage, gear train ratios, and hydraulic pressure transfers.',
                'drills' => ['Simple machines physics simulators', 'Electrical circuit breadboarding', 'Gear ratio calculations']
            ],
            'verbal-reasoning' => [
                'observation' => 'Differentiating between logically valid inferences and subjective assumptions takes disciplined training.',
                'coaching' => 'Focus on formal syllogisms (All A are B), identifying premise contradictions, and avoiding emotional bias in arguments.',
                'drills' => ['Critical reasoning argument mapping', 'Syllogism truth tables', 'Fallacy identification practice']
            ],
            'language-aptitude' => [
                'observation' => 'Vocabulary depth and nuanced contextual usage have high growth potential.',
                'coaching' => 'Read long-form editorial essays (e.g. The Hindu, Project Syndicate) and practice active word-association journaling.',
                'drills' => ['Root-word etymology cards (Latin/Greek)', 'Contextual sentence completions', 'Daily editorial synthesis']
            ],
            'perceptual-aptitude' => [
                'observation' => 'Fatigue during rapid character-matching can induce minor clerical oversights.',
                'coaching' => 'Train visual saccades using digit-cancellation exercises and systematic left-to-right scanning techniques.',
                'drills' => ['Timed proofreading exercises', 'Alphanumeric verification sheets', 'Visual scanning drills']
            ],
        ];

        $fallback = [
            'observation' => 'Performance in ' . $label . ' shows room for incremental calibration.',
            'coaching' => 'Schedule dedicated 15-minute weekly practice sessions targeting fundamentals in ' . $label . '.',
            'drills' => ['Fundamentals review', 'Timed sectional questions', 'Error log revision']
        ];

        $item = $coaching[$dim] ?? $fallback;
        $item['dimension'] = $dim;
        $item['label'] = $label;
        $item['score'] = $score;

        return $item;
    }

    /**
     * Map student's score profile to recommended academic streams.
     */
    protected function determineStreamFit(array $sortedDims, TestSession $session): array
    {
        $keys = array_keys($sortedDims);
        $top1 = $keys[0] ?? '';
        $top2 = $keys[1] ?? '';

        if (in_array($top1, ['abstract-reasoning', 'numerical-aptitude']) && in_array($top2, ['spatial-aptitude', 'mechanical-reasoning', 'numerical-aptitude', 'abstract-reasoning'])) {
            return [
                'primary' => 'Computer Science, AI & Engineering Technologies (PCM Stream)',
                'secondary' => 'Data Science, Applied Robotics & Quantitative Economics',
                'fit_percentage' => 95,
                'rationale' => 'Your synergy of elite abstract problem solving and numerical precision directly matches the cognitive prerequisites of top-tier software architecture and core engineering.'
            ];
        }

        if (in_array($top1, ['mechanical-reasoning', 'spatial-aptitude']) || in_array($top2, ['mechanical-reasoning', 'spatial-aptitude'])) {
            return [
                'primary' => 'Mechanical, Aerospace, EV & Mechatronics Engineering',
                'secondary' => 'Industrial Product Design, Architecture & Automation',
                'fit_percentage' => 92,
                'rationale' => 'Exceptional spatial intuition combined with physical kinetic reasoning makes you naturally suited for physical systems, aircraft design, and structural robotics.'
            ];
        }

        if (in_array($top1, ['verbal-reasoning', 'language-aptitude']) || in_array($top2, ['verbal-reasoning', 'numerical-aptitude'])) {
            return [
                'primary' => 'Corporate Law, Management, Economics & Strategic Policy',
                'secondary' => 'Consulting, Investment Analysis & Media Strategy',
                'fit_percentage' => 90,
                'rationale' => 'Strong deductive comprehension and structured articulation enable high performance in fast-paced executive, corporate, and legal environments.'
            ];
        }

        return [
            'primary' => 'Interdisciplinary STEM & Applied Management',
            'secondary' => 'Business Analytics, Technology Management & Allied Sciences',
            'fit_percentage' => 88,
            'rationale' => 'A well-rounded cognitive spread allows you to thrive at the intersection of technical execution and business operations.'
        ];
    }

    /**
     * Determine top competitive entrance exams fitting the candidate's mind.
     */
    protected function determineTargetExams(array $sortedDims, float $avgScore): array
    {
        $keys = array_keys($sortedDims);
        $top1 = $keys[0] ?? '';

        $exams = [];

        if (in_array($top1, ['numerical-aptitude', 'abstract-reasoning', 'mechanical-reasoning', 'spatial-aptitude'])) {
            $exams[] = [
                'name' => 'JEE Main & Advanced',
                'badge' => 'Prime Match',
                'color' => '#2563eb',
                'desc' => 'National engineering entrance for IITs, NITs, and IIITs requiring deep conceptual physics, math, and chemistry problem solving.'
            ];
            $exams[] = [
                'name' => 'MHT-CET (Maharashtra Engineering)',
                'badge' => 'High Probability Fit',
                'color' => '#059669',
                'desc' => 'State CET for top colleges (COEP, VJTI, PICT, SPIT) where your speed and accuracy can unlock 99+ percentile ranks.'
            ];
            $exams[] = [
                'name' => 'BITSAT / UCEED',
                'badge' => 'Aptitude Aligned',
                'color' => '#7c3aed',
                'desc' => 'Speed-focused online evaluations that reward superior spatial reasoning, rapid mental math, and visual logic.'
            ];
        } else {
            $exams[] = [
                'name' => 'CLAT / AILET',
                'badge' => 'Prime Match',
                'color' => '#2563eb',
                'desc' => 'National law entrance evaluating critical reading, logical reasoning, and legal deduction.'
            ];
            $exams[] = [
                'name' => 'IPMAT / CUET (General & Business)',
                'badge' => 'High Probability Fit',
                'color' => '#059669',
                'desc' => 'IIM 5-year integrated management & top central university entrance prioritizing verbal and quantitative reasoning.'
            ];
            $exams[] = [
                'name' => 'CAT / XAT (Long-term Target)',
                'badge' => 'Strategic Target',
                'color' => '#d97706',
                'desc' => 'Premier MBA entrance benchmark for decision-making, data interpretation, and quantitative aptitude.'
            ];
        }

        return $exams;
    }

    /**
     * Generate an actionable 90-day learning & career trajectory.
     */
    protected function generate90DayRoadmap(array $sortedDims, array $growthDims): array
    {
        $topLabel = $this->dimensionLabels[array_key_first($sortedDims)] ?? 'Key Strength';
        $growthLabel = $this->dimensionLabels[array_key_first($growthDims)] ?? 'Growth Area';

        return [
            [
                'period' => 'Days 1 – 30',
                'title' => 'Strength Consolidation & Foundation',
                'icon' => 'fa-solid fa-flag-checkered',
                'badge' => 'Phase 1',
                'action_items' => [
                    "Leverage your standout aptitude in {$topLabel} by taking advanced level-2 challenge questions.",
                    'Explore syllabus blueprints of your primary matched competitive entrance exams on CareerGyan.',
                    'Build an organized error log to review skipped or incorrect questions from your test.'
                ]
            ],
            [
                'period' => 'Days 31 – 60',
                'title' => 'Targeted Dimension Coaching & Speed Drills',
                'icon' => 'fa-solid fa-bolt',
                'badge' => 'Phase 2',
                'action_items' => [
                    "Dedicate 20 minutes daily to targeted drills in {$growthLabel} to elevate your baseline score.",
                    'Practice timed sectional quizzes (20 questions in 15 minutes) to master time allocation under pressure.',
                    'Use the CareerGyan College Predictor to model cutoffs required in your preferred regional or national colleges.'
                ]
            ],
            [
                'period' => 'Days 61 – 90',
                'title' => 'Full-Length Mocks & Strategic College Mapping',
                'icon' => 'fa-solid fa-trophy',
                'badge' => 'Phase 3',
                'action_items' => [
                    'Take full-length standardized mock tests under timed, exam-hall conditions.',
                    'Consult 1-on-1 with CareerGyan counselors or AI Guruji to lock in your final list of target branches and institutes.',
                    'Review category-wise closing ranks and seat matrices across rounds to craft a resilient admission strategy.'
                ]
            ]
        ];
    }

    /**
     * Compose executive performance summary text.
     */
    protected function generateExecutiveSummary(TestSession $session, array $archetype, float $avgScore, array $topDims, int $accuracyPct): string
    {
        $candidate = $session->candidate_name ?: 'Candidate';
        $topList = [];
        foreach ($topDims as $dim => $sc) {
            $topList[] = ($this->dimensionLabels[$dim] ?? $dim) . " ({$sc}/10)";
        }
        $topStr = implode(', ', $topList);

        if ($avgScore >= 8.0) {
            return "{$candidate} has demonstrated an exemplary cognitive profile across the 7 aptitude dimensions with an aggregate score of {$avgScore}/10 and {$accuracyPct}% test accuracy. The candidate exhibits outstanding natural prowess in {$topStr}. This cognitive footprint matches the '{$archetype['title']}' persona, characterized by disciplined analytical inquiry, rapid problem isolation, and high mental endurance. They are positioned in the top competitive tier for premier technical, scientific, or quantitative academic admissions.";
        }

        if ($avgScore >= 6.0) {
            return "{$candidate} presents a solid and well-balanced cognitive foundation with an aggregate score of {$avgScore}/10 and {$accuracyPct}% accuracy. Notable standout dimensions include {$topStr}. The profile reflects a '{$archetype['title']}' mindset, displaying reliable problem-solving consistency. With focused practice in the identified growth areas, the candidate is well equipped to achieve top percentiles in state and national competitive examinations.";
        }

        return "{$candidate} completed the comprehensive evaluation, scoring an average of {$avgScore}/10. Clear relative strengths emerged in {$topStr}. With the tailored 90-day practice drills and focused conceptual strengthening outlined below, the candidate can significantly accelerate speed, accuracy, and examination confidence.";
    }

    /**
     * Counselor review notes for admin dossier.
     */
    protected function generateCounselorNotes(TestSession $session, array $archetype, array $topDims, array $growthDims): string
    {
        $topKey = array_key_first($topDims);
        $topName = $this->dimensionLabels[$topKey] ?? 'Key Strengths';
        $growthKey = array_key_first($growthDims);
        $growthName = $this->dimensionLabels[$growthKey] ?? 'Growth Dimensions';

        return "Candidate displays high cognitive affinity for {$topName}. Recommend advising candidate towards academic streams with rigorous analytical or creative application. Key coaching opportunity lies in elevating {$growthName} through structured weekly practice. Overall admission tractability: Very High.";
    }

    /**
     * Qualitative score readiness grade.
     */
    protected function getReadinessGrade(float $avg): string
    {
        if ($avg >= 8.5) return 'Tier 1 - Outstanding Cognitive Excellence';
        if ($avg >= 7.0) return 'Tier 2 - Strong Analytical & Academic Readiness';
        if ($avg >= 5.5) return 'Tier 3 - Solid Foundational Aptitude';
        return 'Tier 4 - Emerging / Developmental Aptitude';
    }

    /**
     * Attempt external RAG/LLM enrichment if scraper is available.
     */
    protected function attemptExternalEnrichment(TestSession $session, array $baseAnalysis): ?array
    {
        $baseUrl = rtrim((string) config('services.careergyan_scrapper.base_url', 'http://127.0.0.1:8001'), '/');

        try {
            $prompt = "Act as an expert psychometric career counselor. Analyze the following student test results:\n"
                    . "- Overall Score: {$baseAnalysis['overall_score']}/10\n"
                    . "- Archetype: {$baseAnalysis['archetype_title']}\n"
                    . "- Top Dimensions: " . json_encode($session->aptitude_scores) . "\n"
                    . "Provide a brief 2-sentence empowering personalized insight for this student.";

            $resp = Http::timeout(4)->post("{$baseUrl}/api/chat", [
                'message' => $prompt,
                'history' => [],
                'top_k' => 2,
            ]);

            if ($resp->successful() && !empty($resp->json('reply'))) {
                return [
                    'ai_guruji_quote' => trim($resp->json('reply'))
                ];
            }
        } catch (\Throwable $e) {
            // Silently fall back to heuristic analysis without disruption
        }

        return null;
    }
}

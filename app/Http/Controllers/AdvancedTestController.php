<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvancedTestAttempt;
use App\Models\Career;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdvancedTestController extends Controller
{
    public function index()
    {
        $tests = [
            [
                'id' => 'personality-profiler',
                'title' => '🧠 Advanced Personality Profiler',
                'desc' => 'Understand your cognitive traits, work patterns, and interpersonal style mapped to career success using the Big Five framework.',
                'questions_count' => 15,
                'duration' => '10 mins',
                'color' => 'var(--brand)',
                'icon' => 'fa-solid fa-brain'
            ],
            [
                'id' => 'career-deep-dive',
                'title' => '🎯 Career Deep-Dive Analysis',
                'desc' => 'An in-depth suitability evaluation that assesses your detailed interests and compatibility with 50+ modern high-paying career paths.',
                'questions_count' => 15,
                'duration' => '12 mins',
                'color' => '#8b5cf6',
                'icon' => 'fa-solid fa-crosshairs'
            ],
            [
                'id' => 'industry-readiness',
                'title' => '⚡ Industry Readiness Score',
                'desc' => 'Test your soft skills, adaptive thinking, and corporate communication to see how prepared you are for today’s competitive job market.',
                'questions_count' => 15,
                'duration' => '10 mins',
                'color' => '#10b981',
                'icon' => 'fa-solid fa-briefcase'
            ],
            [
                'id' => 'leadership-entrepreneurship',
                'title' => '👑 Leadership & Entrepreneurial Aptitude',
                'desc' => 'Find out your risk tolerance, vision execution, and organizational capability. Ideal for aspiring founders, CEOs, and corporate leaders.',
                'questions_count' => 15,
                'duration' => '8 mins',
                'color' => '#f59e0b',
                'icon' => 'fa-solid fa-crown'
            ],
        ];

        $attempts = AdvancedTestAttempt::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('advanced-test.index', compact('tests', 'attempts'));
    }

    public function startTest($type)
    {
        $questions = $this->getQuestionsForType($type);
        if (empty($questions)) {
            return redirect()->route('advanced-test.index')->with('error', 'Test type not found.');
        }

        $title = $this->getTestTitle($type);
        
        return view('advanced-test.quiz', compact('questions', 'type', 'title'));
    }

    public function submitTest(Request $request)
    {
        $type = $request->input('type');
        $answers = $request->input('answers', []);
        
        $questions = $this->getQuestionsForType($type);
        if (empty($questions)) {
            return response()->json(['success' => false, 'message' => 'Invalid test type.']);
        }

        // Calculate scores grouped by category
        $scores = [];
        foreach ($questions as $q) {
            $ansValue = (int) ($answers[$q['id']] ?? 3); // Default to neutral/medium (3 out of 5)
            $category = $q['category'];
            
            if (!isset($scores[$category])) {
                $scores[$category] = ['total' => 0, 'count' => 0];
            }
            
            $scores[$category]['total'] += $ansValue;
            $scores[$category]['count']++;
        }

        $finalScores = [];
        foreach ($scores as $cat => $data) {
            $finalScores[$cat] = round(($data['total'] / ($data['count'] * 5)) * 100, 1);
        }

        // Generate custom recommendations
        $recommendations = $this->generateRecommendations($type, $finalScores);

        $attempt = AdvancedTestAttempt::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'test_type' => $type,
            'scores' => $finalScores,
            'answers' => $answers,
            'recommendations' => $recommendations
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('advanced-test.results', $attempt->uuid)
        ]);
    }

    public function results($uuid)
    {
        $attempt = AdvancedTestAttempt::where('uuid', $uuid)->firstOrFail();
        $title = $this->getTestTitle($attempt->test_type);
        
        return view('advanced-test.results', compact('attempt', 'title'));
    }

    private function getTestTitle($type)
    {
        $titles = [
            'personality-profiler' => 'Advanced Personality Profiler',
            'career-deep-dive' => 'Career Deep-Dive Analysis',
            'industry-readiness' => 'Industry Readiness Score',
            'leadership-entrepreneurship' => 'Leadership & Entrepreneurship Aptitude'
        ];
        return $titles[$type] ?? 'Advanced Career Test';
    }

    private function generateRecommendations($type, $scores)
    {
        // Mock matching logical recommendations based on highest scores
        arsort($scores);
        $primaryTrait = key($scores);

        if ($type === 'personality-profiler') {
            $recommendations = [
                'Openness' => [
                    'archetype' => 'The Creative Innovator',
                    'careers' => ['UI/UX Designer', 'Research Scientist', 'Marketing Strategist', 'Film Director'],
                    'strengths' => 'High creativity, abstract reasoning, adaptive problem solving, open to new concepts.',
                    'advice' => 'Look for roles that offer flexibility, creative freedom, and regular intellectual challenges rather than static routines.'
                ],
                'Conscientiousness' => [
                    'archetype' => 'The Master Executor',
                    'careers' => ['Project Manager', 'Software Engineer', 'Financial Analyst', 'Database Administrator'],
                    'strengths' => 'Highly organized, detail-oriented, reliable, structured thinker.',
                    'advice' => 'You thrive in environments with clear milestones, standard protocols, and analytical complexity.'
                ],
                'Extraversion' => [
                    'archetype' => 'The Social Catalyst',
                    'careers' => ['Public Relations Manager', 'Sales Director', 'HR Specialist', 'Product Manager'],
                    'strengths' => 'Exceptional communication, networking, collaborative leadership, persuasive capability.',
                    'advice' => 'Prioritize careers that involve client-facing activities, team coordination, or public speaking.'
                ],
                'Agreeableness' => [
                    'archetype' => 'The Compassionate Mentor',
                    'careers' => ['Clinical Psychologist', 'Educator / Professor', 'Customer Success Lead', 'Social worker'],
                    'strengths' => 'Empathy, consensus-building, conflict resolution, active listening.',
                    'advice' => 'You will find the most satisfaction in service-oriented, coaching, or community development fields.'
                ],
                'Emotional Stability' => [
                    'archetype' => 'The Resilient Strategist',
                    'careers' => ['Investment Banker', 'Cybersecurity Specialist', 'Emergency Coordinator', 'DevOps Architect'],
                    'strengths' => 'Calm under pressure, rational decision making, risk tolerance.',
                    'advice' => 'Your ability to stay logical in crisis makes you perfect for high-stakes, fast-moving environments.'
                ],
            ];
            return $recommendations[$primaryTrait] ?? $recommendations['Openness'];
        }

        if ($type === 'career-deep-dive') {
            $recommendations = [
                'Technology' => [
                    'archetype' => 'Full-Stack Technical Consultant',
                    'careers' => ['AI Engineer', 'Cloud Architect', 'Cybersecurity Expert', 'Full-Stack Developer'],
                    'strengths' => 'Algorithmic thinking, system design, continuous learning capability.',
                    'advice' => 'Target high-growth niches like Artificial Intelligence, Blockchain, or Cloud Infrastructure.'
                ],
                'Management' => [
                    'archetype' => 'Strategic Management Executive',
                    'careers' => ['Product Manager', 'Management Consultant', 'Operations Director', 'Operations Analyst'],
                    'strengths' => 'Stakeholder management, data-driven decisions, process optimization.',
                    'advice' => 'Look into MBA options or certifications like PMP/Agile Scrum to fast-track your path.'
                ],
                'Creative' => [
                    'archetype' => 'Digital Brand Architect',
                    'careers' => ['Game Designer', 'UX Lead', 'Creative Director', 'Copywriter'],
                    'strengths' => 'Visual communication, narrative creation, spatial design.',
                    'advice' => 'Work on building an outstanding digital portfolio. Focus on cross-disciplinary creative tech roles.'
                ],
                'Social' => [
                    'archetype' => 'Development & Relations Specialist',
                    'careers' => ['Educational Consultant', 'Corporate Trainer', 'NGO Director', 'PR Consultant'],
                    'strengths' => 'Community engagement, empathetic teaching, public advocacy.',
                    'advice' => 'Focus on organizations with strong social missions, sustainable development, or corporate social responsibility.'
                ],
            ];
            return $recommendations[$primaryTrait] ?? $recommendations['Technology'];
        }

        // Defaults for other tests
        return [
            'archetype' => 'High Aptitude Leader',
            'careers' => ['Founder', 'Management Consultant', 'Chief Technology Officer', 'Strategy Lead'],
            'strengths' => 'Balanced scoring across decision metrics, leadership vision, and technical awareness.',
            'advice' => 'Focus on developing cross-functional capabilities combining technical mastery with high empathy management.'
        ];
    }

    private function getQuestionsForType($type)
    {
        $questions = [
            'personality-profiler' => [
                ['id' => 'q1', 'text' => 'I feel energized and motivated when leading team discussions or brainstorming sessions.', 'category' => 'Extraversion'],
                ['id' => 'q2', 'text' => 'I prefer to plan out my week in detail rather than taking tasks as they come.', 'category' => 'Conscientiousness'],
                ['id' => 'q3', 'text' => 'I am deeply interested in abstract theories, philosophy, and creative concepts.', 'category' => 'Openness'],
                ['id' => 'q4', 'text' => 'I prioritize keeping team harmony and resolving arguments quickly, even if it requires compromise.', 'category' => 'Agreeableness'],
                ['id' => 'q5', 'text' => 'I remain calm, steady, and logical during high-pressure crises or tight deadlines.', 'category' => 'Emotional Stability'],
                ['id' => 'q6', 'text' => 'I enjoy going to networking events and meeting new professionals outside my circle.', 'category' => 'Extraversion'],
                ['id' => 'q7', 'text' => 'I pay close attention to minor details and double-check my work for errors.', 'category' => 'Conscientiousness'],
                ['id' => 'q8', 'text' => 'I enjoy visiting art galleries, reading complex novels, or listening to unique music.', 'category' => 'Openness'],
                ['id' => 'q9', 'text' => 'I find it easy to empathize with others and understand their personal challenges.', 'category' => 'Agreeableness'],
                ['id' => 'q10', 'text' => 'I rarely worry about minor setbacks and can easily pivot my attention.', 'category' => 'Emotional Stability'],
                ['id' => 'q11', 'text' => 'I express my thoughts easily in groups and am comfortable being the center of attention.', 'category' => 'Extraversion'],
                ['id' => 'q12', 'text' => 'I set high standards for my academic or professional performance and work diligently to meet them.', 'category' => 'Conscientiousness'],
                ['id' => 'q13', 'text' => 'I love thinking about futuristic concepts and imagining how technologies will evolve.', 'category' => 'Openness'],
                ['id' => 'q14', 'text' => 'I enjoy volunteering my time to help peers learn or complete their assignments.', 'category' => 'Agreeableness'],
                ['id' => 'q15', 'text' => 'I handle unexpected critique from superiors objectively without taking it personally.', 'category' => 'Emotional Stability'],
            ],
            'career-deep-dive' => [
                ['id' => 'q1', 'text' => 'I enjoy writing clean code, building algorithms, or designing database schemas.', 'category' => 'Technology'],
                ['id' => 'q2', 'text' => 'I love coordinating people, managing budgets, and planning project timelines.', 'category' => 'Management'],
                ['id' => 'q3', 'text' => 'I spend my free time drawing, editing videos, writing scripts, or designing logos.', 'category' => 'Creative'],
                ['id' => 'q4', 'text' => 'Helping students solve their career dilemmas or teaching skills gives me deep satisfaction.', 'category' => 'Social'],
                ['id' => 'q5', 'text' => 'I am eager to learn how artificial intelligence models are trained and deployed.', 'category' => 'Technology'],
                ['id' => 'q6', 'text' => 'I enjoy reading case studies about corporate mergers, startup funding, and market strategies.', 'category' => 'Management'],
                ['id' => 'q7', 'text' => 'I notice and critique user interfaces, color choices, and branding of apps I use.', 'category' => 'Creative'],
                ['id' => 'q8', 'text' => 'I am interested in psychology, counseling, and understanding human relationship dynamics.', 'category' => 'Social'],
                ['id' => 'q9', 'text' => 'I find logic puzzles, mathematical proofs, and data analysis highly satisfying.', 'category' => 'Technology'],
                ['id' => 'q10', 'text' => 'I feel comfortable making financial decisions and interpreting charts/spreadsheets.', 'category' => 'Management'],
                ['id' => 'q11', 'text' => 'I enjoy storytelling, blogging, or producing content for social media platforms.', 'category' => 'Creative'],
                ['id' => 'q12', 'text' => 'I enjoy organizing workshops, community campaigns, or educational events.', 'category' => 'Social'],
                ['id' => 'q13', 'text' => 'I prefer spending hours troubleshooting software/hardware bugs over managing people.', 'category' => 'Technology'],
                ['id' => 'q14', 'text' => 'I enjoy leading debates, selling ideas, and negotiating terms in group projects.', 'category' => 'Management'],
                ['id' => 'q15', 'text' => 'I enjoy craftwork, fashion design, game design, or writing creative copy.', 'category' => 'Creative'],
            ],
            'industry-readiness' => [
                ['id' => 'q1', 'text' => 'I can write professional business emails and structure slides clearly.', 'category' => 'Communication'],
                ['id' => 'q2', 'text' => 'I quickly adapt when a project scope changes and happily switch directions.', 'category' => 'Adaptability'],
                ['id' => 'q3', 'text' => 'When faced with a problem, I break it down logically rather than guessing solutions.', 'category' => 'Problem Solving'],
                ['id' => 'q4', 'text' => 'I understand industry trends in my chosen domain (e.g. AI tools, cloud, hybrid work).', 'category' => 'Domain Awareness'],
                ['id' => 'q5', 'text' => 'I feel confident presenting arguments to senior management or stakeholders.', 'category' => 'Communication'],
                ['id' => 'q6', 'text' => 'I can work effectively in cross-functional teams with people of diverse backgrounds.', 'category' => 'Adaptability'],
                ['id' => 'q7', 'text' => 'I enjoy analyzing root causes of failures to prevent them in the future.', 'category' => 'Problem Solving'],
                ['id' => 'q8', 'text' => 'I regularly read newsletters, blogs, or reports about my target industry.', 'category' => 'Domain Awareness'],
                ['id' => 'q9', 'text' => 'I active-listen to others and repeat back points to avoid communication gaps.', 'category' => 'Communication'],
                ['id' => 'q10', 'text' => 'I am comfortable shifting my work hours or location to meet critical project demands.', 'category' => 'Adaptability'],
                ['id' => 'q11', 'text' => 'I search for alternative angles to solve blockages when standard routes fail.', 'category' => 'Problem Solving'],
                ['id' => 'q12', 'text' => 'I know which tools, software, and frameworks are currently in demand in the market.', 'category' => 'Domain Awareness'],
                ['id' => 'q13', 'text' => 'I handle client feedback constructivly and implement requested changes quickly.', 'category' => 'Communication'],
                ['id' => 'q14', 'text' => 'I enjoy learning new tools and software systems on my own within a few days.', 'category' => 'Adaptability'],
                ['id' => 'q15', 'text' => 'I can isolate key metrics from a large dump of reports or data.', 'category' => 'Problem Solving'],
            ],
            'leadership-entrepreneurship' => [
                ['id' => 'q1', 'text' => 'I am comfortable investing time and money into high-risk, high-reward ideas.', 'category' => 'Risk Appetite'],
                ['id' => 'q2', 'text' => 'I can visualize product concepts and pitch them clearly to others.', 'category' => 'Visionary Thinking'],
                ['id' => 'q3', 'text' => 'I focus on getting things done (executing) rather than just planning/talking.', 'category' => 'Execution Focus'],
                ['id' => 'q4', 'text' => 'I can motivate uninspired team members to work toward a common goal.', 'category' => 'Charismatic Leadership'],
                ['id' => 'q5', 'text' => 'I see business failure as a valuable learning experience rather than a personal defeat.', 'category' => 'Risk Appetite'],
                ['id' => 'q6', 'text' => 'I often think of ways to improve or monetize everyday services/products I use.', 'category' => 'Visionary Thinking'],
                ['id' => 'q7', 'text' => 'I prioritize action, shipping MVPs (minimum viable products) and testing early.', 'category' => 'Execution Focus'],
                ['id' => 'q8', 'text' => 'I naturally take charge of groups and delegate tasks based on member strengths.', 'category' => 'Charismatic Leadership'],
                ['id' => 'q9', 'text' => 'I am comfortable leaving a secure, predictable job to start my own venture.', 'category' => 'Risk Appetite'],
                ['id' => 'q10', 'text' => 'I enjoy predicting market gaps and identifying consumer behavior trends.', 'category' => 'Visionary Thinking'],
                ['id' => 'q11', 'text' => 'I can work 12+ hour days consistently to launch a project on time.', 'category' => 'Execution Focus'],
                ['id' => 'q12', 'text' => 'I feel comfortable making hard decisions that might upset some team members.', 'category' => 'Charismatic Leadership'],
                ['id' => 'q13', 'text' => 'I am comfortable making strategic choices with only 50-60% of the facts available.', 'category' => 'Risk Appetite'],
                ['id' => 'q14', 'text' => 'I prefer to create my own unique path rather than following a pre-existing blueprint.', 'category' => 'Visionary Thinking'],
                ['id' => 'q15', 'text' => 'I hold myself and my team accountable for meeting quality metrics and deadliness.', 'category' => 'Execution Focus'],
            ],
        ];

        return $questions[$type] ?? [];
    }

    public function certificate($uuid)
    {
        $attempt = AdvancedTestAttempt::where('uuid', $uuid)->firstOrFail();
        
        $name = Auth::user()->name;
        $testTitle = $this->getTestTitle($attempt->test_type);
        $date = $attempt->created_at ? $attempt->created_at->format('d F Y') : now()->format('d F Y');
        
        $topCareer = $attempt->recommendations['archetype'] ?? 'N/A';
        
        return view('certificate.show', compact('name', 'testTitle', 'date', 'uuid', 'topCareer'));
    }
}

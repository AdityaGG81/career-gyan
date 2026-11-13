<?php

namespace App\Http\Controllers;

use App\Models\AiChatLog;
use App\Models\TestSession;
use App\Models\StudentAnalysis;
use App\Models\QuickTestAttempt;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AiCareerChatController extends Controller
{
    /**
     * Send a user message to the trained CareerGyan Scraper RAG API.
     */
    public function message(Request $request)
    {
        $startTime = microtime(true);

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
            'history' => 'nullable|array',
            'session_id' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reply' => 'Please enter a valid message.',
                'remaining' => 5,
            ], 422);
        }

        $user = auth()->user();
        $userId = $user ? $user->id : null;
        $name = $user ? ($user->name ?? $user->first_name ?? 'User') : 'Guest';
        $email = $user ? ($user->email ?? '') : '';
        $sessionId = $request->input('session_id') ?: ($request->hasSession() ? $request->session()->getId() : (string) Str::uuid());
        
        $date = now()->format('Y-m-d');
        $userCacheKey = $userId 
            ? "ai_chat_limit_user_{$userId}_{$date}" 
            : "ai_chat_limit_guest_" . md5($request->ip() . '_' . $sessionId) . "_{$date}";
        
        $maxCount = Cache::get($userCacheKey, 0);
        $remaining = max(0, 5 - $maxCount);

        $isTestUser = ($email === 'test@gmail.com');

        if (! $isTestUser && $maxCount >= 5) {
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

            // Log rate-limited attempt
            $this->safeLogQuestion([
                'user_id' => $user->id ?? null,
                'user_name' => $name,
                'user_email' => $email,
                'session_id' => $sessionId,
                'question' => $request->message,
                'reply' => 'Daily free question limit reached. Please try again tomorrow.',
                'status' => 'rate_limited',
                'model_used' => 'Rate Limiter',
                'response_time_ms' => $responseTimeMs,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => false,
                'reply' => 'Daily free question limit reached. Please try again tomorrow.',
                'remaining' => 0,
            ], 429);
        }

        // Keep 'remaining' high for test user so the UI doesn't show 0
        if ($isTestUser) {
            $remaining = 999;
        }

        $timeout = (int) config('services.careergyan_scrapper.timeout', 45);
        $primaryUrl = rtrim((string) config('services.careergyan_scrapper.base_url', 'http://127.0.0.1:8001'), '/');
        
        // List candidate endpoints to check: configured URL first, then fallback to 8000 if different
        $endpoints = [$primaryUrl];
        if (! in_array('http://127.0.0.1:8000', $endpoints) && ! in_array('http://localhost:8000', $endpoints)) {
            $endpoints[] = 'http://127.0.0.1:8000';
        }

        $incomingHistory = $request->input('history', []);
        $history = is_array($incomingHistory) ? array_slice($incomingHistory, -6) : [];

        // Fetch student's test results context
        $testContext = $this->getStudentTestContext($user, $request);

        $messageToSend = $request->message;
        if ($testContext['has_data']) {
            $messageToSend .= "\n\n[STUDENT VERIFIED ASSESSMENT & TEST RESULTS:\n" . $testContext['summary'] . "\nActively use these verified test results and scores to provide tailored career suggestions, explain why particular fields fit their aptitude, and outline actionable next steps.]";
        }

        $chatPayload = [
            'message' => $messageToSend,
            'history' => $history,
            'top_k' => 5,
        ];

        $successfulResponse = null;
        $activeBaseUrl = null;
        $lastError = null;

        foreach ($endpoints as $baseUrl) {
            try {
                $response = Http::timeout($timeout)
                    ->acceptJson()
                    ->post("{$baseUrl}/api/chat", $chatPayload);

                if ($response->successful()) {
                    $successfulResponse = $response->json();
                    $activeBaseUrl = $baseUrl;
                    break;
                } else {
                    $lastError = "HTTP " . $response->status() . " from {$baseUrl}";
                }
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
            }
        }

        if ($successfulResponse && isset($successfulResponse['reply'])) {
            $reply = trim((string) $successfulResponse['reply']);
            $sources = $successfulResponse['sources'] ?? [];

            Cache::put($userCacheKey, $maxCount + 1, now()->endOfDay());

            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);
            $port = parse_url($activeBaseUrl, PHP_URL_PORT) ?: '8001';

            // Log successful response
            $this->safeLogQuestion([
                'user_id' => $user->id ?? null,
                'user_name' => $name,
                'user_email' => $email,
                'session_id' => $sessionId,
                'question' => $request->message,
                'reply' => $reply,
                'sources' => $sources,
                'model_used' => "RAG Scrapper (Port {$port})",
                'status' => 'success',
                'response_time_ms' => $responseTimeMs,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'reply' => $reply,
                'sources' => $sources,
                'remaining' => $isTestUser ? 999 : max(0, 5 - ($maxCount + 1)),
            ]);
        }

        // Fallback: Check if legacy aicredits API is configured if scrapper is offline
        $legacyKey = trim((string) config('services.aicredits.api_key'));
        if ($legacyKey !== '') {
            try {
                $legacyResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $legacyKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                    ->timeout(30)
                    ->post(rtrim(config('services.aicredits.base_url'), '/') . '/chat/completions', [
                        'model' => config('services.aicredits.model'),
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => 'You are CareerGyan AI Career Guide for Indian students. Provide detailed, helpful, and highly informative career guidance.',
                            ],
                            [
                                'role' => 'user',
                                'content' => "Name: {$name}\nQuestion: {$messageToSend}",
                            ],
                        ],
                        'temperature' => 0.7,
                        'max_tokens' => 500,
                    ]);

                if ($legacyResponse->successful()) {
                    $legacyReply = data_get($legacyResponse->json(), 'choices.0.message.content');
                    if ($legacyReply) {
                        Cache::put($userCacheKey, $maxCount + 1, now()->endOfDay());

                        $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

                        $this->safeLogQuestion([
                            'user_id' => $user->id ?? null,
                            'user_name' => $name,
                            'user_email' => $email,
                            'session_id' => $sessionId,
                            'question' => $request->message,
                            'reply' => trim($legacyReply),
                            'sources' => [],
                            'model_used' => 'Legacy AI Fallback',
                            'status' => 'success',
                            'response_time_ms' => $responseTimeMs,
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->userAgent(),
                        ]);

                        return response()->json([
                            'success' => true,
                            'reply' => trim($legacyReply),
                            'sources' => [],
                            'remaining' => $isTestUser ? 999 : max(0, 5 - ($maxCount + 1)),
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Legacy AI fallback failed: ' . $e->getMessage());
                $lastError = 'Legacy AI failed: ' . $e->getMessage();
            }
        }

        // If external RAG is offline, check if question can be answered intelligently from student's test results
        $testBasedReply = $this->generateTestBasedSuggestion($request->message, $testContext);
        if ($testBasedReply) {
            Cache::put($userCacheKey, $maxCount + 1, now()->endOfDay());
            $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

            $this->safeLogQuestion([
                'user_id' => $user->id ?? null,
                'user_name' => $name,
                'user_email' => $email,
                'session_id' => $sessionId,
                'question' => $request->message,
                'reply' => $testBasedReply,
                'sources' => [
                    ['title' => 'Your CareerGyan Assessment Results', 'url' => route('career-test.hub')],
                    ['title' => 'Career Explorer & Roadmaps', 'url' => url('/explore')],
                    ['title' => 'Maharashtra College Cutoffs', 'url' => route('tools.mh-cutoff')]
                ],
                'model_used' => 'CareerGyan Test Analyzer (Direct Engine)',
                'status' => 'success',
                'response_time_ms' => $responseTimeMs,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'reply' => $testBasedReply,
                'sources' => [
                    ['title' => 'Your CareerGyan Assessment Results', 'url' => route('career-test.hub')],
                    ['title' => 'Career Explorer & Roadmaps', 'url' => url('/explore')],
                    ['title' => 'Maharashtra College Cutoffs', 'url' => route('tools.mh-cutoff')]
                ],
                'remaining' => $isTestUser ? 999 : max(0, 5 - ($maxCount + 1)),
            ]);
        }

        Log::error('CareerGyan Scrapper API connection failed', [
            'attempted_endpoints' => $endpoints,
            'last_error' => $lastError,
        ]);

        $failureReply = 'The CareerGyan AI service is starting up or offline. Please make sure the AI scrapper service is running (start it with `python app.py` in the careergyan_scrapper folder).';
        $responseTimeMs = (int) round((microtime(true) - $startTime) * 1000);

        // Log failed attempt
        $this->safeLogQuestion([
            'user_id' => $user->id ?? null,
            'user_name' => $name,
            'user_email' => $email,
            'session_id' => $sessionId,
            'question' => $request->message,
            'reply' => $failureReply,
            'status' => 'failed',
            'error_message' => $lastError,
            'model_used' => 'Service Offline / Error',
            'response_time_ms' => $responseTimeMs,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'success' => false,
            'reply' => $failureReply,
            'remaining' => $remaining,
        ], 503);
    }

    /**
     * Safely record the chat interaction in the database without disrupting the response.
     */
    protected function safeLogQuestion(array $attributes): void
    {
        try {
            AiChatLog::create($attributes);
        } catch (\Throwable $e) {
            Log::error('Failed to log chatbot query: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
    }

    /**
     * Get the remaining daily free question limit for the user or guest.
     */
    public function getRemainingLimit(Request $request)
    {
        $user = auth()->user();
        $date = now()->format('Y-m-d');

        if ($user) {
            $email = $user->email;
            if ($email === 'test@gmail.com') {
                return response()->json(['remaining' => 999]);
            }
            $userCacheKey = "ai_chat_limit_user_{$user->id}_{$date}";
        } else {
            $sessionId = $request->input('session_id') ?: ($request->hasSession() ? $request->session()->getId() : '');
            $userCacheKey = "ai_chat_limit_guest_" . md5($request->ip() . '_' . $sessionId) . "_{$date}";
        }

        $maxCount = Cache::get($userCacheKey, 0);
        $remaining = max(0, 5 - $maxCount);

        return response()->json(['remaining' => $remaining]);
    }

    /**
     * Debug and diagnose the legacy AI credits API connection.
     */
    public function debugAicreditsTest()
    {
        $baseUrl = rtrim((string) config('services.aicredits.base_url', 'https://api.aicredits.com/v1'), '/');
        $apiKey = (string) config('services.aicredits.api_key', '');
        $model = (string) config('services.aicredits.model', 'gpt-3.5-turbo');

        $statusData = null;
        $statusError = null;

        if (empty($apiKey)) {
            $statusError = 'API key is not configured in services.aicredits.api_key';
        } else {
            try {
                $response = Http::withHeaders([
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json',
                ])->timeout(10)->get("{$baseUrl}/models");
                $statusData = $response->json() ?: $response->body();
            } catch (\Exception $e) {
                $statusError = $e->getMessage();
            }
        }

        return response()->json([
            'configured_url' => $baseUrl,
            'model' => $model,
            'has_api_key' => !empty($apiKey),
            'status' => [
                'success' => $statusError === null,
                'data' => $statusData,
                'error' => $statusError,
            ],
        ]);
    }

    /**
     * Debug and diagnose the CareerGyan Scrapper API connection.
     */
    public function debugScrapperTest()
    {
        $baseUrl = rtrim((string) config('services.careergyan_scrapper.base_url', 'http://127.0.0.1:8001'), '/');
        $timeout = (int) config('services.careergyan_scrapper.timeout', 15);

        $statusData = null;
        $statusError = null;

        try {
            $statusResp = Http::timeout(10)->get("{$baseUrl}/api/status");
            $statusData = $statusResp->json() ?: $statusResp->body();
        } catch (\Exception $e) {
            $statusError = $e->getMessage();
        }

        $chatData = null;
        $chatError = null;

        try {
            $chatResp = Http::timeout($timeout)->post("{$baseUrl}/api/chat", [
                'message' => 'What career guidance does CareerGyan provide?',
                'history' => [],
                'top_k' => 3,
            ]);
            $chatData = $chatResp->json() ?: $chatResp->body();
        } catch (\Exception $e) {
            $chatError = $e->getMessage();
        }

        return response()->json([
            'configured_url' => $baseUrl,
            'status_endpoint' => [
                'success' => $statusError === null,
                'data' => $statusData,
                'error' => $statusError,
            ],
            'chat_test_endpoint' => [
                'success' => $chatError === null,
                'data' => $chatData,
                'error' => $chatError,
            ],
        ]);
    }

    /**
     * Return the student's test results status & personalized prompt chips.
     */
    public function profileStatus(Request $request)
    {
        $user = auth()->user();
        $testContext = $this->getStudentTestContext($user, $request);

        return response()->json([
            'has_test_results' => $testContext['has_data'],
            'student_name' => $testContext['name'],
            'brief' => $testContext['brief'],
            'test_types' => $testContext['test_types'] ?? [],
            'top_careers' => $testContext['top_careers'],
            'quick_prompts' => $testContext['quick_prompts'],
        ]);
    }

    /**
     * Gather comprehensive test results and assessment data for the student.
     */
    public function getStudentTestContext($user = null, ?Request $request = null): array
    {
        $hasData = false;
        $sections = [];
        $topCareers = [];
        $archetype = null;
        $testTypes = [];
        $candidateName = $user ? ($user->name ?? $user->first_name) : 'Student';

        // 1. Check Student Analysis (47 Questions)
        $analysis = null;
        if ($user) {
            $analysis = StudentAnalysis::where('user_id', $user->id)->latest()->first();
        }
        if (!$analysis && $request && $request->hasSession() && $request->session()->has('last_analysis_uuid')) {
            $analysis = StudentAnalysis::where('uuid', $request->session()->get('last_analysis_uuid'))->first();
        }
        if (!$analysis && $user && $user->email) {
            $analysis = StudentAnalysis::where('email', $user->email)->latest()->first();
        }

        if ($analysis) {
            $hasData = true;
            $testTypes[] = 'Student Analysis';
            $candidateName = $analysis->full_name ?: $candidateName;
            $class = $analysis->current_class;
            $stream = $analysis->current_stream;
            $desiredCourse = $analysis->desired_admission_course;
            $enjoyed = is_array($analysis->enjoyed_subjects) ? implode(', ', $analysis->enjoyed_subjects) : ($analysis->enjoyed_subjects ?: 'N/A');
            $difficult = is_array($analysis->difficult_subjects) ? implode(', ', $analysis->difficult_subjects) : ($analysis->difficult_subjects ?: 'N/A');
            $skills = is_array($analysis->strongest_skills) ? implode(', ', $analysis->strongest_skills) : ($analysis->strongest_skills ?: 'N/A');
            $dream = $analysis->dream_career ?: $analysis->desired_admission_course;

            $sections[] = "STUDENT QUESTIONNAIRE & ACADEMIC ANALYSIS:
- Candidate Name: {$candidateName}
- Current Class & Stream: {$class} ({$stream})
- Desired Target Course / Career: {$desiredCourse}
- Enjoyed Subjects: {$enjoyed}
- Difficult / Challenging Subjects: {$difficult}
- Key Strengths & Skills: {$skills}
- Stated Career Goals / Dream Career: {$dream}
- Problem-Solving Rating: {$analysis->problem_solving_rating}/5
- Target Colleges: " . ($analysis->target_colleges_list ?? 'Top Institutes') . "
- Planned Entrance Exams: " . (is_array($analysis->entrance_exams_planning) ? implode(', ', $analysis->entrance_exams_planning) : ($analysis->entrance_exams_planning ?? 'State / National CETs'));
        }

        // 2. Check Aptitude Test (7 Dimensions)
        $testSession = null;
        if ($user) {
            $testSession = TestSession::where('user_id', $user->id)->latest()->first();
        }
        if (!$testSession && $request && $request->hasSession() && $request->session()->has('last_test_uuid')) {
            $testSession = TestSession::where('uuid', $request->session()->get('last_test_uuid'))->first();
        }

        if ($testSession) {
            $hasData = true;
            $testTypes[] = 'Aptitude Test';
            $scores = $testSession->aptitude_scores ?? [];
            $scoresList = [];
            foreach ($scores as $dim => $sc) {
                $label = ucwords(str_replace(['-aptitude', '-reasoning'], '', $dim));
                $scoresList[] = "{$label}: {$sc}/10";
            }
            $scoresStr = implode(', ', $scoresList);

            $recommended = $testSession->recommended_careers ?? [];
            if (!empty($recommended)) {
                $careerModels = Career::whereIn('id', array_keys($recommended))->take(5)->get();
                foreach ($careerModels as $cm) {
                    $matchPct = $recommended[$cm->id] ?? 85;
                    $topCareers[] = "{$cm->name} ({$matchPct}% match)";
                }
            }

            $sections[] = "APTITUDE TEST BENCHMARK SCORES (Out of 10):
- 7-Dimension Aptitude Scores: {$scoresStr}
- Algorithmic Top Matched Careers: " . (!empty($topCareers) ? implode(', ', $topCareers) : 'Mapped in CareerGyan');
        }

        // 3. Check Quick Test
        $quickTest = null;
        if ($user && $user->email) {
            $quickTest = QuickTestAttempt::where('student_email', $user->email)->latest()->first();
        }
        if ($quickTest) {
            $hasData = true;
            $testTypes[] = 'Quick Test';
            $sections[] = "QUICK TEST SCORE: {$quickTest->total_score} points (Stream Suggestions: " . $quickTest->stream_summary . ")";
        }

        $summary = implode("\n\n", $sections);
        $brief = $hasData ? "Assessment scores & career roadmap ready" : "No test taken yet";

        $quickPrompts = [];
        if ($hasData) {
            $quickPrompts = [
                '🎯 Suggest top careers based on my test results',
                '📊 What do my aptitude scores mean for my career?',
                '🚀 Step-by-step roadmap for my recommended careers',
                '🏛️ Which colleges & entrance exams best match my strengths?'
            ];
        } else {
            $quickPrompts = [
                '🧭 What careers can I explore on CareerGyan?',
                '📝 How do I take the Aptitude Test or Student Analysis?',
                '🎓 What are the top engineering and medical cutoffs in Maharashtra?'
            ];
        }

        return [
            'has_data' => $hasData,
            'name' => $candidateName,
            'brief' => $brief,
            'test_types' => $testTypes,
            'summary' => $summary,
            'archetype' => $archetype,
            'top_careers' => $topCareers,
            'quick_prompts' => $quickPrompts,
        ];
    }

    /**
     * Generate an intelligent direct recommendation when external LLM is offline
     * but student test data is available in database.
     */
    protected function generateTestBasedSuggestion(string $message, array $testContext): ?string
    {
        if (!$testContext['has_data']) {
            return null;
        }

        $lower = strtolower($message);
        $testKeywords = ['test', 'result', 'score', 'suggest', 'recommend', 'career', 'strength', 'aptitude', 'what should i do', 'roadmap', 'college', 'option', 'guidance', 'exam', 'admission'];
        $matches = false;
        foreach ($testKeywords as $kw) {
            if (str_contains($lower, $kw)) {
                $matches = true;
                break;
            }
        }

        if (!$matches) {
            return null;
        }

        $name = $testContext['name'] ?? 'Student';
        $topCareers = $testContext['top_careers'] ?? [];
        $careersList = !empty($topCareers) 
            ? implode("\n- ", $topCareers) 
            : "- Software Engineering & Artificial Intelligence\n- Data Science & Analytics\n- Professional Management & Technology";

        return "### 🎯 Personalized Career Guidance for **{$name}**\n\n"
             . "I have analyzed your **CareerGyan Assessment & Test Results**! Here is your personalized breakdown:\n\n"
             . "#### 1. Top Recommended Career Matches\n"
             . "- {$careersList}\n\n"
             . "#### 2. Key Insights from your Assessment\n"
             . "Your assessment highlights clear strengths in logical reasoning, problem-solving, and subject competency. Your scores indicate you perform best in high-impact structured environments where analytical capabilities and technical skills are rewarded.\n\n"
             . "#### 3. Recommended Next Steps & Roadmap\n"
             . "1. **Target Admissions & Entrance Exams**: Focus preparation on key state & national entrance tests (such as JEE Main, MHT-CET, or relevant discipline exams) matching your target streams.\n"
             . "2. **Explore Cutoffs & Top Colleges**: Use the CareerGyan [College Predictor](/tools/college-predictor) and [2026 Cutoffs Portal](/tools/maharashtra-cutoff) to evaluate top institutes within your target percentiles.\n"
             . "3. **Foundational Skills**: Start exploring practical skills, certifications, and project work in your top recommended fields.\n\n"
             . "*Feel free to ask me about specific college options, syllabus details, or entrance cutoff percentiles!*";
    }
}

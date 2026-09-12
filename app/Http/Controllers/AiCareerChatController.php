<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AiCareerChatController extends Controller
{
    /**
     * Send a user message to the trained CareerGyan Scraper RAG API.
     */
    public function message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
            'history' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reply' => 'Please enter a valid message.',
                'remaining' => 5,
            ], 422);
        }

        $user = auth()->user();
        $name = $user->name ?? $user->first_name ?? 'User';
        $email = $user->email ?? '';
        
        $date = now()->format('Y-m-d');
        $userCacheKey = "ai_chat_limit_user_{$user->id}_{$date}";
        
        $maxCount = Cache::get($userCacheKey, 0);
        $remaining = max(0, 5 - $maxCount);

        $isTestUser = ($email === 'test@gmail.com');

        if (! $isTestUser && $maxCount >= 5) {
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

        $chatPayload = [
            'message' => $request->message,
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
                                'content' => "Name: {$name}\nQuestion: {$request->message}",
                            ],
                        ],
                        'temperature' => 0.7,
                        'max_tokens' => 500,
                    ]);

                if ($legacyResponse->successful()) {
                    $legacyReply = data_get($legacyResponse->json(), 'choices.0.message.content');
                    if ($legacyReply) {
                        Cache::put($userCacheKey, $maxCount + 1, now()->endOfDay());

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
            }
        }

        Log::error('CareerGyan Scrapper API connection failed', [
            'attempted_endpoints' => $endpoints,
            'last_error' => $lastError,
        ]);

        return response()->json([
            'success' => false,
            'reply' => 'The CareerGyan AI service is starting up or offline. Please make sure the AI scrapper service is running (start it with `python app.py` in the careergyan_scrapper folder).',
            'remaining' => $remaining,
        ], 503);
    }

    /**
     * Get the remaining daily free question limit for the authenticated user.
     */
    public function getRemainingLimit()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['remaining' => 0]);
        }

        $email = $user->email;
        $isTestUser = ($email === 'test@gmail.com');

        if ($isTestUser) {
            return response()->json(['remaining' => 999]);
        }

        $date = now()->format('Y-m-d');
        $userCacheKey = "ai_chat_limit_user_{$user->id}_{$date}";
        $maxCount = Cache::get($userCacheKey, 0);
        $remaining = max(0, 5 - $maxCount);

        return response()->json(['remaining' => $remaining]);
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
}

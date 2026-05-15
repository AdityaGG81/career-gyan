<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AiCareerChatController extends Controller
{
    public function message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
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
        $email = $user->email;
        $qualification = 'Student/User';
        
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

        $apiKey = trim((string) config('services.aicredits.api_key'));

        if ($apiKey === '') {
            return response()->json([
                'success' => false,
                'reply' => 'AI service is not configured yet.',
                'remaining' => 5,
            ]);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
                ->timeout(45)
                ->post(rtrim(config('services.aicredits.base_url'), '/').'/chat/completions', [
                    'model' => config('services.aicredits.model'),
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are CareerGyan AI Career Guide for Indian students. Provide detailed, helpful, and highly informative career guidance.',
                        ],
                        [
                            'role' => 'user',
                            'content' => "Name: {$name}\nEmail: {$email}\nQualification: {$qualification}\nQuestion: {$request->message}",
                        ],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 500,
                ]);

            if ($response->failed()) {
                Log::error('AI Credits API failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'base_url' => config('services.aicredits.base_url'),
                    'model' => config('services.aicredits.model'),
                    'api_key_present' => $apiKey !== '',
                    'api_key_length' => strlen($apiKey),
                ]);

                if ($response->status() === 401) {
                    return response()->json([
                        'success' => false,
                        'reply' => 'AI key is invalid. Please update API key.',
                        'remaining' => $remaining,
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'reply' => 'Sorry, I could not answer right now. Please try again.',
                    'remaining' => $remaining,
                ]);
            }

            $reply = data_get($response->json(), 'choices.0.message.content');

            if (! $reply) {
                Log::error('AI Credits response parsing failed', [
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'success' => false,
                    'reply' => 'AI response format error.',
                    'remaining' => $remaining,
                ]);
            }

            $reply = trim($reply);

            Cache::put($userCacheKey, $maxCount + 1, now()->endOfDay());

            return response()->json([
                'success' => true,
                'reply' => $reply,
                'remaining' => $isTestUser ? 999 : max(0, 5 - ($maxCount + 1)),
            ]);
        } catch (\Exception $e) {
            Log::error('AI Career Chat Exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'reply' => 'Sorry, I could not answer right now. Please try again.',
                'remaining' => $remaining,
            ], 500);
        }
    }

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

    public function debugAicreditsTest()
    {
        $apiKey = trim((string) config('services.aicredits.api_key'));
        $baseUrl = rtrim((string) config('services.aicredits.base_url'), '/');
        $model = config('services.aicredits.model');

        if ($apiKey === '') {
            return response()->json([
                'status' => null,
                'body' => 'API key missing from Laravel config',
                'base_url' => $baseUrl,
                'model' => $model,
                'api_key_present' => false,
                'api_key_length' => 0,
            ]);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
                ->timeout(45)
                ->post($baseUrl.'/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => 'Reply only Hello',
                        ],
                    ],
                    'temperature' => 0.2,
                    'max_tokens' => 20,
                ]);

            return response()->json([
                'status' => $response->status(),
                'body' => $response->json() ?: $response->body(),
                'base_url' => $baseUrl,
                'model' => $model,
                'api_key_present' => true,
                'api_key_length' => strlen($apiKey),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'body' => $e->getMessage(),
                'base_url' => $baseUrl,
                'model' => $model,
                'api_key_present' => true,
                'api_key_length' => strlen($apiKey),
            ]);
        }
    }
}

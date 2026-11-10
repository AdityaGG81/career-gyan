<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityPost;
use App\Models\CommunityAnswer;
use App\Models\CommunityVote;
use App\Models\CommunityProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    /**
     * Auto-seed sample community threads if database is empty.
     */
    private function ensureCommunitySeeded(): void
    {
        if (CommunityPost::count() === 0 && class_exists(\Database\Seeders\CommunitySeeder::class)) {
            try {
                (new \Database\Seeders\CommunitySeeder())->run();
            } catch (\Exception $e) {
                // Ignore duplicate errors
            }
        }
    }

    /**
     * Get or create active community profile for the current visitor.
     */
    private function getCurrentProfile(Request $request): array
    {
        $sessionId = $request->session()->getId();

        if (Auth::check()) {
            $user = Auth::user();
            $dbProfile = CommunityProfile::where('user_id', $user->id)->first();
            if ($dbProfile) {
                return [
                    'name' => $dbProfile->display_name ?: $user->name,
                    'persona' => $dbProfile->persona ?: 'College Student',
                    'headline' => $dbProfile->headline ?: 'Member of CareerGyan',
                    'color' => $dbProfile->avatar_color ?: '#ff4500',
                    'points' => $dbProfile->reputation_points,
                    'is_logged_in' => true,
                ];
            }

            return [
                'name' => $user->name,
                'persona' => 'College Student',
                'headline' => 'CareerGyan Student',
                'color' => '#2563eb',
                'points' => 10,
                'is_logged_in' => true,
            ];
        }

        // Guest profile from session or cookies
        $guestName = $request->session()->get('community_guest_name', $request->cookie('community_guest_name'));
        $guestPersona = $request->session()->get('community_guest_persona', $request->cookie('community_guest_persona', '10th/12th Student'));
        $guestHeadline = $request->session()->get('community_guest_headline', $request->cookie('community_guest_headline', 'Aspiring Student'));
        $guestColor = $request->session()->get('community_guest_color', $request->cookie('community_guest_color', '#ff4500'));

        if ($guestName) {
            return [
                'name' => $guestName,
                'persona' => $guestPersona,
                'headline' => $guestHeadline,
                'color' => $guestColor,
                'points' => 10,
                'is_logged_in' => false,
            ];
        }

        return [
            'name' => '',
            'persona' => '10th/12th Student',
            'headline' => '',
            'color' => '#ff4500',
            'points' => 10,
            'is_logged_in' => false,
        ];
    }

    /**
     * Community Feed Homepage.
     */
    public function index(Request $request, $channel = 'all')
    {
        $this->ensureCommunitySeeded();

        $channels = CommunityPost::getChannels();
        $selectedChannel = strtolower(trim($request->input('channel', $channel)));
        if (!isset($channels[$selectedChannel])) {
            $selectedChannel = 'all';
        }

        $sort = $request->input('sort', 'hot'); // 'hot', 'new', 'top', 'unanswered'
        $search = trim($request->input('search', ''));

        $query = CommunityPost::withCount('answers');

        if ($selectedChannel !== 'all') {
            $query->where('channel', $selectedChannel);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%");
            });
        }

        switch ($sort) {
            case 'new':
                $query->latest();
                break;
            case 'top':
                $query->orderBy('upvotes_count', 'desc')->latest();
                break;
            case 'unanswered':
                $query->where('answers_count', 0)->latest();
                break;
            case 'hot':
            default:
                // Hot formula: pinned first, then upvotes + answers balance
                $query->orderBy('is_pinned', 'desc')
                      ->orderByRaw('(upvotes_count * 2 + answers_count * 3) DESC')
                      ->latest();
                break;
        }

        $posts = $query->paginate(12)->withQueryString();
        $profile = $this->getCurrentProfile($request);
        $totalQuestions = CommunityPost::count();
        $totalAnswers = CommunityAnswer::count();

        // Popular channel counts
        $channelCounts = CommunityPost::selectRaw('channel, count(*) as count')
            ->groupBy('channel')
            ->pluck('count', 'channel')
            ->toArray();

        return view('community.index', compact(
            'posts',
            'channels',
            'selectedChannel',
            'sort',
            'search',
            'profile',
            'totalQuestions',
            'totalAnswers',
            'channelCounts'
        ));
    }

    /**
     * Single Thread & Answers View.
     */
    public function show(Request $request, $slugOrUuid)
    {
        $this->ensureCommunitySeeded();

        $post = CommunityPost::where('uuid', $slugOrUuid)
            ->orWhere('slug', $slugOrUuid)
            ->with(['answers' => function ($q) {
                $q->orderBy('is_accepted', 'desc')
                  ->orderBy('is_expert_answer', 'desc')
                  ->orderBy('upvotes_count', 'desc')
                  ->orderBy('created_at', 'asc');
            }])
            ->firstOrFail();

        // Increment view count gently
        $viewedKey = 'viewed_post_' . $post->id;
        if (!$request->session()->has($viewedKey)) {
            $post->increment('views_count');
            $request->session()->put($viewedKey, true);
        }

        $profile = $this->getCurrentProfile($request);
        $channels = CommunityPost::getChannels();

        // Related discussions in the same channel
        $relatedPosts = CommunityPost::where('channel', $post->channel)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(4)
            ->get();

        return view('community.show', compact('post', 'profile', 'channels', 'relatedPosts'));
    }

    /**
     * Post a new Question (Open to Guests and Registered Users).
     */
    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:8|max:255',
            'channel' => 'required|string',
            'content' => 'required|string|min:15',
            'author_name' => 'nullable|string|max:80',
            'author_persona' => 'nullable|string|max:80',
            'author_headline' => 'nullable|string|max:150',
            'tags' => 'nullable|string',
        ]);

        $channels = CommunityPost::getChannels();
        $channelKey = isset($channels[$request->channel]) ? $request->channel : 'career-advice';

        $authorName = $request->input('author_name');
        $authorPersona = $request->input('author_persona', '10th/12th Student');
        $authorHeadline = $request->input('author_headline');

        if (Auth::check()) {
            $authorName = Auth::user()->name;
        } elseif (empty($authorName)) {
            $authorName = $request->session()->get('community_guest_name', 'Student Candidate');
        }

        // Parse tags
        $tags = [];
        if ($request->filled('tags')) {
            $tags = array_filter(array_map('trim', explode(',', $request->tags)));
        }

        $post = CommunityPost::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'author_name' => $authorName,
            'author_persona' => $authorPersona,
            'author_headline' => $authorHeadline,
            'channel' => $channelKey,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'tags' => $tags,
            'upvotes_count' => 1, // Start with author upvote
            'guest_session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
        ]);

        // Remember guest details in session and cookie
        $this->saveGuestPersona($request, $authorName, $authorPersona, $authorHeadline);

        return redirect()->route('community.show', $post->slug)->with('success', 'Your question has been published to the community!');
    }

    /**
     * Post an Answer (Open to Guests and Registered Users).
     */
    public function storeAnswer(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|min:10',
            'author_name' => 'nullable|string|max:80',
            'author_persona' => 'nullable|string|max:80',
            'author_headline' => 'nullable|string|max:150',
        ]);

        $post = CommunityPost::findOrFail($postId);

        $authorName = $request->input('author_name');
        $authorPersona = $request->input('author_persona', 'College Student');
        $authorHeadline = $request->input('author_headline');

        if (Auth::check()) {
            $authorName = Auth::user()->name;
        } elseif (empty($authorName)) {
            $authorName = $request->session()->get('community_guest_name', 'Community Contributor');
        }

        $isExpert = in_array($authorPersona, ['Working Professional', 'Career Counselor', 'Alumnus / Mentor']);

        $answer = CommunityAnswer::create([
            'uuid' => (string) Str::uuid(),
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'author_name' => $authorName,
            'author_persona' => $authorPersona,
            'author_headline' => $authorHeadline,
            'content' => $request->content,
            'upvotes_count' => 1,
            'is_expert_answer' => $isExpert,
            'guest_session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
        ]);

        $post->increment('answers_count');

        // Remember guest details
        $this->saveGuestPersona($request, $authorName, $authorPersona, $authorHeadline);

        return redirect()->route('community.show', $post->slug)->with('success', 'Thank you! Your answer has been posted to the discussion.');
    }

    /**
     * Upvote or Downvote a Post or Answer (Supports Guests and Auth Users).
     */
    public function vote(Request $request)
    {
        $request->validate([
            'type' => 'required|in:post,answer',
            'id' => 'required|integer',
            'direction' => 'required|in:1,-1',
        ]);

        $type = $request->type;
        $id = $request->id;
        $direction = (int) $request->direction;
        $sessionId = $request->session()->getId();
        $userId = Auth::id();
        $ip = $request->ip();

        // Check if already voted
        $voteQuery = CommunityVote::where('votable_type', $type)
            ->where('votable_id', $id);

        if ($userId) {
            $voteQuery->where('user_id', $userId);
        } else {
            $voteQuery->where('session_id', $sessionId);
        }

        $existingVote = $voteQuery->first();

        $targetModel = $type === 'post' ? CommunityPost::find($id) : CommunityAnswer::find($id);
        if (!$targetModel) {
            return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
        }

        if ($existingVote) {
            if ($existingVote->vote_type === $direction) {
                // Cancel vote (toggle off)
                $existingVote->delete();
                $targetModel->decrement('upvotes_count', $direction);
                return response()->json([
                    'success' => true,
                    'action' => 'cleared',
                    'new_count' => $targetModel->fresh()->upvotes_count
                ]);
            } else {
                // Change vote
                $existingVote->update(['vote_type' => $direction]);
                $targetModel->increment('upvotes_count', $direction * 2);
                return response()->json([
                    'success' => true,
                    'action' => 'switched',
                    'new_count' => $targetModel->fresh()->upvotes_count
                ]);
            }
        }

        // Record new vote
        CommunityVote::create([
            'votable_type' => $type,
            'votable_id' => $id,
            'user_id' => $userId,
            'session_id' => $sessionId,
            'ip_address' => $ip,
            'vote_type' => $direction,
        ]);

        $targetModel->increment('upvotes_count', $direction);

        return response()->json([
            'success' => true,
            'action' => 'voted',
            'new_count' => $targetModel->fresh()->upvotes_count
        ]);
    }

    /**
     * Save community persona profile (Without requiring signup).
     */
    public function saveProfile(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string|min:2|max:80',
            'persona' => 'required|string',
            'headline' => 'nullable|string|max:150',
            'target_stream' => 'nullable|string|max:100',
        ]);

        $name = trim($request->display_name);
        $persona = trim($request->persona);
        $headline = trim($request->headline ?: '');
        $targetStream = trim($request->target_stream ?: '');

        $colorMap = [
            '10th/12th Student' => '#2563eb',
            'College Student' => '#6366f1',
            'Working Professional' => '#059669',
            'Career Counselor' => '#d97706',
            'Parent / Guardian' => '#e11d48',
            'Alumnus / Mentor' => '#7c3aed',
        ];
        $color = $colorMap[$persona] ?? '#ff4500';

        // Save to DB
        $profile = CommunityProfile::updateOrCreate(
            Auth::check() ? ['user_id' => Auth::id()] : ['session_id' => $request->session()->getId()],
            [
                'display_name' => $name,
                'persona' => $persona,
                'headline' => $headline,
                'avatar_color' => $color,
                'target_stream' => $targetStream,
            ]
        );

        $this->saveGuestPersona($request, $name, $persona, $headline, $color);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Community profile saved successfully!',
                'profile' => [
                    'name' => $name,
                    'persona' => $persona,
                    'headline' => $headline,
                    'color' => $color,
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Your Community Profile is ready! You can now ask and answer questions.');
    }

    private function saveGuestPersona(Request $request, $name, $persona, $headline = null, $color = null): void
    {
        $request->session()->put('community_guest_name', $name);
        $request->session()->put('community_guest_persona', $persona);
        if ($headline) $request->session()->put('community_guest_headline', $headline);
        if ($color) $request->session()->put('community_guest_color', $color);

        // Store cookie for 60 days
        cookie()->queue('community_guest_name', $name, 60 * 24 * 60);
        cookie()->queue('community_guest_persona', $persona, 60 * 24 * 60);
        if ($headline) cookie()->queue('community_guest_headline', $headline, 60 * 24 * 60);
    }
}


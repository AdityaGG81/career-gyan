<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityPost;
use App\Models\CommunityAnswer;
use App\Models\CommunityProfile;
use App\Models\CommunityVote;
use Illuminate\Support\Str;

class AdminCommunityController extends Controller
{
    private function checkAuth()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Community Management Hub.
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $tab = $request->input('tab', 'questions'); // 'questions', 'answers', 'profiles'
        $search = trim($request->input('q', ''));
        $channelFilter = $request->input('channel', 'all');
        $statusFilter = $request->input('status', 'all');

        // Statistics
        $stats = [
            'total_questions' => CommunityPost::count(),
            'total_answers' => CommunityAnswer::count(),
            'total_profiles' => CommunityProfile::count(),
            'verified_experts' => CommunityProfile::where('is_verified_expert', true)->count(),
            'expert_answers' => CommunityAnswer::where('is_expert_answer', true)->count(),
            'pinned_posts' => CommunityPost::where('is_pinned', true)->count(),
        ];

        $channels = CommunityPost::getChannels();

        // 1. Questions Query
        $questionsQuery = CommunityPost::withCount('answers');
        if ($search !== '') {
            $questionsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        if ($channelFilter !== 'all' && isset($channels[$channelFilter])) {
            $questionsQuery->where('channel', $channelFilter);
        }
        if ($statusFilter === 'pinned') {
            $questionsQuery->where('is_pinned', true);
        } elseif ($statusFilter === 'resolved') {
            $questionsQuery->where('is_resolved', true);
        } elseif ($statusFilter === 'unanswered') {
            $questionsQuery->where('answers_count', 0);
        }
        $questions = $questionsQuery->orderBy('is_pinned', 'desc')->latest()->paginate(15, ['*'], 'q_page')->withQueryString();

        // 2. Answers Query
        $answersQuery = CommunityAnswer::with('post');
        if ($search !== '') {
            $answersQuery->where(function ($q) use ($search) {
                $q->where('author_name', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        if ($statusFilter === 'expert') {
            $answersQuery->where('is_expert_answer', true);
        } elseif ($statusFilter === 'accepted') {
            $answersQuery->where('is_accepted', true);
        }
        $answers = $answersQuery->latest()->paginate(15, ['*'], 'a_page')->withQueryString();

        // 3. Profiles / Verified Experts Query
        $profilesQuery = CommunityProfile::with('user');
        if ($search !== '') {
            $profilesQuery->where(function ($q) use ($search) {
                $q->where('display_name', 'like', "%{$search}%")
                  ->orWhere('persona', 'like', "%{$search}%")
                  ->orWhere('headline', 'like', "%{$search}%")
                  ->orWhere('expert_title', 'like', "%{$search}%");
            });
        }
        if ($statusFilter === 'expert') {
            $profilesQuery->where('is_verified_expert', true);
        }
        $profiles = $profilesQuery->orderBy('is_verified_expert', 'desc')->latest()->paginate(15, ['*'], 'p_page')->withQueryString();

        return view('admin.community.index', compact(
            'stats',
            'tab',
            'search',
            'channelFilter',
            'statusFilter',
            'channels',
            'questions',
            'answers',
            'profiles'
        ));
    }

    /**
     * Update Question (Post).
     */
    public function updatePost(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $post = CommunityPost::findOrFail($id);

        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'channel' => 'required|string',
            'content' => 'required|string|min:10',
            'author_name' => 'required|string|max:80',
            'author_persona' => 'required|string|max:80',
            'author_headline' => 'nullable|string|max:150',
            'tags' => 'nullable|string',
        ]);

        $tags = [];
        if ($request->filled('tags')) {
            $tags = array_filter(array_map('trim', explode(',', $request->tags)));
        }

        $post->update([
            'title' => $request->title,
            'channel' => $request->channel,
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_persona' => $request->author_persona,
            'author_headline' => $request->author_headline,
            'tags' => $tags,
            'is_pinned' => $request->boolean('is_pinned'),
            'is_resolved' => $request->boolean('is_resolved'),
        ]);

        return redirect()->back()->with('success', 'Question updated successfully!');
    }

    /**
     * Toggle Post Pin.
     */
    public function togglePostPin($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $post = CommunityPost::findOrFail($id);
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        $msg = $post->is_pinned ? 'Question pinned to the top of feed!' : 'Question unpinned.';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Toggle Post Resolved.
     */
    public function togglePostResolved($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $post = CommunityPost::findOrFail($id);
        $post->is_resolved = !$post->is_resolved;
        $post->save();

        $msg = $post->is_resolved ? 'Question marked as resolved!' : 'Question reopened.';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Delete Question and its answers.
     */
    public function destroyPost($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $post = CommunityPost::findOrFail($id);
        // Cascade delete answers and votes
        CommunityAnswer::where('post_id', $post->id)->delete();
        CommunityVote::where('votable_type', 'post')->where('votable_id', $post->id)->delete();
        $post->delete();

        return redirect()->back()->with('success', 'Question and associated answers deleted successfully!');
    }

    /**
     * Update Answer.
     */
    public function updateAnswer(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $answer = CommunityAnswer::findOrFail($id);

        $request->validate([
            'content' => 'required|string|min:10',
            'author_name' => 'required|string|max:80',
            'author_persona' => 'required|string|max:80',
            'author_headline' => 'nullable|string|max:150',
        ]);

        $answer->update([
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_persona' => $request->author_persona,
            'author_headline' => $request->author_headline,
            'is_expert_answer' => $request->boolean('is_expert_answer'),
            'is_accepted' => $request->boolean('is_accepted'),
        ]);

        return redirect()->back()->with('success', 'Answer updated successfully!');
    }

    /**
     * Toggle Verified Expert status on an Answer.
     */
    public function toggleAnswerExpert($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $answer = CommunityAnswer::findOrFail($id);
        $answer->is_expert_answer = !$answer->is_expert_answer;
        $answer->save();

        $msg = $answer->is_expert_answer 
            ? 'Answer marked as Verified Expert answer!' 
            : 'Verified Expert badge removed from this answer.';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Toggle Accepted status on an Answer.
     */
    public function toggleAnswerAccepted($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $answer = CommunityAnswer::findOrFail($id);
        $answer->is_accepted = !$answer->is_accepted;
        $answer->save();

        $msg = $answer->is_accepted 
            ? 'Answer marked as accepted solution!' 
            : 'Accepted solution status cleared.';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Delete Answer.
     */
    public function destroyAnswer($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $answer = CommunityAnswer::findOrFail($id);
        $postId = $answer->post_id;

        CommunityVote::where('votable_type', 'answer')->where('votable_id', $answer->id)->delete();
        $answer->delete();

        if ($postId) {
            $post = CommunityPost::find($postId);
            if ($post) {
                $post->decrement('answers_count');
            }
        }

        return redirect()->back()->with('success', 'Answer removed successfully!');
    }

    /**
     * Provision someone as a Verified Expert (or revoke).
     */
    public function toggleProfileExpert(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $profile = CommunityProfile::findOrFail($id);
        $makeExpert = !$profile->is_verified_expert;
        $title = $request->input('expert_title', $profile->expert_title);

        $profile->is_verified_expert = $makeExpert;
        if ($makeExpert && empty($title)) {
            $title = match($profile->persona) {
                'Career Counselor' => 'Certified Career Counselor',
                'Working Professional' => 'Industry Mentor & Professional',
                'Alumnus / Mentor' => 'Senior Alumnus & Mentor',
                default => 'Verified Academic & Career Expert'
            };
        }
        $profile->expert_title = $makeExpert ? $title : null;
        $profile->save();

        // Also retroactively mark answers by this user / session as expert
        if ($makeExpert) {
            if ($profile->user_id) {
                CommunityAnswer::where('user_id', $profile->user_id)->update(['is_expert_answer' => true]);
            } elseif ($profile->session_id) {
                CommunityAnswer::where('guest_session_id', $profile->session_id)->update(['is_expert_answer' => true]);
            }
        }

        $msg = $makeExpert
            ? "{$profile->display_name} has been verified as an Expert ({$profile->expert_title})!"
            : "Verified Expert status revoked for {$profile->display_name}.";

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Update Community Profile.
     */
    public function updateProfile(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $profile = CommunityProfile::findOrFail($id);

        $request->validate([
            'display_name' => 'required|string|max:80',
            'persona' => 'required|string|max:80',
            'headline' => 'nullable|string|max:150',
            'reputation_points' => 'required|integer|min:0',
            'expert_title' => 'nullable|string|max:120',
        ]);

        $profile->update([
            'display_name' => $request->display_name,
            'persona' => $request->persona,
            'headline' => $request->headline,
            'reputation_points' => $request->reputation_points,
            'is_verified_expert' => $request->boolean('is_verified_expert'),
            'expert_title' => $request->expert_title,
        ]);

        return redirect()->back()->with('success', "Profile of {$profile->display_name} updated successfully!");
    }

    /**
     * Delete Profile.
     */
    public function destroyProfile($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $profile = CommunityProfile::findOrFail($id);
        $name = $profile->display_name;
        $profile->delete();

        return redirect()->back()->with('success', "Community profile for '{$name}' deleted.");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyQuizQuestion;
use App\Models\DailyQuizAttempt;
use App\Models\UserQuizStat;
use App\Models\User;
use Carbon\Carbon;

class DailyQuizController extends Controller
{
    public function index()
    {
        $today = today();
        $todayQuestions = DailyQuizQuestion::whereDate('quiz_date', $today)
            ->where('is_active', true)
            ->get();
        
        $userStat = null;
        $todayAttempts = collect();
        $alreadyTaken = false;
        $completedAttemptsCount = 0;
        $totalQuestionsCount = $todayQuestions->count();
        $totalPointsEarnedToday = 0;
        $question = $todayQuestions->first();

        if (Auth::check()) {
            $userStat = UserQuizStat::forUser(Auth::id());
            $todayAttempts = DailyQuizAttempt::where('user_id', Auth::id())
                                ->whereDate('attempted_at', $today)
                                ->get();
            $completedAttemptsCount = $todayAttempts->count();
            
            $alreadyTaken = ($completedAttemptsCount >= 10 || $completedAttemptsCount >= $totalQuestionsCount) && $totalQuestionsCount > 0;
            $totalPointsEarnedToday = $todayAttempts->sum('points_earned');
            
            $attemptedQuestionIds = $todayAttempts->pluck('question_id')->toArray();
            $unattempted = $todayQuestions->first(function ($q) use ($attemptedQuestionIds) {
                return !in_array($q->id, $attemptedQuestionIds);
            });
            if ($unattempted) {
                $question = $unattempted;
            }
        }

        // Top 3 for leaderboard preview
        $topUsers = UserQuizStat::with('user')
            ->orderByDesc('total_points')
            ->take(3)
            ->get();

        // Next quiz countdown (tomorrow midnight)
        $nextQuizAt = $today->copy()->addDay()->startOfDay();
        $secondsUntilNext = now()->diffInSeconds($nextQuizAt, false);
        if ($secondsUntilNext < 0) $secondsUntilNext = 0;

        return view('daily-quiz.index', compact(
            'question',
            'userStat',
            'todayAttempts',
            'completedAttemptsCount',
            'totalQuestionsCount',
            'alreadyTaken',
            'totalPointsEarnedToday',
            'topUsers',
            'secondsUntilNext'
        ));
    }

    public function take()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please sign in to take the daily quiz.');
        }

        $today = today();
        $questions = DailyQuizQuestion::whereDate('quiz_date', $today)
            ->where('is_active', true)
            ->get();

        if ($questions->isEmpty()) {
            return redirect()->route('daily-quiz.index')->with('info', 'No quiz available for today. Check back tomorrow!');
        }

        // Already attempted today?
        $attempts = DailyQuizAttempt::where('user_id', Auth::id())
            ->whereDate('attempted_at', $today)
            ->get();

        $totalQuestionsCount = min(10, $questions->count());

        if ($attempts->count() >= 10 || $attempts->count() >= $questions->count()) {
            return redirect()->route('daily-quiz.result', ['date' => $today->toDateString()]);
        }

        // Find the first question that has not been attempted yet
        $attemptedQuestionIds = $attempts->pluck('question_id')->toArray();
        $nextQuestion = $questions->first(function ($q) use ($attemptedQuestionIds) {
            return !in_array($q->id, $attemptedQuestionIds);
        });

        if (!$nextQuestion) {
            return redirect()->route('daily-quiz.result', ['date' => $today->toDateString()]);
        }

        $currentIndex = $attempts->count() + 1;

        return view('daily-quiz.take', [
            'question' => $nextQuestion,
            'currentIndex' => $currentIndex,
            'totalQuestionsCount' => $totalQuestionsCount,
        ]);
    }

    public function submit(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'question_id'       => 'required|exists:daily_quiz_questions,id',
            'selected_option'   => 'nullable|in:a,b,c,d',
            'time_taken_seconds'=> 'required|integer|min:0|max:30',
        ]);

        $today    = today();
        $question = DailyQuizQuestion::findOrFail($request->question_id);

        // Already attempted today?
        $existing = DailyQuizAttempt::where('user_id', Auth::id())
            ->where('question_id', $question->id)
            ->whereDate('attempted_at', $today)
            ->first();

        if ($existing) {
            return redirect()->route('daily-quiz.result', [
                'date' => $today->toDateString(),
                'attempt_id' => $existing->id
            ]);
        }

        $todayAttemptsCount = DailyQuizAttempt::where('user_id', Auth::id())
            ->whereDate('attempted_at', $today)
            ->count();

        if ($todayAttemptsCount >= 10) {
            return redirect()->route('daily-quiz.result', ['date' => $today->toDateString()]);
        }

        $selectedOption = $request->selected_option;
        $isCorrect      = $selectedOption && $selectedOption === $question->correct_option;
        $timeTaken      = (int) $request->time_taken_seconds;

        // Points calculation
        $pointsEarned = 0;
        $speedBonus   = 0;
        if ($isCorrect) {
            $pointsEarned = $question->points;
            if ($timeTaken <= 10) {
                $speedBonus   = 5;
                $pointsEarned += $speedBonus;
            }
        }

        // Save the attempt
        $attempt = DailyQuizAttempt::create([
            'user_id'            => Auth::id(),
            'question_id'        => $question->id,
            'selected_option'    => $selectedOption,
            'is_correct'         => $isCorrect,
            'points_earned'      => $pointsEarned,
            'time_taken_seconds' => $timeTaken,
            'attempted_at'       => $today->toDateString(),
        ]);

        // Update user stats
        $stat = UserQuizStat::forUser(Auth::id());

        // Streak logic - Only runs on the first attempt of the day
        $streakBonus = 0;
        if ($todayAttemptsCount == 0) {
            if ($stat->last_attempt_date) {
                $lastDate = Carbon::parse($stat->last_attempt_date);
                if ($lastDate->isYesterday()) {
                    $stat->current_streak += 1;
                } elseif (!$lastDate->isToday()) {
                    $stat->current_streak = 1;
                }
            } else {
                $stat->current_streak = 1;
            }

            if ($stat->current_streak > $stat->longest_streak) {
                $stat->longest_streak = $stat->current_streak;
            }

            $stat->last_attempt_date = $today->toDateString();
        }

        // Streak bonus applies to any correct answer if current streak > 1
        if ($isCorrect && $stat->current_streak > 1) {
            $streakBonus   = min($stat->current_streak * 2, 20); // cap at +20
            $pointsEarned += $streakBonus;
            $attempt->points_earned = $pointsEarned;
            $attempt->save();
        }

        $stat->total_points    += $pointsEarned;
        $stat->quizzes_taken   += 1;
        if ($isCorrect) $stat->correct_answers += 1;
        if ($speedBonus > 0) $stat->speed_bonuses += 1;
        $stat->save();

        // Check for new badges
        $newBadges = $stat->checkAndAwardBadges();

        // Check top-10 champion badge
        $rank = UserQuizStat::where('total_points', '>', $stat->total_points)->count() + 1;
        if ($rank <= 10 && !in_array('champion', $stat->badges ?? [])) {
            $badges   = $stat->badges ?? [];
            $badges[] = 'champion';
            $stat->badges = $badges;
            $stat->save();
            $newBadges[] = 'champion';
        }

        return redirect()->route('daily-quiz.result', [
            'date' => $today->toDateString(),
            'attempt_id' => $attempt->id
        ])
        ->with('new_badges', $newBadges)
        ->with('streak_bonus', $streakBonus)
        ->with('speed_bonus', $speedBonus);
    }

    public function result(Request $request, $date)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $attemptQuery = DailyQuizAttempt::where('user_id', Auth::id())
            ->whereDate('attempted_at', $date);

        if ($request->has('attempt_id')) {
            $attempt = $attemptQuery->where('id', $request->attempt_id)->with('question')->firstOrFail();
        } else {
            $attempt = $attemptQuery->orderByDesc('id')->with('question')->firstOrFail();
        }

        $stat      = UserQuizStat::forUser(Auth::id());
        $newBadges = session('new_badges', []);
        $streakBonus = session('streak_bonus', 0);
        $speedBonus  = session('speed_bonus', 0);
        $allBadges   = UserQuizStat::allBadgeDefinitions();

        // Motivational messages based on score, streak, category
        $message = $this->getMotivationalMessage($attempt, $stat);

        // Fetch how many attempts the user has made today vs total questions available today
        $todayQuestionsCount = DailyQuizQuestion::whereDate('quiz_date', $date)
            ->where('is_active', true)
            ->count();
        $todayAttemptsCount = DailyQuizAttempt::where('user_id', Auth::id())
            ->whereDate('attempted_at', $date)
            ->count();

        $hasMoreQuestions = $todayAttemptsCount < 10 && $todayAttemptsCount < $todayQuestionsCount;
        $nextQuestionIndex = $todayAttemptsCount + 1;

        return view('daily-quiz.result', compact(
            'attempt',
            'stat',
            'newBadges',
            'allBadges',
            'streakBonus',
            'speedBonus',
            'message',
            'hasMoreQuestions',
            'nextQuestionIndex',
            'todayAttemptsCount',
            'todayQuestionsCount'
        ));
    }

    public function leaderboard(Request $request)
    {
        $period = $request->get('period', 'all_time');

        if ($period === 'weekly') {
            $startDate = now()->startOfWeek()->toDateString();
            $stats = DailyQuizAttempt::selectRaw('user_id, SUM(points_earned) as period_points')
                ->where('attempted_at', '>=', $startDate)
                ->groupBy('user_id')
                ->orderByDesc('period_points')
                ->take(50)
                ->get();

            $leaderboard = $stats->map(function ($row) {
                $globalStat = UserQuizStat::where('user_id', $row->user_id)->first();
                return (object)[
                    'user'           => User::find($row->user_id),
                    'period_points'  => $row->period_points,
                    'total_points'   => $globalStat?->total_points ?? 0,
                    'current_streak' => $globalStat?->current_streak ?? 0,
                    'badges'         => $globalStat?->badges ?? [],
                ];
            })->filter(fn($r) => $r->user !== null)->values();
        } elseif ($period === 'monthly') {
            $startDate = now()->startOfMonth()->toDateString();
            $stats = DailyQuizAttempt::selectRaw('user_id, SUM(points_earned) as period_points')
                ->where('attempted_at', '>=', $startDate)
                ->groupBy('user_id')
                ->orderByDesc('period_points')
                ->take(50)
                ->get();

            $leaderboard = $stats->map(function ($row) {
                $globalStat = UserQuizStat::where('user_id', $row->user_id)->first();
                return (object)[
                    'user'           => User::find($row->user_id),
                    'period_points'  => $row->period_points,
                    'total_points'   => $globalStat?->total_points ?? 0,
                    'current_streak' => $globalStat?->current_streak ?? 0,
                    'badges'         => $globalStat?->badges ?? [],
                ];
            })->filter(fn($r) => $r->user !== null)->values();
        } else {
            // All time
            $rawStats = UserQuizStat::with('user')
                ->orderByDesc('total_points')
                ->take(50)
                ->get();

            $leaderboard = $rawStats->filter(fn($s) => $s->user !== null)->map(function ($s) {
                return (object)[
                    'user'           => $s->user,
                    'period_points'  => $s->total_points,
                    'total_points'   => $s->total_points,
                    'current_streak' => $s->current_streak,
                    'badges'         => $s->badges ?? [],
                ];
            })->values();
        }

        $myRank = null;
        $myStat = UserQuizStat::forUser(Auth::id());
        if ($period === 'all_time') {
            $myRank = UserQuizStat::where('total_points', '>', $myStat->total_points)->count() + 1;
        }

        $allBadges = UserQuizStat::allBadgeDefinitions();

        return view('daily-quiz.leaderboard', compact('leaderboard', 'period', 'myStat', 'myRank', 'allBadges'));
    }

    public function myStats()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $stat = UserQuizStat::forUser(Auth::id());
        $allBadges = UserQuizStat::allBadgeDefinitions();

        $recentAttempts = DailyQuizAttempt::where('user_id', Auth::id())
            ->with('question')
            ->orderByDesc('attempted_at')
            ->take(30)
            ->get();

        $myRank = UserQuizStat::where('total_points', '>', $stat->total_points)->count() + 1;

        return view('daily-quiz.my-stats', compact('stat', 'allBadges', 'recentAttempts', 'myRank'));
    }

    private function getMotivationalMessage(DailyQuizAttempt $attempt, UserQuizStat $stat): array
    {
        $category = $attempt->question->category ?? 'general';
        $streak   = $stat->current_streak;

        $correctMessages = [
            'engineering'  => ["🚀 Brilliant! You have the mind of an engineer!", "⚙️ Outstanding! Engineering could be your destiny!", "🔧 Perfect! You think like a future tech innovator!"],
            'science'      => ["🔬 Wow! A scientist is born! Keep exploring!", "🧪 Excellent! Your scientific thinking is razor sharp!", "🌟 Spectacular! The world needs curious minds like yours!"],
            'arts'         => ["🎨 Creative genius! The arts world awaits you!", "✨ Brilliant! You see the world through an artist's eye!", "🎭 Wonderful! You have the soul of a creative professional!"],
            'commerce'     => ["📈 Spot on! You have the instincts of a business leader!", "💼 Excellent! Wall Street could use a mind like yours!", "💰 Outstanding! You think like a future entrepreneur!"],
            'technology'   => ["💻 You're going places in Tech! Keep it up!", "🖥️ Perfect! The digital world is your playground!", "⚡ Amazing! Future CTO material right here!"],
            'general'      => ["🌟 Brilliant answer! Your knowledge is impressive!", "🏆 Outstanding! You're a true quiz champion!", "🎯 Spot on! You nailed it!"],
        ];

        $wrongMessages = [
            "📚 Almost there! Every mistake is a step toward mastery.",
            "💪 Don't give up! Great minds learn from every question.",
            "🌱 Keep going! Consistency beats perfection every time.",
            "🔄 So close! Come back tomorrow stronger than ever.",
            "🧠 Learning in progress! You're building something great.",
        ];

        $streakMessages = [
            7  => "🔥 7-DAY STREAK! You're absolutely unstoppable!",
            14 => "🏅 14-day streak! You're a quiz legend in the making!",
            30 => "💎 30-DAY STREAK! DIAMOND STATUS ACHIEVED! Incredible!",
        ];

        if (isset($streakMessages[$streak])) {
            return ['type' => 'streak', 'text' => $streakMessages[$streak]];
        }

        if ($attempt->is_correct) {
            $msgs = $correctMessages[$category] ?? $correctMessages['general'];
            return ['type' => 'correct', 'text' => $msgs[array_rand($msgs)]];
        }

        return ['type' => 'wrong', 'text' => $wrongMessages[array_rand($wrongMessages)]];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyQuizQuestion;
use App\Models\DailyQuizAttempt;
use App\Models\UserQuizStat;
use App\Models\User;

class AdminQuizController extends Controller
{
    private function requireAdmin()
    {
        if (!session()->has('admin_logged_in')) {
            abort(redirect()->route('admin.login'));
        }
    }

    public function index()
    {
        $this->requireAdmin();
        $questions = DailyQuizQuestion::orderByDesc('quiz_date')->paginate(20);
        $totalAttempts = DailyQuizAttempt::count();
        $totalQuestions = DailyQuizQuestion::count();
        return view('admin.quiz.index', compact('questions', 'totalAttempts', 'totalQuestions'));
    }

    public function create()
    {
        $this->requireAdmin();
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $this->requireAdmin();

        $request->validate([
            'quiz_date'      => 'required|date',
            'question_text'  => 'required|string',
            'option_a'       => 'required|string',
            'option_b'       => 'required|string',
            'option_c'       => 'required|string',
            'option_d'       => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation'    => 'nullable|string',
            'category'       => 'required|in:general,engineering,science,arts,commerce,technology',
            'difficulty'     => 'required|in:easy,medium,hard',
            'points'         => 'required|integer|min:5|max:50',
            'is_active'      => 'nullable|boolean',
        ]);

        DailyQuizQuestion::create([
            'quiz_date'      => $request->quiz_date,
            'question_text'  => $request->question_text,
            'option_a'       => $request->option_a,
            'option_b'       => $request->option_b,
            'option_c'       => $request->option_c,
            'option_d'       => $request->option_d,
            'correct_option' => $request->correct_option,
            'explanation'    => $request->explanation,
            'category'       => $request->category,
            'difficulty'     => $request->difficulty,
            'points'         => $request->points,
            'is_active'      => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz question created successfully!');
    }

    public function edit($id)
    {
        $this->requireAdmin();
        $question = DailyQuizQuestion::findOrFail($id);
        return view('admin.quiz.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $this->requireAdmin();
        $question = DailyQuizQuestion::findOrFail($id);

        $request->validate([
            'quiz_date'      => 'required|date',
            'question_text'  => 'required|string',
            'option_a'       => 'required|string',
            'option_b'       => 'required|string',
            'option_c'       => 'required|string',
            'option_d'       => 'required|string',
            'correct_option' => 'required|in:a,b,c,d',
            'explanation'    => 'nullable|string',
            'category'       => 'required|in:general,engineering,science,arts,commerce,technology',
            'difficulty'     => 'required|in:easy,medium,hard',
            'points'         => 'required|integer|min:5|max:50',
            'is_active'      => 'nullable|boolean',
        ]);

        $question->update([
            'quiz_date'      => $request->quiz_date,
            'question_text'  => $request->question_text,
            'option_a'       => $request->option_a,
            'option_b'       => $request->option_b,
            'option_c'       => $request->option_c,
            'option_d'       => $request->option_d,
            'correct_option' => $request->correct_option,
            'explanation'    => $request->explanation,
            'category'       => $request->category,
            'difficulty'     => $request->difficulty,
            'points'         => $request->points,
            'is_active'      => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz question updated successfully!');
    }

    public function destroy($id)
    {
        $this->requireAdmin();
        $question = DailyQuizQuestion::findOrFail($id);
        $question->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz question deleted.');
    }

    public function scores(Request $request)
    {
        $this->requireAdmin();

        $query = DailyQuizAttempt::with(['user', 'question'])->orderByDesc('attempted_at');

        if ($request->filled('date')) {
            $query->whereDate('attempted_at', $request->date);
        }
        if ($request->filled('user_name')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->user_name . '%'));
        }
        if ($request->filled('correct')) {
            $query->where('is_correct', $request->correct === 'yes');
        }

        $attempts = $query->paginate(30);
        $totalAttempts = DailyQuizAttempt::count();
        $correctCount  = DailyQuizAttempt::where('is_correct', true)->count();
        $totalPoints   = DailyQuizAttempt::sum('points_earned');

        return view('admin.quiz.scores', compact('attempts', 'totalAttempts', 'correctCount', 'totalPoints'));
    }

    public function leaderboard()
    {
        $this->requireAdmin();

        $stats = UserQuizStat::with('user')
            ->orderByDesc('total_points')
            ->take(100)
            ->get()
            ->filter(fn($s) => $s->user !== null)
            ->values();

        return view('admin.quiz.leaderboard', compact('stats'));
    }
}

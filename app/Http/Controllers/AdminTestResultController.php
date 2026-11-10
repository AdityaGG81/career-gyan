<?php

namespace App\Http\Controllers;

use App\Models\TestSession;
use App\Models\StudentAnalysis;
use App\Models\QuickTestAttempt;
use App\Models\SpecializedTestAttempt;
use App\Models\SpecializedCourse;
use App\Models\User;
use App\Models\Career;
use App\Models\Field;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminTestResultController extends Controller
{
    /**
     * Admin check middleware / session enforcement.
     */
    protected function checkAdminAuth()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Display a unified hub of all test results across the platform.
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $tab = $request->query('tab', 'aptitude');
        $search = trim((string) $request->query('search', ''));

        // Counts for tabs
        $aptitudeCount = TestSession::count();
        $analysisCount = StudentAnalysis::count();
        $quickCount = QuickTestAttempt::count();
        $specializedCount = SpecializedTestAttempt::count();
        $totalTests = $aptitudeCount + $analysisCount + $quickCount + $specializedCount;

        // 1. Aptitude Tests Query
        $aptitudeQuery = TestSession::with('user')->latest();
        if ($search !== '') {
            $aptitudeQuery->where(function ($q) use ($search) {
                $q->where('uuid', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }
        $aptitudeSessions = $aptitudeQuery->paginate(15, ['*'], 'aptitude_page');

        // 2. Student Analyses Query
        $analysisQuery = StudentAnalysis::latest();
        if ($search !== '') {
            $analysisQuery->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('desired_admission_course', 'like', "%{$search}%")
                  ->orWhere('current_stream', 'like', "%{$search}%");
            });
        }
        $studentAnalyses = $analysisQuery->paginate(15, ['*'], 'analysis_page');

        // 3. Quick Tests Query
        $quickQuery = QuickTestAttempt::latest();
        if ($search !== '') {
            $quickQuery->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('student_email', 'like', "%{$search}%")
                  ->orWhere('uuid', 'like', "%{$search}%");
            });
        }
        $quickAttempts = $quickQuery->paginate(15, ['*'], 'quick_page');

        // 4. Specialized Aptitude Tests Query (Spiritual, Artistic, Sports, Business)
        $specializedQuery = SpecializedTestAttempt::with('user')->latest();
        if ($search !== '') {
            $specializedQuery->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('student_email', 'like', "%{$search}%")
                  ->orWhere('student_phone', 'like', "%{$search}%")
                  ->orWhere('uuid', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        if ($request->filled('specialized_category') && $request->specialized_category !== 'all') {
            $specializedQuery->where('category', $request->specialized_category);
        }
        $specializedAttempts = $specializedQuery->paginate(15, ['*'], 'specialized_page');

        return view('admin.test-results.index', compact(
            'tab',
            'search',
            'aptitudeSessions',
            'studentAnalyses',
            'quickAttempts',
            'specializedAttempts',
            'aptitudeCount',
            'analysisCount',
            'quickCount',
            'specializedCount',
            'totalTests'
        ));
    }

    /**
     * Detailed inspection of an individual Aptitude Test session.
     */
    public function showAptitude($uuidOrId)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $session = TestSession::with('user')
            ->where('uuid', $uuidOrId)
            ->orWhere('id', $uuidOrId)
            ->firstOrFail();

        $recommendedIds = $session->recommended_careers ?? [];
        $careers = collect();
        if (!empty($recommendedIds)) {
            $careers = Career::whereIn('id', array_keys($recommendedIds))
                ->get()
                ->sortByDesc(function ($c) use ($recommendedIds) {
                    return $recommendedIds[$c->id] ?? 0;
                });
        }

        $recommendedFields = $session->recommended_fields ?? [];
        $fields = collect();
        if (!empty($recommendedFields)) {
            $fields = Field::whereIn('id', array_keys($recommendedFields))
                ->get()
                ->sortByDesc(function ($f) use ($recommendedFields) {
                    return $recommendedFields[$f->id] ?? 0;
                });
        }

        $questions = Question::with('dimension')->get()->keyBy('id');

        return view('admin.test-results.aptitude-show', compact('session', 'careers', 'recommendedIds', 'fields', 'recommendedFields', 'questions'));
    }

    /**
     * Delete an Aptitude Test session.
     */
    public function destroyAptitude(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $session = TestSession::findOrFail($id);
        $candidate = $session->candidate_name;
        $session->delete();

        if ($request->input('redirect_to') === 'index' || str_contains(url()->previous(), '/aptitude/')) {
            return redirect()->route('admin.test-results.index', ['tab' => 'aptitude'])
                ->with('success', "Aptitude Test result record for '{$candidate}' deleted successfully.");
        }

        return redirect()->back()
            ->with('success', "Aptitude Test result record for '{$candidate}' deleted successfully.");
    }

    /**
     * Detailed inspection of an individual Quick Test attempt with question & answersheet review.
     */
    public function showQuick($uuidOrId)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $attempt = QuickTestAttempt::where('uuid', $uuidOrId)
            ->orWhere('id', $uuidOrId)
            ->firstOrFail();

        $questions = \App\Models\QuickTestQuestion::all();

        return view('admin.test-results.quick-show', compact('attempt', 'questions'));
    }

    /**
     * Delete a Quick Test attempt.
     */
    public function destroyQuick(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $attempt = QuickTestAttempt::findOrFail($id);
        $candidate = $attempt->student_name ?: ('Candidate #' . $attempt->id);
        $attempt->delete();

        if ($request->input('redirect_to') === 'index' || str_contains(url()->previous(), '/quick/')) {
            return redirect()->route('admin.test-results.index', ['tab' => 'quick'])
                ->with('success', "Quick Test record for '{$candidate}' deleted successfully.");
        }

        return redirect()->back()
            ->with('success', "Quick Test record for '{$candidate}' deleted successfully.");
    }

    /**
     * Detailed inspection of a Specialized Aptitude Test (Spiritual, Artistic, Sports, Business).
     */
    public function showSpecialized($uuidOrId)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $attempt = SpecializedTestAttempt::with('user')
            ->where('uuid', $uuidOrId)
            ->orWhere('id', $uuidOrId)
            ->firstOrFail();

        $recommendedCourses = SpecializedCourse::where('category', $attempt->category)->get();

        return view('admin.test-results.specialized-show', compact('attempt', 'recommendedCourses'));
    }

    /**
     * Delete a Specialized Aptitude Test attempt.
     */
    public function destroySpecialized(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $attempt = SpecializedTestAttempt::findOrFail($id);
        $candidate = $attempt->student_name ?: ('Candidate #' . $attempt->id);
        $catLabel = $attempt->category_label;
        $attempt->delete();

        if ($request->input('redirect_to') === 'index' || str_contains(url()->previous(), '/specialized/')) {
            return redirect()->route('admin.test-results.index', ['tab' => 'specialized'])
                ->with('success', "{$catLabel} record for '{$candidate}' deleted successfully.");
        }

        return redirect()->back()
            ->with('success', "{$catLabel} record for '{$candidate}' deleted successfully.");
    }

    /**
     * Bulk delete selected test records across any tab.
     */
    public function bulkDelete(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate([
            'type' => 'required|in:aptitude,analysis,quick,specialized',
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);

        $type = $request->input('type');
        $ids = $request->input('ids');
        $count = count($ids);

        if ($type === 'aptitude') {
            TestSession::whereIn('id', $ids)->delete();
            $label = "{$count} Aptitude Test record(s)";
        } elseif ($type === 'analysis') {
            StudentAnalysis::whereIn('id', $ids)->delete();
            $label = "{$count} Student Analysis questionnaire(s)";
        } elseif ($type === 'quick') {
            QuickTestAttempt::whereIn('id', $ids)->delete();
            $label = "{$count} Quick Test record(s)";
        } elseif ($type === 'specialized') {
            SpecializedTestAttempt::whereIn('id', $ids)->delete();
            $label = "{$count} Specialized Aptitude Test record(s)";
        }

        return redirect()->back()->with('success', "Successfully deleted {$label}.");
    }

    /**
     * Clear test records based on filter criteria.
     */
    public function clearRecords(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $request->validate([
            'category' => 'required|in:aptitude,analysis,quick,specialized,all',
            'range' => 'required|in:all,older_30,older_60,older_90',
        ]);

        $category = $request->input('category');
        $range = $request->input('range');

        $cutoff = match($range) {
            'older_30' => now()->subDays(30),
            'older_60' => now()->subDays(60),
            'older_90' => now()->subDays(90),
            default => null,
        };

        $totalDeleted = 0;

        if ($category === 'aptitude' || $category === 'all') {
            $q = TestSession::query();
            if ($cutoff) $q->where('created_at', '<', $cutoff);
            $totalDeleted += $q->delete();
        }

        if ($category === 'quick' || $category === 'all') {
            $q = QuickTestAttempt::query();
            if ($cutoff) $q->where('created_at', '<', $cutoff);
            $totalDeleted += $q->delete();
        }

        if ($category === 'analysis' || $category === 'all') {
            $q = StudentAnalysis::query();
            if ($cutoff) $q->where('created_at', '<', $cutoff);
            $totalDeleted += $q->delete();
        }

        if ($category === 'specialized' || $category === 'all') {
            $q = SpecializedTestAttempt::query();
            if ($cutoff) $q->where('created_at', '<', $cutoff);
            $totalDeleted += $q->delete();
        }

        $tab = $category === 'all' ? 'aptitude' : $category;
        $rangeLabel = $cutoff ? "older than " . str_replace('older_', '', $range) . " days" : "in total";

        return redirect()->route('admin.test-results.index', ['tab' => $tab])
            ->with('success', "Cleared {$totalDeleted} test record(s) {$rangeLabel}.");
    }

    /**
     * Candidate-specific assessment dossier showing all tests taken by a user.
     */
    public function userTestResults($userId)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $user = User::with(['testSessions', 'studentAnalyses', 'aiChatLogs', 'specializedTestAttempts'])->findOrFail($userId);

        $quickAttempts = QuickTestAttempt::where('student_email', $user->email)->latest()->get();
        $specializedAttempts = SpecializedTestAttempt::where('user_id', $user->id)
            ->orWhere('student_email', $user->email)
            ->latest()
            ->get();

        return view('admin.test-results.user-profile', compact('user', 'quickAttempts', 'specializedAttempts'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\TestSession;
use App\Models\StudentAnalysis;
use App\Models\QuickTestAttempt;
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
        $totalTests = $aptitudeCount + $analysisCount + $quickCount;

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

        return view('admin.test-results.index', compact(
            'tab',
            'search',
            'aptitudeSessions',
            'studentAnalyses',
            'quickAttempts',
            'aptitudeCount',
            'analysisCount',
            'quickCount',
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
    public function destroyAptitude($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $session = TestSession::findOrFail($id);
        $session->delete();

        return redirect()->route('admin.test-results.index', ['tab' => 'aptitude'])
            ->with('success', 'Aptitude Test result record deleted successfully.');
    }

    /**
     * Candidate-specific assessment dossier showing all tests taken by a user.
     */
    public function userTestResults($userId)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $user = User::with(['testSessions', 'studentAnalyses', 'aiChatLogs'])->findOrFail($userId);

        $quickAttempts = QuickTestAttempt::where('student_email', $user->email)->latest()->get();

        return view('admin.test-results.user-profile', compact('user', 'quickAttempts'));
    }
}

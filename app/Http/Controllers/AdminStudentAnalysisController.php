<?php

namespace App\Http\Controllers;

use App\Models\StudentAnalysis;
use Illuminate\Http\Request;

class AdminStudentAnalysisController extends Controller
{
    /**
     * Display listing of submitted student analyses.
     */
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = StudentAnalysis::with('user')->latest();

        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('desired_admission_course', 'like', "%{$search}%")
                  ->orWhere('city_district', 'like', "%{$search}%");
            });
        }

        $totalCount = StudentAnalysis::count();
        $analyses = $query->paginate(20)->withQueryString();

        return view('admin.student-analyses.index', compact('analyses', 'totalCount'));
    }

    /**
     * Display a single student analysis submission details.
     */
    public function show($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $analysis = StudentAnalysis::with('user')->findOrFail($id);

        return view('admin.student-analyses.show', compact('analysis'));
    }

    /**
     * Delete a submission.
     */
    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $analysis = StudentAnalysis::findOrFail($id);
        $analysis->delete();

        return redirect()->route('admin.student-analyses.index')->with('success', 'Student Analysis submission deleted successfully.');
    }
}

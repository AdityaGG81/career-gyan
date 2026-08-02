<?php

namespace App\Http\Controllers;

use App\Services\PercentilePredictorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PercentileCalculatorController extends Controller
{
    /**
     * Display the Percentile & Rank Calculator tool page.
     */
    public function index(Request $request): View
    {
        $exam = $request->query('exam', 'mht_cet');
        $marks = (float) $request->query('marks', 145);
        $shift = $request->query('shift', 'moderate');

        $initialPrediction = PercentilePredictorService::predict($marks, $exam, $shift);

        return view('tools.percentile-calculator', [
            'initialPrediction' => $initialPrediction,
            'defaultMarks' => $marks,
            'defaultExam' => $exam,
            'defaultShift' => $shift,
        ]);
    }

    /**
     * AJAX JSON endpoint for real-time recalculations.
     */
    public function calculateApi(Request $request): JsonResponse
    {
        $marks = (float) $request->input('marks', 145);
        $exam = $request->input('exam', 'mht_cet');
        $shift = $request->input('shift', 'moderate');

        $subjectMarks = null;
        if ($request->has('maths') || $request->has('physics') || $request->has('chemistry')) {
            $maths = (float) $request->input('maths', 0);
            $physics = (float) $request->input('physics', 0);
            $chem = (float) $request->input('chemistry', 0);
            $subjectMarks = [
                'maths' => $maths,
                'physics' => $physics,
                'chemistry' => $chem,
            ];
            $marks = $maths + $physics + $chem;
        }

        $result = PercentilePredictorService::predict($marks, $exam, $shift, $subjectMarks);

        return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\CollegePredictorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CollegePredictorController extends Controller
{
    /**
     * Display the College Predictor tool.
     */
    public function index(Request $request): View
    {
        $percentile = (float) $request->query('percentile', 95.0);
        $category = strtoupper(trim($request->query('category', 'GOPENS')));
        $district = trim($request->query('district', ''));
        $branchGroup = trim($request->query('branch_group', ''));
        $chanceLevel = strtolower(trim($request->query('chance_level', 'all')));
        $collegeType = strtolower(trim($request->query('college_type', 'all')));
        $search = trim($request->query('q', ''));

        $filters = [
            'percentile' => $percentile,
            'category' => $category,
            'district' => $district,
            'branch_group' => $branchGroup,
            'chance_level' => $chanceLevel,
            'college_type' => $collegeType,
            'search' => $search,
            'limit' => 120,
        ];

        $predictions = CollegePredictorService::predictColleges($filters);

        return view('tools.college-predictor', [
            'initialData' => $predictions,
            'filters' => $filters,
            'categories' => CollegePredictorService::CATEGORY_OPTIONS,
            'branchGroups' => CollegePredictorService::BRANCH_GROUPS,
            'districts' => CollegePredictorService::DISTRICTS,
        ]);
    }

    /**
     * AJAX JSON prediction endpoint for real-time reactive filtering.
     */
    public function predictApi(Request $request): JsonResponse
    {
        $filters = [
            'percentile' => (float) $request->input('percentile', 95.0),
            'category' => strtoupper(trim($request->input('category', 'GOPENS'))),
            'district' => trim($request->input('district', '')),
            'branch_group' => trim($request->input('branch_group', '')),
            'chance_level' => strtolower(trim($request->input('chance_level', 'all'))),
            'college_type' => strtolower(trim($request->input('college_type', 'all'))),
            'search' => trim($request->input('search', '')),
            'limit' => (int) $request->input('limit', 150),
        ];

        $data = CollegePredictorService::predictColleges($filters);

        return response()->json($data);
    }

    /**
     * Download personalized CAP Option Form / College Preference List as CSV.
     */
    public function exportPreferenceList(Request $request): StreamedResponse
    {
        $filters = [
            'percentile' => (float) $request->query('percentile', 95.0),
            'category' => strtoupper(trim($request->query('category', 'GOPENS'))),
            'district' => trim($request->query('district', '')),
            'branch_group' => trim($request->query('branch_group', '')),
            'chance_level' => strtolower(trim($request->query('chance_level', 'all'))),
            'college_type' => strtolower(trim($request->query('college_type', 'all'))),
            'search' => trim($request->query('search', '')),
            'limit' => 300,
        ];

        $data = CollegePredictorService::predictColleges($filters);
        $results = $data['results'];
        $userPercentile = $data['user_percentile'];

        $fileName = 'CareerGyan_CAP_Preference_List_' . date('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($results, $userPercentile) {
            $handle = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header metadata
            fputcsv($handle, ['CareerGyan Maharashtra Engineering CAP Preference List (Option Form)']);
            fputcsv($handle, ['Candidate Percentile Score:', $userPercentile . '%', 'Generated Date:', date('d M Y, h:i A')]);
            fputcsv($handle, []);

            // Column headers
            fputcsv($handle, [
                'Preference No.',
                'DTE Code',
                'College Name',
                'Branch / Course',
                'Quota / Category',
                '2025 Cutoff (%)',
                'Candidate Score (%)',
                'Score Delta (%)',
                'Probability (%)',
                'Admission Chance Tier',
                'District',
                'Management',
                'College Profile Link',
            ]);

            $pref = 1;
            foreach ($results as $r) {
                fputcsv($handle, [
                    $pref++,
                    $r['college_code'] ?? 'N/A',
                    $r['college_name'],
                    $r['branch_name'],
                    $r['category'],
                    $r['cutoff_formatted'],
                    $userPercentile . '%',
                    $r['delta_formatted'],
                    $r['probability'],
                    $r['chance_label'],
                    $r['district'],
                    $r['management'],
                    $r['show_url'] ?? $r['cutoffs_url'],
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}

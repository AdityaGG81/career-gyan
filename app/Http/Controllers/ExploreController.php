<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\College;
use App\Models\Field;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExploreController extends Controller
{
    /* ─────────────────────────────────────────────
     | GET /explore  — main page load
     ────────────────────────────────────────────── */
    public function index(): View
    {
        $fields   = Field::withCount('careers')->get();
        $subjects = Subject::orderBy('name')->get();
        $careers  = Career::with('field', 'subjects')
                          ->orderBy('name')
                          ->get();

        return view('explore', compact('fields', 'subjects', 'careers'));
    }

    /* ─────────────────────────────────────────────
     | GET /explore/field/{field}
     | Returns careers for a single field (AJAX)
     ────────────────────────────────────────────── */
    public function byField(Field $field): JsonResponse
    {
        $careers  = Career::with('field', 'subjects')
                          ->where('field_id', $field->id)
                          ->orderBy('name')
                          ->get()
                          ->map(fn($c) => $this->formatCareer($c));

        $colleges = College::where('field_id', $field->id)
                           ->orderBy('name')
                           ->get();

        return response()->json([
            'careers'  => $careers,
            'colleges' => $colleges,
            'field'    => $field,
        ]);
    }

    /* ─────────────────────────────────────────────
     | POST /explore/subjects
     | Body: { subject_ids: [1, 3, 5] }
     | Returns careers sorted by match count (AJAX)
     ────────────────────────────────────────────── */
    public function bySubjects(Request $request): JsonResponse
    {
        $ids = $request->input('subject_ids', []);

        if (empty($ids)) {
            $careers = Career::with('field', 'subjects')->orderBy('name')->get()
                             ->map(fn($c) => $this->formatCareer($c, 0));
            return response()->json(['careers' => $careers]);
        }

        // Count how many of the selected subjects each career matches
        $careers = Career::with('field', 'subjects')
            ->whereHas('subjects', fn($q) => $q->whereIn('subjects.id', $ids))
            ->get()
            ->map(function (Career $c) use ($ids) {
                $matchCount = $c->subjects->whereIn('id', $ids)->count();
                return $this->formatCareer($c, $matchCount);
            })
            ->sortByDesc('match_count')
            ->values();

        return response()->json(['careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | GET /explore/career/{career}
     | Full career detail: roadmap + subjects + colleges (AJAX)
     ────────────────────────────────────────────── */
    public function careerDetail(Career $career): JsonResponse
    {
        $career->load('field', 'subjects');

        $colleges = College::where('field_id', $career->field_id)
                           ->orderBy('type')
                           ->get();

        return response()->json([
            'career'   => $this->formatCareer($career),
            'colleges' => $colleges,
        ]);
    }

    /* ─────────────────────────────────────────────
     | GET /explore/search?q=
     | Full-text search on career name & description (AJAX)
     ────────────────────────────────────────────── */
    public function search(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json(['careers' => []]);
        }

        $careers = Career::with('field', 'subjects')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->get()
            ->map(fn($c) => $this->formatCareer($c));

        return response()->json(['careers' => $careers]);
    }

    /* ─────────────────────────────────────────────
     | Private helper — uniform career shape for JSON
     ────────────────────────────────────────────── */
    private function formatCareer(Career $career, int $matchCount = 0): array
    {
        return [
            'id'            => $career->id,
            'name'          => $career->name,
            'slug'          => $career->slug,
            'description'   => $career->description,
            'qualification' => $career->qualification,
            'stream'        => $career->stream,
            'salary_range'  => $career->salary_range,
            'demand_level'  => $career->demand_level,
            'roadmap'       => $career->roadmap,
            'icon'          => $career->icon,
            'match_count'   => $matchCount,
            'field'         => [
                'id'       => $career->field->id,
                'name'     => $career->field->name,
                'color'    => $career->field->color,
                'bg_color' => $career->field->bg_color,
            ],
            'subjects'      => $career->subjects->pluck('name'),
        ];
    }
}

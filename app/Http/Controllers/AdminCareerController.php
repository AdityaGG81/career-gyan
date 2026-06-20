<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCareerController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = Career::with('field');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('stream', 'like', "%{$searchTerm}%");
        }

        $careers = $query->orderBy('name', 'asc')->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $career = Career::findOrFail($id);
        $fields = Field::all();

        // Convert array casts to line-separated strings for textareas
        $skillsText = is_array($career->skills) ? implode("\n", $career->skills) : '';
        $examsText = is_array($career->entrance_exams) ? implode("\n", $career->entrance_exams) : '';
        $jobsText = is_array($career->job_opportunities) ? implode("\n", $career->job_opportunities) : '';
        
        // Convert roadmap to formatted JSON string
        $roadmapJson = json_encode($career->roadmap ?: [], JSON_PRETTY_PRINT);

        return view('admin.careers.edit', compact('career', 'fields', 'skillsText', 'examsText', 'jobsText', 'roadmapJson'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $career = Career::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'field_id' => 'required|exists:fields,id',
            'description' => 'required|string',
            'qualification' => 'nullable|string',
            'stream' => 'nullable|string',
            'salary_range' => 'nullable|string',
            'demand_level' => 'required|in:High,Medium,Moderate,Low',
            'future_scope' => 'nullable|string',
            'skills' => 'nullable|string',
            'entrance_exams' => 'nullable|string',
            'job_opportunities' => 'nullable|string',
            'roadmap' => 'nullable|string', // JSON string
            'video_url' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        // Helper to parse line-separated string to array
        $parseTextArea = function($text) {
            if (empty($text)) return [];
            return array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $text)))));
        };

        $skillsArray = $parseTextArea($request->skills);
        $examsArray = $parseTextArea($request->entrance_exams);
        $jobsArray = $parseTextArea($request->job_opportunities);

        // Validate and parse roadmap JSON
        $roadmapArray = [];
        if ($request->filled('roadmap')) {
            $roadmapArray = json_decode($request->roadmap, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->withInput()->withErrors(['roadmap' => 'Invalid JSON format in Roadmap.']);
            }
        }

        // Auto update slug if name changes
        $slug = $career->slug;
        if ($career->name !== $request->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Career::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $career->update([
            'name' => $request->name,
            'slug' => $slug,
            'field_id' => $request->field_id,
            'description' => $request->description,
            'qualification' => $request->qualification,
            'stream' => $request->stream,
            'salary_range' => $request->salary_range,
            'demand_level' => $request->demand_level,
            'future_scope' => $request->future_scope,
            'skills' => $skillsArray,
            'entrance_exams' => $examsArray,
            'job_opportunities' => $jobsArray,
            'roadmap' => $roadmapArray,
            'video_url' => $request->video_url,
            'image' => $request->image,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.careers.index')->with('success', 'Career path updated successfully.');
    }
}

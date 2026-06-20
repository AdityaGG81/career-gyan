<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Field;
use Illuminate\Http\Request;

class AdminCollegeController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $colleges = College::with('field')->orderBy('name')->get();
        return view('admin.colleges.index', compact('colleges'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $fields = Field::orderBy('name')->get();
        return view('admin.colleges.create', compact('fields'));
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'field_id' => 'required|exists:fields,id',
            'location' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'fees_range' => 'required|string|max:255',
            'type' => 'required|in:Government,Private,Deemed,Central,Autonomous',
            'website' => 'nullable|url|max:255',
            'rank' => 'nullable|integer|min:1',
            'popular_branches' => 'nullable|string|max:255',
            'cutoff' => 'nullable|string|max:255',
            'placement_support' => 'nullable|string',
            'facilities' => 'nullable|string',
            'description' => 'nullable|string',
            'youtube_url' => 'nullable|string',
            'naac_grade' => 'nullable|string|max:10',
            'government_rank' => 'nullable|integer|min:1',
        ]);

        College::create($request->all());

        return redirect()->route('admin.colleges.index')->with('success', 'Institute created successfully.');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = College::findOrFail($id);
        $fields = Field::orderBy('name')->get();
        return view('admin.colleges.edit', compact('college', 'fields'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = College::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'field_id' => 'required|exists:fields,id',
            'location' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'fees_range' => 'required|string|max:255',
            'type' => 'required|in:Government,Private,Deemed,Central,Autonomous',
            'website' => 'nullable|url|max:255',
            'rank' => 'nullable|integer|min:1',
            'popular_branches' => 'nullable|string|max:255',
            'cutoff' => 'nullable|string|max:255',
            'placement_support' => 'nullable|string',
            'facilities' => 'nullable|string',
            'description' => 'nullable|string',
            'youtube_url' => 'nullable|string',
            'naac_grade' => 'nullable|string|max:10',
            'government_rank' => 'nullable|integer|min:1',
        ]);

        $college->update($request->all());

        return redirect()->route('admin.colleges.index')->with('success', 'Institute updated successfully.');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = College::findOrFail($id);
        $college->delete();

        return redirect()->route('admin.colleges.index')->with('success', 'Institute deleted successfully.');
    }
}

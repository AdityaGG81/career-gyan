<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminFieldController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $fields = Field::withCount('careers')->get();
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'bg_color' => 'nullable|string|max:7',
            'cover_image' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Field::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Field::create([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon ?: 'fa-briefcase',
            'color' => $request->color ?: '#1a56db',
            'bg_color' => $request->bg_color ?: '#e8f0fe',
            'cover_image' => $request->cover_image,
        ]);

        return redirect()->route('admin.fields.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $field = Field::findOrFail($id);
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $field = Field::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'bg_color' => 'nullable|string|max:7',
            'cover_image' => 'nullable|string',
        ]);

        $slug = $field->slug;
        if ($field->name !== $request->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Field::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $field->update([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon ?: 'fa-briefcase',
            'color' => $request->color ?: '#1a56db',
            'bg_color' => $request->bg_color ?: '#e8f0fe',
            'cover_image' => $request->cover_image,
        ]);

        return redirect()->route('admin.fields.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Category deleted successfully.');
    }
}

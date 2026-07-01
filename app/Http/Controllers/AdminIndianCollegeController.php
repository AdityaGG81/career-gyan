<?php

namespace App\Http\Controllers;

use App\Models\IndianCollege;
use Illuminate\Http\Request;

class AdminIndianCollegeController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = IndianCollege::query();

        // Optional search filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('college_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('university_name', 'like', "%{$search}%");
            });
        }

        // Paginate 25 items per page (mandatory to handle 90k database efficiently)
        $colleges = $query->orderBy('college_name')->paginate(25)->withQueryString();

        return view('admin.indian-colleges.index', compact('colleges'));
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = IndianCollege::findOrFail($id);
        return view('admin.indian-colleges.edit', compact('college'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = IndianCollege::findOrFail($id);

        $request->validate([
            'college_name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'management' => 'nullable|string|max:255',
            'college_type' => 'nullable|string|max:255',
            'university_name' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
        ]);

        $college->update($request->all());

        return redirect()->route('admin.indian-colleges.index')->with('success', 'College updated successfully.');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $college = IndianCollege::findOrFail($id);
        $college->delete();

        return redirect()->route('admin.indian-colleges.index')->with('success', 'College deleted successfully from All India database.');
    }
}

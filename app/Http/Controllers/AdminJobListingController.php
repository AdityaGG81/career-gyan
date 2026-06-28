<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminJobListingController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     */
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $jobs = JobListing::orderBy('created_at', 'desc')->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $categories = ['Railway', 'Banking', 'SSC', 'Defense', 'State Govt'];
        $qualifications = ['10th Pass', '12th Pass', 'Graduate', 'Post Graduate', 'Diploma'];

        return view('admin.jobs.create', compact('categories', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_type' => 'required|string|in:govt,pvt,both',
            'category_select' => 'required|string',
            'category_custom' => 'required_if:category_select,Other|nullable|string|max:255',
            'qualification_select' => 'required|string',
            'qualification_custom' => 'required_if:qualification_select,Other|nullable|string|max:255',
            'location' => 'required|string|max:255',
            'last_date' => 'required|date',
            'apply_link' => 'nullable|url|max:255',
            'notification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:51200',
            'description' => 'nullable|string',
        ]);

        $category = $request->input('category_select');
        if ($category === 'Other') {
            $category = $request->input('category_custom');
        }

        $qualification = $request->input('qualification_select');
        if ($qualification === 'Other') {
            $qualification = $request->input('qualification_custom');
        }

        $filePath = null;
        if ($request->hasFile('notification_file')) {
            $file = $request->file('notification_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Ensure uploads/jobs directory exists in public folder
            $destinationPath = public_path('uploads/jobs');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $filePath = 'uploads/jobs/' . $fileName;
        }

        JobListing::create([
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'job_type' => $request->job_type,
            'category' => $category,
            'qualification' => $qualification,
            'location' => $request->location,
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'notification_file' => $filePath,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Job recruitment notification added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $job = JobListing::findOrFail($id);
        $categories = ['Railway', 'Banking', 'SSC', 'Defense', 'State Govt'];
        $qualifications = ['10th Pass', '12th Pass', 'Graduate', 'Post Graduate', 'Diploma'];

        $isCustomCategory = !in_array($job->category, $categories);
        $selectedCategory = $isCustomCategory ? 'Other' : $job->category;
        $customCategoryVal = $isCustomCategory ? $job->category : '';

        $isCustomQualification = !in_array($job->qualification, $qualifications);
        $selectedQualification = $isCustomQualification ? 'Other' : $job->qualification;
        $customQualificationVal = $isCustomQualification ? $job->qualification : '';

        return view('admin.jobs.edit', compact(
            'job', 
            'categories', 
            'qualifications', 
            'selectedCategory', 
            'customCategoryVal', 
            'selectedQualification', 
            'customQualificationVal'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $job = JobListing::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_type' => 'required|string|in:govt,pvt,both',
            'category_select' => 'required|string',
            'category_custom' => 'required_if:category_select,Other|nullable|string|max:255',
            'qualification_select' => 'required|string',
            'qualification_custom' => 'required_if:qualification_select,Other|nullable|string|max:255',
            'location' => 'required|string|max:255',
            'last_date' => 'required|date',
            'apply_link' => 'nullable|url|max:255',
            'notification_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:51200',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,archived',
        ]);

        $category = $request->input('category_select');
        if ($category === 'Other') {
            $category = $request->input('category_custom');
        }

        $qualification = $request->input('qualification_select');
        if ($qualification === 'Other') {
            $qualification = $request->input('qualification_custom');
        }

        $filePath = $job->notification_file;
        if ($request->hasFile('notification_file')) {
            // Delete old file if exists
            if ($filePath && File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
            }

            $file = $request->file('notification_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $destinationPath = public_path('uploads/jobs');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $filePath = 'uploads/jobs/' . $fileName;
        }

        $job->update([
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'job_type' => $request->job_type,
            'category' => $category,
            'qualification' => $qualification,
            'location' => $request->location,
            'last_date' => $request->last_date,
            'apply_link' => $request->apply_link,
            'notification_file' => $filePath,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Job recruitment notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $job = JobListing::findOrFail($id);

        // Delete associated file if it exists
        if ($job->notification_file && File::exists(public_path($job->notification_file))) {
            File::delete(public_path($job->notification_file));
        }

        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job recruitment notification deleted successfully.');
    }
}

@extends('admin.layout')

@section('title', 'Add Job Notification')
@section('page_title', 'Create Notification')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.jobs.index') }}" style="color: var(--admin-text-2); text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
        <i class="fa-solid fa-arrow-left"></i> Back to listings
    </a>
</div>

<div class="panel-card" style="max-width: 800px;">
    <div class="panel-header">
        <h2>New Recruitment Notification Form</h2>
    </div>

    <div style="padding: 32px;">
        @if ($errors->any())
            <div class="admin-alert admin-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <ul style="margin-left: 20px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Form Row 1 -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Company / Organization Name <strong style="color: #ef4444;">*</strong></label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" required class="form-control" placeholder="e.g. UPSC, Railway Recruitment Board">
                </div>
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Job Designation / Title <strong style="color: #ef4444;">*</strong></label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}" required class="form-control" placeholder="e.g. Probationary Officer, Agniveer">
                </div>
            </div>

            <!-- Form Row 2 -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Job Sector <strong style="color: #ef4444;">*</strong></label>
                    <select name="job_type" required class="form-control" style="background: #fff;">
                        <option value="govt" {{ old('job_type', 'govt') == 'govt' ? 'selected' : '' }}>Government (Govt)</option>
                        <option value="pvt" {{ old('job_type') == 'pvt' ? 'selected' : '' }}>Private (Pvt)</option>
                        <option value="both" {{ old('job_type') == 'both' ? 'selected' : '' }}>Both (Govt & Private)</option>
                    </select>
                </div>
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Job Category <strong style="color: #ef4444;">*</strong></label>
                    <select name="category_select" id="category_select" required class="form-control" style="background: #fff;" onchange="toggleCustomField('category')">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category_select') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                        <option value="Other" {{ old('category_select') == 'Other' ? 'selected' : '' }}>Other (Type Custom Category)</option>
                    </select>
                    
                    <div id="category_custom_div" style="margin-top: 10px; display: none;">
                        <input type="text" name="category_custom" id="category_custom" value="{{ old('category_custom') }}" class="form-control" placeholder="Enter custom category name">
                    </div>
                </div>
            </div>

            <!-- Form Row 3 -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Minimum Qualification <strong style="color: #ef4444;">*</strong></label>
                    <select name="qualification_select" id="qualification_select" required class="form-control" style="background: #fff;" onchange="toggleCustomField('qualification')">
                        <option value="">Select Qualification</option>
                        @foreach($qualifications as $qual)
                            <option value="{{ $qual }}" {{ old('qualification_select') == $qual ? 'selected' : '' }}>{{ $qual }}</option>
                        @endforeach
                        <option value="Other" {{ old('qualification_select') == 'Other' ? 'selected' : '' }}>Other (Type Custom Qualification)</option>
                    </select>

                    <div id="qualification_custom_div" style="margin-top: 10px; display: none;">
                        <input type="text" name="qualification_custom" id="qualification_custom" value="{{ old('qualification_custom') }}" class="form-control" placeholder="Enter custom qualification name">
                    </div>
                </div>
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Job Location <strong style="color: #ef4444;">*</strong></label>
                    <input type="text" name="location" value="{{ old('location') }}" required class="form-control" placeholder="e.g. Across India, Maharashtra, Mumbai">
                </div>
            </div>

            <!-- Form Row 4 -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Last Date to Apply <strong style="color: #ef4444;">*</strong></label>
                    <input type="date" name="last_date" value="{{ old('last_date') }}" required class="form-control">
                </div>
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Online Application Link (Apply URL)</label>
                    <input type="url" name="apply_link" value="{{ old('apply_link') }}" class="form-control" placeholder="https://example.com/apply">
                </div>
            </div>

            <!-- Form Row 5 (Attachments) -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Notification File (PDF, Photo, Doc)</label>
                    <input type="file" name="notification_file" class="form-control" style="padding: 7px 12px;">
                    <div style="font-size: 11px; color: var(--admin-text-3); margin-top: 5px;">Supports: PDF, JPG, PNG, DOC, DOCX (Max: 50MB)</div>
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 28px;">
                <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">Detailed Information / Eligibility Criteria</label>
                <textarea name="description" rows="6" class="form-control" placeholder="Provide extra description about age limit, exam dates, syllabus highlights..." style="resize: vertical;">{{ old('description') }}</textarea>
            </div>

            <!-- Submission Buttons -->
            <div style="display: flex; gap: 12px; border-top: 1px solid var(--admin-border); padding-top: 24px; justify-content: flex-end;">
                <a href="{{ route('admin.jobs.index') }}" style="display: inline-flex; align-items: center; justify-content: center; height: 40px; padding: 0 20px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 14px; color: var(--admin-text-2); border: 1px solid var(--admin-border); text-decoration: none; background: #fff; transition: background 0.2s;" onmouseover="this.style.background='#f4f4f5'" onmouseout="this.style.background='#fff'">
                    Cancel
                </a>
                <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; height: 40px; padding: 0 24px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 14px; color: #fff; background: #000; border: none; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#27272a'" onmouseout="this.style.background='#000'">
                    Save Notification
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleCustomField(type) {
        const select = document.getElementById(type + '_select');
        const customDiv = document.getElementById(type + '_custom_div');
        const customInput = document.getElementById(type + '_custom');
        
        if (select.value === 'Other') {
            customDiv.style.display = 'block';
            customInput.setAttribute('required', 'required');
        } else {
            customDiv.style.display = 'none';
            customInput.removeAttribute('required');
        }
    }

    // Set initial state on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleCustomField('category');
        toggleCustomField('qualification');
    });
</script>
@endsection

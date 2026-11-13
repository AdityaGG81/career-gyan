@extends('careerguru.layout')

@section('title', 'Edit ' . $lead->student_name)
@section('page-title', 'Edit Student Lead')

@section('styles')
<style>
  .form-section-title {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--guru-primary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  @media (max-width: 768px) {
    .form-grid-2 { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <div style="max-width: 860px; margin: 0 auto;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px;">
      <div>
        <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Edit Student Lead</h2>
        <p style="font-size:13px; color:#64748b;">Update student information and academic preferences.</p>
      </div>
      <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Back to Student Profile
      </a>
    </div>

    @if($errors->any())
      <div class="guru-alert guru-alert-danger">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>
          <strong>Please resolve the following errors:</strong>
          <ul style="margin-left: 20px; margin-top: 6px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <div class="guru-card">
      <div class="guru-card-body">
        <form method="POST" action="{{ route('careerguru.students.update', $lead->id) }}">
          @csrf
          @method('PUT')

          <div class="form-section-title">
            <i class="fa-solid fa-user-pen"></i> Student Information
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="student_name">Student Full Name <span class="required">*</span></label>
              <input type="text" id="student_name" name="student_name" class="form-control" value="{{ old('student_name', $lead->student_name) }}" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Phone Number <span class="required">*</span></label>
              <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $lead->phone) }}" required>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="email">Email Address <span class="required">*</span></label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $lead->email) }}" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="standard">Studying Standard / Class <span class="required">*</span></label>
              <select id="standard" name="standard" class="form-control" required>
                @foreach($standards as $std)
                  <option value="{{ $std }}" {{ old('standard', $lead->standard) == $std ? 'selected' : '' }}>{{ $std }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="lead_status">Lead Status</label>
              <select id="lead_status" name="lead_status" class="form-control">
                @foreach($statuses as $lbl)
                  <option value="{{ $lbl }}" {{ old('lead_status', $lead->lead_status) == $lbl ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="next_followup_at">Next Follow-up Date</label>
              <input type="date" id="next_followup_at" name="next_followup_at" class="form-control" value="{{ old('next_followup_at', $lead->next_followup_at ? $lead->next_followup_at->format('Y-m-d') : '') }}">
            </div>
          </div>

          <hr style="margin: 24px 0; border: none; border-top: 1px solid var(--guru-border);">

          <div class="form-section-title" style="color: #64748b;">
            <i class="fa-solid fa-address-card"></i> Optional Contact & Academic Info
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="parent_name">Parent / Guardian Name</label>
              <input type="text" id="parent_name" name="parent_name" class="form-control" value="{{ old('parent_name', $lead->parent_name) }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="parent_phone">Parent / Guardian Contact Number</label>
              <input type="tel" id="parent_phone" name="parent_phone" class="form-control" value="{{ old('parent_phone', $lead->parent_phone) }}">
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="city">City / District</label>
              <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $lead->city) }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="school_college">School / College Name</label>
              <input type="text" id="school_college" name="school_college" class="form-control" value="{{ old('school_college', $lead->school_college) }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="interested_course">Interested Course / Stream</label>
            <input type="text" id="interested_course" name="interested_course" class="form-control" value="{{ old('interested_course', $lead->interested_course) }}">
          </div>

          <div class="form-group">
            <label class="form-label" for="additional_notes">Additional Notes / Remarks</label>
            <textarea id="additional_notes" name="additional_notes" class="form-control" rows="4">{{ old('additional_notes', $lead->additional_notes) }}</textarea>
          </div>

          <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:28px;">
            <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding:11px 24px;">
              <i class="fa-solid fa-floppy-disk"></i> Update Student
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection


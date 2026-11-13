@extends('careerguru.layout')

@section('title', 'Add New Student')
@section('page-title', 'Add Student Lead')

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
        <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Add Student Lead</h2>
        <p style="font-size:13px; color:#64748b;">Record student details to initiate tracking and send an automated invitation link.</p>
      </div>
      <a href="{{ route('careerguru.students.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Back to Leads
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
        <form method="POST" action="{{ route('careerguru.students.store') }}">
          @csrf

          <!-- Mandatory Section -->
          <div class="form-section-title">
            <i class="fa-solid fa-user-check"></i> Required Student Information
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="student_name">Student Full Name <span class="required">*</span></label>
              <input type="text" id="student_name" name="student_name" class="form-control" placeholder="e.g. Rahul Sharma" value="{{ old('student_name') }}" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Phone Number <span class="required">*</span></label>
              <input type="tel" id="phone" name="phone" class="form-control" placeholder="e.g. 9876543210" value="{{ old('phone') }}" required>
              <div class="form-text">Used for SMS/WhatsApp guidance & account matching.</div>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="email">Email Address <span class="required">*</span></label>
              <input type="email" id="email" name="email" class="form-control" placeholder="e.g. rahul@gmail.com" value="{{ old('email') }}" required>
              <div class="form-text">Used to link verified CareerGyan registrations.</div>
            </div>

            <div class="form-group">
              <label class="form-label" for="standard">Current Studying Standard / Class <span class="required">*</span></label>
              <select id="standard" name="standard" class="form-control" required>
                <option value="">-- Select Class / Standard --</option>
                @foreach($standards as $std)
                  <option value="{{ $std }}" {{ old('standard') == $std ? 'selected' : '' }}>{{ $std }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="lead_status">Initial Lead Status</label>
              <select id="lead_status" name="lead_status" class="form-control">
                @foreach($statuses as $lbl)
                  <option value="{{ $lbl }}" {{ old('lead_status', 'New Lead') == $lbl ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="next_followup_at">Next Follow-up Date (Optional)</label>
              <input type="date" id="next_followup_at" name="next_followup_at" class="form-control" value="{{ old('next_followup_at') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="additional_notes">Additional Information / Remarks <span class="required">*</span></label>
            <textarea id="additional_notes" name="additional_notes" class="form-control" rows="3" placeholder="Enter student's career interest, initial conversation remarks, background, or goals..." required>{{ old('additional_notes') }}</textarea>
          </div>

          <hr style="margin: 26px 0; border: none; border-top: 1px solid var(--guru-border);">

          <!-- Optional Section -->
          <div class="form-section-title" style="color: #64748b;">
            <i class="fa-solid fa-address-card"></i> Additional Details (Optional)
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="parent_name">Parent / Guardian Name</label>
              <input type="text" id="parent_name" name="parent_name" class="form-control" placeholder="e.g. Mr. Anil Sharma" value="{{ old('parent_name') }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="parent_phone">Parent / Guardian Contact Number</label>
              <input type="tel" id="parent_phone" name="parent_phone" class="form-control" placeholder="e.g. 9811122334" value="{{ old('parent_phone') }}">
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="city">City / District</label>
              <input type="text" id="city" name="city" class="form-control" placeholder="e.g. Pune, Mumbai, Nashik" value="{{ old('city') }}">
            </div>

            <div class="form-group">
              <label class="form-label" for="school_college">School / College Name</label>
              <input type="text" id="school_college" name="school_college" class="form-control" placeholder="e.g. Fergusson College / St. Xavier's" value="{{ old('school_college') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="interested_course">Interested Course / Career Stream</label>
            <input type="text" id="interested_course" name="interested_course" class="form-control" placeholder="e.g. Engineering (Computer Science), MBBS, Law, UPSC" value="{{ old('interested_course') }}">
          </div>

          <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:28px;">
            <a href="{{ route('careerguru.students.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding:11px 24px;">
              <i class="fa-solid fa-floppy-disk"></i> Save Student Lead
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

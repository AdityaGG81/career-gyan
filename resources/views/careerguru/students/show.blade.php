@extends('careerguru.layout')

@section('title', $lead->student_name . ' - Student Profile')
@section('page-title', 'Student Profile & Details')

@section('styles')
<style>
  .profile-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
  }
  @media (max-width: 991px) {
    .profile-grid { grid-template-columns: 1fr; }
  }

  .detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13.5px;
  }
  .detail-row:last-child { border-bottom: none; }
  .detail-label { color: #64748b; font-weight: 500; }
  .detail-val { color: var(--guru-text-main); font-weight: 600; text-align: right; }

  /* Activity Timeline */
  .timeline {
    position: relative;
    padding-left: 28px;
    margin-top: 14px;
  }
  .timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 6px;
    bottom: 6px;
    width: 2px;
    background: #e2e8f0;
  }
  .timeline-item {
    position: relative;
    margin-bottom: 20px;
  }
  .timeline-item:last-child { margin-bottom: 0; }
  .timeline-icon {
    position: absolute;
    left: -28px;
    top: 2px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid var(--guru-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    color: var(--guru-primary);
  }
  .timeline-content {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 14px;
  }
  .timeline-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--guru-text-main);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .timeline-date {
    font-size: 11px;
    color: #94a3b8;
    font-weight: 500;
  }
  .timeline-desc {
    font-size: 12.5px;
    color: #475569;
    margin-top: 4px;
    line-height: 1.5;
  }
  .notes-box {
    background: #fdfbf7;
    border: 1px solid #fef3c7;
    border-radius: 10px;
    padding: 16px;
    white-space: pre-wrap;
    font-size: 13.5px;
    color: #451a03;
    line-height: 1.6;
    max-height: 350px;
    overflow-y: auto;
  }
</style>
@endsection

@section('content')

  <!-- Top Action Bar -->
  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 22px; flex-wrap:wrap; gap:12px;">
    <div style="display:flex; align-items:center; gap:12px;">
      <a href="{{ route('careerguru.students.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Back to Leads
      </a>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">
        {{ $lead->student_name }}
      </h2>
      <span class="status-pill {{ $lead->status_badge_class }}">
        {{ $lead->lead_status }}
      </span>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('careerguru.students.edit', $lead->id) }}" class="btn btn-outline">
        <i class="fa-solid fa-pen-to-square"></i> Edit Details
      </a>
      <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $lead->phone) }}&text={{ urlencode('Hello ' . $lead->student_name . '! I am your CareerGyan Mentor ' . $guru->name . '. Create your account here: ' . $studentReferralUrl) }}" target="_blank" class="btn btn-success">
        <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
      </a>
    </div>
  </div>

  <div class="profile-grid">
    <!-- Left Column: Student Details & Notes -->
    <div>
      <!-- Personal & Academic Details Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-id-card" style="color:#2563eb;"></i> Student Information
          </h3>
          <span style="font-size:12px; color:#64748b;">Added on {{ $lead->created_at->format('d M Y, h:i A') }}</span>
        </div>
        <div class="guru-card-body">
          <div class="detail-row">
            <span class="detail-label">Full Name</span>
            <span class="detail-val">{{ $lead->student_name }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Phone Number</span>
            <span class="detail-val">
              <a href="tel:{{ $lead->phone }}" style="color:#2563eb; text-decoration:none;">{{ $lead->phone }}</a>
            </span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Email Address</span>
            <span class="detail-val">
              <a href="mailto:{{ $lead->email }}" style="color:#2563eb; text-decoration:none;">{{ $lead->email }}</a>
            </span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Studying Class / Standard</span>
            <span class="detail-val"><span class="status-pill pill-gray">{{ $lead->standard }}</span></span>
          </div>
          <div class="detail-row">
            <span class="detail-label">City / District</span>
            <span class="detail-val">{{ $lead->city ?? 'Not Provided' }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">School / College Name</span>
            <span class="detail-val">{{ $lead->school_college ?? 'Not Provided' }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Interested Course / Stream</span>
            <span class="detail-val">{{ $lead->interested_course ?? 'General Career Guidance' }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Parent / Guardian</span>
            <span class="detail-val">{{ $lead->parent_name ?? '—' }} {{ $lead->parent_phone ? '(' . $lead->parent_phone . ')' : '' }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Next Follow-up Date</span>
            <span class="detail-val" style="color: {{ $lead->next_followup_at && $lead->next_followup_at->isPast() ? '#dc2626' : '#2563eb' }};">
              {{ $lead->next_followup_at ? $lead->next_followup_at->format('d M Y') : 'None scheduled' }}
            </span>
          </div>
        </div>
      </div>

      <!-- Additional Notes / Remarks Section -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-notes-medical" style="color:#f59e0b;"></i> Additional Notes & Remarks
          </h3>
          <span style="font-size:12px; color:#64748b;">Complete history of conversations & remarks</span>
        </div>
        <div class="guru-card-body">
          @if($lead->additional_notes)
            <div class="notes-box">{{ $lead->additional_notes }}</div>
          @else
            <p style="color:#94a3b8; font-style:italic; font-size:13px; margin-bottom:14px;">No notes recorded yet.</p>
          @endif

          <!-- Form to Append New Note -->
          <form method="POST" action="{{ route('careerguru.students.note', $lead->id) }}" style="margin-top: 20px;">
            @csrf
            <div class="form-group">
              <label class="form-label" for="note">Append Follow-up Note / Update Conversation</label>
              <textarea id="note" name="note" class="form-control" rows="3" placeholder="Write new notes, conversation takeaways, student reaction, or reason for hesitation..." required></textarea>
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
              <div style="display:flex; align-items:center; gap:8px;">
                <label style="font-size:12.5px; font-weight:600; color:#475569;">Schedule Next Follow-up:</label>
                <input type="date" name="next_followup_at" class="form-control" style="width: auto; padding: 6px 10px;" value="{{ $lead->next_followup_at ? $lead->next_followup_at->format('Y-m-d') : '' }}">
              </div>
              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Append Note
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Activity Timeline -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-timeline" style="color:#818cf8;"></i> Activity & Follow-up History
          </h3>
        </div>
        <div class="guru-card-body">
          <div class="timeline">
            @forelse($lead->activities as $act)
              <div class="timeline-item">
                <div class="timeline-icon">
                  <i class="fa-solid {{ $act->activity_icon }}"></i>
                </div>
                <div class="timeline-content">
                  <div class="timeline-title">
                    <span>{{ $act->title }}</span>
                    <span class="timeline-date">{{ $act->created_at->format('d M Y, h:i A') }}</span>
                  </div>
                  @if($act->description)
                    <div class="timeline-desc">{{ $act->description }}</div>
                  @endif
                </div>
              </div>
            @empty
              <div style="color:#94a3b8; font-size:13px; font-style:italic;">No logged activity yet.</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column: Verification Status, Link & Status Updater -->
    <div>
      <!-- CareerGyan Registration Status Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-shield-check" style="color:#10b981;"></i> Platform Verification
          </h3>
        </div>
        <div class="guru-card-body">
          <div style="margin-bottom: 16px;">
            <div style="font-size:12px; color:#64748b; margin-bottom:4px;">CareerGyan Registration</div>
            @if($lead->isRegistered())
              <div class="status-pill pill-green" style="font-size:13px; padding:6px 12px;">
                <i class="fa-solid fa-circle-check"></i> Account Verified
              </div>
              <div style="font-size:12px; color:#64748b; margin-top:6px;">
                Joined: {{ $lead->registered_at ? $lead->registered_at->format('d M Y, h:i A') : ($lead->registeredUser ? $lead->registeredUser->created_at->format('d M Y') : 'Active') }}
              </div>
            @else
              <div class="status-pill pill-gray" style="font-size:13px; padding:6px 12px;">
                <i class="fa-solid fa-clock"></i> Not Yet Registered
              </div>
              <div style="font-size:12px; color:#64748b; margin-top:6px;">
                Student has not registered with email {{ $lead->email }}.
              </div>
            @endif
          </div>

          <hr style="border:none; border-top:1px solid #f1f5f9; margin:16px 0;">

          <div>
            <div style="font-size:12px; color:#64748b; margin-bottom:4px;">VIP Premium Membership</div>
            @if($lead->isPremium())
              <div class="status-pill pill-yellow" style="font-size:13px; padding:6px 12px;">
                <i class="fa-solid fa-crown"></i> Active Premium Member
              </div>
              <div style="font-size:12px; color:#64748b; margin-top:6px;">
                Purchased: {{ $lead->premium_purchased_at ? $lead->premium_purchased_at->format('d M Y') : 'Active' }}
              </div>
            @else
              <div class="status-pill pill-gray" style="font-size:13px; padding:6px 12px;">
                Standard Free Account
              </div>
              <div style="font-size:12px; color:#64748b; margin-top:6px;">
                Eligible for commission once upgraded!
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Personalized Referral Link Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-link" style="color:#2563eb;"></i> Student Referral Link
          </h3>
        </div>
        <div class="guru-card-body">
          <p style="font-size:12.5px; color:#64748b; margin-bottom:12px;">
            Share this link directly with {{ $lead->student_name }}. It pre-fills their details and links their account directly to you:
          </p>
          <div style="background:#f8fafc; border:1px dashed #cbd5e1; border-radius:8px; padding:8px 10px; font-size:11.5px; word-break:break-all; margin-bottom:12px; color:#334155; font-family:monospace;">
            {{ $studentReferralUrl }}
          </div>
          <button type="button" class="btn btn-primary" style="width:100%; justify-content:center;" onclick="copyReferralLink('{{ $studentReferralUrl }}', this)">
            <i class="fa-regular fa-copy"></i> <span>Copy Personalized Link</span>
          </button>
        </div>
      </div>

      <!-- Inline Lead Status Updater -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-pen-nib" style="color:#6366f1;"></i> Update Lead Status
          </h3>
        </div>
        <div class="guru-card-body">
          <form method="POST" action="{{ route('careerguru.students.status', $lead->id) }}">
            @csrf
            <div class="form-group">
              <label class="form-label" for="lead_status">Select New Status</label>
              <select name="lead_status" id="lead_status" class="form-control" required>
                <option value="New Lead" {{ $lead->lead_status == 'New Lead' ? 'selected' : '' }}>New Lead</option>
                <option value="Contacted" {{ $lead->lead_status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="Interested" {{ $lead->lead_status == 'Interested' ? 'selected' : '' }}>Interested</option>
                <option value="Follow-up Required" {{ $lead->lead_status == 'Follow-up Required' ? 'selected' : '' }}>Follow-up Required</option>
                <option value="Not Interested" {{ $lead->lead_status == 'Not Interested' ? 'selected' : '' }}>Not Interested</option>
              </select>
              <div class="form-text">Note: "Registered" and "Premium" statuses are automatically validated by the database.</div>
            </div>

            <div class="form-group">
              <label class="form-label" for="remarks">Status Change Remarks (Optional)</label>
              <input type="text" id="remarks" name="remarks" class="form-control" placeholder="e.g. Student requested call after 4 PM">
            </div>

            <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center;">
              <i class="fa-solid fa-arrows-rotate"></i> Update Status
            </button>
          </form>
        </div>
      </div>

      <!-- Associated Commissions Card (if any) -->
      @if($lead->commissions && $lead->commissions->count() > 0)
        <div class="guru-card">
          <div class="guru-card-header">
            <h3 class="guru-card-title">
              <i class="fa-solid fa-sack-dollar" style="color:#10b981;"></i> Generated Commissions
            </h3>
          </div>
          <div class="guru-card-body" style="padding:0;">
            <table class="guru-table">
              <tbody>
                @foreach($lead->commissions as $comm)
                  <tr>
                    <td>
                      <strong>{{ $comm->plan_name }}</strong>
                      <div style="font-size:11px; color:#64748b;">{{ $comm->created_at->format('d M Y') }}</div>
                    </td>
                    <td style="text-align:right;">
                      <div style="color:#10b981; font-weight:700;">₹{{ number_format($comm->commission_amount, 2) }}</div>
                      <span class="status-pill {{ $comm->status_badge_class }}" style="font-size:10.5px;">
                        {{ ucfirst($comm->status) }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection


@extends('admin.layout')

@section('title', 'Lead Details: ' . $lead->student_name)
@section('page_title', 'Student Lead Details')

@section('styles')
<style>
  .lead-details-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
  }
  @media (max-width: 991px) {
    .lead-details-grid { grid-template-columns: 1fr; }
  }
  .row-field {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13.5px;
  }
  .row-field:last-child { border-bottom: none; }
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

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
    <div style="display:flex; align-items:center; gap:12px;">
      <a href="{{ route('admin.careergurus.leads') }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">
        <i class="fa-solid fa-arrow-left"></i> Back to Leads
      </a>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">{{ $lead->student_name }}</h2>
      <span class="status-badge {{ $lead->status_badge_class }}">{{ $lead->lead_status }}</span>
    </div>
  </div>

  <div class="lead-details-grid">
    <div>
      <!-- Personal & Academic Info -->
      <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:24px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
        <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:14px;">
          <i class="fa-solid fa-id-card" style="color:#2563eb; margin-right:6px;"></i> Student Details
        </h3>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Full Name</span>
          <strong style="color:var(--admin-text-1);">{{ $lead->student_name }}</strong>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Phone Number</span>
          <strong><a href="tel:{{ $lead->phone }}" style="color:#2563eb; text-decoration:none;">{{ $lead->phone }}</a></strong>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Email Address</span>
          <strong><a href="mailto:{{ $lead->email }}" style="color:#2563eb; text-decoration:none;">{{ $lead->email }}</a></strong>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Class / Standard</span>
          <span class="status-badge" style="background:#f1f5f9; color:#475569;">{{ $lead->standard }}</span>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">City / District</span>
          <span>{{ $lead->city ?? 'Not Provided' }}</span>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">School / College</span>
          <span>{{ $lead->school_college ?? 'Not Provided' }}</span>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Interested Course / Stream</span>
          <span>{{ $lead->interested_course ?? 'General Guidance' }}</span>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Parent Contact</span>
          <span>{{ $lead->parent_name ?? '—' }} {{ $lead->parent_phone ? '(' . $lead->parent_phone . ')' : '' }}</span>
        </div>
        <div class="row-field">
          <span style="color:var(--admin-text-2);">Lead Added On</span>
          <span>{{ $lead->created_at->format('d M Y, h:i A') }}</span>
        </div>
      </div>

      <!-- Notes & Remarks -->
      <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:24px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
        <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:14px;">
          <i class="fa-solid fa-notes-medical" style="color:#f59e0b; margin-right:6px;"></i> Additional Notes & Remarks
        </h3>
        @if($lead->additional_notes)
          <div class="notes-box">{{ $lead->additional_notes }}</div>
        @else
          <p style="color:var(--admin-text-3); font-style:italic; font-size:13px;">No notes recorded for this student.</p>
        @endif
      </div>

      <!-- Activity Timeline -->
      <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:24px; box-shadow:var(--admin-shadow);">
        <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:14px;">
          <i class="fa-solid fa-timeline" style="color:#6366f1; margin-right:6px;"></i> Lead Activity History
        </h3>
        @forelse($lead->activities as $act)
          <div style="padding:10px 0; border-bottom:1px solid #f1f5f9;">
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <strong style="font-size:13px; color:var(--admin-text-1);">{{ $act->title }}</strong>
              <span style="font-size:11px; color:var(--admin-text-3);">{{ $act->created_at->format('d M Y, h:i A') }}</span>
            </div>
            @if($act->description)
              <div style="font-size:12.5px; color:var(--admin-text-2); margin-top:3px;">{{ $act->description }}</div>
            @endif
          </div>
        @empty
          <div style="color:var(--admin-text-3); font-size:13px; font-style:italic;">No logged activities.</div>
        @endforelse
      </div>
    </div>

    <!-- Right Column: CareerGuru Attribution & Account Status -->
    <div>
      <!-- CareerGuru Partner Card -->
      <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:22px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
        <h3 style="font-family:'Outfit',sans-serif; font-size:15px; font-weight:700; margin-bottom:14px;">
          <i class="fa-solid fa-user-tie" style="color:#6366f1; margin-right:6px;"></i> Attributed CareerGuru
        </h3>
        @if($lead->careerguru)
          <div style="font-size:15px; font-weight:700; color:var(--admin-text-1);">
            <a href="{{ route('admin.careergurus.show', $lead->careerguru->id) }}" style="color:inherit; text-decoration:none;">
              {{ $lead->careerguru->name }}
            </a>
          </div>
          <div style="font-size:12px; color:#2563eb; font-family:monospace; margin-top:2px;">
            ID: {{ $lead->careerguru->guru_id }} · Code: {{ $lead->careerguru->referral_code }}
          </div>
          <div style="font-size:12px; color:var(--admin-text-2); margin-top:6px;">
            Email: {{ $lead->careerguru->email }}
          </div>
          <div style="margin-top:12px;">
            <a href="{{ route('admin.careergurus.show', $lead->careerguru->id) }}" class="guru-action-btn">
              View Partner Profile →
            </a>
          </div>
        @else
          <span style="color:var(--admin-text-3);">Direct Platform Lead</span>
        @endif
      </div>

      <!-- Platform Verification Status -->
      <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:22px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
        <h3 style="font-family:'Outfit',sans-serif; font-size:15px; font-weight:700; margin-bottom:14px;">
          <i class="fa-solid fa-shield-halved" style="color:#10b981; margin-right:6px;"></i> Account Verification
        </h3>
        <div style="margin-bottom:14px;">
          <div style="font-size:11.5px; color:var(--admin-text-3); text-transform:uppercase;">Registration</div>
          @if($lead->isRegistered())
            <span class="status-badge status-active"><i class="fa-solid fa-check"></i> Account Created</span>
            <div style="font-size:12px; color:var(--admin-text-2); margin-top:4px;">
              Joined: {{ $lead->registered_at ? $lead->registered_at->format('d M Y') : 'Active' }}
            </div>
          @else
            <span class="status-badge" style="background:#f1f5f9; color:var(--admin-text-3);">Not Registered</span>
          @endif
        </div>

        <div>
          <div style="font-size:11.5px; color:var(--admin-text-3); text-transform:uppercase;">Premium Status</div>
          @if($lead->isPremium())
            <span class="status-badge status-active" style="background:#fef3c7; color:#b45309;"><i class="fa-solid fa-crown"></i> VIP Member</span>
            <div style="font-size:12px; color:var(--admin-text-2); margin-top:4px;">
              Purchased: {{ $lead->premium_purchased_at ? $lead->premium_purchased_at->format('d M Y') : 'Active' }}
            </div>
          @else
            <span class="status-badge" style="background:#f1f5f9; color:var(--admin-text-3);">Free Account</span>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection


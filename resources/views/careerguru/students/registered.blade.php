@extends('careerguru.layout')

@section('title', 'Verified Registered Students')
@section('page-title', 'Verified Student Registrations')

@section('content')

  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Verified Registered Students</h2>
      <p style="font-size:13px; color:#64748b;">Students who registered their CareerGyan account using your referral link or referral code.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('careerguru.students.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add New Lead
      </a>
      <a href="{{ route('careerguru.referral-link') }}" class="btn btn-outline">
        <i class="fa-solid fa-share-nodes"></i> Share Referral Link
      </a>
    </div>
  </div>

  <!-- Search Filter Card -->
  <div class="guru-card" style="margin-bottom:20px;">
    <div class="guru-card-body" style="padding:16px 20px;">
      <form method="GET" action="{{ route('careerguru.students.registered') }}" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
        <div style="flex:1; min-width:220px;">
          <input type="text" name="search" class="form-control" placeholder="Search by student name, email, or phone..." value="{{ request('search') }}">
        </div>
        <div>
          <select name="membership" class="form-control" style="width: auto;">
            <option value="">All Membership Tiers</option>
            <option value="pro" {{ request('membership') == 'pro' ? 'selected' : '' }}>VIP / Pro Member</option>
            <option value="free" {{ request('membership') == 'free' ? 'selected' : '' }}>Free Account</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        @if(request('search') || request('membership'))
          <a href="{{ route('careerguru.students.registered') }}" class="btn btn-outline" title="Reset">
            <i class="fa-solid fa-rotate-left"></i>
          </a>
        @endif
      </form>
    </div>
  </div>

  <div class="guru-card">
    <div class="guru-card-header">
      <h3 class="guru-card-title">
        <i class="fa-solid fa-user-check" style="color:#10b981;"></i> CareerGyan Accounts Attributed to You
      </h3>
      <span style="font-size:12.5px; color:#64748b;">
        Total: {{ $students->total() }} verified accounts
      </span>
    </div>

    <div class="guru-table-wrapper">
      <table class="guru-table">
        <thead>
          <tr>
            <th style="width:50px;">Sr. No.</th>
            <th>Student Name</th>
            <th>Email Address</th>
            <th>Phone</th>
            <th>CareerGyan Reg. Date</th>
            <th>Current Plan</th>
            <th>Attributed Status</th>
            <th>Linked Lead</th>
          </tr>
        </thead>
        <tbody>
          @forelse($students as $idx => $student)
            @php
              $lead = $student->careerguruLead;
              $activeMembership = $student->memberships->where('status', 'active')->first();
            @endphp
            <tr>
              <td style="font-weight:600; color:#64748b;">
                {{ $students->firstItem() + $idx }}
              </td>
              <td>
                <strong style="color:var(--guru-text-main);">{{ $student->name }}</strong>
                @if($student->current_education_level)
                  <div style="font-size:11px; color:#64748b;">{{ $student->current_education_level }}</div>
                @endif
              </td>
              <td>
                <a href="mailto:{{ $student->email }}" style="color:#2563eb; text-decoration:none;">{{ $student->email }}</a>
              </td>
              <td>
                {{ $student->phone ?? ($lead ? $lead->phone : '—') }}
              </td>
              <td style="font-size:12px; color:#64748b; white-space:nowrap;">
                {{ $student->careerguru_registered_at ? \Carbon\Carbon::parse($student->careerguru_registered_at)->format('d M Y, h:i A') : $student->created_at->format('d M Y') }}
              </td>
              <td>
                @if($activeMembership)
                  <span class="status-pill pill-yellow">
                    <i class="fa-solid fa-crown"></i> VIP Member
                  </span>
                @else
                  <span class="status-pill pill-gray">Free Account</span>
                @endif
              </td>
              <td>
                <span class="status-pill pill-green">
                  <i class="fa-solid fa-check"></i> Verified Referral
                </span>
              </td>
              <td>
                @if($lead)
                  <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline btn-sm">
                    <i class="fa-solid fa-eye"></i> View Lead
                  </a>
                @else
                  <span style="font-size:11px; color:#94a3b8;">Direct Referral</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align:center; padding: 36px; color:#94a3b8;">
                <i class="fa-solid fa-user-plus" style="font-size:32px; margin-bottom:12px; display:block; opacity:0.5;"></i>
                No students registered using your referral code yet.
                <div style="margin-top:10px;">
                  <a href="{{ route('careerguru.referral-link') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-share-nodes"></i> Share Your Referral Link
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($students->hasPages())
      <div style="padding: 18px 22px; border-top: 1px solid var(--guru-border);">
        {{ $students->links() }}
      </div>
    @endif
  </div>

@endsection

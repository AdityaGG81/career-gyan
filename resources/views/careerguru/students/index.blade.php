@extends('careerguru.layout')

@section('title', 'My Students & Leads')
@section('page-title', 'Student Lead Management')

@section('styles')
<style>
  .filters-card {
    background: #ffffff;
    border: 1px solid var(--guru-border);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
  }
  .filters-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr auto;
    gap: 12px;
    align-items: flex-end;
  }
  @media (max-width: 1300px) {
    .filters-grid { grid-template-columns: repeat(3, 1fr); }
  }
  @media (max-width: 768px) {
    .filters-grid { grid-template-columns: 1fr; }
  }
  .action-btns-group {
    display: flex;
    align-items: center;
    gap: 6px;
  }
</style>
@endsection

@section('content')

  <!-- Top bar with title and Add button -->
  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">My Students / Leads</h2>
      <p style="font-size:13px; color:#64748b;">Manage and guide prospective students, track registrations, and convert to premium.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('careerguru.students.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add New Student
      </a>
    </div>
  </div>

  <!-- Search & Filter Form -->
  <div class="filters-card">
    <form method="GET" action="{{ route('careerguru.students.index') }}" class="filters-grid">
      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label"><i class="fa-solid fa-magnifying-glass"></i> Search</label>
        <input type="text" name="search" class="form-control" placeholder="Name, Email, or Phone..." value="{{ $search }}">
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Studying Class</label>
        <select name="standard" class="form-control">
          <option value="">All Standards</option>
          @foreach($standards as $std)
            <option value="{{ $std }}" {{ $standard == $std ? 'selected' : '' }}>{{ $std }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Lead Status</label>
        <select name="status" class="form-control">
          <option value="">All Statuses</option>
          @foreach($statuses as $lbl)
            <option value="{{ $lbl }}" {{ $status == $lbl ? 'selected' : '' }}>{{ $lbl }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Registration</label>
        <select name="registration_status" class="form-control">
          <option value="">All</option>
          <option value="registered" {{ $registrationStatus == 'registered' ? 'selected' : '' }}>Registered</option>
          <option value="not_registered" {{ $registrationStatus == 'not_registered' ? 'selected' : '' }}>Not Registered</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Premium Status</label>
        <select name="premium_status" class="form-control">
          <option value="">All</option>
          <option value="premium" {{ $premiumStatus == 'premium' ? 'selected' : '' }}>Premium / VIP</option>
          <option value="free" {{ $premiumStatus == 'free' ? 'selected' : '' }}>Free / Regular</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Date Added</label>
        <select name="date_filter" class="form-control">
          <option value="">Any Time</option>
          <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>Today</option>
          <option value="this_week" {{ $dateFilter == 'this_week' ? 'selected' : '' }}>This Week</option>
          <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>This Month</option>
          <option value="last_month" {{ $dateFilter == 'last_month' ? 'selected' : '' }}>Last Month</option>
        </select>
      </div>

      <div style="display:flex; gap:8px;">
        <button type="submit" class="btn btn-primary" style="height:41px;">
          <i class="fa-solid fa-filter"></i> Filter
        </button>
        @if($search || $standard || $status || $registrationStatus || $premiumStatus || $dateFilter)
          <a href="{{ route('careerguru.students.index') }}" class="btn btn-outline" style="height:41px;" title="Reset Filters">
            <i class="fa-solid fa-rotate-left"></i>
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Students Information Table -->
  <div class="guru-card">
    <div class="guru-card-header">
      <h3 class="guru-card-title">
        <i class="fa-solid fa-list-check" style="color:#2563eb;"></i> Student Information Table
      </h3>
      <span style="font-size:12.5px; color:#64748b;">
        Showing {{ $leads->firstItem() ?? 0 }} - {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} students
      </span>
    </div>

    <div class="guru-table-wrapper">
      <table class="guru-table">
        <thead>
          <tr>
            <th style="width: 50px;">Sr. No.</th>
            <th>Student Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Studying Standard</th>
            <th>Lead Status</th>
            <th>CareerGyan Reg.</th>
            <th>Premium Status</th>
            <th>Date Added</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $idx => $lead)
            <tr>
              <td style="font-weight:600; color:#64748b;">
                {{ $leads->firstItem() + $idx }}
              </td>
              <td>
                <div style="font-weight:700; color:var(--guru-text-main);">
                  <a href="{{ route('careerguru.students.show', $lead->id) }}" style="color:inherit; text-decoration:none;">
                    {{ $lead->student_name }}
                  </a>
                </div>
                @if($lead->city || $lead->school_college)
                  <div style="font-size:11px; color:#64748b;">
                    {{ $lead->city ? $lead->city . ' · ' : '' }}{{ $lead->school_college }}
                  </div>
                @endif
              </td>
              <td>
                <a href="tel:{{ $lead->phone }}" style="color:#2563eb; text-decoration:none; font-weight:500;">
                  <i class="fa-solid fa-phone" style="font-size:11px; margin-right:3px;"></i>{{ $lead->phone }}
                </a>
              </td>
              <td>
                <a href="mailto:{{ $lead->email }}" style="color:#64748b; text-decoration:none;">
                  {{ $lead->email }}
                </a>
              </td>
              <td>
                <span class="status-pill pill-gray">{{ $lead->standard }}</span>
              </td>
              <td>
                <span class="status-pill {{ $lead->status_badge_class }}">
                  {{ $lead->lead_status }}
                </span>
              </td>
              <td>
                @if($lead->isRegistered())
                  <span class="status-pill pill-green" title="Registered on CareerGyan">
                    <i class="fa-solid fa-check"></i> Registered
                  </span>
                @else
                  <span class="status-pill pill-gray" title="Not yet created account">
                    Not Registered
                  </span>
                @endif
              </td>
              <td>
                @if($lead->isPremium())
                  <span class="status-pill pill-yellow" title="Premium Membership Active">
                    <i class="fa-solid fa-crown"></i> VIP Premium
                  </span>
                @else
                  <span class="status-pill pill-gray">Regular</span>
                @endif
              </td>
              <td style="font-size:12px; color:#64748b; white-space:nowrap;">
                {{ $lead->created_at->format('d M Y') }}
              </td>
              <td>
                <div class="action-btns-group" style="justify-content: flex-end;">
                  <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline btn-sm" title="View Student Profile & Notes">
                    <i class="fa-solid fa-eye"></i> View
                  </a>
                  <a href="{{ route('careerguru.students.edit', $lead->id) }}" class="btn btn-outline btn-sm" title="Edit Student">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" style="text-align:center; padding: 36px; color:#94a3b8;">
                <i class="fa-solid fa-user-slash" style="font-size:32px; margin-bottom:12px; display:block; opacity:0.5;"></i>
                No students found matching your criteria.
                <div style="margin-top:10px;">
                  <a href="{{ route('careerguru.students.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-user-plus"></i> Add New Student
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($leads->hasPages())
      <div style="padding: 18px 22px; border-top: 1px solid var(--guru-border);">
        {{ $leads->links() }}
      </div>
    @endif
  </div>

@endsection

@extends('admin.layout')

@section('title', 'All Student Leads')
@section('page_title', 'Centralized Student Leads')

@section('styles')
<style>
  .filters-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 20px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
  }
  .filters-grid {
    display: grid;
    grid-template-columns: 2fr 1.2fr 1fr 1fr 1fr auto;
    gap: 12px;
    align-items: flex-end;
  }
  @media (max-width: 1200px) {
    .filters-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 600px) {
    .filters-grid { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Centralized Student Leads Repository</h2>
      <p style="font-size:13px; color:var(--admin-text-2);">Complete overview of all prospective student leads registered by CareerGuru partners across India.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('admin.careergurus.export.leads') }}" class="guru-action-btn" style="background:#ecfdf5; color:#047857; border-color:#a7f3d0; padding:8px 14px; font-weight:600;">
        <i class="fa-solid fa-file-csv"></i> Export All Leads CSV
      </a>
    </div>
  </div>

  <!-- Search & Filters -->
  <div class="filters-card">
    <form method="GET" action="{{ route('admin.careergurus.leads') }}" class="filters-grid">
      <div>
        <label class="form-label" style="font-size:12px; font-weight:600;"><i class="fa-solid fa-magnifying-glass"></i> Search</label>
        <input type="text" name="search" class="form-control" placeholder="Search name, phone, email, city..." value="{{ request('search') }}">
      </div>

      <div>
        <label class="form-label" style="font-size:12px; font-weight:600;">CareerGuru Partner</label>
        <select name="careerguru_id" class="form-control">
          <option value="all">All Partners</option>
          @foreach($allGurus as $g)
            <option value="{{ $g->id }}" {{ request('careerguru_id') == $g->id ? 'selected' : '' }}>{{ $g->name }} ({{ $g->guru_id }})</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="form-label" style="font-size:12px; font-weight:600;">Class / Standard</label>
        <select name="standard" class="form-control">
          <option value="all">All Standards</option>
          @foreach($standards as $std)
            <option value="{{ $std }}" {{ request('standard') == $std ? 'selected' : '' }}>{{ $std }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="form-label" style="font-size:12px; font-weight:600;">Lead Status</label>
        <select name="lead_status" class="form-control">
          <option value="all">All Statuses</option>
          @foreach($statuses as $st)
            <option value="{{ $st }}" {{ request('lead_status') == $st ? 'selected' : '' }}>{{ $st }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="form-label" style="font-size:12px; font-weight:600;">Registration</label>
        <select name="reg_status" class="form-control">
          <option value="all">All</option>
          <option value="registered" {{ request('reg_status') == 'registered' ? 'selected' : '' }}>Registered Users</option>
          <option value="not_registered" {{ request('reg_status') == 'not_registered' ? 'selected' : '' }}>Not Registered</option>
        </select>
      </div>

      <div style="display:flex; gap:8px;">
        <button type="submit" class="guru-action-btn" style="background:#2563eb; color:#fff; height:41px; padding:0 16px;">
          <i class="fa-solid fa-filter"></i> Filter
        </button>
        @if(request()->hasAny(['search', 'careerguru_id', 'standard', 'lead_status', 'reg_status']))
          <a href="{{ route('admin.careergurus.leads') }}" class="guru-action-btn" style="height:41px; padding:0 12px;" title="Reset"><i class="fa-solid fa-rotate-left"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Leads Table -->
  <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); overflow:hidden; box-shadow:var(--admin-shadow);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
      <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700;">
        <i class="fa-solid fa-address-book" style="color:#38bdf8; margin-right:6px;"></i> All Student Leads Table
      </h3>
      <span style="font-size:12px; color:var(--admin-text-2);">
        Showing {{ $leads->firstItem() ?? 0 }} - {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} leads
      </span>
    </div>

    <div style="width:100%; overflow-x:auto;">
      <table style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:1px solid var(--admin-border);">
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Sr.</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Student Details</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Class / Stream</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">CareerGuru Partner</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Lead Status</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Platform Account</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Premium</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Date Added</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $idx => $lead)
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px; font-weight:600; color:var(--admin-text-3);">
                {{ $leads->firstItem() + $idx }}
              </td>
              <td style="padding:14px;">
                <strong style="color:var(--admin-text-1);">{{ $lead->student_name }}</strong>
                <div style="font-size:11.5px; color:var(--admin-text-2);">
                  <a href="tel:{{ $lead->phone }}" style="color:inherit; text-decoration:none;">{{ $lead->phone }}</a> · 
                  <a href="mailto:{{ $lead->email }}" style="color:#2563eb; text-decoration:none;">{{ $lead->email }}</a>
                </div>
                @if($lead->city || $lead->school_college)
                  <div style="font-size:11px; color:var(--admin-text-3);">
                    {{ $lead->city ? $lead->city . ' · ' : '' }}{{ $lead->school_college }}
                  </div>
                @endif
              </td>
              <td style="padding:14px;">
                <span class="status-badge" style="background:#f1f5f9; color:#475569;">{{ $lead->standard }}</span>
                @if($lead->interested_course)
                  <div style="font-size:11px; color:var(--admin-text-2); margin-top:2px;">{{ $lead->interested_course }}</div>
                @endif
              </td>
              <td style="padding:14px;">
                @if($lead->careerguru)
                  <a href="{{ route('admin.careergurus.show', $lead->careerguru->id) }}" style="color:var(--admin-text-1); font-weight:600; text-decoration:none;">
                    {{ $lead->careerguru->name }}
                  </a>
                  <div style="font-size:11px; color:#2563eb; font-family:monospace;">{{ $lead->careerguru->guru_id }}</div>
                @else
                  <span style="color:#94a3b8;">—</span>
                @endif
              </td>
              <td style="padding:14px;">
                <span class="status-badge {{ $lead->status_badge_class }}">
                  {{ $lead->lead_status }}
                </span>
              </td>
              <td style="padding:14px;">
                @if($lead->isRegistered())
                  <span class="status-badge status-active"><i class="fa-solid fa-check"></i> Registered</span>
                  @if($lead->registered_at)
                    <div style="font-size:11px; color:var(--admin-text-3);">{{ $lead->registered_at->format('d M Y') }}</div>
                  @endif
                @else
                  <span class="status-badge" style="background:#f1f5f9; color:#94a3b8;">Unregistered</span>
                @endif
              </td>
              <td style="padding:14px;">
                @if($lead->isPremium())
                  <span class="status-badge status-active" style="background:#fef3c7; color:#b45309;"><i class="fa-solid fa-crown"></i> VIP Member</span>
                @else
                  <span style="color:#94a3b8; font-size:12px;">Regular</span>
                @endif
              </td>
              <td style="padding:14px; font-size:12px; color:var(--admin-text-2); white-space:nowrap;">
                {{ $lead->created_at->format('d M Y') }}
              </td>
              <td style="padding:14px; text-align:right;">
                <a href="{{ route('admin.careergurus.lead-details', $lead->id) }}" class="guru-action-btn">
                  <i class="fa-solid fa-eye"></i> Details
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" style="text-align:center; padding:36px; color:var(--admin-text-3);">
                No student leads found matching criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($leads->hasPages())
      <div style="padding:16px 20px; border-top:1px solid var(--admin-border);">
        {{ $leads->links() }}
      </div>
    @endif
  </div>

@endsection


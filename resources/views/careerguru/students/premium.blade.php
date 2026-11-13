@extends('careerguru.layout')

@section('title', 'Premium Students')
@section('page-title', 'Premium Purchased Students')

@section('content')

  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Premium Purchased Students</h2>
      <p style="font-size:13px; color:#64748b;">Verified students who purchased a VIP membership on CareerGyan, triggering partner commission.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('careerguru.commissions.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-wallet"></i> View Commission Ledger
      </a>
    </div>
  </div>

  <!-- Filter Card -->
  <div class="guru-card" style="margin-bottom:20px;">
    <div class="guru-card-body" style="padding:16px 20px;">
      <form method="GET" action="{{ route('careerguru.students.premium') }}" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
        <div style="flex:1; min-width:220px;">
          <input type="text" name="search" class="form-control" placeholder="Search by student name, email, or phone..." value="{{ request('search') }}">
        </div>
        <div>
          <select name="status" class="form-control" style="width: auto;">
            <option value="all">All Commission Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Audit</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected / Refunded</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-filter"></i> Filter
        </button>
        @if(request('search') || (request('status') && request('status') !== 'all'))
          <a href="{{ route('careerguru.students.premium') }}" class="btn btn-outline" title="Reset">
            <i class="fa-solid fa-rotate-left"></i>
          </a>
        @endif
      </form>
    </div>
  </div>

  <!-- Premium Students Table -->
  <div class="guru-card">
    <div class="guru-card-header">
      <h3 class="guru-card-title">
        <i class="fa-solid fa-crown" style="color:#f59e0b;"></i> Premium Conversions Table
      </h3>
      <span style="font-size:12.5px; color:#64748b;">
        Showing {{ $commissions->firstItem() ?? 0 }} - {{ $commissions->lastItem() ?? 0 }} of {{ $commissions->total() }} premium conversions
      </span>
    </div>

    <div class="guru-table-wrapper">
      <table class="guru-table">
        <thead>
          <tr>
            <th style="width:50px;">Sr. No.</th>
            <th>Student Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Studying Standard</th>
            <th>Membership Plan</th>
            <th>Purchase Date</th>
            <th>Membership Amount</th>
            <th>Commission %</th>
            <th>Commission Amount</th>
            <th>Commission Status</th>
            <th style="text-align:right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($commissions as $idx => $comm)
            @php
              $student = $comm->studentUser;
              $lead = $comm->lead;
              $phone = $student ? $student->phone : ($lead ? $lead->phone : '—');
              $standard = $lead ? $lead->standard : ($student ? $student->current_education_level : '—');
            @endphp
            <tr>
              <td style="font-weight:600; color:#64748b;">
                {{ $commissions->firstItem() + $idx }}
              </td>
              <td>
                <strong style="color:var(--guru-text-main);">
                  {{ $student ? $student->name : ($lead ? $lead->student_name : 'Student #' . $comm->user_id) }}
                </strong>
              </td>
              <td>{{ $phone ?? '—' }}</td>
              <td>
                <a href="mailto:{{ $student ? $student->email : ($lead ? $lead->email : '') }}" style="color:#2563eb; text-decoration:none;">
                  {{ $student ? $student->email : ($lead ? $lead->email : '—') }}
                </a>
              </td>
              <td>
                <span class="status-pill pill-gray">{{ $standard ?? 'Student' }}</span>
              </td>
              <td>
                <span class="status-pill pill-purple">
                  <i class="fa-solid fa-gem"></i> {{ $comm->plan_name }}
                </span>
              </td>
              <td style="font-size:12px; color:#64748b; white-space:nowrap;">
                {{ $comm->purchase_date ? $comm->purchase_date->format('d M Y') : $comm->created_at->format('d M Y') }}
              </td>
              <td>
                <strong>₹{{ number_format($comm->membership_amount, 2) }}</strong>
              </td>
              <td style="font-weight:600;">
                {{ $comm->commission_percentage }}%
              </td>
              <td style="color:#10b981; font-weight:800; font-size:13.5px;">
                ₹{{ number_format($comm->commission_amount, 2) }}
              </td>
              <td>
                <span class="status-pill {{ $comm->status_badge_class }}">
                  {{ ucfirst($comm->status) }}
                </span>
              </td>
              <td style="text-align:right;">
                @if($lead)
                  <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline btn-sm">
                    <i class="fa-solid fa-eye"></i> View Lead
                  </a>
                @else
                  <span style="font-size:11px; color:#94a3b8;">Direct Buyer</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="12" style="text-align:center; padding: 36px; color:#94a3b8;">
                <i class="fa-solid fa-crown" style="font-size:32px; margin-bottom:12px; display:block; opacity:0.5; color:#f59e0b;"></i>
                No verified premium purchases yet.
                <p style="font-size:12.5px; margin-top:6px;">When students you refer upgrade to VIP Membership, they will automatically appear here with exact commission calculations.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($commissions->hasPages())
      <div style="padding: 18px 22px; border-top: 1px solid var(--guru-border);">
        {{ $commissions->links() }}
      </div>
    @endif
  </div>

@endsection

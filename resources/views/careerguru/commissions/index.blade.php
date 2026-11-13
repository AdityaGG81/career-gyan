@extends('careerguru.layout')

@section('title', 'Commission Management')
@section('page-title', 'Commission Earnings & Payouts')

@section('styles')
<style>
  .comm-summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }
  @media (max-width: 991px) {
    .comm-summary-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 576px) {
    .comm-summary-grid { grid-template-columns: 1fr; }
  }
  .comm-card {
    background: #ffffff;
    border: 1px solid var(--guru-border);
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
  }
  .comm-card-title {
    font-size: 11.5px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--guru-text-muted);
    font-weight: 700;
    margin-bottom: 8px;
  }
  .comm-card-val {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: var(--guru-text-main);
  }
  .comm-card-sub {
    font-size: 11.5px;
    color: #94a3b8;
    margin-top: 4px;
  }
</style>
@endsection

@section('content')

  <!-- Header -->
  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">My Commissions & Payouts</h2>
      <p style="font-size:13px; color:#64748b;">
        Detailed transaction-wise breakdown of earned commissions, approved balances, and paid transfers.
      </p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('careerguru.profile') }}" class="btn btn-outline">
        <i class="fa-solid fa-building-columns"></i> Manage Bank / UPI Details
      </a>
    </div>
  </div>

  <!-- 4 Summary Cards -->
  <div class="comm-summary-grid">
    <div class="comm-card">
      <div class="comm-card-title">Total Commission Earned</div>
      <div class="comm-card-val" style="color:#059669;">₹{{ number_format($totalEarned, 2) }}</div>
      <div class="comm-card-sub"><i class="fa-solid fa-circle-check" style="color:#10b981;"></i> Lifetime Approved + Paid</div>
    </div>

    <div class="comm-card">
      <div class="comm-card-title">Pending Audit</div>
      <div class="comm-card-val" style="color:#d97706;">₹{{ number_format($pendingCommission, 2) }}</div>
      <div class="comm-card-sub"><i class="fa-solid fa-clock" style="color:#f59e0b;"></i> Under admin review</div>
    </div>

    <div class="comm-card">
      <div class="comm-card-title">Approved (Pending Payout)</div>
      <div class="comm-card-val" style="color:#2563eb;">₹{{ number_format($approvedCommission, 2) }}</div>
      <div class="comm-card-sub"><i class="fa-solid fa-check-circle" style="color:#3b82f6;"></i> Ready for bank transfer</div>
    </div>

    <div class="comm-card">
      <div class="comm-card-title">Total Paid Out</div>
      <div class="comm-card-val" style="color:#4f46e5;">₹{{ number_format($paidCommission, 2) }}</div>
      <div class="comm-card-sub"><i class="fa-solid fa-money-bill-transfer" style="color:#6366f1;"></i> Transferred to your account</div>
    </div>
  </div>

  <!-- Filter -->
  <div class="guru-card" style="margin-bottom:20px;">
    <div class="guru-card-body" style="padding:16px 20px;">
      <form method="GET" action="{{ route('careerguru.commissions.index') }}" style="display:flex; gap:12px; align-items:center;">
        <label style="font-size:12.5px; font-weight:600; color:#475569;">Filter by Status:</label>
        <select name="status" class="form-control" style="width: auto;" onchange="this.form.submit()">
          <option value="all">All Transactions</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected / Refunded</option>
        </select>
        @if(request('status') && request('status') !== 'all')
          <a href="{{ route('careerguru.commissions.index') }}" class="btn btn-outline btn-sm">Clear Filter</a>
        @endif
      </form>
    </div>
  </div>

  <!-- Commission Ledger Table -->
  <div class="guru-card">
    <div class="guru-card-header">
      <h3 class="guru-card-title">
        <i class="fa-solid fa-receipt" style="color:#2563eb;"></i> Transaction-Wise Commission Ledger
      </h3>
      <span style="font-size:12.5px; color:#64748b;">
        Showing {{ $commissions->firstItem() ?? 0 }} - {{ $commissions->lastItem() ?? 0 }} of {{ $commissions->total() }} records
      </span>
    </div>

    <div class="guru-table-wrapper">
      <table class="guru-table">
        <thead>
          <tr>
            <th style="width:50px;">Tx ID</th>
            <th>Referred Student</th>
            <th>Membership Plan</th>
            <th>Purchase Date</th>
            <th>Plan Amount</th>
            <th>Commission Rate</th>
            <th>Commission Earned</th>
            <th>Status</th>
            <th>Payout Details / UTR</th>
          </tr>
        </thead>
        <tbody>
          @forelse($commissions as $comm)
            <tr>
              <td style="font-weight:600; font-family:monospace; color:#64748b;">
                #{{ $comm->id }}
              </td>
              <td>
                <strong style="color:var(--guru-text-main);">
                  {{ $comm->studentUser ? $comm->studentUser->name : 'Student #' . $comm->user_id }}
                </strong>
                <div style="font-size:11px; color:#64748b;">
                  {{ $comm->studentUser ? $comm->studentUser->email : '' }}
                </div>
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
              <td style="color:#10b981; font-weight:800; font-size:14px;">
                ₹{{ number_format($comm->commission_amount, 2) }}
              </td>
              <td>
                <span class="status-pill {{ $comm->status_badge_class }}">
                  {{ ucfirst($comm->status) }}
                </span>
              </td>
              <td>
                @if($comm->status === 'paid')
                  <div style="font-size:12px; color:#10b981; font-weight:600;">
                    <i class="fa-solid fa-check-double"></i> Paid on {{ $comm->paid_at ? $comm->paid_at->format('d M Y') : '—' }}
                  </div>
                  @if($comm->payout_reference)
                    <div style="font-size:11px; font-family:monospace; color:#64748b;">
                      Ref: {{ $comm->payout_reference }}
                    </div>
                  @endif
                @elseif($comm->status === 'approved')
                  <span style="font-size:12px; color:#2563eb; font-weight:600;">
                    <i class="fa-solid fa-circle-check"></i> Queued for next payout cycle
                  </span>
                @elseif($comm->status === 'rejected')
                  <span style="font-size:12px; color:#ef4444;">
                    <i class="fa-solid fa-xmark"></i> {{ $comm->admin_remarks ?? 'Refunded / Ineligible' }}
                  </span>
                @else
                  <span style="font-size:12px; color:#f59e0b;">
                    <i class="fa-solid fa-hourglass-half"></i> Awaiting verification
                  </span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" style="text-align:center; padding: 36px; color:#94a3b8;">
                <i class="fa-solid fa-sack-dollar" style="font-size:32px; margin-bottom:12px; display:block; opacity:0.5;"></i>
                No commission records found.
                <p style="font-size:12.5px; margin-top:6px;">When students purchase a VIP membership through your referral, verified commissions will appear here automatically.</p>
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


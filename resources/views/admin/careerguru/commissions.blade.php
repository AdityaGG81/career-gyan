@extends('admin.layout')

@section('title', 'Commission Payout Management')
@section('page_title', 'Commission Management')

@section('styles')
<style>
  .comm-stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }
  @media (max-width: 991px) {
    .comm-stats-row { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 576px) {
    .comm-stats-row { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Partner Commission Payouts</h2>
      <p style="font-size:13px; color:var(--admin-text-2);">Audit, approve, and record banking/UPI disbursements for CareerGuru partner commissions.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('admin.careergurus.export.commissions') }}" class="guru-action-btn" style="background:#ecfdf5; color:#047857; border-color:#a7f3d0; padding:8px 14px; font-weight:600;">
        <i class="fa-solid fa-file-csv"></i> Export Commissions CSV
      </a>
      <a href="{{ route('admin.careergurus.settings') }}" class="guru-action-btn" style="background:#fff; padding:8px 14px;">
        <i class="fa-solid fa-sliders"></i> Commission Rules & Settings
      </a>
    </div>
  </div>

  <!-- Summary Stats -->
  <div class="comm-stats-row">
    <div class="stat-box">
      <div class="stat-label">Pending Verification</div>
      <div class="stat-number" style="color:#d97706;">₹{{ number_format($pendingAmount, 2) }}</div>
      <div class="stat-sub"><strong style="color:#d97706;">{{ $pendingCount }} transactions</strong> awaiting approval</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">Approved (Ready for Payout)</div>
      <div class="stat-number" style="color:#2563eb;">₹{{ number_format($approvedAmount, 2) }}</div>
      <div class="stat-sub">Queued for next bank transfer cycle</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">Total Commission Paid</div>
      <div class="stat-number" style="color:#059669;">₹{{ number_format($paidAmount, 2) }}</div>
      <div class="stat-sub"><i class="fa-solid fa-check-double"></i> Settled and disbursed</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">Total Commission Liability</div>
      <div class="stat-number" style="color:var(--admin-text-1);">₹{{ number_format($pendingAmount + $approvedAmount, 2) }}</div>
      <div class="stat-sub">Outstanding balance payable to partners</div>
    </div>
  </div>

  <!-- Filters -->
  <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:18px 20px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
    <form method="GET" action="{{ route('admin.careergurus.commissions') }}" style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
      <div style="flex:1; min-width:240px; position:relative;">
        <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--admin-text-3);"></i>
        <input type="text" name="search" class="form-control" style="padding-left:36px;" placeholder="Search student name, email, partner, UTR ref..." value="{{ request('search') }}">
      </div>

      <div>
        <select name="status" class="form-control" style="width:auto;">
          <option value="all">All Statuses</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
      </div>

      <div>
        <select name="careerguru_id" class="form-control" style="width:auto;">
          <option value="all">All Partners</option>
          @foreach($allGurus as $g)
            <option value="{{ $g->id }}" {{ request('careerguru_id') == $g->id ? 'selected' : '' }}>{{ $g->name }} ({{ $g->guru_id }})</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="guru-action-btn" style="background:#2563eb; color:#fff; height:41px; padding:0 16px;">
        <i class="fa-solid fa-filter"></i> Filter
      </button>

      @if(request()->hasAny(['search', 'status', 'careerguru_id']))
        <a href="{{ route('admin.careergurus.commissions') }}" class="guru-action-btn" style="height:41px; padding:0 12px;" title="Reset"><i class="fa-solid fa-rotate-left"></i></a>
      @endif
    </form>
  </div>

  <!-- Commission Table -->
  <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); overflow:hidden; box-shadow:var(--admin-shadow);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
      <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700;">
        <i class="fa-solid fa-hand-holding-dollar" style="color:#fbbf24; margin-right:6px;"></i> All Commission Records
      </h3>
      <span style="font-size:12px; color:var(--admin-text-2);">
        Showing {{ $commissions->firstItem() ?? 0 }} - {{ $commissions->lastItem() ?? 0 }} of {{ $commissions->total() }} records
      </span>
    </div>

    <div style="width:100%; overflow-x:auto;">
      <table style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:1px solid var(--admin-border);">
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Tx ID</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">CareerGuru Partner</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Student Buyer</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Plan & Purchase Date</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Paid Amount</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Commission (Rate)</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Status</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Payout UTR / Info</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($commissions as $comm)
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px; font-family:monospace; font-weight:700; color:var(--admin-text-3);">
                #{{ $comm->id }}
              </td>
              <td style="padding:14px;">
                @if($comm->careerguru)
                  <strong style="color:var(--admin-text-1);">
                    <a href="{{ route('admin.careergurus.show', $comm->careerguru->id) }}" style="color:inherit; text-decoration:none;">
                      {{ $comm->careerguru->name }}
                    </a>
                  </strong>
                  <div style="font-size:11px; color:#2563eb; font-family:monospace;">
                    {{ $comm->careerguru->guru_id }} · {{ $comm->careerguru->payout_upi_id ? 'UPI: ' . $comm->careerguru->payout_upi_id : 'Bank: ' . ($comm->careerguru->payout_account_number ?? 'None') }}
                  </div>
                @else
                  <span style="color:#94a3b8;">—</span>
                @endif
              </td>
              <td style="padding:14px;">
                <strong style="color:var(--admin-text-1);">
                  {{ $comm->studentUser ? $comm->studentUser->name : 'User #' . $comm->user_id }}
                </strong>
                <div style="font-size:11px; color:var(--admin-text-2);">
                  {{ $comm->studentUser ? $comm->studentUser->email : '' }}
                </div>
              </td>
              <td style="padding:14px;">
                <span class="status-badge" style="background:#f3e8ff; color:#7e22ce;">{{ $comm->plan_name }}</span>
                <div style="font-size:11px; color:var(--admin-text-3); margin-top:2px;">
                  {{ $comm->purchase_date ? $comm->purchase_date->format('d M Y') : $comm->created_at->format('d M Y') }}
                </div>
              </td>
              <td style="padding:14px; font-weight:700;">
                ₹{{ number_format($comm->membership_amount, 2) }}
              </td>
              <td style="padding:14px;">
                <div style="font-weight:800; color:#059669; font-size:14px;">
                  ₹{{ number_format($comm->commission_amount, 2) }}
                </div>
                <div style="font-size:11px; color:var(--admin-text-3);">{{ $comm->commission_percentage }}% rate</div>
              </td>
              <td style="padding:14px;">
                <span class="status-badge {{ $comm->status_badge_class }}">
                  {{ ucfirst($comm->status) }}
                </span>
              </td>
              <td style="padding:14px; font-size:12px;">
                @if($comm->status === 'paid')
                  <div style="color:#059669; font-weight:600;"><i class="fa-solid fa-check-double"></i> Paid {{ $comm->paid_at ? $comm->paid_at->format('d M Y') : '' }}</div>
                  @if($comm->payment_reference)
                    <div style="font-family:monospace; font-size:11px; color:var(--admin-text-2);">UTR: {{ $comm->payment_reference }}</div>
                  @endif
                @elseif($comm->status === 'approved')
                  <span style="color:#2563eb; font-weight:600;"><i class="fa-solid fa-circle-check"></i> Approved</span>
                @elseif($comm->status === 'rejected')
                  <span style="color:#dc2626;"><i class="fa-solid fa-ban"></i> {{ $comm->rejection_reason ?? 'Rejected' }}</span>
                @else
                  <span style="color:#d97706;"><i class="fa-solid fa-hourglass-half"></i> Pending</span>
                @endif
              </td>
              <td style="padding:14px; text-align:right;">
                <div style="display:flex; justify-content:flex-end; gap:6px;">
                  @if($comm->status === 'pending')
                    <form method="POST" action="{{ route('admin.careergurus.commissions.approve', $comm->id) }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="guru-action-btn" style="background:#ecfdf5; color:#047857; border-color:#a7f3d0;" title="Approve Commission" onclick="return confirm('Approve commission of ₹{{ $comm->commission_amount }}?')">
                        <i class="fa-solid fa-check"></i> Approve
                      </button>
                    </form>
                    <button type="button" class="guru-action-btn" style="color:#dc2626;" title="Reject" onclick="openRejectModal('{{ $comm->id }}', '{{ $comm->commission_amount }}')">
                      <i class="fa-solid fa-xmark"></i> Reject
                    </button>
                  @endif

                  @if($comm->status === 'approved')
                    <button type="button" class="guru-action-btn" style="background:#2563eb; color:#fff;" title="Record Payout Transfer" onclick="openPaidModal('{{ $comm->id }}', '{{ $comm->commission_amount }}', '{{ $comm->careerguru ? $comm->careerguru->name : '' }}')">
                      <i class="fa-solid fa-money-bill-transfer"></i> Record Paid
                    </button>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" style="text-align:center; padding:36px; color:var(--admin-text-3);">
                No commission records found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($commissions->hasPages())
      <div style="padding:16px 20px; border-top:1px solid var(--admin-border);">
        {{ $commissions->links() }}
      </div>
    @endif
  </div>

  <!-- Reject Modal -->
  <div id="rejectModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:#fff; border-radius:var(--admin-radius-lg); width:100%; max-width:440px; box-shadow:0 20px 25px rgba(0,0,0,0.2); overflow:hidden;">
      <div style="padding:18px 24px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
        <h4 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; color:#dc2626;">Reject Commission</h4>
        <button type="button" onclick="closeRejectModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
      </div>
      <form id="rejectForm" method="POST" action="">
        @csrf
        <div style="padding:22px 24px;">
          <p id="rejectModalMsg" style="font-size:13px; color:var(--admin-text-2); margin-bottom:14px;"></p>
          <div class="form-group">
            <label class="form-label" for="reason">Reason for Rejection <span style="color:#ef4444;">*</span></label>
            <input type="text" id="reason" name="reason" class="form-control" placeholder="e.g. Refunded order / duplicate / unauthorized" required>
          </div>
        </div>
        <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid var(--admin-border); display:flex; justify-content:flex-end; gap:10px;">
          <button type="button" class="guru-action-btn" onclick="closeRejectModal()">Cancel</button>
          <button type="submit" class="guru-action-btn" style="background:#dc2626; color:#fff;">Confirm Rejection</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Mark Paid Modal -->
  <div id="paidModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:#fff; border-radius:var(--admin-radius-lg); width:100%; max-width:460px; box-shadow:0 20px 25px rgba(0,0,0,0.2); overflow:hidden;">
      <div style="padding:18px 24px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
        <h4 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; color:#059669;">Record Commission Disbursement</h4>
        <button type="button" onclick="closePaidModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
      </div>
      <form id="paidForm" method="POST" action="">
        @csrf
        <div style="padding:22px 24px;">
          <p id="paidModalMsg" style="font-size:13px; color:var(--admin-text-2); margin-bottom:16px;"></p>

          <div class="form-group" style="margin-bottom:14px;">
            <label class="form-label" for="payment_reference">Transaction / UTR Reference ID <span style="color:#ef4444;">*</span></label>
            <input type="text" id="payment_reference" name="payment_reference" class="form-control" placeholder="e.g. UPI/312019283719 or NEFT/SBIN123..." required>
          </div>

          <div class="form-group" style="margin-bottom:14px;">
            <label class="form-label" for="paid_at">Payout Date <span style="color:#ef4444;">*</span></label>
            <input type="date" id="paid_at" name="paid_at" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="admin_remarks">Administrative Remarks (Optional)</label>
            <input type="text" id="admin_remarks" name="admin_remarks" class="form-control" placeholder="e.g. Disbursed via SBI NetBanking">
          </div>
        </div>
        <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid var(--admin-border); display:flex; justify-content:flex-end; gap:10px;">
          <button type="button" class="guru-action-btn" onclick="closePaidModal()">Cancel</button>
          <button type="submit" class="guru-action-btn" style="background:#059669; color:#fff;">Save Disbursement Record</button>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  function openRejectModal(commId, amount) {
    document.getElementById('rejectForm').action = `/admin/careergurus/commissions/${commId}/reject`;
    document.getElementById('rejectModalMsg').innerText = `You are marking commission #${commId} (₹${amount}) as rejected.`;
    document.getElementById('rejectModal').style.display = 'flex';
  }
  function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
  }

  function openPaidModal(commId, amount, guruName) {
    document.getElementById('paidForm').action = `/admin/careergurus/commissions/${commId}/mark-paid`;
    document.getElementById('paidModalMsg').innerText = `Record transfer of ₹${amount} to partner: ${guruName}.`;
    document.getElementById('paidModal').style.display = 'flex';
  }
  function closePaidModal() {
    document.getElementById('paidModal').style.display = 'none';
  }
</script>
@endsection

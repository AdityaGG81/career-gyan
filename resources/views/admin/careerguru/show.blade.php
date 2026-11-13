@extends('admin.layout')

@section('title', $guru->name . ' - Partner Performance')
@section('page_title', 'CareerGuru Performance Tracking')

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .profile-header-card {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    color: #fff;
    border-radius: var(--admin-radius-lg);
    padding: 26px 30px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }
  .partner-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 800;
    color: #fff;
    flex-shrink: 0;
  }
  .filter-bar {
    background: #fff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 16px 20px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
  }
  .stats-grid-6 {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 14px;
    margin-bottom: 24px;
  }
  @media (max-width: 1200px) {
    .stats-grid-6 { grid-template-columns: repeat(3, 1fr); }
  }
  @media (max-width: 650px) {
    .stats-grid-6 { grid-template-columns: 1fr; }
  }
  .stat-card-sm {
    background: #fff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 16px;
    box-shadow: var(--admin-shadow);
  }
  .stat-card-sm .label {
    font-size: 11px;
    text-transform: uppercase;
    color: var(--admin-text-2);
    font-weight: 700;
    letter-spacing: 0.04em;
    margin-bottom: 6px;
  }
  .stat-card-sm .val {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: var(--admin-text-1);
  }
  .two-cols {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
  }
  @media (max-width: 991px) {
    .two-cols { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <!-- Partner Profile Header Card -->
  <div class="profile-header-card">
    <div style="display:flex; align-items:center; gap:18px;">
      <div class="partner-avatar">{{ strtoupper(substr($guru->name, 0, 1)) }}</div>
      <div>
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
          <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">{{ $guru->name }}</h2>
          <span style="font-family:monospace; background:rgba(59,130,246,0.25); color:#93c5fd; padding:3px 8px; border-radius:6px; font-size:12px; font-weight:700;">
            {{ $guru->guru_id }}
          </span>
          @if($guru->status === 'active')
            <span class="status-badge status-active">Active</span>
          @elseif($guru->status === 'inactive')
            <span class="status-badge status-inactive">Inactive</span>
          @else
            <span class="status-badge status-revoked">Revoked</span>
          @endif
        </div>
        <div style="font-size:13px; color:#cbd5e1; margin-top:6px; display:flex; gap:16px; flex-wrap:wrap;">
          <span><i class="fa-solid fa-envelope" style="margin-right:4px;"></i>{{ $guru->email }}</span>
          <span><i class="fa-solid fa-phone" style="margin-right:4px;"></i>{{ $guru->phone }}</span>
          <span><i class="fa-solid fa-tag" style="margin-right:4px; color:#fde047;"></i>Code: <strong>{{ $guru->referral_code }}</strong></span>
          <span><i class="fa-solid fa-percentage" style="margin-right:4px; color:#86efac;"></i>Commission: <strong>{{ $guru->commission_percentage }}%</strong></span>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
      <a href="{{ route('admin.careergurus.edit', $guru->id) }}" class="guru-action-btn" style="background:#fff; color:var(--admin-text-1);">
        <i class="fa-solid fa-pen-to-square"></i> Edit
      </a>
      <form method="POST" action="{{ route('admin.careergurus.toggle-status', $guru->id) }}" style="display:inline;">
        @csrf
        @if($guru->status === 'active')
          <button type="submit" class="guru-action-btn" style="color:#d97706;" onclick="return confirm('Deactivate account?')">
            <i class="fa-solid fa-pause"></i> Deactivate
          </button>
        @else
          <button type="submit" class="guru-action-btn" style="color:#059669;" onclick="return confirm('Activate account?')">
            <i class="fa-solid fa-play"></i> Activate
          </button>
        @endif
      </form>
      @if($guru->status !== 'revoked')
        <form method="POST" action="{{ route('admin.careergurus.revoke', $guru->id) }}" style="display:inline;">
          @csrf
          <button type="submit" class="guru-action-btn" style="color:#dc2626;" onclick="return confirm('Revoke partner access completely?')">
            <i class="fa-solid fa-ban"></i> Revoke
          </button>
        </form>
      @endif
    </div>
  </div>

  <!-- Date Range Filter Bar -->
  <div class="filter-bar">
    <div style="font-size:13.5px; font-weight:700; color:var(--admin-text-1);">
      <i class="fa-solid fa-filter" style="color:#2563eb; margin-right:6px;"></i> Performance Period:
    </div>
    <div style="display:flex; gap:6px; flex-wrap:wrap;">
      <a href="{{ route('admin.careergurus.show', [$guru->id, 'date_range' => 'today']) }}" class="guru-action-btn {{ $dateFilter == 'today' ? 'active' : '' }}" style="{{ $dateFilter == 'today' ? 'background:#2563eb; color:#fff;' : '' }}">Today</a>
      <a href="{{ route('admin.careergurus.show', [$guru->id, 'date_range' => '7_days']) }}" class="guru-action-btn {{ $dateFilter == '7_days' ? 'active' : '' }}" style="{{ $dateFilter == '7_days' ? 'background:#2563eb; color:#fff;' : '' }}">Last 7 Days</a>
      <a href="{{ route('admin.careergurus.show', [$guru->id, 'date_range' => '30_days']) }}" class="guru-action-btn {{ $dateFilter == '30_days' ? 'active' : '' }}" style="{{ $dateFilter == '30_days' ? 'background:#2563eb; color:#fff;' : '' }}">Last 30 Days</a>
      <a href="{{ route('admin.careergurus.show', [$guru->id, 'date_range' => 'this_month']) }}" class="guru-action-btn {{ $dateFilter == 'this_month' ? 'active' : '' }}" style="{{ $dateFilter == 'this_month' ? 'background:#2563eb; color:#fff;' : '' }}">This Month</a>
      <a href="{{ route('admin.careergurus.show', [$guru->id, 'date_range' => 'last_month']) }}" class="guru-action-btn {{ $dateFilter == 'last_month' ? 'active' : '' }}" style="{{ $dateFilter == 'last_month' ? 'background:#2563eb; color:#fff;' : '' }}">Last Month</a>
    </div>
  </div>

  <!-- Filtered vs Lifetime Stats Grid -->
  <div class="stats-grid-6">
    <div class="stat-card-sm">
      <div class="label">Period Leads</div>
      <div class="val" style="color:#2563eb;">{{ number_format($filteredLeadsCount) }}</div>
      <div style="font-size:11px; color:var(--admin-text-3);">Lifetime: {{ number_format($totalLeads) }}</div>
    </div>

    <div class="stat-card-sm">
      <div class="label">Registrations</div>
      <div class="val" style="color:#10b981;">{{ number_format($filteredRegistrationsCount) }}</div>
      <div style="font-size:11px; color:var(--admin-text-3);">Lifetime: {{ number_format($totalRegistrations) }}</div>
    </div>

    <div class="stat-card-sm">
      <div class="label">VIP Conversions</div>
      <div class="val" style="color:#f59e0b;">{{ number_format($filteredPremiumCount) }}</div>
      <div style="font-size:11px; color:var(--admin-text-3);">Lifetime: {{ number_format($totalPremium) }}</div>
    </div>

    <div class="stat-card-sm">
      <div class="label">Revenue Brought</div>
      <div class="val">₹{{ number_format($filteredRevenueGenerated, 2) }}</div>
      <div style="font-size:11px; color:var(--admin-text-3);">Lifetime: ₹{{ number_format($totalRevenue, 2) }}</div>
    </div>

    <div class="stat-card-sm">
      <div class="label">Commission Earned</div>
      <div class="val" style="color:#059669;">₹{{ number_format($filteredCommissionEarned, 2) }}</div>
      <div style="font-size:11px; color:var(--admin-text-3);">Total: ₹{{ number_format($totalCommissionEarned, 2) }}</div>
    </div>

    <div class="stat-card-sm">
      <div class="label">Commission Paid</div>
      <div class="val" style="color:#4f46e5;">₹{{ number_format($totalCommissionPaid, 2) }}</div>
      <div style="font-size:11px; color:#d97706;">Pending: ₹{{ number_format($pendingCommission, 2) }}</div>
    </div>
  </div>

  <!-- Performance Charts Row -->
  <div class="two-cols">
    <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:20px; box-shadow:var(--admin-shadow);">
      <h3 style="font-family:'Outfit',sans-serif; font-size:15px; font-weight:700; margin-bottom:16px;">
        <i class="fa-solid fa-chart-column" style="color:#2563eb; margin-right:6px;"></i> Monthly Leads & Registrations
      </h3>
      <div style="position:relative; height:240px;">
        <canvas id="guruLeadsChart"></canvas>
      </div>
    </div>

    <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:20px; box-shadow:var(--admin-shadow);">
      <h3 style="font-family:'Outfit',sans-serif; font-size:15px; font-weight:700; margin-bottom:16px;">
        <i class="fa-solid fa-sack-dollar" style="color:#10b981; margin-right:6px;"></i> Conversions & Commission (₹)
      </h3>
      <div style="position:relative; height:240px;">
        <canvas id="guruCommChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Banking & Payout Details Card -->
  <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:22px 24px; margin-bottom:24px; box-shadow:var(--admin-shadow);">
    <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:14px; color:var(--admin-text-1);">
      <i class="fa-solid fa-building-columns" style="color:#059669; margin-right:6px;"></i> Partner Payout Information
    </h3>
    <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; font-size:13px;">
      <div>
        <div style="color:var(--admin-text-3); font-size:11.5px; text-transform:uppercase;">UPI ID</div>
        <strong style="color:#2563eb;">{{ $guru->payout_upi_id ?? 'Not Provided' }}</strong>
      </div>
      <div>
        <div style="color:var(--admin-text-3); font-size:11.5px; text-transform:uppercase;">Bank Name</div>
        <strong>{{ $guru->payout_bank_name ?? 'Not Provided' }}</strong>
      </div>
      <div>
        <div style="color:var(--admin-text-3); font-size:11.5px; text-transform:uppercase;">Account Number</div>
        <strong style="font-family:monospace;">{{ $guru->payout_account_number ?? 'Not Provided' }}</strong>
      </div>
      <div>
        <div style="color:var(--admin-text-3); font-size:11.5px; text-transform:uppercase;">IFSC Code</div>
        <strong style="font-family:monospace;">{{ $guru->payout_ifsc_code ?? 'Not Provided' }}</strong>
      </div>
    </div>
  </div>

  <!-- Recent Leads Table for this Guru -->
  <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); overflow:hidden; margin-bottom:24px; box-shadow:var(--admin-shadow);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
      <h3 style="font-family:'Outfit',sans-serif; font-size:15px; font-weight:700;">
        <i class="fa-solid fa-users" style="color:#38bdf8; margin-right:6px;"></i> Recent Student Leads by {{ $guru->name }}
      </h3>
      <a href="{{ route('admin.careergurus.leads', ['guru_id' => $guru->id]) }}" class="guru-action-btn">View All Guru Leads</a>
    </div>
    <div style="width:100%; overflow-x:auto;">
      <table style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:1px solid var(--admin-border);">
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Student</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Phone</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Class</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Lead Status</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">CareerGyan Reg.</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Premium</th>
            <th style="padding:10px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:right;">Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $ld)
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:12px 14px;">
                <strong>{{ $ld->student_name }}</strong>
                <div style="font-size:11px; color:var(--admin-text-3);">{{ $ld->email }}</div>
              </td>
              <td style="padding:12px 14px;">{{ $ld->phone }}</td>
              <td style="padding:12px 14px;"><span class="status-badge" style="background:#f1f5f9; color:#475569;">{{ $ld->standard }}</span></td>
              <td style="padding:12px 14px;"><span class="status-badge" style="background:#e0f2fe; color:#0369a1;">{{ $ld->lead_status }}</span></td>
              <td style="padding:12px 14px;">
                @if($ld->isRegistered())
                  <span class="status-badge status-active"><i class="fa-solid fa-check"></i> Registered</span>
                @else
                  <span class="status-badge" style="background:#f1f5f9; color:#64748b;">No</span>
                @endif
              </td>
              <td style="padding:12px 14px;">
                @if($ld->isPremium())
                  <span class="status-badge status-active" style="background:#fef3c7; color:#b45309;"><i class="fa-solid fa-crown"></i> VIP</span>
                @else
                  <span style="color:#94a3b8; font-size:12px;">Regular</span>
                @endif
              </td>
              <td style="padding:12px 14px; text-align:right; font-size:12px; color:var(--admin-text-2);">
                {{ $ld->created_at->format('d M Y') }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center; padding:24px; color:var(--admin-text-3);">No leads recorded for this partner yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  new Chart(document.getElementById('guruLeadsChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: {!! json_encode($chartMonths) !!},
      datasets: [
        { label: 'Leads', data: {!! json_encode($monthlyLeads) !!}, backgroundColor: '#3b82f6', borderRadius: 4 },
        { label: 'Registered', data: {!! json_encode($monthlyRegistrations) !!}, backgroundColor: '#10b981', borderRadius: 4 }
      ]
    },
    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
  });

  new Chart(document.getElementById('guruCommChart').getContext('2d'), {
    type: 'line',
    data: {
      labels: {!! json_encode($chartMonths) !!},
      datasets: [
        { label: 'Conversions', data: {!! json_encode($monthlyConversions) !!}, borderColor: '#f59e0b', backgroundColor: 'rgba(245,158,11,0.1)', fill: true, tension: 0.3, yAxisID: 'y' },
        { label: 'Commission (₹)', data: {!! json_encode($monthlyCommissions) !!}, borderColor: '#10b981', tension: 0.3, yAxisID: 'y1' }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: { type: 'linear', position: 'left', beginAtZero: true, ticks: { precision: 0 } },
        y1: { type: 'linear', position: 'right', beginAtZero: true, grid: { drawOnChartArea: false } }
      }
    }
  });
</script>
@endsection

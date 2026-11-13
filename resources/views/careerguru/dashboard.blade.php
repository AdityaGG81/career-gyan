@extends('careerguru.layout')

@section('title', 'Partner Dashboard')
@section('page-title', 'CareerGuru Dashboard')

@section('styles')
<style>
  .welcome-banner {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 24px 28px;
    margin-bottom: 26px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 18px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08);
  }
  .welcome-text h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 4px;
    letter-spacing: -0.01em;
  }
  .welcome-text p {
    font-size: 13.5px;
    color: #94a3b8;
  }
  .welcome-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  /* 8 Stat Cards Grid */
  .stats-grid-8 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 26px;
  }
  .stat-card-item {
    background: #ffffff;
    border: 1px solid var(--guru-border);
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    display: block;
  }
  .stat-card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
  }
  .stat-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
  }
  .stat-card-title {
    font-size: 12px;
    font-weight: 600;
    color: var(--guru-text-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .stat-card-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }
  .stat-card-val {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: var(--guru-text-main);
    line-height: 1;
    margin-bottom: 4px;
  }
  .stat-card-sub {
    font-size: 11.5px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* Color themes for 8 cards */
  .card-theme-blue .stat-card-icon { background: #dbeafe; color: #2563eb; }
  .card-theme-green .stat-card-icon { background: #dcfce7; color: #16a34a; }
  .card-theme-orange .stat-card-icon { background: #ffedd5; color: #ea580c; }
  .card-theme-gold .stat-card-icon { background: #fef3c7; color: #d97706; }
  .card-theme-yellow .stat-card-icon { background: #fef9c3; color: #ca8a04; }
  .card-theme-emerald .stat-card-icon { background: #ccfbf1; color: #0d9488; }
  .card-theme-amber .stat-card-icon { background: #fef3c7; color: #b45309; }
  .card-theme-indigo .stat-card-icon { background: #e0e7ff; color: #4f46e5; }

  /* Charts Row */
  .charts-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 20px;
    margin-bottom: 26px;
  }
  .chart-card {
    background: #ffffff;
    border: 1px solid var(--guru-border);
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
  }
  .chart-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }
  .chart-title {
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--guru-text-main);
  }
  .chart-canvas-wrapper {
    position: relative;
    height: 250px;
    width: 100%;
  }

  /* Rates row */
  .rates-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 26px;
  }
  .rate-card {
    background: #ffffff;
    border: 1px solid var(--guru-border);
    border-radius: 14px;
    padding: 18px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .rate-info h4 {
    font-size: 13px;
    font-weight: 600;
    color: var(--guru-text-muted);
    margin-bottom: 6px;
  }
  .rate-progress-wrap {
    height: 8px;
    width: 140px;
    background: #f1f5f9;
    border-radius: 999px;
    overflow: hidden;
    margin-top: 6px;
  }
  .rate-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #10b981);
    border-radius: 999px;
  }

  /* Two Column Table Grid */
  .tables-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 26px;
  }

  @media (max-width: 1200px) {
    .stats-grid-8 { grid-template-columns: repeat(2, 1fr); }
    .charts-grid { grid-template-columns: 1fr; }
    .tables-grid-2 { grid-template-columns: 1fr; }
  }
  @media (max-width: 640px) {
    .stats-grid-8 { grid-template-columns: 1fr; }
    .rates-row { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <!-- Welcome Banner -->
  <div class="welcome-banner">
    <div class="welcome-text">
      <h2>Welcome back, {{ $guru->name }}!</h2>
      <p>Partner ID: <strong style="color:#93c5fd;">{{ $guru->guru_id }}</strong> · Referral Code: <strong style="color:#fde047;">{{ $guru->referral_code }}</strong> · Commission Rate: <strong style="color:#86efac;">{{ $guru->commission_percentage }}%</strong></p>
    </div>
    <div class="welcome-actions">
      <a href="{{ route('careerguru.students.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add Student Lead
      </a>
      <button type="button" class="btn btn-outline" style="color:#fff; background:rgba(255,255,255,0.08); border-color:rgba(255,255,255,0.15);" onclick="copyReferralLink('{{ route('careerguru.ref', ['code' => $guru->referral_code]) }}', this)">
        <i class="fa-regular fa-copy"></i> <span>Copy Referral Link</span>
      </button>
      <a href="https://api.whatsapp.com/send?text={{ urlencode('Hello! Join CareerGyan to plan your career and predict college cutoffs: ' . route('careerguru.ref', ['code' => $guru->referral_code])) }}" target="_blank" class="btn btn-success">
        <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
      </a>
    </div>
  </div>

  <!-- 8 Attractive Stat Cards -->
  <div class="stats-grid-8">
    <!-- 1. Total Students / Leads -->
    <a href="{{ route('careerguru.students.index') }}" class="stat-card-item card-theme-blue">
      <div class="stat-card-header">
        <span class="stat-card-title">1. Total Leads</span>
        <div class="stat-card-icon"><i class="fa-solid fa-users"></i></div>
      </div>
      <div class="stat-card-val">{{ number_format($totalLeads) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-arrow-right"></i> All students recorded</div>
    </a>

    <!-- 2. Students Registered on CareerGyan -->
    <a href="{{ route('careerguru.students.registered') }}" class="stat-card-item card-theme-green">
      <div class="stat-card-header">
        <span class="stat-card-title">2. Registered</span>
        <div class="stat-card-icon"><i class="fa-solid fa-user-check"></i></div>
      </div>
      <div class="stat-card-val">{{ number_format($registeredStudents) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-circle-check" style="color:#10b981;"></i> Active CareerGyan accounts</div>
    </a>

    <!-- 3. Students Not Yet Registered -->
    <div class="stat-card-item card-theme-orange">
      <div class="stat-card-header">
        <span class="stat-card-title">3. Unregistered Leads</span>
        <div class="stat-card-icon"><i class="fa-solid fa-user-clock"></i></div>
      </div>
      <div class="stat-card-val">{{ number_format($notYetRegistered) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-phone" style="color:#ea580c;"></i> Follow-up recommended</div>
    </div>

    <!-- 4. Premium Membership Purchased -->
    <a href="{{ route('careerguru.students.premium') }}" class="stat-card-item card-theme-gold">
      <div class="stat-card-header">
        <span class="stat-card-title">4. Premium Purchased</span>
        <div class="stat-card-icon"><i class="fa-solid fa-crown"></i></div>
      </div>
      <div class="stat-card-val">{{ number_format($premiumPurchased) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-sparkles" style="color:#d97706;"></i> Verified VIP conversions</div>
    </a>

    <!-- 5. Pending Premium Conversions -->
    <div class="stat-card-item card-theme-yellow">
      <div class="stat-card-header">
        <span class="stat-card-title">5. Pending Conversions</span>
        <div class="stat-card-icon"><i class="fa-solid fa-hourglass-half"></i></div>
      </div>
      <div class="stat-card-val">{{ number_format($pendingPremium) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-clock"></i> Registered, non-premium</div>
    </div>

    <!-- 6. Total Commission Earned -->
    <a href="{{ route('careerguru.commissions.index') }}" class="stat-card-item card-theme-emerald">
      <div class="stat-card-header">
        <span class="stat-card-title">6. Commission Earned</span>
        <div class="stat-card-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
      </div>
      <div class="stat-card-val">₹{{ number_format($totalCommissionEarned, 2) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-wallet" style="color:#0d9488;"></i> Lifetime approved + paid</div>
    </a>

    <!-- 7. Pending Commission -->
    <div class="stat-card-item card-theme-amber">
      <div class="stat-card-header">
        <span class="stat-card-title">7. Pending Commission</span>
        <div class="stat-card-icon"><i class="fa-solid fa-receipt"></i></div>
      </div>
      <div class="stat-card-val">₹{{ number_format($pendingCommission, 2) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-shield-halved"></i> Under admin audit</div>
    </div>

    <!-- 8. Total Commission Paid -->
    <div class="stat-card-item card-theme-indigo">
      <div class="stat-card-header">
        <span class="stat-card-title">8. Commission Paid</span>
        <div class="stat-card-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
      </div>
      <div class="stat-card-val">₹{{ number_format($totalCommissionPaid, 2) }}</div>
      <div class="stat-card-sub"><i class="fa-solid fa-check-double" style="color:#4f46e5;"></i> Transferred to bank/UPI</div>
    </div>
  </div>

  <!-- Performance Rates -->
  <div class="rates-row">
    <div class="rate-card">
      <div class="rate-info">
        <h4>Lead to Registration Conversion</h4>
        <div style="font-family:'Outfit',sans-serif; font-size:24px; font-weight:800; color:#2563eb;">
          {{ $leadConversionRate }}%
        </div>
        <div class="rate-progress-wrap">
          <div class="rate-progress-bar" style="width: {{ min($leadConversionRate, 100) }}%;"></div>
        </div>
      </div>
      <div style="text-align:right; font-size:12px; color:#64748b;">
        <div>{{ $registeredStudents }} of {{ $totalLeads }} registered</div>
        <div style="margin-top:4px;"><a href="{{ route('careerguru.students.index') }}" style="color:#2563eb; text-decoration:none; font-weight:600;">View Leads →</a></div>
      </div>
    </div>

    <div class="rate-card">
      <div class="rate-info">
        <h4>Registered to Premium Conversion</h4>
        <div style="font-family:'Outfit',sans-serif; font-size:24px; font-weight:800; color:#10b981;">
          {{ $regToPremiumRate }}%
        </div>
        <div class="rate-progress-wrap">
          <div class="rate-progress-bar" style="width: {{ min($regToPremiumRate, 100) }}%; background: linear-gradient(90deg, #10b981, #059669);"></div>
        </div>
      </div>
      <div style="text-align:right; font-size:12px; color:#64748b;">
        <div>{{ $premiumPurchased }} of {{ $registeredStudents }} upgraded</div>
        <div style="margin-top:4px;"><a href="{{ route('careerguru.students.premium') }}" style="color:#10b981; text-decoration:none; font-weight:600;">View Premium →</a></div>
      </div>
    </div>
  </div>

  <!-- Graphical Representation (Chart.js) -->
  <div class="charts-grid">
    <div class="chart-card">
      <div class="chart-header">
        <h3 class="chart-title"><i class="fa-solid fa-chart-line" style="color:#3b82f6; margin-right:6px;"></i> Monthly Leads & Registrations</h3>
        <span style="font-size:12px; color:#94a3b8;">Last 6 Months</span>
      </div>
      <div class="chart-canvas-wrapper">
        <canvas id="leadsRegChart"></canvas>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-header">
        <h3 class="chart-title"><i class="fa-solid fa-sack-dollar" style="color:#10b981; margin-right:6px;"></i> Premium Conversions & Earnings (₹)</h3>
        <span style="font-size:12px; color:#94a3b8;">Last 6 Months</span>
      </div>
      <div class="chart-canvas-wrapper">
        <canvas id="conversionCommChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Tables Grid: Recent Leads & Recent Registrations -->
  <div class="tables-grid-2">
    <!-- Recent Student Leads -->
    <div class="guru-card">
      <div class="guru-card-header">
        <h3 class="guru-card-title"><i class="fa-solid fa-user-clock" style="color:#38bdf8;"></i> Recent Student Leads</h3>
        <a href="{{ route('careerguru.students.index') }}" class="btn btn-outline btn-sm">View All</a>
      </div>
      <div class="guru-table-wrapper">
        <table class="guru-table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Class</th>
              <th>Status</th>
              <th>Date Added</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentLeads as $lead)
              <tr>
                <td>
                  <strong style="color:var(--guru-text-main);">{{ $lead->student_name }}</strong>
                  <div style="font-size:11px; color:#64748b;">{{ $lead->phone }}</div>
                </td>
                <td><span class="status-pill pill-gray">{{ $lead->studying_standard }}</span></td>
                <td>
                  <span class="status-pill {{ $lead->status_badge_class }}">
                    {{ $lead->status_label }}
                  </span>
                </td>
                <td style="font-size:12px; color:#64748b;">{{ $lead->created_at->format('d M Y') }}</td>
                <td>
                  <a href="{{ route('careerguru.students.show', $lead->id) }}" class="btn btn-outline btn-sm">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-align:center; padding: 24px; color:#94a3b8;">
                  No student leads added yet. <a href="{{ route('careerguru.students.create') }}" style="color:#2563eb; font-weight:600;">Add your first student lead!</a>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recently Registered Students -->
    <div class="guru-card">
      <div class="guru-card-header">
        <h3 class="guru-card-title"><i class="fa-solid fa-id-badge" style="color:#10b981;"></i> Verified Registered Students</h3>
        <a href="{{ route('careerguru.students.registered') }}" class="btn btn-outline btn-sm">View All</a>
      </div>
      <div class="guru-table-wrapper">
        <table class="guru-table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Email</th>
              <th>Premium Status</th>
              <th>Registered At</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentRegistered as $student)
              <tr>
                <td>
                  <strong style="color:var(--guru-text-main);">{{ $student->name }}</strong>
                </td>
                <td style="font-size:12px; color:#64748b;">{{ $student->email }}</td>
                <td>
                  @if($student->is_vip)
                    <span class="status-pill pill-gold"><i class="fa-solid fa-crown"></i> VIP</span>
                  @else
                    <span class="status-pill pill-gray">Free User</span>
                  @endif
                </td>
                <td style="font-size:12px; color:#64748b;">
                  {{ $student->careerguru_registered_at ? \Carbon\Carbon::parse($student->careerguru_registered_at)->format('d M Y') : $student->created_at->format('d M Y') }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" style="text-align:center; padding: 24px; color:#94a3b8;">
                  No verified student registrations yet. Share your referral link with students!
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Recent Premium Purchases & Latest Commission Activity -->
  <div class="guru-card">
    <div class="guru-card-header">
      <h3 class="guru-card-title"><i class="fa-solid fa-crown" style="color:#f59e0b;"></i> Recent Premium Conversions & Commissions</h3>
      <a href="{{ route('careerguru.students.premium') }}" class="btn btn-outline btn-sm">View All Premium</a>
    </div>
    <div class="guru-table-wrapper">
      <table class="guru-table">
        <thead>
          <tr>
            <th>Student</th>
            <th>Plan</th>
            <th>Purchase Date</th>
            <th>Paid Amount</th>
            <th>Comm. %</th>
            <th>Commission Earned</th>
            <th>Commission Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentCommissions as $comm)
            <tr>
              <td>
                <strong style="color:var(--guru-text-main);">{{ $comm->studentUser ? $comm->studentUser->name : 'Student #' . $comm->user_id }}</strong>
                <div style="font-size:11px; color:#64748b;">{{ $comm->studentUser ? $comm->studentUser->email : '' }}</div>
              </td>
              <td><span class="status-pill pill-purple">{{ $comm->plan_name }}</span></td>
              <td style="font-size:12px; color:#64748b;">{{ $comm->purchase_date ? $comm->purchase_date->format('d M Y') : $comm->created_at->format('d M Y') }}</td>
              <td><strong>₹{{ number_format($comm->membership_amount, 2) }}</strong></td>
              <td>{{ $comm->commission_percentage }}%</td>
              <td style="color:#10b981; font-weight:700;">₹{{ number_format($comm->commission_amount, 2) }}</td>
              <td>
                <span class="status-pill {{ $comm->status_badge_class }}">
                  {{ ucfirst($comm->status) }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center; padding: 28px; color:#94a3b8;">
                No premium conversions yet. When your referred students upgrade to VIP Membership, your earned commissions will appear here automatically!
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  // Monthly Leads & Registrations Chart
  const ctxLeads = document.getElementById('leadsRegChart').getContext('2d');
  new Chart(ctxLeads, {
    type: 'bar',
    data: {
      labels: {!! json_encode($chartMonths) !!},
      datasets: [
        {
          label: 'Student Leads Added',
          data: {!! json_encode($monthlyLeads) !!},
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: '#2563eb',
          borderWidth: 1,
          borderRadius: 6,
        },
        {
          label: 'Registered Students',
          data: {!! json_encode($monthlyRegistrations) !!},
          backgroundColor: 'rgba(16, 185, 129, 0.7)',
          borderColor: '#059669',
          borderWidth: 1,
          borderRadius: 6,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'top', labels: { boxWidth: 12, font: { family: 'Plus Jakarta Sans', size: 11 } } },
      },
      scales: {
        y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } } },
        x: { ticks: { font: { size: 11 } } }
      }
    }
  });

  // Premium Conversions & Earnings Chart
  const ctxComm = document.getElementById('conversionCommChart').getContext('2d');
  new Chart(ctxComm, {
    type: 'line',
    data: {
      labels: {!! json_encode($chartMonths) !!},
      datasets: [
        {
          label: 'Premium Conversions',
          data: {!! json_encode($monthlyConversions) !!},
          borderColor: '#f59e0b',
          backgroundColor: 'rgba(245, 158, 11, 0.1)',
          fill: true,
          tension: 0.35,
          yAxisID: 'y'
        },
        {
          label: 'Commission (₹)',
          data: {!! json_encode($monthlyCommissions) !!},
          borderColor: '#10b981',
          backgroundColor: 'transparent',
          borderDash: [5, 5],
          tension: 0.35,
          yAxisID: 'y1'
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'top', labels: { boxWidth: 12, font: { family: 'Plus Jakarta Sans', size: 11 } } },
      },
      scales: {
        y: {
          type: 'linear',
          display: true,
          position: 'left',
          beginAtZero: true,
          ticks: { precision: 0, font: { size: 11 } },
          title: { display: true, text: 'Conversions', font: { size: 10 } }
        },
        y1: {
          type: 'linear',
          display: true,
          position: 'right',
          beginAtZero: true,
          grid: { drawOnChartArea: false },
          ticks: {
            font: { size: 11 },
            callback: function(value) { return '₹' + value; }
          },
          title: { display: true, text: 'Earnings (₹)', font: { size: 10 } }
        },
        x: { ticks: { font: { size: 11 } } }
      }
    }
  });
</script>
@endsection

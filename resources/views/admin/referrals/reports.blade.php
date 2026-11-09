@extends('admin.layout')

@section('title', 'Referral & Rewards Reports & Analytics')

@section('styles')
<style>
  .admin-subnav {
    display: flex;
    gap: 10px;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--admin-border);
    padding-bottom: 12px;
    flex-wrap: wrap;
  }

  .admin-subnav a {
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    color: var(--admin-text-2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
  }

  .admin-subnav a:hover {
    background: #e4e4e7;
    color: var(--admin-text-1);
  }

  .admin-subnav a.active {
    background: #18181b;
    color: #ffffff;
    font-weight: 700;
  }

  .charts-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 24px;
    margin-bottom: 32px;
  }

  @media(max-width: 992px) {
    .charts-grid {
      grid-template-columns: 1fr;
    }
  }

  .metric-card-summary {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 24px;
    box-shadow: var(--admin-shadow);
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="page-header" style="margin-bottom: 24px;">
  <h1 class="page-title"><i class="fa-solid fa-chart-column" style="color: #10b981;"></i> Referral & Rewards Analytics</h1>
  <p style="font-size: 14px; color: var(--admin-text-2); margin-top: 4px;">Comprehensive visual reports, referral conversion rates, and leaderboard insights.</p>
</div>

{{-- Subnavigation Tabs --}}
<div class="admin-subnav">
  <a href="{{ route('admin.referrals.index') }}">
    <i class="fa-solid fa-table-list"></i> All Referrals & Overview
  </a>
  <a href="{{ route('admin.referrals.tree') }}">
    <i class="fa-solid fa-sitemap"></i> Referral Genealogy Tree
  </a>
  <a href="{{ route('admin.referrals.user-rewards') }}">
    <i class="fa-solid fa-user-gear"></i> Student Reward Management
  </a>
  <a href="{{ route('admin.referrals.reports') }}" class="active">
    <i class="fa-solid fa-chart-column"></i> Analytics & Reports
  </a>
</div>

{{-- High Level Conversion Metrics --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px;">
  <div class="metric-card-summary">
    <div style="font-size: 12px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Total Invitations</div>
    <div style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: var(--admin-text-1); margin-top: 4px;">
      {{ number_format($totalInvited) }}
    </div>
  </div>
  <div class="metric-card-summary">
    <div style="font-size: 12px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Successful Signups</div>
    <div style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #16a34a; margin-top: 4px;">
      {{ number_format($totalCompleted) }}
    </div>
  </div>
  <div class="metric-card-summary">
    <div style="font-size: 12px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Conversion Rate</div>
    <div style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #2563eb; margin-top: 4px;">
      {{ $conversionRate }}%
    </div>
  </div>
  <div class="metric-card-summary">
    <div style="font-size: 12px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Referral Points Distributed</div>
    <div style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #d97706; margin-top: 4px;">
      {{ number_format($activityStats['referrals']) }} pts
    </div>
  </div>
</div>

{{-- Charts Section --}}
<div class="charts-grid">
  {{-- 1. Daily Trend Line Chart --}}
  <div class="panel-card" style="padding: 24px;">
    <h3 style="font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; margin-bottom: 16px; color: var(--admin-text-1);">
      <i class="fa-solid fa-chart-line" style="color: #2563eb;"></i> 7-Day Referral Invitations Trend
    </h3>
    <div style="position: relative; height: 260px;">
      <canvas id="trendChart"></canvas>
    </div>
  </div>

  {{-- 2. Points Distribution Doughnut Chart --}}
  <div class="panel-card" style="padding: 24px;">
    <h3 style="font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; margin-bottom: 16px; color: var(--admin-text-1);">
      <i class="fa-solid fa-chart-pie" style="color: #f59e0b;"></i> Points Distributed by Activity
    </h3>
    <div style="position: relative; height: 260px;">
      <canvas id="pointsDoughnutChart"></canvas>
    </div>
  </div>
</div>

{{-- Top Referrers Leaderboard --}}
<div class="panel-card">
  <div class="panel-header">
    <h2><i class="fa-solid fa-trophy" style="color: #f59e0b;"></i> Top Referrers Leaderboard</h2>
    <span style="font-size: 13px; color: var(--admin-text-3);">Most successful student promoters</span>
  </div>

  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Student Name</th>
          <th>Email Address</th>
          <th>Referral Code</th>
          <th>Successful Referrals</th>
          <th>Total Wallet Balance</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($topReferrers as $index => $referrer)
          <tr>
            <td style="font-weight: 800; font-size: 15px;">
              @if($index === 0)
                <span style="color: #f59e0b;"><i class="fa-solid fa-crown"></i> #1</span>
              @elseif($index === 1)
                <span style="color: #94a3b8;"><i class="fa-solid fa-medal"></i> #2</span>
              @elseif($index === 2)
                <span style="color: #b45309;"><i class="fa-solid fa-medal"></i> #3</span>
              @else
                <span style="color: var(--admin-text-3);">#{{ $index + 1 }}</span>
              @endif
            </td>
            <td style="font-weight: 700; color: var(--admin-text-1);">
              {{ $referrer->name }}
            </td>
            <td style="font-size: 13px; color: var(--admin-text-2);">
              {{ $referrer->email }}
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 800; background: #eff6ff; color: #1d4ed8; padding: 3px 8px; border-radius: 6px;">
                {{ $referrer->referral_code }}
              </span>
            </td>
            <td style="font-weight: 800; color: #16a34a; font-size: 15px;">
              {{ $referrer->successful_referrals_count }} friends
            </td>
            <td style="font-weight: 800; color: #d97706;">
              {{ number_format($referrer->points_balance) }} pts
            </td>
            <td>
              <a href="{{ route('admin.referrals.user-rewards', ['user_id' => $referrer->id]) }}" style="background: #f4f4f5; color: var(--admin-text-1); padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 700; text-decoration: none;">
                Manage Points &rarr;
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 40px; color: var(--admin-text-3);">
              No completed referrals recorded yet. Once students invite friends and verify their accounts, top promoters will appear here.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  // Trend Chart
  const trendCtx = document.getElementById('trendChart').getContext('2d');
  new Chart(trendCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode($dates) !!},
      datasets: [{
        label: 'Invitations',
        data: {!! json_encode($trendCounts) !!},
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37, 99, 235, 0.1)',
        tension: 0.3,
        fill: true,
        pointBackgroundColor: '#2563eb',
        pointRadius: 4,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, ticks: { precision: 0 } }
      }
    }
  });

  // Points Doughnut Chart
  const doughnutCtx = document.getElementById('pointsDoughnutChart').getContext('2d');
  new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
      labels: ['Referral Bonuses', 'Aptitude Test', 'Student Analysis', 'Admin Adjustments'],
      datasets: [{
        data: [
          {{ $activityStats['referrals'] }},
          {{ $activityStats['aptitude'] }},
          {{ $activityStats['student_analysis'] }},
          {{ $activityStats['adjustments'] }}
        ],
        backgroundColor: ['#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b'],
        borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 12 } } }
      }
    }
  });
</script>
@endsection


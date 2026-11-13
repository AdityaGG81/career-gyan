@extends('admin.layout')

@section('title', 'CareerGuru Partner Leaderboard')
@section('page_title', 'Guru Performance Comparison')

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .podium-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 26px;
  }
  @media (max-width: 900px) {
    .podium-grid { grid-template-columns: 1fr; }
  }
  .podium-card {
    background: #fff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 24px;
    text-align: center;
    box-shadow: var(--admin-shadow);
    position: relative;
    overflow: hidden;
  }
  .podium-rank-1 {
    border-color: #fde047;
    background: linear-gradient(180deg, #fffbeb 0%, #ffffff 100%);
  }
  .podium-rank-2 {
    border-color: #cbd5e1;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
  }
  .podium-rank-3 {
    border-color: #fed7aa;
    background: linear-gradient(180deg, #fff7ed 0%, #ffffff 100%);
  }
  .medal-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
  }
  .medal-1 { background: #fef08a; color: #854d0e; }
  .medal-2 { background: #e2e8f0; color: #475569; }
  .medal-3 { background: #ffedd5; color: #9a3412; }
</style>
@endsection

@section('content')

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
    <div>
      <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">CareerGuru Leaderboard & Performance Comparison</h2>
      <p style="font-size:13px; color:var(--admin-text-2);">Rankings and cross-partner comparative analytics by student registrations, VIP conversions, and platform revenue.</p>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('admin.careergurus.index') }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">
        <i class="fa-solid fa-list"></i> All Accounts
      </a>
    </div>
  </div>

  <!-- Top 3 Podium -->
  @if($gurus->count() > 0)
    <div class="podium-grid">
      @foreach($gurus->take(3) as $idx => $entry)
        @php
          $g = $entry['guru'];
          $rank = $idx + 1;
        @endphp
        <div class="podium-card podium-rank-{{ $rank }}">
          <div class="medal-icon medal-{{ $rank }}">
            @if($rank === 1) <i class="fa-solid fa-crown"></i>
            @elseif($rank === 2) <i class="fa-solid fa-medal"></i>
            @else <i class="fa-solid fa-award"></i>
            @endif
          </div>
          <div style="font-size:11px; text-transform:uppercase; font-weight:800; letter-spacing:0.06em; color:var(--admin-text-2);">
            Rank #{{ $rank }}
          </div>
          <h3 style="font-family:'Outfit',sans-serif; font-size:18px; font-weight:700; color:var(--admin-text-1); margin:4px 0 2px;">
            {{ $g->name }}
          </h3>
          <div style="font-size:11.5px; color:#2563eb; font-family:monospace; margin-bottom:14px;">{{ $g->guru_id }}</div>

          <div style="background:rgba(0,0,0,0.03); padding:12px; border-radius:10px; display:grid; grid-template-columns:1fr 1fr; gap:8px; font-size:12px; text-align:left;">
            <div>
              <span style="color:var(--admin-text-3);">Revenue:</span>
              <strong style="color:#059669; display:block;">₹{{ number_format($entry['revenue'], 2) }}</strong>
            </div>
            <div>
              <span style="color:var(--admin-text-3);">VIPs:</span>
              <strong style="color:#f59e0b; display:block;">{{ $entry['premium_count'] }}</strong>
            </div>
            <div>
              <span style="color:var(--admin-text-3);">Registered:</span>
              <strong style="display:block;">{{ $entry['registered_count'] }}</strong>
            </div>
            <div>
              <span style="color:var(--admin-text-3);">Conversion:</span>
              <strong style="display:block;">{{ $entry['conversion_rate'] }}%</strong>
            </div>
          </div>

          <div style="margin-top:14px;">
            <a href="{{ route('admin.careergurus.show', $g->id) }}" class="guru-action-btn" style="width:100%; justify-content:center;">
              View Performance →
            </a>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <!-- Chart comparing top partners -->
  @if($gurus->count() > 1)
    <div style="background:#fff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:24px; margin-bottom:26px; box-shadow:var(--admin-shadow);">
      <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:16px;">
        <i class="fa-solid fa-chart-bar" style="color:#2563eb; margin-right:6px;"></i> Revenue & VIP Conversions Comparison
      </h3>
      <div style="position:relative; height:280px;">
        <canvas id="leaderboardChart"></canvas>
      </div>
    </div>
  @endif

  <!-- Full Leaderboard Table -->
  <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); overflow:hidden; box-shadow:var(--admin-shadow);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--admin-border);">
      <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700;">
        <i class="fa-solid fa-ranking-star" style="color:#fbbf24; margin-right:6px;"></i> Full Partner Rankings
      </h3>
    </div>

    <div style="width:100%; overflow-x:auto;">
      <table style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:1px solid var(--admin-border);">
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); width:60px;">Rank</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">CareerGuru Partner</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Leads Added</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Registered Students</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">VIP Conversions</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Conversion %</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Revenue Generated</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Commission Earned</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Commission Paid</th>
            <th style="padding:12px 14px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($gurus as $rankIdx => $row)
            @php $g = $row['guru']; @endphp
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px; font-weight:800; font-size:14px;">
                @if($rankIdx === 0)
                  <span style="color:#ca8a04;"><i class="fa-solid fa-crown"></i> 1</span>
                @elseif($rankIdx === 1)
                  <span style="color:#64748b;"><i class="fa-solid fa-medal"></i> 2</span>
                @elseif($rankIdx === 2)
                  <span style="color:#c2410c;"><i class="fa-solid fa-award"></i> 3</span>
                @else
                  <span style="color:var(--admin-text-3);">{{ $rankIdx + 1 }}</span>
                @endif
              </td>
              <td style="padding:14px;">
                <strong style="color:var(--admin-text-1);">
                  <a href="{{ route('admin.careergurus.show', $g->id) }}" style="color:inherit; text-decoration:none;">
                    {{ $g->name }}
                  </a>
                </strong>
                <div style="font-size:11px; color:#2563eb; font-family:monospace;">
                  {{ $g->guru_id }} · {{ $g->commission_percentage }}% comm.
                </div>
              </td>
              <td style="padding:14px; text-align:center; font-weight:700;">
                {{ number_format($row['leads_count']) }}
              </td>
              <td style="padding:14px; text-align:center; font-weight:700; color:#2563eb;">
                {{ number_format($row['registered_count']) }}
              </td>
              <td style="padding:14px; text-align:center; font-weight:800; color:#f59e0b;">
                {{ number_format($row['premium_count']) }}
              </td>
              <td style="padding:14px; text-align:center; font-weight:700;">
                <span class="status-badge" style="background:#ecfdf5; color:#047857;">{{ $row['conversion_rate'] }}%</span>
              </td>
              <td style="padding:14px; font-weight:800; color:var(--admin-text-1);">
                ₹{{ number_format($row['revenue'], 2) }}
              </td>
              <td style="padding:14px; font-weight:700; color:#059669;">
                ₹{{ number_format($row['commission_earned'], 2) }}
              </td>
              <td style="padding:14px; font-weight:600; color:#4f46e5;">
                ₹{{ number_format($row['commission_paid'], 2) }}
              </td>
              <td style="padding:14px; text-align:right;">
                <a href="{{ route('admin.careergurus.show', $g->id) }}" class="guru-action-btn">
                  <i class="fa-solid fa-chart-line"></i> Performance
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" style="text-align:center; padding:36px; color:var(--admin-text-3);">
                No partners found for leaderboard comparison.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('scripts')
@if($gurus->count() > 1)
<script>
  @php
    $chartGurus = $gurus->take(10);
    $chartNames = $chartGurus->map(fn($item) => $item['guru']->name)->toArray();
    $chartRevenues = $chartGurus->map(fn($item) => $item['revenue'])->toArray();
    $chartPrems = $chartGurus->map(fn($item) => $item['premium_count'])->toArray();
  @endphp

  new Chart(document.getElementById('leaderboardChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: {!! json_encode($chartNames) !!},
      datasets: [
        {
          label: 'Platform Revenue (₹)',
          data: {!! json_encode($chartRevenues) !!},
          backgroundColor: '#3b82f6',
          borderRadius: 6,
          yAxisID: 'y'
        },
        {
          label: 'VIP Conversions',
          data: {!! json_encode($chartPrems) !!},
          backgroundColor: '#f59e0b',
          borderRadius: 6,
          yAxisID: 'y1'
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: { type: 'linear', position: 'left', beginAtZero: true, ticks: { callback: v => '₹' + v } },
        y1: { type: 'linear', position: 'right', beginAtZero: true, grid: { drawOnChartArea: false }, ticks: { precision: 0 } }
      }
    }
  });
</script>
@endif
@endsection


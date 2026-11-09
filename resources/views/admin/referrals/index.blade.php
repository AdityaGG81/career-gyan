@extends('admin.layout')

@section('title', 'Referral & Rewards Management')

@section('styles')
<style>
  .rewards-stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
  }

  .stat-widget {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 20px 24px;
    box-shadow: var(--admin-shadow);
    display: flex;
    align-items: center;
    gap: 18px;
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .stat-widget:hover {
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-hover);
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .stat-info .title {
    font-size: 12px;
    font-weight: 700;
    color: var(--admin-text-3);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
  }

  .stat-info .num {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: var(--admin-text-1);
    line-height: 1.1;
  }

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

  .filter-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 20px 24px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
  }

  .filter-form {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap: 14px;
    align-items: end;
  }

  @media(max-width: 992px) {
    .filter-form {
      grid-template-columns: 1fr;
    }
  }

  .badge-ref-status {
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-ref-status.completed { background: #dcfce7; color: #15803d; }
  .badge-ref-status.pending { background: #fef3c7; color: #b45309; }
  .badge-ref-status.rejected { background: #fee2e2; color: #b91c1c; }
</style>
@endsection

@section('content')
<div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
  <div>
    <h1 class="page-title"><i class="fa-solid fa-gift" style="color: #f59e0b;"></i> Referral & Rewards Management</h1>
    <p style="font-size: 14px; color: var(--admin-text-2); margin-top: 4px;">Monitor student referral networks, reward points, and automated test incentives.</p>
  </div>
  <div style="display: flex; gap: 12px;">
    <a href="{{ route('admin.referrals.export-csv', request()->query()) }}" class="btn-primary" style="background: #16a34a; color: #fff; padding: 10px 18px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
      <i class="fa-solid fa-file-excel"></i> Export CSV
    </a>
  </div>
</div>

{{-- Subnavigation Tabs --}}
<div class="admin-subnav">
  <a href="{{ route('admin.referrals.index') }}" class="active">
    <i class="fa-solid fa-table-list"></i> All Referrals & Overview
  </a>
  <a href="{{ route('admin.referrals.tree') }}">
    <i class="fa-solid fa-sitemap"></i> Referral Genealogy Tree
  </a>
  <a href="{{ route('admin.referrals.user-rewards') }}">
    <i class="fa-solid fa-user-gear"></i> Student Reward Management
  </a>
  <a href="{{ route('admin.referrals.reports') }}">
    <i class="fa-solid fa-chart-column"></i> Analytics & Reports
  </a>
</div>

{{-- Dynamic Summary Cards --}}
<div class="rewards-stat-grid">
  <div class="stat-widget">
    <div class="stat-icon" style="background: #e0f2fe; color: #0284c7;">
      <i class="fa-solid fa-users"></i>
    </div>
    <div class="stat-info">
      <div class="title">Total Users</div>
      <div class="num">{{ number_format($totalUsers) }}</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
      <i class="fa-solid fa-link"></i>
    </div>
    <div class="stat-info">
      <div class="title">Referral Links</div>
      <div class="num">{{ number_format($totalReferralLinks) }}</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
      <i class="fa-solid fa-circle-check"></i>
    </div>
    <div class="stat-info">
      <div class="title">Successful Referrals</div>
      <div class="num">{{ number_format($totalSuccessfulReferrals) }}</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
      <i class="fa-solid fa-clock"></i>
    </div>
    <div class="stat-info">
      <div class="title">Pending Referrals</div>
      <div class="num">{{ number_format($totalPendingReferrals) }}</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #fef3c7; color: #b45309;">
      <i class="fa-solid fa-coins"></i>
    </div>
    <div class="stat-info">
      <div class="title">Referral Pts Given</div>
      <div class="num">{{ number_format($totalReferralPointsDistributed) }}</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
      <i class="fa-solid fa-brain"></i>
    </div>
    <div class="stat-info">
      <div class="title">Aptitude Rewards</div>
      <div class="num">{{ number_format($totalAptitudeRewards) }} pts</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #fce7f3; color: #db2777;">
      <i class="fa-solid fa-chart-pie"></i>
    </div>
    <div class="stat-info">
      <div class="title">Analysis Rewards</div>
      <div class="num">{{ number_format($totalStudentAnalysisRewards) }} pts</div>
    </div>
  </div>

  <div class="stat-widget">
    <div class="stat-icon" style="background: #f0fdf4; color: #059669;">
      <i class="fa-solid fa-wallet"></i>
    </div>
    <div class="stat-info">
      <div class="title">Total Points Given</div>
      <div class="num">{{ number_format($totalPointsDistributed) }} pts</div>
    </div>
  </div>
</div>

{{-- Filters Card --}}
<div class="filter-card">
  <form method="GET" action="{{ route('admin.referrals.index') }}" class="filter-form">
    <div>
      <label style="font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase;">Search Referral</label>
      <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search by student, email, referral code or ID...">
    </div>

    <div>
      <label style="font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase;">Status</label>
      <select name="status" class="form-control">
        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Statuses</option>
        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
    </div>

    <div>
      <label style="font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase;">From Date</label>
      <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
    </div>

    <div>
      <label style="font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase;">To Date</label>
      <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
    </div>

    <div style="display: flex; gap: 8px;">
      <button type="submit" class="btn-primary" style="background: #18181b; color: #fff; padding: 10px 18px; border-radius: var(--admin-radius-md); font-weight: 700; cursor: pointer; border: none;">
        <i class="fa-solid fa-filter"></i> Filter
      </button>
      <a href="{{ route('admin.referrals.index') }}" style="background: #e4e4e7; color: var(--admin-text-1); padding: 10px 14px; border-radius: var(--admin-radius-md); font-weight: 600; text-decoration: none; font-size: 13px;">
        Reset
      </a>
    </div>
  </form>
</div>

{{-- All Referrals Table --}}
<div class="panel-card">
  <div class="panel-header">
    <h2><i class="fa-solid fa-list-check"></i> All Referral Records ({{ $referrals->total() }})</h2>
    <div style="font-size: 13px; color: var(--admin-text-3);">
      Showing page {{ $referrals->currentPage() }} of {{ $referrals->lastPage() }}
    </div>
  </div>

  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Referrer (Sponsor)</th>
          <th>Code Used</th>
          <th>Referred Student</th>
          <th>Registration Date</th>
          <th>Status</th>
          <th>Referrer Pts</th>
          <th>Referred Pts</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($referrals as $ref)
          <tr>
            <td style="font-weight: 700; color: var(--admin-text-3);">
              #{{ $ref->id }}
            </td>
            <td>
              @if($ref->referrer)
                <div style="font-weight: 700; color: var(--admin-text-1);">{{ $ref->referrer->name }}</div>
                <div style="font-size: 12px; color: var(--admin-text-3);">{{ $ref->referrer->email }} (ID: {{ $ref->referrer_id }})</div>
              @else
                <span style="color: var(--admin-text-3);">Deleted User ({{ $ref->referrer_id }})</span>
              @endif
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 800; background: #f4f4f5; padding: 3px 8px; border-radius: 6px;">
                {{ $ref->referral_code }}
              </span>
            </td>
            <td>
              @if($ref->referredUser)
                <div style="font-weight: 700; color: var(--admin-text-1);">{{ $ref->referredUser->name }}</div>
                <div style="font-size: 12px; color: var(--admin-text-3);">{{ $ref->referredUser->email }} (ID: {{ $ref->referred_user_id }})</div>
              @else
                <span style="color: var(--admin-text-3);">Deleted User ({{ $ref->referred_user_id }})</span>
              @endif
            </td>
            <td style="font-size: 13px;">
              {{ $ref->created_at ? $ref->created_at->format('d M Y, h:i A') : 'N/A' }}
            </td>
            <td>
              @if($ref->status === 'completed')
                <span class="badge-ref-status completed"><i class="fa-solid fa-circle-check"></i> Completed</span>
              @elseif($ref->status === 'pending')
                <span class="badge-ref-status pending"><i class="fa-solid fa-clock"></i> Pending</span>
              @else
                <span class="badge-ref-status rejected"><i class="fa-solid fa-circle-xmark"></i> Rejected</span>
              @endif
            </td>
            <td style="font-weight: 700; color: #16a34a;">
              +{{ $ref->referrer_points }} pts
            </td>
            <td style="font-weight: 700; color: #16a34a;">
              +{{ $ref->referred_user_points }} pts
            </td>
            <td>
              <a href="{{ route('admin.referrals.user-rewards', ['user_id' => $ref->referrer_id]) }}" title="View Referrer Rewards" style="color: #2563eb; font-size: 13px; font-weight: 600; text-decoration: none; margin-right: 8px;">
                <i class="fa-solid fa-eye"></i> Referrer
              </a>
              <a href="{{ route('admin.referrals.user-rewards', ['user_id' => $ref->referred_user_id]) }}" title="View Student Rewards" style="color: #059669; font-size: 13px; font-weight: 600; text-decoration: none;">
                <i class="fa-solid fa-user"></i> Student
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" style="text-align: center; padding: 48px; color: var(--admin-text-3);">
              <i class="fa-solid fa-inbox" style="font-size: 36px; margin-bottom: 12px; opacity: 0.5;"></i>
              <div>No referral records found matching your filters.</div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($referrals->hasPages())
    <div style="padding: 20px 24px; border-top: 1px solid var(--admin-border);">
      {{ $referrals->links() }}
    </div>
  @endif
</div>
@endsection


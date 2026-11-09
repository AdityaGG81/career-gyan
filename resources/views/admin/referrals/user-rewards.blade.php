@extends('admin.layout')

@section('title', 'Student Reward & Points Management')

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

  .user-overview-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 24px;
    margin-bottom: 32px;
  }

  @media(max-width: 992px) {
    .user-overview-grid {
      grid-template-columns: 1fr;
    }
  }

  .profile-stat-box {
    background: #f8fafc;
    border: 1px solid var(--admin-border);
    border-radius: 10px;
    padding: 14px 18px;
  }

  .profile-stat-box .title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--admin-text-3);
    letter-spacing: 0.05em;
    margin-bottom: 4px;
  }

  .profile-stat-box .val {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: var(--admin-text-1);
  }

  .points-val-badge {
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 14px;
  }
  .points-val-badge.plus { color: #16a34a; }
  .points-val-badge.minus { color: #dc2626; }
</style>
@endsection

@section('content')
<div class="page-header" style="margin-bottom: 24px;">
  <h1 class="page-title"><i class="fa-solid fa-user-gear" style="color: #6366f1;"></i> Student Reward & Points Management</h1>
  <p style="font-size: 14px; color: var(--admin-text-2); margin-top: 4px;">Search any registered student, view their complete referral metrics, points wallet, and perform manual ledger adjustments.</p>
</div>

{{-- Subnavigation Tabs --}}
<div class="admin-subnav">
  <a href="{{ route('admin.referrals.index') }}">
    <i class="fa-solid fa-table-list"></i> All Referrals & Overview
  </a>
  <a href="{{ route('admin.referrals.tree') }}">
    <i class="fa-solid fa-sitemap"></i> Referral Genealogy Tree
  </a>
  <a href="{{ route('admin.referrals.user-rewards') }}" class="active">
    <i class="fa-solid fa-user-gear"></i> Student Reward Management
  </a>
  <a href="{{ route('admin.referrals.reports') }}">
    <i class="fa-solid fa-chart-column"></i> Analytics & Reports
  </a>
</div>

{{-- Alert Messages --}}
@if(session('success'))
  <div class="admin-alert admin-alert-success">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
  </div>
@endif

{{-- Search Bar --}}
<div style="background: var(--admin-surface); border: 1px solid var(--admin-border); border-radius: var(--admin-radius-lg); padding: 18px 24px; margin-bottom: 28px; box-shadow: var(--admin-shadow);">
  <form method="GET" action="{{ route('admin.referrals.user-rewards') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 280px; position: relative;">
      <i class="fa-solid fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--admin-text-3);"></i>
      <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search by Student Name, Email, Referral Code, or User ID..." style="padding-left: 40px;">
    </div>
    <button type="submit" style="background: #18181b; color: #ffffff; padding: 10px 20px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px; border: none; cursor: pointer;">
      Search Student
    </button>
  </form>
</div>

@if($userDetails)
  @php
    $student = $userDetails['user'];
    $stats = $userDetails['stats'];
  @endphp

  <div class="user-overview-grid">
    {{-- Left Card: Student Profile & Referral Hierarchy Details --}}
    <div class="panel-card" style="padding: 28px;">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div style="width: 54px; height: 54px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800;">
            {{ strtoupper(substr($student->name, 0, 1)) }}
          </div>
          <div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 800; color: var(--admin-text-1); margin-bottom: 2px;">
              {{ $student->name }} <span style="font-size: 13px; font-weight: normal; color: var(--admin-text-3);">#{{ $student->id }}</span>
            </h2>
            <div style="font-size: 13.5px; color: var(--admin-text-2);">{{ $student->email }} &bull; {{ $student->phone ?? 'No phone' }}</div>
          </div>
        </div>

        <div style="text-align: right;">
          <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--admin-text-3); display: block; margin-bottom: 4px;">Referral Code</span>
          <span style="font-family: monospace; font-size: 16px; font-weight: 800; background: #eff6ff; color: #1d4ed8; padding: 4px 12px; border-radius: 6px; border: 1px solid #bfdbfe;">
            {{ $student->referral_code ?? 'None' }}
          </span>
        </div>
      </div>

      {{-- Metrics Grid --}}
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; margin-bottom: 24px;">
        <div class="profile-stat-box">
          <div class="title">Points Balance</div>
          <div class="val" style="color: #16a34a;">{{ number_format($student->points_balance) }} <span style="font-size: 13px;">PTS</span></div>
        </div>
        <div class="profile-stat-box">
          <div class="title">Total Earned</div>
          <div class="val">{{ number_format($stats['total_earned_points']) }}</div>
        </div>
        <div class="profile-stat-box">
          <div class="title">Direct Referrals</div>
          <div class="val" style="color: #2563eb;">{{ $userDetails['direct_referrals'] }}</div>
        </div>
        <div class="profile-stat-box">
          <div class="title">Chain Members</div>
          <div class="val" style="color: #d97706;">{{ $userDetails['chain_members'] }}</div>
        </div>
      </div>

      {{-- Hierarchy & Rewards Checklist --}}
      <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 12px; padding: 18px 20px;">
        <div style="margin-bottom: 12px; font-size: 13.5px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
          <div>
            <strong style="color: var(--admin-text-1);">Sponsor (Referred By):</strong>
            @if($student->referrer)
              <a href="{{ route('admin.referrals.user-rewards', ['user_id' => $student->referrer->id]) }}" style="color: #2563eb; font-weight: 700; margin-left: 6px; text-decoration: none;">
                {{ $student->referrer->name }} ({{ $student->referrer->email }}) &rarr;
              </a>
            @else
              <span style="color: var(--admin-text-3); margin-left: 6px;">Direct Registration (No sponsor)</span>
            @endif
          </div>
          <div>
            <strong style="color: var(--admin-text-1);">Milestone Badge:</strong>
            @if($student->current_badge)
              <span style="background: {{ $student->current_badge['badge_bg'] ?? '#fef3c7' }}; color: {{ $student->current_badge['badge_color'] ?? '#b45309' }}; font-weight: 800; padding: 4px 10px; border-radius: 99px; font-size: 12px; margin-left: 4px; display: inline-flex; align-items: center; gap: 4px;">
                <i class="{{ $student->current_badge['badge_icon'] ?? 'fa-solid fa-award' }}"></i> {{ $student->current_badge['badge_name'] }} (Tier {{ $student->current_badge['tier_level'] }})
              </span>
            @else
              <span style="color: var(--admin-text-3); font-size: 12px; margin-left: 4px;">Working toward Tier 1 ({{ number_format(1000 - ($student->points_balance % 1000)) }} pts needed)</span>
            @endif
          </div>
        </div>

        <div style="display: flex; gap: 20px; flex-wrap: wrap; font-size: 13px;">
          <div>
            <strong>Aptitude Reward:</strong>
            @if($stats['aptitude_claimed'])
              <span style="color: #16a34a; font-weight: 700; margin-left: 4px;"><i class="fa-solid fa-circle-check"></i> Awarded (+50 pts)</span>
            @else
              <span style="color: var(--admin-text-3); margin-left: 4px;"><i class="fa-solid fa-clock"></i> Not Yet Completed</span>
            @endif
          </div>
          <div>
            <strong>Student Analysis Reward:</strong>
            @if($stats['analysis_claimed'])
              <span style="color: #16a34a; font-weight: 700; margin-left: 4px;"><i class="fa-solid fa-circle-check"></i> Awarded (+50 pts)</span>
            @else
              <span style="color: var(--admin-text-3); margin-left: 4px;"><i class="fa-solid fa-clock"></i> Not Yet Completed</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- Right Card: Manual Points Adjustment Form --}}
    <div class="panel-card" style="padding: 28px;">
      <h3 style="font-family: 'Outfit', sans-serif; font-size: 17px; font-weight: 700; color: var(--admin-text-1); margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-sliders" style="color: #d97706;"></i> Adjust Points
      </h3>
      <p style="font-size: 13px; color: var(--admin-text-2); margin-bottom: 20px;">
        Manually credit or debit reward points for this student. All adjustments are permanently audited in the transaction ledger.
      </p>

      <form action="{{ route('admin.referrals.adjust-points') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $student->id }}">

        <div style="margin-bottom: 14px;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase; margin-bottom: 6px;">Action</label>
          <div style="display: flex; gap: 12px;">
            <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 600; cursor: pointer;">
              <input type="radio" name="action" value="add" checked> Add Points (+)
            </label>
            <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 600; cursor: pointer;">
              <input type="radio" name="action" value="deduct"> Deduct Points (-)
            </label>
          </div>
        </div>

        <div style="margin-bottom: 14px;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase; margin-bottom: 6px;">Points Amount</label>
          <input type="number" name="points" min="1" max="100000" class="form-control" placeholder="e.g. 50" required>
        </div>

        <div style="margin-bottom: 18px;">
          <label style="display: block; font-size: 12px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase; margin-bottom: 6px;">Reason / Admin Note</label>
          <textarea name="reason" rows="2" class="form-control" placeholder="e.g. Special campaign incentive / Contest winner" required></textarea>
        </div>

        <button type="submit" style="width: 100%; background: #18181b; color: #ffffff; padding: 11px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 14px; border: none; cursor: pointer;" onclick="return confirm('Are you sure you want to adjust points for {{ addslashes($student->name) }}?')">
          Submit Adjustment
        </button>
      </form>
    </div>
  </div>

  {{-- Complete Points Transaction Ledger for Student --}}
  <div class="panel-card">
    <div class="panel-header">
      <h2><i class="fa-solid fa-receipt"></i> Complete Points Transaction History ({{ $userDetails['transactions']->total() }})</h2>
    </div>

    <div style="overflow-x: auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Tx ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Points</th>
            <th>Reference</th>
            <th>Date & Time</th>
          </tr>
        </thead>
        <tbody>
          @forelse($userDetails['transactions'] as $tx)
            <tr>
              <td style="color: var(--admin-text-3); font-weight: 700;">#{{ $tx->id }}</td>
              <td style="font-weight: 700;">
                @if($tx->transaction_type === 'referral_bonus' || $tx->transaction_type === 'referred_signup')
                  <span style="color: #2563eb;"><i class="fa-solid fa-gift"></i> Referral Bonus</span>
                @elseif($tx->transaction_type === 'aptitude_test')
                  <span style="color: #7c3aed;"><i class="fa-solid fa-brain"></i> Aptitude Test</span>
                @elseif($tx->transaction_type === 'student_analysis')
                  <span style="color: #db2777;"><i class="fa-solid fa-chart-pie"></i> Student Analysis</span>
                @elseif($tx->transaction_type === 'admin_adjustment')
                  <span style="color: #d97706;"><i class="fa-solid fa-sliders"></i> Admin Adjustment</span>
                @else
                  <span>{{ ucwords(str_replace('_', ' ', $tx->transaction_type)) }}</span>
                @endif
              </td>
              <td>{{ $tx->description }}</td>
              <td>
                @if($tx->points > 0)
                  <span class="points-val-badge plus">+{{ $tx->points }}</span>
                @else
                  <span class="points-val-badge minus">{{ $tx->points }}</span>
                @endif
              </td>
              <td style="font-size: 13px; color: var(--admin-text-3);">
                {{ $tx->reference_type ? $tx->reference_type . ' #' . $tx->reference_id : 'N/A' }}
              </td>
              <td style="font-size: 13px; color: var(--admin-text-3);">
                {{ $tx->created_at ? $tx->created_at->format('d M Y, h:i A') : 'N/A' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 40px; color: var(--admin-text-3);">
                No points transactions recorded for this student yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($userDetails['transactions']->hasPages())
      <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
        {{ $userDetails['transactions']->links() }}
      </div>
    @endif
  </div>
@else
  <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: var(--admin-radius-lg); border: 1px solid var(--admin-border);">
    <i class="fa-solid fa-user-xmark" style="font-size: 40px; color: var(--admin-text-3); margin-bottom: 12px;"></i>
    <h3>No Student Found</h3>
    <p style="color: var(--admin-text-2); font-size: 14px;">Try searching with another name, email address, or user ID.</p>
  </div>
@endif
@endsection


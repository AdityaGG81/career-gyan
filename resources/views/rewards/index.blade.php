@extends('layouts.app')

@section('title', 'My Rewards & Points Wallet | CareerGyan')

@section('styles')
<style>
  :root {
    --rewards-gold: #f59e0b;
    --rewards-gold-light: #fef3c7;
    --rewards-gold-dark: #b45309;
    --rewards-green: #10b981;
    --rewards-green-light: #ecfdf5;
  }

  .rewards-page {
    background: #f8fafc;
    min-height: calc(100vh - 84px);
    padding: 40px 0 80px;
  }

  .rewards-hero-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #1d4ed8 100%);
    border-radius: var(--radius-xl);
    padding: 36px 40px;
    color: #ffffff;
    box-shadow: 0 10px 30px rgba(30, 58, 138, 0.2);
    position: relative;
    overflow: hidden;
    margin-bottom: 32px;
  }

  .rewards-hero-card::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 250px;
    height: 250px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .hero-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
    position: relative;
    z-index: 2;
  }

  .hero-balance-wrap {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .balance-coin-badge {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fbbf24, #d97706);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    animation: pulseGlow 2.5s infinite ease-in-out;
  }

  @keyframes pulseGlow {
    0%, 100% { transform: scale(1); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4); }
    50% { transform: scale(1.06); box-shadow: 0 6px 22px rgba(245, 158, 11, 0.6); }
  }

  .balance-label {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #93c5fd;
    margin-bottom: 4px;
  }

  .balance-amount {
    font-family: 'Sora', sans-serif;
    font-size: clamp(34px, 5vw, 44px);
    font-weight: 800;
    line-height: 1;
    color: #ffffff;
  }

  .balance-unit {
    font-size: 20px;
    font-weight: 600;
    color: #fde047;
    margin-left: 6px;
  }

  /* Overview 4-Stat Grid */
  .stats-overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
  }

  .stat-card-pill {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
  }

  .stat-card-pill:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
  }

  .stat-pill-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .stat-pill-info h4 {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 4px;
  }

  .stat-pill-info .val {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--text-1);
    line-height: 1.1;
  }

  /* Refer & Earn Modern Card */
  .refer-share-box {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 36px 40px;
    box-shadow: var(--shadow-md);
    margin-bottom: 36px;
    position: relative;
  }

  .refer-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fef3c7;
    color: #92400e;
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    padding: 6px 16px;
    border-radius: 99px;
    margin-bottom: 12px;
  }

  .refer-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(22px, 3.5vw, 28px);
    font-weight: 800;
    color: var(--text-1);
    margin-bottom: 8px;
  }

  .refer-subtitle {
    font-size: 15px;
    color: var(--text-2);
    margin-bottom: 28px;
    max-width: 680px;
  }

  .refer-inputs-grid {
    display: grid;
    grid-template-columns: 1fr 1.6fr;
    gap: 20px;
    margin-bottom: 28px;
  }

  @media(max-width: 800px) {
    .refer-inputs-grid {
      grid-template-columns: 1fr;
    }
    .refer-share-box {
      padding: 24px;
    }
  }

  .code-box-wrap label {
    display: block;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-2);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 8px;
  }

  .copy-input-group {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 6px 8px 6px 16px;
    transition: border-color var(--transition);
  }

  .copy-input-group:focus-within {
    border-color: var(--brand);
    background: #ffffff;
  }

  .copy-input-group input {
    border: none;
    background: transparent;
    font-family: inherit;
    font-size: 14.5px;
    font-weight: 700;
    color: var(--text-1);
    width: 100%;
    outline: none;
  }

  .btn-copy-action {
    background: #ffffff;
    border: 1px solid var(--border);
    color: var(--brand);
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    transition: all var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  }

  .btn-copy-action:hover {
    background: var(--brand);
    color: #ffffff;
    border-color: var(--brand);
  }

  .share-action-buttons {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  .btn-whatsapp-share {
    background: #25d366;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
    transition: transform var(--transition), box-shadow var(--transition);
  }

  .btn-whatsapp-share:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.4);
    color: #ffffff;
  }

  .btn-native-share {
    background: var(--brand);
    color: #ffffff;
    padding: 12px 22px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(26, 86, 219, 0.25);
    transition: transform var(--transition);
  }

  .btn-native-share:hover {
    transform: translateY(-2px);
  }

  /* How To Earn Points Grid */
  .earn-rules-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-bottom: 36px;
  }

  .earn-rule-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform var(--transition), border-color var(--transition);
    position: relative;
    overflow: hidden;
  }

  .earn-rule-card:hover {
    transform: translateY(-4px);
    border-color: var(--brand);
  }

  .earn-rule-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 14px;
  }

  .rule-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .rule-pts-badge {
    background: var(--rewards-gold-light);
    color: var(--rewards-gold-dark);
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 14px;
    padding: 4px 12px;
    border-radius: 99px;
  }

  .earn-rule-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 6px;
  }

  .earn-rule-card p {
    font-size: 13.5px;
    color: var(--text-2);
    margin-bottom: 18px;
    line-height: 1.5;
  }

  .earn-rule-action a, .earn-rule-action span {
    font-size: 13.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* Two Column Activity Section */
  .activity-columns-wrap {
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
  }

  .content-table-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .table-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }

  .table-card-header h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .filter-pills-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .filter-pill {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--text-2);
    background: #f1f5f9;
    text-decoration: none;
    transition: all var(--transition);
  }

  .filter-pill:hover {
    background: #e2e8f0;
    color: var(--text-1);
  }

  .filter-pill.active {
    background: var(--brand);
    color: #ffffff;
    font-weight: 700;
  }

  .custom-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
  }

  .custom-data-table th {
    background: #f8fafc;
    padding: 14px 20px;
    text-align: left;
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-3);
    border-bottom: 1px solid var(--border);
  }

  .custom-data-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    color: var(--text-1);
    vertical-align: middle;
  }

  .custom-data-table tr:last-child td {
    border-bottom: none;
  }

  .custom-data-table tr:hover td {
    background: #fafafa;
  }

  .badge-status {
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .badge-status.success {
    background: #dcfce7;
    color: #15803d;
  }

  .badge-status.pending {
    background: #fef3c7;
    color: #b45309;
  }

  .points-val-badge {
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 14px;
  }

  .points-val-badge.plus {
    color: #16a34a;
  }

  .points-val-badge.minus {
    color: #dc2626;
  }

  .empty-state-wrap {
    text-align: center;
    padding: 48px 24px;
    color: var(--text-3);
  }

  .empty-state-wrap i {
    font-size: 42px;
    margin-bottom: 14px;
    opacity: 0.5;
  }

  /* Toast Notification */
  .toast-copied {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #0f172a;
    color: #ffffff;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    z-index: 9999;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
  }

  .toast-copied.show {
    opacity: 1;
    transform: translateY(0);
  }

  /* Milestone Badges System */
  .badge-showcase-section {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: var(--shadow-sm);
  }

  .badge-showcase-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
  }

  .badge-current-rank-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: var(--radius-lg);
    padding: 24px 28px;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
  }

  .badge-current-rank-card::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 180px;
    height: 180px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.25) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .badge-progress-wrap {
    flex: 1;
    min-width: 260px;
  }

  .badge-progress-bar-bg {
    height: 10px;
    background: rgba(255,255,255,0.15);
    border-radius: 99px;
    overflow: hidden;
    margin: 8px 0;
  }

  .badge-progress-bar-fill {
    height: 100%;
    border-radius: 99px;
    background: linear-gradient(90deg, #f59e0b, #10b981);
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .badge-tier-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 18px;
  }

  .badge-tier-card {
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    text-align: center;
    position: relative;
    transition: all var(--transition);
  }

  .badge-tier-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }

  .badge-tier-card.unlocked {
    border-color: #fde047;
    background: linear-gradient(180deg, #ffffff 0%, #fefce8 100%);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.08);
  }

  .badge-tier-card.locked {
    opacity: 0.72;
    background: #fafafa;
  }

  .badge-tier-card.locked:hover {
    opacity: 0.95;
  }

  .badge-icon-disc {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin: 0 auto 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    transition: transform 0.3s;
  }

  .badge-tier-card:hover .badge-icon-disc {
    transform: scale(1.1) rotate(5deg);
  }
</style>
@endsection

@section('content')
<div class="rewards-page">
  <div class="container">

    {{-- Session Flash Alert --}}
    @if(session('success'))
      <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: var(--radius-md); margin-bottom: 24px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> {{ session('success') }}
      </div>
    @endif

    {{-- Hero Points Wallet Card --}}
    <div class="rewards-hero-card">
      <div class="hero-flex">
        <div>
          <span style="background: rgba(255,255,255,0.15); color: #fde047; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; padding: 6px 14px; border-radius: 99px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 12px;">
            <i class="fa-solid fa-wallet"></i> My Centralized Points Wallet
          </span>
          <div class="hero-balance-wrap">
            <div class="balance-coin-badge">
              <i class="fa-solid fa-coins"></i>
            </div>
            <div>
              <div class="balance-label">Total Available Points</div>
              <div class="balance-amount">{{ number_format($stats['available_points']) }}<span class="balance-unit">PTS</span></div>
            </div>
          </div>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
          <a href="#refer-section" class="btn-native-share" style="background: #ffffff; color: #1e3a8a; font-weight: 800;">
            <i class="fa-solid fa-gift" style="color: #f59e0b;"></i> Invite Friends
          </a>
          <a href="#earn-rules" style="background: rgba(255,255,255,0.12); color: #ffffff; padding: 12px 20px; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
            How to Earn
          </a>
        </div>
      </div>
    </div>

    {{-- Overview Stats Pill Grid --}}
    <div class="stats-overview-grid">
      <div class="stat-card-pill">
        <div class="stat-pill-icon" style="background: #fef3c7; color: #d97706;">
          <i class="fa-solid fa-award"></i>
        </div>
        <div class="stat-pill-info">
          <h4>Total Earned</h4>
          <div class="val">{{ number_format($stats['total_earned_points']) }}</div>
        </div>
      </div>

      <div class="stat-card-pill">
        <div class="stat-pill-icon" style="background: #dbeafe; color: #2563eb;">
          <i class="fa-solid fa-user-plus"></i>
        </div>
        <div class="stat-pill-info">
          <h4>Referral Points</h4>
          <div class="val">{{ number_format($stats['referral_points']) }}</div>
        </div>
      </div>

      <div class="stat-card-pill">
        <div class="stat-pill-icon" style="background: #ede9fe; color: #7c3aed;">
          <i class="fa-solid fa-brain"></i>
        </div>
        <div class="stat-pill-info">
          <h4>Test Rewards</h4>
          <div class="val">{{ number_format($stats['test_points']) }}</div>
        </div>
      </div>

      <div class="stat-card-pill">
        <div class="stat-pill-icon" style="background: #dcfce7; color: #16a34a;">
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-pill-info">
          <h4>Successful Referrals</h4>
          <div class="val">{{ number_format($stats['successful_referrals']) }}</div>
        </div>
      </div>
    </div>

    {{-- Milestone Badges & Ranks Showcase (Every 1,000 Points) --}}
    <div class="badge-showcase-section" id="badges-section">
      <div class="badge-showcase-header">
        <div>
          <span style="background: #fef3c7; color: #b45309; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 99px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 8px;">
            <i class="fa-solid fa-trophy"></i> MILESTONE BADGE SYSTEM
          </span>
          <h2 style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: var(--text-1); margin: 0 0 4px;">
            Milestone Badges & Student Ranks
          </h2>
          <p style="font-size: 14px; color: var(--text-2); margin: 0;">
            Earn a distinguished prestige badge for <strong>every 1,000 reward points</strong> accumulated across tests, referrals, and activities.
          </p>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
          <div style="background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: var(--radius-md); padding: 10px 18px; text-align: center;">
            <div style="font-size: 11px; font-weight: 700; color: #1e40af; text-transform: uppercase; letter-spacing: 0.05em;">Badges Earned</div>
            <div style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: #1d4ed8;">
              <i class="fa-solid fa-award"></i> {{ $badgeSummary['badges_earned_count'] ?? 0 }}
            </div>
          </div>
        </div>
      </div>

      {{-- Current Rank & Next Milestone Progress Bar --}}
      <div class="badge-current-rank-card">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div style="width: 58px; height: 58px; border-radius: 50%; background: {{ $badgeSummary['current_badge']['badge_gradient'] ?? 'linear-gradient(135deg, #475569, #334155)' }}; display: flex; align-items: center; justify-content: center; font-size: 26px; color: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <i class="{{ $badgeSummary['current_badge']['badge_icon'] ?? 'fa-solid fa-seedling' }}"></i>
          </div>
          <div>
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 2px;">
              Current Milestone Rank
            </div>
            <div style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: #ffffff;">
              {{ $badgeSummary['current_badge']['badge_name'] ?? 'Rookie Explorer' }}
              @if(!empty($badgeSummary['current_badge']))
                <span style="font-size: 12px; font-weight: 700; background: rgba(255,255,255,0.2); padding: 3px 8px; border-radius: 99px; margin-left: 6px;">
                  Tier {{ $badgeSummary['current_badge']['tier_level'] }}
                </span>
              @endif
            </div>
            <div style="font-size: 12.5px; color: #cbd5e1; margin-top: 2px;">
              {{ $badgeSummary['current_badge']['badge_description'] ?? 'Earn 1,000 points to unlock your first Bronze Explorer badge!' }}
            </div>
          </div>
        </div>

        <div class="badge-progress-wrap">
          <div style="display: flex; justify-content: space-between; font-size: 12.5px; font-weight: 700; color: #94a3b8;">
            <span>Next: <strong style="color: #fde047;">{{ $badgeSummary['next_badge']['badge_name'] ?? 'Bronze Explorer' }}</strong> ({{ number_format($badgeSummary['next_badge']['points_milestone'] ?? 1000) }} PTS)</span>
            <span style="color: #ffffff;">{{ $badgeSummary['points_in_tier'] ?? 0 }} / 1,000 PTS ({{ $badgeSummary['progress_percent'] ?? 0 }}%)</span>
          </div>
          <div class="badge-progress-bar-bg">
            <div class="badge-progress-bar-fill" style="width: {{ $badgeSummary['progress_percent'] ?? 0 }}%;"></div>
          </div>
          <div style="display: flex; justify-content: space-between; font-size: 11.5px; color: #94a3b8;">
            <span>{{ number_format($badgeSummary['points_needed'] ?? 1000) }} points needed to unlock next badge</span>
            <span>+1 Badge per 1,000 PTS</span>
          </div>
        </div>
      </div>

      {{-- Milestone Tiers Grid --}}
      <div class="badge-tier-grid">
        @foreach($badgeSummary['display_tiers'] ?? [] as $tier)
          <div class="badge-tier-card {{ $tier['is_unlocked'] ? 'unlocked' : 'locked' }}">
            @if($tier['is_unlocked'])
              <span style="position: absolute; top: 12px; right: 12px; background: #dcfce7; color: #15803d; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 99px; display: inline-flex; align-items: center; gap: 4px;">
                <i class="fa-solid fa-circle-check"></i> UNLOCKED
              </span>
            @elseif($tier['is_next'])
              <span style="position: absolute; top: 12px; right: 12px; background: #fef3c7; color: #b45309; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 99px; display: inline-flex; align-items: center; gap: 4px;">
                <i class="fa-solid fa-hourglass-half"></i> NEXT UP
              </span>
            @else
              <span style="position: absolute; top: 12px; right: 12px; background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 99px; display: inline-flex; align-items: center; gap: 4px;">
                <i class="fa-solid fa-lock"></i> LOCKED
              </span>
            @endif

            <div class="badge-icon-disc" style="background: {{ $tier['is_unlocked'] ? $tier['badge_gradient'] : '#e2e8f0' }}; color: {{ $tier['is_unlocked'] ? '#ffffff' : '#94a3b8' }};">
              <i class="{{ $tier['badge_icon'] }}"></i>
            </div>

            <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; color: {{ $tier['is_unlocked'] ? $tier['badge_color'] : '#64748b' }}; margin-bottom: 2px;">
              Tier {{ $tier['tier_level'] }} Milestone
            </div>
            <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 800; color: {{ $tier['is_unlocked'] ? 'var(--text-1)' : '#64748b' }}; margin-bottom: 4px;">
              {{ $tier['badge_name'] }}
            </h4>
            <div style="font-family: monospace; font-size: 13.5px; font-weight: 800; color: {{ $tier['is_unlocked'] ? '#b45309' : '#94a3b8' }}; margin-bottom: 8px;">
              {{ number_format($tier['points_milestone']) }} PTS
            </div>
            <p style="font-size: 12px; color: var(--text-3); line-height: 1.4; margin: 0;">
              {{ $tier['badge_description'] }}
            </p>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Refer & Earn Prominent Section --}}
    <div class="refer-share-box" id="refer-section">
      <span class="refer-badge-pill">
        <i class="fa-solid fa-sparkles"></i> Refer & Earn System
      </span>
      <h2 class="refer-title">Invite Friends & Earn 100 Points Together</h2>
      <p class="refer-subtitle">
        Your friends deserve to know about us! Invite them to explore careers, test their skills, and you both earn <strong>100 reward points</strong> when they join and verify their email!
      </p>

      <div class="refer-inputs-grid">
        <div class="code-box-wrap">
          <label><i class="fa-solid fa-ticket"></i> Your Referral Code</label>
          <div class="copy-input-group">
            <input type="text" id="refCodeInput" value="{{ $user->referral_code }}" readonly>
            <button type="button" class="btn-copy-action" onclick="copyToClipboard('refCodeInput', 'Referral Code copied!')">
              <i class="fa-solid fa-copy"></i> Copy
            </button>
          </div>
        </div>

        <div class="code-box-wrap">
          <label><i class="fa-solid fa-link"></i> Your Unique Referral Link</label>
          <div class="copy-input-group">
            <input type="text" id="refLinkInput" value="{{ $user->referral_link }}" readonly>
            <button type="button" class="btn-copy-action" onclick="copyToClipboard('refLinkInput', 'Referral Link copied!')">
              <i class="fa-solid fa-copy"></i> Copy Link
            </button>
          </div>
        </div>
      </div>

      <div class="share-action-buttons">
        <a href="{{ $user->whatsapp_share_url }}" target="_blank" rel="noopener noreferrer" class="btn-whatsapp-share">
          <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i> Share on WhatsApp
        </a>

        <button type="button" class="btn-native-share" onclick="triggerWebShare()">
          <i class="fa-solid fa-share-nodes"></i> Share via Apps
        </button>
      </div>
    </div>

    {{-- How to Earn Points Cards --}}
    <div style="margin-bottom: 24px;" id="earn-rules">
      <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-1); margin-bottom: 6px;">
        <i class="fa-solid fa-lightbulb" style="color: var(--rewards-gold);"></i> How to Earn Reward Points
      </h3>
      <p style="font-size: 14px; color: var(--text-2);">Complete activities across CareerGyan to earn points and climb the student ranks.</p>
    </div>

    <div class="earn-rules-grid">
      <!-- 1. Refer a Friend -->
      <div class="earn-rule-card">
        <div>
          <div class="earn-rule-top">
            <div class="rule-icon-box" style="background: #fef3c7; color: #b45309;">
              <i class="fa-solid fa-user-plus"></i>
            </div>
            <span class="rule-pts-badge">+100 PTS</span>
          </div>
          <h3>1. Refer a Friend</h3>
          <p>Share your unique referral link with classmates. When they register and verify their email, you get 100 points!</p>
        </div>
        <div class="earn-rule-action">
          <a href="#refer-section" style="color: var(--brand);">
            Invite Friends <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <!-- 2. Join Through Referral -->
      <div class="earn-rule-card">
        <div>
          <div class="earn-rule-top">
            <div class="rule-icon-box" style="background: #ecfdf5; color: #047857;">
              <i class="fa-solid fa-handshake"></i>
            </div>
            <span class="rule-pts-badge">+100 PTS</span>
          </div>
          <h3>2. Join Via Referral</h3>
          <p>Sign up using a friend's referral link. Both of you receive 100 reward points once your email is verified.</p>
        </div>
        <div class="earn-rule-action">
          @if($stats['referral_bonus_claimed'])
            <span style="color: #16a34a;"><i class="fa-solid fa-circle-check"></i> Claimed</span>
          @else
            <span style="color: var(--text-3);"><i class="fa-solid fa-lock"></i> Signup Bonus</span>
          @endif
        </div>
      </div>

      <!-- 3. Complete Aptitude Test -->
      <div class="earn-rule-card">
        <div>
          <div class="earn-rule-top">
            <div class="rule-icon-box" style="background: #eff6ff; color: #1d4ed8;">
              <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <span class="rule-pts-badge">+50 PTS</span>
          </div>
          <h3>3. Complete Aptitude Test</h3>
          <p>Take our comprehensive aptitude assessment to test your analytical, verbal, and spatial abilities. Earn 50 points on completion!</p>
        </div>
        <div class="earn-rule-action">
          @if($stats['aptitude_claimed'])
            <span style="color: #16a34a;"><i class="fa-solid fa-circle-check"></i> Completed & Claimed (+50 PTS)</span>
          @else
            <a href="{{ route('test.start') }}" style="color: var(--brand);">
              Take Test <i class="fa-solid fa-arrow-right"></i>
            </a>
          @endif
        </div>
      </div>

      <!-- 4. Complete Student Analysis Test -->
      <div class="earn-rule-card">
        <div>
          <div class="earn-rule-top">
            <div class="rule-icon-box" style="background: #fdf2f8; color: #be185d;">
              <i class="fa-solid fa-chart-pie"></i>
            </div>
            <span class="rule-pts-badge">+50 PTS</span>
          </div>
          <h3>4. Student Analysis Test</h3>
          <p>Fill out our scientific student self-analysis to discover your personality archetype and ideal career fields. Earn 50 points on completion!</p>
        </div>
        <div class="earn-rule-action">
          @if($stats['analysis_claimed'])
            <span style="color: #16a34a;"><i class="fa-solid fa-circle-check"></i> Completed & Claimed (+50 PTS)</span>
          @else
            <a href="{{ route('student-analysis.create') }}" style="color: var(--brand);">
              Start Assessment <i class="fa-solid fa-arrow-right"></i>
            </a>
          @endif
        </div>
      </div>
    </div>

    {{-- Activity & History Section --}}
    <div class="activity-columns-wrap">

      {{-- 1. Your Referral Activity Table --}}
      <div class="content-table-card">
        <div class="table-card-header">
          <h3>
            <i class="fa-solid fa-users-rays" style="color: var(--brand);"></i> Your Referral Activity
          </h3>
          <span style="font-size: 13px; font-weight: 700; color: var(--text-2);">
            Total Invited: {{ $referrals->count() }} | Completed: {{ $stats['successful_referrals'] }}
          </span>
        </div>

        <div style="overflow-x: auto;">
          <table class="custom-data-table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Date Joined</th>
                <th>Status</th>
                <th>Reward</th>
              </tr>
            </thead>
            <tbody>
              @forelse($referrals as $ref)
                <tr>
                  <td style="font-weight: 700;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                      <div style="width: 32px; height: 32px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #475569;">
                        {{ strtoupper(substr($ref->referredUser->name ?? 'Student', 0, 1)) }}
                      </div>
                      <span>{{ $ref->referredUser->name ?? 'Student' }}</span>
                    </div>
                  </td>
                  <td style="color: var(--text-2);">
                    {{ $ref->created_at->format('d M Y') }}
                  </td>
                  <td>
                    @if($ref->status === 'completed')
                      <span class="badge-status success"><i class="fa-solid fa-circle-check"></i> Successful</span>
                    @elseif($ref->status === 'pending')
                      <span class="badge-status pending"><i class="fa-solid fa-clock"></i> Pending Verification</span>
                    @else
                      <span class="badge-status" style="background: #fee2e2; color: #b91c1c;">Rejected</span>
                    @endif
                  </td>
                  <td>
                    @if($ref->status === 'completed')
                      <span class="points-val-badge plus">+100 PTS</span>
                    @else
                      <span style="color: var(--text-3); font-size: 13px; font-weight: 600;">Pending</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">
                    <div class="empty-state-wrap">
                      <i class="fa-solid fa-user-group"></i>
                      <div style="font-weight: 700; font-size: 15px; color: var(--text-2); margin-bottom: 4px;">No referrals yet!</div>
                      <div style="font-size: 13px;">Share your link above to invite friends and start earning 100 points per referral.</div>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- 2. Points Transaction Ledger Table --}}
      <div class="content-table-card" style="margin-top: 10px;">
        <div class="table-card-header">
          <h3>
            <i class="fa-solid fa-receipt" style="color: var(--rewards-gold);"></i> Points Transaction History
          </h3>

          <div class="filter-pills-bar">
            <a href="{{ route('rewards.index', ['filter' => 'all']) }}" class="filter-pill {{ $filter === 'all' ? 'active' : '' }}">All</a>
            <a href="{{ route('rewards.index', ['filter' => 'referral']) }}" class="filter-pill {{ $filter === 'referral' ? 'active' : '' }}">Referrals</a>
            <a href="{{ route('rewards.index', ['filter' => 'aptitude']) }}" class="filter-pill {{ $filter === 'aptitude' ? 'active' : '' }}">Aptitude Test</a>
            <a href="{{ route('rewards.index', ['filter' => 'student_analysis']) }}" class="filter-pill {{ $filter === 'student_analysis' ? 'active' : '' }}">Student Analysis</a>
          </div>
        </div>

        <div style="overflow-x: auto;">
          <table class="custom-data-table">
            <thead>
              <tr>
                <th>Activity</th>
                <th>Description</th>
                <th>Points</th>
                <th>Date & Time</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $tx)
                <tr>
                  <td style="font-weight: 700;">
                    @if($tx->transaction_type === 'referral_bonus' || $tx->transaction_type === 'referred_signup')
                      <span style="color: #2563eb;"><i class="fa-solid fa-gift"></i> Referral Reward</span>
                    @elseif($tx->transaction_type === 'aptitude_test')
                      <span style="color: #7c3aed;"><i class="fa-solid fa-brain"></i> Aptitude Test</span>
                    @elseif($tx->transaction_type === 'student_analysis')
                      <span style="color: #be185d;"><i class="fa-solid fa-chart-pie"></i> Student Analysis</span>
                    @elseif($tx->transaction_type === 'admin_adjustment')
                      <span style="color: #d97706;"><i class="fa-solid fa-sliders"></i> Admin Adjustment</span>
                    @else
                      <span>{{ ucwords(str_replace('_', ' ', $tx->transaction_type)) }}</span>
                    @endif
                  </td>
                  <td style="color: var(--text-2);">
                    {{ $tx->description }}
                  </td>
                  <td>
                    @if($tx->points > 0)
                      <span class="points-val-badge plus">+{{ $tx->points }}</span>
                    @else
                      <span class="points-val-badge minus">{{ $tx->points }}</span>
                    @endif
                  </td>
                  <td style="color: var(--text-3); font-size: 13px;">
                    {{ $tx->created_at->format('d M Y, h:i A') }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">
                    <div class="empty-state-wrap">
                      <i class="fa-solid fa-receipt"></i>
                      <div style="font-weight: 700; font-size: 15px; color: var(--text-2); margin-bottom: 4px;">No transactions yet</div>
                      <div style="font-size: 13px;">Complete an aptitude test or invite a friend to earn your first reward points!</div>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($transactions->hasPages())
          <div style="padding: 16px 24px; border-top: 1px solid var(--border);">
            {{ $transactions->links() }}
          </div>
        @endif
      </div>

    </div>

  </div>
</div>

{{-- Toast Notification --}}
<div id="copyToast" class="toast-copied">
  <i class="fa-solid fa-circle-check" style="color: #10b981;"></i>
  <span id="toastMsg">Copied to clipboard!</span>
</div>

<script>
  function copyToClipboard(elementId, message) {
    const input = document.getElementById(elementId);
    if (!input) return;

    input.select();
    input.setSelectionRange(0, 99999); // Mobile devices

    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(input.value).then(() => {
        showToast(message || 'Copied to clipboard!');
      }).catch(() => {
        document.execCommand('copy');
        showToast(message || 'Copied to clipboard!');
      });
    } else {
      document.execCommand('copy');
      showToast(message || 'Copied to clipboard!');
    }
  }

  function showToast(msg) {
    const toast = document.getElementById('copyToast');
    const toastMsg = document.getElementById('toastMsg');
    if (!toast || !toastMsg) return;

    toastMsg.innerText = msg;
    toast.classList.add('show');
    setTimeout(() => {
      toast.classList.remove('show');
    }, 2800);
  }

  function triggerWebShare() {
    const input = document.getElementById('refLinkInput');
    const url = input ? input.value : '{{ $user->referral_link }}';
    const text = "Hey! I found a useful platform for students where you can explore your career options, take aptitude tests and analyze your skills.\n\nJoin using my referral link and get 100 reward points!\n\n" + url;

    if (navigator.share) {
      navigator.share({
        title: 'Join CareerGyan',
        text: text
      }).catch((err) => {
        if (err.name !== 'AbortError') {
          copyToClipboard('refLinkInput', 'Referral link copied! Share it with your friends.');
        }
      });
    } else {
      copyToClipboard('refLinkInput', 'Referral link copied! Share it with your friends.');
    }
  }
</script>
@endsection


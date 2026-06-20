@extends('layouts.app')
@section('title', 'Leaderboard | CareerGyan Daily Quiz')

@section('styles')
<style>
  .lb-page { background: #f8fafc; min-height: 100vh; padding-bottom: 80px; }

  /* ── Hero ── */
  .lb-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 60%, #0f172a 100%);
    padding: 60px 0 80px;
    position: relative;
    overflow: hidden;
    text-align: center;
  }
  .lb-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 50% 100%, rgba(99,102,241,0.15) 0%, transparent 70%);
  }
  .lb-hero-inner { position: relative; z-index: 1; }
  .lb-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(32px, 5vw, 52px);
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
  }
  .lb-hero p { font-size: 16px; color: rgba(255,255,255,0.55); }

  /* ── Tabs ── */
  .lb-tabs {
    display: flex;
    gap: 6px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 5px;
    border-radius: 999px;
    width: fit-content;
    margin: 24px auto 0;
  }
  .lb-tab {
    padding: 9px 22px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    transition: all 0.2s;
  }
  .lb-tab:hover { color: rgba(255,255,255,0.85); }
  .lb-tab.active { background: #6366f1; color: #fff; box-shadow: 0 4px 14px rgba(99,102,241,0.4); }

  /* ── My rank banner ── */
  .my-rank-banner {
    background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(79,70,229,0.06));
    border: 1px solid rgba(99,102,241,0.25);
    border-radius: 16px;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 14px;
  }
  .my-rank-num {
    font-family: 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 800;
    color: #818cf8;
  }
  .my-rank-text { font-size: 14px; color: #64748b; }
  .my-rank-pts  { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: #fbbf24; margin-left: auto; }

  /* ── Podium ── */
  .podium-section { padding: 40px 0 0; }
  .podium-wrap {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 16px;
    margin-bottom: 48px;
  }
  .podium-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
  }
  .podium-avatar {
    width: 68px; height: 68px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #fff;
    position: relative;
    border: 3px solid;
    flex-shrink: 0;
  }
  .podium-item:nth-child(1) .podium-avatar { background: linear-gradient(135deg,#d1d5db,#9ca3af); border-color: #9ca3af; width: 60px; height: 60px; font-size: 18px; }
  .podium-item:nth-child(2) .podium-avatar { background: linear-gradient(135deg,#fbbf24,#f59e0b); border-color: #f59e0b; width: 76px; height: 76px; font-size: 24px; }
  .podium-item:nth-child(3) .podium-avatar { background: linear-gradient(135deg,#c2763a,#a16207); border-color: #c2763a; width: 60px; height: 60px; font-size: 18px; }
  .podium-crown {
    position: absolute;
    top: -18px;
    font-size: 20px;
  }
  .podium-name { font-weight: 700; font-size: 14px; color: #1e293b; text-align: center; max-width: 100px; }
  .podium-pts  { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 800; color: #6366f1; }
  .podium-base {
    border-radius: 12px 12px 0 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 22px;
    color: rgba(255,255,255,0.8);
    width: 90px;
  }
  .podium-item:nth-child(1) .podium-base { background: linear-gradient(180deg,#9ca3af,#6b7280); height: 70px; }
  .podium-item:nth-child(2) .podium-base { background: linear-gradient(180deg,#fbbf24,#d97706); height: 100px; }
  .podium-item:nth-child(3) .podium-base { background: linear-gradient(180deg,#c2763a,#92400e); height: 55px; }
  .podium-rank-num { font-size: 28px; }

  /* ── Leaderboard Table ── */
  .lb-table-wrap {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
  }
  .lb-table { width: 100%; border-collapse: collapse; }
  .lb-table th {
    padding: 14px 20px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }
  .lb-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
  }
  .lb-table tr:last-child td { border-bottom: none; }
  .lb-table tbody tr { transition: background 0.15s; }
  .lb-table tbody tr:hover { background: #f8fafc; }
  .lb-table tbody tr.is-me { background: linear-gradient(90deg, rgba(99,102,241,0.06), rgba(99,102,241,0.02)); }

  .rank-cell {
    width: 48px; height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 15px;
  }
  .rank-gold   { background: linear-gradient(135deg,#fbbf24,#f59e0b); color: #000; }
  .rank-silver { background: linear-gradient(135deg,#d1d5db,#9ca3af); color: #000; }
  .rank-bronze { background: linear-gradient(135deg,#c2763a,#a16207); color: #fff; }
  .rank-normal { background: #f1f5f9; color: #64748b; }

  .user-cell { display: flex; align-items: center; gap: 12px; }
  .user-avatar-lb {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 15px;
    color: #fff;
    flex-shrink: 0;
  }
  .user-name-lb { font-weight: 600; font-size: 15px; color: #1e293b; }
  .user-badges-lb { display: flex; gap: 4px; flex-wrap: wrap; margin-top: 2px; }
  .badge-mini { font-size: 14px; }

  .pts-cell { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 800; color: #4f46e5; }
  .streak-cell { display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 14px; color: #64748b; }

  .me-tag {
    display: inline-flex;
    align-items: center;
    background: #ede9fe;
    color: #6d28d9;
    font-size: 10px;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 999px;
    margin-left: 6px;
    letter-spacing: 0.05em;
  }

  @media (max-width: 640px) {
    .podium-wrap { gap: 8px; }
    .podium-base { width: 70px; }
    .lb-table th:nth-child(3),
    .lb-table td:nth-child(3) { display: none; }
  }
</style>
@endsection

@section('content')
<div class="lb-page">
  {{-- Hero --}}
  <div class="lb-hero">
    <div class="lb-hero-inner container">
      <h1>🏆 Leaderboard</h1>
      <p>See who's leading the daily quiz challenge on CareerGyan</p>

      <div class="lb-tabs">
        <a href="{{ route('daily-quiz.leaderboard', ['period' => 'all_time']) }}"
           class="lb-tab {{ $period === 'all_time' ? 'active' : '' }}">All Time</a>
        <a href="{{ route('daily-quiz.leaderboard', ['period' => 'weekly']) }}"
           class="lb-tab {{ $period === 'weekly' ? 'active' : '' }}">This Week</a>
        <a href="{{ route('daily-quiz.leaderboard', ['period' => 'monthly']) }}"
           class="lb-tab {{ $period === 'monthly' ? 'active' : '' }}">This Month</a>
      </div>
    </div>
  </div>

  <div class="container" style="padding-top: 40px;">

    {{-- My Rank Banner --}}
    @auth
    @if($period === 'all_time' && $myRank)
    <div class="my-rank-banner">
      <div class="my-rank-num">#{{ $myRank }}</div>
      <div>
        <div style="font-weight:700; color:#1e293b;">Your Rank</div>
        <div class="my-rank-text">{{ $myStat->total_points }} total points • {{ $myStat->current_streak }}-day streak</div>
      </div>
      <div class="my-rank-pts">{{ $myStat->total_points }} pts</div>
      <a href="{{ route('daily-quiz.my-stats') }}" style="font-size:13px; font-weight:600; color:#6366f1; text-decoration:none; margin-left:8px;">
        My Stats <i class="fa-solid fa-arrow-right" style="font-size:11px;"></i>
      </a>
    </div>
    @endif
    @endauth

    {{-- Podium (top 3) --}}
    @if($leaderboard->count() >= 3)
    <div class="podium-section">
      <div class="podium-wrap reveal">
        {{-- 2nd place --}}
        <div class="podium-item">
          <div class="podium-avatar">
            {{ strtoupper(substr($leaderboard[1]->user->name ?? $leaderboard[1]->user->first_name, 0, 1)) }}
          </div>
          <div class="podium-name">{{ $leaderboard[1]->user->name ?? ($leaderboard[1]->user->first_name . ' ' . $leaderboard[1]->user->last_name) }}</div>
          <div class="podium-pts">{{ number_format($leaderboard[1]->period_points) }} pts</div>
          <div class="podium-base"><span class="podium-rank-num">2</span></div>
        </div>
        {{-- 1st place --}}
        <div class="podium-item">
          <div class="podium-avatar">
            <span class="podium-crown">👑</span>
            {{ strtoupper(substr($leaderboard[0]->user->name ?? $leaderboard[0]->user->first_name, 0, 1)) }}
          </div>
          <div class="podium-name" style="font-size:16px;">{{ $leaderboard[0]->user->name ?? ($leaderboard[0]->user->first_name . ' ' . $leaderboard[0]->user->last_name) }}</div>
          <div class="podium-pts" style="font-size:18px;">{{ number_format($leaderboard[0]->period_points) }} pts</div>
          <div class="podium-base"><span class="podium-rank-num">1</span></div>
        </div>
        {{-- 3rd place --}}
        <div class="podium-item">
          <div class="podium-avatar">
            {{ strtoupper(substr($leaderboard[2]->user->name ?? $leaderboard[2]->user->first_name, 0, 1)) }}
          </div>
          <div class="podium-name">{{ $leaderboard[2]->user->name ?? ($leaderboard[2]->user->first_name . ' ' . $leaderboard[2]->user->last_name) }}</div>
          <div class="podium-pts">{{ number_format($leaderboard[2]->period_points) }} pts</div>
          <div class="podium-base"><span class="podium-rank-num">3</span></div>
        </div>
      </div>
    </div>
    @endif

    {{-- Full Table --}}
    @if($leaderboard->isNotEmpty())
    <div class="lb-table-wrap reveal">
      <table class="lb-table">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Player</th>
            <th>Streak</th>
            <th>Points</th>
          </tr>
        </thead>
        <tbody>
          @foreach($leaderboard as $i => $row)
            @php
              $isMe = Auth::check() && Auth::id() === $row->user->id;
              $rank = $i + 1;
              $rankClass = match($rank) { 1 => 'rank-gold', 2 => 'rank-silver', 3 => 'rank-bronze', default => 'rank-normal' };
              $displayName = $row->user->name ?? ($row->user->first_name . ' ' . $row->user->last_name);
            @endphp
            <tr class="{{ $isMe ? 'is-me' : '' }}">
              <td>
                <div class="rank-cell {{ $rankClass }}">{{ $rank }}</div>
              </td>
              <td>
                <div class="user-cell">
                  <div class="user-avatar-lb">{{ strtoupper(substr($displayName, 0, 1)) }}</div>
                  <div>
                    <div class="user-name-lb">
                      {{ $displayName }}
                      @if($isMe)<span class="me-tag">YOU</span>@endif
                    </div>
                    @if(!empty($row->badges))
                    <div class="user-badges-lb">
                      @foreach(array_slice($row->badges, 0, 5) as $badge)
                        @php $def = $allBadges[$badge] ?? null; @endphp
                        @if($def)<span class="badge-mini" title="{{ $def['label'] }}">{{ $def['emoji'] }}</span>@endif
                      @endforeach
                    </div>
                    @endif
                  </div>
                </div>
              </td>
              <td>
                <div class="streak-cell">
                  🔥 {{ $row->current_streak }}
                </div>
              </td>
              <td>
                <div class="pts-cell">{{ number_format($row->period_points) }}</div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
      <div style="text-align:center; padding: 60px 0; color: #94a3b8;">
        <p style="font-size:48px; margin-bottom:12px;">🏆</p>
        <p style="font-size:18px; font-weight:600; color:#64748b;">No scores yet for this period.</p>
        <p style="margin-top:8px;">Be the first — <a href="{{ route('daily-quiz.index') }}" style="color:#6366f1; font-weight:600;">take today's quiz!</a></p>
      </div>
    @endif

    <div style="text-align:center; margin-top: 32px;">
      <a href="{{ route('daily-quiz.index') }}" style="display:inline-flex; align-items:center; gap:8px; color:#6366f1; font-weight:700; text-decoration:none; font-size:15px;">
        <i class="fa-solid fa-arrow-left"></i> Back to Quiz Home
      </a>
    </div>

  </div>
</div>
@endsection

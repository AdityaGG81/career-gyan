@extends('layouts.app')
@section('title', 'My Quiz Stats | CareerGyan')

@section('styles')
<style>
  .stats-page { background: #f8fafc; min-height: 100vh; padding-bottom: 80px; }

  .stats-hero {
    background: linear-gradient(135deg, #0f172a 0%, #312e81 60%, #0f172a 100%);
    padding: 60px 0 100px;
    position: relative;
    overflow: hidden;
  }
  .stats-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 50% 80% at 80% 50%, rgba(99,102,241,0.2) 0%, transparent 70%);
  }
  .stats-hero-inner {
    position: relative; z-index: 1;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 40px;
    align-items: center;
  }

  .hero-greeting {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #818cf8;
    margin-bottom: 10px;
  }
  .hero-name {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800;
    color: #fff;
    margin-bottom: 8px;
  }
  .hero-sub { font-size: 15px; color: rgba(255,255,255,0.5); }

  .rank-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(251,191,36,0.15);
    border: 1px solid rgba(251,191,36,0.3);
    color: #fbbf24;
    padding: 8px 18px;
    border-radius: 999px;
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 800;
    margin-top: 16px;
    width: fit-content;
  }

  /* Cards pulled over hero */
  .stats-cards-wrap {
    margin-top: -60px;
    position: relative;
    z-index: 10;
    margin-bottom: 32px;
  }
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
  }
  .stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 22px 20px;
    text-align: center;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
  }
  .stat-card:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(0,0,0,0.1); }
  .stat-icon { font-size: 28px; margin-bottom: 10px; }
  .stat-val { font-family: 'Sora', sans-serif; font-size: 30px; font-weight: 800; color: #1e293b; line-height: 1; }
  .stat-lbl { font-size: 12px; color: #94a3b8; font-weight: 600; margin-top: 6px; text-transform: uppercase; letter-spacing: 0.05em; }

  /* Accuracy bar */
  .acc-bar-wrap { margin-top: 8px; height: 4px; background: #e2e8f0; border-radius: 99px; overflow: hidden; }
  .acc-bar { height: 100%; background: linear-gradient(90deg, #4ade80, #22c55e); border-radius: 99px; transition: width 1.5s ease; }

  /* Badges section */
  .badges-section-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .badges-grid-user {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
    margin-bottom: 40px;
  }
  .badge-card-user {
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    padding: 18px 14px;
    text-align: center;
    transition: all 0.2s;
  }
  .badge-card-user.earned { border-color: #6366f1; background: #f5f3ff; }
  .badge-card-user:not(.earned) { opacity: 0.45; filter: grayscale(0.5); }
  .badge-card-user:hover.earned { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(99,102,241,0.15); }
  .bcu-emoji { font-size: 28px; margin-bottom: 6px; display: block; }
  .bcu-name  { font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 2px; }
  .bcu-desc  { font-size: 11px; color: #94a3b8; line-height: 1.4; }
  .bcu-earned-tag {
    display: inline-block;
    background: #dcfce7; color: #166534;
    font-size: 10px; font-weight: 700;
    padding: 2px 8px; border-radius: 999px;
    margin-top: 4px;
  }

  /* History table */
  .history-wrap {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .history-header {
    padding: 20px 24px 16px;
    border-bottom: 1px solid #e2e8f0;
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
  }
  .history-table { width: 100%; border-collapse: collapse; }
  .history-table th {
    padding: 12px 20px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    background: #fafafa;
    border-bottom: 1px solid #e2e8f0;
  }
  .history-table td {
    padding: 14px 20px;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
  }
  .history-table tr:last-child td { border-bottom: none; }

  .result-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
  }
  .result-correct { background: #dcfce7; color: #166534; }
  .result-wrong   { background: #fee2e2; color: #991b1b; }
  .result-timeout { background: #fef3c7; color: #92400e; }

  .pts-earned { font-family: 'Sora', sans-serif; font-weight: 800; color: #6366f1; }

  @media (max-width: 640px) {
    .stats-hero-inner { grid-template-columns: 1fr; }
    .history-table th:nth-child(3),
    .history-table td:nth-child(3) { display: none; }
  }
</style>
@endsection

@section('content')
<div class="stats-page">

  {{-- Hero --}}
  <div class="stats-hero">
    <div class="container">
      <div class="stats-hero-inner">
        <div>
          <div class="hero-greeting">📊 Your Progress</div>
          <div class="hero-name">{{ Auth::user()->name ?? (Auth::user()->first_name . ' ' . Auth::user()->last_name) }}</div>
          <div class="hero-sub">Quiz performance overview</div>
          <div class="rank-pill">🏅 Global Rank #{{ $myRank }}</div>
        </div>
        <x-gyani state="idle" size="160" />
      </div>
    </div>
  </div>

  <div class="container">

    {{-- Stats Cards --}}
    <div class="stats-cards-wrap">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">⭐</div>
          <div class="stat-val">{{ number_format($stat->total_points) }}</div>
          <div class="stat-lbl">Total Points</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">📅</div>
          <div class="stat-val">{{ $stat->quizzes_taken }}</div>
          <div class="stat-lbl">Quizzes Taken</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🔥</div>
          <div class="stat-val">{{ $stat->current_streak }}</div>
          <div class="stat-lbl">Current Streak</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">💪</div>
          <div class="stat-val">{{ $stat->longest_streak }}</div>
          <div class="stat-lbl">Best Streak</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🎯</div>
          <div class="stat-val">{{ $stat->accuracy }}%</div>
          <div class="stat-lbl">Accuracy</div>
          <div class="acc-bar-wrap">
            <div class="acc-bar" style="width: {{ $stat->accuracy }}%;"></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">⚡</div>
          <div class="stat-val">{{ $stat->speed_bonuses }}</div>
          <div class="stat-lbl">Speed Bonuses</div>
        </div>
      </div>
    </div>

    {{-- Badges --}}
    <div class="badges-section-title">🎖️ My Badges</div>
    <div class="badges-grid-user">
      @foreach($allBadges as $key => $badge)
        @php $earned = in_array($key, $stat->badges ?? []); @endphp
        <div class="badge-card-user {{ $earned ? 'earned' : '' }}">
          <span class="bcu-emoji">{{ $badge['emoji'] }}</span>
          <div class="bcu-name">{{ $badge['label'] }}</div>
          <div class="bcu-desc">{{ $badge['desc'] }}</div>
          @if($earned)<span class="bcu-earned-tag">✅ Earned</span>@endif
        </div>
      @endforeach
    </div>

    {{-- Quiz History --}}
    <div class="history-wrap">
      <div class="history-header">📋 Recent Quiz History</div>
      @if($recentAttempts->isNotEmpty())
      <table class="history-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Result</th>
            <th>Time</th>
            <th>Points</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentAttempts as $attempt)
          <tr>
            <td style="font-weight:600; color:#1e293b;">{{ $attempt->attempted_at->format('d M Y') }}</td>
            <td>
              @if($attempt->is_correct)
                <span class="result-badge result-correct">✅ Correct</span>
              @elseif(!$attempt->selected_option)
                <span class="result-badge result-timeout">⏱ Timed Out</span>
              @else
                <span class="result-badge result-wrong">❌ Wrong</span>
              @endif
            </td>
            <td>{{ $attempt->time_taken_seconds }}s</td>
            <td><span class="pts-earned">+{{ $attempt->points_earned }}</span></td>
            <td>
              @if($attempt->question)
                <span style="font-size:13px; color:#64748b; font-weight:500;">{{ ucfirst($attempt->question->category) }}</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <div style="padding: 60px; text-align:center; color:#94a3b8;">
          <p style="font-size:40px; margin-bottom:12px;">🎯</p>
          <p style="font-size:16px; font-weight:600; color:#64748b;">No quiz attempts yet.</p>
          <a href="{{ route('daily-quiz.take') }}" style="margin-top:16px; display:inline-block; color:#6366f1; font-weight:700; text-decoration:none;">Take today's quiz →</a>
        </div>
      @endif
    </div>

    <div style="text-align:center; margin-top:32px; display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
      <a href="{{ route('daily-quiz.index') }}" style="display:inline-flex; align-items:center; gap:8px; color:#6366f1; font-weight:700; text-decoration:none; font-size:15px; background:#ede9fe; padding:12px 24px; border-radius:999px;">
        <i class="fa-solid fa-bolt"></i> Take Today's Quiz
      </a>
      <a href="{{ route('daily-quiz.leaderboard') }}" style="display:inline-flex; align-items:center; gap:8px; color:#475569; font-weight:700; text-decoration:none; font-size:15px; background:#f1f5f9; padding:12px 24px; border-radius:999px;">
        <i class="fa-solid fa-trophy"></i> View Leaderboard
      </a>
    </div>

  </div>
</div>
@endsection

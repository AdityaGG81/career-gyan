@extends('layouts.app')

@section('title', 'Daily Career Quiz | CareerGyan')

@section('styles')
<style>
  /* ── Quiz Landing Hero ── */
  .quiz-hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #0f172a 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
  }

  .quiz-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 50% at 20% 50%, rgba(99,102,241,0.18) 0%, transparent 70%),
      radial-gradient(ellipse 50% 60% at 80% 40%, rgba(59,130,246,0.12) 0%, transparent 70%);
  }

  /* Animated grid lines */
  .quiz-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(99,102,241,0.06) 1px, transparent 1px),
      linear-gradient(90deg, rgba(99,102,241,0.06) 1px, transparent 1px);
    background-size: 60px 60px;
    animation: gridScroll 20s linear infinite;
  }

  @keyframes gridScroll {
    0%   { background-position: 0 0; }
    100% { background-position: 60px 60px; }
  }

  .hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1160px;
    margin: 0 auto;
    padding: 60px 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
  }

  .hero-left { display: flex; flex-direction: column; gap: 28px; }

  .quiz-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(99,102,241,0.2);
    border: 1px solid rgba(99,102,241,0.4);
    color: #a5b4fc;
    padding: 8px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.06em;
    width: fit-content;
    backdrop-filter: blur(10px);
  }

  .quiz-badge .dot {
    width: 8px; height: 8px;
    background: #22c55e;
    border-radius: 50%;
    animation: pulse 1.5s ease-in-out infinite;
  }

  @keyframes pulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.5); }
    50%      { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
  }

  .hero-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(36px, 5vw, 58px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
    letter-spacing: -0.02em;
  }

  .hero-title .highlight {
    background: linear-gradient(135deg, #818cf8, #60a5fa, #34d399);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .hero-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.65);
    line-height: 1.7;
    max-width: 480px;
  }

  /* Info chips */
  .quiz-meta-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .meta-chip {
    display: flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.8);
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    backdrop-filter: blur(8px);
  }

  .meta-chip i { color: #fbbf24; }

  /* Streak badge */
  .streak-display {
    display: flex;
    align-items: center;
    gap: 14px;
    background: rgba(251,191,36,0.1);
    border: 1px solid rgba(251,191,36,0.3);
    padding: 16px 22px;
    border-radius: 16px;
    width: fit-content;
  }

  .streak-icon { font-size: 32px; }

  .streak-text .streak-num {
    font-family: 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: #fbbf24;
  }

  .streak-text .streak-label {
    font-size: 12px;
    color: rgba(255,255,255,0.5);
    display: block;
  }

  /* CTA Buttons */
  .hero-ctas { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }

  .btn-quiz-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    padding: 16px 32px;
    border-radius: 999px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(.22,.68,0,1);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    position: relative;
    overflow: hidden;
  }

  .btn-quiz-primary::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
    border-radius: inherit;
  }

  .btn-quiz-primary:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 12px 35px rgba(99,102,241,0.5);
    color: #fff;
  }

  .btn-quiz-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.75);
    font-size: 14px;
    font-weight: 600;
    padding: 14px 24px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.2);
    text-decoration: none;
    transition: all 0.2s;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(8px);
  }

  .btn-quiz-secondary:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
    border-color: rgba(255,255,255,0.35);
  }

  /* Already taken state */
  .already-taken-card {
    background: rgba(34,197,94,0.1);
    border: 1px solid rgba(34,197,94,0.3);
    border-radius: 20px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .taken-icon {
    width: 56px; height: 56px;
    background: rgba(34,197,94,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
  }

  .taken-text h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #4ade80;
    margin-bottom: 4px;
  }

  .taken-text p { font-size: 14px; color: rgba(255,255,255,0.55); }

  /* Countdown */
  .countdown-wrap {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 20px 24px;
    width: fit-content;
  }

  .countdown-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.4);
    margin-bottom: 10px;
  }

  .countdown-digits {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .countdown-unit {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
  }

  .countdown-num {
    font-family: 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    background: rgba(255,255,255,0.08);
    border-radius: 10px;
    padding: 8px 14px;
    min-width: 52px;
    text-align: center;
  }

  .countdown-lbl {
    font-size: 10px;
    color: rgba(255,255,255,0.35);
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  .countdown-sep {
    font-size: 24px;
    color: rgba(255,255,255,0.3);
    font-weight: 700;
    margin-bottom: 16px;
  }

  /* ── Right Side ── */
  .hero-right {
    display: flex;
    flex-direction: column;
    gap: 24px;
    align-items: flex-end;
  }

  .gyani-float-wrap {
    display: flex;
    justify-content: center;
    filter: drop-shadow(0 20px 40px rgba(99,102,241,0.3));
  }

  /* ── Today's Quiz Card ── */
  .todays-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 20px;
    padding: 24px;
    backdrop-filter: blur(12px);
    width: 100%;
    max-width: 380px;
  }

  .todays-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.4);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .todays-label::before {
    content: '';
    width: 6px; height: 6px;
    background: #22c55e;
    border-radius: 50%;
    animation: pulse 1.5s ease-in-out infinite;
  }

  .quiz-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .cat-general      { background: rgba(99,102,241,0.2); color: #a5b4fc; }
  .cat-engineering  { background: rgba(251,191,36,0.2); color: #fcd34d; }
  .cat-science      { background: rgba(34,197,94,0.2);  color: #4ade80; }
  .cat-arts         { background: rgba(244,63,94,0.2);  color: #fb7185; }
  .cat-commerce     { background: rgba(249,115,22,0.2); color: #fb923c; }
  .cat-technology   { background: rgba(59,130,246,0.2); color: #60a5fa; }

  .quiz-diff-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    margin-left: 6px;
  }

  .diff-easy   { background: rgba(34,197,94,0.15);  color: #4ade80; }
  .diff-medium { background: rgba(251,191,36,0.15); color: #fcd34d; }
  .diff-hard   { background: rgba(239,68,68,0.15);  color: #f87171; }

  .todays-points {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #fbbf24;
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .todays-points span { font-size: 14px; color: rgba(255,255,255,0.4); font-weight: 400; font-family: 'DM Sans', sans-serif; }

  /* ── Mini Leaderboard ── */
  .mini-lb {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 20px 24px;
    width: 100%;
    max-width: 380px;
    backdrop-filter: blur(12px);
  }

  .mini-lb-title {
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: rgba(255,255,255,0.7);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .mini-lb-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  .mini-lb-row:last-child { border-bottom: none; }

  .lb-rank {
    width: 28px; height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0;
  }

  .rank-1 { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; }
  .rank-2 { background: linear-gradient(135deg, #d1d5db, #9ca3af); color: #000; }
  .rank-3 { background: linear-gradient(135deg, #c2763a, #a16207); color: #fff; }

  .lb-name { flex: 1; font-size: 14px; font-weight: 600; color: rgba(255,255,255,0.85); }
  .lb-pts  { font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800; color: #fbbf24; }

  /* ── No quiz today ── */
  .no-quiz-card {
    background: rgba(251,191,36,0.08);
    border: 1px solid rgba(251,191,36,0.2);
    border-radius: 20px;
    padding: 28px;
    text-align: center;
  }

  .no-quiz-card p { color: rgba(255,255,255,0.55); font-size: 15px; line-height: 1.6; }

  /* ── Points System Section ── */
  .points-section {
    background: #f8fafc;
    padding: 80px 0;
  }

  .points-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 40px;
  }

  .point-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }

  .point-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    border-color: #6366f1;
  }

  .point-emoji { font-size: 36px; margin-bottom: 12px; display: block; }
  .point-value { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; color: #4f46e5; margin-bottom: 6px; }
  .point-label { font-size: 14px; color: #64748b; font-weight: 500; }

  /* ── Badges Section ── */
  .badges-section { padding: 80px 0; background: #fff; }

  .badges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
    margin-top: 40px;
  }

  .badge-card {
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 20px;
    text-align: center;
    transition: all 0.2s;
  }

  .badge-card:hover { border-color: #6366f1; background: #f5f3ff; }
  .badge-emoji { font-size: 32px; margin-bottom: 8px; display: block; }
  .badge-name  { font-weight: 700; font-size: 14px; color: #1e293b; margin-bottom: 4px; }
  .badge-desc  { font-size: 12px; color: #94a3b8; }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .hero-content { grid-template-columns: 1fr; gap: 32px; text-align: center; padding: 40px 16px 60px; }
    .hero-right { align-items: center; }
    .hero-ctas { justify-content: center; }
    .quiz-meta-chips { justify-content: center; }
    .streak-display { margin: 0 auto; }
    .todays-card, .mini-lb { max-width: 100%; }
    .countdown-wrap { margin: 0 auto; }
    .already-taken-card { flex-direction: column; text-align: center; }
  }
</style>
@endsection

@section('content')

{{-- ── HERO SECTION ── --}}
<section class="quiz-hero">
  <div class="hero-content">

    {{-- LEFT SIDE --}}
    <div class="hero-left">
      <div>
        <div class="quiz-badge">
          <span class="dot"></span>
          🎯 DAILY CHALLENGE — {{ now()->format('l, d M Y') }}
        </div>
      </div>

      <h1 class="hero-title">
        Level Up Your<br>
        <span class="highlight">Career Knowledge</span><br>
        Daily
      </h1>

      <p class="hero-desc">
        10 daily questions. 30 seconds each. Infinite learning. Take today's career quiz, earn points, climb the leaderboard and unlock exclusive badges!
      </p>

      {{-- Quiz info chips --}}
      <div class="quiz-meta-chips">
        @if($question)
          <div class="meta-chip">
            <i class="fa-solid fa-{{ $question->category_icon }}"></i>
            {{ ucfirst($question->category) }}
          </div>
          <div class="meta-chip">
            <i class="fa-solid fa-star"></i>
            {{ $question->points }}+ Points
          </div>
        @endif
        <div class="meta-chip">
          <i class="fa-solid fa-clock"></i>
          30 Seconds
        </div>
        <div class="meta-chip">
          <i class="fa-solid fa-fire"></i>
          Daily Streak
        </div>
      </div>

      {{-- Streak display for logged-in users --}}
      @auth
        @if($userStat && $userStat->current_streak > 0)
          <div class="streak-display">
            <span class="streak-icon">🔥</span>
            <div class="streak-text">
              <div class="streak-num">{{ $userStat->current_streak }}-Day Streak!</div>
              <span class="streak-label">Keep it going — don't break it!</span>
            </div>
          </div>
        @endif
      @endauth

      {{-- CTA Area --}}
      @if($alreadyTaken)
        <div class="already-taken-card" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3);">
          <div class="taken-icon">✅</div>
          <div class="taken-text">
            <h3>Daily Quiz Completed!</h3>
            <p>You solved all <strong style="color:#4ade80;">{{ $completedAttemptsCount }}</strong> questions today and earned <strong style="color:#fbbf24;">{{ $totalPointsEarnedToday }} pts</strong>!</p>
          </div>
        </div>
        <div class="hero-ctas">
          <a href="{{ route('daily-quiz.result', ['date' => now()->toDateString()]) }}" class="btn-quiz-primary">
            <i class="fa-solid fa-eye"></i> View Last Result
          </a>
          <a href="{{ route('daily-quiz.leaderboard') }}" class="btn-quiz-secondary">
            <i class="fa-solid fa-trophy"></i> Leaderboard
          </a>
        </div>
        @if($secondsUntilNext > 0)
          <div class="countdown-wrap">
            <div class="countdown-label">Next quiz in</div>
            <div class="countdown-digits">
              <div class="countdown-unit">
                <div class="countdown-num" id="cd-hours">00</div>
                <div class="countdown-lbl">Hours</div>
              </div>
              <div class="countdown-sep">:</div>
              <div class="countdown-unit">
                <div class="countdown-num" id="cd-mins">00</div>
                <div class="countdown-lbl">Mins</div>
              </div>
              <div class="countdown-sep">:</div>
              <div class="countdown-unit">
                <div class="countdown-num" id="cd-secs">00</div>
                <div class="countdown-lbl">Secs</div>
              </div>
            </div>
          </div>
        @endif

      @elseif($question)
        @if($completedAttemptsCount > 0)
          <div class="already-taken-card" style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3);">
            <div class="taken-icon" style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc;">✍️</div>
            <div class="taken-text">
              <h3 style="color: #a5b4fc;">Quiz In Progress!</h3>
              <p>Completed <strong style="color:#a5b4fc;">{{ $completedAttemptsCount }} of {{ min(10, $totalQuestionsCount) }}</strong> questions. Score: <strong style="color:#fbbf24;">{{ $totalPointsEarnedToday }} pts</strong></p>
            </div>
          </div>
        @endif
        <div class="hero-ctas">
          @auth
            <a href="{{ route('daily-quiz.take') }}" class="btn-quiz-primary">
              <i class="fa-solid fa-bolt"></i> {{ $completedAttemptsCount > 0 ? "Continue Today's Quiz" : "Take Today's Quiz" }}
            </a>
          @else
            <a href="{{ route('login') }}" class="btn-quiz-primary">
              <i class="fa-solid fa-bolt"></i> Sign in to Play
            </a>
          @endauth
          <a href="{{ route('daily-quiz.leaderboard') }}" class="btn-quiz-secondary">
            <i class="fa-solid fa-trophy"></i> Leaderboard
          </a>
        </div>

      @else
        <div class="no-quiz-card">
          <p>🌙 No quiz scheduled for today yet.<br>Check back soon — the admin posts daily quizzes!</p>
        </div>
        <div class="hero-ctas">
          <a href="{{ route('daily-quiz.leaderboard') }}" class="btn-quiz-secondary">
            <i class="fa-solid fa-trophy"></i> View Leaderboard
          </a>
        </div>
      @endif

    </div>

    {{-- RIGHT SIDE --}}
    <div class="hero-right">

      {{-- Gyani Mascot --}}
      <div class="gyani-float-wrap">
        <x-gyani :state="$alreadyTaken ? 'happy' : 'idle'" size="220" />
      </div>

      {{-- Today's Quiz Card --}}
      @if($question)
      <div class="todays-card">
        <div class="todays-label">Today's Quiz</div>
        <div>
          <span class="quiz-category-pill cat-{{ $question->category }}">
            <i class="fa-solid fa-{{ $question->category_icon }}"></i>
            {{ ucfirst($question->category) }}
          </span>
          <span class="quiz-diff-badge diff-{{ $question->difficulty }}">
            {{ ucfirst($question->difficulty) }}
          </span>
        </div>
        @if(!$alreadyTaken)
          <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 10px; font-style: italic;">
            🤫 Question hidden — take the quiz to reveal it!
          </p>
        @else
          <p style="color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 10px; line-height: 1.5;">
            {{ Str::limit($question->question_text, 80) }}
          </p>
        @endif
        <div class="todays-points">
          ⚡ {{ $question->points }} pts <span>base + speed bonus available</span>
        </div>
      </div>
      @endif

      {{-- Mini Leaderboard --}}
      @if($topUsers->isNotEmpty())
      <div class="mini-lb">
        <div class="mini-lb-title">
          <i class="fa-solid fa-trophy" style="color: #fbbf24;"></i>
          Top Scorers
        </div>
        @foreach($topUsers as $i => $top)
          @if($top->user)
          <div class="mini-lb-row">
            <div class="lb-rank rank-{{ $i + 1 }}">{{ $i + 1 }}</div>
            <div class="lb-name">{{ $top->user->name ?? ($top->user->first_name . ' ' . $top->user->last_name) }}</div>
            <div class="lb-pts">{{ number_format($top->total_points) }} pts</div>
          </div>
          @endif
        @endforeach
        <div style="margin-top: 14px; text-align: center;">
          <a href="{{ route('daily-quiz.leaderboard') }}" style="font-size: 13px; color: #818cf8; font-weight: 600; text-decoration: none;">
            View Full Leaderboard <i class="fa-solid fa-arrow-right" style="font-size: 11px;"></i>
          </a>
        </div>
      </div>
      @endif

    </div>
  </div>
</section>

{{-- ── POINTS SYSTEM SECTION ── --}}
<section class="points-section">
  <div class="container">
    <div class="section-label"><i class="fa-solid fa-star"></i> Points System</div>
    <h2 class="section-title">How You Earn Points</h2>
    <p class="section-sub">Every correct answer counts — plus bonuses for speed and consistency!</p>

    <div class="points-grid">
      <div class="point-card">
        <span class="point-emoji">✅</span>
        <div class="point-value">+10</div>
        <div class="point-label">Correct Answer</div>
      </div>
      <div class="point-card">
        <span class="point-emoji">⚡</span>
        <div class="point-value">+5</div>
        <div class="point-label">Speed Bonus (under 10s)</div>
      </div>
      <div class="point-card">
        <span class="point-emoji">🔥</span>
        <div class="point-value">+2×</div>
        <div class="point-label">Daily Streak Multiplier</div>
      </div>
      <div class="point-card">
        <span class="point-emoji">🏆</span>
        <div class="point-value">Top 10</div>
        <div class="point-label">Champion Badge Unlocked</div>
      </div>
    </div>
  </div>
</section>

{{-- ── BADGES SECTION ── --}}
<section class="badges-section">
  <div class="container">
    <div class="section-label"><i class="fa-solid fa-medal"></i> Badges & Rewards</div>
    <h2 class="section-title">Unlock Achievement Badges</h2>
    <p class="section-sub">Earn exclusive badges by completing quizzes, building streaks, and climbing the leaderboard.</p>

    <div class="badges-grid">
      @foreach(\App\Models\UserQuizStat::allBadgeDefinitions() as $key => $badge)
      <div class="badge-card">
        <span class="badge-emoji">{{ $badge['emoji'] }}</span>
        <div class="badge-name">{{ $badge['label'] }}</div>
        <div class="badge-desc">{{ $badge['desc'] }}</div>
      </div>
      @endforeach
    </div>

    @guest
    <div style="text-align: center; margin-top: 48px;">
      <a href="{{ route('signup') }}" class="btn-quiz-primary" style="display: inline-flex; text-decoration: none; background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; padding: 14px 32px; border-radius: 999px; font-weight: 700; align-items: center; gap: 8px; box-shadow: 0 8px 25px rgba(99,102,241,0.3);">
        <i class="fa-solid fa-user-plus"></i> Join & Start Earning
      </a>
    </div>
    @endguest
  </div>
</section>

@endsection

@section('scripts')
<script>
  // Countdown timer
  let remaining = {{ $secondsUntilNext ?? 0 }};
  const hoursEl = document.getElementById('cd-hours');
  const minsEl  = document.getElementById('cd-mins');
  const secsEl  = document.getElementById('cd-secs');

  if (remaining > 0 && hoursEl) {
    function updateCountdown() {
      const h = Math.floor(remaining / 3600);
      const m = Math.floor((remaining % 3600) / 60);
      const s = remaining % 60;
      hoursEl.textContent = String(h).padStart(2, '0');
      minsEl.textContent  = String(m).padStart(2, '0');
      secsEl.textContent  = String(s).padStart(2, '0');
      if (remaining > 0) {
        remaining--;
        setTimeout(updateCountdown, 1000);
      }
    }
    updateCountdown();
  }
</script>
@endsection

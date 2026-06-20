@extends('layouts.app')

@section('title', 'Quiz Result | CareerGyan')

@section('styles')
<style>
  .result-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
  }

  /* Confetti canvas */
  #confettiCanvas {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    pointer-events: none;
    z-index: 0;
  }

  .result-content {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    max-width: 1000px;
    width: 100%;
    align-items: start;
  }

  /* ── Left: Mascot + Message ── */
  .result-mascot-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 24px;
  }

  .result-mascot-wrap {
    filter: drop-shadow(0 20px 40px rgba(99,102,241,0.35));
    animation: mascotEntrance 0.8s cubic-bezier(.22,.68,0,1) forwards;
  }

  @keyframes mascotEntrance {
    from { transform: translateY(40px) scale(0.8); opacity: 0; }
    to   { transform: translateY(0) scale(1); opacity: 1; }
  }

  .result-verdict {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 5vw, 42px);
    font-weight: 800;
    line-height: 1.15;
    animation: fadeUpIn 0.7s 0.3s ease forwards;
    opacity: 0;
  }

  .verdict-correct { color: #4ade80; }
  .verdict-wrong   { color: #f87171; }
  .verdict-timeout { color: #fbbf24; }

  .result-message {
    font-size: 16px;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    max-width: 340px;
    animation: fadeUpIn 0.7s 0.5s ease forwards;
    opacity: 0;
    font-style: italic;
  }

  @keyframes fadeUpIn {
    from { transform: translateY(20px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
  }

  /* CTA buttons */
  .result-ctas {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    max-width: 300px;
    animation: fadeUpIn 0.7s 0.8s ease forwards;
    opacity: 0;
  }

  .btn-result {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 24px;
    border-radius: 999px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    font-family: inherit;
  }

  .btn-result-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    box-shadow: 0 8px 20px rgba(99,102,241,0.35);
  }
  .btn-result-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99,102,241,0.45); color: #fff; }

  .btn-result-outline {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.8);
  }
  .btn-result-outline:hover { background: rgba(255,255,255,0.1); color: #fff; }

  /* ── Right: Score Panel ── */
  .result-panel-col {
    display: flex;
    flex-direction: column;
    gap: 20px;
    animation: slideInRight 0.8s 0.2s cubic-bezier(.22,.68,0,1) forwards;
    opacity: 0;
  }

  @keyframes slideInRight {
    from { transform: translateX(40px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
  }

  .panel-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 24px;
    backdrop-filter: blur(12px);
  }

  /* Points card */
  .points-earned-card {
    background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(79,70,229,0.1));
    border: 1px solid rgba(99,102,241,0.35);
  }

  .points-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.45);
    margin-bottom: 12px;
  }

  .points-big {
    font-family: 'Sora', sans-serif;
    font-size: 56px;
    font-weight: 800;
    color: #fbbf24;
    line-height: 1;
    display: flex;
    align-items: flex-end;
    gap: 8px;
  }

  .points-big .pts-label {
    font-size: 20px;
    color: rgba(255,255,255,0.4);
    font-weight: 500;
    padding-bottom: 8px;
    font-family: 'DM Sans', sans-serif;
  }

  .points-breakdown {
    display: flex;
    gap: 12px;
    margin-top: 14px;
    flex-wrap: wrap;
  }

  .pts-chip {
    display: flex;
    align-items: center;
    gap: 5px;
    background: rgba(255,255,255,0.08);
    border-radius: 999px;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.7);
  }

  /* Answer reveal */
  .answer-reveal {
    border-left: 3px solid;
    padding-left: 14px;
  }

  .answer-reveal.correct { border-color: #4ade80; }
  .answer-reveal.wrong   { border-color: #f87171; }

  .answer-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 6px;
  }

  .answer-reveal.correct .answer-label { color: #4ade80; }
  .answer-reveal.wrong   .answer-label { color: #f87171; }

  .answer-text {
    font-size: 15px;
    color: rgba(255,255,255,0.85);
    font-weight: 500;
    line-height: 1.4;
    margin-bottom: 4px;
  }

  /* Explanation */
  .explanation-box {
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.2);
    border-radius: 12px;
    padding: 14px;
    font-size: 14px;
    color: rgba(255,255,255,0.65);
    line-height: 1.6;
    margin-top: 16px;
  }

  .explanation-box .exp-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #818cf8;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  /* Streak card */
  .streak-card {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .streak-flame { font-size: 36px; }

  .streak-info .streak-num {
    font-family: 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: #fbbf24;
  }

  .streak-info .streak-sub {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
  }

  /* New badges notification */
  .new-badges-card {
    background: linear-gradient(135deg, rgba(251,191,36,0.15), rgba(249,115,22,0.08));
    border: 1px solid rgba(251,191,36,0.3);
    border-radius: 20px;
    padding: 20px 24px;
    animation: badgePop 0.5s 1s cubic-bezier(.22,.68,0,1) forwards;
    opacity: 0;
    transform: scale(0.9);
  }

  @keyframes badgePop {
    to { opacity: 1; transform: scale(1); }
  }

  .new-badges-title {
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: #fbbf24;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .badge-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .badge-pill {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(251,191,36,0.15);
    border: 1px solid rgba(251,191,36,0.25);
    color: #fcd34d;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
  }

  /* Stats row */
  .stat-mini-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
  }

  .stat-mini {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 14px;
    text-align: center;
  }

  .stat-mini .sm-val {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #fff;
  }

  .stat-mini .sm-lbl {
    font-size: 11px;
    color: rgba(255,255,255,0.35);
    font-weight: 600;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .result-content {
      grid-template-columns: 1fr;
      gap: 24px;
    }
    .result-mascot-col { padding-top: 20px; }
    .stat-mini-row { grid-template-columns: repeat(2, 1fr); }
  }
</style>
@endsection

@section('content')

@if($attempt->is_correct)
<canvas id="confettiCanvas"></canvas>
@endif

<section class="result-page">
  <div class="result-content">

    {{-- LEFT: Mascot + Message --}}
    <div class="result-mascot-col">
      <div class="result-mascot-wrap">
        <x-gyani :state="$attempt->is_correct ? 'happy' : 'sad'" size="240" />
      </div>

      <div class="result-verdict {{ $attempt->is_correct ? 'verdict-correct' : ($attempt->selected_option ? 'verdict-wrong' : 'verdict-timeout') }}">
        @if($attempt->is_correct)
          🎉 Brilliant!
        @elseif(!$attempt->selected_option)
          ⏱️ Time's Up!
        @else
          😔 Not Quite!
        @endif
      </div>

      <p class="result-message">"{{ $message['text'] }}"</p>

      <div class="result-ctas">
        @if($hasMoreQuestions)
          <a href="{{ route('daily-quiz.take') }}" class="btn-result btn-result-primary" style="background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 8px 20px rgba(16,185,129,0.35);">
            <i class="fa-solid fa-arrow-right"></i> Next Question ({{ $nextQuestionIndex }} of {{ min(10, $todayQuestionsCount) }})
          </a>
        @endif
        <a href="{{ route('daily-quiz.leaderboard') }}" class="btn-result {{ $hasMoreQuestions ? 'btn-result-outline' : 'btn-result-primary' }}">
          <i class="fa-solid fa-trophy"></i> View Leaderboard
        </a>
        <a href="{{ route('daily-quiz.my-stats') }}" class="btn-result btn-result-outline">
          <i class="fa-solid fa-chart-bar"></i> My Stats
        </a>
        <a href="{{ route('daily-quiz.index') }}" class="btn-result btn-result-outline">
          <i class="fa-solid fa-house"></i> Quiz Home
        </a>
      </div>
    </div>

    {{-- RIGHT: Score Cards --}}
    <div class="result-panel-col">

      {{-- Points Earned --}}
      <div class="panel-card points-earned-card">
        <div class="points-label">✨ Points Earned for this Question</div>
        <div class="points-big">
          <span id="pointsCounter">0</span>
          <span class="pts-label">pts</span>
        </div>
        @if($attempt->points_earned > 0)
        <div class="points-breakdown">
          @if($attempt->is_correct)
            <span class="pts-chip">✅ +{{ $attempt->question->points ?? 10 }} correct</span>
          @endif
          @if($speedBonus > 0)
            <span class="pts-chip">⚡ +{{ $speedBonus }} speed bonus</span>
          @endif
          @if($streakBonus > 0)
            <span class="pts-chip">🔥 +{{ $streakBonus }} streak bonus</span>
          @endif
        </div>
        @endif
      </div>

      {{-- Streak --}}
      <div class="panel-card streak-card">
        <span class="streak-flame">🔥</span>
        <div class="streak-info">
          <div class="streak-num">{{ $stat->current_streak }}-Day Streak</div>
          <div class="streak-sub">Longest: {{ $stat->longest_streak }} days &nbsp;|&nbsp; Keep going!</div>
        </div>
      </div>

      {{-- Answer Reveal --}}
      <div class="panel-card">
        <div class="answer-reveal {{ $attempt->is_correct ? 'correct' : 'wrong' }}" style="margin-bottom: 14px;">
          <div class="answer-label">
            {{ $attempt->is_correct ? '✅ Your Answer (Correct!)' : '❌ Your Answer' }}
          </div>
          @if($attempt->selected_option)
            <div class="answer-text">
              <strong>{{ strtoupper($attempt->selected_option) }}.</strong>
              {{ $attempt->question->{'option_' . $attempt->selected_option} }}
            </div>
          @else
            <div class="answer-text" style="color: rgba(255,255,255,0.4); font-style: italic;">No answer selected (timed out)</div>
          @endif
        </div>

        @if(!$attempt->is_correct)
        <div class="answer-reveal correct">
          <div class="answer-label">✅ Correct Answer</div>
          <div class="answer-text">
            <strong>{{ strtoupper($attempt->question->correct_option) }}.</strong>
            {{ $attempt->question->{'option_' . $attempt->question->correct_option} }}
          </div>
        </div>
        @endif

        @if($attempt->question->explanation)
        <div class="explanation-box">
          <div class="exp-label"><i class="fa-solid fa-circle-info"></i> Explanation</div>
          {{ $attempt->question->explanation }}
        </div>
        @endif
      </div>

      {{-- New Badges --}}
      @if(!empty($newBadges))
      <div class="new-badges-card">
        <div class="new-badges-title">
          <i class="fa-solid fa-award"></i>
          🎊 New Badges Unlocked!
        </div>
        <div class="badge-row">
          @foreach($newBadges as $badgeKey)
            @if(isset($allBadges[$badgeKey]))
              <span class="badge-pill">
                {{ $allBadges[$badgeKey]['emoji'] }} {{ $allBadges[$badgeKey]['label'] }}
              </span>
            @endif
          @endforeach
        </div>
      </div>
      @endif

      {{-- My Stats Mini --}}
      <div class="panel-card">
        <div class="points-label" style="margin-bottom: 14px;">📊 Your All-Time Stats</div>
        <div class="stat-mini-row">
          <div class="stat-mini">
            <div class="sm-val">{{ number_format($stat->total_points) }}</div>
            <div class="sm-lbl">Total Points</div>
          </div>
          <div class="stat-mini">
            <div class="sm-val">{{ $stat->quizzes_taken }}</div>
            <div class="sm-lbl">Quizzes</div>
          </div>
          <div class="stat-mini">
            <div class="sm-val">{{ $stat->accuracy }}%</div>
            <div class="sm-lbl">Accuracy</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  // ── Animated Points Counter ──
  const finalPoints = {{ $attempt->points_earned }};
  const counterEl   = document.getElementById('pointsCounter');
  let current = 0;
  const duration = 1500;
  const startTime = Date.now();

  function animateCounter() {
    const elapsed  = Date.now() - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const ease     = 1 - Math.pow(1 - progress, 3); // ease-out cubic
    current = Math.round(ease * finalPoints);
    counterEl.textContent = current;
    if (progress < 1) requestAnimationFrame(animateCounter);
  }

  setTimeout(() => requestAnimationFrame(animateCounter), 400);

  // ── Confetti (correct answers only) ──
  @if($attempt->is_correct)
  const canvas  = document.getElementById('confettiCanvas');
  const ctx     = canvas.getContext('2d');
  canvas.width  = window.innerWidth;
  canvas.height = window.innerHeight;

  const colors  = ['#6366f1','#fbbf24','#4ade80','#f87171','#60a5fa','#a78bfa','#34d399'];
  const pieces  = [];

  for (let i = 0; i < 180; i++) {
    pieces.push({
      x: Math.random() * canvas.width,
      y: -20 - Math.random() * 200,
      w: 8 + Math.random() * 8,
      h: 5 + Math.random() * 5,
      color: colors[Math.floor(Math.random() * colors.length)],
      rot: Math.random() * Math.PI * 2,
      vx: (Math.random() - 0.5) * 3,
      vy: 2 + Math.random() * 4,
      vr: (Math.random() - 0.5) * 0.2,
      opacity: 1
    });
  }

  let confettiRunning = true;

  function drawConfetti() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    let alive = false;
    pieces.forEach(p => {
      p.x  += p.vx;
      p.y  += p.vy;
      p.rot += p.vr;
      if (p.y > canvas.height * 0.7) p.opacity -= 0.02;
      if (p.opacity > 0) alive = true;
      ctx.save();
      ctx.globalAlpha = Math.max(0, p.opacity);
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
      ctx.restore();
    });
    if (alive && confettiRunning) requestAnimationFrame(drawConfetti);
    else ctx.clearRect(0, 0, canvas.width, canvas.height);
  }

  setTimeout(() => requestAnimationFrame(drawConfetti), 200);
  setTimeout(() => { confettiRunning = false; }, 5000);

  window.addEventListener('resize', () => {
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;
  });
  @endif
</script>
@endsection

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
    padding: 60px 16px;
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
    grid-template-columns: 1fr 1.2fr;
    gap: 40px;
    max-width: 1100px;
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
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 24px;
    padding: 40px 24px;
    backdrop-filter: blur(12px);
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
    font-size: clamp(24px, 4vw, 36px);
    font-weight: 800;
    line-height: 1.15;
    animation: fadeUpIn 0.7s 0.3s ease forwards;
    opacity: 0;
  }

  .verdict-success { color: #4ade80; }
  .verdict-info    { color: #60a5fa; }
  .verdict-warning { color: #fcd34d; }

  .result-message {
    font-size: 15px;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    max-width: 380px;
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
    gap: 12px;
    width: 100%;
    max-width: 320px;
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
  .btn-result-primary:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 12px 28px rgba(99,102,241,0.45); 
    color: #fff; 
  }

  .btn-result-outline {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.8);
  }
  .btn-result-outline:hover { 
    background: rgba(255,255,255,0.1); 
    color: #fff; 
    border-color: rgba(255, 255, 255, 0.3);
  }

  /* ── Right: Score Panel ── */
  .result-panel-col {
    display: flex;
    flex-direction: column;
    gap: 24px;
    animation: slideInRight 0.8s 0.2s cubic-bezier(.22,.68,0,1) forwards;
    opacity: 0;
  }

  @keyframes slideInRight {
    from { transform: translateX(40px); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
  }

  .panel-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
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
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.45);
    margin-bottom: 8px;
  }

  .points-big {
    font-family: 'Sora', sans-serif;
    font-size: 48px;
    font-weight: 800;
    color: #fbbf24;
    line-height: 1;
    display: flex;
    align-items: flex-end;
    gap: 8px;
  }

  .points-big .pts-label {
    font-size: 18px;
    color: rgba(255,255,255,0.4);
    font-weight: 500;
    padding-bottom: 6px;
    font-family: 'DM Sans', sans-serif;
  }

  .today-summary-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 18px;
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-top: 16px;
  }

  .summary-stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .summary-stat-val {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
  }

  /* Streak card */
  .streak-card {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .streak-flame { font-size: 32px; }

  .streak-info .streak-num {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #fbbf24;
  }

  .streak-info .streak-sub {
    font-size: 12px;
    color: rgba(255,255,255,0.45);
  }

  /* Detailed review card */
  .review-section-title {
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .review-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-height: 480px;
    overflow-y: auto;
    padding-right: 8px;
  }

  .review-list::-webkit-scrollbar {
    width: 6px;
  }

  .review-list::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
  }

  .review-item {
    border-left: 3px solid;
    padding-left: 14px;
    margin-bottom: 4px;
  }

  .review-item.correct { border-color: #4ade80; }
  .review-item.wrong { border-color: #f87171; }

  .review-q-text {
    font-size: 14px;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 8px;
  }

  .review-ans-row {
    font-size: 13px;
    margin-bottom: 4px;
  }

  .explanation-box {
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.2);
    border-radius: 10px;
    padding: 10px 12px;
    font-size: 12.5px;
    color: rgba(255,255,255,0.6);
    line-height: 1.5;
    margin-top: 8px;
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

  /* Graph container */
  .chart-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  /* ── Responsive ── */
  @media (max-width: 991px) {
    .result-content {
      grid-template-columns: 1fr;
      gap: 32px;
    }
  }

  @media (max-width: 768px) {
    .result-page {
      padding: 40px 12px;
    }

    .result-mascot-col {
      padding: 30px 16px;
    }

    .result-ctas {
      max-width: 100%;
    }

    .btn-result {
      width: 100%;
      height: 48px;
    }

    .panel-card {
      padding: 20px;
    }
  }
</style>
@endsection

@section('content')

@if(($correctCount / $totalQuestionsCount) >= 0.8)
<canvas id="confettiCanvas"></canvas>
@endif

<section class="result-page">
  <div class="result-content">

    {{-- LEFT: Mascot + Message --}}
    <div class="result-mascot-col">
      <div class="result-mascot-wrap">
        @if(($correctCount / $totalQuestionsCount) >= 0.8)
          <x-gyani state="happy" size="220" />
        @elseif(($correctCount / $totalQuestionsCount) >= 0.5)
          <x-gyani state="idle" size="220" />
        @else
          <x-gyani state="sad" size="220" />
        @endif
      </div>

      <div class="result-verdict @if(($correctCount / $totalQuestionsCount) >= 0.8) verdict-success @elseif(($correctCount / $totalQuestionsCount) >= 0.5) verdict-info @else verdict-warning @endif">
        @if(($correctCount / $totalQuestionsCount) >= 0.8)
          🏆 Excellent Performance!
        @elseif(($correctCount / $totalQuestionsCount) >= 0.5)
          👍 Good Effort!
        @else
          📚 Keep Learning!
        @endif
      </div>

      <p class="result-message">"{{ $message['text'] }}"</p>

      <div class="result-ctas">
        <a href="{{ route('daily-quiz.leaderboard') }}" class="btn-result btn-result-primary">
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

    {{-- RIGHT: Score Cards & Graphs --}}
    <div class="result-panel-col">

      {{-- Points Earned & Correct stats --}}
      <div class="panel-card points-earned-card">
        <div class="points-label">⚡ Today's Score Summary</div>
        <div class="points-big">
          <span id="pointsCounter">0</span>
          <span class="pts-label">total pts earned</span>
        </div>
        
        <div class="today-summary-grid">
          <div class="summary-stat">
            <span class="points-label" style="margin-bottom: 2px;">Correct Answers</span>
            <span class="summary-stat-val" style="color: #4ade80;">{{ $correctCount }} / {{ $totalQuestionsCount }}</span>
          </div>
          <div class="summary-stat">
            <span class="points-label" style="margin-bottom: 2px;">Daily Accuracy</span>
            <span class="summary-stat-val" style="color: #60a5fa;">{{ round(($correctCount / $totalQuestionsCount) * 100) }}%</span>
          </div>
        </div>
      </div>

      {{-- Streak status --}}
      <div class="panel-card streak-card">
        <span class="streak-flame">🔥</span>
        <div class="streak-info">
          <div class="streak-num">{{ $stat->current_streak }}-Day Streak</div>
          <div class="streak-sub">Longest Streak: {{ $stat->longest_streak }} days &nbsp;|&nbsp; Come back tomorrow to keep it burning!</div>
        </div>
      </div>

      {{-- Weekly Progress Graph --}}
      @if($weeklyProgress->isNotEmpty())
      <div class="panel-card chart-card">
        <div class="points-label" style="margin-bottom: 16px;"><i class="fa-solid fa-chart-line" style="color:#818cf8; margin-right:6px;"></i> Weekly Points Progress</div>
        <div style="position: relative; height: 200px; width: 100%;">
          <canvas id="progressChart"></canvas>
        </div>
      </div>
      @endif

      {{-- Detailed Question-by-Question Review --}}
      <div class="panel-card">
        <h3 class="review-section-title">
          <i class="fa-solid fa-list-check" style="color: #6366f1;"></i> Today's Question Review
        </h3>
        
        <div class="review-list">
          @foreach($todayAttempts as $index => $attempt)
            <div class="review-item {{ $attempt->is_correct ? 'correct' : 'wrong' }}">
              <div class="review-q-text">
                Q{{ $index + 1 }}. {{ $attempt->question->question_text }}
              </div>
              <div class="review-ans-row">
                <span class="points-label" style="font-size: 10px; margin-right: 4px;">Your Answer:</span>
                @if($attempt->selected_option)
                  <span style="color: {{ $attempt->is_correct ? '#4ade80' : '#f87171' }}; font-weight: 700;">
                    {{ strtoupper($attempt->selected_option) }}. {{ $attempt->question->{'option_' . $attempt->selected_option} }}
                  </span>
                @else
                  <span style="color: #fbbf24; font-style: italic;">Timed Out / No Selection</span>
                @endif
              </div>
              
              @if(!$attempt->is_correct)
                <div class="review-ans-row">
                  <span class="points-label" style="font-size: 10px; margin-right: 4px; color:#4ade80;">Correct Answer:</span>
                  <span style="color: #4ade80; font-weight: 700;">
                    {{ strtoupper($attempt->question->correct_option) }}. {{ $attempt->question->{'option_' . $attempt->question->correct_option} }}
                  </span>
                </div>
              @endif

              @if($attempt->question->explanation)
                <div class="explanation-box">
                  <span style="font-size: 11px; font-weight: 700; color: #818cf8; display: block; margin-bottom: 2px;">
                    <i class="fa-solid fa-circle-info"></i> Explanation
                  </span>
                  {{ $attempt->question->explanation }}
                </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>

      {{-- New Badges Unlocked --}}
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

    </div>
  </div>
</section>

@endsection

@section('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // ── Animated Points Counter ──
  const finalPoints = {{ $totalPointsEarnedToday }};
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

  // ── Confetti (accuracy >= 80%) ──
  @if(($correctCount / $totalQuestionsCount) >= 0.8)
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

  // ── Render Chart.js Graph ──
  @if($weeklyProgress->isNotEmpty())
  document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('progressChart').getContext('2d');
    const labels = @json($weeklyProgress->pluck('date'));
    const data = @json($weeklyProgress->pluck('points'));

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Daily Score (Points)',
          data: data,
          borderColor: '#818cf8',
          backgroundColor: 'rgba(129, 140, 248, 0.1)',
          borderWidth: 3,
          tension: 0.3,
          fill: true,
          pointBackgroundColor: '#fbbf24',
          pointBorderColor: '#818cf8',
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            grid: {
              color: 'rgba(255, 255, 255, 0.05)'
            },
            ticks: {
              color: 'rgba(255, 255, 255, 0.5)'
            }
          },
          y: {
            grid: {
              color: 'rgba(255, 255, 255, 0.05)'
            },
            ticks: {
              color: 'rgba(255, 255, 255, 0.5)'
            },
            beginAtZero: true
          }
        }
      }
    });
  });
  @endif
</script>
@endsection

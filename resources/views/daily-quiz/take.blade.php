@extends('layouts.app')

@section('title', 'Take Daily Quiz | CareerGyan')

@section('styles')
<style>
  .quiz-arena {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
    position: relative;
    overflow: hidden;
  }

  .quiz-arena::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 40% 50% at 10% 30%, rgba(99,102,241,0.15) 0%, transparent 70%),
      radial-gradient(ellipse 30% 40% at 90% 70%, rgba(59,130,246,0.1) 0%, transparent 70%);
    pointer-events: none;
  }

  .quiz-card {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 28px;
    padding: 48px;
    max-width: 720px;
    width: 100%;
    position: relative;
    z-index: 2;
    box-shadow: 0 30px 80px rgba(0,0,0,0.4);
  }

  /* ── Header ── */
  .quiz-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 36px;
    gap: 16px;
  }

  .quiz-info-left {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .q-date-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(99,102,241,0.2);
    border: 1px solid rgba(99,102,241,0.35);
    color: #a5b4fc;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.05em;
    width: fit-content;
  }

  .q-category-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    width: fit-content;
  }

  .cat-general    { background: rgba(99,102,241,0.2); color: #a5b4fc; }
  .cat-engineering{ background: rgba(251,191,36,0.2); color: #fcd34d; }
  .cat-science    { background: rgba(34,197,94,0.2);  color: #4ade80; }
  .cat-arts       { background: rgba(244,63,94,0.2);  color: #fb7185; }
  .cat-commerce   { background: rgba(249,115,22,0.2); color: #fb923c; }
  .cat-technology { background: rgba(59,130,246,0.2); color: #60a5fa; }

  /* ── Timer Ring ── */
  .timer-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    flex-shrink: 0;
  }

  .timer-ring {
    position: relative;
    width: 72px;
    height: 72px;
  }

  .timer-ring svg {
    transform: rotate(-90deg);
    width: 100%;
    height: 100%;
  }

  .timer-ring .ring-bg  { fill: none; stroke: rgba(255,255,255,0.08); stroke-width: 5; }
  .timer-ring .ring-bar {
    fill: none;
    stroke: #6366f1;
    stroke-width: 5;
    stroke-linecap: round;
    stroke-dasharray: 188;
    stroke-dashoffset: 0;
    transition: stroke-dashoffset 1s linear, stroke 0.5s ease;
  }

  .timer-num {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #fff;
  }

  .timer-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.08em;
    color: rgba(255,255,255,0.35);
    text-transform: uppercase;
  }

  /* ── Question ── */
  .question-section { margin-bottom: 36px; }

  .question-text {
    font-family: 'Sora', sans-serif;
    font-size: clamp(18px, 3vw, 24px);
    font-weight: 700;
    color: #ffffff;
    line-height: 1.45;
    margin-bottom: 8px;
  }

  .points-hint {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    margin-top: 8px;
  }

  .speed-hint {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: rgba(251,191,36,0.12);
    border: 1px solid rgba(251,191,36,0.2);
    color: #fcd34d;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    margin-left: 8px;
  }

  /* ── Options ── */
  .options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 36px;
  }

  .option-btn {
    position: relative;
    display: flex;
    align-items: center;
    gap: 14px;
    background: rgba(255,255,255,0.05);
    border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 16px;
    padding: 18px 20px;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(.22,.68,0,1);
    text-align: left;
    width: 100%;
    overflow: hidden;
  }

  .option-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(99,102,241,0.12), transparent);
    opacity: 0;
    transition: opacity 0.2s;
    border-radius: inherit;
  }

  .option-btn:hover {
    border-color: rgba(99,102,241,0.6);
    background: rgba(99,102,241,0.1);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(99,102,241,0.2);
  }

  .option-btn:hover::before { opacity: 1; }

  .option-btn.selected {
    border-color: #6366f1;
    background: rgba(99,102,241,0.18);
    box-shadow: 0 8px 24px rgba(99,102,241,0.25);
    transform: none;
  }

  .option-btn.selected::before { opacity: 1; }

  .option-letter {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 800;
    color: rgba(255,255,255,0.7);
    flex-shrink: 0;
    transition: all 0.2s;
  }

  .option-btn.selected .option-letter {
    background: #6366f1;
    border-color: #6366f1;
    color: #fff;
  }

  .option-text {
    font-size: 15px;
    font-weight: 500;
    color: rgba(255,255,255,0.8);
    line-height: 1.4;
    flex: 1;
  }

  /* Pulse animation on selection */
  @keyframes optionPulse {
    0%   { box-shadow: 0 0 0 0 rgba(99,102,241,0.5); }
    70%  { box-shadow: 0 0 0 12px rgba(99,102,241,0); }
    100% { box-shadow: 0 0 0 0 rgba(99,102,241,0); }
  }

  .option-btn.selected { animation: optionPulse 0.4s ease-out; }

  /* ── Gyani in corner ── */
  .gyani-corner {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 10;
    filter: drop-shadow(0 10px 30px rgba(99,102,241,0.3));
    transition: all 0.3s ease;
  }

  /* ── Submit Button ── */
  .quiz-submit-wrap {
    display: flex;
    justify-content: center;
  }

  .btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    padding: 16px 48px;
    border-radius: 999px;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(.22,.68,0,1);
    box-shadow: 0 8px 25px rgba(99,102,241,0.4);
    font-family: inherit;
    position: relative;
    overflow: hidden;
  }

  .btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
  }

  .btn-submit:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 12px 35px rgba(99,102,241,0.5);
  }

  .btn-submit:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
  }

  /* ── Time up overlay ── */
  .timeout-flash {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(239,68,68,0.15);
    z-index: 100;
    pointer-events: none;
    animation: flashRed 0.3s ease-out;
  }

  @keyframes flashRed {
    0%   { opacity: 0; }
    50%  { opacity: 1; }
    100% { opacity: 0; }
  }

  /* ── Responsive ── */
  @media (max-width: 1024px) {
    .gyani-corner { display: none; }
  }

  @media (max-width: 640px) {
    .quiz-card { padding: 24px 16px; border-radius: 20px; }
    .options-grid { grid-template-columns: 1fr; gap: 12px; margin-bottom: 28px; }
    .quiz-header { flex-direction: column-reverse; align-items: flex-start; gap: 20px; }
    .timer-wrap { flex-direction: row; align-items: center; gap: 10px; width: 100%; justify-content: space-between; }
    .btn-submit { width: 100%; height: 50px; }
  }
</style>
@endsection

@section('content')

<div class="timeout-flash" id="timeoutFlash"></div>

<section class="quiz-arena">
  <form id="quizForm" action="{{ route('daily-quiz.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="question_id" value="{{ $question->id }}">
    <input type="hidden" name="time_taken_seconds" id="timeTakenInput" value="30">
    <input type="hidden" name="selected_option" id="selectedOptionInput" value="">

    <div class="quiz-card">

      {{-- Header --}}
      <div class="quiz-header">
        <div class="quiz-info-left">
          <div class="q-date-badge">
            <i class="fa-regular fa-calendar"></i>
            {{ now()->format('d M Y') }} — Question {{ $currentIndex }} of {{ $totalQuestionsCount }}
          </div>
          <div>
            <span class="q-category-pill cat-{{ $question->category }}">
              <i class="fa-solid fa-{{ $question->category_icon }}"></i>
              {{ ucfirst($question->category) }}
            </span>
          </div>
        </div>

        {{-- Timer Ring --}}
        <div class="timer-wrap">
          <div class="timer-ring">
            <svg viewBox="0 0 72 72">
              <circle class="ring-bg" cx="36" cy="36" r="30"/>
              <circle class="ring-bar" id="timerRing" cx="36" cy="36" r="30"/>
            </svg>
            <div class="timer-num" id="timerNum">30</div>
          </div>
          <div class="timer-label">Seconds</div>
        </div>
      </div>

      {{-- Question --}}
      <div class="question-section">
        <div class="question-text">{{ $question->question_text }}</div>
        <div class="points-hint">
          <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
          {{ $question->points }} base points
          <span class="speed-hint">
            <i class="fa-solid fa-bolt"></i>
            +5 if under 10s!
          </span>
        </div>
      </div>

      {{-- Options --}}
      <div class="options-grid">
        @foreach(['a','b','c','d'] as $opt)
        <button type="button"
                class="option-btn"
                id="opt-{{ $opt }}"
                data-option="{{ $opt }}"
                onclick="selectOption('{{ $opt }}')">
          <div class="option-letter">{{ strtoupper($opt) }}</div>
          <div class="option-text">{{ $question->{'option_' . $opt} }}</div>
        </button>
        @endforeach
      </div>

      {{-- Submit --}}
      <div class="quiz-submit-wrap">
        <button type="button" class="btn-submit" id="submitBtn" onclick="submitQuiz()" disabled>
          <i class="fa-solid fa-paper-plane"></i>
          Submit Answer
        </button>
      </div>

    </div>
  </form>
</section>

{{-- Gyani in corner (thinking while answering) --}}
<div class="gyani-corner" id="gyaniCorner">
  <x-gyani state="thinking" size="130" />
</div>

@endsection

@section('scripts')
<script>
  // ── Timer ──
  let timeLeft   = 30;
  let startTime  = Date.now();
  let timerId    = null;
  const FULL_CIRC = 188; // 2 * π * 30

  const timerNumEl  = document.getElementById('timerNum');
  const timerRingEl = document.getElementById('timerRing');
  const submitBtn   = document.getElementById('submitBtn');

  function updateTimer() {
    timerNumEl.textContent = timeLeft;
    const progress = ((30 - timeLeft) / 30) * FULL_CIRC;
    timerRingEl.style.strokeDashoffset = progress;

    // Colour changes
    if (timeLeft <= 10) {
      timerRingEl.style.stroke = '#f59e0b';
      timerNumEl.style.color   = '#fbbf24';
    }
    if (timeLeft <= 5) {
      timerRingEl.style.stroke = '#ef4444';
      timerNumEl.style.color   = '#f87171';
    }

    if (timeLeft <= 0) {
      clearInterval(timerId);
      // Flash red
      const flash = document.getElementById('timeoutFlash');
      flash.style.display = 'block';
      setTimeout(() => { flash.style.display = 'none'; }, 300);
      // Auto-submit with no selection
      document.getElementById('timeTakenInput').value = 30;
      document.getElementById('quizForm').submit();
      return;
    }
    timeLeft--;
  }

  timerId = setInterval(updateTimer, 1000);
  updateTimer();

  // ── Option Selection ──
  let selectedOption = null;

  function selectOption(opt) {
    if (submitBtn.form && submitBtn.form.submitting) return;

    // Deselect all
    document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));

    // Select clicked
    document.getElementById('opt-' + opt).classList.add('selected');
    selectedOption = opt;
    document.getElementById('selectedOptionInput').value = opt;

    // Enable submit
    submitBtn.disabled = false;
  }

  // ── Submit ──
  function submitQuiz() {
    if (!selectedOption) return;
    clearInterval(timerId);

    const elapsed = Math.round((Date.now() - startTime) / 1000);
    document.getElementById('timeTakenInput').value = Math.min(elapsed, 30);

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';
    document.getElementById('quizForm').submit();
  }

  // Prevent page close during quiz
  window.addEventListener('beforeunload', function(e) {
    if (!document.getElementById('quizForm').submitting) {
      e.preventDefault();
    }
  });
</script>
@endsection

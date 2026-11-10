@extends('layouts.app')

@section('title', 'Take ' . $meta['name'] . ' - 20 Questions | CareerGyan')
@section('meta_description', 'Complete the 20-question randomized ' . $meta['name'] . ' test to evaluate your instincts and discover accredited degree pathways.')

@section('content')
<style>
  .quiz-page-container {
    background: #f8fafc;
    min-height: 85vh;
    padding: 30px 16px 80px;
  }
  .quiz-wrap {
    max-width: 960px;
    margin: 0 auto;
  }

  /* Sticky Top Bar */
  .quiz-sticky-header {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 18px 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
  }
  .quiz-info-left {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .quiz-domain-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: {{ $meta['bg_light'] }};
    color: {{ $meta['color'] }};
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }
  .quiz-domain-title {
    font-family: 'Outfit', sans-serif;
    font-size: 19px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
  }
  .quiz-progress-text {
    font-size: 12.5px;
    color: #64748b;
    font-weight: 600;
  }

  /* Timer */
  .quiz-timer-box {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    padding: 8px 16px;
    border-radius: 999px;
    font-family: 'Outfit', monospace;
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    border: 1px solid #cbd5e1;
  }
  .quiz-timer-box.timer-warning {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
    animation: pulse 1.5s infinite;
  }
  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.6; }
  }

  /* Progress Bar */
  .quiz-progress-track {
    width: 100%;
    height: 6px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
    margin-top: 14px;
  }
  .quiz-progress-fill {
    height: 100%;
    background: {{ $meta['color'] }};
    width: 0%;
    transition: width 0.3s ease;
  }

  /* Question Card */
  .question-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 36px 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    margin-bottom: 24px;
    display: none;
  }
  .question-card.active {
    display: block;
    animation: fadeIn 0.25s ease-out;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .q-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    background: {{ $meta['bg_light'] }};
    color: {{ $meta['color_dark'] }};
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 14px;
    text-transform: uppercase;
  }
  .q-text {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.45;
    margin-bottom: 24px;
  }

  /* Options Grid */
  .options-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .option-label {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    font-size: 15px;
    color: #1e293b;
    font-weight: 500;
    line-height: 1.4;
  }
  .option-label:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
    transform: translateX(4px);
  }
  .option-label input[type="radio"] {
    display: none;
  }
  .option-key-badge {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #f1f5f9;
    color: #475569;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 13.5px;
    flex-shrink: 0;
    transition: all 0.2s;
  }
  .option-label.selected {
    border-color: {{ $meta['color'] }};
    background: {{ $meta['bg_light'] }};
    color: #0f172a;
    font-weight: 600;
  }
  .option-label.selected .option-key-badge {
    background: {{ $meta['color'] }};
    color: #ffffff;
  }

  /* Question Palette */
  .palette-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 20px 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
  }
  .palette-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(36px, 1fr));
    gap: 8px;
    margin-top: 12px;
  }
  .palette-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s;
  }
  .palette-btn:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
  }
  .palette-btn.current {
    border-color: {{ $meta['color'] }};
    background: {{ $meta['color'] }};
    color: #ffffff;
  }
  .palette-btn.answered {
    background: #10b981;
    color: #ffffff;
    border-color: #10b981;
  }
  .palette-btn.answered.current {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.35);
  }

  /* Bottom Nav */
  .quiz-nav-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
  }
  .btn-quiz-nav {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14.5px;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
  }
  .btn-quiz-prev {
    background: #ffffff;
    color: #475569;
    border: 1px solid #cbd5e1;
  }
  .btn-quiz-prev:hover {
    background: #f8fafc;
    color: #0f172a;
  }
  .btn-quiz-next {
    background: {{ $meta['color'] }};
    color: #ffffff;
  }
  .btn-quiz-next:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
  }
  .btn-quiz-submit {
    background: #10b981;
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
  }
  .btn-quiz-submit:hover {
    background: #059669;
    transform: translateY(-1px);
  }

  /* Candidate Info Modal for Guests */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .modal-box {
    background: #ffffff;
    border-radius: 20px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    overflow: hidden;
  }
  .modal-head {
    background: #0f172a;
    color: #ffffff;
    padding: 22px 26px;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .modal-body {
    padding: 26px;
  }
</style>

<div class="quiz-page-container">
  <div class="quiz-wrap">

    <!-- Sticky Header -->
    <div class="quiz-sticky-header">
      <div class="quiz-info-left">
        <div class="quiz-domain-icon">
          <i class="{{ $meta['icon'] }}"></i>
        </div>
        <div>
          <h1 class="quiz-domain-title">{{ $meta['name'] }} Assessment</h1>
          <div class="quiz-progress-text">
            Question <span id="currentQNum">1</span> of {{ $questions->count() }} &bull;
            <span id="answeredCountText">0</span> Answered
          </div>
        </div>
      </div>

      <div style="display: flex; align-items: center; gap: 12px;">
        <div class="quiz-timer-box" id="timerBox">
          <i class="fa-regular fa-clock"></i>
          <span id="timerDisplay">15:00</span>
        </div>
        <button type="button" onclick="confirmSubmit()" class="btn-quiz-nav btn-quiz-submit" style="padding: 8px 16px; font-size: 13px;">
          <i class="fa-solid fa-flag-checkered"></i> Submit Test
        </button>
      </div>

      <div class="quiz-progress-track">
        <div class="quiz-progress-fill" id="progressFill"></div>
      </div>
    </div>

    <!-- Question Cards Container -->
    <form id="quizForm" onsubmit="event.preventDefault(); confirmSubmit();">
      @csrf

      @foreach($questions as $index => $q)
        <div class="question-card {{ $index === 0 ? 'active' : '' }}" id="questionCard_{{ $index }}" data-qid="{{ $q->id }}">
          <div class="q-badge">
            <i class="fa-solid fa-circle-question"></i> Question {{ $index + 1 }} of {{ $questions->count() }}
          </div>
          <h2 class="q-text">
            {{ $q->question_text }}
          </h2>

          <div class="options-grid">
            <label class="option-label" onclick="selectOption({{ $index }}, 'A', this)">
              <input type="radio" name="answers[{{ $q->id }}]" value="A">
              <span class="option-key-badge">A</span>
              <span>{{ $q->option_a }}</span>
            </label>

            <label class="option-label" onclick="selectOption({{ $index }}, 'B', this)">
              <input type="radio" name="answers[{{ $q->id }}]" value="B">
              <span class="option-key-badge">B</span>
              <span>{{ $q->option_b }}</span>
            </label>

            <label class="option-label" onclick="selectOption({{ $index }}, 'C', this)">
              <input type="radio" name="answers[{{ $q->id }}]" value="C">
              <span class="option-key-badge">C</span>
              <span>{{ $q->option_c }}</span>
            </label>

            <label class="option-label" onclick="selectOption({{ $index }}, 'D', this)">
              <input type="radio" name="answers[{{ $q->id }}]" value="D">
              <span class="option-key-badge">D</span>
              <span>{{ $q->option_d }}</span>
            </label>
          </div>
        </div>
      @endforeach

      <!-- Palette and Question Nav -->
      <div class="palette-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 13px; font-weight: 700; color: #1e293b;">Question Palette:</span>
          <span style="font-size: 12px; color: #64748b;">
            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#10b981; margin-right:4px;"></span> Answered
            &nbsp;&bull;&nbsp;
            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#e2e8f0; margin-right:4px;"></span> Unanswered
          </span>
        </div>
        <div class="palette-grid">
          @foreach($questions as $index => $q)
            <button type="button" class="palette-btn {{ $index === 0 ? 'current' : '' }}" id="paletteBtn_{{ $index }}" onclick="goToQuestion({{ $index }})">
              {{ $index + 1 }}
            </button>
          @endforeach
        </div>
      </div>

      <!-- Navigation Bar -->
      <div class="quiz-nav-bar">
        <button type="button" class="btn-quiz-nav btn-quiz-prev" id="btnPrev" onclick="prevQuestion()" style="visibility: hidden;">
          <i class="fa-solid fa-arrow-left"></i> Previous
        </button>

        <div style="display: flex; gap: 10px;">
          <button type="button" class="btn-quiz-nav btn-quiz-next" id="btnNext" onclick="nextQuestion()">
            Next Question <i class="fa-solid fa-arrow-right"></i>
          </button>
          <button type="button" class="btn-quiz-nav btn-quiz-submit" id="btnSubmitFinal" onclick="confirmSubmit()" style="display: none;">
            <i class="fa-solid fa-circle-check"></i> Complete & Submit Test
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Candidate Details Modal (If Guest) -->
<div class="modal-overlay" id="candidateModal">
  <div class="modal-box">
    <div class="modal-head">
      <i class="fa-solid fa-user-check" style="color: #38bdf8; font-size: 22px;"></i>
      <div>
        <h3 style="margin: 0; font-size: 18px; font-weight: 800;">Candidate Details</h3>
        <p style="margin: 2px 0 0; font-size: 12.5px; color: #94a3b8;">Enter details for your personalized scorecard</p>
      </div>
    </div>
    <div class="modal-body">
      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Your Full Name *</label>
        <input type="text" id="candidateNameInput" class="form-control" placeholder="e.g. Rahul Sharma" value="{{ Auth::check() ? Auth::user()->name : '' }}" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
      </div>
      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Email Address *</label>
        <input type="email" id="candidateEmailInput" class="form-control" placeholder="e.g. rahul@example.com" value="{{ Auth::check() ? Auth::user()->email : '' }}" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
      </div>
      <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Mobile Number (Optional)</label>
        <input type="tel" id="candidatePhoneInput" class="form-control" placeholder="e.g. 9876543210" value="{{ Auth::check() ? Auth::user()->phone : '' }}" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
      </div>

      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" onclick="closeModal()" style="padding: 10px 18px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; cursor: pointer;">
          Back to Test
        </button>
        <button type="button" id="btnFinalSubmitModal" onclick="doFinalSubmit()" style="padding: 10px 22px; border-radius: 8px; border: none; background: #10b981; color: #fff; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
          <span>Submit & View Results</span> <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  const totalQuestions = {{ $questions->count() }};
  let currentIdx = 0;
  const answers = {};
  const isAuth = {{ Auth::check() ? 'true' : 'false' }};
  const submitUrl = "{{ route('specialized-aptitude.submit', $meta['key']) }}";
  const csrfToken = "{{ csrf_token() }}";

  function selectOption(qIdx, optionKey, labelEl) {
    // Unselect other options in this question
    const card = document.getElementById(`questionCard_${qIdx}`);
    const labels = card.querySelectorAll('.option-label');
    labels.forEach(l => l.classList.remove('selected'));

    labelEl.classList.add('selected');
    const radio = labelEl.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;

    const qId = card.getAttribute('data-qid');
    answers[qId] = optionKey;

    // Update Palette
    const palBtn = document.getElementById(`paletteBtn_${qIdx}`);
    if (palBtn) palBtn.classList.add('answered');

    updateProgress();
  }

  function updateProgress() {
    const answeredCount = Object.keys(answers).length;
    document.getElementById('answeredCountText').textContent = answeredCount;
    const pct = Math.round((answeredCount / totalQuestions) * 100);
    document.getElementById('progressFill').style.width = pct + '%';
  }

  function goToQuestion(idx) {
    if (idx < 0 || idx >= totalQuestions) return;

    // Hide old question
    document.getElementById(`questionCard_${currentIdx}`).classList.remove('active');
    document.getElementById(`paletteBtn_${currentIdx}`).classList.remove('current');

    // Show new question
    currentIdx = idx;
    document.getElementById(`questionCard_${currentIdx}`).classList.add('active');
    document.getElementById(`paletteBtn_${currentIdx}`).classList.add('current');
    document.getElementById('currentQNum').textContent = currentIdx + 1;

    // Toggle Prev / Next / Submit buttons
    document.getElementById('btnPrev').style.visibility = currentIdx === 0 ? 'hidden' : 'visible';
    if (currentIdx === totalQuestions - 1) {
      document.getElementById('btnNext').style.display = 'none';
      document.getElementById('btnSubmitFinal').style.display = 'inline-flex';
    } else {
      document.getElementById('btnNext').style.display = 'inline-flex';
      document.getElementById('btnSubmitFinal').style.display = 'none';
    }

    window.scrollTo({ top: 120, behavior: 'smooth' });
  }

  function nextQuestion() {
    if (currentIdx < totalQuestions - 1) {
      goToQuestion(currentIdx + 1);
    }
  }

  function prevQuestion() {
    if (currentIdx > 0) {
      goToQuestion(currentIdx - 1);
    }
  }

  function confirmSubmit() {
    const answeredCount = Object.keys(answers).length;
    if (answeredCount < totalQuestions) {
      const remaining = totalQuestions - answeredCount;
      if (!confirm(`You have answered ${answeredCount} of ${totalQuestions} questions (${remaining} remaining). Are you sure you want to finish and submit now?`)) {
        return;
      }
    }

    if (!isAuth) {
      document.getElementById('candidateModal').style.display = 'flex';
    } else {
      doFinalSubmit();
    }
  }

  function closeModal() {
    document.getElementById('candidateModal').style.display = 'none';
  }

  function doFinalSubmit() {
    let name = document.getElementById('candidateNameInput') ? document.getElementById('candidateNameInput').value.trim() : '';
    let email = document.getElementById('candidateEmailInput') ? document.getElementById('candidateEmailInput').value.trim() : '';
    let phone = document.getElementById('candidatePhoneInput') ? document.getElementById('candidatePhoneInput').value.trim() : '';

    if (!isAuth) {
      if (!name) {
        alert('Please enter your full name.');
        return;
      }
      if (!email || !email.includes('@')) {
        alert('Please enter a valid email address.');
        return;
      }
    }

    const submitBtn = document.getElementById('btnFinalSubmitModal');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';
    }

    fetch(submitUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        answers: answers,
        student_name: name,
        student_email: email,
        student_phone: phone
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success && data.redirect_url) {
        window.location.href = data.redirect_url;
      } else {
        alert(data.message || 'Error evaluating test. Please try again.');
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Submit & View Results';
        }
      }
    })
    .catch(err => {
      console.error(err);
      alert('Network or server error while submitting. Please try again.');
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Submit & View Results';
      }
    });
  }

  // 15-Minute Countdown Timer
  let remainingSeconds = 15 * 60;
  const timerDisplay = document.getElementById('timerDisplay');
  const timerBox = document.getElementById('timerBox');

  const timerInterval = setInterval(() => {
    remainingSeconds--;
    if (remainingSeconds <= 0) {
      clearInterval(timerInterval);
      alert('Time is up! Submitting your answers automatically.');
      doFinalSubmit();
      return;
    }

    const mins = Math.floor(remainingSeconds / 60);
    const secs = remainingSeconds % 60;
    timerDisplay.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

    if (remainingSeconds <= 180) { // 3 mins remaining
      timerBox.classList.add('timer-warning');
    }
  }, 1000);
</script>
@endsection

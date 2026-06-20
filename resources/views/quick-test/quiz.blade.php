@extends('layouts.app')

@section('title', 'Quick Test Quiz | CareerGyan')

@section('styles')
<style>
    .quiz-sticky-bar {
        position: sticky;
        top: 100px;
        z-index: 50;
        background: #fff;
        border-bottom: 1px solid var(--border);
        padding: 12px 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .question-step {
        display: none;
    }
    .question-step.active {
        display: block;
        animation: fadeIn 0.4s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .question-card {
        background: #fff;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        padding: 40px;
        margin-top: 30px;
        min-height: 400px;
        box-shadow: var(--shadow-md);
    }
    .option-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 30px;
    }
    @media(max-width: 640px) {
        .option-grid { grid-template-columns: 1fr; }
    }
    .option-label {
        display: flex;
        flex-direction: column;
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.2s;
        background: #fff;
        position: relative;
    }
    .option-label:hover {
        border-color: var(--brand);
        background: var(--brand-light);
        transform: translateY(-2px);
    }
    .option-label.selected {
        background: var(--brand-light);
        border-color: var(--brand);
        box-shadow: 0 0 0 1px var(--brand);
    }
    .option-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    .option-label input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--brand);
    }
    .option-label .opt-id {
        font-weight: 800;
        color: var(--brand);
        font-size: 16px;
    }
    .option-content {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .option-img {
        max-width: 100%;
        max-height: 180px;
        object-fit: contain;
        border-radius: 8px;
    }
    .section-indicator {
        font-size: 13px;
        font-weight: 700;
        color: var(--brand);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: var(--brand-light);
        padding: 4px 12px;
        border-radius: 999px;
        display: inline-block;
        margin-bottom: 15px;
    }
    .progress-text {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-2);
    }
    .nav-btn {
        height: 50px;
        padding: 0 30px;
        border-radius: var(--radius-md);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-back { background: var(--bg); color: var(--text-2); border: 1px solid var(--border); }
    .btn-back:hover { background: var(--border); }
    .btn-back:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-next { background: var(--brand); color: #fff; }
    .btn-next:hover { background: var(--brand-dark); }
    .btn-submit { background: var(--accent); color: #fff; }
    .btn-submit:hover { opacity: 0.9; }

    .q-image-container {
        margin: 20px 0;
        padding: 15px;
        background: #f8fafc;
        border-radius: var(--radius-md);
        display: inline-block;
        max-width: 100%;
        border: 1px solid var(--border);
    }
    .q-image {
        max-width: 100%;
        max-height: 350px;
        border-radius: 8px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="quiz-sticky-bar">
    <div class="container">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="width: 36px; height: 36px; background: var(--brand-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-clock" style="color: var(--brand); font-size: 14px;"></i>
                    </div>
                    <div id="timer" style="font-family: monospace; font-size: 18px; font-weight: 800; color: var(--text-1);">20:00</div>
                </div>
                <div class="progress-text" id="progressIndicator">Question 1 of {{ count($questions) }}</div>
            </div>
            
            <div id="currentSectionName" style="font-weight: 700; color: var(--text-2); font-size: 14px; text-transform: uppercase;">
                {{ $questions[0]->section }}
            </div>

            <button type="button" onclick="confirmSubmit()" class="nav-cta" style="background: var(--accent); height: 40px; padding: 0 15px; font-size: 13px;">
                Submit Test
            </button>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <form id="quizForm" action="{{ route('quick-test.submit') }}" method="POST">
            @csrf
            
            {{-- Student Information --}}
            @auth
                {{-- Logged-in: show a readonly info notice, no editable fields needed --}}
                <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: var(--radius-lg); padding: 18px 24px; margin-bottom: 30px; display: flex; align-items: center; gap: 14px;">
                    <div style="width: 40px; height: 40px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-user-check" style="color: #2563eb; font-size: 16px;"></i>
                    </div>
                    <div>
                        <p style="font-size: 13px; font-weight: 600; color: #1e40af; margin: 0 0 2px 0; text-transform: uppercase; letter-spacing: 0.05em;">Report will be generated for</p>
                        <p style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0;">
                            {{ auth()->user()->name }}
                            <span style="font-weight: 500; color: #64748b; font-size: 14px;">({{ auth()->user()->email }})</span>
                        </p>
                    </div>
                </div>
            @else
                {{-- Guest: show editable name/email fields --}}
                <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; margin-bottom: 30px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: var(--text-1); margin-bottom: 16px; text-align: center;">
                        Student Information
                    </h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 600px; margin: 0 auto;">
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: var(--text-2); margin-bottom: 6px;">
                                Full Name *
                            </label>
                            <input type="text" name="student_name" required
                                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-md); font-size: 14px;"
                                   placeholder="Enter your full name">
                        </div>
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: var(--text-2); margin-bottom: 6px;">
                                Email Address *
                            </label>
                            <input type="email" name="student_email" required
                                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-md); font-size: 14px;"
                                   placeholder="your.email@example.com">
                        </div>
                    </div>
                </div>
            @endauth
            
            @foreach($questions as $index => $question)
                <div class="question-step {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" data-section="{{ $question->section }}">
                    <div class="question-card">
                        <div class="section-indicator">{{ $question->section }}</div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                            <h2 style="font-size: 22px; font-weight: 800; color: var(--text-1); line-height: 1.4;">
                                {{ $question->question_text }}
                            </h2>
                        </div>

                        {{-- Question Image Support --}}
                        @if(!empty($question->question_image) && file_exists(public_path($question->question_image)))
                            <div class="q-image-container">
                                <img src="{{ asset($question->question_image) }}" alt="Diagram" class="q-image">
                            </div>
                        @endif

                        <div class="option-grid">
                            @foreach(['a', 'b', 'c', 'd'] as $opt)
                                @php 
                                    $optText = $question->{'option_' . $opt};
                                    $optImage = $question->{'option_' . $opt . '_image'};
                                @endphp
                                <label class="option-label" onclick="selectOption(this)">
                                    <div class="option-header">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ strtoupper($opt) }}">
                                        <span class="opt-id">{{ strtoupper($opt) }}.</span>
                                    </div>
                                    <div class="option-content">
                                        @if(!empty($optImage) && file_exists(public_path($optImage)))
                                            <img src="{{ asset($optImage) }}" alt="Option {{ strtoupper($opt) }}" class="option-img">
                                        @else
                                            <span style="font-weight: 500; font-size: 16px;">{{ $optText }}</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Navigation Buttons --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding-bottom: 100px;">
                <button type="button" id="btnPrev" class="nav-btn btn-back" onclick="changeStep(-1)">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
                
                <div style="display: gap: 15px; display: flex;">
                    <button type="button" id="btnNext" class="nav-btn btn-next" onclick="changeStep(1)">
                        Next <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <button type="submit" id="btnSubmit" class="nav-btn btn-submit" style="display: none;">
                        Submit Test <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStep = 0;
    const totalSteps = {{ count($questions) }};
    const steps = document.querySelectorAll('.question-step');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const btnSubmit = document.getElementById('btnSubmit');
    const progressIndicator = document.getElementById('progressIndicator');
    const sectionDisplay = document.getElementById('currentSectionName');

    function showStep(index) {
        steps.forEach(step => step.classList.remove('active'));
        steps[index].classList.add('active');
        
        // Update labels
        progressIndicator.textContent = `Question ${index + 1} of ${totalSteps}`;
        sectionDisplay.textContent = steps[index].getAttribute('data-section');

        // Navigation visibility
        btnPrev.disabled = (index === 0);
        
        if (index === totalSteps - 1) {
            btnNext.style.display = 'none';
            btnSubmit.style.display = 'flex';
        } else {
            btnNext.style.display = 'flex';
            btnSubmit.style.display = 'none';
        }

        // Scroll to top of card
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function changeStep(delta) {
        const nextStep = currentStep + delta;
        if (nextStep >= 0 && nextStep < totalSteps) {
            currentStep = nextStep;
            showStep(currentStep);
        }
    }

    function selectOption(label) {
        const step = label.closest('.question-step');
        step.querySelectorAll('.option-label').forEach(l => l.classList.remove('selected'));
        label.classList.add('selected');
        label.querySelector('input').checked = true;
    }

    function confirmSubmit() {
        if(confirm("Are you sure you want to submit your test?")) {
            document.getElementById('quizForm').submit();
        }
    }

    // Timer Logic
    let timeLeft = 20 * 60;
    const timerDisplay = document.getElementById('timer');
    const quizForm = document.getElementById('quizForm');

    const countdown = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            alert("Time is up! Your test will be submitted automatically.");
            quizForm.submit();
        }
        if (timeLeft < 60) timerDisplay.style.color = "#dc2626";
        timeLeft--;
    }, 1000);

    // Initialize
    showStep(0);
</script>
@endsection

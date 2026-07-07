@extends('layouts.app')

@section('title', 'Premium Assessment | CareerGyan')

@section('styles')
<style>
    .quiz-page {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 60px 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quiz-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        max-width: 700px;
        width: 100%;
        padding: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
    }

    .quiz-progress-bar {
        height: 6px;
        background: var(--border);
        border-radius: 99px;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--brand);
        width: 0%;
        transition: width 0.3s ease;
    }

    .step-indicator {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-3);
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .question-box h2 {
        font-family: 'Sora';
        font-size: 22px;
        font-weight: 800;
        color: var(--text-1);
        line-height: 1.5;
        margin-bottom: 35px;
        min-height: 66px;
    }

    /* Option Likert scale grid */
    .likert-scale {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 40px;
    }

    @media (max-width: 600px) {
        .likert-scale {
            flex-direction: column;
        }
    }

    .likert-option {
        flex: 1;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        padding: 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .likert-option:hover {
        border-color: var(--brand);
        background: var(--brand-light);
    }

    .likert-option.selected {
        border-color: var(--brand);
        background: var(--brand);
        color: white;
    }

    .option-num {
        font-weight: 800;
        font-size: 16px;
        margin-bottom: 6px;
    }

    .option-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .quiz-navigation {
        display: flex;
        justify-content: space-between;
        border-top: 1px solid var(--border);
        padding-top: 25px;
    }

    .nav-btn {
        height: 48px;
        padding: 0 25px;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 14.5px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .btn-back {
        background: white;
        border: 1.5px solid var(--border);
        color: var(--text-2);
    }

    .btn-back:hover {
        background: var(--bg);
        border-color: var(--text-3);
    }

    .btn-next {
        background: var(--brand);
        color: white;
    }

    .btn-next:hover {
        background: var(--brand-dark);
    }

    .submitting-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-xl);
        z-index: 100;
    }

    .spinner {
        border: 4px solid rgba(0,0,0,0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border-left-color: var(--brand);
        animation: spin 1s linear infinite;
        margin-bottom: 15px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<div class="quiz-page">
    <div class="quiz-card">
        
        <!-- Submitting Loader -->
        <div class="submitting-overlay" id="submittingOverlay">
            <div class="spinner"></div>
            <div style="font-weight: 800; color: var(--text-1); font-size: 16px;">Analyzing Cognitive Dimensions...</div>
            <div style="font-size: 13px; color: var(--text-3); margin-top: 4px;">Computing matches and roadmaps...</div>
        </div>

        <div class="step-indicator" id="stepIndicator">
            Question 1 of {{ count($questions) }}
        </div>
        
        <div class="quiz-progress-bar">
            <div class="progress-fill" id="progressFill"></div>
        </div>

        <div class="question-box">
            <h2 id="questionText">Loading assessment question...</h2>
            
            <div class="likert-scale">
                <div class="likert-option" data-value="1">
                    <span class="option-num">1</span>
                    <span class="option-label">Strongly Disagree</span>
                </div>
                <div class="likert-option" data-value="2">
                    <span class="option-num">2</span>
                    <span class="option-label">Disagree</span>
                </div>
                <div class="likert-option" data-value="3">
                    <span class="option-num">3</span>
                    <span class="option-label">Neutral</span>
                </div>
                <div class="likert-option" data-value="4">
                    <span class="option-num">4</span>
                    <span class="option-label">Agree</span>
                </div>
                <div class="likert-option" data-value="5">
                    <span class="option-num">5</span>
                    <span class="option-label">Strongly Agree</span>
                </div>
            </div>
        </div>

        <div class="quiz-navigation">
            <button onclick="prevQuestion()" id="btnPrev" class="nav-btn btn-back" style="visibility: hidden;">
                <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Back
            </button>
            <button onclick="nextQuestion()" id="btnNext" class="nav-btn btn-next">
                Next <i class="fa-solid fa-arrow-right" style="margin-left: 6px;"></i>
            </button>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    const questions = @json($questions);
    let currentIndex = 0;
    const answers = {};

    function loadQuestion() {
        const q = questions[currentIndex];
        
        // Update texts
        document.getElementById('questionText').innerText = q.text;
        document.getElementById('stepIndicator').innerText = `Question ${currentIndex + 1} of ${questions.length}`;
        
        // Update progress bar
        const percent = ((currentIndex) / questions.length) * 100;
        document.getElementById('progressFill').style.width = percent + '%';

        // Set navigation buttons visibility
        document.getElementById('btnPrev').style.visibility = currentIndex === 0 ? 'hidden' : 'visible';
        
        // Update next/submit button text
        const nextBtn = document.getElementById('btnNext');
        if (currentIndex === questions.length - 1) {
            nextBtn.innerHTML = `Submit Assessment <i class="fa-solid fa-circle-check" style="margin-left: 6px;"></i>`;
        } else {
            nextBtn.innerHTML = `Next <i class="fa-solid fa-arrow-right" style="margin-left: 6px;"></i>`;
        }

        // Highlight previous answer if selected
        const options = document.querySelectorAll('.likert-option');
        options.forEach(opt => opt.classList.remove('selected'));
        
        const prevAnswer = answers[q.id];
        if (prevAnswer) {
            const selectedOpt = document.querySelector(`.likert-option[data-value="${prevAnswer}"]`);
            if (selectedOpt) selectedOpt.classList.add('selected');
        }
    }

    // Attach click events to options
    document.querySelectorAll('.likert-option').forEach(opt => {
        opt.onclick = function() {
            document.querySelectorAll('.likert-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');
            
            const value = this.getAttribute('data-value');
            const q = questions[currentIndex];
            answers[q.id] = parseInt(value);

            // Auto-advance after selection to improve UX (except on last question)
            if (currentIndex < questions.length - 1) {
                setTimeout(() => {
                    currentIndex++;
                    loadQuestion();
                }, 200);
            }
        };
    });

    function nextQuestion() {
        const q = questions[currentIndex];
        if (!answers[q.id]) {
            alert("Please select an option before moving to the next question.");
            return;
        }

        if (currentIndex < questions.length - 1) {
            currentIndex++;
            loadQuestion();
        } else {
            submitQuiz();
        }
    }

    function prevQuestion() {
        if (currentIndex > 0) {
            currentIndex--;
            loadQuestion();
        }
    }

    function submitQuiz() {
        document.getElementById('submittingOverlay').style.display = 'flex';
        
        fetch("{{ route('advanced-test.submit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                type: "{{ $type }}",
                answers: answers
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                document.getElementById('submittingOverlay').style.display = 'none';
                alert(data.message || "An error occurred while submitting.");
            }
        })
        .catch(error => {
            document.getElementById('submittingOverlay').style.display = 'none';
            console.error('Error:', error);
            alert("Connection error. Please try again.");
        });
    }

    // Initialize first question
    document.addEventListener("DOMContentLoaded", function() {
        loadQuestion();
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'Advanced Career Assessment | CareerGyan Pro')

@section('styles')
<style>
    .quiz-container { max-width: 820px; margin: 40px auto; background: white; border-radius: var(--radius-lg, 16px); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08); overflow: hidden; border: 1px solid var(--border, #e2e8f0); }
    .quiz-header { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; padding: 22px 32px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .quiz-header h2 { font-family: 'Sora', sans-serif; font-size: 20px; color: #ffffff; margin: 0; display: flex; align-items: center; gap: 10px; }
    .quiz-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4); padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }
    
    .progress-bar-wrap { width: 100%; height: 6px; background: #e2e8f0; }
    .progress-bar-fill { height: 100%; background: linear-gradient(90deg, #2563eb, #3b82f6); width: 0%; transition: width 0.3s ease; }

    .step { display: none; padding: 40px 32px; }
    .step.active { display: block; animation: fadeUp 0.35s ease; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .question-dim { display: inline-block; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .06em; color: #2563eb; background: #eff6ff; padding: 4px 12px; border-radius: 999px; margin-bottom: 16px; }
    .question-text { font-family: 'Sora', sans-serif; font-size: 21px; font-weight: 700; color: #0f172a; margin-bottom: 28px; line-height: 1.45; }

    /* Images */
    .q-images { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; justify-content: center; background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; }
    .q-images img { max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 6px; }

    /* Options */
    .options-grid { display: grid; grid-template-columns: 1fr; gap: 12px; }
    .options-grid.images-grid { grid-template-columns: repeat(2, 1fr); }

    .option-card { border: 2px solid #e2e8f0; border-radius: 12px; padding: 16px 20px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; gap: 14px; font-size: 15.5px; font-weight: 500; background: #ffffff; color: #1e293b; }
    .option-card:hover { border-color: #2563eb; background: #f8fafc; transform: translateY(-1px); }
    .option-card.selected { border-color: #2563eb; background: #eff6ff; color: #1d4ed8; font-weight: 700; box-shadow: 0 0 0 1px #2563eb; }

    .option-letter { width: 30px; height: 30px; border-radius: 8px; background: #f1f5f9; color: #475569; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800; flex-shrink: 0; transition: all 0.2s; }
    .option-card.selected .option-letter { background: #2563eb; color: #ffffff; }

    .option-card img { max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 4px; display: block; margin: 0 auto; }
    .option-card.has-image { justify-content: center; padding: 12px; }

    /* Footer */
    .quiz-footer { padding: 20px 32px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
    .btn { padding: 12px 26px; font-size: 14.5px; font-weight: 700; border-radius: 10px; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
    .btn-outline { border: 1.5px solid #cbd5e1; color: #475569; background: white; }
    .btn-outline:hover { background: #e2e8f0; color: #0f172a; }
    .btn-primary { background: #2563eb; color: white; border: none; }
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

    /* Submitting overlay */
    .submitting-overlay { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); display: none; flex-direction: column; align-items: center; justify-content: center; z-index: 9999; color: #ffffff; }
    .spinner { width: 50px; height: 50px; border: 4px solid rgba(255,255,255,0.2); border-left-color: #3b82f6; border-radius: 50%; animation: spin 0.9s linear infinite; margin-bottom: 20px; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>
@endsection

@section('content')
<div class="container" style="padding-top: 20px; padding-bottom: 60px;">
    
    <!-- Submitting Overlay -->
    <div class="submitting-overlay" id="submittingOverlay">
        <div class="spinner"></div>
        <div style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; margin-bottom: 6px;">Analyzing Cognitive Dimensions...</div>
        <div style="font-size: 14px; color: #cbd5e1;">Evaluating cognitive factors and matching career tracks...</div>
    </div>

    <div class="quiz-container" id="quizApp">
        <div class="quiz-header">
            <div>
                <h2>
                    <i class="fa-solid fa-crown" style="color: #fbbf24; font-size: 18px;"></i>
                    Advanced Career Assessment
                </h2>
                <span class="quiz-badge">CareerGyan Pro</span>
            </div>
            <div style="display: flex; align-items: center; gap: 18px;">
                <div style="display: flex; align-items: center; gap: 8px; font-family: 'Sora', sans-serif; font-weight: 700; color: #0f172a; background: #ffffff; padding: 6px 14px; border-radius: 20px; font-size: 14px;">
                    <i class="fa-solid fa-clock" style="color: #2563eb;"></i>
                    <span id="advTimer">25:00</span>
                </div>
                <div style="font-size: 14px; font-weight: 700; color: #cbd5e1;">
                    <span id="currentStepNum" style="color: #ffffff;">1</span> / <span id="totalStepsNum">{{ count($questions) }}</span>
                </div>
            </div>
        </div>

        <div class="progress-bar-wrap">
            <div class="progress-bar-fill" id="progressBar"></div>
        </div>

        <!-- Questions Container -->
        <div id="quizQuestionsContainer"></div>

        <div class="quiz-footer">
            <button type="button" class="btn btn-outline" id="btnPrev" style="visibility: hidden;">
                <i class="fa-solid fa-arrow-left"></i> Previous
            </button>
            <button type="button" class="btn btn-primary" id="btnNext" disabled>
                Next Question <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const questionsData = @json($questions);

    const state = {
        currentStep: 0,
        totalQuestions: questionsData.length,
        answers: {}, // question_id => answer string
    };

    const DOM = {
        questionsContainer: document.getElementById('quizQuestionsContainer'),
        currentStepNum: document.getElementById('currentStepNum'),
        totalStepsNum: document.getElementById('totalStepsNum'),
        progressBar: document.getElementById('progressBar'),
        btnPrev: document.getElementById('btnPrev'),
        btnNext: document.getElementById('btnNext'),
        overlay: document.getElementById('submittingOverlay'),
    };

    DOM.totalStepsNum.innerText = state.totalQuestions;

    function renderQuestions() {
        let html = '';
        const letters = ['A', 'B', 'C', 'D', 'E'];

        questionsData.forEach((q, index) => {
            let imageHtml = '';
            if (q.question_images && q.question_images.length > 0) {
                imageHtml = `<div class="q-images">`;
                q.question_images.forEach(img => {
                    imageHtml += `<img src="/images/aptitude/${img}" alt="Visual">`;
                });
                imageHtml += `</div>`;
            }

            let optionsHtml = '';
            const isImageOptions = q.options_type === 'image';
            const gridClass = isImageOptions ? 'images-grid' : '';

            optionsHtml += `<div class="options-grid ${gridClass}" id="options-${q.id}">`;
            
            if (q.options && Array.isArray(q.options)) {
                q.options.forEach((opt, optIdx) => {
                    const optContent = isImageOptions 
                        ? `<img src="/images/aptitude/${opt}" alt="Option">`
                        : `<span>${opt}</span>`;
                    
                    const letter = letters[optIdx] || (optIdx + 1);

                    optionsHtml += `
                        <div class="option-card ${isImageOptions ? 'has-image' : ''}" data-qid="${q.id}" data-val="${opt}" onclick="selectOption(this)">
                            <span class="option-letter">${letter}</span>
                            ${optContent}
                        </div>
                    `;
                });
            }
            optionsHtml += `</div>`;

            html += `
                <div class="step" id="step-q-${index}">
                    <span class="question-dim">${q.dimension_name || 'Aptitude'}</span>
                    <div class="question-text">${q.question_text || 'Solve the following question:'}</div>
                    ${imageHtml}
                    ${optionsHtml}
                </div>
            `;
        });

        DOM.questionsContainer.innerHTML = html;
    }

    window.selectOption = function(el) {
        const parent = el.parentNode;
        parent.querySelectorAll('.option-card').forEach(s => s.classList.remove('selected'));
        el.classList.add('selected');

        const qid = el.getAttribute('data-qid');
        const val = el.getAttribute('data-val');
        state.answers[qid] = val;

        validateStep();
    };

    function updateView() {
        DOM.currentStepNum.innerText = state.currentStep + 1;
        const pct = ((state.currentStep + 1) / state.totalQuestions) * 100;
        DOM.progressBar.style.width = pct + '%';

        document.querySelectorAll('[id^="step-q-"]').forEach(el => el.classList.remove('active'));

        const stepEl = document.getElementById('step-q-' + state.currentStep);
        if (stepEl) stepEl.classList.add('active');

        DOM.btnPrev.style.visibility = (state.currentStep === 0) ? 'hidden' : 'visible';

        if (state.currentStep === state.totalQuestions - 1) {
            DOM.btnNext.innerHTML = `Submit & View Report <i class="fa-solid fa-circle-check"></i>`;
        } else {
            DOM.btnNext.innerHTML = `Next Question <i class="fa-solid fa-arrow-right"></i>`;
        }

        validateStep();
    }

    function validateStep() {
        let isValid = false;
        const currentQ = questionsData[state.currentStep];
        if (currentQ && state.answers[currentQ.id]) isValid = true;
        DOM.btnNext.disabled = !isValid;
    }

    DOM.btnNext.addEventListener('click', () => {
        if (state.currentStep === state.totalQuestions - 1) {
            submitQuiz();
        } else {
            state.currentStep++;
            updateView();
            window.scrollTo({ top: DOM.questionsContainer.offsetTop - 80, behavior: 'smooth' });
        }
    });

    DOM.btnPrev.addEventListener('click', () => {
        if (state.currentStep > 0) {
            state.currentStep--;
            updateView();
            window.scrollTo({ top: DOM.questionsContainer.offsetTop - 80, behavior: 'smooth' });
        }
    });

    function submitQuiz() {
        DOM.btnNext.disabled = true;
        DOM.overlay.style.display = 'flex';

        fetch("{{ route('advanced-test.submit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                answers: state.answers
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.redirect_url) {
                window.location.href = data.redirect_url;
            } else {
                DOM.overlay.style.display = 'none';
                DOM.btnNext.disabled = false;
                alert(data.message || 'Error submitting test. Please try again.');
            }
        })
        .catch(err => {
            DOM.overlay.style.display = 'none';
            DOM.btnNext.disabled = false;
            console.error(err);
            alert('A network error occurred. Please try again.');
        });
    }

    // 25-minute countdown
    let timeLeft = 25 * 60;
    const timerDisplay = document.getElementById('advTimer');
    const countdown = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            alert("Time's up! Your assessment will now be submitted automatically.");
            submitQuiz();
        }
        timeLeft--;
    }, 1000);

    // Initial render
    renderQuestions();
    updateView();
</script>
@endsection

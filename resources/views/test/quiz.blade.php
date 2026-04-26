@extends('layouts.app')

@section('title', 'Aptitude Test | CareerGyan')

@section('styles')
<style>
    .quiz-container { max-width: 800px; margin: 40px auto; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); overflow: hidden; border: 1px solid var(--border); }
    .quiz-header { background: var(--brand-light); padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); }
    .quiz-header h2 { font-family: 'Sora'; font-size: 20px; color: var(--brand-dark); }
    .quiz-progress { font-size: 14px; font-weight: 600; color: var(--brand); /* For the counter */ }
    
    .progress-bar { width: 100%; height: 6px; background: var(--border); }
    .progress-bar-fill { height: 100%; background: var(--brand); width: 0%; transition: width 0.3s ease; }

    .step { display: none; padding: 40px 30px; }
    .step.active { display: block; animation: fadeUp 0.4s ease; }

    /* Form Elements */
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 15px; color: var(--text-1); }
    .form-control { width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: var(--radius-md); font-family: inherit; font-size: 15px; outline: none; transition: border-color 0.2s; background: var(--bg); }
    .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 3px var(--brand-light); }

    /* Quiz Elements */
    .question-dim { display: inline-block; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: var(--accent); margin-bottom: 12px; }
    .question-text { font-family: 'Sora'; font-size: 22px; font-weight: 600; color: var(--text-1); margin-bottom: 24px; line-height: 1.4; }
    
    /* Images */
    .q-images { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; justify-content: center; background: var(--bg); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border); }
    .q-images img { max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

    /* Options */
    .options-grid { display: grid; grid-template-columns: 1fr; gap: 12px; }
    .options-grid.images-grid { grid-template-columns: repeat(2, 1fr); }
    
    .option-card { border: 2px solid var(--border); border-radius: var(--radius-md); padding: 16px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 12px; font-size: 16px; font-weight: 500; background: white; }
    .option-card:hover { border-color: var(--brand); background: var(--brand-light); }
    .option-card.selected { border-color: var(--brand); background: var(--brand-light); box-shadow: 0 0 0 1px var(--brand); }
    
    .option-card img { max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 4px; display: block; margin: 0 auto; }
    .option-card.has-image { justify-content: center; padding: 10px; }

    /* Footer */
    .quiz-footer { padding: 20px 30px; background: var(--bg); border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .btn { padding: 12px 24px; font-size: 15px; font-weight: 600; border-radius: var(--radius-md); transition: all 0.2s; }
    .btn-outline { border: 1px solid var(--border); color: var(--text-2); background: white; }
    .btn-outline:hover { background: var(--border); color: var(--text-1); }
    .btn-primary { background: var(--brand); color: white; }
    .btn-primary:hover { background: var(--brand-dark); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }

</style>
@endsection

@section('content')
<main>
    <div class="container">
        <div class="quiz-container" id="quizApp">
            
            <div class="quiz-header">
                <h2>Skill Assessment</h2>
                <div class="quiz-progress"><span id="currentStepNum">1</span> / <span id="totalStepsNum">?</span></div>
            </div>
            
            <div class="progress-bar">
                <div class="progress-bar-fill" id="progressBar"></div>
            </div>

            <!-- Profile Step -->
            <div class="step active" id="step-profile">
                <div class="question-text">Let's personalize your results</div>
                <p style="color: var(--text-2); margin-bottom: 30px;">Tell us a bit about your background so we can match you with the best fit careers.</p>
                
                <div class="form-group">
                    <label>Current Qualification Level</label>
                    <select class="form-control" id="inputQual">
                        <option value="">Select Qualification...</option>
                        <option value="high_school">High School (10th/12th)</option>
                        <option value="bachelors">Bachelor's Degree</option>
                        <option value="masters">Master's Degree</option>
                        <option value="diploma">Diploma / Certification</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Expected Budget for Education/Training (₹)</label>
                    <select class="form-control" id="inputBudget">
                        <option value="">Select Budget...</option>
                        <option value="50000">< ₹50,000</option>
                        <option value="150000">₹50,000 - ₹2,00,000</option>
                        <option value="500000">₹2,00,000 - ₹10,00,000</option>
                        <option value="1000000">> ₹10,00,000 (No Constraint)</option>
                    </select>
                </div>
            </div>

            <!-- Quiz Steps injected by JS below -->
            <div id="quizQuestionsContainer"></div>

            <div class="quiz-footer">
                <button class="btn btn-outline" id="btnPrev" style="visibility: hidden;">Back</button>
                <button class="btn btn-primary" id="btnNext">Continue</button>
            </div>

        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    const questionsData = @json($questions);
    
    // Application State
    const state = {
        currentStep: -1, // -1 is Profile, 0 is first question
        totalQuestions: questionsData.length,
        answers: {}, // question_id => answer string
        profile: {
            qual: '',
            budget: ''
        }
    };

    const DOM = {
        stepProfile: document.getElementById('step-profile'),
        questionsContainer: document.getElementById('quizQuestionsContainer'),
        btnNext: document.getElementById('btnNext'),
        btnPrev: document.getElementById('btnPrev'),
        progressFill: document.getElementById('progressBar'),
        currentStepNum: document.getElementById('currentStepNum'),
        totalStepsNum: document.getElementById('totalStepsNum'),
        quizProgress: document.querySelector('.quiz-progress')
    };

    DOM.totalStepsNum.innerText = state.totalQuestions;

    // Initialize Questions HTML
    function renderQuestions() {
        let html = '';
        questionsData.forEach((q, index) => {
            let imageHtml = '';
            if (q.question_images && q.question_images.length > 0) {
                imageHtml = `<div class="q-images">`;
                q.question_images.forEach(img => {
                    imageHtml += `<img src="/images/aptitude/${img}" alt="Question Image">`;
                });
                imageHtml += `</div>`;
            }

            let optionsHtml = '';
            const isImageOptions = q.options_type === 'image';
            const gridClass = isImageOptions ? 'images-grid' : '';

            optionsHtml += `<div class="options-grid ${gridClass}" id="options-${q.id}">`;
            
            if (q.options && Array.isArray(q.options)) {
                q.options.forEach(opt => {
                    let optContent = isImageOptions 
                        ? `<img src="/images/aptitude/${opt}" alt="Option">`
                        : `<span>${opt}</span>`;
                    
                    optionsHtml += `
                        <div class="option-card ${isImageOptions ? 'has-image' : ''}" data-qid="${q.id}" data-val="${opt}" onclick="selectOption(this)">
                            ${optContent}
                        </div>
                    `;
                });
            }
            optionsHtml += `</div>`;

            html += `
                <div class="step" id="step-q-${index}">
                    <span class="question-dim">${q.dimension_name}</span>
                    <div class="question-text">${q.question_text || 'Solve the following:'}</div>
                    ${imageHtml}
                    ${optionsHtml}
                </div>
            `;
        });
        DOM.questionsContainer.innerHTML = html;
    }

    window.selectOption = function(el) {
        // Remove selected class from siblings
        const parent = el.parentNode;
        const siblings = parent.querySelectorAll('.option-card');
        siblings.forEach(s => s.classList.remove('selected'));
        
        // Add selected to clicked
        el.classList.add('selected');

        // Save answer
        const qid = el.getAttribute('data-qid');
        const val = el.getAttribute('data-val');
        state.answers[qid] = val;

        validateStep();
    }

    function updateView() {
        // Update Progress Bar
        if (state.currentStep === -1) {
            DOM.quizProgress.style.display = 'none';
            DOM.progressFill.style.width = '0%';
        } else {
            DOM.quizProgress.style.display = 'block';
            DOM.currentStepNum.innerText = state.currentStep + 1;
            const pct = ((state.currentStep + 1) / state.totalQuestions) * 100;
            DOM.progressFill.style.width = pct + '%';
        }

        // Hide all steps
        DOM.stepProfile.classList.remove('active');
        document.querySelectorAll('[id^="step-q-"]').forEach(el => el.classList.remove('active'));

        // Show active step
        if (state.currentStep === -1) {
            DOM.stepProfile.classList.add('active');
            DOM.btnPrev.style.visibility = 'hidden';
            DOM.btnNext.innerText = 'Continue to Quiz';
        } else {
            const stepEl = document.getElementById('step-q-' + state.currentStep);
            if (stepEl) stepEl.classList.add('active');
            DOM.btnPrev.style.visibility = 'visible';
            
            if (state.currentStep === state.totalQuestions - 1) {
                DOM.btnNext.innerText = 'Submit & Get Results';
            } else {
                DOM.btnNext.innerText = 'Next Question';
            }
        }
        
        validateStep();
    }

    function validateStep() {
        let isValid = false;
        if (state.currentStep === -1) {
            const qual = document.getElementById('inputQual').value;
            const budget = document.getElementById('inputBudget').value;
            if (qual && budget) isValid = true;
        } else {
            const currentQ = questionsData[state.currentStep];
            if (state.answers[currentQ.id]) isValid = true;
        }
        DOM.btnNext.disabled = !isValid;
    }

    // Event Listeners
    document.getElementById('inputQual').addEventListener('change', validateStep);
    document.getElementById('inputBudget').addEventListener('change', validateStep);

    DOM.btnNext.addEventListener('click', () => {
        if (state.currentStep === -1) {
            state.profile.qual = document.getElementById('inputQual').value;
            state.profile.budget = document.getElementById('inputBudget').value;
        }

        if (state.currentStep === state.totalQuestions - 1) {
            submitQuiz();
        } else {
            state.currentStep++;
            updateView();
        }
    });

    DOM.btnPrev.addEventListener('click', () => {
        if (state.currentStep > -1) {
            state.currentStep--;
            updateView();
        }
    });

    function submitQuiz() {
        DOM.btnNext.disabled = true;
        DOM.btnNext.innerText = 'Analyzing...';
        
        fetch('{{ route("test.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                answers: state.answers,
                profile: state.profile
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url;
            }
        })
        .catch(err => {
            console.error(err);
            DOM.btnNext.disabled = false;
            DOM.btnNext.innerText = 'Error. Try Again.';
        });
    }

    // Init
    renderQuestions();
    updateView();
</script>
@endsection

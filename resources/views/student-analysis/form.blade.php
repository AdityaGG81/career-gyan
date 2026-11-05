@extends('layouts.app')

@section('title', 'Student Analysis - Career & Course Selection Assessment | CareerGyan')

@section('styles')
<style>
  :root {
    --sa-primary: #1a56db;
    --sa-primary-light: #eff6ff;
    --sa-border: #e2e8f0;
    --sa-surface: #ffffff;
    --sa-text: #0f172a;
    --sa-muted: #64748b;
  }

  .sa-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    padding: 40px 20px 80px;
    font-family: 'Inter', system-ui, sans-serif;
  }

  .sa-container {
    max-width: 880px;
    margin: 0 auto;
  }

  /* Header Card */
  .sa-header-card {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    color: #ffffff;
    border-radius: 20px;
    padding: 36px 32px;
    margin-bottom: 28px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    position: relative;
    overflow: hidden;
  }

  .sa-badge-top {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 14px;
  }

  .sa-header-card h1 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 10px;
    line-height: 1.25;
  }

  .sa-header-card p {
    font-size: 14.5px;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    max-width: 720px;
  }

  /* Stepper Progress Bar */
  .sa-stepper-wrap {
    background: #ffffff;
    border: 1px solid var(--sa-border);
    border-radius: 16px;
    padding: 20px 24px;
    margin-bottom: 28px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
  }

  .sa-progress-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--sa-text);
  }

  .sa-progress-bar-bg {
    width: 100%;
    height: 8px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
  }

  .sa-progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #2563eb, #38bdf8);
    width: 16.6%;
    border-radius: 999px;
    transition: width 0.35s ease;
  }

  .sa-steps-indicators {
    display: flex;
    justify-content: space-between;
    margin-top: 14px;
    gap: 8px;
  }

  .sa-step-dot {
    flex: 1;
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    cursor: pointer;
    transition: color 0.2s;
  }

  .sa-step-dot.active {
    color: #2563eb;
  }

  .sa-step-dot.completed {
    color: #059669;
  }

  /* Form Container */
  .sa-form-card {
    background: #ffffff;
    border: 1px solid var(--sa-border);
    border-radius: 20px;
    padding: 36px 32px;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
  }

  .step-pane {
    display: none;
  }

  .step-pane.active {
    display: block;
    animation: fadeIn 0.25s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .step-header {
    border-bottom: 1px solid var(--sa-border);
    padding-bottom: 16px;
    margin-bottom: 28px;
  }

  .step-header h2 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--sa-text);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .step-header p {
    font-size: 13.5px;
    color: var(--sa-muted);
    margin-top: 4px;
  }

  /* Question Groups */
  .q-group {
    margin-bottom: 26px;
  }

  .q-label {
    display: block;
    font-size: 14.5px;
    font-weight: 700;
    color: var(--sa-text);
    margin-bottom: 8px;
    line-height: 1.4;
  }

  .q-label span.req {
    color: #ef4444;
  }

  .q-hint {
    font-size: 12.5px;
    color: var(--sa-muted);
    margin-top: -4px;
    margin-bottom: 8px;
  }

  /* Inputs */
  .sa-input, .sa-select, .sa-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--sa-border);
    border-radius: 12px;
    font-size: 14px;
    color: var(--sa-text);
    background: #fdfdfd;
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
  }

  .sa-input:focus, .sa-select:focus, .sa-textarea:focus {
    border-color: #2563eb;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
  }

  .sa-textarea {
    resize: vertical;
    min-height: 85px;
  }

  /* Multi-column grid */
  .form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  @media(max-width: 640px) {
    .form-grid-2 { grid-template-columns: 1fr; }
    .sa-form-card { padding: 24px 20px; }
    .sa-header-card { padding: 28px 20px; }
  }

  /* Pill Radio & Checkbox buttons */
  .options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
  }

  .option-pill-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border: 1.5px solid var(--sa-border);
    border-radius: 12px;
    background: #fafafa;
    font-size: 13.5px;
    color: var(--sa-text);
    cursor: pointer;
    transition: all 0.2s;
    user-select: none;
  }

  .option-pill-label:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
  }

  .option-pill-label input[type="radio"],
  .option-pill-label input[type="checkbox"] {
    accent-color: #2563eb;
    width: 17px;
    height: 17px;
  }

  .option-pill-label.checked {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #1e40af;
    font-weight: 600;
  }

  /* Likert Rating Scale (1 to 5) */
  .likert-scale-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    background: #f8fafc;
    border: 1px solid var(--sa-border);
    border-radius: 14px;
    padding: 14px 20px;
    margin-top: 6px;
  }

  .likert-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    cursor: pointer;
  }

  .likert-option input {
    accent-color: #2563eb;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .likert-label {
    font-size: 12px;
    font-weight: 600;
    color: #475569;
  }

  .likert-end-text {
    font-size: 11.5px;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
  }

  /* Form Navigation Buttons */
  .form-nav-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid var(--sa-border);
    padding-top: 24px;
    margin-top: 32px;
  }

  .btn-sa-nav {
    padding: 12px 26px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
  }

  .btn-sa-prev {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
  }

  .btn-sa-prev:hover {
    background: #e2e8f0;
    color: #0f172a;
  }

  .btn-sa-next {
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
  }

  .btn-sa-next:hover {
    background: #1d4ed8;
  }

  .btn-sa-submit {
    background: #059669;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
  }

  .btn-sa-submit:hover {
    background: #047857;
  }
</style>
@endsection

@section('content')
<div class="sa-page">
  <div class="sa-container">

    <!-- Header Card -->
    <div class="sa-header-card">
      <div class="sa-badge-top">
        <i class="fa-solid fa-graduation-cap"></i> Student Assessment
      </div>
      <h1>Career & Course Selection Assessment</h1>
      <p>
        This comprehensive questionnaire helps CareerGyan analyze your academic strengths, aptitude, interests, skills, personality, and career goals to suggest the most suitable educational and career pathways. Answer honestly — there are no right or wrong answers!
      </p>
    </div>

    <!-- Stepper Progress Bar -->
    <div class="sa-stepper-wrap">
      <div class="sa-progress-info">
        <span id="stepTitleText">Step 1 of 6: Basic & Academic Profile</span>
        <span id="stepPercentText">16%</span>
      </div>
      <div class="sa-progress-bar-bg">
        <div class="sa-progress-bar-fill" id="progressBar"></div>
      </div>
      <div class="sa-steps-indicators">
        <div class="sa-step-dot active" onclick="jumpToStep(1)">1. Profile</div>
        <div class="sa-step-dot" onclick="jumpToStep(2)">2. Subjects</div>
        <div class="sa-step-dot" onclick="jumpToStep(3)">3. Interests</div>
        <div class="sa-step-dot" onclick="jumpToStep(4)">4. Skills</div>
        <div class="sa-step-dot" onclick="jumpToStep(5)">5. Careers</div>
        <div class="sa-step-dot" onclick="jumpToStep(6)">6. Goals</div>
      </div>
    </div>

    <!-- Form Container -->
    <div class="sa-form-card">
      <form id="studentAnalysisForm" method="POST" action="{{ route('student-analysis.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- ==============================================
             STEP 1: Basic & Academic Profile (Q1 - Q9)
             ============================================== -->
        <div class="step-pane active" id="step1">
          <div class="step-header">
            <h2><i class="fa-solid fa-user" style="color: #2563eb;"></i> Step 1: Academic & Contact Profile</h2>
            <p>Tell us about your educational background and target courses.</p>
          </div>

          <div class="form-grid-2">
            <!-- 1. Full Name -->
            <div class="q-group">
              <label class="q-label">1. Full Name <span class="req">*</span></label>
              <input type="text" name="full_name" class="sa-input" required value="{{ old('full_name', $user?->name ?? ($user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : '')) }}" placeholder="Enter your full name">
            </div>

            <!-- 2. Mobile Number -->
            <div class="q-group">
              <label class="q-label">2. Mobile Number <span class="req">*</span></label>
              <input type="tel" name="mobile_number" class="sa-input" required value="{{ old('mobile_number', $user?->phone ?? '') }}" placeholder="Enter 10-digit mobile number">
            </div>
          </div>

          <div class="form-grid-2">
            <!-- 3. Email ID -->
            <div class="q-group">
              <label class="q-label">3. Email ID <span class="req">*</span></label>
              <input type="email" name="email" class="sa-input" required value="{{ old('email', $user?->email ?? '') }}" placeholder="name@example.com">
            </div>

            <!-- 6. City / District -->
            <div class="q-group">
              <label class="q-label">6. City / District <span class="req">*</span></label>
              <input type="text" name="city_district" class="sa-input" required value="{{ old('city_district', $user?->city ?? '') }}" placeholder="e.g. Pune, Mumbai, Nashik">
            </div>
          </div>

          <!-- 4. Current Class / Qualification -->
          <div class="q-group">
            <label class="q-label">4. Current Class / Qualification <span class="req">*</span></label>
            <div class="options-grid">
              @foreach(['Class 9', 'Class 10', 'Class 11', 'Class 12', 'Diploma', 'Undergraduate', 'Other'] as $opt)
                <label class="option-pill-label">
                  <input type="radio" name="current_class" value="{{ $opt }}" required {{ old('current_class') == $opt ? 'checked' : '' }}>
                  <span>{{ $opt }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 5. Current Stream -->
          <div class="q-group">
            <label class="q-label">5. Current Stream <span class="req">*</span></label>
            <div class="options-grid">
              @foreach(['Science PCM', 'Science PCB', 'Science PCMB', 'Commerce', 'Arts-Humanities', 'Diploma Technical', 'Not Applicable', 'Other'] as $opt)
                <label class="option-pill-label">
                  <input type="radio" name="current_stream" value="{{ $opt }}" required {{ old('current_stream') == $opt ? 'checked' : '' }}>
                  <span>{{ $opt }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 7. Examination Results for the last 3 years -->
          <div class="q-group">
            <label class="q-label">7. Enter your examination results for the last 3 years <span class="req">*</span></label>
            <div class="q-hint">e.g., 10th: 88%, 11th: 82%, 12th / Sem 1: 85% or GPA</div>
            <textarea name="exam_results_last_3_years" class="sa-textarea" required placeholder="Mention your percentages/scores for 9th/10th/11th/12th or college semesters...">{{ old('exam_results_last_3_years') }}</textarea>
          </div>

          <!-- 8. Three Subjects performed well -->
          <div class="q-group">
            <label class="q-label">8. Mention at least THREE subjects in which you have performed well during the last 3 years <span class="req">*</span></label>
            <textarea name="top_subjects_last_3_years" class="sa-textarea" required placeholder="e.g., Mathematics, Physics, English...">{{ old('top_subjects_last_3_years') }}</textarea>
          </div>

          <!-- 9. Desired Admission Course -->
          <div class="q-group">
            <label class="q-label">9. Which course do you currently wish to get admission for? <span class="req">*</span></label>
            <input type="text" name="desired_admission_course" class="sa-input" required value="{{ old('desired_admission_course') }}" placeholder="e.g. B.Tech Computer Science, MBBS, BBA, B.Des, Chartered Accountancy...">
          </div>

          <div class="form-nav-actions">
            <div></div>
            <button type="button" class="btn-sa-nav btn-sa-next" onclick="goToStep(2)">
              Continue to Step 2 &rarr;
            </button>
          </div>
        </div>

        <!-- ==============================================
             STEP 2: Subject Preferences & Aptitude (Q10 - Q15)
             ============================================== -->
        <div class="step-pane" id="step2">
          <div class="step-header">
            <h2><i class="fa-solid fa-book-open-reader" style="color: #2563eb;"></i> Step 2: Subject Preferences & Aptitude</h2>
            <p>Help us understand which subjects energize you and your aptitude test background.</p>
          </div>

          @php
            $subjectOptions = [
              'Mathematics', 'Physics', 'Chemistry', 'Biology', 'Computer IT',
              'English-Languages', 'Social Science', 'Geography', 'Economics',
              'Accountancy', 'Business Studies', 'Drawing-Art', 'Physical Education-Sports', 'Other'
            ];
          @endphp

          <!-- 10. Subjects enjoyed the most -->
          <div class="q-group">
            <label class="q-label">10. Which subjects do you enjoy the most? <span class="req">*</span></label>
            <div class="q-hint">Check all that apply</div>
            <div class="options-grid">
              @foreach($subjectOptions as $sub)
                <label class="option-pill-label">
                  <input type="checkbox" name="enjoyed_subjects[]" value="{{ $sub }}">
                  <span>{{ $sub }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 11. Subjects find difficult -->
          <div class="q-group">
            <label class="q-label">11. Which subjects do you find difficult or do not enjoy? <span class="req">*</span></label>
            <div class="q-hint">Check all that apply</div>
            <div class="options-grid">
              @foreach($subjectOptions as $sub)
                <label class="option-pill-label">
                  <input type="checkbox" name="difficult_subjects[]" value="{{ $sub }}">
                  <span>{{ $sub }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 12. Completed Aptitude Test -->
          <div class="q-group">
            <label class="q-label">12. Have you completed the CareerGyan Aptitude Test? <span class="req">*</span></label>
            <div style="display: flex; gap: 20px;">
              <label class="option-pill-label" style="min-width: 120px;">
                <input type="radio" name="completed_aptitude_test" value="Yes" onchange="toggleAptitudeDetails(true)">
                <span>Yes</span>
              </label>
              <label class="option-pill-label" style="min-width: 120px;">
                <input type="radio" name="completed_aptitude_test" value="No" checked onchange="toggleAptitudeDetails(false)">
                <span>No</span>
              </label>
            </div>
          </div>

          <!-- Aptitude details container (Conditional) -->
          <div id="aptitudeDetailsBox">
            <!-- 13. Scores -->
            <div class="q-group">
              <label class="q-label">13. Enter your CareerGyan Aptitude Test result/scores</label>
              <textarea name="aptitude_test_scores" class="sa-textarea" placeholder="Enter scores or dimensions if known, or write 'Completed on platform'...">{{ old('aptitude_test_scores') }}</textarea>
            </div>

            <!-- 14. Strongest Areas -->
            <div class="q-group">
              <label class="q-label">14. What are your strongest aptitude areas according to the test?</label>
              <div class="options-grid">
                @foreach(['Logical-Analytical', 'Numerical', 'Verbal', 'Spatial', 'Mechanical', 'Perceptual', 'Other', 'Not sure'] as $area)
                  <label class="option-pill-label">
                    <input type="checkbox" name="strongest_aptitude_areas[]" value="{{ $area }}">
                    <span>{{ $area }}</span>
                  </label>
                @endforeach
              </div>
            </div>

            <!-- 15. Upload Report -->
            <div class="q-group">
              <label class="q-label">15. Upload your CareerGyan Aptitude Test Report (Optional)</label>
              <div class="q-hint">Accepted formats: PDF, PNG, JPG (Max 10 MB)</div>
              <input type="file" name="aptitude_report_file" class="sa-input" accept=".pdf,.png,.jpg,.jpeg,.doc,.docx">
            </div>
          </div>

          <div class="form-nav-actions">
            <button type="button" class="btn-sa-nav btn-sa-prev" onclick="goToStep(1)">&larr; Back</button>
            <button type="button" class="btn-sa-nav btn-sa-next" onclick="goToStep(3)">Continue to Step 3 &rarr;</button>
          </div>
        </div>

        <!-- ==============================================
             STEP 3: Personal Interests & Activities (Q16 - Q19)
             ============================================== -->
        <div class="step-pane" id="step3">
          <div class="step-header">
            <h2><i class="fa-solid fa-heart" style="color: #ec4899;"></i> Step 3: Personal Interests & Activities</h2>
            <p>Tell us about your passions, hobbies, and activities outside textbooks.</p>
          </div>

          <!-- 16. Personal Interests -->
          <div class="q-group">
            <label class="q-label">16. What are your main personal interests? <span class="req">*</span></label>
            <textarea name="personal_interests" class="sa-textarea" required placeholder="e.g. Technology gadgets, stock markets, medicine, sketching, creative writing, robotics...">{{ old('personal_interests') }}</textarea>
          </div>

          <!-- 17. Special Hobbies -->
          <div class="q-group">
            <label class="q-label">17. Do you have any special hobby, talent, art or extracurricular activity?</label>
            <textarea name="special_hobbies_talents" class="sa-textarea" placeholder="e.g. Playing guitar, state-level badminton, graphic design, debate, coding projects...">{{ old('special_hobbies_talents') }}</textarea>
          </div>

          <!-- 18. Activities enjoy -->
          <div class="q-group">
            <label class="q-label">18. Which activities do you enjoy?</label>
            <div class="q-hint">Check all that apply</div>
            @php
              $activityOptions = [
                'Solving mathematical problems', 'Coding-Computers-Technology', 'Building or repairing things',
                'Drawing-Designing', 'Reading-Writing', 'Scientific experiments', 'Helping people',
                'Teaching', 'Business-Selling-Marketing', 'Managing people or events', 'Working with machines-vehicles',
                'Healthcare', 'Finance-Investment', 'Nature-Agriculture-Environment', 'Performing Arts',
                'Sports-Fitness', 'Travelling-Exploring', 'Social work', 'Other'
              ];
            @endphp
            <div class="options-grid">
              @foreach($activityOptions as $act)
                <label class="option-pill-label">
                  <input type="checkbox" name="enjoyed_activities[]" value="{{ $act }}">
                  <span>{{ $act }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 19. Completely Free Day -->
          <div class="q-group">
            <label class="q-label">19. If you get a completely free day, what would you naturally like to do?</label>
            <textarea name="free_day_preference" class="sa-textarea" placeholder="Describe your ideal day spent doing what you genuinely love...">{{ old('free_day_preference') }}</textarea>
          </div>

          <div class="form-nav-actions">
            <button type="button" class="btn-sa-nav btn-sa-prev" onclick="goToStep(2)">&larr; Back</button>
            <button type="button" class="btn-sa-nav btn-sa-next" onclick="goToStep(4)">Continue to Step 4 &rarr;</button>
          </div>
        </div>

        <!-- ==============================================
             STEP 4: Skills & Work Style Personality (Q20 - Q25)
             ============================================== -->
        <div class="step-pane" id="step4">
          <div class="step-header">
            <h2><i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Step 4: Skills & Work Personality</h2>
            <p>Let's map your core strengths, problem-solving mindset, and interpersonal traits.</p>
          </div>

          <!-- 20. Strongest Skills (Select Upto 5) -->
          <div class="q-group">
            <label class="q-label">20. What are your strongest skills? (Select up to 5) <span class="req">*</span></label>
            @php
              $skillOptions = [
                'Problem solving', 'Creativity', 'Mathematics', 'Computer-Technology skills',
                'Communication', 'Leadership', 'Drawing-Designing', 'Writing',
                'Practical-Technical skills', 'Organising', 'Teamwork', 'Helping others',
                'Decision making', 'Other'
              ];
            @endphp
            <div class="options-grid">
              @foreach($skillOptions as $sk)
                <label class="option-pill-label">
                  <input type="checkbox" name="strongest_skills[]" value="{{ $sk }}">
                  <span>{{ $sk }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 21. Work Mainly With -->
          <div class="q-group">
            <label class="q-label">21. You would prefer working mainly with: <span class="req">*</span></label>
            <div class="options-grid">
              @foreach(['People', 'Computers and data', 'Machines and tools', 'Numbers', 'Ideas and research', 'Art and design', 'Nature-environment', 'A combination'] as $opt)
                <label class="option-pill-label">
                  <input type="radio" name="work_with_preference" value="{{ $opt }}" required>
                  <span>{{ $opt }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 22. Work style -->
          <div class="q-group">
            <label class="q-label">22. You prefer: <span class="req">*</span></label>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
              @foreach(['Working independently', 'Working in a team', 'Both'] as $ws)
                <label class="option-pill-label" style="min-width: 170px;">
                  <input type="radio" name="work_style" value="{{ $ws }}" required>
                  <span>{{ $ws }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 23. Description suits best (Upto 3) -->
          <div class="q-group">
            <label class="q-label">23. Which description suits you best? (Choose up to 3) <span class="req">*</span></label>
            @php
              $descOptions = [
                'Analytical', 'Creative', 'Practical', 'Social-Helpful', 'Organised',
                'Curious-Research-oriented', 'Enterprising-Business-minded', 'Technical',
                'Artistic', 'Leadership-oriented'
              ];
            @endphp
            <div class="options-grid">
              @foreach($descOptions as $desc)
                <label class="option-pill-label">
                  <input type="checkbox" name="personality_descriptions[]" value="{{ $desc }}">
                  <span>{{ $desc }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 24. Problem Solving Likert -->
          <div class="q-group">
            <label class="q-label">24. I enjoy solving difficult or unfamiliar problems</label>
            <div class="likert-scale-wrap">
              <span class="likert-end-text">Strongly Disagree</span>
              @for($i=1; $i<=5; $i++)
                <label class="likert-option">
                  <span class="likert-label">{{ $i }}</span>
                  <input type="radio" name="problem_solving_rating" value="{{ $i }}" {{ $i==3 ? 'checked' : '' }}>
                </label>
              @endfor
              <span class="likert-end-text">Strongly Agree</span>
            </div>
          </div>

          <!-- 25. Learn New Tech Likert -->
          <div class="q-group">
            <label class="q-label">25. I enjoy learning new technology or new skills</label>
            <div class="likert-scale-wrap">
              <span class="likert-end-text">Strongly Disagree</span>
              @for($i=1; $i<=5; $i++)
                <label class="likert-option">
                  <span class="likert-label">{{ $i }}</span>
                  <input type="radio" name="learning_tech_rating" value="{{ $i }}" {{ $i==4 ? 'checked' : '' }}>
                </label>
              @endfor
              <span class="likert-end-text">Strongly Agree</span>
            </div>
          </div>

          <div class="form-nav-actions">
            <button type="button" class="btn-sa-nav btn-sa-prev" onclick="goToStep(3)">&larr; Back</button>
            <button type="button" class="btn-sa-nav btn-sa-next" onclick="goToStep(5)">Continue to Step 5 &rarr;</button>
          </div>
        </div>

        <!-- ==============================================
             STEP 5: Career Fields & Environment (Q26 - Q33)
             ============================================== -->
        <div class="step-pane" id="step5">
          <div class="step-header">
            <h2><i class="fa-solid fa-briefcase" style="color: #2563eb;"></i> Step 5: Career Fields & Environment</h2>
            <p>Tell us about the fields and environments you envision yourself thriving in.</p>
          </div>

          <!-- 26. Career Fields (Choose Upto 5) -->
          <div class="q-group">
            <label class="q-label">26. Which career fields currently interest you? (Choose up to 5) <span class="req">*</span></label>
            @php
              $fieldOptions = [
                'Engineering & Technology', 'Computer Science-IT-AI', 'Medical & Healthcare',
                'Pure Science & Research', 'Commerce & Finance', 'Business & Management',
                'Entrepreneurship', 'Architecture', 'Design-Creative Arts', 'Law',
                'Government-Civil Services', 'Defence', 'Teaching-Education', 'Agriculture',
                'Environment', 'Media-Journalism', 'Psychology-Social Sciences', 'Sports',
                'Hospitality-Tourism', 'Other', 'I am not sure'
              ];
            @endphp
            <div class="options-grid">
              @foreach($fieldOptions as $fld)
                <label class="option-pill-label">
                  <input type="checkbox" name="interested_career_fields[]" value="{{ $fld }}">
                  <span>{{ $fld }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 27. Dream Career -->
          <div class="q-group">
            <label class="q-label">27. Do you currently have a dream career?</label>
            <input type="text" name="dream_career" class="sa-input" placeholder="e.g. AI Research Scientist, Neurosurgeon, Investment Banker, Aerospace Engineer...">
          </div>

          <!-- 28. Why Career Interests You -->
          <div class="q-group">
            <label class="q-label">28. Why does this career interest you?</label>
            <textarea name="dream_career_reason" class="sa-textarea" placeholder="What motivates you about this role? Is it impact, innovation, problem-solving, or lifestyle?"></textarea>
          </div>

          <!-- 29. Career Priorities (Choose Max 3) -->
          <div class="q-group">
            <label class="q-label">29. What is most important to you in your future career? (Choose up to 3) <span class="req">*</span></label>
            @php
              $priorityOptions = [
                'Personal interest', 'High income', 'Job security', 'Career growth',
                'Creativity', 'Helping society', 'Social Respect', 'Work-life balance',
                'Government job', 'Entrepreneurship', 'Opportunities abroad', 'Flexible working',
                'Family preference'
              ];
            @endphp
            <div class="options-grid">
              @foreach($priorityOptions as $prio)
                <label class="option-pill-label">
                  <input type="checkbox" name="career_priorities[]" value="{{ $prio }}">
                  <span>{{ $prio }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 30. Business Startup -->
          <div class="q-group">
            <label class="q-label">30. Would you like to start your own business/startup someday?</label>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
              @foreach(['Yes', 'No', 'Maybe'] as $biz)
                <label class="option-pill-label" style="min-width: 120px;">
                  <input type="radio" name="business_startup_interest" value="{{ $biz }}" {{ $biz=='Maybe' ? 'checked' : '' }}>
                  <span>{{ $biz }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 31. Where would you enjoy working -->
          <div class="q-group">
            <label class="q-label">31. Where would you enjoy working?</label>
            <div class="q-hint">Check all that apply</div>
            @php
              $envOptions = [
                'Office', 'Computer-Technology environment', 'Laboratory', 'Hospital-Healthcare',
                'Factory-Industry', 'Construction site', 'Outdoor-Field', 'Studio-Creative environment',
                'School-College', 'Business environment', 'Government organisation', 'Work from home', 'No preference'
              ];
            @endphp
            <div class="options-grid">
              @foreach($envOptions as $env)
                <label class="option-pill-label">
                  <input type="checkbox" name="preferred_work_environments[]" value="{{ $env }}">
                  <span>{{ $env }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 32. Interaction with people rating -->
          <div class="q-group">
            <label class="q-label">32. Would you be comfortable with a career involving frequent interaction with people?</label>
            <div class="likert-scale-wrap">
              <span class="likert-end-text">Not Comfortable</span>
              @for($i=1; $i<=5; $i++)
                <label class="likert-option">
                  <span class="likert-label">{{ $i }}</span>
                  <input type="radio" name="people_interaction_comfort" value="{{ $i }}" {{ $i==3 ? 'checked' : '' }}>
                </label>
              @endfor
              <span class="likert-end-text">Very Comfortable</span>
            </div>
          </div>

          <!-- 33. Machines/Tools rating -->
          <div class="q-group">
            <label class="q-label">33. Would you be comfortable working with machines, tools or technical equipment?</label>
            <div class="likert-scale-wrap">
              <span class="likert-end-text">Not Comfortable</span>
              @for($i=1; $i<=5; $i++)
                <label class="likert-option">
                  <span class="likert-label">{{ $i }}</span>
                  <input type="radio" name="machines_tools_comfort" value="{{ $i }}" {{ $i==3 ? 'checked' : '' }}>
                </label>
              @endfor
              <span class="likert-end-text">Very Comfortable</span>
            </div>
          </div>

          <div class="form-nav-actions">
            <button type="button" class="btn-sa-nav btn-sa-prev" onclick="goToStep(4)">&larr; Back</button>
            <button type="button" class="btn-sa-nav btn-sa-next" onclick="goToStep(6)">Continue to Step 6 &rarr;</button>
          </div>
        </div>

        <!-- ==============================================
             STEP 6: Higher Education, Budget & Goals (Q34 - Q47)
             ============================================== -->
        <div class="step-pane" id="step6">
          <div class="step-header">
            <h2><i class="fa-solid fa-flag-checkered" style="color: #059669;"></i> Step 6: Education Preferences & Support</h2>
            <p>Final details on your educational roadmap, parent suggestions, and where you need guidance.</p>
          </div>

          <!-- 34. Higher Studies -->
          <div class="q-group">
            <label class="q-label">34. Are you willing to pursue higher studies after graduation? <span class="req">*</span></label>
            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
              @foreach(['Yes', 'No', 'Maybe-Not decided'] as $hs)
                <label class="option-pill-label" style="min-width: 150px;">
                  <input type="radio" name="higher_studies_willingness" value="{{ $hs }}" required {{ $hs=='Yes' ? 'checked' : '' }}>
                  <span>{{ $hs }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="form-grid-2">
            <!-- 35. Outside City -->
            <div class="q-group">
              <label class="q-label">35. Willing to study outside your city? <span class="req">*</span></label>
              <div style="display: flex; gap: 16px;">
                <label class="option-pill-label" style="min-width: 100px;">
                  <input type="radio" name="study_outside_city" value="Yes" checked>
                  <span>Yes</span>
                </label>
                <label class="option-pill-label" style="min-width: 100px;">
                  <input type="radio" name="study_outside_city" value="No">
                  <span>No</span>
                </label>
              </div>
            </div>

            <!-- 38. Scholarships / Loans -->
            <div class="q-group">
              <label class="q-label">38. Need info on scholarships or education loans?</label>
              <div style="display: flex; gap: 16px;">
                @foreach(['Yes', 'No', 'Maybe'] as $sl)
                  <label class="option-pill-label" style="min-width: 80px;">
                    <input type="radio" name="need_scholarship_loan_info" value="{{ $sl }}" {{ $sl=='Yes' ? 'checked' : '' }}>
                    <span>{{ $sl }}</span>
                  </label>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 36. Preferred Study Location -->
          <div class="q-group">
            <label class="q-label">36. Where would you prefer to study? <span class="req">*</span></label>
            <div class="options-grid">
              @foreach(['Same City', 'Same District', 'Anywhere in Maharashtra', 'Anywhere in India', 'Abroad', 'No restriction'] as $loc)
                <label class="option-pill-label">
                  <input type="radio" name="preferred_study_location" value="{{ $loc }}" required {{ $loc=='Anywhere in Maharashtra' ? 'checked' : '' }}>
                  <span>{{ $loc }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 37. Annual Budget -->
          <div class="q-group">
            <label class="q-label">37. Approximate annual education budget</label>
            <input type="text" name="annual_education_budget" class="sa-input" placeholder="e.g. Under ₹1 Lakh, ₹2 - ₹4 Lakhs, ₹5 - ₹10 Lakhs, No specific limit">
          </div>

          <!-- 39. Top 3 Careers/Courses -->
          <div class="q-group">
            <label class="q-label">39. Which THREE careers/courses currently interest you the most? <span class="req">*</span></label>
            <textarea name="top_three_careers_courses" class="sa-textarea" required placeholder="1. Computer Engineering (AI/ML)&#10;2. Data Science&#10;3. Product Management"></textarea>
          </div>

          <!-- 40 & 41: Parents -->
          <div class="form-grid-2">
            <div class="q-group">
              <label class="q-label">40. Which career/course do parents or family suggest?</label>
              <input type="text" name="parent_suggested_career" class="sa-input" placeholder="e.g. Civil Services, MBBS, Software Engineer">
            </div>

            <div class="q-group">
              <label class="q-label">41. Are your and your parents' preferences the same?</label>
              <select name="parent_preference_alignment" class="sa-select">
                @foreach(['Yes', 'No', 'Partially', "We haven't discussed it", "I haven't decided yet"] as $al)
                  <option value="{{ $al }}">{{ $al }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- 42. Limitations -->
          <div class="q-group">
            <label class="q-label">42. Any family, financial, health, location or other limitation to consider?</label>
            <textarea name="limitations_constraints" class="sa-textarea" placeholder="e.g. Prefer colleges in Pune due to family, need affordable fee structure, etc."></textarea>
          </div>

          <!-- 43 & 44. Dream career without limitations -->
          <div class="form-grid-2">
            <div class="q-group">
              <label class="q-label">43. If marks, money & location were NOT limitations, what career would you choose?</label>
              <input type="text" name="dream_career_no_limitations" class="sa-input" placeholder="e.g. Commercial Pilot, Game Director, Quantum Physicist">
            </div>
            <div class="q-group">
              <label class="q-label">44. Why would you choose it?</label>
              <input type="text" name="no_limitations_reason" class="sa-input" placeholder="Why does this career appeal to your heart?">
            </div>
          </div>

          <!-- 45. Biggest Confusion -->
          <div class="q-group">
            <label class="q-label">45. What is your biggest confusion regarding your career?</label>
            <textarea name="biggest_career_confusion" class="sa-textarea" placeholder="e.g. Confused between Computer Engineering vs Electronics, or should I prepare for GATE vs Placements?"></textarea>
          </div>

          <!-- 46. Help requested -->
          <div class="q-group">
            <label class="q-label">46. What would you like CareerGyan to help you with?</label>
            <div class="q-hint">Check all that apply</div>
            @php
              $helpOptions = [
                'Selecting the right career', 'Selecting the right course', 'Selecting a specialisation-branch',
                'Entrance examinations', 'College selection', 'Understanding career opportunities',
                'Career aptitude analysis', 'Scholarships', 'Higher education', 'Career Counseling', 'Other'
              ];
            @endphp
            <div class="options-grid">
              @foreach($helpOptions as $hlp)
                <label class="option-pill-label">
                  <input type="checkbox" name="help_requested[]" value="{{ $hlp }}">
                  <span>{{ $hlp }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- 47. Anything else -->
          <div class="q-group">
            <label class="q-label">47. Anything else you would like to tell CareerGyan about yourself?</label>
            <textarea name="additional_info" class="sa-textarea" placeholder="Any specific questions, aspirations, or details you want our counseling team to review..."></textarea>
          </div>

          <div class="form-nav-actions">
            <button type="button" class="btn-sa-nav btn-sa-prev" onclick="goToStep(5)">&larr; Back</button>
            <button type="submit" class="btn-sa-nav btn-sa-submit">
              <i class="fa-solid fa-paper-plane"></i> Submit Student Analysis
            </button>
          </div>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
  let currentStep = 1;
  const totalSteps = 6;
  const stepTitles = [
    "Step 1 of 6: Basic & Academic Profile",
    "Step 2 of 6: Subject Preferences & Aptitude",
    "Step 3 of 6: Personal Interests & Activities",
    "Step 4 of 6: Skills & Work Personality",
    "Step 5 of 6: Career Fields & Environment",
    "Step 6 of 6: Education Preferences & Support"
  ];

  function updateStepUI() {
    // Hide all steps, show current
    document.querySelectorAll('.step-pane').forEach((p, idx) => {
      p.classList.toggle('active', idx + 1 === currentStep);
    });

    // Update progress bar & text
    const percent = Math.round((currentStep / totalSteps) * 100);
    document.getElementById('progressBar').style.width = percent + '%';
    document.getElementById('stepTitleText').textContent = stepTitles[currentStep - 1];
    document.getElementById('stepPercentText').textContent = percent + '%';

    // Update step dots
    document.querySelectorAll('.sa-step-dot').forEach((dot, idx) => {
      dot.classList.toggle('active', idx + 1 === currentStep);
      dot.classList.toggle('completed', idx + 1 < currentStep);
    });

    // Scroll smoothly to top of card
    window.scrollTo({ top: document.querySelector('.sa-stepper-wrap').offsetTop - 30, behavior: 'smooth' });
  }

  function validateStep(step) {
    const pane = document.getElementById('step' + step);
    const requiredInputs = pane.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    let firstInvalid = null;

    // Check text/select/textarea
    requiredInputs.forEach(input => {
      if (input.type === 'radio') {
        const name = input.name;
        const checked = pane.querySelector(`input[name="${name}"]:checked`);
        if (!checked) {
          isValid = false;
          if (!firstInvalid) firstInvalid = input;
        }
      } else if (!input.value.trim()) {
        isValid = false;
        input.style.borderColor = '#ef4444';
        if (!firstInvalid) firstInvalid = input;
      } else {
        input.style.borderColor = '';
      }
    });

    if (!isValid) {
      alert('Please fill out all required fields before proceeding.');
      if (firstInvalid) firstInvalid.focus();
    }

    return isValid;
  }

  function goToStep(step) {
    if (step > currentStep) {
      if (!validateStep(currentStep)) return;
    }
    currentStep = step;
    updateStepUI();
  }

  function jumpToStep(step) {
    if (step <= currentStep) {
      currentStep = step;
      updateStepUI();
    }
  }

  function toggleAptitudeDetails(show) {
    const box = document.getElementById('aptitudeDetailsBox');
    if (box) box.style.display = show ? 'block' : 'none';
  }

  // Visual highlight for option pill labels when checked
  document.addEventListener('change', function(e) {
    if (e.target.matches('.option-pill-label input')) {
      const parent = e.target.closest('.q-group');
      if (parent) {
        parent.querySelectorAll('.option-pill-label').forEach(lbl => {
          const inp = lbl.querySelector('input');
          lbl.classList.toggle('checked', inp && inp.checked);
        });
      }
    }
  });
</script>
@endsection

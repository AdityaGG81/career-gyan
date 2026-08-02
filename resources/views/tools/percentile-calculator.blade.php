@extends('layouts.app')

@section('title', 'MHT CET Marks vs Percentile & Rank Calculator 2025 | CareerGyan')
@section('meta_description', 'Calculate your exact expected MHT-CET 2025 percentile and State General Merit Rank from your raw marks. Real-time shift difficulty normalization & college predictions.')
@section('meta_keywords', 'mht cet marks vs percentile, mht cet percentile calculator 2025, mht cet rank predictor, calculate mht cet percentile, marks to rank converter maharashtra')

@push('styles')
<style>
  :root {
    --pct-brand: #7c3aed;
    --pct-brand-light: #f5f3ff;
    --pct-brand-dark: #6d28d9;
    --pct-safe: #059669;
    --pct-target: #2563eb;
    --pct-reach: #d97706;
  }

  .calc-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
    color: white;
    padding: 56px 0 44px;
    position: relative;
    overflow: hidden;
  }
  .calc-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(167, 139, 250, 0.25) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .calc-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #e0e7ff;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 99px;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }
  .calc-title {
    font-family: 'Sora', sans-serif;
    font-size: 36px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 14px;
  }
  .calc-subtitle {
    font-size: 16px;
    color: #c7d2fe;
    max-width: 680px;
    line-height: 1.6;
    margin: 0;
  }

  /* Main Calculator Card Layout */
  .calc-main-section {
    padding: 40px 0 70px;
    background: var(--bg);
  }
  .calc-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 28px;
    align-items: start;
  }
  @media (max-width: 960px) {
    .calc-grid {
      grid-template-columns: 1fr;
    }
  }

  .calc-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
  }

  .calc-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
  }
  .calc-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Mode Switcher Tabs */
  .mode-switch {
    display: flex;
    background: #f1f5f9;
    border-radius: var(--radius-md);
    padding: 4px;
    gap: 4px;
    margin-bottom: 24px;
  }
  .mode-btn {
    flex: 1;
    border: none;
    background: transparent;
    padding: 10px 16px;
    font-size: 13.5px;
    font-weight: 700;
    color: #64748b;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
  }
  .mode-btn.active {
    background: #ffffff;
    color: var(--pct-brand);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  /* Exam Selector Chips */
  .chip-group {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }
  .chip-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-2);
    margin-bottom: 8px;
    display: block;
  }
  .exam-chip, .shift-chip {
    padding: 8px 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background: #ffffff;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-2);
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .exam-chip.active, .shift-chip.active {
    background: var(--pct-brand-light);
    border-color: var(--pct-brand);
    color: var(--pct-brand);
    font-weight: 700;
  }

  /* Slider and Input */
  .marks-input-wrapper {
    background: #f8fafc;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    margin-bottom: 24px;
  }
  .marks-slider-header {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    margin-bottom: 16px;
  }
  .marks-slider-label {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
  }
  .marks-display-val {
    font-family: 'Sora', sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: var(--pct-brand);
  }
  .marks-display-max {
    font-size: 16px;
    font-weight: 600;
    color: #64748b;
  }

  .range-slider {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 4px;
    background: #e2e8f0;
    outline: none;
    margin: 12px 0 20px;
  }
  .range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: var(--pct-brand);
    cursor: pointer;
    border: 3px solid #ffffff;
    box-shadow: 0 2px 10px rgba(124, 58, 237, 0.4);
    transition: transform 0.1s ease;
  }
  .range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
  }

  /* Subject Inputs */
  .subject-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-top: 14px;
  }
  @media (max-width: 600px) {
    .subject-grid {
      grid-template-columns: 1fr;
    }
  }
  .subject-input-box {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 14px;
    text-align: center;
  }
  .subject-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-2);
    margin-bottom: 6px;
  }
  .subject-input {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    text-align: center;
  }

  /* Right Output Gauge Card */
  .result-card {
    background: linear-gradient(180deg, #ffffff 0%, #faf5ff 100%);
    border: 1px solid #e9d5ff;
    border-radius: var(--radius-xl);
    padding: 32px 28px;
    box-shadow: 0 12px 36px rgba(124, 58, 237, 0.08);
    position: sticky;
    top: 24px;
  }

  /* Gauge Component */
  .gauge-box {
    text-align: center;
    position: relative;
    margin-bottom: 24px;
  }
  .gauge-svg {
    width: 220px;
    height: 120px;
    overflow: visible;
  }
  .gauge-bg {
    fill: none;
    stroke: #e2e8f0;
    stroke-width: 16;
    stroke-linecap: round;
  }
  .gauge-fill {
    fill: none;
    stroke: url(#gaugeGradient);
    stroke-width: 16;
    stroke-linecap: round;
    stroke-dasharray: 283;
    stroke-dashoffset: 28;
    transition: stroke-dashoffset 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .gauge-percentile-num {
    font-family: 'Sora', sans-serif;
    font-size: 40px;
    font-weight: 800;
    color: var(--pct-brand-dark);
    line-height: 1;
    margin-top: -10px;
  }
  .gauge-percentile-label {
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 4px;
  }

  /* Stat Rows */
  .stat-row-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-lg);
    padding: 16px 20px;
    margin-bottom: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .stat-row-label {
    font-size: 13.5px;
    color: #475569;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .stat-row-val {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 800;
    color: var(--text-1);
  }

  /* Action Buttons */
  .btn-predict-now {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
    color: white;
    font-size: 16px;
    font-weight: 700;
    padding: 16px 24px;
    border-radius: var(--radius-lg);
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.35);
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    margin-top: 18px;
  }
  .btn-predict-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 26px rgba(124, 58, 237, 0.45);
    color: white;
  }

  /* Reference Marks Table */
  .ref-table-wrapper {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-top: 36px;
  }
  .ref-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    text-align: left;
  }
  .ref-table th {
    background: #f8fafc;
    padding: 14px 18px;
    font-weight: 700;
    color: var(--text-1);
    border-bottom: 2px solid #e2e8f0;
  }
  .ref-table td {
    padding: 12px 18px;
    border-bottom: 1px solid #e2e8f0;
    color: var(--text-2);
  }
  .ref-table tr:hover {
    background: #faf5ff;
  }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="calc-hero">
  <div class="container">
    <div class="calc-badge">
      <i class="fa-solid fa-bolt"></i> 2025 Normalization Algorithm
    </div>
    <h1 class="calc-title">MHT CET Marks vs Percentile & Rank Calculator</h1>
    <p class="calc-subtitle">
      Calculate your exact estimated MHT-CET 2025 percentile and State General Merit Rank from your raw score out of 200 marks, with multi-shift difficulty adjustments.
    </p>
  </div>
</section>

<!-- Calculator Section -->
<section class="calc-main-section">
  <div class="container">
    <div class="calc-grid">
      
      <!-- Left Column: Input Controller -->
      <div class="calc-card">
        <div class="calc-card-header">
          <div class="calc-card-title">
            <i class="fa-solid fa-sliders" style="color: var(--pct-brand);"></i>
            <span>Score Input Parameters</span>
          </div>
          <span style="font-size: 12.5px; color: #64748b; font-weight: 600;">
            <i class="fa-solid fa-clock-rotate-left"></i> Updated for 2025 Pattern
          </span>
        </div>

        <!-- Mode Switcher -->
        <div class="mode-switch">
          <button type="button" class="mode-btn active" id="btnQuickMode" onclick="switchMode('quick')">
            <i class="fa-solid fa-gauge-high"></i> Quick Total Marks (0-200)
          </button>
          <button type="button" class="mode-btn" id="btnSubjectMode" onclick="switchMode('subject')">
            <i class="fa-solid fa-layer-group"></i> Subject-wise Breakdown
          </button>
        </div>

        <!-- Exam Type -->
        <div style="margin-bottom: 20px;">
          <span class="chip-label"><i class="fa-solid fa-graduation-cap"></i> Target Entrance Exam:</span>
          <div class="chip-group">
            <button type="button" class="exam-chip active" data-exam="mht_cet" onclick="selectExam('mht_cet')">
              <i class="fa-solid fa-check"></i> MHT-CET (PCM - 200 Marks)
            </button>
            <button type="button" class="exam-chip" data-exam="jee_main" onclick="selectExam('jee_main')">
              JEE Main (300 Marks)
            </button>
          </div>
        </div>

        <!-- Shift Difficulty -->
        <div style="margin-bottom: 24px;">
          <span class="chip-label"><i class="fa-solid fa-chart-line"></i> Exam Shift Difficulty Level:</span>
          <div class="chip-group">
            <button type="button" class="shift-chip" data-shift="easy" onclick="selectShift('easy')">
              <i class="fa-solid fa-face-smile" style="color:#059669;"></i> Easy Shift (-0.6% Normalization)
            </button>
            <button type="button" class="shift-chip active" data-shift="moderate" onclick="selectShift('moderate')">
              <i class="fa-solid fa-face-meh" style="color:#2563eb;"></i> Moderate Shift (Standard)
            </button>
            <button type="button" class="shift-chip" data-shift="tough" onclick="selectShift('tough')">
              <i class="fa-solid fa-face-flushed" style="color:#ea580c;"></i> Tough Shift (+0.8% Boost)
            </button>
          </div>
        </div>

        <!-- Quick Mode Slider -->
        <div id="quickModeWrapper" class="marks-input-wrapper">
          <div class="marks-slider-header">
            <div>
              <div class="marks-slider-label">Your Expected Raw Score</div>
              <div style="font-size: 12.5px; color: #64748b; margin-top: 2px;">Slide or type your raw marks</div>
            </div>
            <div>
              <span class="marks-display-val" id="marksDisplayVal">{{ $initialPrediction['marks'] }}</span>
              <span class="marks-display-max" id="marksDisplayMax">/ 200</span>
            </div>
          </div>

          <input type="range" class="range-slider" id="marksSlider" min="0" max="200" step="1" value="{{ $initialPrediction['marks'] }}" oninput="updateFromSlider(this.value)">
          
          <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; color: #94a3b8;">
            <span>0 Marks</span>
            <span>50 Marks</span>
            <span>100 Marks</span>
            <span>150 Marks</span>
            <span id="maxLabel">200 Marks</span>
          </div>
        </div>

        <!-- Subject Mode Breakdown -->
        <div id="subjectModeWrapper" class="marks-input-wrapper" style="display: none;">
          <div class="marks-slider-label" style="margin-bottom: 4px;">Subject-wise Marks Entry</div>
          <div style="font-size: 12.5px; color: #64748b; margin-bottom: 14px;">Enter your estimated marks in each subject</div>

          <div class="subject-grid">
            <div class="subject-input-box">
              <div class="subject-title">Mathematics (100)</div>
              <input type="number" id="subMaths" class="subject-input" min="0" max="100" value="75" oninput="updateFromSubjects()">
            </div>
            <div class="subject-input-box">
              <div class="subject-title">Physics (50)</div>
              <input type="number" id="subPhysics" class="subject-input" min="0" max="50" value="38" oninput="updateFromSubjects()">
            </div>
            <div class="subject-input-box">
              <div class="subject-title">Chemistry (50)</div>
              <input type="number" id="subChem" class="subject-input" min="0" max="50" value="42" oninput="updateFromSubjects()">
            </div>
          </div>
          <div style="margin-top: 14px; text-align: right; font-size: 13.5px; font-weight: 700; color: var(--pct-brand);">
            Calculated Total: <span id="subjectTotalDisplay">155</span> / 200
          </div>
        </div>

        <!-- Quick Links for Reference -->
        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 20px;">
          <a href="{{ route('tools.mh-cutoff') }}" class="btn-college-info" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; background: #f8fafc; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; text-decoration: none; color: var(--text-2); font-weight: 600;">
            <i class="fa-solid fa-list-check" style="color: var(--pct-brand);"></i> Browse 2025 CAP Cutoffs
          </a>
          <a href="{{ route('guidance.mht-cet') }}" class="btn-college-info" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; background: #f8fafc; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; text-decoration: none; color: var(--text-2); font-weight: 600;">
            <i class="fa-solid fa-book-open" style="color: #059669;"></i> MHT CET Admission Guide
          </a>
        </div>
      </div>

      <!-- Right Column: Results & Speedometer Gauge -->
      <div class="result-card">
        
        <!-- Speedometer Gauge -->
        <div class="gauge-box">
          <svg class="gauge-svg" viewBox="0 0 200 110">
            <defs>
              <linearGradient id="gaugeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#3b82f6" />
                <stop offset="50%" stop-color="#8b5cf6" />
                <stop offset="100%" stop-color="#059669" />
              </linearGradient>
            </defs>
            <!-- Background Arc (Radius 80) -->
            <path class="gauge-bg" d="M 20 100 A 80 80 0 0 1 180 100" />
            <!-- Animated Value Arc -->
            <path id="gaugeFill" class="gauge-fill" d="M 20 100 A 80 80 0 0 1 180 100" />
          </svg>

          <div class="gauge-percentile-num" id="resPercentile">
            {{ $initialPrediction['percentile_formatted'] }}
          </div>
          <div class="gauge-percentile-label">Predicted Percentile Score</div>
          <div style="font-size: 12px; color: #64748b; margin-top: 4px;" id="resRange">
            Range: {{ $initialPrediction['percentile_range'] }}
          </div>
        </div>

        <!-- Predicted Merit Rank -->
        <div class="stat-row-box">
          <div class="stat-row-label">
            <i class="fa-solid fa-trophy" style="color: #eab308; font-size: 16px;"></i>
            <span>Est. State General Rank</span>
          </div>
          <div class="stat-row-val" style="color: var(--pct-brand-dark);" id="resRank">
            #{{ $initialPrediction['estimated_rank_formatted'] }}
          </div>
        </div>

        <!-- Rank Range & Total Candidates -->
        <div class="stat-row-box">
          <div class="stat-row-label">
            <i class="fa-solid fa-users" style="color: #64748b;"></i>
            <span>Rank Estimate Range</span>
          </div>
          <div class="stat-row-val" style="font-size: 15px;" id="resRankRange">
            {{ $initialPrediction['rank_range_formatted'] }}
          </div>
        </div>

        <!-- Tier & Category Badge -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-lg); padding: 18px; margin-top: 14px;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
            <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b;">Admission Bracket</span>
            <span class="college-badge" id="resBandBadge" style="background: #ecfdf5; color: #059669; font-weight: 700;">
              {{ $initialPrediction['band'] }}
            </span>
          </div>
          <p id="resDescription" style="font-size: 13px; color: #475569; line-height: 1.5; margin: 0;">
            {{ $initialPrediction['description'] }}
          </p>
        </div>

        <!-- Direct 1-Click CTA to College Predictor -->
        <a href="{{ $initialPrediction['predictor_url'] }}" id="resPredictorBtn" class="btn-predict-now">
          <i class="fa-solid fa-compass"></i> Predict My Eligible Colleges <i class="fa-solid fa-arrow-right"></i>
        </a>
        <div style="text-align: center; margin-top: 8px; font-size: 12px; color: #64748b;">
          Instant match with 363+ Maharashtra Engineering Colleges
        </div>
      </div>

    </div>

    <!-- Official Historical Marks vs Percentile Reference Table -->
    <div class="ref-table-wrapper">
      <div style="padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <div>
          <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-1); margin: 0;">
            <i class="fa-solid fa-table" style="color: var(--pct-brand); margin-right: 8px;"></i> Official MHT-CET Marks vs Percentile Analysis
          </h3>
          <p style="font-size: 13px; color: var(--text-3); margin: 4px 0 0;">Historical normalization trends across state CAP rounds</p>
        </div>
        <span class="college-badge" style="background: var(--pct-brand-light); color: var(--pct-brand); font-weight: 700;">
          State CET Cell Benchmarks
        </span>
      </div>

      <div style="overflow-x: auto;">
        <table class="ref-table">
          <thead>
            <tr>
              <th>Raw Marks Range (out of 200)</th>
              <th>Expected Percentile</th>
              <th>Approx. State Merit Rank</th>
              <th>Eligible Top Institutions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>175 – 200 Marks</strong></td>
              <td><span class="college-badge" style="background:#ecfdf5; color:#059669; font-weight:700;">99.80 – 100.00%</span></td>
              <td>Rank 1 – 800</td>
              <td>COEP Pune, VJTI Mumbai (CSE / IT / AI-DS)</td>
            </tr>
            <tr>
              <td><strong>160 – 174 Marks</strong></td>
              <td><span class="college-badge" style="background:#ecfdf5; color:#059669; font-weight:700;">99.40 – 99.79%</span></td>
              <td>Rank 801 – 2,500</td>
              <td>SPIT Mumbai, PICT Pune, Walchand Sangli</td>
            </tr>
            <tr>
              <td><strong>150 – 159 Marks</strong></td>
              <td><span class="college-badge" style="background:#eff6ff; color:#2563eb; font-weight:700;">99.00 – 99.39%</span></td>
              <td>Rank 2,501 – 4,100</td>
              <td>VIT Pune, PCCOE Pune, D.J. Sanghvi Mumbai</td>
            </tr>
            <tr>
              <td><strong>135 – 149 Marks</strong></td>
              <td><span class="college-badge" style="background:#eff6ff; color:#2563eb; font-weight:700;">97.50 – 98.99%</span></td>
              <td>Rank 4,101 – 10,250</td>
              <td>VESIT Chembur, Thadomal Shahani, VIIT Pune</td>
            </tr>
            <tr>
              <td><strong>120 – 134 Marks</strong></td>
              <td><span class="college-badge" style="background:#eff6ff; color:#2563eb; font-weight:700;">95.00 – 97.49%</span></td>
              <td>Rank 10,251 – 20,500</td>
              <td>K.J. Somaiya, SIES GST, Cummins College Pune</td>
            </tr>
            <tr>
              <td><strong>100 – 119 Marks</strong></td>
              <td><span class="college-badge" style="background:#fffbeb; color:#d97706; font-weight:700;">89.00 – 94.99%</span></td>
              <td>Rank 20,501 – 45,000</td>
              <td>D.Y. Patil Akurdi, Thakur Mumbai, Sinhgad Pune</td>
            </tr>
            <tr>
              <td><strong>80 – 99 Marks</strong></td>
              <td><span class="college-badge" style="background:#fffbeb; color:#d97706; font-weight:700;">77.00 – 88.99%</span></td>
              <td>Rank 45,001 – 94,000</td>
              <td>AISSMS Pune, Pillai College, Atharva Mumbai</td>
            </tr>
            <tr>
              <td><strong>60 – 79 Marks</strong></td>
              <td><span class="college-badge" style="background:#f1f5f9; color:#475569; font-weight:700;">57.00 – 76.99%</span></td>
              <td>Rank 94,001 – 1,76,000</td>
              <td>Regional Engineering Colleges & Tech Institutes</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- SEO FAQ Section -->
    <div style="margin-top: 40px; background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 32px;">
      <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-1); margin-bottom: 20px;">
        <i class="fa-solid fa-circle-question" style="color: var(--pct-brand); margin-right: 8px;"></i> Frequently Asked Questions about MHT-CET Percentile Calculation
      </h3>

      <div style="display: flex; flex-direction: column; gap: 16px;">
        <div>
          <h4 style="font-size: 15.5px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">How is MHT CET Percentile calculated from marks?</h4>
          <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">
            The State CET Cell uses relative percentile normalization: <code>Percentile = (100 * Number of candidates with raw score <= candidate's score) / Total candidates in that shift</code>. This prevents candidates in harder shifts from being penalized compared to easier shifts.
          </p>
        </div>
        <div>
          <h4 style="font-size: 15.5px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">What is a good score in MHT CET for Computer Science in Top Colleges?</h4>
          <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">
            For COEP, VJTI, and SPIT, a raw score of 165+ marks (99.50+ percentile) is typically required for Open Category. For other top autonomous colleges like PICT, VIT Pune, and PCCOE, 140+ marks (98.00+ percentile) ensures high probability of admission.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
  let currentExam = '{{ $defaultExam }}';
  let currentShift = '{{ $defaultShift }}';
  let currentMode = 'quick';
  let currentMarks = {{ $initialPrediction['marks'] }};

  const API_CALC_URL = "{{ route('tools.percentile-calculator.api') }}";
  const PREDICTOR_BASE_URL = "{{ route('tools.college-predictor') }}";

  function switchMode(mode) {
    currentMode = mode;
    document.getElementById('btnQuickMode').classList.toggle('active', mode === 'quick');
    document.getElementById('btnSubjectMode').classList.toggle('active', mode === 'subject');
    
    document.getElementById('quickModeWrapper').style.display = mode === 'quick' ? 'block' : 'none';
    document.getElementById('subjectModeWrapper').style.display = mode === 'subject' ? 'block' : 'none';

    if (mode === 'subject') {
      updateFromSubjects();
    } else {
      updateFromSlider(document.getElementById('marksSlider').value);
    }
  }

  function selectExam(exam) {
    currentExam = exam;
    document.querySelectorAll('.exam-chip').forEach(c => {
      c.classList.toggle('active', c.getAttribute('data-exam') === exam);
    });

    const maxMarks = exam === 'jee_main' ? 300 : 200;
    const slider = document.getElementById('marksSlider');
    slider.max = maxMarks;
    document.getElementById('marksDisplayMax').textContent = '/ ' + maxMarks;
    document.getElementById('maxLabel').textContent = maxMarks + ' Marks';

    if (parseFloat(slider.value) > maxMarks) {
      slider.value = maxMarks;
    }
    recalculate();
  }

  function selectShift(shift) {
    currentShift = shift;
    document.querySelectorAll('.shift-chip').forEach(c => {
      c.classList.toggle('active', c.getAttribute('data-shift') === shift);
    });
    recalculate();
  }

  function updateFromSlider(val) {
    currentMarks = parseFloat(val) || 0;
    document.getElementById('marksDisplayVal').textContent = currentMarks;
    recalculate();
  }

  function updateFromSubjects() {
    const m = parseFloat(document.getElementById('subMaths').value) || 0;
    const p = parseFloat(document.getElementById('subPhysics').value) || 0;
    const c = parseFloat(document.getElementById('subChem').value) || 0;
    const tot = m + p + c;
    currentMarks = tot;
    document.getElementById('subjectTotalDisplay').textContent = tot;
    document.getElementById('marksSlider').value = tot;
    document.getElementById('marksDisplayVal').textContent = tot;
    recalculate();
  }

  let debounceTimer = null;
  function recalculate() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      fetch(API_CALC_URL + '?marks=' + encodeURIComponent(currentMarks) + '&exam=' + encodeURIComponent(currentExam) + '&shift=' + encodeURIComponent(currentShift))
      .then(r => r.json())
      .then(data => {
        updateUI(data);
      })
      .catch(err => console.error('Calculation error:', err));
    }, 120);
  }

  function updateUI(data) {
    // Percentile Readout
    document.getElementById('resPercentile').textContent = data.percentile_formatted;
    document.getElementById('resRange').textContent = 'Range: ' + data.percentile_range;
    document.getElementById('resRank').textContent = '#' + data.estimated_rank_formatted;
    document.getElementById('resRankRange').textContent = data.rank_range_formatted;
    
    // Band & Description
    const badge = document.getElementById('resBandBadge');
    badge.textContent = data.band;
    badge.style.color = data.band_color || '#059669';
    badge.style.backgroundColor = (data.band_color || '#059669') + '15';
    document.getElementById('resDescription').textContent = data.description;

    // Update Speedometer SVG Arc (Total Arc length = 283)
    const pct = Math.max(0, Math.min(100, data.percentile));
    const offset = 283 - ((pct / 100) * 283);
    const gaugeFill = document.getElementById('gaugeFill');
    if (gaugeFill) {
      gaugeFill.style.strokeDashoffset = offset;
    }

    // Update College Predictor 1-Click CTA link
    const predictorBtn = document.getElementById('resPredictorBtn');
    if (predictorBtn) {
      const categoryParam = currentExam === 'jee_main' ? 'AI' : 'GOPENS';
      predictorBtn.href = PREDICTOR_BASE_URL + '?percentile=' + encodeURIComponent(data.percentile) + '&category=' + categoryParam;
    }
  }

  // Initial gauge arc set
  document.addEventListener('DOMContentLoaded', () => {
    const initialPct = {{ $initialPrediction['percentile'] }};
    const offset = 283 - ((initialPct / 100) * 283);
    const gaugeFill = document.getElementById('gaugeFill');
    if (gaugeFill) {
      gaugeFill.style.strokeDashoffset = offset;
    }
  });
</script>
@endpush

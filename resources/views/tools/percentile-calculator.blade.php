@extends('layouts.app')

@section('title', 'MHT CET Marks vs Percentile & Rank Calculator 2025 | CareerGyan')
@section('meta_description', 'Calculate your exact expected MHT-CET 2025 percentile and State General Merit Rank from raw marks. Real-time shift difficulty normalization & 1-click college prediction.')
@section('meta_keywords', 'mht cet marks vs percentile 2025, mht cet percentile calculator, mht cet rank predictor, calculate mht cet score, marks to rank converter maharashtra')

@section('styles')
<style>
  :root {
    --pct-brand: #6366f1;
    --pct-brand-dark: #4f46e5;
    --pct-brand-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
    --pct-surface: #ffffff;
    --pct-card-border: rgba(99, 102, 241, 0.12);
  }

  /* ─── Top Shared Tool Switcher Bar ─── */
  .tool-nav-bar {
    background: #0f172a;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding: 12px 0;
  }
  .tool-nav-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
  }
  .tool-nav-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 99px;
    font-size: 13.5px;
    font-weight: 700;
    color: #94a3b8;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
    text-decoration: none;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .tool-nav-item:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-1px);
  }
  .tool-nav-item.active {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
  }

  /* ─── Ultra Modern Hero ─── */
  .calc-hero {
    background: linear-gradient(135deg, #090d16 0%, #0f172a 40%, #1e1b4b 100%);
    color: white;
    padding: 60px 0 50px;
    position: relative;
    overflow: hidden;
  }
  .calc-hero-glow-1 {
    position: absolute;
    top: -30%;
    left: 20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.22) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }
  .calc-hero-glow-2 {
    position: absolute;
    bottom: -40%;
    right: 10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(217, 70, 239, 0.18) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }
  .calc-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(99, 102, 241, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(165, 180, 252, 0.25);
    color: #a5b4fc;
    font-size: 12.5px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 99px;
    margin-bottom: 18px;
    letter-spacing: 0.6px;
    text-transform: uppercase;
  }
  .calc-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 14px;
    letter-spacing: -0.5px;
  }
  .calc-title span {
    background: linear-gradient(135deg, #a5b4fc 0%, #c084fc 50%, #f472b6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .calc-subtitle {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 680px;
    line-height: 1.6;
    margin: 0;
  }

  /* ─── Main Section & Layout ─── */
  .calc-section {
    padding: 44px 0 80px;
    background: #f8fafc;
    min-height: 600px;
  }
  .calc-layout-grid {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 32px;
    align-items: start;
  }
  @media (max-width: 1024px) {
    .calc-layout-grid {
      grid-template-columns: 1fr;
    }
  }

  /* ─── Premium Input Card ─── */
  .calc-input-card {
    background: #ffffff;
    border: 1px solid rgba(226, 232, 240, 0.9);
    border-radius: 24px;
    padding: 34px;
    box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0,0,0,0.02);
    position: relative;
    overflow: hidden;
  }
  .calc-input-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--pct-brand-gradient);
  }

  .calc-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
  }
  .calc-card-heading {
    font-family: 'Sora', sans-serif;
    font-size: 21px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Tab Segmented Control */
  .segmented-control {
    display: flex;
    background: #f1f5f9;
    padding: 4px;
    border-radius: 12px;
    gap: 4px;
    margin-bottom: 26px;
  }
  .seg-btn {
    flex: 1;
    border: none;
    background: transparent;
    padding: 10px 16px;
    border-radius: 9px;
    font-size: 13.5px;
    font-weight: 700;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
  }
  .seg-btn.active {
    background: #ffffff;
    color: var(--pct-brand-dark);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  }

  /* Pill Chips */
  .pill-group {
    margin-bottom: 24px;
  }
  .pill-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .pills-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }
  .pill-chip {
    padding: 8px 16px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 13.5px;
    font-weight: 700;
    color: #334155;
    cursor: pointer;
    transition: all 0.18s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .pill-chip:hover {
    border-color: #cbd5e1;
    background: #ffffff;
    transform: translateY(-1px);
  }
  .pill-chip.active {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #1d4ed8;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
  }
  .pill-chip.shift-easy.active {
    background: #ecfdf5;
    border-color: #10b981;
    color: #047857;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
  }
  .pill-chip.shift-tough.active {
    background: #fef2f2;
    border-color: #ef4444;
    color: #b91c1c;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
  }

  /* Interactive Main Score Box */
  .main-score-box {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 2px solid #e2e8f0;
    border-radius: 20px;
    padding: 24px 28px;
    margin-bottom: 24px;
    transition: all 0.2s ease;
  }
  .main-score-box:focus-within {
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
  }
  .score-box-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }
  .score-box-lbl {
    font-size: 14px;
    font-weight: 700;
    color: #334155;
  }
  .score-counter-display {
    display: flex;
    align-items: baseline;
    gap: 4px;
  }
  .score-val-big {
    font-family: 'Sora', sans-serif;
    font-size: 40px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
  }
  .score-max-sub {
    font-size: 18px;
    font-weight: 700;
    color: #94a3b8;
  }

  /* Range Slider */
  .custom-range-slider {
    width: 100%;
    -webkit-appearance: none;
    appearance: none;
    height: 8px;
    border-radius: 99px;
    background: #cbd5e1;
    outline: none;
    cursor: pointer;
    margin: 12px 0 6px;
  }
  .custom-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #6366f1;
    border: 3px solid #ffffff;
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.4);
    cursor: pointer;
    transition: transform 0.15s ease;
  }
  .custom-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
  }

  /* Subject Cards Grid */
  .subject-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 24px;
  }
  @media (max-width: 600px) {
    .subject-cards-grid {
      grid-template-columns: 1fr;
    }
  }
  .subject-card {
    border-radius: 16px;
    padding: 16px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .sub-maths { border-top: 4px solid #6366f1; background: #faf5ff; }
  .sub-physics { border-top: 4px solid #f59e0b; background: #fffbeb; }
  .sub-chemistry { border-top: 4px solid #10b981; background: #ecfdf5; }

  .sub-title {
    font-size: 13px;
    font-weight: 700;
    color: #334155;
    display: flex;
    justify-content: space-between;
  }
  .sub-input {
    width: 100%;
    padding: 10px 12px;
    font-size: 18px;
    font-weight: 800;
    font-family: 'Sora', sans-serif;
    color: #0f172a;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    background: #ffffff;
    outline: none;
    transition: border 0.15s ease;
  }
  .sub-input:focus {
    border-color: #6366f1;
  }

  /* Quick Presets Row */
  .quick-marks-row {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }
  .quick-chip {
    padding: 6px 12px;
    border-radius: 8px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    font-size: 12.5px;
    font-weight: 700;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .quick-chip:hover {
    background: #6366f1;
    border-color: #6366f1;
    color: white;
  }

  /* ─── Ultra Sleek Output Results Card ─── */
  .calc-result-card {
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid rgba(99, 102, 241, 0.18);
    border-radius: 24px;
    padding: 34px;
    box-shadow: 0 20px 50px -15px rgba(99, 102, 241, 0.1), 0 2px 6px rgba(0,0,0,0.02);
    position: sticky;
    top: 20px;
  }

  .result-top-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
  }

  /* Main Gauge Meter */
  .gauge-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    margin: 10px 0 24px;
  }
  .gauge-svg {
    width: 220px;
    height: 120px;
  }
  .gauge-percentile-text {
    position: absolute;
    bottom: 0px;
    text-align: center;
  }
  .gauge-val-big {
    font-family: 'Sora', sans-serif;
    font-size: 38px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
  }
  .gauge-val-label {
    font-size: 12.5px;
    font-weight: 700;
    color: #64748b;
    margin-top: 2px;
  }

  /* Rank & Band Metrics Box */
  .metrics-box-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 24px;
  }
  .metric-tile {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 16px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  }
  .metric-lbl {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 4px;
    text-transform: uppercase;
  }
  .metric-val {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
  }
  .metric-sub {
    font-size: 11.5px;
    color: #94a3b8;
    margin-top: 2px;
  }

  /* Tier Description */
  .tier-desc-card {
    background: #faf5ff;
    border: 1px solid #e9d5ff;
    border-radius: 16px;
    padding: 16px 20px;
    margin-bottom: 24px;
  }
  .tier-desc-title {
    font-size: 14px;
    font-weight: 800;
    color: #7e22ce;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .tier-desc-body {
    font-size: 13px;
    color: #4b5563;
    line-height: 1.5;
    margin: 0;
  }

  /* Action CTA Button */
  .btn-launch-predictor {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: #ffffff;
    border: none;
    border-radius: 16px;
    padding: 16px 24px;
    font-size: 16px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.45);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }
  .btn-launch-predictor:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 30px -5px rgba(99, 102, 241, 0.6);
    color: #ffffff;
  }

  /* Eligible Institutes Pills */
  .colleges-preview-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 16px;
    justify-content: center;
  }
  .college-tag {
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 700;
    color: #475569;
  }
</style>
@endsection

@section('content')
<!-- Shared Tools Switcher Bar -->
<div class="tool-nav-bar">
  <div class="container">
    <div class="tool-nav-wrapper">
      <a href="{{ route('tools.percentile-calculator') }}" class="tool-nav-item active">
        <i class="fa-solid fa-calculator"></i> Percentile & Rank Calculator
      </a>
      <a href="{{ route('tools.college-predictor') }}" class="tool-nav-item">
        <i class="fa-solid fa-crosshairs"></i> College Predictor 🎯
      </a>
      <a href="{{ route('tools.mh-cutoff') }}" class="tool-nav-item">
        <i class="fa-solid fa-database"></i> CAP Round 1 Cutoffs 2025
      </a>
    </div>
  </div>
</div>

<!-- Hero Section -->
<section class="calc-hero">
  <div class="calc-hero-glow-1"></div>
  <div class="calc-hero-glow-2"></div>
  <div class="container" style="position: relative; z-index: 2;">
    <div class="calc-badge">
      <i class="fa-solid fa-microchip"></i> 2025 Normalization & Difficulty Math Engine
    </div>
    <h1 class="calc-title">
      MHT-CET <span>Marks vs Percentile</span> & Rank Calculator
    </h1>
    <p class="calc-subtitle">
      Calculate your exact estimated MHT-CET 2025 percentile and State General Merit Rank from your raw score out of 200 marks, with multi-shift difficulty adjustments.
    </p>
  </div>
</section>

<!-- Main Calculator Section -->
<section class="calc-section">
  <div class="container">
    <div class="calc-layout-grid">
      
      <!-- Input Panel -->
      <div class="calc-input-card">
        <div class="calc-header-row">
          <div class="calc-card-heading">
            <i class="fa-solid fa-sliders" style="color: #6366f1;"></i>
            <span>Calculate Score</span>
          </div>
          <span style="font-size: 13px; font-weight: 700; color: #64748b;">
            <i class="fa-solid fa-shield-check" style="color: #10b981;"></i> 2025 Standardized
          </span>
        </div>

        <!-- Mode Segmented Control -->
        <div class="segmented-control">
          <button type="button" class="seg-btn active" id="btnModeTotal" onclick="setCalculationMode('total')">
            <i class="fa-solid fa-chart-simple"></i> Total Marks (0 - 200)
          </button>
          <button type="button" class="seg-btn" id="btnModeSubject" onclick="setCalculationMode('subject')">
            <i class="fa-solid fa-cubes-stacked"></i> Subject Breakdown (M + P + C)
          </button>
        </div>

        <!-- Exam Type Selector -->
        <div class="pill-group">
          <label class="pill-label">
            <i class="fa-solid fa-file-pen" style="color: #6366f1;"></i> Exam Type
          </label>
          <div class="pills-row">
            <button type="button" class="pill-chip active" data-exam="mht_cet_pcm" onclick="selectExam('mht_cet_pcm')">
              <i class="fa-solid fa-atom"></i> MHT-CET (PCM - 200 Marks)
            </button>
            <button type="button" class="pill-chip" data-exam="mht_cet_pcb" onclick="selectExam('mht_cet_pcb')">
              <i class="fa-solid fa-dna"></i> MHT-CET (PCB - 200 Marks)
            </button>
            <button type="button" class="pill-chip" data-exam="jee_main" onclick="selectExam('jee_main')">
              <i class="fa-solid fa-award"></i> JEE Main (300 Marks)
            </button>
          </div>
        </div>

        <!-- Shift Difficulty Adjuster -->
        <div class="pill-group">
          <label class="pill-label">
            <i class="fa-solid fa-gauge" style="color: #f59e0b;"></i> Shift Difficulty Adjustment
          </label>
          <div class="pills-row">
            <button type="button" class="pill-chip shift-chip shift-easy" data-shift="easy" onclick="selectShift('easy')">
              🟢 Easy Shift (-1.5%)
            </button>
            <button type="button" class="pill-chip shift-chip active" data-shift="moderate" onclick="selectShift('moderate')">
              🟡 Moderate Shift (Standard)
            </button>
            <button type="button" class="pill-chip shift-chip shift-tough" data-shift="tough" onclick="selectShift('tough')">
              🔴 Tough Shift (+2.5%)
            </button>
          </div>
        </div>

        <!-- Mode 1: Total Marks Slider Input -->
        <div id="modeTotalWrapper">
          <div class="main-score-box">
            <div class="score-box-top">
              <span class="score-box-lbl">Your Raw Marks</span>
              <div class="score-counter-display">
                <span class="score-val-big" id="marksDisplayVal">{{ $calcData['marks'] }}</span>
                <span class="score-max-sub" id="marksMaxSub">/ 200</span>
              </div>
            </div>
            <input type="range" class="custom-range-slider" id="marksSlider" min="0" max="200" step="1" value="{{ $calcData['marks'] }}" oninput="updateFromSlider(this.value)">
          </div>

          <!-- Quick Score Chips -->
          <div style="margin-bottom: 24px;">
            <span style="font-size: 12.5px; font-weight: 700; color: #64748b; margin-right: 8px;">Quick Presets:</span>
            <span class="quick-marks-row" style="display:inline-flex;">
              <button type="button" class="quick-chip" onclick="setMarks(180)">180+ (COEP / VJTI CS)</button>
              <button type="button" class="quick-chip" onclick="setMarks(150)">150 (Top Tier 1)</button>
              <button type="button" class="quick-chip" onclick="setMarks(125)">125 (Top 10%)</button>
              <button type="button" class="quick-chip" onclick="setMarks(95)">95</button>
              <button type="button" class="quick-chip" onclick="setMarks(70)">70</button>
            </span>
          </div>
        </div>

        <!-- Mode 2: Subject-wise Breakdown -->
        <div id="modeSubjectWrapper" style="display: none;">
          <div class="subject-cards-grid">
            <div class="subject-card sub-maths">
              <div class="sub-title">
                <span><i class="fa-solid fa-square-root-variable"></i> Mathematics</span>
                <span style="color:#6366f1;">/ 100</span>
              </div>
              <input type="number" id="subMaths" class="sub-input" min="0" max="100" value="70" oninput="updateFromSubjects()">
            </div>

            <div class="subject-card sub-physics">
              <div class="sub-title">
                <span><i class="fa-solid fa-bolt"></i> Physics</span>
                <span style="color:#f59e0b;">/ 50</span>
              </div>
              <input type="number" id="subPhysics" class="sub-input" min="0" max="50" value="35" oninput="updateFromSubjects()">
            </div>

            <div class="subject-card sub-chemistry">
              <div class="sub-title">
                <span><i class="fa-solid fa-flask"></i> Chemistry</span>
                <span style="color:#10b981;">/ 50</span>
              </div>
              <input type="number" id="subChem" class="sub-input" min="0" max="50" value="35" oninput="updateFromSubjects()">
            </div>
          </div>
          <div style="font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 20px;">
            Total Computed Score: <strong id="subjectTotalDisplay" style="color:#6366f1; font-size:16px;">140</strong> / 200
          </div>
        </div>

      </div>

      <!-- Result Card -->
      <div class="calc-result-card">
        
        <div style="text-align: center;">
          <span class="result-top-badge" id="resBandBadge" style="background: {{ $calcData['band_color'] }}15; color: {{ $calcData['band_color'] }}; border: 1px solid {{ $calcData['band_color'] }}40;">
            <i class="fa-solid fa-sparkles"></i> <span id="resBadgeText">{{ $calcData['badge'] }}</span>
          </span>
        </div>

        <!-- SVG Gauge -->
        <div class="gauge-container">
          <svg class="gauge-svg" viewBox="0 0 200 110">
            <!-- Background Arc -->
            <path d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="#e2e8f0" stroke-width="18" stroke-linecap="round" />
            <!-- Animated Value Arc -->
            <path id="gaugeArc" d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="url(#gaugeGradient)" stroke-width="18" stroke-linecap="round" stroke-dasharray="251.2" stroke-dashoffset="30" style="transition: stroke-dashoffset 0.6s cubic-bezier(0.4, 0, 0.2, 1);" />
            <defs>
              <linearGradient id="gaugeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#3b82f6" />
                <stop offset="50%" stop-color="#8b5cf6" />
                <stop offset="100%" stop-color="#ec4899" />
              </linearGradient>
            </defs>
          </svg>

          <div class="gauge-percentile-text">
            <div class="gauge-val-big" id="resPercentileBig">{{ $calcData['percentile_formatted'] }}</div>
            <div class="gauge-val-label">Expected Percentile</div>
          </div>
        </div>

        <!-- Metrics Box -->
        <div class="metrics-box-grid">
          <div class="metric-tile">
            <div class="metric-lbl">State Merit Rank</div>
            <div class="metric-val" id="resRankVal">#{{ $calcData['estimated_rank_formatted'] }}</div>
            <div class="metric-sub" id="resRankRange">Range: {{ $calcData['rank_range_formatted'] }}</div>
          </div>

          <div class="metric-tile">
            <div class="metric-lbl">Percentile Band</div>
            <div class="metric-val" id="resRangeVal" style="font-size: 17px; color: #6366f1;">{{ $calcData['percentile_range'] }}</div>
            <div class="metric-sub" id="resTotalCand">out of {{ $calcData['total_candidates'] }}</div>
          </div>
        </div>

        <!-- Tier Info Card -->
        <div class="tier-desc-card">
          <div class="tier-desc-title">
            <i class="fa-solid fa-graduation-cap"></i> <span id="resTierTitle">{{ $calcData['tier_title'] }}</span>
          </div>
          <p class="tier-desc-body" id="resTierDesc">
            {{ $calcData['description'] }}
          </p>
        </div>

        <!-- Launch Predictor CTA -->
        <a href="{{ $calcData['predictor_url'] }}" id="resPredictorBtn" class="btn-launch-predictor">
          <span>Predict Eligible Colleges For This Score</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>

        <!-- Eligible Institutes Preview -->
        <div class="colleges-preview-row" id="resCollegesList">
          @foreach($calcData['top_colleges'] as $col)
            <span class="college-tag">{{ $col }}</span>
          @endforeach
        </div>

      </div>

    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  let currentExam = 'mht_cet_pcm';
  let currentShift = 'moderate';
  let currentMarks = {{ $calcData['marks'] }};
  const API_CALC_URL = "{{ route('tools.percentile-calculator.api') }}";

  function setCalculationMode(mode) {
    document.getElementById('btnModeTotal').classList.toggle('active', mode === 'total');
    document.getElementById('btnModeSubject').classList.toggle('active', mode === 'subject');
    document.getElementById('modeTotalWrapper').style.display = (mode === 'total') ? 'block' : 'none';
    document.getElementById('modeSubjectWrapper').style.display = (mode === 'subject') ? 'block' : 'none';
  }

  function selectExam(exam) {
    currentExam = exam;
    document.querySelectorAll('[data-exam]').forEach(c => {
      c.classList.toggle('active', c.getAttribute('data-exam') === exam);
    });

    const maxM = (exam === 'jee_main') ? 300 : 200;
    document.getElementById('marksSlider').max = maxM;
    document.getElementById('marksMaxSub').textContent = '/ ' + maxM;

    if (currentMarks > maxM) {
      currentMarks = maxM;
      document.getElementById('marksSlider').value = maxM;
      document.getElementById('marksDisplayVal').textContent = maxM;
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

  function setMarks(m) {
    currentMarks = m;
    document.getElementById('marksSlider').value = m;
    document.getElementById('marksDisplayVal').textContent = m;
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
    }, 100);
  }

  function updateUI(data) {
    document.getElementById('resPercentileBig').textContent = data.percentile_formatted;
    document.getElementById('resRankVal').textContent = '#' + data.estimated_rank_formatted;
    document.getElementById('resRankRange').textContent = 'Range: ' + data.rank_range_formatted;
    document.getElementById('resRangeVal').textContent = data.percentile_range;
    document.getElementById('resTotalCand').textContent = 'out of ' + data.total_candidates;
    document.getElementById('resTierTitle').textContent = data.tier_title;
    document.getElementById('resTierDesc').textContent = data.description;
    document.getElementById('resBadgeText').textContent = data.badge;

    const badgeEl = document.getElementById('resBandBadge');
    badgeEl.style.color = data.band_color;
    badgeEl.style.background = data.band_color + '15';
    badgeEl.style.borderColor = data.band_color + '40';

    document.getElementById('resPredictorBtn').href = data.predictor_url;

    // Update Gauge Arc stroke-dashoffset (total length is 251.2)
    const pct = Math.max(0, Math.min(100, data.percentile));
    const offset = 251.2 - (pct / 100) * 251.2;
    document.getElementById('gaugeArc').style.strokeDashoffset = offset;

    // Update Colleges List
    const colList = document.getElementById('resCollegesList');
    colList.innerHTML = '';
    if (data.top_colleges) {
      data.top_colleges.forEach(c => {
        const span = document.createElement('span');
        span.className = 'college-tag';
        span.textContent = c;
        colList.appendChild(span);
      });
    }
  }

  // Initial gauge set
  document.addEventListener('DOMContentLoaded', () => {
    const initialPct = {{ $calcData['percentile'] }};
    const offset = 251.2 - (initialPct / 100) * 251.2;
    document.getElementById('gaugeArc').style.strokeDashoffset = offset;
  });
</script>
@endsection

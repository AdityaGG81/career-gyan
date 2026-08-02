@extends('layouts.app')

@section('title', 'Accurate MHT CET & JEE College Predictor 2025 | CareerGyan')
@section('meta_description', 'Predict your admission chances in 363+ Maharashtra Engineering Colleges with 99% accuracy using official 2025 CAP Round cutoffs, categories, and chance analysis.')
@section('meta_keywords', 'mht cet college predictor 2025, engineering college predictor maharashtra, mht cet branch predictor, coep cutoff predictor, vjti admission chances, cap round option form generator')

@section('styles')
<style>
  :root {
    --cp-brand: #2563eb;
    --cp-brand-dark: #1d4ed8;
    --cp-brand-light: #eff6ff;
    --cp-safe: #059669;
    --cp-safe-bg: #ecfdf5;
    --cp-safe-border: #a7f3d0;
    --cp-target: #2563eb;
    --cp-target-bg: #eff6ff;
    --cp-target-border: #bfdbfe;
    --cp-reach: #d97706;
    --cp-reach-bg: #fffbeb;
    --cp-reach-border: #fde68a;
    --cp-dream: #dc2626;
    --cp-dream-bg: #fef2f2;
    --cp-dream-border: #fecaca;
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
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
  }

  /* ─── Hero Section ─── */
  .cp-hero {
    background: linear-gradient(135deg, #090d16 0%, #0f172a 45%, #172554 100%);
    color: white;
    padding: 60px 0 50px;
    position: relative;
    overflow: hidden;
  }
  .cp-hero-glow {
    position: absolute;
    top: -40%;
    right: 15%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.22) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .cp-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(59, 130, 246, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(147, 197, 253, 0.25);
    color: #93c5fd;
    font-size: 12.5px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 99px;
    margin-bottom: 18px;
    letter-spacing: 0.6px;
    text-transform: uppercase;
  }
  .cp-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 14px;
    letter-spacing: -0.5px;
  }
  .cp-title span {
    background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 50%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .cp-subtitle {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 720px;
    line-height: 1.6;
    margin: 0;
  }

  /* ─── Main Section ─── */
  .cp-main-section {
    padding: 36px 0 80px;
    background: #f8fafc;
    min-height: 600px;
  }

  /* ─── Filter Command Card ─── */
  .cp-filter-card {
    background: #ffffff;
    border: 1px solid rgba(226, 232, 240, 0.9);
    border-radius: 24px;
    padding: 30px 34px;
    box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
  }
  .cp-filter-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #2563eb, #3b82f6, #8b5cf6);
  }

  .cp-filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 22px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
    flex-wrap: wrap;
    gap: 12px;
  }
  .cp-filter-title {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Grid Layout for Filter Inputs */
  .cp-inputs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 18px;
    align-items: end;
  }
  .cp-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .cp-label {
    font-size: 12.5px;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .cp-input, .cp-select {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #cbd5e1;
    border-radius: 12px;
    background: #ffffff;
    font-size: 14.5px;
    font-weight: 700;
    color: #0f172a;
    outline: none;
    transition: all 0.18s ease;
  }
  .cp-input:focus, .cp-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
  }

  /* Buttons */
  .btn-cp-predict {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-size: 15px;
    font-weight: 800;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    transition: all 0.2s ease;
    height: 48px;
  }
  .btn-cp-predict:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.45);
  }

  .btn-cp-reset {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    padding: 12px 18px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 48px;
    transition: all 0.2s ease;
  }
  .btn-cp-reset:hover {
    background: #e2e8f0;
    color: #0f172a;
  }

  /* Preset Percentiles Chips */
  .preset-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    flex-wrap: wrap;
  }
  .preset-btn {
    padding: 5px 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .preset-btn:hover {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #1d4ed8;
  }

  /* ─── Chance KPI Filter Tabs ─── */
  .chance-kpi-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
    margin-bottom: 26px;
  }
  @media (max-width: 900px) {
    .chance-kpi-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 500px) {
    .chance-kpi-grid {
      grid-template-columns: 1fr;
    }
  }

  .chance-tab-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    padding: 18px 20px;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  }
  .chance-tab-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
  }
  .chance-tab-card.active {
    border-color: #2563eb;
    background: #f0f7ff;
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.15);
  }
  .chance-tab-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }
  .chance-tab-lbl {
    font-size: 13px;
    font-weight: 800;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }
  .chance-tab-num {
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
  }

  /* ─── Results Container & Header ─── */
  .cp-results-card {
    background: #ffffff;
    border: 1px solid rgba(226, 232, 240, 0.9);
    border-radius: 24px;
    padding: 30px 34px;
    box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.05);
  }
  .cp-results-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
  }

  /* View Switcher Toggle (Cards vs Table) */
  .view-toggle-wrap {
    display: inline-flex;
    background: #f1f5f9;
    padding: 3px;
    border-radius: 10px;
    gap: 2px;
  }
  .view-btn {
    border: none;
    background: transparent;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .view-btn.active {
    background: #ffffff;
    color: #0f172a;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  }

  .btn-export-cap {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    transition: all 0.2s ease;
  }
  .btn-export-cap:hover {
    background: #047857;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(5, 150, 105, 0.4);
  }

  /* ─── Mode 1: Modern College Cards Grid View ─── */
  .college-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 20px;
  }
  @media (max-width: 600px) {
    .college-cards-grid {
      grid-template-columns: 1fr;
    }
  }

  .pred-college-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    padding: 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
  }
  .pred-college-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
  }

  .card-top-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  .card-inst-name {
    font-size: 15.5px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.35;
  }
  .card-branch-name {
    font-size: 14px;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  /* Chance Bar & Badge */
  .card-chance-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .chance-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 800;
  }
  .cp-prob-safe { background: var(--cp-safe-bg); color: var(--cp-safe); border: 1px solid var(--cp-safe-border); }
  .cp-prob-target { background: var(--cp-target-bg); color: var(--cp-target); border: 1px solid var(--cp-target-border); }
  .cp-prob-reach { background: var(--cp-reach-bg); color: var(--cp-reach); border: 1px solid var(--cp-reach-border); }
  .cp-prob-dream { background: var(--cp-dream-bg); color: var(--cp-dream); border: 1px solid var(--cp-dream-border); }

  .card-metrics-box {
    background: #f8fafc;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-bottom: 16px;
  }
  .card-m-item {
    text-align: center;
  }
  .card-m-lbl {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
  }
  .card-m-val {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin-top: 2px;
  }

  .card-actions-row {
    display: flex;
    gap: 8px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
  }
  .btn-card-action {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 12px;
    border-radius: 10px;
    font-size: 12.5px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-card-primary {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }
  .btn-card-primary:hover {
    background: #2563eb;
    color: #ffffff;
  }
  .btn-card-map {
    background: #fff7ed;
    color: #c2410c;
    border: 1px solid #ffedd5;
  }
  .btn-card-map:hover {
    background: #ea580c;
    color: #ffffff;
  }

  /* ─── Mode 2: Clean Data Table View ─── */
  .cp-table-wrapper {
    overflow-x: auto;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
  }
  .cp-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    text-align: left;
  }
  .cp-table th {
    background: #f8fafc;
    padding: 14px 18px;
    font-weight: 700;
    color: #0f172a;
    border-bottom: 2px solid #cbd5e1;
    white-space: nowrap;
  }
  .cp-table td {
    padding: 14px 18px;
    border-bottom: 1px solid #e2e8f0;
    color: #334155;
    vertical-align: middle;
  }
  .cp-table tr:hover {
    background: #f8fafc;
  }
</style>
@endsection

@section('content')
<!-- Shared Tools Switcher Bar -->
<div class="tool-nav-bar">
  <div class="container">
    <div class="tool-nav-wrapper">
      <a href="{{ route('tools.percentile-calculator') }}" class="tool-nav-item">
        <i class="fa-solid fa-calculator"></i> Percentile & Rank Calculator
      </a>
      <a href="{{ route('tools.college-predictor') }}" class="tool-nav-item active">
        <i class="fa-solid fa-crosshairs"></i> College Predictor 🎯
      </a>
      <a href="{{ route('tools.mh-cutoff') }}" class="tool-nav-item">
        <i class="fa-solid fa-database"></i> CAP Round 1 Cutoffs 2025
      </a>
    </div>
  </div>
</div>

<!-- Hero Section -->
<section class="cp-hero">
  <div class="cp-hero-glow"></div>
  <div class="container" style="position: relative; z-index: 2;">
    <div class="cp-badge">
      <i class="fa-solid fa-crosshairs"></i> Official 2025 CAP Round 1 Dataset & Probability Engine
    </div>
    <h1 class="cp-title">
      Accurate <span>Maharashtra Engineering</span> College Predictor
    </h1>
    <p class="cp-subtitle">
      Discover which colleges and branches you can secure across Maharashtra based on your MHT-CET or JEE Main percentile score, reservation quota, and preferred districts.
    </p>
  </div>
</section>

<!-- Main Predictor Section -->
<section class="cp-main-section">
  <div class="container">

    <!-- Filters Command Card -->
    <div class="cp-filter-card">
      <div class="cp-filter-header">
        <div class="cp-filter-title">
          <i class="fa-solid fa-sliders" style="color: #2563eb;"></i>
          <span>Admission Prediction Preferences</span>
        </div>
        <div>
          <a href="{{ route('tools.percentile-calculator') }}" class="btn-cp-reset" style="height: 38px; padding: 0 14px; font-size: 13px;">
            <i class="fa-solid fa-calculator" style="color: #2563eb;"></i> Calculate Percentile from Raw Marks
          </a>
        </div>
      </div>

      <form id="predictorForm" onsubmit="event.preventDefault(); triggerPrediction();">
        <div class="cp-inputs-grid">
          
          <!-- Percentile Input -->
          <div class="cp-form-group">
            <label class="cp-label" for="filterPercentile">
              <i class="fa-solid fa-percent" style="color: #2563eb;"></i> Your Percentile Score:
            </label>
            <input type="number" step="0.01" min="1" max="100" id="filterPercentile" class="cp-input" value="{{ $filters['percentile'] }}" placeholder="e.g. 98.45">
          </div>

          <!-- Category / Quota -->
          <div class="cp-form-group">
            <label class="cp-label" for="filterCategory">
              <i class="fa-solid fa-tags" style="color: #7c3aed;"></i> Category / Seat Type:
            </label>
            <select id="filterCategory" class="cp-select">
              @foreach($categories as $code => $label)
                <option value="{{ $code }}" {{ $filters['category'] === $code ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Preferred District -->
          <div class="cp-form-group">
            <label class="cp-label" for="filterDistrict">
              <i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> Preferred District:
            </label>
            <select id="filterDistrict" class="cp-select">
              <option value="">All Maharashtra Districts</option>
              @foreach($districts as $d)
                <option value="{{ $d }}" {{ $filters['district'] === $d ? 'selected' : '' }}>
                  {{ $d }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Preferred Branch Domain -->
          <div class="cp-form-group">
            <label class="cp-label" for="filterBranchGroup">
              <i class="fa-solid fa-graduation-cap" style="color: #059669;"></i> Branch Domain:
            </label>
            <select id="filterBranchGroup" class="cp-select">
              <option value="">All Engineering Branches</option>
              @foreach($branchGroups as $bKey => $bData)
                <option value="{{ $bKey }}" {{ $filters['branch_group'] === $bKey ? 'selected' : '' }}>
                  {{ $bData['label'] }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Search College Name -->
          <div class="cp-form-group">
            <label class="cp-label" for="filterSearch">
              <i class="fa-solid fa-magnifying-glass" style="color: #64748b;"></i> Specific College Search:
            </label>
            <input type="text" id="filterSearch" class="cp-input" value="{{ $filters['search'] }}" placeholder="e.g. COEP, VJTI, PICT...">
          </div>

          <!-- Actions -->
          <div class="cp-form-group" style="display: flex; flex-direction: row; gap: 10px;">
            <button type="submit" class="btn-cp-predict" style="flex: 1;">
              <i class="fa-solid fa-magnifying-glass"></i> Predict Colleges
            </button>
            <button type="button" class="btn-cp-reset" onclick="resetFilters()" title="Reset Filters">
              <i class="fa-solid fa-rotate-left"></i>
            </button>
          </div>

        </div>
      </form>

      <!-- Preset Score Quick Chips -->
      <div class="preset-row">
        <span style="font-size: 12px; font-weight: 700; color: #64748b;">Quick Percentiles:</span>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(99.5)">99.5% (Elite)</button>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(98.0)">98.0% (Tier 1)</button>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(95.0)">95.0% (Top 5%)</button>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(90.0)">90.0% (Top 10%)</button>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(85.0)">85.0%</button>
        <button type="button" class="preset-btn" onclick="setPresetPercentile(75.0)">75.0%</button>
      </div>
    </div>

    <!-- Probability KPI Tab Bar -->
    <div class="chance-kpi-grid">
      
      <!-- All Option Tab -->
      <div class="chance-tab-card active" id="tabAll" onclick="filterByChance('all')">
        <div class="chance-tab-top">
          <span class="chance-tab-lbl">All Options</span>
          <i class="fa-solid fa-layer-group" style="color: #2563eb;"></i>
        </div>
        <div class="chance-tab-num" id="kpiCountTotal">{{ $initialData['counts']['total'] }}</div>
      </div>

      <!-- Safe Bets Tab -->
      <div class="chance-tab-card" id="tabSafe" onclick="filterByChance('safe')">
        <div class="chance-tab-top">
          <span class="chance-tab-lbl" style="color: #059669;">🟢 Safe Bets (>90%)</span>
          <i class="fa-solid fa-circle-check" style="color: #059669;"></i>
        </div>
        <div class="chance-tab-num" style="color: #059669;" id="kpiCountSafe">{{ $initialData['counts']['safe'] }}</div>
      </div>

      <!-- Target Colleges Tab -->
      <div class="chance-tab-card" id="tabTarget" onclick="filterByChance('target')">
        <div class="chance-tab-top">
          <span class="chance-tab-lbl" style="color: #2563eb;">🟡 Target (65-90%)</span>
          <i class="fa-solid fa-bullseye" style="color: #2563eb;"></i>
        </div>
        <div class="chance-tab-num" style="color: #2563eb;" id="kpiCountTarget">{{ $initialData['counts']['target'] }}</div>
      </div>

      <!-- Reach Colleges Tab -->
      <div class="chance-tab-card" id="tabReach" onclick="filterByChance('reach')">
        <div class="chance-tab-top">
          <span class="chance-tab-lbl" style="color: #d97706;">🟠 Reach (30-60%)</span>
          <i class="fa-solid fa-mountain" style="color: #d97706;"></i>
        </div>
        <div class="chance-tab-num" style="color: #d97706;" id="kpiCountReach">{{ $initialData['counts']['reach'] }}</div>
      </div>

      <!-- Dream Colleges Tab -->
      <div class="chance-tab-card" id="tabDream" onclick="filterByChance('dream')">
        <div class="chance-tab-top">
          <span class="chance-tab-lbl" style="color: #dc2626;">🔴 Dream (Ambitious)</span>
          <i class="fa-solid fa-star" style="color: #dc2626;"></i>
        </div>
        <div class="chance-tab-num" style="color: #dc2626;" id="kpiCountDream">{{ $initialData['counts']['dream'] }}</div>
      </div>

    </div>

    <!-- Results Section -->
    <div class="cp-results-card">
      <div class="cp-results-toolbar">
        <div>
          <h2 style="font-family: 'Sora', sans-serif; font-size: 21px; font-weight: 800; color: #0f172a; margin: 0;">
            Predicted Eligible Colleges & Branches (<span id="resultsCountDisplay">{{ $initialData['results_count'] }}</span> options)
          </h2>
          <p style="font-size: 13.5px; color: #64748b; margin: 4px 0 0;">
            Ranked by admission probability for <strong id="scoreBadge" style="color:#2563eb;">{{ $initialData['user_percentile'] }}%</strong> ({{ $initialData['category'] }})
          </p>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
          <!-- View Switcher -->
          <div class="view-toggle-wrap">
            <button type="button" class="view-btn active" id="btnViewCards" onclick="switchViewMode('cards')">
              <i class="fa-solid fa-grip"></i> Cards
            </button>
            <button type="button" class="view-btn" id="btnViewTable" onclick="switchViewMode('table')">
              <i class="fa-solid fa-table-list"></i> Table
            </button>
          </div>

          <!-- Export CSV -->
          <a href="{{ route('tools.college-predictor.export', ['percentile' => $filters['percentile'], 'category' => $filters['category']]) }}" id="exportCsvBtn" class="btn-export-cap">
            <i class="fa-solid fa-file-arrow-down"></i> Export CAP Option Form (CSV)
          </a>
        </div>
      </div>

      <!-- View 1: Modern Cards Grid -->
      <div id="cardsViewWrapper" class="college-cards-grid">
        @foreach($initialData['results'] as $item)
          @php
            $pClass = 'cp-prob-' . $item['chance'];
          @endphp
          <div class="pred-college-card">
            <div>
              <div class="card-top-row">
                <div class="card-inst-name">{{ $item['college_name'] }}</div>
                @if($item['college_code'])
                  <span style="background:#f1f5f9; color:#475569; font-size:11.5px; font-weight:700; padding:3px 8px; border-radius:6px; white-space:nowrap;">
                    #{{ $item['college_code'] }}
                  </span>
                @endif
              </div>

              <div class="card-branch-name">
                <i class="fa-solid fa-graduation-cap"></i> {{ $item['branch_name'] }}
              </div>

              <div class="card-chance-row">
                <div class="chance-pill {{ $pClass }}">
                  <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
                  {{ $item['chance_badge'] }} ({{ $item['probability'] }})
                </div>
                <span style="font-size: 12px; font-weight: 700; color: {{ $item['delta'] >= 0 ? '#059669' : '#d97706' }};">
                  {{ $item['delta_formatted'] }}
                </span>
              </div>

              <div class="card-metrics-box">
                <div class="card-m-item">
                  <div class="card-m-lbl">Seat Type</div>
                  <div class="card-m-val" style="color: #2563eb;">{{ $item['category'] }}</div>
                </div>
                <div class="card-m-item">
                  <div class="card-m-lbl">2025 Cutoff</div>
                  <div class="card-m-val">{{ $item['cutoff_formatted'] }}</div>
                </div>
                <div class="card-m-item">
                  <div class="card-m-lbl">District</div>
                  <div class="card-m-val">{{ $item['district'] }}</div>
                </div>
              </div>
            </div>

            <div class="card-actions-row">
              <a href="{{ $item['show_url'] ?? $item['cutoffs_url'] }}" class="btn-card-action btn-card-primary" target="_blank">
                <i class="fa-solid fa-building-columns"></i> View Cutoffs
              </a>
              <a href="{{ $item['map_directions_url'] }}" class="btn-card-action btn-card-map" target="_blank" title="Campus Map">
                <i class="fa-solid fa-location-dot"></i> Map
              </a>
            </div>
          </div>
        @endforeach
      </div>

      <!-- View 2: Table View -->
      <div id="tableViewWrapper" class="cp-table-wrapper" style="display: none;">
        <table class="cp-table">
          <thead>
            <tr>
              <th>College & Location</th>
              <th>Branch / Degree</th>
              <th>Seat Type</th>
              <th>2025 Cutoff</th>
              <th>Delta Score</th>
              <th>Admission Probability</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="predictionTableBody">
            @foreach($initialData['results'] as $item)
              @php
                $pClass = 'cp-prob-' . $item['chance'];
              @endphp
              <tr>
                <td style="max-width: 320px;">
                  <div style="font-weight: 700; color: #0f172a; font-size: 14px; margin-bottom: 3px;">
                    {{ $item['college_name'] }}
                  </div>
                  <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    @if($item['college_code'])
                      <span style="background:#f1f5f9; color:#475569; padding:2px 6px; border-radius:4px;">Code: {{ $item['college_code'] }}</span>
                    @endif
                    <span><i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> {{ $item['district'] }}</span>
                    <span>• {{ $item['management'] }}</span>
                  </div>
                </td>

                <td style="font-weight: 600; color: #0f172a;">
                  {{ $item['branch_name'] }}
                </td>

                <td>
                  <span style="background:#eff6ff; color:#2563eb; font-weight:700; padding:3px 8px; border-radius:6px; font-size:12.5px;">
                    {{ $item['category'] }}
                  </span>
                </td>

                <td style="font-family: 'Sora', sans-serif; font-weight: 700; color: #0f172a;">
                  {{ $item['cutoff_formatted'] }}
                  @if($item['merit_no'] !== 'N/A')
                    <div style="font-size: 11.5px; color: #64748b; font-weight: 500;">Merit #{{ $item['merit_no'] }}</div>
                  @endif
                </td>

                <td style="font-weight: 700; color: {{ $item['delta'] >= 0 ? '#059669' : '#d97706' }};">
                  {{ $item['delta_formatted'] }}
                </td>

                <td>
                  <div class="chance-pill {{ $pClass }}">
                    <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
                    {{ $item['chance_badge'] }} ({{ $item['probability'] }})
                  </div>
                </td>

                <td>
                  <div style="display: flex; gap: 6px;">
                    <a href="{{ $item['show_url'] ?? $item['cutoffs_url'] }}" class="btn-card-action btn-card-primary" style="padding: 6px 12px; font-size: 12px;" target="_blank">
                      Cutoffs
                    </a>
                    <a href="{{ $item['map_directions_url'] }}" class="btn-card-action btn-card-map" style="padding: 6px 10px; font-size: 12px;" target="_blank" title="Campus Map">
                      <i class="fa-solid fa-location-dot"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

    <!-- Strategy & FAQ Section -->
    <div style="margin-top: 40px; background: white; border: 1px solid #e2e8f0; border-radius: 20px; padding: 34px;">
      <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">
        <i class="fa-solid fa-circle-question" style="color: #2563eb; margin-right: 8px;"></i> How to Build a Winning Maharashtra CAP Round Option Form
      </h3>

      <div style="display: flex; flex-direction: column; gap: 16px;">
        <div>
          <h4 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Recommended 3-Tier Option Form Strategy:</h4>
          <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0;">
            1. <strong>Top 15–20 Choices (Dream & Reach)</strong>: Top autonomous institutions like COEP Pune, VJTI Mumbai, SPIT Mumbai, PICT Pune, Walchand Sangli in your dream branches.<br>
            2. <strong>Middle 25–35 Choices (Target)</strong>: Colleges where your percentile closely aligns with past cutoffs (+/- 1.0%).<br>
            3. <strong>Bottom 15–20 Choices (Safe Bets)</strong>: Established accredited institutes where your score is safely +1.5% to +5.0% higher than the 2025 cutoff to guarantee a seat.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('scripts')
<script>
  let activeChanceFilter = 'all';
  let currentViewMode = 'cards';
  const API_PREDICT_URL = "{{ route('tools.college-predictor.api') }}";
  const EXPORT_BASE_URL = "{{ route('tools.college-predictor.export') }}";

  function switchViewMode(mode) {
    currentViewMode = mode;
    document.getElementById('btnViewCards').classList.toggle('active', mode === 'cards');
    document.getElementById('btnViewTable').classList.toggle('active', mode === 'table');
    document.getElementById('cardsViewWrapper').style.display = (mode === 'cards') ? 'grid' : 'none';
    document.getElementById('tableViewWrapper').style.display = (mode === 'table') ? 'block' : 'none';
  }

  function setPresetPercentile(val) {
    document.getElementById('filterPercentile').value = val;
    triggerPrediction();
  }

  function filterByChance(chance) {
    activeChanceFilter = chance;
    document.querySelectorAll('.chance-tab-card').forEach(c => c.classList.remove('active'));
    
    if (chance === 'all') document.getElementById('tabAll').classList.add('active');
    if (chance === 'safe') document.getElementById('tabSafe').classList.add('active');
    if (chance === 'target') document.getElementById('tabTarget').classList.add('active');
    if (chance === 'reach') document.getElementById('tabReach').classList.add('active');
    if (chance === 'dream') document.getElementById('tabDream').classList.add('active');

    triggerPrediction();
  }

  function resetFilters() {
    document.getElementById('filterPercentile').value = '95.0';
    document.getElementById('filterCategory').value = 'GOPENS';
    document.getElementById('filterDistrict').value = '';
    document.getElementById('filterBranchGroup').value = '';
    document.getElementById('filterSearch').value = '';
    activeChanceFilter = 'all';
    document.querySelectorAll('.chance-tab-card').forEach(c => c.classList.remove('active'));
    document.getElementById('tabAll').classList.add('active');
    triggerPrediction();
  }

  function triggerPrediction() {
    const p = parseFloat(document.getElementById('filterPercentile').value) || 95.0;
    const cat = document.getElementById('filterCategory').value;
    const dist = document.getElementById('filterDistrict').value;
    const branch = document.getElementById('filterBranchGroup').value;
    const search = document.getElementById('filterSearch').value;

    // Update Export URL
    const exportBtn = document.getElementById('exportCsvBtn');
    exportBtn.href = EXPORT_BASE_URL + '?percentile=' + encodeURIComponent(p) +
      '&category=' + encodeURIComponent(cat) +
      '&district=' + encodeURIComponent(dist) +
      '&branch_group=' + encodeURIComponent(branch) +
      '&chance_level=' + encodeURIComponent(activeChanceFilter) +
      '&search=' + encodeURIComponent(search);

    fetch(API_PREDICT_URL + '?percentile=' + encodeURIComponent(p) +
      '&category=' + encodeURIComponent(cat) +
      '&district=' + encodeURIComponent(dist) +
      '&branch_group=' + encodeURIComponent(branch) +
      '&chance_level=' + encodeURIComponent(activeChanceFilter) +
      '&search=' + encodeURIComponent(search)
    )
    .then(r => r.json())
    .then(data => {
      renderPredictions(data);
    })
    .catch(err => console.error('Predictor error:', err));
  }

  function renderPredictions(data) {
    // Update KPI counters
    document.getElementById('kpiCountTotal').textContent = data.counts.total;
    document.getElementById('kpiCountSafe').textContent = data.counts.safe;
    document.getElementById('kpiCountTarget').textContent = data.counts.target;
    document.getElementById('kpiCountReach').textContent = data.counts.reach;
    document.getElementById('kpiCountDream').textContent = data.counts.dream;
    document.getElementById('resultsCountDisplay').textContent = data.results_count;
    document.getElementById('scoreBadge').textContent = data.user_percentile + '%';

    const cardsWrapper = document.getElementById('cardsViewWrapper');
    const tbody = document.getElementById('predictionTableBody');

    if (!data.results || data.results.length === 0) {
      const emptyHtml = `
        <div style="grid-column: 1 / -1; text-align:center; padding:50px 20px; color:#64748b;">
          <i class="fa-solid fa-magnifying-glass" style="font-size:32px; margin-bottom:12px; color:#cbd5e1; display:block;"></i>
          <strong style="font-size:16px; color:#0f172a;">No matching colleges found for this criteria.</strong>
          <p style="font-size:13.5px; margin-top:6px;">Try expanding your district filter or selecting "All Engineering Branches".</p>
        </div>
      `;
      cardsWrapper.innerHTML = emptyHtml;
      tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:40px 20px; color:#64748b;">No colleges found.</td></tr>`;
      return;
    }

    let cardsHtml = '';
    let tableHtml = '';

    data.results.forEach(item => {
      const pClass = 'cp-prob-' + item['chance'];
      const deltaColor = item.delta >= 0 ? '#059669' : '#d97706';
      const meritText = item.merit_no !== 'N/A' ? `<div style="font-size:11.5px; color:#64748b; font-weight:500;">Merit #${item.merit_no}</div>` : '';
      const codeBadge = item.college_code ? `<span style="background:#f1f5f9; color:#475569; font-size:11.5px; font-weight:700; padding:3px 8px; border-radius:6px; white-space:nowrap;">#${item.college_code}</span>` : '';

      // Cards View Markup
      cardsHtml += `
        <div class="pred-college-card">
          <div>
            <div class="card-top-row">
              <div class="card-inst-name">${item.college_name}</div>
              ${codeBadge}
            </div>

            <div class="card-branch-name">
              <i class="fa-solid fa-graduation-cap"></i> ${item.branch_name}
            </div>

            <div class="card-chance-row">
              <div class="chance-pill ${pClass}">
                <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
                ${item.chance_badge} (${item.probability})
              </div>
              <span style="font-size: 12px; font-weight: 700; color: ${deltaColor};">
                ${item.delta_formatted}
              </span>
            </div>

            <div class="card-metrics-box">
              <div class="card-m-item">
                <div class="card-m-lbl">Seat Type</div>
                <div class="card-m-val" style="color: #2563eb;">${item.category}</div>
              </div>
              <div class="card-m-item">
                <div class="card-m-lbl">2025 Cutoff</div>
                <div class="card-m-val">${item.cutoff_formatted}</div>
              </div>
              <div class="card-m-item">
                <div class="card-m-lbl">District</div>
                <div class="card-m-val">${item.district}</div>
              </div>
            </div>
          </div>

          <div class="card-actions-row">
            <a href="${item.show_url || item.cutoffs_url}" class="btn-card-action btn-card-primary" target="_blank">
              <i class="fa-solid fa-building-columns"></i> View Cutoffs
            </a>
            <a href="${item.map_directions_url}" class="btn-card-action btn-card-map" target="_blank" title="Campus Map">
              <i class="fa-solid fa-location-dot"></i> Map
            </a>
          </div>
        </div>
      `;

      // Table View Markup
      tableHtml += `
        <tr>
          <td style="max-width: 320px;">
            <div style="font-weight: 700; color: #0f172a; font-size: 14px; margin-bottom: 3px;">
              ${item.college_name}
            </div>
            <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              ${item.college_code ? `<span style="background:#f1f5f9; color:#475569; padding:2px 6px; border-radius:4px;">Code: ${item.college_code}</span>` : ''}
              <span><i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> ${item.district}</span>
              <span>• ${item.management}</span>
            </div>
          </td>

          <td style="font-weight: 600; color: #0f172a;">
            ${item.branch_name}
          </td>

          <td>
            <span style="background:#eff6ff; color:#2563eb; font-weight:700; padding:3px 8px; border-radius:6px; font-size:12.5px;">
              ${item.category}
            </span>
          </td>

          <td style="font-family: 'Sora', sans-serif; font-weight: 700; color: #0f172a;">
            ${item.cutoff_formatted}
            ${meritText}
          </td>

          <td style="font-weight: 700; color: ${deltaColor};">
            ${item.delta_formatted}
          </td>

          <td>
            <div class="chance-pill ${pClass}">
              <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
              ${item.chance_badge} (${item.probability})
            </div>
          </td>

          <td>
            <div style="display: flex; gap: 6px;">
              <a href="${item.show_url || item.cutoffs_url}" class="btn-card-action btn-card-primary" style="padding: 6px 12px; font-size: 12px;" target="_blank">
                Cutoffs
              </a>
              <a href="${item.map_directions_url}" class="btn-card-action btn-card-map" style="padding: 6px 10px; font-size: 12px;" target="_blank" title="Campus Map">
                <i class="fa-solid fa-location-dot"></i>
              </a>
            </div>
          </td>
        </tr>
      `;
    });

    cardsWrapper.innerHTML = cardsHtml;
    tbody.innerHTML = tableHtml;
  }
</script>
@endsection

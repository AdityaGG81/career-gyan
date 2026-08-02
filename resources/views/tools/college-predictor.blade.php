@extends('layouts.app')

@section('title', 'Accurate MHT CET & JEE College Predictor 2025 | CareerGyan')
@section('meta_description', 'Predict your admission chances in 363+ Maharashtra Engineering Colleges with 99% accuracy using official 2025 CAP Round cutoffs, categories, and chance analysis.')
@section('meta_keywords', 'mht cet college predictor 2025, engineering college predictor maharashtra, mht cet branch predictor, coep cutoff predictor, vjti admission chances, cap round option form generator')

@push('styles')
<style>
  :root {
    --pred-brand: #2563eb;
    --pred-brand-dark: #1d4ed8;
    --pred-brand-light: #eff6ff;
    --pred-safe: #059669;
    --pred-safe-bg: #ecfdf5;
    --pred-target: #2563eb;
    --pred-target-bg: #eff6ff;
    --pred-reach: #d97706;
    --pred-reach-bg: #fffbeb;
    --pred-dream: #dc2626;
    --pred-dream-bg: #fef2f2;
  }

  .pred-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #1e3a8a 100%);
    color: white;
    padding: 56px 0 44px;
    position: relative;
    overflow: hidden;
  }
  .pred-hero::after {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .pred-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #93c5fd;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 99px;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }
  .pred-title {
    font-family: 'Sora', sans-serif;
    font-size: 36px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 14px;
  }
  .pred-subtitle {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 720px;
    line-height: 1.6;
    margin: 0;
  }

  /* Filter Dashboard Section */
  .pred-dashboard-section {
    padding: 36px 0 60px;
    background: var(--bg);
  }

  .filter-panel-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    margin-bottom: 30px;
  }
  .filter-panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 12px;
  }
  .filter-panel-title {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Form Layout */
  .pred-form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 18px;
    align-items: end;
  }
  .pred-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .pred-form-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-1);
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .pred-form-input, .pred-form-select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background: #ffffff;
    font-size: 14.5px;
    font-weight: 600;
    color: var(--text-1);
    outline: none;
    transition: all 0.2s ease;
  }
  .pred-form-input:focus, .pred-form-select:focus {
    border-color: var(--pred-brand);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
  }

  /* Action Buttons */
  .btn-pred-submit {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    padding: 12px 24px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    transition: all 0.2s ease;
    height: 46px;
  }
  .btn-pred-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
  }

  .btn-pred-reset {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 12px 18px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 46px;
    transition: all 0.2s ease;
  }
  .btn-pred-reset:hover {
    background: #e2e8f0;
    color: var(--text-1);
  }

  /* Preset Score Chips */
  .preset-chips-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 14px;
    flex-wrap: wrap;
  }
  .preset-chip {
    padding: 4px 10px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: #ffffff;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-2);
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .preset-chip:hover {
    border-color: var(--pred-brand);
    color: var(--pred-brand);
    background: var(--pred-brand-light);
  }

  /* Summary KPI Bar */
  .kpi-summary-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
    margin-bottom: 24px;
  }
  @media (max-width: 900px) {
    .kpi-summary-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 500px) {
    .kpi-summary-grid {
      grid-template-columns: 1fr;
    }
  }

  .kpi-tab-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px 18px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .kpi-tab-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  }
  .kpi-tab-card.active {
    border-color: var(--pred-brand);
    background: var(--pred-brand-light);
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.15);
  }
  .kpi-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
  }
  .kpi-label {
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
  }
  .kpi-val {
    font-family: 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: var(--text-1);
  }

  /* Results Table & Cards */
  .pred-results-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
  }
  .pred-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 14px;
  }

  .btn-export-csv {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #059669;
    color: white;
    border: none;
    border-radius: var(--radius-md);
    padding: 10px 18px;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    transition: all 0.2s ease;
  }
  .btn-export-csv:hover {
    background: #047857;
    color: white;
    transform: translateY(-1px);
  }

  /* Prediction Table */
  .pred-table-wrapper {
    overflow-x: auto;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-lg);
  }
  .pred-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    text-align: left;
  }
  .pred-table th {
    background: #f8fafc;
    padding: 14px 16px;
    font-weight: 700;
    color: #1e293b;
    border-bottom: 2px solid #cbd5e1;
    white-space: nowrap;
  }
  .pred-table td {
    padding: 14px 16px;
    border-bottom: 1px solid #e2e8f0;
    color: #334155;
    vertical-align: middle;
  }
  .pred-table tr:hover {
    background: #f8fafc;
  }

  /* Probability Badge */
  .prob-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 99px;
    font-size: 12.5px;
    font-weight: 800;
  }
  .prob-safe { background: var(--pred-safe-bg); color: var(--pred-safe); border: 1px solid #a7f3d0; }
  .prob-target { background: var(--pred-target-bg); color: var(--pred-target); border: 1px solid #bfdbfe; }
  .prob-reach { background: var(--pred-reach-bg); color: var(--pred-reach); border: 1px solid #fde68a; }
  .prob-dream { background: var(--pred-dream-bg); color: var(--pred-dream); border: 1px solid #fecaca; }

  /* College Profile Modal */
  .college-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .college-modal-overlay.active {
    display: flex;
  }
  .college-modal-card {
    background: #ffffff;
    border-radius: 20px;
    width: 100%;
    max-width: 640px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="pred-hero">
  <div class="container">
    <div class="pred-badge">
      <i class="fa-solid fa-crosshairs"></i> Official 2025 CAP Round 1 Dataset & Probability Engine
    </div>
    <h1 class="pred-title">Accurate Maharashtra Engineering College Predictor</h1>
    <p class="pred-subtitle">
      Discover which colleges and branches you can get into across Maharashtra based on your MHT-CET or JEE Main percentile score, category quota, and location preferences.
    </p>
  </div>
</section>

<!-- Main Predictor Section -->
<section class="pred-dashboard-section">
  <div class="container">

    <!-- Filters Panel -->
    <div class="filter-panel-card">
      <div class="filter-panel-header">
        <div class="filter-panel-title">
          <i class="fa-solid fa-sliders" style="color: var(--pred-brand);"></i>
          <span>Admission Prediction Filters</span>
        </div>
        <div>
          <a href="{{ route('tools.percentile-calculator') }}" class="btn-pred-reset" style="height: 38px; padding: 0 14px; font-size: 13px;">
            <i class="fa-solid fa-calculator" style="color: var(--pred-brand);"></i> Calculate Percentile from Marks
          </a>
        </div>
      </div>

      <form id="predictorForm" onsubmit="event.preventDefault(); triggerPrediction();">
        <div class="pred-form-grid">
          
          <!-- Percentile Input -->
          <div class="pred-form-group">
            <label class="pred-form-label" for="filterPercentile">
              <i class="fa-solid fa-percent" style="color: var(--pred-brand);"></i> Your Percentile Score:
            </label>
            <input type="number" step="0.01" min="1" max="100" id="filterPercentile" class="pred-form-input" value="{{ $filters['percentile'] }}" placeholder="e.g. 98.45">
          </div>

          <!-- Category / Quota -->
          <div class="pred-form-group">
            <label class="pred-form-label" for="filterCategory">
              <i class="fa-solid fa-tags" style="color: #7c3aed;"></i> Category / Seat Type:
            </label>
            <select id="filterCategory" class="pred-form-select">
              @foreach($categories as $code => $label)
                <option value="{{ $code }}" {{ $filters['category'] === $code ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Preferred District -->
          <div class="pred-form-group">
            <label class="pred-form-label" for="filterDistrict">
              <i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> Preferred District:
            </label>
            <select id="filterDistrict" class="pred-form-select">
              <option value="">All Maharashtra Districts</option>
              @foreach($districts as $d)
                <option value="{{ $d }}" {{ $filters['district'] === $d ? 'selected' : '' }}>
                  {{ $d }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Preferred Branch Domain -->
          <div class="pred-form-group">
            <label class="pred-form-label" for="filterBranchGroup">
              <i class="fa-solid fa-graduation-cap" style="color: #059669;"></i> Branch Domain:
            </label>
            <select id="filterBranchGroup" class="pred-form-select">
              <option value="">All Engineering Branches</option>
              @foreach($branchGroups as $bKey => $bData)
                <option value="{{ $bKey }}" {{ $filters['branch_group'] === $bKey ? 'selected' : '' }}>
                  {{ $bData['label'] }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Search College Name -->
          <div class="pred-form-group">
            <label class="pred-form-label" for="filterSearch">
              <i class="fa-solid fa-magnifying-glass" style="color: #64748b;"></i> Specific College Search:
            </label>
            <input type="text" id="filterSearch" class="pred-form-input" value="{{ $filters['search'] }}" placeholder="e.g. COEP, VJTI, PICT...">
          </div>

          <!-- Actions -->
          <div class="pred-form-group" style="display: flex; flex-direction: row; gap: 10px;">
            <button type="submit" class="btn-pred-submit" style="flex: 1;">
              <i class="fa-solid fa-magnifying-glass"></i> Predict Colleges
            </button>
            <button type="button" class="btn-pred-reset" onclick="resetFilters()">
              <i class="fa-solid fa-rotate-left"></i>
            </button>
          </div>

        </div>
      </form>

      <!-- Preset Score Quick Chips -->
      <div class="preset-chips-row">
        <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">Quick Percentiles:</span>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(99.5)">99.5% (Elite)</button>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(98.0)">98.0% (Tier 1)</button>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(95.0)">95.0% (Top 5%)</button>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(90.0)">90.0% (Top 10%)</button>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(85.0)">85.0%</button>
        <button type="button" class="preset-chip" onclick="setPresetPercentile(75.0)">75.0%</button>
      </div>
    </div>

    <!-- Probability KPI Tab Bar -->
    <div class="kpi-summary-grid">
      
      <!-- All Option Tab -->
      <div class="kpi-tab-card active" id="tabAll" onclick="filterByChance('all')">
        <div class="kpi-top-row">
          <span class="kpi-label">All Predicted Options</span>
          <i class="fa-solid fa-layer-group" style="color: var(--pred-brand);"></i>
        </div>
        <div class="kpi-val" id="kpiCountTotal">{{ $initialData['counts']['total'] }}</div>
      </div>

      <!-- Safe Bets Tab -->
      <div class="kpi-tab-card" id="tabSafe" onclick="filterByChance('safe')">
        <div class="kpi-top-row">
          <span class="kpi-label" style="color: #059669;">🟢 Safe Bets (>90%)</span>
          <i class="fa-solid fa-circle-check" style="color: #059669;"></i>
        </div>
        <div class="kpi-val" style="color: #059669;" id="kpiCountSafe">{{ $initialData['counts']['safe'] }}</div>
      </div>

      <!-- Target Colleges Tab -->
      <div class="kpi-tab-card" id="tabTarget" onclick="filterByChance('target')">
        <div class="kpi-top-row">
          <span class="kpi-label" style="color: #2563eb;">🟡 Target (65-90%)</span>
          <i class="fa-solid fa-bullseye" style="color: #2563eb;"></i>
        </div>
        <div class="kpi-val" style="color: #2563eb;" id="kpiCountTarget">{{ $initialData['counts']['target'] }}</div>
      </div>

      <!-- Reach Colleges Tab -->
      <div class="kpi-tab-card" id="tabReach" onclick="filterByChance('reach')">
        <div class="kpi-top-row">
          <span class="kpi-label" style="color: #d97706;">🟠 Reach (30-60%)</span>
          <i class="fa-solid fa-mountain" style="color: #d97706;"></i>
        </div>
        <div class="kpi-val" style="color: #d97706;" id="kpiCountReach">{{ $initialData['counts']['reach'] }}</div>
      </div>

      <!-- Dream Colleges Tab -->
      <div class="kpi-tab-card" id="tabDream" onclick="filterByChance('dream')">
        <div class="kpi-top-row">
          <span class="kpi-label" style="color: #dc2626;">🔴 Dream (Ambitious)</span>
          <i class="fa-solid fa-star" style="color: #dc2626;"></i>
        </div>
        <div class="kpi-val" style="color: #dc2626;" id="kpiCountDream">{{ $initialData['counts']['dream'] }}</div>
      </div>

    </div>

    <!-- Results Table Section -->
    <div class="pred-results-card">
      <div class="pred-results-header">
        <div>
          <h2 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-1); margin: 0;">
            Predicted Eligible Colleges & Branches (<span id="resultsCountDisplay">{{ $initialData['results_count'] }}</span> options)
          </h2>
          <p style="font-size: 13.5px; color: var(--text-3); margin: 4px 0 0;">
            Ranked by admission probability for <strong id="scoreBadge">{{ $initialData['user_percentile'] }}%</strong> ({{ $initialData['category'] }})
          </p>
        </div>

        <div>
          <a href="{{ route('tools.college-predictor.export', ['percentile' => $filters['percentile'], 'category' => $filters['category']]) }}" id="exportCsvBtn" class="btn-export-csv">
            <i class="fa-solid fa-file-arrow-down"></i> Export CAP Option Form (CSV)
          </a>
        </div>
      </div>

      <!-- Results Table -->
      <div class="pred-table-wrapper">
        <table class="pred-table">
          <thead>
            <tr>
              <th>College & Campus Location</th>
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
                $pClass = 'prob-' . $item['chance'];
              @endphp
              <tr>
                <td style="max-width: 320px;">
                  <div style="font-weight: 700; color: var(--text-1); font-size: 14px; margin-bottom: 3px;">
                    {{ $item['college_name'] }}
                  </div>
                  <div style="font-size: 12px; color: var(--text-3); display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    @if($item['college_code'])
                      <span class="college-badge" style="background:#f1f5f9; color:#475569;">Code: {{ $item['college_code'] }}</span>
                    @endif
                    <span><i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> {{ $item['district'] }}</span>
                    <span>• {{ $item['management'] }}</span>
                  </div>
                </td>

                <td style="font-weight: 600; color: var(--text-1);">
                  {{ $item['branch_name'] }}
                </td>

                <td>
                  <span class="college-badge" style="background:#eff6ff; color:#2563eb; font-weight:700;">
                    {{ $item['category'] }}
                  </span>
                </td>

                <td style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--text-1);">
                  {{ $item['cutoff_formatted'] }}
                  @if($item['merit_no'] !== 'N/A')
                    <div style="font-size: 11.5px; color: var(--text-3); font-weight: 500;">Merit #{{ $item['merit_no'] }}</div>
                  @endif
                </td>

                <td style="font-weight: 700; color: {{ $item['delta'] >= 0 ? '#059669' : '#d97706' }};">
                  {{ $item['delta_formatted'] }}
                </td>

                <td>
                  <div class="prob-badge {{ $pClass }}">
                    <i class="fa-solid fa-circle" style="font-size: 8px;"></i>
                    {{ $item['chance_badge'] }} ({{ $item['probability'] }})
                  </div>
                </td>

                <td>
                  <div style="display: flex; gap: 6px;">
                    <a href="{{ $item['show_url'] ?? $item['cutoffs_url'] }}" class="btn-college-info" style="padding: 6px 12px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;" target="_blank">
                      <i class="fa-solid fa-building-columns"></i> Profile
                    </a>
                    <a href="{{ $item['map_directions_url'] }}" class="btn-college-info" style="padding: 6px 10px; font-size: 12px; text-decoration: none; color: #ea580c; display: inline-flex; align-items: center; gap: 4px;" target="_blank" title="Open in Google Maps">
                      <i class="fa-solid fa-diamond-turn-right"></i> Map
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

    <!-- SEO FAQ Section -->
    <div style="margin-top: 40px; background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 32px;">
      <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-1); margin-bottom: 20px;">
        <i class="fa-solid fa-circle-question" style="color: var(--pred-brand); margin-right: 8px;"></i> Frequently Asked Questions about Maharashtra College Prediction
      </h3>

      <div style="display: flex; flex-direction: column; gap: 16px;">
        <div>
          <h4 style="font-size: 15.5px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">How accurate is this College Predictor?</h4>
          <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">
            CareerGyan's College Predictor is powered by official State CET Cell Maharashtra CAP Round cutoff datasets across 363+ colleges and all reservation quotas (GOPENS, GOPENH, LOPENS, GOBCS, GSCH, GSTH, EWS, TFWS, and AI). It accounts for score deltas to provide 99% reliable admission probability estimates.
          </p>
        </div>
        <div>
          <h4 style="font-size: 15.5px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">How should I arrange my CAP Option Form preferences?</h4>
          <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">
            We recommend arranging your CAP Option Form in a balanced 3-tier strategy: 
            1. <strong>Top 10-15 Choices</strong>: Dream / Reach Colleges (Ambitions & Premier Autonomous Institutes)
            2. <strong>Middle 20-30 Choices</strong>: Target Colleges (Good probability matches)
            3. <strong>Bottom 10-15 Choices</strong>: Safe Bets (Guaranteed admission backup seats)
          </p>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
  let activeChanceFilter = 'all';
  const API_PREDICT_URL = "{{ route('tools.college-predictor.api') }}";
  const EXPORT_BASE_URL = "{{ route('tools.college-predictor.export') }}";

  function setPresetPercentile(val) {
    document.getElementById('filterPercentile').value = val;
    triggerPrediction();
  }

  function filterByChance(chance) {
    activeChanceFilter = chance;
    document.querySelectorAll('.kpi-tab-card').forEach(c => c.classList.remove('active'));
    
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
    document.querySelectorAll('.kpi-tab-card').forEach(c => c.classList.remove('active'));
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

    const tbody = document.getElementById('predictionTableBody');
    if (!data.results || data.results.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" style="text-align:center; padding:40px 20px; color:#64748b;">
            <i class="fa-solid fa-magnifying-glass" style="font-size:28px; margin-bottom:10px; color:#cbd5e1; display:block;"></i>
            <strong>No matching colleges found for this criteria.</strong>
            <p style="font-size:13px; margin-top:4px;">Try expanding your district or selecting "All Engineering Branches".</p>
          </td>
        </tr>
      `;
      return;
    }

    let html = '';
    data.results.forEach(item => {
      const pClass = 'prob-' + item.chance;
      const deltaColor = item.delta >= 0 ? '#059669' : '#d97706';
      const meritText = item.merit_no !== 'N/A' ? `<div style="font-size:11.5px; color:#64748b; font-weight:500;">Merit #${item.merit_no}</div>` : '';
      const codeBadge = item.college_code ? `<span class="college-badge" style="background:#f1f5f9; color:#475569;">Code: ${item.college_code}</span>` : '';

      html += `
        <tr>
          <td style="max-width: 320px;">
            <div style="font-weight: 700; color: var(--text-1); font-size: 14px; margin-bottom: 3px;">
              ${item.college_name}
            </div>
            <div style="font-size: 12px; color: var(--text-3); display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              ${codeBadge}
              <span><i class="fa-solid fa-location-dot" style="color: #dc2626;"></i> ${item.district}</span>
              <span>• ${item.management}</span>
            </div>
          </td>

          <td style="font-weight: 600; color: var(--text-1);">
            ${item.branch_name}
          </td>

          <td>
            <span class="college-badge" style="background:#eff6ff; color:#2563eb; font-weight:700;">
              ${item.category}
            </span>
          </td>

          <td style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--text-1);">
            ${item.cutoff_formatted}
            ${meritText}
          </td>

          <td style="font-weight: 700; color: ${deltaColor};">
            ${item.delta_formatted}
          </td>

          <td>
            <div class="prob-badge ${pClass}">
              <i class="fa-solid fa-circle" style="font-size: 8px;"></i>
              ${item.chance_badge} (${item.probability})
            </div>
          </td>

          <td>
            <div style="display: flex; gap: 6px;">
              <a href="${item.show_url || item.cutoffs_url}" class="btn-college-info" style="padding: 6px 12px; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;" target="_blank">
                <i class="fa-solid fa-building-columns"></i> Profile
              </a>
              <a href="${item.map_directions_url}" class="btn-college-info" style="padding: 6px 10px; font-size: 12px; text-decoration: none; color: #ea580c; display: inline-flex; align-items: center; gap: 4px;" target="_blank" title="Open in Google Maps">
                <i class="fa-solid fa-diamond-turn-right"></i> Map
              </a>
            </div>
          </td>
        </tr>
      `;
    });

    tbody.innerHTML = html;
  }
</script>
@endpush

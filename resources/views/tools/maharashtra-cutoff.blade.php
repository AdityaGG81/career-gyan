@extends('layouts.app')

@section('title', 'MHT CET Cutoff 2025: Engineering College Wise Percentile & Merit Ranks | CareerGyan')
@section('meta_description', 'Official MHT CET Cutoff 2025 for 363+ Maharashtra Engineering Colleges. Search CAP Round 1 cutoff percentiles for VJTI, COEP, PICT & filter by branch, category (GOPENS, GOPENH). Download Excel/CSV data.')
@section('meta_keywords', 'mht cet cutoff 2025, mhtcet cutoff, mht cet engineering cutoff 2025, maharashtra engineering college cutoffs, cap round 1 cutoff, vjti cutoff 2025 mht cet, coep mht cet cutoff 2025, pict cutoff, mht cet percentile list')

@section('meta')
    <link rel="canonical" href="{{ url('/tools/maharashtra-colleges-cutoff') }}" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="MHT CET Cutoff 2025: Engineering College Wise Percentiles">
    <meta property="og:description" content="Explore CAP Round 1 cutoff percentiles for 363+ Maharashtra engineering colleges. Filter by college, branch & category. Download complete CSV.">
    <meta property="og:url" content="{{ url('/tools/maharashtra-colleges-cutoff') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MHT CET Cutoff 2025 - All Maharashtra Engineering Colleges">
    <meta name="twitter:description" content="Search official MHT CET 2025 CAP Round 1 cutoff percentiles and merit ranks for VJTI, COEP, PICT, Walchand & more.">
@endsection

@section('styles')
<style>
  /* ─── Cutoff Hero ─── */
  .cutoff-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1a56db 100%);
    padding: 60px 0 45px;
    color: #fff;
    position: relative;
    overflow: hidden;
  }
  .cutoff-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
  }
  .cutoff-hero-glow {
    position: absolute;
    top: -40%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
    pointer-events: none;
  }
  .cutoff-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4.5vw, 40px);
    font-weight: 800;
    margin-bottom: 12px;
    line-height: 1.2;
  }
  .cutoff-hero h1 span {
    background: linear-gradient(135deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .cutoff-hero-subtitle {
    font-size: 15px;
    color: #94a3b8;
    max-width: 650px;
    line-height: 1.6;
    margin-bottom: 20px;
  }
  .cutoff-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 6px 16px;
    border-radius: 99px;
    font-size: 12.5px;
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 18px;
  }
  .cutoff-hero-badge i {
    color: #38bdf8;
  }

  /* ─── Popular Acronyms Pill Strip ─── */
  .cutoff-acronyms-strip {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 16px;
    margin-bottom: 20px;
  }
  .cutoff-acronym-lbl {
    font-size: 13px;
    font-weight: 600;
    color: #cbd5e1;
  }
  .cutoff-acronym-chip {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
  }
  .cutoff-acronym-chip:hover {
    background: #38bdf8;
    color: #0f172a;
    border-color: #38bdf8;
    transform: translateY(-2px);
  }

  /* ─── Stats Row ─── */
  .cutoff-stats-row {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    margin-top: 12px;
  }
  .cutoff-stat {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-md);
    padding: 12px 18px;
    backdrop-filter: blur(8px);
  }
  .cutoff-stat-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }
  .cutoff-stat-icon.blue { background: rgba(56,189,248,0.2); color: #38bdf8; }
  .cutoff-stat-icon.purple { background: rgba(139,92,246,0.2); color: #a78bfa; }
  .cutoff-stat-icon.green { background: rgba(52,211,153,0.2); color: #34d399; }
  .cutoff-stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
  }
  .cutoff-stat-label {
    font-size: 11px;
    color: #94a3b8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* ─── Download Button ─── */
  .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 13.5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    margin-top: 14px;
  }
  .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16,185,129,0.3);
    color: #fff;
  }

  /* ─── Search & Filter Section ─── */
  .cutoff-search-section {
    background: #fff;
    border-bottom: 1px solid var(--border);
    padding: 24px 0;
    position: sticky;
    top: 64px;
    z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .search-filter-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr 180px 140px;
    gap: 14px;
    align-items: end;
  }
  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .filter-group label {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-2);
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }
  .filter-input,
  .filter-select {
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    color: var(--text-1);
    background: #fff;
    transition: all 0.2s ease;
    width: 100%;
  }
  .filter-input:focus,
  .filter-select:focus {
    outline: none;
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
  }
  .filter-input::placeholder {
    color: var(--text-3);
  }
  .btn-search {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: var(--brand);
    color: #fff;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    height: 42px;
  }
  .btn-search:hover {
    background: var(--brand-dark);
    transform: translateY(-1px);
  }
  .btn-clear {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: transparent;
    color: var(--text-3);
    padding: 8px 12px;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 13px;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.2s ease;
    margin-top: 6px;
  }
  .btn-clear:hover {
    color: #dc2626;
    border-color: #dc2626;
    background: #fef2f2;
  }

  /* ─── Autocomplete ─── */
  .autocomplete-wrapper {
    position: relative;
  }
  .autocomplete-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    max-height: 260px;
    overflow-y: auto;
    z-index: 100;
    display: none;
  }
  .autocomplete-list.show {
    display: block;
  }
  .autocomplete-item {
    padding: 10px 14px;
    font-size: 13.5px;
    color: var(--text-1);
    cursor: pointer;
    transition: background 0.15s;
    border-bottom: 1px solid var(--border);
  }
  .autocomplete-item:last-child {
    border-bottom: none;
  }
  .autocomplete-item:hover,
  .autocomplete-item.active {
    background: var(--brand-light);
    color: var(--brand);
  }

  /* ─── Results Section ─── */
  .cutoff-results-section {
    background: var(--bg);
    padding: 30px 0 80px;
    min-height: 400px;
  }
  .results-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
  }
  .results-count {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-2);
  }
  .results-count strong {
    color: var(--brand);
  }
  .sort-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-2);
  }
  .sort-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    background: #fff;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    color: var(--text-2);
  }
  .sort-btn.active {
    background: var(--brand-light);
    border-color: var(--brand);
    color: var(--brand);
  }
  .sort-btn:hover {
    border-color: var(--brand);
    color: var(--brand);
  }

  /* ─── Results Table ─── */
  .cutoff-table-wrapper {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }
  .cutoff-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
  }
  .cutoff-table thead {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    position: sticky;
    top: 0;
    z-index: 10;
  }
  .cutoff-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-2);
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
    cursor: pointer;
    transition: color 0.2s;
    user-select: none;
  }
  .cutoff-table th:hover {
    color: var(--brand);
  }
  .cutoff-table th.sorted {
    color: var(--brand);
  }
  .cutoff-table th .sort-icon {
    margin-left: 4px;
    font-size: 10px;
    opacity: 0.5;
  }
  .cutoff-table th.sorted .sort-icon {
    opacity: 1;
  }
  .cutoff-table td {
    padding: 12px 16px;
    color: var(--text-1);
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }
  .cutoff-table tbody tr {
    transition: background 0.15s;
  }
  .cutoff-table tbody tr:hover {
    background: rgba(26,86,219,0.02);
  }
  .cutoff-table tbody tr:last-child td {
    border-bottom: none;
  }
  .college-name-cell {
    font-weight: 600;
    color: var(--text-1);
    max-width: 340px;
    line-height: 1.4;
  }
  .college-action-row {
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .btn-college-info {
    font-size: 11px;
    font-weight: 700;
    color: var(--brand);
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    padding: 2px 8px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .btn-college-info:hover {
    background: var(--brand);
    color: white;
  }
  .branch-cell {
    color: var(--text-1);
    max-width: 280px;
  }
  .percentile-cell {
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 15px;
  }
  .percentile-high { color: #059669; }
  .percentile-mid  { color: #d97706; }
  .percentile-low  { color: #dc2626; }
  .merit-cell {
    font-weight: 600;
    color: var(--text-2);
    font-size: 13px;
  }
  .seat-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
  }
  .seat-badge.gopens {
    background: #ecfdf5;
    color: #059669;
  }
  .seat-badge.gopenh {
    background: #eff6ff;
    color: #2563eb;
  }
  .band-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    background: #f1f5f9;
    color: var(--text-2);
  }

  /* ─── Loading State ─── */
  .loading-overlay {
    display: none;
    text-align: center;
    padding: 60px 20px;
  }
  .loading-overlay.active {
    display: block;
  }
  .loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--border);
    border-top-color: var(--brand);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto 16px;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  .loading-text {
    font-size: 14px;
    color: var(--text-3);
  }

  /* ─── Empty State ─── */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    display: none;
  }
  .empty-state.active {
    display: block;
  }
  .empty-state i {
    font-size: 48px;
    color: var(--text-3);
    margin-bottom: 16px;
  }
  .empty-state h3 {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 8px;
  }
  .empty-state p {
    font-size: 14px;
    color: var(--text-3);
    max-width: 400px;
    margin: 0 auto;
  }

  /* ─── Pagination ─── */
  .cutoff-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 24px;
    flex-wrap: wrap;
  }
  .page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    padding: 0 12px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    background: #fff;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-2);
    cursor: pointer;
    transition: all 0.2s;
  }
  .page-btn:hover {
    border-color: var(--brand);
    color: var(--brand);
    background: var(--brand-light);
  }
  .page-btn.active {
    background: var(--brand);
    border-color: var(--brand);
    color: #fff;
  }
  .page-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
  }
  .page-info {
    font-size: 13px;
    color: var(--text-3);
    padding: 0 8px;
  }

  /* ─── Mobile Card Layout ─── */
  .cutoff-cards-mobile {
    display: none;
  }
  .cutoff-card-mobile {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px;
    margin-bottom: 12px;
    box-shadow: var(--shadow-sm);
  }
  .cutoff-card-mobile-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 10px;
  }
  .cutoff-card-mobile-name {
    font-weight: 700;
    color: var(--text-1);
    font-size: 14.5px;
    line-height: 1.4;
  }
  .cutoff-card-mobile-branch {
    font-size: 13px;
    color: var(--text-2);
    margin-bottom: 10px;
  }
  .cutoff-card-mobile-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 12px;
  }
  .cutoff-card-stat {
    background: var(--bg);
    border-radius: var(--radius-sm);
    padding: 8px;
    text-align: center;
  }
  .cutoff-card-stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 800;
  }
  .cutoff-card-stat-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* ─── College Modal / Slide-over ─── */
  .college-modal-backdrop {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .college-modal-backdrop.active {
    display: flex;
  }
  .college-modal-card {
    background: white;
    width: 100%;
    max-width: 600px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
    animation: modalSlide 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
  }
  @keyframes modalSlide {
    from { opacity: 0; transform: scale(0.95) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }
  .college-modal-header {
    background: linear-gradient(135deg, #1e3a5f, #1a56db);
    color: white;
    padding: 20px 24px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
  }
  .college-modal-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.3;
    margin: 0;
  }
  .btn-modal-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: background 0.2s;
  }
  .btn-modal-close:hover {
    background: rgba(255,255,255,0.4);
  }
  .college-modal-body {
    padding: 24px;
    overflow-y: auto;
    font-size: 14px;
  }
  .modal-attr-grid {
    display: grid;
    grid-template-columns: 140px 1fr;
    gap: 12px 0;
    margin-bottom: 20px;
  }
  .modal-attr-lbl {
    font-weight: 600;
    color: var(--text-2);
  }
  .modal-attr-val {
    color: var(--text-1);
    font-weight: 500;
  }
  .college-modal-footer {
    padding: 16px 24px;
    background: #f8fafc;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  /* ─── Responsive ─── */
  @media (max-width: 991px) {
    .search-filter-grid {
      grid-template-columns: 1fr 1fr;
    }
    .cutoff-stats-row {
      gap: 12px;
    }
    .cutoff-stat {
      flex: 1;
      min-width: 140px;
    }
  }
  @media (max-width: 767px) {
    .search-filter-grid {
      grid-template-columns: 1fr;
    }
    .cutoff-hero {
      padding: 40px 0 30px;
    }
    .cutoff-table-wrapper {
      display: none;
    }
    .cutoff-cards-mobile {
      display: block;
    }
    .cutoff-stats-row {
      flex-direction: column;
    }
    .cutoff-search-section {
      position: relative;
      top: 0;
    }
  }
</style>
@endsection

@section('content')
<!-- ─── Hero ─── -->
<section class="cutoff-hero">
  <div class="cutoff-hero-glow"></div>
  <div class="container" style="position: relative; z-index: 2;">
    <div class="cutoff-hero-badge">
      <i class="fa-solid fa-database"></i>
      CAP Round I &middot; 2025-26 Academic Year
    </div>
    <h1>Maharashtra <span>MHT-CET</span><br>Engineering Cutoffs 2025</h1>
    <p class="cutoff-hero-subtitle">
      Browse the complete MHT-CET engineering cutoff data for 2025-26 CAP Round I across all Maharashtra colleges.
      Search by college acronym (COEP, VJTI, PICT, etc.), branch, or seat category.
    </p>

    <!-- Popular College Acronym Filter Chips -->
    <div class="cutoff-acronyms-strip">
      <span class="cutoff-acronym-lbl"><i class="fa-solid fa-bolt text-amber-300"></i> Top Institutes:</span>
      @foreach($popularAcronyms as $acronym => $full)
        <span class="cutoff-acronym-chip" data-acronym="{{ $acronym }}" title="{{ $full }}">
          {{ $acronym }}
        </span>
      @endforeach
    </div>

    <div class="cutoff-stats-row">
      <div class="cutoff-stat">
        <div class="cutoff-stat-icon blue"><i class="fa-solid fa-school"></i></div>
        <div>
          <div class="cutoff-stat-value">{{ number_format($totalColleges) }}</div>
          <div class="cutoff-stat-label">Colleges</div>
        </div>
      </div>
      <div class="cutoff-stat">
        <div class="cutoff-stat-icon purple"><i class="fa-solid fa-code-branch"></i></div>
        <div>
          <div class="cutoff-stat-value">{{ number_format($totalBranches) }}</div>
          <div class="cutoff-stat-label">Branches</div>
        </div>
      </div>
      <div class="cutoff-stat">
        <div class="cutoff-stat-icon green"><i class="fa-solid fa-list-ol"></i></div>
        <div>
          <div class="cutoff-stat-value">{{ number_format($totalRecords) }}</div>
          <div class="cutoff-stat-label">Cutoff Records</div>
        </div>
      </div>
    </div>

    <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
      <a href="{{ route('tools.mh-cutoff.download') }}" class="btn-download">
        <i class="fa-solid fa-download"></i> Download Full CSV
      </a>
      <a href="{{ route('indian-colleges.index') }}" class="btn-download" style="background: rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.3);">
        <i class="fa-solid fa-building-columns"></i> Browse All 98k+ Colleges
      </a>
    </div>
  </div>
</section>

<!-- ─── Search & Filter Bar ─── -->
<section class="cutoff-search-section">
  <div class="container">
    <div class="search-filter-grid">
      <div class="filter-group">
        <label>Search College / Acronym</label>
        <div class="autocomplete-wrapper">
          <input type="text" id="collegeSearch" class="filter-input" placeholder="Type COEP, VJTI, Pune, etc..." autocomplete="off">
          <div id="collegeAutocomplete" class="autocomplete-list"></div>
        </div>
      </div>
      <div class="filter-group">
        <label>Branch / Course</label>
        <select id="branchFilter" class="filter-select">
          <option value="">All Branches</option>
          @foreach($branches as $b)
            <option value="{{ $b }}">{{ $b }}</option>
          @endforeach
        </select>
      </div>
      <div class="filter-group">
        <label>Seat Type</label>
        <select id="categoryFilter" class="filter-select">
          <option value="">All Seat Types (All Categories)</option>
          @foreach($categories as $c)
            @php
              $label = match(strtoupper($c)) {
                'GOPENH' => 'GOPENH — Home University Open',
                'GOPENS' => 'GOPENS — State Level Open',
                'TFWS' => 'TFWS — Tuition Fee Waiver',
                'EWS' => 'EWS — Economically Weaker Section',
                default => $c,
              };
            @endphp
            <option value="{{ $c }}">{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="filter-group">
        <label>&nbsp;</label>
        <button type="button" id="searchBtn" class="btn-search">
          <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        <button type="button" id="clearBtn" class="btn-clear">
          <i class="fa-solid fa-xmark"></i> Clear All
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ─── Results ─── -->
<section class="cutoff-results-section">
  <div class="container">
    <!-- Results header -->
    <div class="results-header">
      <div class="results-count">
        Showing <strong id="showingCount">{{ !empty($initialCutoffs) ? count($initialCutoffs) : 0 }}</strong> of <strong id="totalCount">{{ number_format($initialTotal ?? 0) }}</strong> results
      </div>
      <div class="sort-controls">
        <span>Sort by:</span>
        <button class="sort-btn active" data-sort="percentile" data-dir="desc">
          <i class="fa-solid fa-arrow-down-wide-short"></i> Percentile
        </button>
        <button class="sort-btn" data-sort="college_name" data-dir="asc">
          <i class="fa-solid fa-arrow-down-a-z"></i> College
        </button>
        <button class="sort-btn" data-sort="merit_no" data-dir="asc">
          <i class="fa-solid fa-arrow-down-1-9"></i> Merit No
        </button>
      </div>
    </div>

    <!-- Loading -->
    <div id="loadingState" class="loading-overlay">
      <div class="loading-spinner"></div>
      <div class="loading-text">Loading cutoff data...</div>
    </div>

    <!-- Empty state -->
    <div id="emptyState" class="empty-state {{ empty($initialCutoffs) || count($initialCutoffs) === 0 ? 'active' : '' }}">
      <i class="fa-solid fa-magnifying-glass"></i>
      <h3>No Cutoffs Found</h3>
      <p>Try adjusting your search filters or searching for acronyms like <strong>COEP</strong>, <strong>VJTI</strong>, or <strong>PICT</strong>.</p>
    </div>

    <!-- Desktop table -->
    <div class="cutoff-table-wrapper" id="tableWrapper" style="{{ empty($initialCutoffs) || count($initialCutoffs) === 0 ? 'display:none;' : 'display:block;' }}">
      <div style="overflow-x: auto;">
        <table class="cutoff-table">
          <thead>
            <tr>
              <th data-col="college_name">College & Institute Profile <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="branch_name">Branch / Course <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="category">Seat Type <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="percentile" class="sorted">Percentile <i class="fa-solid fa-sort-down sort-icon"></i></th>
              <th data-col="merit_no">Merit No. <i class="fa-solid fa-sort sort-icon"></i></th>
              <th>Band</th>
            </tr>
          </thead>
          <tbody id="cutoffTableBody">
            @if(!empty($initialCutoffs))
              @foreach($initialCutoffs as $r)
                @php
                  $pct = (float)$r->percentile;
                  $percClass = $pct >= 95 ? 'percentile-high' : ($pct >= 80 ? 'percentile-mid' : 'percentile-low');
                  $catClass = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $r->category ?? 'OPEN'));
                @endphp
                <tr>
                  <td class="college-name-cell">
                    <div>{{ $r->college_name }}</div>
                    <div class="college-action-row">
                      <span class="btn-college-info" onclick="window.__openProfile('{{ addslashes($r->college_name) }}', '{{ addslashes($r->college_code ?? '') }}')">
                        <i class="fa-solid fa-circle-info"></i> Details & Institute Info
                      </span>
                    </div>
                  </td>
                  <td class="branch-cell">{{ $r->branch_name }}</td>
                  <td><span class="seat-badge {{ $catClass }}">{{ $r->category }}</span></td>
                  <td class="percentile-cell {{ $percClass }}">{{ number_format($pct, 2) }}%</td>
                  <td class="merit-cell">{{ $r->merit_no ? '#' . number_format($r->merit_no) : 'N/A' }}</td>
                  <td>
                    @if($r->percentile_band)
                      <span class="band-badge">{{ $r->percentile_band }}</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <!-- Mobile cards -->
    <div class="cutoff-cards-mobile" id="mobileCards">
      @if(!empty($initialCutoffs))
        @foreach($initialCutoffs as $r)
          @php
            $pct = (float)$r->percentile;
            $percClass = $pct >= 95 ? 'percentile-high' : ($pct >= 80 ? 'percentile-mid' : 'percentile-low');
            $catClass = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $r->category ?? 'OPEN'));
          @endphp
          <div class="cutoff-card-mobile">
            <div class="cutoff-card-mobile-header">
              <div class="cutoff-card-mobile-name">{{ $r->college_name }}</div>
              <span class="seat-badge {{ $catClass }}">{{ $r->category }}</span>
            </div>
            <div class="cutoff-card-mobile-branch">
              <i class="fa-solid fa-code-branch" style="color:var(--brand); margin-right:4px;"></i>
              {{ $r->branch_name }}
            </div>
            <div class="cutoff-card-mobile-stats">
              <div class="cutoff-card-stat">
                <div class="cutoff-card-stat-value {{ $percClass }}">{{ number_format($pct, 2) }}%</div>
                <div class="cutoff-card-stat-label">Percentile</div>
              </div>
              <div class="cutoff-card-stat">
                <div class="cutoff-card-stat-value" style="color:var(--text-1);">{{ $r->merit_no ? '#' . number_format($r->merit_no) : 'N/A' }}</div>
                <div class="cutoff-card-stat-label">Merit No.</div>
              </div>
            </div>
            <div style="margin-top: 10px; text-align:center;">
              <button class="btn-college-info" style="width:100%; justify-content:center; padding: 6px 12px;" onclick="window.__openProfile('{{ addslashes($r->college_name) }}', '{{ addslashes($r->college_code ?? '') }}')">
                <i class="fa-solid fa-circle-info"></i> View Institute Profile & Address
              </button>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <!-- Pagination -->
    <div class="cutoff-pagination" id="pagination">
      @php
        $lastPage = ceil(($initialTotal ?? 1) / 50);
      @endphp
      @if($lastPage > 1)
        <button class="page-btn" disabled><i class="fa-solid fa-chevron-left"></i></button>
        <button class="page-btn active" onclick="window.__cutoffPage(1)">1</button>
        @if($lastPage >= 2)
          <button class="page-btn" onclick="window.__cutoffPage(2)">2</button>
        @endif
        @if($lastPage >= 3)
          <button class="page-btn" onclick="window.__cutoffPage(3)">3</button>
        @endif
        @if($lastPage > 4)
          <span class="page-info">...</span>
          <button class="page-btn" onclick="window.__cutoffPage({{ $lastPage }})">{{ $lastPage }}</button>
        @endif
        <button class="page-btn" onclick="window.__cutoffPage(2)"><i class="fa-solid fa-chevron-right"></i></button>
        <span class="page-info">Page 1 of {{ $lastPage }}</span>
      @endif
    </div>
  </div>
</section>

<!-- ─── Institutional Details Modal ─── -->
<div class="college-modal-backdrop" id="collegeModal">
  <div class="college-modal-card">
    <div class="college-modal-header">
      <div>
        <div style="font-size: 11px; text-transform:uppercase; letter-spacing:1px; color:#93c5fd; margin-bottom:4px;">Combined Institutional Profile</div>
        <h3 class="college-modal-title" id="modalCollegeName">College Name</h3>
      </div>
      <button type="button" class="btn-modal-close" id="modalCloseBtn">&times;</button>
    </div>
    <div class="college-modal-body" id="modalBody">
      <div id="modalLoading" style="text-align:center; padding:30px 0;">
        <div class="loading-spinner"></div>
        <div>Loading college details...</div>
      </div>
      <div id="modalContent" style="display:none;">
        <div class="modal-attr-grid">
          <div class="modal-attr-lbl">DTE Code</div>
          <div class="modal-attr-val" id="modalCode">N/A</div>

          <div class="modal-attr-lbl">Location</div>
          <div class="modal-attr-val" id="modalLocation">N/A</div>

          <div class="modal-attr-lbl">University</div>
          <div class="modal-attr-val" id="modalUniversity">N/A</div>

          <div class="modal-attr-lbl">Management</div>
          <div class="modal-attr-val" id="modalManagement">N/A</div>

          <div class="modal-attr-lbl">Established</div>
          <div class="modal-attr-val" id="modalEstablished">N/A</div>

          <div class="modal-attr-lbl">Address</div>
          <div class="modal-attr-val" id="modalAddress">N/A</div>
        </div>

        <!-- Campus Map Inside Modal -->
        <div id="modalMapSection" style="margin-top: 20px; display: none;">
          <div style="font-size: 13.5px; font-weight: 700; color: var(--text-1); margin-bottom: 8px; display: flex; align-items: center; justify-content: space-between;">
            <span><i class="fa-solid fa-map-location-dot" style="color: #ea580c; margin-right: 6px;"></i> Campus Map & Location</span>
            <a href="#" id="modalDirectionsLink" target="_blank" rel="noopener noreferrer" style="font-size: 12.5px; color: var(--brand); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
              <i class="fa-solid fa-diamond-turn-right"></i> Directions <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></i>
            </a>
          </div>
          <div style="border-radius: 12px; overflow: hidden; border: 1px solid var(--border); box-shadow: 0 4px 16px rgba(0,0,0,.06); background: var(--surface);">
            <iframe id="modalMapIframe" src="" width="100%" height="220" style="border:0; display: block;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
    <div class="college-modal-footer">
      <a href="#" id="modalWebsiteLink" target="_blank" rel="noopener noreferrer" class="btn-website" style="background:#475569; display:none;">
        Official Website <i class="fa-solid fa-arrow-up-right-from-square"></i>
      </a>
      <a href="#" id="modalProfileLink" class="btn-website" style="background:var(--brand); display:none;">
        View Full College Profile <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>
</div>

<!-- ─── SEO FAQ & Information Section ─── -->
<section class="cutoff-faq-section" style="padding: 60px 0; background: #ffffff; border-top: 1px solid var(--border);">
  <div class="container">
    <div style="max-width: 900px; margin: 0 auto;">
      <div style="text-align: center; margin-bottom: 40px;">
        <span style="background: var(--brand-light); color: var(--brand); font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 99px; text-transform: uppercase; letter-spacing: 1px;">Guide & FAQs</span>
        <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-1); margin-top: 12px;">Frequently Asked Questions (MHT-CET Cutoff 2025)</h2>
        <p style="color: var(--text-2); font-size: 15px; margin-top: 8px;">Everything you need to know about Maharashtra Engineering CAP Round admissions, category codes, and percentile calculations.</p>
      </div>

      <div class="faq-grid" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 14px; padding: 24px;">
          <h3 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 8px;">
            <i class="fa-solid fa-circle-question" style="color: var(--brand); margin-right: 8px;"></i> What is the MHT-CET 2025 Cutoff Percentile?
          </h3>
          <p style="color: var(--text-2); font-size: 14.5px; line-height: 1.6;">
            The MHT-CET 2025 Cutoff is the minimum percentile score or State General Merit Rank required by a candidate to secure admission into a specific engineering branch (like Computer Science, IT, AI-DS, Mechanical) at a Maharashtra engineering institute during State CET Cell Centralized Admission Process (CAP) Rounds.
          </p>
        </div>

        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 14px; padding: 24px;">
          <h3 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 8px;">
            <i class="fa-solid fa-tags" style="color: var(--brand); margin-right: 8px;"></i> What do GOPENS, GOPENH, and LOPEN category codes mean?
          </h3>
          <p style="color: var(--text-2); font-size: 14.5px; line-height: 1.6;">
            In MHT-CET CAP allocation:
            <br>• <strong>GOPENS</strong>: General Open Category - State Level seats (open for candidates across Maharashtra state).
            <br>• <strong>GOPENH</strong>: General Open Category - Home University seats (reserved for students under that specific university area).
            <br>• <strong>LOPENS / LOPENH</strong>: Ladies Open category seats for State or Home University.
            <br>• <strong>GOBCS / GSCH</strong>: General OBC / SC seats for State or Home University quotas.
          </p>
        </div>

        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 14px; padding: 24px;">
          <h3 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 8px;">
            <i class="fa-solid fa-graduation-cap" style="color: var(--brand); margin-right: 8px;"></i> Which colleges have the highest MHT CET Engineering Cutoff?
          </h3>
          <p style="color: var(--text-2); font-size: 14.5px; line-height: 1.6;">
            Top autonomous institutes like <strong>Veermata Jijabai Technological Institute (VJTI), Mumbai</strong> (99.95 percentile), <strong>COEP Technological University, Pune</strong> (99.93 percentile), <strong>Sardar Patel Institute of Technology (SPIT), Mumbai</strong> (99.60 percentile), <strong>Walchand College of Engineering, Sangli</strong> (99.47 percentile), and <strong>PICT Pune</strong> (99.28 percentile) consistently have the highest cutoffs for Computer Science and IT branches.
          </p>
        </div>

        <div style="background: var(--bg); border: 1px solid var(--border); border-radius: 14px; padding: 24px;">
          <h3 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 8px;">
            <i class="fa-solid fa-file-csv" style="color: var(--brand); margin-right: 8px;"></i> Can I download the complete MHT-CET Cutoff Excel/CSV file?
          </h3>
          <p style="color: var(--text-2); font-size: 14.5px; line-height: 1.6;">
            Yes! You can download the complete official 2025 CAP Round 1 cutoff list for all 363+ colleges as a CSV spreadsheet directly from CareerGyan by clicking the <strong>"Download Full CSV"</strong> button above.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Schema.org JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "WebPage",
      "@@id": "{{ url('/tools/maharashtra-colleges-cutoff') }}",
      "url": "{{ url('/tools/maharashtra-colleges-cutoff') }}",
      "name": "MHT CET Cutoff 2025 - All Maharashtra Engineering Colleges",
      "description": "Official MHT CET 2025 CAP Round 1 cutoff percentiles and merit ranks for 363+ engineering colleges in Maharashtra including VJTI, COEP, PICT, Walchand.",
      "breadcrumb": {
        "@@type": "BreadcrumbList",
        "itemListElement": [
          { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
          { "@@type": "ListItem", "position": 2, "name": "MHT CET Cutoff 2025", "item": "{{ url('/tools/maharashtra-colleges-cutoff') }}" }
        ]
      }
    }
  ]
}
</script>
@endsection

@section('scripts')
<script>
(function() {
  const SEARCH_URL = @json(route('tools.mh-cutoff.search', [], false));
  const COLLEGES_URL = @json(route('tools.mh-cutoff.colleges', [], false));
  const PROFILE_URL = @json(route('tools.mh-cutoff.profile', [], false));

  let currentSort = 'percentile';
  let currentDir = 'desc';
  let currentPage = 1;
  let debounceTimer = null;

  const collegeInput = document.getElementById('collegeSearch');
  const branchFilter = document.getElementById('branchFilter');
  const categoryFilter = document.getElementById('categoryFilter');
  const searchBtn = document.getElementById('searchBtn');
  const clearBtn = document.getElementById('clearBtn');
  const tableBody = document.getElementById('cutoffTableBody');
  const mobileCards = document.getElementById('mobileCards');
  const tableWrapper = document.getElementById('tableWrapper');
  const loadingState = document.getElementById('loadingState');
  const emptyState = document.getElementById('emptyState');
  const pagination = document.getElementById('pagination');
  const showingCount = document.getElementById('showingCount');
  const totalCount = document.getElementById('totalCount');
  const autocompleteList = document.getElementById('collegeAutocomplete');

  // Modal elements
  const modal = document.getElementById('collegeModal');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const modalCollegeName = document.getElementById('modalCollegeName');
  const modalLoading = document.getElementById('modalLoading');
  const modalContent = document.getElementById('modalContent');
  const modalCode = document.getElementById('modalCode');
  const modalLocation = document.getElementById('modalLocation');
  const modalUniversity = document.getElementById('modalUniversity');
  const modalManagement = document.getElementById('modalManagement');
  const modalEstablished = document.getElementById('modalEstablished');
  const modalAddress = document.getElementById('modalAddress');
  const modalWebsiteLink = document.getElementById('modalWebsiteLink');
  const modalProfileLink = document.getElementById('modalProfileLink');
  const modalMapSection = document.getElementById('modalMapSection');
  const modalMapIframe = document.getElementById('modalMapIframe');
  const modalDirectionsLink = document.getElementById('modalDirectionsLink');

  // ─── Modal Functions ───
  function openCollegeModal(collegeName, collegeCode) {
    modalCollegeName.textContent = collegeName || 'College Profile';
    modal.classList.add('active');
    modalLoading.style.display = 'block';
    modalContent.style.display = 'none';
    modalWebsiteLink.style.display = 'none';
    modalProfileLink.style.display = 'none';
    if (modalMapSection) modalMapSection.style.display = 'none';
    if (modalMapIframe) modalMapIframe.src = '';

    fetch(PROFILE_URL + '?college_name=' + encodeURIComponent(collegeName || '') + '&college_code=' + encodeURIComponent(collegeCode || ''))
      .then(r => r.json())
      .then(p => {
        modalLoading.style.display = 'none';
        modalContent.style.display = 'block';

        modalCode.textContent = p.college_code || collegeCode || 'N/A';
        modalLocation.textContent = (p.district ? p.district + ', ' : '') + (p.state || 'Maharashtra');
        modalUniversity.textContent = p.university_name || 'Autonomous / SPPU / State Affiliation';
        modalManagement.textContent = p.management || 'Government / Autonomous / Private';
        modalEstablished.textContent = p.year_of_establishment || 'Established';
        modalAddress.textContent = p.address || (p.city ? p.city + ', Maharashtra' : 'Maharashtra, India');

        if (p.website) {
          modalWebsiteLink.href = p.website;
          modalWebsiteLink.style.display = 'inline-flex';
        }
        if (p.show_url) {
          modalProfileLink.href = p.show_url;
          modalProfileLink.style.display = 'inline-flex';
        }
        if (p.map_embed_url && modalMapSection && modalMapIframe) {
          modalMapIframe.src = p.map_embed_url;
          if (modalDirectionsLink) {
            modalDirectionsLink.href = p.map_directions_url || p.map_embed_url;
          }
          modalMapSection.style.display = 'block';
        }
      })
      .catch(err => {
        modalLoading.style.display = 'none';
        modalContent.style.display = 'block';
        modalAddress.textContent = 'Information loaded from Maharashtra DTE registry.';
      });
  }

  modalCloseBtn.addEventListener('click', () => modal.classList.remove('active'));
  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.remove('active');
  });

  // ─── Acronym Chips Click ───
  document.querySelectorAll('.cutoff-acronym-chip').forEach(chip => {
    chip.addEventListener('click', function() {
      const ac = this.getAttribute('data-acronym');
      collegeInput.value = ac;
      fetchResults(1);
    });
  });

  // ─── Autocomplete ───
  collegeInput.addEventListener('input', function() {
    const q = this.value.trim();
    if (q.length < 2) {
      autocompleteList.classList.remove('show');
      return;
    }
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      fetch(COLLEGES_URL + '?q=' + encodeURIComponent(q))
        .then(r => r.json())
        .then(names => {
          if (!Array.isArray(names) || names.length === 0) {
            autocompleteList.classList.remove('show');
            return;
          }
          autocompleteList.innerHTML = names.map(n =>
            `<div class="autocomplete-item">${escHtml(n)}</div>`
          ).join('');
          autocompleteList.classList.add('show');

          autocompleteList.querySelectorAll('.autocomplete-item').forEach(item => {
            item.addEventListener('click', function() {
              collegeInput.value = this.textContent;
              autocompleteList.classList.remove('show');
              fetchResults(1);
            });
          });
        })
        .catch(() => autocompleteList.classList.remove('show'));
    }, 250);
  });

  document.addEventListener('click', e => {
    if (!e.target.closest('.autocomplete-wrapper')) {
      autocompleteList.classList.remove('show');
    }
  });

  // ─── Search & Filter ───
  searchBtn.addEventListener('click', () => fetchResults(1));
  clearBtn.addEventListener('click', () => {
    collegeInput.value = '';
    branchFilter.value = '';
    categoryFilter.value = '';
    fetchResults(1);
  });
  collegeInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') { e.preventDefault(); fetchResults(1); }
  });
  branchFilter.addEventListener('change', () => fetchResults(1));
  categoryFilter.addEventListener('change', () => fetchResults(1));

  // ─── Sort buttons ───
  document.querySelectorAll('.sort-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const sort = this.dataset.sort;
      if (currentSort === sort) {
        currentDir = currentDir === 'asc' ? 'desc' : 'asc';
      } else {
        currentSort = sort;
        currentDir = this.dataset.dir;
      }
      document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      fetchResults(currentPage);
    });
  });

  // ─── Table header sort ───
  document.querySelectorAll('.cutoff-table th[data-col]').forEach(th => {
    th.addEventListener('click', function() {
      const col = this.dataset.col;
      if (currentSort === col) {
        currentDir = currentDir === 'asc' ? 'desc' : 'asc';
      } else {
        currentSort = col;
        currentDir = col === 'college_name' || col === 'branch_name' ? 'asc' : 'desc';
      }
      fetchResults(currentPage);
    });
  });

  // ─── Fetch results ───
  function fetchResults(page) {
    currentPage = page || 1;
    loadingState.classList.add('active');
    emptyState.classList.remove('active');

    const params = new URLSearchParams({
      page: page,
      per_page: 50,
      sort_by: currentSort,
      sort_dir: currentDir
    });

    const q = collegeInput.value.trim();
    if (q) params.set('q', q);
    if (branchFilter.value) params.set('branch', branchFilter.value);
    if (categoryFilter.value) params.set('category', categoryFilter.value);

    fetch(SEARCH_URL + '?' + params.toString())
      .then(r => {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(result => {
        loadingState.classList.remove('active');

        if (!result || !result.data || result.data.length === 0) {
          tableWrapper.style.display = 'none';
          mobileCards.innerHTML = '';
          pagination.innerHTML = '';
          emptyState.classList.add('active');
          showingCount.textContent = '0';
          totalCount.textContent = '0';
          return;
        }

        showingCount.textContent = result.data.length;
        totalCount.textContent = Number(result.total || result.data.length).toLocaleString();

        // Desktop table
        tableBody.innerHTML = result.data.map(r => {
          const cName = r.college_name || 'N/A';
          const cCode = r.college_code || '';
          const bName = r.branch_name || 'N/A';
          const cat = r.category ? String(r.category) : 'OPEN';
          const catClass = cat.toLowerCase().replace(/[^a-z0-9]/g, '');
          const perc = formatPercentile(r.percentile);
          const percClass = getPercentileClass(r.percentile || 0);
          const merit = r.merit_no ? '#' + Number(r.merit_no).toLocaleString() : 'N/A';
          const band = r.percentile_band ? `<span class="band-badge">${escHtml(r.percentile_band)}</span>` : '';

          return `
            <tr>
              <td class="college-name-cell">
                <div>${escHtml(cName)}</div>
                <div class="college-action-row">
                  <span class="btn-college-info" onclick="window.__openProfile('${escAttr(cName)}', '${escAttr(cCode)}')">
                    <i class="fa-solid fa-circle-info"></i> Details & Institute Info
                  </span>
                </div>
              </td>
              <td class="branch-cell">${escHtml(bName)}</td>
              <td><span class="seat-badge ${catClass}">${escHtml(cat)}</span></td>
              <td class="percentile-cell ${percClass}">${perc}%</td>
              <td class="merit-cell">${merit}</td>
              <td>${band}</td>
            </tr>
          `;
        }).join('');
        tableWrapper.style.display = 'block';

        // Mobile cards
        mobileCards.innerHTML = result.data.map(r => {
          const cName = r.college_name || 'N/A';
          const cCode = r.college_code || '';
          const bName = r.branch_name || 'N/A';
          const cat = r.category ? String(r.category) : 'OPEN';
          const catClass = cat.toLowerCase().replace(/[^a-z0-9]/g, '');
          const perc = formatPercentile(r.percentile);
          const percClass = getPercentileClass(r.percentile || 0);
          const merit = r.merit_no ? '#' + Number(r.merit_no).toLocaleString() : 'N/A';

          return `
            <div class="cutoff-card-mobile">
              <div class="cutoff-card-mobile-header">
                <div class="cutoff-card-mobile-name">${escHtml(cName)}</div>
                <span class="seat-badge ${catClass}">${escHtml(cat)}</span>
              </div>
              <div class="cutoff-card-mobile-branch">
                <i class="fa-solid fa-code-branch" style="color:var(--brand); margin-right:4px;"></i>
                ${escHtml(bName)}
              </div>
              <div class="cutoff-card-mobile-stats">
                <div class="cutoff-card-stat">
                  <div class="cutoff-card-stat-value ${percClass}">${perc}%</div>
                  <div class="cutoff-card-stat-label">Percentile</div>
                </div>
                <div class="cutoff-card-stat">
                  <div class="cutoff-card-stat-value" style="color:var(--text-1);">${merit}</div>
                  <div class="cutoff-card-stat-label">Merit No.</div>
                </div>
              </div>
              <div style="margin-top: 10px; text-align:center;">
                <button class="btn-college-info" style="width:100%; justify-content:center; padding: 6px 12px;" onclick="window.__openProfile('${escAttr(cName)}', '${escAttr(cCode)}')">
                  <i class="fa-solid fa-circle-info"></i> View Institute Profile & Address
                </button>
              </div>
            </div>
          `;
        }).join('');

        // Pagination
        renderPagination(result.current_page || 1, result.last_page || 1, result.total || result.data.length);

        // Update sort header icons
        document.querySelectorAll('.cutoff-table th[data-col]').forEach(th => {
          th.classList.remove('sorted');
          const icon = th.querySelector('.sort-icon');
          if (icon) icon.className = 'fa-solid fa-sort sort-icon';
        });
        const sortedTh = document.querySelector(`.cutoff-table th[data-col="${currentSort}"]`);
        if (sortedTh) {
          sortedTh.classList.add('sorted');
          const icon = sortedTh.querySelector('.sort-icon');
          if (icon) icon.className = `fa-solid fa-sort-${currentDir === 'asc' ? 'up' : 'down'} sort-icon`;
        }
      })
      .catch(err => {
        loadingState.classList.remove('active');
        console.error('Fetch error:', err);
      });
  }

  window.__openProfile = function(name, code) {
    openCollegeModal(name, code);
  };

  function renderPagination(current, last, total) {
    if (last <= 1) { pagination.innerHTML = ''; return; }
    let html = '';
    html += `<button class="page-btn" ${current === 1 ? 'disabled' : ''} onclick="window.__cutoffPage(${current - 1})"><i class="fa-solid fa-chevron-left"></i></button>`;

    const pages = getPaginationRange(current, last);
    pages.forEach(p => {
      if (p === '...') {
        html += `<span class="page-info">...</span>`;
      } else {
        html += `<button class="page-btn ${p === current ? 'active' : ''}" onclick="window.__cutoffPage(${p})">${p}</button>`;
      }
    });

    html += `<button class="page-btn" ${current === last ? 'disabled' : ''} onclick="window.__cutoffPage(${current + 1})"><i class="fa-solid fa-chevron-right"></i></button>`;
    html += `<span class="page-info">Page ${current} of ${last}</span>`;
    pagination.innerHTML = html;
  }

  function getPaginationRange(current, last) {
    const delta = 2;
    const range = [];
    const left = Math.max(2, current - delta);
    const right = Math.min(last - 1, current + delta);

    range.push(1);
    if (left > 2) range.push('...');
    for (let i = left; i <= right; i++) range.push(i);
    if (right < last - 1) range.push('...');
    if (last > 1) range.push(last);
    return range;
  }

  window.__cutoffPage = function(page) { 
    fetchResults(page); 
    const resultsSec = document.querySelector('.cutoff-results-section');
    if (resultsSec) {
      window.scrollTo({ top: resultsSec.offsetTop - 80, behavior: 'smooth' }); 
    }
  };

  function getPercentileClass(p) {
    if (p >= 95) return 'percentile-high';
    if (p >= 80) return 'percentile-mid';
    return 'percentile-low';
  }

  function formatPercentile(p) {
    if (!p || p === 0) return 'N/A';
    return parseFloat(p).toFixed(2);
  }

  function escHtml(s) {
    if (!s) return '';
    const d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
  }

  function escAttr(s) {
    if (!s) return '';
    return s.replace(/'/g, "\\'").replace(/"/g, '&quot;');
  }

  // Pre-fill from URL query param
  const urlParams = new URLSearchParams(window.location.search);
  const initialQ = urlParams.get('q');
  if (initialQ) {
    collegeInput.value = initialQ;
    fetchResults(1);
  }
})();
</script>
@endsection

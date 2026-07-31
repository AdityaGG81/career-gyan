@extends('layouts.app')

@section('title', 'Maharashtra MHT-CET Engineering Cutoffs 2025 | CareerGyan')
@section('meta_description', 'Search the complete Maharashtra MHT-CET Engineering cutoff list for 2025-26 CAP Round I. Filter by college, branch, and seat type. Download the full cutoff data as CSV.')
@section('meta_keywords', 'mht cet cutoff 2025, maharashtra engineering cutoff, cap round 1 cutoff, mhtcet percentile cutoff, college cutoff list maharashtra, gopens gopenh cutoff')

@section('styles')
<style>
  /* ─── Cutoff Hero ─── */
  .cutoff-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1a56db 100%);
    padding: 70px 0 50px;
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
    font-size: clamp(28px, 5vw, 42px);
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
    font-size: 16px;
    color: #94a3b8;
    max-width: 600px;
    line-height: 1.6;
    margin-bottom: 24px;
  }
  .cutoff-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 8px 16px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 600;
    color: #e2e8f0;
    margin-bottom: 24px;
  }
  .cutoff-hero-badge i {
    color: #38bdf8;
  }

  /* ─── Stats Row ─── */
  .cutoff-stats-row {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-top: 8px;
  }
  .cutoff-stat {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-md);
    padding: 14px 20px;
    backdrop-filter: blur(8px);
  }
  .cutoff-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }
  .cutoff-stat-icon.blue { background: rgba(56,189,248,0.2); color: #38bdf8; }
  .cutoff-stat-icon.purple { background: rgba(139,92,246,0.2); color: #a78bfa; }
  .cutoff-stat-icon.green { background: rgba(52,211,153,0.2); color: #34d399; }
  .cutoff-stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
  }
  .cutoff-stat-label {
    font-size: 12px;
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
    padding: 12px 24px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    margin-top: 16px;
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
    padding: 30px 0;
    position: sticky;
    top: 64px;
    z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .search-filter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 200px 160px;
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
    padding: 11px 14px;
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
    padding: 11px 24px;
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
    font-size: 14px;
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
    font-size: 14px;
  }
  .cutoff-table thead {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    position: sticky;
    top: 0;
    z-index: 10;
  }
  .cutoff-table th {
    padding: 14px 16px;
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
    padding: 14px 16px;
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
    max-width: 320px;
    line-height: 1.4;
  }
  .branch-cell {
    color: var(--text-1);
    max-width: 280px;
  }
  .percentile-cell {
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 16px;
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
    padding: 4px 10px;
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
    padding: 20px;
    margin-bottom: 12px;
    box-shadow: var(--shadow-sm);
  }
  .cutoff-card-mobile-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  .cutoff-card-mobile-name {
    font-weight: 700;
    color: var(--text-1);
    font-size: 15px;
    line-height: 1.4;
  }
  .cutoff-card-mobile-branch {
    font-size: 13px;
    color: var(--text-2);
    margin-bottom: 12px;
  }
  .cutoff-card-mobile-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .cutoff-card-stat {
    background: var(--bg);
    border-radius: var(--radius-sm);
    padding: 10px;
    text-align: center;
  }
  .cutoff-card-stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 800;
  }
  .cutoff-card-stat-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
      padding: 50px 0 40px;
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
      Search by college, branch, or seat type. Download the full dataset as CSV.
    </p>

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

    <a href="{{ route('tools.mh-cutoff.download') }}" class="btn-download">
      <i class="fa-solid fa-download"></i> Download Full CSV
    </a>
  </div>
</section>

<!-- ─── Search & Filter Bar ─── -->
<section class="cutoff-search-section">
  <div class="container">
    <div class="search-filter-grid">
      <div class="filter-group">
        <label>Search College</label>
        <div class="autocomplete-wrapper">
          <input type="text" id="collegeSearch" class="filter-input" placeholder="Type college name..." autocomplete="off">
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
          <option value="">All Types</option>
          @foreach($categories as $c)
            <option value="{{ $c }}">{{ $c }}</option>
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
        Showing <strong id="showingCount">0</strong> of <strong id="totalCount">0</strong> results
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
    <div id="loadingState" class="loading-overlay active">
      <div class="loading-spinner"></div>
      <div class="loading-text">Loading cutoff data...</div>
    </div>

    <!-- Empty state -->
    <div id="emptyState" class="empty-state">
      <i class="fa-solid fa-magnifying-glass"></i>
      <h3>No Cutoffs Found</h3>
      <p>Try adjusting your search filters or clearing all filters to see all available cutoff data.</p>
    </div>

    <!-- Desktop table -->
    <div class="cutoff-table-wrapper" id="tableWrapper" style="display:none;">
      <div style="overflow-x: auto;">
        <table class="cutoff-table">
          <thead>
            <tr>
              <th data-col="college_name" class="sorted">College Name <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="branch_name">Branch / Course <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="category">Seat Type <i class="fa-solid fa-sort sort-icon"></i></th>
              <th data-col="percentile" class="sorted">Percentile <i class="fa-solid fa-sort-down sort-icon"></i></th>
              <th data-col="merit_no">Merit No. <i class="fa-solid fa-sort sort-icon"></i></th>
              <th>Band</th>
            </tr>
          </thead>
          <tbody id="cutoffTableBody">
          </tbody>
        </table>
      </div>
    </div>

    <!-- Mobile cards -->
    <div class="cutoff-cards-mobile" id="mobileCards"></div>

    <!-- Pagination -->
    <div class="cutoff-pagination" id="pagination"></div>
  </div>
</section>
@endsection

@section('scripts')
<script>
(function() {
  const SEARCH_URL = @json(route('tools.mh-cutoff.search'));
  const COLLEGES_URL = @json(route('tools.mh-cutoff.colleges'));

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
          if (names.length === 0) {
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
    currentPage = page;
    loadingState.classList.add('active');
    emptyState.classList.remove('active');
    tableWrapper.style.display = 'none';
    mobileCards.innerHTML = '';
    pagination.innerHTML = '';

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
      .then(r => r.json())
      .then(result => {
        loadingState.classList.remove('active');

        if (!result.data || result.data.length === 0) {
          emptyState.classList.add('active');
          showingCount.textContent = '0';
          totalCount.textContent = '0';
          return;
        }

        showingCount.textContent = result.data.length;
        totalCount.textContent = result.total.toLocaleString();

        // Desktop table
        tableBody.innerHTML = result.data.map(r => `
          <tr>
            <td class="college-name-cell">${escHtml(r.college_name)}</td>
            <td class="branch-cell">${escHtml(r.branch_name)}</td>
            <td><span class="seat-badge ${r.category.toLowerCase()}">${escHtml(r.category)}</span></td>
            <td class="percentile-cell ${getPercentileClass(r.percentile)}">${formatPercentile(r.percentile)}</td>
            <td class="merit-cell">${r.merit_no ? '#' + Number(r.merit_no).toLocaleString() : 'N/A'}</td>
            <td>${r.percentile_band ? '<span class="band-badge">' + escHtml(r.percentile_band) + '</span>' : ''}</td>
          </tr>
        `).join('');
        tableWrapper.style.display = 'block';

        // Mobile cards
        mobileCards.innerHTML = result.data.map(r => `
          <div class="cutoff-card-mobile">
            <div class="cutoff-card-mobile-header">
              <div class="cutoff-card-mobile-name">${escHtml(r.college_name)}</div>
              <span class="seat-badge ${r.category.toLowerCase()}">${escHtml(r.category)}</span>
            </div>
            <div class="cutoff-card-mobile-branch">
              <i class="fa-solid fa-code-branch" style="color:var(--brand); margin-right:4px;"></i>
              ${escHtml(r.branch_name)}
            </div>
            <div class="cutoff-card-mobile-stats">
              <div class="cutoff-card-stat">
                <div class="cutoff-card-stat-value ${getPercentileClass(r.percentile)}">${formatPercentile(r.percentile)}</div>
                <div class="cutoff-card-stat-label">Percentile</div>
              </div>
              <div class="cutoff-card-stat">
                <div class="cutoff-card-stat-value" style="color:var(--text-1);">${r.merit_no ? '#' + Number(r.merit_no).toLocaleString() : 'N/A'}</div>
                <div class="cutoff-card-stat-label">Merit No.</div>
              </div>
            </div>
          </div>
        `).join('');

        // Pagination
        renderPagination(result.current_page, result.last_page, result.total);

        // Update sort header icons
        document.querySelectorAll('.cutoff-table th[data-col]').forEach(th => {
          th.classList.remove('sorted');
          const icon = th.querySelector('.sort-icon');
          icon.className = 'fa-solid fa-sort sort-icon';
        });
        const sortedTh = document.querySelector(`.cutoff-table th[data-col="${currentSort}"]`);
        if (sortedTh) {
          sortedTh.classList.add('sorted');
          const icon = sortedTh.querySelector('.sort-icon');
          icon.className = `fa-solid fa-sort-${currentDir === 'asc' ? 'up' : 'down'} sort-icon`;
        }
      })
      .catch(err => {
        loadingState.classList.remove('active');
        emptyState.classList.add('active');
        console.error('Fetch error:', err);
      });
  }

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

  window.__cutoffPage = function(page) { fetchResults(page); window.scrollTo({ top: document.querySelector('.cutoff-results-section').offsetTop - 80, behavior: 'smooth' }); };

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

  // Pre-fill from URL query param (from homepage mini-search)
  const urlParams = new URLSearchParams(window.location.search);
  const initialQ = urlParams.get('q');
  if (initialQ) {
    collegeInput.value = initialQ;
  }

  // Initial load
  fetchResults(1);
})();
</script>
@endsection

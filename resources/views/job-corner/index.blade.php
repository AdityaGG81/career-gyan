@extends('layouts.app')

@section('title', 'Job Corner - CareerGyan')

@section('styles')
<style>
  .job-suggestions-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: #ffffff;
    border-radius: var(--radius-lg);
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.18);
    border: 1px solid var(--border);
    max-height: 340px;
    overflow-y: auto;
    z-index: 1000;
    text-align: left;
    display: none;
    animation: dropdownFadeIn 0.2s ease;
  }
  .job-suggestion-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    text-decoration: none;
    color: var(--text-1);
    border-bottom: 1px solid var(--border);
    transition: all 0.2s;
  }
  .job-suggestion-item:last-child { border-bottom: none; }
  .job-suggestion-item:hover, .job-suggestion-item.selected {
    background: #ecfdf5;
    color: #10b981;
    padding-left: 20px;
  }

  /* ══════════════════════════════════════════════
     JOB CORNER LAYOUT — RESPONSIVE CLASSES
     ══════════════════════════════════════════════ */
  .job-page-wrapper {
    background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    padding-top: 48px;
    min-height: calc(100vh - 200px);
  }

  .job-page-header {
    text-align: center;
    margin-bottom: 40px;
  }

  /* Main layout: sidebar + content */
  .job-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 32px;
    align-items: start;
  }

  /* Sidebar Filters */
  .job-sidebar {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 100px;
  }

  .sidebar-filter-label {
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    color: var(--text-2);
    display: block;
    margin-bottom: 8px;
  }

  .filter-section {
    margin-bottom: 24px;
  }

  .sector-tabs {
    display: flex;
    gap: 4px;
    background: #f1f5f9;
    border-radius: var(--radius-md);
    padding: 4px;
  }

  /* Mobile filter toggle button — hidden on desktop */
  .mobile-filter-toggle {
    display: none;
    width: 100%;
    padding: 14px 20px;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    font-family: inherit;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    cursor: pointer;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s ease;
    margin-bottom: 20px;
  }

  .mobile-filter-toggle:hover {
    background: #f8fafc;
    border-color: var(--brand);
  }

  .mobile-filter-toggle i.chevron {
    transition: transform 0.3s ease;
    font-size: 12px;
  }

  .mobile-filter-toggle.open i.chevron {
    transform: rotate(180deg);
  }

  /* Type Tabs (Active / Archived) */
  .type-tabs {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    border-bottom: 2px solid var(--border);
    padding-bottom: 12px;
  }

  .type-tab-link {
    font-size: 15px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: var(--transition);
  }

  /* Job Cards Grid */
  .job-cards-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
  }

  /* Job Card */
  .job-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-sm);
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 20px;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border-left: 4px solid transparent;
  }

  .job-card.sector-govt { border-left-color: #f59e0b; }
  .job-card.sector-pvt { border-left-color: #0d9488; }
  .job-card.sector-both { border-left-color: #8b5cf6; }

  .job-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(0, 0, 0, 0.08);
  }

  .job-card-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 12px;
    align-items: center;
  }

  .job-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 6px;
  }

  .job-card-title a {
    color: inherit;
    transition: color var(--transition);
  }

  .job-card-title a:hover {
    color: var(--brand);
  }

  .job-card-company {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-2);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .job-card-company i {
    color: var(--text-3);
  }

  .job-card-meta {
    display: flex;
    gap: 24px;
    font-size: 13px;
    color: var(--text-2);
    flex-wrap: wrap;
  }

  .job-card-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .job-card-meta i {
    color: var(--text-3);
  }

  .job-card-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    justify-content: center;
    align-items: flex-end;
  }

  .job-card-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    padding: 0 18px;
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 700;
    background: var(--brand-light);
    color: var(--brand-dark);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    white-space: nowrap;
  }

  .job-card-btn:hover {
    background: var(--brand);
    color: #ffffff;
    transform: translateX(2px);
  }

  /* Empty state */
  .job-empty-state {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 56px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
  }

  .job-empty-state i {
    font-size: 48px;
    color: var(--text-3);
    margin-bottom: 16px;
  }

  .job-empty-state h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    color: var(--text-1);
    margin-bottom: 8px;
  }

  .job-empty-state p {
    color: var(--text-2);
    max-width: 400px;
    margin: 0 auto;
  }

  /* Clear filters */
  .clear-filters-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 10px;
    background: #f1f5f9;
    color: var(--text-2);
    font-weight: 600;
    font-size: 13px;
    border-radius: var(--radius-md);
    transition: var(--transition);
    text-decoration: none;
  }

  .clear-filters-btn:hover {
    background: #e2e8f0;
    color: var(--text-1);
  }

  /* ══════════════════════════════════════════════
     FILTER INPUTS (Premium styling)
     ══════════════════════════════════════════════ */
  .filter-input {
    width: 100%;
    padding: 10px 14px 10px 36px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: 14px;
    outline: none;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
  }

  .filter-input:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
  }

  .filter-select {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: 14px;
    background: #ffffff;
    outline: none;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 36px;
    color: var(--text-1);
  }

  .filter-select:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
  }

  .sector-tab {
    flex: 1;
    text-align: center;
    padding: 8px 4px;
    font-size: 13px;
    font-weight: 700;
    border-radius: var(--radius-sm);
    text-decoration: none;
    color: var(--text-2);
    background: transparent;
    transition: all 0.2s ease;
  }

  .sector-tab:hover {
    color: var(--text-1);
  }

  .sector-tab.active {
    color: #1e293b;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  /* ══════════════════════════════════════════════
     RESPONSIVE — TABLET (≤ 991px)
     ══════════════════════════════════════════════ */
  @media (max-width: 991px) {
    .job-layout {
      grid-template-columns: 240px 1fr;
      gap: 24px;
    }
  }

  /* ══════════════════════════════════════════════
     RESPONSIVE — MOBILE (≤ 768px)
     ══════════════════════════════════════════════ */
  @media (max-width: 768px) {
    .job-page-wrapper {
      padding-top: 24px;
    }

    .job-page-header {
      margin-bottom: 24px;
    }

    .job-layout {
      grid-template-columns: 1fr;
      gap: 0;
    }

    /* Show mobile filter toggle */
    .mobile-filter-toggle {
      display: flex;
    }

    /* Hide sidebar by default on mobile */
    .job-sidebar {
      position: relative;
      top: 0;
      display: none;
      margin-bottom: 20px;
      border-radius: var(--radius-lg);
      animation: slideDown 0.3s ease;
    }

    .job-sidebar.mobile-open {
      display: block;
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Type tabs: scroll horizontally */
    .type-tabs {
      gap: 8px;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 12px;
    }

    .type-tab-link {
      font-size: 14px;
      padding: 8px 14px;
      white-space: nowrap;
    }

    /* Job Card: stack to single column */
    .job-card {
      grid-template-columns: 1fr;
      gap: 16px;
      padding: 20px;
    }

    .job-card:hover {
      transform: translateY(-2px);
    }

    .job-card-title {
      font-size: 16px;
    }

    .job-card-meta {
      gap: 12px;
      flex-direction: column;
    }

    .job-card-actions {
      align-items: stretch;
      width: 100%;
    }

    .job-card-btn {
      width: 100%;
      height: 44px;
      font-size: 14px;
      justify-content: center;
    }
  }

  /* ══════════════════════════════════════════════
     RESPONSIVE — SMALL MOBILE (≤ 480px)
     ══════════════════════════════════════════════ */
  @media (max-width: 480px) {
    .job-page-wrapper {
      padding-top: 16px;
    }

    .job-card {
      padding: 16px;
    }

    .job-card-badges {
      gap: 6px;
    }

    .job-card-badges .tag {
      font-size: 10px;
      padding: 3px 8px;
    }

    .job-card-meta {
      font-size: 12px;
    }

    .sector-tabs {
      flex-direction: column;
      gap: 2px;
    }

    .sector-tab {
      padding: 10px;
    }
  }
</style>
@endsection

@section('content')
<div class="section job-page-wrapper">
    <div class="container">
        
        <!-- HEADER SECTION -->
        <div class="fade-up fade-up-1 job-page-header">
            <span class="section-label">
                <i class="fa-solid fa-briefcase"></i> Recruitment Hub
            </span>
            <h1 class="section-title">Job Corner</h1>
            <p class="section-sub" style="margin: 10px auto 0;">Explore the latest recruitment notices, official notifications, and direct application links for Government & Private jobs.</p>
        </div>

        <!-- MOBILE FILTER TOGGLE BUTTON -->
        <button class="mobile-filter-toggle" id="mobileFilterToggle" onclick="toggleMobileFilters()">
            <i class="fa-solid fa-sliders"></i>
            Filters & Search
            <i class="fa-solid fa-chevron-down chevron"></i>
        </button>

        <!-- SEARCH AND FILTER CONTAINER -->
        <div class="job-layout reveal visible">
            
            <!-- SIDEBAR FILTERS -->
            <div class="job-sidebar" id="jobSidebar">
                <form action="{{ route('jobs.index') }}" method="GET" id="filterForm">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="sector" value="{{ $sector }}">

                    <!-- Sector Filter -->
                    <div class="filter-section">
                        <label class="sidebar-filter-label">Job Sector</label>
                        <div class="sector-tabs">
                            <a href="{{ route('jobs.index', array_merge(request()->except(['sector', 'page']), ['sector' => 'all'])) }}" 
                                class="sector-tab {{ $sector === 'all' ? 'active' : '' }}">
                                All
                            </a>
                            <a href="{{ route('jobs.index', array_merge(request()->except(['sector', 'page']), ['sector' => 'govt'])) }}" 
                                class="sector-tab {{ $sector === 'govt' ? 'active' : '' }}">
                                Govt
                            </a>
                            <a href="{{ route('jobs.index', array_merge(request()->except(['sector', 'page']), ['sector' => 'pvt'])) }}" 
                                class="sector-tab {{ $sector === 'pvt' ? 'active' : '' }}">
                                Pvt
                            </a>
                        </div>
                    </div>

                    <!-- Search Input -->
                    <div class="filter-section">
                        <label class="sidebar-filter-label">Keyword Search</label>
                        <div style="position: relative;" id="jobSearchWrap">
                            <input type="text" id="jobSearchInput" name="search" value="{{ request('search') }}" placeholder="Search company, title..." 
                                class="filter-input" autocomplete="off">
                            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 13px; color: var(--text-3); font-size: 13px;"></i>
                            <div id="jobSearchSuggestions" class="job-suggestions-dropdown"></div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="filter-section">
                        <label class="sidebar-filter-label">Job Category</label>
                        <select name="category" onchange="this.form.submit()" class="filter-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Qualification Filter -->
                    <div class="filter-section">
                        <label class="sidebar-filter-label">Qualification</label>
                        <select name="qualification" onchange="this.form.submit()" class="filter-select">
                            <option value="">All Qualifications</option>
                            @foreach($qualifications as $qual)
                                <option value="{{ $qual }}" {{ request('qualification') == $qual ? 'selected' : '' }}>{{ $qual }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location Filter -->
                    <div class="filter-section">
                        <label class="sidebar-filter-label">Location</label>
                        <div style="position: relative;">
                            <input type="text" name="location" value="{{ request('location') }}" placeholder="e.g., Maharashtra, Delhi" 
                                class="filter-input"
                                onchange="this.form.submit()">
                            <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 13px; color: var(--text-3); font-size: 13px;"></i>
                        </div>
                    </div>

                    <!-- Clear Button -->
                    @if(request()->anyFilled(['search', 'category', 'qualification', 'location']) || $sector !== 'all')
                        <a href="{{ route('jobs.index', ['type' => $type]) }}" class="clear-filters-btn">
                            <i class="fa-solid fa-xmark"></i> Clear All Filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- JOB LISTINGS -->
            <div>
                <!-- Type Selector Tabs -->
                <div class="type-tabs">
                    <a href="{{ route('jobs.index', array_merge(request()->except('page'), ['type' => 'active'])) }}" 
                        class="type-tab-link"
                        style="color: {{ $type === 'active' ? 'var(--brand)' : 'var(--text-2)' }}; background: {{ $type === 'active' ? 'var(--brand-light)' : 'transparent' }};">
                        <i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i> Active Jobs
                    </a>
                    <a href="{{ route('jobs.index', array_merge(request()->except('page'), ['type' => 'archived'])) }}" 
                        class="type-tab-link"
                        style="color: {{ $type === 'archived' ? 'var(--brand)' : 'var(--text-2)' }}; background: {{ $type === 'archived' ? 'var(--brand-light)' : 'transparent' }};">
                        <i class="fa-solid fa-archive" style="margin-right: 6px;"></i> Archived / Expired
                    </a>
                </div>

                <!-- LISTING GRID -->
                @if($jobs->isEmpty())
                    <div class="job-empty-state">
                        <i class="fa-solid fa-briefcase"></i>
                        <h3>No Job Openings Found</h3>
                        <p>We couldn't find any job openings matching your filters. Try modifying your search keywords or checking the archived tab.</p>
                    </div>
                @else
                    <div class="job-cards-grid">
                        @foreach($jobs as $job)
                            <div class="job-card sector-{{ $job->job_type }}">
                                
                                <div>
                                    <!-- Badges -->
                                    <div class="job-card-badges">
                                        @if($job->job_type === 'both')
                                            <span class="tag badge-purple"><i class="fa-solid fa-briefcase"></i> Govt & Pvt</span>
                                        @elseif($job->job_type === 'pvt')
                                            <span class="tag badge-teal"><i class="fa-solid fa-building"></i> Private</span>
                                        @else
                                            <span class="tag badge-amber"><i class="fa-solid fa-building-columns"></i> Govt</span>
                                        @endif
                                        <span class="tag badge-blue">{{ $job->category }}</span>
                                        <span class="tag badge-purple" style="background: #f3e8ff; color: #6b21a8;">{{ $job->qualification }}</span>
                                        
                                        @if(!$job->isExpired() && $job->isRecent())
                                            <span class="tag badge-green" style="animation: pulse 2s infinite;"><i class="fa-solid fa-sparkles"></i> NEW</span>
                                        @endif

                                        @if($job->isExpired())
                                            <span class="tag badge-rose"><i class="fa-solid fa-circle-xmark"></i> Closed / Expired</span>
                                        @endif
                                    </div>

                                    <!-- Details -->
                                    <h3 class="job-card-title">
                                        <a href="{{ route('jobs.show', $job->id) }}">
                                            {{ $job->job_title }}
                                        </a>
                                    </h3>
                                    <p class="job-card-company">
                                        <i class="fa-solid fa-building"></i> {{ $job->company_name }}
                                    </p>

                                    <!-- Quick highlights -->
                                    <div class="job-card-meta">
                                        <span><i class="fa-solid fa-location-dot"></i> {{ $job->location }}</span>
                                        <span style="color: {{ $job->isExpired() ? '#b91c1c' : 'inherit' }}">
                                            <i class="fa-solid fa-calendar-days"></i> 
                                            Last Date: <strong>{{ $job->last_date->format('M d, Y') }}</strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="job-card-actions">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="job-card-btn">
                                        Details & Apply <i class="fa-solid fa-arrow-right" style="margin-left: 6px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    {{ $jobs->links('vendor.pagination.career-gyan') }}
                @endif
            </div>

        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
  // ── Mobile filter toggle ──
  function toggleMobileFilters() {
    const sidebar = document.getElementById('jobSidebar');
    const toggle = document.getElementById('mobileFilterToggle');
    sidebar.classList.toggle('mobile-open');
    toggle.classList.toggle('open');
  }

  // ── Search Suggestions ──
  document.addEventListener('DOMContentLoaded', () => {
    const jobSearchInput = document.getElementById('jobSearchInput');
    const jobSearchSuggestions = document.getElementById('jobSearchSuggestions');
    const filterForm = document.getElementById('filterForm');
    let selectedIndex = -1;

    if (!jobSearchInput || !jobSearchSuggestions) return;

    function debounce(func, timeout = 250) {
      let timer;
      return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
      };
    }

    const performJobSearch = debounce(() => {
      const query = jobSearchInput.value.trim();
      selectedIndex = -1;

      if (query.length < 2) {
        jobSearchSuggestions.style.display = 'none';
        jobSearchSuggestions.innerHTML = '';
        return;
      }

      fetch(`/global-search?q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
          const jobs = data.jobs || [];
          if (jobs.length === 0) {
            jobSearchSuggestions.innerHTML = `<div style="padding: 14px; color: var(--text-3); text-align: center; font-size: 13px;">No recruitment notices found matching "<b>${query}</b>"</div>`;
            jobSearchSuggestions.style.display = 'block';
            return;
          }

          let html = '';
          jobs.forEach(j => {
            html += `
              <a href="${j.url}" class="job-suggestion-item">
                <div style="width: 32px; height: 32px; border-radius: 6px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
                <div style="flex: 1; overflow: hidden;">
                  <div style="font-weight: 700; font-size: 13.5px; color: var(--text-1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${j.title}</div>
                  <div style="font-size: 11.5px; color: var(--text-3); display: flex; align-items: center; gap: 6px;">
                    <span style="color: #10b981; font-weight: 600;">${j.company}</span> • <span>${j.location || 'India'}</span>
                  </div>
                </div>
              </a>
            `;
          });

          jobSearchSuggestions.innerHTML = html;
          jobSearchSuggestions.style.display = 'block';
        })
        .catch(err => {
          console.error(err);
          jobSearchSuggestions.style.display = 'none';
        });
    }, 250);

    jobSearchInput.addEventListener('input', performJobSearch);

    jobSearchInput.addEventListener('focus', () => {
      if (jobSearchInput.value.trim().length >= 2 && jobSearchSuggestions.innerHTML !== '') {
        jobSearchSuggestions.style.display = 'block';
      }
    });

    jobSearchInput.addEventListener('keydown', (e) => {
      const items = jobSearchSuggestions.querySelectorAll('.job-suggestion-item');

      if (e.key === 'ArrowDown' && items.length > 0) {
        e.preventDefault();
        selectedIndex = (selectedIndex + 1) % items.length;
        updateSelection(items);
      } else if (e.key === 'ArrowUp' && items.length > 0) {
        e.preventDefault();
        selectedIndex = (selectedIndex - 1 + items.length) % items.length;
        updateSelection(items);
      } else if (e.key === 'Enter') {
        if (selectedIndex >= 0 && items[selectedIndex]) {
          e.preventDefault();
          items[selectedIndex].click();
        } else {
          e.preventDefault();
          if (filterForm) filterForm.submit();
        }
      } else if (e.key === 'Escape') {
        jobSearchSuggestions.style.display = 'none';
      }
    });

    function updateSelection(items) {
      items.forEach((item, index) => {
        if (index === selectedIndex) {
          item.classList.add('selected');
          item.scrollIntoView({ block: 'nearest' });
        } else {
          item.classList.remove('selected');
        }
      });
    }

    document.addEventListener('click', (e) => {
      const wrap = document.getElementById('jobSearchWrap');
      if (wrap && !wrap.contains(e.target)) {
        jobSearchSuggestions.style.display = 'none';
      }
    });
  });
</script>
@endsection

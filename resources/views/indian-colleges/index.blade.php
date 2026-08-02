@extends('layouts.app')

@section('title', 'Find & Explore Indian Colleges | CareerGyan')

@section('styles')
<style>
    .colleges-hero {
        padding: 60px 0 50px;
        background: linear-gradient(135deg, rgba(26, 86, 219, 0.95), rgba(79, 70, 229, 0.95)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .colleges-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 80% 20%, rgba(249, 115, 22, 0.15), transparent 50%);
        pointer-events: none;
    }
    .colleges-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: clamp(28px, 4.5vw, 42px);
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .colleges-hero p {
        font-size: clamp(15px, 1.8vw, 17px);
        max-width: 680px;
        margin: 0 auto 24px;
        opacity: 0.92;
    }
    
    .stats-bar {
        display: inline-flex;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: 8px 24px;
        border-radius: 50px;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .stat-item {
        font-size: 13.5px;
        font-weight: 500;
    }
    .stat-item span {
        font-weight: 800;
        color: #fb923c;
    }

    /* Popular Acronyms Pill Strip */
    .acronym-chips-strip {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    .acronym-label {
        font-size: 13px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.85);
        margin-right: 4px;
    }
    .acronym-chip {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .acronym-chip:hover {
        background: white;
        color: var(--brand);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .acronym-chip.active {
        background: #fb923c;
        border-color: #f97316;
        color: white;
    }

    /* Layout structure */
    .colleges-layout {
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 28px;
        margin-top: 36px;
        margin-bottom: 80px;
    }

    /* Filters Card */
    .filters-sidebar {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        height: fit-content;
        position: sticky;
        top: 100px;
        box-shadow: var(--shadow-sm);
    }
    .filters-title {
        font-family: 'Sora', sans-serif;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text-1);
    }
    .filters-title a {
        font-size: 12px;
        color: var(--brand);
        font-weight: 600;
        text-decoration: none;
    }
    .filters-title a:hover {
        text-decoration: underline;
    }
    .filter-group {
        margin-bottom: 16px;
    }
    .filter-group label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--text-2);
        margin-bottom: 6px;
    }
    .filter-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: 13.5px;
        background-color: var(--bg);
        color: var(--text-1);
        outline: none;
        transition: var(--transition);
    }
    .filter-control:focus {
        border-color: var(--brand);
        background-color: white;
    }

    /* Cutoff Tool promo widget in sidebar */
    .cutoff-sidebar-widget {
        background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
        border: 1px solid #a7f3d0;
        border-radius: var(--radius-md);
        padding: 16px;
        margin-top: 20px;
        text-align: center;
    }
    .cutoff-sidebar-widget h4 {
        font-size: 14px;
        font-weight: 700;
        color: #065f46;
        margin-bottom: 6px;
    }
    .cutoff-sidebar-widget p {
        font-size: 12px;
        color: #047857;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .btn-widget-cutoff {
        display: inline-block;
        background: #059669;
        color: white;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.2s ease;
    }
    .btn-widget-cutoff:hover {
        background: #047857;
        color: white;
    }

    /* Main content area */
    .colleges-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Search and Result Info */
    .search-result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }
    .result-info {
        font-size: 14.5px;
        color: var(--text-2);
    }
    .result-info strong {
        color: var(--text-1);
    }

    /* College Card Grid */
    .colleges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
        gap: 20px;
    }
    
    .college-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }
    .college-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(26, 86, 219, 0.3);
    }
    
    /* State Ribbon or Accent */
    .college-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, var(--brand), #6366f1);
    }

    .college-card-header {
        margin-bottom: 14px;
    }
    .college-card-title {
        font-family: 'Sora', sans-serif;
        font-size: 15.5px;
        font-weight: 700;
        line-height: 1.4;
        color: var(--text-1);
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 42px;
    }
    .college-card-subtitle {
        font-size: 12px;
        color: var(--text-3);
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .college-card-subtitle i {
        color: var(--brand);
    }

    .college-card-body {
        margin-bottom: 18px;
        font-size: 13px;
        color: var(--text-2);
        display: flex;
        flex-direction: column;
        gap: 7px;
    }
    .college-info-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .college-info-row i {
        width: 15px;
        color: var(--text-3);
    }

    /* Cutoff highlight pill inside card */
    .cutoff-card-pill {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .college-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 4px;
        margin-right: 6px;
    }

    .college-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }
    .btn-college-detail {
        font-size: 13px;
        font-weight: 600;
        color: var(--brand);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
        transition: var(--transition);
    }
    .btn-college-detail:hover {
        color: var(--brand-dark);
        gap: 7px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
    }
    .empty-state i {
        font-size: 48px;
        color: var(--text-3);
        margin-bottom: 16px;
    }
    .empty-state h3 {
        font-family: 'Sora', sans-serif;
        font-size: 20px;
        margin-bottom: 8px;
        color: var(--text-1);
    }
    .empty-state p {
        color: var(--text-2);
        max-width: 400px;
        margin: 0 auto;
    }

    /* Custom pagination */
    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper .pagination {
        display: flex;
        gap: 6px;
        list-style: none;
    }
    .pagination-wrapper .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        background: white;
        color: var(--text-2);
        font-weight: 600;
        font-size: 13.5px;
        transition: var(--transition);
        text-decoration: none;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: var(--brand);
        color: white;
        border-color: var(--brand);
    }
    .pagination-wrapper .page-item .page-link:hover:not(.active) {
        background: var(--bg);
        border-color: var(--text-3);
    }
    .pagination-wrapper .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Did You Mean banner */
    .did-you-mean-banner {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 1px solid #fde68a;
        border-radius: var(--radius-md);
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        color: #92400e;
        animation: slideDown 0.3s ease;
    }
    .did-you-mean-banner i {
        color: #f59e0b;
        font-size: 16px;
    }
    .did-you-mean-banner a {
        color: var(--brand);
        font-weight: 700;
        font-style: italic;
        text-decoration: underline;
        text-underline-offset: 2px;
        transition: var(--transition);
    }
    .did-you-mean-banner a:hover {
        color: var(--brand-dark);
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 991px) {
        .colleges-layout {
            grid-template-columns: 1fr;
        }
        .filters-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 20px;
        }
    }
</style>
@endsection

@section('content')
<section class="colleges-hero">
    <div class="container">
        <h1>Explore Indian Colleges & Cutoffs</h1>
        <p>Search over 98,000+ colleges across India with combined MHT-CET Cutoffs, courses, affiliated universities, and management details.</p>
        
        <div class="stats-bar">
            <div class="stat-item">Database: <span>{{ number_format($totalColleges) }}+</span> Colleges</div>
            <div class="stat-item">Coverage: <span>{{ $totalStates }}</span> States & UTs</div>
            <div class="stat-item">Cutoffs: <span>Combined Live Data</span></div>
        </div>

        <!-- Popular Acronym Search Chips -->
        <div class="acronym-chips-strip">
            <span class="acronym-label"><i class="fa-solid fa-bolt text-amber-300"></i> Popular:</span>
            @foreach($popularAcronyms as $acronym => $full)
                <a href="{{ route('indian-colleges.index', ['q' => $acronym]) }}" 
                   class="acronym-chip {{ request('q') === $acronym ? 'active' : '' }}" 
                   title="{{ $full }}">
                    {{ $acronym }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<div class="container">
    <div class="colleges-layout">
        <!-- Sidebar filters -->
        <aside class="filters-sidebar">
            <div class="filters-title">
                <span><i class="fa-solid fa-sliders mr-2" style="color:var(--brand)"></i> Filters</span>
                <a href="{{ route('indian-colleges.index') }}">Clear All</a>
            </div>
            
            <form action="{{ route('indian-colleges.index') }}" method="GET" id="filterForm">
                <!-- Search term -->
                <div class="filter-group">
                    <label for="q">Keyword Search / Acronym</label>
                    <input type="text" name="q" id="q" value="{{ request('q') }}" class="filter-control" placeholder="COEP, VJTI, Pune, IIT...">
                </div>

                <!-- State -->
                <div class="filter-group">
                    <label for="stateSelect">State</label>
                    <select name="state" id="stateSelect" class="filter-control">
                        <option value="">All States</option>
                        @foreach($states as $s)
                            <option value="{{ $s }}" {{ request('state') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- District -->
                <div class="filter-group">
                    <label for="districtSelect">District</label>
                    <select name="district" id="districtSelect" class="filter-control" {{ !request('state') ? 'disabled' : '' }}>
                        <option value="">All Districts</option>
                        <!-- Loaded via JS -->
                    </select>
                </div>

                <!-- Management -->
                <div class="filter-group">
                    <label for="managementSelect">Management Type</label>
                    <select name="management" id="managementSelect" class="filter-control">
                        <option value="">All Managements</option>
                        @foreach($managementTypes as $m)
                            <option value="{{ $m }}" {{ request('management') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- College Type -->
                <div class="filter-group">
                    <label for="typeSelect">College Type</label>
                    <select name="college_type" id="typeSelect" class="filter-control">
                        <option value="">All Types</option>
                        @foreach($collegeTypes as $t)
                            <option value="{{ $t }}" {{ request('college_type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Course Category -->
                @if($courseCategories->count() > 0)
                    <div class="filter-group">
                        <label for="categorySelect">Course Category</label>
                        <select name="course_category" id="categorySelect" class="filter-control">
                            <option value="">All Categories</option>
                            @foreach($courseCategories as $c)
                                <option value="{{ $c }}" {{ request('course_category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Course Type (Level) -->
                @if(isset($courseTypes) && $courseTypes->count() > 0)
                    <div class="filter-group">
                        <label for="courseTypeSelect">Course Level / Type</label>
                        <select name="course_type" id="courseTypeSelect" class="filter-control">
                            <option value="">All Levels</option>
                            @foreach($courseTypes as $ct)
                                <option value="{{ $ct }}" {{ request('course_type') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <button type="submit" class="btn-view" style="width:100%; margin-top:10px; background-color: var(--brand); color: white; border-radius: var(--radius-md); padding: 10px; font-weight: 600; border:none; cursor:pointer;">Apply Filters</button>
            </form>

            <!-- Cutoff Tool Promo -->
            <div class="cutoff-sidebar-widget">
                <h4><i class="fa-solid fa-chart-line"></i> MHT-CET Cutoffs</h4>
                <p>Compare branch cutoffs & percentile trends for Maharashtra engineering colleges.</p>
                <a href="{{ route('tools.mh-cutoff') }}" class="btn-widget-cutoff">
                    Open Cutoffs Tool &rarr;
                </a>
            </div>
        </aside>

        <!-- Colleges Content -->
        <main class="colleges-content">
            <!-- Search Results Summary -->
            <div class="search-result-header">
                <div class="result-info">
                    Showing <strong>{{ $colleges->firstItem() ?? 0 }} - {{ $colleges->lastItem() ?? 0 }}</strong> 
                    of <strong>{{ number_format($colleges->total()) }}</strong> Colleges
                    @if(request('q'))
                        for <span style="color: var(--brand); font-weight:700;">"{{ request('q') }}"</span>
                    @endif
                </div>
            </div>

            @if(isset($didYouMean) && $didYouMean)
                <div class="did-you-mean-banner">
                    <i class="fa-solid fa-lightbulb"></i>
                    <span>
                        @if(isset($fuzzyUsed) && $fuzzyUsed)
                            Showing results for: <a href="{{ route('indian-colleges.index', array_merge(request()->query(), ['q' => $didYouMean])) }}">{{ $didYouMean }}</a>
                        @else
                            Did you mean: <a href="{{ route('indian-colleges.index', array_merge(request()->query(), ['q' => $didYouMean])) }}">{{ $didYouMean }}</a>?
                        @endif
                    </span>
                </div>
            @endif

            @if($colleges->isEmpty())
                <div class="empty-state">
                    <i class="fa-solid fa-building-columns"></i>
                    <h3>No colleges found</h3>
                    <p>We couldn't find any colleges matching "{{ request('q') }}". Try searching for acronyms like <strong>COEP</strong>, <strong>VJTI</strong>, or <strong>PICT</strong>.</p>
                </div>
            @else
                <!-- College Cards Grid -->
                <div class="colleges-grid">
                    @foreach($colleges as $c)
                        <div class="college-card">
                            <div class="college-card-header">
                                <h3 class="college-card-title" title="{{ $c->college_name }}">{{ $c->college_name }}</h3>
                                <div class="college-card-subtitle" title="{{ $c->university_name }}">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span>{{ $c->university_name ?: 'Affiliation Info N/A' }}</span>
                                </div>
                            </div>

                            <div class="college-card-body">
                                <div class="college-info-row">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>{{ $c->location_string }}</span>
                                </div>

                                <!-- Cutoff Indicator if available -->
                                @if(isset($c->cutoff_stats) && $c->cutoff_stats['has_cutoffs'])
                                    <div class="college-info-row">
                                        <i class="fa-solid fa-chart-simple text-emerald-600"></i>
                                        <span class="cutoff-card-pill">
                                            MHT-CET Cutoff: <strong>{{ $c->cutoff_stats['highest_percentile'] }}</strong>
                                        </span>
                                    </div>
                                @endif

                                @if($c->management)
                                    <div class="college-info-row">
                                        <i class="fa-solid fa-shield-halved"></i>
                                        <span class="college-badge" style="background: {{ $c->management_badge_color }}20; color: {{ $c->management_badge_color }};">
                                            {{ $c->management }}
                                        </span>
                                    </div>
                                @endif

                                @if($c->course_count > 0)
                                    <div class="college-info-row">
                                        <i class="fa-solid fa-book-open"></i>
                                        <span>
                                            <strong>{{ $c->course_count }}</strong> {{ $c->course_count == 1 ? 'Course' : 'Courses' }} Offered
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="college-card-footer">
                                <span style="font-size: 12px; color: var(--text-3);">Est. {{ $c->year_of_establishment ?: 'N/A' }}</span>
                                <a href="{{ route('indian-colleges.show', $c->id) }}" class="btn-college-detail">
                                    Profile & Cutoffs <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($colleges->hasPages())
                    <div class="pagination-wrapper">
                        {{ $colleges->links('vendor.pagination.career-gyan') }}
                    </div>
                @endif
            @endif
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stateSelect = document.getElementById('stateSelect');
        const districtSelect = document.getElementById('districtSelect');
        const currentDistrict = "{{ request('district') }}";

        function loadDistricts(state, selected = '') {
            if (!state) {
                districtSelect.innerHTML = '<option value="">All Districts</option>';
                districtSelect.disabled = true;
                return;
            }

            districtSelect.disabled = true;
            fetch(`{{ route('indian-colleges.districts') }}?state=${encodeURIComponent(state)}`)
                .then(res => res.json())
                .then(districts => {
                    let html = '<option value="">All Districts</option>';
                    districts.forEach(d => {
                        html += `<option value="${d}" ${d === selected ? 'selected' : ''}>${d}</option>`;
                    });
                    districtSelect.innerHTML = html;
                    districtSelect.disabled = false;
                })
                .catch(err => {
                    console.error('Failed to load districts:', err);
                    districtSelect.disabled = false;
                });
        }

        // Initialize district list if state is pre-selected
        if (stateSelect && stateSelect.value) {
            loadDistricts(stateSelect.value, currentDistrict);
        }

        // Handle state changes
        if (stateSelect) {
            stateSelect.addEventListener('change', function() {
                loadDistricts(this.value);
            });
        }
    });
</script>
@endsection

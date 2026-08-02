@extends('layouts.app')

@section('title', $college->college_name . ' - Courses, Cutoffs & Institutional Profile | CareerGyan')

@section('meta')
    <meta name="description" content="View admission cutoffs, courses, affiliated university, management type, and complete institutional details for {{ $college->college_name }}.">
@endsection

@section('styles')
<style>
    .college-detail-container {
        padding: 40px 0 80px;
    }
    
    /* Breadcrumbs */
    .breadcrumb-nav {
        margin-bottom: 24px;
        font-size: 14px;
        color: var(--text-2);
    }
    .breadcrumb-nav a {
        color: var(--brand);
        font-weight: 500;
        transition: var(--transition);
    }
    .breadcrumb-nav a:hover {
        color: var(--brand-dark);
        text-decoration: underline;
    }
    .breadcrumb-nav span {
        margin: 0 8px;
        color: var(--text-3);
    }

    /* College Header Profile Card */
    .college-profile-header {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 36px 40px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .college-profile-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; bottom: 0; width: 6px;
        background: linear-gradient(180deg, var(--brand), #6366f1);
    }
    
    .college-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        flex-wrap: wrap;
    }
    .college-title-area {
        flex: 1;
        min-width: 280px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .college-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(22px, 3.5vw, 30px);
        font-weight: 800;
        line-height: 1.3;
        color: var(--text-1);
        margin: 0;
    }
    .college-meta-details {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 20px;
        font-size: 14px;
        color: var(--text-2);
        margin-top: 4px;
    }
    .college-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .college-meta-item i {
        color: var(--brand);
    }
    
    /* Header Quick Badges */
    .header-quick-badges {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }
    .cutoff-badge-pill {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        border: 1px solid #c7d2fe;
        color: #4338ca;
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 13.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .dte-code-pill {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #475569;
        padding: 8px 14px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Main Details Grid */
    .detail-grid {
        display: grid;
        grid-template-columns: 2.2fr 1fr;
        gap: 28px;
    }

    /* Card Box base */
    .info-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 28px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 28px;
    }
    .info-box-title {
        font-family: 'Sora', sans-serif;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
        color: var(--text-1);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .info-box-title-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-box-title i {
        color: var(--brand);
    }

    /* Cutoff Summary Metrics Bar */
    .cutoff-metric-banner {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-md);
        padding: 16px;
    }
    .metric-card {
        text-align: center;
        padding: 8px 12px;
    }
    .metric-val {
        font-size: 22px;
        font-weight: 800;
        color: #1e3a8a;
        line-height: 1.2;
    }
    .metric-val.high {
        color: #15803d;
    }
    .metric-lbl {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        margin-top: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Cutoff Table Filter Bar */
    .cutoff-table-filter {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .cutoff-search-input {
        flex: 1;
        min-width: 200px;
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: 14px;
    }
    .cutoff-select-filter {
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: 14px;
        background: white;
    }

    /* Cutoff Table Styles */
    .cutoff-table-wrapper {
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-md);
        max-height: 480px;
        overflow-y: auto;
    }
    .cutoff-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13.5px;
    }
    .cutoff-table th {
        background-color: #f1f5f9;
        padding: 12px 14px;
        font-weight: 700;
        color: #1e293b;
        border-bottom: 2px solid #cbd5e1;
        position: sticky;
        top: 0;
        z-index: 2;
    }
    .cutoff-table td {
        padding: 12px 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
    }
    .cutoff-table tr:hover {
        background-color: #f8fafc;
    }
    .percentile-chip {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 13px;
    }
    .percentile-high {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .percentile-mid {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .percentile-low {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    /* Attributes Grid */
    .attributes-table {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 14px 0;
        font-size: 14.5px;
    }
    .attr-label {
        font-weight: 600;
        color: var(--text-2);
    }
    .attr-value {
        color: var(--text-1);
    }

    /* Stats Grid */
    .stats-card-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .stat-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 18px;
        text-align: center;
    }
    .stat-card-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--brand);
        margin-bottom: 4px;
    }
    .stat-card-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-2);
    }

    /* Courses Table (Maharashtra) */
    .courses-table-wrapper {
        overflow-x: auto;
        margin-top: 10px;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
    }
    .courses-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13.5px;
    }
    .courses-table th {
        background-color: var(--bg);
        padding: 12px 14px;
        font-weight: 700;
        color: var(--text-1);
        border-bottom: 2px solid var(--border);
    }
    .courses-table td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--border);
        color: var(--text-2);
    }
    .courses-table tr:hover {
        background-color: rgba(26, 86, 219, 0.02);
    }

    /* Related Colleges Lists */
    .related-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .related-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
    }
    .related-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .related-item-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-1);
        line-height: 1.3;
        transition: var(--transition);
        text-decoration: none;
    }
    .related-item-title:hover {
        color: var(--brand);
    }
    .related-item-meta {
        font-size: 12px;
        color: var(--text-3);
    }

    /* Action Buttons */
    .btn-website {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--brand);
        color: white;
        padding: 10px 18px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 13.5px;
        transition: var(--transition);
        text-decoration: none;
    }
    .btn-website:hover {
        background: var(--brand-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);
    }
    .btn-cutoff-tool {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #4338ca;
        color: white;
        padding: 10px 18px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 13.5px;
        transition: var(--transition);
        text-decoration: none;
    }
    .btn-cutoff-tool:hover {
        background: #3730a3;
        color: white;
        transform: translateY(-2px);
    }

    /* Badges */
    .college-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
        .college-profile-header {
            padding: 24px;
        }
    }
    @media (max-width: 575px) {
        .attributes-table {
            grid-template-columns: 1fr;
            gap: 6px 0;
        }
        .stats-card-grid {
            grid-template-columns: 1fr;
        }
        .cutoff-metric-banner {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container college-detail-container">
    <!-- Breadcrumbs -->
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span>/</span>
        <a href="{{ route('indian-colleges.index') }}">Colleges</a>
        <span>/</span>
        <span style="color: var(--text-1)">{{ $college->college_name }}</span>
    </nav>

    <!-- Profile Header Card -->
    <header class="college-profile-header">
        <div class="college-header-top">
            <div class="college-title-area">
                <h1 class="college-title">{{ $college->college_name }}</h1>
                
                <div class="college-meta-details">
                    @if($college->university_name)
                        <div class="college-meta-item">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span>Affiliated to <strong>{{ $college->university_name }}</strong></span>
                        </div>
                    @endif
                    <div class="college-meta-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ $college->location_string }}</span>
                    </div>
                    @if($college->year_of_establishment)
                        <div class="college-meta-item">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Established: <strong>{{ $college->year_of_establishment }}</strong></span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Badges & Direct Cutoff Tool Link -->
            <div class="header-quick-badges">
                @if($cutoffStats['has_cutoffs'])
                    <div class="cutoff-badge-pill">
                        <i class="fa-solid fa-fire text-amber-500"></i> Top Cutoff: {{ $cutoffStats['highest_percentile'] }}
                    </div>
                    @if($cutoffStats['college_code'])
                        <div class="dte-code-pill">
                            <i class="fa-solid fa-id-badge"></i> DTE Code: {{ $cutoffStats['college_code'] }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </header>

    <!-- Details Grid -->
    <div class="detail-grid">
        <!-- Left Column: Cutoffs, Overview, Stats, Courses -->
        <div class="detail-main">

            <!-- COMBINED DATA: MHT-CET Cutoffs Section -->
            @if($cutoffStats['has_cutoffs'] && $cutoffs->count() > 0)
                <section class="info-box" id="cutoffs-section">
                    <div class="info-box-title">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-chart-line" style="color: #4338ca;"></i>
                            <span>MHT-CET Engineering Cutoff & Admission Trends</span>
                        </div>
                        <a href="{{ $cutoffStats['cutoffs_url'] }}" class="btn-cutoff-tool" target="_blank">
                            Explore in Cutoff Tool <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- Cutoff Metric Overview Banner -->
                    <div class="cutoff-metric-banner">
                        <div class="metric-card">
                            <div class="metric-val high">{{ $cutoffStats['highest_percentile'] }}</div>
                            <div class="metric-lbl">Highest Cutoff</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-val">{{ $cutoffStats['lowest_percentile'] }}</div>
                            <div class="metric-lbl">Lowest Cutoff</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-val">{{ $cutoffStats['total_branches'] }}</div>
                            <div class="metric-lbl">Engineering Branches</div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-val" style="font-size: 15px; font-weight:700; color: #4338ca;">{{ $cutoffStats['top_branch'] }}</div>
                            <div class="metric-lbl">Top Demanded Branch</div>
                        </div>
                    </div>

                    <!-- Instant Interactive Filter for Cutoffs Table -->
                    <div class="cutoff-table-filter">
                        <input type="text" id="cutoffBranchSearch" class="cutoff-search-input" placeholder="Filter by branch (e.g. Computer, Mechanical, AI)...">
                        <select id="cutoffCategorySelect" class="cutoff-select-filter">
                            <option value="">All Categories</option>
                            @php
                                $uniqueCategories = $cutoffs->pluck('category')->unique()->sort();
                            @endphp
                            @foreach($uniqueCategories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cutoff Records Table -->
                    <div class="cutoff-table-wrapper">
                        <table class="cutoff-table" id="collegeCutoffsTable">
                            <thead>
                                <tr>
                                    <th>Branch / Specialization</th>
                                    <th>Category</th>
                                    <th>Percentile Cutoff</th>
                                    <th>Merit Rank</th>
                                    <th>CAP Round</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cutoffs as $cutoff)
                                    @php
                                        $pct = (float)$cutoff->percentile;
                                        $chipClass = $pct >= 95 ? 'percentile-high' : ($pct >= 80 ? 'percentile-mid' : 'percentile-low');
                                    @endphp
                                    <tr data-branch="{{ strtolower($cutoff->branch_name) }}" data-category="{{ $cutoff->category }}">
                                        <td>
                                            <strong>{{ $cutoff->branch_name }}</strong>
                                        </td>
                                        <td>
                                            <span class="college-badge" style="background:#f1f5f9; color:#334155;">
                                                {{ $cutoff->category }}
                                            </span>
                                            @if($cutoff->category_full && $cutoff->category_full !== $cutoff->category)
                                                <div style="font-size: 11px; color: #64748b; margin-top:2px;">{{ $cutoff->category_full }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="percentile-chip {{ $chipClass }}">
                                                {{ number_format($pct, 2) }}%
                                            </span>
                                        </td>
                                        <td>
                                            <strong>#{{ number_format($cutoff->merit_no) }}</strong>
                                        </td>
                                        <td>
                                            <span style="font-size: 12px; color: #64748b;">Round {{ $cutoff->round }} ({{ $cutoff->year }})</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 12px; font-size: 12px; color: #64748b; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                        <span>* Cutoff data based on Maharashtra State CET Cell CAP Round allotments.</span>
                        <a href="{{ route('tools.college-predictor') }}" style="color: var(--brand); font-weight:600; text-decoration:none;">
                            Use College Predictor &rarr;
                        </a>
                    </div>
                </section>
            @endif

            <!-- Basic Overview -->
            <section class="info-box">
                <h2 class="info-box-title">
                    <div class="info-box-title-left">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Institution Overview</span>
                    </div>
                </h2>
                <div class="attributes-table">
                    <div class="attr-label">Management Type</div>
                    <div class="attr-value">
                        @if($college->management)
                            <span class="college-badge" style="background: {{ $college->management_badge_color }}20; color: {{ $college->management_badge_color }};">
                                {{ $college->management }}
                            </span>
                        @else
                            Government / Autonomous / Private
                        @endif
                    </div>

                    <div class="attr-label">College Category</div>
                    <div class="attr-value">{{ $college->college_type ?: 'Engineering & Technology' }}</div>

                    @if($college->university_type)
                        <div class="attr-label">University Type</div>
                        <div class="attr-value">{{ $college->university_type }}</div>
                    @endif

                    @if($college->affiliation)
                        <div class="attr-label">Affiliation Status</div>
                        <div class="attr-value">{{ $college->affiliation }}</div>
                    @endif

                    @if($college->taluka)
                        <div class="attr-label">Taluka</div>
                        <div class="attr-value">{{ $college->taluka }}</div>
                    @endif

                    <div class="attr-label">City / Town</div>
                    <div class="attr-value">{{ $college->city ?: ($college->district ?: 'N/A') }}</div>

                    <div class="attr-label">District</div>
                    <div class="attr-value">{{ $college->district ?: 'N/A' }}</div>

                    <div class="attr-label">State</div>
                    <div class="attr-value">{{ $college->state ?: 'Maharashtra' }}</div>

                    @if($college->pin_code)
                        <div class="attr-label">Pin Code</div>
                        <div class="attr-value">{{ $college->pin_code }}</div>
                    @endif

                    @if($college->address)
                        <div class="attr-label">Full Address</div>
                        <div class="attr-value">{{ $college->address }}</div>
                    @endif
                </div>

                @if($college->website)
                    <div style="margin-top: 24px; display:flex; gap:12px; flex-wrap:wrap;">
                        <a href="{{ $college->website }}" target="_blank" rel="noopener noreferrer" class="btn-website">
                            Visit Official Website <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        @if($cutoffStats['has_cutoffs'])
                            <a href="{{ $cutoffStats['cutoffs_url'] }}" class="btn-cutoff-tool" target="_blank">
                                <i class="fa-solid fa-chart-simple"></i> View All MHT-CET Cutoffs
                            </a>
                        @endif
                    </div>
                @endif
            </section>

            <!-- Campus Location & Interactive Map -->
            <section class="info-box">
                <h2 class="info-box-title">
                    <div class="info-box-title-left">
                        <i class="fa-solid fa-map-location-dot" style="color: #ea580c;"></i>
                        <span>Campus Location & Interactive Map</span>
                    </div>
                    <a href="{{ $college->google_map_directions_url }}" target="_blank" rel="noopener noreferrer" style="font-size:13px; font-weight:600; color:var(--brand); text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fa-solid fa-diamond-turn-right"></i> Get Directions <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:11px;"></i>
                    </a>
                </h2>

                <div class="college-map-card">
                    <div class="college-address-box" style="background:#f8fafc; border:1px solid var(--border); border-radius:var(--radius-md); padding:14px 18px; margin-bottom:16px;">
                        <div style="display:flex; align-items:flex-start; gap:12px;">
                            <div style="width:36px; height:36px; border-radius:10px; background:#fee2e2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0;">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <div style="font-weight:700; color:var(--text-1); font-size:15px; margin-bottom:3px;">
                                    {{ $college->college_name }}
                                </div>
                                <div style="color:var(--text-2); font-size:13.5px; line-height:1.6;">
                                    @if($college->address)
                                        {{ $college->address }}<br>
                                    @endif
                                    {{ $college->city ?: ($college->district ?: '') }}{{ $college->taluka && $college->taluka !== $college->city ? ', Tal. ' . $college->taluka : '' }}{{ $college->district ? ', Dist. ' . $college->district : '' }}, {{ $college->state ?: 'Maharashtra' }} {{ $college->pin_code ? '- ' . $college->pin_code : '' }}, India
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Map Embed -->
                    <div class="map-frame-wrapper" style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); box-shadow: 0 6px 24px rgba(0,0,0,.05); background: var(--surface);">
                        <iframe 
                            src="{{ $college->google_map_embed_url }}" 
                            width="100%" 
                            height="380" 
                            style="border:0; display: block;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div style="margin-top: 14px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                        <span style="font-size:12.5px; color:var(--text-3);">
                            <i class="fa-solid fa-satellite"></i> Accurate campus geocoding & live location powered by Google Maps
                        </span>
                        <a href="{{ $college->google_map_directions_url }}" target="_blank" rel="noopener noreferrer" class="btn-website" style="padding: 8px 16px; font-size: 13px;">
                            <i class="fa-solid fa-diamond-turn-right"></i> Open in Google Maps
                        </a>
                    </div>
                </div>
            </section>

            <!-- Enrollment & Faculty Stats -->
            @if($college->total_enrollment || $college->faculty_count)
                <section class="info-box">
                    <h2 class="info-box-title">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span>Key Campus Statistics</span>
                        </div>
                    </h2>
                    <div class="stats-card-grid">
                        @if($college->total_enrollment)
                            <div class="stat-card">
                                <div class="stat-card-value">{{ number_format($college->total_enrollment) }}</div>
                                <div class="stat-card-label">Total Student Enrollment</div>
                            </div>
                        @endif
                        @if($college->faculty_count)
                            <div class="stat-card">
                                <div class="stat-card-value">{{ number_format($college->faculty_count) }}</div>
                                <div class="stat-card-label">Total Faculty Strength</div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif

            <!-- Courses Offered (Maharashtra Dataset) -->
            @if($courses->count() > 0)
                <section class="info-box">
                    <h2 class="info-box-title">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span>Courses & Degree Programs</span>
                        </div>
                    </h2>
                    <div class="courses-table-wrapper">
                        <table class="courses-table">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td><strong>{{ $course->course_name }}</strong></td>
                                        <td>{{ $course->course_type ?: 'N/A' }}</td>
                                        <td>{{ $course->course_category ?: 'Engineering' }}</td>
                                        <td>{{ $course->course_duration_months ? $course->course_duration_months . ' months' : '48 months' }}</td>
                                        <td>
                                            @if($course->course_aided_unaided)
                                                <span class="college-badge" style="background:{{ strtolower($course->course_aided_unaided) == 'aided' ? '#ecfdf5; color:#059669;' : '#fef2f2; color:#dc2626;' }}">
                                                    {{ $course->course_aided_unaided }}
                                                </span>
                                            @else
                                                <span class="college-badge" style="background:#f1f5f9; color:#475569;">Standard</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @endif
        </div>

        <!-- Right Column: Sidebar / Affiliated & Nearby Colleges -->
        <div class="detail-sidebar">
            <!-- Cutoff Quick Actions Card -->
            @if($cutoffStats['has_cutoffs'])
                <div class="info-box" style="background: linear-gradient(180deg, #faf5ff, #ffffff); border-color: #e9d5ff;">
                    <h3 class="info-box-title" style="border-bottom-color: #f3e8ff;">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-bolt" style="color: #7c3aed;"></i>
                            <span>Cutoff Tools</span>
                        </div>
                    </h3>
                    <p style="font-size: 13.5px; color: #475569; margin-bottom: 16px; line-height: 1.5;">
                        Check where you stand! Compare your MHT-CET score with <strong>{{ $college->college_name }}</strong> cutoff percentiles across all categories.
                    </p>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <a href="{{ $cutoffStats['cutoffs_url'] }}" class="btn-cutoff-tool" style="justify-content:center; text-align:center;">
                            <i class="fa-solid fa-list-check"></i> Filter All Cutoffs
                        </a>
                        <a href="{{ route('tools.college-predictor') }}" class="btn-website" style="justify-content:center; text-align:center; background:#059669;">
                            <i class="fa-solid fa-calculator"></i> Predict Your College
                        </a>
                    </div>
                </div>
            @endif

            <!-- Related by University -->
            @if($relatedByUniversity->count() > 0)
                <div class="info-box">
                    <h3 class="info-box-title">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-school"></i>
                            <span>Same University</span>
                        </div>
                    </h3>
                    <div class="related-list">
                        @foreach($relatedByUniversity as $rc)
                            <div class="related-item">
                                <a href="{{ route('indian-colleges.show', $rc->id) }}" class="related-item-title">
                                    {{ $rc->college_name }}
                                </a>
                                <div class="related-item-meta">
                                    {{ $rc->district }}, {{ $rc->state }} | {{ $rc->college_type ?: 'General' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Related by District -->
            @if($relatedByDistrict->count() > 0)
                <div class="info-box">
                    <h3 class="info-box-title">
                        <div class="info-box-title-left">
                            <i class="fa-solid fa-map"></i>
                            <span>Nearby in {{ $college->district ?: 'District' }}</span>
                        </div>
                    </h3>
                    <div class="related-list">
                        @foreach($relatedByDistrict as $rc)
                            <div class="related-item">
                                <a href="{{ route('indian-colleges.show', $rc->id) }}" class="related-item-title">
                                    {{ $rc->college_name }}
                                </a>
                                <div class="related-item-meta">
                                    {{ $rc->college_type ?: 'Engineering / Tech' }} | {{ $rc->management ?: 'Autonomous / Private' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const branchInput = document.getElementById('cutoffBranchSearch');
        const catSelect = document.getElementById('cutoffCategorySelect');
        const table = document.getElementById('collegeCutoffsTable');

        if (branchInput && catSelect && table) {
            function filterCutoffs() {
                const branchQuery = branchInput.value.toLowerCase().trim();
                const catQuery = catSelect.value.toUpperCase().trim();
                const rows = table.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const rowBranch = row.getAttribute('data-branch') || '';
                    const rowCat = (row.getAttribute('data-category') || '').toUpperCase();

                    const matchBranch = !branchQuery || rowBranch.includes(branchQuery);
                    const matchCat = !catQuery || rowCat === catQuery;

                    if (matchBranch && matchCat) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            branchInput.addEventListener('input', filterCutoffs);
            catSelect.addEventListener('change', filterCutoffs);
        }
    });
</script>
@endpush
@endsection

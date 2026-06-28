@extends('layouts.app')

@section('title', 'Job Corner - CareerGyan')

@section('content')
<div class="section" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); padding-top: 48px; min-height: calc(100vh - 200px);">
    <div class="container">
        
        <!-- HEADER SECTION -->
        <div class="fade-up fade-up-1" style="text-align: center; margin-bottom: 40px;">
            <span class="section-label">
                <i class="fa-solid fa-briefcase"></i> Recruitment Hub
            </span>
            <h1 class="section-title">Job Corner</h1>
            <p class="section-sub" style="margin: 10px auto 0;">Explore the latest recruitment notices, official notifications, and direct application links for Government & Private jobs.</p>
        </div>

        <!-- SEARCH AND FILTER CONTAINER -->
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 32px; align-items: start;" class="reveal visible">
            
            <!-- SIDEBAR FILTERS -->
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow-sm); position: sticky; top: 100px;">
                <form action="{{ route('jobs.index') }}" method="GET" id="filterForm">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="sector" value="{{ $sector }}">

                    <!-- Sector Filter -->
                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-2); display: block; margin-bottom: 8px;">Job Sector</label>
                        <div style="display: flex; gap: 4px; background: #f1f5f9; border-radius: var(--radius-md); padding: 4px;">
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
                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-2); display: block; margin-bottom: 8px;">Keyword Search</label>
                        <div style="position: relative;">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search company, title..." 
                                class="filter-input"
                                onchange="this.form.submit()">
                            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 13px; color: var(--text-3); font-size: 13px;"></i>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-2); display: block; margin-bottom: 8px;">Job Category</label>
                        <select name="category" onchange="this.form.submit()" class="filter-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Qualification Filter -->
                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-2); display: block; margin-bottom: 8px;">Qualification</label>
                        <select name="qualification" onchange="this.form.submit()" class="filter-select">
                            <option value="">All Qualifications</option>
                            @foreach($qualifications as $qual)
                                <option value="{{ $qual }}" {{ request('qualification') == $qual ? 'selected' : '' }}>{{ $qual }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location Filter -->
                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--text-2); display: block; margin-bottom: 8px;">Location</label>
                        <div style="position: relative;">
                            <input type="text" name="location" value="{{ request('location') }}" placeholder="e.g., Maharashtra, Delhi" 
                                class="filter-input"
                                onchange="this.form.submit()">
                            <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 13px; color: var(--text-3); font-size: 13px;"></i>
                        </div>
                    </div>

                    <!-- Clear Button -->
                    @if(request()->anyFilled(['search', 'category', 'qualification', 'location']) || $sector !== 'all')
                        <a href="{{ route('jobs.index', ['type' => $type]) }}" 
                            style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 10px; background: #f1f5f9; color: var(--text-2); font-weight: 600; font-size: 13px; border-radius: var(--radius-md); transition: var(--transition); text-decoration: none;">
                            <i class="fa-solid fa-xmark"></i> Clear All Filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- JOB LISTINGS -->
            <div>
                <!-- Type Selector Tabs -->
                <div style="display: flex; gap: 12px; margin-bottom: 24px; border-bottom: 2px solid var(--border); padding-bottom: 12px;">
                    <a href="{{ route('jobs.index', array_merge(request()->except('page'), ['type' => 'active'])) }}" 
                        style="font-size: 15px; font-weight: 700; padding: 6px 16px; border-radius: var(--radius-md); text-decoration: none; color: {{ $type === 'active' ? 'var(--brand)' : 'var(--text-2)' }}; background: {{ $type === 'active' ? 'var(--brand-light)' : 'transparent' }}; transition: var(--transition);">
                        <i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i> Active Jobs
                    </a>
                    <a href="{{ route('jobs.index', array_merge(request()->except('page'), ['type' => 'archived'])) }}" 
                        style="font-size: 15px; font-weight: 700; padding: 6px 16px; border-radius: var(--radius-md); text-decoration: none; color: {{ $type === 'archived' ? 'var(--brand)' : 'var(--text-2)' }}; background: {{ $type === 'archived' ? 'var(--brand-light)' : 'transparent' }}; transition: var(--transition);">
                        <i class="fa-solid fa-archive" style="margin-right: 6px;"></i> Archived / Expired
                    </a>
                </div>

                <!-- LISTING GRID -->
                @if($jobs->isEmpty())
                    <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 56px 24px; text-align: center; box-shadow: var(--shadow-sm);">
                        <i class="fa-solid fa-briefcase" style="font-size: 48px; color: var(--text-3); margin-bottom: 16px;"></i>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; color: var(--text-1); margin-bottom: 8px;">No Job Openings Found</h3>
                        <p style="color: var(--text-2); max-width: 400px; margin: 0 auto;">We couldn't find any job openings matching your filters. Try modifying your search keywords or checking the archived tab.</p>
                    </div>
                @else
                    <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                        @foreach($jobs as $job)
                            <div class="job-card sector-{{ $job->job_type }}">
                                
                                <div>
                                    <!-- Badges -->
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; align-items: center;">
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
                                    <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-1); margin-bottom: 6px;">
                                        <a href="{{ route('jobs.show', $job->id) }}" style="color: inherit; transition: color var(--transition);" onmouseover="this.style.color='var(--brand)'" onmouseout="this.style.color='inherit'">
                                            {{ $job->job_title }}
                                        </a>
                                    </h3>
                                    <p style="font-size: 14px; font-weight: 600; color: var(--text-2); margin-bottom: 12px;">
                                        <i class="fa-solid fa-building" style="margin-right: 6px; color: var(--text-3);"></i> {{ $job->company_name }}
                                    </p>

                                    <!-- Quick highlights -->
                                    <div style="display: flex; gap: 24px; font-size: 13px; color: var(--text-2); flex-wrap: wrap;">
                                        <span><i class="fa-solid fa-location-dot" style="margin-right: 6px; color: var(--text-3);"></i> {{ $job->location }}</span>
                                        <span style="color: {{ $job->isExpired() ? '#b91c1c' : 'inherit' }}">
                                            <i class="fa-solid fa-calendar-days" style="margin-right: 6px; color: var(--text-3);"></i> 
                                            Last Date: <strong>{{ $job->last_date->format('M d, Y') }}</strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div style="display: flex; flex-direction: column; gap: 8px; justify-content: center; align-items: flex-end;">
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

<style>
    /* Premium styling overrides for Job Corner page */
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
    .job-card.sector-govt {
        border-left-color: #f59e0b;
    }
    .job-card.sector-pvt {
        border-left-color: #0d9488;
    }
    .job-card.sector-both {
        border-left-color: #8b5cf6;
    }
    .job-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(0, 0, 0, 0.08);
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
    }
    .job-card-btn:hover {
        background: var(--brand);
        color: #ffffff;
        transform: translateX(2px);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>
@endsection

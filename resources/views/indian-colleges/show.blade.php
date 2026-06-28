@extends('layouts.app')

@section('title', $college->college_name . ' | CareerGyan')

@section('styles')
<style>
    .college-detail-container {
        padding: 50px 0 80px;
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
        padding: 40px;
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
    
    .college-title-area {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .college-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(24px, 4vw, 32px);
        font-weight: 800;
        line-height: 1.3;
        color: var(--text-1);
    }
    .college-meta-details {
        display: flex;
        flex-wrap: wrap;
        gap: 16px 24px;
        font-size: 14.5px;
        color: var(--text-2);
        margin-top: 8px;
    }
    .college-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .college-meta-item i {
        color: var(--brand);
    }
    
    /* Main Details Grid */
    .detail-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    /* Card Box base */
    .info-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 30px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
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
        gap: 10px;
    }
    .info-box-title i {
        color: var(--brand);
    }

    /* Attributes Grid */
    .attributes-table {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 16px 0;
        font-size: 15px;
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
        gap: 20px;
    }
    .stat-card {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 20px;
        text-align: center;
    }
    .stat-card-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--brand);
        margin-bottom: 6px;
    }
    .stat-card-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-2);
    }

    /* Courses Table (Maharashtra) */
    .courses-table-wrapper {
        overflow-x: auto;
        margin-top: 15px;
    }
    .courses-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 14.5px;
    }
    .courses-table th {
        background-color: var(--bg);
        padding: 12px 16px;
        font-weight: 700;
        color: var(--text-1);
        border-bottom: 2px solid var(--border);
    }
    .courses-table td {
        padding: 14px 16px;
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
        gap: 14px;
    }
    .related-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }
    .related-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .related-item-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-1);
        line-height: 1.3;
        transition: var(--transition);
    }
    .related-item-title:hover {
        color: var(--brand);
    }
    .related-item-meta {
        font-size: 12px;
        color: var(--text-3);
    }

    /* External Links */
    .btn-website {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--brand);
        color: white;
        padding: 12px 20px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition);
        margin-top: 10px;
    }
    .btn-website:hover {
        background: var(--brand-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
        .college-profile-header {
            padding: 30px;
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
    </header>

    <!-- Details Grid -->
    <div class="detail-grid">
        <!-- Left Column: Details, Stats, Courses -->
        <div class="detail-main">
            <!-- Basic Details -->
            <section class="info-box">
                <h2 class="info-box-title">
                    <i class="fa-solid fa-circle-info"></i> Institution Overview
                </h2>
                <div class="attributes-table">
                    <div class="attr-label">Management Type</div>
                    <div class="attr-value">
                        @if($college->management)
                            <span class="college-badge" style="background: {{ $college->management_badge_color }}20; color: {{ $college->management_badge_color }};">
                                {{ $college->management }}
                            </span>
                        @else
                            N/A
                        @endif
                    </div>

                    <div class="attr-label">College Category</div>
                    <div class="attr-value">{{ $college->college_type ?: 'General College' }}</div>

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
                    <div class="attr-value">{{ $college->city ?: 'N/A' }}</div>

                    <div class="attr-label">District</div>
                    <div class="attr-value">{{ $college->district ?: 'N/A' }}</div>

                    <div class="attr-label">State</div>
                    <div class="attr-value">{{ $college->state ?: 'N/A' }}</div>

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
                    <div style="margin-top: 24px;">
                        <a href="{{ $college->website }}" target="_blank" rel="noopener noreferrer" class="btn-website">
                            Visit Website <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                @endif
            </section>

            <!-- Enrollment & Faculty Stats (Kaggle Dataset) -->
            @if($college->total_enrollment || $college->faculty_count)
                <section class="info-box">
                    <h2 class="info-box-title">
                        <i class="fa-solid fa-chart-simple"></i> Key Statistics
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
                        <i class="fa-solid fa-graduation-cap"></i> Courses & Curriculum
                    </h2>
                    <div class="courses-table-wrapper">
                        <table class="courses-table">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Professional</th>
                                    <th>Aided / Unaided</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td><strong>{{ $course->course_name }}</strong></td>
                                        <td>{{ $course->course_type ?: 'N/A' }}</td>
                                        <td>{{ $course->course_category ?: 'N/A' }}</td>
                                        <td>{{ $course->course_duration_months ? $course->course_duration_months . ' months' : 'N/A' }}</td>
                                        <td>
                                            @if($course->is_professional)
                                                <span class="college-badge" style="background:#fef3c7; color:#d97706;">
                                                    {{ $course->is_professional }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($course->course_aided_unaided)
                                                <span class="college-badge" style="background:{{ strtolower($course->course_aided_unaided) == 'aided' ? '#ecfdf5; color:#059669;' : '#fef2f2; color:#dc2626;' }}">
                                                    {{ $course->course_aided_unaided }}
                                                </span>
                                            @else
                                                N/A
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
            <!-- Related by University -->
            @if($relatedByUniversity->count() > 0)
                <div class="info-box">
                    <h3 class="info-box-title">
                        <i class="fa-solid fa-school"></i> Same University
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
                        <i class="fa-solid fa-map"></i> Nearby in {{ $college->district ?: 'District' }}
                    </h3>
                    <div class="related-list">
                        @foreach($relatedByDistrict as $rc)
                            <div class="related-item">
                                <a href="{{ route('indian-colleges.show', $rc->id) }}" class="related-item-title">
                                    {{ $rc->college_name }}
                                </a>
                                <div class="related-item-meta">
                                    {{ $rc->college_type ?: 'General' }} | {{ $rc->management ?: 'Private' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

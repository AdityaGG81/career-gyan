@extends('layouts.app')

@section('title', 'CareerGyan Aptitude Analysis Report')

@section('styles')
<style>
    .dashboard-container {
        padding: 40px 0;
        background: #f8fafc;
    }
    .stat-card {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        border: 1px solid var(--border);
        height: 100%;
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .profile-box {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 30px;
        border: 1px solid var(--border);
        margin-bottom: 30px;
    }
    .aptitude-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .high-badge { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .avg-badge { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
    .low-badge { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .rec-section {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 30px;
        border: 1px solid var(--border);
        margin-top: 30px;
    }
    .rec-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }
    .rec-card {
        background: #fdfdfd;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 20px;
        transition: transform 0.2s;
    }
    .rec-card:hover {
        transform: translateY(-5px);
        border-color: var(--brand);
    }
    .rec-icon {
        width: 40px;
        height: 40px;
        background: var(--brand-light);
        color: var(--brand);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 15px;
    }
    .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    .tag-item {
        font-size: 11px;
        background: #f1f5f9;
        color: #475569;
        padding: 3px 10px;
        border-radius: 4px;
        font-weight: 600;
    }
    a.tag-item {
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    a.tag-item:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-1px);
    }
    a.tag-item.occ-tag {
        background: var(--brand-light);
        color: var(--brand);
    }
    a.tag-item.occ-tag:hover {
        background: #dbeafe;
        color: var(--brand-dark);
    }

    /* Answersheet Styles */
    .answersheet-section {
        display: none;
        margin-top: 40px;
        padding: 30px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
    }
    
    /* Modern Action Center */
    .results-action-bar {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        padding: 24px 30px;
        margin-top: 40px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .action-bar-buttons {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-action-main {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.25s ease;
        box-shadow: var(--shadow-sm);
    }
    .btn-action-main:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-cert {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff;
    }
    .btn-cert:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        color: #ffffff;
    }
    .btn-review-toggle {
        background: #f8fafc;
        color: #1e293b;
        border: 1.5px solid #cbd5e1;
    }
    .btn-review-toggle:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .btn-review-toggle.is-active {
        background: #7c3aed;
        color: #ffffff;
        border-color: #7c3aed;
    }
    .btn-print {
        background: #ffffff;
        color: #475569;
        border: 1.5px solid #e2e8f0;
    }
    .btn-print:hover {
        background: #f8fafc;
        color: #1e293b;
    }
    .btn-explore {
        background: #0f172a;
        color: #ffffff;
    }
    .btn-explore:hover {
        background: #1e293b;
        color: #ffffff;
    }

    /* Modern Answer Review Card */
    .answer-review-container {
        display: block;
        margin-top: 35px;
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .answer-review-header {
        padding: 28px 32px 20px;
        background: linear-gradient(180deg, #fafafa 0%, #ffffff 100%);
        border-bottom: 1px solid var(--border);
    }

    .review-stats-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    .review-stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid transparent;
    }
    .review-stat-chip.total { background: #f5f3ff; color: #6d28d9; border-color: #ddd6fe; }
    .review-stat-chip.correct { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
    .review-stat-chip.wrong { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
    .review-stat-chip.acc { background: #f8fafc; color: #334155; border-color: #cbd5e1; }

    .review-filter-nav {
        display: flex;
        gap: 8px;
        padding: 16px 32px;
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .review-filter-btn {
        padding: 7px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid var(--border);
        background: #ffffff;
        color: var(--text-2);
        cursor: pointer;
        transition: all 0.2s;
    }
    .review-filter-btn:hover {
        background: #f1f5f9;
        color: var(--text-1);
    }
    .review-filter-btn.active {
        background: #7c3aed;
        color: #ffffff;
        border-color: #7c3aed;
        box-shadow: 0 2px 6px rgba(124, 58, 237, 0.25);
    }

    .review-items-list {
        padding: 24px 32px 32px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .review-q-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: var(--radius-lg);
        padding: 22px;
        transition: all 0.2s ease;
    }
    .review-q-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    }
    .review-q-card.is-correct-card {
        border-left: 5px solid #10b981;
    }
    .review-q-card.is-wrong-card {
        border-left: 5px solid #ef4444;
    }

    .review-q-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
    }

    .review-pill-status {
        font-size: 12px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .review-pill-status.corr { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .review-pill-status.incorr { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

    .review-q-text {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-1);
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .review-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 10px;
        margin-bottom: 14px;
    }

    .review-opt-pill {
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 13.5px;
        border: 1.5px solid #e2e8f0;
        background: #ffffff;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s;
    }
    .review-opt-pill.is-target {
        border-color: #10b981;
        background: #ecfdf5;
        color: #065f46;
        font-weight: 700;
    }
    .review-opt-pill.is-user-wrong {
        border-color: #ef4444;
        background: #fff1f2;
        color: #991b1b;
        font-weight: 700;
    }

    .review-answer-comparison {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 14px;
    }
    @media (max-width: 650px) {
        .review-answer-comparison { grid-template-columns: 1fr; }
    }

    .review-ans-box {
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13.5px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .review-ans-box.user-chosen-correct {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }
    .review-ans-box.user-chosen-wrong {
        background: #fef2f2;
        border: 1px solid #fecaca;
    }
    .review-ans-box.official-correct {
        background: #f0fdf4;
        border: 1px solid #86efac;
    }

    .cta-advanced {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 40px;
        color: #fff;
        text-align: center;
        margin-top: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }
    .cta-advanced::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        pointer-events: none;
    }
    .cta-advanced h2 {
        font-family: 'Sora', sans-serif;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #fff;
    }
    .cta-advanced p {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    /* Print Styles for Professional PDF */
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background: #fff !important;
        }
        
        .dashboard-container {
            background: #fff !important;
            padding: 0 !important;
        }
        
        .report-header {
            border: 2px solid #3b82f6 !important;
            page-break-inside: avoid;
            margin-bottom: 30px !important;
        }
        
        .profile-box,
        .stat-card,
        .rec-section {
            page-break-inside: avoid;
            margin-bottom: 20px !important;
        }
        
        .chart-container {
            page-break-inside: avoid;
            height: 250px !important;
        }
        
        .action-btn,
        .cta-advanced,
        .answersheet-section,
        .quiz-sticky-bar {
            display: none !important;
        }
        
        h1, h2, h3 {
            color: #1e293b !important;
        }
        
        .section-label {
            color: #64748b !important;
        }
        
        /* Ensure proper spacing */
        .container {
            max-width: 100% !important;
            padding: 20px !important;
        }
        
        /* Fix table layouts */
        .rec-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container">
        {{-- Professional Report Header --}}
        <div class="report-header" style="background: #fff; border: 2px solid #3b82f6; border-radius: 16px; padding: 32px; margin-bottom: 40px; box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                {{-- CareerGyan Branding --}}
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px; font-weight: 800;">
                        CG
                    </div>
                    <div>
                        <h1 style="font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 800; color: #1e293b; margin: 0; line-height: 1.2;">
                            CareerGyan
                        </h1>
                        <p style="font-size: 14px; color: #64748b; margin: 0; font-weight: 500;">
                            INDIAN INSTITUTE OF CAREER MANAGEMENT
                        </p>
                    </div>
                </div>
                
                {{-- Report Title --}}
                <div style="text-align: right;">
                    <h2 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: #1e293b; margin: 0; line-height: 1.2;">
                        CareerGyan Aptitude Analysis Report
                    </h2>
                    <p style="font-size: 13px; color: #64748b; margin: 4px 0 0 0;">
                        Professional Career Assessment
                    </p>
                </div>
            </div>
            
            {{-- Student Information Section --}}
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 16px 0; text-transform: uppercase; letter-spacing: 0.05em;">
                    Student Information
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Student Name</span>
                        <p style="font-size: 16px; color: #1e293b; font-weight: 600; margin: 4px 0 0 0;">
                            {{ $attempt->student_name ?: 'Not Provided' }}
                        </p>
                    </div>
                    <div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Student ID</span>
                        <p style="font-size: 16px; color: #1e293b; font-weight: 600; margin: 4px 0 0 0;">
                            #{{ strtoupper(substr($attempt->uuid, 0, 8)) }}
                        </p>
                    </div>
                    <div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Report Date</span>
                        <p style="font-size: 16px; color: #1e293b; font-weight: 600; margin: 4px 0 0 0;">
                            {{ $attempt->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    @if($attempt->student_email)
                    <div>
                        <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Email</span>
                        <p style="font-size: 16px; color: #1e293b; font-weight: 600; margin: 4px 0 0 0;">
                            {{ $attempt->student_email }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Aptitude Profile Paragraph --}}
        <div class="profile-box">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 15px;">Aptitude Profile Summary</h3>
            <p style="font-size: 16px; line-height: 1.6; color: var(--text-1);">
                {!! nl2br(e($profileParagraph)) !!}
            </p>
            
            <div style="margin-top: 25px;">
                <h4 style="font-size: 14px; font-weight: 700; color: var(--text-3); text-transform: uppercase; margin-bottom: 12px;">Aptitude Classification</h4>
                <div style="margin-bottom: 10px;">
                    <strong style="font-size: 13px; color: #166534; width: 140px; display: inline-block;">High Aptitude:</strong>
                    @forelse($highAptitude as $h)
                        <span class="aptitude-badge high-badge">{{ $h }}</span>
                    @empty
                        <span style="color: var(--text-3); font-size: 13px;">None</span>
                    @endforelse
                </div>
                <div style="margin-bottom: 10px;">
                    <strong style="font-size: 13px; color: #854d0e; width: 140px; display: inline-block;">Average Aptitude:</strong>
                    @forelse($averageAptitude as $a)
                        <span class="aptitude-badge avg-badge">{{ $a }}</span>
                    @empty
                        <span style="color: var(--text-3); font-size: 13px;">None</span>
                    @endforelse
                </div>
                <div>
                    <strong style="font-size: 13px; color: #991b1b; width: 140px; display: inline-block;">Low Aptitude:</strong>
                    @forelse($lowAptitude as $l)
                        <span class="aptitude-badge low-badge">{{ $l }}</span>
                    @empty
                        <span style="color: var(--text-3); font-size: 13px;">None</span>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- Charts Row --}}
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 30px;">
            <div class="stat-card">
                <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; margin-bottom: 25px; color: var(--brand);">Sectional Aptitude Graph</h3>
                <div class="chart-container">
                    <canvas id="sectionChart"></canvas>
                </div>
            </div>
            <div class="stat-card">
                <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; margin-bottom: 25px; color: var(--brand);">Accuracy Overview</h3>
                <div class="chart-container">
                    <canvas id="accuracyChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Recommendation Section --}}
        <div class="rec-section">
            <h3 style="font-size: 20px; font-weight: 800; color: var(--text-1); margin-bottom: 10px;">Suggested Educational & Vocational Areas</h3>
            <p style="color: var(--text-3); font-size: 14px;">Based on your top aptitude strengths.</p>
            
            <div class="rec-grid">
                @foreach($linkedRecommendedCareers as $rec)
                    <div class="rec-card">
                        <div class="rec-icon">
                            <i class="fa-solid {{ $rec['icon'] }}"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--brand); margin-bottom: 8px;">{{ $rec['section'] }}</h4>
                        
                        <div style="margin-bottom: 15px;">
                            <div style="font-size: 12px; font-weight: 700; color: var(--text-3); text-transform: uppercase;">Vocational Areas</div>
                            <div class="tag-list">
                                @foreach($rec['areas'] as $area)
                                    @if($area && isset($area['label']) && isset($area['url']))
                                        <a href="{{ $area['url'] }}" class="tag-item" title="View {{ $area['label'] }} details">{{ $area['label'] }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @if(count($rec['occupations']) > 0)
                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: var(--text-3); text-transform: uppercase;">Suggested Occupations</div>
                            <div class="tag-list">
                                @foreach($rec['occupations'] as $occ)
                                    @if($occ && isset($occ['label']) && isset($occ['url']))
                                        <a href="{{ $occ['url'] }}" class="tag-item occ-tag" title="View {{ $occ['label'] }} details">{{ $occ['label'] }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Results Action & Command Toolbar --}}
        <div class="results-action-bar">
            <div>
                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--brand); letter-spacing: 0.5px;">
                    Take the Next Step
                </span>
                <h3 style="font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800; color: var(--text-1); margin: 2px 0 0 0;">
                    Your Official Report & Tools
                </h3>
            </div>
            
            <div class="action-bar-buttons">
                @guest
                <a href="{{ route('quick-test.certificate', $attempt->uuid) }}" target="_blank" class="btn-action-main btn-cert">
                    <i class="fa-solid fa-right-to-bracket"></i> Sign In for Certificate
                </a>
                @else
                <a href="{{ route('quick-test.certificate', $attempt->uuid) }}" target="_blank" class="btn-action-main btn-cert">
                    <i class="fa-solid fa-award"></i> View Certificate
                </a>
                @endguest

                <button type="button" id="toggleReviewBtn" onclick="toggleAnswersheet()" class="btn-action-main btn-review-toggle is-active">
                    <i class="fa-solid fa-list-check"></i> Answer Review ({{ count($questions) }} Qs)
                </button>

                <button type="button" onclick="window.print()" class="btn-action-main btn-print">
                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                </button>

                <a href="{{ url('/explore') }}" class="btn-action-main btn-explore">
                    Explore Careers <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Detailed Question & Answer Review Section --}}
        @php
            $answers = $attempt->answers ?? [];
            $totalQuestionsCount = count($questions);
            $correctCount = 0;
            $wrongCount = 0;
            foreach($questions as $q) {
                $userAns = $answers[$q->id] ?? null;
                if ($userAns && strtoupper(trim((string)$userAns)) === strtoupper(trim((string)$q->correct_option))) {
                    $correctCount++;
                } else {
                    $wrongCount++;
                }
            }
            $accuracyPercentage = $totalQuestionsCount > 0 ? round(($correctCount / $totalQuestionsCount) * 100) : 0;
        @endphp

        <div id="answersheet" class="answer-review-container">
            <div class="answer-review-header">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <span style="font-size: 11px; font-weight: 800; background: #ede9fe; color: #6d28d9; padding: 2px 8px; border-radius: 999px; text-transform: uppercase;">
                                Questions Breakdown
                            </span>
                            <span style="font-size: 12px; color: var(--text-3);">Evaluated against official answer key</span>
                        </div>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-1); margin: 0;">
                            Detailed Answer Review
                        </h3>
                    </div>

                    {{-- Performance Metrics Chips --}}
                    <div class="review-stats-bar" style="margin-top: 0;">
                        <span class="review-stat-chip total">
                            Total: <strong>{{ $totalQuestionsCount }}</strong>
                        </span>
                        <span class="review-stat-chip correct">
                            <i class="fa-solid fa-circle-check"></i> Correct: <strong>{{ $correctCount }}</strong>
                        </span>
                        <span class="review-stat-chip wrong">
                            <i class="fa-solid fa-circle-xmark"></i> Incorrect: <strong>{{ $wrongCount }}</strong>
                        </span>
                        <span class="review-stat-chip acc">
                            Accuracy: <strong>{{ $accuracyPercentage }}%</strong>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Interactive Filter Tabs --}}
            <div class="review-filter-nav">
                <button type="button" class="review-filter-btn active" onclick="filterQuickReview('all', this)">
                    All Questions ({{ $totalQuestionsCount }})
                </button>
                <button type="button" class="review-filter-btn" onclick="filterQuickReview('correct', this)">
                    <i class="fa-solid fa-check" style="color: #10b981;"></i> Correct Only ({{ $correctCount }})
                </button>
                <button type="button" class="review-filter-btn" onclick="filterQuickReview('wrong', this)">
                    <i class="fa-solid fa-xmark" style="color: #ef4444;"></i> Incorrect Only ({{ $wrongCount }})
                </button>
            </div>

            {{-- Card-Based Question List --}}
            <div class="review-items-list" id="quickQuestionsReviewList">
                @foreach($questions as $index => $q)
                    @php
                        $userAns = $answers[$q->id] ?? null;
                        $isCorrect = ($userAns && strtoupper(trim((string)$userAns)) === strtoupper(trim((string)$q->correct_option)));
                        $correctOpt = strtoupper(trim((string)$q->correct_option));
                        $userOpt = $userAns ? strtoupper(trim((string)$userAns)) : null;

                        $optionsMap = [
                            'A' => ['text' => $q->option_a, 'img' => $q->option_a_image],
                            'B' => ['text' => $q->option_b, 'img' => $q->option_b_image],
                            'C' => ['text' => $q->option_c, 'img' => $q->option_c_image],
                            'D' => ['text' => $q->option_d, 'img' => $q->option_d_image],
                        ];
                    @endphp
                    <div class="review-q-card {{ $isCorrect ? 'is-correct-card' : 'is-wrong-card' }}" data-status="{{ $isCorrect ? 'correct' : 'wrong' }}">
                        <div class="review-q-meta">
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <span style="font-weight: 800; font-size: 14px; color: var(--text-1);">#{{ $index + 1 }}</span>
                                <span style="background: #f3e8ff; color: #7c3aed; font-size: 11.5px; font-weight: 700; padding: 2px 10px; border-radius: 6px;">
                                    {{ $q->section }}
                                </span>
                            </div>
                            <span class="review-pill-status {{ $isCorrect ? 'corr' : 'incorr' }}">
                                @if($isCorrect)
                                    <i class="fa-solid fa-circle-check"></i> Correct
                                @else
                                    <i class="fa-solid fa-circle-xmark"></i> Incorrect
                                @endif
                            </span>
                        </div>

                        <div class="review-q-text">
                            {{ $q->question_text }}
                        </div>

                        {{-- Question Diagram / Visual if available --}}
                        @if(!empty($q->question_image))
                            <div style="margin-bottom: 16px;">
                                <img src="{{ asset($q->question_image) }}" alt="Question Diagram" style="max-height: 180px; max-width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; padding: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.04);">
                            </div>
                        @endif

                        {{-- Options List / Grid --}}
                        <div class="review-options-grid">
                            @foreach($optionsMap as $optKey => $optData)
                                @php
                                    $hasOpt = !empty($optData['text']) || !empty($optData['img']);
                                    if (!$hasOpt) continue;
                                    $isThisCorrect = ($optKey === $correctOpt);
                                    $isThisSelected = ($optKey === $userOpt);
                                @endphp
                                <div class="review-opt-pill {{ $isThisCorrect ? 'is-target' : ($isThisSelected ? 'is-user-wrong' : '') }}">
                                    <span style="font-weight: 800; min-width: 22px;">{{ $optKey }}.</span>
                                    
                                    @if(!empty($optData['img']))
                                        <img src="{{ asset($optData['img']) }}" alt="Option {{ $optKey }}" style="max-height: 48px; border-radius: 4px; border: 1px solid #e2e8f0; background: #fff; padding: 2px;">
                                    @endif

                                    @if(!empty($optData['text']))
                                        <span style="flex: 1;">{{ $optData['text'] }}</span>
                                    @endif

                                    @if($isThisCorrect)
                                        <span style="font-size: 10px; background: #10b981; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800; margin-left: auto;">CORRECT</span>
                                    @elseif($isThisSelected)
                                        <span style="font-size: 10px; background: #ef4444; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800; margin-left: auto;">YOUR CHOICE</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Side-by-Side User Answer vs Official Correct Answer Comparison --}}
                        <div class="review-answer-comparison">
                            <div class="review-ans-box {{ $isCorrect ? 'user-chosen-correct' : 'user-chosen-wrong' }}">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: {{ $isCorrect ? '#15803d' : '#991b1b' }};">
                                    Your Submitted Choice:
                                </span>
                                <span style="font-size: 14.5px; font-weight: 700; color: {{ $isCorrect ? '#15803d' : '#991b1b' }};">
                                    @if($userOpt)
                                        Option {{ $userOpt }} {{ !empty($optionsMap[$userOpt]['text']) ? '— ' . $optionsMap[$userOpt]['text'] : '' }}
                                    @else
                                        Not Answered / Skipped
                                    @endif
                                </span>
                            </div>
                            <div class="review-ans-box official-correct">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #166534;">
                                    <i class="fa-solid fa-circle-check"></i> Official Correct Answer:
                                </span>
                                <span style="font-size: 14.5px; font-weight: 700; color: #166534;">
                                    Option {{ $correctOpt }} {{ !empty($optionsMap[$correctOpt]['text']) ? '— ' . $optionsMap[$correctOpt]['text'] : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Single Smart AI Career Guruji Consultation Card --}}
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: var(--radius-xl); padding: 32px 36px; margin-top: 40px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);">
            <div style="display: flex; align-items: center; gap: 18px; max-width: 680px;">
                <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #7c3aed, #4f46e5); display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ffffff; flex-shrink: 0; box-shadow: 0 4px 16px rgba(124, 58, 237, 0.4);">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 6px 0; font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800; color: #ffffff;">
                        Need Personal Guidance on These Results?
                    </h4>
                    <p style="margin: 0; font-size: 14px; color: #cbd5e1; line-height: 1.5;">
                        AI Career Guruji has analyzed your stream recommendations. Ask about top degrees, entrance examinations, or a customized career roadmap matching your strengths.
                    </p>
                </div>
            </div>
            <button type="button" onclick="window.openAiChatWithQuery && window.openAiChatWithQuery('Based on my quick stream test results, which careers, streams, and colleges do you recommend for me?')" style="background: #7c3aed; color: #ffffff; padding: 14px 26px; border-radius: 10px; font-size: 14.5px; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 16px rgba(124, 58, 237, 0.4); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-comment-dots"></i> Ask AI About My Scores
            </button>
        </div>

        {{-- Next Steps & Interconnected Ecosystem Recommendation Hub --}}
        <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 36px 32px; margin-top: 40px; box-shadow: var(--shadow-sm);">
            <div style="text-align: center; max-width: 680px; margin: 0 auto 30px;">
                <span style="display:inline-block; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:var(--brand); background:var(--brand-light); padding:4px 14px; border-radius:99px; margin-bottom:8px;">
                    <i class="fa-solid fa-compass"></i> Action Plan
                </span>
                <h3 style="font-family:'Sora', sans-serif; font-size:24px; font-weight:800; color:var(--text-1); margin:0 0 6px;">
                    What to Do Next with Your Aptitude Report
                </h3>
                <p style="font-size:14.5px; color:var(--text-2); margin:0;">
                    Turn these insights into action! Explore verified colleges, predict admission cutoffs, and practice daily.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <!-- 1. College Search -->
                <a href="{{ route('indian-colleges.index') }}" style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--brand)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none';">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px;">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin: 0 0 6px;">Find Top Colleges</h4>
                    <p style="font-size: 13px; color: var(--text-2); line-height: 1.5; margin: 0 0 16px; flex: 1;">Search 90,000+ colleges across India offering degree courses in your recommended career streams.</p>
                    <span style="font-size: 13px; font-weight: 700; color: #2563eb; display: inline-flex; align-items: center; gap: 6px;">Search Colleges &rarr;</span>
                </a>

                <!-- 2. College Predictor -->
                <a href="{{ route('tools.college-predictor') }}" style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.2s;" onmouseover="this.style.borderColor='#d97706'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none';">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px;">
                        <i class="fa-solid fa-crosshairs"></i>
                    </div>
                    <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin: 0 0 6px;">Predict Admission Cutoffs</h4>
                    <p style="font-size: 13px; color: var(--text-2); line-height: 1.5; margin: 0 0 16px; flex: 1;">Check past MHT-CET & engineering cutoffs and predict your probability of getting selected.</p>
                    <span style="font-size: 13px; font-weight: 700; color: #d97706; display: inline-flex; align-items: center; gap: 6px;">Launch Predictor &rarr;</span>
                </a>

                <!-- 3. Daily Quiz -->
                <a href="{{ route('daily-quiz.index') }}" style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.2s;" onmouseover="this.style.borderColor='#7c3aed'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none';">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #f3e8ff; color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px;">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin: 0 0 6px;">Daily Aptitude Quiz</h4>
                    <p style="font-size: 13px; color: var(--text-2); line-height: 1.5; margin: 0 0 16px; flex: 1;">Sharpen your reasoning and general knowledge with 5 quick daily questions and climb the leaderboard.</p>
                    <span style="font-size: 13px; font-weight: 700; color: #7c3aed; display: inline-flex; align-items: center; gap: 6px;">Play Daily Quiz &rarr;</span>
                </a>

                <!-- 4. Job Corner -->
                <a href="{{ route('jobs.index') }}" style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.2s;" onmouseover="this.style.borderColor='#059669'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none';">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px;">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin: 0 0 6px;">Job & Internship Alerts</h4>
                    <p style="font-size: 13px; color: var(--text-2); line-height: 1.5; margin: 0 0 16px; flex: 1;">Explore active hiring notifications, eligibility rules, and official application links for freshers.</p>
                    <span style="font-size: 13px; font-weight: 700; color: #059669; display: inline-flex; align-items: center; gap: 6px;">Browse Jobs &rarr;</span>
                </a>
            </div>
        </div>

        {{-- Advanced Test Invitation Banner --}}
        <div class="cta-advanced fade-up">
            <h2>Ready for an In-Depth 7-Dimension Career Evaluation?</h2>
            <p>Our Advanced Career Assessment covers comprehensive verbal, numerical, spatial, and psychometric dimensions with detailed college & career matching.</p>
            <div style="display: flex; justify-content: center;">
                <a href="{{ route('test.start') }}" class="action-btn" style="background: var(--accent); color: var(--brand-dark); font-weight: 800; font-size: 15px; padding: 14px 30px; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <i class="fa-solid fa-bolt"></i> Take Advanced Test Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle Answersheet
        window.toggleAnswersheet = function() {
            const sheet = document.getElementById('answersheet');
            const btn = document.getElementById('toggleReviewBtn');
            if (!sheet) return;

            if (sheet.style.display === 'none') {
                sheet.style.display = 'block';
                if (btn) btn.classList.add('is-active');
                sheet.scrollIntoView({ behavior: 'smooth' });
            } else {
                sheet.style.display = 'none';
                if (btn) btn.classList.remove('is-active');
            }
        };

        // Filter Quick Test questions by status
        window.filterQuickReview = function(status, btnElement) {
            document.querySelectorAll('.review-filter-btn').forEach(b => b.classList.remove('active'));
            if (btnElement) btnElement.classList.add('active');

            const cards = document.querySelectorAll('#quickQuestionsReviewList .review-q-card');
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        };

        // Sectional Performance Chart
        const sectionalCtx = document.getElementById('sectionChart');
        if (sectionalCtx) {
            const sectionMax = {
                'Language Aptitude': 2,
                'Abstract Reasoning': 2,
                'Verbal Reasoning': 2,
                'Mechanical Reasoning': 2,
                'Numerical Aptitude': 2,
                'Spatial Aptitude': 2,
                'Perceptual Aptitude': 4
            };
            
            const labels = Object.keys(sectionMax);
            const userScores = @json($attempt->section_scores ?? []);
            
            // Map to Tamanna short codes for graph if needed, but labels are clear
            const correctData = labels.map(l => userScores[l] || 0);
            const wrongData = labels.map(l => (sectionMax[l] || 0) - (userScores[l] || 0));

            new Chart(sectionalCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Correct',
                            data: correctData,
                            backgroundColor: '#10b981',
                            borderRadius: 4
                        },
                        {
                            label: 'Incorrect',
                            data: wrongData,
                            backgroundColor: '#ef4444',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: true, grid: { display: false }, ticks: { font: { size: 10, weight: 'bold' } } },
                        y: { stacked: true, beginAtZero: true, max: 4, ticks: { stepSize: 1 } }
                    },
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }

        // Accuracy Pie Chart
        const accuracyCtx = document.getElementById('accuracyChart');
        if (accuracyCtx) {
            const totalCorrect = {{ $attempt->total_score ?? 0 }};
            const totalWrong = 16 - totalCorrect;

            new Chart(accuracyCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Correct', 'Incorrect'],
                    datasets: [{
                        data: [totalCorrect, totalWrong],
                        backgroundColor: ['#10b981', '#ef4444'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }
    });
</script>
@endsection

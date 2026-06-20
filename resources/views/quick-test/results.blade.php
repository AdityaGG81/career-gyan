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
    .answer-row {
        padding: 15px;
        border-bottom: 1px solid var(--border);
        display: grid;
        grid-template-columns: 80px 2fr 1fr 1fr 80px;
        gap: 15px;
        align-items: center;
    }
    .answer-row:last-child { border-bottom: none; }
    .answer-row.correct { background: #f0fdf4; }
    .answer-row.wrong { background: #fef2f2; }
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        text-align: center;
    }
    .status-correct { background: #dcfce7; color: #166534; }
    .status-wrong { background: #fee2e2; color: #991b1b; }
    
    .btn-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 40px;
    }
    .action-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        height: 50px;
        padding: 0 30px;
        background: var(--brand);
        color: #fff;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 15px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }
    .action-btn:hover {
        background: var(--brand-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: #fff;
    }
    .action-btn.btn-outline {
        background: #fff;
        color: var(--brand);
        border: 1.5px solid var(--brand);
        box-shadow: none;
    }
    .action-btn.btn-outline:hover {
        background: var(--brand-light);
        color: var(--brand);
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

        {{-- Advanced Test CTA --}}
        <div class="cta-advanced fade-up">
            <h2>Not sure which career path is right for you?</h2>
            <p>Take our Advanced Test for a deeper aptitude analysis and more accurate career recommendations.</p>
            <div style="display: flex; justify-content: center;">
                <a href="{{ route('test.start') }}" class="action-btn" style="background: var(--accent); color: var(--brand-dark); box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);">
                    <i class="fa-solid fa-bolt"></i> Take Advanced Test
                </a>
            </div>
        </div>

        {{-- Actions --}}
        <div class="btn-group">
            <button onclick="toggleAnswersheet()" class="action-btn btn-outline">
                <i class="fa-solid fa-list-check"></i> Show Answersheet
            </button>
            <button onclick="window.print()" class="action-btn">
                <i class="fa-solid fa-file-pdf"></i> Download Report
            </button>
            <a href="{{ url('/explore') }}" class="action-btn" style="background: var(--text-1);">
                Explore Careers <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        {{-- Answersheet Section --}}
        <div id="answersheet" class="answersheet-section">
            <h3 style="font-size: 20px; font-weight: 800; color: var(--text-1); margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-file-invoice" style="color: var(--brand);"></i> 
                Detailed Answer Review
            </h3>
            
            <div class="answer-row" style="background: #f8fafc; font-weight: 700; border-radius: 8px 8px 0 0; border-bottom: 2px solid var(--border);">
                <div>Q. No</div>
                <div>Question Section</div>
                <div style="text-align: center;">Selected</div>
                <div style="text-align: center;">Correct</div>
                <div style="text-align: center;">Result</div>
            </div>

            @php $answers = $attempt->answers ?? []; @endphp
            @foreach($questions as $index => $q)
                @php 
                    $userAns = $answers[$q->id] ?? 'N/A';
                    $isCorrect = ($userAns === $q->correct_option);
                @endphp
                <div class="answer-row {{ $isCorrect ? 'correct' : 'wrong' }}">
                    <div style="font-weight: 800; color: var(--text-3);">#{{ $index + 1 }}</div>
                    <div>
                        <div style="font-size: 14px; font-weight: 700; color: var(--text-1);">{{ $q->section }}</div>
                    </div>
                    <div style="text-align: center; font-weight: 700;">Option {{ $userAns }}</div>
                    <div style="text-align: center; font-weight: 700; color: #166534;">Option {{ $q->correct_option }}</div>
                    <div style="text-align: center;">
                        <span class="status-badge {{ $isCorrect ? 'status-correct' : 'status-wrong' }}">
                            {{ $isCorrect ? 'Correct' : 'Wrong' }}
                        </span>
                    </div>
                </div>
            @endforeach
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
            if (sheet.style.display === 'block') {
                sheet.style.display = 'none';
            } else {
                sheet.style.display = 'block';
                sheet.scrollIntoView({ behavior: 'smooth' });
            }
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

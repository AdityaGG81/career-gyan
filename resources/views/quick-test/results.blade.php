@extends('layouts.app')

@section('title', 'Aptitude Analytics Dashboard | CareerGyan')

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
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container">
        {{-- Header --}}
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
            <div>
                <span class="section-label">Tamanna Aptitude Report</span>
                <h1 class="section-title" style="margin-top: 10px; color: var(--brand);">Aptitude Profile Analysis</h1>
                <p style="color: var(--text-2); margin-top: 5px;">Based on NCERT Tamanna Aptitude Test Guidelines.</p>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 14px; color: var(--text-3); font-weight: 600;">Student ID: #{{ substr($attempt->uuid, 0, 8) }}</div>
                <div style="font-size: 14px; color: var(--text-3); font-weight: 600;">Date: {{ $attempt->created_at->format('M d, Y') }}</div>
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
                <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; margin-bottom: 25px; color: var(--brand);">Sectional Aptitude Graph (Tamanna Profile)</h3>
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
            <p style="color: var(--text-3); font-size: 14px;">Based on your top aptitude strengths (Tamanna Appendix VII & VIII).</p>
            
            <div class="rec-grid">
                @foreach($attempt->recommended_careers as $rec)
                    <div class="rec-card">
                        <div class="rec-icon">
                            <i class="fa-solid {{ $rec['icon'] }}"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--brand); margin-bottom: 8px;">{{ $rec['section'] }}</h4>
                        
                        <div style="margin-bottom: 15px;">
                            <div style="font-size: 12px; font-weight: 700; color: var(--text-3); text-transform: uppercase;">Vocational Areas</div>
                            <div class="tag-list">
                                @foreach($rec['areas'] as $area)
                                    <span class="tag-item">{{ $area }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <div style="font-size: 12px; font-weight: 700; color: var(--text-3); text-transform: uppercase;">Suggested Occupations</div>
                            <div class="tag-list">
                                @foreach($rec['occupations'] as $occ)
                                    <span class="tag-item" style="background: var(--brand-light); color: var(--brand);">{{ $occ }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        <div style="text-align: center; margin-top: 50px;">
            <button onclick="window.print()" class="nav-btn btn-back" style="display: inline-flex; margin-right: 15px;">
                <i class="fa-solid fa-print"></i> Download Report
            </button>
            <a href="{{ url('/explore') }}" class="nav-cta" style="height: 50px; padding: 0 40px;">
                Explore Detailed Career Paths <i class="fa-solid fa-arrow-right" style="margin-left: 10px;"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

@extends('layouts.app')

@section('title', 'Assessment Report | CareerGyan')

@section('styles')
<style>
    .results-page {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 60px 24px;
    }

    .results-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .results-hero {
        background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);
        border-radius: var(--radius-lg);
        padding: 50px 40px;
        color: white;
        text-align: center;
        margin-bottom: 45px;
        box-shadow: var(--shadow-md);
    }

    .results-hero h1 {
        font-family: 'Sora';
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .results-hero p {
        font-size: 15.5px;
        color: #cbd5e1;
    }

    .archetype-banner {
        background: rgba(251, 191, 36, 0.1);
        border: 1px dashed #fbbf24;
        color: #fbbf24;
        padding: 10px 20px;
        border-radius: 999px;
        display: inline-block;
        font-weight: 700;
        font-size: 14px;
        margin-top: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .results-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 35px;
        margin-bottom: 45px;
    }

    @media (max-width: 900px) {
        .results-grid {
            grid-template-columns: 1fr;
        }
    }

    .card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 35px;
        box-shadow: var(--shadow-sm);
    }

    .card h3 {
        font-family: 'Sora';
        font-size: 18px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 25px;
        border-bottom: 1px solid var(--border);
        padding-bottom: 12px;
    }

    .archetype-section {
        background: linear-gradient(135deg, #fef8f0 0%, #fff7ed 100%);
        border: 1px solid #fed7aa;
    }

    .archetype-section h3 {
        border-bottom-color: #fed7aa;
        color: #9a3412;
    }

    .career-chip {
        display: inline-block;
        background: var(--brand-light);
        color: var(--brand);
        padding: 8px 16px;
        border-radius: 99px;
        font-weight: 700;
        font-size: 13.5px;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    /* Actions block */
    .actions-bar {
        display: flex;
        justify-content: center;
        gap: 20px;
        border-top: 1px solid var(--border);
        padding-top: 35px;
    }

    @media (max-width: 600px) {
        .actions-bar {
            flex-direction: column;
        }
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 52px;
        padding: 0 35px;
        background: var(--brand);
        color: white;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 15.5px;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-action:hover {
        background: var(--brand-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    .btn-certificate {
        background: #10b981;
    }
    .btn-certificate:hover {
        background: #059669;
    }

    .btn-outline {
        background: white;
        color: var(--text-2);
        border: 1.5px solid var(--border);
        box-shadow: none;
    }
    .btn-outline:hover {
        background: var(--bg);
        color: var(--text-1);
    }
</style>
@endsection

@section('content')
<div class="results-page">
    <div class="results-container">
        
        <div class="results-hero">
            <h1>Assessment Completed Successfully</h1>
            <p>We have isolated your key cognitive factors. Check out your full evaluation below.</p>
            
            <div class="archetype-banner">
                Archetype: {{ $attempt->recommendations['archetype'] ?? 'High Performer' }}
            </div>
        </div>

        <div class="results-grid">
            <!-- Left Side: Radar Chart -->
            <div class="card">
                <h3>Dimension Breakdown</h3>
                <canvas id="scoresChart" width="300" height="300"></canvas>
                
                <div style="margin-top: 25px;">
                    @foreach($attempt->scores as $dim => $val)
                        <div style="display: flex; justify-content: space-between; font-size: 13.5px; margin-bottom: 12px; border-bottom: 1px solid var(--border); padding-bottom: 6px;">
                            <span style="color: var(--text-2); font-weight: 600; text-transform: capitalize;">{{ str_replace('-', ' ', $dim) }}</span>
                            <strong style="color: var(--brand); font-weight: 700;">{{ $val }}%</strong>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side: Archetype and Advice -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="card archetype-section">
                    <h3>Cognitive Archetype Profile</h3>
                    <p style="font-size: 15px; color: #431407; font-weight: 700; margin-bottom: 15px; font-family: 'Sora';">
                        {{ $attempt->recommendations['archetype'] ?? 'Cognitive Thinker' }}
                    </p>
                    <div style="font-size: 14px; color: #7c2d12; line-height: 1.6; margin-bottom: 25px;">
                        <strong>Key Strengths:</strong> {{ $attempt->recommendations['strengths'] ?? 'Exceptional cognitive capacity and analytical framework.' }}
                    </div>
                    <div style="font-size: 14px; color: #7c2d12; line-height: 1.6;">
                        <strong>Growth Advice:</strong> {{ $attempt->recommendations['advice'] ?? 'Focus on identifying multi-dimensional environments.' }}
                    </div>
                </div>

                <div class="card">
                    <h3>Recommended Career Matches</h3>
                    <p style="font-size: 14px; color: var(--text-2); margin-bottom: 20px; line-height: 1.5;">
                        Your profile matches exceptionally well with the following high-growth career tracks:
                    </p>
                    
                    <div style="margin-bottom: 20px;">
                        @foreach(($attempt->recommendations['careers'] ?? ['Management Consulting', 'Strategy Lead', 'Product Lead']) as $career)
                            <span class="career-chip">{{ $career }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="actions-bar">
            <a href="{{ route('advanced-test.certificate', $attempt->uuid) }}" target="_blank" class="btn-action btn-certificate">
                <i class="fa-solid fa-award"></i> View Official Certificate
            </a>
            <a href="{{ route('advanced-test.index') }}" class="btn-action btn-outline">
                <i class="fa-solid fa-rotate-left"></i> Hub Dashboard
            </a>
            <a href="{{ url('/') }}" class="btn-action" style="background: var(--primary);">
                Back to Home <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scoresData = @json($attempt->scores);
        const labels = Object.keys(scoresData).map(k => k.charAt(0).toUpperCase() + k.slice(1));
        const data = Object.values(scoresData);

        const ctx = document.getElementById('scoresChart').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Match Percent',
                    data: data,
                    backgroundColor: 'rgba(26, 86, 219, 0.2)',
                    borderColor: 'rgba(26, 86, 219, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(26, 86, 219, 1)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        angleLines: { display: true },
                        grid: { display: true },
                        ticks: { min: 0, max: 100, stepSize: 20, display: false }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection

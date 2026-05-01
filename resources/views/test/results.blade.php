@extends('layouts.app')

@section('title', 'Your Test Results | CareerGyan')

@section('styles')
<style>
    .results-hero { background: var(--brand-dark); padding: 60px 0; color: white; text-align: center; }
    .results-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 40px; margin-top: -30px; align-items: start; }
    
    @media(max-width: 900px) {
        .results-grid { grid-template-columns: 1fr; }
    }

    .chart-card { background: white; padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); position: relative; z-index: 10; border: 1px solid var(--border); }
    .recommendations-card { background: white; padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); position: relative; z-index: 10; border: 1px solid var(--border); }

    .career-item { border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; transition: all 0.2s; background: var(--bg); }
    .career-item:hover { border-color: var(--brand); box-shadow: 0 4px 12px rgba(26, 86, 219, 0.08); background: white; }
    
    .career-info h3 { font-family: 'Sora'; font-size: 20px; color: var(--text-1); margin-bottom: 6px; }
    .career-info p { font-size: 14px; color: var(--text-2); }
    
    .match-badge { background: var(--brand-light); color: var(--brand); padding: 8px 16px; border-radius: 999px; font-weight: 700; font-family: 'Sora'; font-size: 16px; display: inline-block; white-space: nowrap; }
    
</style>
@endsection

@section('content')
<main>
    <div class="results-hero">
        <div class="container fade-up">
            <span class="section-label" style="background: rgba(255,255,255,0.2); color: white; margin-bottom: 12px;">
                <i class="fa-solid fa-check-circle"></i> Assessment Complete
            </span>
            <h1 style="font-family: 'Sora'; font-size: 32px; font-weight: 700;">Your Cognitive Profile & Matches</h1>
        </div>
    </div>

    <div class="container" style="padding-bottom: 80px;">
        <div class="results-grid">
            
            <!-- Radar Chart -->
            <div class="chart-card fade-up fade-up-1">
                <h3 style="font-family: 'Sora'; font-size: 18px; margin-bottom: 20px; text-align: center; color: var(--text-1);">Aptitude Radar</h3>
                <canvas id="scoresChart" width="400" height="400"></canvas>

                <div style="margin-top: 30px;">
                    <h4 style="font-family: 'Sora'; font-size: 16px; margin-bottom: 12px; border-bottom: 2px solid var(--border); padding-bottom: 8px;">Breakdown of Marks</h4>
                    <ul style="padding: 0; margin: 0; list-style: none;">
                    @if(isset($session->user_inputs['raw_scores']))
                        @foreach($session->user_inputs['raw_scores'] as $slug => $data)
                            <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--border); font-size: 14.5px;">
                                <span style="color: var(--text-2); text-transform: capitalize;">{{ str_replace('-', ' ', $slug) }}</span>
                                <strong style="color: var(--brand); font-weight: 700;">{{ $data['correct'] }} / {{ $data['total'] }}</strong>
                            </li>
                        @endforeach
                    @elseif(isset($session->aptitude_scores))
                        @foreach($session->aptitude_scores as $slug => $score)
                            <li style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--border); font-size: 14.5px;">
                                <span style="color: var(--text-2); text-transform: capitalize;">{{ str_replace('-', ' ', $slug) }}</span>
                                <strong style="color: var(--brand); font-weight: 700;">{{ $score }} / 10</strong>
                            </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>

            <!-- Recommendations -->
            <div style="display: flex; flex-direction: column; gap: 40px;">

                <!-- Fields -->
                <div class="recommendations-card fade-up fade-up-2">
                    <h2 style="font-family: 'Sora'; font-size: 24px; margin-bottom: 8px; color: var(--text-1);">Recommended Broad Fields</h2>
                    <p style="color: var(--text-2); margin-bottom: 30px; font-size: 15px;">Your aptitude scores show a strong inclination towards these general areas of study and work.</p>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
                        @forelse($fields as $field)
                        <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px; background: white; display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: {{ $field->bg_color ?? 'var(--brand-light)' }}; color: {{ $field->color ?? 'var(--brand)' }}; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                <i class="{{ $field->icon ?? 'fa-solid fa-briefcase' }}"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="font-family: 'Sora'; font-size: 16px; margin-bottom: 4px;">{{ $field->name }}</h4>
                                <div style="width: 100%; height: 6px; background: var(--border); border-radius: 999px; overflow: hidden; margin-top: 8px;">
                                    <div style="height: 100%; width: {{ round($recommendedFields[$field->id]) }}%; background: var(--brand);"></div>
                                </div>
                            </div>
                            <div style="font-weight: 700; color: var(--brand); font-size: 18px;">
                                {{ round($recommendedFields[$field->id]) }}%
                            </div>
                        </div>
                        @empty
                            <p style="color: var(--text-2);">No fields calculated. Try retaking the test.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Careers -->
                <div class="recommendations-card fade-up fade-up-3">
                <h2 style="font-family: 'Sora'; font-size: 24px; margin-bottom: 8px; color: var(--text-1);">Top Recommended Careers</h2>
                <p style="color: var(--text-2); margin-bottom: 30px; font-size: 15px;">Based on your aptitude scores and preferences, here are the paths where you are statistically most likely to thrive.</p>

                @forelse($careers as $career)
                    <div class="career-item">
                        <div class="career-info">
                            <h3>{{ $career->title }}</h3>
                            <p>{{ Str::limit($career->description, 100) }}</p>
                            <div style="margin-top: 10px;">
                                <span class="tag badge-green"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($career->average_salary) }}/yr</span>
                                <span class="tag badge-purple"><i class="fa-solid fa-graduation-cap"></i> {{ $career->required_qualification ?? 'Varies' }}</span>
                            </div>
                        </div>
                        <div class="match-badge">
                            {{ round($recommendedIds[$career->id]) }}% Fit
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: var(--text-2);">
                        <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 15px; opacity: 0.5;"></i>
                        <p>No suitable careers found. We might need more data.</p>
                    </div>
                @endforelse

                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ url('/explore') }}" class="btn btn-outline" style="display: inline-block; text-decoration: none; padding: 10px 20px;">Explore All Careers</a>
                </div>
            </div>

            </div> <!-- End Display Flex right col -->
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scoresData = @json($session->aptitude_scores);
        
        const labels = Object.keys(scoresData).map(slug => {
            return slug.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        });
        const data = Object.values(scoresData);

        const ctx = document.getElementById('scoresChart').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Your Score (/10)',
                    data: data,
                    backgroundColor: 'rgba(26, 86, 219, 0.2)',
                    borderColor: 'rgba(26, 86, 219, 1)',
                    pointBackgroundColor: 'rgba(26, 86, 219, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(26, 86, 219, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        angleLines: { color: 'rgba(0, 0, 0, 0.1)' },
                        grid: { color: 'rgba(0, 0, 0, 0.1)' },
                        pointLabels: {
                            font: { family: "'DM Sans', sans-serif", size: 12, weight: '500' },
                            color: '#475569'
                        },
                        ticks: { min: 0, max: 10, stepSize: 2, display: false }
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

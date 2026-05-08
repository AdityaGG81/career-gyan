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
    
    .recommendations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .career-card-new {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 25px;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
    .career-card-new:hover {
        transform: translateY(-5px);
        border-color: var(--brand);
        box-shadow: var(--shadow-md);
    }
    
    .action-buttons-container {
        text-align: center;
        margin-top: 60px;
        border-top: 1px solid var(--border);
        padding-top: 40px;
    }
    /* Action Buttons Style */
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
        grid-template-columns: 60px 180px 1fr 120px 120px 100px;
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
</style>
@endsection

@section('content')
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
                <div class="recommendations-card fade-up fade-up-2" style="margin-top: 0; height: 100%;">
                    <h2 style="font-family: 'Sora'; font-size: 24px; margin-bottom: 8px; color: var(--text-1);">Recommended Broad Fields</h2>
                    <p style="color: var(--text-2); margin-bottom: 30px; font-size: 15px;">Inclination towards these general areas of study and work.</p>

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
                            <p style="color: var(--text-2);">No fields calculated.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Careers Full Width Section -->
        <div class="recommendations-card fade-up fade-up-3" style="margin-top: 40px;">
            <h2 style="font-family: 'Sora'; font-size: 28px; margin-bottom: 8px; color: var(--text-1); text-align: center;">Top Recommended Career Matches</h2>
            <p style="color: var(--text-2); margin-bottom: 40px; font-size: 16px; text-align: center; max-width: 700px; margin-left: auto; margin-right: auto;">
                Based on your aptitude scores and cognitive profile, here are the paths where you are statistically most likely to thrive.
            </p>

            <div class="recommendations-grid">
                @forelse($careers as $career)
                    <div class="career-card-new">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                                <h3 style="font-family: 'Sora'; font-size: 20px; color: var(--brand); font-weight: 700; margin: 0;">{{ $career->title }}</h3>
                                <div class="match-badge" style="font-size: 14px; padding: 5px 12px;">{{ round($recommendedIds[$career->id]) }}% Fit</div>
                            </div>
                            <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px;">{{ Str::limit($career->description, 120) }}</p>
                        </div>
                        
                        <div style="border-top: 1px solid var(--border); padding-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
                            <span class="tag badge-green" style="font-size: 12px;"><i class="fa-solid fa-indian-rupee-sign"></i> ₹{{ number_format($career->average_salary/100000, 1) }}L/yr</span>
                            <span class="tag badge-purple" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap"></i> {{ $career->required_qualification ?? 'Varies' }}</span>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px;">
                        <i class="fa-solid fa-box-open" style="font-size: 50px; margin-bottom: 20px; opacity: 0.3;"></i>
                        <p style="color: var(--text-2); font-size: 18px;">No specific career matches found yet.</p>
                    </div>
                @endforelse
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
                <div>Section</div>
                <div>Question</div>
                <div style="text-align: center;">Your Answer</div>
                <div style="text-align: center;">Correct</div>
                <div style="text-align: center;">Result</div>
            </div>

            @php $userAnswers = $session->user_inputs['answers'] ?? []; @endphp
            @foreach($questions as $index => $q)
                @php 
                    $userAns = $userAnswers[$q->id] ?? 'N/A';
                    $isCorrect = (trim(strtolower($userAns)) === trim(strtolower($q->correct_answer)));
                @endphp
                <div class="answer-row {{ $isCorrect ? 'correct' : 'wrong' }}">
                    <div style="font-weight: 800; color: var(--text-3);">#{{ $index + 1 }}</div>
                    <div style="font-size: 13px; font-weight: 600; color: var(--brand); text-transform: capitalize;">
                        {{ str_replace('-', ' ', $q->dimension->slug) }}
                    </div>
                    <div style="font-size: 14px; color: var(--text-1); line-height: 1.4;">
                        {{ $q->question_text }}
                    </div>
                    <div style="text-align: center; font-weight: 700;">{{ $userAns }}</div>
                    <div style="text-align: center; font-weight: 700; color: #166534;">{{ $q->correct_answer }}</div>
                    <div style="text-align: center;">
                        <span class="status-badge {{ $isCorrect ? 'status-correct' : 'status-wrong' }}">
                            {{ $isCorrect ? 'Correct' : 'Wrong' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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

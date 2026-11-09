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
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
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
    .review-stat-chip.total { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
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
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
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
</style>
@endsection

@section('content')
    <div class="results-hero">
        <div class="container fade-up">
            <span class="section-label" style="background: rgba(255,255,255,0.2); color: white; margin-bottom: 12px;">
                <i class="fa-solid fa-check-circle"></i> Assessment Complete
            </span>
            <h1 style="font-family: 'Sora'; font-size: 32px; font-weight: 700;">Your Cognitive Profile & Matches</h1>

            @if(session('reward_notification'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1.5px solid rgba(52, 211, 153, 0.8); color: #ecfdf5; padding: 14px 22px; border-radius: var(--radius-lg); margin: 20px auto 0; max-width: 650px; display: flex; align-items: center; justify-content: space-between; gap: 16px; backdrop-filter: blur(8px);">
                    <div style="display: flex; align-items: center; gap: 12px; text-align: left;">
                        <i class="fa-solid fa-gift" style="font-size: 24px; color: #34d399;"></i>
                        <div>
                            <div style="font-weight: 700; font-size: 14px;">{{ session('reward_notification') }}</div>
                        </div>
                    </div>
                    <a href="{{ route('rewards.index') }}" style="background: #10b981; color: #ffffff; padding: 7px 14px; border-radius: 99px; font-weight: 700; font-size: 12px; text-decoration: none; white-space: nowrap;">
                        My Wallet &rarr;
                    </a>
                </div>
            @endif
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

        @php
            $userAnswers = $session->user_inputs['answers'] ?? [];
            $answeredQuestions = $questions->filter(function($q) use ($userAnswers) {
                return array_key_exists($q->id, $userAnswers);
            });
            if ($answeredQuestions->isEmpty()) {
                $answeredQuestions = $questions->take(20);
            }

            $totalAnswered = $answeredQuestions->count();
            $evalCorrect = 0;
            $evalWrong = 0;

            foreach($answeredQuestions as $q) {
                $uAns = $userAnswers[$q->id] ?? null;
                $isC = ($uAns !== null && trim(strtolower((string)$uAns)) === trim(strtolower((string)$q->correct_answer)));
                if ($isC) {
                    $evalCorrect++;
                } else {
                    $evalWrong++;
                }
            }
            $accuracyRate = $totalAnswered > 0 ? round(($evalCorrect / $totalAnswered) * 100) : 0;
        @endphp

        {{-- Results Action & Command Center --}}
        <div class="results-action-bar fade-up">
            <div>
                <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: var(--brand); display: block; margin-bottom: 4px;">
                    <i class="fa-solid fa-circle-check"></i> Assessment Verified
                </span>
                <h3 style="font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800; color: var(--text-1); margin: 0;">
                    Your Official Report & Tools
                </h3>
            </div>
            
            <div class="action-bar-buttons">
                <a href="{{ route('test.certificate', $session->uuid) }}" target="_blank" class="btn-action-main btn-cert">
                    <i class="fa-solid fa-award"></i> View Certificate
                </a>
                <button type="button" id="toggleReviewBtn" onclick="toggleAnswersheet()" class="btn-action-main btn-review-toggle is-active">
                    <i class="fa-solid fa-list-check"></i> Answer Review ({{ $totalAnswered }} Qs)
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
        <div id="answersheet" class="answer-review-container">
            <div class="answer-review-header">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <span style="font-size: 11px; font-weight: 800; background: var(--brand-light); color: var(--brand); padding: 2px 8px; border-radius: 999px; text-transform: uppercase;">
                                Questions Breakdown
                            </span>
                            <span style="font-size: 12px; color: var(--text-3);">Evaluated vs official key</span>
                        </div>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-1); margin: 0;">
                            Detailed Answer Review
                        </h3>
                    </div>

                    {{-- Performance Metrics Chips --}}
                    <div class="review-stats-bar" style="margin-top: 0;">
                        <span class="review-stat-chip total">
                            Total: <strong>{{ $totalAnswered }}</strong>
                        </span>
                        <span class="review-stat-chip correct">
                            <i class="fa-solid fa-circle-check"></i> Correct: <strong>{{ $evalCorrect }}</strong>
                        </span>
                        <span class="review-stat-chip wrong">
                            <i class="fa-solid fa-circle-xmark"></i> Incorrect: <strong>{{ $evalWrong }}</strong>
                        </span>
                        <span class="review-stat-chip acc">
                            Accuracy: <strong>{{ $accuracyRate }}%</strong>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Interactive Filter Tabs --}}
            <div class="review-filter-nav">
                <button type="button" class="review-filter-btn active" onclick="filterAptitudeReview('all', this)">
                    All Questions ({{ $totalAnswered }})
                </button>
                <button type="button" class="review-filter-btn" onclick="filterAptitudeReview('correct', this)">
                    <i class="fa-solid fa-check" style="color: #10b981;"></i> Correct Only ({{ $evalCorrect }})
                </button>
                <button type="button" class="review-filter-btn" onclick="filterAptitudeReview('wrong', this)">
                    <i class="fa-solid fa-xmark" style="color: #ef4444;"></i> Incorrect Only ({{ $evalWrong }})
                </button>
            </div>

            {{-- Card-Based Question List --}}
            <div class="review-items-list" id="aptitudeQuestionsReviewList">
                @foreach($answeredQuestions->values() as $index => $q)
                    @php
                        $userAns = $userAnswers[$q->id] ?? 'N/A';
                        $isCorrect = (trim(strtolower((string)$userAns)) === trim(strtolower((string)$q->correct_answer)));
                    @endphp
                    <div class="review-q-card {{ $isCorrect ? 'is-correct-card' : 'is-wrong-card' }}" data-status="{{ $isCorrect ? 'correct' : 'wrong' }}">
                        <div class="review-q-meta">
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <span style="font-weight: 800; font-size: 14px; color: var(--text-1);">#{{ $index + 1 }}</span>
                                @if($q->dimension)
                                    <span style="background: #eff6ff; color: #1d4ed8; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 6px; text-transform: capitalize;">
                                        {{ str_replace('-', ' ', $q->dimension->slug) }}
                                    </span>
                                @endif
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

                        @if(!empty($q->question_images) && is_array($q->question_images))
                            <div style="display: flex; gap: 10px; margin-bottom: 14px; flex-wrap: wrap;">
                                @foreach($q->question_images as $img)
                                    <img src="{{ asset($img) }}" alt="Question visual" style="max-height: 140px; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; padding: 4px;">
                                @endforeach
                            </div>
                        @endif

                        @if(!empty($q->options) && is_array($q->options))
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 8px; margin-bottom: 14px;">
                                @foreach($q->options as $optKey => $optVal)
                                    @php
                                        $isThisSelected = (trim(strtolower((string)$userAns)) === trim(strtolower((string)$optVal)) || trim(strtolower((string)$userAns)) === trim(strtolower((string)$optKey)));
                                        $isThisCorrect = (trim(strtolower((string)$q->correct_answer)) === trim(strtolower((string)$optVal)) || trim(strtolower((string)$q->correct_answer)) === trim(strtolower((string)$optKey)));
                                    @endphp
                                    <div style="padding: 9px 12px; border-radius: 8px; font-size: 13px; border: 1.5px solid {{ $isThisCorrect ? '#10b981' : ($isThisSelected ? '#ef4444' : '#e2e8f0') }}; background: {{ $isThisCorrect ? '#ecfdf5' : ($isThisSelected ? '#fef2f2' : '#ffffff') }}; color: {{ $isThisCorrect ? '#065f46' : ($isThisSelected ? '#991b1b' : 'var(--text-1)') }}; display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                        <span><strong>{{ is_string($optKey) && strlen($optKey) <= 2 ? $optKey . '. ' : '' }}</strong>{{ $optVal }}</span>
                                        @if($isThisCorrect)
                                            <span style="font-size: 10px; background: #10b981; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800;">CORRECT</span>
                                        @elseif($isThisSelected)
                                            <span style="font-size: 10px; background: #ef4444; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800;">YOUR CHOICE</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="review-answer-comparison">
                            <div class="review-ans-box {{ $isCorrect ? 'user-chosen-correct' : 'user-chosen-wrong' }}">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: {{ $isCorrect ? '#15803d' : '#991b1b' }};">
                                    Your Submitted Choice:
                                </span>
                                <span style="font-size: 14.5px; font-weight: 700; color: {{ $isCorrect ? '#15803d' : '#991b1b' }};">
                                    {{ $userAns !== 'N/A' ? $userAns : 'Not Answered / Skipped' }}
                                </span>
                            </div>
                            <div class="review-ans-box official-correct">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #166534;">
                                    <i class="fa-solid fa-circle-check"></i> Official Correct Answer:
                                </span>
                                <span style="font-size: 14.5px; font-weight: 700; color: #166534;">
                                    {{ $q->correct_answer }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                    <p style="font-size: 13px; color: var(--text-2); line-height: 1.5; margin: 0 0 16px; flex: 1;">Search 90,000+ colleges across India offering degree courses matching your aptitude profile.</p>
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

        {{-- Single Smart AI Career Guruji Consultation Card --}}
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: var(--radius-xl); padding: 32px 36px; margin-top: 40px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);">
            <div style="display: flex; align-items: center; gap: 18px; max-width: 680px;">
                <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ffffff; flex-shrink: 0; box-shadow: 0 4px 16px rgba(59, 130, 246, 0.4);">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 6px 0; font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800; color: #ffffff;">
                        Need Personal Guidance on These Results?
                    </h4>
                    <p style="margin: 0; font-size: 14px; color: #cbd5e1; line-height: 1.5;">
                        AI Career Guruji has analyzed your 7 cognitive dimensions. Ask about top degrees, entrance examinations, or a customized career roadmap matching your strengths.
                    </p>
                </div>
            </div>
            <button type="button" onclick="window.openAiChatWithQuery && window.openAiChatWithQuery('Based on my aptitude test results, which careers, streams, and skills do you recommend for me?')" style="background: #2563eb; color: #ffffff; padding: 14px 26px; border-radius: 10px; font-size: 14.5px; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-comment-dots"></i> Ask AI About My Scores
            </button>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Answersheet visibility smoothly
        window.toggleAnswersheet = function() {
            const sheet = document.getElementById('answersheet');
            const btn = document.getElementById('toggleReviewBtn');
            if (sheet.style.display === 'none') {
                sheet.style.display = 'block';
                if (btn) btn.classList.add('is-active');
                sheet.scrollIntoView({ behavior: 'smooth' });
            } else {
                sheet.style.display = 'none';
                if (btn) btn.classList.remove('is-active');
            }
        };

        // Filter Questions in Answersheet
        window.filterAptitudeReview = function(status, btn) {
            document.querySelectorAll('.review-filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('#aptitudeQuestionsReviewList .review-q-card');
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
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

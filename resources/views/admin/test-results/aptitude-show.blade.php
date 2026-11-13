@extends('admin.layout')

@section('title', 'Aptitude Test Report - ' . $session->candidate_name)
@section('page_title', 'Aptitude Assessment Details')

@section('styles')
<style>
  .report-top-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 28px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
  }

  .candidate-info h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 6px;
  }

  .candidate-meta {
    display: flex;
    gap: 16px;
    font-size: 13.5px;
    color: var(--admin-text-2);
    flex-wrap: wrap;
  }

  .candidate-meta span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* AI Performance Analysis Card */
  .ai-performance-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 60%, #172554 100%);
    color: #ffffff;
    border-radius: var(--admin-radius-lg);
    padding: 30px;
    margin-bottom: 28px;
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.25);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .ai-performance-card::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 260px;
    height: 260px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .ai-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(37, 99, 235, 0.25);
    border: 1px solid rgba(96, 165, 250, 0.4);
    color: #93c5fd;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 12px;
  }

  .ai-archetype-title {
    font-family: 'Outfit', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .ai-archetype-sub {
    font-size: 14.5px;
    color: #cbd5e1;
    margin: 0 0 20px 0;
    font-weight: 500;
  }

  .ai-stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
  }

  .ai-stat-box {
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    padding: 14px 18px;
    backdrop-filter: blur(8px);
  }

  .ai-stat-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    font-weight: 700;
    margin-bottom: 4px;
  }

  .ai-stat-val {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #ffffff;
  }

  .ai-narrative-box {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    padding: 20px;
    line-height: 1.7;
    font-size: 14.5px;
    color: #e2e8f0;
    margin-bottom: 24px;
  }

  .ai-section-title {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ai-grid-2col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 24px;
  }
  @media (max-width: 850px) {
    .ai-grid-2col { grid-template-columns: 1fr; }
  }

  .ai-sub-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 18px;
  }

  .scores-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 18px;
    margin-bottom: 28px;
  }

  .score-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    position: relative;
    overflow: hidden;
  }

  .score-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }

  .dimension-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--admin-text-1);
  }

  .score-val {
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #2563eb;
  }

  .score-meter {
    height: 8px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 8px;
  }

  .score-fill {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, #3b82f6, #2563eb);
    transition: width 0.5s ease-in-out;
  }

  .score-fill.high { background: linear-gradient(90deg, #10b981, #059669); }
  .score-fill.medium { background: linear-gradient(90deg, #f59e0b, #d97706); }

  .two-col-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 28px;
  }
  @media (max-width: 900px) {
    .two-col-layout { grid-template-columns: 1fr; }
  }

  .section-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 24px;
  }

  .section-title {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--admin-border);
  }

  .career-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
  }
  .career-item-row:last-child { border-bottom: none; }

  .career-name {
    font-weight: 700;
    font-size: 15px;
    color: var(--admin-text-1);
    margin-bottom: 2px;
  }

  .career-cat {
    font-size: 12px;
    color: var(--admin-text-3);
  }

  .match-pill {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    background: #ecfdf5;
    color: #047857;
    white-space: nowrap;
  }

  /* Answersheet Styles */
  .answersheet-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 28px;
    margin-top: 28px;
  }

  .q-filter-btn {
    padding: 7px 16px;
    border-radius: 20px;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-2);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .q-filter-btn.active {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
  }

  .answer-card-item {
    border: 1.5px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 20px;
    margin-bottom: 18px;
    background: #ffffff;
    transition: all 0.2s;
  }

  .answer-card-item.is-correct {
    border-color: #86efac;
    background: #fafdfb;
  }

  .answer-card-item.is-wrong {
    border-color: #fca5a5;
    background: #fffdfd;
  }

  .status-badge-res {
    font-size: 12px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .status-badge-res.correct {
    background: #dcfce7;
    color: #166534;
  }

  .status-badge-res.wrong {
    background: #fee2e2;
    color: #991b1b;
  }

  .options-grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 12px;
    margin: 14px 0;
  }

  .opt-choice-card {
    border-radius: 8px;
    padding: 12px 14px;
    transition: all 0.2s ease;
  }

  @media print {
    .admin-sidebar, .admin-topbar, .btn-no-print {
      display: none !important;
    }
    .admin-main {
      margin-left: 0 !important;
      width: 100% !important;
    }
  }
</style>
@endsection

@section('content')

<!-- Back Link -->
<div style="margin-bottom: 18px;" class="btn-no-print">
  <a href="{{ route('admin.test-results.index', ['tab' => 'aptitude']) }}" style="color: var(--admin-text-2); text-decoration: none; font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
    <i class="fa-solid fa-arrow-left"></i> Back to Assessment Results
  </a>
</div>

<!-- Header Card -->
<div class="report-top-card">
  <div class="candidate-info">
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
      <span style="background: #ecfdf5; color: #047857; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase;">
        <i class="fa-solid fa-brain"></i> Aptitude Test
      </span>
      <span style="font-size: 12px; color: var(--admin-text-3);">UUID: {{ $session->uuid }}</span>
    </div>
    <h2>{{ $session->candidate_name }}</h2>
    <div class="candidate-meta">
      <span><i class="fa-solid fa-envelope"></i> {{ $session->candidate_email }}</span>
      @if($session->user)
        <span><i class="fa-solid fa-user-check" style="color: #10b981;"></i> Registered Member (ID #{{ $session->user->id }})</span>
        <a href="{{ route('admin.test-results.user', $session->user->id) }}" style="color: #2563eb; text-decoration: underline; font-weight: 600;">View Candidate Dossier</a>
      @else
        <span><i class="fa-solid fa-user-clock"></i> Guest Submission</span>
      @endif
      <span><i class="fa-solid fa-calendar-day"></i> {{ $session->created_at->format('d M, Y \a\t h:i A') }}</span>
    </div>
  </div>

  <div class="btn-no-print" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    <a href="#answersheetSection" class="action-btn-sm" style="background: #2563eb; color: #ffffff; padding: 10px 16px; border-radius: 6px; font-weight: 700; text-decoration: none;">
      <i class="fa-solid fa-list-check"></i> Inspect Answersheet
    </a>
    <button onclick="window.print()" class="action-btn-sm" style="background: #f1f5f9; color: #1e293b; padding: 10px 16px; border: 1px solid #cbd5e1; cursor: pointer; border-radius: 6px; font-weight: 600;">
      <i class="fa-solid fa-print"></i> Print Report
    </button>
    <a href="{{ route('test.results', $session->uuid) }}" target="_blank" class="action-btn-sm btn-view-report" style="padding: 10px 16px; border-radius: 6px;">
      <i class="fa-solid fa-arrow-up-right-from-square"></i> Student View
    </a>
    <form action="{{ route('admin.test-results.aptitude.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this aptitude test report?');" style="display: inline;">
      @csrf
      @method('DELETE')
      <input type="hidden" name="redirect_to" value="index">
      <button type="submit" style="background: #fff; color: #dc2626; border: 1px solid #fecaca; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">
        <i class="fa-solid fa-trash"></i> Delete Record
      </button>
    </form>
  </div>
</div>

@if(isset($aiAnalysis))
  <!-- AI Cognitive Performance & Archetype Card -->
  <div class="ai-performance-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 14px; margin-bottom: 12px;">
      <div>
        <div class="ai-badge-pill">
          <i class="{{ $aiAnalysis['archetype_icon'] ?? 'fa-solid fa-brain' }}"></i>
          {{ $aiAnalysis['archetype_badge'] ?? 'Cognitive Talent Profile' }}
        </div>
        <h2 class="ai-archetype-title">
          {{ $aiAnalysis['archetype_title'] }}
        </h2>
        <p class="ai-archetype-sub">
          {{ $aiAnalysis['archetype_subtitle'] }}
        </p>
      </div>

      <div style="text-align: right;">
        <span style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 700; display: block; margin-bottom: 2px;">Readiness Grade</span>
        <span style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: #38bdf8;">
          {{ $aiAnalysis['readiness_grade'] ?? 'A (Proficient)' }}
        </span>
      </div>
    </div>

    <!-- Quick Stats Metric Boxes -->
    <div class="ai-stats-row">
      <div class="ai-stat-box">
        <div class="ai-stat-label">Cognitive Index</div>
        <div class="ai-stat-val" style="color: #60a5fa;">{{ $aiAnalysis['overall_score'] ?? '0' }}/10</div>
      </div>
      <div class="ai-stat-box">
        <div class="ai-stat-label">Accuracy Rate</div>
        <div class="ai-stat-val" style="color: #34d399;">{{ $aiAnalysis['accuracy_percentage'] ?? '0' }}%</div>
      </div>
      <div class="ai-stat-box">
        <div class="ai-stat-label">Correct Answers</div>
        <div class="ai-stat-val" style="color: #facc15;">{{ $aiAnalysis['correct_count'] ?? 0 }} / {{ $aiAnalysis['total_questions'] ?? 0 }}</div>
      </div>
      <div class="ai-stat-box">
        <div class="ai-stat-label">AI Engine</div>
        <div class="ai-stat-val" style="font-size: 14px; color: #cbd5e1; margin-top: 4px;">Heuristic 7-Dim Logic</div>
      </div>
    </div>

    <!-- Executive Summary -->
    <div class="ai-narrative-box">
      <div style="font-weight: 700; color: #93c5fd; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; font-size: 13.5px; text-transform: uppercase; letter-spacing: 0.5px;">
        <i class="fa-solid fa-sparkles"></i> AI Executive Synthesis:
      </div>
      {{ $aiAnalysis['executive_summary'] }}
    </div>

    <!-- Strengths & Growth Areas Grid -->
    <div class="ai-grid-2col">
      <!-- Standout Strengths -->
      <div class="ai-sub-card">
        <div class="ai-section-title" style="color: #34d399;">
          <i class="fa-solid fa-circle-check"></i> Standout Cognitive Strengths
        </div>
        @foreach($aiAnalysis['strengths'] ?? [] as $st)
          <div style="margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px dashed rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 14px; color: #ffffff; margin-bottom: 3px;">
              <span><i class="{{ $st['icon'] ?? 'fa-solid fa-check' }}" style="color: {{ $st['color'] ?? '#34d399' }}; margin-right: 6px;"></i> {{ $st['label'] ?? '' }}: {{ $st['headline'] ?? '' }}</span>
              <span style="color: #34d399; font-weight: 800;">{{ $st['score'] ?? 0 }}/10</span>
            </div>
            <div style="font-size: 13px; color: #cbd5e1; line-height: 1.5; margin-bottom: 4px;">{{ $st['description'] ?? '' }}</div>
            <div style="font-size: 12px; color: #93c5fd;"><i class="fa-solid fa-briefcase"></i> <strong>Workplace Application:</strong> {{ $st['real_world'] ?? '' }}</div>
          </div>
        @endforeach
      </div>

      <!-- Growth Areas & Drills -->
      <div class="ai-sub-card">
        <div class="ai-section-title" style="color: #f59e0b;">
          <i class="fa-solid fa-arrow-trend-up"></i> Priority Growth Areas & Drills
        </div>
        @foreach($aiAnalysis['growth_areas'] ?? [] as $ga)
          <div style="margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px dashed rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 14px; color: #ffffff; margin-bottom: 3px;">
              <span><i class="fa-solid fa-crosshairs" style="color: #f59e0b; margin-right: 6px;"></i> {{ $ga['label'] ?? '' }}</span>
              <span style="color: #f59e0b; font-weight: 800;">{{ $ga['score'] ?? 0 }}/10</span>
            </div>
            <div style="font-size: 13px; color: #cbd5e1; line-height: 1.5; margin-bottom: 4px;">{{ $ga['observation'] ?? '' }}</div>
            <div style="font-size: 12.5px; color: #fed7aa; margin-bottom: 4px;"><i class="fa-solid fa-dumbbell"></i> <strong>Coaching:</strong> {{ $ga['coaching'] ?? '' }}</div>
            @if(!empty($ga['drills']))
              <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 6px;">
                @foreach($ga['drills'] as $drill)
                  <span style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); color: #fef3c7; font-size: 11px; padding: 2px 8px; border-radius: 4px;">
                    {{ $drill }}
                  </span>
                @endforeach
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>

    <!-- Academic Stream & Competitive Exam Alignment -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 24px;">
      <div class="ai-sub-card">
        <div class="ai-section-title" style="color: #60a5fa;">
          <i class="fa-solid fa-graduation-cap"></i> Academic Stream Alignment
        </div>
        @if(!empty($aiAnalysis['stream_fit']))
          @php $sf = $aiAnalysis['stream_fit']; @endphp
          <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; font-size: 14px; color: #ffffff;">{{ $sf['primary'] ?? 'Recommended Stream' }}</span>
              <span style="background: rgba(59, 130, 246, 0.25); border: 1px solid rgba(59, 130, 246, 0.5); color: #93c5fd; padding: 3px 10px; border-radius: 6px; font-weight: 800; font-size: 12.5px;">
                {{ $sf['fit_percentage'] ?? 90 }}% Fit
              </span>
            </div>
            <div style="font-size: 12.5px; color: #cbd5e1; line-height: 1.5; margin-bottom: 6px;">{{ $sf['rationale'] ?? '' }}</div>
            @if(!empty($sf['secondary']))
              <div style="font-size: 12px; color: #93c5fd;"><strong>Secondary Pathway:</strong> {{ $sf['secondary'] }}</div>
            @endif
          </div>
        @endif
      </div>

      <div class="ai-sub-card">
        <div class="ai-section-title" style="color: #c084fc;">
          <i class="fa-solid fa-bullseye"></i> Target Competitive Exams
        </div>
        @foreach($aiAnalysis['target_exams'] ?? [] as $te)
          <div style="margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px dashed rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;">
              <span style="font-weight: 700; font-size: 13.5px; color: #ffffff;">{{ $te['name'] ?? '' }}</span>
              <span style="background: rgba(168, 85, 247, 0.2); border: 1px solid rgba(168, 85, 247, 0.4); color: #e9d5ff; padding: 2px 8px; border-radius: 4px; font-weight: 700; font-size: 11px;">
                {{ $te['badge'] ?? 'Match' }}
              </span>
            </div>
            <div style="font-size: 12px; color: #cbd5e1;">{{ $te['desc'] ?? '' }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- 90-Day Action Roadmap -->
    @if(!empty($aiAnalysis['roadmap_90_days']))
      <div class="ai-sub-card" style="margin-bottom: 24px;">
        <div class="ai-section-title" style="color: #38bdf8;">
          <i class="fa-solid fa-route"></i> 90-Day Strategic Development Roadmap
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px;">
          @foreach($aiAnalysis['roadmap_90_days'] as $phase)
            <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 8px; padding: 14px;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; text-transform: uppercase; font-weight: 800; color: #38bdf8; letter-spacing: 0.5px;">{{ $phase['period'] ?? '' }}</span>
                <span style="background: rgba(56, 189, 248, 0.2); color: #7dd3fc; font-size: 10.5px; font-weight: 700; padding: 1px 6px; border-radius: 4px;">{{ $phase['badge'] ?? '' }}</span>
              </div>
              <div style="font-weight: 700; font-size: 13.5px; color: #ffffff; margin-bottom: 8px;">
                <i class="{{ $phase['icon'] ?? 'fa-solid fa-flag' }}" style="margin-right: 4px; color: #38bdf8;"></i> {{ $phase['title'] ?? '' }}
              </div>
              <ul style="margin: 0; padding-left: 18px; font-size: 12px; color: #cbd5e1; line-height: 1.5;">
                @foreach($phase['action_items'] ?? [] as $ai)
                  <li style="margin-bottom: 4px;">{{ $ai }}</li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <!-- Counselor Guidance Notes -->
    @if(!empty($aiAnalysis['counselor_notes']))
      <div style="background: rgba(255, 255, 255, 0.04); border-left: 4px solid #38bdf8; padding: 14px 18px; border-radius: 6px; font-size: 13.5px; color: #e2e8f0; line-height: 1.6;">
        <span style="font-weight: 700; color: #38bdf8; display: block; margin-bottom: 4px;"><i class="fa-solid fa-user-tie"></i> Guidance Counselor Memo:</span>
        {{ $aiAnalysis['counselor_notes'] }}
      </div>
    @endif
  </div>
@endif

<!-- 7 Aptitude Dimensions Grid -->
<h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 700; color: var(--admin-text-1); margin-bottom: 16px;">
  <i class="fa-solid fa-chart-simple" style="color: #3b82f6;"></i> Aptitude Dimension Breakdown (Out of 10)
</h3>

<div class="scores-grid">
  @php
    $dimScores = $session->aptitude_scores ?? [];
    $dimensionLabels = [
      'numerical-aptitude' => 'Numerical Aptitude',
      'verbal-reasoning' => 'Verbal Reasoning',
      'abstract-reasoning' => 'Abstract Reasoning',
      'mechanical-reasoning' => 'Mechanical Reasoning',
      'spatial-aptitude' => 'Spatial Aptitude',
      'language-aptitude' => 'Language Aptitude',
      'perceptual-aptitude' => 'Perceptual Aptitude'
    ];
  @endphp

  @foreach($dimScores as $key => $score)
    @php
      $num = (float) $score;
      $fillClass = $num >= 7.5 ? 'high' : ($num >= 5.0 ? 'medium' : '');
      $pct = min(100, $num * 10);
      $label = $dimensionLabels[$key] ?? ucwords(str_replace('-', ' ', $key));
    @endphp
    <div class="score-card">
      <div class="score-header">
        <span class="dimension-title">{{ $label }}</span>
        <span class="score-val">{{ $score }}/10</span>
      </div>
      <div class="score-meter">
        <div class="score-fill {{ $fillClass }}" style="width: {{ $pct }}%;"></div>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 11px; color: var(--admin-text-3); font-weight: 600;">
        <span>{{ $num >= 7.5 ? 'Strong Strength' : ($num >= 5.0 ? 'Moderate' : 'Developing') }}</span>
        <span>{{ $pct }}%</span>
      </div>
    </div>
  @endforeach
</div>

<!-- Recommendations Layout -->
<div class="two-col-layout">
  <!-- Recommended Careers -->
  <div class="section-card">
    <div class="section-title">
      <i class="fa-solid fa-briefcase" style="color: #059669;"></i>
      <span>Algorithmic Recommended Careers ({{ $careers->count() }})</span>
    </div>

    @forelse($careers as $career)
      @php
        $match = $recommendedIds[$career->id] ?? null;
      @endphp
      <div class="career-item-row">
        <div>
          <div class="career-name">
            <a href="{{ route('explore.career', $career->id) }}" target="_blank" style="color: inherit; text-decoration: none;">
              {{ $career->name }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px; color: #94a3b8;"></i>
            </a>
          </div>
          <div class="career-cat">
            {{ $career->field->name ?? 'General' }}
          </div>
        </div>
        @if($match !== null)
          <div class="match-pill">{{ $match }}% Match</div>
        @endif
      </div>
    @empty
      <p style="color: var(--admin-text-3); font-size: 14px;">No recommended careers calculated for this session.</p>
    @endforelse
  </div>

  <!-- Recommended Fields & Profile Info -->
  <div class="section-card">
    <div class="section-title">
      <i class="fa-solid fa-shapes" style="color: #6366f1;"></i>
      <span>Recommended Career Fields</span>
    </div>

    @forelse($fields as $field)
      @php
        $fieldScore = $recommendedFields[$field->id] ?? null;
      @endphp
      <div class="career-item-row">
        <div>
          <div class="career-name">{{ $field->name }}</div>
          <div class="career-cat">{{ $field->careers_count ?? $field->careers()->count() }} available paths</div>
        </div>
        @if($fieldScore !== null)
          <span style="font-size: 13px; font-weight: 700; color: #4f46e5;">Score: {{ $fieldScore }}</span>
        @endif
      </div>
    @empty
      <p style="color: var(--admin-text-3); font-size: 14px;">No specific fields mapped.</p>
    @endforelse

    @if(!empty($session->user_inputs))
      <div class="section-title" style="margin-top: 30px;">
        <i class="fa-solid fa-id-card" style="color: #d97706;"></i>
        <span>Submitted Profile Inputs</span>
      </div>

      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; font-size: 13px;">
        @foreach($session->user_inputs as $k => $v)
          @if(!in_array($k, ['answers', 'raw_scores', 'ai_analysis']))
            <div style="display: flex; justify-content: space-between; margin-bottom: 6px; border-bottom: 1px dashed #e2e8f0; padding-bottom: 4px;">
              <span style="font-weight: 600; color: #475569;">{{ ucwords(str_replace('_', ' ', $k)) }}:</span>
              <span style="color: #0f172a;">{{ is_array($v) ? implode(', ', $v) : $v }}</span>
            </div>
          @endif
        @endforeach
      </div>
    @endif
  </div>
</div>

@php
  $userAnswers = $session->user_inputs['answers'] ?? [];
  $rawScores = $session->user_inputs['raw_scores'] ?? [];
  $answeredQuestions = [];
  $letters = ['A', 'B', 'C', 'D'];
  $correctCount = 0;
  $wrongCount = 0;

  if (!empty($userAnswers)) {
      foreach ($userAnswers as $qId => $uAns) {
          $q = $questions[$qId] ?? \App\Models\Question::with('dimension')->find($qId);
          if (!$q) continue;

          $isCorr = (trim(strtolower((string)$uAns)) === trim(strtolower((string)$q->correct_answer)));
          if (!$isCorr && is_array($q->options)) {
              foreach ($q->options as $idx => $opt) {
                  $letter = $letters[$idx] ?? chr(65 + $idx);
                  if (trim(strtoupper((string)$uAns)) === $letter && trim(strtolower((string)$opt)) === trim(strtolower((string)$q->correct_answer))) {
                      $isCorr = true;
                      break;
                  }
              }
          }

          if ($isCorr) {
              $correctCount++;
          } else {
              $wrongCount++;
          }

          $answeredQuestions[] = [
              'question' => $q,
              'userAnswer' => $uAns,
              'isCorrect' => $isCorr
          ];
      }
  }

  $totalAnswered = count($answeredQuestions);
  $accuracyPct = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100) : 0;
@endphp

<!-- Detailed Question & Answersheet Review Section -->
<div class="answersheet-card" id="answersheetSection">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 22px; padding-bottom: 16px; border-bottom: 1px solid var(--admin-border);">
    <div>
      <h3 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: var(--admin-text-1); margin: 0 0 4px 0; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-list-check" style="color: #2563eb;"></i>
        Detailed Questions & Answersheet Review
      </h3>
      <p style="margin: 0; font-size: 13.5px; color: var(--admin-text-2);">
        Candidate's submitted answers evaluated against official correct options across all dimensions.
      </p>
    </div>

    <!-- Quick Stats -->
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
      <div style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700;">
        Total Answered: {{ $totalAnswered }}
      </div>
      <div style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700;">
        <i class="fa-solid fa-check"></i> Correct: {{ $correctCount }}
      </div>
      <div style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700;">
        <i class="fa-solid fa-xmark"></i> Incorrect: {{ $wrongCount }}
      </div>
      <div style="background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700;">
        Accuracy: {{ $accuracyPct }}%
      </div>
    </div>
  </div>

  @if($totalAnswered > 0)
    <!-- Filter Pills -->
    <div style="display: flex; gap: 8px; margin-bottom: 20px;" class="btn-no-print">
      <button type="button" class="q-filter-btn active" onclick="filterAptitudeAnswers('all', this)">
        All Questions ({{ $totalAnswered }})
      </button>
      <button type="button" class="q-filter-btn" onclick="filterAptitudeAnswers('correct', this)">
        <i class="fa-solid fa-check" style="color: #10b981;"></i> Correct ({{ $correctCount }})
      </button>
      <button type="button" class="q-filter-btn" onclick="filterAptitudeAnswers('wrong', this)">
        <i class="fa-solid fa-xmark" style="color: #ef4444;"></i> Incorrect ({{ $wrongCount }})
      </button>
    </div>

    <div id="aptitudeQuestionsList">
      @foreach($answeredQuestions as $idx => $item)
        @php
          $q = $item['question'];
          $uAns = $item['userAnswer'];
          $isCorr = $item['isCorrect'];
        @endphp
        <div class="answer-card-item {{ $isCorr ? 'is-correct' : 'is-wrong' }}" data-status="{{ $isCorr ? 'correct' : 'wrong' }}">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 12px;">
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              <span style="font-weight: 800; font-size: 14.5px; color: var(--admin-text-1);">
                #{{ $idx + 1 }}
              </span>
              @if($q->dimension)
                <span style="background: #e0e7ff; color: #3730a3; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">
                  {{ $q->dimension->name }}
                </span>
              @endif
              <span style="font-size: 11.5px; color: var(--admin-text-3);">Question ID: #{{ $q->id }}</span>
            </div>
            <div>
              @if($isCorr)
                <span class="status-badge-res correct">
                  <i class="fa-solid fa-circle-check"></i> Correct
                </span>
              @else
                <span class="status-badge-res wrong">
                  <i class="fa-solid fa-circle-xmark"></i> Incorrect
                </span>
              @endif
            </div>
          </div>

          <!-- Question Text -->
          <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 12px; line-height: 1.55;">
            {{ $q->question_text }}
          </div>

          <!-- Question Figures / Images (if any) -->
          @if(!empty($q->question_images) && is_array($q->question_images))
            <div style="display: flex; gap: 12px; margin: 12px 0 16px; flex-wrap: wrap;">
              @foreach($q->question_images as $img)
                <div style="background: #ffffff; padding: 8px; border: 1.5px solid #cbd5e1; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                  <img src="{{ asset($img) }}" alt="Question Figure" style="max-height: 160px; max-width: 100%; object-fit: contain; border-radius: 4px; display: block;">
                </div>
              @endforeach
            </div>
          @endif

          <!-- All 4 Options Grid with Inspection Highlighting -->
          @if(!empty($q->options) && is_array($q->options))
            <div style="margin: 14px 0;">
              <span style="font-size: 11.5px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                Options & Selections:
              </span>
              <div class="options-grid-view">
                @foreach($q->options as $optIdx => $optVal)
                  @php
                    $optLetter = $letters[$optIdx] ?? chr(65 + $optIdx);
                    
                    $isImgOpt = ($q->options_type === 'image') || 
                                preg_match('/\.(png|jpe?g|gif|svg|webp)$/i', (string)$optVal) || 
                                str_starts_with((string)$optVal, 'abstract/') || 
                                str_starts_with((string)$optVal, 'spatial/') || 
                                str_starts_with((string)$optVal, 'mechanical/');
                    
                    $isStudentChoice = (trim(strtolower((string)$uAns)) === trim(strtolower((string)$optVal))) ||
                                       (trim(strtoupper((string)$uAns)) === $optLetter) ||
                                       ((string)$uAns === (string)$optIdx);

                    $isOfficialAnswer = (trim(strtolower((string)$optVal)) === trim(strtolower((string)$q->correct_answer))) ||
                                        (trim(strtoupper((string)$q->correct_answer)) === $optLetter);
                  @endphp

                  <div class="opt-choice-card"
                       style="border: 1.5px solid {{ $isStudentChoice ? ($isCorr ? '#10b981' : '#ef4444') : ($isOfficialAnswer ? '#10b981' : '#e2e8f0') }}; background: {{ $isStudentChoice ? ($isCorr ? '#f0fdf4' : '#fef2f2') : ($isOfficialAnswer ? '#f0fdf4' : '#ffffff') }}; box-shadow: {{ $isStudentChoice ? ($isCorr ? '0 0 0 1px #10b981' : '0 0 0 1px #ef4444') : 'none' }};">
                    
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; gap: 8px;">
                      <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; font-size: 11.5px; font-weight: 800; background: {{ $isStudentChoice ? ($isCorr ? '#10b981' : '#ef4444') : ($isOfficialAnswer ? '#10b981' : '#f1f5f9') }}; color: {{ ($isStudentChoice || $isOfficialAnswer) ? '#ffffff' : '#475569' }}; flex-shrink: 0;">
                        {{ $optLetter }}
                      </span>

                      @if($isStudentChoice && $isCorr)
                        <span style="font-size: 11px; font-weight: 700; color: #15803d; background: #dcfce7; padding: 2px 8px; border-radius: 4px; white-space: nowrap;">
                          <i class="fa-solid fa-check"></i> Candidate Pick (Correct)
                        </span>
                      @elseif($isStudentChoice && !$isCorr)
                        <span style="font-size: 11px; font-weight: 700; color: #b91c1c; background: #fee2e2; padding: 2px 8px; border-radius: 4px; white-space: nowrap;">
                          <i class="fa-solid fa-xmark"></i> Candidate Pick (Wrong)
                        </span>
                      @elseif($isOfficialAnswer)
                        <span style="font-size: 11px; font-weight: 700; color: #15803d; background: #dcfce7; padding: 2px 8px; border-radius: 4px; white-space: nowrap;">
                          <i class="fa-solid fa-circle-check"></i> Correct Answer
                        </span>
                      @endif
                    </div>

                    <div style="font-size: 13.5px; font-weight: 600; color: #1e293b; padding-left: 2px;">
                      @if($isImgOpt)
                        <img src="{{ asset($optVal) }}" alt="Option {{ $optLetter }}" style="max-height: 90px; max-width: 100%; object-fit: contain; border-radius: 4px; display: block; margin-top: 4px; border: 1px solid #cbd5e1; background: #fff; padding: 4px;">
                      @else
                        <span>{{ $optVal }}</span>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Comparison Footer Box -->
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 12px; margin-top: 12px;">
            <div>
              <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Candidate's Choice:</span>
              @php
                $isUserAnsImg = preg_match('/\.(png|jpe?g|gif|svg|webp)$/i', (string)$uAns) || str_starts_with((string)$uAns, 'abstract/') || str_starts_with((string)$uAns, 'spatial/');
              @endphp
              @if($isUserAnsImg)
                <img src="{{ asset($uAns) }}" alt="Candidate Choice" style="max-height: 80px; border-radius: 4px; border: 1.5px solid {{ $isCorr ? '#86efac' : '#fca5a5' }}; background: #fff; padding: 4px;">
              @else
                <span style="font-size: 14px; font-weight: 700; color: {{ $isCorr ? '#166534' : '#991b1b' }};">
                  {{ $uAns }}
                </span>
              @endif
            </div>
            <div>
              <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Official Correct Answer:</span>
              @php
                $isCorrAnsImg = preg_match('/\.(png|jpe?g|gif|svg|webp)$/i', (string)$q->correct_answer) || str_starts_with((string)$q->correct_answer, 'abstract/') || str_starts_with((string)$q->correct_answer, 'spatial/');
              @endphp
              @if($isCorrAnsImg)
                <img src="{{ asset($q->correct_answer) }}" alt="Correct Answer" style="max-height: 80px; border-radius: 4px; border: 1.5px solid #86efac; background: #fff; padding: 4px;">
              @else
                <span style="font-size: 14px; font-weight: 700; color: #166534;">
                  <i class="fa-solid fa-check"></i> {{ $q->correct_answer }}
                </span>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <!-- Fallback for legacy session where individual answers were not recorded -->
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 32px 24px; text-align: center;">
      <i class="fa-solid fa-clipboard-check" style="font-size: 42px; color: #64748b; margin-bottom: 14px; opacity: 0.6;"></i>
      <h4 style="font-family: 'Outfit', sans-serif; font-size: 17px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">
        Aggregate Dimension Scoring Available
      </h4>
      <p style="font-size: 13.5px; color: #64748b; max-width: 600px; margin: 0 auto 20px auto; line-height: 1.5;">
        This assessment was submitted using aggregate raw scoring per dimension. Individual multiple-choice selections were calculated directly into dimension score totals.
      </p>

      @if(!empty($rawScores))
        <div style="max-width: 500px; margin: 0 auto; text-align: left; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; overflow: hidden;">
          <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
              <tr style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                <th style="padding: 10px 14px; font-weight: 700; color: #475569;">Dimension</th>
                <th style="padding: 10px 14px; text-align: right; font-weight: 700; color: #475569;">Score Breakdown</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rawScores as $dim => $data)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                  <td style="padding: 10px 14px; font-weight: 600; color: #1e293b; text-transform: capitalize;">
                    {{ str_replace('-', ' ', $dim) }}
                  </td>
                  <td style="padding: 10px 14px; text-align: right; font-weight: 700; color: #2563eb;">
                    {{ $data['correct'] ?? 0 }} / {{ $data['total'] ?? 0 }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  @endif
</div>

<script>
function filterAptitudeAnswers(status, btn) {
  document.querySelectorAll('.q-filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const items = document.querySelectorAll('#aptitudeQuestionsList .answer-card-item');
  items.forEach(item => {
    if (status === 'all' || item.dataset.status === status) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}
</script>

@endsection

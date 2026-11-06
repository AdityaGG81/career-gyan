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
    grid-template-columns: 1.2fr 0.8fr;
    gap: 24px;
    margin-bottom: 28px;
  }

  @media(max-width: 900px) {
    .two-col-layout {
      grid-template-columns: 1fr;
    }
  }

  .section-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 26px;
  }

  .section-title {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--admin-border);
  }

  .career-item-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    margin-bottom: 12px;
    background: #fafafa;
    transition: all 0.2s;
  }

  .career-item-row:hover {
    background: #ffffff;
    border-color: #3b82f6;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08);
  }

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
    padding: 26px;
    margin-top: 28px;
  }

  .q-filter-btn {
    padding: 6px 14px;
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
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 16px 20px;
    margin-bottom: 14px;
    transition: all 0.2s;
  }

  .answer-card-item.is-correct {
    background: #f0fdf4;
    border-color: #86efac;
  }

  .answer-card-item.is-wrong {
    background: #fef2f2;
    border-color: #fca5a5;
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

  <div class="btn-no-print" style="display: flex; gap: 10px; align-items: center;">
    <button onclick="window.print()" class="action-btn-sm" style="background: #f1f5f9; color: #1e293b; padding: 10px 16px; border: 1px solid #cbd5e1; cursor: pointer;">
      <i class="fa-solid fa-print"></i> Print Report
    </button>
    <a href="{{ route('test.results', $session->uuid) }}" target="_blank" class="action-btn-sm btn-view-report" style="padding: 10px 16px;">
      <i class="fa-solid fa-arrow-up-right-from-square"></i> Student View
    </a>
  </div>
</div>

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
            <a href="{{ route('career.detail', $career->id) }}" target="_blank" style="color: inherit; text-decoration: none;">
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
          @if(!in_array($k, ['answers', 'raw_scores']))
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
  $correctCount = 0;
  $wrongCount = 0;
  $answeredQuestions = [];

  foreach($questions as $q) {
      if (isset($userAnswers[$q->id])) {
          $uAns = $userAnswers[$q->id];
          $isCorr = (trim(strtolower((string)$uAns)) === trim(strtolower((string)$q->correct_answer)));
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
  $totalAnswered = count($userAnswers);
  $accuracyPct = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100) : 0;
@endphp

<!-- Detailed Question & Answersheet Review -->
<div class="answersheet-card">
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
          <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 10px;">
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
              <span style="font-weight: 800; font-size: 14px; color: var(--admin-text-1);">
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

          <div style="font-size: 14.5px; font-weight: 600; color: #0f172a; margin-bottom: 12px; line-height: 1.5;">
            {{ $q->question_text }}
          </div>

          @if(!empty($q->question_images) && is_array($q->question_images))
            <div style="display: flex; gap: 10px; margin-bottom: 12px; flex-wrap: wrap;">
              @foreach($q->question_images as $img)
                <img src="{{ asset($img) }}" alt="Question Image" style="max-height: 140px; border-radius: 6px; border: 1px solid #cbd5e1;">
              @endforeach
            </div>
          @endif

          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; background: rgba(255, 255, 255, 0.7); border: 1px solid rgba(0,0,0,0.06); border-radius: 8px; padding: 12px;">
            <div>
              <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Candidate's Answer:</span>
              <span style="font-size: 14px; font-weight: 700; color: {{ $isCorr ? '#166534' : '#991b1b' }};">
                {{ $uAns }}
              </span>
            </div>
            <div>
              <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Correct Answer:</span>
              <span style="font-size: 14px; font-weight: 700; color: #166534;">
                <i class="fa-solid fa-check"></i> {{ $q->correct_answer }}
              </span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div style="text-align: center; padding: 36px 20px; color: var(--admin-text-3);">
      <i class="fa-solid fa-clipboard-question" style="font-size: 40px; margin-bottom: 10px; opacity: 0.4;"></i>
      <p style="font-size: 14.5px; margin: 0;">No individual answer selections were recorded for this session (legacy session or custom input format).</p>
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


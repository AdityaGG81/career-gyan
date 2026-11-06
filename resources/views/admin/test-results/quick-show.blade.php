@extends('admin.layout')

@section('title', 'Quick Test Report - ' . ($attempt->student_name ?: 'Candidate #' . $attempt->id))
@section('page_title', 'Quick Stream Assessment Details')

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

  .section-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 26px;
    margin-bottom: 24px;
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

  .scores-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
  }

  .score-card {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 16px 18px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  }

  .score-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .dimension-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--admin-text-1);
  }

  .score-val {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #7c3aed;
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
    background: #7c3aed;
    color: #fff;
    border-color: #7c3aed;
  }

  .answer-card-item {
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 18px 20px;
    margin-bottom: 16px;
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

  .option-pill {
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .option-pill.is-selected {
    border-color: #ef4444;
    background: #fff1f2;
    font-weight: 700;
    color: #991b1b;
  }

  .option-pill.is-correct-target {
    border-color: #10b981;
    background: #ecfdf5;
    font-weight: 700;
    color: #065f46;
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
  <a href="{{ route('admin.test-results.index', ['tab' => 'quick']) }}" style="color: var(--admin-text-2); text-decoration: none; font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
    <i class="fa-solid fa-arrow-left"></i> Back to Assessment Results
  </a>
</div>

<!-- Header Card -->
<div class="report-top-card">
  <div class="candidate-info">
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
      <span style="background: #fdf4ff; color: #a21caf; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase;">
        <i class="fa-solid fa-bolt"></i> Quick Stream Test
      </span>
      <span style="font-size: 12px; color: var(--admin-text-3);">UUID: {{ $attempt->uuid }}</span>
    </div>
    <h2>{{ $attempt->student_name ?: 'Candidate #' . $attempt->id }}</h2>
    <div class="candidate-meta">
      <span><i class="fa-solid fa-envelope"></i> {{ $attempt->student_email ?: 'Anonymous / Not Provided' }}</span>
      <span><i class="fa-solid fa-calendar-day"></i> {{ $attempt->created_at->format('d M, Y \a\t h:i A') }}</span>
      <span><i class="fa-solid fa-award" style="color: #d97706;"></i> Total Score: <strong>{{ $attempt->total_score }} points</strong></span>
    </div>
  </div>

  <div class="btn-no-print" style="display: flex; gap: 10px; align-items: center;">
    <button onclick="window.print()" class="action-btn-sm" style="background: #f1f5f9; color: #1e293b; padding: 10px 16px; border: 1px solid #cbd5e1; cursor: pointer; border-radius: 6px; font-weight: 600;">
      <i class="fa-solid fa-print"></i> Print Report
    </button>
    <a href="{{ route('quick-test.results', $attempt->uuid) }}" target="_blank" class="action-btn-sm" style="background: #7c3aed; color: #fff; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
      <i class="fa-solid fa-arrow-up-right-from-square"></i> Student View
    </a>
    <form action="{{ route('admin.test-results.quick.destroy', $attempt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this quick test record?');" style="display: inline;">
      @csrf
      @method('DELETE')
      <button type="submit" style="background: #fff; color: #dc2626; border: 1px solid #fecaca; padding: 10px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">
        <i class="fa-solid fa-trash"></i>
      </button>
    </form>
  </div>
</div>

@php
  $userAnswers = $attempt->answers ?? [];
  $correctCount = 0;
  $wrongCount = 0;
  $evaluatedQuestions = [];

  foreach($questions as $q) {
      $uAns = $userAnswers[$q->id] ?? null;
      $isCorr = ($uAns !== null && trim(strtoupper((string)$uAns)) === trim(strtoupper((string)$q->correct_option)));
      if ($isCorr) {
          $correctCount++;
      } else {
          $wrongCount++;
      }
      $evaluatedQuestions[] = [
          'question' => $q,
          'userAnswer' => $uAns,
          'isCorrect' => $isCorr
      ];
  }
  $totalCount = count($questions);
  $accuracyPct = $totalCount > 0 ? round(($correctCount / $totalCount) * 100) : 0;
@endphp

<!-- Section Breakdown & KPI Cards -->
<div class="scores-grid">
  @php
    $secScores = $attempt->section_scores ?? [];
  @endphp
  @foreach($secScores as $secName => $score)
    <div class="score-card">
      <div class="score-header">
        <span class="dimension-title">{{ $secName }}</span>
        <span class="score-val">{{ $score }} pts</span>
      </div>
    </div>
  @endforeach
</div>

<!-- Detailed Questions & Answers Review Card -->
<div class="section-card">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 22px; padding-bottom: 16px; border-bottom: 1px solid var(--admin-border);">
    <div>
      <h3 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: var(--admin-text-1); margin: 0 0 4px 0; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-list-check" style="color: #7c3aed;"></i>
        Quick Test Questions & Answersheet Review
      </h3>
      <p style="margin: 0; font-size: 13.5px; color: var(--admin-text-2);">
        Every question answered by the student evaluated against the correct options.
      </p>
    </div>

    <!-- Quick Stats -->
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
      <div style="background: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700;">
        Total Questions: {{ $totalCount }}
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

  <!-- Filter Pills -->
  <div style="display: flex; gap: 8px; margin-bottom: 20px;" class="btn-no-print">
    <button type="button" class="q-filter-btn active" onclick="filterQuickAnswers('all', this)">
      All Questions ({{ $totalCount }})
    </button>
    <button type="button" class="q-filter-btn" onclick="filterQuickAnswers('correct', this)">
      <i class="fa-solid fa-check" style="color: #10b981;"></i> Correct ({{ $correctCount }})
    </button>
    <button type="button" class="q-filter-btn" onclick="filterQuickAnswers('wrong', this)">
      <i class="fa-solid fa-xmark" style="color: #ef4444;"></i> Incorrect ({{ $wrongCount }})
    </button>
  </div>

  <div id="quickQuestionsList">
    @foreach($evaluatedQuestions as $idx => $item)
      @php
        $q = $item['question'];
        $uAns = $item['userAnswer'];
        $isCorr = $item['isCorrect'];
        $correctOpt = trim(strtoupper((string)$q->correct_option));
      @endphp
      <div class="answer-card-item {{ $isCorr ? 'is-correct' : 'is-wrong' }}" data-status="{{ $isCorr ? 'correct' : 'wrong' }}">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 10px;">
          <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
            <span style="font-weight: 800; font-size: 14px; color: var(--admin-text-1);">
              #{{ $idx + 1 }}
            </span>
            <span style="background: #f3e8ff; color: #6b21a8; font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 4px;">
              {{ $q->section }}
            </span>
            <span style="font-size: 11.5px; color: var(--admin-text-3);">Marks: {{ $q->marks }}</span>
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

        <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 14px; line-height: 1.5;">
          {{ $q->question_text }}
        </div>

        @if($q->question_image)
          <div style="margin-bottom: 14px;">
            <img src="{{ asset($q->question_image) }}" alt="Question" style="max-height: 150px; border-radius: 6px; border: 1px solid #cbd5e1;">
          </div>
        @endif

        <!-- Options Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px; margin-bottom: 14px;">
          @php
            $opts = [
              'A' => ['text' => $q->option_a, 'img' => $q->option_a_image],
              'B' => ['text' => $q->option_b, 'img' => $q->option_b_image],
              'C' => ['text' => $q->option_c, 'img' => $q->option_c_image],
              'D' => ['text' => $q->option_d, 'img' => $q->option_d_image],
            ];
          @endphp
          @foreach($opts as $letter => $optData)
            @php
              $isSelected = ($uAns !== null && trim(strtoupper((string)$uAns)) === $letter);
              $isTarget = ($correctOpt === $letter);
              $pillClass = '';
              if ($isTarget) {
                  $pillClass = 'is-correct-target';
              } elseif ($isSelected) {
                  $pillClass = 'is-selected';
              }
            @endphp
            <div class="option-pill {{ $pillClass }}">
              <strong style="width: 20px;">{{ $letter }}.</strong>
              <div style="flex: 1;">
                {{ $optData['text'] }}
                @if($optData['img'])
                  <div><img src="{{ asset($optData['img']) }}" alt="" style="max-height: 60px; margin-top: 4px;"></div>
                @endif
              </div>
              @if($isTarget)
                <span style="font-size: 11px; background: #10b981; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800;">CORRECT</span>
              @elseif($isSelected)
                <span style="font-size: 11px; background: #ef4444; color: #fff; padding: 2px 6px; border-radius: 4px; font-weight: 800;">CHOSEN</span>
              @endif
            </div>
          @endforeach
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; background: rgba(255, 255, 255, 0.7); border: 1px solid rgba(0,0,0,0.06); border-radius: 8px; padding: 12px;">
          <div>
            <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Candidate's Selected Answer:</span>
            <span style="font-size: 14px; font-weight: 700; color: {{ $isCorr ? '#166534' : '#991b1b' }};">
              {{ $uAns ? 'Option ' . $uAns : 'Not Answered / Skipped' }}
            </span>
          </div>
          <div>
            <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 3px;">Official Correct Answer:</span>
            <span style="font-size: 14px; font-weight: 700; color: #166534;">
              <i class="fa-solid fa-check"></i> Option {{ $correctOpt }}
            </span>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<script>
function filterQuickAnswers(status, btn) {
  document.querySelectorAll('.q-filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const items = document.querySelectorAll('#quickQuestionsList .answer-card-item');
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

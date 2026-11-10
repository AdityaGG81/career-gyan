@extends('admin.layout')

@section('title', 'Specialized Aptitude Report - ' . ($attempt->student_name ?: 'Candidate #' . $attempt->id))
@section('page_title', $attempt->category_label . ' Assessment Details')

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
    display: flex;
    align-items: center;
    gap: 10px;
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

  .stat-summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }

  .stat-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: var(--admin-radius-md);
    padding: 16px 20px;
  }

  .stat-box-label {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
  }

  .stat-box-val {
    font-family: 'Outfit', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: var(--admin-text-1);
  }

  /* Question Review Items */
  .question-item {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: var(--admin-radius-md);
    padding: 20px;
    margin-bottom: 16px;
    transition: border-color 0.2s;
  }

  .question-item.correct {
    border-left: 4px solid #10b981;
  }

  .question-item.incorrect {
    border-left: 4px solid #ef4444;
  }

  .q-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }

  .q-num {
    font-family: 'Outfit', sans-serif;
    font-weight: 800;
    font-size: 14px;
    color: #64748b;
  }

  .q-badge {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .q-badge.correct {
    background: #dcfce7;
    color: #15803d;
  }

  .q-badge.incorrect {
    background: #fee2e2;
    color: #b91c1c;
  }

  .q-text {
    font-size: 15px;
    font-weight: 600;
    color: var(--admin-text-1);
    line-height: 1.5;
    margin-bottom: 16px;
  }

  .options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 10px;
    margin-bottom: 14px;
  }

  .option-pill {
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    font-size: 13.5px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #334155;
  }

  .option-pill.user-selected {
    border-color: #3b82f6;
    background: #eff6ff;
    color: #1d4ed8;
    font-weight: 700;
  }

  .option-pill.correct-answer {
    border-color: #10b981;
    background: #ecfdf5;
    color: #047857;
    font-weight: 700;
  }

  .option-pill.user-selected.incorrect {
    border-color: #ef4444;
    background: #fef2f2;
    color: #b91c1c;
    font-weight: 700;
  }

  .q-explanation {
    background: #f8fafc;
    border-left: 3px solid #6366f1;
    padding: 10px 14px;
    border-radius: 0 8px 8px 0;
    font-size: 13px;
    color: #475569;
    line-height: 1.5;
  }

  /* Recommended courses grid */
  .courses-rec-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 18px;
  }

  .course-rec-card {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: var(--admin-radius-md);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .course-rec-title {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--admin-text-1);
    margin-bottom: 6px;
  }
</style>
@endsection

@section('content')

<!-- Top Header Card -->
<div class="report-top-card">
  <div class="candidate-info">
    <h2>
      <i class="{{ $attempt->category_icon }}" style="color: {{ $attempt->category_color }};"></i>
      {{ $attempt->student_name ?: 'Candidate #' . $attempt->id }}
      <span style="font-size: 13px; font-weight: 700; background: {{ $attempt->category_bg }}; color: {{ $attempt->category_color }}; padding: 4px 12px; border-radius: 999px;">
        {{ $attempt->category_label }}
      </span>
    </h2>
    <div class="candidate-meta">
      <span><i class="fa-solid fa-envelope"></i> {{ $attempt->student_email }}</span>
      @if($attempt->student_phone)
        <span><i class="fa-solid fa-phone"></i> {{ $attempt->student_phone }}</span>
      @endif
      @if($attempt->user_id)
        <span><i class="fa-solid fa-user-check"></i> Registered User #{{ $attempt->user_id }}</span>
      @else
        <span><i class="fa-solid fa-user-clock"></i> Guest Submission</span>
      @endif
      <span><i class="fa-solid fa-calendar"></i> {{ $attempt->created_at->format('d M Y, h:i A') }}</span>
      <span><i class="fa-solid fa-hashtag"></i> UUID: {{ substr($attempt->uuid, 0, 8) }}...</span>
    </div>
  </div>

  <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    <a href="{{ route('admin.test-results.index', ['tab' => 'specialized']) }}" class="action-btn-sm" style="background: #f1f5f9; color: #475569; padding: 10px 16px; border-radius: 8px;">
      <i class="fa-solid fa-arrow-left"></i> Back to Results
    </a>

    <button type="button" onclick="window.print()" class="action-btn-sm" style="background: #2563eb; color: #ffffff; padding: 10px 16px; border-radius: 8px; border: none; cursor: pointer;">
      <i class="fa-solid fa-print"></i> Print Report
    </button>

    <form action="{{ route('admin.test-results.specialized.destroy', $attempt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this test attempt permanently?')" style="margin: 0;">
      @csrf
      @method('DELETE')
      <input type="hidden" name="redirect_to" value="index">
      <button type="submit" class="action-btn-sm" style="background: #fee2e2; color: #dc2626; padding: 10px 16px; border-radius: 8px; border: none; cursor: pointer;">
        <i class="fa-solid fa-trash"></i> Delete Record
      </button>
    </form>
  </div>
</div>

<!-- Score Overview Summary -->
<div class="stat-summary-grid">
  <div class="stat-box" style="border-left: 4px solid {{ $attempt->category_color }};">
    <div class="stat-box-label">Correct Answers</div>
    <div class="stat-box-val" style="color: {{ $attempt->category_color }};">
      {{ $attempt->correct_answers }} / {{ $attempt->total_questions }}
    </div>
  </div>

  <div class="stat-box" style="border-left: 4px solid #10b981;">
    <div class="stat-box-label">Score Percentage</div>
    <div class="stat-box-val" style="color: #059669;">
      {{ number_format($attempt->score_percentage, 1) }}%
    </div>
  </div>

  <div class="stat-box" style="border-left: 4px solid #6366f1;">
    <div class="stat-box-label">Assessed Aptitude Level</div>
    <div class="stat-box-val" style="font-size: 20px; color: #4338ca;">
      {{ $attempt->aptitude_level }}
    </div>
  </div>

  <div class="stat-box" style="border-left: 4px solid #f59e0b;">
    <div class="stat-box-label">Evaluation Domain</div>
    <div class="stat-box-val" style="font-size: 20px; color: #d97706;">
      {{ $attempt->category_label }}
    </div>
  </div>
</div>

<!-- Recommended Courses Section -->
<div class="section-card">
  <div class="section-title">
    <i class="fa-solid fa-graduation-cap" style="color: #2563eb;"></i>
    Mapped Recommended Courses for {{ $attempt->student_name }}
  </div>

  <div class="courses-rec-grid">
    @forelse($recommendedCourses as $course)
      <div class="course-rec-card">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; padding: 3px 8px; border-radius: 6px; background: #e0e7ff; color: #3730a3;">
              {{ $course->level }}
            </span>
            <span style="font-size: 12px; font-weight: 700; color: #64748b;">
              <i class="fa-solid fa-clock"></i> {{ $course->duration }}
            </span>
          </div>

          <div class="course-rec-title">{{ $course->title }}</div>
          <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 12px;">
            {{ Str::limit($course->description, 130) }}
          </p>

          <div style="font-size: 12.5px; color: #334155; margin-bottom: 8px;">
            <strong>Expected Package:</strong> <span style="color: #059669; font-weight: 700;">{{ $course->salary_range ?: 'N/A' }}</span>
          </div>

          @if(!empty($course->top_colleges))
            <div style="font-size: 12px; color: #475569; margin-bottom: 6px;">
              <strong>Top Colleges:</strong> {{ implode(', ', array_slice($course->top_colleges, 0, 2)) }}
            </div>
          @endif
        </div>
      </div>
    @empty
      <p style="color: #64748b;">No specific courses mapped yet.</p>
    @endforelse
  </div>
</div>

<!-- Complete Question-by-Question Answersheet Review -->
<div class="section-card">
  <div class="section-title">
    <i class="fa-solid fa-list-check" style="color: #059669;"></i>
    Question-by-Question Answersheet Audit (20 Questions)
  </div>

  @foreach($attempt->question_details ?? [] as $index => $q)
    <div class="question-item {{ $q['is_correct'] ? 'correct' : 'incorrect' }}">
      <div class="q-header">
        <div class="q-num">Question #{{ $index + 1 }}</div>
        <div>
          @if($q['is_correct'])
            <span class="q-badge correct">
              <i class="fa-solid fa-circle-check"></i> Correct (+1 Point)
            </span>
          @else
            <span class="q-badge incorrect">
              <i class="fa-solid fa-circle-xmark"></i> Incorrect (0 Points)
            </span>
          @endif
        </div>
      </div>

      <div class="q-text">{{ $q['question_text'] }}</div>

      <div class="options-grid">
        <!-- Option A -->
        <div class="option-pill {{ $q['chosen_option'] === 'A' ? ($q['is_correct'] ? 'user-selected' : 'user-selected incorrect') : '' }} {{ $q['correct_option'] === 'A' ? 'correct-answer' : '' }}">
          <strong>A.</strong> {{ $q['option_a'] }}
          @if($q['chosen_option'] === 'A')
            <span style="margin-left: auto; font-size: 11px;">[Candidate's Choice]</span>
          @endif
          @if($q['correct_option'] === 'A')
            <span style="margin-left: auto; font-size: 11px; color: #047857;">[Correct Answer]</span>
          @endif
        </div>

        <!-- Option B -->
        <div class="option-pill {{ $q['chosen_option'] === 'B' ? ($q['is_correct'] ? 'user-selected' : 'user-selected incorrect') : '' }} {{ $q['correct_option'] === 'B' ? 'correct-answer' : '' }}">
          <strong>B.</strong> {{ $q['option_b'] }}
          @if($q['chosen_option'] === 'B')
            <span style="margin-left: auto; font-size: 11px;">[Candidate's Choice]</span>
          @endif
          @if($q['correct_option'] === 'B')
            <span style="margin-left: auto; font-size: 11px; color: #047857;">[Correct Answer]</span>
          @endif
        </div>

        <!-- Option C -->
        <div class="option-pill {{ $q['chosen_option'] === 'C' ? ($q['is_correct'] ? 'user-selected' : 'user-selected incorrect') : '' }} {{ $q['correct_option'] === 'C' ? 'correct-answer' : '' }}">
          <strong>C.</strong> {{ $q['option_c'] }}
          @if($q['chosen_option'] === 'C')
            <span style="margin-left: auto; font-size: 11px;">[Candidate's Choice]</span>
          @endif
          @if($q['correct_option'] === 'C')
            <span style="margin-left: auto; font-size: 11px; color: #047857;">[Correct Answer]</span>
          @endif
        </div>

        <!-- Option D -->
        <div class="option-pill {{ $q['chosen_option'] === 'D' ? ($q['is_correct'] ? 'user-selected' : 'user-selected incorrect') : '' }} {{ $q['correct_option'] === 'D' ? 'correct-answer' : '' }}">
          <strong>D.</strong> {{ $q['option_d'] }}
          @if($q['chosen_option'] === 'D')
            <span style="margin-left: auto; font-size: 11px;">[Candidate's Choice]</span>
          @endif
          @if($q['correct_option'] === 'D')
            <span style="margin-left: auto; font-size: 11px; color: #047857;">[Correct Answer]</span>
          @endif
        </div>
      </div>

      @if(!empty($q['explanation']))
        <div class="q-explanation">
          <strong><i class="fa-solid fa-circle-info"></i> Psychometric Rationale:</strong> {{ $q['explanation'] }}
        </div>
      @endif
    </div>
  @endforeach
</div>

@endsection

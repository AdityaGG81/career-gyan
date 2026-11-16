@extends('layouts.app')

@section('title', $meta['name'] . ' Scorecard & Report - ' . $attempt->student_name . ' | CareerGyan')
@section('meta_description', 'Detailed assessment report and scorecard for ' . $attempt->student_name . ' in ' . $meta['name'] . '. View score, answersheet rationale, and recommended courses.')

@section('content')
<style>
  .spec-res-page {
    background: #f8fafc;
    min-height: 90vh;
    padding: 40px 16px 80px;
  }
  .spec-res-container {
    max-width: 1100px;
    margin: 0 auto;
  }

  /* Scorecard Header Card */
  .spec-scorecard-card {
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    padding: 40px 36px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
  }
  .spec-scorecard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 8px;
    background: linear-gradient(90deg, {{ $meta['color'] }} 0%, {{ $meta['color_dark'] }} 100%);
  }

  .scorecard-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 24px;
  }
  .scorecard-candidate h1 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
  }
  .scorecard-candidate-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 13.5px;
    color: #64748b;
  }

  /* Score Dial Box */
  .score-dial-box {
    display: flex;
    align-items: center;
    gap: 20px;
    background: {{ $meta['bg_light'] }};
    border: 1px solid {{ $meta['badge_bg'] }};
    padding: 20px 28px;
    border-radius: 18px;
  }
  .score-num-big {
    font-family: 'Outfit', sans-serif;
    font-size: 44px;
    font-weight: 900;
    color: {{ $meta['color_dark'] }};
    line-height: 1;
  }
  .score-num-sub {
    font-size: 14px;
    font-weight: 700;
    color: #475569;
  }
  .level-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    background: #ffffff;
    color: {{ $meta['color_dark'] }};
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    margin-top: 6px;
  }

  /* Reward notification */
  .reward-pill-banner {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    border-radius: 12px;
    padding: 12px 18px;
    margin-top: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 700;
  }

  /* Section Card */
  .res-section-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  }
  .res-section-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Question Review Item */
  .qa-review-item {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px 24px;
    margin-bottom: 16px;
    background: #ffffff;
  }
  .qa-review-item.is-correct {
    border-left: 5px solid #10b981;
  }
  .qa-review-item.is-wrong {
    border-left: 5px solid #ef4444;
  }
  .qa-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  .qa-qtext {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
  }
  .qa-status-pill {
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .qa-status-correct {
    background: #dcfce7;
    color: #15803d;
  }
  .qa-status-wrong {
    background: #fee2e2;
    color: #b91c1c;
  }

  .qa-options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 8px;
    margin-bottom: 14px;
    font-size: 13.5px;
  }
  .qa-opt-box {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
  }
  .qa-opt-box.selected-wrong {
    background: #fef2f2;
    border-color: #fca5a5;
    color: #991b1b;
    font-weight: 700;
  }
  .qa-opt-box.is-the-correct {
    background: #f0fdf4;
    border-color: #86efac;
    color: #166534;
    font-weight: 700;
  }

  .qa-explanation-box {
    background: #f8fafc;
    border-radius: 10px;
    padding: 12px 16px;
    border-left: 3px solid {{ $meta['color'] }};
    font-size: 13px;
    color: #334155;
    line-height: 1.5;
  }

  /* Recommended Course Cards */
  .res-course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
  }
  .res-course-card {
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 22px;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s;
  }
  .res-course-card:hover {
    border-color: {{ $meta['color'] }};
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    transform: translateY(-2px);
  }

  @media print {
    body { background: #fff !important; }
    .no-print { display: none !important; }
    .spec-scorecard-card, .res-section-card { box-shadow: none !important; border: 1px solid #ccc !important; }
  }
</style>

<div class="spec-res-page">
  <div class="spec-res-container">

    <!-- Breadcrumb -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;" class="no-print">
      <div style="font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 8px;">
        <a href="{{ route('explore.index') }}" style="color: #64748b; text-decoration: none;">Explore</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <a href="{{ route('specialized-aptitude.index') }}" style="color: #64748b; text-decoration: none;">Specialized Tests</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span>Scorecard</span>
      </div>

      <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <button type="button" onclick="window.print()" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; color: #1e293b; font-weight: 700; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fa-solid fa-print"></i> Print / Save PDF
        </button>
        @if($attempt->category === 'sports' && !empty($attempt->sport))
          <a href="{{ route('specialized-aptitude.quiz', ['category' => 'sports', 'sport' => $attempt->sport]) }}" style="padding: 8px 16px; border-radius: 8px; background: {{ $sportMeta['color'] ?? $meta['color'] }}; color: #fff; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-rotate-right"></i> Retake {{ $sportMeta['name'] ?? 'Sport' }} Test
          </a>
          <a href="{{ route('specialized-aptitude.quiz', 'sports') }}" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; color: #334155; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-trophy"></i> Try Another Sport
          </a>
        @else
          <a href="{{ route('specialized-aptitude.quiz', $meta['key']) }}" style="padding: 8px 16px; border-radius: 8px; background: {{ $meta['color'] }}; color: #fff; font-weight: 700; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-rotate-right"></i> Retake Test
          </a>
        @endif
      </div>
    </div>

    <!-- Scorecard Header Card -->
    <div class="spec-scorecard-card">
      <div class="scorecard-header-flex">
        <div class="scorecard-candidate">
          @if(!empty($sportMeta))
            <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 14px; border-radius: 999px; background: {{ $sportMeta['bg_light'] }}; color: {{ $sportMeta['color_dark'] }}; font-size: 12px; font-weight: 800; margin-bottom: 10px; text-transform: uppercase;">
              <i class="{{ $sportMeta['icon'] }}"></i> {{ $sportMeta['name'] }} Specialization Report
            </div>
          @else
            <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 999px; background: {{ $meta['bg_light'] }}; color: {{ $meta['color_dark'] }}; font-size: 12px; font-weight: 800; margin-bottom: 10px; text-transform: uppercase;">
              <i class="{{ $meta['icon'] }}"></i> {{ $meta['name'] }} Report
            </div>
          @endif
          <h1>{{ $attempt->student_name }}</h1>
          <div class="scorecard-candidate-meta">
            <span><i class="fa-regular fa-envelope"></i> {{ $attempt->student_email }}</span>
            @if($attempt->student_phone)
              <span><i class="fa-solid fa-phone"></i> {{ $attempt->student_phone }}</span>
            @endif
            <span><i class="fa-regular fa-calendar"></i> {{ $attempt->created_at->format('d M, Y &bull; h:i A') }}</span>
            <span><i class="fa-solid fa-hashtag"></i> ID: #{{ substr($attempt->uuid, 0, 8) }}</span>
            @if(!empty($sportMeta))
              <span><i class="{{ $sportMeta['icon'] }}"></i> Sport: <strong>{{ $sportMeta['name'] }}</strong></span>
            @endif
          </div>
        </div>

        <div class="score-dial-box">
          <div>
            <div class="score-num-big">{{ $attempt->correct_answers }}<span style="font-size: 22px; color: #64748b; font-weight: 600;">/{{ $attempt->total_questions }}</span></div>
            <div class="score-num-sub">{{ $attempt->score_percentage }}% Accuracy</div>
            <div class="level-badge">
              <i class="fa-solid fa-award"></i> {{ $attempt->aptitude_level }}
            </div>
          </div>
        </div>
      </div>

      @php
        $details = $attempt->question_details ?? [];
        $genTotal = 0;
        $genCorrect = 0;
        $sportTotal = 0;
        $sportCorrect = 0;

        foreach($details as $item) {
          $isSport = !empty($item['is_sport_specific']) || (isset($item['sport']) && $item['sport'] !== 'general' && !empty($attempt->sport));
          if ($isSport) {
            $sportTotal++;
            if (!empty($item['is_correct'])) $sportCorrect++;
          } else {
            $genTotal++;
            if (!empty($item['is_correct'])) $genCorrect++;
          }
        }
      @endphp

      @if($attempt->category === 'sports' && !empty($sportMeta))
        <!-- 2-Part Section Breakdown for Sports Specialization -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-top: 28px; padding-top: 22px; border-top: 1px solid #e2e8f0;">
          <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 14px; padding: 18px 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-size: 12px; font-weight: 800; color: #0369a1; text-transform: uppercase;">
                <i class="fa-solid fa-person-running"></i> Section 1: General Foundations
              </span>
              <span style="font-size: 11.5px; font-weight: 700; color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 999px;">
                10 Questions
              </span>
            </div>
            <div style="font-size: 28px; font-weight: 900; color: #0369a1; line-height: 1.2;">
              {{ $genCorrect }}<span style="font-size: 18px; color: #64748b; font-weight: 600;">/{{ $genTotal > 0 ? $genTotal : 10 }}</span>
              <span style="font-size: 15px; font-weight: 700; color: #0284c7; margin-left: 6px;">({{ $genTotal > 0 ? round(($genCorrect / $genTotal) * 100) : 0 }}%)</span>
            </div>
            <div style="font-size: 12.5px; color: #475569; margin-top: 6px;">
              Biomechanics, recovery, kinesiology, athletic nutrition & psychology
            </div>
          </div>

          <div style="background: {{ $sportMeta['bg_light'] }}; border: 1px solid {{ $sportMeta['color'] }}55; border-radius: 14px; padding: 18px 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-size: 12px; font-weight: 800; color: {{ $sportMeta['color_dark'] }}; text-transform: uppercase;">
                <i class="{{ $sportMeta['icon'] }}"></i> Section 2: {{ $sportMeta['name'] }} Specialization
              </span>
              <span style="font-size: 11.5px; font-weight: 700; color: {{ $sportMeta['color_dark'] }}; background: #ffffff; padding: 2px 8px; border-radius: 999px;">
                10 Questions
              </span>
            </div>
            <div style="font-size: 28px; font-weight: 900; color: {{ $sportMeta['color_dark'] }}; line-height: 1.2;">
              {{ $sportCorrect }}<span style="font-size: 18px; color: #64748b; font-weight: 600;">/{{ $sportTotal > 0 ? $sportTotal : 10 }}</span>
              <span style="font-size: 15px; font-weight: 700; color: {{ $sportMeta['color_dark'] }}; margin-left: 6px;">({{ $sportTotal > 0 ? round(($sportCorrect / $sportTotal) * 100) : 0 }}%)</span>
            </div>
            <div style="font-size: 12.5px; color: #475569; margin-top: 6px;">
              Tactics, match strategy, tournament rules & technical sport execution
            </div>
          </div>
        </div>
      @endif

      @if(session('reward_notification'))
        <div class="reward-pill-banner">
          <i class="fa-solid fa-gift" style="font-size: 20px; color: #10b981;"></i>
          <div>{{ session('reward_notification') }}</div>
        </div>
      @endif
    </div>

    <!-- Diagnostic Assessment Summary -->
    <div class="res-section-card">
      <h2 class="res-section-title">
        <i class="fa-solid fa-chart-line" style="color: {{ $meta['color'] }};"></i>
        Psychometric Diagnostic Assessment
      </h2>
      <p style="font-size: 15px; color: #334155; line-height: 1.6; margin-bottom: 16px;">
        @if($attempt->score_percentage >= 80)
          Exceptional cognitive alignment detected! You demonstrated <strong>{{ $attempt->aptitude_level }}</strong> in {{ $meta['name'] }}. You exhibit instinctive problem-solving, advanced situational anticipation, and sound qualitative judgment in this domain. Highly recommended for premium bachelor's and professional master's degrees.
        @elseif($attempt->score_percentage >= 60)
          Strong domain affinity detected! With a score of <strong>{{ $attempt->score_percentage }}%</strong>, you demonstrated <strong>{{ $attempt->aptitude_level }}</strong>. You have solid fundamental instincts and strong conceptual understanding. Formal degree training and practical internship exposure will elevate you into top leadership tiers.
        @elseif($attempt->score_percentage >= 40)
          Promising aptitude detected! You showed <strong>{{ $attempt->aptitude_level }}</strong> ({{ $attempt->score_percentage }}%). You understand key core principles and will thrive with foundational diploma or structured introductory certification programs in this field.
        @else
          Emerging aptitude identified. You are in the foundational discovery stage for {{ $meta['name'] }}. Introductory diplomas, foundation workshops, and hands-on skill development will strengthen your core domain knowledge.
        @endif
      </p>

      <div style="display: flex; gap: 8px; flex-wrap: wrap;">
        @foreach($meta['focus_traits'] as $trait)
          <span style="padding: 6px 12px; border-radius: 8px; background: #f1f5f9; color: #475569; font-size: 12.5px; font-weight: 600;">
            <i class="fa-solid fa-check" style="color: {{ $meta['color'] }};"></i> {{ $trait }}
          </span>
        @endforeach
      </div>
    </div>

    <!-- Recommended Courses & Degree Pathways -->
    <div class="res-section-card">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <h2 class="res-section-title" style="margin: 0;">
          <i class="fa-solid fa-graduation-cap" style="color: {{ $meta['color'] }};"></i>
          Recommended Degree & Diploma Pathways
        </h2>
        <a href="{{ route('specialized-aptitude.courses', $meta['key']) }}" class="no-print" style="font-size: 13.5px; font-weight: 700; color: {{ $meta['color'] }}; text-decoration: none;">
          View All Courses in {{ $meta['name'] }} &rarr;
        </a>
      </div>

      <div class="res-course-grid">
        @foreach($courses->take(4) as $course)
          <div class="res-course-card">
            <div>
              <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 999px; background: #f1f5f9; color: #475569;">
                  {{ $course->level }}
                </span>
                <span style="font-size: 12px; color: #64748b; font-weight: 600;">
                  <i class="fa-regular fa-clock"></i> {{ $course->duration }}
                </span>
              </div>

              <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                {{ $course->title }}
              </h3>

              <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 14px;">
                {{ Str::limit($course->description, 130) }}
              </p>

              <div style="background: #f8fafc; border-radius: 10px; padding: 10px 12px; font-size: 12px; margin-bottom: 12px;">
                <div style="color: #64748b; margin-bottom: 2px;">Expected Salary:</div>
                <div style="color: #059669; font-weight: 800; font-size: 13px;">{{ $course->salary_range ?: 'Competitive Industry Pay' }}</div>
              </div>

              @if(!empty($course->top_colleges) && is_array($course->top_colleges))
                <div style="font-size: 11.5px; color: #475569;">
                  <strong>Top Colleges:</strong> {{ implode(', ', array_slice($course->top_colleges, 0, 2)) }}
                </div>
              @endif
            </div>

            <div style="margin-top: 18px; pt: 12px; border-top: 1px solid #f1f5f9;">
              <a href="{{ route('specialized-aptitude.courses', $meta['key']) }}" style="font-size: 13px; font-weight: 700; color: {{ $meta['color'] }}; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                Inspect Curriculum & Eligibility <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Question-by-Question Answersheet & Psychometric Rationale -->
    <div class="res-section-card">
      <h2 class="res-section-title">
        <i class="fa-solid fa-list-check" style="color: {{ $meta['color'] }};"></i>
        Answersheet Breakdown & Psychometric Rationale ({{ count($attempt->question_details ?? []) }} Questions)
      </h2>
      <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">
        Review your response against the scientifically evaluated correct answers and the rationale for each scenario:
      </p>

      @php
        $details = $attempt->question_details ?? [];
      @endphp

      @forelse($details as $idx => $item)
        @php
          $isCorrect = !empty($item['is_correct']);
          $chosen = $item['chosen_option'] ?? 'Unanswered';
          $correct = $item['correct_option'] ?? 'N/A';
        @endphp
        <div class="qa-review-item {{ $isCorrect ? 'is-correct' : 'is-wrong' }}">
          <div class="qa-header">
            <div class="qa-qtext">
              <span style="color: #94a3b8; margin-right: 6px;">Q{{ $idx + 1 }}.</span>
              @if(!empty($item['is_sport_specific']) || (isset($item['sport']) && $item['sport'] !== 'general' && !empty($attempt->sport)))
                <span style="font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 6px; background: {{ $sportMeta['bg_light'] ?? '#ecfdf5' }}; color: {{ $sportMeta['color_dark'] ?? '#047857' }}; margin-right: 6px; display: inline-flex; align-items: center; gap: 4px;">
                  <i class="{{ $sportMeta['icon'] ?? 'fa-solid fa-medal' }}"></i> {{ $sportMeta['name'] ?? 'Sport' }} Specialization
                </span>
              @elseif($attempt->category === 'sports')
                <span style="font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 6px; background: #e0f2fe; color: #0369a1; margin-right: 6px; display: inline-flex; align-items: center; gap: 4px;">
                  <i class="fa-solid fa-person-running"></i> General Athletic Foundation
                </span>
              @endif
              {{ $item['question_text'] ?? 'Question' }}
            </div>
            @if($isCorrect)
              <span class="qa-status-pill qa-status-correct">
                <i class="fa-solid fa-circle-check"></i> Correct (+1)
              </span>
            @else
              <span class="qa-status-pill qa-status-wrong">
                <i class="fa-solid fa-circle-xmark"></i> Incorrect
              </span>
            @endif
          </div>

          <div class="qa-options-grid">
            <div class="qa-opt-box {{ $chosen === 'A' ? ($isCorrect ? 'is-the-correct' : 'selected-wrong') : ($correct === 'A' ? 'is-the-correct' : '') }}">
              <strong>A.</strong> {{ $item['option_a'] ?? '' }}
            </div>
            <div class="qa-opt-box {{ $chosen === 'B' ? ($isCorrect ? 'is-the-correct' : 'selected-wrong') : ($correct === 'B' ? 'is-the-correct' : '') }}">
              <strong>B.</strong> {{ $item['option_b'] ?? '' }}
            </div>
            <div class="qa-opt-box {{ $chosen === 'C' ? ($isCorrect ? 'is-the-correct' : 'selected-wrong') : ($correct === 'C' ? 'is-the-correct' : '') }}">
              <strong>C.</strong> {{ $item['option_c'] ?? '' }}
            </div>
            <div class="qa-opt-box {{ $chosen === 'D' ? ($isCorrect ? 'is-the-correct' : 'selected-wrong') : ($correct === 'D' ? 'is-the-correct' : '') }}">
              <strong>D.</strong> {{ $item['option_d'] ?? '' }}
            </div>
          </div>

          <div style="font-size: 13px; margin-bottom: 8px;">
            Your Selection: <strong style="{{ $isCorrect ? 'color: #15803d;' : 'color: #b91c1c;' }}">Option {{ $chosen }}</strong> &bull;
            Correct Answer: <strong style="color: #15803d;">Option {{ $correct }}</strong>
          </div>

          @if(!empty($item['explanation']))
            <div class="qa-explanation-box">
              <strong style="color: {{ $meta['color_dark'] }};">Psychometric / Subject Rationale:</strong>
              {{ $item['explanation'] }}
            </div>
          @endif
        </div>
      @empty
        <div style="text-align: center; padding: 40px; color: #94a3b8;">
          No itemized questions breakdown available for this attempt.
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection


@extends('layouts.app')

@section('title', $meta['name'] . ' - Assessment, Traits & Courses | CareerGyan')
@section('meta_description', 'Take the 20-question ' . $meta['name'] . ' test. Explore verified courses, eligibility, top colleges in India, and career options in ' . $meta['name'] . '.')

@section('content')
<style>
  .spec-show-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #ffffff;
    padding: 54px 20px 70px;
    position: relative;
    overflow: hidden;
  }
  .spec-show-hero::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: {{ $meta['color'] }};
    opacity: 0.18;
    filter: blur(60px);
    pointer-events: none;
  }
  .spec-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    position: relative;
    z-index: 2;
  }
  .spec-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #94a3b8;
    margin-bottom: 20px;
  }
  .spec-breadcrumb a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.2s;
  }
  .spec-breadcrumb a:hover {
    color: #ffffff;
  }
  .spec-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 16px;
  }
  .spec-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 40px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 12px;
  }
  .spec-sub {
    font-size: 18px;
    color: #cbd5e1;
    max-width: 760px;
    line-height: 1.6;
    margin-bottom: 28px;
  }
  .spec-hero-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    align-items: center;
  }
  .btn-start-hero {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    border-radius: 12px;
    color: #ffffff;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    transition: all 0.2s;
  }
  .btn-start-hero:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
  }

  /* Main Content Layout */
  .spec-body-section {
    padding: 50px 0 80px;
    background: #f8fafc;
  }
  .spec-body-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 32px;
  }
  @media(max-width: 992px) {
    .spec-body-grid { grid-template-columns: 1fr; }
  }

  /* Cards */
  .spec-content-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    padding: 30px;
    margin-bottom: 28px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
  }
  .spec-sec-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Course Card */
  .course-item-card {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 18px;
    background: #ffffff;
    transition: all 0.2s;
  }
  .course-item-card:hover {
    border-color: {{ $meta['color'] }};
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    transform: translateY(-2px);
  }
  .course-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 8px;
  }
  .course-title {
    font-family: 'Outfit', sans-serif;
    font-size: 19px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
  }
  .course-level-tag {
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    background: #f1f5f9;
    color: #475569;
    white-space: nowrap;
  }
  .course-desc {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 16px;
  }
  .course-meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    background: #f8fafc;
    border-radius: 10px;
    padding: 14px;
    font-size: 13px;
  }
  .meta-cell-label {
    font-size: 11px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    margin-bottom: 2px;
  }
  .meta-cell-val {
    font-weight: 600;
    color: #1e293b;
  }

  /* Traits */
  .traits-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 12px;
  }
  .trait-chip {
    padding: 8px 16px;
    border-radius: 10px;
    background: {{ $meta['bg_light'] }};
    color: {{ $meta['color_dark'] }};
    font-size: 13px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  /* Sidebar */
  .spec-sidebar-sticky {
    position: sticky;
    top: 90px;
  }
  .sidebar-box {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    padding: 26px;
    margin-bottom: 24px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
  }
</style>

<!-- Hero Section -->
<section class="spec-show-hero">
  <div class="spec-container">
    <div class="spec-breadcrumb">
      <a href="{{ route('explore.index') }}">Explore</a>
      <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
      <a href="{{ route('specialized-aptitude.index') }}">Specialized Aptitude</a>
      <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
      <span>{{ $meta['name'] }}</span>
    </div>

    <div class="spec-badge-pill" style="background: {{ $meta['bg_light'] }}; color: {{ $meta['color_dark'] }};">
      <i class="{{ $meta['icon'] }}"></i> {{ $meta['name'] }} Evaluation
    </div>

    <h1 class="spec-title">
      {{ $meta['name'] }} & Degree Pathways
    </h1>
    <p class="spec-sub">
      {{ $meta['description'] }}
    </p>

    <!-- Previous Attempt Banner if taken -->
    @if($userAttempt)
      <div style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); border-radius: 14px; padding: 14px 20px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; max-width: 800px;">
        <div style="display: flex; align-items: center; gap: 12px;">
          <div style="width: 44px; height: 44px; border-radius: 12px; background: {{ $meta['color'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
            <i class="fa-solid fa-trophy"></i>
          </div>
          <div>
            <div style="font-size: 12px; color: #cbd5e1;">Your Last Attempt ({{ $userAttempt->created_at->format('d M, Y') }}):</div>
            <div style="font-size: 16px; font-weight: 800; color: #fff;">
              Score: {{ $userAttempt->correct_answers }}/{{ $userAttempt->total_questions }} ({{ $userAttempt->score_percentage }}%) &bull; <span style="color: #34d399;">{{ $userAttempt->aptitude_level }}</span>
            </div>
          </div>
        </div>
        <a href="{{ route('specialized-aptitude.results', $userAttempt->uuid) }}" style="padding: 8px 16px; border-radius: 8px; background: #fff; color: #0f172a; font-weight: 700; font-size: 13px; text-decoration: none;">
          View Answersheet &rarr;
        </a>
      </div>
    @endif

    <div class="spec-hero-actions">
      <a href="{{ route('specialized-aptitude.quiz', $meta['key']) }}" class="btn-start-hero" style="background: {{ $meta['color'] }};">
        <i class="fa-solid fa-pen-to-square"></i> Take 20-Question Assessment
      </a>
      <a href="#courses-section" class="btn-start-hero" style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3);">
        <i class="fa-solid fa-graduation-cap"></i> View {{ $courses->count() }} Degree & Diploma Courses
      </a>
    </div>
  </div>
</section>

<!-- Content Section -->
<section class="spec-body-section">
  <div class="spec-container">
    <div class="spec-body-grid">
      <!-- Main Column -->
      <div>
        <!-- Evaluated Traits Card -->
        <div class="spec-content-card">
          <h2 class="spec-sec-title">
            <i class="fa-solid fa-bullseye" style="color: {{ $meta['color'] }};"></i>
            Key Competencies & Evaluated Traits
          </h2>
          <p style="font-size: 14.5px; color: #475569; line-height: 1.6; margin-bottom: 16px;">
            The {{ $meta['name'] }} assessment measures instinctive cognitive and behavioral traits critical for high performance in this discipline:
          </p>
          <div class="traits-list">
            @foreach($meta['focus_traits'] as $trait)
              <div class="trait-chip">
                <i class="fa-solid fa-circle-check"></i>
                {{ $trait }}
              </div>
            @endforeach
          </div>
        </div>

        <!-- Courses Section -->
        <div id="courses-section" class="spec-content-card">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <h2 class="spec-sec-title" style="margin: 0;">
              <i class="fa-solid fa-graduation-cap" style="color: {{ $meta['color'] }};"></i>
              Accredited Courses & Degrees ({{ $courses->count() }})
            </h2>
            <span style="font-size: 13px; font-weight: 600; color: #64748b;">
              Curated for {{ $meta['name'] }}
            </span>
          </div>

          @forelse($courses as $course)
            <div class="course-item-card">
              <div class="course-header">
                <div>
                  <h3 class="course-title">{{ $course->title }}</h3>
                  <div style="font-size: 13px; color: #64748b; margin-top: 4px;">
                    <i class="fa-regular fa-clock"></i> Duration: <strong>{{ $course->duration }}</strong>
                  </div>
                </div>
                <span class="course-level-tag">{{ $course->level }}</span>
              </div>

              <p class="course-desc">
                {{ $course->description }}
              </p>

              <div class="course-meta-grid">
                <div>
                  <div class="meta-cell-label">Eligibility Criteria</div>
                  <div class="meta-cell-val">{{ $course->eligibility }}</div>
                </div>
                <div>
                  <div class="meta-cell-label">Expected Salary Range</div>
                  <div class="meta-cell-val" style="color: #059669; font-weight: 700;">{{ $course->salary_range ?: 'As per industry benchmark' }}</div>
                </div>
                <div>
                  <div class="meta-cell-label">Average Annual Fees</div>
                  <div class="meta-cell-val">{{ $course->average_fees ?: 'Standard Govt / University Fees' }}</div>
                </div>
              </div>

              @if(!empty($course->top_colleges) && is_array($course->top_colleges))
                <div style="margin-top: 14px; font-size: 12.5px;">
                  <span style="font-weight: 700; color: #475569;">Top Colleges in India:</span>
                  <span style="color: #64748b;">{{ implode(' &bull; ', $course->top_colleges) }}</span>
                </div>
              @endif

              @if(!empty($course->career_roles) && is_array($course->career_roles))
                <div style="margin-top: 6px; font-size: 12.5px;">
                  <span style="font-weight: 700; color: #475569;">Prominent Roles:</span>
                  <span style="color: #1e293b; font-weight: 600;">{{ implode(', ', $course->career_roles) }}</span>
                </div>
              @endif
            </div>
          @empty
            <div style="text-align: center; padding: 40px; color: #94a3b8;">
              <i class="fa-solid fa-graduation-cap" style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
              Courses for this section are being updated.
            </div>
          @endforelse
        </div>
      </div>

      <!-- Sidebar -->
      <div>
        <div class="spec-sidebar-sticky">
          <!-- Test CTA Box -->
          <div class="sidebar-box" style="border-top: 5px solid {{ $meta['color'] }};">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
              <div style="width: 36px; height: 36px; border-radius: 10px; background: {{ $meta['bg_light'] }}; color: {{ $meta['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa-solid fa-clock"></i>
              </div>
              <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: #0f172a; margin: 0;">
                Assessment Details
              </h3>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 20px; font-size: 13.5px; color: #475569; display: flex; flex-direction: column; gap: 10px;">
              <li style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>20 Questions</strong> (Randomized from {{ $questionsCount }} Question Pool)
              </li>
              <li style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>15-Minute</strong> Recommended Time
              </li>
              <li style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Instant Score</strong> & Mastery Level
              </li>
              <li style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Answersheet & Rationale</strong> Included
              </li>
              <li style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-gift" style="color: #f59e0b;"></i> <strong>Reward Points</strong> for Registered Students
              </li>
            </ul>

            <a href="{{ route('specialized-aptitude.quiz', $meta['key']) }}" class="btn-start-hero" style="background: {{ $meta['color'] }}; width: 100%; justify-content: center; padding: 13px 20px;">
              <i class="fa-solid fa-play"></i> Start 20-Q Assessment
            </a>
          </div>

          <!-- Other Streams Nav -->
          <div class="sidebar-box">
            <h4 style="font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 14px;">
              Other Specialized Streams
            </h4>
            <div style="display: flex; flex-direction: column; gap: 8px;">
              @foreach(['spiritual' => 'Spiritual Aptitude', 'artistic' => 'Artistic Aptitude', 'sports' => 'Sports Aptitude', 'business' => 'Business Aptitude'] as $k => $label)
                @if($k !== $meta['key'])
                  <a href="{{ route('specialized-aptitude.show', $k) }}" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: 10px; background: #f8fafc; text-decoration: none; color: #334155; font-size: 13.5px; font-weight: 600; border: 1px solid #f1f5f9; transition: all 0.2s;">
                    <span>{{ $label }}</span>
                    <i class="fa-solid fa-chevron-right" style="font-size: 11px; color: #94a3b8;"></i>
                  </a>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


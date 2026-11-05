@extends('layouts.app')

@section('title', 'Student Career Analysis Report - ' . $analysis->full_name . ' | CareerGyan')

@section('styles')
<style>
  .report-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    padding: 50px 20px 90px;
    font-family: 'Inter', system-ui, sans-serif;
  }

  .report-container {
    max-width: 920px;
    margin: 0 auto;
  }

  /* Success Banner */
  .report-banner {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    color: #ffffff;
    border-radius: 20px;
    padding: 36px 32px;
    margin-bottom: 28px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
  }

  .report-banner h1 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 6px;
  }

  .report-banner p {
    font-size: 14.5px;
    color: rgba(255, 255, 255, 0.88);
  }

  .report-actions-top {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .btn-report-action {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
  }

  .btn-report-action:hover {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
  }

  /* Archetype Hero Card */
  .archetype-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    display: flex;
    align-items: flex-start;
    gap: 24px;
  }

  .archetype-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    flex-shrink: 0;
  }

  .archetype-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
  }

  .archetype-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 10px;
  }

  .archetype-summary {
    font-size: 14.5px;
    color: #475569;
    line-height: 1.6;
  }

  /* Section Cards */
  .report-section {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 28px 32px;
    margin-bottom: 24px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
  }

  .section-heading-sm {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 12px;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 18px;
  }

  .info-label {
    font-size: 11.5px;
    color: #64748b;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 4px;
  }

  .info-value {
    font-size: 14px;
    color: #0f172a;
    font-weight: 600;
    line-height: 1.4;
  }

  .tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 6px;
  }

  .pill-tag {
    background: #f1f5f9;
    color: #334155;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
  }

  .pill-tag.green {
    background: #ecfdf5;
    color: #065f46;
  }

  .pill-tag.blue {
    background: #eff6ff;
    color: #1e40af;
  }

  .pill-tag.amber {
    background: #fef3c7;
    color: #92400e;
  }

  /* Recommended Careers Grid */
  .careers-rec-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
    margin-top: 16px;
  }

  .rec-career-card {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 18px;
    background: #f8fafc;
    transition: all 0.2s;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .rec-career-card:hover {
    border-color: #2563eb;
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.08);
  }

  .rec-career-title {
    font-weight: 700;
    color: #0f172a;
    font-size: 15px;
    margin-bottom: 4px;
  }

  .rec-career-salary {
    font-size: 12.5px;
    color: #059669;
    font-weight: 600;
  }

  /* Bottom Actions */
  .next-steps-card {
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    border: 1.5px solid #a7f3d0;
    border-radius: 20px;
    padding: 32px;
    text-align: center;
    margin-top: 28px;
  }

  .next-steps-card h3 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #065f46;
    margin-bottom: 8px;
  }

  .next-steps-card p {
    font-size: 14.5px;
    color: #047857;
    max-width: 580px;
    margin: 0 auto 20px;
    line-height: 1.5;
  }

  .next-steps-btns {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  .btn-next-aptitude {
    background: #059669;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
  }

  .btn-next-aptitude:hover {
    background: #047857;
    color: #ffffff;
  }

  .btn-next-explore {
    background: #ffffff;
    color: #065f46;
    border: 1.5px solid #a7f3d0;
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-next-explore:hover {
    background: #f0fdf4;
  }

  @media print {
    .report-banner, .next-steps-card, .btn-report-action { display: none !important; }
    .report-page { padding: 0; background: #fff; }
    .report-section { box-shadow: none; border: 1px solid #ccc; page-break-inside: avoid; }
  }
</style>
@endsection

@section('content')
<div class="report-page">
  <div class="report-container">

    <!-- Top Banner -->
    <div class="report-banner">
      <div>
        <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; opacity: 0.85; margin-bottom: 4px;">
          Assessment Summary Completed
        </div>
        <h1>Student Analysis Report</h1>
        <p>Generated for <strong>{{ $analysis->full_name }}</strong> on {{ $analysis->created_at->format('d M, Y') }}</p>
      </div>
      <div class="report-actions-top">
        <button type="button" class="btn-report-action" onclick="window.print()">
          <i class="fa-solid fa-print"></i> Print / Save PDF
        </button>
        <a href="{{ route('explore.index') }}#career-assessments" class="btn-report-action">
          <i class="fa-solid fa-shapes"></i> Explore Assessments
        </a>
      </div>
    </div>

    <!-- Archetype Hero Card -->
    <div class="archetype-card">
      <div class="archetype-icon-wrap" style="background: {{ $archetype['bg'] }}; color: {{ $archetype['color'] }};">
        <i class="{{ $archetype['icon'] }}"></i>
      </div>
      <div>
        <span class="archetype-badge" style="background: {{ $archetype['bg'] }}; color: {{ $archetype['color'] }};">
          {{ $archetype['badge'] }}
        </span>
        <h2 class="archetype-title">{{ $archetype['title'] }}</h2>
        <p class="archetype-summary">{{ $archetype['summary'] }}</p>
      </div>
    </div>

    <!-- Section 1: Academic & Target Profile -->
    <div class="report-section">
      <h3 class="section-heading-sm">
        <i class="fa-solid fa-graduation-cap" style="color: #2563eb;"></i> Academic & Target Profile
      </h3>
      <div class="info-grid">
        <div>
          <div class="info-label">Qualification / Class</div>
          <div class="info-value">{{ $analysis->current_class }}</div>
        </div>
        <div>
          <div class="info-label">Current Stream</div>
          <div class="info-value">{{ $analysis->current_stream }}</div>
        </div>
        <div>
          <div class="info-label">City / District</div>
          <div class="info-value">{{ $analysis->city_district }}</div>
        </div>
        <div>
          <div class="info-label">Desired Admission Course</div>
          <div class="info-value" style="color: #2563eb;">{{ $analysis->desired_admission_course }}</div>
        </div>
      </div>

      <div style="margin-top: 18px; padding-top: 14px; border-top: 1px dashed #e2e8f0;">
        <div class="info-label">3-Year Exam Highlights & Top Subjects</div>
        <div class="info-value" style="font-weight: 500; font-size: 13.5px; color: #334155; margin-top: 4px;">
          {{ $analysis->top_subjects_last_3_years }}
        </div>
      </div>
    </div>

    <!-- Section 2: Subject Inclinations & Aptitude -->
    <div class="report-section">
      <h3 class="section-heading-sm">
        <i class="fa-solid fa-book-bookmark" style="color: #059669;"></i> Subject Preferences & Aptitude
      </h3>

      <div style="margin-bottom: 18px;">
        <div class="info-label">Subjects Enjoyed the Most</div>
        <div class="tags-list">
          @if(!empty($analysis->enjoyed_subjects))
            @foreach($analysis->enjoyed_subjects as $sub)
              <span class="pill-tag green"><i class="fa-solid fa-circle-check" style="font-size: 11px;"></i> {{ $sub }}</span>
            @endforeach
          @else
            <span class="info-value" style="font-size: 13px; color: #94a3b8;">None selected</span>
          @endif
        </div>
      </div>

      <div style="margin-bottom: 18px;">
        <div class="info-label">Subjects Found Challenging</div>
        <div class="tags-list">
          @if(!empty($analysis->difficult_subjects))
            @foreach($analysis->difficult_subjects as $sub)
              <span class="pill-tag amber"><i class="fa-solid fa-circle-exclamation" style="font-size: 11px;"></i> {{ $sub }}</span>
            @endforeach
          @else
            <span class="info-value" style="font-size: 13px; color: #94a3b8;">None selected</span>
          @endif
        </div>
      </div>

      @if($analysis->completed_aptitude_test === 'Yes')
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px;">
          <div class="info-label">CareerGyan Aptitude Test Status</div>
          <div class="info-value" style="color: #059669; margin-bottom: 4px;">
            <i class="fa-solid fa-circle-check"></i> Completed Aptitude Test
          </div>
          @if($analysis->aptitude_test_scores)
            <div style="font-size: 13px; color: #475569;">Scores/Notes: {{ $analysis->aptitude_test_scores }}</div>
          @endif
        </div>
      @endif
    </div>

    <!-- Section 3: Skills, Personality & Priorities -->
    <div class="report-section">
      <h3 class="section-heading-sm">
        <i class="fa-solid fa-bolt" style="color: #d97706;"></i> Skills, Work Style & Priorities
      </h3>

      <div class="info-grid" style="margin-bottom: 18px;">
        <div>
          <div class="info-label">Prefers Working With</div>
          <div class="info-value">{{ $analysis->work_with_preference ?? 'Versatile' }}</div>
        </div>
        <div>
          <div class="info-label">Work Style</div>
          <div class="info-value">{{ $analysis->work_style ?? 'Both' }}</div>
        </div>
        <div>
          <div class="info-label">Startup Interest</div>
          <div class="info-value">{{ $analysis->business_startup_interest ?? 'Maybe' }}</div>
        </div>
        <div>
          <div class="info-label">Preferred Location</div>
          <div class="info-value">{{ $analysis->preferred_study_location ?? 'Flexible' }}</div>
        </div>
      </div>

      <div style="margin-bottom: 16px;">
        <div class="info-label">Top Highlighted Skills</div>
        <div class="tags-list">
          @if(!empty($analysis->strongest_skills))
            @foreach($analysis->strongest_skills as $sk)
              <span class="pill-tag blue"><i class="fa-solid fa-star" style="font-size: 10px;"></i> {{ $sk }}</span>
            @endforeach
          @endif
        </div>
      </div>

      <div>
        <div class="info-label">Core Career Priorities</div>
        <div class="tags-list">
          @if(!empty($analysis->career_priorities))
            @foreach($analysis->career_priorities as $prio)
              <span class="pill-tag"><i class="fa-solid fa-check" style="font-size: 10px;"></i> {{ $prio }}</span>
            @endforeach
          @endif
        </div>
      </div>
    </div>

    <!-- Section 4: Recommended Career Fields & Roadmaps -->
    <div class="report-section">
      <h3 class="section-heading-sm">
        <i class="fa-solid fa-compass" style="color: #7c3aed;"></i> Recommended Career Paths for You
      </h3>
      <p style="font-size: 13.5px; color: #64748b; margin-top: -10px;">
        Based on your selected fields ({{ implode(', ', $analysis->interested_career_fields ?? ['All Fields']) }}), here are tailored careers to explore on CareerGyan:
      </p>

      <div class="careers-rec-grid">
        @foreach($matchedCareers as $career)
          <a href="{{ route('career.detail.page', $career->slug) }}" class="rec-career-card">
            <div>
              <div class="rec-career-title">{{ $career->title }}</div>
              <div style="font-size: 12px; color: #64748b; margin-bottom: 8px;">
                {{ Str::limit($career->summary ?? $career->description, 65) }}
              </div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 8px; margin-top: 8px;">
              <span class="rec-career-salary">{{ $career->starting_salary ? '₹' . $career->starting_salary : 'Competitive' }}</span>
              <span style="font-size: 12px; color: #2563eb; font-weight: 700;">View Roadmap &rarr;</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>

    <!-- Next Steps CTA -->
    <div class="next-steps-card">
      <div style="width: 48px; height: 48px; border-radius: 50%; background: #dcfce7; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px; margin: 0 auto 12px;">
        <i class="fa-solid fa-circle-check"></i>
      </div>
      <h3>Take the Aptitude Test to Complement Your Profile</h3>
      <p>
        Combine this qualitative Student Analysis with our scientific 5-dimensional Aptitude Test to get quantified numerical, logical, and spatial scores.
      </p>
      <div class="next-steps-btns">
        <a href="{{ route('test.start') }}" class="btn-next-aptitude">
          <i class="fa-solid fa-brain"></i> Take Current Aptitude Test
        </a>
        <a href="{{ route('explore.index') }}#career-assessments" class="btn-next-explore">
          <i class="fa-solid fa-arrow-left"></i> Back to Career Tests
        </a>
      </div>
    </div>

  </div>
</div>
@endsection

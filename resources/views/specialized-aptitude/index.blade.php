@extends('layouts.app')

@section('title', 'Specialized Aptitude Tests & Courses - Spiritual, Artistic, Sports & Business | CareerGyan')
@section('meta_description', 'Take 20-question specialized aptitude tests in Spiritual, Artistic, Sports, and Business domains. Explore accredited degree and diploma courses in India.')

@section('content')
<style>
  .spec-hub-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
    color: #ffffff;
    padding: 64px 20px 80px;
    position: relative;
    overflow: hidden;
  }
  .spec-hub-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.25) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(236, 72, 153, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 90%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);
    pointer-events: none;
  }
  .spec-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    position: relative;
    z-index: 2;
  }
  .spec-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    color: #f8fafc;
    padding: 6px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 20px;
    text-transform: uppercase;
  }
  .spec-hero-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 44px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
  }
  .spec-hero-title span {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 50%, #34d399 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .spec-hero-desc {
    font-size: 18px;
    line-height: 1.6;
    color: #cbd5e1;
    max-width: 760px;
    margin-bottom: 32px;
  }
  .spec-stats-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 40px;
  }
  .spec-stat-box {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(6px);
    padding: 16px 20px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .spec-stat-num {
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
    font-family: 'Outfit', sans-serif;
  }
  .spec-stat-label {
    font-size: 12.5px;
    color: #94a3b8;
    line-height: 1.3;
    font-weight: 600;
  }
  
  /* Cards Section */
  .spec-cards-section {
    padding: 60px 0 80px;
    background: #f8fafc;
  }
  .spec-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 28px;
  }
  .spec-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    padding: 32px 28px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
  }
  .spec-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.09);
  }
  .spec-card-top-bar {
    height: 6px;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
  }
  .spec-card-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 20px;
  }
  .spec-card-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
  }
  .spec-card-tagline {
    font-size: 13.5px;
    font-weight: 700;
    margin-bottom: 14px;
  }
  .spec-card-desc {
    font-size: 14.5px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 20px;
  }
  .spec-trait-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 600;
    margin-right: 6px;
    margin-bottom: 6px;
  }
  .spec-card-actions {
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .btn-spec-start {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 20px;
    border-radius: 12px;
    color: #ffffff;
    font-weight: 700;
    font-size: 14.5px;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
  }
  .btn-spec-start:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
  }
  .btn-spec-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 18px;
    border-radius: 10px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #334155;
    font-weight: 600;
    font-size: 13.5px;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .btn-spec-secondary:hover {
    background: #f1f5f9;
    color: #0f172a;
  }

  /* Courses Banner */
  .spec-courses-banner {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 36px 40px;
    margin-top: 48px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
  }

  @media(max-width: 768px) {
    .spec-hero-title { font-size: 32px; }
    .spec-hub-hero { padding: 44px 16px 60px; }
    .spec-courses-banner { padding: 24px 20px; flex-direction: column; text-align: center; }
  }
</style>

<!-- Hero Section -->
<section class="spec-hub-hero">
  <div class="spec-container">
    <div class="spec-hero-badge">
      <i class="fa-solid fa-shapes"></i> Specialized Aptitude Evaluators & Courses
    </div>
    <h1 class="spec-hero-title">
      Evaluate Your Calling in <span>Spiritual, Artistic, Sports & Business</span> Aptitude
    </h1>
    <p class="spec-hero-desc">
      Not every talent fits traditional academic molds. Measure your innate instincts with scientific 20-question psychometric tests and explore verified bachelor's degrees, master's programs, and professional diplomas tailored to each field.
    </p>

    <div style="display: flex; gap: 14px; flex-wrap: wrap;">
      <a href="#streams-grid" class="btn-spec-start" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); padding: 14px 26px;">
        <i class="fa-solid fa-play"></i> Explore All 4 Streams
      </a>
      <a href="{{ route('specialized-aptitude.courses') }}" class="btn-spec-secondary" style="background: rgba(255,255,255,0.15); color: #fff; border-color: rgba(255,255,255,0.3); padding: 14px 24px;">
        <i class="fa-solid fa-graduation-cap"></i> Browse 24 Specialized Courses
      </a>
    </div>

    <!-- Stats Bar -->
    <div class="spec-stats-bar">
      <div class="spec-stat-box">
        <i class="fa-solid fa-compass" style="font-size: 24px; color: #a78bfa;"></i>
        <div>
          <div class="spec-stat-num">4 Streams</div>
          <div class="spec-stat-label">Spiritual, Art, Sports, Business</div>
        </div>
      </div>
      <div class="spec-stat-box">
        <i class="fa-solid fa-clipboard-question" style="font-size: 24px; color: #f472b6;"></i>
        <div>
          <div class="spec-stat-num">20 Questions</div>
          <div class="spec-stat-label">Fast, scientific 15-min assessment</div>
        </div>
      </div>
      <div class="spec-stat-box">
        <i class="fa-solid fa-building-columns" style="font-size: 24px; color: #34d399;"></i>
        <div>
          <div class="spec-stat-num">24 Courses</div>
          <div class="spec-stat-label">Degree & diploma curriculum mapped</div>
        </div>
      </div>
      <div class="spec-stat-box">
        <i class="fa-solid fa-award" style="font-size: 24px; color: #fbbf24;"></i>
        <div>
          <div class="spec-stat-num">Instant Report</div>
          <div class="spec-stat-label">Score, mastery level & careers</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Streams Grid Section -->
<section id="streams-grid" class="spec-cards-section">
  <div class="spec-container">
    <div style="text-align: center; margin-bottom: 44px;">
      <span style="font-size: 13px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.8px;">
        Select an Aptitude Dimension
      </span>
      <h2 style="font-family: 'Outfit', 'Sora', sans-serif; font-size: 34px; font-weight: 800; color: #0f172a; margin-top: 6px;">
        Choose Your Specialized Aptitude Assessment
      </h2>
      <p style="color: #64748b; font-size: 16px; max-width: 640px; margin: 8px auto 0;">
        Each evaluation features 20 randomized scenario-based questions with instant psychometric grading, answersheet breakdown, and direct course pathways.
      </p>
    </div>

    <div class="spec-grid">
      @foreach($categories as $cat)
        @php
          $catCourses = $courses[$cat['key']] ?? collect();
        @endphp
        <div class="spec-card">
          <div class="spec-card-top-bar" style="background: {{ $cat['color'] }};"></div>
          
          <div>
            <div class="spec-card-icon" style="background: {{ $cat['bg_light'] }}; color: {{ $cat['color'] }};">
              <i class="{{ $cat['icon'] }}"></i>
            </div>

            <h3 class="spec-card-title">{{ $cat['name'] }}</h3>
            <div class="spec-card-tagline" style="color: {{ $cat['color_dark'] }};">
              {{ $cat['tagline'] }}
            </div>

            <p class="spec-card-desc">
              {{ $cat['description'] }}
            </p>

            <div style="margin-bottom: 16px;">
              <div style="font-size: 11.5px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                Evaluated Traits & Focus Areas:
              </div>
              <div>
                @foreach($cat['focus_traits'] as $trait)
                  <span class="spec-trait-pill" style="background: {{ $cat['bg_light'] }}; color: {{ $cat['color_dark'] }};">
                    <i class="fa-solid fa-check" style="font-size: 10px;"></i> {{ $trait }}
                  </span>
                @endforeach
              </div>
            </div>

            @if($catCourses->isNotEmpty())
              <div style="background: #f8fafc; border-radius: 12px; padding: 12px 14px; border: 1px solid #f1f5f9; margin-top: 14px;">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">
                  Popular Programs:
                </div>
                <div style="font-size: 13px; color: #1e293b; font-weight: 600;">
                  @foreach($catCourses->take(2) as $c)
                    <div style="margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                      <i class="fa-solid fa-graduation-cap" style="color: {{ $cat['color'] }}; font-size: 11px;"></i>
                      <span>{{ $c->title }}</span>
                      <span style="font-size: 11px; color: #94a3b8; margin-left: auto;">{{ $c->level }}</span>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <div class="spec-card-actions">
            <a href="{{ route('specialized-aptitude.quiz', $cat['key']) }}" class="btn-spec-start" style="background: {{ $cat['color'] }};">
              <i class="fa-solid fa-pen-to-square"></i> Take 20-Q Assessment
            </a>
            <a href="{{ route('specialized-aptitude.show', $cat['key']) }}" class="btn-spec-secondary">
              <i class="fa-solid fa-circle-info"></i> View Section & Courses ({{ $catCourses->count() }})
            </a>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Courses Callout Banner -->
    <div class="spec-courses-banner">
      <div>
        <span style="font-size: 12px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px;">
          Comprehensive Curriculum Guide
        </span>
        <h3 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: #0f172a; margin: 4px 0 8px;">
          Looking for Degrees, Diplomas & Certifications?
        </h3>
        <p style="color: #64748b; font-size: 14.5px; margin: 0; max-width: 600px;">
          Explore all 24 curated courses across Spiritual, Artistic, Sports, and Business fields with eligibility, top universities in India, average fees, and career salary ranges.
        </p>
      </div>
      <div>
        <a href="{{ route('specialized-aptitude.courses') }}" class="btn-spec-start" style="background: #0f172a; padding: 14px 28px;">
          <i class="fa-solid fa-graduation-cap"></i> Browse All Courses <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>
@endsection

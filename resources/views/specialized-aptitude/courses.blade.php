@extends('layouts.app')

@section('title', 'Specialized Courses & Degrees - Spiritual, Art, Sports, Business | CareerGyan')
@section('meta_description', 'Explore accredited degree and diploma courses in Spiritual, Artistic, Sports, and Business fields with eligibility, top colleges, and career prospects.')

@section('content')
<style>
  .spec-courses-page {
    background: #f8fafc;
    min-height: 90vh;
    padding: 40px 16px 80px;
  }
  .spec-courses-wrap {
    max-width: 1200px;
    margin: 0 auto;
  }

  .courses-hero-banner {
    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
    border-radius: 24px;
    padding: 44px 36px;
    color: #ffffff;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
  }
  .courses-hero-banner::after {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.3) 0%, transparent 70%);
    pointer-events: none;
  }
  .courses-banner-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 34px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 10px;
  }
  .courses-banner-sub {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 720px;
    line-height: 1.6;
    margin-bottom: 24px;
  }

  /* Filters Bar */
  .filter-panel {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    padding: 24px 28px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  }
  .category-pill-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
  }
  .cat-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid transparent;
  }
  .cat-filter-btn.active {
    background: #0f172a;
    color: #ffffff;
  }
  .cat-filter-btn:not(.active) {
    background: #f1f5f9;
    color: #475569;
  }
  .cat-filter-btn:hover:not(.active) {
    background: #e2e8f0;
    color: #0f172a;
  }

  /* Search & Level Row */
  .search-level-row {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
  }
  .course-search-box {
    flex: 2;
    min-width: 260px;
    position: relative;
  }
  .course-search-box i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
  }
  .course-search-box input {
    width: 100%;
    padding: 12px 14px 12px 40px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
  }
  .level-select-box {
    flex: 1;
    min-width: 200px;
  }
  .level-select-box select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
    background: #fff;
  }

  /* Courses Grid */
  .course-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 24px;
  }
  @media(max-width: 480px) {
    .course-cards-grid { grid-template-columns: 1fr; }
  }

  .course-full-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 26px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .course-full-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 30px rgba(0, 0, 0, 0.07);
    border-color: #cbd5e1;
  }

  .course-domain-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 999px;
    margin-bottom: 12px;
    text-transform: uppercase;
  }
  .course-full-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
    margin-bottom: 8px;
  }
  .course-duration-bar {
    display: flex;
    gap: 12px;
    font-size: 12.5px;
    color: #64748b;
    margin-bottom: 12px;
  }
  .course-full-desc {
    font-size: 13.5px;
    color: #475569;
    line-height: 1.55;
    margin-bottom: 16px;
  }

  .course-detail-row {
    background: #f8fafc;
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 14px;
    font-size: 12.5px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .detail-label {
    font-size: 11px;
    color: #94a3b8;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 2px;
  }
  .detail-value {
    font-weight: 600;
    color: #1e293b;
  }

  .skills-tag-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 14px;
  }
  .skill-pill {
    font-size: 11px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #475569;
  }

  .course-card-bottom {
    margin-top: 18px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
  }
  .btn-take-cat-test {
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 12.5px;
    font-weight: 700;
    text-decoration: none;
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
  }
  .btn-take-cat-test:hover {
    color: #ffffff;
    transform: translateY(-1px);
    filter: brightness(1.1);
  }
</style>

<div class="spec-courses-page">
  <div class="spec-courses-wrap">

    <!-- Hero Banner -->
    <div class="courses-hero-banner">
      <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); padding: 4px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 12px; text-transform: uppercase;">
        <i class="fa-solid fa-graduation-cap"></i> Specialized Academic & Vocational Curriculum
      </div>
      <h1 class="courses-banner-title">
        Specialized Degree, Diploma & Professional Programs
      </h1>
      <p class="courses-banner-sub">
        Explore 24 verified educational courses tailored to Spiritual, Artistic, Sports, and Business aptitude. Benchmark admission eligibility, average annual fees, top institutions in India, and industry salary ranges.
      </p>

      <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="{{ route('specialized-aptitude.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; background: #fff; color: #0f172a; font-weight: 700; font-size: 13.5px; text-decoration: none;">
          <i class="fa-solid fa-shapes"></i> Take Specialized Aptitude Tests
        </a>
      </div>
    </div>

    <!-- Filter Panel -->
    <div class="filter-panel">
      <!-- Category Pills -->
      <div class="category-pill-row">
        <a href="{{ route('specialized-aptitude.courses', ['category' => null, 'level' => request('level'), 'search' => request('search')]) }}" class="cat-filter-btn {{ $selectedCategory === 'all' ? 'active' : '' }}">
          All 4 Streams (24)
        </a>
        <a href="{{ route('specialized-aptitude.courses', ['category' => 'spiritual', 'level' => request('level'), 'search' => request('search')]) }}" class="cat-filter-btn {{ $selectedCategory === 'spiritual' ? 'active' : '' }}" style="{{ $selectedCategory === 'spiritual' ? 'background: #8b5cf6;' : '' }}">
          <i class="fa-solid fa-om"></i> Spiritual (6)
        </a>
        <a href="{{ route('specialized-aptitude.courses', ['category' => 'artistic', 'level' => request('level'), 'search' => request('search')]) }}" class="cat-filter-btn {{ $selectedCategory === 'artistic' ? 'active' : '' }}" style="{{ $selectedCategory === 'artistic' ? 'background: #ec4899;' : '' }}">
          <i class="fa-solid fa-palette"></i> Artistic (6)
        </a>
        <a href="{{ route('specialized-aptitude.courses', ['category' => 'sports', 'level' => request('level'), 'search' => request('search')]) }}" class="cat-filter-btn {{ $selectedCategory === 'sports' ? 'active' : '' }}" style="{{ $selectedCategory === 'sports' ? 'background: #10b981;' : '' }}">
          <i class="fa-solid fa-medal"></i> Sports (6)
        </a>
        <a href="{{ route('specialized-aptitude.courses', ['category' => 'business', 'level' => request('level'), 'search' => request('search')]) }}" class="cat-filter-btn {{ $selectedCategory === 'business' ? 'active' : '' }}" style="{{ $selectedCategory === 'business' ? 'background: #f59e0b;' : '' }}">
          <i class="fa-solid fa-briefcase"></i> Business (6)
        </a>
      </div>

      <!-- Search & Level Filters -->
      <form method="GET" action="{{ route('specialized-aptitude.courses', ['category' => $selectedCategory !== 'all' ? $selectedCategory : null]) }}" class="search-level-row">
        <div class="course-search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="search" placeholder="Search by course name, college, or eligibility..." value="{{ request('search') }}">
        </div>

        <div class="level-select-box">
          <select name="level" onchange="this.form.submit()">
            <option value="all">All Qualification Levels</option>
            <option value="Bachelor Degree" {{ request('level') === 'Bachelor Degree' ? 'selected' : '' }}>Bachelor Degree (UG)</option>
            <option value="Master Degree" {{ request('level') === 'Master Degree' ? 'selected' : '' }}>Master Degree (PG)</option>
            <option value="Diploma" {{ request('level') === 'Diploma' ? 'selected' : '' }}>Diploma Programs</option>
            <option value="Certification" {{ request('level') === 'Certification' ? 'selected' : '' }}>Professional Certifications</option>
          </select>
        </div>

        <button type="submit" style="padding: 12px 20px; border-radius: 10px; border: none; background: #0f172a; color: #fff; font-weight: 700; font-size: 14px; cursor: pointer;">
          Apply Filters
        </button>

        @if(request('search') || request('level'))
          <a href="{{ route('specialized-aptitude.courses', ['category' => $selectedCategory !== 'all' ? $selectedCategory : null]) }}" style="padding: 12px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 13.5px; text-decoration: none; display: inline-flex; align-items: center;">
            Clear
          </a>
        @endif
      </form>
    </div>

    <!-- Courses Grid -->
    <div class="course-cards-grid">
      @forelse($courses as $course)
        @php
          $catMeta = $categories[$course->category] ?? [
            'name' => ucfirst($course->category),
            'color' => '#2563eb',
            'bg_light' => '#eff6ff',
            'color_dark' => '#1d4ed8',
            'icon' => 'fa-solid fa-shapes',
          ];
        @endphp
        <div class="course-full-card">
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <span class="course-domain-badge" style="background: {{ $catMeta['bg_light'] }}; color: {{ $catMeta['color_dark'] }};">
                <i class="{{ $catMeta['icon'] }}"></i> {{ $catMeta['name'] }}
              </span>
              <span style="font-size: 11.5px; font-weight: 700; color: #64748b; background: #f1f5f9; padding: 3px 8px; border-radius: 999px;">
                {{ $course->level }}
              </span>
            </div>

            <h2 class="course-full-title">{{ $course->title }}</h2>

            <div class="course-duration-bar">
              <span><i class="fa-regular fa-clock"></i> Duration: <strong>{{ $course->duration }}</strong></span>
            </div>

            <p class="course-full-desc">
              {{ $course->description }}
            </p>

            <div class="course-detail-row">
              <div>
                <div class="detail-label">Eligibility</div>
                <div class="detail-value">{{ $course->eligibility }}</div>
              </div>
              <div>
                <div class="detail-label">Salary Range</div>
                <div class="detail-value" style="color: #059669; font-weight: 700;">{{ $course->salary_range ?: 'Benchmark Level' }}</div>
              </div>
              <div>
                <div class="detail-label">Average Annual Fees</div>
                <div class="detail-value">{{ $course->average_fees ?: 'Standard' }}</div>
              </div>
              <div>
                <div class="detail-label">Top Roles</div>
                <div class="detail-value">{{ !empty($course->career_roles) ? implode(', ', array_slice($course->career_roles, 0, 2)) : 'Specialist' }}</div>
              </div>
            </div>

            @if(!empty($course->key_skills) && is_array($course->key_skills))
              <div class="skills-tag-wrap">
                @foreach($course->key_skills as $sk)
                  <span class="skill-pill">{{ $sk }}</span>
                @endforeach
              </div>
            @endif

            @if(!empty($course->top_colleges) && is_array($course->top_colleges))
              <div style="font-size: 12px; color: #64748b; margin-top: 6px;">
                <strong style="color: #334155;">Top Colleges:</strong> {{ implode(', ', $course->top_colleges) }}
              </div>
            @endif
          </div>

          <div class="course-card-bottom">
            <a href="{{ route('specialized-aptitude.show', $course->category) }}" style="font-size: 13px; font-weight: 700; color: {{ $catMeta['color'] }}; text-decoration: none;">
              Domain Details &rarr;
            </a>

            <a href="{{ route('specialized-aptitude.quiz', $course->category) }}" class="btn-take-cat-test" style="background: {{ $catMeta['color'] }};">
              <i class="fa-solid fa-play"></i> Take Test
            </a>
          </div>
        </div>
      @empty
        <div style="grid-column: 1 / -1; background: #ffffff; border-radius: 18px; border: 1px solid #e2e8f0; padding: 60px 20px; text-align: center; color: #94a3b8;">
          <i class="fa-solid fa-magnifying-glass" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
          <h3 style="font-family: 'Outfit', sans-serif; font-size: 20px; color: #1e293b; margin-bottom: 6px;">No Courses Found</h3>
          <p style="font-size: 14px; margin-bottom: 20px;">Try adjusting your search criteria or clearing filters.</p>
          <a href="{{ route('specialized-aptitude.courses') }}" style="padding: 10px 20px; border-radius: 8px; background: #0f172a; color: #fff; font-weight: 700; font-size: 13.5px; text-decoration: none;">
            View All Courses
          </a>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($courses->hasPages())
      <div style="margin-top: 36px;">
        {{ $courses->links() }}
      </div>
    @endif

  </div>
</div>
@endsection


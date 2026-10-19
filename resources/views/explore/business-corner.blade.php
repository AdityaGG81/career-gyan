@extends('layouts.app')

@section('title', 'Business Corner - Opportunities, Initial Investment & Skills | CareerGyan')
@section('meta_description', 'Explore top business opportunities across Retail, Wholesale, IT, Software, Electronics, Food, and more. Complete with initial investment requirements, hard technical skills, and essential soft skills.')

@section('styles')
<style>
  :root {
    --biz-dark: #0f172a;
    --biz-dark-surface: #1e293b;
    --biz-gold: #f59e0b;
    --biz-gold-light: #fef3c7;
    --biz-blue: #2563eb;
    --biz-blue-light: #eff6ff;
    --biz-green: #10b981;
    --biz-purple: #8b5cf6;
    --biz-bg: #f8fafc;
    --biz-border: #e2e8f0;
  }

  /* ─── Hero Section ─── */
  .biz-hero {
    background: radial-gradient(circle at 20% 20%, #1e3a8a 0%, #0f172a 60%, #090d16 100%);
    color: #ffffff;
    padding: 75px 0 55px;
    position: relative;
    overflow: hidden;
    border-bottom: 4px solid var(--biz-gold);
  }

  .biz-hero-glow {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, transparent 70%);
    top: -150px;
    right: -100px;
    pointer-events: none;
  }

  .biz-breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #94a3b8;
    margin-bottom: 20px;
  }

  .biz-breadcrumbs a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.2s;
  }

  .biz-breadcrumbs a:hover {
    color: var(--biz-gold);
  }

  .biz-badge-top {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(245, 158, 11, 0.15);
    border: 1px solid rgba(245, 158, 11, 0.35);
    color: var(--biz-gold);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 18px;
  }

  .biz-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(30px, 4.5vw, 48px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
  }

  .biz-hero h1 span {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #f97316 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .biz-hero-desc {
    font-size: 16.5px;
    color: #cbd5e1;
    max-width: 820px;
    line-height: 1.6;
    margin-bottom: 32px;
  }

  /* Stats Row */
  .biz-hero-stats {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-top: 10px;
  }

  .hero-stat-pill {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 10px 18px;
    border-radius: 14px;
  }

  .hero-stat-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(245, 158, 11, 0.18);
    color: var(--biz-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
  }

  .hero-stat-info .stat-num {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
  }

  .hero-stat-info .stat-label {
    font-size: 11px;
    color: #94a3b8;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.05em;
  }

  /* ─── Filter Section ─── */
  .biz-filter-panel {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--biz-border);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    margin-top: -30px;
    position: relative;
    z-index: 20;
    padding: 24px;
  }

  /* Category Tabs */
  .category-pill-bar {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 12px;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  .category-pill-bar::-webkit-scrollbar {
    display: none;
  }

  .cat-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    border: 1.5px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    user-select: none;
  }

  .cat-pill:hover {
    background: #f1f5f9;
    color: var(--biz-dark);
    border-color: #cbd5e1;
    transform: translateY(-1px);
  }

  .cat-pill.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.2);
  }

  .cat-pill.active i {
    color: var(--biz-gold);
  }

  .cat-pill .pill-count {
    background: rgba(0, 0, 0, 0.08);
    color: inherit;
    font-size: 11px;
    padding: 2px 7px;
    border-radius: 99px;
    font-weight: 800;
  }

  .cat-pill.active .pill-count {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
  }

  /* Search & Secondary Filter controls */
  .biz-filter-controls {
    display: grid;
    grid-template-columns: 1.8fr 1.3fr 1.2fr 1.1fr;
    gap: 14px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
  }

  .biz-search-box {
    position: relative;
  }

  .biz-search-box i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
  }

  .biz-search-input {
    width: 100%;
    padding: 12px 16px 12px 44px;
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    font-size: 14px;
    color: var(--biz-dark);
    outline: none;
    transition: all 0.2s;
    background: #f8fafc;
  }

  .biz-search-input:focus {
    background: #ffffff;
    border-color: var(--biz-blue);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  }

  .biz-select-control {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    font-size: 14px;
    font-weight: 600;
    color: #334155;
    background: #f8fafc;
    outline: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .biz-select-control:focus {
    border-color: var(--biz-blue);
    background: #ffffff;
  }

  /* ─── Business Opportunity Cards ─── */
  .biz-grid-section {
    padding: 50px 0 80px;
  }

  .biz-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 28px;
  }

  .biz-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--biz-border);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
  }

  .biz-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 22px 35px -5px rgba(15, 23, 42, 0.12);
    border-color: #cbd5e1;
  }

  .biz-card-top {
    padding: 24px 24px 16px;
    border-bottom: 1px solid #f1f5f9;
  }

  .biz-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
  }

  .biz-category-badge {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    padding: 4px 12px;
    border-radius: 99px;
    display: inline-block;
  }

  .cat-retail { background: #dbeafe; color: #1d4ed8; }
  .cat-wholesale { background: #fef3c7; color: #b45309; }
  .cat-it-software { background: #ede9fe; color: #6d28d9; }
  .cat-electronics { background: #e0e7ff; color: #4338ca; }
  .cat-food-hospitality { background: #ffedd5; color: #c2410c; }
  .cat-manufacturing-production { background: #f1f5f9; color: #334155; }
  .cat-healthcare-wellness { background: #ffe4e6; color: #be123c; }
  .cat-education-services { background: #ccfbf1; color: #0f766e; }
  .cat-agriculture-allied { background: #dcfce7; color: #15803d; }
  .cat-creative-digital { background: #fae8ff; color: #86198f; }
  .cat-default { background: #f3f4f6; color: #374151; }

  .biz-risk-badge {
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .risk-low { background: #dcfce7; color: #15803d; }
  .risk-medium { background: #fef9c3; color: #a16207; }
  .risk-high { background: #fee2e2; color: #b91c1c; }

  .biz-card-title-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .biz-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: var(--biz-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .biz-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.3;
    margin: 0;
  }

  .biz-card-desc {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 14px 0 0 0;
  }

  /* Key Metrics Boxes */
  .biz-card-metrics {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    padding: 16px 24px;
    background: #fafaf9;
    border-bottom: 1px solid #f1f5f9;
  }

  .metric-item {
    background: #ffffff;
    padding: 10px 14px;
    border-radius: 12px;
    border: 1px solid #f1f5f9;
  }

  .metric-label {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 0.04em;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 4px;
  }

  .metric-value {
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
  }

  .metric-value.highlight-green {
    color: #15803d;
  }

  /* Skills & Soft Skills Sections on Card */
  .biz-card-skills {
    padding: 20px 24px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .skills-block-title {
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    color: #475569;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 8px;
  }

  .skill-chips-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
  }

  .hard-skill-chip {
    font-size: 11.5px;
    font-weight: 600;
    padding: 4px 10px;
    background: #f1f5f9;
    color: #334155;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
  }

  .soft-skill-chip {
    font-size: 11.5px;
    font-weight: 600;
    padding: 4px 10px;
    background: #fdf2f8;
    color: #9d174d;
    border-radius: 8px;
    border: 1px solid #fbcfe8;
  }

  /* Card Footer Actions */
  .biz-card-footer {
    padding: 16px 24px;
    background: #ffffff;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .btn-view-blueprint {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #0f172a;
    color: #ffffff;
    padding: 9px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
  }

  .btn-view-blueprint:hover {
    background: var(--biz-blue);
    transform: translateX(3px);
  }

  .btn-view-blueprint i {
    color: var(--biz-gold);
    transition: transform 0.2s;
  }

  .btn-view-blueprint:hover i {
    transform: translateX(3px);
  }

  .btn-quick-mudra {
    font-size: 12px;
    font-weight: 700;
    color: #0284c7;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .btn-quick-mudra:hover {
    text-decoration: underline;
  }

  /* ─── Startup Blueprint Modal ─── */
  .biz-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(6px);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: fadeInModal 0.2s ease;
  }

  @keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .biz-modal-container {
    background: #ffffff;
    border-radius: 24px;
    max-width: 780px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border: 1px solid var(--biz-border);
    display: flex;
    flex-direction: column;
    animation: scaleModal 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }

  @keyframes scaleModal {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  .biz-modal-header {
    padding: 24px 28px;
    background: #0f172a;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .modal-close-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
  }

  .modal-close-btn:hover {
    background: rgba(255, 255, 255, 0.25);
  }

  .biz-modal-body {
    padding: 32px 28px;
  }

  .blueprint-section {
    margin-bottom: 28px;
  }

  .blueprint-section-title {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    padding-bottom: 6px;
    border-bottom: 2px solid #f1f5f9;
  }

  /* Guide & Government Schemes Section */
  .guide-container {
    margin-top: 50px;
    padding: 60px 40px;
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border-radius: 30px;
    border: 1px solid #fde68a;
  }

  .guide-steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    margin-top: 36px;
  }

  .guide-step-card {
    background: #ffffff;
    padding: 24px;
    border-radius: 16px;
    border: 1px solid rgba(245, 158, 11, 0.2);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.06);
    position: relative;
  }

  .step-badge {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--biz-gold);
    color: #0f172a;
    font-weight: 900;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
  }

  .schemes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 24px;
    margin-top: 36px;
  }

  .scheme-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--biz-border);
    padding: 26px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    position: relative;
    overflow: hidden;
  }

  .scheme-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.12);
    border-color: #cbd5e1;
  }

  .scheme-card-top {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 16px;
  }

  .scheme-icon-wrap {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: #eff6ff;
    color: var(--biz-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }

  .scheme-subsidy-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    padding: 4px 10px;
    border-radius: 6px;
    margin-bottom: 8px;
  }

  /* Responsive Rules */
  @media (max-width: 991px) {
    .biz-filter-controls {
      grid-template-columns: 1fr;
    }
    .schemes-grid {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .biz-hero {
      padding: 50px 0 40px;
    }
    .biz-hero h1 {
      font-size: 28px;
    }
    .biz-hero-desc {
      font-size: 14.5px;
    }
    .biz-cards-grid {
      grid-template-columns: 1fr;
    }
    .guide-container {
      padding: 32px 20px;
    }
  }
</style>
@endsection

@section('content')

<!-- HERO SECTION -->
<section class="biz-hero">
  <div class="biz-hero-glow"></div>
  <div class="container" style="position: relative; z-index: 2;">
    <!-- Breadcrumbs -->
    <div class="biz-breadcrumbs">
      <a href="{{ url('/') }}">Home</a>
      <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
      <a href="{{ route('explore.index') }}">Explore</a>
      <i class="fa-solid fa-angle-right" style="font-size: 10px;"></i>
      <span style="color: var(--biz-gold); font-weight: 700;">Business Corner</span>
    </div>

    <!-- Badge -->
    <div class="biz-badge-top">
      <i class="fa-solid fa-rocket"></i> CareerGyan Entrepreneurship Hub
    </div>

    <h1>
      Business Corner: <span>Be Your Own Boss</span>
    </h1>
    <p class="biz-hero-desc">
      Explore high-potential business opportunities across <strong>Retail, Wholesale, IT, Software, Electronics</strong>, and more. 
      Review accurate breakdowns of initial investments required, core technical hard skills, and essential soft skills to turn your vision into a profitable reality.
    </p>

    <!-- Stats Bar -->
    <div class="biz-hero-stats">
      <div class="hero-stat-pill">
        <div class="hero-stat-icon"><i class="fa-solid fa-briefcase"></i></div>
        <div class="hero-stat-info">
          <div class="stat-num">{{ $allIdeas->count() }}+</div>
          <div class="stat-label">Opportunities</div>
        </div>
      </div>

      <div class="hero-stat-pill">
        <div class="hero-stat-icon" style="background: rgba(16, 185, 129, 0.18); color: #10b981;"><i class="fa-solid fa-indian-rupee-sign"></i></div>
        <div class="hero-stat-info">
          <div class="stat-num">From ₹20K</div>
          <div class="stat-label">Low Capital Starts</div>
        </div>
      </div>

      <div class="hero-stat-pill">
        <div class="hero-stat-icon" style="background: rgba(139, 92, 246, 0.18); color: #8b5cf6;"><i class="fa-solid fa-shapes"></i></div>
        <div class="hero-stat-info">
          <div class="stat-num">{{ count($categories) }} Sectors</div>
          <div class="stat-label">Retail, IT, Wholesale...</div>
        </div>
      </div>

      <div class="hero-stat-pill">
        <div class="hero-stat-icon" style="background: rgba(59, 130, 246, 0.18); color: #3b82f6;"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="hero-stat-info">
          <div class="stat-num">Complete</div>
          <div class="stat-label">Skill Roadmaps</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT CONTAINER -->
<div class="container" style="position: relative; z-index: 10;">

  <!-- FILTER & SEARCH PANEL -->
  <div class="biz-filter-panel">
    <!-- Category Navigation Pills -->
    <div class="category-pill-bar" id="categoryTabs">
      <button class="cat-pill active" data-slug="all" onclick="filterCategory('all', this)">
        <i class="fa-solid fa-border-all"></i> All Sectors
        <span class="pill-count">{{ $allIdeas->count() }}</span>
      </button>

      @php
        $catIcons = [
          'Retail' => 'fa-store',
          'Wholesale' => 'fa-boxes-stacked',
          'IT & Software' => 'fa-laptop-code',
          'Electronics' => 'fa-microchip',
          'Food & Hospitality' => 'fa-utensils',
          'Manufacturing & Production' => 'fa-industry',
          'Healthcare & Wellness' => 'fa-heart-pulse',
          'Education & Services' => 'fa-graduation-cap',
          'Agriculture & Allied' => 'fa-leaf',
          'Creative & Digital' => 'fa-palette',
        ];
      @endphp

      @foreach($categories as $catName => $count)
        <button class="cat-pill" data-slug="{{ Str::slug($catName) }}" onclick="filterCategory('{{ Str::slug($catName) }}', this)">
          <i class="fa-solid {{ $catIcons[$catName] ?? 'fa-tag' }}"></i> {{ $catName }}
          <span class="pill-count">{{ $count }}</span>
        </button>
      @endforeach
    </div>

    <!-- Search & Select Controls -->
    <div class="biz-filter-controls">
      <div class="biz-search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="bizSearchInput" class="biz-search-input" placeholder="Search businesses, skills, keywords (e.g., Kirana, Coding, Electronics, Wholesale)..." oninput="applyAllFilters()">
      </div>

      <!-- Sector / Category Dropdown -->
      <div>
        <select id="sectorFilter" class="biz-select-control" onchange="onSectorDropdownChange(this.value)">
          <option value="all">🏢 All Business Sectors ({{ $allIdeas->count() }})</option>
          @foreach($categories as $catName => $count)
            <option value="{{ Str::slug($catName) }}">
              {{ $catName }} ({{ $count }})
            </option>
          @endforeach
        </select>
      </div>

      <!-- Investment Budget Dropdown -->
      <div>
        <select id="budgetFilter" class="biz-select-control" onchange="applyAllFilters()">
          <option value="all">💰 All Investment Budgets</option>
          <option value="under-50k">Under ₹50,000</option>
          <option value="50k-2l">₹50,000 - ₹2 Lakhs</option>
          <option value="2l-5l">₹2 Lakhs - ₹5 Lakhs</option>
          <option value="above-5l">₹5 Lakhs & Above</option>
        </select>
      </div>

      <!-- Risk Level Dropdown -->
      <div>
        <select id="riskFilter" class="biz-select-control" onchange="applyAllFilters()">
          <option value="all">⚡ All Risk Levels</option>
          <option value="low">Low Risk</option>
          <option value="medium">Medium Risk</option>
          <option value="high">High Risk</option>
        </select>
      </div>
    </div>
  </div>

  <!-- BUSINESS OPPORTUNITIES GRID SECTION -->
  <section class="biz-grid-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h2 style="font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
          Possible Business Opportunities
        </h2>
        <p style="font-size: 14px; color: #64748b; margin: 4px 0 0 0;">
          Showing <span id="visibleCount" style="font-weight: 700; color: var(--biz-blue);">{{ $allIdeas->count() }}</span> businesses
        </p>
      </div>

      <div style="display: flex; gap: 8px;">
        <a href="#launchGuide" style="font-size: 13px; font-weight: 700; color: #d97706; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; background: #fef3c7; padding: 8px 14px; border-radius: 99px;">
          <i class="fa-solid fa-lightbulb"></i> Startup Steps
        </a>
        <a href="#govtSchemes" style="font-size: 13px; font-weight: 700; color: #2563eb; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; padding: 8px 14px; border-radius: 99px;">
          <i class="fa-solid fa-building-columns"></i> Mudra & Govt Loans
        </a>
      </div>
    </div>

    <!-- Cards Grid -->
    <div class="biz-cards-grid" id="bizCardsGrid">
      @foreach($allIdeas as $biz)
        @php
          $catSlug = Str::slug($biz->category);
          $catClass = 'cat-' . $catSlug;
          $riskClass = 'risk-' . strtolower($biz->risk_level);
          
          // Investment grouping for quick filter
          $invRaw = strtolower($biz->effective_investment);
          $invBracket = '50k-2l';
          if ((str_contains($invRaw, '20,000') || str_contains($invRaw, '25,000') || str_contains($invRaw, '30,000') || str_contains($invRaw, '40,000') || str_contains($invRaw, '20k') || str_contains($invRaw, '30k') || str_contains($invRaw, '40k')) && !str_contains($invRaw, '2l') && !str_contains($invRaw, '3l') && !str_contains($invRaw, '4l') && !str_contains($invRaw, '5l')) {
              $invBracket = 'under-50k';
          } elseif (str_contains($invRaw, '6,00,000') || str_contains($invRaw, '7,00,000') || str_contains($invRaw, '8,00,000') || str_contains($invRaw, '10,00,000') || str_contains($invRaw, '6 lakh') || str_contains($invRaw, '7 lakh') || str_contains($invRaw, '8 lakh') || str_contains($invRaw, '10 lakh')) {
              $invBracket = 'above-5l';
          } elseif (str_contains($invRaw, '2 lakh') || str_contains($invRaw, '2.5 lakh') || str_contains($invRaw, '3 lakh') || str_contains($invRaw, '3.5 lakh') || str_contains($invRaw, '4 lakh') || str_contains($invRaw, '4.5 lakh') || str_contains($invRaw, '5 lakh') || str_contains($invRaw, '2,00,000') || str_contains($invRaw, '3,00,000') || str_contains($invRaw, '4,00,000') || str_contains($invRaw, '5,00,000')) {
              $invBracket = '2l-5l';
          } else {
              $invBracket = '50k-2l';
          }
        @endphp

        <div class="biz-card" 
             data-category="{{ $catSlug }}" 
             data-risk="{{ strtolower($biz->risk_level) }}" 
             data-bracket="{{ $invBracket }}"
             data-name="{{ strtolower($biz->name) }}"
             data-skills="{{ strtolower($biz->skills_required . ' ' . $biz->soft_skills . ' ' . $biz->category) }}">
          
          <!-- Card Top: Category, Risk, Title, Description -->
          <div class="biz-card-top">
            <div class="biz-card-header">
              <span class="biz-category-badge {{ $catClass }}">
                {{ $biz->category }}
              </span>
              <span class="biz-risk-badge {{ $riskClass }}">
                <i class="fa-solid fa-shield-halved"></i> {{ $biz->risk_level }} Risk
              </span>
            </div>

            <div class="biz-card-title-wrap">
              <div class="biz-avatar">
                <i class="fa-solid {{ $biz->icon ?: 'fa-store' }}"></i>
              </div>
              <h3 class="biz-card-title">{{ $biz->name }}</h3>
            </div>

            <p class="biz-card-desc">{{ Str::limit($biz->description, 130) }}</p>
          </div>

          <!-- Key Metrics: Investment, Profit, Break-even -->
          <div class="biz-card-metrics">
            <div class="metric-item">
              <div class="metric-label">
                <i class="fa-solid fa-wallet" style="color: #2563eb;"></i> Initial Investment
              </div>
              <div class="metric-value">
                {{ $biz->effective_investment }}
              </div>
            </div>

            <div class="metric-item">
              <div class="metric-label">
                <i class="fa-solid fa-chart-line" style="color: #10b981;"></i> Profit Margin
              </div>
              <div class="metric-value highlight-green">
                {{ $biz->profit_margin ?: '20% - 35%' }}
              </div>
            </div>

            @if($biz->break_even_period)
              <div class="metric-item" style="grid-column: span 2;">
                <div class="metric-label">
                  <i class="fa-regular fa-clock" style="color: #d97706;"></i> Expected Break-Even: 
                  <strong style="color: #0f172a; text-transform: none; margin-left: 4px;">{{ $biz->break_even_period }}</strong>
                  <span style="color: #94a3b8; margin: 0 4px;">•</span>
                  <span>Launch in {{ $biz->start_time ?: '2-4 Weeks' }}</span>
                </div>
              </div>
            @endif
          </div>

          <!-- Skills Required (Hard Skills & Soft Skills) -->
          <div class="biz-card-skills">
            <!-- Hard Skills Required -->
            <div>
              <div class="skills-block-title">
                <i class="fa-solid fa-gears" style="color: #2563eb;"></i> Skills Required (Hard / Technical)
              </div>
              <div class="skill-chips-wrap">
                @forelse(array_slice($biz->skills_list, 0, 4) as $skill)
                  <span class="hard-skill-chip">{{ $skill }}</span>
                @empty
                  <span class="hard-skill-chip">General Business Knowledge</span>
                @endforelse
                @if(count($biz->skills_list) > 4)
                  <span style="font-size: 11px; color: #64748b; font-weight: 700; align-self: center;">
                    +{{ count($biz->skills_list) - 4 }} more
                  </span>
                @endif
              </div>
            </div>

            <!-- Soft Skills Required -->
            <div>
              <div class="skills-block-title">
                <i class="fa-solid fa-handshake" style="color: #db2777;"></i> Soft Skills Required
              </div>
              <div class="skill-chips-wrap">
                @forelse(array_slice($biz->soft_skills_list, 0, 3) as $soft)
                  <span class="soft-skill-chip">{{ $soft }}</span>
                @empty
                  <span class="soft-skill-chip">Communication & Negotiation</span>
                @endforelse
                @if(count($biz->soft_skills_list) > 3)
                  <span style="font-size: 11px; color: #db2777; font-weight: 700; align-self: center;">
                    +{{ count($biz->soft_skills_list) - 3 }} more
                  </span>
                @endif
              </div>
            </div>
          </div>

          <!-- Card Footer -->
          <div class="biz-card-footer">
            <a href="#govtSchemes" class="btn-quick-mudra" title="Check Mudra collateral-free loan for this business">
              <i class="fa-solid fa-building-columns"></i> Mudra Eligible
            </a>

            <button type="button" class="btn-view-blueprint" onclick="openBlueprintModal({{ json_encode($biz) }})">
              <span>View Blueprint</span> <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Empty State -->
    <div id="noBizResults" style="display: none; text-align: center; padding: 60px 20px; background: #ffffff; border-radius: 20px; border: 1px dashed var(--biz-border); margin-top: 30px;">
      <i class="fa-solid fa-magnifying-glass" style="font-size: 40px; color: #94a3b8; margin-bottom: 16px;"></i>
      <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; color: #0f172a; margin-bottom: 8px;">No Businesses Found</h3>
      <p style="color: #64748b; font-size: 14.5px; max-width: 450px; margin: 0 auto 20px;">
        Try adjusting your category filter, investment budget, or search query to see other business ideas.
      </p>
      <button onclick="resetAllFilters()" style="padding: 10px 20px; background: #0f172a; color: #fff; border-radius: 99px; font-weight: 700; font-size: 13px; border: none; cursor: pointer;">
        Clear All Filters
      </button>
    </div>
  </section>

  <!-- STEP-BY-STEP LAUNCH GUIDE SECTION -->
  <section class="guide-container" id="launchGuide">
    <div style="text-align: center; max-width: 700px; margin: 0 auto;">
      <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #b45309; background: rgba(245, 158, 11, 0.25); padding: 4px 14px; border-radius: 99px;">
        🚀 Execution Blueprint
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: clamp(24px, 3.5vw, 36px); font-weight: 800; color: #0f172a; margin: 14px 0 8px;">
        5 Steps to Launch Your Business
      </h2>
      <p style="color: #78350f; font-size: 15.5px; margin: 0;">
        You don't need millions to start. Start lean, test your market, refine your skills, and scale with profits.
      </p>
    </div>

    <div class="guide-steps-grid">
      <div class="guide-step-card">
        <div class="step-badge">1</div>
        <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Pick Niche & Survey</h4>
        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
          Select an opportunity matching your background. Talk to at least 25 potential local customers about what they currently miss.
        </p>
      </div>

      <div class="guide-step-card">
        <div class="step-badge">2</div>
        <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Master Core Skills</h4>
        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
          Bridge hard technical skills (inventory, billing, technical craft) and practice interpersonal negotiation & customer empathy.
        </p>
      </div>

      <div class="guide-step-card">
        <div class="step-badge">3</div>
        <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Setup & Funding</h4>
        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
          Calculate initial investment needed. Apply for collateral-free Mudra Shishu/Kishore loans or begin with personal savings.
        </p>
      </div>

      <div class="guide-step-card">
        <div class="step-badge">4</div>
        <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Go Digital & Launch</h4>
        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
          Create a Google Business Profile, WhatsApp Business catalogue, and Instagram presence to attract direct orders from day 1.
        </p>
      </div>

      <div class="guide-step-card">
        <div class="step-badge">5</div>
        <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Reinvest & Scale</h4>
        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
          Achieve break-even within 3-6 months. Reinvest 50% of monthly net profits to expand product variety and hire assistants.
        </p>
      </div>
    </div>
  </section>

  <!-- GOVERNMENT SUPPORT & SCHEMES SECTION -->
  <section style="margin: 60px 0 80px;" id="govtSchemes">
    <div style="text-align: center; margin-bottom: 30px;">
      <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #2563eb; background: #eff6ff; padding: 4px 14px; border-radius: 99px;">
        🏛️ Government Subsidies & Financial Schemes
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: #0f172a; margin: 12px 0 6px;">
        Empowering Indian Startups & Micro-Enterprises
      </h2>
      <p style="color: #64748b; font-size: 15px; max-width: 680px; margin: 0 auto;">
        Leverage official central government capital subsidies up to 35%, interest rebates, collateral-free credit lines, and MSME grants designed to launch and scale your venture.
      </p>
    </div>

    <div class="schemes-grid">
      <!-- 1. PMEGP (Prime Minister's Employment Generation Programme) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #ecfdf5; color: #059669;">
              <i class="fa-solid fa-percent"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #dcfce7; color: #15803d;">
                Up to 35% Capital Subsidy
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                PMEGP Scheme (KVIC / MSME)
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Prime Minister’s flagship credit-linked subsidy programme providing massive non-refundable capital support:
            <br>• <strong>Max Project Cost:</strong> Up to ₹50 Lakhs for Manufacturing, ₹20 Lakhs for Service / Retail
            <br>• <strong>Government Subsidy:</strong> 15% to 25% for General category, and <strong>25% to 35%</strong> for Women, SC/ST, OBC, and Rural areas
            <br>• <strong>Own Contribution:</strong> Only 5% to 10% own equity needed; balance funded by bank loans
          </p>
        </div>
        <a href="https://www.kviconline.gov.in/pmegpeportal/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #059669; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Apply on PMEGP e-Portal <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 2. PM SVANidhi (Street Vendors & Micro-Retailers) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #fffbeb; color: #d97706;">
              <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #fef3c7; color: #b45309;">
                7% Interest Subsidy + Digital Cashback
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                PM SVANidhi (Micro-Retailers & Vendors)
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Collateral-free working capital micro-credit for neighbourhood retail vendors, Kirana kiosks, and street hawkers:
            <br>• <strong>Loan Tranches:</strong> ₹10,000 (1st Tranche) ➔ ₹20,000 (2nd Tranche) ➔ ₹50,000 (3rd Tranche)
            <br>• <strong>Interest Subsidy:</strong> 7% per annum credited directly to your bank on timely repayment
            <br>• <strong>Cashback:</strong> Up to ₹1,200 annual reward cashback on digital UPI transactions
          </p>
        </div>
        <a href="https://pmsvanidhi.mohua.gov.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #d97706; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Check Eligibility & Apply <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 3. PM Vishwakarma Scheme (Traditional Crafts & Trades) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #f5f3ff; color: #7c3aed;">
              <i class="fa-solid fa-hammer"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #ede9fe; color: #6d28d9;">
                ₹15,000 Toolkit + 5% Concessional Loan
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                PM Vishwakarma Yojana
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Comprehensive central support for traditional artisans, tailors, carpenters, potters, cobblers, and craftsmen across 18 trades:
            <br>• <strong>Free Modern Toolkit:</strong> ₹15,000 e-voucher grant for purchasing modern professional equipment
            <br>• <strong>Collateral-Free Credit:</strong> Tranche 1: ₹1 Lakh (18 mos) & Tranche 2: ₹2 Lakhs (30 mos)
            <br>• <strong>Ultra-Low Interest:</strong> Concessional interest rate of just <strong>5%</strong> (Govt pays 8% subvention)
            <br>• <strong>Training Stipend:</strong> Free skill upskilling with ₹500/day daily allowance
          </p>
        </div>
        <a href="https://pmvishwakarma.gov.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #7c3aed; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          PM Vishwakarma Portal <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 4. PMFME (Food Processing Micro Enterprises) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #f0fdf4; color: #16a34a;">
              <i class="fa-solid fa-bowl-rice"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #dcfce7; color: #15803d;">
                35% Capital Subsidy (Up to ₹10 Lakhs)
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                PMFME Scheme (Food Processing)
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Under the Ministry of Food Processing Industries (MoFPI) for individual micro food units and self-help groups:
            <br>• <strong>Capital Subsidy:</strong> 35% credit-linked capital subsidy up to <strong>₹10 Lakhs</strong> on plant & machinery
            <br>• <strong>Eligible Units:</strong> Bakeries, spice grinding, cold-press oil, dairy/paneer, pickles, namkeen, and flour mills
            <br>• <strong>Seed Capital:</strong> ₹40,000 per SHG member for immediate working capital and small tools
          </p>
        </div>
        <a href="https://pmfme.mofpi.gov.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #16a34a; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Apply on PMFME MIS Portal <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 5. Stand-Up India Scheme -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #fff1f2; color: #e11d48;">
              <i class="fa-solid fa-venus"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #ffe4e6; color: #be123c;">
                ₹10 Lakhs to ₹1 Crore Financing
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                Stand-Up India (Women & SC/ST)
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Targeted institutional credit scheme facilitating bank funding to underserved entrepreneurs:
            <br>• <strong>Loan Range:</strong> Composite loans from ₹10 Lakhs up to <strong>₹1 Crore</strong>
            <br>• <strong>Mandate:</strong> Every scheduled commercial bank branch must support at least 1 Woman and 1 SC/ST borrower
            <br>• <strong>Sectors Covered:</strong> Trading & Retail, Manufacturing, Services, and Agri-Allied activities
            <br>• <strong>Margin Money:</strong> Only 15% borrower contribution, convergible with state subsidies
          </p>
        </div>
        <a href="https://www.standupmitra.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #e11d48; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Stand-Up Mitra Portal <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 6. CGTMSE (Credit Guarantee Fund Trust) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #eef2ff; color: #4f46e5;">
              <i class="fa-solid fa-shield-heart"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #e0e7ff; color: #3730a3;">
                Collateral-Free up to ₹5 Crores
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                CGTMSE Guarantee Scheme
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Joint initiative by Ministry of MSME and SIDBI to eliminate third-party mortgage demands by lending banks:
            <br>• <strong>No Collateral Required:</strong> Banks cannot demand residential or commercial property as security
            <br>• <strong>Guarantee Cover:</strong> Govt covers up to <strong>85%</strong> for micro units and women-owned businesses
            <br>• <strong>Eligible Borrowers:</strong> Retail traders, wholesale distributors, IT service agencies, and fabrication workshops
          </p>
        </div>
        <a href="https://www.cgtmse.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #4f46e5; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Official CGTMSE Guidelines <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 7. Pradhan Mantri MUDRA Yojana (PMMY) -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #f0f9ff; color: #0284c7;">
              <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #e0f2fe; color: #0369a1;">
                Loans up to ₹10L (Now ₹20L Tarun Plus)
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                Pradhan Mantri MUDRA Yojana (PMMY)
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            The go-to collateral-free MSME loan scheme available at all public, private, and regional rural banks:
            <br>• <strong>Shishu:</strong> Loans up to ₹50,000 (Ideal for initial stock and small kiosk equipment)
            <br>• <strong>Kishore:</strong> Loans from ₹50,000 to ₹5,00,000 (Shop interiors and inventory build-up)
            <br>• <strong>Tarun / Tarun Plus:</strong> Loans from ₹5 Lakhs up to ₹20 Lakhs for established enterprises
            <br>• <strong>Zero Processing Fees:</strong> No upfront processing charges for Shishu & Kishore categories
          </p>
        </div>
        <a href="https://www.mudra.org.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #0284c7; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          MUDRA Loan Portal <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>

      <!-- 8. MSME Udyam Registration & Samadhaan -->
      <div class="scheme-card">
        <div>
          <div class="scheme-card-top">
            <div class="scheme-icon-wrap" style="background: #f8fafc; color: #334155;">
              <i class="fa-solid fa-award"></i>
            </div>
            <div>
              <span class="scheme-subsidy-badge" style="background: #f1f5f9; color: #334155;">
                Zero-Fee Govt Recognition
              </span>
              <h4 style="font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;">
                Udyam MSME Registration & Samadhaan
              </h4>
            </div>
          </div>
          <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
            Free, 100% paperless national registration certificate granting immediate MSME legal status:
            <br>• <strong>Priority Banking:</strong> Mandatory priority sector bank lending at subsidized interest rates
            <br>• <strong>IPR Discounts:</strong> 50% government fee concession on trademark and patent applications
            <br>• <strong>GeM E-Tenders:</strong> Exemption from Earnest Money Deposits (EMD) in government procurement
            <br>• <strong>Delayed Payment Protection:</strong> MSME Samadhaan portal ensures statutory 45-day compound interest penalty on buyer payment defaults
          </p>
        </div>
        <a href="https://udyamregistration.gov.in/" target="_blank" rel="noopener" style="font-size: 13px; font-weight: 700; color: #2563eb; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
          Register on Udyam Portal (Free) <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
        </a>
      </div>
    </div>
  </section>

</div>

<!-- HIGH-DETAIL BLUEPRINT MODAL -->
<div class="biz-modal-overlay" id="blueprintModal" onclick="closeModalOnOverlay(event)">
  <div class="biz-modal-container">
    <div class="biz-modal-header">
      <div>
        <span id="modalCategory" class="biz-category-badge cat-retail" style="margin-bottom: 8px;">Retail</span>
        <h3 id="modalTitle" style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; margin: 4px 0 0; color: #fff;">
          Business Name
        </h3>
      </div>
      <button class="modal-close-btn" onclick="closeBlueprintModal()" title="Close">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="biz-modal-body">
      <!-- 1. Description -->
      <div class="blueprint-section">
        <div class="blueprint-section-title">
          <i class="fa-solid fa-circle-info" style="color: #2563eb;"></i> Overview & Business Model
        </div>
        <p id="modalDesc" style="font-size: 14.5px; color: #334155; line-height: 1.6; margin: 0;"></p>
      </div>

      <!-- 2. Financial Metrics Matrix -->
      <div class="blueprint-section">
        <div class="blueprint-section-title">
          <i class="fa-solid fa-indian-rupee-sign" style="color: #16a34a;"></i> Financial Matrix & Capital Feasibility
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px;">
          <div style="background: #f8fafc; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Initial Investment</div>
            <div id="modalInvestment" style="font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 800; color: #0f172a; margin-top: 4px;"></div>
          </div>

          <div style="background: #f8fafc; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Profit Margin</div>
            <div id="modalProfit" style="font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 800; color: #166534; margin-top: 4px;"></div>
          </div>

          <div style="background: #f8fafc; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Break-Even Period</div>
            <div id="modalBreakEven" style="font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 800; color: #0f172a; margin-top: 4px;"></div>
          </div>

          <div style="background: #f8fafc; padding: 12px 16px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Risk Level</div>
            <div id="modalRisk" style="font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 800; margin-top: 4px;"></div>
          </div>
        </div>
      </div>

      <!-- 3. Skills Required (Hard Skills & Soft Skills) -->
      <div class="blueprint-section">
        <div class="blueprint-section-title">
          <i class="fa-solid fa-graduation-cap" style="color: #8b5cf6;"></i> Complete Skills Blueprint
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div>
            <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #2563eb; margin-bottom: 8px;">
              <i class="fa-solid fa-gears"></i> Hard & Domain Skills
            </div>
            <div id="modalHardSkills" style="display: flex; flex-direction: column; gap: 6px;"></div>
          </div>

          <div>
            <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #db2777; margin-bottom: 8px;">
              <i class="fa-solid fa-handshake"></i> Soft Skills
            </div>
            <div id="modalSoftSkills" style="display: flex; flex-direction: column; gap: 6px;"></div>
          </div>
        </div>
      </div>

      <!-- 4. Growth Opportunities -->
      <div class="blueprint-section">
        <div class="blueprint-section-title">
          <i class="fa-solid fa-chart-line" style="color: #f59e0b;"></i> Growth Avenues & Market Opportunities
        </div>
        <div id="modalOpportunities" style="display: flex; flex-direction: column; gap: 8px;"></div>
      </div>

      <!-- 5. Equipment Needed -->
      <div class="blueprint-section" id="modalEquipmentWrap">
        <div class="blueprint-section-title">
          <i class="fa-solid fa-toolbox" style="color: #0f172a;"></i> Required Equipment & Infrastructure
        </div>
        <p id="modalEquipment" style="font-size: 13.5px; color: #475569; line-height: 1.5; margin: 0;"></p>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  let currentCategory = 'all';

  function filterCategory(catSlug, btn) {
    currentCategory = catSlug;

    // Update active tab styling
    document.querySelectorAll('#categoryTabs .cat-pill').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    // Sync Sector dropdown
    const sectorEl = document.getElementById('sectorFilter');
    if (sectorEl) {
      sectorEl.value = catSlug;
    }

    applyAllFilters();
  }

  function onSectorDropdownChange(catSlug) {
    currentCategory = catSlug;

    // Update active tab styling on pills
    document.querySelectorAll('#categoryTabs .cat-pill').forEach(b => {
      b.classList.remove('active');
      const slug = b.getAttribute('data-slug') || '';
      if (slug === catSlug) {
        b.classList.add('active');
        b.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
      }
    });

    applyAllFilters();
  }

  function applyAllFilters() {
    const searchVal = document.getElementById('bizSearchInput').value.trim().toLowerCase();
    const budgetVal = document.getElementById('budgetFilter').value;
    const riskVal = document.getElementById('riskFilter').value;

    const cards = document.querySelectorAll('#bizCardsGrid .biz-card');
    let visibleCount = 0;

    cards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');
      const cardRisk = card.getAttribute('data-risk');
      const cardBracket = card.getAttribute('data-bracket');
      const cardName = card.getAttribute('data-name');
      const cardSkills = card.getAttribute('data-skills');

      // Category condition
      const matchCategory = (currentCategory === 'all' || cardCategory === currentCategory);

      // Search condition (matches title, skills, description)
      const matchSearch = (!searchVal || cardName.includes(searchVal) || cardSkills.includes(searchVal));

      // Risk condition
      const matchRisk = (riskVal === 'all' || cardRisk === riskVal);

      // Budget condition
      let matchBudget = true;
      if (budgetVal !== 'all') {
        matchBudget = (cardBracket === budgetVal);
      }

      if (matchCategory && matchSearch && matchRisk && matchBudget) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    document.getElementById('visibleCount').textContent = visibleCount;
    document.getElementById('noBizResults').style.display = (visibleCount === 0) ? 'block' : 'none';
  }

  function resetAllFilters() {
    currentCategory = 'all';
    document.getElementById('bizSearchInput').value = '';
    document.getElementById('budgetFilter').value = 'all';
    document.getElementById('riskFilter').value = 'all';
    if (document.getElementById('sectorFilter')) {
      document.getElementById('sectorFilter').value = 'all';
    }

    document.querySelectorAll('#categoryTabs .cat-pill').forEach(b => {
      b.classList.remove('active');
      if (b.getAttribute('data-slug') === 'all') {
        b.classList.add('active');
      }
    });

    applyAllFilters();
  }

  // ─── Blueprint Modal Logic ───
  function openBlueprintModal(biz) {
    document.getElementById('modalTitle').textContent = biz.name;
    document.getElementById('modalCategory').textContent = biz.category;
    document.getElementById('modalCategory').className = 'biz-category-badge cat-' + (biz.category ? biz.category.toLowerCase().replace(/[^a-z0-9]+/g, '-') : 'default');
    
    document.getElementById('modalDesc').textContent = biz.description;
    document.getElementById('modalInvestment').textContent = biz.initial_investment || biz.investment || '₹50,000 - ₹2,00,000';
    document.getElementById('modalProfit').textContent = biz.profit_margin || '20% - 35%';
    document.getElementById('modalBreakEven').textContent = biz.break_even_period || '3 - 6 Months';
    
    const riskEl = document.getElementById('modalRisk');
    riskEl.textContent = (biz.risk_level || 'Low') + ' Risk';
    if ((biz.risk_level || '').toLowerCase() === 'low') {
      riskEl.style.color = '#15803d';
    } else if ((biz.risk_level || '').toLowerCase() === 'medium') {
      riskEl.style.color = '#a16207';
    } else {
      riskEl.style.color = '#b91c1c';
    }

    // Hard Skills
    const hardContainer = document.getElementById('modalHardSkills');
    hardContainer.innerHTML = '';
    const hardArray = (biz.skills_required || '').split(/[\r\n,•|]+/).map(s => s.trim()).filter(Boolean);
    if (hardArray.length > 0) {
      hardArray.forEach(s => {
        hardContainer.innerHTML += `
          <div style="font-size: 13px; color: #334155; display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 6px 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <i class="fa-solid fa-check" style="color: #2563eb; font-size: 11px;"></i> ${s}
          </div>
        `;
      });
    } else {
      hardContainer.innerHTML = '<span style="color:#94a3b8; font-size:13px;">General business foundation</span>';
    }

    // Soft Skills
    const softContainer = document.getElementById('modalSoftSkills');
    softContainer.innerHTML = '';
    const softArray = (biz.soft_skills || '').split(/[\r\n,•|]+/).map(s => s.trim()).filter(Boolean);
    if (softArray.length > 0) {
      softArray.forEach(s => {
        softContainer.innerHTML += `
          <div style="font-size: 13px; color: #9d174d; display: flex; align-items: center; gap: 8px; background: #fdf2f8; padding: 6px 12px; border-radius: 8px; border: 1px solid #fbcfe8;">
            <i class="fa-solid fa-heart" style="color: #db2777; font-size: 11px;"></i> ${s}
          </div>
        `;
      });
    } else {
      softContainer.innerHTML = '<span style="color:#94a3b8; font-size:13px;">Customer communication</span>';
    }

    // Opportunities
    const oppContainer = document.getElementById('modalOpportunities');
    oppContainer.innerHTML = '';
    const oppArray = (biz.opportunities || '').split(/[\r\n,•|]+/).map(s => s.trim()).filter(Boolean);
    if (oppArray.length > 0) {
      oppArray.forEach(s => {
        oppContainer.innerHTML += `
          <div style="font-size: 13.5px; color: #1e293b; display: flex; align-items: flex-start; gap: 10px; background: #fffbeb; padding: 8px 14px; border-radius: 8px; border: 1px solid #fef3c7;">
            <i class="fa-solid fa-arrow-trend-up" style="color: #d97706; margin-top: 3px;"></i> <span>${s}</span>
          </div>
        `;
      });
    } else {
      oppContainer.innerHTML = '<div style="color:#64748b; font-size:13px;">Direct consumer retail, WhatsApp ordering, regional expansion</div>';
    }

    // Equipment
    const eqWrap = document.getElementById('modalEquipmentWrap');
    if (biz.equipment_needed) {
      eqWrap.style.display = 'block';
      document.getElementById('modalEquipment').textContent = biz.equipment_needed;
    } else {
      eqWrap.style.display = 'none';
    }

    document.getElementById('blueprintModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeBlueprintModal() {
    document.getElementById('blueprintModal').style.display = 'none';
    document.body.style.overflow = 'auto';
  }

  function closeModalOnOverlay(e) {
    if (e.target.id === 'blueprintModal') {
      closeBlueprintModal();
    }
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeBlueprintModal();
    }
  });
</script>
@endsection

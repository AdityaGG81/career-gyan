@extends('layouts.app')

@section('title', 'Explore Careers | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
  /* ─── Explore Page Design System (LIGHT Theme) ─── */
  :root {
    --explore-bg: #f8fafc;
    --explore-card-hover: rgba(26, 86, 219, 0.05);
  }

  body {
    background-color: var(--explore-bg);
    color: var(--text-1);
  }

  /* ─── Hero Section ─── */
  .explore-hero {
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0f7ff 100%);
    padding: 80px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  /* Floating SVG Doodles */
  .explore-doodle {
    position: absolute;
    opacity: 0.12;
    pointer-events: none;
    z-index: 1;
    animation: floatDoodle 6s ease-in-out infinite alternate;
  }

  .ed-1 { top: 15%; left: 8%; animation-delay: 0s; }
  .ed-2 { top: 25%; right: 10%; animation-delay: -2s; }
  .ed-3 { bottom: 15%; left: 20%; animation-delay: -4s; }

  @keyframes floatDoodle {
    0% { transform: translateY(0) rotate(0deg); }
    100% { transform: translateY(-15px) rotate(8deg); }
  }

  .explore-hero-content {
    position: relative;
    z-index: 2;
  }

  .explore-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(32px, 5vw, 44px);
    font-weight: 800;
    color: var(--brand);
    margin-bottom: 12px;
    letter-spacing: -0.5px;
  }

  .explore-hero p {
    font-size: 17px;
    color: var(--text-2);
    margin-bottom: 32px;
  }

  /* Search bar */
  .search-container {
    max-width: 560px;
    margin: 0 auto;
    position: relative;
  }

  .search-input-wrap {
    position: relative;
    display: flex;
    background: #ffffff;
    border-radius: 99px;
    padding: 6px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    border: 1px solid var(--border);
  }

  .search-input-wrap i.search-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-3);
  }

  .search-input-wrap input {
    flex-grow: 1;
    border: none;
    padding: 12px 16px 12px 48px;
    border-radius: 99px;
    font-family: inherit;
    font-size: 15px;
    color: var(--text-1);
  }

  .search-input-wrap input:focus {
    outline: none;
  }

  .btn-search {
    background: var(--brand);
    color: #ffffff;
    border: none;
    padding: 12px 28px;
    border-radius: 99px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-search:hover {
    background: var(--brand-dark);
  }

  /* Autocomplete Suggestions */
  .search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
    z-index: 100;
    margin-top: 8px;
    max-height: 450px;
    overflow-y: auto;
    text-align: left;
  }

  .suggestion-section-title {
    padding: 8px 20px;
    font-family: 'Sora', sans-serif;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--text-3);
    background: #f8fafc;
    border-bottom: 1px solid var(--border);
    letter-spacing: 0.05em;
  }

  .suggestions-header {
    padding: 10px 20px;
    font-family: 'Sora', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--brand);
    background: #f8fafc;
    border-bottom: 1px solid var(--border);
  }

  .suggestion-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    cursor: pointer;
    transition: background 0.2s;
    border-bottom: 1px solid var(--border);
  }

  .suggestion-item:last-child {
    border-bottom: none;
  }

  .suggestion-item:hover {
    background: var(--explore-card-hover);
  }

  .suggestion-icon-wrap {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
  }

  .suggestion-details {
    flex-grow: 1;
  }

  .suggestion-title {
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 2px;
  }

  .suggestion-meta {
    font-size: 11px;
    color: var(--text-3);
    font-weight: 600;
  }

  .suggestion-badge {
    background: var(--brand-light);
    color: var(--brand);
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: 700;
  }

  .no-results {
    padding: 24px;
    text-align: center;
    color: var(--text-3);
    font-size: 14.5px;
  }

  /* ─── Browse by Field Section ─── */
  .section-container {
    padding: 80px 0;
  }

  .section-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--brand);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    background: var(--brand-light);
    padding: 6px 14px;
    border-radius: 99px;
    margin-bottom: 16px;
  }

  .section-title {
    font-family: 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 800;
    color: var(--text-1);
    margin-bottom: 10px;
  }

  .section-subtitle {
    font-size: 15.5px;
    color: var(--text-2);
    margin-bottom: 40px;
  }

  /* Categories Grid */
  .fields-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
    margin-bottom: 60px;
  }

  .field-card {
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    display: flex;
    flex-direction: column;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
    overflow: hidden;
  }

  .field-card:hover {
    transform: translateY(-10px) scale(1.05) !important;
    box-shadow: 0 25px 45px rgba(26, 86, 219, 0.15) !important;
    border-color: var(--brand) !important;
  }

  .field-card-cover {
    height: 120px;
    background-size: cover;
    background-position: center;
    position: relative;
    border-bottom: 1px solid var(--border);
  }

  .field-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    position: absolute;
    bottom: -20px;
    left: 24px;
    box-shadow: var(--shadow-sm);
    border: 3px solid #ffffff;
  }

  .field-card-content {
    padding: 32px 24px 24px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .field-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 4px;
    line-height: 1.3;
  }

  .field-career-count {
    font-size: 12.5px;
    color: var(--text-3);
    font-weight: 600;
  }

  .field-card-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: auto;
    padding-top: 20px;
  }

  .btn-field-action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    padding: 10px;
    border-radius: var(--radius-md);
    transition: all 0.2s;
  }

  .btn-field-path {
    background: var(--brand-light);
    color: var(--brand);
  }

  .btn-field-path:hover {
    background: var(--brand);
    color: #ffffff;
  }

  .btn-field-guide {
    background: #f1f5f9;
    color: var(--text-2);
    border: 1px solid var(--border);
  }

  .btn-field-guide:hover {
    background: var(--text-2);
    color: #ffffff;
    border-color: var(--text-2);
  }

  /* ─── All Careers Section ─── */
  .all-careers-section {
    padding: 80px 0;
    background: #ffffff;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
  }

  /* Filter Bar */
  .explore-filter-bar {
    background: #f8fafc;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 20px 24px;
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    flex-wrap: wrap;
  }

  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex-grow: 1;
    min-width: 200px;
  }

  .filter-group label {
    font-size: 11.5px;
    font-weight: 700;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .filter-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: var(--radius-md);
    border: 1.5px solid var(--border);
    font-family: inherit;
    font-size: 14.5px;
    background: #ffffff;
    color: var(--text-1);
    cursor: pointer;
  }

  /* Careers Grid */
  .careers-list-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
    margin-bottom: 40px;
  }

  .career-item-card {
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px;
    display: flex;
    flex-direction: column;
    transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
    position: relative;
    overflow: hidden;
  }

  .career-item-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--brand);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
  }

  .career-item-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(26, 86, 219, 0.2);
  }

  .career-item-card:hover::after {
    transform: scaleX(1);
  }

  .career-item-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 14px;
  }

  .career-icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .career-item-header h3 {
    font-family: 'Sora', sans-serif;
    font-size: 17.5px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 4px;
  }

  .career-field-badge {
    display: inline-block;
    background: #f1f5f9;
    color: var(--text-2);
    font-size: 11px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 99px;
  }

  .career-item-desc {
    font-size: 14px;
    color: var(--text-2);
    line-height: 1.55;
    margin-bottom: 20px;
    flex-grow: 1;
  }

  .career-item-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 14px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin-bottom: 20px;
    font-size: 13px;
    color: var(--text-2);
  }

  .meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .meta-item i {
    width: 16px;
    color: var(--text-3);
    text-align: center;
  }

  .badge-demand {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 2px 8px;
    border-radius: 99px;
  }

  .badge-demand-high { background: #dcfce7; color: #166534; }
  .badge-demand-medium { background: #fef3c7; color: #d97706; }
  .badge-demand-moderate { background: #eff6ff; color: #1d4ed8; }
  .badge-demand-low { background: #f1f5f9; color: #475569; }

  .btn-view-roadmap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: var(--brand-light);
    color: var(--brand);
    padding: 11px;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 13.5px;
    text-decoration: none;
    transition: all 0.2s;
  }

  .career-item-card:hover .btn-view-roadmap {
    background: var(--brand);
    color: #ffffff;
  }

  /* ─── How CareerGyan Works (Horizontal Timeline) ─── */
  .timeline-section {
    padding: 100px 0;
    background: #f8fafc;
    text-align: center;
  }

  .timeline-cards-wrap {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Horizontal connecting line */
  .timeline-connecting-line {
    position: absolute;
    top: 52px;
    left: 10%;
    width: 80%;
    height: 3px;
    background-image: linear-gradient(to right, var(--border) 50%, transparent 50%);
    background-size: 16px 3px;
    z-index: 1;
  }

  .timeline-card-lite {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s;
  }

  .timeline-card-lite:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: var(--card-hover-border);
  }

  .timeline-card-node {
    width: 44px;
    height: 44px;
    background: #ffffff;
    border: 3px solid var(--brand);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    color: var(--brand);
    font-size: 16px;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(26, 86, 219, 0.1);
  }

  .timeline-card-lite:hover .timeline-card-node {
    background: var(--brand);
    color: #ffffff;
  }

  .timeline-card-lite h4 {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 8px;
  }

  .timeline-card-lite p {
    font-size: 13px;
    color: var(--text-2);
    line-height: 1.5;
  }

  /* ─── Responsive ─── */
  @media (max-width: 991px) {
    .timeline-connecting-line {
      display: none;
    }

    .timeline-cards-wrap {
      grid-template-columns: 1fr;
      gap: 24px;
      max-width: 450px;
    }

    .timeline-card-lite {
      padding: 24px;
      flex-direction: row;
      text-align: left;
      gap: 20px;
    }

    .timeline-card-node {
      margin-bottom: 0;
      flex-shrink: 0;
    }
  }

  @media (max-width: 768px) {
    .explore-hero {
      padding: 60px 0 40px;
    }

    .explore-filter-bar {
      flex-direction: column;
      padding: 16px;
      gap: 12px;
    }

    .filter-group {
      width: 100%;
      min-width: 0;
    }
  }

  @media (max-width: 580px) {
    .fields-grid {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 480px) {
    .explore-hero h1 {
      font-size: 28px;
    }

    .search-input-wrap {
      flex-direction: column;
      border-radius: var(--radius-xl);
      padding: 10px;
      gap: 10px;
    }

    .search-input-wrap input {
      padding: 10px 12px 10px 36px;
      width: 100%;
    }

    .search-input-wrap i.search-icon {
      left: 16px;
    }

    .btn-search {
      width: 100%;
      border-radius: var(--radius-md);
      padding: 10px;
    }

    .careers-list-grid {
      grid-template-columns: 1fr;
    }

    .timeline-card-lite {
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 12px;
    }
  }
</style>
@endsection

@section('content')

<!-- Explore Hero -->
<section class="explore-hero">
  <!-- Inline SVG doodles for background decor -->
  <svg class="explore-doodle ed-1" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M5 25 Q15 5 25 25 T45 25" stroke="#1a56db" stroke-width="2.5" fill="none"/>
  </svg>
  <svg class="explore-doodle ed-2" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="5" y="5" width="30" height="30" rx="8" stroke="#f97316" stroke-width="2" fill="#fff" fill-opacity="0.2"/>
  </svg>
  <svg class="explore-doodle ed-3" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="25" cy="25" r="20" stroke="#7c3aed" stroke-width="2" stroke-dasharray="6 4"/>
  </svg>

  <div class="container explore-hero-content">
    <h1>Explore Career Paths</h1>
    <p>Discover 5000+ career choices, roadmap steps, salaries, and leading colleges in India</p>

    <!-- Autocomplete Search Container -->
    <div class="search-container">
      <div class="search-input-wrap">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchInput" placeholder="Search for careers or categories (e.g. Software Engineer, Medical)..." autocomplete="off">
        <button onclick="performFieldSearch()" class="btn-search">Search</button>
      </div>

      <!-- Autocomplete Dropdown -->
      <div id="searchSuggestions" class="search-suggestions" style="display: none;">
        <div class="suggestions-header">Suggestions</div>
        <div id="suggestionsList"></div>
        <div id="noResults" class="no-results" style="display: none;">
          <i class="fa-solid fa-triangle-exclamation"></i>
          <span>No matching career or field found.</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Browse by Category Section -->
<section class="section-container">
  <div class="container">
    <div style="text-align: center;">
      <div class="section-label">
        <i class="fa-solid fa-route"></i> Fields
      </div>
      <h2 class="section-title">Browse by Category</h2>
      <p class="section-subtitle">Select a specific sector to explore related paths and college locators</p>
    </div>

    <div class="fields-grid">
      @foreach($fields as $field)
        <!-- Category Card -->
        @php
          $slug = $field->slug;
          $coverMap = [
              'technology-engineering' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
              'modern-tech' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1000',
              'gaming-careers' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=1000',
              'medical' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1000',
              'pharmacy' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&q=80&w=1000',
              'ayush-allied' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1000',
              'arts-humanities' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000',
              'creative-careers' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=1000',
              'social-media' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&q=80&w=1000',
              'business' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1000',
              'commerce' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&q=80&w=1000',
              'agriculture' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&q=80&w=1000',
              'science' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=1000',
              'hotel-management' => 'https://images.unsplash.com/photo-1566073171526-8731302eb8ed?auto=format&fit=crop&q=80&w=1000',
              'sports' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=1000',
              'skill-development' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=1000',
              'freelancing' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1000',
              'government-defence' => 'https://images.unsplash.com/photo-1508182314998-3bd49473002f?auto=format&fit=crop&q=80&w=1000',
              'teaching-law' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=1000',
              'small-scale' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&q=80&w=1000',
              'competitive-exams' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=1000',
              'non-traditional' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=1000',
              'traditional' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1000',
          ];
          $coverImage = $field->cover_image ?: ($coverMap[$slug] ?? 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=1000');
        @endphp
        <div class="field-card" onclick="navigateToField('{{ $field->slug }}')">
          <div class="field-card-cover" style="background-image: url('{{ $coverImage }}');">
            <div class="field-icon-wrap" style="background: {{ $field->bg_color }}; color: {{ $field->color }};">
              <i class="fa-solid {{ $field->icon }}"></i>
            </div>
          </div>

          <div class="field-card-content">
            <div>
              <h3>{{ $field->name }}</h3>
              <span class="field-career-count">{{ $field->careers_count }} Careers</span>
            </div>

          <div class="field-card-actions">
            <!-- Full career path page -->
            @php
              $slugMap = [
                  'modern-tech' => 'modern-tech-ai',
                  'creative-careers' => 'creative-careers',
                  'social-media' => 'social-media-content',
                  'gaming-careers' => 'gaming-esports',
                  'freelancing' => 'freelancing-remote',
                  'competitive-exams' => 'competitive-exams',
                  'hotel-management' => 'hotel-management',
                  'pharmacy' => 'pharmaceutical-sciences',
                  'ayush-allied' => 'ayush-allied-health',
                  'non-traditional' => 'non-traditional-careers'
              ];
              $pathSlug = $slugMap[$field->slug] ?? $field->slug;
            @endphp
            <a href="{{ $field->slug === 'gaming-careers' ? route('career-path.gaming-esports') : route('career.path', $pathSlug) }}" onclick="event.stopPropagation()" class="btn-field-action btn-field-path">
              <i class="fa-solid fa-route"></i> View Career Path
            </a>

            <!-- College locator / sub-guide -->
            @php
              $collegeRoutes = [
                  'technology-engineering' => 'explore.engineering-colleges',
                  'arts-humanities' => 'explore.arts-humanities-colleges',
                  'science' => 'explore.science-colleges',
                  'commerce' => 'explore.commerce-colleges',
                  'agriculture' => 'explore.agriculture-colleges',
                  'medical' => 'explore.medical-colleges',
                  'hotel-management' => 'explore.hotel-management-colleges',
                  'business' => 'explore.management-colleges',
                  'pharmacy' => 'explore.pharmacy-colleges',
                  'ayush-allied' => 'explore.non-mbbs-colleges'
              ];

              $customLabels = [
                  'government-defence' => 'Defense Paths',
                  'teaching-law' => 'Teaching & Law Paths',
                  'modern-tech' => 'AI & Tech Guide',
                  'creative-careers' => 'Creative Careers Guide',
                  'social-media' => 'Content Creation Guide',
                  'gaming-careers' => 'Esports Career Guide',
                  'freelancing' => 'Freelance Guide',
                  'competitive-exams' => 'Exams Roadmap',
                  'non-traditional' => 'Modern Career Guide',
                  'small-scale' => 'Business Ideas',
                  'sports' => 'Sports Careers',
                  'skill-development' => 'Skills Hub'
              ];

              $customRoutes = [
                  'government-defence' => 'explore.government-defence',
                  'teaching-law' => 'explore.teaching-law',
                  'modern-tech' => 'explore.modern-tech',
                  'creative-careers' => 'explore.creative-careers',
                  'social-media' => 'explore.social-media',
                  'gaming-careers' => 'explore.gaming-careers',
                  'freelancing' => 'explore.freelancing',
                  'competitive-exams' => 'explore.competitive-exams',
                  'non-traditional' => 'explore.non-traditional-careers',
                  'small-scale' => 'explore.small-scale-business',
                  'sports' => 'explore.sports-careers',
                  'skill-development' => 'explore.skill-development'
              ];
            @endphp

            @if(isset($collegeRoutes[$field->slug]))
              <a href="{{ route($collegeRoutes[$field->slug]) }}" onclick="event.stopPropagation()" class="btn-field-action btn-field-guide">
                <i class="fa-solid fa-building-columns"></i> View Top Colleges
              </a>
            @elseif(isset($customRoutes[$field->slug]))
              <a href="{{ route($customRoutes[$field->slug]) }}" onclick="event.stopPropagation()" class="btn-field-action btn-field-guide">
                <i class="fa-solid fa-book"></i> {{ $customLabels[$field->slug] }}
              </a>
            @endif
          </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- All Career Paths Section (With Filter Controls) -->
<section class="all-careers-section">
  <div class="container">
    <div style="text-align: center;">
      <div class="section-label" style="background: #eef2f6; color: var(--text-2);">
        <i class="fa-solid fa-list-ul"></i> Database
      </div>
      <h2 class="section-title">All Career Paths</h2>
      <p class="section-subtitle">Use the options below to filter our database in real-time</p>
    </div>

    <!-- Filter Bar -->
    <div class="explore-filter-bar">
      <!-- Filter 1: Field category -->
      <div class="filter-group">
        <label for="fieldFilter">Filter by Field</label>
        <select id="fieldFilter" class="filter-control">
          <option value="all">All Fields</option>
          @foreach($fields as $field)
            <option value="{{ $field->slug }}">{{ $field->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Filter 2: Demand Level -->
      <div class="filter-group">
        <label for="demandFilter">Filter by Demand Level</label>
        <select id="demandFilter" class="filter-control">
          <option value="all">All Demand Levels</option>
          <option value="high">High Demand</option>
          <option value="medium">Medium Demand</option>
          <option value="moderate">Moderate Demand</option>
          <option value="low">Low Demand</option>
        </select>
      </div>
    </div>

    <!-- Career Cards list -->
    <div class="careers-list-grid" id="careersGrid">
      @foreach($careers as $career)
        @php
          $careerFieldSlug = $career->field->slug ?? 'others';
          $demandLevel = strtolower($career->demand_level ?: 'low');
        @endphp
        <div class="career-item-card" data-field="{{ $careerFieldSlug }}" data-demand="{{ $demandLevel }}">
          <div class="career-item-header">
            <div class="career-icon-circle" style="background: {{ $career->field->bg_color ?? '#e2e8f0' }}; color: {{ $career->field->color ?? '#475569' }};">
              <i class="fa-solid {{ $career->icon ?: 'fa-briefcase' }}"></i>
            </div>
            <div>
              <h3>{{ $career->name }}</h3>
              <span class="career-field-badge">{{ $career->field->name ?? 'General' }}</span>
            </div>
          </div>

          <p class="career-item-desc">{{ Str::limit($career->description, 115) }}</p>

          <div class="career-item-meta">
            <!-- Qualification -->
            <div class="meta-item">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Req: <strong>{{ $career->qualification ?: 'N/A' }}</strong></span>
            </div>
            <!-- Salary -->
            <div class="meta-item">
              <i class="fa-solid fa-wallet"></i>
              <span>Salary: <strong>{{ $career->salary_range ?: 'N/A' }}</strong></span>
            </div>
            <!-- Demand -->
            <div class="meta-item">
              <i class="fa-solid fa-chart-line"></i>
              <span>Demand: 
                @if($demandLevel == 'high')
                  <span class="badge-demand badge-demand-high">High</span>
                @elseif($demandLevel == 'medium')
                  <span class="badge-demand badge-demand-medium">Medium</span>
                @elseif($demandLevel == 'moderate')
                  <span class="badge-demand badge-demand-moderate">Moderate</span>
                @else
                  <span class="badge-demand badge-demand-low">{{ $career->demand_level ?: 'Low' }}</span>
                @endif
              </span>
            </div>
          </div>

          <!-- View Roadmap -->
          <a href="{{ route('career.detail.page', $career->slug) }}" class="btn-view-roadmap">
            View Roadmap &rarr;
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Timeline (How CareerGyan Works) -->
<section class="timeline-section">
  <div class="container">
    <div style="text-align: center;">
      <div class="section-label">
        <i class="fa-solid fa-bolt"></i> Flowchart
      </div>
      <h2 class="section-title" style="color:var(--text-1) !important;">How CareerGyan Works</h2>
      <p style="color:var(--text-2) !important; font-size:16px; margin-bottom: 50px;">Follow our simple roadmap structure to match interests, explore roles, and select colleges.</p>
    </div>

    <div class="timeline-cards-wrap">
      <div class="timeline-connecting-line"></div>
      
      <!-- Card 1 -->
      <div class="timeline-card-lite">
        <div class="timeline-card-node">1</div>
        <h4>Take Free Test</h4>
        <p>Assess aptitudes, interests, and personalities scientifically.</p>
      </div>

      <!-- Card 2 -->
      <div class="timeline-card-lite">
        <div class="timeline-card-node">2</div>
        <h4>Get Matches</h4>
        <p>Get personalized recommendations based on quiz scores.</p>
      </div>

      <!-- Card 3 -->
      <div class="timeline-card-lite">
        <div class="timeline-card-node">3</div>
        <h4>Explore Paths</h4>
        <p>Review salaries, roles, required skills, and growth rates.</p>
      </div>

      <!-- Card 4 -->
      <div class="timeline-card-lite">
        <div class="timeline-card-node">4</div>
        <h4>Find Colleges</h4>
        <p>Search institutions by location, stream, and entry criteria.</p>
      </div>

      <!-- Card 5 -->
      <div class="timeline-card-lite">
        <div class="timeline-card-node">5</div>
        <h4>Build Career</h4>
        <p>Establish exact study milestones and enter the job market.</p>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  document.getElementById('searchInput').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
          e.preventDefault();
          performFieldSearch();
      }
  });

  // ── Autocomplete Search Script ──
  let searchTimeout;
  let currentFieldResults = [];
  let currentCareerResults = [];
  let currentCollegeResults = [];
  let currentBlogResults = [];

  document.getElementById('searchInput').addEventListener('input', function(e) {
      clearTimeout(searchTimeout);
      let q = e.target.value.trim();
      
      if (q.length < 2) {
          hideSuggestions();
          return;
      }
      
      searchTimeout = setTimeout(() => {
          fetchSuggestions(q);
      }, 250);
  });

  document.addEventListener('click', function(e) {
      if (!e.target.closest('.search-container')) {
          hideSuggestions();
      }
  });

  function fetchSuggestions(query) {
      fetch(`/global-search?q=${encodeURIComponent(query)}`)
          .then(r => r.json())
          .then(data => {
              currentFieldResults = data.config_careers || [];
              currentCareerResults = data.db_careers || [];
              currentCollegeResults = data.colleges || [];
              currentBlogResults = data.blogs || [];
              showSuggestions(data);
          })
          .catch(e => {
              console.error('Error fetching suggestions:', e);
              hideSuggestions();
          });
  }

  function showSuggestions(data) {
      const suggestionsDiv = document.getElementById('searchSuggestions');
      const suggestionsList = document.getElementById('suggestionsList');
      const noResults = document.getElementById('noResults');
      
      const fields = data.config_careers || [];
      const careers = data.db_careers || [];
      const colleges = data.colleges || [];
      const blogs = data.blogs || [];
      
      const hasFields = fields.length > 0;
      const hasCareers = careers.length > 0;
      const hasColleges = colleges.length > 0;
      const hasBlogs = blogs.length > 0;
      
      if (!hasFields && !hasCareers && !hasColleges && !hasBlogs) {
          suggestionsList.innerHTML = '';
          noResults.style.display = 'block';
      } else {
          noResults.style.display = 'none';
          let html = '';
          
          if (hasFields) {
              html += `<div class="suggestion-section-title">Fields & Streams</div>`;
              html += fields.map(field => `
                  <div class="suggestion-item" onclick="navigateToUrl('${field.url}')">
                      <div class="suggestion-icon-wrap" style="background: ${field.bg_color}; color: ${field.color};">
                          <i class="fa-solid ${field.icon}"></i>
                      </div>
                      <div class="suggestion-details">
                          <div class="suggestion-title">${field.name}</div>
                          <span class="suggestion-meta">Field Category</span>
                      </div>
                  </div>
              `).join('');
          }
          
          if (hasCareers) {
              html += `<div class="suggestion-section-title">Career Paths</div>`;
              html += careers.map(career => `
                  <div class="suggestion-item" onclick="navigateToUrl('${career.url}')">
                      <div class="suggestion-icon-wrap" style="background: ${career.bg_color || '#e2e8f0'}; color: ${career.color || '#475569'};">
                          <i class="fa-solid ${career.icon || 'fa-briefcase'}"></i>
                      </div>
                      <div class="suggestion-details">
                          <div class="suggestion-title">${career.name}</div>
                          <span class="suggestion-meta">${career.field || 'Career Path'}</span>
                      </div>
                  </div>
              `).join('');
          }

          if (hasColleges) {
              html += `<div class="suggestion-section-title">Colleges & Institutes</div>`;
              html += colleges.map(col => `
                  <div class="suggestion-item" onclick="navigateToUrl('${col.url}')">
                      <div class="suggestion-icon-wrap" style="background: var(--brand-light); color: var(--brand);">
                          <i class="fa-solid fa-building-columns"></i>
                      </div>
                      <div class="suggestion-details">
                          <div class="suggestion-title">${col.name}</div>
                          <span class="suggestion-meta">${col.location} | ${col.field}</span>
                      </div>
                  </div>
              `).join('');
          }

          if (hasBlogs) {
              html += `<div class="suggestion-section-title">Blog Articles</div>`;
              html += blogs.map(b => `
                  <div class="suggestion-item" onclick="navigateToUrl('${b.url}')">
                      <div class="suggestion-icon-wrap" style="background: #ffe4e6; color: #e11d48;">
                          <i class="fa-solid fa-newspaper"></i>
                      </div>
                      <div class="suggestion-details">
                          <div class="suggestion-title">${b.title}</div>
                          <span class="suggestion-meta">${b.category}</span>
                      </div>
                  </div>
              `).join('');
          }
          suggestionsList.innerHTML = html;
      }
      suggestionsDiv.style.display = 'block';
  }

  function hideSuggestions() {
      document.getElementById('searchSuggestions').style.display = 'none';
  }

  function navigateToUrl(url) {
      window.location.href = url;
  }

  function performFieldSearch() {
      let q = document.getElementById('searchInput').value.trim().toLowerCase();
      if (q.length < 2) return;
      
      let matchedCareer = currentCareerResults.find(c => c.name.toLowerCase() === q);
      if (matchedCareer) {
          navigateToUrl(matchedCareer.url);
          return;
      }
      
      let matchedField = currentFieldResults.find(f => f.name.toLowerCase() === q);
      if (matchedField) {
          navigateToUrl(matchedField.url);
          return;
      }

      let matchedCollege = currentCollegeResults.find(col => col.name.toLowerCase() === q);
      if (matchedCollege) {
          navigateToUrl(matchedCollege.url);
          return;
      }

      let matchedBlog = currentBlogResults.find(b => b.title.toLowerCase() === q);
      if (matchedBlog) {
          navigateToUrl(matchedBlog.url);
          return;
      }

      if (currentCareerResults.length > 0) {
          navigateToUrl(currentCareerResults[0].url);
      } else if (currentFieldResults.length > 0) {
          navigateToUrl(currentFieldResults[0].url);
      } else if (currentCollegeResults.length > 0) {
          navigateToUrl(currentCollegeResults[0].url);
      } else if (currentBlogResults.length > 0) {
          navigateToUrl(currentBlogResults[0].url);
      } else {
          const suggestionsDiv = document.getElementById('searchSuggestions');
          const suggestionsList = document.getElementById('suggestionsList');
          const noResults = document.getElementById('noResults');
          
          suggestionsList.innerHTML = '';
          noResults.style.display = 'block';
          suggestionsDiv.style.display = 'block';
          setTimeout(hideSuggestions, 2000);
      }
  }

  // ── Client-Side Filter Script ──
  document.addEventListener('DOMContentLoaded', () => {
    const fieldFilter = document.getElementById('fieldFilter');
    const demandFilter = document.getElementById('demandFilter');
    const cards = document.querySelectorAll('.career-item-card');

    function applyFilters() {
      const selectedField = fieldFilter.value;
      const selectedDemand = demandFilter.value;

      cards.forEach(card => {
        const cardField = card.getAttribute('data-field');
        const cardDemand = card.getAttribute('data-demand');

        const fieldMatch = (selectedField === 'all' || cardField === selectedField);
        const demandMatch = (selectedDemand === 'all' || cardDemand === selectedDemand);

        if (fieldMatch && demandMatch) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }

    fieldFilter.addEventListener('change', applyFilters);
    demandFilter.addEventListener('change', applyFilters);
  });
</script>
@endsection

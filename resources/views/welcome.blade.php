@extends('layouts.app')

@section('title', 'CareerGyan | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
  /* ─── Hero ─── */
  .hero {
    position: relative;
    overflow: hidden;
    background:
      radial-gradient(circle at 12% 18%, rgba(255,255,255,0.55), transparent 20%),
      radial-gradient(circle at 85% 25%, rgba(255,255,255,0.35), transparent 24%),
      radial-gradient(circle at 50% 100%, rgba(255,255,255,0.75), transparent 30%),
      linear-gradient(135deg, #e0f7ff 0%, #7dd3fc 35%, #38bdf8 65%, #60a5fa 100%);
    padding: 90px 0 80px;
  }

  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='28' height='28' viewBox='0 0 28 28' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1.2' fill='%23ffffff' fill-opacity='0.45'/%3E%3C/svg%3E");
    opacity: 0.35;
    pointer-events: none;
    z-index: 0;
  }

  .hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(255,255,255,0.18) 0%, rgba(224,247,255,0.08) 45%, rgba(255,255,255,0.12) 100%);
    pointer-events: none;
    z-index: 0;
  }

  .hero-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(72px);
    pointer-events: none;
    z-index: 0;
  }

  .hero-blob-1 {
    width: 420px;
    height: 420px;
    background: rgba(255, 255, 255, 0.65);
    opacity: 0.55;
    top: -120px;
    right: -100px;
  }

  .hero-blob-2 {
    width: 300px;
    height: 300px;
    background: rgba(186, 230, 253, 0.85);
    opacity: 0.45;
    bottom: -80px;
    left: 2%;
  }

  .hero-content {
    position: relative;
    z-index: 1;
    text-align: center;
  }

  .hero-content::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -48%);
    width: min(92%, 720px);
    height: 72%;
    background: radial-gradient(ellipse at center, rgba(255,255,255,0.42) 0%, rgba(255,255,255,0.12) 55%, transparent 72%);
    border-radius: 50%;
    pointer-events: none;
    z-index: -1;
  }

  /* SLOGAN + INSTITUTE */
  .hero-top-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin-bottom: 28px;
  }

  .hero-slogan {
    font-family: 'Sora', sans-serif;
    color: #1e3a8a;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: .5px;
    text-shadow: 0 1px 2px rgba(255,255,255,0.45);
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(30, 64, 175, 0.88);
    border: 1.5px solid rgba(255,255,255,.35);
    color: #ffffff;
    font-size: 26px;
    font-weight: 800;
    letter-spacing: .5px;
    padding: 14px 40px;
    border-radius: 999px;
    backdrop-filter: blur(8px);
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.12);
    transition: transform 0.3s ease;
  }

  .hero-badge:hover {
    transform: scale(1.02);
    background: rgba(29, 78, 216, 0.92);
  }

  .hero-badge i {
    color: #fbbf24;
    font-size: 22px;
  }

  .hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(30px, 5.5vw, 56px);
    font-weight: 700;
    color: #0f172a;
    line-height: 1.15;
    margin-bottom: 18px;
    text-shadow: 0 1px 14px rgba(255,255,255,0.75);
  }

  .hero h1 em {
    color: #f59e0b;
    font-style: normal;
  }

  .hero p {
    font-size: clamp(16px, 2vw, 19px);
    color: #334155;
    max-width: 560px;
    margin: 0 auto 36px;
    line-height: 1.65;
  }

  .hero-btns {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  .btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15.5px;
    font-weight: 600;
    color: var(--brand);
    background: #fff;
    padding: 13px 28px;
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 18px rgba(0,0,0,.18);
    transition: transform var(--transition), box-shadow var(--transition);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,.22);
  }

  .btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15.5px;
    font-weight: 600;
    color: #1e40af;
    background: rgba(255,255,255,.82);
    border: 1.5px solid #1e40af;
    padding: 13px 28px;
    border-radius: var(--radius-lg);
    backdrop-filter: blur(4px);
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
  }

  .btn-outline:hover {
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.12);
  }

  .hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-top: 52px;
  }

  .hero-stat {
    text-align: center;
  }

  .hero-stat strong {
    display: block;
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 700;
    color: #102a56;
  }

  .hero-stat span {
    font-size: 13px;
    color: #475569;
  }

  /* ─── Qualification Cards ─── */
  .qual-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 36px;
  }

  .qual-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px 24px 24px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: border-color var(--transition), transform var(--transition), box-shadow var(--transition);
  }

  .qual-card::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity var(--transition);
  }

  .qual-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: transparent;
  }

  .qual-card:hover::before {
    opacity: 1;
  }

  .qual-card.card-blue::before {
    background: linear-gradient(135deg,#eff6ff,#dbeafe);
    border: 1.5px solid #bfdbfe;
  }

  .qual-card.card-green::before {
    background: linear-gradient(135deg,#f0fdf4,#dcfce7);
    border: 1.5px solid #bbf7d0;
  }

  .qual-card.card-purple::before {
    background: linear-gradient(135deg,#faf5ff,#ede9fe);
    border: 1.5px solid #ddd6fe;
  }

  .qual-card.card-amber::before {
    background: linear-gradient(135deg,#fffbeb,#fef3c7);
    border: 1.5px solid #fde68a;
  }

  .qual-icon {
    width: 52px;
    height: 52px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
  }

  .icon-blue { background: var(--brand-light); color: var(--brand); }
  .icon-green { background: #dcfce7; color: #16a34a; }
  .icon-purple { background: #ede9fe; color: #9333ea; }
  .icon-amber { background: #fef3c7; color: #d97706; }

  .qual-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 7px;
    position: relative;
    z-index: 1;
  }

  .qual-card p {
    font-size: 14px;
    color: var(--text-2);
    line-height: 1.55;
    position: relative;
    z-index: 1;
  }

  .qual-card .card-arrow {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    font-weight: 600;
    color: var(--brand);
    margin-top: 16px;
    position: relative;
    z-index: 1;
    transition: gap var(--transition);
  }

  .qual-card:hover .card-arrow {
    gap: 9px;
  }

  /* ─── Filters ─── */
  .filters-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 20px 24px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
    box-shadow: var(--shadow-sm);
  }

  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
    min-width: 160px;
  }

  .filter-group label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-2);
    letter-spacing: .04em;
    text-transform: uppercase;
  }

  .filter-group select {
    font-family: 'DM Sans', sans-serif;
    font-size: 14.5px;
    color: var(--text-1);
    background: var(--bg);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 9px 14px;
    cursor: pointer;
  }

  .filter-group select:focus {
    outline: none;
    border-color: var(--brand);
  }

  .filter-btn {
    font-size: 14.5px;
    font-weight: 600;
    color: #fff;
    background: var(--brand);
    padding: 10px 24px;
    border-radius: var(--radius-md);
    transition: background var(--transition), transform var(--transition);
    align-self: flex-end;
  }

  .filter-btn:hover {
    background: var(--brand-dark);
    transform: translateY(-1px);
  }

  /* ─── Field Grid ─── */
  .field-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 16px;
    margin-top: 36px;
  }

  .field-item {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    text-align: center;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  }

  .field-item:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
    border-color: var(--brand);
  }

  .field-icon {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .field-item h4 {
    font-family: 'Sora', sans-serif;
    font-size: 14.5px;
    font-weight: 600;
  }

  .field-item span {
    font-size: 12.5px;
    color: var(--text-3);
  }

  /* ─── Career Cards ─── */
  .career-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 22px;
    margin-top: 36px;
  }

  .career-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 26px;
    display: flex;
    flex-direction: column;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }

  .career-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--brand);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform var(--transition);
  }

  .career-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(26,86,219,.25);
  }

  .career-card:hover::after {
    transform: scaleX(1);
  }

  .career-header {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 14px;
  }

  .career-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .career-title {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
  }

  .career-desc {
    font-size: 13.5px;
    color: var(--text-2);
    line-height: 1.55;
    margin-bottom: 16px;
    flex: 1;
  }

  .career-meta {
    display: flex;
    flex-direction: column;
    gap: 9px;
    padding: 14px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
  }

  .meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
  }

  .meta-row i {
    color: var(--text-3);
    width: 16px;
  }

  .meta-row strong {
    color: var(--text-1);
  }

  .meta-row span {
    color: var(--text-2);
  }

  .btn-roadmap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 14px;
    font-weight: 600;
    color: var(--brand);
    background: var(--brand-light);
    border-radius: var(--radius-md);
    padding: 10px;
    transition: background var(--transition), color var(--transition);
  }

  .btn-roadmap:hover {
    background: var(--brand);
    color: #fff;
  }

  /* ─── CTA ─── */
  .cta-section {
    background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #2563eb 100%);
    border-radius: var(--radius-xl);
    padding: 64px 48px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .cta-section h2 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(22px,3.5vw,34px);
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
  }

  .cta-section p {
    font-size: 16px;
    color: rgba(255,255,255,.75);
    margin-bottom: 32px;
  }

  .btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    font-size: 16px;
    font-weight: 700;
    color: var(--brand);
    background: #fff;
    padding: 15px 36px;
    border-radius: var(--radius-xl);
    box-shadow: 0 6px 24px rgba(0,0,0,.2);
    transition: transform var(--transition), box-shadow var(--transition);
  }

  .btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 36px rgba(0,0,0,.28);
  }

  .cta-features {
    display: flex;
    justify-content: center;
    gap: 32px;
    flex-wrap: wrap;
    margin-top: 32px;
  }

  .cta-feat {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: rgba(255,255,255,.75);
  }

  .cta-feat i {
    color: #86efac;
  }

  @media(max-width: 768px) {
    .hero {
      padding: 60px 0 56px;
    }

    .hero-slogan {
      font-size: 16px;
    }

    .hero-badge {
      font-size: 18px;
      padding: 12px 24px;
    }

    .hero-badge i {
      font-size: 16px;
    }

    .hero-stats {
      gap: 24px;
    }

    .qual-grid {
      grid-template-columns: 1fr 1fr;
    }

    .field-grid {
      grid-template-columns: repeat(3, 1fr);
    }

    .career-grid {
      grid-template-columns: 1fr;
    }

    .cta-section {
      padding: 44px 24px;
    }

    .filters-bar {
      flex-direction: column;
    }
  }

  @media(max-width: 480px) {
    .qual-grid {
      grid-template-columns: 1fr;
    }

    .field-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* ─── Suggestion Box ─── */
  .suggestion-section {
    background: #f8fafc;
    padding: 80px 0;
    border-top: 1px solid var(--border);
  }

  .suggestion-container {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 48px;
    align-items: start;
  }

  .suggestion-info h2 {
    font-family: 'Sora', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 16px;
  }

  .suggestion-info p {
    color: var(--text-2);
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 32px;
  }

  .suggestion-card {
    background: #fff;
    border-radius: var(--radius-xl);
    padding: 32px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    border: 1px solid var(--border);
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-2);
    margin-bottom: 8px;
  }

  .form-control {
    width: 100%;
    padding: 12px 16px;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--border);
    font-family: inherit;
    font-size: 15px;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--brand);
    box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
  }

  .btn-submit {
    width: 100%;
    background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: var(--radius-lg);
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(29, 78, 216, 0.3);
  }


  @media(max-width: 991px) {
    .suggestion-container {
      grid-template-columns: 1fr;
    }
  }

/* ── How CareerGyan Works Mobile Responsive ── */
@media (max-width: 768px) {
    .how-it-works-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .step-card {
        padding: 24px;
    }
    
    .step-card div[style*="width: 60px"] {
        width: 48px !important;
        height: 48px !important;
        font-size: 24px !important;
        margin-bottom: 16px !important;
    }
    
    .step-card h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    
    .step-card p {
        font-size: 14px;
        line-height: 1.5;
    }
}

@media (max-width: 480px) {
    .how-it-works-grid {
        gap: 16px;
        margin-bottom: 20px;
    }
    
    .step-card {
        padding: 20px;
    }
    
    .step-card div[style*="width: 60px"] {
        width: 40px !important;
        height: 40px !important;
        font-size: 20px !important;
        margin-bottom: 12px !important;
    }
    
    .step-card h3 {
        font-size: 16px;
        margin-bottom: 8px;
    }
    
    .step-card p {
        font-size: 13px;
        line-height: 1.4;
    }
}
</style>
@endsection

@section('content')

<section class="hero">
  <div class="hero-blob hero-blob-1"></div>
  <div class="hero-blob hero-blob-2"></div>

  <div class="container">
    <div class="hero-content">

      <div class="hero-top-area fade-up">
        <div class="hero-slogan">
          ज्ञानात् ज्ञानं ततः सिद्धिः
        </div>

        <div class="hero-badge">
          <i class="fa-solid fa-building-columns"></i>
          INDIAN INSTITUTE OF CAREER MANAGEMENT
        </div>
      </div>

      <h1 class="fade-up fade-up-1">
        Explore Career Paths<br/><em>in India</em>
      </h1>

      <p class="fade-up fade-up-2">
        Find the best career options after 10th, 12th, diploma, or graduation.
        Make informed decisions for a brighter future.
      </p>

      <div class="hero-btns fade-up fade-up-3">
        <a href="{{ url('/explore') }}" class="btn-primary">
          <i class="fa-solid fa-compass"></i> Explore Now
        </a>

        <a href="{{ route('quick-test.start') }}" class="btn-outline">
          <i class="fa-solid fa-gauge-high"></i> Take Quick Test
        </a>
      </div>

      <div class="hero-stats fade-up" style="animation-delay:.46s;opacity:0;">
        <div class="hero-stat">
          <strong>5000+</strong>
          <span>Career Paths</span>
        </div>

        <div class="hero-stat">
          <strong>50+</strong>
          <span>Fields Covered</span>
        </div>

        <div class="hero-stat">
          <strong>Free</strong>
          <span>Career Test</span>
        </div>

        <div class="hero-stat">
          <strong>Expert</strong>
          <span>Roadmaps</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Premium How CareerGyan Works Section -->
<section class="cgw-section">
    <div class="cgw-bg">
        <div class="cgw-blob cgw-blob-1"></div>
        <div class="cgw-blob cgw-blob-2"></div>
        <div class="cgw-blob cgw-blob-3"></div>
        <div class="cgw-dots"></div>
    </div>
    <div class="container cgw-container">
        <div class="cgw-header">
            <div class="section-label"><i class="fa-solid fa-bolt"></i> SIMPLE STEPS</div>
            <h2 class="cgw-title">How CareerGyan <span>Works</span></h2>
            <p class="cgw-subtitle">Simple steps to discover the right career path and colleges for your future.</p>
        </div>
        <div class="cgw-grid">
            <!-- Card 1: Quick Test -->
            <a href="{{ route('quick-test.start') }}" class="cgw-card-link">
                <article class="cgw-card cgw-card--blue">
                    <div class="cgw-card-shine"></div>
                    <div class="cgw-icon-wrap">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3 class="cgw-card-title">Quick Test</h3>
                    <p class="cgw-card-desc">Discover your interests and strengths through our comprehensive aptitude test.</p>
                    <div class="cgw-cta"><span>Start Quick Test</span><i class="fa-solid fa-arrow-right cgw-arrow"></i></div>
                </article>
            </a>
            <!-- Card 2: Get Suggestions -->
            <a href="{{ url('/explore') }}" class="cgw-card-link">
                <article class="cgw-card cgw-card--violet">
                    <div class="cgw-card-shine"></div>
                    <div class="cgw-icon-wrap">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="cgw-card-title">Get Suggestions</h3>
                    <p class="cgw-card-desc">Receive personalized career recommendations based on your test results.</p>
                    <div class="cgw-cta"><span>Explore Careers</span><i class="fa-solid fa-arrow-right cgw-arrow"></i></div>
                </article>
            </a>
            <!-- Card 3: Explore Paths -->
            <a href="{{ url('/explore') }}" class="cgw-card-link">
                <article class="cgw-card cgw-card--emerald">
                    <div class="cgw-card-shine"></div>
                    <div class="cgw-icon-wrap">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <h3 class="cgw-card-title">Explore Paths</h3>
                    <p class="cgw-card-desc">Learn about different career options, salaries, skills required and future scope.</p>
                    <div class="cgw-cta"><span>Explore Careers</span><i class="fa-solid fa-arrow-right cgw-arrow"></i></div>
                </article>
            </a>
            <!-- Card 4: Top Colleges -->
            <a href="{{ url('/explore') }}" class="cgw-card-link cgw-card-link--c4">
                <article class="cgw-card cgw-card--amber">
                    <div class="cgw-card-shine"></div>
                    <div class="cgw-icon-wrap">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h3 class="cgw-card-title">Find Top Colleges</h3>
                    <p class="cgw-card-desc">Discover best colleges by district, state and stream with detailed information.</p>
                    <div class="cgw-cta"><span>Explore Careers</span><i class="fa-solid fa-arrow-right cgw-arrow"></i></div>
                </article>
            </a>
            <!-- Card 5: Build Future -->
            <a href="{{ url('/explore') }}" class="cgw-card-link cgw-card-link--c5">
                <article class="cgw-card cgw-card--rose">
                    <div class="cgw-card-shine"></div>
                    <div class="cgw-icon-wrap">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                    <h3 class="cgw-card-title">Build Your Future</h3>
                    <p class="cgw-card-desc">Plan your career journey with confidence and clear guidance from industry experts.</p>
                    <div class="cgw-cta"><span>Explore Careers</span><i class="fa-solid fa-arrow-right cgw-arrow"></i></div>
                </article>
            </a>
        </div>
    </div>
</section>

<style>
/* ── CareerGyan Works – Premium Section ─────────────────────────── */
.cgw-section {
    position: relative;
    padding: 120px 0;
    background: linear-gradient(160deg, #eef6ff 0%, #f8faff 50%, #ffffff 100%);
    overflow: hidden;
}

/* Layered background */
.cgw-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none; }

.cgw-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
}
.cgw-blob-1 {
    width: 480px; height: 480px;
    background: radial-gradient(circle, rgba(59,130,246,.22), transparent 70%);
    top: -120px; left: -80px;
}
.cgw-blob-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(139,92,246,.18), transparent 70%);
    bottom: -100px; right: -60px;
}
.cgw-blob-3 {
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(251,191,36,.15), transparent 70%);
    top: 45%; left: 55%;
}
.cgw-dots {
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(15,23,42,.045) 1px, transparent 1px);
    background-size: 28px 28px;
}

/* Container */
.cgw-container { position: relative; z-index: 2; }

/* Header */
.cgw-header {
    text-align: center;
    margin-bottom: 72px;
}
.cgw-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(34px, 5vw, 52px);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin-bottom: 18px;
}
.cgw-title span {
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cgw-subtitle {
    font-size: 18px;
    color: #64748b;
    max-width: 620px;
    margin: 0 auto;
    line-height: 1.7;
}

/* Grid – 3 cols first row, 2 centered second row */
.cgw-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 28px;
}
.cgw-card-link {
    grid-column: span 2;
    text-decoration: none;
    display: flex;
}
/* Center cards 4 & 5 on desktop */
@media (min-width: 992px) {
    .cgw-card-link--c4 { grid-column: 2 / span 2; }
    .cgw-card-link--c5 { grid-column: 4 / span 2; }
}

/* Card base */
.cgw-card {
    position: relative;
    background: rgba(255,255,255,.72);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,.85);
    border-radius: 28px;
    padding: 48px 36px 40px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: transform .45s cubic-bezier(.23,1,.32,1),
                box-shadow .45s cubic-bezier(.23,1,.32,1),
                border-color .35s ease;
    box-shadow:
        0 2px 8px rgba(0,0,0,.04),
        0 8px 24px rgba(0,0,0,.06),
        inset 0 1px 0 rgba(255,255,255,.9);
    overflow: hidden;
}

/* Top gradient strip */
.cgw-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 28px 28px 0 0;
    opacity: 0;
    transition: opacity .4s ease;
}
.cgw-card--blue::before  { background: linear-gradient(90deg, #3b82f6, #06b6d4); }
.cgw-card--violet::before { background: linear-gradient(90deg, #8b5cf6, #3b82f6); }
.cgw-card--emerald::before{ background: linear-gradient(90deg, #10b981, #06b6d4); }
.cgw-card--amber::before  { background: linear-gradient(90deg, #f59e0b, #ef4444); }
.cgw-card--rose::before   { background: linear-gradient(90deg, #ec4899, #f97316); }

/* Hover corner-glow shine */
.cgw-card-shine {
    position: absolute;
    top: -60px; right: -60px;
    width: 180px; height: 180px;
    border-radius: 50%;
    opacity: 0;
    filter: blur(40px);
    transition: opacity .5s ease, transform .5s ease;
    pointer-events: none;
}
.cgw-card--blue .cgw-card-shine   { background: rgba(59,130,246,.25); }
.cgw-card--violet .cgw-card-shine  { background: rgba(139,92,246,.25); }
.cgw-card--emerald .cgw-card-shine { background: rgba(16,185,129,.25); }
.cgw-card--amber .cgw-card-shine   { background: rgba(245,158,11,.25); }
.cgw-card--rose .cgw-card-shine    { background: rgba(236,72,153,.25); }

/* Icon */
.cgw-icon-wrap {
    width: 72px; height: 72px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: #fff;
    margin-bottom: 28px;
    position: relative;
    z-index: 1;
    transition: transform .45s cubic-bezier(.34,1.56,.64,1),
                box-shadow .45s ease;
    flex-shrink: 0;
}
.cgw-card--blue .cgw-icon-wrap   { background: linear-gradient(135deg,#3b82f6,#1d4ed8); box-shadow: 0 10px 28px rgba(59,130,246,.35); }
.cgw-card--violet .cgw-icon-wrap  { background: linear-gradient(135deg,#8b5cf6,#6d28d9); box-shadow: 0 10px 28px rgba(139,92,246,.35); }
.cgw-card--emerald .cgw-icon-wrap { background: linear-gradient(135deg,#10b981,#059669); box-shadow: 0 10px 28px rgba(16,185,129,.35); }
.cgw-card--amber .cgw-icon-wrap   { background: linear-gradient(135deg,#f59e0b,#d97706); box-shadow: 0 10px 28px rgba(245,158,11,.35); }
.cgw-card--rose .cgw-icon-wrap    { background: linear-gradient(135deg,#ec4899,#be185d); box-shadow: 0 10px 28px rgba(236,72,153,.35); }

/* Text */
.cgw-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 21px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 14px;
    line-height: 1.3;
    position: relative; z-index: 1;
}
.cgw-card-desc {
    font-size: 15.5px;
    color: #64748b;
    line-height: 1.65;
    margin-bottom: 28px;
    flex-grow: 1;
    position: relative; z-index: 1;
}

/* CTA */
.cgw-cta {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 14.5px;
    font-weight: 700;
    letter-spacing: .01em;
    position: relative; z-index: 1;
    transition: color .3s ease;
}
.cgw-card--blue .cgw-cta   { color: #2563eb; }
.cgw-card--violet .cgw-cta  { color: #7c3aed; }
.cgw-card--emerald .cgw-cta { color: #059669; }
.cgw-card--amber .cgw-cta   { color: #d97706; }
.cgw-card--rose .cgw-cta    { color: #be185d; }

.cgw-arrow {
    transition: transform .35s cubic-bezier(.34,1.56,.64,1);
}

/* ── Hover ─────────────────── */
.cgw-card-link:hover .cgw-card {
    transform: translateY(-14px);
    border-color: rgba(99,102,241,.25);
    box-shadow:
        0 2px 8px rgba(0,0,0,.03),
        0 20px 50px rgba(15,23,42,.12),
        inset 0 1px 0 rgba(255,255,255,.95);
}
.cgw-card-link:hover .cgw-card::before  { opacity: 1; }
.cgw-card-link:hover .cgw-card-shine    { opacity: 1; transform: scale(1.15); }
.cgw-card-link:hover .cgw-icon-wrap     { transform: scale(1.12) rotate(8deg); }
.cgw-card-link:hover .cgw-arrow        { transform: translateX(7px); }

/* ── Responsive ─────────────── */
@media (max-width: 991px) {
    .cgw-card-link { grid-column: span 3; }
    .cgw-card-link--c4,
    .cgw-card-link--c5 { grid-column: span 3; }
    .cgw-section { padding: 80px 0; }
}
@media (max-width: 767px) {
    .cgw-card-link,
    .cgw-card-link--c4,
    .cgw-card-link--c5 { grid-column: span 6; }
    .cgw-grid { gap: 18px; }
    .cgw-card { padding: 36px 28px 32px; }
    .cgw-section { padding: 60px 0; }
}
</style>



<section class="section">
  <div class="container">
    <div class="cta-section">

      <h2>Not sure which career is right for you?</h2>

      <p>
        Take our free AI-powered Quick Test — answer 16 questions and get personalised career recommendations tailored to your interests and strengths.
      </p>

      <a href="{{ route('quick-test.start') }}" class="btn-cta">
        <i class="fa-solid fa-bolt" style="color:var(--accent);"></i>
        Quick Test
        <i class="fa-solid fa-arrow-right"></i>
      </a>

      <div class="cta-features">
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Takes only 20 minutes</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Personalised results</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Expert roadmaps included</div>
      </div>
    </div>
  </div>
<section class="suggestion-section">
  <div class="container">
    <div class="suggestion-container">
      
      <div class="suggestion-info">
        <div class="section-label">
          <i class="fa-solid fa-lightbulb"></i> Feedback
        </div>
        <h2>💡 Share Your Suggestions</h2>
        <p>Your ideas help us build a better platform for everyone. Whether it's a new feature request or feedback on existing content, we'd love to hear from you!</p>
      </div>

      <div class="suggestion-card">
        @if(session('success'))
          <div style="background: #dcfce7; color: #166534; padding: 24px; border-radius: var(--radius-lg); text-align: center; font-weight: 600;">
            <div style="font-size: 40px; margin-bottom: 16px;">✅</div>
            <div style="font-size: 18px; line-height: 1.5;">{{ session('success') }}</div>
          </div>
        @else
          <form action="{{ route('suggestion.store') }}" method="POST">
            @csrf
            <!-- Honeypot -->
            <div style="display: none;">
              <input type="text" name="website" value="">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
              </div>
            </div>

            <div class="form-group">
              <label for="role">I am a...</label>
              <select name="role" id="role" class="form-control" required>
                <option value="Student">Student</option>
                <option value="Expert">Expert</option>
                <option value="Parent">Parent</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Suggestion Message <span style="color: #dc2626;">*</span></label>
              <textarea name="message" id="message" rows="4" class="form-control" placeholder="Tell us how we can improve..." required></textarea>
              @error('message')
                <span style="color: #dc2626; font-size: 12px;">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn-submit">
              Send Suggestion <i class="fa-solid fa-paper-plane"></i>
            </button>
          </form>
        @endif
      </div>

    </div>
  </div>
</section>

@endsection
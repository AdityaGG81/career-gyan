@extends('layouts.app')

@section('title', 'CareerGyan | Indian Institute of Career Management')

@section('styles')
<style>
  /* ─── Hero ─── */
  .hero {
    position: relative; overflow: hidden;
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 55%, #3b82f6 100%);
    padding: 90px 0 80px;
  }
  .hero::before {
    content: ''; position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }
  .hero-blob {
    position: absolute; border-radius: 50%; filter: blur(64px); opacity: .3;
    pointer-events: none;
  }
  .hero-blob-1 { width: 400px; height: 400px; background: #60a5fa; top: -100px; right: -80px; }
  .hero-blob-2 { width: 260px; height: 260px; background: #f97316; bottom: -60px; left: 5%; }
  .hero-content { position: relative; z-index: 1; text-align: center; }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
    color: #e0eaff; font-size: 13px; font-weight: 500;
    padding: 7px 16px; border-radius: 999px; margin-bottom: 24px;
    backdrop-filter: blur(4px);
  }
  .hero-badge i { color: #fbbf24; font-size: 12px; }
  .hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(30px, 5.5vw, 56px); font-weight: 700;
    color: #fff; line-height: 1.15; margin-bottom: 18px;
    text-shadow: 0 2px 20px rgba(0,0,0,.15);
  }
  .hero h1 em { color: #fbbf24; font-style: normal; }
  .hero p {
    font-size: clamp(16px, 2vw, 19px); color: rgba(255,255,255,.82);
    max-width: 560px; margin: 0 auto 36px; line-height: 1.65;
  }
  .hero-btns { display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; }
  .btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 15.5px; font-weight: 600; color: var(--brand);
    background: #fff; padding: 13px 28px; border-radius: var(--radius-lg);
    box-shadow: 0 4px 18px rgba(0,0,0,.18);
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.22); }
  .btn-outline {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 15.5px; font-weight: 600; color: #fff;
    background: rgba(255,255,255,.12); border: 1.5px solid rgba(255,255,255,.4);
    padding: 13px 28px; border-radius: var(--radius-lg);
    backdrop-filter: blur(4px);
    transition: background var(--transition), transform var(--transition);
  }
  .btn-outline:hover { background: rgba(255,255,255,.2); transform: translateY(-2px); }
  .hero-stats {
    display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;
    margin-top: 52px;
  }
  .hero-stat { text-align: center; }
  .hero-stat strong { display: block; font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #fff; }
  .hero-stat span { font-size: 13px; color: rgba(255,255,255,.65); }

  /* ─── Qualification Cards ─── */
  .qual-grid {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px; margin-top: 36px;
  }
  .qual-card {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: var(--radius-xl); padding: 28px 24px 24px;
    cursor: pointer; position: relative; overflow: hidden;
    transition: border-color var(--transition), transform var(--transition), box-shadow var(--transition);
  }
  .qual-card::before {
    content: ''; position: absolute; inset: 0; opacity: 0;
    transition: opacity var(--transition);
  }
  .qual-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); border-color: transparent; }
  .qual-card:hover::before { opacity: 1; }

  .qual-card.card-blue::before  { background: linear-gradient(135deg,#eff6ff,#dbeafe); border: 1.5px solid #bfdbfe; }
  .qual-card.card-green::before { background: linear-gradient(135deg,#f0fdf4,#dcfce7); border: 1.5px solid #bbf7d0; }
  .qual-card.card-purple::before { background: linear-gradient(135deg,#faf5ff,#ede9fe); border: 1.5px solid #ddd6fe; }
  .qual-card.card-amber::before { background: linear-gradient(135deg,#fffbeb,#fef3c7); border: 1.5px solid #fde68a; }

  .qual-icon {
    width: 52px; height: 52px; border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin-bottom: 18px; position: relative; z-index: 1;
  }
  .icon-blue   { background: var(--brand-light);  color: var(--brand); }
  .icon-green  { background: var(--green-light);  color: var(--green); }
  .icon-purple { background: var(--purple-light); color: var(--purple); }
  .icon-amber  { background: var(--amber-light);  color: var(--amber); }

  .qual-card h3 { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 600; margin-bottom: 7px; position: relative; z-index: 1; }
  .qual-card p  { font-size: 14px; color: var(--text-2); line-height: 1.55; position: relative; z-index: 1; }
  .qual-card .card-arrow {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 13px; font-weight: 600; color: var(--brand);
    margin-top: 16px; position: relative; z-index: 1;
    transition: gap var(--transition);
  }
  .qual-card:hover .card-arrow { gap: 9px; }

  /* ─── Filters ─── */
  .filters-bar {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-xl); padding: 20px 24px;
    display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;
    box-shadow: var(--shadow-sm);
  }
  .filter-group { display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 160px; }
  .filter-group label { font-size: 12px; font-weight: 600; color: var(--text-2); letter-spacing: .04em; text-transform: uppercase; }
  .filter-group select {
    font-family: 'DM Sans', sans-serif; font-size: 14.5px;
    color: var(--text-1); background: var(--bg);
    border: 1.5px solid var(--border); border-radius: var(--radius-md);
    padding: 9px 14px; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2394a3b8' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center;
    cursor: pointer; transition: border-color var(--transition);
  }
  .filter-group select:focus { outline: none; border-color: var(--brand); }
  .filter-btn {
    font-size: 14.5px; font-weight: 600; color: #fff;
    background: var(--brand); padding: 10px 24px; border-radius: var(--radius-md);
    transition: background var(--transition), transform var(--transition);
    align-self: flex-end;
  }
  .filter-btn:hover { background: var(--brand-dark); transform: translateY(-1px); }

  /* ─── Field Grid ─── */
  .field-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 16px; margin-top: 36px;
  }
  .field-item {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: var(--radius-lg); padding: 22px 18px;
    display: flex; flex-direction: column; align-items: center; gap: 12px;
    cursor: pointer; text-align: center;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  }
  .field-item:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--brand); }
  .field-item:hover .field-icon { transform: scale(1.1); }
  .field-icon {
    width: 54px; height: 54px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; transition: transform var(--transition);
  }
  .field-item h4 { font-family: 'Sora', sans-serif; font-size: 14.5px; font-weight: 600; }
  .field-item span { font-size: 12.5px; color: var(--text-3); }

  /* ─── Career Cards ─── */
  .career-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 22px; margin-top: 36px;
  }
  .career-card {
    background: var(--surface); border: 1.5px solid var(--border);
    border-radius: var(--radius-xl); padding: 26px;
    display: flex; flex-direction: column;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
    cursor: pointer; position: relative; overflow: hidden;
  }
  .career-card::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    background: var(--brand); transform: scaleX(0); transform-origin: left;
    transition: transform var(--transition);
  }
  .career-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); border-color: rgba(26,86,219,.25); }
  .career-card:hover::after { transform: scaleX(1); }

  .career-header { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 14px; }
  .career-icon {
    width: 48px; height: 48px; border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center; font-size: 20px;
    flex-shrink: 0;
  }
  .career-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; margin-bottom: 4px; }
  .career-desc { font-size: 13.5px; color: var(--text-2); line-height: 1.55; margin-bottom: 16px; flex: 1; }
  .career-meta {
    display: flex; flex-direction: column; gap: 9px;
    padding: 14px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
  }
  .meta-row { display: flex; align-items: center; gap: 8px; font-size: 13px; }
  .meta-row i { color: var(--text-3); font-size: 13px; width: 16px; }
  .meta-row strong { color: var(--text-1); }
  .meta-row span { color: var(--text-2); }
  .btn-roadmap {
    display: flex; align-items: center; justify-content: center; gap: 7px;
    font-size: 14px; font-weight: 600; color: var(--brand);
    background: var(--brand-light); border-radius: var(--radius-md);
    padding: 10px; transition: background var(--transition), color var(--transition);
  }
  .btn-roadmap:hover { background: var(--brand); color: #fff; }

  /* ─── CTA ─── */
  .cta-section {
    background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #2563eb 100%);
    border-radius: var(--radius-xl); padding: 64px 48px;
    text-align: center; position: relative; overflow: hidden;
  }
  .cta-section::before {
    content: ''; position: absolute;
    width: 320px; height: 320px; background: rgba(255,255,255,.05);
    border-radius: 50%; top: -80px; right: -60px;
  }
  .cta-section::after {
    content: ''; position: absolute;
    width: 200px; height: 200px; background: rgba(249,115,22,.15);
    border-radius: 50%; bottom: -60px; left: 10%;
  }
  .cta-section h2 {
    font-family: 'Sora', sans-serif; font-size: clamp(22px,3.5vw,34px);
    font-weight: 700; color: #fff; margin-bottom: 12px; position: relative; z-index: 1;
  }
  .cta-section p { font-size: 16px; color: rgba(255,255,255,.75); margin-bottom: 32px; position: relative; z-index: 1; }
  .btn-cta {
    display: inline-flex; align-items: center; gap: 9px;
    font-size: 16px; font-weight: 700; color: var(--brand);
    background: #fff; padding: 15px 36px; border-radius: var(--radius-xl);
    box-shadow: 0 6px 24px rgba(0,0,0,.2);
    transition: transform var(--transition), box-shadow var(--transition);
    position: relative; z-index: 1;
  }
  .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 10px 36px rgba(0,0,0,.28); }
  .cta-features {
    display: flex; justify-content: center; gap: 32px; flex-wrap: wrap;
    margin-top: 32px; position: relative; z-index: 1;
  }
  .cta-feat {
    display: flex; align-items: center; gap: 8px;
    font-size: 13.5px; color: rgba(255,255,255,.75);
  }
  .cta-feat i { color: #86efac; }

  /* ─── Responsive for Home Specific Elements ─── */
  @media(max-width: 768px) {
    .hero { padding: 60px 0 56px; }
    .hero-stats { gap: 24px; }
    .qual-grid { grid-template-columns: 1fr 1fr; }
    .field-grid { grid-template-columns: repeat(3, 1fr); }
    .career-grid { grid-template-columns: 1fr; }
    .cta-section { padding: 44px 24px; }
    .filters-bar { flex-direction: column; }
  }
  @media(max-width: 480px) {
    .qual-grid { grid-template-columns: 1fr; }
    .field-grid { grid-template-columns: repeat(2, 1fr); }
  }
</style>
@endsection

@section('content')
<!-- ═══════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════ -->
<section class="hero">
  <div class="hero-blob hero-blob-1"></div>
  <div class="hero-blob hero-blob-2"></div>
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge fade-up" style="font-size: 16px; font-weight: 600; letter-spacing: 0.5px; padding: 10px 24px;">
        <i class="fa-solid fa-building-columns"></i>
        Brought to you by Indian Institute of Career Management
      </div>
      <h1 class="fade-up fade-up-1">
        Explore Career Paths<br/><em>in India</em>
      </h1>
      <p class="fade-up fade-up-2">Find the best career options after 10th, 12th, diploma, or graduation. Make informed decisions for a brighter future.</p>
      <div class="hero-btns fade-up fade-up-3">
        <a href="{{ url('/explore') }}" class="btn-primary"><i class="fa-solid fa-compass"></i> Explore Now</a>
        <a href="#" class="btn-outline"><i class="fa-solid fa-bolt"></i> Take Free Test</a>
      </div>
      <div class="hero-stats fade-up" style="animation-delay:.46s;opacity:0;">
        <div class="hero-stat"><strong>500+</strong><span>Career Paths</span></div>
        <div class="hero-stat"><strong>12</strong><span>Fields Covered</span></div>
        <div class="hero-stat"><strong>Free</strong><span>Career Test</span></div>
        <div class="hero-stat"><strong>Expert</strong><span>Roadmaps</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
     EXPLORE BY QUALIFICATION
═══════════════════════════════════════ -->
<section class="section" id="qualification">
  <div class="container">
    <div class="section-label"><i class="fa-solid fa-graduation-cap"></i> By Qualification</div>
    <h2 class="section-title">What's your current level?</h2>
    <p class="section-sub">Choose your qualification to see relevant career paths tailored for you.</p>

    <div class="qual-grid">
      <!-- After 10th -->
      <div class="qual-card card-blue" onclick="location.href='{{ url('/explore') }}'">
        <div class="qual-icon icon-blue"><i class="fa-solid fa-school"></i></div>
        <h3>After 10th</h3>
        <p>Explore ITI, polytechnic, vocational courses and diploma programmes.</p>
        <div class="card-arrow">Explore options <i class="fa-solid fa-arrow-right"></i></div>
      </div>

      <!-- After 12th -->
      <div class="qual-card card-green" onclick="location.href='{{ url('/explore') }}'">
        <div class="qual-icon icon-green"><i class="fa-solid fa-book-open"></i></div>
        <h3>After 12th</h3>
        <p>Science, Commerce & Arts streams — find degrees, courses & entrance exams.</p>
        <div class="card-arrow" style="color:var(--green)">Explore options <i class="fa-solid fa-arrow-right"></i></div>
      </div>

      <!-- After Diploma -->
      <div class="qual-card card-purple" onclick="location.href='{{ url('/explore') }}'">
        <div class="qual-icon icon-purple"><i class="fa-solid fa-certificate"></i></div>
        <h3>After Diploma</h3>
        <p>Lateral entry to B.Tech, specialised roles in engineering & technology sectors.</p>
        <div class="card-arrow" style="color:var(--purple)">Explore options <i class="fa-solid fa-arrow-right"></i></div>
      </div>

      <!-- After Graduation -->
      <div class="qual-card card-amber" onclick="location.href='{{ url('/explore') }}'">
        <div class="qual-icon icon-amber"><i class="fa-solid fa-university"></i></div>
        <h3>After Graduation</h3>
        <p>MBA, M.Tech, UPSC, CA Final, research & corporate opportunities await.</p>
        <div class="card-arrow" style="color:var(--amber)">Explore options <i class="fa-solid fa-arrow-right"></i></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
     FILTERS UI (UI only static demo)
═══════════════════════════════════════ -->
<section style="padding: 0 0 32px;">
  <div class="container">
    <div class="filters-bar">
      <div class="filter-group">
        <label><i class="fa-solid fa-filter"></i> &nbsp;Qualification</label>
        <select>
          <option value="">All Qualifications</option>
          <option>After 10th</option>
          <option>After 12th – Science</option>
          <option>After 12th – Commerce</option>
          <option>After 12th – Arts</option>
          <option>After Diploma</option>
          <option>After Graduation</option>
        </select>
      </div>
      <div class="filter-group">
        <label><i class="fa-solid fa-layer-group"></i> &nbsp;Field / Stream</label>
        <select>
          <option value="">All Fields</option>
          <option>Engineering & Technology</option>
          <option>Medical & Healthcare</option>
          <option>Commerce & Finance</option>
          <option>Arts & Design</option>
          <option>Government & UPSC</option>
          <option>Science & Research</option>
        </select>
      </div>
      <div class="filter-group">
        <label><i class="fa-solid fa-indian-rupee-sign"></i> &nbsp;Course Budget</label>
        <select>
          <option value="">Any Budget</option>
          <option>Low (Under ₹50K/yr)</option>
          <option>Medium (₹50K–₹2L/yr)</option>
          <option>High (₹2L+/yr)</option>
        </select>
      </div>
      <button class="filter-btn" onclick="location.href='{{ url('/explore') }}'"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Apply Filters</button>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
     EXPLORE BY FIELD
═══════════════════════════════════════ -->
<section class="section" style="padding-top:16px;" id="fields">
  <div class="container">
    <div class="section-label"><i class="fa-solid fa-shapes"></i> By Field</div>
    <h2 class="section-title">Browse by Field</h2>
    <p class="section-sub">Not sure where to start? Pick a field that excites you.</p>

    <div class="field-grid">
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#eff6ff;"><i class="fa-solid fa-flask" style="color:#1d4ed8;font-size:22px;"></i></div>
        <h4>Science</h4>
        <span>38 Careers</span>
      </div>
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#ecfdf5;"><i class="fa-solid fa-chart-line" style="color:#16a34a;font-size:22px;"></i></div>
        <h4>Commerce</h4>
        <span>45 Careers</span>
      </div>
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#fdf4ff;"><i class="fa-solid fa-palette" style="color:#9333ea;font-size:22px;"></i></div>
        <h4>Arts</h4>
        <span>32 Careers</span>
      </div>
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#fff1f0;"><i class="fa-solid fa-microchip" style="color:#dc2626;font-size:22px;"></i></div>
        <h4>Engineering</h4>
        <span>62 Careers</span>
      </div>
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#fff7ed;"><i class="fa-solid fa-stethoscope" style="color:#ea580c;font-size:22px;"></i></div>
        <h4>Medical</h4>
        <span>40 Careers</span>
      </div>
      <div class="field-item" onclick="location.href='{{ url('/explore') }}'">
        <div class="field-icon" style="background:#f0fdfa;"><i class="fa-solid fa-landmark" style="color:#0d9488;font-size:22px;"></i></div>
        <h4>Govt Jobs</h4>
        <span>55 Careers</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
     CAREER LIST SECTION
═══════════════════════════════════════ -->
<section class="section" id="careers" style="background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border);">
  <div class="container">
    <div class="section-label"><i class="fa-solid fa-briefcase"></i> Career Options</div>
    <h2 class="section-title">Popular Career Paths in India</h2>
    <p class="section-sub">Explore detailed roadmaps, qualification requirements, and salary insights.</p>

    <div class="career-grid" style="margin-top:36px;">
      <!-- Card 1: Software Engineer -->
      <div class="career-card" onclick="location.href='{{ url('/explore') }}'">
        <div class="career-header">
          <div class="career-icon" style="background:#eff6ff;"><i class="fa-solid fa-code" style="color:#1d4ed8;font-size:20px;"></i></div>
          <div>
            <div class="career-title">Software Engineer</div>
            <span class="tag badge-blue">Engineering</span>
          </div>
        </div>
        <p class="career-desc">Design, develop and maintain software systems for companies across all industries — one of India's fastest-growing professions.</p>
        <div class="career-meta">
          <div class="meta-row"><i class="fa-solid fa-graduation-cap"></i><span>Required: </span><strong>B.Tech / BCA / B.Sc CS</strong></div>
          <div class="meta-row"><i class="fa-solid fa-indian-rupee-sign"></i><span>Salary: </span><strong>₹4L – ₹40L per annum</strong></div>
          <div class="meta-row"><i class="fa-solid fa-chart-simple"></i><span>Demand: </span><span class="tag badge-green">Very High</span></div>
        </div>
        <span class="btn-roadmap"><i class="fa-solid fa-map-location-dot"></i> View Roadmap</span>
      </div>

      <!-- Card 2: Doctor -->
      <div class="career-card" onclick="location.href='{{ url('/explore') }}'">
        <div class="career-header">
          <div class="career-icon" style="background:#fff7ed;"><i class="fa-solid fa-user-doctor" style="color:#ea580c;font-size:20px;"></i></div>
          <div>
            <div class="career-title">Doctor (MBBS)</div>
            <span class="tag badge-amber">Medical</span>
          </div>
        </div>
        <p class="career-desc">Diagnose and treat patients — a respected and highly rewarding profession requiring dedication, empathy, and rigorous study.</p>
        <div class="career-meta">
          <div class="meta-row"><i class="fa-solid fa-graduation-cap"></i><span>Required: </span><strong>MBBS (via NEET UG)</strong></div>
          <div class="meta-row"><i class="fa-solid fa-indian-rupee-sign"></i><span>Salary: </span><strong>₹8L – ₹60L per annum</strong></div>
          <div class="meta-row"><i class="fa-solid fa-chart-simple"></i><span>Demand: </span><span class="tag badge-green">Very High</span></div>
        </div>
        <span class="btn-roadmap"><i class="fa-solid fa-map-location-dot"></i> View Roadmap</span>
      </div>

      <!-- Card 3: Chartered Accountant -->
      <div class="career-card" onclick="location.href='{{ url('/explore') }}'">
        <div class="career-header">
          <div class="career-icon" style="background:#ecfdf5;"><i class="fa-solid fa-file-invoice-dollar" style="color:#16a34a;font-size:20px;"></i></div>
          <div>
            <div class="career-title">Chartered Accountant</div>
            <span class="tag badge-green">Commerce</span>
          </div>
        </div>
        <p class="career-desc">Manage financial audits, taxation, and accounts for businesses and individuals. CA is one of India's most prestigious commerce careers.</p>
        <div class="career-meta">
          <div class="meta-row"><i class="fa-solid fa-graduation-cap"></i><span>Required: </span><strong>12th Commerce + CA Exams</strong></div>
          <div class="meta-row"><i class="fa-solid fa-indian-rupee-sign"></i><span>Salary: </span><strong>₹7L – ₹50L per annum</strong></div>
          <div class="meta-row"><i class="fa-solid fa-chart-simple"></i><span>Demand: </span><span class="tag badge-green">High</span></div>
        </div>
        <span class="btn-roadmap"><i class="fa-solid fa-map-location-dot"></i> View Roadmap</span>
      </div>
    </div>

    <!-- Show more button -->
    <div style="text-align:center; margin-top:36px;">
      <button onclick="location.href='{{ url('/explore') }}'" style="font-size:15px;font-weight:600;color:var(--brand);background:var(--brand-light);padding:12px 32px;border-radius:var(--radius-lg);border:1.5px solid rgba(26,86,219,.2);cursor:pointer;transition:background .2s;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='var(--brand-light)'">
        <i class="fa-solid fa-grid"></i> &nbsp;View All 500+ Careers
      </button>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
     CALL TO ACTION SECTION
═══════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="cta-section">
      <div style="margin-bottom:14px;position:relative;z-index:1;">
        <span style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#e0eaff;font-size:13px;font-weight:500;padding:6px 16px;border-radius:999px;">
          <i class="fa-solid fa-bolt" style="color:#fbbf24;"></i> &nbsp;Free · No Registration Required
        </span>
      </div>
      <h2>Not sure which career is right for you?</h2>
      <p>Take our free AI-powered career test — answer 15 questions and get personalised career recommendations tailored to your interests and strengths.</p>
      <a href="#" class="btn-cta">
        <i class="fa-solid fa-bolt" style="color:var(--accent);"></i>
        Take Free Career Test
        <i class="fa-solid fa-arrow-right"></i>
      </a>
      <div class="cta-features">
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Takes only 5 minutes</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> No sign-up needed</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Personalised results</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Expert roadmaps included</div>
      </div>
    </div>
  </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'About Us | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
/* ─── CSS Variables ─── */
:root {
    --brand: #1a56db;
    --brand-dark: #1341a8;
    --brand-light: #e8f0fe;
    --accent: #f97316;
    --bg: #f8fafc;
    --surface: #ffffff;
    --border: #e2e8f0;
    --text-1: #0f172a;
    --text-2: #475569;
    --text-3: #94a3b8;
    --radius-md: 10px;
    --radius-lg: 16px;
    --radius-xl: 22px;
}

/* ─── Hero ─── */
.about-hero {
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 60%, #2563eb 100%);
    color: #fff;
    padding: 120px 0 100px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.about-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(30px, 5vw, 44px);
    font-weight: 800;
    margin-bottom: 16px;
    position: relative;
    z-index: 2;
}
.about-hero p {
    font-size: 18px;
    color: rgba(255,255,255,.8);
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    line-height: 1.7;
}
.about-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    color: rgba(255,255,255,.6);
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}
.about-breadcrumb a {
    color: rgba(255,255,255,.7);
    text-decoration: none;
    transition: color .3s;
}
.about-breadcrumb a:hover { color: #fff; }

/* ─── Floating SVG Doodles ─── */
.doodle {
    position: absolute;
    opacity: 0.08;
    z-index: 1;
    animation: doodleFloat 6s ease-in-out infinite;
}
.doodle-1 { top: 15%; left: 8%; animation-delay: 0s; }
.doodle-2 { top: 25%; right: 10%; animation-delay: -2s; }
.doodle-3 { bottom: 15%; left: 15%; animation-delay: -4s; }
.doodle-4 { bottom: 20%; right: 8%; animation-delay: -1s; }
.doodle-5 { top: 50%; left: 50%; animation-delay: -3s; }
@keyframes doodleFloat {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

/* ─── Mission & Vision ─── */
.mv-section {
    padding: 80px 0;
    background: var(--bg);
}
.mv-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}
.mv-card {
    background: var(--surface);
    border-radius: var(--radius-xl);
    padding: 40px;
    border: 1px solid var(--border);
    border-top: 4px solid transparent;
    box-shadow: 0 4px 20px rgba(0,0,0,.04);
    transition: transform .4s cubic-bezier(.4,0,.2,1), box-shadow .4s;
    position: relative;
    overflow: hidden;
}
.mv-card:nth-child(1) { border-image: linear-gradient(135deg, #1a56db, #2563eb) 1; border-image-slice: 1; border-top-width: 4px; }
.mv-card:nth-child(2) { border-image: linear-gradient(135deg, #f97316, #f59e0b) 1; border-image-slice: 1; border-top-width: 4px; }
.mv-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0,0,0,.08);
}
.mv-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 20px;
}
.mv-card:nth-child(1) .mv-icon { background: var(--brand-light); color: var(--brand); }
.mv-card:nth-child(2) .mv-icon { background: #fff7ed; color: var(--accent); }
.mv-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 12px;
}
.mv-card p {
    color: var(--text-2);
    line-height: 1.7;
    font-size: 15px;
}

/* ─── What We Offer ─── */
.offer-section {
    padding: 80px 0;
    background: var(--surface);
}
.offer-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 48px;
}
.offer-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    text-align: center;
    transition: all .4s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.offer-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--brand-light), transparent);
    opacity: 0;
    transition: opacity .4s;
}
.offer-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(26,86,219,.1);
    border-color: var(--brand);
}
.offer-card:hover::before { opacity: 1; }
.offer-icon {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 20px;
    position: relative;
    z-index: 1;
    transition: transform .4s;
}
.offer-card:hover .offer-icon { transform: scale(1.1) rotate(5deg); }
.offer-card h4 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}
.offer-card p {
    color: var(--text-2);
    font-size: 14px;
    line-height: 1.6;
    position: relative;
    z-index: 1;
}

/* ─── Impact Numbers ─── */
.impact-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 60%, #2563eb 100%);
    color: #fff;
}
.impact-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    margin-top: 48px;
}
.impact-card {
    text-align: center;
    padding: 32px 16px;
    border-radius: var(--radius-xl);
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.15);
    transition: transform .4s, background .4s;
}
.impact-card:hover {
    transform: translateY(-4px);
    background: rgba(255,255,255,.12);
}
.impact-number {
    font-family: 'Sora', sans-serif;
    font-size: clamp(36px, 5vw, 52px);
    font-weight: 800;
    background: linear-gradient(135deg, #fff, #93c5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
}
.impact-label {
    font-size: 15px;
    color: rgba(255,255,255,.7);
    font-weight: 500;
}
.impact-icon {
    font-size: 28px;
    margin-bottom: 16px;
    color: rgba(255,255,255,.5);
}

/* ─── Our Story ─── */
.story-section {
    padding: 80px 0;
    background: var(--bg);
}
.story-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}
.story-content p {
    color: var(--text-2);
    font-size: 16px;
    line-height: 1.85;
    margin-bottom: 24px;
}
.slogan-card {
    background: linear-gradient(135deg, #0e1f6b, #1a56db);
    border-radius: var(--radius-xl);
    padding: 40px;
    color: #fff;
    margin-top: 32px;
}
.slogan-sanskrit {
    font-size: clamp(22px, 3vw, 30px);
    font-weight: 700;
    margin-bottom: 12px;
    font-family: 'Sora', sans-serif;
    background: linear-gradient(135deg, #fff, #93c5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.slogan-translation {
    font-size: 16px;
    color: rgba(255,255,255,.7);
    font-style: italic;
}

/* ─── Team Section ─── */
.team-section {
    padding: 80px 0;
    background: var(--surface);
}
.team-header {
    text-align: center;
    margin-bottom: 48px;
}
.section-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--brand);
    background: var(--brand-light);
    padding: 6px 16px;
    border-radius: 30px;
    margin-bottom: 16px;
}
.section-heading {
    font-family: 'Sora', sans-serif;
    font-size: clamp(24px, 4vw, 36px);
    font-weight: 800;
    color: var(--text-1);
}
.section-sub-text {
    color: var(--text-2);
    font-size: 16px;
    max-width: 600px;
    margin: 12px auto 0;
}
.team-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}
.team-role-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    box-shadow: 0 2px 12px rgba(0,0,0,.04);
    transition: transform .3s ease, box-shadow .3s ease;
}
.team-role-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,.08);
}
.team-role-card--wide { grid-column: span 2; }
.team-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 999px;
    margin-bottom: 24px;
}
.role-principal { background: #dbeafe; color: #1e3a8a; }
.role-ceo       { background: #ede9fe; color: #5b21b6; }
.role-creative  { background: #d1fae5; color: #065f46; }
.role-thanks    { background: #fce7f3; color: #9d174d; }
.team-members-list {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
}
.team-member {
    display: flex;
    align-items: center;
    gap: 14px;
}
.team-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: .03em;
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
    position: relative;
}
.team-avatar::after {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,.3);
}
.team-member-name {
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--text-1);
}

/* ─── FAQ Section ─── */
.faq-section {
    padding: 80px 0;
    background: var(--bg);
}
.faq-list {
    max-width: 800px;
    margin: 48px auto 0;
}
.faq-item {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    margin-bottom: 12px;
    overflow: hidden;
    transition: box-shadow .3s;
}
.faq-item:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
}
.faq-question {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    cursor: pointer;
    gap: 16px;
    user-select: none;
}
.faq-question h4 {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-1);
    margin: 0;
    flex: 1;
}
.faq-toggle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--brand-light);
    color: var(--brand);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
    transition: transform .3s, background .3s;
}
.faq-item.active .faq-toggle {
    transform: rotate(180deg);
    background: var(--brand);
    color: #fff;
}
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height .4s ease, padding .4s ease;
}
.faq-answer-inner {
    padding: 0 24px 20px;
    color: var(--text-2);
    font-size: 14px;
    line-height: 1.7;
}

/* ─── Contact Section ─── */
.contact-section {
    padding: 0 0 80px;
    background: var(--bg);
}
.contact-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 48px;
    box-shadow: 0 8px 32px rgba(0,0,0,.06);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
}
.ct-block { margin-bottom: 24px; }
.ct-block h3 {
    color: var(--brand);
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ct-block p {
    color: var(--text-2);
    font-size: 15px;
    line-height: 1.7;
}
.ct-block a {
    color: var(--brand);
    text-decoration: none;
    font-weight: 600;
    transition: color .3s;
}
.ct-block a:hover { color: var(--brand-dark); }
.ct-right {
    background: var(--bg);
    border: 1px solid var(--border);
    padding: 32px;
    border-radius: var(--radius-lg);
}

/* ─── Responsive ─── */
@media (max-width: 1024px) {
    .offer-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .mv-grid { grid-template-columns: 1fr; }
    .offer-grid { grid-template-columns: 1fr; }
    .impact-grid { grid-template-columns: 1fr 1fr; }
    .team-grid { grid-template-columns: 1fr; }
    .team-role-card--wide { grid-column: span 1; }
    .team-members-list { flex-direction: column; gap: 16px; }
    .team-role-card { padding: 24px; }
    .contact-card { grid-template-columns: 1fr; padding: 30px; }
    .about-hero { padding: 80px 0 60px; }
    .ct-block .working-hours { font-size: 14px !important; }
}
@media (max-width: 480px) {
    .impact-grid { grid-template-columns: 1fr; }
}

/* ─── Animations ─── */
.fade-up {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity .6s ease, transform .6s ease;
}
.fade-up.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
@endsection

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="about-hero">
    {{-- Floating SVG Doodles --}}
    <svg class="doodle doodle-1" width="80" height="80" viewBox="0 0 80 80" fill="none">
        <rect x="10" y="15" width="60" height="50" rx="4" stroke="white" stroke-width="2" fill="none"/>
        <line x1="10" y1="30" x2="70" y2="30" stroke="white" stroke-width="2"/>
        <line x1="20" y1="40" x2="60" y2="40" stroke="white" stroke-width="1.5"/>
        <line x1="20" y1="48" x2="50" y2="48" stroke="white" stroke-width="1.5"/>
        <line x1="20" y1="56" x2="55" y2="56" stroke="white" stroke-width="1.5"/>
    </svg>
    <svg class="doodle doodle-2" width="90" height="90" viewBox="0 0 90 90" fill="none">
        <path d="M45 10 L75 35 L65 35 L65 55 L25 55 L25 35 L15 35 Z" stroke="white" stroke-width="2" fill="none"/>
        <rect x="37" y="42" width="16" height="13" stroke="white" stroke-width="2" fill="none"/>
        <path d="M30 55 L30 75 L60 75 L60 55" stroke="white" stroke-width="2" fill="none"/>
    </svg>
    <svg class="doodle doodle-3" width="70" height="70" viewBox="0 0 70 70" fill="none">
        <circle cx="35" cy="30" r="15" stroke="white" stroke-width="2" fill="none"/>
        <path d="M35 15 L35 8 M35 52 L35 62 M20 30 L12 30 M58 30 L50 30" stroke="white" stroke-width="2"/>
        <circle cx="35" cy="30" r="5" stroke="white" stroke-width="2" fill="none"/>
    </svg>
    <svg class="doodle doodle-4" width="80" height="80" viewBox="0 0 80 80" fill="none">
        <ellipse cx="40" cy="20" rx="25" ry="8" stroke="white" stroke-width="2" fill="none"/>
        <line x1="40" y1="28" x2="40" y2="50" stroke="white" stroke-width="3"/>
        <path d="M25 50 L40 65 L55 50" stroke="white" stroke-width="2" fill="none"/>
    </svg>
    <svg class="doodle doodle-5" width="60" height="60" viewBox="0 0 60 60" fill="none">
        <path d="M30 5 C30 5 45 15 45 30 C45 38 38 45 30 45 C22 45 15 38 15 30 C15 15 30 5 30 5Z" stroke="white" stroke-width="2" fill="none"/>
        <line x1="30" y1="45" x2="30" y2="55" stroke="white" stroke-width="2"/>
        <line x1="24" y1="55" x2="36" y2="55" stroke="white" stroke-width="2"/>
    </svg>

    <div class="container">
        <div class="about-breadcrumb">
            <a href="{{ url('/') }}"><i class="fa-solid fa-house" style="font-size:12px;"></i> Home</a>
            <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
            <span>About</span>
        </div>
        <h1>About CareerGyan</h1>
        <p>Empowering students and professionals to make data-driven, confident career choices through India's most comprehensive career guidance platform.</p>
    </div>
</section>

{{-- ═══ MISSION & VISION ═══ --}}
<section class="mv-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:48px;">
            <div class="section-label"><i class="fa-solid fa-compass"></i> OUR PURPOSE</div>
            <h2 class="section-heading">Mission & Vision</h2>
        </div>
        <div class="mv-grid">
            <div class="mv-card fade-up">
                <div class="mv-icon"><i class="fa-solid fa-bullseye"></i></div>
                <h3>Our Mission</h3>
                <p>To empower every student in India to make informed, confident career decisions through comprehensive data-driven guidance. We believe that access to the right career information at the right time can transform lives and help students unlock their true potential across 5000+ career paths.</p>
            </div>
            <div class="mv-card fade-up" style="transition-delay:.1s;">
                <div class="mv-icon"><i class="fa-solid fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>To become India's most trusted and accessible career guidance platform, reaching every student regardless of their background, location, or financial status. We envision a future where no student is left confused about their career path and every young mind gets the guidance they deserve.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ WHAT WE OFFER ═══ --}}
<section class="offer-section">
    <div class="container">
        <div style="text-align:center;">
            <div class="section-label"><i class="fa-solid fa-sparkles"></i> FEATURES</div>
            <h2 class="section-heading">What We Offer</h2>
            <p class="section-sub-text">Everything you need to discover, explore, and plan your perfect career journey</p>
        </div>
        <div class="offer-grid">
            <div class="offer-card fade-up">
                <div class="offer-icon" style="background:#e8f0fe; color:#1a56db;"><i class="fa-solid fa-route"></i></div>
                <h4>5000+ Career Paths</h4>
                <p>Comprehensive database covering every field from traditional to modern, helping you explore careers you never knew existed.</p>
            </div>
            <div class="offer-card fade-up" style="transition-delay:.05s;">
                <div class="offer-icon" style="background:#ede9fe; color:#7c3aed;"><i class="fa-solid fa-robot"></i></div>
                <h4>AI-Powered Tests</h4>
                <p>Smart aptitude and interest assessments that analyze your strengths and match you with ideal career paths scientifically.</p>
            </div>
            <div class="offer-card fade-up" style="transition-delay:.1s;">
                <div class="offer-icon" style="background:#d1fae5; color:#059669;"><i class="fa-solid fa-map"></i></div>
                <h4>Expert Roadmaps</h4>
                <p>Step-by-step guidance for each career — from education requirements to skills needed and top institutions to join.</p>
            </div>
            <div class="offer-card fade-up" style="transition-delay:.15s;">
                <div class="offer-icon" style="background:#fff7ed; color:#f97316;"><i class="fa-solid fa-building-columns"></i></div>
                <h4>College Finder</h4>
                <p>Find the best colleges across India by location, stream, and ranking to make the right educational choice.</p>
            </div>
            <div class="offer-card fade-up" style="transition-delay:.2s;">
                <div class="offer-icon" style="background:#fce7f3; color:#db2777;"><i class="fa-solid fa-comments"></i></div>
                <h4>Career Guruji AI</h4>
                <p>24/7 AI-powered career counseling chatbot that answers your career questions instantly with personalized advice.</p>
            </div>
            <div class="offer-card fade-up" style="transition-delay:.25s;">
                <div class="offer-icon" style="background:#dbeafe; color:#2563eb;"><i class="fa-solid fa-gift"></i></div>
                <h4>Completely Free</h4>
                <p>All features — career exploration, aptitude tests, AI chatbot, and college finder — available at absolutely no cost.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ IMPACT NUMBERS ═══ --}}
<section class="impact-section">
    <div class="container">
        <div style="text-align:center;">
            <div class="section-label" style="background:rgba(255,255,255,.15); color:#fff;"><i class="fa-solid fa-chart-line"></i> OUR IMPACT</div>
            <h2 style="font-family:'Sora',sans-serif; font-size:clamp(24px,4vw,36px); font-weight:800; color:#fff;">Numbers That Speak</h2>
        </div>
        <div class="impact-grid">
            <div class="impact-card fade-up">
                <div class="impact-icon"><i class="fa-solid fa-route"></i></div>
                <div class="impact-number" data-target="5000">0</div>
                <div class="impact-label">Career Paths</div>
            </div>
            <div class="impact-card fade-up" style="transition-delay:.1s;">
                <div class="impact-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="impact-number" data-target="50">0</div>
                <div class="impact-label">Fields Covered</div>
            </div>
            <div class="impact-card fade-up" style="transition-delay:.2s;">
                <div class="impact-icon"><i class="fa-solid fa-users"></i></div>
                <div class="impact-number" data-target="1000">0</div>
                <div class="impact-label">Students Guided</div>
            </div>
            <div class="impact-card fade-up" style="transition-delay:.3s;">
                <div class="impact-icon"><i class="fa-solid fa-building-columns"></i></div>
                <div class="impact-number" data-target="100">0</div>
                <div class="impact-label">Colleges Listed</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ OUR STORY ═══ --}}
<section class="story-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:32px;">
            <div class="section-label"><i class="fa-solid fa-book-open"></i> OUR STORY</div>
            <h2 class="section-heading">How It All Began</h2>
        </div>
        <div class="story-content fade-up">
            <p>CareerGyan started as a passion project by the <strong>Indian Institute of Career Management</strong> with a simple yet powerful goal — to bridge the gap between students and career information. In a country where millions of students make career decisions without proper guidance, we saw an opportunity to create something truly impactful.</p>
            <p>Our team of educators, engineers, and career counselors came together to build a platform that makes career exploration accessible, engaging, and completely free. From covering 5000+ career paths to developing AI-powered aptitude tests, every feature is designed to help students discover their true calling.</p>
            <div class="slogan-card">
                <div class="slogan-sanskrit">ज्ञानात् ज्ञानं ततः सिद्धिः</div>
                <div class="slogan-translation">"From knowledge comes wisdom, from wisdom comes success"</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ TEAM SECTION ═══ --}}
<section class="team-section">
    <div class="container">
        <div class="team-header">
            <div class="section-label"><i class="fa-solid fa-users"></i> OUR TEAM</div>
            <h2 class="section-heading">Meet the People Behind CareerGyan</h2>
            <p class="section-sub-text">A passionate team dedicated to transforming career guidance in India</p>
        </div>

        <div class="team-grid">
            {{-- Principal --}}
            <div class="team-role-card fade-up">
                <div class="team-role-badge role-principal"><i class="fa-solid fa-crown"></i> Principal</div>
                <div class="team-member">
                    <div class="team-avatar" style="background: linear-gradient(135deg, #1e3a8a, #1d4ed8);">DD</div>
                    <div class="team-member-name">Mr. Dynaneshwar D. Kakad</div>
                </div>
            </div>

            {{-- CEO --}}
            <div class="team-role-card fade-up" style="transition-delay:.1s;">
                <div class="team-role-badge role-ceo"><i class="fa-solid fa-star"></i> CEO</div>
                <div class="team-member">
                    <div class="team-avatar" style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">SK</div>
                    <div class="team-member-name">Er. Sudarshan D. Kakad</div>
                </div>
            </div>

            {{-- Creative Team --}}
            <div class="team-role-card team-role-card--wide fade-up" style="transition-delay:.2s;">
                <div class="team-role-badge role-creative"><i class="fa-solid fa-palette"></i> Creative Team</div>
                <div class="team-members-list">
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #0284c7, #38bdf8);">AG</div>
                        <div class="team-member-name">Er. Abhishek Gite</div>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #7c3aed, #a78bfa);">OA</div>
                        <div class="team-member-name">Er. Omkar Avhad</div>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #059669, #10b981);">AG</div>
                        <div class="team-member-name">Er. Aditya Ghorpade</div>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #d97706, #f59e0b);">SC</div>
                        <div class="team-member-name">Er. Shubham Chitte</div>
                    </div>
                </div>
            </div>

            {{-- Special Thanks --}}
            <div class="team-role-card team-role-card--wide fade-up" style="transition-delay:.3s;">
                <div class="team-role-badge role-thanks"><i class="fa-solid fa-heart"></i> Special Thanks &amp; Gratitude</div>
                <div class="team-members-list">
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #be185d, #ec4899);">JP</div>
                        <div class="team-member-name">Er. Jay Pardeshi</div>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #9333ea, #c084fc);">SJ</div>
                        <div class="team-member-name">Mr. Sujit Jadhav</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ FAQ SECTION ═══ --}}
<section class="faq-section">
    <div class="container">
        <div style="text-align:center;">
            <div class="section-label"><i class="fa-solid fa-circle-question"></i> FAQ</div>
            <h2 class="section-heading">Frequently Asked Questions</h2>
            <p class="section-sub-text">Everything you need to know about CareerGyan</p>
        </div>
        <div class="faq-list">
            <div class="faq-item fade-up">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>What is CareerGyan?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">CareerGyan is a free career guidance platform by the Indian Institute of Career Management that helps students after 10th, 12th, and graduation explore career options, take aptitude tests, and get personalized recommendations.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.05s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>How does the career test work?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">Our tests use scientifically designed questions to assess your interests, aptitudes, and strengths across multiple dimensions. Based on your responses, we recommend career paths that match your profile.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.1s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>Is CareerGyan free to use?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">Yes! CareerGyan is completely free. All features including career exploration, aptitude tests, AI chatbot, and college finder are available at no cost.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.15s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>Who created CareerGyan?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">CareerGyan is developed by the Indian Institute of Career Management, led by Mr. Dynaneshwar D. Kakad (Principal) and Er. Sudarshan D. Kakad (CEO), along with a dedicated creative team.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.2s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>How accurate are the career suggestions?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">Our suggestions are based on comprehensive data analysis covering 5000+ career paths across 50+ fields. While we provide data-driven guidance, we recommend discussing options with mentors and counselors too.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.25s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>Can I retake the career test?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">Yes, you can take both the Quick Test and Advance Test multiple times. Each attempt generates fresh results based on your responses.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.3s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>What qualifications does CareerGyan cover?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">We cover career paths after 10th, 12th (Science, Commerce, Arts), Diploma, Graduation, and Post-Graduation across traditional and non-traditional fields.</div>
                </div>
            </div>
            <div class="faq-item fade-up" style="transition-delay:.35s;">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4>How do I contact support?</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">Email us at admin@careergyan.in or use the suggestion form on our homepage. Our team typically responds within 24-48 hours.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ CONTACT SECTION ═══ --}}
<section class="contact-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:48px;">
            <div class="section-label"><i class="fa-solid fa-paper-plane"></i> CONTACT</div>
            <h2 class="section-heading">Get In Touch</h2>
        </div>
        <div class="contact-card fade-up">
            <div>
                <h2 style="font-family:'Sora',sans-serif; font-size:26px; font-weight:800; color:var(--text-1); margin-bottom:16px;">We'd Love To Hear From You</h2>
                <p style="color:var(--text-2); margin-bottom:32px; line-height:1.7;">Have questions about the CareerGyan platform, need career counseling, or looking for partnerships? We are here to help!</p>
                <div class="ct-block">
                    <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                    <p><a href="mailto:admin@careergyan.in">admin@careergyan.in</a></p>
                </div>
            </div>
            <div class="ct-right">
                <div class="ct-block">
                    <h3><i class="fa-solid fa-location-dot"></i> Address</h3>
                    <p>B wing 95,96 Business Index,<br>Hanumanwadi Makhmalabad road,<br>Nashik-3, Maharashtra, India</p>
                </div>
                <div class="ct-block" style="margin-bottom:0;">
                    <h3><i class="fa-solid fa-clock"></i> Working Hours</h3>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        <div style="font-size:15px; font-weight:700; color:var(--text-2);">Mon-Sat: 8:00 AM – 6:00 PM</div>
                        <div style="font-size:15px; color:var(--text-2);">Sunday: <span style="color:var(--text-3);">Closed</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map Section -->
        <div class="map-container fade-up" style="margin-top: 32px; border-radius: var(--radius-xl); overflow: hidden; border: 1px solid var(--border); box-shadow: 0 8px 32px rgba(0,0,0,.06); background: var(--surface); padding: 12px;">
            <iframe src="https://maps.google.com/maps?q=20.02123488638282,73.78554411178844&z=17&output=embed" width="100%" height="400" style="border:0; border-radius:12px; display: block;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
// ── FAQ Accordion ──
function toggleFaq(el) {
    const item = el.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isActive = item.classList.contains('active');

    // Close all
    document.querySelectorAll('.faq-item.active').forEach(faq => {
        faq.classList.remove('active');
        faq.querySelector('.faq-answer').style.maxHeight = '0';
    });

    // Open clicked (if wasn't active)
    if (!isActive) {
        item.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + 'px';
    }
}

// ── Animated Counters ──
function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-target'));
    const duration = 2000;
    const start = performance.now();

    function update(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(eased * target);
        el.textContent = current.toLocaleString() + '+';
        if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
}

// ── Intersection Observer for animations ──
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Fade-up animations
            if (entry.target.classList.contains('fade-up')) {
                entry.target.classList.add('visible');
            }
            // Counter animations
            if (entry.target.classList.contains('impact-number')) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        }
    });
}, { threshold: 0.15 });

document.querySelectorAll('.fade-up, .impact-number').forEach(el => observer.observe(el));
</script>
@endsection

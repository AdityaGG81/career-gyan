@extends('layouts.app')

@section('title', 'UPSC Civil Services Guidance, Syllabus & Government Careers | CareerGyan')
@section('meta_description', 'Complete guidance for UPSC Civil Services Examination (IAS, IPS, IFS). Explore exam patterns, government and defence career paths, daily current affairs quizzes, and arts & law colleges.')
@section('meta_keywords', 'upsc guidance, ias exam preparation, ips roadmap, civil services syllabus, government jobs, defence careers, daily quiz gk')

@section('styles')
<style>
  .guidance-hero {
    background: linear-gradient(135deg, #1c1917 0%, #78350f 50%, #1c1917 100%);
    color: #ffffff;
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
  }
  .guidance-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(245,158,11,0.2) 0%, transparent 60%);
  }
  .guidance-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fde68a;
    padding: 6px 16px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 18px;
  }
  .guidance-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4.5vw, 42px);
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 16px;
  }
  .guidance-sub {
    font-size: 16.5px;
    color: rgba(255, 255, 255, 0.85);
    max-width: 740px;
    line-height: 1.7;
    margin-bottom: 30px;
  }
  .hub-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 30px;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
  }
  .hub-card:hover {
    transform: translateY(-5px);
    border-color: #d97706;
    box-shadow: var(--shadow-lg);
  }
  .hub-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 20px;
  }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="guidance-hero">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="guidance-badge">
      <i class="fa-solid fa-landmark"></i> Civil Services & Administration
    </div>
    <h1 class="guidance-title">
      UPSC Civil Services Guidance & Public Sector Careers
    </h1>
    <p class="guidance-sub">
      Your strategic guide to cracking the UPSC CSE exam (IAS, IPS, IFS, IRS). Build your current affairs foundation with our daily quiz, explore public administration career roadmaps, and track official government job notifications.
    </p>

    <div style="display:flex; gap:14px; flex-wrap:wrap;">
      <a href="{{ route('daily-quiz.index') }}" style="background: linear-gradient(135deg, #d97706, #b45309); color:#fff; padding: 14px 28px; border-radius: 12px; font-weight: 800; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(217,119,6,0.4);">
        <i class="fa-solid fa-brain"></i> Daily Current Affairs & GK Quiz
      </a>
      <a href="{{ route('explore.government-defence') }}" style="background: rgba(255,255,255,0.12); color:#fff; border: 1px solid rgba(255,255,255,0.25); padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-shield-halved"></i> Government & Defence Careers
      </a>
      <a href="{{ route('jobs.index') }}" style="background: rgba(255,255,255,0.12); color:#fff; border: 1px solid rgba(255,255,255,0.25); padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-briefcase"></i> Public Job Notifications
      </a>
    </div>
  </div>
</section>

<!-- Section 1: Connected Resources for UPSC Aspirants -->
<section style="padding: 70px 0; background: var(--bg);">
  <div class="container">
    <div style="text-align: center; max-width: 650px; margin: 0 auto 40px;">
      <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #d97706; background: #fef3c7; padding: 4px 14px; border-radius: 99px;">
        Connected Pillars
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-1); margin: 10px 0;">
        Prepare Smartly Across the CareerGyan Ecosystem
      </h2>
      <p style="font-size: 15px; color: var(--text-2); margin: 0;">
        Combine academic degree planning with regular competitive practice and career backups.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      
      <!-- Card 1 -->
      <a href="{{ route('daily-quiz.index') }}" class="hub-card">
        <div class="hub-icon" style="background:#fef3c7; color:#d97706;">
          <i class="fa-solid fa-brain"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Daily GK & GS Practice Quiz
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Take daily 5-question quizzes on Indian Polity, Modern History, Geography, and Current Affairs to build exam discipline.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #d97706; display: inline-flex; align-items: center; gap: 6px;">
          Start Daily Practice &rarr;
        </span>
      </a>

      <!-- Card 2 -->
      <a href="{{ route('explore.government-defence') }}" class="hub-card">
        <div class="hub-icon" style="background:#eff6ff; color:#2563eb;">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Govt & Defence Careers
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Explore career pathways in UPSC Civil Services, Combined Defence Services (CDS), NDA, State PSCs, and SSC CGL.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #2563eb; display: inline-flex; align-items: center; gap: 6px;">
          View Public Sector Paths &rarr;
        </span>
      </a>

      <!-- Card 3 -->
      <a href="{{ route('explore.arts-humanities-colleges') }}" class="hub-card">
        <div class="hub-icon" style="background:#f3e8ff; color:#7c3aed;">
          <i class="fa-solid fa-book-atlas"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Arts & Humanities Colleges
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Find premier universities offering Political Science, Public Administration, History, and Sociology degree programs.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #7c3aed; display: inline-flex; align-items: center; gap: 6px;">
          Browse Degree Colleges &rarr;
        </span>
      </a>

      <!-- Card 4 -->
      <a href="{{ route('jobs.index') }}" class="hub-card">
        <div class="hub-icon" style="background:#ecfdf5; color:#059669;">
          <i class="fa-solid fa-bell"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Govt Job Corner
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Stay updated with recruitment circulars, age criteria, eligibility norms, and direct online application links.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #059669; display: inline-flex; align-items: center; gap: 6px;">
          Check Open Postings &rarr;
        </span>
      </a>

    </div>
  </div>
</section>

<!-- Section 2: Strategy Breakdown -->
<section style="padding: 70px 0; background: #ffffff; border-top: 1px solid var(--border);">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 40px; align-items: center;">
      <div>
        <h2 style="font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-1); margin-bottom: 16px;">
          The 3-Phase UPSC CSE Blueprint
        </h2>
        <div style="display: flex; flex-direction: column; gap: 18px;">
          <div style="border-left: 3px solid #d97706; padding-left: 18px;">
            <h4 style="font-family:'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">1. Prelims (Objective Screening)</h4>
            <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">General Studies Paper I (cut-off deciding) & CSAT Paper II (qualifying at 33%). Practice negative marking management and daily speed quizzes.</p>
          </div>
          <div style="border-left: 3px solid #2563eb; padding-left: 18px;">
            <h4 style="font-family:'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">2. Mains (Subjective Written Examination)</h4>
            <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">9 papers testing analytical depth, ethics, essay writing, and your chosen optional subject (500 marks). Consistent answer-writing is the key differentiator.</p>
          </div>
          <div style="border-left: 3px solid #059669; padding-left: 18px;">
            <h4 style="font-family:'Sora', sans-serif; font-size: 17px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">3. Personality Test (Interview)</h4>
            <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin: 0;">275 marks assessing intellectual integrity, social alertness, balanced judgment, and leadership under pressure.</p>
          </div>
        </div>
      </div>

      <!-- Quick Backup & Aptitude Card -->
      <div style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 32px;">
        <h3 style="font-family:'Sora', sans-serif; font-size: 19px; font-weight: 800; color: var(--text-1); margin-bottom: 14px;">
          Need a Strategic Career Plan B?
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 22px;">
          UPSC success requires an informed backup strategy. Take our free aptitude assessment to understand complementary career paths:
        </p>
        <div style="display:flex; flex-direction:column; gap:10px;">
          <a href="{{ route('quick-test.start') }}" style="display:flex; align-items:center; justify-content:space-between; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#2563eb;">
            <span><i class="fa-solid fa-bolt" style="color:#d97706;"></i> Take Free Aptitude Test</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="{{ route('explore.teaching-law') }}" style="display:flex; align-items:center; justify-content:space-between; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-scale-balanced"></i> Law & Judicial Careers</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="{{ route('explore.traditional-careers') }}" style="display:flex; align-items:center; justify-content:space-between; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-graduation-cap"></i> Academic & Research Careers</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

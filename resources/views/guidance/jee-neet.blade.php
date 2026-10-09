@extends('layouts.app')

@section('title', 'JEE & NEET Preparation Guidance, Top Colleges & Careers | CareerGyan')
@section('meta_description', 'Comprehensive guidance for JEE Main, JEE Advanced, and NEET UG. Explore premier engineering and medical colleges, preparation strategies, aptitude tests, and career roadmaps.')
@section('meta_keywords', 'jee main guidance, neet guidance, iit colleges, aiims colleges, medical careers, engineering careers, mht cet, career gyan')

@section('styles')
<style>
  .guidance-hero {
    background: linear-gradient(135deg, #091e3a 0%, #1e1b4b 50%, #091e3a 100%);
    color: #ffffff;
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
  }
  .guidance-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(99,102,241,0.25) 0%, transparent 60%);
  }
  .guidance-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #a5b4fc;
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
    color: rgba(255, 255, 255, 0.8);
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
    border-color: var(--brand);
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
      <i class="fa-solid fa-atom"></i> National Entrance Exam Hub
    </div>
    <h1 class="guidance-title">
      JEE & NEET: Careers, Colleges & Strategic Guidance
    </h1>
    <p class="guidance-sub">
      Navigate India’s premier competitive entrance exams for engineering (IITs, NITs, IIITs) and medicine (AIIMS, GMCs). Compare top institutes, assess your natural aptitude, and discover career alternatives.
    </p>

    <div style="display:flex; gap:14px; flex-wrap:wrap;">
      <a href="{{ route('explore.engineering-colleges') }}" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; padding: 14px 28px; border-radius: 12px; font-weight: 800; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(37,99,235,0.4);">
        <i class="fa-solid fa-microchip"></i> Engineering Colleges
      </a>
      <a href="{{ route('explore.medical-colleges') }}" style="background: linear-gradient(135deg, #059669, #047857); color:#fff; padding: 14px 28px; border-radius: 12px; font-weight: 800; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(5,150,105,0.4);">
        <i class="fa-solid fa-user-doctor"></i> Medical Colleges
      </a>
      <a href="{{ route('quick-test.start') }}" style="background: rgba(255,255,255,0.12); color:#fff; border: 1px solid rgba(255,255,255,0.25); padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-bolt"></i> Free Stream Aptitude Test
      </a>
    </div>
  </div>
</section>

<!-- Section 1: Connected College Directories -->
<section style="padding: 70px 0; background: var(--bg);">
  <div class="container">
    <div style="text-align: center; max-width: 650px; margin: 0 auto 40px;">
      <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--brand); background: var(--brand-light); padding: 4px 14px; border-radius: 99px;">
        College Directories
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-1); margin: 10px 0;">
        Explore Higher Education Pathways
      </h2>
      <p style="font-size: 15px; color: var(--text-2); margin: 0;">
        Filter verified institutes across India by accreditation, management, and course specializations.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      
      <!-- Card 1 -->
      <a href="{{ route('explore.engineering-colleges') }}" class="hub-card">
        <div class="hub-icon" style="background:#eff6ff; color:#2563eb;">
          <i class="fa-solid fa-microchip"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Top Engineering Colleges
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Explore B.Tech and B.E programs in Computer Science, Artificial Intelligence, Mechanical, Aerospace, and Electronics.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #2563eb; display: inline-flex; align-items: center; gap: 6px;">
          Browse Engineering Colleges &rarr;
        </span>
      </a>

      <!-- Card 2 -->
      <a href="{{ route('explore.medical-colleges') }}" class="hub-card">
        <div class="hub-icon" style="background:#ecfdf5; color:#059669;">
          <i class="fa-solid fa-stethoscope"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Top Medical Colleges (MBBS)
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Find government and private medical colleges, seat intakes, affiliated universities, and NEET cutoff expectations.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #059669; display: inline-flex; align-items: center; gap: 6px;">
          Browse Medical Colleges &rarr;
        </span>
      </a>

      <!-- Card 3 -->
      <a href="{{ route('explore.non-mbbs-colleges') }}" class="hub-card">
        <div class="hub-icon" style="background:#fef3c7; color:#d97706;">
          <i class="fa-solid fa-heart-pulse"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Allied & Non-MBBS Courses
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Explore BDS, BAMS, BHMS, Physiotherapy (BPT), Biotechnology, and Nursing options with lucrative career scope.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #d97706; display: inline-flex; align-items: center; gap: 6px;">
          Explore Allied Health &rarr;
        </span>
      </a>

      <!-- Card 4 -->
      <a href="{{ route('explore.pharmacy-colleges') }}" class="hub-card">
        <div class="hub-icon" style="background:#f3e8ff; color:#7c3aed;">
          <i class="fa-solid fa-pills"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Pharmacy Colleges (B.Pharm)
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Discover PCI-approved pharmacy colleges, pharmaceutical research centers, and clinical pharmacology pathways.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #7c3aed; display: inline-flex; align-items: center; gap: 6px;">
          Browse Pharmacy Colleges &rarr;
        </span>
      </a>

    </div>
  </div>
</section>

<!-- Section 2: Two Strategic Career Streams Comparison -->
<section style="padding: 70px 0; background: #ffffff; border-top: 1px solid var(--border);">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
      
      <!-- JEE Column -->
      <div style="background: #f8fafc; border: 1.5px solid #bfdbfe; border-radius: var(--radius-xl); padding: 32px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
          <div style="width:40px; height:40px; border-radius:10px; background:#2563eb; color:#fff; display:flex; align-items:center; justify-content:center; font-size:18px;">
            <i class="fa-solid fa-code"></i>
          </div>
          <h3 style="font-family:'Sora', sans-serif; font-size:20px; font-weight:800; color:var(--text-1); margin:0;">JEE (Engineering) Roadmap</h3>
        </div>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin-bottom:20px;">
          Focus on problem-solving speed, numerical confidence, and conceptual mastery in Calculus, Mechanics, and Electrodynamics.
        </p>
        <div style="display:flex; flex-direction:column; gap:10px;">
          <a href="{{ route('tools.college-predictor') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#1e40af;">
            <span><i class="fa-solid fa-crosshairs"></i> Predict Engineering Colleges</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
          <a href="{{ route('tools.mh-cutoff') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-database"></i> Search Engineering Cutoffs</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
          <a href="{{ route('explore.index') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-laptop-code"></i> High-Paying Tech Career Roadmaps</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
        </div>
      </div>

      <!-- NEET Column -->
      <div style="background: #f8fafc; border: 1.5px solid #a7f3d0; border-radius: var(--radius-xl); padding: 32px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
          <div style="width:40px; height:40px; border-radius:10px; background:#059669; color:#fff; display:flex; align-items:center; justify-content:center; font-size:18px;">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <h3 style="font-family:'Sora', sans-serif; font-size:20px; font-weight:800; color:var(--text-1); margin:0;">NEET (Medical) Roadmap</h3>
        </div>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin-bottom:20px;">
          Biology constitutes 50% of total NEET score. Master NCERT word-by-word, coupled with rigorous Organic Chemistry and Physics numerical practice.
        </p>
        <div style="display:flex; flex-direction:column; gap:10px;">
          <a href="{{ route('explore.medical-colleges') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#065f46;">
            <span><i class="fa-solid fa-hospital"></i> Government Medical Colleges Directory</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
          <a href="{{ route('explore.non-mbbs-colleges') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-dna"></i> Lucrative Non-MBBS Career Paths</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
          <a href="{{ route('quick-test.start') }}" style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:12px 16px; border-radius:10px; border:1px solid var(--border); text-decoration:none; font-weight:700; font-size:13.5px; color:#475569;">
            <span><i class="fa-solid fa-bolt"></i> Evaluate Medical vs Science Aptitude</span>
            <i class="fa-solid fa-arrow-right" style="font-size:12px;"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Section 3: Daily Practice Quiz & Interconnected Exploration CTA -->
<section style="background: linear-gradient(135deg, #1e1b4b, #0f172a); color: #fff; padding: 60px 0; text-align: center;">
  <div class="container" style="max-width: 800px;">
    <h2 style="font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; margin-bottom: 14px;">
      Build Consistency with CareerGyan
    </h2>
    <p style="font-size: 15px; color: rgba(255,255,255,0.8); margin-bottom: 28px; line-height: 1.6;">
      Sharpen your problem-solving reflex with daily quizzes, explore all 90,000+ colleges across India, and take our 5-minute aptitude assessment.
    </p>
    <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
      <a href="{{ route('daily-quiz.index') }}" style="background: #6366f1; color: #fff; padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        <i class="fa-solid fa-brain"></i> Take Daily Quiz
      </a>
      <a href="{{ route('indian-colleges.index') }}" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        <i class="fa-solid fa-building-columns"></i> 90k+ Indian Colleges
      </a>
      <a href="{{ route('blog.index') }}" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        <i class="fa-solid fa-newspaper"></i> Read Guidance Articles
      </a>
    </div>
  </div>
</section>
@endsection

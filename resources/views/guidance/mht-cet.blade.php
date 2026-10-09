@extends('layouts.app')

@section('title', 'MHT CET 2026 Guidance, Preparation Strategy & College Cutoffs | CareerGyan')
@section('meta_description', 'Complete guidance for MHT CET preparation. Access 2026 cutoff analysis, college predictor, percentile calculator, top Maharashtra engineering colleges, and syllabus strategies.')
@section('meta_keywords', 'mht cet guidance, mht cet preparation, mht cet syllabus, mht cet mock test, maharashtra engineering cutoffs, mht cet college predictor')

@section('styles')
<style>
  .guidance-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
    color: #ffffff;
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
  }
  .guidance-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(59,130,246,0.2) 0%, transparent 60%);
  }
  .guidance-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #93c5fd;
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
  .guidance-hero-cta {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
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
  .step-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    display: flex;
    gap: 20px;
    align-items: flex-start;
  }
  .step-num {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--brand-light);
    color: var(--brand);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 16px;
    flex-shrink: 0;
  }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="guidance-hero">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="guidance-badge">
      <i class="fa-solid fa-graduation-cap"></i> Maharashtra Entrance Exam Hub
    </div>
    <h1 class="guidance-title">
      MHT CET 2026: Roadmap, Cutoffs & Complete Guidance
    </h1>
    <p class="guidance-sub">
      Your all-in-one resource portal to conquer the Maharashtra Common Entrance Test. Explore past cutoff percentiles for 360+ colleges, calculate your expected ranks, and unlock verified college options.
    </p>

    <div class="guidance-hero-cta">
      <a href="{{ route('tools.college-predictor') }}" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; padding: 14px 28px; border-radius: 12px; font-weight: 800; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(37,99,235,0.4);">
        <i class="fa-solid fa-crosshairs"></i> Predict Engineering Colleges
      </a>
      <a href="{{ route('tools.mh-cutoff') }}" style="background: rgba(255,255,255,0.12); color:#fff; border: 1px solid rgba(255,255,255,0.25); padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-database"></i> Search 2026 Cutoffs
      </a>
      <a href="{{ route('daily-quiz.index') }}" style="background: rgba(255,255,255,0.12); color:#fff; border: 1px solid rgba(255,255,255,0.25); padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-brain"></i> Daily Practice Quiz
      </a>
    </div>
  </div>
</section>

<!-- Section 1: Connected Interactive Tools -->
<section style="padding: 70px 0; background: var(--bg);">
  <div class="container">
    <div style="text-align: center; max-width: 650px; margin: 0 auto 40px;">
      <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--brand); background: var(--brand-light); padding: 4px 14px; border-radius: 99px;">
        Essential Tools
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-1); margin: 10px 0;">
        Specialized MHT CET Decision Engines
      </h2>
      <p style="font-size: 15px; color: var(--text-2); margin: 0;">
        Directly integrated with the official Maharashtra State CET Cell CAP Round allotment data.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
      
      <!-- Tool 1 -->
      <a href="{{ route('tools.college-predictor') }}" class="hub-card">
        <div class="hub-icon" style="background:#eff6ff; color:#2563eb;">
          <i class="fa-solid fa-crosshairs"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          College Predictor
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Enter your percentile and category to see Safe, Target, Reach, and Dream colleges across Pune, Mumbai, Nagpur & Nashik.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #2563eb; display: inline-flex; align-items: center; gap: 6px;">
          Launch Predictor &rarr;
        </span>
      </a>

      <!-- Tool 2 -->
      <a href="{{ route('tools.mh-cutoff') }}" class="hub-card">
        <div class="hub-icon" style="background:#fef3c7; color:#d97706;">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Cutoff Analytics Tool
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Search cutoffs for 360+ colleges and 100+ branches including AI, Computer Engineering, Data Science, and Robotics.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #d97706; display: inline-flex; align-items: center; gap: 6px;">
          Browse Cutoffs &rarr;
        </span>
      </a>

      <!-- Tool 3 -->
      <a href="{{ route('tools.percentile-calculator') }}" class="hub-card">
        <div class="hub-icon" style="background:#ecfdf5; color:#059669;">
          <i class="fa-solid fa-calculator"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Percentile & Rank Estimator
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Convert your raw MHT CET test marks (out of 200) into expected percentile and State General Merit (SGM) Rank.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #059669; display: inline-flex; align-items: center; gap: 6px;">
          Calculate Percentile &rarr;
        </span>
      </a>

      <!-- Tool 4 -->
      <a href="{{ route('quick-test.start') }}" class="hub-card">
        <div class="hub-icon" style="background:#f3e8ff; color:#7c3aed;">
          <i class="fa-solid fa-bolt"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
          Branch Aptitude Test
        </h3>
        <p style="font-size: 14px; color: var(--text-2); line-height: 1.6; margin-bottom: 20px; flex: 1;">
          Unsure whether to pick Computer Science, Mechanical, Civil, or AI? Assess your reasoning & technical affinities.
        </p>
        <span style="font-size: 13.5px; font-weight: 700; color: #7c3aed; display: inline-flex; align-items: center; gap: 6px;">
          Take Free Test &rarr;
        </span>
      </a>

    </div>
  </div>
</section>

<!-- Section 2: Preparation Strategy & Milestone Roadmap -->
<section style="padding: 70px 0; background: #ffffff; border-top: 1px solid var(--border);">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;">
      <div>
        <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--brand); background: var(--brand-light); padding: 4px 14px; border-radius: 99px;">
          Strategy & Syllabus
        </span>
        <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-1); margin: 12px 0 16px;">
          How to Score 99+ Percentile in MHT CET
        </h2>
        <p style="font-size: 15px; color: var(--text-2); line-height: 1.7; margin-bottom: 24px;">
          MHT CET features 20% weightage from the Class 11 State Board curriculum and 80% from Class 12. There is no negative marking, which makes speed and question accuracy paramount.
        </p>

        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div class="step-card">
            <div class="step-num">1</div>
            <div>
              <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">Master Maharashtra State Board Textbooks</h4>
              <p style="font-size: 13.5px; color: var(--text-2); margin: 0; line-height: 1.5;">Direct questions in Physics, Chemistry, and Mathematics mirror Balbharati standard textbook exercises and solved examples.</p>
            </div>
          </div>

          <div class="step-card">
            <div class="step-num">2</div>
            <div>
              <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">Solve Last 5 Years Previous Questions (PYQs)</h4>
              <p style="font-size: 13.5px; color: var(--text-2); margin: 0; line-height: 1.5;">CET Cell repeats core mathematical problem structures. Practice 2020-2025 shift questions under time constraints.</p>
            </div>
          </div>

          <div class="step-card">
            <div class="step-num">3</div>
            <div>
              <h4 style="font-family:'Sora', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-1); margin-bottom: 4px;">Strengthen Daily Problem Solving</h4>
              <p style="font-size: 13.5px; color: var(--text-2); margin: 0; line-height: 1.5;">Keep your mental agility sharp by answering our Daily Reasoning & General Aptitude Quizzes.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Connected Colleges & Streams -->
      <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 36px;">
        <h3 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-1); margin-bottom: 16px;">
          <i class="fa-solid fa-building-columns" style="color: var(--brand); margin-right: 8px;"></i>
          Explore Maharashtra Institutes
        </h3>
        <p style="font-size: 14px; color: var(--text-2); margin-bottom: 24px; line-height: 1.6;">
          Check campus details, official fees, affiliation, and cutoffs for major colleges admitting through MHT CET:
        </p>

        <div style="display: flex; flex-direction: column; gap: 12px;">
          <a href="{{ route('explore.engineering-colleges') }}" style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); text-decoration: none; font-weight: 700; font-size: 14px; color: var(--text-1); transition: 0.2s;" onmouseover="this.style.borderColor='var(--brand)'" onmouseout="this.style.borderColor='var(--border)'">
            <span><i class="fa-solid fa-microchip" style="color:#2563eb; margin-right:8px;"></i> Top Engineering Colleges in Maharashtra</span>
            <i class="fa-solid fa-chevron-right" style="color:#94a3b8; font-size:12px;"></i>
          </a>
          <a href="{{ route('explore.pharmacy-colleges') }}" style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); text-decoration: none; font-weight: 700; font-size: 14px; color: var(--text-1); transition: 0.2s;" onmouseover="this.style.borderColor='var(--brand)'" onmouseout="this.style.borderColor='var(--border)'">
            <span><i class="fa-solid fa-pills" style="color:#059669; margin-right:8px;"></i> Top Pharmacy Colleges (B.Pharm)</span>
            <i class="fa-solid fa-chevron-right" style="color:#94a3b8; font-size:12px;"></i>
          </a>
          <a href="{{ route('indian-colleges.index') }}?state=Maharashtra" style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); text-decoration: none; font-weight: 700; font-size: 14px; color: var(--text-1); transition: 0.2s;" onmouseover="this.style.borderColor='var(--brand)'" onmouseout="this.style.borderColor='var(--border)'">
            <span><i class="fa-solid fa-city" style="color:#7c3aed; margin-right:8px;"></i> Search by District (Pune, Mumbai, Nashik)</span>
            <i class="fa-solid fa-chevron-right" style="color:#94a3b8; font-size:12px;"></i>
          </a>
          <a href="{{ route('blog.index') }}" style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); text-decoration: none; font-weight: 700; font-size: 14px; color: var(--text-1); transition: 0.2s;" onmouseover="this.style.borderColor='var(--brand)'" onmouseout="this.style.borderColor='var(--border)'">
            <span><i class="fa-solid fa-newspaper" style="color:#ea580c; margin-right:8px;"></i> Read MHT CET Articles & Counseling Tips</span>
            <i class="fa-solid fa-chevron-right" style="color:#94a3b8; font-size:12px;"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section 3: Bottom Interconnection CTA Strip -->
<section style="background: linear-gradient(135deg, #1e3a8a, #0f172a); color: #fff; padding: 60px 0; text-align: center;">
  <div class="container" style="max-width: 800px;">
    <h2 style="font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; margin-bottom: 14px;">
      Ready to test your readiness and predict your seat?
    </h2>
    <p style="font-size: 15px; color: rgba(255,255,255,0.8); margin-bottom: 28px; line-height: 1.6;">
      Use the CareerGyan platform completely free. No subscription required.
    </p>
    <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
      <a href="{{ route('tools.college-predictor') }}" style="background: #2563eb; color: #fff; padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        Launch College Predictor
      </a>
      <a href="{{ route('daily-quiz.index') }}" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        Play Daily Quiz
      </a>
      <a href="{{ route('explore.index') }}" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); padding: 12px 26px; border-radius: 99px; font-weight: 700; font-size: 14.5px; text-decoration: none;">
        Explore Engineering Careers
      </a>
    </div>
  </div>
</section>
@endsection

@extends('layouts.app')

@section('title', $pathData['title'] . ' Career Path | Subject-wise Guide')

@section('styles')
<style>
    :root {
        --theme-color: {{ $pathData['theme_color'] }};
        --theme-gradient: {{ $pathData['gradient'] }};
        --glass-bg: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.15);
        --glass-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }
    
    body {
        background: linear-gradient(135deg, #0f172a, #1e3a8a, #6d28d9);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        color: #f1f5f9;
    }
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .bg-blobs { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; pointer-events: none; overflow: hidden; }
    .blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4; animation: float 10s infinite ease-in-out alternate; }
    .blob-1 { width: 400px; height: 400px; background: #3b82f6; top: -100px; left: -100px; animation-delay: 0s; }
    .blob-2 { width: 350px; height: 350px; background: #8b5cf6; bottom: -50px; right: -50px; animation-delay: -2s; }
    .blob-3 { width: 300px; height: 300px; background: #06b6d4; top: 40%; left: 60%; animation-delay: -4s; }
    .blob-4 { width: 250px; height: 250px; background: #10b981; top: 60%; left: 10%; animation-delay: -6s; }
    @keyframes float { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, 50px) scale(1.1); } }

    /* --- Hero Section --- */
    .path-hero {
        padding: 80px 0 60px;
        text-align: center;
        margin-bottom: 0px;
        position: relative;
    }
    .back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        color: #fff; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);
        padding: 10px 20px; border-radius: 30px; margin-bottom: 24px;
        font-weight: 600; font-size: 14px; transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .back-btn:hover { background: rgba(255,255,255,0.2); transform: translateX(-5px); color: #fff; }

    /* --- Stats Row --- */
    .stats-container {
        display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 20px; margin-bottom: 60px;
    }
    .stat-card {
        background: var(--glass-bg); backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border); border-top: 1px solid rgba(255,255,255,0.3);
        border-radius: 20px; padding: 20px 30px; text-align: center; min-width: 160px;
        transition: transform 0.3s ease; box-shadow: var(--glass-shadow);
    }
    .stat-card:hover { transform: translateY(-5px); background: rgba(255,255,255,0.08); }
    .stat-number { font-family: 'Sora', sans-serif; font-size: 32px; font-weight: 800; color: #fff; line-height: 1.2; text-shadow: 0 2px 10px rgba(0,0,0,0.5);}
    .stat-label { font-size: 13px; font-weight: 700; text-transform: uppercase; color: #cbd5e1; letter-spacing: 0.05em; }

    /* --- Subject Cards --- */
    .subject-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px; margin-bottom: 80px; }
    .subject-card {
        background: var(--glass-bg); backdrop-filter: blur(14px);
        border-radius: 24px; padding: 0; border: 1px solid var(--glass-border); border-top: 1px solid rgba(255,255,255,0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex; flex-direction: column; position: relative; overflow: hidden; box-shadow: var(--glass-shadow);
    }
    .subject-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4); border-color: rgba(255,255,255,0.4); }
    
    .subject-image-wrapper { position: relative; width: 100%; height: 180px; overflow: hidden; }
    .career-path-image { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s ease; }
    .subject-card:hover .career-path-image { transform: scale(1.1); }
    .image-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(15,23,42,0.9) 100%);
    }
    .image-title {
        position: absolute; bottom: 20px; left: 24px; z-index: 2;
        font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.8);
    }

    .subject-card-body { padding: 24px; flex-grow: 1; display: flex; flex-direction: column; }
    
    /* Subject Icon Float */
    .subject-icon-float {
        position: absolute; top: 156px; right: 24px; width: 48px; height: 48px;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.3); z-index: 10;
        border: 1px solid rgba(255,255,255,0.3);
    }

    /* Chips */
    .content-section { margin-bottom: 18px; }
    .content-label { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.1em; margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
    .course-tags, .career-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    
    .tag-item { padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(4px); transition: all 0.2s; }
    .tag-item.course { background: rgba(59, 130, 246, 0.15); color: #93c5fd; border-color: rgba(59, 130, 246, 0.3); }
    .tag-item.career { background: rgba(16, 185, 129, 0.15); color: #6ee7b7; border-color: rgba(16, 185, 129, 0.3); }
    .tag-item.skill { background: rgba(249, 115, 22, 0.15); color: #fdba74; border-color: rgba(249, 115, 22, 0.3); }

    .note-box {
        margin-top: auto; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.1); font-size: 13.5px; color: #e2e8f0; line-height: 1.5;
        display: flex; gap: 12px; align-items: flex-start;
    }

    /* --- Info Sections --- */
    .info-sections { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 80px; }
    .info-card { background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-top: 1px solid rgba(255,255,255,0.3); border-radius: 24px; padding: 40px; box-shadow: var(--glass-shadow); position: relative; overflow: hidden; }
    .info-card h3 { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; margin-bottom: 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
    
    .roadmap-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 20px; position: relative; }
    .roadmap-list::before { content: ''; position: absolute; left: 15px; top: 10px; bottom: 10px; width: 2px; background: rgba(255,255,255,0.2); z-index: 0; }
    .roadmap-item { display: flex; gap: 20px; align-items: flex-start; position: relative; z-index: 1; }
    .roadmap-step-num { background: linear-gradient(135deg, #3b82f6, #8b5cf6); color: white; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3); border: 2px solid rgba(255,255,255,0.2); }
    .roadmap-content { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 16px 20px; border-radius: 16px; flex-grow: 1; }
    
    .opps-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px; }
    .opps-item { display: flex; gap: 16px; align-items: flex-start; background: rgba(255,255,255,0.05); padding: 16px 20px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1; }
    .opps-icon { color: #10b981; background: rgba(16,185,129,0.15); width: 32px; height: 32px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid rgba(16,185,129,0.3);}

    /* --- CTA Section --- */
    .cta-section { background: rgba(255,255,255,0.05); border-radius: 32px; padding: 60px 40px; text-align: center; border: 1px solid rgba(255,255,255,0.15); margin-bottom: 80px; position: relative; overflow: hidden; backdrop-filter: blur(20px); box-shadow: var(--glass-shadow); }
    .cta-title { font-family: 'Sora', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin-bottom: 16px; }
    .cta-desc { color: #cbd5e1; font-size: 18px; margin-bottom: 40px; max-width: 600px; margin-inline: auto; }
    .cta-buttons { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
    
    .btn-primary { background: linear-gradient(135deg, #ec4899, #8b5cf6); color: white; padding: 16px 40px; border-radius: 30px; font-weight: 700; font-size: 16px; text-decoration: none; box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.5); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px; border: none;}
    .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 25px -5px rgba(236, 72, 153, 0.7); color: white; }
    
    .btn-secondary { background: rgba(255,255,255,0.1); color: #fff; padding: 16px 40px; border-radius: 30px; font-weight: 700; font-size: 16px; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 10px; }
    .btn-secondary:hover { background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.5); color: #fff; transform: translateY(-3px);}

    @media (max-width: 768px) {
        .path-hero { padding: 60px 20px 40px; }
        .stats-container { margin-top: 20px; padding: 0 20px; }
        .stat-card { min-width: 130px; padding: 15px; }
        .subject-grid { grid-template-columns: 1fr; }
        .info-sections { grid-template-columns: 1fr; }
        .info-card { padding: 30px 20px; }
        .cta-section { padding: 40px 20px; }
    }
</style>
@endsection

@section('content')

<!-- Background Blobs -->
<div class="bg-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="blob blob-4"></div>
</div>

@php
    $totalCourses = 0; $totalCareers = 0; $totalSkills = 0;
    foreach($pathData['subjects'] as $sub) {
        $totalCourses += count($sub['courses'] ?? []);
        $totalCareers += count($sub['careers'] ?? []);
        $totalSkills += count($sub['skills'] ?? []);
    }
@endphp

<div class="container">
    <!-- Hero Section -->
    <section class="path-hero">
        <a href="{{ route('explore.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Explore
        </a>
        <h1 style="font-family: 'Sora'; font-size: clamp(36px, 5vw, 56px); font-weight: 800; margin-bottom: 16px; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            <span style="background: linear-gradient(135deg, #60a5fa, #c084fc, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                {{ $pathData['title'] }}
            </span>
        </h1>
        <p style="font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto; line-height: 1.6; color: #e2e8f0;">
            {{ $pathData['description'] }}
        </p>
    </section>

    <!-- Stats Row -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number">{{ count($pathData['subjects']) }}</div>
            <div class="stat-label">Core Fields</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalCourses }}+</div>
            <div class="stat-label">Top Courses</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalCareers }}+</div>
            <div class="stat-label">Career Options</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalSkills }}+</div>
            <div class="stat-label">Key Skills</div>
        </div>
    </div>

    <!-- Subject Grid -->
    <h2 style="text-align: center; font-family: 'Sora'; font-weight: 800; font-size: 28px; margin-bottom: 40px; color: #fff;">
        Explore Sub-Fields
    </h2>
    <div class="subject-grid">
        @foreach($pathData['subjects'] as $subject)
        <div class="subject-card">
            <div class="subject-image-wrapper">
                <img src="{{ asset($subject['image']) }}" 
                     alt="{{ $subject['name'] }}" 
                     class="career-path-image"
                     onerror="this.src='https://via.placeholder.com/300x200'">
                <div class="image-overlay"></div>
                <div class="image-title">{{ $subject['name'] }}</div>
            </div>
            
            <div class="subject-icon-float">
                <i class="fa-solid {{ $subject['icon'] }}"></i>
            </div>
            
            <div class="subject-card-body">
                <div class="content-section">
                    <span class="content-label"><i class="fa-solid fa-graduation-cap"></i> Degrees & Courses</span>
                    <div class="course-tags">
                        @foreach($subject['courses'] as $course)
                            <span class="tag-item course">{{ $course }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="content-section">
                    <span class="content-label"><i class="fa-solid fa-briefcase"></i> Career Roles</span>
                    <div class="career-tags">
                        @foreach($subject['careers'] as $career)
                            <span class="tag-item career">{{ $career }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="content-section">
                    <span class="content-label"><i class="fa-solid fa-bolt"></i> Essential Skills</span>
                    <div class="course-tags">
                        @foreach($subject['skills'] as $skill)
                            <span class="tag-item skill">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="note-box">
                    <i class="fa-solid fa-lightbulb" style="font-size: 18px; margin-top: 2px; color: #fbbf24;"></i> 
                    <div><strong style="color: #fff;">Future Scope:</strong> {{ $subject['scope'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Info Sections -->
    @if(isset($pathData['roadmap']) && isset($pathData['opportunities']))
    <div class="info-sections">
        <!-- Roadmap -->
        <div class="info-card">
            <h3><i class="fa-solid fa-map-location-dot" style="color: #60a5fa;"></i> Your Roadmap</h3>
            <ul class="roadmap-list">
                <li class="roadmap-item">
                    <div class="roadmap-step-num">1</div>
                    <div class="roadmap-content">
                        <strong style="display:block; margin-bottom:4px; color:#fff;">After 10th</strong>
                        <span style="color:#cbd5e1; font-size:14.5px;">{{ $pathData['roadmap']['after_10th'] }}</span>
                    </div>
                </li>
                <li class="roadmap-item">
                    <div class="roadmap-step-num">2</div>
                    <div class="roadmap-content">
                        <strong style="display:block; margin-bottom:4px; color:#fff;">After 12th</strong>
                        <span style="color:#cbd5e1; font-size:14.5px;">{{ $pathData['roadmap']['after_12th'] }}</span>
                    </div>
                </li>
                <li class="roadmap-item">
                    <div class="roadmap-step-num">3</div>
                    <div class="roadmap-content">
                        <strong style="display:block; margin-bottom:4px; color:#fff;">After Graduation</strong>
                        <span style="color:#cbd5e1; font-size:14.5px;">{{ $pathData['roadmap']['after_grad'] }}</span>
                    </div>
                </li>
            </ul>
        </div>
        
        <!-- Opportunities -->
        <div class="info-card">
            <h3><i class="fa-solid fa-earth-asia" style="color: #34d399;"></i> Regional Opportunities</h3>
            <ul class="opps-list">
                @foreach($pathData['opportunities'] as $opp)
                <li class="opps-item">
                    <div class="opps-icon"><i class="fa-solid fa-check"></i></div>
                    <span style="font-size:14.5px; line-height:1.5; padding-top:4px;">{{ $opp }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="cta-section">
        <h2 class="cta-title">Ready to take the next step?</h2>
        <p class="cta-desc">Discover your true potential with our AI psychometric test, or explore the best colleges offering these top courses.</p>
        <div class="cta-buttons">
            <a href="{{ route('test.start') }}" class="btn-primary">
                Take Free Career Test <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="{{ route('explore.index') }}" class="btn-secondary">
                Explore More Streams <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </div>
    </div>
</div>
@endsection

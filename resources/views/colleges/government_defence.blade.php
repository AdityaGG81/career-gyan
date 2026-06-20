@extends('layouts.app')

@section('title', 'Government & Defence Career Paths | CareerGyan')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e3a8a, #6d28d9);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        color: #fff;
    }
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .bg-blobs { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; pointer-events: none; overflow: hidden; }
    .blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4; animation: float 10s infinite ease-in-out alternate; }
    .blob-1 { width: 400px; height: 400px; background: #3b82f6; top: -100px; left: -100px; }
    .blob-2 { width: 350px; height: 350px; background: #8b5cf6; bottom: -50px; right: -50px; }
    
    .hero-section { padding: 80px 0 40px; text-align: center; }
    .hero-section h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(32px, 5vw, 48px); margin-bottom: 20px; }
    .hero-section p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

    .sub-domain-section { margin-bottom: 60px; }
    .sub-domain-title { 
        font-family: 'Sora', sans-serif; 
        font-size: 24px; 
        font-weight: 700; 
        margin-bottom: 30px; 
        display: flex; 
        align-items: center; 
        gap: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }
    .sub-domain-title i { color: #fbbf24; }

    .career-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
        gap: 24px; 
    }
    .career-card { 
        background: #fff; 
        border-radius: 22px; 
        padding: 0; 
        overflow: hidden; 
        transition: all 0.3s ease; 
        display: flex; 
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.1);
        cursor: pointer;
        height: 100%;
    }
    .career-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
    
    .card-image { width: 100%; height: 180px; position: relative; overflow: hidden; background: #1e293b; }
    .card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .career-card:hover .card-image img { transform: scale(1.1); }
    
    .card-content { padding: 24px; flex-grow: 1; display: flex; flex-direction: column; color: #1e293b; }
    .card-header { display: flex; gap: 12px; margin-bottom: 12px; align-items: flex-start; }
    .card-icon { 
        width: 44px; height: 44px; 
        background: #f1f5f9; 
        color: #3b82f6; 
        border-radius: 12px; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 20px; flex-shrink: 0; 
    }
    .card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.2; }
    
    .card-desc { font-size: 14px; color: #64748b; line-height: 1.5; margin-bottom: 16px; flex-grow: 1; }
    
    .card-meta { 
        padding-top: 16px; 
        border-top: 1px solid #f1f5f9; 
        display: flex; flex-direction: column; gap: 8px; 
        font-size: 13px; color: #475569;
        margin-bottom: 20px;
    }
    .card-meta span { display: flex; align-items: center; gap: 8px; }
    .card-meta i { color: #94a3b8; width: 16px; text-align: center; }
    .card-meta b { color: #1e293b; }

    .btn-details {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        margin-top: auto;
    }
    .btn-details:hover { background: linear-gradient(135deg, #1d4ed8, #2563eb); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); color: #fff; }

    @media (max-width: 768px) {
        .career-grid { grid-template-columns: 1fr; }
    }

  @media (max-width: 480px) {
    .hero-section {
      padding: 50px 0 30px;
    }
    .hero-section h1 {
      font-size: 28px;
    }
    .card-content {
      padding: 16px;
    }
  }
</style>
@endsection

@section('content')
<div class="bg-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
</div>

<div class="container">
    <header class="hero-section">
        <h1 class="fade-up">Government & Defence</h1>
        <p class="fade-up" style="animation-delay: 0.1s;">Explore 35+ prestigious career paths in administration, revenue, police, defence, and public service. Build a career dedicated to serving the nation.</p>
    </header>

    @foreach($categories as $subDomain => $careers)
    <section class="sub-domain-section fade-up" style="animation-delay: 0.2s;">
        <h2 class="sub-domain-title">
            <i class="fa-solid fa-folder-open"></i> {{ $subDomain ?: 'General Government Services' }}
        </h2>
        <div class="career-grid">
            @foreach($careers as $career)
            <div class="career-card" onclick="window.location='{{ route('career.detail.page', $career->slug) }}'">
                <div class="card-image">
                    <img src="{{ asset($career->image) }}" alt="{{ $career->name }}">
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fa-solid {{ $career->icon ?? 'fa-briefcase' }}"></i>
                        </div>
                        <div>
                            <h3 class="card-title">{{ $career->name }}</h3>
                            <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #3b82f6;">{{ $career->demand_level }} Demand</span>
                        </div>
                    </div>
                    <p class="card-desc">{{ Str::limit($career->description, 100) }}</p>
                    <div class="card-meta">
                        <span><i class="fa-solid fa-indian-rupee-sign"></i> Salary: <b>{{ $career->salary_range }}</b></span>
                        <span><i class="fa-solid fa-graduation-cap"></i> Qualification: <b>{{ $career->qualification }}</b></span>
                    </div>
                    <a href="{{ route('career.detail.page', $career->slug) }}" class="btn-details">View Full Roadmap &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach

    <div class="text-center" style="padding: 40px 0;">
        <a href="{{ route('explore.index') }}" class="btn-roadmap" style="display: inline-flex; width: auto; padding: 14px 40px; background: rgba(255,255,255,0.1); color: #fff; border: 1px solid rgba(255,255,255,0.2); border-radius: 30px;">
            <i class="fa-solid fa-arrow-left"></i> Back to All Categories
        </a>
    </div>
</div>
@endsection

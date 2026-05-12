@extends('layouts.app')

@section('title', 'Sports Career Paths | Career Gyan')

@section('styles')
<style>
    :root {
        --sp-primary: #8b5cf6;
        --sp-secondary: #c084fc;
        --glass-bg: rgba(255,255,255,0.06);
        --glass-border: rgba(255,255,255,0.12);
    }
    body { background: #0f172a; color: #fff; }

    /* ── Hero ── */
    .sp-hero {
        background: linear-gradient(135deg, #0f172a, #1e3a8a, #6d28d9);
        padding: 110px 0 100px;
        text-align: center;
        border-radius: 0 0 60px 60px;
        position: relative;
        overflow: hidden;
    }
    .sp-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        opacity: 0.07;
        pointer-events: none;
    }
    .back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        color: #fff; background: rgba(255,255,255,.15); backdrop-filter: blur(10px);
        padding: 10px 22px; border-radius: 30px; margin-bottom: 28px;
        font-weight: 600; font-size: 14px; transition: all .3s;
        border: 1px solid rgba(255,255,255,.25); text-decoration: none;
    }
    .back-btn:hover { background: rgba(255,255,255,.28); transform: translateX(-5px); color: #fff; }

    /* ── Stats ── */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin: -50px auto 70px;
        position: relative; z-index: 10;
        max-width: 1140px; padding: 0 20px;
    }
    .stat-box {
        background: rgba(255,255,255,.08); backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,.15);
        padding: 30px 20px; border-radius: 24px; text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,.2); transition: transform .3s;
    }
    .stat-box:hover { transform: translateY(-10px); }
    .stat-num {
        font-family: 'Sora', sans-serif; font-size: 34px; font-weight: 900;
        background: linear-gradient(to right, #fff, #c4b5fd);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        margin-bottom: 6px;
    }
    .stat-label { font-size: 13px; color: #94a3b8; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1px; }

    /* ── Grid ── */
    .career-path-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 28px; margin-bottom: 50px;
    }

    /* ── Card ── */
    .path-card {
        background: var(--glass-bg); backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 28px; overflow: hidden;
        transition: all .4s cubic-bezier(.4,0,.2,1);
        display: block; text-decoration: none;
        position: relative;
    }
    .path-card:hover {
        transform: translateY(-14px);
        box-shadow: 0 30px 60px rgba(109,40,217,.3);
        border-color: rgba(109,40,217,.5);
        text-decoration: none;
    }
    .path-img-wrapper { position: relative; height: 210px; overflow: hidden; }
    .path-img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease; }
    .path-card:hover .path-img { transform: scale(1.1); }
    .path-overlay {
        position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;
        background: linear-gradient(to top, rgba(15,23,42,.9), transparent);
    }
    .path-icon {
        position: absolute; top: 16px; right: 16px;
        width: 42px; height: 42px; background: rgba(109,40,217,.85);
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        font-size: 18px; color: #fff; box-shadow: 0 8px 20px rgba(0,0,0,.3);
    }
    .path-title {
        font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800;
        color: #fff; margin-top: 8px;
    }
    .path-body { padding: 22px; }
    .path-desc {
        color: #94a3b8; font-size: 13.5px; line-height: 1.65; margin-bottom: 18px;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .view-details {
        display: flex; align-items: center; gap: 8px;
        color: var(--sp-primary); font-weight: 700; font-size: 14.5px; transition: all .3s;
    }
    .path-card:hover .view-details { gap: 13px; color: #c084fc; }

    /* Shine */
    .path-card::after {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 50%; height: 100%;
        background: linear-gradient(to right, transparent, rgba(255,255,255,.08), transparent);
        transform: skewX(-25deg); transition: .75s;
    }
    .path-card:hover::after { left: 150%; }

    .salary-badge {
        display: inline-block; font-size: 12px; font-weight: 700;
        padding: 3px 10px; border-radius: 12px;
        background: rgba(16,185,129,.15); color: #34d399;
        border: 1px solid rgba(16,185,129,.3); margin-bottom: 10px;
    }

    /* Pagination */
    .pagination .page-link {
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        color: #fff; border-radius: 10px; margin: 0 4px; padding: 10px 16px;
    }
    .pagination .page-link:hover,
    .pagination .active .page-link { background: #6d28d9; border-color: #6d28d9; color: #fff; }
    .pagination { justify-content: center; margin-bottom: 60px; }

    @media(max-width:768px) {
        .sp-hero { padding: 80px 0 80px; border-radius: 0 0 40px 40px; }
        .career-path-grid { grid-template-columns: 1fr; }
        .stats-container { grid-template-columns: repeat(2, 1fr); margin-top: -30px; }
    }

    @media (max-width: 768px) {
        .sp-hero { 
            padding: 40px 0 30px !important;
            text-align: center !important;
        }
        
        .sp-hero h1 {
            font-size: clamp(24px, 6vw, 36px) !important;
            margin-bottom: 12px !important;
            line-height: 1.2;
        }
        
        .sp-hero p {
            font-size: 16px !important;
            margin-bottom: 20px !important;
            padding: 0 10px;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
            padding: 0 10px !important;
        }
        
        .stat-box {
            padding: 16px !important;
        }
        
        .section-title {
            font-size: clamp(18px, 4vw, 22px) !important;
            text-align: center !important;
            padding: 0 10px !important;
        }
        
        .career-path-grid {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
            padding: 0 10px !important;
        }
        
        .path-card {
            margin: 0 !important;
        }
    }

    @media (max-width: 480px) {
        .sp-hero {
            padding: 30px 0 20px !important;
        }
        
        .sp-hero h1 {
            font-size: clamp(20px, 5vw, 28px) !important;
            margin-bottom: 10px !important;
        }
        
        .sp-hero p {
            font-size: 14px !important;
            margin-bottom: 15px !important;
            padding: 0 5px;
        }
        
        .stats-container {
            grid-template-columns: 1fr !important;
            gap: 10px !important;
            padding: 0 5px !important;
        }
        
        .stat-box {
            padding: 12px !important;
        }
        
        .section-title {
            font-size: clamp(16px, 4vw, 20px) !important;
            padding: 0 5px !important;
        }
        
        .career-path-grid {
            gap: 12px !important;
            padding: 0 5px !important;
        }
    }
</style>
@endsection

@section('content')

{{-- ── HERO ── --}}
<section class="sp-hero">
    <div class="container" style="position:relative;z-index:2;">
        <a href="{{ route('explore.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Explore
        </a>
        <h1 style="font-family:'Sora';font-size:clamp(30px,6vw,56px);font-weight:900;margin-bottom:16px;color:#fff;">
            Sports Careers
        </h1>
        <p style="font-size:clamp(15px,2vw,20px);opacity:.9;max-width:760px;margin:0 auto;color:#e2e8f0;line-height:1.7;">
            Turn your passion into a profession. Explore high-growth careers in playing, coaching, management, and sports science.
        </p>
    </div>
</section>

<div class="container">

    {{-- ── STATS ── --}}
    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-num">8+</div>
            <div class="stat-label">Sports Sectors</div>
        </div>
        <div class="stat-box">
            <div class="stat-num">200+</div>
            <div class="stat-label">Academies & Colleges</div>
        </div>
        <div class="stat-box">
            <div class="stat-num">20L+</div>
            <div class="stat-label">Industry Growth</div>
        </div>
    </div>

    {{-- ── HEADING ── --}}
    <h2 style="font-family:'Sora';font-size:clamp(20px,3vw,30px);font-weight:800;margin-bottom:40px;text-align:center;color:#fff;">
        Explore Sports & Athletics Career Paths
    </h2>

    {{-- ── CAREER GRID ── --}}
    <div class="career-path-grid">
        @foreach($careers as $path)
        <a href="{{ route('career.detail.page', $path->slug) }}" class="path-card">
            <div class="path-img-wrapper">
                <img
                    src="{{ $path->image ?? 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=600&q=80' }}"
                    alt="{{ $path->name }}"
                    class="path-img"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=600&q=80';"
                >
                <div class="path-icon">
                    <i class="fa-solid {{ $path->icon ?? 'fa-trophy' }}"></i>
                </div>
                <div class="path-overlay">
                    <div class="path-title">{{ $path->name }}</div>
                </div>
            </div>
            <div class="path-body">
                <span class="salary-badge">{{ $path->salary_range }}</span>
                <p class="path-desc">{{ $path->description }}</p>
                <div class="view-details">
                    View Details <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- ── PAGINATION ── --}}
    {{ $careers->withQueryString()->links('vendor.pagination.career-gyan') }}

    {{-- ── CTA ── --}}
    <div style="text-align:center;margin-bottom:80px;">
        <a href="{{ route('explore.index') }}"
           style="display:inline-block;padding:18px 52px;font-size:16px;border-radius:30px;
                  background:linear-gradient(to right,#8b5cf6,#ec4899);color:#fff;font-weight:700;
                  box-shadow:0 12px 30px rgba(139,92,246,.4);text-decoration:none;">
            Explore More Career Streams
        </a>
    </div>
</div>
@endsection

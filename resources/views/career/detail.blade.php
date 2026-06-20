@extends('layouts.app')

@section('title', $career->name . ' – Career Guide | Career Gyan')

@section('styles')
<style>
    body { background-color: var(--bg); color: var(--text-1); }

    /* ── Hero Section ── */
    .detail-hero {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0f7ff 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid var(--border);
    }
    .detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1.2' fill='%231a56db' fill-opacity='0.03'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 0;
    }
    .hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
        opacity: 0.15;
        z-index: 1;
    }
    .hero-orb-1 { width: 300px; height: 300px; background: #3b82f6; top: -50px; right: -50px; }
    .hero-orb-2 { width: 250px; height: 250px; background: #f97316; bottom: -50px; left: 10%; }

    .detail-hero-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 48px;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    @media(max-width: 991px) {
        .detail-hero-grid { grid-template-columns: 1fr; gap: 32px; text-align: center; }
        .hero-left { display: flex; flex-direction: column; align-items: center; }
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-2);
        background: #fff;
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid var(--border);
        margin-bottom: 24px;
        text-decoration: none;
        transition: all var(--transition);
        box-shadow: var(--shadow-sm);
    }
    .back-btn:hover {
        color: var(--brand);
        border-color: var(--brand);
        transform: translateX(-3px);
        box-shadow: var(--shadow-md);
    }

    .career-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: var(--brand-light);
        border: 1px solid rgba(26,86,219,.15);
        color: var(--brand);
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-right .img-wrapper {
        position: relative;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 4px solid #fff;
        background: #fff;
        aspect-ratio: 16 / 10;
        transition: transform 0.4s ease;
    }
    .hero-right .img-wrapper:hover {
        transform: scale(1.02);
    }
    .hero-right img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ── Layout Grid ── */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 32px;
        margin-top: 48px;
        padding-bottom: 80px;
    }
    @media(min-width: 992px) {
        .detail-grid {
            grid-template-columns: 340px 1fr;
        }
    }

    /* ── Cards ── */
    .info-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        padding: 32px;
        transition: transform .3s, box-shadow .3s, border-color .3s;
        box-shadow: var(--shadow-sm);
    }
    .info-card:hover {
        border-color: rgba(26,86,219,.2);
        box-shadow: var(--shadow-md);
    }

    .card-title {
        font-family: 'Sora', sans-serif;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-1);
        border-bottom: 2px solid var(--bg);
        padding-bottom: 12px;
    }
    .card-title i { color: var(--brand); }

    /* ── Stat Pills ── */
    .stat-pill {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        margin-bottom: 14px;
        transition: all .2s;
    }
    .stat-pill:hover {
        background: #fff;
        border-color: var(--brand);
        box-shadow: var(--shadow-sm);
        transform: translateX(4px);
    }
    .stat-pill .icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .stat-pill:nth-child(2) .icon-wrap { background: rgba(16, 185, 129, 0.1); color: #10b981; } /* Salary - Green */
    .stat-pill:nth-child(3) .icon-wrap { background: rgba(59, 130, 246, 0.1); color: #3b82f6; } /* Demand - Blue */
    .stat-pill:nth-child(4) .icon-wrap { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; } /* Qualification - Purple */
    .stat-pill:nth-child(5) .icon-wrap { background: rgba(249, 115, 22, 0.1); color: #f97316; } /* Stream - Orange */

    .stat-val { font-weight: 700; color: var(--text-1); font-size: 15px; }
    .stat-lab { font-size: 11px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }

    /* ── Tags ── */
    .tag-wrap { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag {
        padding: 6px 14px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        font-size: 13px;
        color: var(--text-2);
        font-weight: 600;
        transition: all .2s;
        cursor: default;
    }
    .tag:hover { background: var(--brand-light); color: var(--brand); border-color: var(--brand); }
    
    .tag-exam { border-color: rgba(245,158,11,.2); color: #b45309; background: #fffbeb; }
    .tag-exam:hover { background: #fef3c7; color: #b45309; border-color: #f59e0b; }
    
    .tag-job { border-color: rgba(16,185,129,.2); color: #047857; background: #f0fdf4; }
    .tag-job:hover { background: #dcfce7; color: #047857; border-color: #10b981; }

    /* ── Roadmap Timeline ── */
    .roadmap-timeline {
        position: relative;
        padding-left: 28px;
        margin-top: 8px;
    }
    .roadmap-timeline::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: linear-gradient(to bottom, var(--brand) 0%, rgba(26,86,219,0.1) 100%);
    }
    .timeline-item {
        position: relative;
        padding-bottom: 24px;
    }
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    .timeline-node {
        position: absolute;
        left: -28px;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #fff;
        border: 4px solid var(--brand);
        box-shadow: 0 0 0 4px var(--brand-light);
        z-index: 2;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
        color: var(--brand);
    }
    .timeline-item:hover .timeline-node {
        transform: scale(1.2);
        background: var(--brand);
        color: #fff;
        box-shadow: 0 0 0 6px var(--brand-light);
    }
    .timeline-content {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 18px 20px;
        transition: all 0.2s;
    }
    .timeline-item:hover .timeline-content {
        background: #fff;
        border-color: var(--brand);
        box-shadow: var(--shadow-sm);
    }
    .timeline-step { font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800; color: var(--brand); margin-bottom: 4px; }
    .timeline-desc { font-size: 14px; color: var(--text-2); line-height: 1.6; }

    /* ── Related Careers ── */
    .related-section {
        margin-top: 48px;
        border-top: 1px solid var(--border);
        padding-top: 48px;
    }
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-top: 24px;
    }
    .related-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        padding: 24px;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: all .3s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: var(--shadow-sm);
    }
    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--brand);
    }
    .related-card .icon-wrap {
        width: 48px; height: 48px;
        background: var(--brand-light);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: var(--brand);
        transition: all .3s;
    }
    .related-card:hover .icon-wrap {
        background: var(--brand);
        color: #fff;
    }

    @media(max-width: 991px) {
        .detail-sidebar .info-card {
            position: static !important;
        }
    }

    @media(max-width: 480px) {
        .detail-hero {
            padding: 40px 0;
        }
        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

{{-- ── HERO SECTION ── --}}
<section class="detail-hero">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="container">
        <div class="detail-hero-grid">
            <div class="hero-left">
                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <div>
                    <div class="career-badge">
                        <i class="fa-solid fa-layer-group"></i>
                        {{ $career->field->name }}
                    </div>
                </div>
                <h1 style="font-family:'Sora';font-size:clamp(32px,5vw,48px);font-weight:900;color:var(--text-1);margin-bottom:16px;line-height:1.15;letter-spacing:-0.5px;">
                    {{ $career->name }}
                </h1>
                <p style="font-size:16px;line-height:1.7;color:var(--text-2);max-width:700px;margin-bottom:0;">
                    {{ $career->description }}
                </p>
            </div>
            
            <div class="hero-right">
                <div class="img-wrapper">
                    @php
                      $fieldSlug = $career->field->slug ?? 'general';
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
                      $coverImage = $coverMap[$fieldSlug] ?? 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=1000';
                    @endphp
                    <img src="{{ (str_starts_with($career->image, 'http') || str_starts_with($career->image, '//')) ? $career->image : ($career->image ? asset($career->image) : $coverImage) }}" alt="{{ $career->name }}" onerror="this.onerror=null; this.src='{{ $coverImage }}';">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ── --}}
<div class="container">
    <div class="detail-grid">

        {{-- ── LEFT SIDEBAR (Quick Facts & Skills) ── --}}
        <div class="detail-sidebar">
            <div class="info-card" style="position: sticky; top: 110px;">
                <h3 class="card-title"><i class="fa-solid fa-bolt"></i> Quick Facts</h3>

                <div class="stat-pill">
                    <div class="icon-wrap"><i class="fa-solid fa-indian-rupee-sign"></i></div>
                    <div>
                        <div class="stat-val">{{ $career->salary_range }}</div>
                        <div class="stat-lab">Salary Range</div>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="icon-wrap"><i class="fa-solid fa-arrow-trend-up"></i></div>
                    <div>
                        <div class="stat-val">{{ $career->demand_level }}</div>
                        <div class="stat-lab">Demand Level</div>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="icon-wrap"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <div class="stat-val">{{ $career->qualification }}</div>
                        <div class="stat-lab">Qualification</div>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="icon-wrap"><i class="fa-solid fa-filter"></i></div>
                    <div>
                        <div class="stat-val">{{ $career->stream }}</div>
                        <div class="stat-lab">Preferred Stream</div>
                    </div>
                </div>

                {{-- Skills --}}
                @if(!empty($career->skills))
                <div class="mt-4" style="margin-top: 24px;">
                    <h4 class="card-title" style="font-size:16px;margin-bottom:14px;border-bottom:none;padding-bottom:0;">
                        <i class="fa-solid fa-lightbulb"></i> Key Skills
                    </h4>
                    <div class="tag-wrap">
                        @foreach($career->skills as $skill)
                            <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Entrance Exams --}}
                @if(!empty($career->entrance_exams))
                <div class="mt-4" style="margin-top: 24px;">
                    <h4 class="card-title" style="font-size:16px;margin-bottom:14px;border-bottom:none;padding-bottom:0;">
                        <i class="fa-solid fa-file-pen"></i> Entrance Exams
                    </h4>
                    <div class="tag-wrap">
                        @foreach($career->entrance_exams as $exam)
                            <span class="tag tag-exam">{{ $exam }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            @php
              $embedUrl = '';
              if (!empty($career->video_url)) {
                  $url = $career->video_url;
                  $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
                  if (preg_match($regExp, $url, $matches)) {
                      if (strlen($matches[2]) === 11) {
                          $embedUrl = 'https://www.youtube.com/embed/' . $matches[2];
                      }
                  }
              }
            @endphp

            @if(!empty($embedUrl))
            <div class="info-card" style="margin-top: 24px; padding: 20px; position: sticky; top: 580px;">
                <h3 class="card-title" style="font-size:16px; margin-bottom:14px; border-bottom:none; padding-bottom:0; color:#ef4444;">
                    <i class="fa-brands fa-youtube" style="color:#ef4444;"></i> Career Video Guide
                </h3>
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; border: 1px solid var(--border); background: #000;">
                    <iframe src="{{ $embedUrl }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allowfullscreen></iframe>
                </div>
            </div>
            @endif
        </div>

        {{-- ── RIGHT MAIN CONTENT ── --}}
        <div class="detail-main">
            {{-- Roadmap --}}
            <div class="info-card mb-4" style="margin-bottom: 24px;">
                <h3 class="card-title"><i class="fa-solid fa-map-location-dot"></i> Career Roadmap</h3>
                <div class="roadmap-timeline">
                    @foreach($career->roadmap ?? [] as $step)
                    <div class="timeline-item">
                        <div class="timeline-node">{{ $loop->iteration }}</div>
                        <div class="timeline-content">
                            <div class="timeline-step">Step {{ $loop->iteration }}</div>
                            <div class="timeline-desc">{{ $step }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Future Scope --}}
            @if($career->future_scope)
            <div class="info-card mb-4" style="margin-bottom: 24px;">
                <h3 class="card-title"><i class="fa-solid fa-compass"></i> Future Scope</h3>
                <p style="color:var(--text-2);line-height:1.8;margin:0;font-size:15px;">{{ $career->future_scope }}</p>
            </div>
            @endif

            {{-- Job Opportunities --}}
            @if(!empty($career->job_opportunities))
            <div class="info-card">
                <h3 class="card-title"><i class="fa-solid fa-building"></i> Top Employers & Sectors</h3>
                <div class="tag-wrap">
                    @foreach($career->job_opportunities as $job)
                        <span class="tag tag-job">{{ $job }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Related Careers --}}
    @if($related->count())
    <div class="related-section">
        <h3 class="card-title" style="justify-content:center;font-size:24px;border:none;margin-bottom:0;padding-bottom:0;">
            <i class="fa-solid fa-network-wired"></i> Related Careers
        </h3>
        <div class="related-grid">
            @foreach($related as $rel)
            <a href="{{ route('career.detail.page', $rel->slug) }}" class="related-card">
                <div class="icon-wrap">
                    <i class="fa-solid {{ $rel->icon ?? 'fa-briefcase' }}"></i>
                </div>
                <h4 style="font-family:'Sora';font-weight:800;color:var(--text-1);margin:0;font-size:16px;">{{ $rel->name }}</h4>
                <p style="font-size:14px;color:var(--text-2);margin:0;line-height:1.5;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $rel->description }}</p>
                <div style="font-size:13px;font-weight:700;color:var(--brand);margin-top:auto;display:flex;align-items:center;gap:6px;">
                    <i class="fa-solid fa-indian-rupee-sign"></i> {{ $rel->salary_range }}
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Back to Path Button --}}
    <div style="text-align:center;margin-top:56px;margin-bottom:56px;">
        <a href="{{ route('career.path', $career->field->slug) }}"
           style="display:inline-flex;align-items:center;gap:8px;padding:14px 36px;background:linear-gradient(135deg, var(--brand), var(--brand-dark));border-radius:30px;color:#fff;text-decoration:none;font-weight:700;font-size:15px;box-shadow:0 10px 24px rgba(26,86,219,.25);transition:all var(--transition);">
            <i class="fa-solid fa-arrow-left-long"></i> Back to {{ $career->field->name }}
        </a>
    </div>
</div>
@endsection


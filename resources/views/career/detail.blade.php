@extends('layouts.app')

@section('title', $career->name . ' – Career Guide | Career Gyan')

@section('styles')
<style>
    body { background: #0f172a; color: #e2e8f0; }

    /* ── Hero ── */
    .detail-hero {
        position: relative;
        min-height: 420px;
        display: flex;
        align-items: flex-end;
        padding: 0 0 60px;
        overflow: hidden;
    }
    .detail-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        filter: brightness(0.35);
        transition: transform 6s ease;
    }
    .detail-hero:hover .detail-hero-bg { transform: scale(1.04); }
    .detail-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, #0f172a 10%, rgba(15,23,42,.5) 60%, transparent);
    }
    .detail-hero-content {
        position: relative;
        z-index: 2;
        padding-top: 120px;
    }

    .career-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(59,130,246,.25);
        border: 1px solid rgba(59,130,246,.5);
        color: #93c5fd;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    /* ── Cards ── */
    .info-card {
        background: rgba(255,255,255,.04);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 28px;
        padding: 36px;
        height: 100%;
        transition: border-color .3s, transform .3s, box-shadow .3s;
    }
    .info-card:hover {
        border-color: rgba(59,130,246,.5);
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(0,0,0,.4);
    }

    .section-title {
        font-family: 'Sora', sans-serif;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #fff;
    }
    .section-title i { color: #3b82f6; }

    /* ── Stat Pills ── */
    .stat-pill {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 20px;
        background: rgba(59,130,246,.08);
        border: 1px solid rgba(59,130,246,.2);
        border-radius: 18px;
        margin-bottom: 12px;
        transition: background .3s;
    }
    .stat-pill:hover { background: rgba(59,130,246,.18); }
    .stat-pill i { font-size: 20px; color: #3b82f6; width: 26px; text-align: center; }
    .stat-val { font-weight: 800; color: #fff; font-size: 16px; }
    .stat-lab { font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }

    /* ── Tags ── */
    .tag-wrap { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag {
        padding: 6px 16px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 20px;
        font-size: 13px;
        color: #cbd5e1;
        transition: all .25s;
        cursor: default;
    }
    .tag:hover { background: #3b82f6; color: #fff; border-color: #3b82f6; }
    .tag-exam { border-color: rgba(245,158,11,.5); color: #fbbf24; background: rgba(245,158,11,.08); }
    .tag-exam:hover { background: #f59e0b; color: #fff; border-color: #f59e0b; }
    .tag-job { border-color: rgba(16,185,129,.5); color: #34d399; background: rgba(16,185,129,.08); }
    .tag-job:hover { background: #10b981; color: #fff; border-color: #10b981; }

    /* ── Roadmap ── */
    .roadmap-wrap { position: relative; }
    .roadmap-item {
        position: relative;
        padding: 0 0 32px 56px;
    }
    .roadmap-item:last-child { padding-bottom: 0; }
    .rm-circle {
        position: absolute;
        left: 0; top: 2px;
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #3b82f6, #0ea5e9);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 800; color: #fff;
        box-shadow: 0 0 16px rgba(59,130,246,.5);
        z-index: 2;
    }
    .rm-line {
        position: absolute;
        left: 15px; top: 34px;
        width: 2px;
        height: calc(100% - 34px);
        background: rgba(255,255,255,.1);
    }
    .roadmap-item:last-child .rm-line { display: none; }
    .rm-step { font-weight: 700; color: #fff; margin-bottom: 4px; }
    .rm-desc { font-size: 14px; color: #94a3b8; line-height: 1.6; }

    /* ── Related Cards ── */
    .related-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; }
    .related-card {
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 22px;
        padding: 28px 24px;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 12px;
        transition: all .3s;
    }
    .related-card:hover {
        background: rgba(59,130,246,.12);
        border-color: rgba(59,130,246,.5);
        transform: translateY(-6px);
        color: #fff;
        text-decoration: none;
    }
    .related-card .icon-wrap {
        width: 60px; height: 60px;
        background: rgba(59,130,246,.15);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: #3b82f6;
        transition: background .3s;
    }
    .related-card:hover .icon-wrap { background: #3b82f6; color: #fff; }

    @media(max-width:768px){
        .detail-hero { min-height: 320px; }
    }
</style>
@endsection

@section('content')

{{-- ── HERO ── --}}
<section class="detail-hero">
    <div class="detail-hero-bg" style="background-image: url('{{ $career->image ? asset($career->image) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80' }}')"></div>
    <div class="detail-hero-overlay"></div>
    <div class="container detail-hero-content">
        <a href="{{ url()->previous() }}" class="back-btn" style="display:inline-flex;align-items:center;gap:8px;color:#fff;background:rgba(255,255,255,.12);backdrop-filter:blur(10px);padding:8px 18px;border-radius:30px;font-weight:600;font-size:14px;border:1px solid rgba(255,255,255,.2);margin-bottom:20px;text-decoration:none;transition:all .3s;">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div>
            <div class="career-badge">
                <i class="fa-solid fa-layer-group"></i>
                {{ $career->field->name }}
            </div>
        </div>
        <h1 style="font-family:'Sora';font-size:clamp(30px,7vw,58px);font-weight:900;color:#fff;margin-bottom:16px;line-height:1.1;">
            {{ $career->name }}
        </h1>
        <p style="font-size:clamp(15px,2vw,19px);max-width:760px;line-height:1.7;color:#cbd5e1;">
            {{ $career->description }}
        </p>
    </div>
</section>
<script>
    (function(){
        var bgUrl = "{{ $career->image ? asset($career->image) : '' }}";
        var fallback = 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80';
        if (!bgUrl) return;
        var probe = new Image();
        probe.onerror = function(){
            var el = document.querySelector('.detail-hero-bg');
            if (el) el.style.backgroundImage = "url('" + fallback + "')";
        };
        probe.src = bgUrl;
    })();
</script>

{{-- ── MAIN CONTENT ── --}}
<div class="container" style="padding-bottom:80px;">
    <div class="row g-4 mt-0" style="margin-top:-20px;">

        {{-- ── LEFT SIDEBAR ── --}}
        <div class="col-lg-4">
            <div class="info-card">
                <div class="section-title"><i class="fa-solid fa-bolt"></i> Quick Facts</div>

                <div class="stat-pill">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <div>
                        <div class="stat-val">{{ $career->salary_range }}</div>
                        <div class="stat-lab">Salary Range</div>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <div>
                        <div class="stat-val">{{ $career->demand_level }}</div>
                        <div class="stat-lab">Demand Level</div>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <div>
                        <div class="stat-val">{{ $career->qualification }}</div>
                        <div class="stat-lab">Qualification</div>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-filter"></i>
                    <div>
                        <div class="stat-val">{{ $career->stream }}</div>
                        <div class="stat-lab">Preferred Stream</div>
                    </div>
                </div>

                {{-- Skills --}}
                @if(!empty($career->skills))
                <div class="mt-4">
                    <div class="section-title" style="font-size:18px;margin-bottom:14px;">
                        <i class="fa-solid fa-lightbulb"></i> Key Skills
                    </div>
                    <div class="tag-wrap">
                        @foreach($career->skills as $skill)
                            <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Entrance Exams --}}
                @if(!empty($career->entrance_exams))
                <div class="mt-4">
                    <div class="section-title" style="font-size:18px;margin-bottom:14px;">
                        <i class="fa-solid fa-file-pen"></i> Entrance Exams
                    </div>
                    <div class="tag-wrap">
                        @foreach($career->entrance_exams as $exam)
                            <span class="tag tag-exam">{{ $exam }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ── RIGHT MAIN ── --}}
        <div class="col-lg-8">
            {{-- Roadmap --}}
            <div class="info-card mb-4">
                <div class="section-title"><i class="fa-solid fa-map-location-dot"></i> Career Roadmap</div>
                <div class="roadmap-wrap">
                    @foreach($career->roadmap ?? [] as $step)
                    <div class="roadmap-item">
                        <div class="rm-circle">{{ $loop->iteration }}</div>
                        <div class="rm-line"></div>
                        <div class="rm-step">Step {{ $loop->iteration }}</div>
                        <div class="rm-desc">{{ $step }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Future Scope --}}
            @if($career->future_scope)
            <div class="info-card mb-4">
                <div class="section-title"><i class="fa-solid fa-compass"></i> Future Scope</div>
                <p style="color:#94a3b8;line-height:1.85;margin:0;">{{ $career->future_scope }}</p>
            </div>
            @endif

            {{-- Job Opportunities --}}
            @if(!empty($career->job_opportunities))
            <div class="info-card">
                <div class="section-title"><i class="fa-solid fa-building"></i> Top Employers & Sectors</div>
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
    <div class="mt-5">
        <h3 class="section-title" style="justify-content:center;font-size:26px;margin-bottom:36px;">
            <i class="fa-solid fa-network-wired"></i> Related Careers
        </h3>
        <div class="related-grid">
            @foreach($related as $rel)
            <a href="{{ route('career.detail.page', $rel->slug) }}" class="related-card">
                <div class="icon-wrap">
                    <i class="fa-solid {{ $rel->icon ?? 'fa-briefcase' }}"></i>
                </div>
                <h5 style="font-weight:700;color:#fff;margin:0;">{{ $rel->name }}</h5>
                <p style="font-size:13px;color:#94a3b8;margin:0;">{{ Str::limit($rel->description, 70) }}</p>
                <span style="font-size:12px;font-weight:700;color:#3b82f6;">{{ $rel->salary_range }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- CTA --}}
    <div class="text-center mt-5">
        <a href="{{ route('career.path', $career->field->slug) }}"
           style="display:inline-block;padding:16px 48px;background:linear-gradient(to right,#3b82f6,#0ea5e9);border-radius:30px;color:#fff;text-decoration:none;font-weight:700;font-size:16px;box-shadow:0 10px 30px rgba(59,130,246,.4);transition:all .3s;">
            ← Back to {{ $career->field->name }}
        </a>
    </div>
</div>
@endsection

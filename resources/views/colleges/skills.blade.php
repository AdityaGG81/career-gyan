@extends('layouts.app')

@section('title', 'Skill Development & Career Skills')

@section('styles')
<style>
/* ─── Skills Specific Styles ─── */
.hero-skills { padding: 90px 0; background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); color: white; text-align: center; }
.hero-skills h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 54px); margin-bottom: 20px; }
.hero-skills p { font-size: 19px; opacity: 0.9; max-width: 800px; margin: 0 auto; color: #e0e7ff; }

/* Category Navigation */
.skill-tabs { display: flex; justify-content: center; gap: 15px; margin-top: -30px; flex-wrap: wrap; position: relative; z-index: 10; padding: 0 20px; }
.tab-btn { background: white; border: 1px solid #e0e7ff; padding: 14px 24px; border-radius: 12px; font-weight: 700; color: #312e81; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 10px; }
.tab-btn:hover, .tab-btn.active { background: #312e81; color: white; border-color: #312e81; transform: translateY(-3px); }

/* Skill Grid */
.skills-container { margin-top: 60px; }
.skill-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px; margin-top: 30px; }
.skill-card { background: white; border-radius: 20px; border: 1px solid #e5e7eb; overflow: hidden; transition: 0.3s; display: flex; flex-direction: column; }
.skill-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: #6366f1; }

.skill-header { padding: 25px; background: #f8fafc; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: top; }
.level { font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; }
.level-beginner { background: #dcfce7; color: #166534; }
.level-intermediate { background: #fef9c3; color: #854d0e; }
.level-advanced { background: #fee2e2; color: #991b1b; }

.skill-body { padding: 25px; flex: 1; }
.skill-name { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
.skill-desc { font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 20px; }
.skill-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
.meta-box { background: #f1f5f9; padding: 12px; border-radius: 10px; }
.meta-box span { display: block; font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px; }
.meta-box b { font-size: 13px; color: #334155; }

.tools-box { border-top: 1px dashed #e2e8f0; padding-top: 15px; }
.tool-tag { display: inline-block; font-size: 12px; background: #eef2ff; color: #4f46e5; padding: 3px 10px; border-radius: 6px; margin: 0 4px 4px 0; font-weight: 600; }

/* Platforms Section */
.platform-sec { margin-top: 100px; padding: 60px; background: #f1f5f9; border-radius: 40px; }
.platform-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 25px; margin-top: 40px; }
.plat-card { background: white; padding: 25px; border-radius: 20px; text-align: center; border: 1px solid #e2e8f0; transition: 0.3s; }
.plat-card:hover { border-color: #6366f1; transform: scale(1.05); }

/* Government Programs */
.gov-sec { margin-top: 80px; text-align: center; }
.gov-box { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; padding: 50px; border-radius: 30px; display: inline-block; width: 100%; max-width: 900px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-skills">
    <div class="container">
        <h1>Degrees Get You Jobs, Skills Get You Careers</h1>
        <p>The job market is shifting from "what you know" to "what you can do." Master the industries most in-demand skills and build a future-proof career.</p>
    </div>
</section>

<div class="container">
    <!-- Category Navigation -->
    <div class="skill-tabs">
        <button class="tab-btn active" onclick="filterSkills('all')"><i class="fa-solid fa-layer-group"></i> All Skills</button>
        @foreach($categories as $cat)
        <button class="tab-btn" onclick="filterSkills('{{ Str::slug($cat['title']) }}')">
            <i class="fa-solid {{ $cat['icon'] }}"></i> {{ $cat['title'] }}
        </button>
        @endforeach
    </div>

    <!-- Skills Listing -->
    <div class="skills-container">
        @foreach($categories as $cat)
        <div class="skill-section" id="{{ Str::slug($cat['title']) }}">
            <h2 style="font-family:'Sora'; color:#1e1b4b; margin-bottom:20px; display:flex; align-items:center; gap:12px; margin-top:50px;">
                <i class="fa-solid {{ $cat['icon'] }}" style="color:#6366f1;"></i> {{ $cat['title'] }}
            </h2>
            <div class="skill-grid">
                @foreach($cat['skills'] as $s)
                <div class="skill-card">
                    <div class="skill-header">
                        <span class="level level-{{ strtolower($s['diff']) }}">{{ $s['diff'] }}</span>
                        <i class="fa-solid fa-bolt" style="color:#fbbf24;"></i>
                    </div>
                    <div class="skill-body">
                        <h3 class="skill-name">{{ $s['name'] }}</h3>
                        <p class="skill-desc">{{ $s['desc'] }}</p>
                        
                        <div class="skill-meta">
                            <div class="meta-box">
                                <span>Time to Learn</span>
                                <b>{{ $s['duration'] }}</b>
                            </div>
                            <div class="meta-box">
                                <span>Avg. Salary</span>
                                <b>{{ $s['salary'] }}</b>
                            </div>
                        </div>

                        <div class="tools-box">
                            <p style="font-size:11px; font-weight:700; color:#94a3b8; margin-bottom:10px; text-transform:uppercase;">Master these Tools:</p>
                            @foreach(explode(', ', $s['tools']) as $t)
                            <span class="tool-tag">{{ $t }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div style="padding: 20px 25px; background: #fefce8; border-top: 1px solid #fef08a;">
                        <h4 style="font-size:12px; color:#854d0e; font-weight:700; margin-bottom:5px;">Career Opportunities:</h4>
                        <p style="font-size:12px; color:#a16207;">{{ $s['jobs'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Platforms Section -->
    <section class="platform-sec">
        <h2 style="font-family:'Sora'; color:#1e1b4b; text-align:center;">🚀 Where to Learn?</h2>
        <div class="platform-grid">
            <div class="plat-card">
                <i class="fa-brands fa-youtube fa-3x" style="color:#ff0000; margin-bottom:15px;"></i>
                <h4>YouTube</h4>
                <p style="font-size:12px; color:#64748b; margin-top:10px;">Free courses & high-quality tutorials from world-class creators.</p>
            </div>
            <div class="plat-card">
                <i class="fa-solid fa-graduation-cap fa-3x" style="color:#0056d2; margin-bottom:15px;"></i>
                <h4>Coursera</h4>
                <p style="font-size:12px; color:#64748b; margin-top:10px;">Accredited certificates from top Global Universities like Yale & Stanford.</p>
            </div>
            <div class="plat-card">
                <i class="fa-brands fa-google fa-3x" style="color:#4285f4; margin-bottom:15px;"></i>
                <h4>Google Courses</h4>
                <p style="font-size:12px; color:#64748b; margin-top:10px;">Industry-recognized professional certificates in IT, Design & Tech.</p>
            </div>
            <div class="plat-card">
                <i class="fa-solid fa-book fa-3x" style="color:#a435f0; margin-bottom:15px;"></i>
                <h4>Udemy</h4>
                <p style="font-size:12px; color:#64748b; margin-top:10px;">Affordable, practical skills from industry experts in every field.</p>
            </div>
        </div>
    </section>

    <!-- Government Section -->
    <div class="gov-sec">
        <div class="gov-box">
            <h2 style="font-family:'Sora'; margin-bottom:15px;">🇮🇳 Skill India Mission</h2>
            <p style="font-size:18px; opacity:0.9;">Take advantage of free government training programs like **PMKVY** and verified vocational certifications.</p>
            <div style="margin-top:30px;">
                <a href="#" class="btn-roadmap" style="background:white; color:#ea580c; border:none; padding:15px 30px; font-weight:800; border-radius:15px;">Explore Govt. Schemes</a>
            </div>
        </div>
    </div>
</div>

<br><br><br>

@endsection

@section('scripts')
<script>
    function filterSkills(catId) {
        // Toggle Active Button
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
            if(btn.textContent.toLowerCase().includes(catId.replace('-', ' '))) {
                btn.classList.add('active');
            }
            if(catId === 'all' && btn.textContent.includes('All Skills')) {
                btn.classList.add('active');
            }
        });

        const sections = document.querySelectorAll('.skill-section');
        sections.forEach(sec => {
            if(catId === 'all') {
                sec.style.display = 'block';
            } else {
                sec.style.display = (sec.id === catId) ? 'block' : 'none';
            }
        });
    }
</script>
@endsection

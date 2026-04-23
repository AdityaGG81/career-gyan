@extends('layouts.app')

@section('title', 'Traditional Career Paths - Career Gyan')

@section('styles')
<style>
/* ─── Traditional Specific Styles ─── */
.hero-trad { padding: 90px 0; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: white; text-align: center; }
.hero-trad h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(32px, 5vw, 54px); margin-bottom: 20px; }
.hero-trad p { font-size: 19px; opacity: 0.9; max-width: 800px; margin: 0 auto; color: #cbd5e1; }

.section-head { font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: #1e3a8a; text-align: center; margin: 80px 0 40px; }
.section-head::after { content: ""; display: block; width: 50px; height: 5px; background: #3b82f6; margin: 15px auto; border-radius: 5px; }

/* Category Grid */
.cat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 60px; }
.cat-card { background: white; padding: 30px; border-radius: 20px; border: 1px solid #e2e8f0; text-align: center; transition: 0.3s; cursor: pointer; }
.cat-card:hover { transform: translateY(-5px); border-color: #3b82f6; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1); }
.cat-card i { font-size: 32px; color: #3b82f6; margin-bottom: 15px; }

/* Path Cards */
.path-container { margin-bottom: 80px; }
.path-group { margin-top: 50px; }
.path-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 25px; }
.path-card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; padding: 35px; border-left: 8px solid #1e3a8a; transition: 0.3s; }
.path-card:hover { transform: scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

.path-name { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 20px; }
.path-meta { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.path-meta li { display: flex; align-items: center; gap: 12px; font-size: 14px; color: #475569; }
.path-meta li i { color: #3b82f6; width: 20px; text-align: center; }
.path-meta b { color: #1e293b; }

.stability-badge { display: inline-block; padding: 4px 12px; background: #dcfce7; color: #166534; font-size: 11px; font-weight: 800; border-radius: 30px; margin-bottom: 15px; text-transform: uppercase; }

/* Roadmap Timeline */
.roadmap-box { background: #f8fafc; padding: 60px 0; border-radius: 40px; margin-top: 80px; }
.timeline { display: flex; justify-content: space-between; max-width: 1000px; margin: 50px auto 0; position: relative; gap: 20px; padding: 0 20px; flex-wrap: wrap; }
.timeline::before { content: ""; position: absolute; top: 25px; left: 50px; right: 50px; height: 3px; background: #e2e8f0; z-index: 1; }
.t-step { position: relative; z-index: 2; text-align: center; width: 140px; }
.t-num { width: 50px; height: 50px; background: #1e3a8a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; margin: 0 auto 15px; border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

/* Exams Section */
.exam-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px; margin-top: 40px; }
.exam-card { background: #1e293b; color: white; padding: 25px; border-radius: 20px; text-align: center; border-bottom: 4px solid #3b82f6; }
.exam-card h4 { font-family: 'Sora'; color: #3b82f6; margin-bottom: 10px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-trad">
    <div class="container">
        <h1>Foundation for a Stable Future</h1>
        <p>Explore the most respected and stable career paths in India. From Civil Services to Medicine, plan your journey towards a secure and prestigious professional life.</p>
    </div>
</section>

<div class="container">
    <!-- Categories -->
    <h2 class="section-head">Career Categories</h2>
    <div class="cat-grid">
        @foreach($careerPaths as $cat)
        <div class="cat-card" onclick="document.getElementById('{{ Str::slug($cat['category']) }}').scrollIntoView({behavior: 'smooth'})">
            <i class="fa-solid {{ $cat['icon'] }}"></i>
            <h4 style="font-family:'Sora';">{{ $cat['category'] }}</h4>
            <p style="font-size:12px; color:#64748b; margin-top:10px;">{{ count($cat['paths']) }} Specialized Paths</p>
        </div>
        @endforeach
    </div>

    <!-- Career Detals -->
    <div class="path-container">
        @foreach($careerPaths as $cat)
        <div class="path-group" id="{{ Str::slug($cat['category']) }}">
            <h3 style="font-family:'Sora'; color:#1e1b4b; border-bottom:1px solid #e2e8f0; padding-bottom:10px; margin-bottom:25px;">
                <i class="fa-solid {{ $cat['icon'] }}" style="color:#3b82f6;"></i> {{ $cat['category'] }}
            </h3>
            <div class="path-grid">
                @foreach($cat['paths'] as $p)
                <div class="path-card">
                    <span class="stability-badge">{{ $p['stability'] }} Stability</span>
                    <h4 class="path-name">{{ $p['name'] }}</h4>
                    <ul class="path-meta">
                        <li><i class="fa-solid fa-graduation-cap"></i> Education: <b>{{ $p['edu'] }}</b></li>
                        <li><i class="fa-solid fa-file-pen"></i> Key Exam: <b>{{ $p['exam'] }}</b></li>
                        <li><i class="fa-solid fa-hourglass-start"></i> Journey: <b>{{ $p['duration'] }}</b></li>
                        <li><i class="fa-solid fa-indian-rupee-sign"></i> Avg. Salary: <b>{{ $p['salary'] }}</b></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Roadmap -->
    <div class="roadmap-box">
        <h2 class="section-head">The Traditional Roadmap</h2>
        <div class="timeline">
            <div class="t-step">
                <div class="t-num">1</div>
                <h4 style="font-size:14px; font-weight:700;">SSC (10th)</h4>
                <p style="font-size:11px; color:#64748b;">Foundation of Basic Subjects</p>
            </div>
            <div class="t-step">
                <div class="t-num">2</div>
                <h4 style="font-size:14px; font-weight:700;">HSC (12th)</h4>
                <p style="font-size:11px; color:#64748b;">Streaming (Sci/Com/Arts)</p>
            </div>
            <div class="t-step">
                <div class="t-num">3</div>
                <h4 style="font-size:14px; font-weight:700;">Entrance</h4>
                <p style="font-size:11px; color:#64748b;">JEE, NEET, CLAT, etc.</p>
            </div>
            <div class="t-step">
                <div class="t-num">4</div>
                <h4 style="font-size:14px; font-weight:700;">Degree</h4>
                <p style="font-size:11px; color:#64748b;">University Education</p>
            </div>
            <div class="t-step">
                <div class="t-num">5</div>
                <h4 style="font-size:14px; font-weight:700;">Job / PG</h4>
                <p style="font-size:11px; color:#64748b;">Corporate or Civil Services</p>
            </div>
        </div>
    </div>

    <!-- Exams -->
    <h2 class="section-head">National Level Entrance Exams</h2>
    <div class="exam-grid">
        <div class="exam-card">
            <h4>JEE Mains/Adv</h4>
            <p style="font-size:12px; opacity:0.8;">For Engineering at IITs, NITs, and IIITs.</p>
        </div>
        <div class="exam-card">
            <h4>NEET UG</h4>
            <p style="font-size:12px; opacity:0.8;">Single exam for MBBS & Medical across India.</p>
        </div>
        <div class="exam-card">
            <h4>CLAT</h4>
            <p style="font-size:12px; opacity:0.8;">Entrance for National Law Universities.</p>
        </div>
        <div class="exam-card">
            <h4>UPSC / MPSC</h4>
            <p style="font-size:12px; opacity:0.8;">For prestigious Civil Services positions.</p>
        </div>
        <div class="exam-card">
            <h4>NDA / CDS</h4>
            <p style="font-size:12px; opacity:0.8;">Entry into the Indian Armed Forces.</p>
        </div>
    </div>
</div>

<br><br><br>

@endsection

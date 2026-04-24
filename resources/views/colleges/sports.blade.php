@extends('layouts.app')

@section('title', 'Career in Sports & Physical Education')

@section('styles')
<style>
/* ─── Sports Specific Styles ─── */
.hero-sports { padding: 90px 0; background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%); color: white; text-align: center; position: relative; }
.hero-sports::before { content: ""; position: absolute; inset: 0; background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png'); opacity: 0.2; }
.hero-sports h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(32px, 5vw, 54px); margin-bottom: 20px; position: relative; text-transform: uppercase; letter-spacing: -1px; }
.hero-sports p { font-size: 19px; opacity: 0.9; max-width: 800px; margin: 0 auto; line-height: 1.6; position: relative; }

/* Grid Sections */
.sec-title { font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 800; color: #7f1d1d; text-align: center; margin: 80px 0 40px; text-transform: uppercase; position: relative; }
.sec-title::after { content: ""; display: block; width: 60px; height: 4px; background: #ef4444; margin: 10px auto; border-radius: 2px; }

/* Sports Grid */
.sports-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; }
.sport-card { background: white; padding: 35px; border-radius: 24px; text-align: center; border: 1px solid #fee2e2; transition: 0.3s; position: relative; overflow: hidden; }
.sport-card:hover { transform: translateY(-8px); border-color: #ef4444; box-shadow: 0 15px 30px rgba(185, 28, 28, 0.1); }
.sport-card i { font-size: 40px; color: #ef4444; margin-bottom: 20px; }
.sport-card h3 { font-family: 'Sora', sans-serif; font-size: 20px; margin-bottom: 12px; color: #1e293b; }
.sport-card p { font-size: 14px; color: #64748b; line-height: 1.5; }

/* Career Row */
.career-row { background: #fef2f2; border-radius: 30px; padding: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; border: 1px solid #fee2e2; }
.career-box { text-align: center; }
.career-box h4 { font-family: 'Sora', sans-serif; color: #991b1b; font-size: 18px; margin-bottom: 8px; }
.career-box b { font-size: 15px; color: #1e293b; display: block; margin-bottom: 10px; }
.career-box span { font-size: 12px; color: #64748b; }

/* Pathway Stepper */
.pathway-container { max-width: 800px; margin: 40px auto; position: relative; padding-left: 40px; border-left: 3px dashed #f87171; }
.step { position: relative; margin-bottom: 40px; padding: 20px; background: white; border-radius: 16px; border: 1px solid #fee2e2; }
.step::before { content: ""; position: absolute; left: -50px; top: 20px; width: 20px; height: 20px; background: #ef4444; border: 5px solid white; border-radius: 50%; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
.step h4 { font-family: 'Sora', sans-serif; color: #7f1d1d; margin-bottom: 8px; }

/* Academy List */
.academy-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
.aca-card { background: #1e293b; color: white; padding: 30px; border-radius: 24px; position: relative; overflow: hidden; display: flex; align-items: center; gap: 20px; }
.aca-card i { opacity: 0.2; position: absolute; right: -20px; bottom: -20px; font-size: 100px; }

/* Course Box */
.course-sec { background: #fffcf0; border: 1px solid #fef08a; border-radius: 30px; padding: 50px; margin-top: 80px; }
.course-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 30px; }
.course-item { background: white; padding: 20px; border-radius: 12px; border: 1px solid #fef9c3; text-align: center; }

/* Skills Section */
.skills-sec { text-align: center; margin-top: 100px; }
.skill-tag { display: inline-block; padding: 12px 25px; background: #fecaca; color: #991b1b; border-radius: 50px; font-weight: 800; font-size: 16px; margin: 10px; border: 1px solid #f87171; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-sports">
    <div class="container">
        <h1>Victory Beyond the Field</h1>
        <p>From Olympic athletes to sports analysts, the world of physical education and sports is growing. Turn your passion into a professional career in Indias billion-dollar sports industry.</p>
    </div>
</section>

<div class="container">
    <!-- Sports Categories -->
    <h2 class="sec-title">Choose Your Sport</h2>
    <div class="sports-grid">
        @foreach($sports as $s)
        <div class="sport-card">
            <div class="sport-icon"><i class="fa-solid {{ $s['icon'] }}"></i></div>
            <h3>{{ $s['name'] }}</h3>
            <p>{{ $s['description'] }}</p>
        </div>
        @endforeach
    </div>

    <!-- Career Opportunities -->
    <h2 class="sec-title">Professional Career Roles</h2>
    <div class="career-row">
        @foreach($careers as $c)
        <div class="career-box">
            <h4>{{ $c['role'] }}</h4>
            <b>Avg. {{ $c['salary'] }}</b>
            <span>{{ $c['scope'] }}</span>
        </div>
        @endforeach
    </div>

    <!-- Pathway -->
    <h2 class="sec-title">The Path to National Level</h2>
    <div class="pathway-container">
        <div class="step">
            <h4>01. School / Grassroots Level</h4>
            <p style="font-size:14px; color:#64748b;">Start playing in school teams, local clubs, and participate in inter-school competitions (DSO).</p>
        </div>
        <div class="step">
            <h4>02. District & State Level</h4>
            <p style="font-size:14px; color:#64748b;">Get selected for District Sports Office (DSO) trials and compete in State Championships.</p>
        </div>
        <div class="step">
            <h4>03. National Level & Academies</h4>
            <p style="font-size:14px; color:#64748b;">Enter elite academies like SAI or National Cricket Academy based on state-level performance.</p>
        </div>
        <div class="step">
            <h4>04. Professional Leagues & International</h4>
            <p style="font-size:14px; color:#64748b;">Participate in IPL, ISL, or represent India in Asian Games, Commonwealth, and Olympics.</p>
        </div>
    </div>

    <!-- Academies -->
    <h2 class="sec-title">Elite Training Academies</h2>
    <div class="academy-grid">
        <div class="aca-card">
            <i class="fa-solid fa-building-columns"></i>
            <div>
                <h4 style="font-family:'Sora'; margin-bottom:10px;">Sports Authority of India (SAI)</h4>
                <p style="font-size:13px; opacity:0.8;">The premier government body for sports training in India with multiple centers in Maharashtra.</p>
            </div>
        </div>
        <div class="aca-card">
            <i class="fa-solid fa-medal"></i>
            <div>
                <h4 style="font-family:'Sora'; margin-bottom:10px;">National Cricket Academy (NCA)</h4>
                <p style="font-size:13px; opacity:0.8;">Specialized training for cricketers aiming for the national team and BCCI tournaments.</p>
            </div>
        </div>
        <div class="aca-card">
            <i class="fa-solid fa-flag"></i>
            <div>
                <h4 style="font-family:'Sora'; margin-bottom:10px;">Balewadi Sports Complex, Pune</h4>
                <p style="font-size:13px; opacity:0.8;">One of Indias leading multi-sport facilities hosting national and international events.</p>
            </div>
        </div>
        <div class="aca-card">
            <i class="fa-solid fa-star"></i>
            <div>
                <h4 style="font-family:'Sora'; margin-bottom:10px;">State Sports Policy Academies</h4>
                <p style="font-size:13px; opacity:0.8;">Residential academies run by various state sports departments for young talents.</p>
            </div>
        </div>
    </div>

    <!-- Courses -->
    <div class="course-sec">
        <h2 style="font-family:'Sora'; color:#7f1d1d; text-align:center;">🎓 Professional Degree Courses</h2>
        <div class="course-grid">
            <div class="course-item">
                <h4 style="color:#b91c1c;">B.P.Ed / M.P.Ed</h4>
                <p style="font-size:12px; margin-top:5px;">Bachelor & Master in Physical Education for teaching and coaching.</p>
            </div>
            <div class="course-item">
                <h4 style="color:#b91c1c;">Sports Science</h4>
                <p style="font-size:12px; margin-top:5px;">Study of athlete performance, nutrition, and exercise physiology.</p>
            </div>
            <div class="course-item">
                <h4 style="color:#b91c1c;">Sports Management</h4>
                <p style="font-size:12px; margin-top:5px;">Business side of sports, branding, and event organization.</p>
            </div>
            <div class="course-item">
                <h4 style="color:#b91c1c;">Sports Journalism</h4>
                <p style="font-size:12px; margin-top:5px;">Media, broadcasting, and reporting for major sports events.</p>
            </div>
        </div>
    </div>

    <!-- Skills -->
    <div class="skills-sec">
        <h2 class="sec-title">What Makes a Champion?</h2>
        <div class="skill-tag">EXPLOSIVE FITNESS</div>
        <div class="skill-tag">MENTAL DISCIPLINE</div>
        <div class="skill-tag">TEAMWORK</div>
        <div class="skill-tag">CONSISTENCY</div>
        <div class="skill-tag">TACTICAL THINKING</div>
    </div>
</div>

<br><br><br>

@endsection

@extends('layouts.app')

@section('title', 'Non-Traditional & Emerging Careers | Career Gyan')

@section('styles')
<style>
    /* Modern Theme Colors */
    :root {
        --modern-bg: #0f172a;
        --modern-card: #1e293b;
        --modern-accent: #8b5cf6;
        --modern-text: #f8fafc;
        --modern-sub: #94a3b8;
    }

    .non-trad-body { background: var(--modern-bg); color: var(--modern-text); font-family: 'Inter', sans-serif; }

    /* Hero Section */
    .hero-non-trad { padding: 120px 0 80px; text-align: center; background: radial-gradient(circle at top right, #2e1065, transparent), radial-gradient(circle at bottom left, #0c4a6e, transparent); position: relative; }
    .hero-non-trad h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(36px, 6vw, 64px); line-height: 1.1; margin-bottom: 25px; }
    .hero-non-trad p { font-size: 20px; color: var(--modern-sub); max-width: 800px; margin: 0 auto; line-height: 1.6; }

    /* Category Navigation */
    .cat-nav-modern { display: flex; justify-content: center; gap: 12px; margin-top: 50px; flex-wrap: wrap; }
    .nav-pill { background: var(--modern-card); border: 1px solid #334155; padding: 12px 24px; border-radius: 50px; font-weight: 600; color: var(--modern-text); cursor: pointer; transition: 0.3s; }
    .nav-pill:hover, .nav-pill.active { background: var(--modern-accent); border-color: var(--modern-accent); transform: translateY(-2px); }

    /* Career Cards */
    .career-grid-modern { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; margin-top: 60px; }
    .card-modern { background: var(--modern-card); border-radius: 24px; border: 1px solid #334155; overflow: hidden; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; display: flex; flex-direction: column; }
    .card-modern:hover { transform: translateY(-12px) scale(1.02); border-color: var(--modern-accent); box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5); }

    .badge-risk { position: absolute; top: 25px; right: 25px; font-size: 11px; font-weight: 800; padding: 5px 15px; border-radius: 30px; text-transform: uppercase; }
    .risk-low { background: #064e3b; color: #34d399; }
    .risk-medium { background: #78350f; color: #fbbf24; }
    .risk-high { background: #7f1d1d; color: #f87171; }

    .card-header-modern { padding: 40px 35px 25px; }
    .icon-wrapper { width: 64px; height: 64px; background: rgba(139, 92, 246, 0.1); color: var(--modern-accent); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 30px; margin-bottom: 25px; border: 1px solid rgba(139, 92, 246, 0.2); }
    .card-header-modern h3 { font-family: 'Sora', sans-serif; font-size: 26px; margin-bottom: 12px; }
    .card-header-modern p { font-size: 15px; color: var(--modern-sub); line-height: 1.6; }

    .card-stats-modern { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; padding: 0 35px 30px; }
    .stat-box-modern { background: rgba(15, 23, 42, 0.5); padding: 15px; border-radius: 16px; border: 1px solid #334155; }
    .stat-box-modern small { display: block; font-size: 10px; color: var(--modern-sub); font-weight: 800; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 1px; }
    .stat-box-modern span { font-size: 14px; font-weight: 700; color: white; }

    .card-footer-modern { padding: 30px 35px; background: rgba(15, 23, 42, 0.3); border-top: 1px solid #334155; margin-top: auto; }
    .btn-roadmap-modern { width: 100%; background: var(--modern-accent); color: white; padding: 15px; border-radius: 16px; font-weight: 700; border: none; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 12px; }
    .btn-roadmap-modern:hover { background: #7c3aed; transform: scale(1.02); }

    /* Feature: No Degree Section */
    .no-degree-sec { margin-top: 120px; padding: 80px; background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); border-radius: 40px; border: 1px solid rgba(139, 92, 246, 0.3); position: relative; overflow: hidden; }
    .no-degree-sec::after { content: "NO DEGREE? NO PROBLEM"; position: absolute; bottom: -20px; right: -20px; font-size: 80px; font-weight: 900; opacity: 0.03; color: white; white-space: nowrap; }
    .no-degree-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 60px; align-items: center; }
    .no-degree-text h2 { font-family: 'Sora', sans-serif; font-size: 42px; margin-bottom: 20px; }
    .no-degree-text p { font-size: 18px; color: var(--modern-sub); line-height: 1.7; margin-bottom: 30px; }
    .check-item { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; font-weight: 600; }
    .check-item i { color: #10b981; font-size: 20px; }

    /* Skills Overview */
    .skills-overview { margin-top: 120px; text-align: center; }
    .skills-modern-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 25px; margin-top: 50px; }
    .skill-modern-card { background: var(--modern-card); padding: 40px 30px; border-radius: 24px; border: 1px solid #334155; transition: 0.3s; }
    .skill-modern-card:hover { border-color: var(--modern-accent); transform: translateY(-5px); }
    .skill-modern-card i { font-size: 40px; color: var(--modern-accent); margin-bottom: 20px; }
    .skill-modern-card h4 { font-family: 'Sora', sans-serif; font-size: 18px; margin-bottom: 10px; }
    .skill-modern-card p { font-size: 13px; color: var(--modern-sub); }

    /* Platforms */
    .plat-modern-sec { margin-top: 120px; padding: 60px 0; border-top: 1px solid #334155; }
    .plat-row { display: flex; justify-content: space-around; flex-wrap: wrap; gap: 40px; opacity: 0.6; filter: grayscale(1); transition: 0.3s; }
    .plat-row:hover { opacity: 1; filter: grayscale(0); }
    .plat-logo { font-size: 40px; display: flex; align-items: center; gap: 12px; font-weight: 800; font-family: 'Sora'; }

    /* Modal Sidebar */
    .sidebar-modern { position: fixed; right: -100%; top: 0; width: 100%; max-width: 550px; height: 100vh; background: #0f172a; border-left: 1px solid #334155; z-index: 2000; transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1); padding: 60px; overflow-y: auto; }
    .sidebar-modern.active { right: 0; }
    .overlay-modern { position: fixed; inset: 0; background: rgba(2, 6, 23, 0.8); backdrop-filter: blur(8px); opacity: 0; visibility: hidden; transition: 0.3s; z-index: 1999; }
    .overlay-modern.active { opacity: 1; visibility: visible; }

    .step-modern { margin-bottom: 40px; position: relative; padding-left: 60px; }
    .step-modern::before { content: ""; position: absolute; left: 20px; top: 40px; bottom: -20px; width: 2px; background: #334155; }
    .step-modern:last-child::before { display: none; }
    .step-num-modern { position: absolute; left: 0; top: 0; width: 42px; height: 42px; background: var(--modern-accent); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; border: 4px solid #0f172a; z-index: 2; }
</style>
@endsection

@section('content')
<div class="non-trad-body">
    <!-- HERO -->
    <section class="hero-non-trad">
        <div class="container">
            <h1>The Future is <span style="background: linear-gradient(to right, #8b5cf6, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Skill-Based.</span></h1>
            <p>Traditional paths are great, but the digital economy runs on what you can build, create, and solve. Discover modern careers where your portfolio is your resume.</p>
            
            <div class="cat-nav-modern">
                <button class="nav-pill active" onclick="filterModern('all')">All Modern Careers</button>
                @foreach($categories as $name => $c)
                    <button class="nav-pill" onclick="filterModern('{{ Str::slug($name) }}')">{{ $name }}</button>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Career Grid -->
        <div class="career-grid-modern">
            @foreach($categories as $name => $careers)
            @foreach($careers as $career)
            <div class="card-modern career-item-modern" data-category="{{ Str::slug($name) }}">
                <span class="badge-risk risk-{{ strtolower($career->risk_level) }}">{{ $career->risk_level }} Risk</span>
                
                <div class="card-header-modern">
                    <div class="icon-wrapper">
                        <i class="fa-solid {{ $career->icon }}"></i>
                    </div>
                    <small style="color:var(--modern-accent); font-weight:800; text-transform:uppercase; letter-spacing:1.5px;">{{ $career->category }}</small>
                    <h3>{{ $career->name }}</h3>
                    <p>{{ $career->description }}</p>
                </div>

                <div class="card-stats-modern">
                    <div class="stat-box-modern">
                        <small>Income Potential</small>
                        <span>{{ $career->income_potential }}</span>
                    </div>
                    <div class="stat-box-modern">
                        <small>Time to Learn</small>
                        <span>{{ $career->duration }}</span>
                    </div>
                </div>

                <div class="card-footer-modern">
                    <button class="btn-roadmap-modern" onclick="openModernPath({{ $career->id }})">
                        Build My Roadmap <i class="fa-solid fa-bolt-lightning"></i>
                    </button>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>

        <!-- No Degree Section -->
        <section class="no-degree-sec">
            <div class="no-degree-grid">
                <div class="no-degree-text">
                    <span style="color:var(--modern-accent); font-weight:800; text-transform:uppercase;">Special Feature</span>
                    <h2>🎓 No Degree? Start Your Career</h2>
                    <p>In the digital economy, your skills are your currency. Companies like Google, Apple, and thousands of startups now hire based on proof of work rather than a college certificate.</p>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                        <div class="check-item"><i class="fa-solid fa-circle-check"></i> Project-based Learning</div>
                        <div class="check-item"><i class="fa-solid fa-circle-check"></i> Open Source Contribution</div>
                        <div class="check-item"><i class="fa-solid fa-circle-check"></i> Online Certifications</div>
                        <div class="check-item"><i class="fa-solid fa-circle-check"></i> Building in Public</div>
                    </div>
                    <button class="btn-roadmap-modern" style="width:auto; padding:18px 40px; margin-top:40px;">Download "No Degree" Guide (PDF)</button>
                </div>
                <div style="text-align:center;">
                    <div style="background:rgba(255,255,255,0.05); padding:40px; border-radius:30px; border:1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-graduation-cap" style="font-size:100px; color:var(--modern-accent); opacity:0.5;"></i>
                        <h4 style="margin-top:20px; font-family:'Sora';">Skills > Certificates</h4>
                        <p style="font-size:14px; opacity:0.6; margin-top:10px;">"80% of top tech companies value a strong portfolio over a traditional degree."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section class="skills-overview">
            <h2 style="font-family:'Sora'; font-size:36px;">The Modern Professional DNA</h2>
            <p style="color:var(--modern-sub); margin-top:10px;">Master these fundamental soft skills to thrive in any non-traditional career.</p>
            
            <div class="skills-modern-grid">
                <div class="skill-modern-card">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <h4>Creativity</h4>
                    <p>Ability to solve problems in unique ways and create original work.</p>
                </div>
                <div class="skill-modern-card">
                    <i class="fa-solid fa-comments"></i>
                    <h4>Communication</h4>
                    <p>Clearly articulating ideas to clients and remote teams worldwide.</p>
                </div>
                <div class="skill-modern-card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h4>Consistency</h4>
                    <p>Show up every day. In freelancing, discipline is your boss.</p>
                </div>
                <div class="skill-modern-card">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <h4>Problem Solving</h4>
                    <p>Turning complex business challenges into simple digital solutions.</p>
                </div>
            </div>
        </section>

        <!-- Platforms -->
        <section class="plat-modern-sec">
            <div class="plat-row">
                <div class="plat-logo"><i class="fa-brands fa-youtube" style="color:#ff0000;"></i> YouTube</div>
                <div class="plat-logo"><i class="fa-brands fa-linkedin" style="color:#0077b5;"></i> LinkedIn</div>
                <div class="plat-logo"><i class="fa-solid fa-upwork" style="color:#6fda44;"></i> Upwork</div>
                <div class="plat-logo"><i class="fa-brands fa-instagram" style="color:#e4405f;"></i> Instagram</div>
                <div class="plat-logo"><i class="fa-brands fa-github"></i> GitHub</div>
            </div>
        </section>
    </div>
</div>

<!-- Sidebar & Overlay -->
<div class="overlay-modern" id="modernOverlay" onclick="closeModern()"></div>
<div class="sidebar-modern" id="modernSidebar">
    <button onclick="closeModern()" style="background:none; border:none; font-size:35px; color:var(--modern-sub); cursor:pointer; position:absolute; right:40px; top:40px;">&times;</button>
    <div id="modernContent"></div>
</div>

@endsection

@section('scripts')
<script>
    const careerData = @json($categories);

    function filterModern(slug) {
        document.querySelectorAll('.nav-pill').forEach(p => p.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.career-item-modern').forEach(item => {
            if(slug === 'all' || item.dataset.category === slug) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function openModernPath(id) {
        let career = null;
        for(let cat in careerData) {
            let found = careerData[cat].find(c => c.id == id);
            if(found) { career = found; break; }
        }

        if(!career) return;

        let stepsHtml = career.learning_path.map((step, idx) => `
            <div class="step-modern">
                <div class="step-num-modern">${idx + 1}</div>
                <h4 style="font-family:'Sora'; margin-bottom:10px;">Phase ${idx + 1}</h4>
                <p style="color:var(--modern-sub); font-size:15px; line-height:1.6;">${step}</p>
            </div>
        `).join('');

        let html = `
            <div class="icon-wrapper" style="width:80px; height:80px; font-size:40px;">
                <i class="fa-solid ${career.icon}"></i>
            </div>
            <h2 style="font-family:'Sora'; font-size:36px; margin-top:25px;">${career.name}</h2>
            <p style="color:var(--modern-sub); margin-top:15px; font-size:17px; line-height:1.6;">${career.description}</p>
            
            <div style="margin:40px 0; padding:30px; background:rgba(255,255,255,0.03); border-radius:24px; border:1px solid #334155;">
                <h4 style="font-family:'Sora'; margin-bottom:15px; color:var(--modern-accent);">Required Tools & Platforms</h4>
                <p style="font-weight:700; color:white;">${career.tools_platforms}</p>
            </div>

            <h3 style="font-family:'Sora'; margin-bottom:30px; color:white;">🚀 Your 4-Step Roadmap</h3>
            <div>${stepsHtml}</div>

            <div style="margin-top:60px; padding:40px; background:linear-gradient(135deg, #4f46e5, #7c3aed); border-radius:30px; text-align:center;">
                <h4 style="font-family:'Sora'; font-size:22px; margin-bottom:15px;">Ready to Build Your Future?</h4>
                <p style="opacity:0.9; font-size:14px; margin-bottom:30px;">Start with Phase 1 today. Consistency is the only secret to success.</p>
                <button style="background:white; color:#4f46e5; border:none; padding:18px 40px; border-radius:16px; font-weight:800; cursor:pointer;">Start Learning for Free</button>
            </div>
        `;

        document.getElementById('modernContent').innerHTML = html;
        document.getElementById('modernSidebar').classList.add('active');
        document.getElementById('modernOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModern() {
        document.getElementById('modernSidebar').classList.remove('active');
        document.getElementById('modernOverlay').classList.remove('active');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection

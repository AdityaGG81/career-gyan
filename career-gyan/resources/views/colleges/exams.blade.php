@extends('layouts.app')

@section('title', 'Competitive Exams in India | Career Gyan')

@section('styles')
<style>
    /* Competitive Exams Specific Styles */
    .hero-exams { padding: 90px 0; background: linear-gradient(135deg, #0f172a 0%, #334155 100%); color: white; text-align: center; border-bottom: 4px solid var(--brand); }
    .hero-exams h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(32px, 5vw, 54px); margin-bottom: 20px; }
    .hero-exams p { font-size: 19px; opacity: 0.9; max-width: 800px; margin: 0 auto; line-height: 1.6; }

    .category-nav { display: flex; justify-content: center; gap: 15px; margin-top: -30px; flex-wrap: wrap; padding: 0 20px; }
    .cat-btn { background: white; border: 1px solid var(--border); padding: 14px 24px; border-radius: 12px; font-weight: 700; color: var(--text-1); cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .cat-btn:hover, .cat-btn.active { background: var(--brand); color: white; border-color: var(--brand); transform: translateY(-3px); }

    .exam-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; margin-top: 60px; }
    .exam-card { background: white; border-radius: 20px; border: 1px solid var(--border); overflow: hidden; transition: 0.3s; display: flex; flex-direction: column; height: 100%; position: relative; }
    .exam-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: var(--brand); }

    .difficulty-badge { position: absolute; top: 20px; right: 20px; font-size: 10px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; }
    .diff-easy { background: #dcfce7; color: #166534; }
    .diff-moderate { background: #fef9c3; color: #854d0e; }
    .diff-high { background: #fee2e2; color: #991b1b; }
    .diff-very-high { background: #fef2f2; color: #7f1d1d; border: 1px solid #f87171; }

    .exam-header { padding: 30px 30px 20px; }
    .exam-icon { width: 50px; height: 50px; background: var(--brand-light); color: var(--brand); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px; }
    .exam-name { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: var(--text-1); margin-bottom: 8px; }
    .conducting-body { font-size: 13px; color: var(--brand); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; display: block; }

    .exam-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; padding: 0 30px 25px; }
    .info-box { background: #f8fafc; padding: 12px; border-radius: 10px; border: 1px solid #f1f5f9; }
    .info-box small { display: block; font-size: 10px; color: var(--text-3); font-weight: 700; text-transform: uppercase; margin-bottom: 4px; }
    .info-box span { font-size: 13px; font-weight: 700; color: var(--text-2); }

    .exam-footer { padding: 25px 30px; background: #f8fafc; border-top: 1px solid var(--border); margin-top: auto; }
    .btn-detail { width: 100%; background: var(--brand); color: white; padding: 12px; border-radius: 10px; font-weight: 700; border: none; cursor: pointer; transition: 0.3s; }
    .btn-detail:hover { background: #0f172a; }

    /* Modal Roadmap */
    .modal-overlay { position: fixed; inset: 0; background: rgba(15,23,42,0.8); display: none; align-items: center; justify-content: center; z-index: 1000; padding: 20px; backdrop-filter: blur(4px); }
    .modal-overlay.active { display: flex; }
    .modal-box { background: white; width: 100%; max-width: 850px; max-height: 90vh; border-radius: 24px; overflow-y: auto; position: relative; padding: 40px; }
    .modal-close { position: absolute; top: 25px; right: 25px; font-size: 28px; cursor: pointer; color: var(--text-3); background: none; border: none; }

    .roadmap-step { display: flex; gap: 20px; margin-bottom: 25px; position: relative; }
    .roadmap-step:not(:last-child)::after { content: ""; position: absolute; left: 20px; top: 45px; bottom: -20px; width: 2px; background: var(--border); border-left: 2px dashed var(--brand); opacity: 0.3; }
    .step-circle { width: 40px; height: 40px; background: var(--brand-light); color: var(--brand); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-family: 'Sora'; flex-shrink: 0; z-index: 2; }
    .step-content h4 { font-family: 'Sora', sans-serif; font-size: 16px; margin-bottom: 6px; color: var(--text-1); }
    .step-content p { font-size: 14px; color: var(--text-2); line-height: 1.5; }

    .tips-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 20px; }
    .tip-card { background: #fffcf0; border: 1px solid #fef08a; padding: 15px; border-radius: 12px; display: flex; gap: 12px; align-items: center; }
    .tip-card i { color: #ca8a04; font-size: 18px; }
    .tip-card span { font-size: 13px; font-weight: 600; color: #854d0e; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-exams">
    <div class="container">
        <h1>Competitive Exams in India</h1>
        <p>Your gateway to prestigious careers in Governance, Banking, Defence, and Professional fields. Get detailed roadmaps, eligibility criteria, and expert preparation tips.</p>
    </div>
</section>

<div class="container" style="margin-top: 30px; margin-bottom: 100px;">
    
    <!-- Category Filter -->
    <div class="category-nav">
        <button class="cat-btn active" onclick="filterExams('all')">All Categories</button>
        @foreach($categories as $catName => $exams)
            <button class="cat-btn" onclick="filterExams('{{ Str::slug($catName) }}')">{{ $catName }}</button>
        @endforeach
    </div>

    <!-- Exam Sections -->
    <div id="exams-container">
        @foreach($categories as $catName => $exams)
        <div class="exam-section" id="{{ Str::slug($catName) }}">
            <h2 style="font-family:'Sora'; margin-top:60px; color:var(--text-1); border-left:5px solid var(--brand); padding-left:15px;">{{ $catName }}</h2>
            <div class="exam-grid">
                @foreach($exams as $exam)
                <div class="exam-card">
                    <span class="difficulty-badge diff-{{ strtolower(str_replace(' ', '-', $exam->difficulty_level)) }}">
                        {{ $exam->difficulty_level }} Difficulty
                    </span>
                    
                    <div class="exam-header">
                        <div class="exam-icon">
                            <i class="fa-solid {{ $exam->icon }}"></i>
                        </div>
                        <span class="conducting-body">{{ $exam->conducting_body }}</span>
                        <h3 class="exam-name">{{ $exam->name }}</h3>
                        <p style="font-size:14px; color:var(--text-2); line-height:1.5;">{{ $exam->description }}</p>
                    </div>

                    <div class="exam-info-grid">
                        <div class="info-box">
                            <small>Eligibility</small>
                            <span>{{ $exam->eligibility }}</span>
                        </div>
                        <div class="info-box">
                            <small>Age Limit</small>
                            <span>{{ $exam->age_limit }}</span>
                        </div>
                        <div class="info-box" style="grid-column: span 2;">
                            <small>Purpose</small>
                            <span>{{ $exam->purpose }}</span>
                        </div>
                    </div>

                    <div class="exam-footer">
                        <button class="btn-detail" onclick="openExamModal({{ $exam->id }})">View Complete Guide & Roadmap</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="examModal" onclick="closeModal(event)">
    <div class="modal-box" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal(event)">&times;</button>
        <div id="modalContent">
            <!-- Populated by JS -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const allExams = @json($categories);

    function filterExams(catSlug) {
        // Toggle Buttons
        document.querySelectorAll('.cat-btn').forEach(btn => {
            btn.classList.remove('active');
            if(btn.textContent.toLowerCase().includes(catSlug.replace('-', ' '))) btn.classList.add('active');
            if(catSlug === 'all' && btn.textContent === 'All Categories') btn.classList.add('active');
        });

        // Toggle Sections
        document.querySelectorAll('.exam-section').forEach(sec => {
            if(catSlug === 'all') {
                sec.style.display = 'block';
            } else {
                sec.style.display = (sec.id === catSlug) ? 'block' : 'none';
            }
        });
    }

    function openExamModal(examId) {
        // Find exam data
        let exam = null;
        for(let cat in allExams) {
            let found = allExams[cat].find(e => e.id == examId);
            if(found) { exam = found; break; }
        }

        if(!exam) return;

        let roadmapHtml = exam.roadmap.map((step, idx) => `
            <div class="roadmap-step">
                <div class="step-circle">${idx + 1}</div>
                <div class="step-content">
                    <h4>Step ${idx + 1}</h4>
                    <p>${step}</p>
                </div>
            </div>
        `).join('');

        let tipsHtml = exam.prep_tips.map(tip => `
            <div class="tip-card">
                <i class="fa-solid fa-lightbulb"></i>
                <span>${tip}</span>
            </div>
        `).join('');

        let html = `
            <div style="display:flex; gap:20px; align-items:center; margin-bottom:30px;">
                <div class="exam-icon" style="margin-bottom:0; width:60px; height:60px; font-size:28px;">
                    <i class="fa-solid ${exam.icon}"></i>
                </div>
                <div>
                    <h2 style="font-family:'Sora'; margin-bottom:4px;">${exam.name}</h2>
                    <span style="color:var(--brand); font-weight:700; font-size:13px; text-transform:uppercase;">${exam.conducting_body}</span>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:25px; margin-bottom:40px;">
                <div style="background:#f8fafc; padding:25px; border-radius:20px;">
                    <h4 style="font-family:'Sora'; margin-bottom:15px; color:var(--text-1); font-size:18px;">Exam Details</h4>
                    <p style="font-size:14px; margin-bottom:10px;"><strong>Pattern:</strong> ${exam.exam_pattern}</p>
                    <p style="font-size:14px; margin-bottom:10px;"><strong>Eligibility:</strong> ${exam.eligibility}</p>
                    <p style="font-size:14px;"><strong>Age Limit:</strong> ${exam.age_limit}</p>
                </div>
                <div style="background:var(--brand-light); padding:25px; border-radius:20px;">
                    <h4 style="font-family:'Sora'; margin-bottom:15px; color:var(--brand); font-size:18px;">Career Outcome</h4>
                    <p style="font-size:14px; color:var(--text-1); line-height:1.6;">${exam.career_outcome}</p>
                </div>
            </div>

            <h3 style="font-family:'Sora'; margin-bottom:20px;">🚀 Your Preparation Roadmap</h3>
            <div style="margin-bottom:40px;">
                ${roadmapHtml}
            </div>

            <h3 style="font-family:'Sora'; margin-bottom:20px;">💡 Expert Preparation Tips</h3>
            <div class="tips-grid">
                ${tipsHtml}
            </div>

            <div style="margin-top:50px; text-align:center; padding:30px; background:#f1f5f9; border-radius:20px;">
                <h4 style="font-family:'Sora'; margin-bottom:10px;">Ready to start your journey?</h4>
                <p style="font-size:14px; color:var(--text-2); margin-bottom:20px;">Join our community of aspirants and get access to more resources.</p>
                <button class="btn-detail" style="width:auto; padding:12px 40px;">Download Study Material (PDF)</button>
            </div>
        `;

        document.getElementById('modalContent').innerHTML = html;
        document.getElementById('examModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(e) {
        if(e.target === document.getElementById('examModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('examModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
</script>
@endsection

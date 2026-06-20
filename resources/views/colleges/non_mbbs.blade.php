@extends('layouts.app')

@section('title', 'Top Non-MBBS Medical Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Non-MBBS Specific Styles ─── */
.hero-nonmbbs { padding: 80px 0; background: linear-gradient(135deg, #065f46 0%, #10b981 100%); color: white; text-align: center; }
.hero-nonmbbs h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-nonmbbs p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* Category Navigation */
.cat-nav { display: flex; gap: 12px; overflow-x: auto; padding: 20px 0; margin-top: 40px; scrollbar-width: none; }
.cat-nav::-webkit-scrollbar { display: none; }
.cat-btn { padding: 10px 24px; background: white; border: 1px solid #d1d5db; border-radius: 30px; white-space: nowrap; cursor: pointer; font-weight: 600; color: #4b5563; transition: 0.3s; }
.cat-btn.active { background: #059669; color: white; border-color: #059669; box-shadow: 0 4px 12px rgba(5,150,105,0.2); }

/* Course Sections */
.course-section { margin-top: 50px; }
.course-title { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; color: #064e3b; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }

.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.non-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.non-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); border-color: #10b981; }

.card-top { padding: 20px; flex: 1; }
.tag-course { display: inline-block; padding: 2px 12px; background: #ecfdf5; color: #059669; border-radius: 20px; font-size: 11px; font-weight: 700; margin-bottom: 12px; }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 8px; line-height: 1.3; }
.card-meta { display: flex; flex-direction: column; gap: 10px; margin-top: 15px; }
.meta-row { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #4b5563; }
.meta-row i { color: #10b981; width: 16px; }

.card-footer { padding: 16px 20px; background: #f9fafb; border-top: 1px solid #f3f4f6; }
.btn-view { width: 100%; padding: 12px; background: #059669; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #065f46; }

/* Advice Section */
.advice-box { background: #fafafa; border: 1px solid #e5e7eb; border-radius: 16px; padding: 30px; margin-top: 80px; }
.advice-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 24px; }
.advice-card { background: white; padding: 24px; border-radius: 12px; border: 1px solid #f3f4f6; position: relative; }
.advice-card h4 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; margin-bottom: 10px; color: #064e3b; }
.advice-card p { font-size: 13px; color: #64748b; line-height: 1.5; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 800px; max-height: 90vh; border-radius: 20px; overflow-y: auto; }
.modal-header { padding: 30px; background: #ecfdf5; border-bottom: 1px solid #d1fae5; position: relative; }
.modal-close { position: absolute; top: 20px; right: 20px; font-size: 32px; border: none; background: none; cursor: pointer; color: #065f46; line-height: 1; }
.modal-body { padding: 30px; }
.detail-sec { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
.detail-sec h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #059669; margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }

  /* ═══════════════════════════════════════════
     RESPONSIVE STYLES (ADDED)
     ═══════════════════════════════════════════ */
  @media (max-width: 768px) {
    .filter-container {
      flex-direction: column;
    }
    .filter-group {
      width: 100%;
    }
    .college-grid {
      grid-template-columns: 1fr;
    }
    .top10-card {
      min-width: 240px;
    }
    .modal-content {
      max-height: 100%;
      height: 100%;
      border-radius: 0;
    }
    .modal-header {
      border-radius: 0;
    }
    div[style*="grid-template-columns:1fr 1fr"],
    div[style*="grid-template-columns: 1fr 1fr"],
    div[style*="grid-template-columns:1fr 1fr;"],
    div[style*="grid-template-columns: 1fr 1fr;"] {
      grid-template-columns: 1fr !important;
    }
  }

  @media (max-width: 480px) {
    .hero-colleges {
      padding: 60px 0;
    }
    .hero-colleges h1 {
      font-size: 28px;
    }
    .hero-colleges p {
      font-size: 14px;
    }
  }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-nonmbbs">
    <div class="container">
        <h1>Alternative Medical Excellence</h1>
        <p>Beyond MBBS lay fulfilling careers in Ayurveda, Homeopathy, Dental Surgery, Physiotherapy, and more. Explore top-tier institutions in Maharashtra recognized for their clinical excellence and holistic healthcare approach.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search College</label>
            <input type="text" id="nonSearch" placeholder="Search by name...">
        </div>
        <div class="filter-group">
            <label>State</label>
            <select id="nonState">
                <option value="">All States</option>
                @foreach($states as $st)
                    <option value="{{ $st }}">{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Course Type</label>
            <select id="nonCourse">
                <option value="">All Alternative Med</option>
                @foreach($courses as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="nonType">
                <option value="">All Types</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <!-- Category Nav -->
    <div class="cat-nav">
        <button class="cat-btn active" onclick="filterByCourse('')">All Courses</button>
        <button class="cat-btn" onclick="filterByCourse('BAMS')">🌿 BAMS</button>
        <button class="cat-btn" onclick="filterByCourse('BHMS')">💊 BHMS</button>
        <button class="cat-btn" onclick="filterByCourse('BDS')">🦷 BDS</button>
        <button class="cat-btn" onclick="filterByCourse('BPT')">💪 BPT</button>
        <button class="cat-btn" onclick="filterByCourse('BUMS')">🕌 BUMS</button>
        <button class="cat-btn" onclick="filterByCourse('BNYS')">🧘 BNYS</button>
    </div>

    <!-- Results Area -->
    <div id="resultsArea">
        @foreach($courses as $cStr)
            @php 
                $courseColleges = $colleges->filter(function($item) use ($cStr) {
                    return strpos($item->popular_branches, $cStr) !== false;
                });
                $icon = ($cStr == 'BAMS') ? 'fa-leaf' : (($cStr == 'BHMS') ? 'fa-pills' : (($cStr == 'BDS') ? 'fa-teeth' : (($cStr == 'BPT') ? 'fa-dumbbell' : 'fa-certificate')));
            @endphp
            
            @if($courseColleges->count() > 0)
            <div class="course-section" data-course="{{ $cStr }}">
                <h2 class="course-title"><i class="fa-solid {{ $icon }}"></i> {{ $cStr }} Colleges</h2>
                <div class="college-grid">
                    @foreach($courseColleges as $c)
                        <div class="non-card" data-state="{{ $c->state }}" data-name="{{ strtolower($c->name) }}" data-course="{{ $cStr }}" data-type="{{ $c->type }}">
                            <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:8px; padding: 16px 20px 0;">
                                @if($c->rank)
                                    <span style="font-size:10px; background:#fef3c7; color:#92400e; padding:2px 8px; border-radius:12px; font-weight:700;" title="CareerGyan Rank">CG #{{ $c->rank }}</span>
                                @endif
                                @if($c->government_rank)
                                    <span style="font-size:10px; background:#e0f2fe; color:#0369a1; padding:2px 8px; border-radius:12px; font-weight:700;" title="Govt NIRF Rank">NIRF #{{ $c->government_rank }}</span>
                                @endif
                                @if($c->naac_grade)
                                    <span style="font-size:10px; background:#dcfce7; color:#14532d; padding:2px 8px; border-radius:12px; font-weight:700;" title="NAAC Grade">NAAC {{ $c->naac_grade }}</span>
                                @endif
                            </div>
                            <div class="card-top">
                                <span class="tag-course">{{ $cStr }}</span>
                                <h3 class="card-title">{{ $c->name }}</h3>
                                <div style="font-size:13px; color:#64748b; margin-bottom:15px; display:flex; align-items:center; gap:5px;">
                                    <i class="fa-solid fa-location-dot"></i> {{ $c->location }}, Maharashtra
                                </div>
                                
                                <div class="card-meta">
                                    <div class="meta-row">
                                        <i class="fa-solid fa-clock"></i>
                                        <div><strong>Duration:</strong> {{ $c->duration }}</div>
                                    </div>
                                    <div class="meta-row">
                                        <i class="fa-solid fa-hospital-user"></i>
                                        <div><strong>Admission:</strong> NEET-UG Merit</div>
                                    </div>
                                    <div class="meta-row">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <div><strong>Fees:</strong> {{ $c->fees_range }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn-view" onclick="openNonDetails({{ $c->id }})">View Profile</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-user-md fa-3x" style="color:#d1d5db; margin-bottom:15px;"></i>
        <h3>No colleges match your filter</h3>
        <p>Try expanding your search criteria.</p>
    </div>

    <!-- Advice Section -->
    <div class="advice-box">
        <h2 style="font-family:'Sora'; font-size:22px; color:#064e3b; display:flex; align-items:center; gap:10px;">🧠 Smart Advice for Aspirants</h2>
        <div class="advice-cards">
            <div class="advice-card" style="border-left:4px solid #10b981;">
                <h4>High NEET Score (550+)</h4>
                <p>Focus on top Government Dental (BDS) or prestigious BAMS colleges. These offer excellent clinical exposure and patient flow.</p>
            </div>
            <div class="advice-card" style="border-left:4px solid #34d399;">
                <h4>Medium Score (350-500)</h4>
                <p>BAMS, BPT (Physiotherapy), or Private Dental colleges are great choices. Consider your passion for clinical surgery vs hollistic healing.</p>
            </div>
            <div class="advice-card" style="border-left:4px solid #6ee7b7;">
                <h4>Emerging Interest</h4>
                <p>BNYS (Naturopathy) and BPT are witnessing high demand in high-end wellness centers, sports clinics, and rehab hospitals.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="nonModal" onclick="closeNonModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeNonModal(event)">&times;</button>
            <div id="mCourse" style="font-size:11px; font-weight:700; color:#059669; text-transform:uppercase; margin-bottom:8px;">COURSE TYPE</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:26px; color:#064e3b; line-height:1.2;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div class="detail-sec">
                <h3><i class="fa-solid fa-book-medical"></i> Overview</h3>
                <p id="mDesc" style="font-size:14px; color:#475569; line-height:1.6;"></p>
            </div>
            <!-- Rankings Info widget -->
            <div class="section-tab" id="mRankingsSection" style="display:none; padding: 16px; border: 1px solid var(--border, #e2e8f0); border-radius: 12px; margin-bottom: 16px; background: white;">
                <h3 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 600; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; color: var(--brand, #0d9488);"><i class="fa-solid fa-award"></i> Accreditation & Rankings</h3>
                <div style="display:flex; gap:12px; margin-top:8px; flex-wrap:wrap;">
                    <div id="mCgRank" style="flex:1; min-width:100px; background:#fef3c7; border:1px solid #fde68a; padding:10px; border-radius:8px; text-align:center;">
                        <div style="font-size:10px; color:#92400e; font-weight:700; text-transform:uppercase;">CareerGyan Rank</div>
                        <div style="font-size:18px; font-weight:800; color:#78350f;" id="mCgRankVal">-</div>
                    </div>
                    <div id="mGovRank" style="flex:1; min-width:100px; background:#e0f2fe; border:1px solid #bae6fd; padding:10px; border-radius:8px; text-align:center;">
                        <div style="font-size:10px; color:#0369a1; font-weight:700; text-transform:uppercase;">Govt NIRF Rank</div>
                        <div style="font-size:18px; font-weight:800; color:#075985;" id="mGovRankVal">-</div>
                    </div>
                    <div id="mNaac" style="flex:1; min-width:100px; background:#dcfce7; border:1px solid #bbf7d0; padding:10px; border-radius:8px; text-align:center;">
                        <div style="font-size:10px; color:#14532d; font-weight:700; text-transform:uppercase;">NAAC Grade</div>
                        <div style="font-size:18px; font-weight:800; color:#166534;" id="mNaacVal">-</div>
                    </div>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-calendar-check"></i> Course Duration</h3>
                    <p id="mDuration" style="font-size:15px; font-weight:600;"></p>
                </div>
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> Tuition Fees</h3>
                    <p id="mFees" style="font-size:15px; font-weight:600;"></p>
                </div>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-hospital"></i> Clinical Exposure</h3>
                <p id="mHospital" style="font-size:14px;"></p>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-stethoscope"></i> Placement & Career Scope</h3>
                <p id="mPlacement" style="font-size:14px;"></p>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-microscope"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px; color:#4b5563;"></p>
            </div>

            <!-- Video Guide Section -->
            <div id="mVideoWrap" class="detail-sec" style="display:none;">
                <h3><i class="fa-brands fa-youtube" style="color:#ef4444;"></i> Video Guide</h3>
                <div id="mVideoContainer" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px; background:#000;"></div>
            </div>

            <div style="background:#ecfdf5; border:1px solid #d1fae5; padding:20px; border-radius:12px; margin-top:20px;">
                <h4 style="font-family:'Sora'; color:#064e3b; margin-bottom:10px;">💡 Why Choose This Course?</h4>
                <p style="font-size:13px; line-height:1.5;">Modern healthcare is increasingly multidisciplinary. Pursuing a career in alternative medicine or allied health provides unique specializations that are highly respected and offer a path to establish a successful private clinical practice.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const nonColleges = @json($colleges);

    const nSearch = document.getElementById('nonSearch');
    const nCourse = document.getElementById('nonCourse');
    const nType = document.getElementById('nonType');
    const sections = document.querySelectorAll('.course-section');
    const navBtn = document.querySelectorAll('.cat-btn');

    function filterNonColleges() {
        let q = nSearch.value.toLowerCase();
        let state = document.getElementById('nonState').value;
        let course = nCourse.value;
        let type = nType.value;

        let resTotal = 0;

        sections.forEach(sec => {
            let secCourse = sec.getAttribute('data-course');
            let visCount = 0;
            let cards = sec.querySelectorAll('.non-card');

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let cardState = card.getAttribute('data-state');
                let cardType = card.getAttribute('data-type');

                let matchQ = name.includes(q);
                let matchState = state === '' || cardState === state;
                let matchCourse = course === '' || secCourse === course;
                let matchType = type === '' || cardType === type;

                if(matchQ && matchCourse && matchType && matchState) {
                    card.style.display = 'flex';
                    visCount++;
                    resTotal++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = visCount > 0 ? 'block' : 'none';
        });

        document.getElementById('noResults').style.display = resTotal === 0 ? 'block' : 'none';
        
        // Match nav buttons
        navBtn.forEach(btn => {
            if(btn.textContent.includes(course) || (course === '' && btn.textContent === 'All Courses')) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    function filterByCourse(val) {
        nCourse.value = val;
        filterNonColleges();
    }

    document.getElementById('nonState').addEventListener('change', filterNonColleges);
    nSearch.addEventListener('input', filterNonColleges);
    nCourse.addEventListener('change', filterNonColleges);
    nType.addEventListener('change', filterNonColleges);

    function getYoutubeId(url) {
        if (!url) return null;
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    function openNonDetails(id) {
        const c = nonColleges.find(x => x.id === id);
        if (!c) return;

        const cgRankDiv = document.getElementById('mCgRank');
        const govRankDiv = document.getElementById('mGovRank');
        const naacDiv = document.getElementById('mNaac');
        const rankingsSection = document.getElementById('mRankingsSection');
        let hasAnyRank = false;

        if (c.rank) {
            document.getElementById('mCgRankVal').textContent = '#' + c.rank;
            cgRankDiv.style.display = 'block';
            hasAnyRank = true;
        } else {
            cgRankDiv.style.display = 'none';
        }

        if (c.government_rank) {
            document.getElementById('mGovRankVal').textContent = '#' + c.government_rank;
            govRankDiv.style.display = 'block';
            hasAnyRank = true;
        } else {
            govRankDiv.style.display = 'none';
        }

        if (c.naac_grade) {
            document.getElementById('mNaacVal').textContent = c.naac_grade;
            naacDiv.style.display = 'block';
            hasAnyRank = true;
        } else {
            naacDiv.style.display = 'none';
        }

        if (hasAnyRank) {
            rankingsSection.style.display = 'block';
        } else {
            rankingsSection.style.display = 'none';
        }

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location + ', ' + c.state;
        document.getElementById('mCourse').textContent = c.popular_branches;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mDuration').textContent = c.duration;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mHospital').textContent = c.affiliated_hospital;
        document.getElementById('mPlacement').textContent = c.placement_support;
        document.getElementById('mFacilities').textContent = c.facilities;

        const videoWrap = document.getElementById('mVideoWrap');
        const videoContainer = document.getElementById('mVideoContainer');
        if (c.youtube_url) {
            const videoId = getYoutubeId(c.youtube_url);
            if (videoId) {
                videoContainer.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>`;
                videoWrap.style.display = 'block';
            } else {
                videoWrap.style.display = 'none';
                videoContainer.innerHTML = '';
            }
        } else {
            videoWrap.style.display = 'none';
            videoContainer.innerHTML = '';
        }

        document.getElementById('nonModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeNonModal(e) {
        if(e.target === document.getElementById('nonModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('nonModal').classList.remove('active');
            document.body.style.overflow = "auto";
            const videoContainer = document.getElementById('mVideoContainer');
            if (videoContainer) {
                videoContainer.innerHTML = '';
            }
            const videoWrap = document.getElementById('mVideoWrap');
            if (videoWrap) {
                videoWrap.style.display = 'none';
            }
        }
    }
</script>
@endsection

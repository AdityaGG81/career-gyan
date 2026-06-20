@extends('layouts.app')

@section('title', 'Top Science Colleges in Maharashtra (B.Sc / M.Sc)')

@section('styles')
<style>
/* ─── Science Specific Styles ─── */
.hero-science { padding: 100px 0; background: linear-gradient(rgba(30, 58, 138, 0.85), rgba(59, 130, 246, 0.95)), url("https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=1400") center/cover no-repeat; color: white; text-align: center; }
.hero-science h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-science p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* Research Section */
.research-hub { background: #eff6ff; border-radius: 24px; padding: 40px; margin-top: 60px; border: 1px dashed #3b82f6; }
.research-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-top: 24px; }
.res-card { background: white; padding: 24px; border-radius: 16px; border: 1px solid #dbeafe; transition: 0.3s; cursor: pointer; position: relative; overflow: hidden; }
.res-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(59, 130, 246, 0.1); border-color: #3b82f6; }
.res-card::before { content: "ELITE RESEARCH"; position: absolute; top: 12px; right: -30px; background: #3b82f6; color: white; padding: 4px 40px; font-size: 9px; font-weight: 800; transform: rotate(45deg); }

/* District Headers */
.district-div { margin-top: 50px; }
.dist-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #1e3a8a; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; padding-bottom: 10px; border-bottom: 2px solid #dbeafe; }

.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.sci-card { background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.sci-card:hover { transform: translateY(-5px); border-color: #3b82f6; box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.2); }

.card-top { padding: 24px; flex: 1; }
.sci-tag { display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1d4ed8; font-size: 11px; font-weight: 700; border-radius: 20px; margin-bottom: 12px; }
.card-name { font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 700; color: #0f172a; line-height: 1.3; margin-bottom: 12px; }
.card-info { display: flex; flex-direction: column; gap: 8px; }
.info-row { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b; }
.info-row i { color: #3b82f6; width: 16px; }

.card-footer { padding: 16px 24px; background: #f8fafc; border-top: 1px solid #f1f5f9; }
.btn-view { width: 100%; border: none; background: #1e3a8a; color: white; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #1d4ed8; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 850px; max-height: 90vh; border-radius: 24px; overflow-y: auto; }
.modal-header { padding: 40px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0; position: relative; }
.modal-close { position: absolute; top: 25px; right: 25px; border: none; background: none; font-size: 32px; color: #64748b; cursor: pointer; }
.modal-body { padding: 40px; }
.badge-type { display: inline-block; padding: 4px 12px; background: #e0f2fe; color: #0369a1; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; }

.section-box { border: 1px solid #f1f5f9; border-radius: 12px; padding: 20px; margin-bottom: 24px; }
.section-box h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }

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
<section class="hero-science">
    <div class="container">
        <h1>Exploring the Frontiers of Science</h1>
        <p>Maharashtra is home to Indias premier science institutes. Whether you aim for pure research in Physics or cutting-edge Data Science, find the perfect foundation for your scientific journey.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Science College</label>
            <input type="text" id="sciSearch" placeholder="Search by name...">
        </div>
        <div class="filter-group">
            <label>State</label>
            <select id="sciState">
                <option value="">All States</option>
                @foreach($states as $st)
                    <option value="{{ $st }}">{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="sciLoc">
                <option value="">All Locations</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="sciType">
                <option value="">All Types</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <!-- Research Institutes Section -->
    <div class="research-hub">
        <h2 style="font-family:'Sora'; color:#1e3a8a; text-align:center;">🔬 Premier Research Hubs</h2>
        <div class="research-grid">
            @foreach($colleges->where('rank', 1) as $c)
            <div class="res-card" onclick="openSciDetails({{ $c->id }})">
                <h3 style="font-family:'Sora'; font-size:18px; margin-bottom:12px; padding-right:60px;">{{ $c->name }}</h3>
                <div style="font-size:13px; color:#64748b;"><i class="fa-solid fa-microscope"></i> {{ $c->specializations }}</div>
                <div style="margin-top:15px; font-size:13px; color:#1d4ed8; font-weight:700;">Explore Lab Facilities &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- District-wise UI -->
    <div id="resultsArea">
        @foreach($districts as $loc)
            @php $locColleges = $colleges->where('location', $loc)->where('rank', '!=', 1); @endphp
            @if($locColleges->count() > 0)
                <div class="district-div" data-loc="{{ $loc }}">
                    <div class="dist-title">
                        <i class="fa-solid fa-map-location-dot"></i> {{ $loc }} District
                    </div>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="sci-card" data-state="{{ $c->state }}" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}" data-type="{{ $c->type }}">
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
                                    <span class="sci-tag">Pure Science & IT</span>
                                    <h3 class="card-name">{{ $c->name }}</h3>
                                    <div class="card-info">
                                        <div class="info-row"><i class="fa-solid fa-flask"></i> {{ $c->popular_branches }}</div>
                                        <div class="info-row"><i class="fa-solid fa-award"></i> Merit-based Admission</div>
                                        <div class="info-row"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $c->fees_range }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-view" onclick="openSciDetails({{ $c->id }})">View Details</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-atom fa-3x" style="color:#cbd5e1; margin-bottom:15px;"></i>
        <h3>No colleges found</h3>
        <p>Try searching for a different district or college name.</p>
    </div>

    <!-- Career Scope Section -->
    <section style="margin-top: 80px; padding: 60px; background: #f1f5f9; border-radius: 30px; text-align:center;">
        <h2 style="font-family:'Sora'; color:#1e40af;">🌌 Career Pathways in Science</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:40px; margin-top:40px;">
            <div>
                <i class="fa-solid fa-magnifying-glass-chart fa-2x" style="color:#3b82f6;"></i>
                <h4 style="margin-top:15px;">Research Scientist</h4>
            </div>
            <div>
                <i class="fa-solid fa-binary fa-2x" style="color:#3b82f6;"></i>
                <h4 style="margin-top:15px;">Data & IT Science</h4>
            </div>
            <div>
                <i class="fa-solid fa-chalkboard-user fa-2x" style="color:#3b82f6;"></i>
                <h4 style="margin-top:15px;">Higher Education</h4>
            </div>
            <div>
                <i class="fa-solid fa-vial-circle-check fa-2x" style="color:#3b82f6;"></i>
                <h4 style="margin-top:15px;">Industrial Labs</h4>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal-overlay" id="sciModal" onclick="closeSciModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeSciModal(event)">&times;</button>
            <span class="badge-type" id="mType">Government</span>
            <h2 id="mName" style="font-family:'Sora'; font-size:28px; color:#1e1e2e;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div class="section-box">
                <h3><i class="fa-solid fa-info-circle"></i> About the College</h3>
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
                <div class="section-box">
                    <h3><i class="fa-solid fa-graduation-cap"></i> Popular Courses</h3>
                    <p id="mCourses" style="font-size:14px; font-weight:600;"></p>
                </div>
                <div class="section-box">
                    <h3><i class="fa-solid fa-wallet"></i> Fee Structure</h3>
                    <p id="mFees" style="font-size:14px; font-weight:600;"></p>
                </div>
            </div>

            <div class="section-box">
                <h3><i class="fa-solid fa-microscope"></i> Research & Lab Infrastructure</h3>
                <p id="mResearch" style="font-size:14px;"></p>
            </div>

            <div class="section-box">
                <h3><i class="fa-solid fa-building-user"></i> Placement & Internships</h3>
                <p id="mPlacement" style="font-size:14px;"></p>
            </div>

            <!-- Video Guide Section -->
            <div id="mVideoWrap" class="section-box" style="display:none;">
                <h3><i class="fa-brands fa-youtube" style="color:#ef4444;"></i> Video Guide</h3>
                <div id="mVideoContainer" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px; background:#000;"></div>
            </div>

            <div style="background:#f0f9ff; border-radius:12px; padding:24px; border-left:5px solid #3b82f6;">
                <h4 style="font-family:'Sora'; color:#0369a1; margin-bottom:10px;">🌟 Why Choose This Science College?</h4>
                <p style="font-size:13px; line-height:1.6; color:#0c4a6e;">With world-class labs and a curriculum designed for analytical thinking, this institution provides the perfect launchpad for students aiming for careers in research, academia, and the growing field of industrial science.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const sciColleges = @json($colleges);

    const sciInp = document.getElementById('sciSearch');
    const sciLoc = document.getElementById('sciLoc');
    const sciType = document.getElementById('sciType');
    const sections = document.querySelectorAll('.district-div');
    const researchBox = document.querySelector('.research-hub');

    function filterSci() {
        let q = sciInp.value.toLowerCase();
        let loc = sciLoc.value;
        let type = sciType.value;

        let totalVis = 0;

        // Hide research hub when searching
        if(q !== '' || loc !== '' || type !== '') {
            researchBox.style.display = 'none';
        } else {
            researchBox.style.display = 'block';
        }

        sections.forEach(sec => {
            let secLoc = sec.getAttribute('data-loc');
            let visInSec = 0;
            let cards = sec.querySelectorAll('.sci-card');

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let cardType = card.getAttribute('data-type');

                let matchQ = name.includes(q);
                let matchLoc = loc === '' || secLoc === loc;
                let matchType = type === '' || cardType === type;

                if(matchQ && matchLoc && matchType) {
                    card.style.display = 'flex';
                    visInSec++;
                    totalVis++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = visInSec > 0 ? 'block' : 'none';
        });

        document.getElementById('noResults').style.display = totalVis === 0 && researchBox.style.display === 'none' ? 'block' : 'none';
    }

    sciInp.addEventListener('input', filterSci);
    sciLoc.addEventListener('change', filterSci);
    sciType.addEventListener('change', filterSci);

    function getYoutubeId(url) {
        if (!url) return null;
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    function openSciDetails(id) {
        const c = sciColleges.find(x => x.id === id);
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
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mCourses').textContent = c.popular_branches;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mResearch').textContent = c.research_support;
        document.getElementById('mPlacement').textContent = c.placement_support;

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

        document.getElementById('sciModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeSciModal(e) {
        if(e.target === document.getElementById('sciModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('sciModal').classList.remove('active');
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

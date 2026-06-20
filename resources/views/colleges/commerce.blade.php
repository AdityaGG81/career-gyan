@extends('layouts.app')

@section('title', 'Top Commerce Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Commerce Specific Styles ─── */
.hero-commerce { padding: 100px 0; background: linear-gradient(rgba(234, 88, 12, 0.85), rgba(217, 119, 6, 0.95)), url("https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&q=80&w=1400") center/cover no-repeat; color: white; text-align: center; }
.hero-commerce h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-commerce p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* Highlight Section */
.highlight-row { display: flex; overflow-x: auto; gap: 20px; padding: 10px 0 30px; scrollbar-width: none; mask-image: linear-gradient(to right, black 85%, transparent); }
.highlight-row::-webkit-scrollbar { display: none; }
.top-card { min-width: 300px; background: white; border: 1px solid #d1fae5; border-radius: 20px; padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: 0.3s; cursor: pointer; position: relative; }
.top-card:hover { transform: translateY(-5px); border-color: #10b981; box-shadow: 0 12px 25px rgba(16, 185, 129, 0.1); }
.badge-top { position: absolute; top: 15px; right: 15px; background: #059669; color: white; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 30px; }

/* District Headers */
.district-div { margin-top: 50px; }
.dist-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #064e3b; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; padding-bottom: 10px; border-bottom: 2px solid #d1fae5; }

.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.com-card { background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.com-card:hover { transform: translateY(-5px); border-color: #10b981; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }

.card-top { padding: 24px; flex: 1; }
.com-tag { display: inline-block; padding: 4px 12px; background: #ecfdf5; color: #059669; border-radius: 20px; font-size: 11px; font-weight: 700; margin-bottom: 15px; }
.card-name { font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 700; color: #1e293b; line-height: 1.3; margin-bottom: 12px; }
.card-meta { display: flex; flex-direction: column; gap: 10px; }
.meta-row { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #475569; }
.meta-row i { color: #10b981; width: 16px; }

.card-footer { padding: 16px 24px; background: #f0fdf4; border-top: 1px solid #d1fae5; }
.btn-view { width: 100%; border: none; background: #059669; color: white; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #065f46; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 800px; max-height: 90vh; border-radius: 24px; overflow-y: auto; }
.modal-header { padding: 40px; background: #f0fdf4; border-bottom: 1px solid #d1fae5; position: relative; }
.modal-close { position: absolute; top: 25px; right: 25px; border: none; background: none; font-size: 32px; color: #059669; cursor: pointer; }
.modal-body { padding: 40px; }

.section-box { background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 12px; padding: 20px; margin-bottom: 24px; }
.section-box h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #064e3b; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }

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
<section class="hero-commerce">
    <div class="container">
        <h1>Charting the Future of Finance</h1>
        <p>Maharashtra is the financial capital of India. Explore top commerce institutions that offer world-class training in Accounting, Banking, and Corporate Management.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Commerce College</label>
            <input type="text" id="comSearch" placeholder="Search by name...">
        </div>
        <div class="filter-group">
            <label>State</label>
            <select id="comState">
                <option value="">All States</option>
                @foreach($states as $st)
                    <option value="{{ $st }}">{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="comLoc">
                <option value="">All Locations</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="comType">
                <option value="">All Types</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <!-- Highlight Row -->
    <div id="highlightArea" style="margin-top: 60px;">
        <h2 style="font-family:'Sora'; color:#064e3b; margin-bottom:20px;">⭐ Featured Finance Institutes</h2>
        <div class="highlight-row">
            @foreach($colleges->where('rank', 1) as $c)
            <div class="top-card" onclick="openComDetails({{ $c->id }})">
                <span class="badge-top">TOP RANKED</span>
                <h3 style="font-family:'Sora'; font-size:16px; margin-top:10px;">{{ $c->name }}</h3>
                <div style="font-size:12px; color:#64748b; margin-top:8px;"><i class="fa-solid fa-location-dot"></i> {{ $c->location }}</div>
                <div style="margin-top:15px; font-size:13px; color:#059669; font-weight:700;">View Placements &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- District-wise List -->
    <div id="resultsArea">
        @foreach($districts as $loc)
            @php $locColleges = $colleges->where('location', $loc)->where('rank', '!=', 1); @endphp
            @if($locColleges->count() > 0)
                <div class="district-div" data-loc="{{ $loc }}">
                    <div class="dist-title">
                        <i class="fa-solid fa-chart-line"></i> {{ $loc }} District
                    </div>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="com-card" data-state="{{ $c->state }}" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}" data-type="{{ $c->type }}">
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
                                    <span class="com-tag">Commerce & Finance</span>
                                    <h3 class="card-name">{{ $c->name }}</h3>
                                    <div class="card-meta">
                                        <div class="meta-row"><i class="fa-solid fa-briefcase"></i> {{ $c->popular_branches }}</div>
                                        <div class="meta-row"><i class="fa-solid fa-graduation-cap"></i> Merit-based (12th)</div>
                                        <div class="meta-row"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $c->fees_range }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-view" onclick="openComDetails({{ $c->id }})">View Details</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-calculator fa-3x" style="color:#d1d5db; margin-bottom:15px;"></i>
        <h3>No colleges found</h3>
        <p>Try searching with a different name or district.</p>
    </div>

    <!-- Career Scope -->
    <section style="margin-top: 80px; padding: 60px; background: #ecfdf5; border-radius: 30px; text-align:center; border:1px solid #d1fae5;">
        <h2 style="font-family:'Sora'; color:#064e3b;">💼 Professional Paths in Commerce</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:30px; margin-top:40px;">
            <div>
                <i class="fa-solid fa-building-columns fa-2x" style="color:#059669;"></i>
                <h4 style="margin-top:10px;">Banking & Finance</h4>
            </div>
            <div>
                <i class="fa-solid fa-user-check fa-2x" style="color:#059669;"></i>
                <h4 style="margin-top:10px;">CA / CS / CMA</h4>
            </div>
            <div>
                <i class="fa-solid fa-briefcase fa-2x" style="color:#059669;"></i>
                <h4 style="margin-top:10px;">Corporate Management</h4>
            </div>
            <div>
                <i class="fa-solid fa-rocket fa-2x" style="color:#059669;"></i>
                <h4 style="margin-top:10px;">Entrepreneurship</h4>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal-overlay" id="comModal" onclick="closeComModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeComModal(event)">&times;</button>
            <div id="mType" style="font-size:11px; font-weight:700; color:#059669; text-transform:uppercase; margin-bottom:10px;">TYPE</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:26px; color:#1e293b;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div class="section-box">
                <h3><i class="fa-solid fa-info-circle"></i> Overview</h3>
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
                    <h3><i class="fa-solid fa-graduation-cap"></i> Courses</h3>
                    <p id="mCourses" style="font-size:14px; font-weight:600;"></p>
                </div>
                <div class="section-box">
                    <h3><i class="fa-solid fa-wallet"></i> Fee Structure</h3>
                    <p id="mFees" style="font-size:14px; font-weight:600;"></p>
                </div>
            </div>

            <div class="section-box">
                <h3><i class="fa-solid fa-briefcase"></i> Placement Cell & Recrutiers</h3>
                <p id="mPlacement" style="font-size:14px;"></p>
            </div>

            <div class="section-box">
                <h3><i class="fa-solid fa-laptop-code"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px;"></p>
            </div>

            <!-- Video Guide Section -->
            <div id="mVideoWrap" class="section-box" style="display:none;">
                <h3><i class="fa-brands fa-youtube" style="color:#ef4444;"></i> Video Guide</h3>
                <div id="mVideoContainer" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px; background:#000;"></div>
            </div>

            <div style="background:#f0fdf4; border-radius:12px; padding:20px; border-left:4px solid #059669;">
                <h4 style="font-family:'Sora'; font-size:16px; color:#064e3b; margin-bottom:8px;">🎯 Why Competitive Excellence?</h4>
                <p style="font-size:13px; line-height:1.5;">This institute is renowned for its academic rigor and strong industry connections, providing students a direct gateway to top global firms in banking, taxation, and financial consulting.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const comColleges = @json($colleges);

    const cSearch = document.getElementById('comSearch');
    const cLoc = document.getElementById('comLoc');
    const cType = document.getElementById('comType');
    const sections = document.querySelectorAll('.district-div');
    const hiArea = document.getElementById('highlightArea');

    function filterCom() {
        let q = cSearch.value.toLowerCase();
        let loc = cLoc.value;
        let type = cType.value;

        let totalVis = 0;

        if(q !== '' || loc !== '' || type !== '') {
            hiArea.style.display = 'none';
        } else {
            hiArea.style.display = 'block';
        }

        sections.forEach(sec => {
            let secLoc = sec.getAttribute('data-loc');
            let visInSec = 0;
            let cards = sec.querySelectorAll('.com-card');

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

        document.getElementById('noResults').style.display = totalVis === 0 && hiArea.style.display === 'none' ? 'block' : 'none';
    }

    cSearch.addEventListener('input', filterCom);
    cLoc.addEventListener('change', filterCom);
    cType.addEventListener('change', filterCom);

    function getYoutubeId(url) {
        if (!url) return null;
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    function openComDetails(id) {
        const c = comColleges.find(x => x.id === id);
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
        document.getElementById('mCourses').textContent = c.popular_branches;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mFees').textContent = c.fees_range;
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

        document.getElementById('comModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeComModal(e) {
        if(e.target === document.getElementById('comModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('comModal').classList.remove('active');
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

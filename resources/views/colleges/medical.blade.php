@extends('layouts.app')

@section('title', 'Top Medical Colleges (MBBS)')

@section('styles')
<style>
/* ─── Medical Colleges Specific Additions ─── */
.hero-medical { padding: 100px 0; background: linear-gradient(rgba(6, 78, 59, 0.85), rgba(13, 148, 136, 0.95)), url("https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1400") center/cover no-repeat; color: white; text-align: center; }
.hero-medical h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-medical p { font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto; }

/* Filter Section */
.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }
.filter-group input:focus, .filter-group select:focus { border-color: #0d9488; box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.1); }

/* Top Highlight */
.top-wrapper { display: flex; overflow-x: auto; gap: 16px; padding: 20px 0; scroll-behavior: smooth; }
.top-wrapper::-webkit-scrollbar { height: 6px; }
.top-wrapper::-webkit-scrollbar-thumb { background-color: var(--border); border-radius: 10px; }
.top-card { min-width: 280px; background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; display: flex; flex-direction: column; position: relative; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);}
.top-card:hover { border-color: #0d9488; transform: translateY(-5px); }
.rank-badge { position: absolute; top: -12px; left: 20px; background: #0d9488; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 14px; }

/* College Grid */
.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 24px; margin-top: 40px; }
.college-card { background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; position: relative;}
.college-card:hover { box-shadow: 0 12px 24px rgba(0,0,0,0.06); transform: translateY(-4px); }
.card-header { padding: 20px; border-bottom: 1px solid var(--border); background: #fdfdfd; }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; line-height: 1.3; margin-bottom: 8px; color: #064e3b;}
.card-loc { font-size: 13px; color: var(--text-2); display: flex; gap: 6px; align-items: center; }
.card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; gap: 12px; }
.info-row { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--text-1); }
.info-icon { width: 24px; height: 24px; background: #ccfbf1; color: #0d9488; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 12px;}
.card-footer { padding: 16px 20px; background: #f8fafc; border-top: 1px solid var(--border); }
.btn-view { width: 100%; text-align: center; padding: 12px; background: #0d9488; color: white; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; transition: 0.2s;}
.btn-view:hover { background: #0f766e; }

/* Modal */
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15,23,42,.6); display: none; align-items: center; justify-content: center; z-index: 1000; padding: 20px;}
.modal-overlay.active { display: flex; }
.modal-content { background: #fff; border-radius: 16px; width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; position:relative; display: flex; flex-direction: column;}
.modal-header { padding: 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: flex-start; background: #f0fdfa; border-radius: 16px 16px 0 0;}
.modal-close { background: none; border: none; font-size: 28px; cursor: pointer; color: var(--text-3); line-height: 1;}
.modal-body { padding: 24px; }
.section-tab { padding: 16px; border: 1px solid var(--border); border-radius: 12px; margin-bottom: 16px; }
.section-tab h3 { font-family: 'Sora', sans-serif; font-size: 16px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; color: #0d9488; }

.badge-neet { background: #0d9488; color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight: 700; }

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
<section class="hero-medical">
    <div class="container">
        <h1>Top Medical Colleges</h1>
        <p>Your journey to becoming a doctor starts here. Explore premier MBBS institutes across the state, admission is strictly based on your NEET-UG merit scores. Choosing the right hospital-affiliated college is key to strong clinical exposure.</p>
    </div>
</section>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Medical College</label>
            <input type="text" id="filterSearch" placeholder="E.g. AFMC, Seth GS, AIIMS...">
        </div>
        <div class="filter-group">
            <label>State</label>
            <select id="filterState">
                <option value="">All States</option>
                @foreach($states as $st)
                    <option value="{{ $st }}">{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="filterLoc">
                <option value="">All Locations</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="filterType">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>NEET Score Range</label>
            <select id="filterNeet">
                <option value="">Any Score</option>
                <option value="600">600+ (Govt Top)</option>
                <option value="500">500-600 (Govt/Semi)</option>
                <option value="350">350-500 (Private/Management)</option>
            </select>
        </div>
    </div>

    <!-- Highlights Top 10 -->
    <div style="margin-top: 60px;" id="highlightSection">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="font-family:'Sora'; font-size:24px;">🩺 Top 10 Medical Colleges</h2>
        </div>
        <div class="top-wrapper">
            @foreach($colleges->whereNotNull('rank')->sortBy('rank')->take(10) as $topCol)
            <div class="top-card" onclick="openDetails({{ $topCol->id }})">
                <div class="rank-badge">Rank #{{ $topCol->rank }}</div>
                <h3 style="font-family:'Sora'; font-size:16px; margin-top:12px; margin-bottom:8px; min-height:40px;">{{ $topCol->name }}</h3>
                <div style="color:var(--text-2); font-size:13px; margin-bottom:12px;"><i class="fa-solid fa-location-dot"></i> {{ $topCol->location }}</div>
                <div style="font-size:12px; color:#0d9488; font-weight:600; display:flex; align-items:center; gap:4px;">
                    <i class="fa-solid fa-hospital"></i> High Clinical Exposure
                </div>
                <div style="margin-top: auto; padding-top:16px; font-size:13px; color:var(--brand); font-weight:600;">View Profile &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- All Colleges Grid -->
    <div style="margin-top: 60px;">
        <h2 style="font-family:'Sora'; font-size:24px; margin-bottom:8px;" id="gridTitle">Explore All MBBS Institutes</h2>
        <p style="color:var(--text-2); margin-bottom: 24px;" id="gridSub">Found <span id="count">0</span> matching medical colleges.</p>
        
        <div id="noResults" style="display:none; text-align:center; padding: 40px; background:var(--surface); border-radius:16px;">
            <i class="fa-solid fa-user-md fa-3x" style="color:var(--border); margin-bottom:16px;"></i>
            <h3>No medical colleges found</h3>
            <p>Try searching for a different district or type.</p>
        </div>

        <div class="college-grid" id="collegeGrid">
            <!-- Rendered by JS -->
        </div>
    </div>
</div>

<!-- Detailed Modal -->
<div class="modal-overlay" id="collegeModal" onclick="closeModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <span id="mType" style="display:inline-block; padding:2px 10px; background:#ccfbf1; color:#0f766e; border-radius:12px; font-size:12px; font-weight:600; margin-bottom:8px;">Type</span>
                <h2 id="mName" style="font-family:'Sora'; font-size:24px; line-height:1.2; margin-bottom:4px; color:#064e3b;">College Name</h2>
                <div style="color:var(--text-2); font-size:14px;"><i class="fa-solid fa-map-marker-alt"></i> <span id="mLoc">Location</span></div>
            </div>
            <button class="modal-close" onclick="closeModal(event)">&times;</button>
        </div>
        <div class="modal-body">
            <div class="section-tab">
                <h3><i class="fa-solid fa-notes-medical"></i> Overview</h3>
                <p id="mDesc" style="font-size:14px; line-height:1.6; color:var(--text-1);">Description</p>
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

            
            </div>
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-hospital"></i> Affiliated Hospital</h3>
                    <p id="mHospital" style="font-size:14px; font-weight:500;">Hospital Name</p>
                </div>
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-users"></i> MBBS Seats</h3>
                    <p id="mSeats" style="font-size:14px; font-weight:500;">Seats Count</p>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> Fees Structure</h3>
                    <p id="mFees" style="font-size:14px; font-weight:500;">Fees</p>
                </div>
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-bullseye"></i> NEET Cutoff</h3>
                    <p id="mCutoff" style="font-size:14px; font-weight:500;">Cutoff Range</p>
                </div>
            </div>

            <div class="section-tab">
                <h3><i class="fa-solid fa-stethoscope"></i> Clinical Exposure</h3>
                <p id="mExposure" style="font-size:14px;">Clinical exposure details</p>
            </div>

            <div class="section-tab">
                <h3><i class="fa-solid fa-microscope"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px;">Facilities</p>
            </div>

            <!-- Reviews Section -->
            <div class="section-tab" style="padding: 16px; border: 1px solid var(--border); border-radius: 12px; margin-bottom: 16px; background: white;">
                <div id="mReviewsSection"></div>
            </div>

            <!-- Video Guide Section -->
            <div id="mVideoWrap" class="section-tab" style="display:none;">
                <h3><i class="fa-brands fa-youtube" style="color:#ef4444;"></i> Video Guide</h3>
                <div id="mVideoContainer" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px; background:#000;"></div>
            </div>

            <div style="background:#f0fdf4; border:1px solid #99f6e4; padding:16px; border-radius:12px; color:#0f766e;">
                <h3 style="font-family:'Sora'; font-size:16px; margin-bottom:8px; display:flex; align-items:center; gap:8px;"><i class="fa-solid fa-award"></i> Why Choose This College?</h3>
                <p style="font-size:14px;">This college is highly ranked for its medical research and patient volume, providing students with unparalleled hands-on experience in one of the state's busiest healthcare environments.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const collegesData = @json($colleges);
    
    // DOM Elements
    const searchInput = document.getElementById('filterSearch');
    const locInput = document.getElementById('filterLoc');
    const typeInput = document.getElementById('filterType');
    const neetInput = document.getElementById('filterNeet');
    const gridContainer = document.getElementById('collegeGrid');
    const countDisplay = document.getElementById('count');
    const highlightSection = document.getElementById('highlightSection');

    function renderCards(data) {
        gridContainer.innerHTML = '';
        countDisplay.textContent = data.length;

        if(data.length === 0) {
            document.getElementById('noResults').style.display = 'block';
            return;
        } else {
            document.getElementById('noResults').style.display = 'none';
        }

        data.forEach(c => {
            const card = document.createElement('div');
            card.className = 'college-card';
            
            let ranksHtml = '';
            if (c.rank || c.government_rank || c.naac_grade) {
                ranksHtml = `
                    <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:10px;">
                        ${c.rank ? `<span style="font-size:10.5px; background:#fef3c7; color:#92400e; padding:2px 8px; border-radius:12px; font-weight:700;" title="CareerGyan Rank">CG #${c.rank}</span>` : ''}
                        ${c.government_rank ? `<span style="font-size:10.5px; background:#e0f2fe; color:#0369a1; padding:2px 8px; border-radius:12px; font-weight:700;" title="Govt NIRF Rank">NIRF #${c.government_rank}</span>` : ''}
                        ${c.naac_grade ? `<span style="font-size:10.5px; background:#dcfce7; color:#14532d; padding:2px 8px; border-radius:12px; font-weight:700;" title="NAAC Grade">NAAC ${c.naac_grade}</span>` : ''}
                    </div>
                `;
            }

            card.innerHTML = `
                <div class="card-header">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                        <span style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#0d9488; font-weight:700;">${c.type}</span>
                        ${ranksHtml}
                    </div>
                    <div class="card-title">${c.name}</div>
                    <div class="card-loc"><i class="fa-solid fa-location-dot"></i> ${c.location}, ${c.state}</div>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-hospital"></i></div>
                        <div><strong>Hospital:</strong> Attached Teaching Hospital</div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                        <div><strong>Cutoff:</strong> ${c.cutoff}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
                        <div><strong>Fees:</strong> ${c.fees_range}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn-view" onclick="openDetails(${c.id})">Full Details</button>
                </div>
            `;
            gridContainer.appendChild(card);
        });
    }

    function applyFilters() {
        let q = searchInput.value.toLowerCase();
        let loc = locInput.value;
        let type = typeInput.value;
        let state = document.getElementById('filterState').value;
        let neet = neetInput.value;

        // Hide Top 10 section if any filter is active
        if(q !== '' || loc !== '' || type !== '' || state !== '' || neet !== '') {
            highlightSection.style.display = 'none';
        } else {
            highlightSection.style.display = 'block';
        }

        let filtered = collegesData.filter(c => {
            let matchQ = c.name.toLowerCase().includes(q) || (c.description && c.description.toLowerCase().includes(q));
            let matchLoc = loc === "" || c.location === loc;
            let matchType = type === "" || c.type === type;
            
            // Simple NEET score simulation
            let matchNeet = true;
            let cutoffStr = c.cutoff || '';
            if(neet === "600") matchNeet = cutoffStr.includes('580') || c.type === 'Government';
            if(neet === "500") matchNeet = !cutoffStr.includes('580') || c.type === 'Government' || c.type === 'Private';
            if(neet === "350") matchNeet = c.type === 'Private' || c.type === 'Deemed';

            return matchQ && matchLoc && matchType && matchNeet;
        });

        renderCards(filtered.slice(0, 100));
    }

    // Event Listeners
    function populateDistricts(selectedState) {
        const currentLoc = locInput.value;
        locInput.innerHTML = '<option value="">All Locations</option>';
        let locations = [...new Set(collegesData
            .filter(c => !selectedState || c.state === selectedState)
            .map(c => c.location)
        )].sort();
        locations.forEach(loc => {
            const opt = document.createElement('option');
            opt.value = loc;
            opt.textContent = loc;
            locInput.appendChild(opt);
        });
        if (locations.includes(currentLoc)) {
            locInput.value = currentLoc;
        } else {
            locInput.value = "";
        }
    }

    const stateInput = document.getElementById('filterState');
    stateInput.addEventListener('change', () => {
        populateDistricts(stateInput.value);
        applyFilters();
    });

    searchInput.addEventListener('input', applyFilters);
    locInput.addEventListener('change', applyFilters);
    typeInput.addEventListener('change', applyFilters);
    neetInput.addEventListener('change', applyFilters);

    // Initial Render
    renderCards(collegesData);

    // Modal Logic
    function getYoutubeId(url) {
        if (!url) return null;
        const regExp = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

    function openDetails(id) {
        const c = collegesData.find(x => x.id === id);
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
        document.getElementById('mHospital').textContent = c.affiliated_hospital;
        document.getElementById('mSeats').textContent = c.seats + ' Seats';
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mCutoff').textContent = c.cutoff;
        document.getElementById('mFacilities').textContent = c.facilities;
        document.getElementById('mExposure').textContent = c.clinical_exposure;

        // Load Reviews
        if (typeof loadCollegeReviews === 'function') {
            loadCollegeReviews(c.id, 'mReviewsSection');
        }

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

        document.getElementById('collegeModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeModal(e) {
        if(e.target === document.getElementById('collegeModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('collegeModal').classList.remove('active');
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

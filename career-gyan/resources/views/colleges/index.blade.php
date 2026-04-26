@extends('layouts.app')

@section('title', 'Top Engineering Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Engineering Colleges Specific Additions ─── */
.hero-colleges { padding: 80px 0; background: linear-gradient(135deg, #0e1f6b 0%, #312e81 100%); color: white; text-align: center; }
.hero-colleges h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-colleges p { font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto; }

/* Filter Section */
.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }
.filter-group input:focus, .filter-group select:focus { border-color: var(--brand); box-shadow: 0 0 0 2px var(--brand-light); }

/* Top 10 Highlight */
.top10-wrapper { display: flex; overflow-x: auto; gap: 16px; padding: 20px 0; scroll-behavior: smooth; }
.top10-wrapper::-webkit-scrollbar { height: 6px; }
.top10-wrapper::-webkit-scrollbar-thumb { background-color: var(--border); border-radius: 10px; }
.top10-card { min-width: 280px; background: linear-gradient(180deg, #ffffff, #f8fafc); border: 2px solid #e2e8f0; border-radius: 16px; padding: 20px; display: flex; flex-direction: column; position: relative; cursor: pointer; transition: 0.3s;}
.top10-card:hover { border-color: var(--brand); transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
.rank-badge { position: absolute; top: -12px; left: 20px; background: var(--brand); color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 14px; }

/* College Grid */
.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 24px; margin-top: 40px; }
.college-card { background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.college-card:hover { box-shadow: 0 12px 24px rgba(0,0,0,0.06); transform: translateY(-4px); }
.card-header { padding: 20px; border-bottom: 1px solid var(--border); }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; line-height: 1.3; margin-bottom: 8px; }
.card-loc { font-size: 13px; color: var(--text-2); display: flex; gap: 6px; align-items: center; }
.card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; gap: 12px; }
.info-row { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--text-1); }
.info-icon { width: 24px; height: 24px; background: var(--brand-light); color: var(--brand); border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 12px;}
.card-footer { padding: 16px 20px; background: #f8fafc; border-top: 1px solid var(--border); }
.btn-view { width: 100%; text-align: center; padding: 12px; background: var(--brand); color: white; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; transition: 0.2s;}
.btn-view:hover { background: #1e3a8a; }

/* Modal */
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15,23,42,.6); display: none; align-items: center; justify-content: center; z-index: 1000; padding: 20px;}
.modal-overlay.active { display: flex; }
.modal-content { background: #fff; border-radius: 16px; width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; position:relative; display: flex; flex-direction: column;}
.modal-header { padding: 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: flex-start; background: #f8fafc; border-radius: 16px 16px 0 0;}
.modal-close { background: none; border: none; font-size: 28px; cursor: pointer; color: var(--text-3); line-height: 1;}
.modal-body { padding: 24px; }
.section-tab { padding: 16px; border: 1px solid var(--border); border-radius: 12px; margin-bottom: 16px; }
.section-tab h3 { font-family: 'Sora', sans-serif; font-size: 16px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; color: var(--brand); }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-colleges">
    <div class="container">
        <h1>Top Engineering Colleges</h1>
        <p>Discover premier engineering institutes across Maharashtra. Filter by your preferred district, college type, and branches to find your perfect academic home.</p>
    </div>
</section>

<div class="container">
    <!-- Filter Section (Floating) -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search College</label>
            <input type="text" id="filterSearch" placeholder="E.g. IIT Bombay, DJ Sanghvi...">
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="filterLoc">
                <option value="">Overall Maharashtra</option>
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
    </div>

    <!-- Highlights Top 10 -->
    <div style="margin-top: 60px;" id="highlightSection">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="font-family:'Sora'; font-size:24px;">🏆 Overall Top 10 in Maharashtra</h2>
        </div>
        <div class="top10-wrapper">
            @foreach($colleges->whereNotNull('rank')->sortBy('rank')->take(10) as $topCol)
            <div class="top10-card" onclick="openDetails({{ $topCol->id }})">
                <div class="rank-badge">#{{ $topCol->rank }}</div>
                <h3 style="font-family:'Sora'; font-size:16px; margin-top:12px; margin-bottom:8px;">{{ $topCol->name }}</h3>
                <div style="color:var(--text-2); font-size:13px;"><i class="fa-solid fa-location-dot"></i> {{ $topCol->location }}</div>
                <div style="margin-top: auto; padding-top:16px; font-size:13px; color:var(--brand); font-weight:600;">View Details &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- All Colleges Grid -->
    <div style="margin-top: 60px;">
        <h2 style="font-family:'Sora'; font-size:24px; margin-bottom:8px;" id="gridTitle">All Engineering Colleges</h2>
        <p style="color:var(--text-2); margin-bottom: 24px;" id="gridSub">Showing <span id="count">0</span> colleges based on your filters.</p>
        
        <div id="noResults" style="display:none; text-align:center; padding: 40px; background:var(--surface); border-radius:16px;">
            <i class="fa-solid fa-folder-open fa-3x" style="color:var(--border); margin-bottom:16px;"></i>
            <h3>No colleges found</h3>
            <p>Try adjusting your search or filters.</p>
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
                <span id="mType" style="display:inline-block; padding:2px 10px; background:#e2e8f0; border-radius:12px; font-size:12px; font-weight:600; margin-bottom:8px;">Type</span>
                <h2 id="mName" style="font-family:'Sora'; font-size:24px; line-height:1.2; margin-bottom:4px;">College Name</h2>
                <div style="color:var(--text-2); font-size:14px;"><i class="fa-solid fa-map-marker-alt"></i> <span id="mLoc">Location</span></div>
            </div>
            <button class="modal-close" onclick="closeModal(event)">&times;</button>
        </div>
        <div class="modal-body">
            <div class="section-tab">
                <h3><i class="fa-solid fa-circle-info"></i> Overview</h3>
                <p id="mDesc" style="font-size:14px; line-height:1.6; color:var(--text-1);">Description</p>
            </div>
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-book-open"></i> Popular Branches</h3>
                    <p id="mBranches" style="font-size:14px; font-weight:500;">Branches</p>
                </div>
                <div class="section-tab" style="margin:0;">
                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> Fees Structure</h3>
                    <p id="mFees" style="font-size:14px; font-weight:500;">Fees</p>
                </div>
            </div>

            <div class="section-tab">
                <h3><i class="fa-solid fa-clipboard-check"></i> Admission & Cutoff</h3>
                <p id="mCutoff" style="font-size:14px;">Cutoff details</p>
            </div>

            <div class="section-tab">
                <h3><i class="fa-solid fa-building-columns"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px;">Facilities</p>
            </div>

            <div class="section-tab">
                <h3><i class="fa-solid fa-briefcase"></i> Placement Support</h3>
                <p id="mPlacement" style="font-size:14px;">Placement details</p>
            </div>

            <div style="background:#f0fdf4; border:1px solid #bbf7d0; padding:16px; border-radius:12px; color:#166534;">
                <h3 style="font-family:'Sora'; font-size:16px; margin-bottom:8px; display:flex; align-items:center; gap:8px;"><i class="fa-solid fa-star"></i> Why Choose This College?</h3>
                <p style="font-size:14px;">This institute provides a rigorous academic environment backed by excellent infrastructure and strong industry connections, ensuring graduates are completely industry-ready.</p>
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
            
            let rankHtml = c.rank ? `<span style="font-size:12px; background:#fef08a; color:#854d0e; padding:2px 8px; border-radius:12px; font-weight:700; margin-left:auto;">Top 10</span>` : '';

            card.innerHTML = `
                <div class="card-header">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                        <span style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:var(--brand); font-weight:700;">${c.type}</span>
                        ${rankHtml}
                    </div>
                    <div class="card-title">${c.name}</div>
                    <div class="card-loc"><i class="fa-solid fa-location-dot"></i> ${c.location}, ${c.state}</div>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-code-branch"></i></div>
                        <div><strong>Branches:</strong> ${c.popular_branches}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
                        <div><strong>Fees:</strong> ${c.fees_range}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn-view" onclick="openDetails(${c.id})">View Details</button>
                </div>
            `;
            gridContainer.appendChild(card);
        });
    }

    function applyFilters() {
        let q = searchInput.value.toLowerCase();
        let loc = locInput.value;
        let type = typeInput.value;

        // Hide Top 10 section if any filter is active
        if(q !== '' || loc !== '' || type !== '') {
            highlightSection.style.display = 'none';
        } else {
            highlightSection.style.display = 'block';
        }

        let filtered = collegesData.filter(c => {
            let matchQ = c.name.toLowerCase().includes(q) || (c.description && c.description.toLowerCase().includes(q));
            let matchLoc = loc === "" || c.location === loc;
            let matchType = type === "" || c.type === type;
            return matchQ && matchLoc && matchType;
        });

        renderCards(filtered);
    }

    // Event Listeners
    searchInput.addEventListener('input', applyFilters);
    locInput.addEventListener('change', applyFilters);
    typeInput.addEventListener('change', applyFilters);

    // Initial Render
    renderCards(collegesData);

    // Modal Logic
    function openDetails(id) {
        const c = collegesData.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = `${c.location}, ${c.state}`;
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mBranches').textContent = c.popular_branches;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mCutoff').textContent = c.cutoff;
        document.getElementById('mFacilities').textContent = c.facilities;
        document.getElementById('mPlacement').textContent = c.placement_support;

        document.getElementById('collegeModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeModal(e) {
        if(e.target === document.getElementById('collegeModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('collegeModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

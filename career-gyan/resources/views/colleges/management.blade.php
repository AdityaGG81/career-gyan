@extends('layouts.app')

@section('title', 'Top Management Colleges in Maharashtra (MBA/BBA/PGDM)')

@section('styles')
<style>
/* ─── Management Specific Styles ─── */
.hero-mgmt { padding: 80px 0; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; text-align: center; }
.hero-mgmt h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-mgmt p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* District Sections */
.district-section { margin-top: 50px; }
.district-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #1e3a8a; border-bottom: 2px solid #3b82f6; display: inline-block; padding-bottom: 5px; margin-bottom: 24px; }

/* College Cards */
.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px; }
.mgmt-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.mgmt-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); border-color: #3b82f6; }
.card-top { padding: 20px; flex: 1; }
.type-badge { display: inline-block; padding: 2px 10px; background: #eff6ff; color: #2563eb; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 8px; line-height: 1.3; min-height: 48px; }
.card-meta { display: flex; flex-direction: column; gap: 8px; margin-top: 15px; border-top: 1px solid #f3f4f6; padding-top: 15px; }
.meta-item { display: flex; align-items: flex-start; gap: 8px; font-size: 14px; color: #4b5563; }
.meta-item i { color: #3b82f6; width: 16px; text-align: center; margin-top: 3px; }

.card-footer { padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e5e7eb; }
.btn-view { width: 100%; padding: 12px; background: #1e3a8a; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #1e40af; }

/* Top 10 Highlight */
.horizontal-scroll { display: flex; overflow-x: auto; gap: 20px; padding: 10px 0 30px; scrollbar-width: none; }
.horizontal-scroll::-webkit-scrollbar { display: none; }
.top-card { min-width: 280px; background: white; border-radius: 16px; padding: 20px; position: relative; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); border: 2px solid #dbeafe; transition: 0.3s; cursor: pointer;}
.top-card:hover { border-color: #3b82f6; transform: scale(1.03); }
.rank-pin { position: absolute; top: -10px; left: 20px; background: #1e3a8a; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 12px; }

/* Career Scope */
.scope-container { background: #f1f5f9; border-radius: 20px; padding: 40px; margin-top: 60px; }
.scope-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-top: 30px; }
.scope-item { background: white; padding: 24px; border-radius: 16px; transition: 0.3s; border: 1px solid transparent; }
.scope-item:hover { transform: translateY(-5px); border-color: #3b82f6; }
.scope-item i { font-size: 32px; color: #3b82f6; margin-bottom: 16px; }
.scope-item h4 { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; }
.scope-item p { font-size: 14px; color: #64748b; line-height: 1.5; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 850px; max-height: 90vh; border-radius: 20px; overflow-y: auto; }
.modal-header { padding: 30px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; position: relative; }
.modal-close { position: absolute; top: 20px; right: 20px; font-size: 32px; border: none; background: none; cursor: pointer; color: #64748b; line-height: 1; }
.modal-body { padding: 30px; }
.detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 24px; }
.detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; }
.detail-box h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #1e3a8a; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-mgmt">
    <div class="container">
        <h1>Master Your Corporate Future</h1>
        <p>A career in management is about more than just business—it's about leadership, strategy, and innovation. From world-class MBA/PGDM programs to foundational BBA degrees, find the gateway to the corporate suite here.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Institute</label>
            <input type="text" id="mgmtSearch" placeholder="E.g. IIM Mumbai, SP Jain...">
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="mgmtLoc">
                <option value="">All Maharashtra</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="mgmtType">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Top 10 Highlights -->
    <div style="margin-top: 60px;" id="top10Section">
        <h2 style="font-family:'Sora'; font-size:24px; font-weight:700; margin-bottom:20px;">🎖️ Top Management Schools (Maharashtra)</h2>
        <div class="horizontal-scroll">
            @foreach($colleges->whereNotNull('rank')->sortBy('rank')->take(10) as $c)
            <div class="top-card" onclick="openMgmtDetails({{ $c->id }})">
                <div class="rank-pin">Rank #{{ $c->rank }}</div>
                <h3 style="font-family:'Sora'; font-size:16px; margin: 15px 0 10px; min-height:40px;">{{ $c->name }}</h3>
                <div style="font-size:13px; color:#64748b; display:flex; align-items:center; gap:5px;">
                    <i class="fa-solid fa-location-dot"></i> {{ $c->location }}
                </div>
                <div style="margin-top: 15px; font-size:13px; font-weight:700; color:#3b82f6;">View Details &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- District-wise Results Area -->
    <div id="resultsArea">
        @foreach($districts as $loc)
            @php $locColleges = $colleges->where('location', $loc); @endphp
            @if($locColleges->count() > 0)
                <div class="district-section" data-loc="{{ $loc }}">
                    <h2 class="district-title"><i class="fa-solid fa-map-pin"></i> {{ $loc }} District</h2>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="mgmt-card" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}" data-type="{{ $c->type }}">
                                <div class="card-top">
                                    <div class="type-badge">{{ $c->type }}</div>
                                    <h3 class="card-title">{{ $c->name }}</h3>
                                    
                                    <div class="card-meta">
                                        <div class="meta-item">
                                            <i class="fa-solid fa-chart-line"></i>
                                            <div><strong>Avg Package:</strong> {{ $c->average_package }}</div>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                            <div><strong>Courses:</strong> MBA, PGDM, BBA</div>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fa-solid fa-check-circle"></i>
                                            <div><strong>Entrance:</strong> {{ $c->cutoff }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-view" onclick="openMgmtDetails({{ $c->id }})">View Profile</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 80px 0;">
        <i class="fa-solid fa-magnifying-glass fa-3x" style="color:#cbd5e1; margin-bottom:20px;"></i>
        <h3>No schools matched your filters</h3>
        <p>Try clearing some criteria or changing the location.</p>
    </div>

    <!-- Career Scope Section -->
    <div class="scope-container">
        <h2 style="font-family:'Sora'; font-size:24px; text-align:center;">🚀 Career Scope & Opportunities</h2>
        <p style="text-align:center; color:#64748b; margin-top:10px;">The management degree is a passport to various high-impact sectors.</p>
        
        <div class="scope-grid">
            <div class="scope-item">
                <i class="fa-solid fa-building-user"></i>
                <h4>Corporate Strategy</h4>
                <p>Shape the future of multinational companies through strategic planning and executive leadership.</p>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-rocket"></i>
                <h4>Entrepreneurship</h4>
                <p>Equip yourself with the skills to launch and scale your own startup in the competitive Indian market.</p>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-handshake"></i>
                <h4>Consulting</h4>
                <p>Work with top firms (MBB) to solve complex business problems for diversified clients globally.</p>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-landmark"></i>
                <h4>Fin-Tech & Banking</h4>
                <p>Dominate the financial sector, managing investments, risk, and innovation in top global banks.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="mgmtModal" onclick="closeMgmtModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeMgmtModal(event)">&times;</button>
            <div id="mType" style="font-size:11px; font-weight:700; text-transform:uppercase; color:#3b82f6; margin-bottom:8px;">TYPE</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:26px; color:#1e3a8a; line-height:1.2;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div class="detail-box" style="margin-bottom:24px;">
                <h3><i class="fa-solid fa-quote-left"></i> About the Institute</h3>
                <p id="mDesc" style="font-size:14px; color:#475569; line-height:1.6;"></p>
            </div>

            <div class="detail-grid">
                <div class="detail-box">
                    <h3><i class="fa-solid fa-money-bill-trend-up"></i> Average Salary</h3>
                    <p id="mAvg" style="font-size:18px; font-weight:700; color:#16a34a;"></p>
                </div>
                <div class="detail-box">
                    <h3><i class="fa-solid fa-wallet"></i> Total Course Fees</h3>
                    <p id="mFees" style="font-size:15px; font-weight:600;"></p>
                </div>
            </div>

            <div class="detail-box" style="margin-bottom:20px;">
                <h3><i class="fa-solid fa-star"></i> Specializations</h3>
                <p id="mSpecs" style="font-size:14px; font-weight:600;"></p>
            </div>

            <div class="detail-box" style="margin-bottom:20px;">
                <h3><i class="fa-solid fa-clipboard-list"></i> Admission Entrance Exams</h3>
                <p id="mAdmission" style="font-size:14px; color:#334155; font-weight:600;"></p>
            </div>

            <div class="detail-box" style="margin-bottom:20px;">
                <h3><i class="fa-solid fa-building-columns"></i> Top Recruiting Partners</h3>
                <p id="mRecruiters" style="font-size:14px; line-height:1.5; color:#475569;"></p>
            </div>

            <div class="detail-box">
                <h3><i class="fa-solid fa-chalkboard-user"></i> Campus & Learning Facilities</h3>
                <p id="mFacilities" style="font-size:14px; color:#475569;"></p>
            </div>

            <div style="margin-top:24px; padding:20px; background:#eff6ff; border-radius:12px; border-left:5px solid #2563eb;">
                <h4 style="font-family:'Sora'; font-size:16px; color:#1e3a8a; margin-bottom:8px;">Why Choose This B-School?</h4>
                <p style="font-size:13px; color:#475569; line-height:1.5;">This institute is renowned for its intense industrial interface, globally recognized faculty, and rigorous case-study methodology that prepares students for the highest levels of professional achievement.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const mgmtColleges = @json($colleges);

    const mSearch = document.getElementById('mgmtSearch');
    const mLoc = document.getElementById('mgmtLoc');
    const mType = document.getElementById('mgmtType');
    const top10Sec = document.getElementById('top10Section');
    const dSections = document.querySelectorAll('.district-section');

    function filterMgmt() {
        let q = mSearch.value.toLowerCase();
        let loc = mLoc.value;
        let type = mType.value;

        let totalVisible = 0;

        // Toggle Top 10
        if(q !== '' || loc !== '' || type !== '') {
            top10Sec.style.display = 'none';
        } else {
            top10Sec.style.display = 'block';
        }

        dSections.forEach(sec => {
            let sectionVisibleCount = 0;
            let dLoc = sec.getAttribute('data-loc');
            let cards = sec.querySelectorAll('.mgmt-card');

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let cType = card.getAttribute('data-type');

                let matchQ = name.includes(q);
                let matchLoc = loc === '' || dLoc === loc;
                let matchType = type === '' || cType === type;

                if(matchQ && matchLoc && matchType) {
                    card.style.display = 'flex';
                    sectionVisibleCount++;
                    totalVisible++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = sectionVisibleCount > 0 ? 'block' : 'none';
        });

        document.getElementById('noResults').style.display = totalVisible === 0 ? 'block' : 'none';
    }

    mSearch.addEventListener('input', filterMgmt);
    mLoc.addEventListener('change', filterMgmt);
    mType.addEventListener('change', filterMgmt);

    function openMgmtDetails(id) {
        const c = mgmtColleges.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location;
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mAvg').textContent = c.average_package;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mSpecs').textContent = c.specializations;
        document.getElementById('mAdmission').textContent = c.cutoff;
        document.getElementById('mRecruiters').textContent = c.placement_support;
        document.getElementById('mFacilities').textContent = c.facilities;

        document.getElementById('mgmtModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeMgmtModal(e) {
        if(e.target === document.getElementById('mgmtModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('mgmtModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

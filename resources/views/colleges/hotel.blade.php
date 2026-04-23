@extends('layouts.app')

@section('title', 'Top Hotel Management Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Hotel Management Specific Styles ─── */
.hero-hotel { padding: 80px 0; background: linear-gradient(135deg, #b45309 0%, #d97706 100%); color: white; text-align: center; }
.hero-hotel h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-hotel p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* Tier Sections */
.tier-section { margin-top: 60px; }
.tier-header { border-left: 5px solid #d97706; padding-left: 15px; margin-bottom: 24px; }
.tier-header h2 { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; color: #92400e; }
.tier-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;}
.badge-t1 { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
.badge-t2 { background: #ecfeff; color: #0891b2; border: 1px solid #cffafe; }
.badge-t3 { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }

/* Cards */
.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.hotel-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; position: relative; }
.hotel-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); border-color: #d97706; }
.card-top { padding: 20px; flex: 1; }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #451a03; margin-bottom: 4px; line-height: 1.3; }
.card-location { font-size: 13px; color: #6b7280; display: flex; align-items: center; gap: 4px; margin-bottom: 12px; }
.card-info { font-size: 14px; color: #374151; display: grid; grid-template-columns: 24px 1fr; gap: 8px; margin-bottom: 10px; }
.card-info i { color: #d97706; text-align: center; padding-top: 2px; }

.card-footer { padding: 16px 20px; background: #fffbeb; border-top: 1px solid #fde68a; }
.btn-hotel { width: 100%; padding: 12px; background: #d97706; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-hotel:hover { background: #b45309; }

/* Featured Section */
.featured-scroll { display: flex; overflow-x: auto; gap: 20px; padding: 20px 0; scrollbar-width: none; }
.featured-scroll::-webkit-scrollbar { display: none; }
.featured-card { min-width: 300px; background: white; border: 2px solid #fde68a; border-radius: 20px; padding: 24px; text-align: center; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); cursor: pointer; transition: 0.3s; }
.featured-card:hover { border-color: #d97706; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); scale: 1.02; }

/* Career Scope */
.scope-box { background: #fafafa; border: 1px solid #e5e7eb; border-radius: 16px; padding: 30px; margin-top: 60px; }
.scope-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
.scope-item { background: white; padding: 20px; border-radius: 12px; text-align: center; border: 1px solid #f3f4f6; }
.scope-item i { font-size: 24px; color: #d97706; margin-bottom: 12px; display: block; }
.scope-item h4 { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: #1f2937; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 800px; max-height: 90vh; border-radius: 20px; overflow-y: auto; position: relative; }
.modal-header { padding: 30px; background: #fffbeb; border-bottom: 1px solid #fde68a; position: relative; }
.modal-close { position: absolute; top: 20px; right: 20px; font-size: 30px; border: none; background: none; cursor: pointer; color: #92400e; }
.modal-body { padding: 30px; }
.detail-sec { margin-bottom: 24px; }
.detail-sec h3 { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #92400e; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-hotel">
    <div class="container">
        <h1>Hotel Management Excellence</h1>
        <p>Step into the world of luxury hospitality. From 5-star hotel chains to global event management, a career in Hotel Management offers unparalleled international opportunities and professional growth.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search College</label>
            <input type="text" id="hotelSearch" placeholder="Search by name or city...">
        </div>
        <div class="filter-group">
            <label>Location</label>
            <select id="hotelLoc">
                <option value="">All Maharashtra</option>
                @foreach($locations as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Tier Tiering</label>
            <select id="hotelTier">
                <option value="">All Tiers</option>
                @foreach($tiers as $tier)
                    <option value="{{ $tier }}">{{ $tier }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Featured Section -->
    <div style="margin-top: 60px;" id="featuredSec">
        <h2 style="font-family:'Sora'; font-size:24px; color:#451a03; margin-bottom:20px;">🎖️ Featured & Top Ranked</h2>
        <div class="featured-scroll">
            @foreach($colleges->whereNotNull('rank')->sortBy('rank') as $c)
            <div class="featured-card" onclick="openHotelDetails({{ $c->id }})">
                <div class="badge-t1 tier-badge">Rank #{{ $c->rank }}</div>
                <h3 style="font-family:'Sora'; font-size:16px; margin: 12px 0;">{{ $c->name }}</h3>
                <p style="font-size:13px; color:#6b7280; font-weight:600;"><i class="fa-solid fa-hotel"></i> Premium Campus</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Tier-based Grid -->
    <div id="resultsArea">
        @foreach(['Tier 1', 'Tier 2', 'Tier 3'] as $currentTier)
            @php 
                $tierColleges = $colleges->where('tier', $currentTier);
                $badgeClass = ($currentTier == 'Tier 1') ? 'badge-t1' : (($currentTier == 'Tier 2') ? 'badge-t2' : 'badge-t3');
                $title = ($currentTier == 'Tier 1') ? '⭐ Tier 1 (Premier Institutions)' : (($currentTier == 'Tier 2') ? '⭐ Tier 2 (Highly Recommended)' : '⭐ Tier 3 (Reputed Private Colleges)');
            @endphp
            
            <div class="tier-section" id="section-{{ str_replace(' ', '', $currentTier) }}">
                <div class="tier-header">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="college-grid">
                    @foreach($tierColleges as $c)
                        <div class="hotel-card" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}" data-tier="{{ $c->tier }}">
                            <div class="card-top">
                                <div class="{{ $badgeClass }} tier-badge">{{ $c->tier }}</div>
                                <h3 class="card-title">{{ $c->name }}</h3>
                                <div class="card-location"><i class="fa-solid fa-location-dot"></i> {{ $c->location }}, Maharashtra</div>
                                
                                <div class="card-info">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <div><strong>Courses:</strong> BHM, B.Sc Hospitality</div>
                                </div>
                                <div class="card-info">
                                    <i class="fa-solid fa-check-double"></i>
                                    <div><strong>Admission:</strong> {{ $c->cutoff }}</div>
                                </div>
                                <div class="card-info">
                                    <i class="fa-solid fa-building"></i>
                                    <div><strong>Type:</strong> {{ $c->type }}</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn-hotel" onclick="openHotelDetails({{ $c->id }})">View Program Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div id="noHotelResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-magnifying-glass fa-3x" style="color:#d1d5db; margin-bottom:15px;"></i>
        <h3>No colleges match your search</h3>
        <p>Try different filters or search terms.</p>
    </div>

    <!-- Career Scope -->
    <div class="scope-box">
        <h2 style="font-family:'Sora'; font-size:22px; color:#451a03;">🌍 Global Career Scope</h2>
        <p style="margin-top:8px; color:#4b5563;">Hotel management opens doors to some of the world's most exciting industries.</p>
        <div class="scope-grid">
            <div class="scope-item">
                <i class="fa-solid fa-plane-up"></i>
                <h4>Aviation & Airlines</h4>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-ship"></i>
                <h4>Cruise Liners</h4>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-champagne-glasses"></i>
                <h4>Event Management</h4>
            </div>
            <div class="scope-item">
                <i class="fa-solid fa-earth-americas"></i>
                <h4>International Jobs</h4>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="hotelModal" onclick="closeHotelModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeHotelModal(event)">&times;</button>
            <div id="mTier" style="font-size:11px; font-weight:700; text-transform:uppercase; color:#d97706; margin-bottom:8px;">TIER LEVEL</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:26px; color:#451a03; line-height:1.2;">College Name</h2>
            <div style="margin-top:8px; color:#6b7280;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span></div>
        </div>
        <div class="modal-body">
            <div class="detail-sec">
                <h3><i class="fa-solid fa-circle-info"></i> Overview</h3>
                <p id="mDesc" style="font-size:14px; color:#374151; line-height:1.6;"></p>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-clock"></i> Duration</h3>
                    <p id="mDuration" style="font-size:15px; font-weight:600;"></p>
                </div>
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> Annual Fees</h3>
                    <p id="mFees" style="font-size:15px; font-weight:600;"></p>
                </div>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-briefcase"></i> Key Recruiters</h3>
                <p id="mPlacement" style="font-size:14px; background:#fffbeb; padding:12px; border-radius:8px; border:1px solid #fde68a;"></p>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-plane-departure"></i> Internship Opportunities</h3>
                <p id="mIntern" style="font-size:14px;"></p>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-utensils"></i> Campus Facilities</h3>
                <p id="mFacilities" style="font-size:14px; color:#4b5563;"></p>
            </div>

            <div style="background:#fdf2f8; border:1px solid #fbcfe8; padding:20px; border-radius:12px; margin-top:20px;">
                <h4 style="font-family:'Sora'; color:#9d174d; margin-bottom:10px;">🎓 Career Path After Graduation</h4>
                <p style="font-size:13px; line-height:1.5;">Graduates from this institute are prepared for managerial roles in luxury hotel chains, luxury boutiques, food startups, and high-end event planning organizations both in India and abroad.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const hotelColleges = @json($colleges);

    const hSearch = document.getElementById('hotelSearch');
    const hLoc = document.getElementById('hotelLoc');
    const hTier = document.getElementById('hotelTier');
    const featuredSec = document.getElementById('featuredSec');
    const cards = document.querySelectorAll('.hotel-card');
    const sections = document.querySelectorAll('.tier-section');

    function filterHotels() {
        let q = hSearch.value.toLowerCase();
        let loc = hLoc.value;
        let tier = hTier.value;

        let visibleTotal = 0;

        // Hide featured section if any filter is active
        if(q !== '' || loc !== '' || tier !== '') {
            featuredSec.style.display = 'none';
        } else {
            featuredSec.style.display = 'block';
        }

        sections.forEach(sec => {
            let sectionVisibleCount = 0;
            let secCards = sec.querySelectorAll('.hotel-card');
            
            secCards.forEach(card => {
                let name = card.getAttribute('data-name');
                let cardLoc = card.getAttribute('data-loc');
                let cardTier = card.getAttribute('data-tier');

                let matchQ = name.includes(q);
                let matchLoc = loc === '' || cardLoc === loc;
                let matchTier = tier === '' || cardTier === tier;

                if(matchQ && matchLoc && matchTier) {
                    card.style.display = 'flex';
                    sectionVisibleCount++;
                    visibleTotal++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = sectionVisibleCount > 0 ? 'block' : 'none';
        });

        document.getElementById('noHotelResults').style.display = visibleTotal === 0 ? 'block' : 'none';
    }

    hSearch.addEventListener('input', filterHotels);
    hLoc.addEventListener('change', filterHotels);
    hTier.addEventListener('change', filterHotels);

    function openHotelDetails(id) {
        const c = hotelColleges.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location + ', Maharashtra';
        document.getElementById('mTier').textContent = c.tier || 'Standard';
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mDuration').textContent = c.duration;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mPlacement').textContent = c.placement_support;
        document.getElementById('mIntern').textContent = c.internship_opportunities;
        document.getElementById('mFacilities').textContent = c.facilities;

        document.getElementById('hotelModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeHotelModal(e) {
        if(e.target === document.getElementById('hotelModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('hotelModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

@extends('layouts.app')

@section('title', 'Top Arts & Humanities Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Arts Specific Styles ─── */
.hero-arts { padding: 80px 0; background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%); color: white; text-align: center; }
.hero-arts h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-arts p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* Elite Section */
.elite-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 60px; }
.elite-card { background: white; border: 1px solid #ddd6fe; border-radius: 20px; padding: 30px; text-align: center; transition: 0.3s; cursor: pointer; position: relative; border-bottom: 4px solid #7c3aed; }
.elite-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px -10px rgba(124, 58, 237, 0.2); }
.elite-card i { color: #7c3aed; margin-bottom: 15px; }

/* District Headers */
.district-div { margin-top: 50px; }
.dist-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #4c1d95; margin-bottom: 24px; border-bottom: 2px solid #ede9fe; padding-bottom: 10px; display: flex; align-items: center; gap: 10px; }

.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.arts-card { background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; }
.arts-card:hover { transform: translateY(-5px); border-color: #7c3aed; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }

.card-top { padding: 24px; flex: 1; }
.arts-tag { display: inline-block; padding: 3px 12px; background: #ede9fe; color: #7c3aed; border-radius: 20px; font-size: 11px; font-weight: 700; margin-bottom: 12px; }
.card-name { font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 700; color: #1e293b; margin-bottom: 10px; line-height: 1.3; }
.card-meta { display: flex; flex-direction: column; gap: 8px; margin-top: 15px; }
.meta-row { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #475569; }
.meta-row i { color: #8b5cf6; width: 16px; }

.card-footer { padding: 16px 24px; background: #fdfaff; border-top: 1px solid #ede9fe; }
.btn-view { width: 100%; padding: 12px; background: #7c3aed; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #6d28d9; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 800px; max-height: 90vh; border-radius: 24px; overflow-y: auto; }
.modal-header { padding: 40px; background: #fdfaff; border-bottom: 1px solid #ede9fe; position: relative; }
.modal-close { position: absolute; top: 25px; right: 25px; border: none; background: none; font-size: 32px; color: #7c3aed; cursor: pointer; }
.modal-body { padding: 40px; }

.detail-sec { background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 12px; padding: 20px; margin-bottom: 24px; }
.detail-sec h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #4c1d95; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-arts">
    <div class="container">
        <h1>Voice of Culture & Society</h1>
        <p>From social sciences to liberal arts, explore Maharashtra's most prestigious institutions that foster critical thinking, creativity, and leadership for a globalized world.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Arts College</label>
            <input type="text" id="artsSearch" placeholder="Search by name...">
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="artsLoc">
                <option value="">All Maharashtra</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="artsType">
                <option value="">All Types</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <!-- Elite Institutes -->
    <div id="eliteArea">
        <h2 style="font-family:'Sora'; color:#4c1d95; text-align:center; margin-top:60px;">🏛️ Top Humanities Institutes</h2>
        <div class="elite-grid">
            @foreach($colleges->where('rank', 1) as $c)
            <div class="elite-card" onclick="openArtsDetails({{ $c->id }})">
                <i class="fa-solid fa-building-columns fa-2x"></i>
                <h3 style="font-family:'Sora'; font-size:16px;">{{ $c->name }}</h3>
                <p style="font-size:12px; color:#64748b; margin-top:8px;">{{ $c->location }}, Maharashtra</p>
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
                        <i class="fa-solid fa-landmark-dome"></i> {{ $loc }} District
                    </div>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="arts-card" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}" data-type="{{ $c->type }}">
                                <div class="card-top">
                                    <span class="arts-tag">Humanities & Arts</span>
                                    <h3 class="card-name">{{ $c->name }}</h3>
                                    <div class="card-meta">
                                        <div class="meta-row"><i class="fa-solid fa-book"></i> {{ $c->popular_branches }}</div>
                                        <div class="meta-row"><i class="fa-solid fa-id-card"></i> {{ $c->cutoff }}</div>
                                        <div class="meta-row"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $c->fees_range }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-view" onclick="openArtsDetails({{ $c->id }})">View Profile</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-palette fa-3x" style="color:#d1d5db; margin-bottom:15px;"></i>
        <h3>No colleges found</h3>
        <p>Try searching for a different district or name.</p>
    </div>

    <!-- Career Scope Section -->
    <section style="margin-top: 80px; padding: 60px; background: #fdfaff; border-radius: 30px; text-align:center; border: 1px solid #ede9fe;">
        <h2 style="font-family:'Sora'; color:#4c1d95;">✨ The Impact of Humanities</h2>
        <p style="color:#64748b; max-width:700px; margin: 15px auto 40px;">Arts students shape the future of governance, media, and social systems. Here are the leading career paths:</p>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:30px;">
            <div>
                <i class="fa-solid fa-user-tie fa-2x" style="color:#8b5cf6;"></i>
                <h4 style="margin-top:10px;">CS / IAS / Govt Service</h4>
            </div>
            <div>
                <i class="fa-solid fa-newspaper fa-2x" style="color:#8b5cf6;"></i>
                <h4 style="margin-top:10px;">Journalism & Media</h4>
            </div>
            <div>
                <i class="fa-solid fa-handshake-angle fa-2x" style="color:#8b5cf6;"></i>
                <h4 style="margin-top:10px;">Social Work & NGOs</h4>
            </div>
            <div>
                <i class="fa-solid fa-pen-nib fa-2x" style="color:#8b5cf6;"></i>
                <h4 style="margin-top:10px;">Content & Research</h4>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal-overlay" id="artsModal" onclick="closeArtsModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closeArtsModal(event)">&times;</button>
            <div id="mType" style="font-size:11px; font-weight:700; color:#7c3aed; text-transform:uppercase; margin-bottom:10px;">TYPE</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:26px; color:#1e293b;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div class="detail-sec">
                <h3><i class="fa-solid fa-info-circle"></i> About the Institution</h3>
                <p id="mDesc" style="font-size:14px; color:#475569; line-height:1.6;"></p>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-graduation-cap"></i> Courses</h3>
                    <p id="mCourses" style="font-size:14px; font-weight:600;"></p>
                </div>
                <div class="detail-sec">
                    <h3><i class="fa-solid fa-wallet"></i> Fee Range</h3>
                    <p id="mFees" style="font-size:14px; font-weight:600;"></p>
                </div>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-chalkboard-user"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px; color:#4b5563;"></p>
            </div>

            <div class="detail-sec">
                <h3><i class="fa-solid fa-briefcase"></i> Career Support & Internships</h3>
                <p id="mPlacement" style="font-size:14px;"></p>
            </div>

            <div style="background:#f5f3ff; border-radius:12px; padding:20px; border-left:4px solid #7c3aed;">
                <h4 style="font-family:'Sora'; font-size:16px; color:#5b21b6; margin-bottom:5px;">💡 Why Choose This College?</h4>
                <p style="font-size:13px; line-height:1.5;">This institute combines a rich cultural heritage with a modern academic approach, empowering students to build successful careers in social sciences, public policy, and creative industries.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const artsColleges = @json($colleges);

    const aInp = document.getElementById('artsSearch');
    const aLoc = document.getElementById('artsLoc');
    const aType = document.getElementById('artsType');
    const sections = document.querySelectorAll('.district-div');
    const eliteArea = document.getElementById('eliteArea');

    function filterArts() {
        let q = aInp.value.toLowerCase();
        let loc = aLoc.value;
        let type = aType.value;

        let totalVis = 0;

        if(q !== '' || loc !== '' || type !== '') {
            eliteArea.style.display = 'none';
        } else {
            eliteArea.style.display = 'block';
        }

        sections.forEach(sec => {
            let secLoc = sec.getAttribute('data-loc');
            let visInSec = 0;
            let cards = sec.querySelectorAll('.arts-card');

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

        document.getElementById('noResults').style.display = totalVis === 0 && eliteArea.style.display === 'none' ? 'block' : 'none';
    }

    aInp.addEventListener('input', filterArts);
    aLoc.addEventListener('change', filterArts);
    aType.addEventListener('change', filterArts);

    function openArtsDetails(id) {
        const c = artsColleges.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location;
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mCourses').textContent = c.popular_branches;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mFacilities').textContent = c.facilities;
        document.getElementById('mPlacement').textContent = c.placement_support;

        document.getElementById('artsModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeArtsModal(e) {
        if(e.target === document.getElementById('artsModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('artsModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

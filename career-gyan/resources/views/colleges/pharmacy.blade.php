@extends('layouts.app')

@section('title', 'Top Pharmacy Colleges in Maharashtra (B.Pharm / D.Pharm)')

@section('styles')
<style>
/* ─── Pharmacy Specific Styles ─── */
.hero-pharma { padding: 80px 0; background: linear-gradient(135deg, #be185d 0%, #db2777 100%); color: white; text-align: center; }
.hero-pharma h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-pharma p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 20px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-top: -30px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 16px; border: 1px solid var(--border);}
.filter-group { flex: 1; min-width: 200px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid var(--border); padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; background: var(--surface); }

/* District Title */
.district-header { margin-top: 50px; margin-bottom: 24px; padding-bottom: 10px; border-bottom: 2px solid #fce7f3; display: flex; align-items: center; gap: 10px; }
.district-header h2 { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #9d174d; }

/* College Grid */
.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px; }
.pharma-card { background: white; border: 1px solid #fbcfe8; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; position: relative; cursor: default;}
.pharma-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px -5px rgba(219, 39, 119, 0.1); border-color: #db2777; }
.card-top { padding: 20px; flex: 1; }
.type-lbl { font-size: 11px; font-weight: 700; color: #db2777; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: block; }
.card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: #1e293b; line-height: 1.3; margin-bottom: 12px; }
.card-tag { display: flex; align-items: center; gap: 6px; font-size: 13px; color: #64748b; margin-bottom: 8px; }
.card-tag i { color: #f472b6; width: 16px; }

.card-footer { padding: 16px 20px; background: #fff1f2; border-top: 1px solid #fbcfe8; }
.btn-view { width: 100%; padding: 12px; background: #db2777; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-view:hover { background: #be185d; }

/* Top Highlight */
.featured-row { display: flex; overflow-x: auto; gap: 20px; padding: 10px 0 30px; scrollbar-width: none; }
.featured-row::-webkit-scrollbar { display: none; }
.top-col-card { min-width: 290px; background: white; border: 2px solid #fce7f3; border-radius: 20px; padding: 24px; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.03); cursor: pointer; transition: 0.3s; }
.top-col-card:hover { transform: scale(1.02); border-color: #db2777; }
.badge-rank { position: absolute; top: -10px; left: 24px; background: #9d174d; color: white; padding: 3px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-overlay.active { display: flex; }
.modal-content { background: white; width: 100%; max-width: 800px; max-height: 90vh; border-radius: 20px; overflow-y: auto; position: relative; }
.modal-header { padding: 30px; background: #fff1f2; border-bottom: 1px solid #fbcfe8; }
.modal-close { position: absolute; top: 20px; right: 20px; font-size: 28px; border: none; background: none; cursor: pointer; color: #be185d; }
.modal-body { padding: 30px; }
.section-lab { background: #fdf2f8; border: 1px solid #f9a8d4; border-radius: 12px; padding: 20px; margin-bottom: 24px; }
.section-lab h3 { font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #9d174d; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-pharma">
    <div class="container">
        <h1>Foundation of Future Medicines</h1>
        <p>Pharmacy is at the heart of the healthcare revolution. From drug discovery to patient care, explore top B.Pharm and D.Pharm institutes in Maharashtra that are shaping the next generation of pharmaceutical professionals.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search Pharmacy College</label>
            <input type="text" id="pharmaSearch" placeholder="Search by name...">
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="pharmaLoc">
                <option value="">All Maharashtra</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Course Interest</label>
            <select id="pharmaCourse">
                <option value="">All Courses</option>
                <option value="B.Pharm">B.Pharm (Bachelor)</option>
                <option value="D.Pharm">D.Pharm (Diploma)</option>
            </select>
        </div>
    </div>

    <!-- Top 10 Highlighting -->
    <div style="margin-top: 60px;" id="highlightArea">
        <h2 style="font-family:'Sora'; font-size:24px; color:#9d174d; margin-bottom:20px;">🏆 Top Pharmacy Institutes</h2>
        <div class="featured-row">
            @foreach($colleges->whereNotNull('rank')->sortBy('rank')->take(10) as $c)
            <div class="top-col-card" onclick="openPharmaDetails({{ $c->id }})">
                <div class="badge-rank">Rank #{{ $c->rank }}</div>
                <h3 style="font-family:'Sora'; font-size:16px; margin: 12px 0 8px; min-height:42px;">{{ $c->name }}</h3>
                <div style="font-size:13px; color:#64748b; font-weight:600;"><i class="fa-solid fa-flask"></i> Premier Research Hub</div>
                <div style="margin-top: 15px; font-size:13px; color:#db2777; font-weight:700;">View Profile &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- District-wise Grid -->
    <div id="resultsArea">
        @foreach($districts as $loc)
            @php $locColleges = $colleges->where('location', $loc); @endphp
            @if($locColleges->count() > 0)
                <div class="district-section" data-loc="{{ $loc }}">
                    <div class="district-header">
                        <h2><i class="fa-solid fa-map-marker-alt"></i> {{ $loc }} District</h2>
                    </div>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="pharma-card" data-name="{{ strtolower($c->name) }}" data-loc="{{ $c->location }}">
                                <div class="card-top">
                                    <span class="type-lbl">{{ $c->type }}</span>
                                    <h3 class="card-title">{{ $c->name }}</h3>
                                    
                                    <div class="card-tag">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        <div>{{ $c->popular_branches }}</div>
                                    </div>
                                    <div class="card-tag">
                                        <i class="fa-solid fa-vial-circle-check"></i>
                                        <div>Admission: {{ $c->cutoff }}</div>
                                    </div>
                                    <div class="card-tag">
                                        <i class="fa-solid fa-hospital"></i>
                                        <div>Career: Hospital & Industry</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-view" onclick="openPharmaDetails({{ $c->id }})">View Program & Fees</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noResults" style="display:none; text-align:center; padding: 60px 0;">
        <i class="fa-solid fa-pills fa-3x" style="color:var(--border); margin-bottom:15px;"></i>
        <h3>No pharmacy colleges found</h3>
        <p>Try searching for a different district or name.</p>
    </div>

    <!-- Global Scope Section -->
    <section style="margin-top: 80px; padding: 40px; background: #fff1f2; border-radius: 20px; border: 1px solid #fbcfe8;">
        <h2 style="font-family:'Sora'; text-align:center; color:#9d174d;">💡 Career Opportunities in Pharmacy</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:20px; margin-top:30px; text-align:center;">
            <div>
                <i class="fa-solid fa-flask-vial fa-2x" style="color:#db2777;"></i>
                <h4 style="margin-top:10px;">Drug R&D</h4>
            </div>
            <div>
                <i class="fa-solid fa-industry fa-2x" style="color:#db2777;"></i>
                <h4 style="margin-top:10px;">Manufacturing</h4>
            </div>
            <div>
                <i class="fa-solid fa-stethoscope fa-2x" style="color:#db2777;"></i>
                <h4 style="margin-top:10px;">Clinical Pharmacy</h4>
            </div>
            <div>
                <i class="fa-solid fa-clipboard-check fa-2x" style="color:#db2777;"></i>
                <h4 style="margin-top:10px;">Drug Inspection</h4>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal-overlay" id="pharmaModal" onclick="closePharmaModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <button class="modal-close" onclick="closePharmaModal(event)">&times;</button>
            <div id="mType" style="font-size:11px; font-weight:700; color:#db2777; margin-bottom:8px; text-transform:uppercase;">TYPE</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:24px; color:#1e293b; line-height:1.2;">College Name</h2>
            <div style="margin-top:8px; color:#64748b;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
                <div class="section-lab" style="margin-bottom:0;">
                    <h3><i class="fa-solid fa-certificate"></i> Courses</h3>
                    <p id="mDuration" style="font-size:14px; font-weight:600;"></p>
                </div>
                <div class="section-lab" style="margin-bottom:0;">
                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> Annual Fees</h3>
                    <p id="mFees" style="font-size:14px; font-weight:600;"></p>
                </div>
            </div>

            <div class="section-lab">
                <h3><i class="fa-solid fa-microscope"></i> Lab & Research Support</h3>
                <p id="mResearch" style="font-size:14px; line-height:1.5; color:#475569;"></p>
            </div>

            <div class="section-lab">
                <h3><i class="fa-solid fa-briefcase-medical"></i> Placement & Industry Tie-ups</h3>
                <p id="mPlacement" style="font-size:14px;"></p>
            </div>

            <div class="section-lab">
                <h3><i class="fa-solid fa-building-columns"></i> Facilities</h3>
                <p id="mFacilities" style="font-size:14px;"></p>
            </div>

            <div style="background:#fff1f2; padding:20px; border-radius:12px; border-left:4px solid #db2777;">
                <h4 style="font-family:'Sora'; font-size:16px; color:#be185d; margin-bottom:8px;">🎯 Why Choose This Pharmacy College?</h4>
                <p style="font-size:13px; line-height:1.5;">This institute provides an environment that balances rigorous academic learning with practical laboratory experience, ensuring students are well-prepared for drug development and healthcare management roles.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const pharmaColleges = @json($colleges);

    const sInp = document.getElementById('pharmaSearch');
    const sLoc = document.getElementById('pharmaLoc');
    const hlArea = document.getElementById('highlightArea');
    const dSecs = document.querySelectorAll('.district-section');

    function filterPharma() {
        let q = sInp.value.toLowerCase();
        let loc = sLoc.value;

        let totalVis = 0;

        if(q !== '' || loc !== '') {
            hlArea.style.display = 'none';
        } else {
            hlArea.style.display = 'block';
        }

        dSecs.forEach(sec => {
            let visCount = 0;
            let dLoc = sec.getAttribute('data-loc');
            let cards = sec.querySelectorAll('.pharma-card');

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let matchQ = name.includes(q);
                let matchLoc = loc === '' || dLoc === loc;

                if(matchQ && matchLoc) {
                    card.style.display = 'flex';
                    visCount++;
                    totalVis++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = visCount > 0 ? 'block' : 'none';
        });

        document.getElementById('noResults').style.display = totalVis === 0 ? 'block' : 'none';
    }

    sInp.addEventListener('input', filterPharma);
    sLoc.addEventListener('change', filterPharma);

    function openPharmaDetails(id) {
        const c = pharmaColleges.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location;
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mDuration').textContent = c.duration;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mResearch').textContent = c.research_support;
        document.getElementById('mPlacement').textContent = c.placement_support;
        document.getElementById('mFacilities').textContent = c.facilities;

        document.getElementById('pharmaModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closePharmaModal(e) {
        if(e.target === document.getElementById('pharmaModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('pharmaModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

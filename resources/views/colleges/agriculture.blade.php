@extends('layouts.app')

@section('title', 'Top Agriculture Colleges in Maharashtra')

@section('styles')
<style>
/* ─── Agriculture Specific Styles ─── */
.hero-agri { padding: 80px 0; background: linear-gradient(135deg, #166534 0%, #3f6212 100%); color: white; text-align: center; position: relative; overflow: hidden; }
.hero-agri::after { content: ""; position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(to top, rgba(255,255,255,0.1), transparent); }
.hero-agri h1 { font-family: 'Sora', sans-serif; font-weight: 700; font-size: clamp(32px, 5vw, 48px); margin-bottom: 16px; }
.hero-agri p { font-size: 18px; opacity: 0.9; max-width: 800px; margin: 0 auto; }

.filter-container { background: white; padding: 25px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); margin-top: -40px; position: relative; z-index: 10; display: flex; flex-wrap: wrap; gap: 20px; border: 1px solid #d1d5db; }
.filter-group { flex: 1; min-width: 220px; }
.filter-group label { display: block; font-size: 13px; font-weight: 600; color: #4b5563; margin-bottom: 8px; }
.filter-group input, .filter-group select { width: 100%; border: 1px solid #e5e7eb; padding: 12px 16px; border-radius: 10px; font-size: 14px; outline: none; background: #f9fafb; transition: 0.2s; }
.filter-group input:focus { border-color: #16a34a; background: white; }

/* University Section */
.uni-section { margin-top: 60px; }
.uni-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; margin-top: 25px; }
.uni-card { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 24px; padding: 35px; text-align: center; transition: 0.3s; cursor: pointer; border-bottom: 5px solid #16a34a; }
.uni-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(22, 163, 74, 0.1); }
.uni-icon { background: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #16a34a; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }

/* District Flow */
.district-div { margin-top: 50px; }
.dist-header { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; color: #064e3b; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; }
.dist-header i { color: #16a34a; }

.college-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 25px; }
.agri-card { background: white; border: 1px solid #e2e8f0; border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; transition: 0.3s; position: relative; }
.agri-card:hover { transform: translateY(-5px); border-color: #166534; box-shadow: 0 20px 25px -10px rgba(0,0,0,0.1); }

.card-body { padding: 25px; flex: 1; }
.type-badge { display: inline-block; padding: 4px 12px; background: #ecfdf5; color: #166534; font-size: 11px; font-weight: 800; border-radius: 30px; margin-bottom: 15px; }
.card-name { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: #1e293b; line-height: 1.3; margin-bottom: 15px; }
.meta-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.meta-item { display: flex; align-items: center; gap: 12px; font-size: 14px; color: #4b5563; }
.meta-item i { color: #16a34a; width: 18px; text-align: center; }

.card-footer { padding: 20px 25px; background: #f9fafb; border-top: 1px solid #f1f5f9; }
.btn-details { width: 100%; border: none; background: #166534; color: white; padding: 14px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-details:hover { background: #14532d; }

/* Modal */
.modal-bg { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; padding: 20px; align-items: center; justify-content: center; }
.modal-bg.active { display: flex; }
.modal-ui { background: white; width: 100%; max-width: 850px; max-height: 90vh; border-radius: 30px; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
.modal-top { padding: 45px; background: #f0fdf4; border-bottom: 1px solid #dcfce7; position: relative; }
.close-mod { position: absolute; top: 30px; right: 30px; font-size: 24px; cursor: pointer; color: #064e3b; padding: 5px; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: white; }
.modal-data { padding: 45px; }

.data-section { border: 1px solid #f1f5f9; border-radius: 16px; padding: 25px; margin-bottom: 25px; }
.data-section h3 { font-family: 'Sora', sans-serif; font-size: 18px; color: #064e3b; margin-bottom: 12px; display: flex; align-items: center; gap: 10px; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-agri">
    <div class="container">
        <h1>Nurturing the Future of Agriculture</h1>
        <p>From modern agribusiness to high-tech farming research, explore Maharashtra's prestigious agricultural universities and colleges fueling India's green revolution.</p>
    </div>
</section>

<div class="container">
    <!-- Filters -->
    <div class="filter-container">
        <div class="filter-group">
            <label>Search College Name</label>
            <input type="text" id="agriInp" placeholder="Search...">
        </div>
        <div class="filter-group">
            <label>District</label>
            <select id="agriLoc">
                <option value="">All Maharashtra</option>
                @foreach($districts as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>College Type</label>
            <select id="agriType">
                <option value="">All Types</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
    </div>

    <!-- State Universities Highlights -->
    <div id="topHubs" class="uni-section">
        <h2 style="font-family:'Sora'; color:#064e3b; text-align:center;">🏛️ Major Agricultural Universities</h2>
        <div class="uni-grid">
            @foreach($colleges->where('rank', 1) as $c)
            <div class="uni-card" onclick="openAgriDetails({{ $c->id }})">
                <div class="uni-icon"><i class="fa-solid fa-wheat-awn fa-xl"></i></div>
                <h3 style="font-family:'Sora'; font-size:18px; line-height:1.4;">{{ $c->name }}</h3>
                <p style="font-size:12px; color:#166534; font-weight:700; margin-top:10px;">{{ $c->location }}, MH</p>
                <div style="margin-top:15px; font-size:13px; color:#16a34a; font-weight:700;">Explore Specialized Labs &rarr;</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- District Wise -->
    <div id="agriResults">
        @foreach($districts as $loc)
            @php $locColleges = $colleges->where('location', $loc)->where('rank', '!=', 1); @endphp
            @if($locColleges->count() > 0)
                <div class="district-div" data-loc="{{ $loc }}">
                    <div class="dist-header">
                        <i class="fa-solid fa-seedling"></i> {{ $loc }} Region
                    </div>
                    <div class="college-grid">
                        @foreach($locColleges as $c)
                            <div class="agri-card" data-name="{{ strtolower($c->name) }}" data-loc="{{ $loc }}" data-type="{{ $c->type }}">
                                <div class="card-body">
                                    <span class="type-badge">{{ $c->type }}</span>
                                    <h3 class="card-name">{{ $c->name }}</h3>
                                    <ul class="meta-list">
                                        <li class="meta-item"><i class="fa-solid fa-graduation-cap"></i> {{ $c->popular_branches }}</li>
                                        <li class="meta-item"><i class="fa-solid fa-file-signature"></i> {{ $c->cutoff }}</li>
                                        <li class="meta-item"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $c->fees_range }}</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button class="btn-details" onclick="openAgriDetails({{ $c->id }})">View Profile</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div id="noAgriResults" style="display:none; text-align:center; padding: 80px 0;">
        <i class="fa-solid fa-tractor fa-4x" style="color:#d1d5db; margin-bottom:20px;"></i>
        <h3>No agriculture colleges found</h3>
        <p>Try searching for a different district or university name.</p>
    </div>

    <!-- Career Scope -->
    <section style="margin-top: 100px; padding: 60px; background: #f0fdf4; border-radius: 40px; text-align:center; border: 1px solid #dcfce7;">
        <h2 style="font-family:'Sora'; color:#064e3b; margin-bottom:40px;">🌱 Professional Career Scope</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:40px;">
            <div>
                <i class="fa-solid fa-user-shield fa-2x" style="color:#16a34a;"></i>
                <h4 style="margin-top:15px;">Govt Agriculture Officer</h4>
            </div>
            <div>
                <i class="fa-solid fa-vial-virus fa-2x" style="color:#16a34a;"></i>
                <h4 style="margin-top:15px;">Research Scientist</h4>
            </div>
            <div>
                <i class="fa-solid fa-industry fa-2x" style="color:#16a34a;"></i>
                <h4 style="margin-top:15px;">Food Technology</h4>
            </div>
            <div>
                <i class="fa-solid fa-hands-holding-child fa-2x" style="color:#16a34a;"></i>
                <h4 style="margin-top:15px;">Agribusiness Entrepreneur</h4>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal-bg" id="agriModal" onclick="closeAgriModal(event)">
    <div class="modal-ui" onclick="event.stopPropagation()">
        <div class="modal-top">
            <span class="close-mod" onclick="closeAgriModal(event)">&times;</span>
            <div id="mType" style="font-size:11px; font-weight:800; color:#16a34a; letter-spacing:1px; margin-bottom:10px;">TAG</div>
            <h2 id="mName" style="font-family:'Sora'; font-size:28px; color:#064e3b; line-height:1.2;">College Name</h2>
            <div style="margin-top:12px; color:#4b5563;"><i class="fa-solid fa-location-dot"></i> <span id="mLoc">Location</span>, Maharashtra</div>
        </div>
        <div class="modal-data">
            <div class="data-section">
                <h3><i class="fa-solid fa-circle-info"></i> About the Institution</h3>
                <p id="mDesc" style="font-size:15px; color:#4b5563; line-height:1.7;"></p>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="data-section">
                    <h3><i class="fa-solid fa-graduation-cap"></i> Courses Offered</h3>
                    <p id="mCourses" style="font-size:14px; font-weight:700; color:#1e293b;"></p>
                </div>
                <div class="data-section">
                    <h3><i class="fa-solid fa-money-bill-wave"></i> Fee Range</h3>
                    <p id="mFees" style="font-size:14px; font-weight:700; color:#1e293b;"></p>
                </div>
            </div>

            <div class="data-section">
                <h3><i class="fa-solid fa-microscope"></i> Specialized Research Farms & Labs</h3>
                <p id="mFacilities" style="font-size:14px; color:#4b5563;"></p>
            </div>

            <div class="data-section">
                <h3><i class="fa-solid fa-briefcase"></i> Agribusiness Career Support</h3>
                <p id="mPlacement" style="font-size:14px; color:#4b5563;"></p>
            </div>

            <div style="background:#f0fdf4; padding:30px; border-radius:20px; border-left:6px solid #16a34a;">
                <h4 style="font-family:'Sora'; color:#064e3b; margin-bottom:10px;">🌳 Why Choose Agriculture?</h4>
                <p style="font-size:14px; line-height:1.6; color:#166534;">With the integration of technology and sustainability, these institutions are at the forefront of modern agriculture. Students receive hands-on training on actual farms, preparing them for leadership roles in Indias largest economic sector.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const agriData = @json($colleges);

    const aSearch = document.getElementById('agriInp');
    const aLoc = document.getElementById('agriLoc');
    const aType = document.getElementById('agriType');
    const sections = document.querySelectorAll('.district-div');
    const uniArea = document.getElementById('topHubs');

    function filterAgri() {
        let q = aSearch.value.toLowerCase();
        let loc = aLoc.value;
        let type = aType.value;

        let total = 0;

        if(q !== '' || loc !== '' || type !== '') {
            uniArea.style.display = 'none';
        } else {
            uniArea.style.display = 'block';
        }

        sections.forEach(sec => {
            let secLoc = sec.getAttribute('data-loc');
            let visInSec = 0;
            let cards = sec.querySelectorAll('.agri-card');

            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let cardType = card.getAttribute('data-type');

                let mQ = name.includes(q);
                let mLoc = loc === '' || secLoc === loc;
                let mType = type === '' || cardType === type;

                if(mQ && mLoc && mType) {
                    card.style.display = 'flex';
                    visInSec++;
                    total++;
                } else {
                    card.style.display = 'none';
                }
            });

            sec.style.display = visInSec > 0 ? 'block' : 'none';
        });

        document.getElementById('noAgriResults').style.display = total === 0 && uniArea.style.display === 'none' ? 'block' : 'none';
    }

    aSearch.addEventListener('input', filterAgri);
    aLoc.addEventListener('change', filterAgri);
    aType.addEventListener('change', filterAgri);

    function openAgriDetails(id) {
        const c = agriData.find(x => x.id === id);
        if(!c) return;

        document.getElementById('mName').textContent = c.name;
        document.getElementById('mLoc').textContent = c.location;
        document.getElementById('mType').textContent = c.type;
        document.getElementById('mDesc').textContent = c.description;
        document.getElementById('mCourses').textContent = c.popular_branches;
        document.getElementById('mFees').textContent = c.fees_range;
        document.getElementById('mFacilities').textContent = c.facilities;
        document.getElementById('mPlacement').textContent = c.placement_support;

        document.getElementById('agriModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeAgriModal(e) {
        if(e.target === document.getElementById('agriModal') || e.target.classList.contains('close-mod')) {
            document.getElementById('agriModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }
</script>
@endsection

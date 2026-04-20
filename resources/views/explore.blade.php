@extends('layouts.app')

@section('title', 'Explore Careers | Indian Institute of Career Management')

@section('styles')
<style>
/* ─── Explore Specific Additions ─── */
.search-bar { display: inline-flex; width: 100%; max-width: 500px; background: #fff; border-radius: 30px; padding: 4px; box-shadow: 0 4px 16px rgba(0,0,0,.08); }
.search-bar input { flex: 1; border: none; padding: 12px 20px; border-radius: 30px; font-size: 1rem; outline: none; }
.search-bar button { background: var(--brand); color: #fff; border: none; padding: 12px 24px; border-radius: 30px; cursor: pointer; font-weight: 600;}

.category-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-top: 30px; }
.cat-card { background: var(--surface); border: 1px solid var(--border); padding: 20px; border-radius: var(--radius-lg); text-align: center; cursor: pointer; transition: all var(--transition); }
.cat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--brand); }
.cat-icon { font-size: 24px; margin-bottom: 10px; width: 50px; height: 50px; line-height: 50px; border-radius: 50%; margin-inline: auto; }
.cat-name { font-family: 'Sora', sans-serif; font-weight: 600; font-size: 14px;}

.interactive-box { background: #fff; padding: 24px; border-radius: var(--radius-lg); border: 1px solid var(--border); margin-bottom: 30px;}
.interactive-box label { font-weight: 600; font-family: 'Sora', sans-serif; display: block; margin-bottom: 12px;}

.filter-bar { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 30px;}
.filter-bar select { padding: 10px 16px; border: 1px solid var(--border); border-radius: var(--radius-md); font-family: inherit; font-size: 14px; background: #fff; flex: 1; min-width: 150px; outline:none;}

.career-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
.career-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; display: flex; flex-direction: column; transition: all var(--transition); cursor: pointer;}
.career-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.career-header { display: flex; gap: 12px; margin-bottom: 12px; align-items:flex-start;}
.c-icon { width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;}
.c-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 600; margin-bottom: 4px; line-height:1.2;}
.badge { display: inline-block; font-size: 12px; padding: 2px 8px; border-radius: 12px; font-weight: 600; background: var(--brand-light); color: var(--brand); }
.c-desc { color: var(--text-2); font-size: 14px; flex-grow: 1; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.c-meta { display: flex; flex-direction: column; gap: 6px; font-size: 13px; margin-bottom: 16px; padding: 12px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
.c-meta i { width: 16px; color: var(--text-3); text-align: center; margin-right: 4px;}
.btn-roadmap { text-align: center; background: var(--brand-light); color: var(--brand); padding: 10px; border-radius: var(--radius-md); font-weight: 600; text-decoration: none; display: block; border: none; width: 100%; cursor: pointer;}
.btn-roadmap:hover { background: var(--brand); color: #fff; }

/* Modal */
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15,23,42,.6); display: none; align-items: center; justify-content: center; z-index: 1000; padding: 20px;}
.modal-overlay.active { display: flex; }
.modal-content { background: #fff; border-radius: var(--radius-lg); width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 30px; position:relative; }
.modal-close { position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: var(--text-3); }

.roadmap-step { display: flex; gap: 16px; margin-bottom: 16px; }
.step-num { flex-shrink:0; width: 32px; height: 32px; background: var(--brand-light); color: var(--brand); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-family:'Sora'; }
.step-text { padding-top: 4px; color: var(--text-1); font-size: 15px;}

.college-item { padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-md); margin-bottom: 10px; }
.college-item h4 { font-size: 14px; margin-bottom: 4px; font-family:'Sora'; }
.college-meta { font-size: 12px; color: var(--text-2); display: flex; gap: 12px;}

#loading { text-align: center; padding: 20px; display: none; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero" style="padding: 100px 0; background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 100%);">
    <div class="container text-center" style="text-align: center; color: white;">
        <h1 style="font-family:'Sora'; font-size: clamp(30px, 4vw, 42px); font-weight:700; margin-bottom: 16px;">Explore Career Paths in India</h1>
        <p style="font-size: 18px; margin-bottom:30px; opacity: 0.9;">Find careers based on your interests, subjects, and goals</p>
        <div class="search-bar" style="margin: 0 auto;">
            <input type="text" id="searchInput" placeholder="Search for a career (e.g. Software Engineer)">
            <button onclick="searchCareers()"><i class="fa-solid fa-search"></i> Search</button>
        </div>
    </div>
</section>

<div class="container section">

    <!-- Categories Grid -->
    <h2 class="section-title">Browse by Category</h2>
    <p class="section-sub">Select a field to see related careers</p>
    <div class="category-grid" id="catGrid">
        @foreach($fields as $field)
        <div class="cat-card" onclick="fetchByField({{ $field->id }})">
            <div class="cat-icon" style="background:{{ $field->bg_color }}; color:{{ $field->color }}">
                <i class="fa-solid {{ $field->icon }}"></i>
            </div>
            <div class="cat-name">{{ $field->name }}</div>
        </div>
        @endforeach
    </div>

    <br><br>

    <!-- Interest & Role Box -->
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:24px;">
        <!-- Subjects Input -->
        <div class="interactive-box">
            <label><i class="fa-solid fa-heart" style="color:var(--accent)"></i> Select Your Interests / Subjects</label>
            <p style="font-size:13px; color:var(--text-2); margin-bottom:12px;">We'll match careers to your subjects</p>
            <select class="js-select2" id="subjectSelect" multiple="multiple" style="width:100%">
                @foreach($subjects as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Direct Role Dropdown -->
        <div class="interactive-box">
            <label><i class="fa-solid fa-bullseye" style="color:var(--brand)"></i> I want to become...</label>
            <p style="font-size:13px; color:var(--text-2); margin-bottom:12px;">Select a specific role to see the roadmap</p>
            <select class="js-select2-careers" id="roleSelect" style="width:100%;">
                <option value="">Select a career...</option>
                @foreach($careers as $career)
                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <select id="filterQual" onchange="clientFilter()">
            <option value="">All Qualifications</option>
            <option value="12th">After 12th</option>
            <option value="B.Tech">B.Tech / Degree</option>
            <option value="Graduation">Graduation</option>
        </select>
        <select id="filterDemand" onchange="clientFilter()">
            <option value="">All Demand Levels</option>
            <option value="Very High">Very High</option>
            <option value="High">High</option>
            <option value="Growing">Growing</option>
        </select>
        <button class="btn-roadmap" style="width:auto; padding:10px 24px;" onclick="resetFilters()">Reset</button>
    </div>

    <!-- Results Section -->
    <h2 class="section-title">Career Options</h2>
    <div id="loading"><i class="fa-solid fa-spinner fa-spin fa-2x" style="color:var(--brand)"></i></div>
    <div class="career-grid" id="careersContainer">
        <!-- populated by JS -->
    </div>

</div>

<!-- Modal -->
<div class="modal-overlay" id="careerModal" onclick="closeModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal(event)">&times;</button>
        <div id="modalBody">
            <!-- Populated by JS -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Initial careers mapped from Blade to JS
    let currentCareers = @json($careers);
    let originalCareers = [...currentCareers];

    $(document).ready(function() {
        // Init Select2
        $('#subjectSelect').select2({ placeholder: "Select subjects (e.g. Mathematics, Biology)" });
        $('#roleSelect').select2();

        // On Subject tags change
        $('#subjectSelect').on('change', function() {
            let ids = $(this).val();
            if(!ids || ids.length === 0) {
                currentCareers = [...originalCareers];
                renderCareers();
                return;
            }
            fetchBySubjects(ids);
        });

        // On 'I want to become' change
        $('#roleSelect').on('change', function() {
            let cId = $(this).val();
            if(cId) openCareerDetail(cId);
        });

        renderCareers();
    });

    // --- Data Fetching ---
    function fetchByField(fieldId) {
        showLoading();
        fetch(`/explore/field/${fieldId}`)
            .then(r => r.json())
            .then(data => {
                currentCareers = data.careers;
                renderCareers();
            })
            .catch(e => console.error(e))
            .finally(()=>hideLoading());
    }

    function fetchBySubjects(subjectIds) {
        showLoading();
        fetch(`/explore/subjects`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ subject_ids: subjectIds })
        })
        .then(r => r.json())
        .then(data => {
            currentCareers = data.careers;
            renderCareers();
        })
        .catch(e => console.error(e))
        .finally(()=>hideLoading());
    }

    function searchCareers() {
        let q = document.getElementById('searchInput').value;
        if(q.length < 2) {
            currentCareers = [...originalCareers];
            renderCareers();
            return;
        }
        showLoading();
        fetch(`/explore/search?q=${encodeURIComponent(q)}`)
            .then(r => r.json())
            .then(data => {
                currentCareers = data.careers;
                renderCareers();
            })
            .finally(()=>hideLoading());
    }

    function openCareerDetail(id) {
        showLoading();
        fetch(`/explore/career/${id}`)
            .then(r => r.json())
            .then(data => {
                populateModal(data.career, data.colleges);
            })
            .finally(()=>hideLoading());
    }

    // --- Client Side Filtering ---
    function clientFilter() {
        let qual = document.getElementById('filterQual').value.toLowerCase();
        let demand = document.getElementById('filterDemand').value;
        
        let filtered = currentCareers.filter(c => {
            let matchQual = qual === "" || c.qualification.toLowerCase().includes(qual);
            let matchDemand = demand === "" || c.demand_level === demand;
            return matchQual && matchDemand;
        });
        renderCareers(filtered);
    }

    function resetFilters() {
        document.getElementById('filterQual').value = "";
        document.getElementById('filterDemand').value = "";
        document.getElementById('searchInput').value = "";
        $('#subjectSelect').val(null).trigger('change');
        // Will auto trigger render due to subjectSelect change
    }

    // --- UI Rendering ---
    function renderCareers(list = currentCareers) {
        let container = document.getElementById('careersContainer');
        container.innerHTML = "";

        if(list.length === 0) {
            container.innerHTML = "<p>No careers found. Try adjusting your filters.</p>";
            return;
        }

        let html = list.map(c => {
            let matchBadge = c.match_count > 0 ? `<span style="font-size:12px; color:green; background:#dcfce7; padding:2px 6px; border-radius:10px;">${c.match_count} Matching Subjects</span>` : '';
            return `
            <div class="career-card" onclick="openCareerDetail(${c.id})">
                <div class="career-header">
                    <div class="c-icon" style="background:${c.field.bg_color}; color:${c.field.color}">
                        <i class="fa-solid ${c.icon}"></i>
                    </div>
                    <div>
                        <div class="c-title">${c.name}</div>
                        <span class="badge" style="background:${c.field.bg_color}; color:${c.field.color}">${c.field.name}</span>
                        ${matchBadge}
                    </div>
                </div>
                <div class="c-desc">${c.description}</div>
                <div class="c-meta">
                    <div><i class="fa-solid fa-graduation-cap"></i> <strong>Required:</strong> ${c.qualification}</div>
                    <div><i class="fa-solid fa-indian-rupee-sign"></i> <strong>Salary:</strong> ${c.salary_range}</div>
                    <div><i class="fa-solid fa-chart-line"></i> <strong>Demand:</strong> ${c.demand_level}</div>
                </div>
                <button class="btn-roadmap">View Roadmap</button>
            </div>
            `;
        }).join('');
        container.innerHTML = html;
    }

    function populateModal(career, colleges) {
        let roadmapHtml = career.roadmap.map((step, idx) => `
            <div class="roadmap-step">
                <div class="step-num">${idx + 1}</div>
                <div class="step-text">${step}</div>
            </div>
        `).join('');

        let collegesHtml = colleges.length > 0 ? colleges.map(col => `
            <div class="college-item">
                <h4>${col.name}</h4>
                <div class="college-meta">
                    <span><i class="fa-solid fa-location-dot"></i> ${col.location}, ${col.state}</span>
                    <span><i class="fa-solid fa-indian-rupee-sign"></i> ${col.fees_range}</span>
                    <span style="color:var(--brand)">${col.type}</span>
                </div>
            </div>
        `).join('') : '<p style="font-size:13px; color:var(--text-2);">No specialized colleges listed for this field yet.</p>';

        let subjectsHtml = career.subjects.length > 0 
            ? career.subjects.map(s => `<span class="badge" style="margin:2px;">${s}</span>`).join('')
            : '-';

        let html = `
            <div style="display:flex; gap:16px; align-items:center; margin-bottom:20px;">
                <div class="c-icon" style="background:${career.field.bg_color}; color:${career.field.color}; width:56px; height:56px; font-size:24px;">
                    <i class="fa-solid ${career.icon}"></i>
                </div>
                <div>
                    <h2 class="section-title" style="margin-bottom:4px; font-size:24px;">${career.name}</h2>
                    <span class="badge" style="background:${career.field.bg_color}; color:${career.field.color}">${career.field.name}</span>
                </div>
            </div>
            <p style="color:var(--text-2); margin-bottom:20px; font-size:15px;">${career.description}</p>
            
            <div style="background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:var(--radius-md); margin-bottom:24px; font-size:14px; display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div><strong>Qualification:</strong><br>${career.qualification}</div>
                <div><strong>Stream:</strong><br>${career.stream || 'Any'}</div>
                <div><strong>Salary:</strong><br>${career.salary_range}</div>
                <div><strong>Demand:</strong><br>${career.demand_level}</div>
                <div style="grid-column: span 2;"><strong>Related Subjects:</strong><br>${subjectsHtml}</div>
            </div>

            <h3 style="font-family:'Sora'; margin-bottom:16px; font-size:18px;">Step-by-Step Roadmap</h3>
            <div style="margin-bottom:24px;">${roadmapHtml}</div>

            <h3 style="font-family:'Sora'; margin-bottom:16px; font-size:18px;">Recommended Colleges</h3>
            <div>${collegesHtml}</div>
        `;

        document.getElementById('modalBody').innerHTML = html;
        document.getElementById('careerModal').classList.add('active');
        document.body.style.overflow = "hidden";
    }

    function closeModal(e) {
        if(e.target === document.getElementById('careerModal') || e.target.classList.contains('modal-close')) {
            document.getElementById('careerModal').classList.remove('active');
            document.body.style.overflow = "auto";
        }
    }

    function showLoading() { document.getElementById('loading').style.display = 'block'; document.getElementById('careersContainer').style.display = 'none'; }
    function hideLoading() { document.getElementById('loading').style.display = 'none'; document.getElementById('careersContainer').style.display = 'grid'; }

</script>
@endsection

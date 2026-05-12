@extends('layouts.app')

@section('title', 'Explore Careers | Indian Institute of Career Management')

@section('styles')
<style>
/* ─── Explore Specific Additions ─── */
.search-bar { display: inline-flex; width: 100%; max-width: 500px; background: #fff; border-radius: 30px; padding: 4px; box-shadow: 0 4px 16px rgba(0,0,0,.08); }
.search-bar input { flex: 1; border: none; padding: 12px 20px; border-radius: 30px; font-size: 1rem; outline: none; color: var(--text-1); }
.search-bar button { background: var(--brand); color: #fff; border: none; padding: 12px 24px; border-radius: 30px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; justify-content: center; }

.section-title { color: #fff !important; }
.section-sub { color: rgba(255,255,255,0.8) !important; }
.interactive-box label { color: var(--text-1) !important; }
.select2-container { text-align: left; color: var(--text-1) !important; }

body {
    background: linear-gradient(135deg, #0f172a, #1e3a8a, #6d28d9);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    color: #fff;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.bg-blobs { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; pointer-events: none; overflow: hidden; }
.blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4; animation: float 10s infinite ease-in-out alternate; }
.blob-1 { width: 400px; height: 400px; background: #3b82f6; top: -100px; left: -100px; animation-delay: 0s; }
.blob-2 { width: 350px; height: 350px; background: #8b5cf6; bottom: -50px; right: -50px; animation-delay: -2s; }
.blob-3 { width: 300px; height: 300px; background: #06b6d4; top: 40%; left: 60%; animation-delay: -4s; }
.blob-4 { width: 250px; height: 250px; background: #10b981; top: 60%; left: 10%; animation-delay: -6s; }
@keyframes float { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, 50px) scale(1.1); } }

.category-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; margin-top: 30px; }
.cat-card { background: rgba(255,255,255,0.1); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.2); padding: 24px 20px; border-radius: 24px; text-align: center; cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; z-index: 1; display: flex; flex-direction: column; justify-content: space-between;}
.cat-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 25px 50px rgba(0,0,0,0.18); border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.15); }
.cat-icon { width: 64px; height: 64px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 28px; background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0)); border: 1px solid rgba(255,255,255,0.2); transition: transform 0.4s ease; }
.cat-card:hover .cat-icon { transform: scale(1.15) rotate(5deg); }
.cat-name { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 16px; color: #fff; margin-bottom: 4px; line-height: 1.3;}

.interactive-box { background: #fff; padding: 24px; border-radius: var(--radius-lg); border: 1px solid var(--border); margin-bottom: 30px;}
.interactive-box label { font-weight: 600; font-family: 'Sora', sans-serif; display: block; margin-bottom: 12px;}

.filter-bar { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 30px;}
.filter-bar select { padding: 10px 16px; border: 1px solid var(--border); border-radius: var(--radius-md); font-family: inherit; font-size: 14px; background: #fff; flex: 1; min-width: 150px; outline:none; color: var(--text-1); }

.career-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
.career-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; display: flex; flex-direction: column; transition: all var(--transition); cursor: pointer; color: var(--text-1); }
.career-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.career-header { display: flex; gap: 12px; margin-bottom: 12px; align-items:flex-start;}
.c-icon { width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;}
.c-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 600; margin-bottom: 4px; line-height:1.2; color: var(--text-1); }
.badge { display: inline-block; font-size: 12px; padding: 2px 8px; border-radius: 12px; font-weight: 600; background: var(--brand-light); color: var(--brand); }
.c-desc { color: var(--text-2); font-size: 14px; flex-grow: 1; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.c-meta { display: flex; flex-direction: column; gap: 6px; font-size: 13px; margin-bottom: 16px; padding: 12px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); color: var(--text-2); }
.c-meta i { width: 16px; color: var(--text-3); text-align: center; margin-right: 4px;}
.c-meta strong { color: var(--text-1); }
.btn-roadmap { text-align: center; padding: 10px 14px; border-radius: 12px; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; border: none; width: 100%; cursor: pointer; transition: all 0.3s ease; font-size: 13px;}
.btn-roadmap:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

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

/* ── Search Autocomplete Styles ── */
.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 0 0 20px 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.95);
    z-index: 1000;
    margin-top: 4px;
    max-height: 300px;
    overflow-y: auto;
}

.suggestions-header {
    padding: 12px 20px;
    font-family: 'Sora', sans-serif;
    font-weight: 600;
    color: #1e293b;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    font-size: 14px;
    background: rgba(59, 130, 246, 0.05);
}

.suggestion-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    cursor: pointer;
    transition: all 0.2s ease;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.suggestion-item:hover {
    background: rgba(59, 130, 246, 0.1);
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.suggestion-content {
    flex: 1;
}

.suggestion-name {
    font-family: 'Sora', sans-serif;
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
    line-height: 1.2;
}

.suggestion-badge {
    display: inline-block;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 10px;
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    font-weight: 600;
    margin-top: 4px;
}

.suggestion-field {
    background: rgba(59, 130, 246, 0.05);
    border-left: 3px solid #3b82f6;
}

.suggestion-career {
    background: rgba(16, 185, 129, 0.05);
    border-left: 3px solid #10b981;
}

.career-field-badge {
    display: inline-block;
    font-size: 10px;
    padding: 1px 4px;
    border-radius: 6px;
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
    font-weight: 500;
    margin-top: 2px;
}

.no-results {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 20px;
    color: #64748b;
    font-size: 14px;
    font-family: 'Sora', sans-serif;
}

.no-results i {
    opacity: 0.5;
}

/* ── How CareerGyan Works Section Styles ── */
.how-it-works-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
    max-width: 1400px;
    margin: 0 auto;
}

.step-card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 20px;
    padding: 32px 24px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    min-height: 280px;
}

.step-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.15);
    border-color: rgba(59, 130, 246, 0.2);
}

.step-number {
    position: absolute;
    top: 16px;
    left: 16px;
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
    padding: 4px 8px;
    border-radius: 8px;
    line-height: 1;
}

.step-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 28px;
    color: #fff;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    position: relative;
    z-index: 1;
}

.step-icon::before {
    content: '';
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    border-radius: 50%;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.step-card:hover .step-icon::before {
    opacity: 0.3;
}

.step-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.step-content h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    line-height: 1.3;
}

.step-content p {
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
    flex: 1;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .how-it-works-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .how-it-works-grid > div:nth-child(4),
    .how-it-works-grid > div:nth-child(5) {
        grid-column: span 1;
    }
}

@media (max-width: 768px) {
    .how-it-works-grid {
        grid-template-columns: 1fr;
        gap: 16px;
        max-width: none;
    }
    
    .step-card {
        padding: 24px 20px;
        min-height: 220px;
    }
    
    .step-number {
        font-size: 12px;
        padding: 3px 6px;
    }
    
    .step-icon {
        width: 48px;
        height: 48px;
        font-size: 22px;
        margin-bottom: 16px;
    }
    
    .step-content h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }
    
    .step-content p {
        font-size: 13px;
        line-height: 1.5;
    }
}

@media (max-width: 480px) {
    .how-it-works-grid {
        gap: 12px;
    }
    
    .step-card {
        padding: 20px 16px;
        min-height: 200px;
    }
    
    .step-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
        margin-bottom: 12px;
    }
    
    .step-content h3 {
        font-size: 15px;
        margin-bottom: 8px;
    }
    
    .step-content p {
        font-size: 12px;
        line-height: 1.4;
    }
}

/* ── Mobile Responsive Design ── */
@media (max-width: 768px) {
    /* Hero Section Mobile */
    .hero {
        padding: 40px 0 30px 0 !important;
    }
    
    .hero h1 {
        font-size: clamp(24px, 6vw, 32px) !important;
        margin-bottom: 12px !important;
        line-height: 1.2;
    }
    
    .hero p {
        font-size: 16px !important;
        margin-bottom: 20px !important;
        padding: 0 10px;
    }
    
    /* Search Bar Mobile */
    .search-bar {
        flex-direction: column !important;
        gap: 12px !important;
        width: 100% !important;
        max-width: none !important;
        margin: 0 auto !important;
    }
    
    .search-bar input {
        width: 100% !important;
        max-width: none !important;
        padding: 12px 16px !important;
        font-size: 16px !important;
        border: 2px solid rgba(255,255,255,0.2) !important;
        border-radius: 12px !important;
    }
    
    .search-bar button {
        width: 100% !important;
        padding: 12px 20px !important;
        font-size: 16px !important;
        margin-top: 0 !important;
        border-radius: 12px !important;
    }
    
    /* Search Suggestions Mobile */
    .search-suggestions {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 90vw !important;
        max-width: 400px !important;
        max-height: 60vh !important;
        border-radius: 12px !important;
        z-index: 1000 !important;
    }
    
    /* Section Titles Mobile */
    .section-title {
        font-size: clamp(18px, 4vw, 22px) !important;
        text-align: center !important;
        padding: 0 10px !important;
    }
    
    .section-sub {
        text-align: center !important;
        font-size: 14px !important;
        padding: 0 10px 20px !important;
    }
    
    /* Category Grid Mobile */
    .category-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
        padding: 0 10px !important;
    }
    
    .cat-card {
        margin: 0 !important;
        padding: 16px !important;
    }
    
    .cat-icon {
        width: 48px !important;
        height: 48px !important;
        font-size: 20px !important;
    }
    
    .cat-name {
        font-size: 16px !important;
        margin-bottom: 12px !important;
    }
    
    /* Buttons Mobile */
    .btn-roadmap {
        width: 100% !important;
        padding: 12px 20px !important;
        font-size: 14px !important;
        margin: 8px 0 !important;
    }
    
    /* Filter Bar Mobile */
    .filter-bar {
        flex-direction: column !important;
        gap: 12px !important;
        padding: 20px 10px !important;
    }
    
    .filter-bar select {
        width: 100% !important;
        padding: 10px !important;
        font-size: 14px !important;
    }
    
    /* Career Grid Mobile */
    .career-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
        padding: 0 10px !important;
    }
    
    /* Interactive Boxes Mobile */
    .interactive-box {
        margin-bottom: 16px !important;
        padding: 16px !important;
    }
    
    .js-select2, .js-select2-careers {
        width: 100% !important;
        font-size: 14px !important;
    }
}

@media (max-width: 480px) {
    /* Extra Small Mobile */
    .hero {
        padding: 30px 0 20px 0 !important;
    }
    
    .hero h1 {
        font-size: clamp(20px, 5vw, 28px) !important;
        margin-bottom: 10px !important;
    }
    
    .hero p {
        font-size: 14px !important;
        margin-bottom: 15px !important;
        padding: 0 5px;
    }
    
    .search-bar {
        padding: 0 5px !important;
    }
    
    .search-bar input {
        padding: 10px 12px !important;
        font-size: 14px !important;
    }
    
    .search-bar button {
        padding: 10px 16px !important;
        font-size: 14px !important;
    }
    
    .category-grid {
        gap: 12px !important;
        padding: 0 5px !important;
    }
    
    .cat-card {
        padding: 12px !important;
    }
    
    .cat-icon {
        width: 40px !important;
        height: 40px !important;
        font-size: 18px !important;
    }
    
    .cat-name {
        font-size: 14px !important;
        margin-bottom: 10px !important;
    }
    
    .btn-roadmap {
        padding: 10px 16px !important;
        font-size: 13px !important;
    }
    
    .filter-bar select {
        padding: 8px !important;
        font-size: 13px !important;
    }
}
</style>
@endsection

@section('content')
<div class="bg-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="blob blob-4"></div>
</div>
<!-- HERO -->
<section class="hero" style="padding: 60px 0 20px 0; background: transparent;">
    <div class="container text-center" style="text-align: center; color: white;">
        <h1 style="font-family:'Sora'; font-size: clamp(30px, 4vw, 42px); font-weight:700; margin-bottom: 16px;">Explore Career Paths in India</h1>
        <p style="font-size: 18px; margin-bottom:30px; opacity: 0.9;">Find careers based on your interests, subjects, and goals</p>
        <div class="search-bar" style="margin: 0 auto; position: relative;">
            <input type="text" id="searchInput" placeholder="Search for careers or fields (e.g. Software Engineer, Engineering, Medical)">
            <button onclick="performFieldSearch()"><i class="fa-solid fa-search"></i> Search</button>
            
            <!-- Autocomplete Dropdown -->
            <div id="searchSuggestions" class="search-suggestions" style="display: none;">
                <div class="suggestions-header">Search Results</div>
                <div id="suggestionsList"></div>
                <div id="noResults" class="no-results" style="display: none;">
                    <i class="fa-solid fa-search"></i>
                    <span>No matching career found.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container section">

    <!-- Categories Grid -->
    <h2 class="section-title">Browse by Category</h2>
    <p class="section-sub">Select a field to see related careers</p>
    <div class="category-grid" id="catGrid">
        @foreach($fields as $field)
        <div class="cat-card" 
             @if($field->slug === 'competitive-exams') onclick="window.location='{{ route('explore.competitive-exams') }}'"
             @elseif($field->slug === 'non-traditional') onclick="window.location='{{ route('explore.non-traditional-careers') }}'"
             @else onclick="fetchByField({{ $field->id }})" @endif>
            <div class="cat-icon" style="background:{{ $field->bg_color }}; color:{{ $field->color }}">
                <i class="fa-solid {{ $field->icon }}"></i>
            </div>
            <div class="cat-name">{{ $field->name }}</div>
            
            <div style="margin-top:16px; display:flex; flex-direction:column; gap:15px;">
                {{-- Dynamic View Top Colleges Button --}}
                @php
                    $collegeRoutes = [
                        'technology-engineering' => 'explore.engineering-colleges',
                        'arts-humanities' => 'explore.arts-humanities-colleges',
                        'science' => 'explore.science-colleges',
                        'commerce' => 'explore.commerce-colleges',
                        'agriculture' => 'explore.agriculture-colleges',
                        'medical' => 'explore.medical-colleges',
                        'hotel-management' => 'explore.hotel-management-colleges',
                        'business' => 'explore.management-colleges',
                        'pharmacy' => 'explore.pharmacy-colleges',
                        'ayush-allied' => 'explore.non-mbbs-colleges'
                    ];

                    $customLabels = [
                        'government-defence' => 'Explore Paths',
                        'teaching-law' => 'Explore Paths',
                        'modern-tech' => 'Career Guide',
                        'creative-careers' => 'Career Guide',
                        'social-media' => 'Career Guide',
                        'gaming-careers' => 'Career Guide',
                        'freelancing' => 'Career Guide',
                        'competitive-exams' => 'View Exams & Roadmap',
                        'non-traditional' => 'Modern Career Guide',
                        'small-scale' => 'Explore Ideas',
                        'sports' => 'View Sports Careers',
                        'skill-development' => 'Explore Skills'
                    ];

                    $customRoutes = [
                        'government-defence' => 'explore.government-defence',
                        'teaching-law' => 'explore.teaching-law',
                        'modern-tech' => 'explore.modern-tech',
                        'creative-careers' => 'explore.creative-careers',
                        'social-media' => 'explore.social-media',
                        'gaming-careers' => 'explore.gaming-careers',
                        'freelancing' => 'explore.freelancing',
                        'competitive-exams' => 'explore.competitive-exams',
                        'non-traditional' => 'explore.non-traditional-careers',
                        'small-scale' => 'explore.small-scale-business',
                        'sports' => 'explore.sports-careers',
                        'skill-development' => 'explore.skill-development'
                    ];
                @endphp

                @if(isset($collegeRoutes[$field->slug]))
                    <a href="{{ route($collegeRoutes[$field->slug]) }}" onclick="event.stopPropagation()" class="btn-roadmap" style="background: linear-gradient(135deg, #ec4899, #8b5cf6); color: #fff; border: none; border-radius: 30px; box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4); font-weight: 700;">
                        View Top Colleges &rarr;
                    </a>
                @elseif(isset($customRoutes[$field->slug]))
                    <a href="{{ route($customRoutes[$field->slug]) }}" onclick="event.stopPropagation()" class="btn-roadmap" style="background: linear-gradient(135deg, #ec4899, #8b5cf6); color: #fff; border: none; border-radius: 30px; box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4); font-weight: 700;">
                        {{ $customLabels[$field->slug] }} &rarr;
                    </a>
                @endif

                {{-- NEW Career Path Button --}}
                @php
                    $slugMap = [
                        'modern-tech' => 'modern-tech-ai',
                        'creative-careers' => 'creative-careers',
                        'social-media' => 'social-media-content',
                        'gaming-careers' => 'gaming-esports',
                        'freelancing' => 'freelancing-remote',
                        'competitive-exams' => 'competitive-exams',
                        'hotel-management' => 'hotel-management',
                        'pharmacy' => 'pharmaceutical-sciences',
                        'ayush-allied' => 'ayush-allied-health',
                        'non-traditional' => 'non-traditional-careers'
                    ];
                    $pathSlug = $slugMap[$field->slug] ?? $field->slug;
                @endphp
                <a href="{{ $field->slug === 'gaming-careers' ? route('career-path.gaming-esports') : route('career.path', $pathSlug) }}" onclick="event.stopPropagation()" class="btn-roadmap" style="background: linear-gradient(135deg, #ec4899, #8b5cf6); color: #fff; border: none; border-radius: 30px; box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4); font-weight: 700;">
                    <i class="fa-solid fa-route"></i> Full Career Path
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <br><br>

    <!-- How CareerGyan Works -->
    <div style="background: #f8fafc; padding: 60px 0; margin: 40px 0;">
        <div class="container">
            <h2 style="font-family: 'Sora', sans-serif; font-size: clamp(28px, 4vw, 42px); font-weight: 800; color: #1e293b; text-align: center; margin-bottom: 16px;">
                How CareerGyan Works
            </h2>
            <p style="font-size: 18px; color: #64748b; text-align: center; max-width: 700px; margin: 0 auto 50px; line-height: 1.6;">
                Simple steps to discover the right career path and colleges for your future.
            </p>
            
            <!-- Step Cards -->
            <div class="how-it-works-grid">
                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-number">01</div>
                    <div class="step-icon">🎯</div>
                    <div class="step-content">
                        <h3>Take Free Test</h3>
                        <p>Discover your interests and strengths through our comprehensive aptitude test.</p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-number">02</div>
                    <div class="step-icon">📊</div>
                    <div class="step-content">
                        <h3>Get Career Suggestions</h3>
                        <p>Receive personalized career recommendations based on your test results and profile.</p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-number">03</div>
                    <div class="step-icon">🛤️</div>
                    <div class="step-content">
                        <h3>Explore Career Paths</h3>
                        <p>Learn about different career options, salaries, skills required and future scope.</p>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="step-card">
                    <div class="step-number">04</div>
                    <div class="step-icon">🏫️</div>
                    <div class="step-content">
                        <h3>Find Top Colleges</h3>
                        <p>Discover best colleges by district, state and stream with detailed information.</p>
                    </div>
                </div>
                
                <!-- Step 5 -->
                <div class="step-card">
                    <div class="step-number">05</div>
                    <div class="step-icon">🚀</div>
                    <div class="step-content">
                        <h3>Build Your Future</h3>
                        <p>Plan your career journey with confidence and clear guidance from industry experts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performFieldSearch();
        }
    });

    // ── Field Search with Autocomplete ──
    let searchTimeout;
    let currentFieldResults = [];
    let currentCareerResults = [];

    // Autocomplete on input
    document.getElementById('searchInput').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        let q = e.target.value.trim();
        
        if (q.length < 2) {
            hideSuggestions();
            return;
        }
        
        // Debounce search
        searchTimeout = setTimeout(() => {
            fetchFieldSuggestions(q);
        }, 300);
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-bar')) {
            hideSuggestions();
        }
    });

    function fetchFieldSuggestions(query) {
        fetch(`/explore/field-search?q=${encodeURIComponent(query)}`)
            .then(r => r.json())
            .then(data => {
                currentFieldResults = data.fields || [];
                currentCareerResults = data.careers || [];
                showSuggestions(data);
            })
            .catch(e => {
                console.error('Error fetching field suggestions:', e);
                hideSuggestions();
            });
    }

    function showSuggestions(data) {
        const suggestionsDiv = document.getElementById('searchSuggestions');
        const suggestionsList = document.getElementById('suggestionsList');
        const noResults = document.getElementById('noResults');
        
        const fields = data.fields || [];
        const careers = data.careers || [];
        
        if (fields.length === 0 && careers.length === 0) {
            suggestionsList.innerHTML = '';
            noResults.style.display = 'flex';
        } else {
            noResults.style.display = 'none';
            
            let html = '';
            
            // Add field suggestions
            if (fields.length > 0) {
                html += fields.map(field => `
                    <div class="suggestion-item suggestion-field" onclick="navigateToField('${field.slug}', '${field.name}')">
                        <div class="suggestion-icon" style="background: ${field.bg_color}; color: ${field.color};">
                            <i class="fa-solid ${field.icon}"></i>
                        </div>
                        <div class="suggestion-content">
                            <div class="suggestion-name">${field.name}</div>
                            ${field.has_career_path ? '<span class="suggestion-badge">Career Path Available</span>' : '<span class="career-field-badge">Field</span>'}
                        </div>
                    </div>
                `).join('');
            }
            
            // Add career suggestions
            if (careers.length > 0) {
                html += careers.map(career => `
                    <div class="suggestion-item suggestion-career" onclick="navigateToCareer('${career.slug}', '${career.name}', '${career.field_slug}')">
                        <div class="suggestion-icon" style="background: ${career.field_bg_color}; color: ${career.field_color};">
                            <i class="fa-solid ${career.icon}"></i>
                        </div>
                        <div class="suggestion-content">
                            <div class="suggestion-name">${career.name}</div>
                            <span class="career-field-badge">${career.field_name}</span>
                        </div>
                    </div>
                `).join('');
            }
            
            suggestionsList.innerHTML = html;
        }
        
        suggestionsDiv.style.display = 'block';
    }

    function hideSuggestions() {
        document.getElementById('searchSuggestions').style.display = 'none';
    }

    function performFieldSearch() {
        let q = document.getElementById('searchInput').value.trim();
        if (q.length < 2) {
            hideSuggestions();
            return;
        }
        
        // Find exact match in careers first (more specific)
        let exactCareerMatch = currentCareerResults.find(c => 
            c.name.toLowerCase() === q.toLowerCase() || 
            c.slug.toLowerCase() === q.toLowerCase()
        );
        
        if (exactCareerMatch) {
            navigateToCareer(exactCareerMatch.slug, exactCareerMatch.name, exactCareerMatch.field_slug);
            return;
        }
        
        // Find exact match in fields
        let exactFieldMatch = currentFieldResults.find(f => 
            f.name.toLowerCase() === q.toLowerCase() || 
            f.slug.toLowerCase() === q.toLowerCase()
        );
        
        if (exactFieldMatch) {
            navigateToField(exactFieldMatch.slug, exactFieldMatch.name);
            return;
        }
        
        // If no exact match, navigate to first available result
        if (currentCareerResults.length > 0) {
            navigateToCareer(currentCareerResults[0].slug, currentCareerResults[0].name, currentCareerResults[0].field_slug);
        } else if (currentFieldResults.length > 0) {
            navigateToField(currentFieldResults[0].slug, currentFieldResults[0].name);
        } else {
            // Show no results message
            const suggestionsDiv = document.getElementById('searchSuggestions');
            const suggestionsList = document.getElementById('suggestionsList');
            const noResults = document.getElementById('noResults');
            
            suggestionsList.innerHTML = '';
            noResults.style.display = 'flex';
            suggestionsDiv.style.display = 'block';
            
            // Hide after 3 seconds
            setTimeout(hideSuggestions, 3000);
        }
    }

    function navigateToCareer(slug, name, fieldSlug) {
        hideSuggestions();
        
        // Navigate to career detail page
        window.location.href = `/career/${slug}`;
    }

    function navigateToField(slug, name) {
        hideSuggestions();
        
        // Check if field has a dedicated career path page
        const careerPathRoutes = {
            'technology-engineering': '/career-path/technology-engineering',
            'medical': '/career-path/medical',
            'business': '/career-path/business',
            'science': '/career-path/science',
            'arts-humanities': '/career-path/arts-humanities',
            'commerce': '/career-path/commerce',
            'agriculture': '/career-path/agriculture',
            'sports': '/career-path/sports',
            'skill-development': '/career-path/skill-development',
            'modern-tech': '/career-path/modern-tech-ai',
            'creative-careers': '/career-path/creative-careers',
            'social-media': '/career-path/social-media-content',
            'gaming-careers': '/career-path/gaming-esports',
            'freelancing': '/career-path/freelancing-remote',
            'government-defence': '/explore/government-defence',
            'teaching-law': '/explore/teaching-law',
            'hotel-management': '/explore/hotel-management-colleges',
            'pharmacy': '/explore/pharmacy-colleges',
            'ayush-allied': '/explore/non-mbbs-colleges',
            'small-scale': '/explore/small-scale-business'
        };
        
        const targetRoute = careerPathRoutes[slug];
        if (targetRoute) {
            window.location.href = targetRoute;
        } else {
            // For fields without dedicated pages, redirect to explore page
            window.location.href = `/explore/field/${slug}`;
        }
    }

</script>
@endsection

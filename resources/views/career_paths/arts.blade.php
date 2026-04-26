@extends('layouts.app')

@section('title', 'Arts & Humanities Career Path | Subject-wise Guide')

@section('styles')
<style>
    .path-hero {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        padding: 80px 0 60px;
        color: white;
        text-align: center;
        border-radius: 0 0 40px 40px;
        margin-bottom: 50px;
    }
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        background: rgba(255,255,255,0.2);
        padding: 8px 16px;
        border-radius: 20px;
        margin-bottom: 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .back-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: translateX(-5px);
    }
    .subject-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
        margin-bottom: 60px;
    }
    .subject-card {
        background: white;
        border-radius: 20px;
        padding: 0;
        border: 1px solid var(--border);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    .subject-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #a855f7;
    }
    .subject-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid var(--border);
    }
    .subject-card-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .subject-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #a855f7);
        opacity: 0;
        z-index: 10;
        transition: opacity 0.3s ease;
    }
    .subject-card:hover::before {
        opacity: 1;
    }
    .subject-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    .subject-icon {
        width: 40px;
        height: 40px;
        background: #f5f3ff;
        color: #7c3aed;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .subject-title {
        font-family: 'Sora', sans-serif;
        font-size: 19px;
        font-weight: 700;
        color: var(--text-1);
    }
    .content-section {
        margin-bottom: 15px;
    }
    .content-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
        display: block;
    }
    .course-tags, .career-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .tag-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 13.5px;
        color: #475569;
        font-weight: 500;
    }
    .tag-item.career {
        background: #f0fdf4;
        border-color: #dcfce7;
        color: #166534;
    }
    .note-box {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px dashed #e2e8f0;
        font-size: 13px;
        color: #64748b;
        font-style: italic;
    }
    .info-section {
        background: #f8fafc;
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 40px;
        border: 1px solid var(--border);
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    .info-card h4 {
        font-family: 'Sora', sans-serif;
        font-size: 18px;
        margin-bottom: 15px;
        color: var(--brand);
    }
    .info-card ul li {
        margin-bottom: 10px;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card ul li i {
        color: #16a34a;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .path-hero { padding: 60px 0 40px; }
        .subject-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<section class="path-hero">
    <div class="container">
        <a href="{{ route('explore.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Explore
        </a>
        <h1 style="font-family: 'Sora'; font-size: clamp(28px, 5vw, 42px); font-weight: 800; margin-bottom: 10px;">
            🎓 Arts & Humanities Career Path
        </h1>
        <p style="font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto;">
            A comprehensive subject-wise guide to courses and career opportunities in India
        </p>
    </div>
</section>

<div class="container">
    <div class="subject-grid">
        <!-- 1. English / Literature -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/english-literature.jpg') }}" alt="English Literature" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="subject-title">English / Literature</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA English</span>
                        <span class="tag-item">MA English</span>
                        <span class="tag-item">Journalism</span>
                        <span class="tag-item">Mass Communication</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Content Writer</span>
                        <span class="tag-item career">Journalist</span>
                        <span class="tag-item career">Editor / Publisher</span>
                        <span class="tag-item career">Digital Marketer</span>
                        <span class="tag-item career">Script Writer</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-lightbulb"></i> Strong communication & creativity → high demand in media & corporate sectors
                </div>
            </div>
        </div>

        <!-- 2. Psychology -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/psychology.jpg') }}" alt="Psychology" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-brain"></i></div>
                    <div class="subject-title">Psychology</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA Psychology</span>
                        <span class="tag-item">MA Psychology</span>
                        <span class="tag-item">Specialization (Clinical/Child)</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Clinical Psychologist</span>
                        <span class="tag-item career">Counsellor</span>
                        <span class="tag-item career">HR / Organizational</span>
                        <span class="tag-item career">Career Coach</span>
                        <span class="tag-item career">UX Researcher</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-chart-line"></i> Fast-growing field in India due to mental health awareness
                </div>
            </div>
        </div>

        <!-- 3. Political Science -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/political-science.jpg') }}" alt="Political Science" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-landmark"></i></div>
                    <div class="subject-title">Political Science</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA Political Science</span>
                        <span class="tag-item">Public Administration</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Civil Services (UPSC/MPSC)</span>
                        <span class="tag-item career">Political Analyst</span>
                        <span class="tag-item career">Diplomat</span>
                        <span class="tag-item career">Policy Advisor</span>
                        <span class="tag-item career">Election Strategist</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-shield-halved"></i> Best option for government jobs and UPSC preparation
                </div>
            </div>
        </div>

        <!-- 4. Geography -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/geography.jpg') }}" alt="Geography" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-earth-americas"></i></div>
                    <div class="subject-title">Geography</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA Geography</span>
                        <span class="tag-item">GIS Courses</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">GIS Specialist</span>
                        <span class="tag-item career">Urban Planner</span>
                        <span class="tag-item career">Environmental Consultant</span>
                        <span class="tag-item career">Disaster Management</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-microchip"></i> Tech + environment = growing demand
                </div>
            </div>
        </div>

        <!-- 5. Economics -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/economics.jpg') }}" alt="Economics" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-chart-pie"></i></div>
                    <div class="subject-title">Economics</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA Economics</span>
                        <span class="tag-item">BA Economics Hons.</span>
                        <span class="tag-item">MA Economics</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Financial Analyst</span>
                        <span class="tag-item career">Banker</span>
                        <span class="tag-item career">Data Analyst</span>
                        <span class="tag-item career">Economist</span>
                        <span class="tag-item career">Policy Advisor</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-money-bill-trend-up"></i> High salary options in corporate and government sectors
                </div>
            </div>
        </div>

        <!-- 6. Sociology -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/sociology.jpg') }}" alt="Sociology" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-people-group"></i></div>
                    <div class="subject-title">Sociology</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA Sociology</span>
                        <span class="tag-item">Social Work (BSW)</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Social Worker</span>
                        <span class="tag-item career">NGO / CSR Manager</span>
                        <span class="tag-item career">Policy Researcher</span>
                        <span class="tag-item career">Market Research Analyst</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-hand-holding-heart"></i> Useful for social impact and development sector
                </div>
            </div>
        </div>

        <!-- 7. History -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/history.jpg') }}" alt="History" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div class="subject-title">History</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA History</span>
                        <span class="tag-item">Archaeology</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Historian</span>
                        <span class="tag-item career">Archaeologist</span>
                        <span class="tag-item career">Museum Curator</span>
                        <span class="tag-item career">Heritage Manager</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-building-columns"></i> Good for research, culture, tourism and heritage
                </div>
            </div>
        </div>

        <!-- 8. Law -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/law.jpg') }}" alt="Law" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-gavel"></i></div>
                    <div class="subject-title">Law</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BA LLB (5 years)</span>
                        <span class="tag-item">LLB</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Lawyer</span>
                        <span class="tag-item career">Judge (after exams)</span>
                        <span class="tag-item career">Legal Advisor</span>
                        <span class="tag-item career">Human Rights Advocate</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-scale-balanced"></i> Respected and high-paying career path
                </div>
            </div>
        </div>

        <!-- 9. Fine Arts / Design -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/fine-arts-design.jpg') }}" alt="Fine Arts & Design" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-palette"></i></div>
                    <div class="subject-title">Fine Arts / Design</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BFA</span>
                        <span class="tag-item">B.Des</span>
                        <span class="tag-item">Fashion Design</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Graphic Designer</span>
                        <span class="tag-item career">Fashion Designer</span>
                        <span class="tag-item career">Animator</span>
                        <span class="tag-item career">Interior Designer</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> High scope in creative industries and startups
                </div>
            </div>
        </div>

        <!-- 10. Journalism & Mass Comm -->
        <div class="subject-card">
            <img src="{{ asset('images/career-path/arts/journalism-mass-communication.jpg') }}" alt="Journalism & Mass Communication" class="subject-image">
            <div class="subject-card-body">
                <div class="subject-header">
                    <div class="subject-icon"><i class="fa-solid fa-microphone-lines"></i></div>
                    <div class="subject-title">Journalism & Mass Comm</div>
                </div>
                <div class="content-section">
                    <span class="content-label">Top Courses</span>
                    <div class="course-tags">
                        <span class="tag-item">BJMC</span>
                        <span class="tag-item">BA Mass Media</span>
                    </div>
                </div>
                <div class="content-section">
                    <span class="content-label">Career Options</span>
                    <div class="career-tags">
                        <span class="tag-item career">Journalist</span>
                        <span class="tag-item career">News Anchor</span>
                        <span class="tag-item career">Social Media Manager</span>
                        <span class="tag-item career">PR Specialist</span>
                    </div>
                </div>
                <div class="note-box">
                    <i class="fa-solid fa-tower-broadcast"></i> Huge demand in digital media and content economy
                </div>
            </div>
        </div>
    </div>

    <!-- Maharashtra Specific Section -->
    <div class="info-section">
        <h3 class="section-title" style="margin-bottom: 30px; text-align: center;">📍 Maharashtra-specific Opportunities</h3>
        <div class="info-grid">
            <div class="info-card">
                <h4>Mumbai</h4>
                <ul>
                    <li><i class="fa-solid fa-check"></i> Media, Film, Bollywood Hub</li>
                    <li><i class="fa-solid fa-check"></i> Major News Channels</li>
                    <li><i class="fa-solid fa-check"></i> GLC Mumbai (Top Law)</li>
                    <li><i class="fa-solid fa-check"></i> NIFT Mumbai (Top Design)</li>
                </ul>
            </div>
            <div class="info-card">
                <h4>Pune</h4>
                <ul>
                    <li><i class="fa-solid fa-check"></i> UPSC/MPSC Coaching Ecosystem</li>
                    <li><i class="fa-solid fa-check"></i> ILS Pune (Top Law)</li>
                    <li><i class="fa-solid fa-check"></i> Oxford of the East (Academic Hub)</li>
                </ul>
            </div>
            <div class="info-card">
                <h4>Rural Maharashtra</h4>
                <ul>
                    <li><i class="fa-solid fa-check"></i> NGO and Social Work</li>
                    <li><i class="fa-solid fa-check"></i> Public Administration roles</li>
                    <li><i class="fa-solid fa-check"></i> Heritage & Tourism sites</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Top Fields Summary -->
    <div class="info-section" style="background: white; border-color: #e0e7ff;">
        <h3 class="section-title" style="margin-bottom: 30px; text-align: center;">🚀 Top Career Fields Summary</h3>
        <div class="info-grid">
            <div class="info-card">
                <h4 style="color:#ef4444">Government</h4>
                <p style="font-size: 14px; color: var(--text-2);">UPSC, MPSC, SSC, State Services, Banking</p>
            </div>
            <div class="info-card">
                <h4 style="color:#3b82f6">Corporate</h4>
                <p style="font-size: 14px; color: var(--text-2);">HR, Marketing, Data Analytics, Finance</p>
            </div>
            <div class="info-card">
                <h4 style="color:#ec4899">Creative</h4>
                <p style="font-size: 14px; color: var(--text-2);">Design, Media, Film, Content Creation</p>
            </div>
            <div class="info-card">
                <h4 style="color:#8b5cf6">Professional</h4>
                <p style="font-size: 14px; color: var(--text-2);">Law, Psychology, Consultancy, Research</p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-bottom: 80px;">
        <a href="{{ route('explore.index') }}" class="btn-roadmap" style="display: inline-block; width: auto; padding: 15px 40px; font-size: 16px;">
            Explore More Career Streams
        </a>
    </div>
</div>
@endsection

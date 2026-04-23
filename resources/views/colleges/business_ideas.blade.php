@extends('layouts.app')

@section('title', 'Small Scale Business Ideas & Opportunities')

@section('styles')
<style>
/* ─── Business Specific Styles ─── */
.hero-biz { padding: 90px 0; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; text-align: center; border-bottom: 5px solid #fbbf24; }
.hero-biz h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: clamp(32px, 5vw, 54px); margin-bottom: 20px; color: #fbbf24; }
.hero-biz p { font-size: 19px; opacity: 0.9; max-width: 800px; margin: 0 auto; color: #cbd5e1; }

/* Business Tabs */
.biz-tabs { display: flex; justify-content: center; gap: 15px; margin-top: -30px; flex-wrap: wrap; padding: 0 20px; }
.biz-tab { background: white; border: 1px solid #e2e8f0; padding: 15px 25px; border-radius: 12px; font-weight: 700; color: #1e293b; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
.biz-tab:hover, .biz-tab.active { background: #fbbf24; color: #1e293b; border-color: #fbbf24; transform: translateY(-3px); }

/* Idea Cards */
.ideas-container { margin-top: 60px; }
.idea-card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; overflow: hidden; transition: 0.3s; display: flex; flex-direction: column; height: 100%; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
.idea-card:hover { transform: translateY(-5px); border-color: #fbbf24; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }

.card-content { padding: 30px; flex: 1; }
.risk-tag { font-size: 10px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; margin-bottom: 15px; display: inline-block; }
.risk-low { background: #dcfce7; color: #166534; }
.risk-medium { background: #fef9c3; color: #854d0e; }

.idea-name { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
.idea-desc { font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 20px; }

.idea-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
.stat-box { background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #f1f5f9; }
.stat-box small { display: block; font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-bottom: 4px; }
.stat-box span { font-size: 14px; font-weight: 700; color: #334155; }

/* Startup Guide */
.guide-sec { margin-top: 100px; padding: 60px 0; background: #fffcf0; border-radius: 40px; text-align: center; }
.step-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 30px; margin-top: 50px; padding: 0 40px; }
.step-box { position: relative; }
.step-num { width: 50px; height: 50px; background: #fbbf24; color: #1e293b; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; margin: 0 auto 20px; font-size: 20px; box-shadow: 0 5px 15px rgba(251, 191, 36, 0.4); }

/* Support Section */
.support-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 80px; }
.sup-card { background: white; padding: 40px; border-radius: 30px; border: 1px solid #e2e8f0; display: flex; align-items: top; gap: 20px; }
.sup-icon { background: #f8fafc; width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 24px; border: 1px solid #f1f5f9; flex-shrink: 0; }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="hero-biz">
    <div class="container">
        <h1>Be Your Own Boss</h1>
        <p>Entrepreneurship is not about how much money you have, but how much value you can create. Explore high-potential business ideas you can start with low investment today.</p>
    </div>
</section>

<div class="container">
    <!-- Category Navigation -->
    <div class="biz-tabs">
        <button class="biz-tab active" onclick="filterBiz('all')">All Ideas</button>
        @foreach($businessCategories as $cat)
        <button class="biz-tab" onclick="filterBiz('{{ Str::slug($cat['title']) }}')">
            <i class="fa-solid {{ $cat['icon'] }}"></i> {{ $cat['title'] }}
        </button>
        @endforeach
    </div>

    <!-- Ideas Grid -->
    <div class="ideas-container">
        @foreach($businessCategories as $cat)
        <div class="biz-section" id="{{ Str::slug($cat['title']) }}">
            <h2 style="font-family:'Sora'; color:#0f172a; margin-bottom:30px; margin-top:60px; border-left:5px solid #fbbf24; padding-left:15px;">
                {{ $cat['title'] }}
            </h2>
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap:30px;">
                @foreach($cat['ideas'] as $idea)
                <div class="idea-card">
                    <div class="card-content">
                        <span class="risk-tag risk-{{ strtolower($idea['risk']) }}">{{ $idea['risk'] }} Risk</span>
                        <h3 class="idea-name">{{ $idea['name'] }}</h3>
                        <p class="idea-desc">{{ $idea['desc'] }}</p>
                        
                        <div class="idea-stats">
                            <div class="stat-box">
                                <small>Investment</small>
                                <span>{{ $idea['invest'] }}</span>
                            </div>
                            <div class="stat-box">
                                <small>Profit Margin</small>
                                <span>{{ $idea['profit'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 20px 30px; background: #0f172a; color: white;">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <span style="font-size:12px; font-weight:700; color:#94a3b8;">Start Time: 2-4 Weeks</span>
                            <a href="#" style="color:#fbbf24; font-size:13px; font-weight:800;">Get Plan &rarr;</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Startup Guide -->
    <section class="guide-sec">
        <h2 style="font-family:'Sora'; color:#0f172a;">🚀 Simple Steps to Launch</h2>
        <p style="color:#64748b; margin-top:10px;">Don't wait for the perfect moment. Start small, learn, and grow.</p>
        <div class="step-grid">
            <div class="step-box">
                <div class="step-num">1</div>
                <h4 style="font-family:'Sora';">Pick Idea</h4>
                <p style="font-size:12px; color:#64748b;">Choose a business that matches your skill.</p>
            </div>
            <div class="step-box">
                <div class="step-num">2</div>
                <h4 style="font-family:'Sora';">Mkt. Research</h4>
                <p style="font-size:12px; color:#64748b;">Talk to users & check your competition.</p>
            </div>
            <div class="step-box">
                <div class="step-num">3</div>
                <h4 style="font-family:'Sora';">Fix Budget</h4>
                <p style="font-size:12px; color:#64748b;">Plan your initial investment & tools.</p>
            </div>
            <div class="step-box">
                <div class="step-num">4</div>
                <h4 style="font-family:'Sora';">Go Live</h4>
                <p style="font-size:12px; color:#64748b;">Start selling on WhatsApp & Social Media.</p>
            </div>
            <div class="step-box">
                <div class="step-num">5</div>
                <h4 style="font-family:'Sora';">Scale Up</h4>
                <p style="font-size:12px; color:#64748b;">Invest profits back to expand your reach.</p>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <div class="support-grid">
        <div class="sup-card">
            <div class="sup-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
            <div>
                <h4 style="font-family:'Sora'; color:#0f172a; margin-bottom:8px;">Govt. Support (Mudra Loan)</h4>
                <p style="font-size:13px; color:#64748b;">Get collateral-free loans up to ₹10 Lakhs to start your small business or startup.</p>
                <a href="#" style="display:inline-block; margin-top:12px; font-size:12px; color:#fbbf24; font-weight:800;">Learn More</a>
            </div>
        </div>
        <div class="sup-card">
            <div class="sup-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
            <div>
                <h4 style="font-family:'Sora'; color:#0f172a; margin-bottom:8px;">Digital Platforms</h4>
                <p style="font-size:13px; color:#64748b;">Use Amazon, Instagram Business, and WhatsApp to reach thousands of customers without a shop.</p>
                <a href="#" style="display:inline-block; margin-top:12px; font-size:12px; color:#fbbf24; font-weight:800;">Get Started</a>
            </div>
        </div>
    </div>
</div>

<br><br><br>

@endsection

@section('scripts')
<script>
    function filterBiz(catId) {
        document.querySelectorAll('.biz-tab').forEach(btn => {
            btn.classList.remove('active');
            if(btn.textContent.toLowerCase().includes(catId.replace('-', ' '))) {
                btn.classList.add('active');
            }
            if(catId === 'all' && btn.textContent.includes('All Ideas')) {
                btn.classList.add('active');
            }
        });

        const sections = document.querySelectorAll('.biz-section');
        sections.forEach(sec => {
            if(catId === 'all') {
                sec.style.display = 'block';
            } else {
                sec.style.display = (sec.id === catId) ? 'block' : 'none';
            }
        });
    }
</script>
@endsection

@extends('layouts.app')

@section('title', $blog->title . ' - CareerGyan Blog')

@section('styles')
<style>
  /* ─── Blog Detail Styles ─── */
  .blog-detail-hero {
    position: relative;
    padding: 70px 0 50px;
    background-color: #ffffff;
    color: #0f172a;
    border-bottom: 1px solid #e2e8f0;
    overflow: hidden;
  }

  .blog-detail-hero::before {
    display: none;
  }

  .blog-detail-hero-content {
    position: relative;
    z-index: 2;
    max-width: 840px;
    margin: 0 auto;
    text-align: center;
  }

  .blog-detail-category {
    display: inline-block;
    background: #2563eb;
    color: #ffffff;
    padding: 6px 18px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.18);
  }

  .blog-detail-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4.5vw, 42px);
    font-weight: 800;
    line-height: 1.3;
    margin-bottom: 20px;
    color: #0f172a;
    text-shadow: none;
  }

  .blog-detail-meta {
    display: flex;
    justify-content: center;
    gap: 24px;
    font-size: 14px;
    color: #64748b;
    flex-wrap: wrap;
  }

  .blog-detail-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .blog-detail-meta i {
    color: #2563eb;
  }

  /* Main article container */
  .article-container {
    padding: 60px 0 80px;
    background: #ffffff;
  }

  .article-layout {
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 40px;
    max-width: 840px;
    margin: 0 auto;
  }

  /* Sticky Share Bar */
  .share-bar-sticky {
    position: sticky;
    top: 100px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: center;
    z-index: 10;
  }

  .share-bar-label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--text-3);
    letter-spacing: 1px;
    writing-mode: vertical-rl;
    text-combine-upright: all;
    margin-bottom: 6px;
  }

  .share-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-2);
    background: #ffffff;
    border: 1px solid var(--border);
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }

  .share-btn:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(15, 23, 42, 0.1);
  }

  .share-whatsapp:hover { background: #25d366; border-color: #25d366; }
  .share-twitter:hover { background: #000000; border-color: #000000; }
  .share-linkedin:hover { background: #0a66c2; border-color: #0a66c2; }
  .share-copy:hover { background: var(--brand); border-color: var(--brand); }

  /* Article Body Typography */
  .article-body {
    max-width: 720px;
  }

  .back-to-blog-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14.5px;
    font-weight: 700;
    color: var(--brand);
    text-decoration: none;
    margin-bottom: 30px;
  }

  .back-to-blog-link:hover {
    text-decoration: underline;
  }

  .article-content {
    font-size: 17.5px;
    line-height: 1.85;
    color: var(--text-1);
  }

  .article-content p {
    margin-bottom: 24px;
  }

  .article-content h2, 
  .article-content h3, 
  .article-content h4 {
    font-family: 'Sora', sans-serif;
    color: var(--text-1);
    font-weight: 700;
    margin: 40px 0 16px;
    line-height: 1.3;
  }

  .article-content h2 { font-size: 24px; }
  .article-content h3 { font-size: 20px; }

  .article-content a {
    color: var(--brand);
    text-decoration: underline;
    font-weight: 600;
  }

  .article-content a:hover {
    color: var(--brand-dark);
  }

  .article-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    margin: 32px 0;
  }

  .article-content blockquote {
    border-left: 4px solid var(--brand);
    padding: 12px 24px;
    background: var(--brand-light);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--text-2);
    margin: 32px 0;
  }

  .article-content code {
    background: #f1f5f9;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 15px;
  }

  .article-content pre {
    background: #0f172a;
    color: #f8fafc;
    padding: 20px;
    border-radius: var(--radius-lg);
    overflow-x: auto;
    font-size: 15px;
    margin: 32px 0;
  }

  .article-content pre code {
    background: transparent;
    color: inherit;
    padding: 0;
  }

  /* Tags wrapper */
  .article-tags-wrap {
    margin-top: 48px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .article-tag {
    background: #f1f5f9;
    color: var(--text-2);
    font-size: 13.5px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 99px;
  }

  /* Related section */
  .related-section {
    padding: 80px 0;
    background: #f8fafc;
    border-top: 1px solid var(--border);
  }

  @media (max-width: 768px) {
    .article-layout {
      grid-template-columns: 1fr;
    }

    .share-bar-sticky {
      position: static;
      flex-direction: row;
      justify-content: center;
      margin-bottom: 32px;
      padding-bottom: 24px;
      border-bottom: 1px solid var(--border);
    }

    .share-bar-label {
      writing-mode: horizontal-tb;
      margin-bottom: 0;
      margin-right: 12px;
    }
  }

  @media (max-width: 480px) {
    .blog-detail-hero {
      padding: 60px 0 40px;
    }
    .blog-detail-title {
      font-size: 24px;
    }
    .article-container {
      padding: 30px 0 40px;
    }
    .article-content {
      font-size: 16px;
      line-height: 1.7;
    }
    .article-content blockquote {
      padding: 8px 16px;
      margin: 20px 0;
    }
  }
</style>
@endsection

@section('content')

<!-- Blog Detail Hero -->
<section class="blog-detail-hero">
  <div class="container">
    <div class="blog-detail-hero-content">
      <span class="blog-detail-category">{{ $blog->category }}</span>
      <h1 class="blog-detail-title">{{ $blog->title }}</h1>
      
      <div class="blog-detail-meta">
        <span><i class="fa-solid fa-user-circle"></i> {{ $blog->author }}</span>
        <span><i class="fa-solid fa-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('d M, Y') : $blog->created_at->format('d M, Y') }}</span>
        <span><i class="fa-regular fa-clock"></i> {{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read</span>
        <span><i class="fa-regular fa-eye"></i> {{ $blog->views_count }} views</span>
      </div>
    </div>
  </div>
</section>

<!-- Article Section -->
<section class="article-container">
  <div class="container">
    <div class="article-layout">
      <!-- Sticky share -->
      <div class="share-bar-sticky">
        <span class="share-bar-label">Share</span>
        <a href="https://api.whatsapp.com/send?text={{ rawurlencode($blog->title . ' - ' . request()->url()) }}" target="_blank" class="share-btn share-whatsapp" title="Share on WhatsApp">
          <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ rawurlencode(request()->url()) }}&text={{ rawurlencode($blog->title) }}" target="_blank" class="share-btn share-twitter" title="Share on Twitter/X">
          <i class="fa-brands fa-x-twitter"></i>
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ rawurlencode(request()->url()) }}" target="_blank" class="share-btn share-linkedin" title="Share on LinkedIn">
          <i class="fa-brands fa-linkedin-in"></i>
        </a>
        <button onclick="copyToClipboard()" class="share-btn share-copy" id="copyBtn" title="Copy Link">
          <i class="fa-solid fa-link"></i>
        </button>
      </div>

      <!-- Article content -->
      <div class="article-body">
        <a href="{{ route('blog.index') }}" class="back-to-blog-link">
          <i class="fa-solid fa-arrow-left"></i> Back to Blog
        </a>

        @if($blog->cover_image)
          <div style="width: 100%; border-radius: var(--radius-xl); overflow: hidden; margin-bottom: 40px; box-shadow: var(--shadow-sm);">
            <img src="{{ $blog->cover_image }}" alt="{{ $blog->title }}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1000';" style="width: 100%; height: auto; display: block; font-size: 0;">
          </div>
        @endif

        <div class="article-content">
          {!! $blog->content !!}
        </div>

        {{-- In-Article High-Converting Recommendation Callout --}}
        <div style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border: 1.5px solid #bfdbfe; border-radius: var(--radius-lg); padding: 26px 28px; margin: 36px 0; box-shadow: var(--shadow-sm);">
          <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
            <div style="width:38px; height:38px; border-radius:10px; background:#2563eb; color:#ffffff; display:flex; align-items:center; justify-content:center; font-size:18px;">
              <i class="fa-solid fa-compass"></i>
            </div>
            <div>
              <h4 style="font-family:'Sora', sans-serif; font-size:17px; font-weight:800; color:#0f172a; margin:0;">Plan Your Next Step with CareerGyan</h4>
              <span style="font-size:12.5px; color:#64748b; font-weight:600;">Personalized recommendations based on your goals</span>
            </div>
          </div>
          <p style="font-size:14px; color:#334155; margin-bottom:18px; line-height:1.6;">
            Confused about which stream or college suits your aptitude? Use our free tools to predict your admission chances or discover your natural strengths.
          </p>
          <div style="display:flex; flex-wrap:wrap; gap:10px;">
            <a href="{{ route('quick-test.start') }}" style="display:inline-flex; align-items:center; gap:6px; background:#2563eb; color:#ffffff; padding:10px 18px; border-radius:30px; font-size:13.5px; font-weight:700; text-decoration:none; box-shadow:0 2px 8px rgba(37,99,235,0.25);">
              <i class="fa-solid fa-bolt" style="color:#fde047;"></i> Free Aptitude Test
            </a>
            <a href="{{ route('tools.college-predictor') }}" style="display:inline-flex; align-items:center; gap:6px; background:#ffffff; color:#1e40af; border:1px solid #bfdbfe; padding:10px 18px; border-radius:30px; font-size:13.5px; font-weight:700; text-decoration:none;">
              <i class="fa-solid fa-crosshairs"></i> Predict Colleges
            </a>
            <a href="{{ route('explore.index') }}" style="display:inline-flex; align-items:center; gap:6px; background:#ffffff; color:#475569; border:1px solid #cbd5e1; padding:10px 18px; border-radius:30px; font-size:13.5px; font-weight:700; text-decoration:none;">
              <i class="fa-solid fa-route"></i> Explore Careers
            </a>
          </div>
        </div>

        @if(is_array($blog->tags) && count($blog->tags) > 0)
          <div class="article-tags-wrap">
            @foreach($blog->tags as $tag)
              <span class="article-tag">#{{ $tag }}</span>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Interconnected Career Ecosystem Hub -->
<section style="background: #ffffff; padding: 60px 0; border-top: 1px solid var(--border);">
  <div class="container">
    <div style="text-align: center; max-width: 680px; margin: 0 auto 40px;">
      <span style="display:inline-block; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:#2563eb; background:#eff6ff; padding:5px 14px; border-radius:99px; margin-bottom:10px;">
        <i class="fa-solid fa-network-wired"></i> Connected Career Hub
      </span>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">
        Recommended Tools & Guidance for You
      </h2>
      <p style="font-size: 14.5px; color: var(--text-2); margin: 0;">
        Spend more time planning effectively. Dive directly into our specialized portals designed for students and job seekers.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
      <!-- Tool 1: College Predictor & Cutoffs -->
      <a href="{{ route('tools.college-predictor') }}" style="background:#f8fafc; border:1px solid var(--border); border-radius:var(--radius-lg); padding:24px; text-decoration:none; display:flex; flex-direction:column; transition:all 0.25s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#2563eb'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
        <div style="width:44px; height:44px; border-radius:12px; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; font-size:20px; margin-bottom:16px;">
          <i class="fa-solid fa-crosshairs"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:16px; font-weight:700; color:var(--text-1); margin:0 0 6px;">College Predictor & Cutoffs</h3>
        <p style="font-size:13.5px; color:var(--text-2); line-height:1.5; margin:0 0 16px; flex:1;">
          Check 2026 MHT-CET cutoffs and find your probability of getting into COEP, VJTI, and 360+ top colleges.
        </p>
        <span style="font-size:13px; font-weight:700; color:#2563eb; display:inline-flex; align-items:center; gap:6px;">
          Predict College <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Tool 2: Free Quick Aptitude Test -->
      <a href="{{ route('quick-test.start') }}" style="background:#f8fafc; border:1px solid var(--border); border-radius:var(--radius-lg); padding:24px; text-decoration:none; display:flex; flex-direction:column; transition:all 0.25s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#2563eb'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
        <div style="width:44px; height:44px; border-radius:12px; background:#fef3c7; color:#d97706; display:flex; align-items:center; justify-content:center; font-size:20px; margin-bottom:16px;">
          <i class="fa-solid fa-bolt"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:16px; font-weight:700; color:var(--text-1); margin:0 0 6px;">5-Min Career Aptitude Test</h3>
        <p style="font-size:13.5px; color:var(--text-2); line-height:1.5; margin:0 0 16px; flex:1;">
          Measure your abstract, verbal, numerical, and mechanical aptitudes with instant scientific recommendations.
        </p>
        <span style="font-size:13px; font-weight:700; color:#d97706; display:inline-flex; align-items:center; gap:6px;">
          Start Free Test <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Tool 3: All-India Colleges Directory -->
      <a href="{{ route('indian-colleges.index') }}" style="background:#f8fafc; border:1px solid var(--border); border-radius:var(--radius-lg); padding:24px; text-decoration:none; display:flex; flex-direction:column; transition:all 0.25s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#2563eb'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
        <div style="width:44px; height:44px; border-radius:12px; background:#ecfdf5; color:#059669; display:flex; align-items:center; justify-content:center; font-size:20px; margin-bottom:16px;">
          <i class="fa-solid fa-building-columns"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:16px; font-weight:700; color:var(--text-1); margin:0 0 6px;">90,000+ Colleges Directory</h3>
        <p style="font-size:13.5px; color:var(--text-2); line-height:1.5; margin:0 0 16px; flex:1;">
          Filter institutes by university, district, management type, courses offered, campus map, and student ratings.
        </p>
        <span style="font-size:13px; font-weight:700; color:#059669; display:inline-flex; align-items:center; gap:6px;">
          Search Colleges <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Tool 4: Daily Career Quiz & Leaderboard -->
      <a href="{{ route('daily-quiz.index') }}" style="background:#f8fafc; border:1px solid var(--border); border-radius:var(--radius-lg); padding:24px; text-decoration:none; display:flex; flex-direction:column; transition:all 0.25s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#2563eb'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border)'; this.style.boxShadow='none';">
        <div style="width:44px; height:44px; border-radius:12px; background:#f3e8ff; color:#7c3aed; display:flex; align-items:center; justify-content:center; font-size:20px; margin-bottom:16px;">
          <i class="fa-solid fa-brain"></i>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:16px; font-weight:700; color:var(--text-1); margin:0 0 6px;">Daily Quiz & Streak Challenge</h3>
        <p style="font-size:13.5px; color:var(--text-2); line-height:1.5; margin:0 0 16px; flex:1;">
          Build competitive exam confidence with 5 daily questions in General Knowledge, Reasoning, and Current Affairs.
        </p>
        <span style="font-size:13px; font-weight:700; color:#7c3aed; display:inline-flex; align-items:center; gap:6px;">
          Play Today's Quiz <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>
    </div>

    <!-- Additional quick link pills -->
    <div style="margin-top: 30px; display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
      <span style="font-size:13px; font-weight:700; color:var(--text-3); align-self:center; margin-right:6px;">Trending Guidance:</span>
      <a href="{{ route('guidance.mht-cet') }}" style="background:#f1f5f9; color:var(--text-1); padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">MHT-CET Strategy</a>
      <a href="{{ route('guidance.jee-neet') }}" style="background:#f1f5f9; color:var(--text-1); padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">JEE & NEET Hub</a>
      <a href="{{ route('guidance.upsc') }}" style="background:#f1f5f9; color:var(--text-1); padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">UPSC Civil Services</a>
      <a href="{{ route('jobs.index') }}" style="background:#f1f5f9; color:var(--text-1); padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Job Corner Vacancies</a>
      <a href="{{ route('explore.index') }}" style="background:#f1f5f9; color:var(--text-1); padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">5,000+ Career Roadmaps</a>
    </div>
  </div>
</section>

<!-- Related Posts -->
@if($relatedBlogs->count() > 0)
  <section class="related-section">
    <div class="container">
      <h2 style="font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; color: var(--text-1); margin-bottom: 36px; text-align: center;">Related Articles</h2>
      
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        @foreach($relatedBlogs as $rel)
          <article class="blog-card" style="background:#ffffff;">
            <div class="blog-img-wrap">
              @if($rel->cover_image)
                <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1000';" style="font-size: 0;">
              @else
                <i class="fa-solid fa-newspaper"></i>
              @endif
              <span class="blog-category-overlay">{{ $rel->category }}</span>
            </div>
            <div class="blog-body">
              <div class="blog-meta">
                <span><i class="fa-solid fa-calendar"></i> {{ $rel->published_at ? $rel->published_at->format('d M, Y') : $rel->created_at->format('d M, Y') }}</span>
              </div>
              <h3 class="blog-title" style="font-size:16px;">{{ $rel->title }}</h3>
              <p class="blog-excerpt" style="font-size:13.5px;">{{ $rel->excerpt ?: Str::limit(strip_tags($rel->content), 80) }}</p>
              <div class="blog-footer">
                <a href="{{ route('blog.show', $rel->slug) }}" class="blog-read-link">
                  Read Article <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
@endif

@endsection

@section('scripts')
<script>
  function copyToClipboard() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
      const btn = document.getElementById('copyBtn');
      const originalHtml = btn.innerHTML;
      btn.innerHTML = '<i class="fa-solid fa-check" style="color:#ffffff;"></i>';
      btn.style.backgroundColor = '#16a34a';
      btn.style.borderColor = '#16a34a';
      
      setTimeout(() => {
        btn.innerHTML = originalHtml;
        btn.style.backgroundColor = '';
        btn.style.borderColor = '';
      }, 2000);
    }).catch(err => {
      console.error('Failed to copy: ', err);
    });
  }
</script>
@endsection

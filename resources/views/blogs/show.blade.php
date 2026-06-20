@extends('layouts.app')

@section('title', $blog->title . ' - CareerGyan Blog')

@section('styles')
<style>
  /* ─── Blog Detail Styles ─── */
  .blog-detail-hero {
    position: relative;
    padding: 100px 0 80px;
    background-color: #0b1329;
    color: #ffffff;
    overflow: hidden;
  }

  .blog-detail-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    @if($blog->cover_image)
      background-image: url("{{ $blog->cover_image }}");
    @endif
    background-size: cover;
    background-position: center;
    filter: blur(20px) brightness(0.35);
    transform: scale(1.1);
    z-index: 0;
  }

  .blog-detail-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
  }

  .blog-detail-category {
    display: inline-block;
    background: #f97316;
    color: #ffffff;
    padding: 6px 16px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 24px;
  }

  .blog-detail-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4.5vw, 42px);
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 24px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  }

  .blog-detail-meta {
    display: flex;
    justify-content: center;
    gap: 24px;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.75);
    flex-wrap: wrap;
  }

  .blog-detail-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .blog-detail-meta i {
    color: #60a5fa;
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
            <img src="{{ $blog->cover_image }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; display: block;">
          </div>
        @endif

        <div class="article-content">
          {!! $blog->content !!}
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
                <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}">
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

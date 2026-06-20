@extends('layouts.app')

@section('title', 'CareerGyan Blog | Insights, Tips & Career Advice')

@section('styles')
<style>
  /* ─── Blog Listing Styles ─── */
  .blog-hero {
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 60%, #2563eb 100%);
    color: #ffffff;
    padding: 80px 0 70px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .blog-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1' fill='%23ffffff' fill-opacity='0.05'/%3E%3C/svg%3E");
    pointer-events: none;
  }

  .blog-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(32px, 5vw, 46px);
    font-weight: 800;
    margin-bottom: 16px;
    position: relative;
    z-index: 2;
  }

  .blog-hero p {
    font-size: 17px;
    color: rgba(255, 255, 255, 0.85);
    max-width: 600px;
    margin: 0 auto 32px;
    line-height: 1.6;
    position: relative;
    z-index: 2;
  }

  /* Search bar */
  .blog-search-container {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
  }

  .blog-search-wrap {
    position: relative;
  }

  .blog-search-wrap i {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-3);
  }

  .blog-search-input {
    width: 100%;
    padding: 14px 20px 14px 50px;
    border-radius: 99px;
    border: none;
    font-family: inherit;
    font-size: 15px;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
    color: var(--text-1);
  }

  .blog-search-input:focus {
    outline: none;
    box-shadow: 0 10px 25px rgba(26, 86, 219, 0.25);
  }

  /* Category pills */
  .category-pills-container {
    padding: 40px 0 24px;
    display: flex;
    justify-content: center;
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }

  .category-pills {
    display: inline-flex;
    gap: 12px;
    padding: 4px;
  }

  .category-pill {
    padding: 10px 22px;
    border-radius: 99px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    color: var(--text-2);
    background: #ffffff;
    border: 1px solid var(--border);
    transition: all 0.2s;
  }

  .category-pill:hover {
    border-color: var(--brand);
    color: var(--brand);
    transform: translateY(-1px);
  }

  .category-pill.active {
    background: var(--brand);
    color: #ffffff;
    border-color: var(--brand);
    box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);
  }

  /* Featured Post */
  .featured-post-section {
    margin-bottom: 50px;
  }

  .featured-card {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
  }

  .featured-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }

  .featured-img-wrap {
    height: 380px;
    position: relative;
    background: linear-gradient(135deg, var(--brand-light) 0%, var(--brand) 100%);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 72px;
  }

  .featured-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .featured-badge {
    position: absolute;
    top: 24px;
    left: 24px;
    background: #f97316;
    color: #ffffff;
    padding: 6px 16px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .featured-body {
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .featured-meta {
    font-size: 13px;
    color: var(--text-3);
    margin-bottom: 16px;
    display: flex;
    gap: 16px;
  }

  .featured-title {
    font-family: 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 800;
    color: var(--text-1);
    margin: 0 0 16px;
    line-height: 1.3;
  }

  .featured-excerpt {
    font-size: 15.5px;
    color: var(--text-2);
    line-height: 1.65;
    margin-bottom: 28px;
  }

  /* Grid listings */
  .blogs-grid-container {
    padding-bottom: 80px;
  }

  .blogs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
  }

  .blog-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  .blog-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(26, 86, 219, 0.2);
  }

  .blog-img-wrap {
    height: 200px;
    position: relative;
    background: linear-gradient(135deg, var(--brand-light) 0%, var(--brand) 100%);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 48px;
  }

  .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .blog-category-overlay {
    position: absolute;
    bottom: 16px;
    left: 16px;
    background: rgba(15, 23, 42, 0.75);
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(4px);
  }

  .blog-body {
    padding: 28px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .blog-meta {
    font-size: 12.5px;
    color: var(--text-3);
    margin-bottom: 12px;
    display: flex;
    gap: 12px;
  }

  .blog-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    margin: 0 0 12px;
    line-height: 1.4;
  }

  .blog-excerpt {
    font-size: 14px;
    color: var(--text-2);
    line-height: 1.6;
    margin-bottom: 24px;
    flex-grow: 1;
  }

  .blog-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid var(--border);
    padding-top: 16px;
    margin-top: auto;
  }

  .blog-read-link {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--brand);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .blog-card:hover .blog-read-link {
    gap: 10px;
  }

  .blog-views {
    font-size: 12.5px;
    color: var(--text-3);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* Custom Pagination */
  .blog-pagination {
    display: flex;
    justify-content: center;
    margin-top: 40px;
  }

  .blog-pagination nav {
    display: flex;
    gap: 8px;
  }

  .blog-pagination .page-item {
    list-style: none;
  }

  .blog-pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid var(--border);
    color: var(--text-1);
    text-decoration: none;
    font-weight: 700;
    transition: all 0.2s;
  }

  .blog-pagination .page-link:hover {
    border-color: var(--brand);
    color: var(--brand);
  }

  .blog-pagination .active .page-link {
    background: var(--brand);
    color: #ffffff;
    border-color: var(--brand);
    box-shadow: 0 4px 10px rgba(26, 86, 219, 0.2);
  }

  @media (max-width: 991px) {
    .featured-card {
      grid-template-columns: 1fr;
    }

    .featured-img-wrap {
      height: 250px;
    }
  }

  @media (max-width: 480px) {
    .blog-hero {
      padding: 60px 0 50px;
    }
    .blog-search-container {
      padding: 0 16px;
    }
    .blogs-grid {
      grid-template-columns: 1fr;
    }
    .featured-body {
      padding: 24px;
    }
  }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="blog-hero">
  <div class="container">
    <h1>CareerGyan Blog</h1>
    <p>Read trending articles, study tips, entrance exam guides, and career counseling advice from academic experts.</p>
    
    <div class="blog-search-container">
      <form action="{{ route('blog.index') }}" method="GET">
        @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <div class="blog-search-wrap">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="search" class="blog-search-input" placeholder="Search articles..." value="{{ request('search') }}">
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Category Filter Pills -->
<div class="container">
  <div class="category-pills-container">
    <div class="category-pills">
      @foreach($categories as $cat)
        @php
          $isActive = (request('category') == $cat) || (!request('category') && $cat == 'All');
          $targetCategory = ($cat == 'All') ? null : $cat;
        @endphp
        <a href="{{ route('blog.index', array_filter(['category' => $targetCategory, 'search' => request('search')])) }}" 
           class="category-pill {{ $isActive ? 'active' : '' }}">
          {{ $cat }}
        </a>
      @endforeach
    </div>
  </div>
</div>

<div class="container blogs-grid-container">

  <!-- 1. Featured Post Row (Only if present and on page 1) -->
  @if($featuredBlog)
    <div class="featured-post-section">
      <article class="featured-card">
        <div class="featured-img-wrap">
          @if($featuredBlog->cover_image)
            <img src="{{ $featuredBlog->cover_image }}" alt="{{ $featuredBlog->title }}">
          @else
            <i class="fa-solid fa-newspaper"></i>
          @endif
          <span class="featured-badge">{{ $featuredBlog->category }}</span>
        </div>
        <div class="featured-body">
          <div class="featured-meta">
            <span><i class="fa-solid fa-user-circle"></i> {{ $featuredBlog->author }}</span>
            <span><i class="fa-solid fa-calendar"></i> {{ $featuredBlog->published_at ? $featuredBlog->published_at->format('d M, Y') : $featuredBlog->created_at->format('d M, Y') }}</span>
          </div>
          <h2 class="featured-title">{{ $featuredBlog->title }}</h2>
          <p class="featured-excerpt">
            {{ $featuredBlog->excerpt ?: Str::limit(strip_tags($featuredBlog->content), 160) }}
          </p>
          <div>
            <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="btn-hero-primary" style="text-decoration:none;">
              Read Full Article <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </article>
    </div>
  @endif

  <!-- 2. Grid list of blogs -->
  @if($blogs->count() > 0)
    <div class="blogs-grid">
      @foreach($blogs as $blog)
        <article class="blog-card">
          <div class="blog-img-wrap">
            @if($blog->cover_image)
              <img src="{{ $blog->cover_image }}" alt="{{ $blog->title }}">
            @else
              <i class="fa-solid fa-newspaper"></i>
            @endif
            <span class="blog-category-overlay">{{ $blog->category }}</span>
          </div>

          <div class="blog-body">
            <div class="blog-meta">
              <span><i class="fa-solid fa-user"></i> {{ $blog->author }}</span>
              <span><i class="fa-solid fa-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('d M, Y') : $blog->created_at->format('d M, Y') }}</span>
            </div>
            <h3 class="blog-title">{{ $blog->title }}</h3>
            <p class="blog-excerpt">
              {{ $blog->excerpt ?: Str::limit(strip_tags($blog->content), 95) }}
            </p>
            <div class="blog-footer">
              <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-link">
                Read More <i class="fa-solid fa-arrow-right"></i>
              </a>
              <span class="blog-views">
                <i class="fa-regular fa-eye"></i> {{ $blog->views_count }}
              </span>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <!-- Laravel Pagination -->
    <div class="blog-pagination">
      {{ $blogs->appends(request()->query())->links() }}
    </div>

  @else
    <!-- Empty state -->
    <div style="text-align: center; padding: 80px 20px; background: #ffffff; border-radius: var(--radius-xl); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
      <i class="fa-solid fa-newspaper" style="font-size: 56px; color: var(--text-3); margin-bottom: 20px; display: block;"></i>
      <h2 style="font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-1); margin-bottom: 8px;">No Articles Found</h2>
      <p style="color: var(--text-2); font-size: 15px; max-width: 400px; margin: 0 auto 24px;">We couldn't find any blog posts matching your search query or selected category.</p>
      <a href="{{ route('blog.index') }}" class="btn-hero-primary" style="text-decoration:none;">Clear Filters</a>
    </div>
  @endif

</div>

@endsection

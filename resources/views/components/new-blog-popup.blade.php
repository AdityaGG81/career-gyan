@props(['newlyUploadedBlog' => null])

@php
    if (!isset($newlyUploadedBlog) || empty($newlyUploadedBlog)) {
        try {
            $newlyUploadedBlog = \App\Models\Blog::published()
                ->orderBy('published_at', 'desc')
                ->orderBy('id', 'desc')
                ->first();
        } catch (\Throwable $e) {
            $newlyUploadedBlog = null;
        }
    }
@endphp

@if(!request()->is('admin*') && !empty($newlyUploadedBlog) && !request()->is('blog/' . ($newlyUploadedBlog->slug ?? '')))
<div id="newBlogPopupOverlay" class="new-blog-overlay" role="dialog" aria-modal="true" aria-label="Latest Blog Post" data-blog-id="{{ $newlyUploadedBlog->id }}" onclick="handleOverlayClick(event)">
  <div class="new-blog-modal" onclick="event.stopPropagation()">
    <!-- Top Close Button -->
    <button type="button" class="new-blog-modal-close" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }})" title="Close notification" aria-label="Close modal">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Cover Image / Banner -->
    <div class="new-blog-modal-banner" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }}, '{{ route('blog.show', $newlyUploadedBlog->slug) }}')">
      @if(!empty($newlyUploadedBlog->cover_image) && (str_starts_with($newlyUploadedBlog->cover_image, 'http') || str_starts_with($newlyUploadedBlog->cover_image, '/')))
        <img src="{{ $newlyUploadedBlog->cover_image }}" alt="{{ $newlyUploadedBlog->title }}" class="new-blog-modal-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="new-blog-modal-img-fallback" style="display:none;">
          <i class="fa-solid fa-newspaper"></i>
        </div>
      @else
        <div class="new-blog-modal-img-fallback">
          <i class="fa-solid fa-newspaper"></i>
        </div>
      @endif
      <div class="new-blog-banner-overlay"></div>
      
      <!-- Badges on image -->
      <div class="new-blog-modal-badges">
        <span class="new-blog-badge-pill">
          <span class="new-blog-pulse-dot"></span>
          <i class="fa-solid fa-bolt"></i>
          <span>LATEST BLOG POST</span>
        </span>
        <span class="new-blog-category-pill">
          {{ $newlyUploadedBlog->category ?? 'Career Insights' }}
        </span>
      </div>
    </div>

    <!-- Modal Content -->
    <div class="new-blog-modal-content">
      <h3 class="new-blog-modal-title" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }}, '{{ route('blog.show', $newlyUploadedBlog->slug) }}')">
        {{ $newlyUploadedBlog->title }}
      </h3>

      <p class="new-blog-modal-excerpt">
        {{ Str::limit($newlyUploadedBlog->excerpt ?: strip_tags($newlyUploadedBlog->content), 140) }}
      </p>

      <div class="new-blog-modal-meta">
        <span class="new-blog-meta-item">
          <i class="fa-regular fa-clock"></i>
          {{ $newlyUploadedBlog->published_at ? $newlyUploadedBlog->published_at->diffForHumans() : 'Recently posted' }}
        </span>
        @if(!empty($newlyUploadedBlog->author))
          <span class="new-blog-meta-divider">•</span>
          <span class="new-blog-meta-item">
            <i class="fa-regular fa-user"></i>
            {{ $newlyUploadedBlog->author }}
          </span>
        @endif
      </div>

      <!-- Action Buttons -->
      <div class="new-blog-modal-actions">
        <button type="button" class="new-blog-btn-secondary" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }})">
          Maybe Later
        </button>
        <a href="{{ route('blog.show', $newlyUploadedBlog->slug) }}" 
           onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }})" 
           class="new-blog-btn-primary">
          <span>Read Full Article</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  /* ─── Full-Page Backdrop Overlay ─── */
  .new-blog-overlay {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 99999999 !important;
    background: rgba(8, 14, 26, 0.78);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.35s ease;
  }

  .new-blog-overlay.show {
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
  }

  /* ─── Center Modal Card ─── */
  .new-blog-modal {
    position: relative;
    width: 100%;
    max-width: 580px;
    max-height: 90vh;
    overflow-y: auto;
    background: linear-gradient(180deg, #0f172a 0%, #0b1120 100%);
    border: 1px solid rgba(59, 130, 246, 0.45);
    border-radius: 24px;
    box-shadow: 
      0 25px 60px -15px rgba(0, 0, 0, 0.8),
      0 0 50px rgba(37, 99, 235, 0.3);
    color: #ffffff;
    font-family: 'DM Sans', system-ui, sans-serif;
    transform: scale(0.92) translateY(24px);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .new-blog-overlay.show .new-blog-modal {
    transform: scale(1) translateY(0);
  }

  /* ─── Modal Close Button ─── */
  .new-blog-modal-close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 10;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .new-blog-modal-close:hover {
    background: rgba(239, 68, 68, 0.85);
    color: #ffffff;
    transform: rotate(90deg) scale(1.05);
    border-color: rgba(239, 68, 68, 0.9);
  }

  /* ─── Banner / Image Header ─── */
  .new-blog-modal-banner {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    cursor: pointer;
    background: linear-gradient(135deg, #1e3a8a 0%, #172554 100%);
    border-top-left-radius: 24px;
    border-top-right-radius: 24px;
  }

  .new-blog-modal-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .new-blog-modal:hover .new-blog-modal-img {
    transform: scale(1.05);
  }

  .new-blog-modal-img-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 54px;
    color: rgba(96, 165, 250, 0.7);
  }

  .new-blog-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.85) 100%);
    pointer-events: none;
  }

  /* Badges over image */
  .new-blog-modal-badges {
    position: absolute;
    bottom: 14px;
    left: 20px;
    right: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    z-index: 2;
  }

  .new-blog-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(37, 99, 235, 0.9);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(96, 165, 250, 0.7);
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.6px;
    padding: 4px 12px;
    border-radius: 999px;
    text-transform: uppercase;
  }

  .new-blog-pulse-dot {
    width: 6px;
    height: 6px;
    background: #60a5fa;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(96, 165, 250, 0.7);
    animation: pulseDot 1.6s infinite;
  }

  @keyframes pulseDot {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(96, 165, 250, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(96, 165, 250, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(96, 165, 250, 0); }
  }

  .new-blog-category-pill {
    display: inline-flex;
    align-items: center;
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #38bdf8;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* ─── Modal Content Body ─── */
  .new-blog-modal-content {
    padding: 24px;
  }

  .new-blog-modal-title {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: #f8fafc;
    line-height: 1.35;
    margin: 0 0 10px 0;
    cursor: pointer;
    transition: color 0.2s ease;
  }

  .new-blog-modal-title:hover {
    color: #60a5fa;
  }

  .new-blog-modal-excerpt {
    font-size: 14px;
    color: #94a3b8;
    line-height: 1.6;
    margin: 0 0 16px 0;
  }

  .new-blog-modal-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 22px;
    padding-bottom: 18px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .new-blog-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .new-blog-meta-divider {
    color: #475569;
  }

  /* ─── Modal Action Buttons ─── */
  .new-blog-modal-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
  }

  .new-blog-btn-secondary {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #94a3b8;
    font-size: 13.5px;
    font-weight: 600;
    padding: 10px 18px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .new-blog-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #f8fafc;
    border-color: rgba(255, 255, 255, 0.3);
  }

  .new-blog-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 12px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
    transition: all 0.25s ease;
  }

  .new-blog-btn-primary:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.55);
    transform: translateY(-1px);
    color: #ffffff !important;
  }

  @media (max-width: 640px) {
    .new-blog-modal {
      border-radius: 20px;
    }
    .new-blog-modal-banner {
      height: 180px;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }
    .new-blog-modal-content {
      padding: 18px;
    }
    .new-blog-modal-title {
      font-size: 17px;
    }
    .new-blog-modal-actions {
      flex-direction: column-reverse;
      gap: 10px;
    }
    .new-blog-btn-secondary,
    .new-blog-btn-primary {
      width: 100%;
      justify-content: center;
      text-align: center;
    }
  }
</style>

<script>
  window.dismissNewBlogPopup = function(blogId, redirectUrl) {
    const overlay = document.getElementById('newBlogPopupOverlay');
    if (overlay) {
      overlay.classList.remove('show');
    }
    try {
      sessionStorage.setItem('cg_popup_dismissed_' + blogId, 'true');
    } catch (e) {}

    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  };

  function handleOverlayClick(event) {
    // Dismiss if clicked directly on the overlay background
    if (event.target.id === 'newBlogPopupOverlay') {
      const blogId = event.target.getAttribute('data-blog-id');
      window.dismissNewBlogPopup(blogId);
    }
  }

  // Dismiss on Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const overlay = document.getElementById('newBlogPopupOverlay');
      if (overlay && overlay.classList.contains('show')) {
        const blogId = overlay.getAttribute('data-blog-id');
        window.dismissNewBlogPopup(blogId);
      }
    }
  });

  (function initNewBlogPopup() {
    // Clear old localStorage blockers
    try {
      localStorage.removeItem('cg_dismissed_blog_id');
      localStorage.removeItem('cg_dismissed_blog_time_{{ $newlyUploadedBlog->id }}');
    } catch (e) {}

    const overlay = document.getElementById('newBlogPopupOverlay');
    if (!overlay) return;

    const blogId = overlay.getAttribute('data-blog-id');
    let isDismissed = false;

    try {
      if (sessionStorage.getItem('cg_popup_dismissed_' + blogId) === 'true') {
        isDismissed = true;
      }
    } catch (e) {}

    if (!isDismissed) {
      const show = function() {
        const el = document.getElementById('newBlogPopupOverlay');
        if (el) {
          el.classList.add('show');
        }
      };

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          setTimeout(show, 800);
        });
      } else {
        setTimeout(show, 800);
      }
    }
  })();
</script>
@endif

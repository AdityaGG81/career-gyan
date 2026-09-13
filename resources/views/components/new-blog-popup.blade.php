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
<div id="newBlogPopup" class="new-blog-popup" role="dialog" aria-label="Newly Published Blog Notification" data-blog-id="{{ $newlyUploadedBlog->id }}">
  <div class="new-blog-card">
    <div class="new-blog-header">
      <div class="new-blog-badge">
        <span class="new-blog-pulse"></span>
        <i class="fa-solid fa-bolt" style="color:#60a5fa;"></i>
        <span>NEW BLOG POST</span>
      </div>
      <button type="button" class="new-blog-close-btn" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }})" title="Dismiss" aria-label="Close notification">&times;</button>
    </div>

    <div class="new-blog-body" onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }}, '{{ route('blog.show', $newlyUploadedBlog->slug) }}')">
      <div class="new-blog-media">
        @if(!empty($newlyUploadedBlog->cover_image) && (str_starts_with($newlyUploadedBlog->cover_image, 'http') || str_starts_with($newlyUploadedBlog->cover_image, '/')))
          <img src="{{ $newlyUploadedBlog->cover_image }}" alt="{{ $newlyUploadedBlog->title }}" class="new-blog-thumb" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="new-blog-icon-fallback" style="display:none;"><i class="fa-solid fa-newspaper"></i></div>
        @else
          <div class="new-blog-icon-fallback"><i class="fa-solid fa-newspaper"></i></div>
        @endif
      </div>
      <div class="new-blog-details">
        <div class="new-blog-category">{{ $newlyUploadedBlog->category ?? 'Career Insights' }}</div>
        <h4 class="new-blog-title">{{ $newlyUploadedBlog->title }}</h4>
        <p class="new-blog-excerpt">{{ Str::limit($newlyUploadedBlog->excerpt ?: strip_tags($newlyUploadedBlog->content), 80) }}</p>
      </div>
    </div>

    <div class="new-blog-footer">
      <span class="new-blog-time">
        <i class="fa-regular fa-clock"></i> {{ $newlyUploadedBlog->published_at ? $newlyUploadedBlog->published_at->diffForHumans() : 'Just posted' }}
      </span>
      <a href="{{ route('blog.show', $newlyUploadedBlog->slug) }}" 
         onclick="window.dismissNewBlogPopup({{ $newlyUploadedBlog->id }})" 
         class="new-blog-read-btn">
        <span>Read Post</span>
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>
</div>

<style>
  .new-blog-popup {
    position: fixed;
    top: 85px;
    right: 24px;
    z-index: 9999999 !important;
    width: 380px;
    max-width: calc(100vw - 32px);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-20px) scale(0.95);
    transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.4s ease;
  }

  .new-blog-popup.show {
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
    transform: translateY(0) scale(1) !important;
  }

  .new-blog-card {
    background: rgba(15, 23, 42, 0.96);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid rgba(59, 130, 246, 0.55);
    border-radius: 18px;
    padding: 14px 16px;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.55), 0 0 35px rgba(37, 99, 235, 0.35);
    transition: all 0.3s ease;
  }

  .new-blog-card:hover {
    border-color: rgba(96, 165, 250, 0.9);
    box-shadow: 0 24px 50px rgba(15, 23, 42, 0.65), 0 0 45px rgba(37, 99, 235, 0.45);
  }

  .new-blog-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  .new-blog-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(37, 99, 235, 0.25);
    border: 1px solid rgba(59, 130, 246, 0.5);
    color: #93c5fd;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.6px;
    padding: 3.5px 10px;
    border-radius: 20px;
    text-transform: uppercase;
  }

  .new-blog-pulse {
    width: 7px;
    height: 7px;
    background: #3b82f6;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
    animation: blogPulse 1.6s infinite;
  }

  @keyframes blogPulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 7px rgba(59, 130, 246, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
  }

  .new-blog-close-btn {
    background: rgba(255, 255, 255, 0.08);
    border: none;
    color: #94a3b8;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    cursor: pointer;
    line-height: 1;
    transition: all 0.2s ease;
  }

  .new-blog-close-btn:hover {
    background: rgba(239, 68, 68, 0.3);
    color: #f87171;
    transform: rotate(90deg);
  }

  .new-blog-body {
    display: flex;
    gap: 12px;
    cursor: pointer;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    text-decoration: none;
  }

  .new-blog-media {
    flex-shrink: 0;
    width: 58px;
    height: 58px;
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.3), rgba(14, 165, 233, 0.2));
    border: 1px solid rgba(59, 130, 246, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .new-blog-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .new-blog-icon-fallback {
    color: #60a5fa;
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
  }

  .new-blog-details {
    flex: 1;
    min-width: 0;
  }

  .new-blog-category {
    font-size: 11px;
    font-weight: 700;
    color: #38bdf8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 3px;
  }

  .new-blog-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #f8fafc;
    line-height: 1.35;
    margin: 0 0 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s ease;
  }

  .new-blog-body:hover .new-blog-title {
    color: #60a5fa;
  }

  .new-blog-excerpt {
    font-size: 12px;
    color: #94a3b8;
    line-height: 1.4;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .new-blog-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
  }

  .new-blog-time {
    font-size: 11px;
    color: #94a3b8;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .new-blog-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 10px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    transition: all 0.25s ease;
  }

  .new-blog-read-btn:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.45);
    color: #ffffff !important;
  }

  @media (max-width: 640px) {
    .new-blog-popup {
      top: 75px;
      right: 14px;
      left: 14px;
      width: auto;
    }
  }
</style>

<script>
  window.dismissNewBlogPopup = function(blogId, redirectUrl) {
    const popup = document.getElementById('newBlogPopup');
    if (popup) {
      popup.classList.remove('show');
    }
    try {
      sessionStorage.setItem('cg_popup_dismissed_' + blogId, 'true');
    } catch (e) {}

    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  };

  (function initNewBlogPopup() {
    // Clear old permanent dismiss keys from localStorage that may have blocked the popup
    try {
      localStorage.removeItem('cg_dismissed_blog_id');
      localStorage.removeItem('cg_dismissed_blog_time_{{ $newlyUploadedBlog->id }}');
    } catch (e) {}

    const popup = document.getElementById('newBlogPopup');
    if (!popup) return;

    const blogId = popup.getAttribute('data-blog-id');
    let isDismissed = false;

    try {
      if (sessionStorage.getItem('cg_popup_dismissed_' + blogId) === 'true') {
        isDismissed = true;
      }
    } catch (e) {}

    if (!isDismissed) {
      const display = function() {
        const p = document.getElementById('newBlogPopup');
        if (p) {
          p.classList.add('show');
        }
      };

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          setTimeout(display, 800);
        });
      } else {
        setTimeout(display, 800);
      }
    }
  })();
</script>
@endif

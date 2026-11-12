@props(['internship' => null])

@php
    if (!isset($internship) || empty($internship)) {
        try {
            $internship = \App\Models\JobListing::where('status', 'active')
                ->where('last_date', '>=', now()->startOfDay())
                ->where(function ($q) {
                    $q->where('job_title', 'like', '%intern%')
                      ->orWhere('description', 'like', '%intern%')
                      ->orWhere('category', 'like', '%intern%');
                })
                ->latest('id')
                ->first();

            if (!$internship) {
                $internship = \App\Models\JobListing::where('status', 'active')
                    ->where('last_date', '>=', now()->startOfDay())
                    ->latest('id')
                    ->first();
            }
        } catch (\Throwable $e) {
            $internship = null;
        }
    }
@endphp

@if(!request()->is('admin*') && !empty($internship) && !request()->is('job-corner/' . ($internship->id ?? '')))
<div id="internshipPopupOverlay" class="intern-overlay" role="dialog" aria-modal="true" aria-label="Latest Internship Opportunity" data-intern-id="{{ $internship->id }}" onclick="handleInternOverlayClick(event)">
  <div class="intern-modal" onclick="event.stopPropagation()">
    
    <!-- Top Close Button -->
    <button type="button" class="intern-modal-close" onclick="window.dismissInternshipPopup({{ $internship->id }})" title="Close notification" aria-label="Close modal">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Header Banner -->
    <div class="intern-modal-banner" onclick="window.dismissInternshipPopup({{ $internship->id }}, '{{ route('jobs.show', $internship->id) }}')">
      <div class="intern-banner-bg"></div>

      <!-- Top Badges -->
      <div class="intern-top-badges">
        <span class="intern-badge-pulse">
          <span class="intern-pulse-dot"></span>
          <i class="fa-solid fa-bolt"></i>
          <span>LATEST INTERNSHIP ALERT</span>
        </span>
        <span class="intern-batch-tag">
          <i class="fa-solid fa-graduation-cap"></i> 2026 Batch
        </span>
      </div>

      <!-- Company Identity -->
      <div class="intern-company-row">
        <div class="intern-company-avatar">
          @php
            $companyInitial = strtoupper(substr($internship->company_name ?: 'C', 0, 1));
          @endphp
          <i class="fa-solid fa-briefcase"></i>
        </div>
        <div class="intern-company-meta">
          <span class="intern-company-label">Hiring Company</span>
          <h4 class="intern-company-name">{{ $internship->company_name }}</h4>
        </div>
      </div>
    </div>

    <!-- Modal Content -->
    <div class="intern-modal-body">
      <h3 class="intern-modal-title" onclick="window.dismissInternshipPopup({{ $internship->id }}, '{{ route('jobs.show', $internship->id) }}')">
        {{ $internship->job_title }}
      </h3>

      <!-- Key Details Grid -->
      <div class="intern-details-grid">
        <div class="intern-detail-chip">
          <i class="fa-solid fa-location-dot" style="color: #ef4444;"></i>
          <span><strong>Location:</strong> {{ $internship->location }}</span>
        </div>

        <div class="intern-detail-chip">
          <i class="fa-solid fa-user-graduate" style="color: #2563eb;"></i>
          <span><strong>Eligibility:</strong> {{ $internship->qualification }}</span>
        </div>

        <div class="intern-detail-chip">
          <i class="fa-solid fa-calendar-check" style="color: #10b981;"></i>
          @php
            $daysLeft = now()->startOfDay()->diffInDays($internship->last_date, false);
          @endphp
          <span><strong>Deadline:</strong> {{ $internship->last_date ? $internship->last_date->format('d M Y') : 'Open' }} ({{ $daysLeft > 0 ? $daysLeft . ' days left' : 'Closing Soon' }})</span>
        </div>

        <div class="intern-detail-chip">
          <i class="fa-solid fa-building" style="color: #f59e0b;"></i>
          <span><strong>Sector:</strong> {{ $internship->category ?: 'Corporate / Tech' }}</span>
        </div>
      </div>

      <!-- Description / Overview -->
      <p class="intern-modal-desc">
        {{ Str::limit($internship->description ?: 'Gain real-world industry experience, mentorship from senior engineers, and earn verified certification and stipend.', 160) }}
      </p>

      <!-- Trust & Highlights Bar -->
      <div class="intern-trust-bar">
        <span class="intern-trust-item"><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> Verified Opportunity</span>
        <span class="intern-trust-item"><i class="fa-solid fa-award" style="color: #f59e0b;"></i> Official Certificate</span>
        <span class="intern-trust-item"><i class="fa-solid fa-file-shield" style="color: #2563eb;"></i> Free Application</span>
      </div>

      <!-- Action Buttons -->
      <div class="intern-modal-actions">
        <button type="button" class="intern-btn-secondary" onclick="window.dismissInternshipPopup({{ $internship->id }})">
          Maybe Later
        </button>

        <a href="{{ route('jobs.show', $internship->id) }}" 
           onclick="window.dismissInternshipPopup({{ $internship->id }})" 
           class="intern-btn-primary">
          <span>View & Apply Now</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <!-- Footer Browse All Link -->
      <div style="text-align: center; margin-top: 12px;">
        <a href="{{ route('jobs.index', ['search' => 'internship']) }}" onclick="window.dismissInternshipPopup({{ $internship->id }})" style="font-size: 12px; font-weight: 700; color: #64748b; text-decoration: underline;" onmouseover="this.style.color='#2563eb'" onmouseout="this.style.color='#64748b'">
          <i class="fa-solid fa-magnifying-glass"></i> Browse All Student Internships & Jobs
        </a>
      </div>

    </div>

  </div>
</div>

<style>
  /* ─── Full-Page Backdrop Overlay ─── */
  .intern-overlay {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 99999999 !important;
    background: rgba(8, 14, 26, 0.75);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1),
                visibility 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .intern-overlay.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }

  /* ─── Modal Dialog Window ─── */
  .intern-modal {
    position: relative;
    width: 100%;
    max-width: 520px;
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.1);
    transform: scale(0.92) translateY(20px);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .intern-overlay.show .intern-modal {
    transform: scale(1) translateY(0);
  }

  /* Close button */
  .intern-modal-close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 10;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .intern-modal-close:hover {
    background: rgba(239, 68, 68, 0.95);
    transform: rotate(90deg);
  }

  /* Banner */
  .intern-modal-banner {
    position: relative;
    padding: 24px 22px 20px;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #1a56db 100%);
    color: #ffffff;
    cursor: pointer;
    overflow: hidden;
  }

  .intern-banner-bg {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 80% 20%, rgba(37, 99, 235, 0.4) 0%, transparent 60%),
                      radial-gradient(circle at 10% 80%, rgba(245, 158, 11, 0.25) 0%, transparent 50%);
    pointer-events: none;
  }

  .intern-top-badges {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    gap: 8px;
    flex-wrap: wrap;
  }

  .intern-badge-pulse {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid rgba(239, 68, 68, 0.5);
    color: #fca5a5;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .intern-pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ef4444;
    box-shadow: 0 0 8px #ef4444;
    animation: internPulse 1.5s infinite;
  }

  @keyframes internPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.4); opacity: 0.6; }
  }

  .intern-batch-tag {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: #ffffff;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
  }

  .intern-company-row {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .intern-company-avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    border: 1.5px solid rgba(255, 255, 255, 0.35);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.25);
    flex-shrink: 0;
  }

  .intern-company-label {
    font-size: 11px;
    color: #94a3b8;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
  }

  .intern-company-name {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 19px;
    font-weight: 800;
    color: #ffffff;
    margin: 2px 0 0;
    line-height: 1.2;
  }

  /* Body Content */
  .intern-modal-body {
    padding: 22px 24px 20px;
  }

  .intern-modal-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.35;
    margin-bottom: 14px;
    cursor: pointer;
    transition: color 0.15s;
  }
  .intern-modal-title:hover {
    color: #1a56db;
  }

  /* Details Grid */
  .intern-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-bottom: 14px;
  }
  @media (max-width: 480px) {
    .intern-details-grid {
      grid-template-columns: 1fr;
    }
  }

  .intern-detail-chip {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 7px 10px;
    font-size: 12px;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 7px;
  }
  .intern-detail-chip i {
    font-size: 13px;
    flex-shrink: 0;
  }

  .intern-modal-desc {
    font-size: 13px;
    color: #475569;
    line-height: 1.55;
    margin-bottom: 14px;
  }

  /* Trust Bar */
  .intern-trust-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    font-size: 11.5px;
    font-weight: 700;
    color: #475569;
    background: #f1f5f9;
    padding: 8px 12px;
    border-radius: 8px;
    margin-bottom: 18px;
  }
  .intern-trust-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  /* Actions */
  .intern-modal-actions {
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .intern-btn-secondary {
    flex: 1;
    padding: 11px 16px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .intern-btn-secondary:hover {
    background: #f8fafc;
    color: #0f172a;
    border-color: #94a3b8;
  }

  .intern-btn-primary {
    flex: 1.8;
    padding: 11px 18px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #1a56db 0%, #1d4ed8 100%);
    color: #ffffff;
    font-weight: 800;
    font-size: 13.5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(26, 86, 219, 0.35);
    transition: all 0.2s;
  }
  .intern-btn-primary:hover {
    background: linear-gradient(135deg, #1341a8 0%, #1e40af 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(26, 86, 219, 0.45);
    color: #ffffff;
  }
</style>

<script>
  window.dismissInternshipPopup = function(internId, redirectUrl) {
    const overlay = document.getElementById('internshipPopupOverlay');
    if (overlay) {
      overlay.classList.remove('show');
    }
    try {
      sessionStorage.setItem('cg_internship_dismissed_' + internId, 'true');
    } catch (e) {}

    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  };

  function handleInternOverlayClick(event) {
    if (event.target.id === 'internshipPopupOverlay') {
      const internId = event.target.getAttribute('data-intern-id');
      window.dismissInternshipPopup(internId);
    }
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const overlay = document.getElementById('internshipPopupOverlay');
      if (overlay && overlay.classList.contains('show')) {
        const internId = overlay.getAttribute('data-intern-id');
        window.dismissInternshipPopup(internId);
      }
    }
  });

  (function initInternshipPopup() {
    const overlay = document.getElementById('internshipPopupOverlay');
    if (!overlay) return;

    const internId = overlay.getAttribute('data-intern-id');
    let isDismissed = false;

    try {
      if (sessionStorage.getItem('cg_internship_dismissed_' + internId) === 'true') {
        isDismissed = true;
      }
    } catch (e) {}

    if (!isDismissed) {
      setTimeout(function() {
        const el = document.getElementById('internshipPopupOverlay');
        if (el) {
          el.classList.add('show');
        }
      }, 1200);
    }
  })();
</script>
@endif

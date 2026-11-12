@php
    $shouldShow = !request()->is('admin*') 
               && !request()->is('membership*') 
               && (!Auth::check() || !Auth::user()->hasActiveMembership());
@endphp

@if($shouldShow)
<div id="membershipPopupOverlay" class="member-overlay" role="dialog" aria-modal="true" aria-label="CareerGyan VIP Pro Membership" onclick="handleMemberOverlayClick(event)">
  <div class="member-modal" onclick="event.stopPropagation()">
    
    <!-- Top Close Button -->
    <button type="button" class="member-modal-close" onclick="window.dismissMembershipPopup()" title="Close notification" aria-label="Close modal">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Header Banner -->
    <div class="member-modal-banner" onclick="window.dismissMembershipPopup('{{ route('membership.index') }}')">
      <div class="member-banner-glow"></div>

      <!-- Top VIP Badge -->
      <div class="member-top-pill">
        <span class="member-crown-icon"><i class="fa-solid fa-crown"></i></span>
        <span>CAREERGYAN VIP PRO ACCESS</span>
        <span class="member-pulse-sparkle">★</span>
      </div>

      <h3 class="member-banner-heading">
        Accelerate Your Career with CareerGyan Pro VIP
      </h3>
      <p class="member-banner-sub">
        Get priority 1-on-1 mentorship, full college cutoffs, predictor tools, and unlimited tests.
      </p>
    </div>

    <!-- Modal Content Body -->
    <div class="member-modal-body">
      
      <!-- Highlights Grid -->
      <div class="member-perks-list">
        <div class="member-perk-item">
          <div class="member-perk-icon" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div>
            <h5 class="member-perk-title">Accurate College Cutoffs & Predictor</h5>
            <p class="member-perk-desc">Access category-wise closing ranks, quota insights, and round-by-round seat matrix data.</p>
          </div>
        </div>

        <div class="member-perk-item">
          <div class="member-perk-icon" style="background: rgba(59, 130, 246, 0.15); color: #3b82f6;">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <div>
            <h5 class="member-perk-title">Priority 1-on-1 WhatsApp Mentorship</h5>
            <p class="member-perk-desc">Direct messaging access to expert education counselors for personalized advice.</p>
          </div>
        </div>

        <div class="member-perk-item">
          <div class="member-perk-icon" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
            <i class="fa-solid fa-bolt"></i>
          </div>
          <div>
            <h5 class="member-perk-title">Unlimited Aptitude & Specialized Tests</h5>
            <p class="member-perk-desc">Full access to Advanced Psychometric, Artistic, Spiritual, and Sports test series.</p>
          </div>
        </div>

        <div class="member-perk-item">
          <div class="member-perk-icon" style="background: rgba(139, 92, 246, 0.15); color: #8b5cf6;">
            <i class="fa-solid fa-certificate"></i>
          </div>
          <div>
            <h5 class="member-perk-title">Digital Certificates of Completion</h5>
            <p class="member-perk-desc">Earn verified credentials and official certificates to showcase on your resume and LinkedIn.</p>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="member-modal-actions">
        <button type="button" class="member-btn-secondary" onclick="window.dismissMembershipPopup()">
          Maybe Later
        </button>

        <a href="{{ route('membership.index') }}" 
           onclick="window.dismissMembershipPopup()" 
           class="member-btn-primary">
          <i class="fa-solid fa-crown"></i>
          <span>Get Pro Membership</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <!-- Security / Guarantee footer -->
      <div class="member-trust-note">
        <i class="fa-solid fa-shield-halved" style="color: #10b981;"></i>
        <span>Trusted by 50,000+ Students Across India • Instant Activation</span>
      </div>

    </div>

  </div>
</div>

<style>
  /* ─── Backdrop Overlay ─── */
  .member-overlay {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 99999999 !important;
    background: rgba(8, 14, 26, 0.78);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
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

  .member-overlay.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }

  /* ─── Dialog Card ─── */
  .member-modal {
    position: relative;
    width: 100%;
    max-width: 520px;
    background: #ffffff;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.45),
                0 0 0 1px rgba(251, 191, 36, 0.25);
    transform: scale(0.92) translateY(20px);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .member-overlay.show .member-modal {
    transform: scale(1) translateY(0);
  }

  /* Close Button */
  .member-modal-close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 10;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: #ffffff;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .member-modal-close:hover {
    background: rgba(239, 68, 68, 0.95);
    transform: rotate(90deg);
  }

  /* Banner */
  .member-modal-banner {
    position: relative;
    padding: 30px 24px 22px;
    background: radial-gradient(circle at top, #1e1b4b 0%, #0f172a 100%);
    color: #ffffff;
    cursor: pointer;
    text-align: center;
    overflow: hidden;
    border-bottom: 2px solid #fbbf24;
  }

  .member-banner-glow {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% -20%, rgba(251, 191, 36, 0.3) 0%, transparent 70%);
    pointer-events: none;
  }

  .member-top-pill {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
    color: #78350f;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35);
    margin-bottom: 12px;
  }

  .member-crown-icon {
    font-size: 13px;
  }

  .member-pulse-sparkle {
    font-size: 13px;
    animation: sparkleSpin 2s infinite linear;
  }
  @keyframes sparkleSpin {
    0% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.3) rotate(180deg); }
    100% { transform: scale(1) rotate(360deg); }
  }

  .member-banner-heading {
    position: relative;
    z-index: 2;
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 21px;
    font-weight: 800;
    line-height: 1.28;
    color: #ffffff;
    margin: 0 0 8px;
    background: linear-gradient(135deg, #ffffff 0%, #fef08a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .member-banner-sub {
    position: relative;
    z-index: 2;
    font-size: 13px;
    color: #cbd5e1;
    line-height: 1.5;
    margin: 0;
  }

  /* Body Content */
  .member-modal-body {
    padding: 24px 24px 20px;
    background: #ffffff;
  }

  .member-perks-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 22px;
  }

  .member-perk-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .member-perk-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  .member-perk-title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 2px;
    line-height: 1.3;
  }

  .member-perk-desc {
    font-size: 12px;
    color: #64748b;
    margin: 0;
    line-height: 1.45;
  }

  /* Actions */
  .member-modal-actions {
    display: flex;
    gap: 12px;
    align-items: center;
  }

  .member-btn-secondary {
    flex: 1;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    font-weight: 700;
    font-size: 13.5px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .member-btn-secondary:hover {
    background: #f8fafc;
    color: #0f172a;
    border-color: #94a3b8;
  }

  .member-btn-primary {
    flex: 2;
    padding: 12px 20px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #ffffff;
    font-weight: 800;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.4);
    transition: all 0.2s;
  }
  .member-btn-primary:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.55);
    color: #ffffff;
  }

  .member-trust-note {
    text-align: center;
    font-size: 11.5px;
    font-weight: 600;
    color: #94a3b8;
    margin-top: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
</style>

<script>
  window.dismissMembershipPopup = function(redirectUrl) {
    const overlay = document.getElementById('membershipPopupOverlay');
    if (overlay) {
      overlay.classList.remove('show');
    }
    try {
      sessionStorage.setItem('cg_membership_popup_dismissed', 'true');
    } catch (e) {}

    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  };

  function handleMemberOverlayClick(event) {
    if (event.target.id === 'membershipPopupOverlay') {
      window.dismissMembershipPopup();
    }
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const overlay = document.getElementById('membershipPopupOverlay');
      if (overlay && overlay.classList.contains('show')) {
        window.dismissMembershipPopup();
      }
    }
  });

  (function initMembershipPopup() {
    const overlay = document.getElementById('membershipPopupOverlay');
    if (!overlay) return;

    let isDismissed = false;
    try {
      if (sessionStorage.getItem('cg_membership_popup_dismissed') === 'true') {
        isDismissed = true;
      }
    } catch (e) {}

    if (!isDismissed) {
      setTimeout(function() {
        const el = document.getElementById('membershipPopupOverlay');
        if (el) {
          el.classList.add('show');
        }
      }, 1500);
    }
  })();
</script>
@endif


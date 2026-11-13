@extends('careerguru.layout')

@section('title', 'Referral Link & Share')
@section('page-title', 'Referral Hub & Share Tools')

@section('styles')
<style>
  .hub-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 24px;
  }
  @media (max-width: 991px) {
    .hub-grid { grid-template-columns: 1fr; }
  }
  .link-box {
    background: #f8fafc;
    border: 1px solid var(--guru-border);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
  }
  .link-url {
    font-family: monospace;
    font-size: 13.5px;
    color: #1e293b;
    word-break: break-all;
    background: #fff;
    padding: 10px 14px;
    border: 1px solid var(--guru-border);
    border-radius: 8px;
    margin: 8px 0 12px;
  }
</style>
@endsection

@section('content')

  <div style="margin-bottom: 24px;">
    <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Your Referral Links & Outreach</h2>
    <p style="font-size:13px; color:#64748b;">
      Share your unique partner links with students. Any student who registers through your link is automatically attributed to your account.
    </p>
  </div>

  <div class="hub-grid">
    <!-- Left Column: Links & WhatsApp -->
    <div>
      <!-- Primary Referral Link -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-link" style="color:#2563eb;"></i> Primary Partner Referral Link
          </h3>
          <span class="status-pill pill-blue">{{ $guru->referral_code }}</span>
        </div>
        <div class="guru-card-body">
          <p style="font-size:13px; color:#64748b; margin-bottom:6px;">
            This link sets a 30-day tracking cookie and redirects the student directly to CareerGyan registration with your partner tag:
          </p>
          <div class="link-url">{{ $referralUrl }}</div>
          <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button type="button" class="btn btn-primary" onclick="copyReferralLink('{{ $referralUrl }}', this)">
              <i class="fa-regular fa-copy"></i> <span>Copy Referral Link</span>
            </button>
            <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-success">
              <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
            </a>
          </div>
        </div>
      </div>

      <!-- Direct Signup URL -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-user-plus" style="color:#10b981;"></i> Direct Signup Form Link
          </h3>
        </div>
        <div class="guru-card-body">
          <p style="font-size:13px; color:#64748b; margin-bottom:6px;">
            Opens the student registration page directly with your referral code already locked into the URL query parameters:
          </p>
          <div class="link-url">{{ $directSignupUrl }}</div>
          <button type="button" class="btn btn-outline" onclick="copyReferralLink('{{ $directSignupUrl }}', this)">
            <i class="fa-regular fa-copy"></i> <span>Copy Direct Link</span>
          </button>
        </div>
      </div>

      <!-- WhatsApp / SMS Message Template -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-brands fa-whatsapp" style="color:#25d366;"></i> WhatsApp / SMS Guidance Message
          </h3>
        </div>
        <div class="guru-card-body">
          <p style="font-size:13px; color:#64748b; margin-bottom:8px;">
            Copy this ready-made invitation text to send directly to students or parent groups:
          </p>
          <textarea id="waMsgText" class="form-control" rows="4" readonly style="font-size:13px; background:#f8fafc; margin-bottom:12px;">{{ $whatsappMessage }}</textarea>
          <div style="display:flex; gap:10px;">
            <button type="button" class="btn btn-outline" onclick="copyTextFromArea('waMsgText', this)">
              <i class="fa-regular fa-copy"></i> <span>Copy Message</span>
            </button>
            <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-success">
              <i class="fa-brands fa-whatsapp"></i> Send via WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column: Email Invitation Sender & Instructions -->
    <div>
      <!-- Email Invitation Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-paper-plane" style="color:#6366f1;"></i> Send Student Invitation Email
          </h3>
        </div>
        <div class="guru-card-body">
          <p style="font-size:13px; color:#64748b; margin-bottom:16px;">
            Send an official CareerGyan platform invitation email directly to a student with your referral link embedded:
          </p>

          <form method="POST" action="{{ route('careerguru.send-invite') }}">
            @csrf
            <div class="form-group">
              <label class="form-label" for="invite_name">Student Full Name <span class="required">*</span></label>
              <input type="text" id="invite_name" name="name" class="form-control" placeholder="e.g. Ananya Patel" required>
            </div>

            <div class="form-group">
              <label class="form-label" for="invite_email">Student Email Address <span class="required">*</span></label>
              <input type="email" id="invite_email" name="email" class="form-control" placeholder="e.g. ananya@gmail.com" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
              <i class="fa-solid fa-envelope"></i> Send Email Invitation
            </button>
          </form>
        </div>
      </div>

      <!-- How it Works Card -->
      <div class="guru-card" style="background:#f8fafc;">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-lightbulb" style="color:#f59e0b;"></i> How Attribution Works
          </h3>
        </div>
        <div class="guru-card-body" style="font-size:13px; color:#475569; line-height:1.6;">
          <ol style="margin-left: 18px; display:flex; flex-direction:column; gap:8px;">
            <li><strong>You share the link:</strong> Share via WhatsApp, SMS, or email with prospective students.</li>
            <li><strong>Student registers:</strong> When the student signs up on CareerGyan, your partner ID (<code>{{ $guru->guru_id }}</code>) is permanently tied to their user account.</li>
            <li><strong>Dashboard updates:</strong> The student immediately appears under your <strong>Registered Students</strong> section.</li>
            <li><strong>Premium purchase:</strong> When the student purchases a VIP membership plan, your commission (<strong>{{ $guru->commission_percentage }}%</strong>) is calculated and credited to your account automatically!</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  function copyTextFromArea(areaId, btn) {
    const el = document.getElementById(areaId);
    el.select();
    navigator.clipboard.writeText(el.value).then(function() {
      const origHtml = btn.innerHTML;
      btn.innerHTML = '<i class="fa-solid fa-check"></i> <span>Copied!</span>';
      setTimeout(function() { btn.innerHTML = origHtml; }, 2000);
    });
  }
</script>
@endsection


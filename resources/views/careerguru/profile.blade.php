@extends('careerguru.layout')

@section('title', 'My Profile & Payout Details')
@section('page-title', 'Profile & Payout Settings')

@section('styles')
<style>
  .profile-layout {
    display: grid;
    grid-template-columns: 2fr 1.2fr;
    gap: 24px;
  }
  @media (max-width: 991px) {
    .profile-layout { grid-template-columns: 1fr; }
  }
  .form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  @media (max-width: 640px) {
    .form-grid-2 { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <div style="margin-bottom: 24px;">
    <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Partner Profile & Payout Information</h2>
    <p style="font-size:13px; color:#64748b;">
      Keep your contact details up-to-date and maintain your bank/UPI information for scheduled commission payouts.
    </p>
  </div>

  @if($errors->any())
    <div class="guru-alert guru-alert-danger">
      <i class="fa-solid fa-circle-exclamation"></i>
      <div>
        <strong>Please correct the following:</strong>
        <ul style="margin-left: 20px; margin-top: 6px;">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <div class="profile-layout">
    <!-- Left Column: Profile & Payout Details Form -->
    <div>
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-user-gear" style="color:#2563eb;"></i> Personal & Payout Information
          </h3>
          <span class="status-pill pill-blue">{{ $guru->guru_id }}</span>
        </div>
        <div class="guru-card-body">
          <form method="POST" action="{{ route('careerguru.profile.update') }}">
            @csrf

            <!-- Basic Info -->
            <div style="font-size:13px; font-weight:700; color:#334155; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:14px;">
              Personal Details
            </div>

            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label" for="name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $guru->name) }}" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="phone">Phone Number <span class="required">*</span></label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $guru->phone) }}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Gmail / Registered Email Address</label>
              <input type="email" id="email" class="form-control" value="{{ $guru->email }}" readonly style="background:#f1f5f9; cursor:not-allowed;">
              <div class="form-text">Email address is managed exclusively by CareerGyan administrators.</div>
            </div>

            <hr style="margin: 24px 0; border: none; border-top: 1px solid var(--guru-border);">

            <!-- Payout Details -->
            <div style="font-size:13px; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:14px;">
              <i class="fa-solid fa-building-columns" style="margin-right:4px;"></i> Commission Payout Accounts
            </div>

            <div class="form-group">
              <label class="form-label" for="payout_upi_id">UPI ID / VPA</label>
              <input type="text" id="payout_upi_id" name="payout_upi_id" class="form-control" placeholder="e.g. yourname@oksbi / yourname@paytm" value="{{ old('payout_upi_id', $guru->payout_upi_id) }}">
              <div class="form-text">Preferred for fast instant commission disbursements.</div>
            </div>

            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label" for="payout_bank_name">Bank Name</label>
                <input type="text" id="payout_bank_name" name="payout_bank_name" class="form-control" placeholder="e.g. State Bank of India, HDFC" value="{{ old('payout_bank_name', $guru->payout_bank_name) }}">
              </div>

              <div class="form-group">
                <label class="form-label" for="payout_account_holder_name">Account Holder Name</label>
                <input type="text" id="payout_account_holder_name" name="payout_account_holder_name" class="form-control" placeholder="Name as printed on bank passbook" value="{{ old('payout_account_holder_name', $guru->payout_account_holder_name) }}">
              </div>
            </div>

            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label" for="payout_account_number">Bank Account Number</label>
                <input type="text" id="payout_account_number" name="payout_account_number" class="form-control" placeholder="Enter bank account number" value="{{ old('payout_account_number', $guru->payout_account_number) }}">
              </div>

              <div class="form-group">
                <label class="form-label" for="payout_ifsc_code">Bank IFSC Code</label>
                <input type="text" id="payout_ifsc_code" name="payout_ifsc_code" class="form-control" placeholder="e.g. SBIN0001234" value="{{ old('payout_ifsc_code', $guru->payout_ifsc_code) }}" style="text-transform:uppercase;">
              </div>
            </div>

            <div style="display:flex; justify-content:flex-end; margin-top:24px;">
              <button type="submit" class="btn btn-primary" style="padding:11px 24px;">
                <i class="fa-solid fa-floppy-disk"></i> Save Profile & Payout Info
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Right Column: Account Status & Change Password -->
    <div>
      <!-- Account Metadata Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-id-badge" style="color:#6366f1;"></i> Partner Account Details
          </h3>
        </div>
        <div class="guru-card-body" style="font-size:13px;">
          <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
            <span style="color:#64748b;">Account Status:</span>
            <span class="status-pill pill-green"><i class="fa-solid fa-check"></i> {{ ucfirst($guru->status) }}</span>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
            <span style="color:#64748b;">CareerGuru ID:</span>
            <strong style="color:var(--guru-text-main);">{{ $guru->guru_id }}</strong>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
            <span style="color:#64748b;">Referral Code:</span>
            <strong style="color:#2563eb; font-family:monospace;">{{ $guru->referral_code }}</strong>
          </div>
          <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
            <span style="color:#64748b;">Commission Rate:</span>
            <strong style="color:#10b981;">{{ $guru->commission_percentage }}%</strong>
          </div>
          <div style="display:flex; justify-content:space-between;">
            <span style="color:#64748b;">Partner Since:</span>
            <span>{{ $guru->created_at->format('d M Y') }}</span>
          </div>
        </div>
      </div>

      <!-- Change Password Card -->
      <div class="guru-card">
        <div class="guru-card-header">
          <h3 class="guru-card-title">
            <i class="fa-solid fa-lock" style="color:#ef4444;"></i> Change Password
          </h3>
        </div>
        <div class="guru-card-body">
          <form method="POST" action="{{ route('careerguru.password.change') }}">
            @csrf

            <div class="form-group">
              <label class="form-label" for="current_password">Current Password <span class="required">*</span></label>
              <input type="password" id="current_password" name="current_password" class="form-control" required autocomplete="current-password">
            </div>

            <div class="form-group">
              <label class="form-label" for="new_password">New Password <span class="required">*</span></label>
              <input type="password" id="new_password" name="password" class="form-control" placeholder="Min. 8 characters" required autocomplete="new-password">
            </div>

            <div class="form-group">
              <label class="form-label" for="password_confirmation">Confirm New Password <span class="required">*</span></label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center;">
              <i class="fa-solid fa-key"></i> Update Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


@extends('admin.layout')

@section('title', 'Create CareerGuru Account')
@section('page_title', 'Create CareerGuru Account')

@section('content')

  <div style="max-width: 800px; margin: 0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <div>
        <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Provision New CareerGuru Account</h2>
        <p style="font-size:13px; color:var(--admin-text-2);">CareerGuru accounts can only be created and authorized by the administration.</p>
      </div>
      <a href="{{ route('admin.careergurus.index') }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">
        <i class="fa-solid fa-arrow-left"></i> Back to Accounts
      </a>
    </div>

    @if($errors->any())
      <div class="admin-alert admin-alert-error" style="margin-bottom:20px;">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>
          <strong>Please resolve the following errors:</strong>
          <ul style="margin-left: 20px; margin-top: 6px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:28px; box-shadow:var(--admin-shadow);">
      <form method="POST" action="{{ route('admin.careergurus.store') }}">
        @csrf

        <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#2563eb; margin-bottom:18px;">
          <i class="fa-solid fa-user-plus"></i> Partner Credentials & Contact
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
          <div class="form-group">
            <label class="form-label" for="name">Full Name <span style="color:#ef4444;">*</span></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Prof. Rajesh Kulkarni" value="{{ old('name') }}" required autofocus>
          </div>

          <div class="form-group">
            <label class="form-label" for="phone">Phone Number <span style="color:#ef4444;">*</span></label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="e.g. 9822012345" value="{{ old('phone') }}" required>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:16px;">
          <label class="form-label" for="email">Gmail / Email Address (Login ID) <span style="color:#ef4444;">*</span></label>
          <input type="email" id="email" name="email" class="form-control" placeholder="e.g. rajesh.careerguru@gmail.com" value="{{ old('email') }}" required>
          <div style="font-size:11.5px; color:var(--admin-text-3); margin-top:4px;">The partner will log into <code>/careerguru/login</code> with this email address.</div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
          <div class="form-group">
            <label class="form-label" for="password">Initial Password <span style="color:#ef4444;">*</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Min. 8 characters" required autocomplete="new-password">
          </div>

          <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password <span style="color:#ef4444;">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repeat password" required autocomplete="new-password">
          </div>
        </div>

        <hr style="margin:24px 0; border:none; border-top:1px solid var(--admin-border);">

        <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#059669; margin-bottom:18px;">
          <i class="fa-solid fa-percent"></i> Commission Rate & Authorization
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
          <div class="form-group">
            <label class="form-label" for="commission_percentage">Commission Percentage (%) <span style="color:#ef4444;">*</span></label>
            <input type="number" step="0.01" min="0" max="100" id="commission_percentage" name="commission_percentage" class="form-control" value="{{ old('commission_percentage', $defaultCommission) }}" required>
            <div style="font-size:11.5px; color:var(--admin-text-3); margin-top:4px;">Percentage paid per successful student VIP purchase. (Default: {{ $defaultCommission }}%)</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Account Status <span style="color:#ef4444;">*</span></label>
            <select id="status" name="status" class="form-control" required>
              <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active (Can login immediately)</option>
              <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Access blocked until approved)</option>
            </select>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:24px;">
          <label class="form-label" for="notes">Internal Administration Remarks (Optional)</label>
          <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="e.g. Recommended by Nashik coaching institute partner; onboarded for Maharashtra CET batch...">{{ old('notes') }}</textarea>
        </div>

        <div style="background:#f8fafc; border:1px solid var(--admin-border); border-radius:12px; padding:16px; margin-bottom:24px; font-size:12.5px; color:var(--admin-text-2);">
          <strong style="color:var(--admin-text-1);"><i class="fa-solid fa-sparkles" style="color:#f59e0b; margin-right:4px;"></i> Automatic Provisioning:</strong>
          <ul style="margin-left: 20px; margin-top: 6px; display:flex; flex-direction:column; gap:4px;">
            <li>A unique CareerGuru ID (e.g. <code>CG-1001</code>) will be sequentially assigned.</li>
            <li>A unique student referral code (e.g. <code>GURU-RAJESH-123</code>) will be generated.</li>
            <li>Upon creation, you will see a one-time copyable credentials modal to share directly with the partner.</li>
          </ul>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
          <a href="{{ route('admin.careergurus.index') }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">Cancel</a>
          <button type="submit" class="btn" style="background:#2563eb; color:#fff; padding:11px 24px; font-weight:700;">
            <i class="fa-solid fa-user-plus"></i> Create CareerGuru Account
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection


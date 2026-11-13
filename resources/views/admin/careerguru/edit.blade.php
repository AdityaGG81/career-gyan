@extends('admin.layout')

@section('title', 'Edit ' . $guru->name . ' - CareerGuru')
@section('page_title', 'Edit CareerGuru Account')

@section('content')

  <div style="max-width: 800px; margin: 0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <div>
        <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">Edit CareerGuru: {{ $guru->name }}</h2>
        <p style="font-size:13px; color:var(--admin-text-2);">Partner ID: <strong style="color:#2563eb;">{{ $guru->guru_id }}</strong> · Code: <strong style="color:#6366f1;">{{ $guru->referral_code }}</strong></p>
      </div>
      <a href="{{ route('admin.careergurus.show', $guru->id) }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">
        <i class="fa-solid fa-arrow-left"></i> Back to Profile
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
      <form method="POST" action="{{ route('admin.careergurus.update', $guru->id) }}">
        @csrf
        @method('PUT')

        <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#2563eb; margin-bottom:18px;">
          <i class="fa-solid fa-user-pen"></i> Partner Information
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
          <div class="form-group">
            <label class="form-label" for="name">Full Name <span style="color:#ef4444;">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $guru->name) }}" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="phone">Phone Number <span style="color:#ef4444;">*</span></label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $guru->phone) }}" required>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:16px;">
          <label class="form-label" for="email">Gmail / Email Address (Login ID) <span style="color:#ef4444;">*</span></label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
        </div>

        <hr style="margin:24px 0; border:none; border-top:1px solid var(--admin-border);">

        <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#059669; margin-bottom:18px;">
          <i class="fa-solid fa-sliders"></i> Commission Rate & Account Status
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
          <div class="form-group">
            <label class="form-label" for="commission_percentage">Commission Percentage (%) <span style="color:#ef4444;">*</span></label>
            <input type="number" step="0.01" min="0" max="100" id="commission_percentage" name="commission_percentage" class="form-control" value="{{ old('commission_percentage', $guru->commission_percentage) }}" required>
            <div style="font-size:11.5px; color:var(--admin-text-3); margin-top:4px;">Adjusts future commission payouts for this partner.</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Account Status <span style="color:#ef4444;">*</span></label>
            <select id="status" name="status" class="form-control" required>
              <option value="active" {{ old('status', $guru->status) == 'active' ? 'selected' : '' }}>Active (Authorized to login)</option>
              <option value="inactive" {{ old('status', $guru->status) == 'inactive' ? 'selected' : '' }}>Inactive (Access temporarily disabled)</option>
              <option value="revoked" {{ old('status', $guru->status) == 'revoked' ? 'selected' : '' }}>Revoked (Permanently blocked)</option>
            </select>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:24px;">
          <label class="form-label" for="notes">Internal Remarks</label>
          <textarea id="notes" name="notes" class="form-control" rows="3">{{ old('notes', $guru->notes) }}</textarea>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
          <a href="{{ route('admin.careergurus.show', $guru->id) }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">Cancel</a>
          <button type="submit" class="btn" style="background:#2563eb; color:#fff; padding:11px 24px; font-weight:700;">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
          </button>
        </div>
      </form>
    </div>

    <!-- Danger Zone: Permanent Deletion -->
    <div style="background:#ffffff; border:1px solid #fecaca; border-radius:var(--admin-radius-lg); padding:24px; margin-top:24px; box-shadow:var(--admin-shadow);">
      <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#dc2626; margin-bottom:8px;">
        <i class="fa-solid fa-triangle-exclamation"></i> Danger Zone
      </div>
      <p style="font-size:13px; color:var(--admin-text-2); margin-bottom:16px;">
        Permanently delete this CareerGuru partner account and remove all their associated student leads, activity logs, and commission records. This action cannot be reversed.
      </p>
      <form method="POST" action="{{ route('admin.careergurus.destroy', $guru->id) }}" onsubmit="return confirm('PERMANENTLY DELETE CareerGuru {{ $guru->name }} ({{ $guru->guru_id }}) and all associated data? This CANNOT be undone!');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn" style="background:#ef4444; color:#fff; padding:9px 18px; font-weight:700;">
          <i class="fa-solid fa-trash-can"></i> Delete CareerGuru Account & All Data
        </button>
      </form>
    </div>
  </div>

@endsection


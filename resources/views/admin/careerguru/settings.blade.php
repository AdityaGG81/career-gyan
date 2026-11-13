@extends('admin.layout')

@section('title', 'CareerGuru Partner Program Settings')
@section('page_title', 'Partner Program Settings')

@section('content')

  <div style="max-width: 860px; margin: 0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
      <div>
        <h2 style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:700;">CareerGuru Program Settings</h2>
        <p style="font-size:13px; color:var(--admin-text-2);">Configure platform default commission percentages, minimum payout thresholds, and partner guidelines.</p>
      </div>
      <a href="{{ route('admin.careergurus.index') }}" class="btn" style="background:#fff; border:1px solid var(--admin-border); color:var(--admin-text-1);">
        <i class="fa-solid fa-arrow-left"></i> Back to Accounts
      </a>
    </div>

    <!-- Financial Liability Overview -->
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; margin-bottom:26px;">
      <div class="stat-box">
        <div class="stat-label">Total Outstanding Liability</div>
        <div class="stat-number" style="color:#d97706;">₹{{ number_format($unpaidLiability, 2) }}</div>
        <div class="stat-sub">Pending audit + Approved unpaid</div>
      </div>

      <div class="stat-box">
        <div class="stat-label">Approved & Ready to Pay</div>
        <div class="stat-number" style="color:#2563eb;">₹{{ number_format($approvedUnpaid, 2) }}</div>
        <div class="stat-sub">Approved balance payable to Gurus</div>
      </div>

      <div class="stat-box">
        <div class="stat-label">Lifetime Disbursed</div>
        <div class="stat-number" style="color:#059669;">₹{{ number_format($totalPaidOut, 2) }}</div>
        <div class="stat-sub"><i class="fa-solid fa-check-double"></i> Total settled historically</div>
      </div>
    </div>

    @if($errors->any())
      <div class="admin-alert admin-alert-error" style="margin-bottom:20px;">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div>
          <strong>Please resolve the following:</strong>
          <ul style="margin-left: 20px; margin-top: 6px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:28px; box-shadow:var(--admin-shadow);">
      <form method="POST" action="{{ route('admin.careergurus.settings.update') }}">
        @csrf

        <div style="font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#2563eb; margin-bottom:18px;">
          <i class="fa-solid fa-sliders"></i> Default Commission & Payout Policy
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:20px;">
          <div class="form-group">
            <label class="form-label" for="default_commission_percentage">Default Commission Percentage (%) <span style="color:#ef4444;">*</span></label>
            <input type="number" step="0.01" min="0" max="100" id="default_commission_percentage" name="default_commission_percentage" class="form-control" value="{{ old('default_commission_percentage', $defaultPercentage) }}" required>
            <div style="font-size:11.5px; color:var(--admin-text-3); margin-top:4px;">
              Applied automatically when creating new CareerGuru accounts unless custom percentage is chosen.
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="minimum_payout_amount">Minimum Payout Threshold (₹) <span style="color:#ef4444;">*</span></label>
            <input type="number" step="1" min="0" id="minimum_payout_amount" name="minimum_payout_amount" class="form-control" value="{{ old('minimum_payout_amount', $minPayout) }}" required>
            <div style="font-size:11.5px; color:var(--admin-text-3); margin-top:4px;">
              Minimum accrued commission balance required before triggering scheduled bank/UPI payout.
            </div>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:24px;">
          <label class="form-label" for="payout_instructions">Partner Payout Instructions / Note</label>
          <textarea id="payout_instructions" name="payout_instructions" class="form-control" rows="4" placeholder="Enter payout notes, payment terms, or processing schedules shown in partner portal...">{{ old('payout_instructions', $payoutInstructions) }}</textarea>
        </div>

        <div style="background:#f8fafc; border:1px solid var(--admin-border); border-radius:12px; padding:18px; margin-bottom:24px; font-size:13px; color:var(--admin-text-2);">
          <strong style="color:var(--admin-text-1);"><i class="fa-solid fa-scale-balanced" style="color:#6366f1; margin-right:4px;"></i> Commission Calculation Formula:</strong>
          <p style="margin-top:6px; font-family:monospace; background:#fff; padding:8px 12px; border:1px solid var(--admin-border); border-radius:6px; color:#1e293b;">
            Commission = Eligible Paid Membership Amount × Partner Commission % ÷ 100
          </p>
          <ul style="margin-left: 20px; margin-top: 8px; display:flex; flex-direction:column; gap:4px; font-size:12.5px;">
            <li>Uses verified successful payment transactions exclusively (after discounts, excluding cancellations/refunds).</li>
            <li>Free or complimentary admin grants with amount ₹0 do not generate commission.</li>
            <li>Individual partner rates override this global default.</li>
          </ul>
        </div>

        <div style="display:flex; justify-content:flex-end;">
          <button type="submit" class="btn" style="background:#2563eb; color:#fff; padding:11px 26px; font-weight:700;">
            <i class="fa-solid fa-floppy-disk"></i> Save Program Settings
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

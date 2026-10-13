@extends('admin.layout')

@section('title', 'Premium Membership Settings')

@section('styles')
<style>
  .mem-grid {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 32px;
    align-items: start;
  }

  @media (max-width: 1100px) {
    .mem-grid {
      grid-template-columns: 1fr;
    }
  }

  .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
  }

  .stat-box {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 20px 24px;
    box-shadow: var(--admin-shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .stat-box:hover {
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-hover);
  }

  .stat-box-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .stat-box-icon.gold { background: #fef3c7; color: #b45309; }
  .stat-box-icon.green { background: #dcfce7; color: #15803d; }
  .stat-box-icon.blue { background: #e0f2fe; color: #0369a1; }
  .stat-box-icon.purple { background: #f3e8ff; color: #7e22ce; }

  .stat-box-info h3 {
    font-size: 13px;
    font-weight: 600;
    color: var(--admin-text-3);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
  }

  .stat-box-info .stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--admin-text-1);
  }

  /* Form Styling */
  .form-section-title {
    font-family: 'Outfit', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--admin-border);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--admin-text-1);
    margin-bottom: 6px;
  }

  .form-group .form-hint {
    font-size: 12px;
    color: var(--admin-text-3);
    margin-top: 4px;
  }

  .input-icon-wrap {
    position: relative;
    display: flex;
    align-items: center;
  }

  .input-icon-wrap span.input-prefix {
    position: absolute;
    left: 14px;
    font-size: 14px;
    font-weight: 700;
    color: var(--admin-text-3);
    pointer-events: none;
  }

  .input-icon-wrap input {
    padding-left: 36px;
  }

  /* Symbol Picker */
  .symbol-selector-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(75px, 1fr));
    gap: 10px;
    margin-bottom: 12px;
  }

  .symbol-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 12px 6px;
    border-radius: var(--admin-radius-md);
    border: 1px solid var(--admin-border);
    background: #fafafa;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 18px;
    color: var(--admin-text-2);
  }

  .symbol-btn span.sym-name {
    font-size: 10.5px;
    font-weight: 600;
    color: var(--admin-text-3);
  }

  .symbol-btn:hover {
    background: #f4f4f5;
    border-color: #d4d4d8;
    color: #000;
  }

  .symbol-btn.active {
    background: #09090b;
    border-color: #09090b;
    color: #fbbf24;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }

  .symbol-btn.active span.sym-name {
    color: #f4f4f5;
  }

  /* Live Preview Box */
  .live-preview-sticky {
    position: sticky;
    top: 90px;
  }

  .preview-wrapper {
    background: radial-gradient(circle at top, #1e1b4b 0%, #0f172a 100%);
    border-radius: var(--admin-radius-xl);
    padding: 36px 28px;
    color: white;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
  }

  .preview-ribbon {
    position: absolute;
    top: 22px;
    right: -32px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    color: #78350f;
    font-size: 10px;
    font-weight: 800;
    padding: 5px 36px;
    transform: rotate(45deg);
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  .preview-badge-top {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(251, 191, 36, 0.15);
    border: 1px solid rgba(251, 191, 36, 0.35);
    color: #fbbf24;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.05em;
    margin-bottom: 20px;
  }

  .preview-symbol-badge {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.25), rgba(245, 158, 11, 0.1));
    border: 1px solid rgba(251, 191, 36, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: #fbbf24;
    margin-bottom: 16px;
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.25);
  }

  .preview-plan-title {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 6px;
  }

  .preview-plan-desc {
    font-size: 13px;
    color: #94a3b8;
    line-height: 1.5;
    margin-bottom: 24px;
  }

  .preview-price-box {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: var(--admin-radius-lg);
    padding: 20px;
    margin-bottom: 24px;
    text-align: center;
  }

  .preview-original-price {
    font-size: 14px;
    color: #94a3b8;
    text-decoration: line-through;
    margin-right: 8px;
  }

  .preview-discount-tag {
    background: #10b981;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    display: inline-block;
  }

  .preview-current-price {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 4px;
    margin-top: 6px;
  }

  .preview-currency {
    font-size: 22px;
    font-weight: 700;
    color: #fbbf24;
  }

  .preview-amount {
    font-family: 'Outfit', sans-serif;
    font-size: 46px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
  }

  .preview-period {
    font-size: 14px;
    color: #94a3b8;
    font-weight: 500;
  }

  .preview-features-list {
    list-style: none;
    margin-bottom: 24px;
  }

  .preview-features-list li {
    font-size: 13px;
    color: #e2e8f0;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
    line-height: 1.4;
  }

  .preview-features-list li i {
    color: #10b981;
    font-size: 14px;
    margin-top: 2px;
    flex-shrink: 0;
  }

  .preview-cta-btn {
    display: block;
    width: 100%;
    text-align: center;
    padding: 14px 20px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    color: #78350f;
    font-weight: 800;
    font-size: 14px;
    border-radius: var(--admin-radius-md);
    text-decoration: none;
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
  }

  .btn-submit-save {
    background: #09090b;
    color: #ffffff;
    padding: 12px 28px;
    border-radius: var(--admin-radius-md);
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
  }

  .btn-submit-save:hover {
    background: #27272a;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  }

  .custom-switch {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    user-select: none;
  }

  .custom-switch input {
    width: 20px;
    height: 20px;
    accent-color: #09090b;
    cursor: pointer;
  }
</style>
@endsection

@section('content')
  @if(session('success'))
    <div class="admin-alert admin-alert-success">
      <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if(isset($errors) && $errors->any())
    <div class="admin-alert admin-alert-error">
      <i class="fa-solid fa-circle-exclamation" style="font-size: 18px;"></i>
      <div>
        <strong>Please check the errors below:</strong>
        <ul style="margin-left: 20px; margin-top: 6px;">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <!-- Overview Stats -->
  <div class="stat-grid">
    <div class="stat-box">
      <div class="stat-box-icon gold">
        <i class="fa-solid fa-crown"></i>
      </div>
      <div class="stat-box-info">
        <h3>Active Pro Members</h3>
        <div class="stat-value">{{ number_format($stats['active_members']) }}</div>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-box-icon green">
        <i class="fa-solid fa-indian-rupee-sign"></i>
      </div>
      <div class="stat-box-info">
        <h3>Total Revenue</h3>
        <div class="stat-value">₹{{ number_format($stats['total_revenue']) }}</div>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-box-icon blue">
        <i class="fa-solid fa-receipt"></i>
      </div>
      <div class="stat-box-info">
        <h3>Total Orders</h3>
        <div class="stat-value">{{ number_format($stats['total_transactions']) }}</div>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-box-icon purple">
        <i class="fa-solid fa-toggle-on"></i>
      </div>
      <div class="stat-box-info">
        <h3>Status</h3>
        <div class="stat-value" style="font-size: 18px; color: {{ $plan->is_active ? '#15803d' : '#b91c1c' }};">
          {{ $plan->is_active ? '● Active Live' : '○ Disabled' }}
        </div>
      </div>
    </div>
  </div>

  <div class="mem-grid">
    
    <!-- Left: Settings Form -->
    <div class="panel-card">
      <div class="panel-header">
        <div>
          <h2><i class="fa-solid fa-sliders" style="margin-right: 8px;"></i> Configure Premium Membership</h2>
          <p style="font-size: 12.5px; color: var(--admin-text-3); margin-top: 2px;">Set the price amount, pick the symbol/icon, badge, and customize benefits</p>
        </div>
      </div>

      <div style="padding: 24px;">
        <form action="{{ route('admin.membership.update') }}" method="POST" id="membershipForm">
          @csrf

          <!-- Section 1: Pricing & Amount -->
          <div class="form-section-title">
            <i class="fa-solid fa-money-bill-wave"></i> 1. Membership Pricing & Duration
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label for="price">Membership Amount <span style="color: #dc2626;">*</span></label>
              <div class="input-icon-wrap">
                <span class="input-prefix" id="pricePrefix">{{ $plan->currency_symbol ?: '₹' }}</span>
                <input type="number" step="1" name="price" id="priceInput" class="form-control" value="{{ old('price', $plan->price_in_rupees) }}" required>
              </div>
              <div class="form-hint">The actual amount charged to students (in Rupees/selected currency).</div>
            </div>

            <div class="form-group">
              <label for="original_price">Original / Strikethrough Price (Optional)</label>
              <div class="input-icon-wrap">
                <span class="input-prefix" id="origPrefix">{{ $plan->currency_symbol ?: '₹' }}</span>
                <input type="number" step="1" name="original_price" id="origPriceInput" class="form-control" value="{{ old('original_price', $plan->original_price_in_rupees) }}" placeholder="e.g. 1999">
              </div>
              <div class="form-hint">Shown with strikethrough (e.g. <del>₹1,999</del>) to highlight savings discount.</div>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label for="currency_symbol">Currency Symbol</label>
              <select name="currency_symbol" id="currencySelect" class="form-control">
                <option value="₹" {{ old('currency_symbol', $plan->currency_symbol) == '₹' ? 'selected' : '' }}>₹ (INR - Rupee)</option>
                <option value="$" {{ old('currency_symbol', $plan->currency_symbol) == '$' ? 'selected' : '' }}>$ (USD - Dollar)</option>
                <option value="€" {{ old('currency_symbol', $plan->currency_symbol) == '€' ? 'selected' : '' }}>€ (EUR - Euro)</option>
                <option value="£" {{ old('currency_symbol', $plan->currency_symbol) == '£' ? 'selected' : '' }}>£ (GBP - Pound)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="duration_days">Duration (Days)</label>
              <input type="number" name="duration_days" id="durationDaysInput" class="form-control" value="{{ old('duration_days', $plan->duration_days ?: 365) }}" required>
              <div class="form-hint">365 = 1 Year, 180 = 6 Months</div>
            </div>

            <div class="form-group">
              <label for="billing_period">Billing Label</label>
              <input type="text" name="billing_period" id="billingPeriodInput" class="form-control" value="{{ old('billing_period', $plan->billing_period ?: 'yr') }}" placeholder="e.g. yr, mo, year">
              <div class="form-hint">Shown next to price (e.g. / yr)</div>
            </div>
          </div>

          <!-- Section 2: Symbol & Badge -->
          <div class="form-section-title" style="margin-top: 10px;">
            <i class="fa-solid fa-icons"></i> 2. Membership Symbol & Badge Icon
          </div>

          <div class="form-group">
            <label>Select Membership Symbol / Icon</label>
            <div class="symbol-selector-grid">
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-crown' ? 'active' : '' }}" data-symbol="fa-solid fa-crown">
                <i class="fa-solid fa-crown"></i>
                <span class="sym-name">Crown</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-gem' ? 'active' : '' }}" data-symbol="fa-solid fa-gem">
                <i class="fa-solid fa-gem"></i>
                <span class="sym-name">Diamond</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-star' ? 'active' : '' }}" data-symbol="fa-solid fa-star">
                <i class="fa-solid fa-star"></i>
                <span class="sym-name">Star</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-bolt' ? 'active' : '' }}" data-symbol="fa-solid fa-bolt">
                <i class="fa-solid fa-bolt"></i>
                <span class="sym-name">Bolt</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-shield-halved' ? 'active' : '' }}" data-symbol="fa-solid fa-shield-halved">
                <i class="fa-solid fa-shield-halved"></i>
                <span class="sym-name">Shield</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-rocket' ? 'active' : '' }}" data-symbol="fa-solid fa-rocket">
                <i class="fa-solid fa-rocket"></i>
                <span class="sym-name">Rocket</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-trophy' ? 'active' : '' }}" data-symbol="fa-solid fa-trophy">
                <i class="fa-solid fa-trophy"></i>
                <span class="sym-name">Trophy</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-award' ? 'active' : '' }}" data-symbol="fa-solid fa-award">
                <i class="fa-solid fa-award"></i>
                <span class="sym-name">Medal</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-fire' ? 'active' : '' }}" data-symbol="fa-solid fa-fire">
                <i class="fa-solid fa-fire"></i>
                <span class="sym-name">Fire</span>
              </button>
              <button type="button" class="symbol-btn {{ old('symbol', $plan->symbol) == 'fa-solid fa-certificate' ? 'active' : '' }}" data-symbol="fa-solid fa-certificate">
                <i class="fa-solid fa-certificate"></i>
                <span class="sym-name">Badge</span>
              </button>
            </div>

            <!-- Custom Symbol input -->
            <div style="display: flex; gap: 10px; align-items: center; margin-top: 10px;">
              <input type="text" name="symbol" id="symbolInput" class="form-control" value="{{ old('symbol', $plan->symbol ?: 'fa-solid fa-crown') }}" placeholder="Custom FontAwesome class e.g. fa-solid fa-crown" required>
              <div id="symbolPreviewIcon" style="width: 44px; height: 44px; border-radius: 8px; background: #09090b; color: #fbbf24; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                <i class="{{ $plan->symbol ?: 'fa-solid fa-crown' }}"></i>
              </div>
            </div>
            <div class="form-hint">Click any preset symbol above or type any FontAwesome icon class.</div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="form-group">
              <label for="badge_text">Ribbon / Badge Text</label>
              <input type="text" name="badge_text" id="badgeTextInput" class="form-control" value="{{ old('badge_text', $plan->badge_text ?: 'MOST POPULAR') }}" placeholder="e.g. MOST POPULAR, PRO ACCESS, VIP">
            </div>

            <div class="form-group">
              <label for="color_theme">Accent Theme Color</label>
              <select name="color_theme" id="colorThemeSelect" class="form-control">
                <option value="amber" {{ old('color_theme', $plan->color_theme) == 'amber' ? 'selected' : '' }}>Amber / Gold (Recommended)</option>
                <option value="indigo" {{ old('color_theme', $plan->color_theme) == 'indigo' ? 'selected' : '' }}>Royal Indigo</option>
                <option value="emerald" {{ old('color_theme', $plan->color_theme) == 'emerald' ? 'selected' : '' }}>Emerald Green</option>
                <option value="rose" {{ old('color_theme', $plan->color_theme) == 'rose' ? 'selected' : '' }}>Rose Ruby</option>
              </select>
            </div>
          </div>

          <!-- Section 3: Plan Content & Details -->
          <div class="form-section-title" style="margin-top: 10px;">
            <i class="fa-solid fa-file-lines"></i> 3. Plan Name & Description
          </div>

          <div class="form-group">
            <label for="name">Plan Title <span style="color: #dc2626;">*</span></label>
            <input type="text" name="name" id="planNameInput" class="form-control" value="{{ old('name', $plan->name) }}" required placeholder="e.g. Pro Membership">
          </div>

          <div class="form-group">
            <label for="description">Plan Description / Subtitle</label>
            <textarea name="description" id="planDescInput" rows="2" class="form-control" placeholder="Short description of the membership benefits...">{{ old('description', $plan->description) }}</textarea>
          </div>

          <div class="form-group">
            <label for="features">Plan Features / Benefits Checklist (One per line)</label>
            <textarea name="features" id="featuresInput" rows="7" class="form-control" placeholder="Enter each feature on a separate line...">{{ old('features', is_array($plan->features) ? implode("\n", $plan->features) : $plan->features) }}</textarea>
            <div class="form-hint">Enter each benefit on a new line. These will appear with checkmarks in the section.</div>
          </div>

          <div class="form-group" style="padding: 16px; background: #fafafa; border: 1px solid var(--admin-border); border-radius: var(--admin-radius-md);">
            <label class="custom-switch">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
              <span style="font-size: 14px; font-weight: 600; color: var(--admin-text-1);">
                Enable and display Premium Membership section on the website
              </span>
            </label>
            <div class="form-hint" style="margin-left: 32px;">When enabled, the section will be visible on the homepage and the /membership page will be active for students.</div>
          </div>

          <div style="margin-top: 24px; display: flex; gap: 12px; align-items: center;">
            <button type="submit" class="btn-submit-save">
              <i class="fa-solid fa-floppy-disk"></i> Save & Publish Changes
            </button>
            <a href="{{ route('membership.index') }}" target="_blank" class="view-site-link" style="border: 1px solid var(--admin-border);">
              <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live Page
            </a>
          </div>

        </form>
      </div>
    </div>

    <!-- Right: Real-Time Live Preview -->
    <div class="live-preview-sticky">
      <div style="margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-size: 13px; font-weight: 700; color: var(--admin-text-2); text-transform: uppercase; letter-spacing: 0.05em;">
          <i class="fa-solid fa-eye" style="color: #3b82f6;"></i> Live User Preview
        </span>
        <span style="font-size: 11.5px; background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 999px; font-weight: 700;">
          Updates in Real-Time
        </span>
      </div>

      <div class="preview-wrapper">
        <div class="preview-ribbon" id="prevRibbon">{{ $plan->badge_text ?: 'MOST POPULAR' }}</div>

        <div class="preview-badge-top">
          <i id="prevBadgeIcon" class="{{ $plan->symbol ?: 'fa-solid fa-crown' }}"></i>
          <span id="prevBadgeText">{{ $plan->name ?: 'Pro Membership' }}</span>
        </div>

        <div class="preview-symbol-badge" id="prevSymbolBadge">
          <i id="prevMainIcon" class="{{ $plan->symbol ?: 'fa-solid fa-crown' }}"></i>
        </div>

        <h3 class="preview-plan-title" id="prevPlanTitle">{{ $plan->name ?: 'Pro Membership' }}</h3>
        <p class="preview-plan-desc" id="prevPlanDesc">{{ $plan->description ?: 'Unlock premium tools, advanced tests, 1-on-1 counseling, and expert WhatsApp group access.' }}</p>

        <div class="preview-price-box">
          <div id="prevDiscountWrap" style="{{ $plan->discount_percentage > 0 ? '' : 'display: none;' }}">
            <span class="preview-original-price" id="prevOrigPrice">
              {{ $plan->currency_symbol ?: '₹' }}{{ number_format($plan->original_price_in_rupees ?: 1999) }}
            </span>
            <span class="preview-discount-tag" id="prevDiscountTag">
              SAVE {{ $plan->discount_percentage }}%
            </span>
          </div>

          <div class="preview-current-price">
            <span class="preview-currency" id="prevCurrency">{{ $plan->currency_symbol ?: '₹' }}</span>
            <span class="preview-amount" id="prevAmount">{{ number_format($plan->price_in_rupees ?: 999) }}</span>
            <span class="preview-period" id="prevPeriod">/ {{ $plan->billing_period ?: 'yr' }}</span>
          </div>
        </div>

        <ul class="preview-features-list" id="prevFeaturesList">
          @if(is_array($plan->features))
            @foreach($plan->features as $feat)
              <li><i class="fa-solid fa-circle-check"></i> <span>{{ $feat }}</span></li>
            @endforeach
          @endif
        </ul>

        <a href="javascript:void(0)" class="preview-cta-btn">
          Upgrade to Pro Now <i class="fa-solid fa-arrow-right" style="margin-left: 6px;"></i>
        </a>

        <div style="text-align: center; font-size: 11px; color: #64748b; margin-top: 14px;">
          <i class="fa-solid fa-shield-halved"></i> 100% Secure Checkout via Razorpay
        </div>
      </div>
    </div>

  </div>

  <!-- Recent Members Transactions Table -->
  <div class="panel-card" style="margin-top: 36px;">
    <div class="panel-header">
      <h2><i class="fa-solid fa-clock-rotate-left" style="margin-right: 8px;"></i> Recent Pro Member Transactions</h2>
      <span style="font-size: 13px; color: var(--admin-text-3);">Showing latest {{ count($recentMembers) }} records</span>
    </div>

    @if(count($recentMembers) > 0)
      <div style="overflow-x: auto;">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Member Name</th>
              <th>Email</th>
              <th>Amount Paid</th>
              <th>Status</th>
              <th>Starts At</th>
              <th>Expires At</th>
              <th>Payment ID</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentMembers as $mem)
              <tr>
                <td style="font-weight: 600; color: var(--admin-text-1);">
                  <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">
                      <i class="fa-solid fa-crown"></i>
                    </div>
                    {{ $mem->user ? $mem->user->name : 'User #' . $mem->user_id }}
                  </div>
                </td>
                <td>{{ $mem->user ? $mem->user->email : 'N/A' }}</td>
                <td style="font-weight: 700; color: #15803d;">
                  {{ $mem->currency == 'INR' ? '₹' : $mem->currency }} {{ number_format($mem->amount_paid / 100) }}
                </td>
                <td>
                  <span style="padding: 4px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 700; background: {{ $mem->status == 'active' ? '#dcfce7' : '#fee2e2' }}; color: {{ $mem->status == 'active' ? '#15803d' : '#991b1b' }};">
                    {{ ucfirst($mem->status) }}
                  </span>
                </td>
                <td>{{ $mem->starts_at ? $mem->starts_at->format('d M Y') : 'N/A' }}</td>
                <td>{{ $mem->expires_at ? $mem->expires_at->format('d M Y') : 'Lifetime' }}</td>
                <td style="font-family: monospace; font-size: 12px;">{{ $mem->razorpay_payment_id ?: 'Simulated' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div style="padding: 48px; text-align: center; color: var(--admin-text-3);">
        <i class="fa-solid fa-crown" style="font-size: 36px; opacity: 0.3; margin-bottom: 12px; display: block;"></i>
        <p style="font-weight: 500;">No membership transactions recorded yet.</p>
        <p style="font-size: 13px; margin-top: 4px;">Once students upgrade through the website, their details will appear here.</p>
      </div>
    @endif
  </div>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Symbol button click handler
    const symbolBtns = document.querySelectorAll('.symbol-btn');
    const symbolInput = document.getElementById('symbolInput');
    const symbolPreviewIcon = document.getElementById('symbolPreviewIcon');
    const prevMainIcon = document.getElementById('prevMainIcon');
    const prevBadgeIcon = document.getElementById('prevBadgeIcon');

    symbolBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        symbolBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const sym = btn.getAttribute('data-symbol');
        symbolInput.value = sym;
        updateSymbol(sym);
      });
    });

    symbolInput.addEventListener('input', (e) => {
      const val = e.target.value.trim();
      // Match with buttons
      symbolBtns.forEach(btn => {
        if (btn.getAttribute('data-symbol') === val) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      });
      updateSymbol(val);
    });

    function updateSymbol(iconClass) {
      if (!iconClass) iconClass = 'fa-solid fa-crown';
      symbolPreviewIcon.innerHTML = `<i class="${iconClass}"></i>`;
      prevMainIcon.className = iconClass;
      prevBadgeIcon.className = iconClass;
    }

    // Dynamic Live Preview updates
    const planNameInput = document.getElementById('planNameInput');
    const prevPlanTitle = document.getElementById('prevPlanTitle');
    const prevBadgeText = document.getElementById('prevBadgeText');
    planNameInput.addEventListener('input', (e) => {
      const val = e.target.value.trim() || 'Pro Membership';
      prevPlanTitle.textContent = val;
      prevBadgeText.textContent = val;
    });

    const badgeTextInput = document.getElementById('badgeTextInput');
    const prevRibbon = document.getElementById('prevRibbon');
    badgeTextInput.addEventListener('input', (e) => {
      prevRibbon.textContent = e.target.value.trim() || 'MOST POPULAR';
    });

    const planDescInput = document.getElementById('planDescInput');
    const prevPlanDesc = document.getElementById('prevPlanDesc');
    planDescInput.addEventListener('input', (e) => {
      prevPlanDesc.textContent = e.target.value.trim() || 'Unlock premium tools, advanced tests, 1-on-1 counseling, and expert WhatsApp group access.';
    });

    const currencySelect = document.getElementById('currencySelect');
    const pricePrefix = document.getElementById('pricePrefix');
    const origPrefix = document.getElementById('origPrefix');
    const prevCurrency = document.getElementById('prevCurrency');
    currencySelect.addEventListener('change', (e) => {
      const sym = e.target.value;
      pricePrefix.textContent = sym;
      origPrefix.textContent = sym;
      prevCurrency.textContent = sym;
      updatePrices();
    });

    const priceInput = document.getElementById('priceInput');
    const origPriceInput = document.getElementById('origPriceInput');
    const prevAmount = document.getElementById('prevAmount');
    const prevOrigPrice = document.getElementById('prevOrigPrice');
    const prevDiscountTag = document.getElementById('prevDiscountTag');
    const prevDiscountWrap = document.getElementById('prevDiscountWrap');

    function updatePrices() {
      const cur = currencySelect.value;
      const price = parseFloat(priceInput.value) || 0;
      const orig = parseFloat(origPriceInput.value) || 0;

      prevAmount.textContent = price.toLocaleString();

      if (orig > price && price > 0) {
        prevDiscountWrap.style.display = 'block';
        prevOrigPrice.textContent = cur + orig.toLocaleString();
        const disc = Math.round(((orig - price) / orig) * 100);
        prevDiscountTag.textContent = 'SAVE ' + disc + '%';
      } else {
        prevDiscountWrap.style.display = 'none';
      }
    }

    priceInput.addEventListener('input', updatePrices);
    origPriceInput.addEventListener('input', updatePrices);

    const billingPeriodInput = document.getElementById('billingPeriodInput');
    const prevPeriod = document.getElementById('prevPeriod');
    billingPeriodInput.addEventListener('input', (e) => {
      prevPeriod.textContent = '/ ' + (e.target.value.trim() || 'yr');
    });

    const featuresInput = document.getElementById('featuresInput');
    const prevFeaturesList = document.getElementById('prevFeaturesList');
    featuresInput.addEventListener('input', (e) => {
      const lines = e.target.value.split('\n').map(l => l.trim()).filter(l => l.length > 0);
      prevFeaturesList.innerHTML = '';
      lines.forEach(line => {
        const li = document.createElement('li');
        li.innerHTML = `<i class="fa-solid fa-circle-check"></i> <span>${line}</span>`;
        prevFeaturesList.appendChild(li);
      });
    });
  });
</script>
@endsection

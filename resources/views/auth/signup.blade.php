@extends('layouts.app')

@section('title', 'Sign Up | Career Gyan')

@section('content')
<style>
  .auth-split-container {
    display: grid;
    grid-template-columns: 1fr;
    min-height: calc(100vh - 84px);
    background: var(--bg);
  }
  
  @media (min-width: 992px) {
    .auth-split-container {
      grid-template-columns: 1.1fr 0.9fr;
    }
  }

  /* ── Sidebar (Left Panel) ── */
  .auth-sidebar {
    display: none;
    background: linear-gradient(135deg, #0b1530 0%, #111e47 50%, #1e3a8a 100%);
    color: #ffffff;
    padding: 60px 80px;
    position: relative;
    overflow: hidden;
    flex-direction: column;
    justify-content: center;
  }
  
  @media (min-width: 992px) {
    .auth-sidebar {
      display: flex;
    }
  }

  .auth-sidebar::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1.2' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
  }

  .sidebar-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
    opacity: 0.15;
    z-index: 1;
  }
  .sidebar-orb-1 { width: 300px; height: 300px; background: #3b82f6; top: -50px; right: -50px; }
  .sidebar-orb-2 { width: 250px; height: 250px; background: #f97316; bottom: -50px; left: -50px; }

  .sidebar-content {
    position: relative;
    z-index: 2;
    max-width: 500px;
  }

  .sidebar-logo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: #fff;
    text-decoration: none;
    margin-bottom: 48px;
  }
  .sidebar-logo i {
    color: var(--accent);
  }

  .sidebar-tagline {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 36px);
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 36px;
    color: #fff;
  }

  .auth-features {
    display: flex;
    flex-direction: column;
    gap: 28px;
  }
  .feature-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
  }
  .feature-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #10b981;
    font-size: 14px;
    flex-shrink: 0;
  }
  .feature-text h4 {
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 4px;
  }
  .feature-text p {
    font-size: 14px;
    color: rgba(255,255,255,0.7);
    line-height: 1.5;
  }

  /* ── Form Container (Right Panel) ── */
  .auth-form-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 24px;
  }

  .auth-form-card {
    background: #ffffff;
    max-width: 520px;
    width: 100%;
    border-radius: var(--radius-xl);
    padding: 40px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
  }

  .auth-header {
    margin-bottom: 32px;
  }
  .auth-header h1 {
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: var(--text-1);
    margin-bottom: 8px;
  }
  .auth-header p {
    color: var(--text-2);
    font-size: 15px;
  }

  .form-group {
    margin-bottom: 20px;
  }
  .form-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
  }
  @media (min-width: 576px) {
    .form-row {
      grid-template-columns: 1fr 1fr;
    }
  }
  
  .form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-1);
    margin-bottom: 8px;
  }

  .input-icon-wrapper {
    position: relative;
  }
  .input-icon-wrapper i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-3);
    font-size: 14px;
    transition: color var(--transition);
  }
  .form-input {
    width: 100%;
    padding: 13px 16px 13px 44px;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 15px;
    color: var(--text-1);
    transition: all var(--transition);
  }
  .form-input:focus {
    outline: none;
    border-color: var(--brand);
    box-shadow: 0 0 0 4px var(--brand-light);
  }
  .form-input:focus + i {
    color: var(--brand);
  }

  .form-error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
  }

  .auth-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, var(--brand), var(--brand-dark));
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all var(--transition);
    box-shadow: 0 4px 12px rgba(26,86,219,0.2);
    margin-top: 12px;
  }
  .auth-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(26,86,219,0.3);
  }

  .auth-footer {
    text-align: center;
    margin-top: 28px;
    font-size: 15px;
    color: var(--text-2);
  }
  .auth-footer a {
    color: var(--brand);
    font-weight: 700;
    text-decoration: none;
  }
  .auth-footer a:hover {
    text-decoration: underline;
  }

  /* ── Google Auth Button ── */
  .google-auth-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 12px 18px;
    background: #ffffff;
    color: #1f2937;
    border: 1.5px solid #e5e7eb;
    border-radius: var(--radius-md);
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
  }
  .google-auth-btn:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-1px);
    color: #111827;
  }
  .google-auth-btn:active {
    transform: translateY(0);
    background: #f3f4f6;
  }
  .google-icon {
    flex-shrink: 0;
  }

  .auth-divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 22px 0;
    color: var(--text-3);
    font-size: 12.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .auth-divider::before,
  .auth-divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--border);
  }
  .auth-divider span {
    padding: 0 14px;
    color: var(--text-3);
  }
</style>

<div class="auth-split-container">
  
  {{-- LEFT BRAND SIDEBAR --}}
  <div class="auth-sidebar">
    <div class="sidebar-orb sidebar-orb-1"></div>
    <div class="sidebar-orb sidebar-orb-2"></div>
    
    <div class="sidebar-content">
      <a href="{{ url('/') }}" class="sidebar-logo">
        <i class="fa-solid fa-graduation-cap"></i> CareerGyan
      </a>
      
      <h2 class="sidebar-tagline">Start your career journey with confidence.</h2>
      
      <div class="auth-features">
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
          <div class="feature-text">
            <h4>Explore Career Roadmaps</h4>
            <p>Access hundreds of structured pathways mapping out academic steps and credentials.</p>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
          <div class="feature-text">
            <h4>Scientific Aptitude Tests</h4>
            <p>Assess your strengths and get recommendations aligned with your natural talents.</p>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
          <div class="feature-text">
            <h4>Curated Blogs & Resources</h4>
            <p>Stay updated with expert advice, field analysis, and growth insights.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- RIGHT FORM SECTION --}}
  <div class="auth-form-container">
    <div class="auth-form-card">
      <div class="auth-header">
        <h1>Create an Account</h1>
        <p>Join Career Gyan and find your perfect path</p>
      </div>

      <!-- Sign up with Google Button -->
      <a href="{{ route('auth.google') }}" class="google-auth-btn">
        <svg class="google-icon" viewBox="0 0 24 24" width="20" height="20">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
        </svg>
        <span>Sign up with Google</span>
      </a>

      <div class="auth-divider">
        <span>or sign up with email</span>
      </div>

      <form method="POST" action="{{ route('signup.submit') }}">
        @csrf
        
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="first_name">First Name</label>
            <div class="input-icon-wrapper">
              <input class="form-input" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="John">
              <i class="fa-solid fa-user"></i>
            </div>
            @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label" for="last_name">Last Name</label>
            <div class="input-icon-wrapper">
              <input class="form-input" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Doe">
              <i class="fa-solid fa-user"></i>
            </div>
            @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <div class="input-icon-wrapper">
            <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
            <i class="fa-solid fa-envelope"></i>
          </div>
          @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="phone">Phone Number</label>
          <div class="input-icon-wrapper">
            <input class="form-input" type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+91 9876543210">
            <i class="fa-solid fa-phone"></i>
          </div>
          @error('phone')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <div class="input-icon-wrapper">
            <input class="form-input" type="password" id="password" name="password" required placeholder="Create a password">
            <i class="fa-solid fa-lock"></i>
          </div>
          @error('password')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password_confirmation">Confirm Password</label>
          <div class="input-icon-wrapper">
            <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat password">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
        </div>

        <div class="form-group" style="margin-top: 6px;">
          <label class="form-label" for="referral_code" style="display: flex; justify-content: space-between; align-items: center;">
            <span>Referral Code <span style="font-size: 11px; font-weight: normal; color: var(--text-3);">(Optional)</span></span>
            <span style="font-size: 11px; font-weight: 700; color: #16a34a;"><i class="fa-solid fa-gift"></i> +100 Points</span>
          </label>
          <div class="input-icon-wrapper">
            <input class="form-input" type="text" id="referral_code" name="referral_code" value="{{ old('referral_code', request('ref', session('referral_code'))) }}" placeholder="e.g. VEDANT2026" style="text-transform: uppercase;">
            <i class="fa-solid fa-ticket"></i>
          </div>
          @if(request('ref') || session('referral_code'))
            <div style="font-size: 12px; color: #16a34a; margin-top: 6px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
              <i class="fa-solid fa-circle-check"></i> Referral applied! You and your friend both earn 100 points upon email verification.
            </div>
          @endif
        </div>

        <button type="submit" class="auth-btn">Create Account</button>
      </form>

      <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Sign In</a>
      </div>
    </div>
  </div>
  
</div>
@endsection

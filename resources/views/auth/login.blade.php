@extends('layouts.app')

@section('title', 'Sign In | Career Gyan')

@section('content')
<style>
  .auth-section {
    padding: 80px 20px;
    background: var(--surface);
    min-height: calc(100vh - 100px);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .auth-card {
    background: #fff;
    max-width: 440px;
    width: 100%;
    border-radius: var(--radius-xl);
    padding: 40px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
  }
  .auth-header {
    text-align: center;
    margin-bottom: 30px;
  }
  .auth-header h1 {
    font-size: 28px;
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
  .form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-1);
    margin-bottom: 8px;
  }
  .form-input {
    width: 100%;
    padding: 12px 16px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    font-size: 15px;
    color: var(--text-1);
    transition: all var(--transition);
  }
  .form-input:focus {
    outline: none;
    border-color: var(--brand);
    box-shadow: 0 0 0 3px var(--brand-light);
  }
  .form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    font-size: 14px;
  }
  .form-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-2);
  }
  .form-checkbox input {
    accent-color: var(--brand);
    width: 16px;
    height: 16px;
  }
  .auth-btn {
    width: 100%;
    padding: 14px;
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: var(--radius-md);
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background var(--transition), transform var(--transition);
  }
  .auth-btn:hover {
    background: var(--brand-dark);
    transform: translateY(-2px);
  }
  .auth-footer {
    text-align: center;
    margin-top: 24px;
    font-size: 15px;
    color: var(--text-2);
  }
  .auth-footer a {
    color: var(--brand);
    font-weight: 600;
    text-decoration: none;
  }
  .auth-footer a:hover {
    text-decoration: underline;
  }
  .alert-error {
    background: #fef2f2;
    color: #991b1b;
    padding: 12px 16px;
    border-radius: var(--radius-md);
    font-size: 14px;
    margin-bottom: 20px;
    border: 1px solid #fecaca;
  }
</style>

<div class="auth-section">
  <div class="auth-card">
    <div class="auth-header">
      <h1>Welcome Back</h1>
      <p>Sign in to continue your career journey</p>
    </div>

    @if ($errors->any())
      <div class="alert-error">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
      @csrf
      
      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input class="form-input" type="password" id="password" name="password" required placeholder="••••••••">
      </div>

      <div class="form-options">
        <label class="form-checkbox">
          <input type="checkbox" name="remember">
          Remember me
        </label>
      </div>

      <button type="submit" class="auth-btn">Sign In</button>
    </form>

    <div class="auth-footer">
      Don't have an account? <a href="{{ route('signup') }}">Sign Up</a>
    </div>
  </div>
</div>
@endsection

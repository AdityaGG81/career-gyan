@extends('layouts.app')

@section('title', 'Sign Up | Career Gyan')

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
    max-width: 500px;
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
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
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
    margin-top: 10px;
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
  .form-error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
  }
</style>

<div class="auth-section">
  <div class="auth-card">
    <div class="auth-header">
      <h1>Create an Account</h1>
      <p>Join Career Gyan and find your perfect path</p>
    </div>

    <form method="POST" action="{{ route('signup.submit') }}">
      @csrf
      
      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="first_name">First Name</label>
          <input class="form-input" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="John">
          @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="last_name">Last Name</label>
          <input class="form-input" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Doe">
          @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
        @error('email')<div class="form-error">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="phone">Phone Number</label>
        <input class="form-input" type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+91 9876543210">
        @error('phone')<div class="form-error">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input class="form-input" type="password" id="password" name="password" required placeholder="Create a password">
        @error('password')<div class="form-error">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat password">
      </div>

      <button type="submit" class="auth-btn">Create Account</button>
    </form>

    <div class="auth-footer">
      Already have an account? <a href="{{ route('login') }}">Sign In</a>
    </div>
  </div>
</div>
@endsection

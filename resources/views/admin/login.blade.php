@extends('layouts.app')

@section('title', 'Admin Login - CareerGyan')

@section('styles')
<style>
  .admin-login-wrapper {
    min-height: calc(100vh - 84px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: radial-gradient(circle at 50% -20%, #1e3a8a 0%, #0f172a 60%);
  }

  .login-card-split {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    width: 100%;
    max-width: 1000px;
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.08);
    overflow: hidden;
  }

  /* Left split: Brand & Doodles */
  .login-left-brand {
    background: linear-gradient(180deg, rgba(30, 58, 138, 0.4) 0%, rgba(15, 23, 42, 0) 100%);
    padding: 60px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
  }

  .login-left-brand::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1' fill='%23ffffff' fill-opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
  }

  .admin-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(59, 130, 246, 0.15);
    color: #60a5fa;
    padding: 8px 16px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 24px;
    border: 1px solid rgba(59, 130, 246, 0.3);
    width: fit-content;
  }

  .login-left-brand h2 {
    font-family: 'Sora', sans-serif;
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.2;
    background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .login-left-brand p {
    font-size: 16px;
    color: #94a3b8;
    line-height: 1.7;
    margin-bottom: 40px;
  }

  .feature-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .feature-item {
    display: flex;
    align-items: center;
    gap: 16px;
    color: #cbd5e1;
    font-size: 14.5px;
    font-weight: 500;
  }

  .feature-icon {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #60a5fa;
    font-size: 14px;
  }

  /* Right split: Login form */
  .login-right-form {
    padding: 60px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: rgba(255, 255, 255, 0.02);
  }

  .login-header {
    margin-bottom: 40px;
  }

  .login-header h1 {
    font-family: 'Sora', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 8px;
  }

  .login-header p {
    color: #94a3b8;
    font-size: 15px;
  }

  .form-group {
    margin-bottom: 24px;
    position: relative;
  }

  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #cbd5e1;
    margin-bottom: 10px;
  }

  .input-icon-wrap {
    position: relative;
  }

  .input-icon-wrap i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 16px;
    transition: color 0.3s;
  }

  .form-control {
    width: 100%;
    padding: 14px 18px 14px 48px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.2);
    font-family: inherit;
    font-size: 15px;
    color: #ffffff;
    transition: all 0.3s ease;
  }

  .form-control::placeholder {
    color: #475569;
  }

  .form-control:focus {
    outline: none;
    border-color: #3b82f6;
    background: rgba(15, 23, 42, 0.6);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
  }

  .form-control:focus + i {
    color: #60a5fa;
  }

  .btn-login {
    width: 100%;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #ffffff;
    border: none;
    padding: 16px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
    margin-top: 32px;
  }

  .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2);
    background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
  }

  .alert {
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .alert-error {
    background: rgba(239, 68, 68, 0.1);
    color: #f87171;
    border: 1px solid rgba(239, 68, 68, 0.2);
  }

  @media (max-width: 991px) {
    .login-card-split {
      grid-template-columns: 1fr;
      max-width: 500px;
    }

    .login-left-brand {
      display: none;
    }

    .login-right-form {
      padding: 40px 30px;
    }
  }
</style>
@endsection

@section('content')
<div class="admin-login-wrapper">
  <div class="login-card-split">
    <!-- Left panel: Brand -->
    <div class="login-left-brand">
      <div class="admin-badge">
        <i class="fa-solid fa-user-shield"></i>
        <span>Restricted Area</span>
      </div>
      <h2>CareerGyan Command Center</h2>
      <p>Authenticate to access the administrative dashboard. Manage students, update career roadmaps, and oversee the platform.</p>
      
      <div class="feature-list">
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-chart-line"></i></div>
          <span>Real-time platform analytics</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-users"></i></div>
          <span>Manage user accounts & suggestions</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon"><i class="fa-solid fa-pen-nib"></i></div>
          <span>Publish & edit career content</span>
        </div>
      </div>
    </div>

    <!-- Right panel: Form -->
    <div class="login-right-form">
      <div class="login-header">
        <h1>Admin Portal</h1>
        <p>Enter your credentials to continue</p>
      </div>

      @if(session('error'))
        <div class="alert alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        
        <!-- Email -->
        <div class="form-group">
          <label for="email">Admin Email</label>
          <div class="input-icon-wrap">
            <input type="email" name="email" id="email" class="form-control" placeholder="admin@careergyan.in" required value="{{ old('email') }}">
            <i class="fa-solid fa-envelope"></i>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">Security Password</label>
          <div class="input-icon-wrap">
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            <i class="fa-solid fa-lock"></i>
          </div>
        </div>

        <button type="submit" class="btn-login">
          Sign In to Dashboard <i class="fa-solid fa-arrow-right"></i>
        </button>
      </form>
    </div>
  </div>
</div>
@endsection

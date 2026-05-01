@extends('layouts.app')

@section('title', 'Admin Login - CareerGyan')

@section('styles')
<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at top right, #f8fafc, #eff6ff);
    }
    .login-card {
        background: #fff;
        padding: 40px;
        border-radius: var(--radius-xl);
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        width: 100%;
        max-width: 400px;
    }
    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .login-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-1);
        margin-bottom: 8px;
    }
    .login-header p {
        color: var(--text-3);
        font-size: 14px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-2);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: var(--radius-lg);
        border: 1.5px solid var(--border);
        font-family: inherit;
        font-size: 15px;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
    }
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: var(--radius-lg);
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(29, 78, 216, 0.3);
    }
    .alert {
        padding: 12px 16px;
        border-radius: var(--radius-lg);
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    .alert-error {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .alert-success {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>Admin Access</h1>
            <p>Please enter your credentials</p>
        </div>

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required placeholder="admin">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">
                Login to Dashboard <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>
</div>
@endsection

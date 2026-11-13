<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - CareerGuru Partner Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="icon" type="image/png" href="{{ asset('careergyan-tab-logo.png') }}?v=10">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      min-height: 100vh;
      background: radial-gradient(circle at 10% 20%, #0f172a 0%, #1e1b4b 50%, #0c0a1f 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 16px;
    }
    .auth-container { width: 100%; max-width: 440px; }
    .auth-card {
      background: rgba(15, 23, 42, 0.85);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;
      padding: 38px 34px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(20px);
    }
    .brand-header { text-align: center; margin-bottom: 24px; }
    .brand-icon {
      width: 52px; height: 52px; margin: 0 auto 14px;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border-radius: 16px; display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 22px;
    }
    .brand-header h1 {
      font-family: 'Outfit', sans-serif; font-size: 22px; font-weight: 700; color: #fff;
    }
    .brand-header p {
      font-size: 13px; color: #94a3b8; margin-top: 6px; line-height: 1.5;
    }
    .auth-alert {
      padding: 12px 14px; border-radius: 10px; margin-bottom: 20px; font-size: 13px;
    }
    .alert-danger { background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.35); color: #fca5a5; }
    .alert-success { background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.35); color: #86efac; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 12.5px; font-weight: 600; color: #cbd5e1; margin-bottom: 7px; }
    .input-wrapper { position: relative; }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 14px; }
    .form-input {
      width: 100%; padding: 12px 14px 12px 40px; border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.14); background: rgba(15, 23, 42, 0.6);
      color: #ffffff; font-size: 14px; font-family: inherit; outline: none; transition: all 0.2s;
    }
    .form-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25); }
    .btn-submit {
      width: 100%; padding: 13px; border: none; border-radius: 12px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff; font-size: 14px; font-weight: 700; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover { background: linear-gradient(135deg, #1d4ed8, #1e40af); }
    .back-link {
      display: block; text-align: center; margin-top: 20px; color: #94a3b8;
      text-decoration: none; font-size: 13px; font-weight: 600;
    }
    .back-link:hover { color: #fff; }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <div class="brand-header">
        <div class="brand-icon"><i class="fa-solid fa-key"></i></div>
        <h1>Forgot Password</h1>
        <p>Enter your registered email address and we'll send you a secure link to reset your CareerGuru password.</p>
      </div>

      @if(session('status'))
        <div class="auth-alert alert-success">
          <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
      @endif

      @if(session('error'))
        <div class="auth-alert alert-danger">
          <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="auth-alert alert-danger">
          @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('careerguru.password.email') }}">
        @csrf
        <div class="form-group">
          <label class="form-label" for="email">Gmail / Email Address</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-input" placeholder="guru@gmail.com" value="{{ old('email') }}" required autofocus>
          </div>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-paper-plane"></i> Send Password Reset Link
        </button>
      </form>

      <a href="{{ route('careerguru.login') }}" class="back-link">
        <i class="fa-solid fa-arrow-left" style="margin-right: 4px;"></i> Back to Login
      </a>
    </div>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareerGuru Partner Login - CareerGyan</title>
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
      position: relative;
      overflow-x: hidden;
    }

    /* Ambient background glows */
    .glow-1 {
      position: absolute;
      top: -100px;
      right: -100px;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, transparent 70%);
      border-radius: 50%;
      filter: blur(50px);
      pointer-events: none;
    }
    .glow-2 {
      position: absolute;
      bottom: -100px;
      left: -100px;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, transparent 70%);
      border-radius: 50%;
      filter: blur(50px);
      pointer-events: none;
    }

    .auth-container {
      width: 100%;
      max-width: 440px;
      z-index: 10;
    }

    .auth-card {
      background: rgba(15, 23, 42, 0.85);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;
      padding: 38px 34px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
    }

    .brand-header {
      text-align: center;
      margin-bottom: 28px;
    }
    .brand-icon {
      width: 58px;
      height: 58px;
      margin: 0 auto 16px;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 26px;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
    }
    .brand-header h1 {
      font-family: 'Outfit', sans-serif;
      font-size: 24px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: -0.01em;
    }
    .brand-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 6px;
      padding: 4px 12px;
      background: rgba(251, 191, 36, 0.15);
      border: 1px solid rgba(251, 191, 36, 0.3);
      border-radius: 999px;
      color: #fbbf24;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }

    .auth-alert {
      padding: 12px 14px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 13px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }
    .alert-danger { background: rgba(239, 68, 68, 0.18); border: 1px solid rgba(239, 68, 68, 0.35); color: #fca5a5; }
    .alert-success { background: rgba(16, 185, 129, 0.18); border: 1px solid rgba(16, 185, 129, 0.35); color: #86efac; }
    .alert-warning { background: rgba(245, 158, 11, 0.18); border: 1px solid rgba(245, 158, 11, 0.35); color: #fde047; }

    .form-group {
      margin-bottom: 20px;
    }
    .form-label {
      display: block;
      font-size: 12.5px;
      font-weight: 600;
      color: #cbd5e1;
      margin-bottom: 7px;
    }
    .input-wrapper {
      position: relative;
    }
    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
      font-size: 14px;
    }
    .form-input {
      width: 100%;
      padding: 12px 14px 12px 40px;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.14);
      background: rgba(15, 23, 42, 0.6);
      color: #ffffff;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      border-color: #3b82f6;
      background: rgba(15, 23, 42, 0.9);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }
    .toggle-pwd {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
      cursor: pointer;
      font-size: 14px;
    }

    .form-actions {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      font-size: 12.5px;
    }
    .remember-me {
      display: flex;
      align-items: center;
      gap: 7px;
      color: #94a3b8;
      cursor: pointer;
    }
    .forgot-link {
      color: #60a5fa;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }
    .forgot-link:hover { color: #93c5fd; text-decoration: underline; }

    .btn-submit {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.35);
      transition: all 0.2s;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, #1d4ed8, #1e40af);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
    }

    .partner-note {
      margin-top: 24px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      text-align: center;
      font-size: 12px;
      color: #64748b;
      line-height: 1.5;
    }
    .partner-note a {
      color: #94a3b8;
      text-decoration: none;
      font-weight: 600;
    }
    .partner-note a:hover { color: #fff; }
  </style>
</head>
<body>
  <div class="glow-1"></div>
  <div class="glow-2"></div>

  <div class="auth-container">
    <div class="auth-card">
      <div class="brand-header">
        <div class="brand-icon">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <h1>CareerGuru Partner Login</h1>
        <div class="brand-badge">
          <i class="fa-solid fa-handshake"></i> Partner Program
        </div>
      </div>

      @if(session('success'))
        <div class="auth-alert alert-success">
          <i class="fa-solid fa-circle-check" style="margin-top: 2px;"></i>
          <div>{{ session('success') }}</div>
        </div>
      @endif

      @if(session('error'))
        <div class="auth-alert alert-danger">
          <i class="fa-solid fa-circle-exclamation" style="margin-top: 2px;"></i>
          <div>{{ session('error') }}</div>
        </div>
      @endif

      @if(session('warning'))
        <div class="auth-alert alert-warning">
          <i class="fa-solid fa-triangle-exclamation" style="margin-top: 2px;"></i>
          <div>{{ session('warning') }}</div>
        </div>
      @endif

      @if($errors->any())
        <div class="auth-alert alert-danger">
          <i class="fa-solid fa-circle-exclamation" style="margin-top: 2px;"></i>
          <div>
            @foreach($errors->all() as $err)
              <div>{{ $err }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('careerguru.login.submit') }}">
        @csrf

        <div class="form-group">
          <label class="form-label" for="email">Gmail / Email Address</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-input" placeholder="guru@gmail.com" value="{{ old('email') }}" required autofocus autocomplete="email">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock input-icon"></i>
            <input type="password" id="password" name="password" class="form-input" placeholder="••••••••••••" required autocomplete="current-password">
            <i class="fa-regular fa-eye toggle-pwd" onclick="togglePasswordVisibility()"></i>
          </div>
        </div>

        <div class="form-actions">
          <label class="remember-me">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>Keep me signed in</span>
          </label>
          <a href="{{ route('careerguru.password.request') }}" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In to Partner Portal
        </button>
      </form>

      <div class="partner-note">
        <p><i class="fa-solid fa-shield-halved" style="margin-right: 4px; color: #94a3b8;"></i> CareerGuru accounts are created & verified by CareerGyan administrators.</p>
        <p style="margin-top: 6px;"><a href="{{ url('/') }}">← Back to CareerGyan Website</a></p>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const pwd = document.getElementById('password');
      const icon = event.currentTarget;
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') - CareerGuru Partner Portal | CareerGyan</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="icon" type="image/png" href="{{ asset('careergyan-tab-logo.png') }}?v=10">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root {
      --guru-primary: #2563eb;
      --guru-primary-dark: #1d4ed8;
      --guru-primary-light: #dbeafe;
      --guru-accent: #f59e0b;
      --guru-success: #10b981;
      --guru-danger: #ef4444;
      --guru-sidebar: #0f172a;
      --guru-sidebar-card: #1e293b;
      --guru-sidebar-text: #94a3b8;
      --guru-sidebar-active: #3b82f6;
      --guru-bg: #f8fafc;
      --guru-surface: #ffffff;
      --guru-border: #e2e8f0;
      --guru-text-main: #0f172a;
      --guru-text-muted: #64748b;
      --sidebar-w: 270px;
      --header-h: 70px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
      background: var(--guru-bg);
      color: var(--guru-text-main);
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Sidebar */
    .guru-sidebar {
      width: var(--sidebar-w);
      background: var(--guru-sidebar);
      color: var(--guru-sidebar-text);
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: column;
      z-index: 100;
      transition: transform 0.3s ease;
      border-right: 1px solid rgba(255,255,255,0.06);
    }

    .guru-sidebar-brand {
      height: var(--header-h);
      padding: 0 22px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-decoration: none;
    }
    .guru-logo-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 18px;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    .guru-logo-text {
      display: flex;
      flex-direction: column;
    }
    .guru-logo-text .title {
      font-family: 'Outfit', sans-serif;
      font-size: 19px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: -0.01em;
      line-height: 1.1;
    }
    .guru-logo-text .badge {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #fbbf24;
      font-weight: 700;
      margin-top: 2px;
    }

    /* Guru Partner Card in Sidebar */
    .sidebar-partner-pill {
      margin: 16px 16px 8px;
      padding: 12px 14px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.07);
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .sidebar-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #6366f1, #3b82f6);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      flex-shrink: 0;
    }
    .sidebar-partner-info {
      overflow: hidden;
      flex: 1;
    }
    .sidebar-partner-info .name {
      color: #ffffff;
      font-size: 13px;
      font-weight: 600;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }
    .sidebar-partner-info .meta {
      font-size: 11px;
      color: #94a3b8;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .guru-id-tag {
      background: rgba(59, 130, 246, 0.2);
      color: #93c5fd;
      padding: 1px 6px;
      border-radius: 4px;
      font-weight: 600;
      font-size: 10px;
      letter-spacing: 0.05em;
    }

    /* Menu */
    .guru-sidebar-menu {
      list-style: none;
      padding: 12px 14px 24px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex-grow: 1;
      overflow-y: auto;
    }
    .guru-sidebar-menu::-webkit-scrollbar { width: 5px; }
    .guru-sidebar-menu::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

    .menu-heading {
      font-size: 10.5px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #64748b;
      font-weight: 700;
      margin: 14px 0 6px 12px;
    }

    .guru-menu-item a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #94a3b8;
      text-decoration: none;
      padding: 10px 14px;
      border-radius: 10px;
      font-weight: 500;
      font-size: 13.5px;
      transition: all 0.2s ease;
      position: relative;
    }
    .guru-menu-item a:hover {
      color: #ffffff;
      background: rgba(255, 255, 255, 0.06);
    }
    .guru-menu-item.active a {
      color: #ffffff;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.25), rgba(59, 130, 246, 0.15));
      border: 1px solid rgba(59, 130, 246, 0.35);
      font-weight: 600;
    }
    .guru-menu-item a i {
      width: 20px;
      font-size: 15px;
      text-align: center;
    }
    .guru-menu-item .menu-badge {
      margin-left: auto;
      padding: 2px 7px;
      font-size: 11px;
      font-weight: 700;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.08);
      color: #cbd5e1;
    }

    /* Referral Quick Pill */
    .sidebar-referral-box {
      margin: 12px 14px;
      padding: 12px;
      background: linear-gradient(135deg, rgba(37,99,235,0.15), rgba(30,58,138,0.25));
      border: 1px dashed rgba(59, 130, 246, 0.4);
      border-radius: 12px;
      text-align: center;
    }
    .sidebar-referral-box .code-label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #93c5fd;
      font-weight: 700;
      margin-bottom: 4px;
    }
    .sidebar-referral-box .code-val {
      font-family: monospace;
      font-size: 14px;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: 0.08em;
      background: rgba(0,0,0,0.3);
      padding: 4px 8px;
      border-radius: 6px;
      display: inline-block;
      margin-bottom: 8px;
    }
    .sidebar-referral-box .btn-copy-ref {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      font-weight: 600;
      padding: 5px 10px;
      background: #2563eb;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      justify-content: center;
      transition: background 0.2s;
    }
    .sidebar-referral-box .btn-copy-ref:hover {
      background: #1d4ed8;
    }

    /* Main Area */
    .guru-main {
      margin-left: var(--sidebar-w);
      width: calc(100% - var(--sidebar-w));
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: all 0.3s ease;
    }

    /* Topbar */
    .guru-topbar {
      height: var(--header-h);
      background: var(--guru-surface);
      border-bottom: 1px solid var(--guru-border);
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 90;
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .hamburger-btn {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      color: var(--guru-text-main);
      cursor: pointer;
      padding: 6px;
      border-radius: 6px;
    }
    .topbar-page-title {
      font-family: 'Outfit', sans-serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--guru-text-main);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .topbar-right {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .rate-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      background: #ecfdf5;
      color: #047857;
      border: 1px solid #a7f3d0;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
    }
    .topbar-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      font-size: 12.5px;
      font-weight: 600;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s;
    }
    .topbar-btn-primary {
      background: var(--guru-primary);
      color: #fff;
    }
    .topbar-btn-primary:hover {
      background: var(--guru-primary-dark);
    }
    .topbar-btn-outline {
      background: #fff;
      color: var(--guru-text-main);
      border: 1px solid var(--guru-border);
    }
    .topbar-btn-outline:hover {
      background: #f1f5f9;
    }

    /* Content */
    .guru-content {
      padding: 28px 32px 40px;
      flex-grow: 1;
    }

    /* Alerts */
    .guru-alert {
      padding: 14px 18px;
      border-radius: 12px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 13.5px;
      font-weight: 500;
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .guru-alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .guru-alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    .guru-alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .guru-alert-info { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }

    /* Cards */
    .guru-card {
      background: var(--guru-surface);
      border: 1px solid var(--guru-border);
      border-radius: 14px;
      box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
      margin-bottom: 24px;
      overflow: hidden;
    }
    .guru-card-header {
      padding: 18px 22px;
      border-bottom: 1px solid var(--guru-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }
    .guru-card-title {
      font-family: 'Outfit', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: var(--guru-text-main);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .guru-card-body {
      padding: 22px;
    }

    /* Tables */
    .guru-table-wrapper {
      width: 100%;
      overflow-x: auto;
      border-radius: 10px;
    }
    .guru-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
      text-align: left;
    }
    .guru-table th {
      background: #f8fafc;
      padding: 12px 16px;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #64748b;
      font-weight: 700;
      border-bottom: 1px solid var(--guru-border);
      white-space: nowrap;
    }
    .guru-table td {
      padding: 14px 16px;
      border-bottom: 1px solid #f1f5f9;
      color: var(--guru-text-main);
      vertical-align: middle;
    }
    .guru-table tr:hover td {
      background: #f8fafc;
    }

    /* Badges */
    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 11.5px;
      font-weight: 600;
      white-space: nowrap;
    }
    .pill-green { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .pill-blue { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .pill-yellow { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .pill-purple { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
    .pill-gray { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .pill-red { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 9px 16px;
      font-size: 13px;
      font-weight: 600;
      border-radius: 8px;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all 0.2s ease;
    }
    .btn-sm { padding: 5px 10px; font-size: 12px; }
    .btn-primary { background: var(--guru-primary); color: #fff; }
    .btn-primary:hover { background: var(--guru-primary-dark); }
    .btn-outline { background: #fff; border-color: var(--guru-border); color: var(--guru-text-main); }
    .btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; }
    .btn-success { background: var(--guru-success); color: #fff; }
    .btn-success:hover { background: #059669; }
    .btn-danger { background: var(--guru-danger); color: #fff; }
    .btn-danger:hover { background: #dc2626; }

    /* Form inputs */
    .form-group { margin-bottom: 18px; }
    .form-label {
      display: block;
      font-size: 12.5px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 6px;
    }
    .form-label .required { color: var(--guru-danger); margin-left: 3px; }
    .form-control {
      width: 100%;
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid var(--guru-border);
      font-size: 13.5px;
      color: var(--guru-text-main);
      background: #fff;
      transition: border-color 0.2s;
      outline: none;
      font-family: inherit;
    }
    .form-control:focus {
      border-color: var(--guru-primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }
    .form-text {
      font-size: 11.5px;
      color: var(--guru-text-muted);
      margin-top: 4px;
    }

    /* Modal */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(4px);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      padding: 20px;
    }
    .modal-backdrop.show { display: flex; }
    .modal-card {
      background: #fff;
      border-radius: 16px;
      width: 100%;
      max-width: 540px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .modal-header {
      padding: 18px 24px;
      border-bottom: 1px solid var(--guru-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .modal-body { padding: 22px 24px; }
    .modal-footer {
      padding: 16px 24px;
      border-top: 1px solid var(--guru-border);
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      background: #f8fafc;
    }

    @media (max-width: 991px) {
      .guru-sidebar {
        transform: translateX(-100%);
        box-shadow: 10px 0 30px rgba(0,0,0,0.25);
      }
      .guru-sidebar.show {
        transform: translateX(0);
      }
      .guru-main {
        margin-left: 0;
        width: 100%;
      }
      .hamburger-btn {
        display: block;
      }
      .guru-content {
        padding: 20px 16px;
      }
      .guru-topbar {
        padding: 0 16px;
      }
    }
  </style>
  @yield('styles')
</head>
<body>

  <!-- Sidebar -->
  <aside class="guru-sidebar" id="guruSidebar">
    <a href="{{ route('careerguru.dashboard') }}" class="guru-sidebar-brand">
      <div class="guru-logo-icon">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
      <div class="guru-logo-text">
        <span class="title">CareerGyan</span>
        <span class="badge"><i class="fa-solid fa-crown" style="margin-right:2px;"></i> CareerGuru</span>
      </div>
    </a>

    @php
      $guru = auth('careerguru')->user();
      $currentRoute = request()->route() ? request()->route()->getName() : '';
    @endphp

    @if($guru)
      <div class="sidebar-partner-pill">
        <div class="sidebar-avatar">
          {{ strtoupper(substr($guru->name, 0, 1)) }}
        </div>
        <div class="sidebar-partner-info">
          <div class="name" title="{{ $guru->name }}">{{ $guru->name }}</div>
          <div class="meta">
            <span class="guru-id-tag">{{ $guru->guru_id }}</span>
            <span>· {{ $guru->commission_percentage }}% comm.</span>
          </div>
        </div>
      </div>

      <div class="sidebar-referral-box">
        <div class="code-label"><i class="fa-solid fa-link" style="margin-right: 3px;"></i> Your Referral Code</div>
        <div class="code-val" id="sidebarRefCode">{{ $guru->referral_code }}</div>
        <button type="button" class="btn-copy-ref" onclick="copyReferralLink('{{ route('careerguru.ref', ['code' => $guru->referral_code]) }}', this)">
          <i class="fa-regular fa-copy"></i> <span>Copy Link</span>
        </button>
      </div>
    @endif

    <ul class="guru-sidebar-menu">
      <li class="menu-heading">Main</li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.dashboard' ? 'active' : '' }}">
        <a href="{{ route('careerguru.dashboard') }}">
          <i class="fa-solid fa-chart-pie" style="color: #60a5fa;"></i> Dashboard
        </a>
      </li>

      <li class="menu-heading">Lead Management</li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.students.index' ? 'active' : '' }}">
        <a href="{{ route('careerguru.students.index') }}">
          <i class="fa-solid fa-users" style="color: #38bdf8;"></i> All Students / Leads
          @if($guru && $guru->totalLeadsCount() > 0)
            <span class="menu-badge">{{ $guru->totalLeadsCount() }}</span>
          @endif
        </a>
      </li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.students.create' ? 'active' : '' }}">
        <a href="{{ route('careerguru.students.create') }}">
          <i class="fa-solid fa-user-plus" style="color: #4ade80;"></i> Add New Student
        </a>
      </li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.students.registered' ? 'active' : '' }}">
        <a href="{{ route('careerguru.students.registered') }}">
          <i class="fa-solid fa-id-badge" style="color: #818cf8;"></i> Registered Students
          @if($guru && $guru->registeredCount() > 0)
            <span class="menu-badge" style="background: rgba(99,102,241,0.25); color: #c7d2fe;">{{ $guru->registeredCount() }}</span>
          @endif
        </a>
      </li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.students.premium' ? 'active' : '' }}">
        <a href="{{ route('careerguru.students.premium') }}">
          <i class="fa-solid fa-crown" style="color: #fbbf24;"></i> Premium Students
          @if($guru && $guru->premiumCount() > 0)
            <span class="menu-badge" style="background: rgba(251,191,36,0.25); color: #fde68a;">{{ $guru->premiumCount() }}</span>
          @endif
        </a>
      </li>

      <li class="menu-heading">Earnings & Growth</li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.commissions.index' ? 'active' : '' }}">
        <a href="{{ route('careerguru.commissions.index') }}">
          <i class="fa-solid fa-wallet" style="color: #34d399;"></i> My Commissions
        </a>
      </li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.referral-link' ? 'active' : '' }}">
        <a href="{{ route('careerguru.referral-link') }}">
          <i class="fa-solid fa-share-nodes" style="color: #f472b6;"></i> Referral & Share
        </a>
      </li>

      <li class="menu-heading">Account</li>
      <li class="guru-menu-item {{ $currentRoute == 'careerguru.profile' ? 'active' : '' }}">
        <a href="{{ route('careerguru.profile') }}">
          <i class="fa-solid fa-user-gear" style="color: #cbd5e1;"></i> Profile & Payout
        </a>
      </li>
      <li class="guru-menu-item">
        <form method="POST" action="{{ route('careerguru.logout') }}" id="logoutForm" style="display:none;">
          @csrf
        </form>
        <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit();" style="color: #f87171;">
          <i class="fa-solid fa-right-from-bracket"></i> Sign Out
        </a>
      </li>
    </ul>
  </aside>

  <!-- Main Container -->
  <div class="guru-main">
    <header class="guru-topbar">
      <div class="topbar-left">
        <button type="button" class="hamburger-btn" onclick="toggleSidebar()">
          <i class="fa-solid fa-bars"></i>
        </button>
        <div class="topbar-page-title">
          @yield('page-title', 'CareerGuru Partner Portal')
        </div>
      </div>
      <div class="topbar-right">
        @if($guru)
          <div class="rate-badge">
            <i class="fa-solid fa-percentage"></i> Commission: {{ $guru->commission_percentage }}%
          </div>
          <a href="{{ route('careerguru.students.create') }}" class="topbar-btn topbar-btn-primary">
            <i class="fa-solid fa-user-plus"></i> Add Student
          </a>
        @endif
      </div>
    </header>

    <main class="guru-content">
      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="guru-alert guru-alert-success">
          <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i>
          <div>{{ session('success') }}</div>
        </div>
      @endif

      @if(session('error'))
        <div class="guru-alert guru-alert-danger">
          <i class="fa-solid fa-circle-exclamation" style="font-size: 18px;"></i>
          <div>{{ session('error') }}</div>
        </div>
      @endif

      @if(session('warning'))
        <div class="guru-alert guru-alert-warning">
          <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px;"></i>
          <div>{{ session('warning') }}</div>
        </div>
      @endif

      @if(session('info'))
        <div class="guru-alert guru-alert-info">
          <i class="fa-solid fa-circle-info" style="font-size: 18px;"></i>
          <div>{{ session('info') }}</div>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  <script>
    function toggleSidebar() {
      document.getElementById('guruSidebar').classList.toggle('show');
    }

    function copyReferralLink(url, btn) {
      navigator.clipboard.writeText(url).then(function() {
        const origHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i> <span>Copied!</span>';
        btn.style.background = '#10b981';
        setTimeout(function() {
          btn.innerHTML = origHtml;
          btn.style.background = '';
        }, 2200);
      }).catch(function(err) {
        alert('Could not copy link: ' + err);
      });
    }
  </script>
  @yield('scripts')
</body>
</html>


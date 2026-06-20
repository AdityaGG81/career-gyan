<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard') - CareerGyan Admin</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="icon" type="image/png" href="{{ asset('careergyan-tab-logo.png') }}?v=10">

  <style>
    /* ─── Global Admin Styles ─── */
    :root {
      --sidebar-width: 280px;
      --header-height: 72px;
      
      --admin-brand: #000000;
      --admin-brand-light: #27272a;
      
      --admin-bg: #f4f4f5;
      --admin-surface: #ffffff;
      
      --admin-text-1: #09090b;
      --admin-text-2: #52525b;
      --admin-text-3: #a1a1aa;
      
      --admin-border: #e4e4e7;
      
      --sidebar-bg: #09090b;
      --sidebar-text: #a1a1aa;
      --sidebar-active-bg: #27272a;
      --sidebar-active-text: #ffffff;
      
      --admin-radius-md: 10px;
      --admin-radius-lg: 16px;
      --admin-radius-xl: 24px;
      
      --admin-shadow: 0 4px 12px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.05);
      --admin-shadow-hover: 0 10px 24px rgba(0, 0, 0, 0.08), 0 4px 8px rgba(0, 0, 0, 0.04);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--admin-bg);
      color: var(--admin-text-1);
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ─── Sidebar ─── */
    .admin-sidebar {
      width: var(--sidebar-width);
      background: var(--sidebar-bg);
      color: var(--sidebar-text);
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: column;
      z-index: 100;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .admin-sidebar-header {
      height: var(--header-height);
      padding: 0 24px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .admin-sidebar-logo {
      font-family: 'Outfit', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: -0.02em;
    }

    .admin-sidebar-menu {
      list-style: none;
      padding: 24px 16px;
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex-grow: 1;
      overflow-y: auto;
    }

    .admin-sidebar-menu::-webkit-scrollbar {
      width: 6px;
    }
    .admin-sidebar-menu::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
    }

    .menu-category {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #52525b;
      font-weight: 700;
      margin: 16px 0 8px 12px;
    }

    .admin-menu-item a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: var(--sidebar-text);
      text-decoration: none;
      padding: 12px 14px;
      border-radius: var(--admin-radius-md);
      font-weight: 500;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .admin-menu-item a:hover {
      color: var(--sidebar-active-text);
      background: rgba(255, 255, 255, 0.04);
    }

    .admin-menu-item.active a {
      color: var(--sidebar-active-text);
      background: var(--sidebar-active-bg);
      font-weight: 600;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    .admin-menu-item a i {
      width: 20px;
      font-size: 16px;
      text-align: center;
      opacity: 0.8;
    }

    .admin-sidebar-footer {
      padding: 20px;
      background: rgba(0,0,0,0.2);
      border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .admin-profile-card {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }

    .profile-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #60a5fa, #3b82f6);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
    }

    .profile-info {
      display: flex;
      flex-direction: column;
    }

    .profile-name {
      color: #fff;
      font-size: 14px;
      font-weight: 600;
    }
    
    .profile-role {
      color: #71717a;
      font-size: 12px;
    }

    .btn-logout {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      color: #f87171;
      background: rgba(239, 68, 68, 0.1);
      text-decoration: none;
      padding: 10px;
      border-radius: var(--admin-radius-md);
      font-weight: 600;
      font-size: 13px;
      transition: all 0.2s ease;
      width: 100%;
      border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-logout:hover {
      background: rgba(239, 68, 68, 0.15);
    }

    /* ─── Main Content Wrapper ─── */
    .admin-main {
      margin-left: var(--sidebar-width);
      width: calc(100% - var(--sidebar-width));
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ─── Top Bar ─── */
    .admin-topbar {
      height: var(--header-height);
      background: var(--admin-surface);
      border-bottom: 1px solid var(--admin-border);
      padding: 0 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 90;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .hamburger-menu {
      display: none;
      font-size: 20px;
      color: var(--admin-text-1);
      cursor: pointer;
      padding: 8px;
      border-radius: 8px;
      transition: background 0.2s;
    }

    .hamburger-menu:hover {
      background: #f4f4f5;
    }

    .page-title {
      font-family: 'Outfit', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--admin-text-1);
      letter-spacing: -0.01em;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .view-site-link {
      color: var(--admin-text-2);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: var(--admin-radius-md);
      transition: all 0.2s;
    }

    .view-site-link:hover {
      background: var(--admin-bg);
      color: var(--admin-text-1);
    }

    /* ─── Content Area ─── */
    .admin-content {
      padding: 40px;
      flex-grow: 1;
      max-width: 1400px;
      margin: 0 auto;
      width: 100%;
    }

    /* ─── Global Components ─── */
    .panel-card {
      background: var(--admin-surface);
      border: 1px solid var(--admin-border);
      border-radius: var(--admin-radius-lg);
      box-shadow: var(--admin-shadow);
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .panel-header {
      padding: 24px 24px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--admin-border);
    }

    .panel-header h2 {
      font-family: 'Outfit', sans-serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--admin-text-1);
    }

    .admin-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    .admin-table th {
      text-align: left;
      padding: 14px 24px;
      color: var(--admin-text-3);
      font-weight: 500;
      font-size: 13px;
      border-bottom: 1px solid var(--admin-border);
      background: #fafafa;
    }

    .admin-table td {
      padding: 16px 24px;
      border-bottom: 1px solid var(--admin-border);
      color: var(--admin-text-2);
      vertical-align: middle;
    }

    .admin-table tr:last-child td {
      border-bottom: none;
    }
    
    .form-control {
      width: 100%;
      padding: 10px 16px;
      border-radius: var(--admin-radius-md);
      border: 1px solid var(--admin-border);
      font-family: inherit;
      font-size: 14px;
      color: var(--admin-text-1);
      transition: all 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Alert Boxes */
    .admin-alert {
      padding: 16px 20px;
      border-radius: var(--admin-radius-md);
      margin-bottom: 24px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .admin-alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #bbf7d0;
    }

    .admin-alert-error {
      background: #fef2f2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    /* ─── Responsive ─── */
    @media (max-width: 991px) {
      .admin-sidebar {
        transform: translateX(-100%);
        box-shadow: 10px 0 30px rgba(0,0,0,0.2);
      }

      .admin-sidebar.show {
        transform: translateX(0);
      }

      .admin-main {
        margin-left: 0;
        width: 100%;
      }

      .hamburger-menu {
        display: block;
      }
      
      .admin-content {
        padding: 24px 20px;
      }
      
      .admin-topbar {
        padding: 0 20px;
      }
    }
  </style>
  @yield('styles')
</head>
<body>

  <!-- Sidebar -->
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-header">
      <i class="fa-solid fa-shapes" style="font-size: 20px; color: #ffffff;"></i>
      <span class="admin-sidebar-logo">CareerGyan</span>
    </div>

    @php
      $currentRoute = request()->route() ? request()->route()->getName() : '';
    @endphp

    <ul class="admin-sidebar-menu">
      <li class="menu-category">Overview</li>
      <li class="admin-menu-item {{ $currentRoute == 'admin.dashboard' ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa-solid fa-layer-group"></i> Dashboard
        </a>
      </li>
      
      <li class="menu-category">Management</li>
      <li class="admin-menu-item {{ $currentRoute == 'admin.users' ? 'active' : '' }}">
        <a href="{{ route('admin.users') }}">
          <i class="fa-solid fa-users"></i> Users
        </a>
      </li>
      <li class="admin-menu-item {{ str_starts_with($currentRoute, 'admin.fields') ? 'active' : '' }}">
        <a href="{{ route('admin.fields.index') }}">
          <i class="fa-solid fa-shapes"></i> Categories
        </a>
      </li>
      <li class="admin-menu-item {{ str_starts_with($currentRoute, 'admin.careers') ? 'active' : '' }}">
        <a href="{{ route('admin.careers.index') }}">
          <i class="fa-solid fa-briefcase"></i> Careers
        </a>
      </li>
      <li class="admin-menu-item {{ str_starts_with($currentRoute, 'admin.colleges') ? 'active' : '' }}">
        <a href="{{ route('admin.colleges.index') }}">
          <i class="fa-solid fa-graduation-cap"></i> Colleges
        </a>
      </li>
      <li class="admin-menu-item {{ str_starts_with($currentRoute, 'admin.blogs') ? 'active' : '' }}">
        <a href="{{ route('admin.blogs.index') }}">
          <i class="fa-solid fa-newspaper"></i> Blog Posts
        </a>
      </li>
      <li class="admin-menu-item {{ str_starts_with($currentRoute, 'admin.quiz') ? 'active' : '' }}">
        <a href="{{ route('admin.quiz.index') }}">
          <i class="fa-solid fa-circle-question"></i> Daily Quiz
        </a>
      </li>
      
      <li class="menu-category">Feedback</li>
      <li class="admin-menu-item {{ $currentRoute == 'admin.suggestions' ? 'active' : '' }}">
        <a href="{{ route('admin.suggestions') }}">
          <i class="fa-solid fa-inbox"></i> Suggestions
        </a>
      </li>
    </ul>

    <div class="admin-sidebar-footer">
      <div class="admin-profile-card">
        <div class="profile-avatar">A</div>
        <div class="profile-info">
          <span class="profile-name">Administrator</span>
          <span class="profile-role">admin@careergyan.in</span>
        </div>
      </div>
      <a href="{{ route('admin.logout') }}" class="btn-logout">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out
      </a>
    </div>
  </aside>

  <!-- Overlay for mobile sidebar -->
  <div id="sidebarOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:99; backdrop-filter: blur(4px); transition: all 0.3s;" onclick="toggleSidebar()"></div>

  <!-- Main Content Wrapper -->
  <main class="admin-main">
    <!-- Topbar -->
    <header class="admin-topbar">
      <div class="topbar-left">
        <i class="fa-solid fa-bars hamburger-menu" onclick="toggleSidebar()"></i>
        <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
      </div>

      <div class="topbar-right">
        <a href="{{ url('/') }}" target="_blank" class="view-site-link">
          Live Website <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:12px;"></i>
        </a>
      </div>
    </header>

    <!-- Content -->
    <div class="admin-content">
      @if(session('success'))
        <div class="admin-alert admin-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="admin-alert admin-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </div>
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('adminSidebar');
      const overlay = document.getElementById('sidebarOverlay');
      sidebar.classList.toggle('show');
      if (sidebar.classList.contains('show')) {
        overlay.style.display = 'block';
      } else {
        overlay.style.display = 'none';
      }
    }

    window.addEventListener('resize', () => {
      if (window.innerWidth > 991) {
        document.getElementById('adminSidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').style.display = 'none';
      }
    });
  </script>
  @yield('scripts')
</body>
</html>

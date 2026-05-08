<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', 'CareerGyan | Explore Careers')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="icon" type="image/png" href="{{ asset('careergyan-tab-logo.png') }}?v=10">
<link rel="shortcut icon" href="{{ asset('careergyan-tab-logo.ico') }}?v=10">
<link rel="apple-touch-icon" href="{{ asset('careergyan-tab-logo.png') }}?v=10">
<style>
  :root {
    --brand: #1a56db;
    --brand-dark: #1341a8;
    --brand-light: #e8f0fe;
    --accent: #f97316;
    --bg: #f8fafc;
    --surface: #ffffff;
    --border: #e2e8f0;
    --text-1: #0f172a;
    --text-2: #475569;
    --text-3: #94a3b8;
    --radius-md: 10px;
    --radius-lg: 16px;
    --radius-xl: 22px;
    --shadow-md: 0 4px 16px rgba(0,0,0,.08);
    --transition: 0.22s ease;
    font-size: 16px;
  }

  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  html {
    scroll-behavior: smooth;
    scroll-padding-top: 100px;
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text-1);
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  main {
    flex: 1;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  ul {
    list-style: none;
  }

  img {
    display: block;
    max-width: 100%;
  }

  button {
    font-family: inherit;
    cursor: pointer;
    border: none;
    background: none;
  }

  .container {
    width: 100%;
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .section {
    padding: 72px 0;
  }

  .section-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--brand);
    background: var(--brand-light);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 14px;
  }

  .section-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(24px,3.5vw,34px);
    font-weight: 800;
    color: var(--text-1);
    line-height: 1.22;
  }

  .section-sub {
    font-size: 16px;
    color: var(--text-2);
    margin-top: 10px;
    max-width: 520px;
  }

  .tag {
    display: inline-block;
    font-size: 11.5px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 999px;
  }

  .badge-green { background: #dcfce7; color: #14532d; }
  .badge-blue { background: var(--brand-light); color: var(--brand-dark); }
  .badge-amber { background: #fef3c7; color: #92400e; }
  .badge-purple { background: #ede9fe; color: #5b21b6; }
  .badge-rose { background: #ffe4e6; color: #9f1239; }
  .badge-teal { background: #ccfbf1; color: #134e4a; }

  /* NAVBAR */
  .navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(255,255,255,.94);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--border);
    transition: box-shadow var(--transition);
  }

  .navbar .container {
    max-width: 100%;
    padding: 0 40px;
  }

  .navbar.scrolled {
    box-shadow: var(--shadow-md);
  }

  .nav-inner {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
  }

  .nav-logo img {
    height: 82px;
    width: auto;
    object-fit: contain;
    transition: .3s ease;
  }

  .nav-logo:hover img {
    transform: scale(1.04);
  }

  .nav-left { flex: 1; display: flex; justify-content: flex-start; }
  .nav-center { display: flex; justify-content: center; white-space: nowrap; }
  .nav-right { flex: 1; display: flex; justify-content: flex-end; align-items: center; gap: 16px; }

  .nav-actions { display: flex; align-items: center; gap: 16px; }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .nav-links a {
    display: flex;
    align-items: center;
    height: 42px;
    padding: 0 16px;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-2);
    border-radius: var(--radius-md);
    transition: background var(--transition), color var(--transition);
  }

  .nav-links a:hover {
    background: var(--bg);
    color: var(--text-1);
  }

  .nav-links a.active {
    background: var(--brand-light);
    color: var(--brand);
  }

  .nav-cta {
    display: flex;
    align-items: center;
    gap: 7px;
    height: 44px;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    background: var(--brand);
    padding: 0 22px;
    border-radius: var(--radius-md);
    transition: background var(--transition), transform var(--transition);
    white-space: nowrap;
  }

  .nav-cta:hover {
    background: var(--brand-dark);
    transform: translateY(-1px);
  }

  .nav-mobile-btn {
    display: none;
    font-size: 22px;
    color: var(--text-1);
    padding: 6px;
  }

  .nav-mobile-menu {
    display: none;
    flex-direction: column;
    gap: 4px;
    padding: 12px 0 18px;
    border-top: 1px solid var(--border);
  }

  .nav-mobile-menu a {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-2);
    padding: 10px 16px;
    border-radius: var(--radius-md);
    display: block;
  }

  .nav-mobile-menu a:hover,
  .nav-mobile-menu a.active {
    background: var(--brand-light);
    color: var(--brand);
  }

  /* FOOTER */
  footer {
    background: var(--text-1);
    color: rgba(255,255,255,.65);
    padding: 38px 0;
    text-align: center;
    font-size: 14px;
  }

  footer strong {
    color: #fff;
  }

  .footer-slogan {
    margin-top: 6px;
    color: #fbbf24;
    font-weight: 700;
    font-size: 14px;
  }

  /* RESPONSIVE */
  @media(max-width: 768px) {
    .nav-inner {
      height: 80px;
    }

    .nav-logo img {
      height: 65px;
    }

    .nav-links,
    .nav-actions {
      display: none;
    }

    .nav-mobile-btn {
      display: block;
    }

    .nav-mobile-menu.open {
      display: flex;
    }
  }

  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-up {
    animation: fadeUp .5s ease forwards;
  }

  .fade-up-1 { animation-delay: .1s; opacity: 0; }
  .fade-up-2 { animation-delay: .22s; opacity: 0; }
  .fade-up-3 { animation-delay: .34s; opacity: 0; }

  /* SEARCH MODAL */
  .search-overlay {
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(10px);
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 80px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }

  .search-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }

  .search-container {
    background: var(--surface);
    width: 100%;
    max-width: 600px;
    border-radius: var(--radius-xl);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    transform: translateY(-20px);
    transition: transform 0.3s ease;
    border: 1px solid var(--border);
  }

  .search-overlay.active .search-container {
    transform: translateY(0);
  }

  .search-header {
    display: flex;
    align-items: center;
    padding: 16px 24px;
    border-bottom: 1px solid var(--border);
  }

  .search-input {
    flex-grow: 1;
    border: none;
    outline: none;
    font-size: 18px;
    font-family: inherit;
    color: var(--text-1);
    background: transparent;
  }

  .search-close {
    background: rgba(15, 23, 42, 0.05);
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--text-2);
    transition: all 0.2s;
  }

  .search-close:hover {
    background: rgba(15, 23, 42, 0.1);
    color: var(--text-1);
  }

  .search-results {
    max-height: 60vh;
    overflow-y: auto;
    padding: 20px 24px;
  }

  .search-section-title {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 12px;
    margin-top: 20px;
  }

  .search-section-title:first-child { margin-top: 0; }

  .search-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 12px;
    border-radius: var(--radius-md);
    text-decoration: none;
    color: inherit;
    transition: background 0.2s;
    margin-bottom: 8px;
    border: 1px solid transparent;
  }

  .search-item:hover {
    background: var(--bg);
    border-color: var(--border);
  }

  .search-item-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
  }

  .search-item-content h4 {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    color: var(--text-1);
    margin-bottom: 4px;
  }

  .search-item-content p {
    font-size: 13px;
    color: var(--text-2);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .search-item-badge {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 10px;
    margin-top: 4px;
  }

  .search-empty {
    text-align: center;
    padding: 40px 0;
    color: var(--text-3);
    font-size: 15px;
  }
</style>

@yield('styles')
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">

      <div class="nav-left">
        <a href="{{ url('/') }}" class="nav-logo">
          <img src="{{ asset('images/logo.png') }}" alt="CareerGyan Logo">
        </a>
      </div>

      <div class="nav-center">
        <ul class="nav-links">
          <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ url('/explore') }}" class="{{ request()->is('explore') ? 'active' : '' }}">Explore Careers</a></li>
          <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
        </ul>
      </div>

      <div class="nav-right">
        <div class="nav-actions">
          <button id="openGlobalSearch" style="font-size: 15px; display: flex; align-items: center; justify-content: space-between; width: 220px; height: 40px; border-radius: 30px; background: #fff; border: 1px solid var(--border); box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08); padding: 0 16px; transition: all 0.3s; cursor: pointer;" aria-label="Search">
            <span style="color: var(--text-3); font-style: italic;">Search...</span>
            <i class="fa-solid fa-search" style="font-size: 16px; color: var(--text-1);"></i>
          </button>
          @auth
            <a href="{{ route('quick-test.start') }}" class="nav-cta" style="background: var(--surface); color: var(--text-1); border: 1px solid var(--border);">
              <i class="fa-solid fa-gauge-high" style="color: var(--brand);"></i> Quick Test
            </a>
            <a href="{{ route('test.start') }}" class="nav-cta">
              <i class="fa-solid fa-bolt"></i> Advance Test
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
              @csrf
              <button type="submit" class="nav-cta" style="background: #fee2e2; color: #b91c1c; padding: 0 16px;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="nav-cta" style="background: transparent; color: var(--text-2); padding: 0 10px;">
              Sign In
            </a>
            <a href="{{ route('signup') }}" class="nav-cta">
              Sign Up
            </a>
          @endauth
        </div>
        <button class="nav-mobile-btn" id="mobileBtn" aria-label="Menu">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

    </div>

    <ul class="nav-mobile-menu" id="mobileMenu">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ url('/explore') }}" class="{{ request()->is('explore') ? 'active' : '' }}">Explore Careers</a></li>
      <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
      <li>
        <a href="{{ route('quick-test.start') }}" style="color:var(--brand);font-weight:700;">
          <i class="fa-solid fa-gauge-high"></i> Quick Test
        </a>
      </li>
      <li>
        <a href="{{ route('test.start') }}" style="color:var(--brand);font-weight:700;">
          <i class="fa-solid fa-bolt"></i> Advance Test
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- GLOBAL SEARCH MODAL -->
<div class="search-overlay" id="globalSearchOverlay">
  <div class="search-container" onclick="event.stopPropagation()">
    <div class="search-header">
      <i class="fa-solid fa-search" style="color: var(--text-3); margin-right: 12px; font-size: 18px;"></i>
      <input type="text" id="globalSearchInput" class="search-input" placeholder="Search for careers, streams, subjects..." autocomplete="off">
      <button class="search-close" id="closeGlobalSearch"><i class="fa-solid fa-times"></i></button>
    </div>
    <div class="search-results" id="globalSearchResults">
      <div class="search-empty">
        <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; color: var(--border); margin-bottom: 16px;"></i>
        <p>Type to start exploring amazing careers...</p>
      </div>
    </div>
  </div>
</div>

<!-- PAGE CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div style="margin-bottom: 12px;">
      <h3 style="color:#fff; font-family:'Sora', sans-serif; margin-bottom:4px;">
        Indian Institute of Career Management
      </h3>
      <p style="font-size:13px; color:rgba(255,255,255,.55);">
        Powering the CareerGyan Application
      </p>
      <p class="footer-slogan">
        ज्ञानात् ज्ञानं ततः सिद्धिः
      </p>
    </div>

    <p>
      © 2026 <strong>CareerGyan</strong> · Helping students make better career decisions
    </p>

    <p style="margin-top:8px;font-size:12.5px;">
      <a href="{{ url('/about') }}" style="color:rgba(255,255,255,.55);margin:0 10px;">About & Contact</a>
      <a href="#" style="color:rgba(255,255,255,.55);margin:0 10px;">Privacy Policy</a>
      <a href="#" style="color:rgba(255,255,255,.55);margin:0 10px;">Terms of Use</a>
    </p>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  const navbar = document.getElementById('navbar');

  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  });

  const mobileBtn = document.getElementById('mobileBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  mobileBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');

    const icon = mobileBtn.querySelector('i');
    icon.className = mobileMenu.classList.contains('open')
      ? 'fa-solid fa-xmark'
      : 'fa-solid fa-bars';
  });

  // Global Search Logic
  const searchOverlay = document.getElementById('globalSearchOverlay');
  const openSearchBtn = document.getElementById('openGlobalSearch');
  const closeSearchBtn = document.getElementById('closeGlobalSearch');
  const searchInput = document.getElementById('globalSearchInput');
  const searchResults = document.getElementById('globalSearchResults');

  function openSearch() {
    searchOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => searchInput.focus(), 100);
  }

  function closeSearch() {
    searchOverlay.classList.remove('active');
    document.body.style.overflow = 'auto';
  }

  openSearchBtn?.addEventListener('click', openSearch);
  closeSearchBtn?.addEventListener('click', closeSearch);
  searchOverlay.addEventListener('click', closeSearch);

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
      closeSearch();
    }
  });

  // Debounce helper
  function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
  }

  const performSearch = debounce(() => {
    const query = searchInput.value.trim();
    
    if (query.length < 2) {
      searchResults.innerHTML = `
        <div class="search-empty">
          <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; color: var(--border); margin-bottom: 16px;"></i>
          <p>Type to start exploring amazing careers...</p>
        </div>
      `;
      return;
    }

    searchResults.innerHTML = `<div style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin" style="color:var(--brand); font-size:24px;"></i></div>`;

    fetch(`/global-search?q=${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        let html = '';
        
        if (data.config_careers.length === 0 && data.db_careers.length === 0) {
          searchResults.innerHTML = `
            <div class="search-empty">
              <i class="fa-solid fa-folder-open" style="font-size: 32px; color: var(--border); margin-bottom: 16px;"></i>
              <p>No results found for "${query}"</p>
            </div>
          `;
          return;
        }

        // Render Config Careers (Detailed Paths)
        if (data.config_careers.length > 0) {
          html += `<div class="search-section-title">Comprehensive Career Paths</div>`;
          data.config_careers.forEach(c => {
            let badgeHtml = c.matched_career ? `<span class="search-item-badge" style="background: rgba(255,255,255,0.2); color:#1e293b; border: 1px solid #cbd5e1;">Includes: ${c.matched_career}</span>` : '';
            html += `
              <a href="/career-path/${c.stream}" class="search-item" onclick="closeSearch()">
                <div class="search-item-icon" style="background: ${c.bg_color}; color: #fff;">
                  <i class="fa-solid ${c.icon}"></i>
                </div>
                <div class="search-item-content">
                  <h4>${c.subject_name}</h4>
                  <p>Found in <strong>${c.stream_title}</strong></p>
                  ${badgeHtml}
                </div>
              </a>
            `;
          });
        }

        // Render Database Careers
        if (data.db_careers.length > 0) {
          html += `<div class="search-section-title">Database Careers</div>`;
          data.db_careers.forEach(c => {
            html += `
              <a href="/explore?q=${encodeURIComponent(c.name)}" class="search-item" onclick="closeSearch()">
                <div class="search-item-icon" style="background: ${c.bg_color}; color: ${c.color};">
                  <i class="fa-solid ${c.icon}"></i>
                </div>
                <div class="search-item-content">
                  <h4>${c.name}</h4>
                  <p>${c.description}</p>
                  <span class="search-item-badge" style="background: ${c.bg_color}; color: ${c.color};">${c.field}</span>
                </div>
              </a>
            `;
          });
        }

        searchResults.innerHTML = html;
      })
      .catch(err => {
        console.error(err);
        searchResults.innerHTML = `<div class="search-empty">An error occurred while searching.</div>`;
      });
  });
  

  searchInput.addEventListener('input', performSearch);
</script>

@yield('scripts')

</body>
</html>
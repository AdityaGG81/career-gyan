<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', 'CareerGyan | Explore Careers')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<!-- Select2 / Tagify for explore page -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
  /* ─── CSS Variables ─── */
  :root {
    --brand:       #1a56db;
    --brand-dark:  #1341a8;
    --brand-light: #e8f0fe;
    --accent:      #f97316;
    --accent-light:#fff4ed;
    --bg:          #f8fafc;
    --surface:     #ffffff;
    --border:      #e2e8f0;
    --text-1:      #0f172a;
    --text-2:      #475569;
    --text-3:      #94a3b8;
    --green:       #16a34a;
    --green-light: #dcfce7;
    --purple:      #7c3aed;
    --purple-light:#ede9fe;
    --teal:        #0d9488;
    --teal-light:  #ccfbf1;
    --rose:        #e11d48;
    --rose-light:  #ffe4e6;
    --amber:       #d97706;
    --amber-light: #fef3c7;
    --radius-sm:   6px;
    --radius-md:   10px;
    --radius-lg:   16px;
    --radius-xl:   22px;
    --shadow-sm:   0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md:   0 4px 16px rgba(0,0,0,.08);
    --shadow-lg:   0 8px 32px rgba(0,0,0,.10);
    --transition:  0.22s ease;
    font-size: 16px;
  }

  /* ─── Reset ─── */
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text-1);
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
  }
  a { text-decoration: none; color: inherit; }
  ul { list-style: none; }
  img { display: block; max-width: 100%; }
  button { font-family: inherit; cursor: pointer; border: none; background: none; }

  /* ─── Utility ─── */
  .container { width: 100%; max-width: 1160px; margin: 0 auto; padding: 0 24px; }
  .section { padding: 72px 0; }
  .section-label {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 12px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;
    color: var(--brand); background: var(--brand-light);
    padding: 5px 14px; border-radius: 999px; margin-bottom: 14px;
  }
  .section-title { font-family: 'Sora', sans-serif; font-size: clamp(24px,3.5vw,34px); font-weight: 700; color: var(--text-1); line-height: 1.22; }
  .section-sub { font-size: 16px; color: var(--text-2); margin-top: 10px; max-width: 520px; }
  .tag {
    display: inline-block; font-size: 11.5px; font-weight: 500;
    padding: 3px 10px; border-radius: 999px; letter-spacing: .02em;
  }
  .badge-green  { background: var(--green-light);  color: #14532d; }
  .badge-blue   { background: var(--brand-light);  color: var(--brand-dark); }
  .badge-amber  { background: var(--amber-light);  color: #92400e; }
  .badge-purple { background: var(--purple-light); color: #5b21b6; }
  .badge-rose   { background: var(--rose-light);   color: #9f1239; }
  .badge-teal   { background: var(--teal-light);   color: #134e4a; }

  /* ─── Navbar ─── */
  .navbar {
    position: sticky; top: 0; z-index: 100;
    background: rgba(255,255,255,.92); backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
    transition: box-shadow var(--transition);
  }
  .navbar.scrolled { box-shadow: var(--shadow-md); }
  .nav-inner {
    display: flex; align-items: center; justify-content: space-between;
    height: 90px;
  }
  .nav-logo {
    font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700;
    color: var(--brand); display: flex; align-items: center; gap: 8px;
  }
  .nav-logo span { color: var(--text-1); }
  .logo-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); display: inline-block; }
  .nav-links { display: flex; align-items: center; gap: 6px; }
  .nav-links a {
    font-size: 14.5px; font-weight: 500; color: var(--text-2);
    padding: 7px 15px; border-radius: var(--radius-md);
    transition: background var(--transition), color var(--transition);
  }
  .nav-links a:hover { background: var(--bg); color: var(--text-1); }
  .nav-links a.active {
    background: var(--brand-light); color: var(--brand);
  }
  .nav-cta {
    font-size: 14px; font-weight: 600; color: #fff;
    background: var(--brand); padding: 9px 20px;
    border-radius: var(--radius-md);
    transition: background var(--transition), transform var(--transition);
  }
  .nav-cta:hover { background: var(--brand-dark); transform: translateY(-1px); }
  .nav-mobile-btn { display: none; font-size: 20px; color: var(--text-1); padding: 6px; }
  .nav-mobile-menu {
    display: none; flex-direction: column; gap: 4px;
    padding: 12px 0 18px; border-top: 1px solid var(--border);
  }
  .nav-mobile-menu a {
    font-size: 15px; font-weight: 500; color: var(--text-2);
    padding: 10px 16px; border-radius: var(--radius-md);
    transition: background var(--transition);
  }
  .nav-mobile-menu a:hover, .nav-mobile-menu a.active { background: var(--brand-light); color: var(--brand); }

  /* ─── Footer ─── */
  footer {
    background: var(--text-1); color: rgba(255,255,255,.6);
    padding: 36px 0; text-align: center; font-size: 14px;
  }
  footer strong { color: #fff; }

  /* ─── Responsive ─── */
  @media(max-width: 768px) {
    .nav-links, .nav-cta { display: none; }
    .nav-mobile-btn { display: block; }
    .nav-mobile-menu.open { display: flex; }
  }
  
  /* ─── Animations ─── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .fade-up { animation: fadeUp .5s ease forwards; }
  .fade-up-1 { animation-delay: .1s; opacity: 0; }
  .fade-up-2 { animation-delay: .22s; opacity: 0; }
  .fade-up-3 { animation-delay: .34s; opacity: 0; }

</style>
  <!-- Page Specific Styles passed via yield -->
  @yield('styles')
</head>
<body>

<!-- ═══════════════════════════════════════
     NAVBAR
═══════════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <a href="{{ url('/') }}" class="nav-logo">
        <img src="{{ asset('images/logo.png') }}" alt="CareerGyan Logo" style="height: 76px; width: auto; object-fit: contain;">
      </a>

      <ul class="nav-links">
        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/explore') }}" class="{{ request()->is('explore') ? 'active' : '' }}">Explore Careers</a></li>
        <li><a href="{{ route('test.start') }}" class="{{ request()->is('test*') ? 'active' : '' }}">Take Test</a></li>
        <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
      </ul>

      <a href="{{ route('test.start') }}" class="nav-cta"><i class="fa-solid fa-bolt"></i> Take Free Test</a>
      <button class="nav-mobile-btn" id="mobileBtn" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
    </div>

    <ul class="nav-mobile-menu" id="mobileMenu">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ url('/explore') }}" class="{{ request()->is('explore') ? 'active' : '' }}">Explore Careers</a></li>
      <li><a href="{{ route('test.start') }}" class="{{ request()->is('test*') ? 'active' : '' }}">Take Test</a></li>
      <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
      <li><a href="{{ route('test.start') }}" style="color:var(--brand);font-weight:600;"><i class="fa-solid fa-bolt"></i> Take Free Test</a></li>
    </ul>
  </div>
</nav>

<!-- Page Content -->
@yield('content')

<!-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ -->
<footer>
  <div class="container">
    <div style="margin-bottom: 12px;">
      <h3 style="color:#fff; font-family:'Sora'; margin-bottom:4px;">Indian Institute of Career Management</h3>
      <p style="font-size:13px; color:rgba(255,255,255,.5);">Powering the CareerGyan Application</p>
    </div>
    <p>© 2026 <strong>CareerGyan</strong> &nbsp;·&nbsp; Helping students make better career decisions</p>
    <p style="margin-top:8px;font-size:12.5px;">
      <a href="{{ url('/about') }}" style="color:rgba(255,255,255,.5);margin:0 10px;">About & Contact</a>
      <a href="#" style="color:rgba(255,255,255,.5);margin:0 10px;">Privacy Policy</a>
      <a href="#" style="color:rgba(255,255,255,.5);margin:0 10px;">Terms of Use</a>
    </p>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  // Sticky navbar shadow on scroll
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  });

  // Mobile menu toggle
  const mobileBtn = document.getElementById('mobileBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  mobileBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    const icon = mobileBtn.querySelector('i');
    icon.className = mobileMenu.classList.contains('open') ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
  });
</script>

<!-- Additional Scripts -->
@yield('scripts')

</body>
</html>

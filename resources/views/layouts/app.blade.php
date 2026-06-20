<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    --shadow-sm: 0 2px 8px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08);
    --shadow-lg: 0 8px 30px rgba(0,0,0,.12);
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
    scroll-padding-top: 90px;
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
    overflow-x: hidden;
  }

  /* Custom selection */
  ::selection {
    background: rgba(26, 86, 219, 0.15);
    color: var(--brand-dark);
  }

  /* Custom scrollbar */
  ::-webkit-scrollbar { width: 8px; }
  ::-webkit-scrollbar-track { background: var(--bg); }
  ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
  ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

  main { flex: 1; }

  a { text-decoration: none; color: inherit; }
  ul { list-style: none; }
  img { display: block; max-width: 100%; }

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

  .section { padding: 72px 0; }

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

  /* ═══════════════════════════════════════════
     LIQUID GLASS NAVBAR
     ═══════════════════════════════════════════ */
  .navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    padding: 10px 0;
    transition: all 0.4s cubic-bezier(.22,.68,0,1);
  }

  .navbar-glass {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 32px;
    background: rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.65);
    border-radius: 999px;
    box-shadow:
      0 4px 24px rgba(0, 0, 0, 0.06),
      0 1px 3px rgba(0, 0, 0, 0.04),
      inset 0 1px 0 rgba(255, 255, 255, 0.9);
    transition: all 0.4s cubic-bezier(.22,.68,0,1);
  }

  .navbar.scrolled .navbar-glass {
    background: rgba(255, 255, 255, 0.88);
    box-shadow:
      0 8px 32px rgba(0, 0, 0, 0.10),
      0 2px 6px rgba(0, 0, 0, 0.06),
      inset 0 1px 0 rgba(255, 255, 255, 0.95);
    border-color: rgba(226, 232, 240, 0.6);
  }

  .nav-inner {
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    flex-shrink: 0;
  }

  .nav-logo img {
    height: 48px;
    width: auto;
    object-fit: contain;
    transition: .3s ease;
  }

  .nav-logo:hover img { transform: scale(1.04); }

  .nav-left { display: flex; align-items: center; }
  .nav-center { display: flex; justify-content: center; flex: 1; }
  .nav-right { display: flex; align-items: center; gap: 8px; }

  /* Nav links with sliding pill indicator */
  .nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
    position: relative;
    background: rgba(241, 245, 249, 0.6);
    padding: 4px;
    border-radius: 999px;
  }

  .nav-links a {
    display: flex;
    align-items: center;
    height: 36px;
    padding: 0 18px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-2);
    border-radius: 999px;
    transition: all 0.3s cubic-bezier(.22,.68,0,1);
    white-space: nowrap;
    position: relative;
    z-index: 1;
  }

  .nav-links a:hover {
    color: var(--text-1);
  }

  .nav-links a.active {
    color: var(--brand);
    background: var(--surface);
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
  }

  /* Nav action buttons */
  .nav-actions { display: flex; align-items: center; gap: 6px; }

  .nav-search-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(241, 245, 249, 0.8);
    border: 1px solid rgba(226, 232, 240, 0.5);
    color: var(--text-2);
    font-size: 14px;
    transition: all 0.2s;
    cursor: pointer;
  }

  .nav-search-btn:hover {
    background: var(--brand-light);
    color: var(--brand);
    border-color: transparent;
  }

  .nav-link-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-2);
    padding: 0 12px;
    height: 36px;
    border-radius: 999px;
    transition: all 0.2s;
    white-space: nowrap;
  }

  .nav-link-btn:hover {
    background: rgba(241, 245, 249, 0.8);
    color: var(--text-1);
  }

  .nav-link-btn i { font-size: 12px; }

  .nav-divider {
    width: 1px;
    height: 20px;
    background: var(--border);
    margin: 0 4px;
  }

  .nav-cta {
    display: flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
    padding: 0 18px;
    border-radius: 999px;
    transition: all 0.3s cubic-bezier(.22,.68,0,1);
    white-space: nowrap;
    box-shadow: 0 2px 10px rgba(29, 78, 216, 0.25);
  }

  .nav-cta:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(29, 78, 216, 0.35);
  }

  .nav-cta-outline {
    display: flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    font-size: 13px;
    font-weight: 700;
    color: var(--brand);
    background: var(--brand-light);
    padding: 0 18px;
    border-radius: 999px;
    transition: all 0.2s;
    white-space: nowrap;
  }

  .nav-cta-outline:hover {
    background: var(--brand);
    color: #fff;
  }

  /* Mobile Nav */
  .nav-mobile-btn,
  .nav-mobile-search {
    display: none;
    font-size: 20px;
    color: var(--text-1);
    padding: 8px;
    background: none;
    border: none;
    cursor: pointer;
  }

  .nav-mobile-menu {
    display: none;
    flex-direction: column;
    gap: 2px;
    padding: 12px 16px 16px;
    margin: 0 12px;
    border-top: 1px solid var(--border);
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border-radius: 0 0 24px 24px;
  }

  .nav-mobile-menu a {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-2);
    padding: 12px 16px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .nav-mobile-menu a:hover,
  .nav-mobile-menu a.active {
    background: var(--brand-light);
    color: var(--brand);
  }

  .nav-mobile-menu .mobile-auth {
    display: flex;
    gap: 8px;
    margin-top: 8px;
    padding-top: 12px;
    border-top: 1px solid var(--border);
  }

  .nav-mobile-menu .mobile-auth a {
    flex: 1;
    justify-content: center;
    padding: 10px 16px;
    border-radius: 999px;
    font-size: 14px;
  }

  /* ═══════════════════════════════════════════
     FLOATING DOODLE SYSTEM
     ═══════════════════════════════════════════ */
  .doodle-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
    opacity: 0.12;
  }

  .doodle {
    position: absolute;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
    animation-direction: alternate;
  }

  .doodle svg {
    width: 100%;
    height: 100%;
    fill: none;
    stroke: var(--brand);
    stroke-width: 1.5;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .doodle-1 { top: 8%; left: 5%; width: 40px; height: 40px; animation: dFloat1 8s ease-in-out infinite alternate; }
  .doodle-2 { top: 25%; right: 8%; width: 35px; height: 35px; animation: dFloat2 10s ease-in-out infinite alternate; }
  .doodle-3 { top: 55%; left: 3%; width: 32px; height: 32px; animation: dFloat3 9s ease-in-out infinite alternate; }
  .doodle-4 { top: 70%; right: 5%; width: 38px; height: 38px; animation: dFloat1 11s ease-in-out infinite alternate-reverse; }
  .doodle-5 { top: 40%; left: 92%; width: 30px; height: 30px; animation: dFloat2 7s ease-in-out infinite alternate; }
  .doodle-6 { top: 85%; left: 15%; width: 28px; height: 28px; animation: dFloat3 12s ease-in-out infinite alternate-reverse; }
  .doodle-7 { top: 15%; left: 45%; width: 25px; height: 25px; animation: dFloat1 9s ease-in-out infinite alternate; }
  .doodle-8 { top: 60%; left: 50%; width: 33px; height: 33px; animation: dFloat2 8s ease-in-out infinite alternate-reverse; }

  @keyframes dFloat1 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(15px, -20px) rotate(15deg); }
  }
  @keyframes dFloat2 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(-10px, 18px) rotate(-12deg); }
  }
  @keyframes dFloat3 {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(12px, 15px) rotate(10deg); }
  }

  /* ═══════════════════════════════════════════
     SCROLL REVEAL ANIMATIONS
     ═══════════════════════════════════════════ */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .fade-up { animation: fadeUp .5s ease forwards; }
  .fade-up-1 { animation-delay: .1s; opacity: 0; }
  .fade-up-2 { animation-delay: .22s; opacity: 0; }
  .fade-up-3 { animation-delay: .34s; opacity: 0; }

  .reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.7s cubic-bezier(.22,.68,0,1), transform 0.7s cubic-bezier(.22,.68,0,1);
  }

  .reveal.visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ═══════════════════════════════════════════
     SEARCH MODAL
     ═══════════════════════════════════════════ */
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

  .search-overlay.active { opacity: 1; pointer-events: auto; }

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

  .search-overlay.active .search-container { transform: translateY(0); }

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

  /* ═══════════════════════════════════════════
     FOOTER — Multi-Column
     ═══════════════════════════════════════════ */
  .site-footer {
    background: linear-gradient(180deg, #0f172a 0%, #0c1322 100%);
    color: rgba(255,255,255,.65);
    padding: 0;
    position: relative;
    overflow: hidden;
  }

  .footer-top-wave {
    height: 60px;
    background: var(--bg);
    position: relative;
  }

  .footer-top-wave::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 60px;
    background: linear-gradient(180deg, #0f172a 0%, #0c1322 100%);
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
  }

  .footer-doodle {
    position: absolute;
    opacity: 0.04;
    pointer-events: none;
  }

  .footer-doodle svg {
    fill: none;
    stroke: #fff;
    stroke-width: 1.5;
  }

  .footer-main {
    padding: 48px 0 32px;
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.2fr;
    gap: 48px;
    margin-bottom: 40px;
  }

  .footer-brand h3 {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 4px;
  }

  .footer-brand .footer-org {
    font-size: 12px;
    color: rgba(255,255,255,.4);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 14px;
  }

  .footer-brand p {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 16px;
  }

  .footer-slogan {
    color: #fbbf24;
    font-weight: 700;
    font-size: 14px;
    font-style: italic;
    margin-bottom: 4px;
  }

  .footer-slogan-meaning {
    font-size: 11px;
    color: rgba(255,255,255,.35);
  }

  .footer-social {
    display: flex;
    gap: 10px;
    margin-top: 18px;
  }

  .footer-social a {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: rgba(255,255,255,.6);
    transition: all 0.3s ease;
  }

  .footer-social a:hover {
    background: var(--brand);
    border-color: var(--brand);
    color: #fff;
    transform: translateY(-2px);
  }

  .footer-col h4 {
    font-family: 'Sora', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 18px;
  }

  .footer-col a {
    display: block;
    font-size: 14px;
    color: rgba(255,255,255,.55);
    padding: 5px 0;
    transition: all 0.2s;
  }

  .footer-col a:hover {
    color: #fff;
    padding-left: 6px;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255,255,255,.08);
    padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
  }

  .footer-bottom a {
    color: rgba(255,255,255,.45);
    margin-left: 20px;
    transition: color 0.2s;
  }

  .footer-bottom a:hover { color: #fff; }

  /* ═══════════════════════════════════════════
     RESPONSIVE
     ═══════════════════════════════════════════ */
  @media(max-width: 768px) {
    .navbar { padding: 6px 8px; }

    .navbar-glass {
      padding: 0 16px;
      border-radius: 20px;
      margin: 0 8px;
    }

    .nav-inner { height: 56px; }
    .nav-logo img { height: 38px; }

    .nav-center,
    .nav-actions { display: none; }

    .nav-mobile-btn,
    .nav-mobile-search { display: block; }

    .nav-mobile-menu.open { display: flex; }

    .doodle-container { opacity: 0.06; }

    .footer-grid {
      grid-template-columns: 1fr;
      gap: 32px;
    }

    .footer-bottom {
      flex-direction: column;
      gap: 12px;
      text-align: center;
    }

    .footer-bottom a { margin-left: 10px; }

    /* Search overlay fullscreen on mobile */
    .search-overlay {
      padding-top: 0;
    }

    .search-container {
      max-width: 100%;
      width: 100%;
      height: 100%;
      border-radius: 0;
      border: none;
      display: flex;
      flex-direction: column;
    }

    .search-results {
      flex: 1;
      overflow-y: auto;
    }
  }

  @media(max-width: 480px) {
    .container {
      padding: 0 16px;
    }

    .section {
      padding: 48px 0;
    }

    .navbar-glass {
      padding: 0 12px;
      margin: 0 4px;
    }

    .nav-logo img { height: 32px; }
  }

  /* Profile Dropdown Styling */
  .user-dropdown-menu .dropdown-item:hover {
    background-color: #f1f5f9;
    color: var(--text-1) !important;
  }
  @keyframes dropdownFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

@yield('styles')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5044851395641771"
     crossorigin="anonymous"></script>
</head>

<body>

<!-- FLOATING DOODLES -->
<div class="doodle-container" aria-hidden="true">
  <!-- Pencil -->
  <div class="doodle doodle-1">
    <svg viewBox="0 0 40 40"><path d="M8 32L28 12l4 4L12 36H8v-4z"/><path d="M24 16l4 4"/><path d="M28 12l2-2 4 4-2 2"/></svg>
  </div>
  <!-- Book -->
  <div class="doodle doodle-2">
    <svg viewBox="0 0 40 40"><path d="M6 8c4-2 8-1 14 2 6-3 10-4 14-2v24c-4-1-8 0-14 2-6-2-10-3-14-2V8z"/><path d="M20 10v24"/></svg>
  </div>
  <!-- Graduation Cap -->
  <div class="doodle doodle-3">
    <svg viewBox="0 0 40 40"><path d="M4 18l16-8 16 8-16 8z"/><path d="M10 22v8c0 0 4 4 10 4s10-4 10-4v-8"/><path d="M36 18v10"/></svg>
  </div>
  <!-- Star -->
  <div class="doodle doodle-4">
    <svg viewBox="0 0 40 40"><path d="M20 4l4 12h12l-10 7 4 13-10-8-10 8 4-13L4 16h12z"/></svg>
  </div>
  <!-- Lightbulb -->
  <div class="doodle doodle-5">
    <svg viewBox="0 0 40 40"><path d="M20 4a10 10 0 00-6 18v4h12v-4A10 10 0 0020 4z"/><path d="M16 30h8"/><path d="M16 34h8"/><path d="M20 4v-2"/></svg>
  </div>
  <!-- Rocket -->
  <div class="doodle doodle-6">
    <svg viewBox="0 0 40 40"><path d="M20 4c-4 6-6 14-6 20h12c0-6-2-14-6-20z"/><path d="M14 24c-4 0-6 4-6 4l6 2"/><path d="M26 24c4 0 6 4 6 4l-6 2"/><circle cx="20" cy="18" r="3"/></svg>
  </div>
  <!-- Compass -->
  <div class="doodle doodle-7">
    <svg viewBox="0 0 40 40"><circle cx="20" cy="20" r="14"/><path d="M14 26l4-10 10-4-4 10z"/></svg>
  </div>
  <!-- Atom -->
  <div class="doodle doodle-8">
    <svg viewBox="0 0 40 40"><ellipse cx="20" cy="20" rx="16" ry="6" transform="rotate(30 20 20)"/><ellipse cx="20" cy="20" rx="16" ry="6" transform="rotate(-30 20 20)"/><ellipse cx="20" cy="20" rx="16" ry="6"/><circle cx="20" cy="20" r="2"/></svg>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="navbar-glass">
    <div class="nav-inner">

      <div class="nav-left">
        <a href="{{ url('/') }}" class="nav-logo">
          <img src="{{ asset('images/logo.png') }}" alt="CareerGyan Logo">
        </a>
      </div>

      <div class="nav-center">
        <div class="nav-links">
          <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
          <a href="{{ url('/explore') }}" class="{{ request()->is('explore*') ? 'active' : '' }}">Explore</a>
          <a href="{{ route('daily-quiz.index') }}" class="{{ request()->is('daily-quiz*') ? 'active' : '' }}">Daily Quiz 🔥</a>
          <a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">Blog</a>
          <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
        </div>
      </div>

      <div class="nav-right">
        <div class="nav-actions">
          <button class="nav-search-btn" id="openGlobalSearch" aria-label="Search">
            <i class="fa-solid fa-search"></i>
          </button>

          <a href="{{ route('quick-test.start') }}" class="nav-link-btn">
            <i class="fa-solid fa-gauge-high" style="color: var(--brand);"></i> Quick Test
          </a>

          @auth
            <a href="{{ route('test.start') }}" class="nav-cta">
              <i class="fa-solid fa-bolt" style="color: #fbbf24;"></i> Advance Test
            </a>
            <div class="nav-divider"></div>
            <!-- User Dropdown Menu -->
            <div class="user-dropdown" style="position: relative;">
              <button type="button" onclick="toggleDropdown(event)" style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; border: 2px solid var(--brand); padding: 0; cursor: pointer; overflow: hidden; background: none; transition: border-color var(--transition);">
                <img src="{{ Auth::user()->profile_photo ? (str_starts_with(Auth::user()->profile_photo, 'http') || str_starts_with(Auth::user()->profile_photo, 'uploads/') ? asset(Auth::user()->profile_photo) : asset(Auth::user()->profile_photo)) : 'https://api.dicebear.com/7.x/adventurer/svg?seed=Felix' }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
              </button>
              <div class="user-dropdown-menu" id="userDropdownMenu" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; background: #ffffff; min-width: 180px; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 10px 25px rgba(0,0,0,0.08); overflow: hidden; z-index: 1000; animation: dropdownFadeIn 0.2s ease;">
                <div style="padding: 12px 16px; border-bottom: 1px solid var(--border); background: #f8fafc;">
                  <div style="font-weight: 700; font-size: 14px; color: var(--text-1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align: left;">{{ Auth::user()->name }}</div>
                  <div style="font-size: 11px; color: var(--text-3); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align: left;">{{ Auth::user()->email }}</div>
                </div>
                <a href="{{ route('profile') }}" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; font-size: 14px; font-weight: 600; color: var(--text-2); transition: 0.2s;" class="dropdown-item">
                  <i class="fa-solid fa-user-circle" style="color: var(--brand);"></i> View Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: block;">
                  @csrf
                  <button type="submit" style="display: flex; align-items: center; gap: 8px; width: 100%; text-align: left; padding: 12px 16px; font-size: 14px; font-weight: 600; color: #b91c1c; background: none; border: none; cursor: pointer; transition: 0.2s;" class="dropdown-item">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                  </button>
                </form>
              </div>
            </div>
          @else
            <div class="nav-divider"></div>
            <a href="{{ route('login') }}" class="nav-link-btn">Sign In</a>
            <a href="{{ route('signup') }}" class="nav-cta">Sign Up</a>
          @endauth
        </div>

        <button class="nav-mobile-search" id="openGlobalSearchMobile" aria-label="Search">
          <i class="fa-solid fa-search"></i>
        </button>
        <button class="nav-mobile-btn" id="mobileBtn" aria-label="Menu">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

    </div>
  </div>

  <div class="nav-mobile-menu" id="mobileMenu">
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
      <i class="fa-solid fa-house"></i> Home
    </a>
    <a href="{{ url('/explore') }}" class="{{ request()->is('explore*') ? 'active' : '' }}">
      <i class="fa-solid fa-compass"></i> Explore Careers
    </a>
    <a href="{{ route('daily-quiz.index') }}" class="{{ request()->is('daily-quiz*') ? 'active' : '' }}">
      <i class="fa-solid fa-fire" style="color: #fbbf24;"></i> Daily Quiz
    </a>
    <a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">
      <i class="fa-solid fa-newspaper"></i> Blog
    </a>
    <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">
      <i class="fa-solid fa-info-circle"></i> About
    </a>
    <a href="{{ route('quick-test.start') }}" style="color:var(--brand);font-weight:700;">
      <i class="fa-solid fa-gauge-high"></i> Quick Test
    </a>
    <a href="{{ route('test.start') }}" style="color:var(--brand);font-weight:700;">
      <i class="fa-solid fa-bolt"></i> Advance Test
    </a>
    @auth
    <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
      <i class="fa-solid fa-user"></i> My Profile
    </a>
    @endauth
    <div class="mobile-auth">
      @auth
        <form action="{{ route('logout') }}" method="POST" style="flex:1;">
          @csrf
          <button type="submit" style="width:100%;background:#fef2f2;color:#b91c1c;padding:10px;border-radius:999px;font-weight:700;font-size:14px;border:none;cursor:pointer;">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" style="background:var(--bg);color:var(--text-1);border:1px solid var(--border);">Sign In</a>
        <a href="{{ route('signup') }}" style="background:var(--brand);color:#fff;">Sign Up</a>
      @endauth
    </div>
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
<footer class="site-footer">
  <div class="footer-top-wave"></div>

  <!-- Footer doodle decorations -->
  <div class="footer-doodle" style="top:20%;left:5%;width:60px;height:60px;">
    <svg viewBox="0 0 40 40"><path d="M8 32L28 12l4 4L12 36H8v-4z"/></svg>
  </div>
  <div class="footer-doodle" style="bottom:15%;right:8%;width:50px;height:50px;">
    <svg viewBox="0 0 40 40"><path d="M4 18l16-8 16 8-16 8z"/><path d="M10 22v8c0 0 4 4 10 4s10-4 10-4v-8"/></svg>
  </div>

  <div class="footer-main">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h3>CareerGyan</h3>
          <div class="footer-org">Indian Institute of Career Management</div>
          <p>Empowering students to make data-driven, confident career choices. Explore 5000+ career paths, take aptitude tests, and get personalized guidance — completely free.</p>
          <div class="footer-slogan">ज्ञानात् ज्ञानं ततः सिद्धिः</div>
          <div class="footer-slogan-meaning">From knowledge comes wisdom, from wisdom comes success</div>
          <div class="footer-social">
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Quick Links</h4>
          <a href="{{ url('/') }}">Home</a>
          <a href="{{ url('/explore') }}">Explore Careers</a>
          <a href="{{ url('/blog') }}">Blog</a>
          <a href="{{ url('/about') }}">About Us</a>
          <a href="{{ route('quick-test.start') }}">Quick Test</a>
          <a href="{{ route('test.start') }}">Advance Test</a>
        </div>

        <div class="footer-col">
          <h4>Resources</h4>
          <a href="{{ url('/explore') }}">Career Paths</a>
          <a href="{{ url('/explore/engineering-colleges') }}">Engineering Colleges</a>
          <a href="{{ url('/explore/medical-colleges') }}">Medical Colleges</a>
          <a href="{{ url('/explore/competitive-exams') }}">Competitive Exams</a>
          <a href="{{ url('/explore/skill-development') }}">Skill Development</a>
        </div>

        <div class="footer-col">
          <h4>Get In Touch</h4>
          <a href="mailto:admin@careergyan.in"><i class="fa-solid fa-envelope" style="margin-right:6px;"></i>admin@careergyan.in</a>
          <a href="#"><i class="fa-solid fa-location-dot" style="margin-right:6px;"></i>Nashik, Maharashtra, India</a>
          <a href="#"><i class="fa-solid fa-clock" style="margin-right:6px;"></i>Mon-Sat: 8AM - 6PM</a>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© 2026 <strong style="color:#fff;">CareerGyan</strong> · Helping students make better career decisions</span>
        <div>
          <a href="{{ url('/about') }}">About & Contact</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Use</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  // Navbar scroll effect
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  });

  // Mobile menu
  const mobileBtn = document.getElementById('mobileBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  mobileBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    const icon = mobileBtn.querySelector('i');
    icon.className = mobileMenu.classList.contains('open')
      ? 'fa-solid fa-xmark'
      : 'fa-solid fa-bars';
  });

  // Global Search
  const searchOverlay = document.getElementById('globalSearchOverlay');
  const openSearchBtn = document.getElementById('openGlobalSearch');
  const openSearchBtnMobile = document.getElementById('openGlobalSearchMobile');
  const closeSearchBtn = document.getElementById('closeGlobalSearch');
  const searchInput = document.getElementById('globalSearchInput');
  const searchResults = document.getElementById('globalSearchResults');

  function getSearchHistory() {
    try { return JSON.parse(localStorage.getItem('cg_search_history') || '[]'); } catch(e) { return []; }
  }
  
  function saveSearchHistory(query) {
    if (!query || query.length < 2) return;
    let history = getSearchHistory();
    history = history.filter(q => q.toLowerCase() !== query.toLowerCase());
    history.unshift(query);
    if (history.length > 5) history.pop();
    localStorage.setItem('cg_search_history', JSON.stringify(history));
  }

  function showSearchHistory() {
    let history = getSearchHistory();
    if (history.length === 0) {
      searchResults.innerHTML = `
        <div class="search-empty">
          <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; color: var(--border); margin-bottom: 16px;"></i>
          <p>Type to start exploring amazing careers...</p>
        </div>
      `;
      return;
    }
    let html = `<div class="search-section-title">Recent Searches</div>`;
    history.forEach(q => {
      let escapedQ = q.replace(/'/g, "\\'").replace(/"/g, '&quot;');
      html += `
        <div class="search-item" style="cursor:pointer;" onclick="searchInput.value='${escapedQ}'; performSearch();">
          <div class="search-item-icon" style="background: var(--surface); color: var(--text-2);">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
          <div class="search-item-content">
            <h4 style="margin:0; font-size:14px;">${q}</h4>
          </div>
          <div style="margin-left: auto; padding: 5px; color: var(--text-3);" onclick="event.stopPropagation(); removeSearchHistory('${escapedQ}')">
            <i class="fa-solid fa-xmark"></i>
          </div>
        </div>
      `;
    });
    searchResults.innerHTML = html;
  }

  function removeSearchHistory(query) {
    let history = getSearchHistory();
    history = history.filter(q => q !== query);
    localStorage.setItem('cg_search_history', JSON.stringify(history));
    showSearchHistory();
  }

  function openSearch() {
    searchOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    if(searchInput.value.trim() === '') showSearchHistory();
    setTimeout(() => searchInput.focus(), 100);
  }

  function closeSearch() {
    searchOverlay.classList.remove('active');
    document.body.style.overflow = 'auto';
  }

  openSearchBtn?.addEventListener('click', openSearch);
  openSearchBtnMobile?.addEventListener('click', openSearch);
  closeSearchBtn?.addEventListener('click', closeSearch);
  searchOverlay.addEventListener('click', closeSearch);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && searchOverlay.classList.contains('active')) closeSearch();
    // Ctrl+K to open search
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') { e.preventDefault(); openSearch(); }
  });

  // Debounce
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
      showSearchHistory();
      return;
    }

    searchResults.innerHTML = `<div style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin" style="color:var(--brand); font-size:24px;"></i></div>`;

    fetch(`/global-search?q=${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        let html = '';

        const hasFields = data.config_careers && data.config_careers.length > 0;
        const hasCareers = data.db_careers && data.db_careers.length > 0;
        const hasColleges = data.colleges && data.colleges.length > 0;
        const hasBlogs = data.blogs && data.blogs.length > 0;

        if (!hasFields && !hasCareers && !hasColleges && !hasBlogs) {
          searchResults.innerHTML = `
            <div class="search-empty">
              <i class="fa-solid fa-folder-open" style="font-size: 32px; color: var(--border); margin-bottom: 16px;"></i>
              <p>No matching information found. Try another keyword.</p>
            </div>
          `;
          return;
        }

        if (hasFields) {
          html += `<div class="search-section-title">Fields & Streams</div>`;
          data.config_careers.forEach(f => {
            html += `
              <a href="${f.url}" class="search-item" onclick="saveSearchHistory(searchInput.value); closeSearch()">
                <div class="search-item-icon" style="background: ${f.bg_color}; color: ${f.color};">
                  <i class="fa-solid ${f.icon}"></i>
                </div>
                <div class="search-item-content">
                  <h4>${f.name}</h4>
                  <p>Explore this entire field</p>
                </div>
              </a>
            `;
          });
        }

        if (hasCareers) {
          html += `<div class="search-section-title">Career Paths</div>`;
          data.db_careers.forEach(c => {
            html += `
              <a href="${c.url}" class="search-item" onclick="saveSearchHistory(searchInput.value); closeSearch()">
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

        if (hasColleges) {
          html += `<div class="search-section-title">Colleges & Institutes</div>`;
          data.colleges.forEach(col => {
            html += `
              <a href="${col.url}" class="search-item" onclick="saveSearchHistory(searchInput.value); closeSearch()">
                <div class="search-item-icon" style="background: var(--brand-light); color: var(--brand);">
                  <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="search-item-content">
                  <h4>${col.name}</h4>
                  <p>${col.location} | Branches: ${col.branches}</p>
                  <span class="search-item-badge" style="background: var(--brand-light); color: var(--brand);">${col.field}</span>
                </div>
              </a>
            `;
          });
        }

        if (hasBlogs) {
          html += `<div class="search-section-title">Blog Articles</div>`;
          data.blogs.forEach(b => {
            html += `
              <a href="${b.url}" class="search-item" onclick="saveSearchHistory(searchInput.value); closeSearch()">
                <div class="search-item-icon" style="background: #ffe4e6; color: #e11d48;">
                  <i class="fa-solid fa-newspaper"></i>
                </div>
                <div class="search-item-content">
                  <h4>${b.title}</h4>
                  <p>${b.excerpt}</p>
                  <span class="search-item-badge" style="background: #ffe4e6; color: #e11d48;">${b.category}</span>
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

  // Scroll Reveal Animation
  const revealElements = document.querySelectorAll('.reveal');
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
  });

  // Profile Dropdown Toggle
  function toggleDropdown(event) {
    event.stopPropagation();
    const menu = document.getElementById('userDropdownMenu');
    if (menu) {
      menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }
  }

  window.addEventListener('click', function() {
    const menu = document.getElementById('userDropdownMenu');
    if (menu) {
      menu.style.display = 'none';
    }
  });
</script>

@yield('scripts')

<script>
  // Global College Reviews Logic
  function loadCollegeReviews(collegeId, containerId) {
      const container = document.getElementById(containerId);
      if (!container) return;
      
      container.innerHTML = `<div style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin" style="color:var(--brand); font-size:24px;"></i></div>`;
      
      fetch(`/colleges/${collegeId}/reviews`)
          .then(res => res.json())
          .then(reviews => {
              let html = `
                  <h3 style="font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 600; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; color: var(--brand, #0d9488);"><i class="fa-solid fa-star"></i> Student Reviews</h3>
              `;
              
              if (reviews.length > 0) {
                  html += `<div style="max-height: 300px; overflow-y: auto; margin-bottom: 16px; padding-right: 8px;">`;
                  reviews.forEach(r => {
                      let stars = '';
                      for(let i=1; i<=5; i++) {
                          stars += `<i class="fa-solid fa-star" style="color: ${i <= r.rating ? '#fbbf24' : '#e2e8f0'}; font-size: 12px;"></i>`;
                      }
                      html += `
                          <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px; border-radius: 8px; margin-bottom: 8px;">
                              <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 4px;">
                                  <strong style="font-size:13px; color:#1e293b;">${r.user ? r.user.name : 'Anonymous'}</strong>
                                  <div>${stars}</div>
                              </div>
                              <p style="font-size:13px; color:#475569; margin:0;">${r.review}</p>
                          </div>
                      `;
                  });
                  html += `</div>`;
              } else {
                  html += `<p style="font-size:13px; color:#64748b; margin-bottom: 16px;">No reviews yet. Be the first to review!</p>`;
              }
              
              // Review Form
              const isAuth = {{ Auth::check() ? 'true' : 'false' }};
              if (isAuth) {
                  html += `
                      <div style="background: white; border: 1px solid #e2e8f0; padding: 16px; border-radius: 8px;">
                          <h4 style="font-size:14px; margin-bottom:8px;">Write a Review</h4>
                          <form onsubmit="submitCollegeReview(event, ${collegeId}, '${containerId}')">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div style="margin-bottom: 8px;">
                                  <select id="reviewRating_${collegeId}" required style="width:100%; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px;">
                                      <option value="">Select Rating</option>
                                      <option value="5">5 Stars - Excellent</option>
                                      <option value="4">4 Stars - Good</option>
                                      <option value="3">3 Stars - Average</option>
                                      <option value="2">2 Stars - Poor</option>
                                      <option value="1">1 Star - Terrible</option>
                                  </select>
                              </div>
                              <div style="margin-bottom: 8px;">
                                  <textarea id="reviewText_${collegeId}" required rows="3" placeholder="Share your experience..." style="width:100%; padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; resize: vertical;"></textarea>
                              </div>
                              <button type="submit" style="background: var(--brand, #1d4ed8); color: white; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; border: none;">Submit Review</button>
                          </form>
                      </div>
                  `;
              } else {
                  html += `<div style="background: #eff6ff; padding: 12px; border-radius: 8px; font-size: 13px; text-align: center; color: #1d4ed8;">Please <a href="/login" style="font-weight:bold; text-decoration:underline;">log in</a> to write a review.</div>`;
              }
              
              container.innerHTML = html;
          })
          .catch(err => {
              container.innerHTML = `<p style="color:red; font-size:13px;">Failed to load reviews.</p>`;
          });
  }

  function submitCollegeReview(e, collegeId, containerId) {
      e.preventDefault();
      const rating = document.getElementById(`reviewRating_${collegeId}`).value;
      const reviewText = document.getElementById(`reviewText_${collegeId}`).value;
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      
      const btn = e.target.querySelector('button[type="submit"]');
      const originalText = btn.textContent;
      btn.textContent = 'Submitting...';
      btn.disabled = true;

      fetch(`/colleges/${collegeId}/reviews`, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': token,
              'Accept': 'application/json'
          },
          body: JSON.stringify({ rating: rating, review: reviewText })
      })
      .then(res => res.json())
      .then(data => {
          if(data.message === 'Review added successfully.') {
              loadCollegeReviews(collegeId, containerId);
          } else {
              alert(data.message || 'Error submitting review.');
              btn.textContent = originalText;
              btn.disabled = false;
          }
      })
      .catch(err => {
          alert('Error submitting review.');
          btn.textContent = originalText;
          btn.disabled = false;
      });
  }
</script>

<script>
  window.addEventListener('load', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const collegeId = urlParams.get('college_id');
    if (collegeId) {
      const id = parseInt(collegeId);
      setTimeout(() => {
        const openFunc = window.openAgriDetails 
                      || window.openArtsDetails 
                      || window.openComDetails 
                      || window.openHotelDetails 
                      || window.openDetails 
                      || window.openMgmtDetails 
                      || window.openNonDetails 
                      || window.openPharmaDetails 
                      || window.openSciDetails;
        if (typeof openFunc === 'function') {
          openFunc(id);
        }
      }, 500);
    }
  });
</script>

<x-ai-career-chat />

</body>
</html>
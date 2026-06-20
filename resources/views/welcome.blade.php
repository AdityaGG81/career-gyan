@extends('layouts.app')

@section('title', 'CareerGyan | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
  /* ─── Global Styling variables for this page ─── */
  :root {
    --hero-bg-dark: #0f172a;
    --hero-bg-light: #1e293b;
    --hero-accent: #38bdf8;
    --card-hover-border: rgba(59, 130, 246, 0.2);
  }

  /* ─── Hero Section (Split Layout) ─── */
  .hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #070b19 0%, #0f172a 40%, #1e293b 80%, #0f172a 100%);
    padding: 100px 0 120px;
    color: #ffffff;
  }

  /* Starry Sky Animation */
  .stars-layer {
    position: absolute;
    inset: 0;
    background-image: 
      radial-gradient(1px 1px at 20px 30px, #fff, rgba(0,0,0,0)),
      radial-gradient(1.5px 1.5px at 70px 70px, #fff, rgba(0,0,0,0)),
      radial-gradient(1px 1px at 50px 160px, #ddd, rgba(0,0,0,0)),
      radial-gradient(2px 2px at 120px 120px, #fff, rgba(0,0,0,0)),
      radial-gradient(1px 1px at 190px 20px, #fff, rgba(0,0,0,0)),
      radial-gradient(1.5px 1.5px at 220px 50px, #ddd, rgba(0,0,0,0)),
      radial-gradient(2px 2px at 280px 80px, #fff, rgba(0,0,0,0)),
      radial-gradient(1px 1px at 350px 10px, #fff, rgba(0,0,0,0)),
      radial-gradient(1.5px 1.5px at 390px 140px, #ddd, rgba(0,0,0,0)),
      radial-gradient(1px 1px at 450px 60px, #fff, rgba(0,0,0,0));
    background-size: 450px 450px;
    opacity: 0.35;
    animation: twinkleStars 6s ease-in-out infinite alternate;
    z-index: 1;
    pointer-events: none;
  }

  @keyframes twinkleStars {
    0% { opacity: 0.25; }
    100% { opacity: 0.6; }
  }

  /* Floating Clouds */
  .sky-cloud {
    position: absolute;
    background: linear-gradient(90deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0.02) 100%);
    backdrop-filter: blur(2px);
    border-radius: 99px;
    pointer-events: none;
    z-index: 1;
    animation: floatCloud 30s linear infinite;
  }
  .sky-cloud-1 { width: 320px; height: 50px; top: 12%; left: -350px; animation-duration: 45s; }
  .sky-cloud-2 { width: 220px; height: 35px; top: 38%; left: -250px; animation-duration: 35s; animation-delay: -12s; }
  .sky-cloud-3 { width: 280px; height: 45px; top: 68%; left: -300px; animation-duration: 40s; animation-delay: -22s; }

  @keyframes floatCloud {
    0% { transform: translateX(0); }
    100% { transform: translateX(calc(100vw + 400px)); }
  }

  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1.2' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
  }

  /* Decorative glowing background orbs */
  .hero-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    pointer-events: none;
    opacity: 0.12;
    z-index: 1;
    animation: orbPulse 8s ease-in-out infinite alternate;
  }

  .hero-orb-1 {
    width: 450px;
    height: 450px;
    background: #1a56db;
    top: -100px;
    right: -50px;
  }

  .hero-orb-2 {
    width: 350px;
    height: 350px;
    background: #f97316;
    bottom: -80px;
    left: -50px;
    animation-delay: -4s;
  }

  @keyframes orbPulse {
    0% { transform: scale(1) translate(0, 0); opacity: 0.12; }
    100% { transform: scale(1.15) translate(20px, 15px); opacity: 0.22; }
  }

  .hero-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    align-items: center;
    position: relative;
    z-index: 2;
  }

  /* Left Side Hero Content */
  .hero-left {
    text-align: left;
  }

  .hero-slogan {
    font-family: 'Sora', sans-serif;
    color: #60a5fa;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .hero-slogan::after {
    content: '';
    display: inline-block;
    width: 40px;
    height: 2px;
    background: #60a5fa;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 99px;
    backdrop-filter: blur(8px);
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    transition: all 0.3s ease;
  }

  .hero-badge:hover {
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-1px);
  }

  .hero-badge i {
    color: #fbbf24;
  }

  .hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(32px, 4.5vw, 54px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
  }

  .hero h1 span.highlight {
    background: linear-gradient(135deg, #38bdf8 0%, #60a5fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .typewriter-container {
    display: inline-block;
    position: relative;
    color: #f59e0b;
    border-right: 3px solid #f59e0b;
    padding-right: 4px;
    animation: blinkCursor 0.75s step-end infinite;
  }

  @keyframes blinkCursor {
    from, to { border-color: transparent }
    50% { border-color: #f59e0b; }
  }

  .hero p {
    font-size: clamp(16px, 1.8vw, 18px);
    color: #cbd5e1;
    max-width: 580px;
    margin-bottom: 36px;
    line-height: 1.7;
  }

  .hero-btns {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 48px;
  }

  .btn-hero-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    padding: 14px 30px;
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
  }

  .btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
  }

  .btn-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    background: rgba(255, 255, 255, 0.05);
    border: 1.5px solid rgba(255, 255, 255, 0.2);
    padding: 13px 29px;
    border-radius: var(--radius-lg);
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .btn-hero-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.35);
    transform: translateY(-2px);
  }

  /* Right Side Hero Illustration (Floating SVGs) */
  .hero-right {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 380px;
  }

  .hero-illustration-container {
    position: relative;
    width: 320px;
    height: 320px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .main-student-svg {
    width: 170px;
    height: 170px;
    z-index: 5;
    filter: drop-shadow(0 15px 30px rgba(15, 23, 42, 0.3));
    animation: studentFloat 4s ease-in-out infinite alternate;
  }

  @keyframes studentFloat {
    0% { transform: translateY(0px) rotate(0deg); }
    100% { transform: translateY(-10px) rotate(2deg); }
  }

  .floating-career-doodle {
    position: absolute;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    backdrop-filter: blur(4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    z-index: 3;
  }

  /* Specific Positions & Animations for Floating Icons */
  .fd-med { top: 0; left: 10%; color: #ef4444; animation: fdFloat1 5s ease-in-out infinite alternate; }
  .fd-tech { top: -10%; right: 15%; color: #3b82f6; animation: fdFloat2 6s ease-in-out infinite alternate; }
  .fd-art { bottom: 10%; left: 0; color: #ec4899; animation: fdFloat2 5.5s ease-in-out infinite alternate -1s; }
  .fd-law { bottom: -5%; right: 10%; color: #fbbf24; animation: fdFloat1 6.5s ease-in-out infinite alternate -2s; }
  .fd-biz { top: 40%; right: -15%; color: #10b981; animation: fdFloat1 5.8s ease-in-out infinite alternate -3s; }
  .fd-edu { top: 45%; left: -15%; color: #8b5cf6; animation: fdFloat2 6.2s ease-in-out infinite alternate -4s; }

  @keyframes fdFloat1 {
    0% { transform: translateY(0px) scale(1) rotate(0deg); }
    100% { transform: translateY(-15px) scale(1.05) rotate(10deg); }
  }
  @keyframes fdFloat2 {
    0% { transform: translateY(0px) scale(1) rotate(0deg); }
    100% { transform: translateY(15px) scale(0.95) rotate(-10deg); }
  }

  /* SVG Orbital rings */
  .orbital-rings {
    position: absolute;
    width: 380px;
    height: 380px;
    opacity: 0.15;
    animation: ringRotate 20s linear infinite;
    z-index: 1;
    pointer-events: none;
  }

  @keyframes ringRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  /* Wave Divider */
  .wave-divider {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
    z-index: 2;
  }

  .wave-divider svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 40px;
  }

  .wave-divider .shape-fill {
    fill: #ffffff;
  }

  /* ─── Hero Stats ─── */
  .hero-stats {
    display: flex;
    gap: 32px;
    margin-top: 10px;
  }

  .hero-stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: var(--radius-lg);
    padding: 16px 24px;
    min-width: 120px;
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
  }

  .hero-stat-card:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.15);
  }

  .hero-stat-card strong {
    display: block;
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #60a5fa;
    margin-bottom: 2px;
  }

  .hero-stat-card > span {
    font-size: 13px;
    color: #94a3b8;
  }

  /* ─── Why Choose CareerGyan (USPs) ─── */
  .usp-section {
    padding: 100px 0 80px;
    background: #ffffff;
    text-align: center;
  }

  .section-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    color: var(--brand);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    background: var(--brand-light);
    padding: 6px 14px;
    border-radius: 99px;
    margin-bottom: 16px;
  }

  .section-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 38px);
    font-weight: 800;
    color: var(--text-1);
    margin-bottom: 16px;
  }

  .section-subtitle {
    font-size: 16px;
    color: var(--text-2);
    max-width: 580px;
    margin: 0 auto 56px;
    line-height: 1.6;
  }

  .usp-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 30px;
  }

  .usp-card {
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 40px 30px;
    text-align: left;
    transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1);
    position: relative;
    overflow: hidden;
  }

  .usp-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--brand);
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .usp-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
    border-color: transparent;
  }

  .usp-card:hover::after {
    opacity: 1;
  }

  .usp-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 24px;
    transition: transform 0.4s ease;
  }

  .usp-card:hover .usp-icon-wrap {
    transform: scale(1.1) rotate(5deg);
  }

  .usp-card--blue .usp-icon-wrap { background: #eff6ff; color: #2563eb; }
  .usp-card--orange .usp-icon-wrap { background: #fff7ed; color: #ea580c; }
  .usp-card--purple .usp-icon-wrap { background: #faf5ff; color: #7c3aed; }
  .usp-card--green .usp-icon-wrap { background: #f0fdf4; color: #16a34a; }

  .usp-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 19px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 12px;
  }

  .usp-card p {
    font-size: 14.5px;
    color: var(--text-2);
    line-height: 1.6;
  }

  /* ─── Popular Careers Marquee ─── */
  .marquee-section {
    padding: 80px 0;
    background: #f8fafc;
    overflow: hidden;
  }

  .marquee-container {
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    width: 100%;
    margin-top: 24px;
  }

  .marquee-inner {
    display: inline-flex;
    gap: 24px;
    animation: marqueeAnimation 35s linear infinite;
  }

  .marquee-container:hover .marquee-inner {
    animation-play-state: paused;
  }

  @keyframes marqueeAnimation {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }

  .marquee-card {
    display: inline-flex;
    flex-direction: column;
    width: 280px;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    white-space: normal;
  }

  .marquee-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
    border-color: var(--card-hover-border);
  }

  .marquee-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
  }

  .marquee-icon-wrap {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #fff;
    flex-shrink: 0;
  }

  .marquee-card h4 {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    margin: 0;
  }

  .marquee-card span.category-badge {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    display: block;
  }

  .marquee-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: var(--text-2);
    border-top: 1px solid var(--border);
    padding-top: 10px;
  }

  .marquee-card-meta strong {
    color: var(--brand);
  }

  /* ─── How CareerGyan Works (Timeline) ─── */
  .timeline-section {
    padding: 100px 0;
    background: #ffffff;
    position: relative;
  }

  .timeline-container {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px 0;
  }

  /* Connecting timeline line */
  .timeline-line {
    position: absolute;
    top: 50px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 0; /* Animated on scroll */
    background: linear-gradient(180deg, #eff6ff 0%, var(--brand) 50%, #faf5ff 100%);
    z-index: 1;
    transition: height 1.6s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    position: relative;
    z-index: 2;
    opacity: 0;
    transform: translateY(40px) scale(0.96);
    transition: all 0.75s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .timeline-item.active {
    opacity: 1;
    transform: translateY(0) scale(1);
  }

  .timeline-item:last-child {
    margin-bottom: 0;
  }

  /* Even timeline elements on left, odd on right */
  .timeline-item:nth-child(even) {
    flex-direction: row-reverse;
  }

  .timeline-content {
    width: 44%;
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 30px;
    box-shadow: var(--shadow-sm);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
  }

  .timeline-content:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 20px 35px rgba(26, 86, 219, 0.12);
    border-color: var(--brand);
  }

  .timeline-content h3 {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .timeline-content h3 i {
    color: var(--brand);
  }

  .timeline-content p {
    font-size: 14.5px;
    color: var(--text-2);
    line-height: 1.6;
  }

  /* The center node circle */
  .timeline-node {
    width: 50px;
    height: 50px;
    background: #ffffff;
    border: 4px solid var(--brand);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 18px;
    color: var(--brand);
    box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);
    z-index: 3;
    transition: all 0.3s ease;
  }

  .timeline-item:hover .timeline-node {
    background: var(--brand);
    color: #ffffff;
    transform: scale(1.12);
  }

  .timeline-spacer {
    width: 44%;
  }

  /* ─── Testimonials ─── */
  .testimonials-section {
    padding: 100px 0;
    background: #f8fafc;
  }

  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
  }

  .testimonial-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 36px;
    position: relative;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
  }

  .testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
  }

  .testimonial-quote-icon {
    position: absolute;
    top: 30px;
    right: 30px;
    font-size: 40px;
    color: #e2e8f0;
    line-height: 1;
    pointer-events: none;
  }

  .testimonial-stars {
    color: #fbbf24;
    font-size: 14px;
    margin-bottom: 16px;
  }

  .testimonial-text {
    font-size: 15px;
    color: var(--text-2);
    line-height: 1.6;
    font-style: italic;
    margin-bottom: 24px;
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .testimonial-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--brand-light) 0%, var(--brand) 100%);
    color: var(--brand);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 700;
    font-size: 16px;
  }

  .testimonial-author-info h4 {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    margin: 0 0 2px;
  }

  .testimonial-author-info span {
    font-size: 12.5px;
    color: var(--text-3);
  }

  /* ─── Latest Blog Section ─── */
  .blog-section {
    padding: 100px 0;
    background: #ffffff;
  }

  .blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
  }

  .blog-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  .blog-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
    border-color: var(--card-hover-border);
  }

  .blog-image-wrap {
    height: 180px;
    background: linear-gradient(135deg, var(--brand-light) 0%, var(--brand) 100%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 44px;
  }

  .blog-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .blog-category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(26, 86, 219, 0.9);
    color: #fff;
    padding: 4px 12px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(4px);
  }

  .blog-card-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .blog-card-meta {
    font-size: 12px;
    color: var(--text-3);
    margin-bottom: 12px;
    display: flex;
    gap: 12px;
  }

  .blog-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 700;
    color: var(--text-1);
    margin: 0 0 10px;
    line-height: 1.4;
  }

  .blog-card-excerpt {
    font-size: 13.5px;
    color: var(--text-2);
    line-height: 1.55;
    margin-bottom: 20px;
    flex-grow: 1;
  }

  .blog-card-link {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--brand);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.2s ease;
  }

  .blog-card:hover .blog-card-link {
    gap: 10px;
  }

  /* ─── Premium CTA ─── */
  .cta-section {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
    border-radius: var(--radius-xl);
    padding: 72px 48px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
    color: #ffffff;
  }

  .cta-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.15), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(249, 115, 22, 0.1), transparent 45%);
    pointer-events: none;
  }

  .cta-section h2 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(24px, 3.5vw, 36px);
    font-weight: 800;
    margin-bottom: 16px;
    line-height: 1.25;
  }

  .cta-section p {
    font-size: 16px;
    color: #cbd5e1;
    max-width: 580px;
    margin: 0 auto 36px;
    line-height: 1.65;
  }

  .btn-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 700;
    color: var(--brand);
    background: #ffffff;
    padding: 16px 36px;
    border-radius: var(--radius-xl);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
  }

  .btn-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    background: #f8fafc;
  }

  .cta-features {
    display: flex;
    justify-content: center;
    gap: 32px;
    flex-wrap: wrap;
    margin-top: 36px;
  }

  .cta-feat {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: #cbd5e1;
  }

  .cta-feat i {
    color: #4ade80;
  }

  /* ─── Suggestion Section ─── */
  .suggestion-section {
    background: #f8fafc;
    padding: 100px 0;
    border-top: 1px solid var(--border);
  }

  .suggestion-container {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 60px;
    align-items: center;
  }

  .suggestion-info h2 {
    font-family: 'Sora', sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: var(--text-1);
    margin-bottom: 18px;
  }

  .suggestion-info p {
    color: var(--text-2);
    font-size: 16px;
    line-height: 1.65;
    margin-bottom: 32px;
  }

  .suggestion-card {
    background: #ffffff;
    border-radius: var(--radius-xl);
    padding: 40px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    border: 1px solid var(--border);
  }

  .form-group {
    margin-bottom: 24px;
  }

  .form-group label {
    display: block;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-2);
    margin-bottom: 8px;
  }

  .form-control {
    width: 100%;
    padding: 12px 18px;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--border);
    font-family: inherit;
    font-size: 15px;
    background: #f8fafc;
    transition: all 0.2s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--brand);
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
  }

  .btn-submit {
    width: 100%;
    background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
    color: #ffffff;
    border: none;
    padding: 14px;
    border-radius: var(--radius-lg);
    font-size: 15.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(29, 78, 216, 0.25);
  }

  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(29, 78, 216, 0.4);
  }

  /* ─── Responsive Media Queries ─── */
  @media (max-width: 991px) {
    .hero-grid {
      grid-template-columns: 1fr;
      text-align: center;
      gap: 50px;
    }

    .hero-left {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .hero h1 {
      margin-bottom: 16px;
    }

    .hero p {
      margin-bottom: 28px;
    }

    .hero-btns {
      justify-content: center;
    }

    .hero-stats {
      justify-content: center;
    }

    .timeline-line {
      left: 20px;
    }

    .timeline-item {
      flex-direction: row !important;
      margin-bottom: 40px;
    }

    .timeline-content {
      width: calc(100% - 60px);
    }

    .timeline-node {
      position: absolute;
      left: -5px;
    }

    .timeline-spacer {
      display: none;
    }

    .suggestion-container {
      grid-template-columns: 1fr;
      gap: 40px;
    }
  }

  @media (max-width: 768px) {
    .hero {
      padding: 70px 0 90px;
    }

    .hero-right {
      display: none;
    }

    .hero-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      width: 100%;
    }

    .hero-stat-card {
      width: 100%;
      min-width: 0;
      padding: 12px;
    }

    .timeline-section {
      padding: 70px 0;
    }

    .usp-section {
      padding: 70px 0 50px;
    }

    .marquee-section {
      padding: 60px 0;
    }

    .testimonials-section {
      padding: 70px 0;
    }

    .blog-section {
      padding: 70px 0;
    }

    .suggestion-section {
      padding: 70px 0;
    }

    .cta-section {
      padding: 48px 24px;
    }

    .suggestion-card {
      padding: 24px;
    }

    .form-grid {
      grid-template-columns: 1fr !important;
    }
  }

  @media (max-width: 480px) {
    .hero {
      padding: 60px 0 70px;
    }

    .hero-slogan {
      font-size: 13px;
      letter-spacing: 1px;
    }

    .hero-badge {
      font-size: 11px;
      padding: 6px 12px;
    }

    .hero h1 {
      font-size: clamp(24px, 7vw, 34px);
    }

    .hero-btns {
      flex-direction: column;
      width: 100%;
      gap: 12px;
    }

    .hero-btns a {
      width: 100%;
      justify-content: center;
    }

    .timeline-content {
      padding: 16px;
    }

    .timeline-content h3 {
      font-size: 16px;
    }

    .timeline-content p {
      font-size: 13px;
    }

    .cta-features {
      flex-direction: column;
      align-items: flex-start;
      gap: 12px;
    }
  }
</style>
@endsection

@section('content')

<!-- ─── Hero Section ─── -->
<section class="hero">
  <div class="stars-layer"></div>
  <div class="sky-cloud sky-cloud-1"></div>
  <div class="sky-cloud sky-cloud-2"></div>
  <div class="sky-cloud sky-cloud-3"></div>
  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>

  <div class="container">
    <div class="hero-grid">
      <!-- Left side: content -->
      <div class="hero-left">
        <div class="hero-slogan">
          ज्ञानात् ज्ञानं ततः सिद्धिः
        </div>

        <div class="hero-badge">
          <i class="fa-solid fa-building-columns"></i>
          INDIAN INSTITUTE OF CAREER MANAGEMENT
        </div>

        <h1>
          Explore Career Paths<br/>for a <span class="typewriter-container"><span class="typewriter-text"></span></span> Future
        </h1>

        <p>
          Discover 5000+ career paths across 50+ fields. Get expert roadmaps and personalized recommendations after 10th, 12th, or graduation.
        </p>

        <div class="hero-btns">
          <a href="{{ url('/explore') }}" class="btn-hero-primary">
            <i class="fa-solid fa-compass"></i> Explore Careers
          </a>

          <a href="{{ route('quick-test.start') }}" class="btn-hero-outline">
            <i class="fa-solid fa-bolt"></i> Take Career Test
          </a>
        </div>

        <div class="hero-stats">
          <div class="hero-stat-card">
            <strong><span class="counter-val" data-target="5000" data-suffix="+">0</span></strong>
            <span>Career Paths</span>
          </div>

          <div class="hero-stat-card">
            <strong><span class="counter-val" data-target="50" data-suffix="+">0</span></strong>
            <span>Fields Covered</span>
          </div>

          <div class="hero-stat-card">
            <strong>Free</strong>
            <span>Career Test</span>
          </div>

          <div class="hero-stat-card">
            <strong>Expert</strong>
            <span>Roadmaps</span>
          </div>
        </div>
      </div>

      <!-- Right side: premium doodle illustration -->
      <div class="hero-right">
        <!-- Circular orbital lines -->
        <svg class="orbital-rings" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="200" cy="200" r="150" stroke="white" stroke-width="1.5" stroke-dasharray="8 8"/>
          <circle cx="200" cy="200" r="190" stroke="white" stroke-width="1" stroke-dasharray="4 6"/>
        </svg>

        <div class="hero-illustration-container">
          <!-- Central student SVG drawing -->
          <svg class="main-student-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Cap -->
            <path d="M100 20 L160 50 L100 80 L40 50 Z" fill="#3b82f6" fill-opacity="0.2" stroke="#60a5fa" stroke-width="3"/>
            <path d="M100 80 L100 130 C100 145, 120 145, 120 130" stroke="#60a5fa" stroke-width="3" stroke-linecap="round"/>
            <path d="M160 50 L160 100 C160 105, 163 110, 168 110" stroke="#f59e0b" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="168" cy="110" r="4" fill="#f59e0b"/>
            <!-- Head -->
            <circle cx="100" cy="110" r="30" fill="#1e3a8a" stroke="#60a5fa" stroke-width="3"/>
            <!-- Body -->
            <path d="M50 180 C50 150, 75 140, 100 140 C125 140, 150 150, 150 180" fill="#3b82f6" fill-opacity="0.1" stroke="#60a5fa" stroke-width="3" stroke-linejoin="round"/>
            <!-- Lightbulb above -->
            <path d="M100 95 L100 100" stroke="#f59e0b" stroke-width="3" stroke-linecap="round"/>
          </svg>

          <!-- Floating career icons -->
          <div class="floating-career-doodle fd-med" title="Medical"><i class="fa-solid fa-stethoscope"></i></div>
          <div class="floating-career-doodle fd-tech" title="Technology"><i class="fa-solid fa-laptop-code"></i></div>
          <div class="floating-career-doodle fd-art" title="Design & Arts"><i class="fa-solid fa-palette"></i></div>
          <div class="floating-career-doodle fd-law" title="Law"><i class="fa-solid fa-scale-balanced"></i></div>
          <div class="floating-career-doodle fd-biz" title="Business"><i class="fa-solid fa-chart-line"></i></div>
          <div class="floating-career-doodle fd-edu" title="Education"><i class="fa-solid fa-graduation-cap"></i></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Animated Bottom Wave Divider -->
  <div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120 " preserveAspectRatio="none">
      <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1130.5,103.2,1053.4,101.4,985.66,92.83Z" class="shape-fill"></path>
    </svg>
  </div>
</section>

<!-- ─── Why Choose CareerGyan Section (USPs) ─── -->
<section class="usp-section">
  <div class="container">
    <div class="section-label">
      <i class="fa-solid fa-star"></i> Why CareerGyan
    </div>
    <h2 class="section-title">Designed for Smart Career Choices</h2>
    <p class="section-subtitle">Empowering students to navigate their future with precision, confidence, and completely free tools.</p>
    
    <div class="usp-grid">
      <!-- USP 1 -->
      <div class="usp-card usp-card--blue">
        <div class="usp-icon-wrap">
          <i class="fa-solid fa-route"></i>
        </div>
        <h3>5000+ Career Paths</h3>
        <p>Explore an exhaustive list of careers in science, commerce, humanities, technology, design, and non-traditional fields.</p>
      </div>

      <!-- USP 2 -->
      <div class="usp-card usp-card--orange">
        <div class="usp-icon-wrap">
          <i class="fa-solid fa-robot"></i>
        </div>
        <h3>AI-Powered Counselor</h3>
        <p>Chat 24/7 with Career Guruji AI. Get answers to your specific career queries instantly based on data-driven inputs.</p>
      </div>

      <!-- USP 3 -->
      <div class="usp-card usp-card--purple">
        <div class="usp-icon-wrap">
          <i class="fa-solid fa-map-location-dot"></i>
        </div>
        <h3>Step-by-Step Roadmaps</h3>
        <p>Get visual roadmaps mapping out streams, entrance exams, required qualifications, skill sets, and job markets.</p>
      </div>

      <!-- USP 4 -->
      <div class="usp-card usp-card--green">
        <div class="usp-icon-wrap">
          <i class="fa-solid fa-badge-percent"></i>
        </div>
        <h3>100% Free & Unbiased</h3>
        <p>No ads, no paid promotions, and no college biases. Get completely objective advice tailored to your interest profile.</p>
      </div>
    </div>
  </div>
</section>

<!-- ─── Popular Careers Marquee ─── -->
<section class="marquee-section">
  <div class="container" style="text-align: center;">
    <div class="section-label" style="background:#f1f5f9; color:var(--text-2);">
      <i class="fa-solid fa-fire"></i> Trending Now
    </div>
    <h2 class="section-title" style="margin-bottom:10px;">Popular Career Pathways</h2>
    <p style="color:var(--text-2); font-size:15px; margin-bottom:30px;">Hover over cards to pause scrolling</p>
  </div>

  <div class="marquee-container">
    <div class="marquee-inner">
      <!-- Card 1 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"><i class="fa-solid fa-laptop-code"></i></div>
          <div>
            <h4>Software Engineer</h4>
            <span class="category-badge">Technology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 25L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-stethoscope"></i></div>
          <div>
            <h4>General Physician</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #d97706);"><i class="fa-solid fa-chart-line"></i></div>
          <div>
            <h4>Financial Analyst</h4>
            <span class="category-badge">Finance</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Medium Demand</span>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-bezier-curve"></i></div>
          <div>
            <h4>UX/UI Designer</h4>
            <span class="category-badge">Creative Arts</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 15L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <h4>Corporate Lawyer</h4>
            <span class="category-badge">Legal</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Medium Demand</span>
        </div>
      </div>
      <!-- Card 6 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fa-solid fa-bullhorn"></i></div>
          <div>
            <h4>Digital Marketer</h4>
            <span class="category-badge">Business</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3L - 12L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>

      <!-- Duplicated for seamless marquee loop -->
      <!-- Card 1 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"><i class="fa-solid fa-laptop-code"></i></div>
          <div>
            <h4>Software Engineer</h4>
            <span class="category-badge">Technology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 25L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-stethoscope"></i></div>
          <div>
            <h4>General Physician</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #d97706);"><i class="fa-solid fa-chart-line"></i></div>
          <div>
            <h4>Financial Analyst</h4>
            <span class="category-badge">Finance</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Medium Demand</span>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-bezier-curve"></i></div>
          <div>
            <h4>UX/UI Designer</h4>
            <span class="category-badge">Creative Arts</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 15L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <h4>Corporate Lawyer</h4>
            <span class="category-badge">Legal</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Medium Demand</span>
        </div>
      </div>
      <!-- Card 6 -->
      <div class="marquee-card">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fa-solid fa-bullhorn"></i></div>
          <div>
            <h4>Digital Marketer</h4>
            <span class="category-badge">Business</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3L - 12L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── How It Works (Premium Timeline) ─── -->
<section class="timeline-section">
  <div class="container" style="text-align: center;">
    <div class="section-label">
      <i class="fa-solid fa-business-time"></i> Simple Workflow
    </div>
    <h2 class="section-title">How CareerGyan Works</h2>
    <p class="section-subtitle">Follow our structured path to find clarity, choose the right qualifications, and achieve your professional goals.</p>

    <div class="timeline-container">
      <div class="timeline-line"></div>

      <!-- Step 1 -->
      <div class="timeline-item">
        <div class="timeline-content">
          <h3><i class="fa-solid fa-list-check"></i> 1. Take a Quick Test</h3>
          <p>Answer scientifically-formulated, interest-mapping questions to understand your dominant skill sets and personality profile.</p>
        </div>
        <div class="timeline-node">1</div>
        <div class="timeline-spacer"></div>
      </div>

      <!-- Step 2 -->
      <div class="timeline-item">
        <div class="timeline-content">
          <h3><i class="fa-solid fa-wand-magic-sparkles"></i> 2. Get AI Recommendations</h3>
          <p>Receive personalized career suggestions automatically matches to your streams, qualifications, and quiz outputs.</p>
        </div>
        <div class="timeline-node">2</div>
        <div class="timeline-spacer"></div>
      </div>

      <!-- Step 3 -->
      <div class="timeline-item">
        <div class="timeline-content">
          <h3><i class="fa-solid fa-route"></i> 3. Explore Roadmaps</h3>
          <p>Review step-by-step career path guides outlining exam preparation, colleges, required degrees, salaries, and future growth.</p>
        </div>
        <div class="timeline-node">3</div>
        <div class="timeline-spacer"></div>
      </div>

      <!-- Step 4 -->
      <div class="timeline-item">
        <div class="timeline-content">
          <h3><i class="fa-solid fa-building-columns"></i> 4. Find Top Colleges</h3>
          <p>Discover government and private institutes matching your selected fields. Filter by stream, state, and location details.</p>
        </div>
        <div class="timeline-node">4</div>
        <div class="timeline-spacer"></div>
      </div>

      <!-- Step 5 -->
      <div class="timeline-item">
        <div class="timeline-content">
          <h3><i class="fa-solid fa-rocket"></i> 5. Build Your Future</h3>
          <p>Launch your preparation with a clear set of milestones, recommended entrance exams, and actionable next steps.</p>
        </div>
        <div class="timeline-node">5</div>
        <div class="timeline-spacer"></div>
      </div>
    </div>
  </div>
</section>

<!-- ─── Testimonials ─── -->
<section class="testimonials-section">
  <div class="container">
    <div style="text-align: center; margin-bottom: 50px;">
      <div class="section-label">
        <i class="fa-solid fa-quote-left"></i> Impact
      </div>
      <h2 class="section-title">What Students Say</h2>
      <p style="color:var(--text-2); font-size:16px;">Read real stories from students who found their path using CareerGyan.</p>
    </div>

    <div class="testimonials-grid">
      <!-- Testimonial 1 -->
      <div class="testimonial-card">
        <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">
          "I was completely confused between pursuing B.Sc CS or BCA after my 12th. The quick test matched me to software engineering and laid down the exact exams and skills I'd need. Highly recommended!"
        </p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">RV</div>
          <div class="testimonial-author-info">
            <h4>Rohan Verma</h4>
            <span>CS Student, Nashik</span>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="testimonial-card">
        <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">
          "The Career Guruji AI chatbot answered all my specific questions about pursuing design colleges in Maharashtra. Having this platform completely free is a blessing."
        </p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">AP</div>
          <div class="testimonial-author-info">
            <h4>Anjali Patil</h4>
            <span>Design Aspirant, Pune</span>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="testimonial-card">
        <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="testimonial-text">
          "The detailed roadmaps helped us map out the entrance exams for UPSC and defense careers. Excellent initiative by the Indian Institute of Career Management."
        </p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">SK</div>
          <div class="testimonial-author-info">
            <h4>Siddharth Kale</h4>
            <span>UPSC Aspirant, Mumbai</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── Latest from Blog Section ─── -->
<section class="blog-section">
  <div class="container">
    <div style="text-align: center; margin-bottom: 50px;">
      <div class="section-label">
        <i class="fa-solid fa-newspaper"></i> Articles
      </div>
      <h2 class="section-title">Latest from the Blog</h2>
      <p style="color:var(--text-2); font-size:16px;">Tips, trends, and expert insights to navigate the evolving career landscape.</p>
    </div>

    @php
      $latestBlogs = class_exists(\App\Models\Blog::class) ? \App\Models\Blog::published()->latest()->take(3)->get() : collect();
    @endphp

    <div class="blog-grid">
      @forelse($latestBlogs as $blog)
        <!-- Dynamic Blog Card -->
        <article class="blog-card">
          <div class="blog-image-wrap">
            @if($blog->cover_image)
              <img src="{{ $blog->cover_image }}" alt="{{ $blog->title }}">
            @else
              <i class="fa-solid fa-newspaper"></i>
            @endif
            <span class="blog-category-badge">{{ $blog->category }}</span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="fa-solid fa-user"></i> {{ $blog->author }}</span>
              <span><i class="fa-solid fa-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('d M, Y') : $blog->created_at->format('d M, Y') }}</span>
            </div>
            <h3 class="blog-card-title">{{ $blog->title }}</h3>
            <p class="blog-card-excerpt">{{ Str::limit(strip_tags($blog->excerpt ?: $blog->content), 100) }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-link">
              Read Article <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>
      @empty
        <!-- Fallback/Mock Blog Card 1 -->
        <article class="blog-card">
          <div class="blog-image-wrap">
            <span class="blog-category-badge">Career Tips</span>
            <i class="fa-solid fa-graduation-cap"></i>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="fa-solid fa-user"></i> CareerGyan Team</span>
              <span><i class="fa-solid fa-calendar"></i> 14 Jun, 2026</span>
            </div>
            <h3 class="blog-card-title">How to Choose the Right Career Path After 12th</h3>
            <p class="blog-card-excerpt">A comprehensive guide analyzing stream changes, professional degrees, and high-growth sectors for school passouts.</p>
            <a href="{{ url('/blog') }}" class="blog-card-link">
              Read Article <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>

        <!-- Fallback/Mock Blog Card 2 -->
        <article class="blog-card">
          <div class="blog-image-wrap">
            <span class="blog-category-badge">Education</span>
            <i class="fa-solid fa-brain"></i>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="fa-solid fa-user"></i> Counselors</span>
              <span><i class="fa-solid fa-calendar"></i> 12 Jun, 2026</span>
            </div>
            <h3 class="blog-card-title">The Role of Artificial Intelligence in Modern Jobs</h3>
            <p class="blog-card-excerpt">Understand which sectors are being disrupted by AI, new emerging roles, and how students can upskill.</p>
            <a href="{{ url('/blog') }}" class="blog-card-link">
              Read Article <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>

        <!-- Fallback/Mock Blog Card 3 -->
        <article class="blog-card">
          <div class="blog-image-wrap">
            <span class="blog-category-badge">Skill Development</span>
            <i class="fa-solid fa-compass"></i>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="fa-solid fa-user"></i> Experts</span>
              <span><i class="fa-solid fa-calendar"></i> 10 Jun, 2026</span>
            </div>
            <h3 class="blog-card-title">Why Non-Traditional Careers are Surging in India</h3>
            <p class="blog-card-excerpt">An in-depth look at content creation, gaming, remote freelancing, and digital business paths.</p>
            <a href="{{ url('/blog') }}" class="blog-card-link">
              Read Article <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ─── Action Call Section ─── -->
<section class="section">
  <div class="container">
    <div class="cta-section">
      <h2>Not sure which career is right for you?</h2>
      <p>
        Take our free AI-powered Quick Test — answer 16 simple questions and get personalised career recommendations based on your unique interests and strengths.
      </p>

      <a href="{{ route('quick-test.start') }}" class="btn-cta">
        <i class="fa-solid fa-bolt" style="color:var(--accent);"></i>
        Start Quick Test
        <i class="fa-solid fa-arrow-right"></i>
      </a>

      <div class="cta-features">
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Takes only 15 minutes</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Personalised recommendations</div>
        <div class="cta-feat"><i class="fa-solid fa-check-circle"></i> Detailed roadmap timelines</div>
      </div>
    </div>
  </div>
</section>

<!-- ─── Suggestion Section ─── -->
<section class="suggestion-section">
  <div class="container">
    <div class="suggestion-container">
      
      <div class="suggestion-info">
        <div class="section-label">
          <i class="fa-solid fa-lightbulb"></i> Feedback
        </div>
        <h2>💡 Share Your Suggestions</h2>
        <p>Your ideas help us build a better platform. Whether it is a feature request, college correction, or general feedback, we want to hear from you!</p>
      </div>

      <div class="suggestion-card">
        @if(session('success'))
          <div style="background: #dcfce7; color: #166534; padding: 24px; border-radius: var(--radius-lg); text-align: center; font-weight: 600;">
            <div style="font-size: 40px; margin-bottom: 16px;">✅</div>
            <div style="font-size: 18px; line-height: 1.5;">{{ session('success') }}</div>
          </div>
        @else
          <form action="{{ route('suggestion.store') }}" method="POST">
            @csrf
            <!-- Honeypot -->
            <div style="display: none;">
              <input type="text" name="website" value="">
            </div>

            <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
              </div>
            </div>

            <div class="form-group">
              <label for="role">I am a...</label>
              <select name="role" id="role" class="form-control" required>
                <option value="Student">Student</option>
                <option value="Expert">Expert</option>
                <option value="Parent">Parent</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message">Suggestion Message <span style="color: #dc2626;">*</span></label>
              <textarea name="message" id="message" rows="4" class="form-control" placeholder="Tell us how we can improve..." required></textarea>
              @error('message')
                <span style="color: #dc2626; font-size: 12px;">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn-submit">
              Send Suggestion <i class="fa-solid fa-paper-plane"></i>
            </button>
          </form>
        @endif
      </div>

    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  // Add CSS hover styling enhancements for cards zoom & pop
  const style = document.createElement('style');
  style.innerHTML = `
    .stat-card { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .stat-card:hover { transform: translateY(-8px) scale(1.05) !important; box-shadow: 0 20px 35px rgba(0,0,0,0.06) !important; border-color: rgba(59, 130, 246, 0.3) !important; }
    .usp-card { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .usp-card:hover { transform: translateY(-12px) scale(1.05) !important; box-shadow: 0 25px 45px rgba(26, 86, 219, 0.15) !important; border-color: var(--brand) !important; }
    .marquee-card { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .marquee-card:hover { transform: translateY(-8px) scale(1.06) !important; box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important; border-color: rgba(59, 130, 246, 0.3) !important; }
    .testimonial-card { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .testimonial-card:hover { transform: translateY(-8px) scale(1.04) !important; box-shadow: 0 20px 35px rgba(0,0,0,0.06) !important; border-color: var(--brand) !important; }
    .blog-card { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
    .blog-card:hover { transform: translateY(-10px) scale(1.04) !important; box-shadow: 0 25px 45px rgba(15, 23, 42, 0.1) !important; border-color: rgba(59, 130, 246, 0.3) !important; }
  `;
  document.head.appendChild(style);

  // Typewriter animation on homepage Hero
  document.addEventListener('DOMContentLoaded', () => {
      // Timeline scroll animations using IntersectionObserver
      const timelineItems = document.querySelectorAll('.timeline-item');
      const timelineContainer = document.querySelector('.timeline-container');
      
      const timelineObserver = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.classList.add('active');
                  obs.unobserve(entry.target);
              }
          });
      }, { threshold: 0.15 });

      timelineItems.forEach(item => {
          timelineObserver.observe(item);
      });

      const lineObserver = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  const line = document.querySelector('.timeline-line');
                  if (line) {
                      line.style.height = 'calc(100% - 100px)';
                  }
                  obs.unobserve(entry.target);
              }
          });
      }, { threshold: 0.1 });

      if (timelineContainer) {
          lineObserver.observe(timelineContainer);
      }

      const typewriterSpan = document.querySelector('.typewriter-text');
      const words = ["Successful", "Brighter", "Rewarding", "Prosperous", "Fulfilling"];
      let wordIndex = 0;
      let charIndex = 0;
      let isDeleting = false;
      
      function type() {
          const currentWord = words[wordIndex];
          if (isDeleting) {
              typewriterSpan.textContent = currentWord.substring(0, charIndex - 1);
              charIndex--;
          } else {
              typewriterSpan.textContent = currentWord.substring(0, charIndex + 1);
              charIndex++;
          }
          
          let speed = isDeleting ? 60 : 120;
          
          if (!isDeleting && charIndex === currentWord.length) {
              isDeleting = true;
              speed = 2200; // Wait at full word
          } else if (isDeleting && charIndex === 0) {
              isDeleting = false;
              wordIndex = (wordIndex + 1) % words.length;
              speed = 400; // Wait before starting next word
          }
          
          setTimeout(type, speed);
      }
      
      if (typewriterSpan) {
          type();
      }

      // Count up statistics animation using IntersectionObserver
      const counters = document.querySelectorAll('.counter-val');
      const duration = 1200; // Total count duration in ms
      
      const startCounting = (counter) => {
          const target = parseInt(counter.getAttribute('data-target'));
          const suffix = counter.getAttribute('data-suffix') || '';
          const startTime = performance.now();
          
          const updateCount = (currentTime) => {
              const elapsedTime = currentTime - startTime;
              const progress = Math.min(elapsedTime / duration, 1);
              
              // Easing function outQuad
              const easeProgress = progress * (2 - progress);
              const currentVal = Math.floor(easeProgress * target);
              
              counter.textContent = currentVal + suffix;
              
              if (progress < 1) {
                  requestAnimationFrame(updateCount);
              } else {
                  counter.textContent = target + suffix;
              }
          };
          
          requestAnimationFrame(updateCount);
      };
      
      const observerOptions = {
          root: null,
          threshold: 0.1,
          rootMargin: "0px"
      };
      
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  startCounting(entry.target);
                  observer.unobserve(entry.target);
              }
          });
      }, observerOptions);
      
      counters.forEach(counter => {
          observer.observe(counter);
      });
  });
</script>
@endsection
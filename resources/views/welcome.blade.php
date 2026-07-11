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

  /* ─── Hero Section (Immersive Sky) ─── */
  .hero {
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 100px 0 140px;
    color: #ffffff;
    background: #0b2545; /* Dark fallback background for the blue sky theme */
  }

  /* Sky Background Image */
  .hero-sky-bg {
    position: absolute;
    inset: 0;
    background: url('/images/hero-sky.png') center center / cover no-repeat;
    z-index: 0;
    animation: skyBreathing 20s ease-in-out infinite alternate;
  }

  @keyframes skyBreathing {
    0% { transform: scale(1); filter: brightness(1.0) saturate(1.1); }
    100% { transform: scale(1.03); filter: brightness(1.08) saturate(1.15); }
  }

  /* Minimal overlay — just enough for text contrast, let the real sky show */
  .hero-sky-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      180deg,
      rgba(0, 0, 0, 0.08) 0%,
      rgba(0, 0, 0, 0.0) 50%,
      rgba(0, 0, 0, 0.18) 100%
    );
    z-index: 1;
    pointer-events: none;
  }

  /* Left vignette — dark but not bluish, so the sky colour stays natural */
  .hero-left-vignette {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 18% 50%, rgba(0, 0, 0, 0.42) 0%, transparent 60%);
    z-index: 1;
    pointer-events: none;
  }

  @media (max-width: 991px) {
    .hero-left-vignette {
      background: radial-gradient(circle at 50% 50%, rgba(0, 0, 0, 0.5) 0%, transparent 80%);
    }
  }

  /* Sunlight flare & bloom */
  .sun-bloom {
    position: absolute;
    top: -15%;
    right: 10%;
    width: 650px;
    height: 650px;
    background: radial-gradient(
      circle,
      rgba(255, 255, 255, 0.35) 0%,
      rgba(254, 243, 199, 0.18) 45%,
      rgba(253, 224, 71, 0.03) 75%,
      transparent 100%
    );
    filter: blur(50px);
    z-index: 2;
    pointer-events: none;
    animation: sunPulse 12s ease-in-out infinite alternate;
  }

  @keyframes sunPulse {
    0% { transform: scale(1) translate(0, 0); opacity: 0.7; }
    100% { transform: scale(1.12) translate(15px, -15px); opacity: 0.95; }
  }

  /* Realistic Cloud Drift & Morphing */
  .sky-cloud {
    position: absolute;
    pointer-events: none;
    z-index: 3;
    filter: blur(4px); /* Reduced blur for crisper cloud shapes */
    opacity: 0;
  }

  .sky-cloud svg {
    width: 100%;
    height: 100%;
  }

  /* Different cloud layers at varied heights and speeds (parallax) */
  .sky-cloud-1 {
    width: 650px;
    height: 200px;
    top: 5%;
    left: -700px;
    animation: cloudMorph1 75s linear infinite;
    animation-delay: 0s;
  }
  
  .sky-cloud-2 {
    width: 480px;
    height: 150px;
    top: 28%;
    left: -550px;
    animation: cloudMorph2 60s linear infinite;
    animation-delay: -20s;
  }
  
  .sky-cloud-3 {
    width: 580px;
    height: 180px;
    top: 52%;
    left: -650px;
    animation: cloudMorph3 90s linear infinite;
    animation-delay: -45s;
  }
  
  .sky-cloud-4 {
    width: 420px;
    height: 130px;
    top: 70%;
    left: -500px;
    animation: cloudMorph1 70s linear infinite;
    animation-delay: -10s;
  }

  /* Realistic drift animations featuring minor size changes, opacity shifts and slow vertical drafts */
  @keyframes cloudMorph1 {
    0% { transform: translate(0, 0) scale(0.95); opacity: 0; }
    8% { opacity: 0.75; }
    45% { transform: translate(calc(50vw + 350px), 18px) scale(1.05); opacity: 0.88; }
    92% { opacity: 0.75; }
    100% { transform: translate(calc(100vw + 750px), -8px) scale(0.95); opacity: 0; }
  }

  @keyframes cloudMorph2 {
    0% { transform: translate(0, 0) scale(1.05); opacity: 0; }
    10% { opacity: 0.65; }
    50% { transform: translate(calc(50vw + 300px), -25px) scale(0.95); opacity: 0.78; }
    90% { opacity: 0.65; }
    100% { transform: translate(calc(100vw + 600px), 15px) scale(1.05); opacity: 0; }
  }

  @keyframes cloudMorph3 {
    0% { transform: translate(0, 0) scale(0.9); opacity: 0; }
    12% { opacity: 0.55; }
    48% { transform: translate(calc(50vw + 350px), 30px) scale(1.1); opacity: 0.70; }
    88% { opacity: 0.55; }
    100% { transform: translate(calc(100vw + 700px), -18px) scale(0.9); opacity: 0; }
  }

  /* Horizon light bloom */
  .horizon-glow {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 35%;
    background: linear-gradient(
      0deg,
      rgba(255, 255, 255, 0.15) 0%,
      rgba(254, 243, 199, 0.05) 40%,
      transparent 100%
    );
    z-index: 2;
    pointer-events: none;
    animation: horizonPulse 10s ease-in-out infinite alternate;
  }

  @keyframes horizonPulse {
    0% { opacity: 0.7; }
    100% { opacity: 1; }
  }

  .hero-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    align-items: center;
    position: relative;
    z-index: 5;
  }

  /* Left Side Hero Content */
  .hero-left {
    text-align: left;
  }

  .hero-slogan {
    font-family: 'Sora', sans-serif;
    color: #fbbf24; /* Vibrant yellow/gold */
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    text-shadow: 0 2px 12px rgba(15, 23, 42, 0.65);
  }

  .hero-slogan::after {
    content: '';
    display: inline-block;
    width: 40px;
    height: 2px;
    background: #fbbf24;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(15, 23, 42, 0.55); /* Darker glassmorphism */
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 99px;
    backdrop-filter: blur(12px);
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.3);
    margin-bottom: 24px;
    transition: all 0.3s ease;
  }

  .hero-badge:hover {
    background: rgba(15, 23, 42, 0.7);
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
    text-shadow: 0 2px 15px rgba(15, 23, 42, 0.65);
  }

  .hero h1 span.highlight {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); /* Gorgeous gold gradient for contrast */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .typewriter-container {
    display: inline-block;
    position: relative;
    color: #fbbf24;
    border-right: 3px solid #fbbf24;
    padding-right: 4px;
    animation: blinkCursor 0.75s step-end infinite;
    text-shadow: 0 2px 10px rgba(15, 23, 42, 0.5);
  }

  @keyframes blinkCursor {
    from, to { border-color: transparent }
    50% { border-color: #fbbf24; }
  }

  .hero p {
    font-size: clamp(16px, 1.8vw, 18px);
    color: #ffffff; /* crisp white for legibility */
    max-width: 580px;
    margin-bottom: 36px;
    line-height: 1.7;
    text-shadow: 0 2px 12px rgba(15, 23, 42, 0.7);
    font-weight: 500;
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
    background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
    padding: 14px 30px;
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 24px rgba(15, 23, 42, 0.4), 0 0 60px rgba(37, 99, 235, 0.25);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
  }

  .btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(37, 99, 235, 0.6), 0 0 80px rgba(37, 99, 235, 0.3);
  }

  .btn-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    background: rgba(15, 23, 42, 0.35); /* Darker glassmorphism background */
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    padding: 13px 29px;
    border-radius: var(--radius-lg);
    backdrop-filter: blur(12px);
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .btn-hero-outline:hover {
    background: rgba(15, 23, 42, 0.5);
    border-color: rgba(255, 255, 255, 0.45);
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
    filter: drop-shadow(0 15px 40px rgba(0, 0, 0, 0.4));
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
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
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
    opacity: 0.35;
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
    z-index: 5;
  }

  .wave-divider svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 50px;
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
    background: rgba(15, 23, 42, 0.55); /* Slate-dark glassmorphism backdrop */
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-lg);
    padding: 16px 24px;
    min-width: 120px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);
    transition: all 0.3s ease;
  }

  .hero-stat-card:hover {
    background: rgba(15, 23, 42, 0.7);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
  }

  .hero-stat-card strong {
    display: block;
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #38bdf8; /* Brighter accent sky blue */
    margin-bottom: 2px;
    text-shadow: 0 2px 8px rgba(15, 23, 42, 0.4);
  }

  .hero-stat-card > span {
    font-size: 13px;
    color: #e2e8f0; /* Clear slate white text */
    font-weight: 500;
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

  /* ─── Career Info Modal Styles ─── */
  .career-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    visibility: hidden;
    pointer-events: none;
    transition: visibility 0.55s;
  }

  .career-modal.active {
    visibility: visible;
    pointer-events: auto;
  }

  .career-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    opacity: 0;
    transition: opacity 0.55s ease;
  }

  .career-modal.active .career-modal-backdrop {
    opacity: 1;
  }

  .career-modal-content {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.15);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 24px;
    width: 100%;
    max-width: 500px;
    padding: 32px;
    position: relative;
    z-index: 10001;
    transform: scale(0.2);
    opacity: 0;
    transition: transform 0.55s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.55s ease;
  }

  .career-modal.active .career-modal-content {
    transform: scale(1);
    opacity: 1;
  }

  .career-modal-close {
    position: absolute;
    top: 24px;
    right: 24px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f5f9;
    border: none;
    color: var(--text-2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .career-modal-close:hover {
    background: #e2e8f0;
    color: var(--text-1);
    transform: rotate(90deg);
  }

  .career-modal-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 20px;
  }

  .modal-icon-wrap {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #fff;
  }

  #modalTitle {
    font-family: 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: var(--text-1);
    margin: 0;
  }

  .modal-category {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 4px;
    display: block;
  }

  .career-modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-height: 350px;
    overflow-y: auto;
    padding-right: 8px;
    text-align: left;
  }

  /* Custom scrollbar for modal body */
  .career-modal-body::-webkit-scrollbar { width: 5px; }
  .career-modal-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

  .modal-section h5 {
    font-family: 'Sora', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-2);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .modal-section h5 i {
    color: var(--brand);
  }

  .modal-section p {
    font-size: 14px;
    color: var(--text-1);
    line-height: 1.5;
  }

  .career-modal-footer {
    margin-top: 28px;
    border-top: 1px solid #f1f5f9;
    padding-top: 20px;
    text-align: center;
  }

  .modal-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--brand);
    color: #fff;
    font-weight: 700;
    font-size: 14.5px;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.25s;
    box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);
  }

  .modal-action-btn:hover {
    background: var(--brand-dark);
    box-shadow: 0 6px 20px rgba(26, 86, 219, 0.35);
    transform: translateY(-2px);
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
    }

    .hero-left {
      text-align: center;
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
      min-height: auto;
    }

    .hero-right {
      display: none;
    }

    .sky-cloud {
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
      min-height: auto;
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

    .shooting-star {
      display: none;
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
  /* ═══════════════════════════════════════════════════════════
     INAUGURATION — GRAND RIBBON + THEATRE CURTAINS
     ═══════════════════════════════════════════════════════════ */

  /* ─── Main Overlay ─── */
  #inaug-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
  }
  #inaug-overlay.visible { display: block; opacity: 1; }
  #inaug-overlay.fade-out { opacity: 0; pointer-events: none; }

  /* ─── THEATRE CURTAINS ─── */
  .theatre-curtain {
    position: fixed;
    top: 0;
    width: 52%;
    height: 100%;
    z-index: 99998;
    transition: transform 2s cubic-bezier(0.7, 0, 0.3, 1);
    overflow: hidden;
  }
  .curtain-left { left: 0; transform: translateX(0); }
  .curtain-right { right: 0; transform: translateX(0); }
  .curtain-left.open { transform: translateX(-105%); }
  .curtain-right.open { transform: translateX(105%); }

  /* Velvet fabric */
  .curtain-fabric {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      90deg,
      #2d0a0a 0%, #5c1515 8%, #8b1a1a 18%, #a01c1c 28%,
      #7a1616 38%, #9a1b1b 48%, #b02020 55%, #8b1a1a 62%,
      #6d1313 72%, #9a1b1b 82%, #5c1515 92%, #2d0a0a 100%
    );
  }
  .curtain-right .curtain-fabric {
    background: linear-gradient(
      90deg,
      #2d0a0a 0%, #5c1515 8%, #9a1b1b 18%, #6d1313 28%,
      #8b1a1a 38%, #b02020 48%, #9a1b1b 55%, #7a1616 62%,
      #a01c1c 72%, #8b1a1a 82%, #5c1515 92%, #2d0a0a 100%
    );
  }

  /* Vertical fold lines */
  .curtain-folds {
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
      90deg,
      transparent 0px,
      rgba(0,0,0,0.08) 30px,
      transparent 60px,
      rgba(255,255,255,0.03) 80px,
      transparent 120px
    );
    pointer-events: none;
  }

  /* Velvet sheen */
  .curtain-sheen {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      180deg,
      rgba(255, 200, 150, 0.06) 0%,
      transparent 30%,
      transparent 70%,
      rgba(0, 0, 0, 0.15) 100%
    );
    pointer-events: none;
  }

  /* Gold fringe at the inner edge */
  .curtain-fringe {
    position: absolute;
    top: 0;
    width: 18px;
    height: 100%;
    z-index: 2;
  }
  .curtain-left .curtain-fringe {
    right: 0;
    background: linear-gradient(180deg,
      #d4a520 0%, #ffd700 4%, #b8860b 8%, #ffd700 12%,
      #d4a520 16%, #b8860b 20%, #ffd700 24%, #d4a520 28%
    );
    background-size: 100% 40px;
    box-shadow: 2px 0 12px rgba(212, 165, 32, 0.4);
  }
  .curtain-right .curtain-fringe {
    left: 0;
    background: linear-gradient(180deg,
      #d4a520 0%, #ffd700 4%, #b8860b 8%, #ffd700 12%,
      #d4a520 16%, #b8860b 20%, #ffd700 24%, #d4a520 28%
    );
    background-size: 100% 40px;
    box-shadow: -2px 0 12px rgba(212, 165, 32, 0.4);
  }

  /* Gold valance/pelmet at the top */
  .curtain-valance {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 60px;
    z-index: 100001;
    background: linear-gradient(180deg,
      #3a0f0f 0%, #6b1a1a 30%, #8b1a1a 60%, #5c1212 100%
    );
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.6);
    transition: opacity 1.5s ease 1.5s;
  }
  .curtain-valance.hide { opacity: 0; pointer-events: none; }
  .curtain-valance::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 12px;
    background: linear-gradient(90deg,
      #b8860b 0%, #ffd700 10%, #d4a520 25%, #ffd700 40%,
      #b8860b 50%, #ffd700 60%, #d4a520 75%, #ffd700 90%, #b8860b 100%
    );
    box-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
  }

  /* Sparkle canvas */
  .sparkle-canvas {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 0;
  }

  /* ─── Content Layer (text + ribbon) ─── */
  .inaug-content {
    position: fixed;
    inset: 0;
    z-index: 100000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    pointer-events: none;
  }

  .inaug-top-label {
    text-align: center;
    margin-bottom: 60px;
    animation: inaugFadeInDown 1s ease-out 0.3s both;
  }
  .inaug-top-label .inaug-subtitle {
    font-family: 'Sora', sans-serif;
    font-size: clamp(12px, 3vw, 18px);
    font-weight: 700;
    letter-spacing: 0.4em;
    text-transform: uppercase;
    color: #ffd700;
    margin-bottom: 16px;
    display: block;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8), 0 0 20px rgba(255, 215, 0, 0.5);
  }
  .inaug-top-label .inaug-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(48px, 10vw, 90px);
    font-weight: 800;
    color: #ffd700; /* Solid gold color */
    line-height: 1.1;
    text-shadow: 
      0 4px 15px rgba(0, 0, 0, 0.8), 
      0 0 30px rgba(255, 215, 0, 0.6),
      0 0 10px rgba(255, 255, 255, 0.3);
  }

  @keyframes inaugFadeInDown {
    from { opacity: 0; transform: translateY(-40px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ─── THE GRAND RIBBON ─── */
  .ribbon-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    position: relative;
    /* Removed perspective to avoid 3D rendering bugs in some browsers */
  }

  .ribbon-band {
    width: 110%;
    height: clamp(100px, 15vw, 160px); /* Massive big ribbon */
    position: relative;
    box-shadow:
      0 0 50px rgba(239, 68, 68, 0.4),
      0 15px 40px rgba(0, 0, 0, 0.6);
    animation: inaugRibbonIn 1.2s ease-out 0.6s both;
    z-index: 5;
    cursor: url('/images/scissors.svg') 16 16, pointer;
  }

  .ribbon-band-inner {
    position: absolute;
    inset: 0;
    overflow: hidden;
  }

  @keyframes inaugRibbonIn {
    from { opacity: 0; transform: scaleX(0); }
    to { opacity: 1; transform: scaleX(1); }
  }

  /* Rich satin RED ribbon gradient */
  .ribbon-fabric {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      180deg,
      #fca5a5 0%,
      #ef4444 10%,
      #dc2626 25%,
      #991b1b 50%,
      #dc2626 75%,
      #ef4444 90%,
      #fca5a5 100%
    );
  }

  /* Satin light streaks */
  .ribbon-satin {
    position: absolute;
    inset: 0;
    background:
      linear-gradient(180deg,
        rgba(255,255,255,0.4) 0%,
        transparent 15%,
        transparent 40%,
        rgba(255,255,255,0.15) 50%,
        transparent 60%,
        transparent 85%,
        rgba(255,255,255,0.25) 100%
      );
    pointer-events: none;
  }

  /* Moving shimmer */
  .ribbon-shimmer {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      110deg,
      transparent 0%, transparent 25%,
      rgba(255,255,255,0.3) 40%,
      rgba(255,255,255,0.8) 50%,
      rgba(255,255,255,0.3) 60%,
      transparent 75%, transparent 100%
    );
    background-size: 200% 100%;
    animation: shimmerSlide 2.5s ease-in-out infinite;
  }

  @keyframes shimmerSlide {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }

  /* Ribbon text */
  .ribbon-text {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-size: clamp(20px, 5vw, 36px);
    font-weight: 800;
    color: #ffd700; /* Gold text on red ribbon */
    letter-spacing: 0.25em;
    text-transform: uppercase;
    text-shadow: 0 3px 12px rgba(0,0,0,0.6), 0 0 40px rgba(255,215,0,0.4);
    z-index: 1;
  }

  @media (max-width: 600px) {
    .ribbon-band { width: 110%; }
  }

  /* ─── Ribbon Cut Animation ─── */
  .ribbon-cut-wrap {
    width: 110%;
    height: clamp(100px, 15vw, 160px);
    position: relative;
    display: none;
    z-index: 5;
  }
  .ribbon-cut-wrap.active { display: block; }

  .cut-half {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    overflow: hidden;
  }
  .cut-half-left { left: 0; transform-origin: left center; animation: cutFallLeft 1.8s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
  .cut-half-right { right: 0; transform-origin: right center; animation: cutFallRight 1.8s cubic-bezier(0.4, 0, 0.2, 1) forwards; }

  .cut-half-inner {
    position: absolute;
    top: 0;
    width: 200%;
    height: 100%;
    background: linear-gradient(
      180deg,
      #fca5a5 0%, #ef4444 10%, #dc2626 25%, #991b1b 50%, #dc2626 75%, #ef4444 90%, #fca5a5 100%
    );
  }
  .cut-half-left .cut-half-inner { left: 0; }
  .cut-half-right .cut-half-inner { right: 0; }

  @keyframes cutFallLeft {
    0% { transform: rotate(0deg) translateY(0); opacity: 1; }
    25% { transform: rotate(-6deg) translateY(15px); }
    100% { transform: rotate(-50deg) translateY(400px); opacity: 0; }
  }
  @keyframes cutFallRight {
    0% { transform: rotate(0deg) translateY(0); opacity: 1; }
    25% { transform: rotate(6deg) translateY(15px); }
    100% { transform: rotate(50deg) translateY(400px); opacity: 0; }
  }

  /* Scissors */
  .scissors-flash {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    font-size: clamp(60px, 12vw, 100px);
    z-index: 10;
    display: none;
    filter: drop-shadow(0 0 30px rgba(255,255,255,0.9));
  }
  .scissors-flash.active {
    display: block;
    animation: scissorsFlash 0.7s ease-out forwards;
  }

  @keyframes scissorsFlash {
    0% { transform: translate(-50%, -50%) scale(0.3) rotate(-45deg); opacity: 1; }
    40% { transform: translate(-50%, -50%) scale(1.6) rotate(0deg); opacity: 1; }
    100% { transform: translate(-50%, -50%) scale(2.5) rotate(20deg); opacity: 0; }
  }

  /* Bottom Label */
  .inaug-bottom-label {
    margin-top: 50px;
    text-align: center;
    animation: inaugFadeInDown 1s ease-out 0.9s both;
  }
  .inaug-bottom-label p {
    font-family: 'DM Sans', sans-serif;
    font-size: clamp(14px, 2.5vw, 20px);
    color: rgba(255,255,255,0.65);
    font-weight: 400;
    letter-spacing: 0.08em;
  }

  /* Confetti Canvas */
  #confetti-canvas {
    position: fixed;
    inset: 0;
    z-index: 100002;
    pointer-events: none;
    display: none;
  }

  @media (max-width: 600px) {
    .ribbon-band, .ribbon-cut-wrap { height: 70px; }
    .ribbon-bow { width: 50px; height: 50px; font-size: 24px; }
    .inaug-top-label { margin-bottom: 30px; }
    .inaug-bottom-label { margin-top: 30px; }
    .curtain-fringe { width: 10px; }
    .curtain-valance { height: 40px; }
  }
</style>
@endsection

@section('content')

<!-- ─── Hero Section ─── -->
<section class="hero">
  <!-- Sky Background Image -->
  <div class="hero-sky-bg"></div>
  <div class="hero-sky-overlay"></div>
  <div class="hero-left-vignette"></div>

  <!-- Sun Bloom Flare -->
  <div class="sun-bloom"></div>

  <!-- Volumetric Shifting SVG Clouds -->
  <div class="sky-cloud sky-cloud-1">
    <svg viewBox="0 0 650 200" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="cloudGrad1" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stop-color="#ffffff" stop-opacity="0.98"/>
          <stop offset="50%" stop-color="#f8fafc" stop-opacity="0.92"/>
          <stop offset="85%" stop-color="#e2e8f0" stop-opacity="0.6"/>
          <stop offset="100%" stop-color="#e2e8f0" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <ellipse cx="325" cy="100" rx="280" ry="60" fill="url(#cloudGrad1)" />
      <ellipse cx="230" cy="80" rx="180" ry="50" fill="url(#cloudGrad1)" />
      <ellipse cx="420" cy="90" rx="190" ry="55" fill="url(#cloudGrad1)" />
      <ellipse cx="150" cy="110" rx="120" ry="40" fill="url(#cloudGrad1)" />
      <ellipse cx="490" cy="105" rx="130" ry="40" fill="url(#cloudGrad1)" />
    </svg>
  </div>
  <div class="sky-cloud sky-cloud-2">
    <svg viewBox="0 0 480 150" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="cloudGrad2" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stop-color="#ffffff" stop-opacity="0.98"/>
          <stop offset="50%" stop-color="#f8fafc" stop-opacity="0.9"/>
          <stop offset="85%" stop-color="#cbd5e1" stop-opacity="0.5"/>
          <stop offset="100%" stop-color="#cbd5e1" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <ellipse cx="240" cy="75" rx="200" ry="45" fill="url(#cloudGrad2)" />
      <ellipse cx="170" cy="60" rx="140" ry="38" fill="url(#cloudGrad2)" />
      <ellipse cx="310" cy="65" rx="130" ry="40" fill="url(#cloudGrad2)" />
    </svg>
  </div>
  <div class="sky-cloud sky-cloud-3">
    <svg viewBox="0 0 580 180" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="cloudGrad3" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stop-color="#ffffff" stop-opacity="0.98"/>
          <stop offset="50%" stop-color="#f1f5f9" stop-opacity="0.92"/>
          <stop offset="85%" stop-color="#cbd5e1" stop-opacity="0.55"/>
          <stop offset="100%" stop-color="#cbd5e1" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <ellipse cx="290" cy="90" rx="250" ry="55" fill="url(#cloudGrad3)" />
      <ellipse cx="200" cy="70" rx="160" ry="45" fill="url(#cloudGrad3)" />
      <ellipse cx="370" cy="80" rx="170" ry="50" fill="url(#cloudGrad3)" />
      <ellipse cx="120" cy="100" rx="100" ry="35" fill="url(#cloudGrad3)" />
    </svg>
  </div>
  <div class="sky-cloud sky-cloud-4">
    <svg viewBox="0 0 420 130" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="cloudGrad4" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stop-color="#ffffff" stop-opacity="0.98"/>
          <stop offset="50%" stop-color="#f8fafc" stop-opacity="0.9"/>
          <stop offset="85%" stop-color="#cbd5e1" stop-opacity="0.5"/>
          <stop offset="100%" stop-color="#cbd5e1" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <ellipse cx="210" cy="65" rx="180" ry="40" fill="url(#cloudGrad4)" />
      <ellipse cx="150" cy="55" rx="120" ry="32" fill="url(#cloudGrad4)" />
    </svg>
  </div>

  <!-- Horizon Glow -->
  <div class="horizon-glow"></div>

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
          <circle cx="200" cy="200" r="150" stroke="#0f172a" stroke-width="1.5" stroke-dasharray="8 8"/>
          <circle cx="200" cy="200" r="190" stroke="#0f172a" stroke-width="1" stroke-dasharray="4 6"/>
        </svg>

        <div class="hero-illustration-container">
          <!-- Central student SVG drawing -->
          <svg class="main-student-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Cap -->
            <path d="M100 20 L160 50 L100 80 L40 50 Z" fill="#0f172a" fill-opacity="0.8" stroke="#0f172a" stroke-width="3"/>
            <path d="M100 80 L100 130 C100 145, 120 145, 120 130" stroke="#0f172a" stroke-width="3" stroke-linecap="round"/>
            <path d="M160 50 L160 100 C160 105, 163 110, 168 110" stroke="#d97706" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="168" cy="110" r="4" fill="#d97706"/>
            <!-- Head -->
            <circle cx="100" cy="110" r="30" fill="#1e293b" stroke="#0f172a" stroke-width="3"/>
            <!-- Body -->
            <path d="M50 180 C50 150, 75 140, 100 140 C125 140, 150 150, 150 180" fill="#0f172a" fill-opacity="0.75" stroke="#0f172a" stroke-width="3" stroke-linejoin="round"/>
            <!-- Lightbulb above -->
            <path d="M100 95 L100 100" stroke="#d97706" stroke-width="3" stroke-linecap="round"/>
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
      <div class="marquee-card" 
           data-title="Software Engineer" 
           data-category="Technology" 
           data-icon="fa-solid fa-laptop-code" 
           data-color="linear-gradient(135deg, #3b82f6, #1d4ed8)" 
           data-description="Designs, develops, tests, and maintains software systems, applications, and mobile apps."
           data-skills="Java, Python, Javascript, SQL, Algorithms, Git, System Design"
           data-pathway="BE/B.Tech in Computer Science, BCA, MCA, or certified coding bootcamps."
           data-companies="Google, Microsoft, Amazon, Meta, TCS, Infosys, Tech Startups.">
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
      <div class="marquee-card" 
           data-title="General Physician" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-stethoscope" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Diagnoses, treats, and manages acute and chronic illnesses, providing primary care and healthcare education."
           data-skills="Medical Diagnosis, Patient Care, Pharmacology, Empathy, Communication"
           data-pathway="MBBS Degree (5.5 years) + Compulsory Internship + State Medical Council registration."
           data-companies="Apollo Hospitals, Fortis Healthcare, Max Hospitals, Private Clinics, Gov Hospitals.">
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
      <div class="marquee-card" 
           data-title="Financial Analyst" 
           data-category="Finance" 
           data-icon="fa-solid fa-chart-line" 
           data-color="linear-gradient(135deg, #f59e0b, #d97706)" 
           data-description="Analyzes financial data, evaluates investment opportunities, and assists businesses in strategic financial planning."
           data-skills="Financial Modeling, Excel, Valuation, Market Research, Accounting, SQL"
           data-pathway="B.Com, BBA (Finance), MBA (Finance), or professional certifications like CFA or CA."
           data-companies="Goldman Sachs, JPMorgan Chase, HDFC Bank, Deloitte, EY, KPMG, PwC.">
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
      <div class="marquee-card" 
           data-title="UX/UI Designer" 
           data-category="Creative Arts" 
           data-icon="fa-solid fa-bezier-curve" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Creates user-centered interfaces and experiences for digital products like websites, software, and mobile apps."
           data-skills="Figma, Wireframing, User Research, Prototyping, Visual Design, Usability Testing"
           data-pathway="B.Des (Design), Graphic Design courses, or UX/UI Bootcamps with a strong portfolio."
           data-companies="Adobe, Flipkart, Zomato, Razorpay, Tech Startups, Design Agencies.">
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
      <div class="marquee-card" 
           data-title="Corporate Lawyer" 
           data-category="Legal" 
           data-icon="fa-solid fa-scale-balanced" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Ensures the legality of commercial transactions, advising corporations on their legal rights and duties."
           data-skills="Corporate Law, Contract Drafting, Legal Writing, Negotiation, Analytical Thinking"
           data-pathway="Integrated LLB (5 years) or LLB (3 years) after graduation + passing the Bar Council Exam (AIBE)."
           data-companies="Shardul Amarchand Mangaldas, Khaitan & Co, AZB & Partners, In-house Legal Teams.">
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
      <div class="marquee-card" 
           data-title="Digital Marketer" 
           data-category="Business" 
           data-icon="fa-solid fa-bullhorn" 
           data-color="linear-gradient(135deg, #10b981, #059669)" 
           data-description="Drives brand awareness and lead generation through digital channels like search engines, social media, and email."
           data-skills="SEO, SEM, Content Strategy, Google Analytics, Social Media Management"
           data-pathway="Any Bachelor's degree + Digital Marketing Certifications + Hands-on project portfolio."
           data-companies="Dentsu, Ogilvy, GroupM, Nykaa, eCommerce Brands, Marketing Agencies.">
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
      <div class="marquee-card" 
           data-title="Software Engineer" 
           data-category="Technology" 
           data-icon="fa-solid fa-laptop-code" 
           data-color="linear-gradient(135deg, #3b82f6, #1d4ed8)" 
           data-description="Designs, develops, tests, and maintains software systems, applications, and mobile apps."
           data-skills="Java, Python, Javascript, SQL, Algorithms, Git, System Design"
           data-pathway="BE/B.Tech in Computer Science, BCA, MCA, or certified coding bootcamps."
           data-companies="Google, Microsoft, Amazon, Meta, TCS, Infosys, Tech Startups.">
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
      <div class="marquee-card" 
           data-title="General Physician" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-stethoscope" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Diagnoses, treats, and manages acute and chronic illnesses, providing primary care and healthcare education."
           data-skills="Medical Diagnosis, Patient Care, Pharmacology, Empathy, Communication"
           data-pathway="MBBS Degree (5.5 years) + Compulsory Internship + State Medical Council registration."
           data-companies="Apollo Hospitals, Fortis Healthcare, Max Hospitals, Private Clinics, Gov Hospitals.">
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
      <div class="marquee-card" 
           data-title="Financial Analyst" 
           data-category="Finance" 
           data-icon="fa-solid fa-chart-line" 
           data-color="linear-gradient(135deg, #f59e0b, #d97706)" 
           data-description="Analyzes financial data, evaluates investment opportunities, and assists businesses in strategic financial planning."
           data-skills="Financial Modeling, Excel, Valuation, Market Research, Accounting, SQL"
           data-pathway="B.Com, BBA (Finance), MBA (Finance), or professional certifications like CFA or CA."
           data-companies="Goldman Sachs, JPMorgan Chase, HDFC Bank, Deloitte, EY, KPMG, PwC.">
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
      <div class="marquee-card" 
           data-title="UX/UI Designer" 
           data-category="Creative Arts" 
           data-icon="fa-solid fa-bezier-curve" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Creates user-centered interfaces and experiences for digital products like websites, software, and mobile apps."
           data-skills="Figma, Wireframing, User Research, Prototyping, Visual Design, Usability Testing"
           data-pathway="B.Des (Design), Graphic Design courses, or UX/UI Bootcamps with a strong portfolio."
           data-companies="Adobe, Flipkart, Zomato, Razorpay, Tech Startups, Design Agencies.">
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
      <div class="marquee-card" 
           data-title="Corporate Lawyer" 
           data-category="Legal" 
           data-icon="fa-solid fa-scale-balanced" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Ensures the legality of commercial transactions, advising corporations on their legal rights and duties."
           data-skills="Corporate Law, Contract Drafting, Legal Writing, Negotiation, Analytical Thinking"
           data-pathway="Integrated LLB (5 years) or LLB (3 years) after graduation + passing the Bar Council Exam (AIBE)."
           data-companies="Shardul Amarchand Mangaldas, Khaitan & Co, AZB & Partners, In-house Legal Teams.">
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
      <div class="marquee-card" 
           data-title="Digital Marketer" 
           data-category="Business" 
           data-icon="fa-solid fa-bullhorn" 
           data-color="linear-gradient(135deg, #10b981, #059669)" 
           data-description="Drives brand awareness and lead generation through digital channels like search engines, social media, and email."
           data-skills="SEO, SEM, Content Strategy, Google Analytics, Social Media Management"
           data-pathway="Any Bachelor's degree + Digital Marketing Certifications + Hands-on project portfolio."
           data-companies="Dentsu, Ogilvy, GroupM, Nykaa, eCommerce Brands, Marketing Agencies.">
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

<!-- Career Info Modal -->
<div id="careerInfoModal" class="career-modal">
  <div class="career-modal-backdrop"></div>
  <div class="career-modal-content">
    <button class="career-modal-close"><i class="fa-solid fa-xmark"></i></button>
    <div class="career-modal-header">
      <div id="modalIconWrap" class="modal-icon-wrap"><i class="fa-solid fa-graduation-cap"></i></div>
      <div>
        <h3 id="modalTitle">Career Title</h3>
        <span id="modalCategory" class="modal-category">Category</span>
      </div>
    </div>
    <div class="career-modal-body">
      <div class="modal-section">
        <h5><i class="fa-solid fa-circle-info"></i> Overview</h5>
        <p id="modalDescription">Career description...</p>
      </div>
      <div class="modal-section">
        <h5><i class="fa-solid fa-gears"></i> Key Skills Required</h5>
        <p id="modalSkills">Skills...</p>
      </div>
      <div class="modal-section">
        <h5><i class="fa-solid fa-graduation-cap"></i> Educational Pathway</h5>
        <p id="modalPath">Path...</p>
      </div>
      <div class="modal-section">
        <h5><i class="fa-solid fa-building"></i> Top Recruiters</h5>
        <p id="modalCompanies">Companies...</p>
      </div>
    </div>
    <div class="career-modal-footer">
      <a href="{{ route('explore.index') }}" class="modal-action-btn">Explore Career Pathways <i class="fa-solid fa-arrow-right-long"></i></a>
    </div>
  </div>
</div>

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

            <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number">
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
      // ─── Generate Twinkling Stars ───
      const starsCanvas = document.getElementById('starsCanvas');
      if (starsCanvas) {
          const starCount = 80;
          for (let i = 0; i < starCount; i++) {
              const star = document.createElement('div');
              star.classList.add('star');
              star.style.left = Math.random() * 100 + '%';
              star.style.top = Math.random() * 70 + '%'; // mostly upper sky
              const size = Math.random() * 2.5 + 0.5;
              star.style.width = size + 'px';
              star.style.height = size + 'px';
              star.style.setProperty('--twinkle-dur', (Math.random() * 4 + 2) + 's');
              star.style.setProperty('--twinkle-delay', (Math.random() * 5) + 's');
              starsCanvas.appendChild(star);
          }
      }

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

      // ─── Career Detail Marquee Card Popup Modal Logic ───
      let hoverTimeout;
      const modal = document.getElementById('careerInfoModal');
      const backdrop = modal.querySelector('.career-modal-backdrop');
      const closeBtn = modal.querySelector('.career-modal-close');

      const closeModal = () => {
          modal.classList.remove('active');
      };

      closeBtn.addEventListener('click', closeModal);
      backdrop.addEventListener('click', closeModal);
      document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') closeModal();
      });

      document.querySelectorAll('.marquee-card').forEach(card => {
          const showModal = () => {
              const title = card.getAttribute('data-title');
              const category = card.getAttribute('data-category');
              const description = card.getAttribute('data-description');
              const skills = card.getAttribute('data-skills');
              const pathway = card.getAttribute('data-pathway');
              const companies = card.getAttribute('data-companies');
              const icon = card.getAttribute('data-icon');
              const color = card.getAttribute('data-color');

              document.getElementById('modalTitle').textContent = title;
              document.getElementById('modalCategory').textContent = category;
              document.getElementById('modalDescription').textContent = description;
              document.getElementById('modalSkills').textContent = skills;
              document.getElementById('modalPath').textContent = pathway;
              document.getElementById('modalCompanies').textContent = companies;
              
              const iconWrap = document.getElementById('modalIconWrap');
              iconWrap.style.background = color;
              iconWrap.innerHTML = `<i class="${icon}"></i>`;

              // Calculate card center coordinates to set the scaling origin
              const cardRect = card.getBoundingClientRect();
              const cardCenterX = cardRect.left + cardRect.width / 2;
              const cardCenterY = cardRect.top + cardRect.height / 2;
              
              const modalContent = modal.querySelector('.career-modal-content');
              const modalRect = modalContent.getBoundingClientRect();
              
              const originX = cardCenterX - modalRect.left;
              const originY = cardCenterY - modalRect.top;
              
              modalContent.style.transformOrigin = `${originX}px ${originY}px`;

              modal.classList.add('active');
          };

          card.addEventListener('click', (e) => {
              clearTimeout(hoverTimeout);
              showModal();
          });

          card.addEventListener('mouseenter', () => {
              // Open on hover if they stay on the card for at least 500ms (intentional hover)
              hoverTimeout = setTimeout(showModal, 500);
          });

          card.addEventListener('mouseleave', () => {
              clearTimeout(hoverTimeout);
          });
      });
  });
</script>
<!-- ═══ INAUGURATION: THEATRE CURTAINS + GRAND RIBBON ═══ -->

<!-- Left Curtain -->
<div class="theatre-curtain curtain-left" id="curtainLeft">
  <div class="curtain-fabric"></div>
  <div class="curtain-folds"></div>
  <div class="curtain-sheen"></div>
  <div class="curtain-fringe"></div>
</div>

<!-- Right Curtain -->
<div class="theatre-curtain curtain-right" id="curtainRight">
  <div class="curtain-fabric"></div>
  <div class="curtain-folds"></div>
  <div class="curtain-sheen"></div>
  <div class="curtain-fringe"></div>
</div>

<!-- Gold Valance -->
<div class="curtain-valance" id="curtainValance"></div>

<!-- Dark backdrop behind curtains -->
<div id="inaug-overlay">
  <canvas class="sparkle-canvas" id="sparkleCanvas"></canvas>
</div>

<!-- Content layer: text + ribbon -->
<div class="inaug-content" id="inaugContent">
  <div class="inaug-top-label">
    <span class="inaug-subtitle">✦ Welcome to the Grand Opening ✦</span>
    <div class="inaug-title">CareerGyan</div>
  </div>

  <div class="ribbon-container" id="ribbonMain">
    <div class="ribbon-band">
      <div class="ribbon-band-inner">
        <div class="ribbon-fabric"></div>
        <div class="ribbon-satin"></div>
        <div class="ribbon-shimmer"></div>
        <div class="ribbon-text">✦ GRAND INAUGURATION ✦</div>
      </div>
    </div>
  </div>

  <div class="ribbon-container" id="ribbonCut" style="display:none;">
    <div class="ribbon-cut-wrap active">
      <div class="cut-half cut-half-left">
        <div class="ribbon-band-inner">
          <div class="cut-half-inner"></div>
        </div>
      </div>
      <div class="cut-half cut-half-right">
        <div class="ribbon-band-inner">
          <div class="cut-half-inner"></div>
        </div>
      </div>
    </div>
    <div class="scissors-flash" id="scissorsFlash">✂️</div>
  </div>

  <div class="inaug-bottom-label">
    <p>Indian Institute of Career Management</p>
  </div>
</div>

<canvas id="confetti-canvas"></canvas>

<script>
(function() {
  'use strict';

  const overlay = document.getElementById('inaug-overlay');
  const inaugContent = document.getElementById('inaugContent');
  const ribbonMain = document.getElementById('ribbonMain');
  const ribbonCut = document.getElementById('ribbonCut');
  const scissorsFlash = document.getElementById('scissorsFlash');
  const confettiCanvas = document.getElementById('confetti-canvas');
  const sparkleCanvas = document.getElementById('sparkleCanvas');
  const curtainLeft = document.getElementById('curtainLeft');
  const curtainRight = document.getElementById('curtainRight');
  const curtainValance = document.getElementById('curtainValance');

  let currentState = 'ribbon_hidden';
  let hasPlayedCut = false;
  let pollingInterval = null;

  // Add click listener for visitors to cut the ribbon
  ribbonMain.addEventListener('click', () => {
    if (currentState === 'ribbon_visible') {
      // Optimistically play the cut animation locally
      handleState('ribbon_cut');
      
      // Notify the server so everyone else sees it cut too
      fetch('/api/inauguration/cut', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      }).catch(err => console.error('Failed to cut globally:', err));
    }
  });

  // Initially hide all inauguration elements
  function hideAll() {
    overlay.style.display = 'none';
    overlay.classList.remove('visible');
    inaugContent.style.display = 'none';
    curtainLeft.style.display = 'none';
    curtainRight.style.display = 'none';
    curtainValance.style.display = 'none';
  }
  hideAll();

  // ─── Sparkle Particles ───
  function initSparkles() {
    const ctx = sparkleCanvas.getContext('2d');
    let particles = [];
    const count = 80;

    function resize() {
      sparkleCanvas.width = window.innerWidth;
      sparkleCanvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    for (let i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * sparkleCanvas.width,
        y: Math.random() * sparkleCanvas.height,
        size: Math.random() * 3 + 0.5,
        speedX: (Math.random() - 0.5) * 0.4,
        speedY: (Math.random() - 0.5) * 0.4,
        opacity: Math.random() * 0.7 + 0.2,
        pulse: Math.random() * Math.PI * 2,
        color: Math.random() > 0.5 ? '255, 215, 0' : '255, 255, 255',
      });
    }

    function animate() {
      if (!overlay.classList.contains('visible')) return;
      ctx.clearRect(0, 0, sparkleCanvas.width, sparkleCanvas.height);

      particles.forEach(p => {
        p.x += p.speedX;
        p.y += p.speedY;
        p.pulse += 0.025;
        const alpha = p.opacity * (0.4 + 0.6 * Math.sin(p.pulse));

        if (p.x < 0) p.x = sparkleCanvas.width;
        if (p.x > sparkleCanvas.width) p.x = 0;
        if (p.y < 0) p.y = sparkleCanvas.height;
        if (p.y > sparkleCanvas.height) p.y = 0;

        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(${p.color}, ${alpha})`;
        ctx.fill();
      });

      requestAnimationFrame(animate);
    }
    animate();
  }

  // ─── Confetti Engine (500 pieces!) ───
  function fireConfetti() {
    const ctx = confettiCanvas.getContext('2d');
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;
    confettiCanvas.style.display = 'block';

    const colors = [
      '#ef4444', '#f59e0b', '#fbbf24', '#22c55e', '#3b82f6',
      '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#06b6d4',
      '#e11d48', '#a855f7', '#facc15', '#34d399', '#ffd700',
      '#ff6b6b', '#48dbfb', '#ff9ff3', '#00d2d3', '#54a0ff'
    ];

    const pieces = [];
    const totalPieces = 500;

    const origins = [
      { x: 0, y: confettiCanvas.height * 0.5 },
      { x: confettiCanvas.width * 0.2, y: confettiCanvas.height * 0.4 },
      { x: confettiCanvas.width * 0.5, y: confettiCanvas.height * 0.35 },
      { x: confettiCanvas.width * 0.8, y: confettiCanvas.height * 0.4 },
      { x: confettiCanvas.width, y: confettiCanvas.height * 0.5 },
      { x: confettiCanvas.width * 0.35, y: confettiCanvas.height * 0.6 },
      { x: confettiCanvas.width * 0.65, y: confettiCanvas.height * 0.6 },
    ];

    for (let i = 0; i < totalPieces; i++) {
      const origin = origins[Math.floor(Math.random() * origins.length)];
      const angle = -Math.PI / 2 + (Math.random() - 0.5) * Math.PI * 1.4;
      const speed = Math.random() * 22 + 8;
      const shapes = ['circle', 'rect', 'strip', 'star'];
      const shape = shapes[Math.floor(Math.random() * shapes.length)];

      pieces.push({
        x: origin.x + (Math.random() - 0.5) * 60,
        y: origin.y,
        vx: Math.cos(angle) * speed * (origin.x < confettiCanvas.width / 2 ? 1 : -1) * (Math.random() * 0.6 + 0.4),
        vy: Math.sin(angle) * speed - Math.random() * 6,
        color: colors[Math.floor(Math.random() * colors.length)],
        rotation: Math.random() * 360,
        rotationSpeed: (Math.random() - 0.5) * 18,
        size: Math.random() * 10 + 4,
        gravity: 0.15 + Math.random() * 0.1,
        drag: 0.98 + Math.random() * 0.015,
        opacity: 1,
        shape: shape,
        wobble: Math.random() * Math.PI * 2,
        wobbleSpeed: Math.random() * 0.15 + 0.04,
      });
    }

    let startTime = Date.now();

    function animate() {
      const elapsed = Date.now() - startTime;
      ctx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
      let alive = false;

      pieces.forEach(p => {
        p.vy += p.gravity;
        p.vx *= p.drag;
        p.vy *= p.drag;
        p.x += p.vx;
        p.y += p.vy;
        p.rotation += p.rotationSpeed;
        p.wobble += p.wobbleSpeed;
        p.x += Math.sin(p.wobble) * 2;

        if (elapsed > 4000) p.opacity -= 0.006;
        if (p.opacity <= 0 || p.y > confettiCanvas.height + 60) return;
        alive = true;

        ctx.save();
        ctx.translate(p.x, p.y);
        ctx.rotate((p.rotation * Math.PI) / 180);
        ctx.globalAlpha = Math.max(0, p.opacity);

        if (p.shape === 'circle') {
          ctx.beginPath();
          ctx.arc(0, 0, p.size / 2, 0, Math.PI * 2);
          ctx.fillStyle = p.color;
          ctx.fill();
        } else if (p.shape === 'strip') {
          ctx.fillStyle = p.color;
          ctx.fillRect(-p.size * 0.3, -p.size * 1.5, p.size * 0.6, p.size * 3);
        } else if (p.shape === 'star') {
          ctx.fillStyle = p.color;
          ctx.beginPath();
          for (let s = 0; s < 5; s++) {
            const a = (s * 4 * Math.PI) / 5 - Math.PI / 2;
            const r = s === 0 ? 0 : p.size / 2;
            ctx[s === 0 ? 'moveTo' : 'lineTo'](Math.cos(a) * r, Math.sin(a) * r);
            const a2 = a + (2 * Math.PI) / 10;
            ctx.lineTo(Math.cos(a2) * p.size / 4, Math.sin(a2) * p.size / 4);
          }
          ctx.closePath();
          ctx.fill();
        } else {
          ctx.fillStyle = p.color;
          ctx.fillRect(-p.size / 2, -p.size / 3, p.size, p.size * 0.6);
        }
        ctx.restore();
      });

      if (alive && elapsed < 9000) {
        requestAnimationFrame(animate);
      } else {
        ctx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
        confettiCanvas.style.display = 'none';
      }
    }
    animate();
  }

  // ─── State Transitions ───
  function showRibbonOverlay() {
    // Show curtains
    curtainLeft.style.display = '';
    curtainRight.style.display = '';
    curtainValance.style.display = '';
    curtainLeft.classList.remove('open');
    curtainRight.classList.remove('open');
    curtainValance.classList.remove('hide');

    // Show dark backdrop
    overlay.style.display = 'block';
    void overlay.offsetWidth;
    overlay.classList.add('visible');

    // Show content
    inaugContent.style.display = 'flex';

    // Show ribbon
    ribbonMain.style.display = '';
    ribbonCut.style.display = 'none';

    initSparkles();
  }

  function playCutAnimation() {
    if (hasPlayedCut) return;
    hasPlayedCut = true;

    // 1. Scissors flash + ribbon splits
    ribbonMain.style.display = 'none';
    ribbonCut.style.display = '';
    scissorsFlash.classList.add('active');

    // 2. After ribbon falls, fire confetti + open curtains
    setTimeout(() => {
      fireConfetti();
    }, 400);

    // 3. Open the curtains majestically
    setTimeout(() => {
      curtainLeft.classList.add('open');
      curtainRight.classList.add('open');
    }, 800);

    // 4. Fade out content text
    setTimeout(() => {
      inaugContent.style.opacity = '0';
      inaugContent.style.transition = 'opacity 1s ease';
    }, 1500);

    // 5. Hide valance
    setTimeout(() => {
      curtainValance.classList.add('hide');
    }, 2000);

    // 6. Fade out dark backdrop
    setTimeout(() => {
      overlay.classList.add('fade-out');
    }, 2500);

    // 7. Fully remove everything
    setTimeout(() => {
      overlay.style.display = 'none';
      overlay.classList.remove('visible', 'fade-out');
      inaugContent.style.display = 'none';
      curtainLeft.style.display = 'none';
      curtainRight.style.display = 'none';
      curtainValance.style.display = 'none';
    }, 4000);
  }

  function handleState(newState) {
    if (newState === currentState) return;
    const prevState = currentState;
    currentState = newState;

    if (newState === 'ribbon_visible') {
      showRibbonOverlay();
    } else if (newState === 'ribbon_cut') {
      if (prevState === 'ribbon_hidden') {
        // The ribbon was already cut before the user loaded the page.
        // Don't play the 4-second animation for new visitors, just stay hidden.
        hideAll();
        hasPlayedCut = true;
      } else {
        playCutAnimation();
      }
    } else if (newState === 'ribbon_hidden') {
      hideAll();
      hasPlayedCut = false;
    }
  }

  // ─── Polling ───
  function pollState() {
    fetch('/api/inauguration/state', {
      cache: 'no-store',
      headers: { 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
      if (data && data.state) handleState(data.state);
    })
    .catch(() => {});
  }

  pollState();
  pollingInterval = setInterval(pollState, 2000);

  setInterval(() => {
    if (currentState === 'ribbon_cut' && hasPlayedCut && overlay.style.display === 'none') {
      clearInterval(pollingInterval);
    }
  }, 10000);

  window.addEventListener('resize', () => {
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;
  });
})();
</script>
@endsection
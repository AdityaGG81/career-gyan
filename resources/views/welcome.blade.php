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
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1a56db 100%);
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
    margin-top: 16px;
  }

  .marquee-inner {
    display: inline-flex;
    gap: 20px;
    animation: marqueeAnimation 75s linear infinite;
    will-change: transform;
  }

  .marquee-track-1 .marquee-inner {
    animation-duration: 72s;
  }

  .marquee-track-2 .marquee-inner {
    animation-duration: 80s;
  }

  .marquee-track-3 .marquee-inner {
    animation-duration: 74s;
  }

  .marquee-inner.marquee-reverse {
    animation-direction: reverse !important;
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
    cursor: pointer;
    text-align: left;
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
    padding: 60px 0 70px;
    background: #ffffff;
    position: relative;
  }

  .timeline-container {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
    padding: 24px 0 10px;
  }

  /* Connecting timeline line */
  .timeline-line {
    position: absolute;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: calc(100% - 60px);
    background: linear-gradient(180deg, #eff6ff 0%, var(--brand) 50%, #faf5ff 100%);
    z-index: 1;
    transition: height 1.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 36px;
    position: relative;
    z-index: 2;
    opacity: 1;
    transform: translateY(0) scale(1);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
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
    padding: 70px 0 80px;
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
  /* ─── MHT-CET Cutoff Showcase ─── */
  .cutoff-showcase-section {
    padding: 90px 0 80px;
    background: linear-gradient(180deg, #f0f4ff 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
  }
  .cutoff-showcase-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--brand), #6366f1, #38bdf8);
  }
  .cutoff-showcase-header {
    text-align: center;
    margin-bottom: 48px;
  }
  .cutoff-showcase-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(26,86,219,0.08), rgba(99,102,241,0.08));
    color: var(--brand);
    padding: 8px 18px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 16px;
    border: 1px solid rgba(26,86,219,0.15);
  }
  .cutoff-showcase-badge i {
    font-size: 14px;
  }
  .cutoff-mini-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 24px;
    flex-wrap: wrap;
  }
  .cutoff-mini-stat {
    text-align: center;
  }
  .cutoff-mini-stat-value {
    font-family: 'Sora', sans-serif;
    font-size: 30px;
    font-weight: 800;
    color: var(--brand);
    line-height: 1;
  }
  .cutoff-mini-stat-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-3);
    margin-top: 4px;
  }
  .cutoff-search-mini {
    max-width: 520px;
    margin: 32px auto 0;
    position: relative;
  }
  .cutoff-search-mini input {
    width: 100%;
    padding: 15px 52px 15px 20px;
    border: 2px solid var(--border);
    border-radius: 99px;
    font-size: 15px;
    font-family: 'DM Sans', sans-serif;
    color: var(--text-1);
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
  }
  .cutoff-search-mini input:focus {
    outline: none;
    border-color: var(--brand);
    box-shadow: 0 4px 24px rgba(26,86,219,0.12);
  }
  .cutoff-search-mini input::placeholder {
    color: var(--text-3);
  }
  .cutoff-search-mini-btn {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: var(--brand);
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.2s;
  }
  .cutoff-search-mini-btn:hover {
    background: var(--brand-dark);
    transform: translateY(-50%) scale(1.05);
  }
  .cutoff-college-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
    margin-top: 40px;
  }
  .cutoff-college-card {
    background: #fff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px;
    transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1);
    position: relative;
    overflow: hidden;
  }
  .cutoff-college-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--brand), #6366f1);
    opacity: 0;
    transition: opacity 0.3s;
  }
  .cutoff-college-card:hover {
    border-color: rgba(26,86,219,0.25);
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(26,86,219,0.1);
  }
  .cutoff-college-card:hover::before {
    opacity: 1;
  }
  .cutoff-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
  }
  .cutoff-card-college-name {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    line-height: 1.4;
    flex: 1;
  }
  .cutoff-card-percentile {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: #059669;
    white-space: nowrap;
    line-height: 1;
  }
  .cutoff-card-percentile small {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-3);
    display: block;
    text-align: right;
    margin-top: 2px;
  }
  .cutoff-card-branch {
    font-size: 13px;
    color: var(--text-2);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .cutoff-card-branch i {
    color: var(--brand);
    font-size: 12px;
  }
  .cutoff-card-meta {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }
  .cutoff-card-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
    background: #f1f5f9;
    color: var(--text-2);
  }
  .cutoff-card-tag.green { background: #ecfdf5; color: #059669; }
  .cutoff-card-tag.blue { background: #eff6ff; color: #2563eb; }
  .cutoff-showcase-cta {
    text-align: center;
    margin-top: 48px;
  }
  .cutoff-showcase-cta a {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--brand), #6366f1);
    color: #fff;
    padding: 16px 36px;
    border-radius: 99px;
    font-weight: 700;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(26,86,219,0.25);
  }
  .cutoff-showcase-cta a:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(26,86,219,0.35);
    color: #fff;
  }
  @media (max-width: 767px) {
    .cutoff-showcase-section { padding: 50px 0; }
    .cutoff-college-grid { grid-template-columns: 1fr; gap: 14px; margin-top: 24px; }
    .cutoff-college-card { padding: 18px 16px; border-radius: var(--radius-lg); }
    .cutoff-card-college-name { font-size: 14px; line-height: 1.35; }
    .cutoff-card-percentile { font-size: 19px; }
    .cutoff-card-percentile small { font-size: 10px; }
    .cutoff-card-branch { font-size: 12px; margin-bottom: 10px; }
    .cutoff-card-tag { font-size: 10.5px; padding: 3px 8px; }
    .cutoff-mini-stats { gap: 16px; justify-content: space-around; margin: 20px 0 24px; }
    .cutoff-mini-stat-value { font-size: 20px; }
    .cutoff-mini-stat-label { font-size: 11px; }
    .cutoff-search-mini { max-width: 100%; }
    .cutoff-search-mini input { font-size: 13.5px; padding: 12px 48px 12px 16px; }
    .cutoff-showcase-cta { margin-top: 32px; }
    .cutoff-showcase-cta a { width: 100%; justify-content: center; padding: 14px 24px; font-size: 14.5px; }
  }

  /* ─── Premium Membership Section ─── */
  .premium-membership-section {
    padding: 100px 0;
    background: radial-gradient(circle at 50% 20%, #1e1b4b 0%, #0f172a 60%, #090d16 100%);
    color: #ffffff;
    position: relative;
    overflow: hidden;
  }

  .premium-membership-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.4), transparent);
  }

  .premium-membership-section .mem-glow-orb {
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, rgba(147, 51, 234, 0.05) 50%, transparent 70%);
    filter: blur(60px);
    pointer-events: none;
    z-index: 0;
  }

  .mem-glow-orb-1 { top: -100px; left: -100px; }
  .mem-glow-orb-2 { bottom: -150px; right: -100px; }

  .mem-section-head {
    text-align: center;
    max-width: 780px;
    margin: 0 auto 60px;
    position: relative;
    z-index: 1;
  }

  .mem-section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(90deg, rgba(251, 191, 36, 0.15), rgba(245, 158, 11, 0.25));
    border: 1px solid rgba(251, 191, 36, 0.45);
    color: #fbbf24;
    padding: 7px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 20px;
    box-shadow: 0 4px 20px rgba(245, 158, 11, 0.15);
  }

  .mem-section-head h2 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800;
    line-height: 1.22;
    margin-bottom: 16px;
    background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 60%, #94a3b8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .mem-section-head p {
    font-size: 16.5px;
    color: #94a3b8;
    line-height: 1.6;
  }

  .mem-two-col {
    display: grid;
    grid-template-columns: 1.15fr 0.95fr;
    gap: 48px;
    align-items: center;
    position: relative;
    z-index: 1;
  }

  @media (max-width: 991px) {
    .mem-two-col {
      grid-template-columns: 1fr;
      gap: 40px;
    }
  }

  /* Left: Feature Pillars */
  .mem-features-col {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .mem-feature-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: var(--radius-lg);
    padding: 22px 24px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
  }

  .mem-feature-card:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(251, 191, 36, 0.4);
    transform: translateX(6px);
  }

  .mem-feature-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(245, 158, 11, 0.1));
    border: 1px solid rgba(251, 191, 36, 0.35);
    color: #fbbf24;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .mem-feature-text h4 {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 700;
    color: #f8fafc;
    margin-bottom: 6px;
  }

  .mem-feature-text p {
    font-size: 13.5px;
    color: #94a3b8;
    line-height: 1.5;
  }

  /* Right: Price Glass Card */
  .mem-pricing-glass-card {
    background: linear-gradient(145deg, rgba(30, 27, 75, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
    border: 2px solid rgba(251, 191, 36, 0.6);
    border-radius: var(--radius-xl);
    padding: 44px 36px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 50px rgba(245, 158, 11, 0.15);
    text-align: center;
  }

  .mem-ribbon-tag {
    position: absolute;
    top: 24px;
    right: -35px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    color: #78350f;
    font-size: 10px;
    font-weight: 800;
    padding: 6px 42px;
    transform: rotate(45deg);
    letter-spacing: 1.2px;
    text-transform: uppercase;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  }

  .mem-symbol-display {
    width: 68px;
    height: 68px;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.25), rgba(245, 158, 11, 0.1));
    border: 1.5px solid rgba(251, 191, 36, 0.5);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #fbbf24;
    margin-bottom: 16px;
    box-shadow: 0 8px 24px rgba(245, 158, 11, 0.3);
  }

  .mem-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 8px;
  }

  .mem-card-desc {
    font-size: 13.5px;
    color: #94a3b8;
    line-height: 1.5;
    margin-bottom: 24px;
  }

  .mem-price-area {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: var(--radius-lg);
    padding: 20px;
    margin-bottom: 28px;
  }

  .mem-strike-price-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 6px;
  }

  .mem-strike-price {
    font-size: 16px;
    color: #94a3b8;
    text-decoration: line-through;
  }

  .mem-save-badge {
    background: #10b981;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 999px;
    letter-spacing: 0.03em;
  }

  .mem-main-price {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 4px;
  }

  .mem-main-currency {
    font-size: 26px;
    font-weight: 800;
    color: #fbbf24;
  }

  .mem-main-amount {
    font-family: 'Sora', sans-serif;
    font-size: 56px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
  }

  .mem-main-period {
    font-size: 15px;
    color: #94a3b8;
    font-weight: 600;
  }

  .mem-checklist {
    list-style: none;
    text-align: left;
    margin-bottom: 30px;
    padding: 0 6px;
  }

  .mem-checklist li {
    font-size: 14px;
    color: #e2e8f0;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
    line-height: 1.4;
  }

  .mem-checklist li i {
    color: #10b981;
    font-size: 15px;
    margin-top: 2px;
    flex-shrink: 0;
  }

  .mem-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 16px 28px;
    background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
    color: #78350f;
    border-radius: var(--radius-md);
    font-size: 16px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 10px 24px rgba(245, 158, 11, 0.3);
    transition: all 0.3s ease;
  }

  .mem-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 32px rgba(245, 158, 11, 0.45);
    color: #78350f;
  }

  .mem-trust-tag {
    font-size: 12px;
    color: #64748b;
    margin-top: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
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
            <strong><span class="counter-val" data-target="5000" data-suffix="+">5000+</span></strong>
            <span>Career Paths</span>
          </div>

          <div class="hero-stat-card">
            <strong><span class="counter-val" data-target="50" data-suffix="+">50+</span></strong>
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

<!-- ─── Refer & Earn Section (Front & Center) ─── -->
<section style="padding: 36px 0; background: #ffffff; border-bottom: 1px solid var(--border);">
  <div class="container">
    @auth
      <div style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #1d4ed8 100%); border-radius: var(--radius-xl); padding: 32px 36px; color: #ffffff; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.15); display: flex; justify-content: space-between; align-items: center; gap: 24px; flex-wrap: wrap;">
        <div style="max-width: 580px;">
          <span style="background: rgba(255,255,255,0.15); color: #fde047; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 99px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 10px;">
            <i class="fa-solid fa-gift"></i> REFER & EARN
          </span>
          <h2 style="font-family: 'Sora', sans-serif; font-size: clamp(20px, 3vw, 26px); font-weight: 800; margin-bottom: 8px;">
            Invite Friends & Earn 100 Points Together!
          </h2>
          <p style="font-size: 14px; opacity: 0.9; margin-bottom: 16px;">
            "Your friends deserve to know about us! Invite them and earn rewards together."
          </p>
          <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <span style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); padding: 7px 14px; border-radius: 8px; font-size: 13.5px; font-weight: 700;">
              Your Code: <strong style="color: #fde047; font-family: monospace; font-size: 15px;">{{ Auth::user()->referral_code }}</strong>
            </span>
            <span style="background: rgba(245, 158, 11, 0.2); border: 1px solid rgba(245, 158, 11, 0.4); color: #fde047; padding: 7px 14px; border-radius: 8px; font-size: 13.5px; font-weight: 800;">
              <i class="fa-solid fa-coins"></i> {{ number_format(Auth::user()->points_balance ?? 0) }} Points
            </span>
            @if(Auth::user()->current_badge)
              <span style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; padding: 7px 14px; border-radius: 8px; font-size: 13.5px; font-weight: 800; display: inline-flex; align-items: center; gap: 6px;">
                <i class="{{ Auth::user()->current_badge['badge_icon'] ?? 'fa-solid fa-award' }}" style="color: #fde047;"></i> {{ Auth::user()->current_badge['badge_name'] }}
              </span>
            @endif
          </div>
        </div>

        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
          <a href="{{ route('rewards.index') }}" style="background: #ffffff; color: #1e3a8a; padding: 12px 24px; border-radius: var(--radius-md); font-weight: 800; font-size: 14.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-wallet" style="color: #f59e0b;"></i> Open Points Wallet
          </a>
          <a href="{{ Auth::user()->whatsapp_share_url }}" target="_blank" rel="noopener noreferrer" style="background: #25d366; color: #ffffff; padding: 12px 20px; border-radius: var(--radius-md); font-weight: 700; font-size: 14.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37,211,102,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i> WhatsApp Share
          </a>
        </div>
      </div>
    @else
      <div style="background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%); border: 1.5px solid #bfdbfe; border-radius: var(--radius-xl); padding: 28px 36px; display: flex; justify-content: space-between; align-items: center; gap: 24px; flex-wrap: wrap;">
        <div>
          <span style="background: #dbeafe; color: #1d4ed8; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; padding: 5px 12px; border-radius: 99px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 8px;">
            <i class="fa-solid fa-gift"></i> REWARD POINTS PROGRAM
          </span>
          <h2 style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">
            Earn 100 Reward Points on Signup & Test Completions!
          </h2>
          <p style="font-size: 14.5px; color: #475569; margin: 0;">
            Invite your friends to CareerGyan and both of you earn 100 points, plus 50 points for completing aptitude and career assessments.
          </p>
        </div>
        <div>
          <a href="{{ route('signup') }}" style="background: var(--brand); color: #ffffff; padding: 12px 24px; border-radius: var(--radius-md); font-weight: 700; font-size: 14.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(26, 86, 219, 0.25);">
            Join & Get 100 Points <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    @endauth
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

<!-- ─── Maharashtra MHT-CET Cutoffs Showcase ─── -->
<section class="cutoff-showcase-section">
  <div class="container">
    <div class="cutoff-showcase-header">
      <div class="cutoff-showcase-badge">
        <i class="fa-solid fa-chart-line"></i> New: MHT-CET Cutoffs 2025
      </div>
      <h2 class="section-title">Maharashtra Engineering Cutoffs</h2>
      <p class="section-subtitle">Browse official CAP Round I cutoff percentiles for 363+ engineering colleges across Maharashtra. Search by college or branch instantly.</p>

      <div class="cutoff-mini-stats">
        <div class="cutoff-mini-stat">
          <div class="cutoff-mini-stat-value">363+</div>
          <div class="cutoff-mini-stat-label">Colleges</div>
        </div>
        <div class="cutoff-mini-stat">
          <div class="cutoff-mini-stat-value">103</div>
          <div class="cutoff-mini-stat-label">Branches</div>
        </div>
        <div class="cutoff-mini-stat">
          <div class="cutoff-mini-stat-value">2,149</div>
          <div class="cutoff-mini-stat-label">Cutoff Records</div>
        </div>
      </div>

      <div class="cutoff-search-mini">
        <input type="text" id="homeCutoffSearch" placeholder="Search college name... e.g. VJTI, COEP, PICT" autocomplete="off">
        <button class="cutoff-search-mini-btn" id="homeCutoffSearchBtn"><i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <!-- Featured College Cutoff Cards -->
    <div class="cutoff-college-grid">
      <!-- VJTI -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">Veermata Jijabai Technological Institute (VJTI), Mumbai</div>
          <div class="cutoff-card-percentile">99.95<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #103</span>
        </div>
      </div>

      <!-- COEP -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">College of Engineering, Pune (COEP Technological University)</div>
          <div class="cutoff-card-percentile">99.93<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #152</span>
        </div>
      </div>

      <!-- Walchand Sangli -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">Walchand College of Engineering, Sangli</div>
          <div class="cutoff-card-percentile">99.47<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Science and Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #1,133</span>
        </div>
      </div>

      <!-- PICT -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">Pune Institute of Computer Technology (PICT), Pune</div>
          <div class="cutoff-card-percentile">99.28<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #1,534</span>
        </div>
      </div>

      <!-- Government College Amravati -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">Government College of Engineering, Amravati</div>
          <div class="cutoff-card-percentile">97.37<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Science and Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #9,196</span>
        </div>
      </div>

      <!-- SPIT Mumbai -->
      <div class="cutoff-college-card">
        <div class="cutoff-card-header">
          <div class="cutoff-card-college-name">Sardar Patel Institute of Technology (SPIT), Mumbai</div>
          <div class="cutoff-card-percentile">99.60<small>Percentile</small></div>
        </div>
        <div class="cutoff-card-branch"><i class="fa-solid fa-microchip"></i> Computer Engineering</div>
        <div class="cutoff-card-meta">
          <span class="cutoff-card-tag green">GOPENS</span>
          <span class="cutoff-card-tag blue">CAP Round I</span>
          <span class="cutoff-card-tag">Merit #855</span>
        </div>
      </div>
    </div>

    <div class="cutoff-showcase-cta" style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
      <a href="{{ route('tools.mh-cutoff') }}">
        <i class="fa-solid fa-table-list"></i> Explore 2,149 Cutoffs
      </a>
      <a href="{{ route('tools.college-predictor') }}" style="background: linear-gradient(135deg, #059669, #047857); box-shadow: 0 4px 16px rgba(5,150,105,0.25);">
        <i class="fa-solid fa-crosshairs"></i> Predict Your College
      </a>
      <a href="{{ route('tools.percentile-calculator') }}" style="background: linear-gradient(135deg, #d97706, #b45309); box-shadow: 0 4px 16px rgba(217,119,6,0.25);">
        <i class="fa-solid fa-calculator"></i> Percentile Calculator
      </a>
      <a href="{{ route('guidance.mht-cet') }}" style="background: #ffffff; color: var(--text-1); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
        <i class="fa-solid fa-book-open" style="color:var(--brand);"></i> CET Prep Guide
      </a>
    </div>
  </div>
</section>

<!-- ─── Popular Careers Marquee ─── -->
<section class="marquee-section">
  <div class="container" style="text-align: center;">
    <div class="section-label" style="background:#f1f5f9; color:var(--text-2);">
      <i class="fa-solid fa-fire"></i> Trending Now
    </div>
    <h2 class="section-title" style="margin-bottom:10px;">Popular Career Pathways (78+ Options)</h2>
    <p style="color:var(--text-2); font-size:15px; margin-bottom:28px;">
      Explore in-demand career pathways across Technology, Healthcare, Business, Finance, Law & Civil Services. Click or hover any card to view required skills, pathways & top recruiting companies.
    </p>
  </div>

  <!-- Track: marquee-track-1 -->
  <div class="marquee-container marquee-track-1">
    <div class="marquee-inner">
      <!-- Card: Software Engineer -->
      <div class="marquee-card" 
           data-title="Software Engineer" 
           data-category="Technology" 
           data-icon="fa-solid fa-laptop-code" 
           data-color="linear-gradient(135deg, #3b82f6, #1d4ed8)" 
           data-description="Designs, develops, tests, and maintains scalable software applications, enterprise platforms, and cloud systems."
           data-skills="Java, Python, C++, Go, Data Structures, System Design, Git, SQL"
           data-pathway="B.Tech / BE in CSE / IT, BCA/MCA, or intensive Full-Stack Software Engineering bootcamps."
           data-companies="Google, Microsoft, Amazon, Atlassian, Infosys, TCS, Oracle">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"><i class="fa-solid fa-laptop-code"></i></div>
          <div>
            <h4>Software Engineer</h4>
            <span class="category-badge">Technology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: AI & Machine Learning Engineer -->
      <div class="marquee-card" 
           data-title="AI & Machine Learning Engineer" 
           data-category="Artificial Intelligence" 
           data-icon="fa-solid fa-brain" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Builds predictive algorithms, neural networks, LLMs, and intelligent autonomous systems powering modern AI products."
           data-skills="Python, PyTorch, TensorFlow, Scikit-Learn, Deep Learning, MLOps, NLP"
           data-pathway="B.Tech in AI/Data Science, M.Tech/MS in Computer Science/Machine Learning, specialized AI certifications."
           data-companies="OpenAI, Google DeepMind, NVIDIA, Microsoft, Adobe, Meta, Ola Krutrim">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-brain"></i></div>
          <div>
            <h4>AI & Machine Learning Engineer</h4>
            <span class="category-badge">Artificial Intelligence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 40L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Data Scientist -->
      <div class="marquee-card" 
           data-title="Data Scientist" 
           data-category="Data Science" 
           data-icon="fa-solid fa-chart-pie" 
           data-color="linear-gradient(135deg, #06b6d4, #0e7490)" 
           data-description="Transforms massive raw datasets into actionable predictive insights, statistical models, and business intelligence."
           data-skills="Python, R, SQL, Power BI, Statistics, Tableau, Feature Engineering"
           data-pathway="B.Tech / B.Sc in Statistics, Mathematics, or Data Science, followed by M.Sc / PG Diploma in Big Data."
           data-companies="Amazon, Walmart Global Tech, Mu Sigma, Fractal Analytics, Tiger Analytics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #0e7490);"><i class="fa-solid fa-chart-pie"></i></div>
          <div>
            <h4>Data Scientist</h4>
            <span class="category-badge">Data Science</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Cybersecurity Specialist -->
      <div class="marquee-card" 
           data-title="Cybersecurity Specialist" 
           data-category="Cybersecurity" 
           data-icon="fa-solid fa-shield-halved" 
           data-color="linear-gradient(135deg, #dc2626, #991b1b)" 
           data-description="Protects corporate networks, servers, and sensitive digital assets from cyberattacks, breaches, and ransomware."
           data-skills="Network Security, CEH, Penetration Testing, Kali Linux, SIEM, Cryptography, Wireshark"
           data-pathway="B.Tech in IT / Cybersecurity, CEH / CompTIA Security+ / CISSP certifications."
           data-companies="Cisco, Palo Alto Networks, CrowdStrike, KPMG Cyber, CERT-In, Banking Giants">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #991b1b);"><i class="fa-solid fa-shield-halved"></i></div>
          <div>
            <h4>Cybersecurity Specialist</h4>
            <span class="category-badge">Cybersecurity</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Cloud Solutions Architect -->
      <div class="marquee-card" 
           data-title="Cloud Solutions Architect" 
           data-category="Cloud & DevOps" 
           data-icon="fa-solid fa-cloud" 
           data-color="linear-gradient(135deg, #0284c7, #0369a1)" 
           data-description="Architects robust, secure, and auto-scaling multi-cloud enterprise infrastructure and migration pipelines."
           data-skills="AWS, Azure, GCP, Terraform, Kubernetes, Microservices, IAM"
           data-pathway="B.Tech in CSE / IT + AWS Certified Solutions Architect / Azure Solutions Architect Expert."
           data-companies="Amazon Web Services, Microsoft, Google Cloud, Wipro, Accenture, Cognizant">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0369a1);"><i class="fa-solid fa-cloud"></i></div>
          <div>
            <h4>Cloud Solutions Architect</h4>
            <span class="category-badge">Cloud & DevOps</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: DevOps & Platform Engineer -->
      <div class="marquee-card" 
           data-title="DevOps & Platform Engineer" 
           data-category="Cloud & DevOps" 
           data-icon="fa-solid fa-gears" 
           data-color="linear-gradient(135deg, #f97316, #c2410c)" 
           data-description="Automates deployment pipelines, ensures infrastructure reliability, and streamlines developer productivity."
           data-skills="Docker, Kubernetes, Jenkins, GitLab CI/CD, Ansible, Linux, Prometheus"
           data-pathway="Degree in CS/IT + hands-on DevOps tooling & cloud certifications."
           data-companies="Red Hat, HashiCorp, Flipkart, PhonePe, Razorpay, Swiggy">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #c2410c);"><i class="fa-solid fa-gears"></i></div>
          <div>
            <h4>DevOps & Platform Engineer</h4>
            <span class="category-badge">Cloud & DevOps</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Full Stack Web Developer -->
      <div class="marquee-card" 
           data-title="Full Stack Web Developer" 
           data-category="Web Development" 
           data-icon="fa-solid fa-code" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Engineers end-to-end responsive web applications from dynamic UI frontends to high-performance database backends."
           data-skills="React.js, Next.js, Node.js, TypeScript, PostgreSQL, REST APIs, Tailwind CSS"
           data-pathway="BCA / B.Tech or self-taught web dev portfolio with production projects."
           data-companies="Zomato, CRED, Freshworks, Postman, Zoho, Global Tech Hubs">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-code"></i></div>
          <div>
            <h4>Full Stack Web Developer</h4>
            <span class="category-badge">Web Development</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Mobile App Developer -->
      <div class="marquee-card" 
           data-title="Mobile App Developer" 
           data-category="App Development" 
           data-icon="fa-solid fa-mobile-screen-button" 
           data-color="linear-gradient(135deg, #6366f1, #4338ca)" 
           data-description="Crafts high-performance, fluid iOS and Android mobile experiences enjoyed by millions of daily users."
           data-skills="Flutter, React Native, Swift, Kotlin, Jetpack Compose, Firebase, App Store CI/CD"
           data-pathway="B.Tech CSE, BCA, or specialized cross-platform mobile developer bootcamps."
           data-companies="Paytm, Uber, Swiggy, Zepto, Spotify India, Dream11">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #6366f1, #4338ca);"><i class="fa-solid fa-mobile-screen-button"></i></div>
          <div>
            <h4>Mobile App Developer</h4>
            <span class="category-badge">App Development</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Blockchain Developer -->
      <div class="marquee-card" 
           data-title="Blockchain Developer" 
           data-category="Emerging Tech" 
           data-icon="fa-solid fa-cubes" 
           data-color="linear-gradient(135deg, #e11d48, #9f1239)" 
           data-description="Architects decentralized smart contracts, DeFi protocols, and cryptographically secure distributed ledgers."
           data-skills="Solidity, Ethereum, Rust, Web3.js, Smart Contract Auditing, Cryptography"
           data-pathway="Degree in Computer Science + Web3 fellowship / decentralized app development projects."
           data-companies="Polygon, Coinbase, CoinDCX, ConsenSys, Chainlink, Web3 Startups">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #9f1239);"><i class="fa-solid fa-cubes"></i></div>
          <div>
            <h4>Blockchain Developer</h4>
            <span class="category-badge">Emerging Tech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 35L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: UI / UX Product Designer -->
      <div class="marquee-card" 
           data-title="UI / UX Product Designer" 
           data-category="Design & Tech" 
           data-icon="fa-solid fa-bezier-curve" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Researches user behaviors, crafts wireframes, and prototypes seamless digital product interfaces."
           data-skills="Figma, User Research, Wireframing, Design Systems, Usability Testing, Micro-interactions"
           data-pathway="B.Des (Interaction/Communication Design) from NID/IITs, or UX Design Bootcamp portfolio."
           data-companies="Apple, Google, Adobe, Swiggy, Airbnb, CRED, Flipkart">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-bezier-curve"></i></div>
          <div>
            <h4>UI / UX Product Designer</h4>
            <span class="category-badge">Design & Tech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Robotics & Automation Engineer -->
      <div class="marquee-card" 
           data-title="Robotics & Automation Engineer" 
           data-category="Robotics" 
           data-icon="fa-solid fa-robot" 
           data-color="linear-gradient(135deg, #0ea5e9, #0284c7)" 
           data-description="Designs autonomous robots, factory automation lines, and robotic vision hardware for smart industries."
           data-skills="ROS (Robot OS), C++, Embedded Systems, Sensor Fusion, Kinematics, CAD"
           data-pathway="B.Tech in Robotics / Mechatronics / Electrical Engineering + M.Tech in Robotics."
           data-companies="Tesla, Boston Dynamics, GreyOrange, Fanuc, ABB Robotics, DRDO">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);"><i class="fa-solid fa-robot"></i></div>
          <div>
            <h4>Robotics & Automation Engineer</h4>
            <span class="category-badge">Robotics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Aerospace & Aeronautical Engineer -->
      <div class="marquee-card" 
           data-title="Aerospace & Aeronautical Engineer" 
           data-category="Aerospace" 
           data-icon="fa-solid fa-plane-up" 
           data-color="linear-gradient(135deg, #2563eb, #1e40af)" 
           data-description="Researches, designs, and tests aircraft, satellites, launch rockets, and defense propulsion systems."
           data-skills="Aerodynamics, Propulsion, CFD, Flight Mechanics, ANSYS, CATIA"
           data-pathway="B.Tech in Aerospace/Aeronautical Engineering (IITs/IIST) + GATE for ISRO/DRDO."
           data-companies="ISRO, HAL, Boeing, Airbus, DRDO, Skyroot Aerospace, Agnikul Cosmos">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1e40af);"><i class="fa-solid fa-plane-up"></i></div>
          <div>
            <h4>Aerospace & Aeronautical Engineer</h4>
            <span class="category-badge">Aerospace</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 30L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: VLSI & Chip Design Engineer -->
      <div class="marquee-card" 
           data-title="VLSI & Chip Design Engineer" 
           data-category="Semiconductors" 
           data-icon="fa-solid fa-microchip" 
           data-color="linear-gradient(135deg, #84cc16, #4d7c0f)" 
           data-description="Architects microprocessors, silicon chips, and integrated circuit layouts powering next-gen devices."
           data-skills="Verilog, VHDL, SystemVerilog, FPGA, Synopsys EDA, CMOS, Static Timing Analysis"
           data-pathway="B.Tech in ECE / Electrical Engineering + M.Tech in VLSI Design."
           data-companies="Qualcomm, Intel, NVIDIA, Texas Instruments, AMD, MediaTek">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #84cc16, #4d7c0f);"><i class="fa-solid fa-microchip"></i></div>
          <div>
            <h4>VLSI & Chip Design Engineer</h4>
            <span class="category-badge">Semiconductors</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 36L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Mechanical Design Engineer -->
      <div class="marquee-card" 
           data-title="Mechanical Design Engineer" 
           data-category="Core Engineering" 
           data-icon="fa-solid fa-cogs" 
           data-color="linear-gradient(135deg, #64748b, #334155)" 
           data-description="Conceptualizes, prototypes, and stress-tests mechanical machinery, turbines, and consumer hardware."
           data-skills="SolidWorks, AutoCAD, FEA Analysis, Thermodynamics, GD&T, 3D Prototyping"
           data-pathway="B.Tech in Mechanical Engineering + CAD/CAM industry certifications."
           data-companies="Tata Motors, Larsen & Toubro, Mahindra & Mahindra, Bosch, Siemens">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #64748b, #334155);"><i class="fa-solid fa-cogs"></i></div>
          <div>
            <h4>Mechanical Design Engineer</h4>
            <span class="category-badge">Core Engineering</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Civil & Structural Engineer -->
      <div class="marquee-card" 
           data-title="Civil & Structural Engineer" 
           data-category="Core Engineering" 
           data-icon="fa-solid fa-building" 
           data-color="linear-gradient(135deg, #d97706, #b45309)" 
           data-description="Plans, oversees, and validates mega infrastructure projects including highways, bridges, and skyscrapers."
           data-skills="STAAD Pro, ETABS, Revit, Structural Analysis, Project Planning, Site Surveying"
           data-pathway="B.Tech in Civil Engineering + M.Tech in Structural Engineering."
           data-companies="L&T Construction, Shapoorji Pallonji, NHAI, DLF, Tata Projects">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d97706, #b45309);"><i class="fa-solid fa-building"></i></div>
          <div>
            <h4>Civil & Structural Engineer</h4>
            <span class="category-badge">Core Engineering</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Electrical & EV Systems Engineer -->
      <div class="marquee-card" 
           data-title="Electrical & EV Systems Engineer" 
           data-category="EV & CleanTech" 
           data-icon="fa-solid fa-bolt-lightning" 
           data-color="linear-gradient(135deg, #eab308, #ca8a04)" 
           data-description="Engineers electric vehicle battery packs, motor controllers, smart grids, and EV charging stations."
           data-skills="Battery Management Systems (BMS), MATLAB/Simulink, Power Electronics, CAN Bus"
           data-pathway="B.Tech in Electrical / Electronics Engineering + specialization in EV technologies."
           data-companies="Ather Energy, Ola Electric, Tata Elxsi, Tesla, Mahindra Electric">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #eab308, #ca8a04);"><i class="fa-solid fa-bolt-lightning"></i></div>
          <div>
            <h4>Electrical & EV Systems Engineer</h4>
            <span class="category-badge">EV & CleanTech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 25L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Renewable Energy Engineer -->
      <div class="marquee-card" 
           data-title="Renewable Energy Engineer" 
           data-category="CleanTech" 
           data-icon="fa-solid fa-solar-panel" 
           data-color="linear-gradient(135deg, #10b981, #059669)" 
           data-description="Designs solar farms, wind power parks, and sustainable energy storage grids for clean power transition."
           data-skills="PVsyst, Solar Photovoltaics, Grid Synchronization, Energy Auditing, AutoCAD"
           data-pathway="B.Tech in Electrical / Energy / Mechanical Engineering + Green Energy certifications."
           data-companies="Adani Green Energy, Tata Power Solar, ReNew Power, Suzlon, NTPC">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fa-solid fa-solar-panel"></i></div>
          <div>
            <h4>Renewable Energy Engineer</h4>
            <span class="category-badge">CleanTech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 20L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: Biomedical Engineer -->
      <div class="marquee-card" 
           data-title="Biomedical Engineer" 
           data-category="Biomedical" 
           data-icon="fa-solid fa-heart-pulse" 
           data-color="linear-gradient(135deg, #f43f5e, #be123c)" 
           data-description="Innovates robotic surgical tools, prosthetics, dialysis systems, and diagnostic medical imaging equipment."
           data-skills="Medical Device Regulation, Biomechanics, Biomedical Instrumentation, MATLAB, Signal Processing"
           data-pathway="B.Tech in Biomedical Engineering / Biotechnology + clinical tech internships."
           data-companies="GE Healthcare, Siemens Healthineers, Philips Healthcare, Medtronic, Dräger">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f43f5e, #be123c);"><i class="fa-solid fa-heart-pulse"></i></div>
          <div>
            <h4>Biomedical Engineer</h4>
            <span class="category-badge">Biomedical</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Game Developer -->
      <div class="marquee-card" 
           data-title="Game Developer" 
           data-category="Gaming & XR" 
           data-icon="fa-solid fa-gamepad" 
           data-color="linear-gradient(135deg, #a855f7, #7e22ce)" 
           data-description="Programs real-time physics engines, 3D graphics shaders, gameplay mechanics, and multiplayer architectures."
           data-skills="Unreal Engine, Unity, C++, C#, HLSL Shaders, 3D Math, Multiplayer Networking"
           data-pathway="B.Tech in Computer Science / Game Development or Game Programming diploma."
           data-companies="Ubisoft, Rockstar Games, Electronic Arts, Krafton, Epic Games India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #a855f7, #7e22ce);"><i class="fa-solid fa-gamepad"></i></div>
          <div>
            <h4>Game Developer</h4>
            <span class="category-badge">Gaming & XR</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 25L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: AR / VR Specialist -->
      <div class="marquee-card" 
           data-title="AR / VR Specialist" 
           data-category="Spatial Computing" 
           data-icon="fa-solid fa-vr-cardboard" 
           data-color="linear-gradient(135deg, #06b6d4, #0891b2)" 
           data-description="Crafts immersive spatial computing experiences, virtual training simulators, and mixed-reality apps."
           data-skills="OpenXR, Unity/Unreal, Spatial Audio, 3D Rigging, C#, Meta Quest SDK"
           data-pathway="Degree in CS, Multimedia, or Animation with spatial computing portfolio."
           data-companies="Meta Reality Labs, Apple Vision Pro Labs, HTC Vive, Infosys XR Studio">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #0891b2);"><i class="fa-solid fa-vr-cardboard"></i></div>
          <div>
            <h4>AR / VR Specialist</h4>
            <span class="category-badge">Spatial Computing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Big Data Engineer -->
      <div class="marquee-card" 
           data-title="Big Data Engineer" 
           data-category="Data Infrastructure" 
           data-icon="fa-solid fa-database" 
           data-color="linear-gradient(135deg, #059669, #047857)" 
           data-description="Manages petabyte-scale data lakes, distributed query engines, and transactional database clusters."
           data-skills="PostgreSQL, MongoDB, Apache Spark, Kafka, Snowflake, Hadoop, Redis"
           data-pathway="B.Tech in CSE / IT + Big Data & Cloud DB certifications."
           data-companies="Snowflake, Oracle, Databricks, Morgan Stanley, Reliance Jio, TCS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #047857);"><i class="fa-solid fa-database"></i></div>
          <div>
            <h4>Big Data Engineer</h4>
            <span class="category-badge">Data Infrastructure</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6.5L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: QA Automation & SDET -->
      <div class="marquee-card" 
           data-title="QA Automation & SDET" 
           data-category="Quality Assurance" 
           data-icon="fa-solid fa-bug" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Architects robust automated test frameworks, regression suites, and load-testing pipelines for software."
           data-skills="Selenium, Playwright, Cypress, Java, Python, JMeter, CI/CD Integration"
           data-pathway="B.Tech in CSE/IT or BCA/MCA with SDET automation test suite experience."
           data-companies="Cognizant, Infosys, Capgemini, Flipkart, American Express, IBM">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-bug"></i></div>
          <div>
            <h4>QA Automation & SDET</h4>
            <span class="category-badge">Quality Assurance</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: NLP Engineer -->
      <div class="marquee-card" 
           data-title="NLP Engineer" 
           data-category="Artificial Intelligence" 
           data-icon="fa-solid fa-comments" 
           data-color="linear-gradient(135deg, #7c3aed, #5b21b6)" 
           data-description="Trains Transformer models, multilingual chatbots, generative AI agents, and speech recognition engines."
           data-skills="Hugging Face, Transformers, LangChain, LlamaIndex, Vector DBs, PyTorch, Tokenization"
           data-pathway="Master's or B.Tech in AI/ML, Computational Linguistics, or Computer Science."
           data-companies="Cohere, Anthropic, Google, Sarvam AI, Jio Haptik, Microsoft">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #5b21b6);"><i class="fa-solid fa-comments"></i></div>
          <div>
            <h4>NLP Engineer</h4>
            <span class="category-badge">Artificial Intelligence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Automobile Engineer -->
      <div class="marquee-card" 
           data-title="Automobile Engineer" 
           data-category="Automotive" 
           data-icon="fa-solid fa-car" 
           data-color="linear-gradient(135deg, #b45309, #78350f)" 
           data-description="Designs internal chassis, hybrid transmissions, aerodynamic car bodies, and telemetry sensors."
           data-skills="IC Engines, Chassis Dynamics, MATLAB, CATIA, Aerodynamics, Crash Testing"
           data-pathway="B.Tech in Automobile / Mechanical Engineering + SAE BAJA / Formula Student participation."
           data-companies="Maruti Suzuki, Hyundai India, Mahindra, Bajaj Auto, TVS Motors">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #b45309, #78350f);"><i class="fa-solid fa-car"></i></div>
          <div>
            <h4>Automobile Engineer</h4>
            <span class="category-badge">Automotive</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.8L - 19L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Chemical Engineer -->
      <div class="marquee-card" 
           data-title="Chemical Engineer" 
           data-category="Chemical & Process" 
           data-icon="fa-solid fa-flask-vial" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Optimizes large-scale chemical reactors, petrochemical distillation towers, and polymer synthesis lines."
           data-skills="Aspen Plus, Mass Transfer, Chemical Kinetics, Process Safety, Piping & Instrumentation"
           data-pathway="B.Tech in Chemical Engineering + GATE for PSU careers (IOCL, ONGC, BPCL)."
           data-companies="Reliance Industries, ONGC, BPCL, BASF, Asian Paints, UPL">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-flask-vial"></i></div>
          <div>
            <h4>Chemical Engineer</h4>
            <span class="category-badge">Chemical & Process</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Technical Product Manager -->
      <div class="marquee-card" 
           data-title="Technical Product Manager" 
           data-category="Product Management" 
           data-icon="fa-solid fa-diagram-project" 
           data-color="linear-gradient(135deg, #4f46e5, #3730a3)" 
           data-description="Bridges engineering, business goals, and UX to launch industry-defining technology platforms."
           data-skills="Product Strategy, Agile/Scrum, User Stories, System Architecture, Metrics Tracking, Roadmapping"
           data-pathway="B.Tech in Engineering + MBA from top B-Schools (IIM/ISB) or strong tech PM experience."
           data-companies="Google, Microsoft, Atlassian, Razorpay, Uber, MakeMyTrip">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #4f46e5, #3730a3);"><i class="fa-solid fa-diagram-project"></i></div>
          <div>
            <h4>Technical Product Manager</h4>
            <span class="category-badge">Product Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹14L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>

      <!-- Duplicated for seamless marquee loop -->
      <!-- Card: Software Engineer -->
      <div class="marquee-card" 
           data-title="Software Engineer" 
           data-category="Technology" 
           data-icon="fa-solid fa-laptop-code" 
           data-color="linear-gradient(135deg, #3b82f6, #1d4ed8)" 
           data-description="Designs, develops, tests, and maintains scalable software applications, enterprise platforms, and cloud systems."
           data-skills="Java, Python, C++, Go, Data Structures, System Design, Git, SQL"
           data-pathway="B.Tech / BE in CSE / IT, BCA/MCA, or intensive Full-Stack Software Engineering bootcamps."
           data-companies="Google, Microsoft, Amazon, Atlassian, Infosys, TCS, Oracle">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"><i class="fa-solid fa-laptop-code"></i></div>
          <div>
            <h4>Software Engineer</h4>
            <span class="category-badge">Technology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: AI & Machine Learning Engineer -->
      <div class="marquee-card" 
           data-title="AI & Machine Learning Engineer" 
           data-category="Artificial Intelligence" 
           data-icon="fa-solid fa-brain" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Builds predictive algorithms, neural networks, LLMs, and intelligent autonomous systems powering modern AI products."
           data-skills="Python, PyTorch, TensorFlow, Scikit-Learn, Deep Learning, MLOps, NLP"
           data-pathway="B.Tech in AI/Data Science, M.Tech/MS in Computer Science/Machine Learning, specialized AI certifications."
           data-companies="OpenAI, Google DeepMind, NVIDIA, Microsoft, Adobe, Meta, Ola Krutrim">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-brain"></i></div>
          <div>
            <h4>AI & Machine Learning Engineer</h4>
            <span class="category-badge">Artificial Intelligence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 40L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Data Scientist -->
      <div class="marquee-card" 
           data-title="Data Scientist" 
           data-category="Data Science" 
           data-icon="fa-solid fa-chart-pie" 
           data-color="linear-gradient(135deg, #06b6d4, #0e7490)" 
           data-description="Transforms massive raw datasets into actionable predictive insights, statistical models, and business intelligence."
           data-skills="Python, R, SQL, Power BI, Statistics, Tableau, Feature Engineering"
           data-pathway="B.Tech / B.Sc in Statistics, Mathematics, or Data Science, followed by M.Sc / PG Diploma in Big Data."
           data-companies="Amazon, Walmart Global Tech, Mu Sigma, Fractal Analytics, Tiger Analytics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #0e7490);"><i class="fa-solid fa-chart-pie"></i></div>
          <div>
            <h4>Data Scientist</h4>
            <span class="category-badge">Data Science</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Cybersecurity Specialist -->
      <div class="marquee-card" 
           data-title="Cybersecurity Specialist" 
           data-category="Cybersecurity" 
           data-icon="fa-solid fa-shield-halved" 
           data-color="linear-gradient(135deg, #dc2626, #991b1b)" 
           data-description="Protects corporate networks, servers, and sensitive digital assets from cyberattacks, breaches, and ransomware."
           data-skills="Network Security, CEH, Penetration Testing, Kali Linux, SIEM, Cryptography, Wireshark"
           data-pathway="B.Tech in IT / Cybersecurity, CEH / CompTIA Security+ / CISSP certifications."
           data-companies="Cisco, Palo Alto Networks, CrowdStrike, KPMG Cyber, CERT-In, Banking Giants">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #991b1b);"><i class="fa-solid fa-shield-halved"></i></div>
          <div>
            <h4>Cybersecurity Specialist</h4>
            <span class="category-badge">Cybersecurity</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Cloud Solutions Architect -->
      <div class="marquee-card" 
           data-title="Cloud Solutions Architect" 
           data-category="Cloud & DevOps" 
           data-icon="fa-solid fa-cloud" 
           data-color="linear-gradient(135deg, #0284c7, #0369a1)" 
           data-description="Architects robust, secure, and auto-scaling multi-cloud enterprise infrastructure and migration pipelines."
           data-skills="AWS, Azure, GCP, Terraform, Kubernetes, Microservices, IAM"
           data-pathway="B.Tech in CSE / IT + AWS Certified Solutions Architect / Azure Solutions Architect Expert."
           data-companies="Amazon Web Services, Microsoft, Google Cloud, Wipro, Accenture, Cognizant">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0369a1);"><i class="fa-solid fa-cloud"></i></div>
          <div>
            <h4>Cloud Solutions Architect</h4>
            <span class="category-badge">Cloud & DevOps</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: DevOps & Platform Engineer -->
      <div class="marquee-card" 
           data-title="DevOps & Platform Engineer" 
           data-category="Cloud & DevOps" 
           data-icon="fa-solid fa-gears" 
           data-color="linear-gradient(135deg, #f97316, #c2410c)" 
           data-description="Automates deployment pipelines, ensures infrastructure reliability, and streamlines developer productivity."
           data-skills="Docker, Kubernetes, Jenkins, GitLab CI/CD, Ansible, Linux, Prometheus"
           data-pathway="Degree in CS/IT + hands-on DevOps tooling & cloud certifications."
           data-companies="Red Hat, HashiCorp, Flipkart, PhonePe, Razorpay, Swiggy">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #c2410c);"><i class="fa-solid fa-gears"></i></div>
          <div>
            <h4>DevOps & Platform Engineer</h4>
            <span class="category-badge">Cloud & DevOps</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Full Stack Web Developer -->
      <div class="marquee-card" 
           data-title="Full Stack Web Developer" 
           data-category="Web Development" 
           data-icon="fa-solid fa-code" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Engineers end-to-end responsive web applications from dynamic UI frontends to high-performance database backends."
           data-skills="React.js, Next.js, Node.js, TypeScript, PostgreSQL, REST APIs, Tailwind CSS"
           data-pathway="BCA / B.Tech or self-taught web dev portfolio with production projects."
           data-companies="Zomato, CRED, Freshworks, Postman, Zoho, Global Tech Hubs">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-code"></i></div>
          <div>
            <h4>Full Stack Web Developer</h4>
            <span class="category-badge">Web Development</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Mobile App Developer -->
      <div class="marquee-card" 
           data-title="Mobile App Developer" 
           data-category="App Development" 
           data-icon="fa-solid fa-mobile-screen-button" 
           data-color="linear-gradient(135deg, #6366f1, #4338ca)" 
           data-description="Crafts high-performance, fluid iOS and Android mobile experiences enjoyed by millions of daily users."
           data-skills="Flutter, React Native, Swift, Kotlin, Jetpack Compose, Firebase, App Store CI/CD"
           data-pathway="B.Tech CSE, BCA, or specialized cross-platform mobile developer bootcamps."
           data-companies="Paytm, Uber, Swiggy, Zepto, Spotify India, Dream11">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #6366f1, #4338ca);"><i class="fa-solid fa-mobile-screen-button"></i></div>
          <div>
            <h4>Mobile App Developer</h4>
            <span class="category-badge">App Development</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Blockchain Developer -->
      <div class="marquee-card" 
           data-title="Blockchain Developer" 
           data-category="Emerging Tech" 
           data-icon="fa-solid fa-cubes" 
           data-color="linear-gradient(135deg, #e11d48, #9f1239)" 
           data-description="Architects decentralized smart contracts, DeFi protocols, and cryptographically secure distributed ledgers."
           data-skills="Solidity, Ethereum, Rust, Web3.js, Smart Contract Auditing, Cryptography"
           data-pathway="Degree in Computer Science + Web3 fellowship / decentralized app development projects."
           data-companies="Polygon, Coinbase, CoinDCX, ConsenSys, Chainlink, Web3 Startups">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #9f1239);"><i class="fa-solid fa-cubes"></i></div>
          <div>
            <h4>Blockchain Developer</h4>
            <span class="category-badge">Emerging Tech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 35L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: UI / UX Product Designer -->
      <div class="marquee-card" 
           data-title="UI / UX Product Designer" 
           data-category="Design & Tech" 
           data-icon="fa-solid fa-bezier-curve" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Researches user behaviors, crafts wireframes, and prototypes seamless digital product interfaces."
           data-skills="Figma, User Research, Wireframing, Design Systems, Usability Testing, Micro-interactions"
           data-pathway="B.Des (Interaction/Communication Design) from NID/IITs, or UX Design Bootcamp portfolio."
           data-companies="Apple, Google, Adobe, Swiggy, Airbnb, CRED, Flipkart">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-bezier-curve"></i></div>
          <div>
            <h4>UI / UX Product Designer</h4>
            <span class="category-badge">Design & Tech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Robotics & Automation Engineer -->
      <div class="marquee-card" 
           data-title="Robotics & Automation Engineer" 
           data-category="Robotics" 
           data-icon="fa-solid fa-robot" 
           data-color="linear-gradient(135deg, #0ea5e9, #0284c7)" 
           data-description="Designs autonomous robots, factory automation lines, and robotic vision hardware for smart industries."
           data-skills="ROS (Robot OS), C++, Embedded Systems, Sensor Fusion, Kinematics, CAD"
           data-pathway="B.Tech in Robotics / Mechatronics / Electrical Engineering + M.Tech in Robotics."
           data-companies="Tesla, Boston Dynamics, GreyOrange, Fanuc, ABB Robotics, DRDO">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);"><i class="fa-solid fa-robot"></i></div>
          <div>
            <h4>Robotics & Automation Engineer</h4>
            <span class="category-badge">Robotics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Aerospace & Aeronautical Engineer -->
      <div class="marquee-card" 
           data-title="Aerospace & Aeronautical Engineer" 
           data-category="Aerospace" 
           data-icon="fa-solid fa-plane-up" 
           data-color="linear-gradient(135deg, #2563eb, #1e40af)" 
           data-description="Researches, designs, and tests aircraft, satellites, launch rockets, and defense propulsion systems."
           data-skills="Aerodynamics, Propulsion, CFD, Flight Mechanics, ANSYS, CATIA"
           data-pathway="B.Tech in Aerospace/Aeronautical Engineering (IITs/IIST) + GATE for ISRO/DRDO."
           data-companies="ISRO, HAL, Boeing, Airbus, DRDO, Skyroot Aerospace, Agnikul Cosmos">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1e40af);"><i class="fa-solid fa-plane-up"></i></div>
          <div>
            <h4>Aerospace & Aeronautical Engineer</h4>
            <span class="category-badge">Aerospace</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 30L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: VLSI & Chip Design Engineer -->
      <div class="marquee-card" 
           data-title="VLSI & Chip Design Engineer" 
           data-category="Semiconductors" 
           data-icon="fa-solid fa-microchip" 
           data-color="linear-gradient(135deg, #84cc16, #4d7c0f)" 
           data-description="Architects microprocessors, silicon chips, and integrated circuit layouts powering next-gen devices."
           data-skills="Verilog, VHDL, SystemVerilog, FPGA, Synopsys EDA, CMOS, Static Timing Analysis"
           data-pathway="B.Tech in ECE / Electrical Engineering + M.Tech in VLSI Design."
           data-companies="Qualcomm, Intel, NVIDIA, Texas Instruments, AMD, MediaTek">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #84cc16, #4d7c0f);"><i class="fa-solid fa-microchip"></i></div>
          <div>
            <h4>VLSI & Chip Design Engineer</h4>
            <span class="category-badge">Semiconductors</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 36L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Mechanical Design Engineer -->
      <div class="marquee-card" 
           data-title="Mechanical Design Engineer" 
           data-category="Core Engineering" 
           data-icon="fa-solid fa-cogs" 
           data-color="linear-gradient(135deg, #64748b, #334155)" 
           data-description="Conceptualizes, prototypes, and stress-tests mechanical machinery, turbines, and consumer hardware."
           data-skills="SolidWorks, AutoCAD, FEA Analysis, Thermodynamics, GD&T, 3D Prototyping"
           data-pathway="B.Tech in Mechanical Engineering + CAD/CAM industry certifications."
           data-companies="Tata Motors, Larsen & Toubro, Mahindra & Mahindra, Bosch, Siemens">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #64748b, #334155);"><i class="fa-solid fa-cogs"></i></div>
          <div>
            <h4>Mechanical Design Engineer</h4>
            <span class="category-badge">Core Engineering</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Civil & Structural Engineer -->
      <div class="marquee-card" 
           data-title="Civil & Structural Engineer" 
           data-category="Core Engineering" 
           data-icon="fa-solid fa-building" 
           data-color="linear-gradient(135deg, #d97706, #b45309)" 
           data-description="Plans, oversees, and validates mega infrastructure projects including highways, bridges, and skyscrapers."
           data-skills="STAAD Pro, ETABS, Revit, Structural Analysis, Project Planning, Site Surveying"
           data-pathway="B.Tech in Civil Engineering + M.Tech in Structural Engineering."
           data-companies="L&T Construction, Shapoorji Pallonji, NHAI, DLF, Tata Projects">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d97706, #b45309);"><i class="fa-solid fa-building"></i></div>
          <div>
            <h4>Civil & Structural Engineer</h4>
            <span class="category-badge">Core Engineering</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Electrical & EV Systems Engineer -->
      <div class="marquee-card" 
           data-title="Electrical & EV Systems Engineer" 
           data-category="EV & CleanTech" 
           data-icon="fa-solid fa-bolt-lightning" 
           data-color="linear-gradient(135deg, #eab308, #ca8a04)" 
           data-description="Engineers electric vehicle battery packs, motor controllers, smart grids, and EV charging stations."
           data-skills="Battery Management Systems (BMS), MATLAB/Simulink, Power Electronics, CAN Bus"
           data-pathway="B.Tech in Electrical / Electronics Engineering + specialization in EV technologies."
           data-companies="Ather Energy, Ola Electric, Tata Elxsi, Tesla, Mahindra Electric">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #eab308, #ca8a04);"><i class="fa-solid fa-bolt-lightning"></i></div>
          <div>
            <h4>Electrical & EV Systems Engineer</h4>
            <span class="category-badge">EV & CleanTech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 25L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Renewable Energy Engineer -->
      <div class="marquee-card" 
           data-title="Renewable Energy Engineer" 
           data-category="CleanTech" 
           data-icon="fa-solid fa-solar-panel" 
           data-color="linear-gradient(135deg, #10b981, #059669)" 
           data-description="Designs solar farms, wind power parks, and sustainable energy storage grids for clean power transition."
           data-skills="PVsyst, Solar Photovoltaics, Grid Synchronization, Energy Auditing, AutoCAD"
           data-pathway="B.Tech in Electrical / Energy / Mechanical Engineering + Green Energy certifications."
           data-companies="Adani Green Energy, Tata Power Solar, ReNew Power, Suzlon, NTPC">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fa-solid fa-solar-panel"></i></div>
          <div>
            <h4>Renewable Energy Engineer</h4>
            <span class="category-badge">CleanTech</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 20L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: Biomedical Engineer -->
      <div class="marquee-card" 
           data-title="Biomedical Engineer" 
           data-category="Biomedical" 
           data-icon="fa-solid fa-heart-pulse" 
           data-color="linear-gradient(135deg, #f43f5e, #be123c)" 
           data-description="Innovates robotic surgical tools, prosthetics, dialysis systems, and diagnostic medical imaging equipment."
           data-skills="Medical Device Regulation, Biomechanics, Biomedical Instrumentation, MATLAB, Signal Processing"
           data-pathway="B.Tech in Biomedical Engineering / Biotechnology + clinical tech internships."
           data-companies="GE Healthcare, Siemens Healthineers, Philips Healthcare, Medtronic, Dräger">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f43f5e, #be123c);"><i class="fa-solid fa-heart-pulse"></i></div>
          <div>
            <h4>Biomedical Engineer</h4>
            <span class="category-badge">Biomedical</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Game Developer -->
      <div class="marquee-card" 
           data-title="Game Developer" 
           data-category="Gaming & XR" 
           data-icon="fa-solid fa-gamepad" 
           data-color="linear-gradient(135deg, #a855f7, #7e22ce)" 
           data-description="Programs real-time physics engines, 3D graphics shaders, gameplay mechanics, and multiplayer architectures."
           data-skills="Unreal Engine, Unity, C++, C#, HLSL Shaders, 3D Math, Multiplayer Networking"
           data-pathway="B.Tech in Computer Science / Game Development or Game Programming diploma."
           data-companies="Ubisoft, Rockstar Games, Electronic Arts, Krafton, Epic Games India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #a855f7, #7e22ce);"><i class="fa-solid fa-gamepad"></i></div>
          <div>
            <h4>Game Developer</h4>
            <span class="category-badge">Gaming & XR</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 25L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: AR / VR Specialist -->
      <div class="marquee-card" 
           data-title="AR / VR Specialist" 
           data-category="Spatial Computing" 
           data-icon="fa-solid fa-vr-cardboard" 
           data-color="linear-gradient(135deg, #06b6d4, #0891b2)" 
           data-description="Crafts immersive spatial computing experiences, virtual training simulators, and mixed-reality apps."
           data-skills="OpenXR, Unity/Unreal, Spatial Audio, 3D Rigging, C#, Meta Quest SDK"
           data-pathway="Degree in CS, Multimedia, or Animation with spatial computing portfolio."
           data-companies="Meta Reality Labs, Apple Vision Pro Labs, HTC Vive, Infosys XR Studio">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #0891b2);"><i class="fa-solid fa-vr-cardboard"></i></div>
          <div>
            <h4>AR / VR Specialist</h4>
            <span class="category-badge">Spatial Computing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 28L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Big Data Engineer -->
      <div class="marquee-card" 
           data-title="Big Data Engineer" 
           data-category="Data Infrastructure" 
           data-icon="fa-solid fa-database" 
           data-color="linear-gradient(135deg, #059669, #047857)" 
           data-description="Manages petabyte-scale data lakes, distributed query engines, and transactional database clusters."
           data-skills="PostgreSQL, MongoDB, Apache Spark, Kafka, Snowflake, Hadoop, Redis"
           data-pathway="B.Tech in CSE / IT + Big Data & Cloud DB certifications."
           data-companies="Snowflake, Oracle, Databricks, Morgan Stanley, Reliance Jio, TCS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #047857);"><i class="fa-solid fa-database"></i></div>
          <div>
            <h4>Big Data Engineer</h4>
            <span class="category-badge">Data Infrastructure</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6.5L - 26L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: QA Automation & SDET -->
      <div class="marquee-card" 
           data-title="QA Automation & SDET" 
           data-category="Quality Assurance" 
           data-icon="fa-solid fa-bug" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Architects robust automated test frameworks, regression suites, and load-testing pipelines for software."
           data-skills="Selenium, Playwright, Cypress, Java, Python, JMeter, CI/CD Integration"
           data-pathway="B.Tech in CSE/IT or BCA/MCA with SDET automation test suite experience."
           data-companies="Cognizant, Infosys, Capgemini, Flipkart, American Express, IBM">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-bug"></i></div>
          <div>
            <h4>QA Automation & SDET</h4>
            <span class="category-badge">Quality Assurance</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: NLP Engineer -->
      <div class="marquee-card" 
           data-title="NLP Engineer" 
           data-category="Artificial Intelligence" 
           data-icon="fa-solid fa-comments" 
           data-color="linear-gradient(135deg, #7c3aed, #5b21b6)" 
           data-description="Trains Transformer models, multilingual chatbots, generative AI agents, and speech recognition engines."
           data-skills="Hugging Face, Transformers, LangChain, LlamaIndex, Vector DBs, PyTorch, Tokenization"
           data-pathway="Master's or B.Tech in AI/ML, Computational Linguistics, or Computer Science."
           data-companies="Cohere, Anthropic, Google, Sarvam AI, Jio Haptik, Microsoft">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #5b21b6);"><i class="fa-solid fa-comments"></i></div>
          <div>
            <h4>NLP Engineer</h4>
            <span class="category-badge">Artificial Intelligence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Automobile Engineer -->
      <div class="marquee-card" 
           data-title="Automobile Engineer" 
           data-category="Automotive" 
           data-icon="fa-solid fa-car" 
           data-color="linear-gradient(135deg, #b45309, #78350f)" 
           data-description="Designs internal chassis, hybrid transmissions, aerodynamic car bodies, and telemetry sensors."
           data-skills="IC Engines, Chassis Dynamics, MATLAB, CATIA, Aerodynamics, Crash Testing"
           data-pathway="B.Tech in Automobile / Mechanical Engineering + SAE BAJA / Formula Student participation."
           data-companies="Maruti Suzuki, Hyundai India, Mahindra, Bajaj Auto, TVS Motors">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #b45309, #78350f);"><i class="fa-solid fa-car"></i></div>
          <div>
            <h4>Automobile Engineer</h4>
            <span class="category-badge">Automotive</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.8L - 19L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Chemical Engineer -->
      <div class="marquee-card" 
           data-title="Chemical Engineer" 
           data-category="Chemical & Process" 
           data-icon="fa-solid fa-flask-vial" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Optimizes large-scale chemical reactors, petrochemical distillation towers, and polymer synthesis lines."
           data-skills="Aspen Plus, Mass Transfer, Chemical Kinetics, Process Safety, Piping & Instrumentation"
           data-pathway="B.Tech in Chemical Engineering + GATE for PSU careers (IOCL, ONGC, BPCL)."
           data-companies="Reliance Industries, ONGC, BPCL, BASF, Asian Paints, UPL">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-flask-vial"></i></div>
          <div>
            <h4>Chemical Engineer</h4>
            <span class="category-badge">Chemical & Process</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Technical Product Manager -->
      <div class="marquee-card" 
           data-title="Technical Product Manager" 
           data-category="Product Management" 
           data-icon="fa-solid fa-diagram-project" 
           data-color="linear-gradient(135deg, #4f46e5, #3730a3)" 
           data-description="Bridges engineering, business goals, and UX to launch industry-defining technology platforms."
           data-skills="Product Strategy, Agile/Scrum, User Stories, System Architecture, Metrics Tracking, Roadmapping"
           data-pathway="B.Tech in Engineering + MBA from top B-Schools (IIM/ISB) or strong tech PM experience."
           data-companies="Google, Microsoft, Atlassian, Razorpay, Uber, MakeMyTrip">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #4f46e5, #3730a3);"><i class="fa-solid fa-diagram-project"></i></div>
          <div>
            <h4>Technical Product Manager</h4>
            <span class="category-badge">Product Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹14L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Track: marquee-track-2 -->
  <div class="marquee-container marquee-track-2">
    <div class="marquee-inner marquee-reverse">
      <!-- Card: MBBS General Physician -->
      <div class="marquee-card" 
           data-title="MBBS General Physician" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-stethoscope" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Diagnoses acute and chronic medical conditions, administers preventative primary care, and manages clinical wellness."
           data-skills="Clinical Diagnosis, Pharmacotherapy, Patient Assessment, Emergency Care, Medical Ethics"
           data-pathway="5.5-Year MBBS (NEET-UG qualified) + 1-year compulsory rotating hospital internship."
           data-companies="AIIMS, Apollo Hospitals, Fortis, Max Healthcare, Private Practice, Armed Forces Medical Services">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-stethoscope"></i></div>
          <div>
            <h4>MBBS General Physician</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Interventional Cardiologist -->
      <div class="marquee-card" 
           data-title="Interventional Cardiologist" 
           data-category="Medical Super-Specialty" 
           data-icon="fa-solid fa-heart" 
           data-color="linear-gradient(135deg, #dc2626, #7f1d1d)" 
           data-description="Specializes in diagnosing and treating cardiovascular diseases, performing angioplasties, and managing heart failure."
           data-skills="Cardiac Angiography, Stent Placement, Echocardiography, Catheterization, Intensive Cardiac Care"
           data-pathway="MBBS + MD (General Medicine) + DM in Cardiology (NEET-SS qualified)."
           data-companies="Narayana Health, Medanta The Medicity, Fortis Escorts, Apollo Heart Centre">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #7f1d1d);"><i class="fa-solid fa-heart"></i></div>
          <div>
            <h4>Interventional Cardiologist</h4>
            <span class="category-badge">Medical Super-Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹20L - 75L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Orthopedic Surgeon -->
      <div class="marquee-card" 
           data-title="Orthopedic Surgeon" 
           data-category="Surgical Specialty" 
           data-icon="fa-solid fa-bone" 
           data-color="linear-gradient(135deg, #ea580c, #9a3412)" 
           data-description="Performs joint replacement surgeries, corrects spine trauma, reconstructs ligaments, and restores musculoskeletal mobility."
           data-skills="Arthroscopy, Knee/Hip Arthroplasty, Fracture Fixation, Trauma Surgery, Bone Biomechanics"
           data-pathway="MBBS + MS in Orthopedics + M.Ch or specialized arthroplasty fellowship."
           data-companies="Ganga Hospital Coimbatore, Max Healthcare, Apollo Orthopedics, Manipal Hospitals">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ea580c, #9a3412);"><i class="fa-solid fa-bone"></i></div>
          <div>
            <h4>Orthopedic Surgeon</h4>
            <span class="category-badge">Surgical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹15L - 60L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Pediatrician & Neonatologist -->
      <div class="marquee-card" 
           data-title="Pediatrician & Neonatologist" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-baby" 
           data-color="linear-gradient(135deg, #ec4899, #9d174d)" 
           data-description="Cares for newborn infants, children, and adolescents, treating developmental disorders and childhood diseases."
           data-skills="Pediatric Resuscitation, NICU/PICU Care, Child Immunization, Growth Monitoring"
           data-pathway="MBBS + MD in Pediatrics / DNB Pediatrics + Fellowship in Neonatology."
           data-companies="Rainbow Children's Hospital, Cloudnine, Surya Hospitals, AIIMS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #9d174d);"><i class="fa-solid fa-baby"></i></div>
          <div>
            <h4>Pediatrician & Neonatologist</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 35L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Dermatologist & Cosmetologist -->
      <div class="marquee-card" 
           data-title="Dermatologist & Cosmetologist" 
           data-category="Medical Specialty" 
           data-icon="fa-solid fa-hand-holding-medical" 
           data-color="linear-gradient(135deg, #db2777, #831843)" 
           data-description="Treats skin, hair, and nail pathology alongside cosmetic laser procedures, aesthetic therapies, and derma-surgery."
           data-skills="Dermatosurgery, Laser Therapies, Trichology, Chemical Peels, Clinical Dermatology"
           data-pathway="MBBS + MD in Dermatology, Venereology & Leprosy (DVD/DNB)."
           data-companies="Kaya Skin Clinic, Oliva Skin & Hair, Max Healthcare, Private Aesthetics Clinics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #db2777, #831843);"><i class="fa-solid fa-hand-holding-medical"></i></div>
          <div>
            <h4>Dermatologist & Cosmetologist</h4>
            <span class="category-badge">Medical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Radiologist & Imaging Expert -->
      <div class="marquee-card" 
           data-title="Radiologist & Imaging Expert" 
           data-category="Diagnostic Medicine" 
           data-icon="fa-solid fa-x-ray" 
           data-color="linear-gradient(135deg, #0284c7, #0c4a6e)" 
           data-description="Diagnoses complex conditions by interpreting MRI scans, CT scans, ultrasounds, and mammograms."
           data-skills="MRI/CT Interpretation, Ultrasound, PET-CT, Interventional Radiology, Teleradiology"
           data-pathway="MBBS + MD/DNB in Radio-diagnosis (NEET-PG top ranks)."
           data-companies="Vijaya Diagnostic, Dr. Lal PathLabs, Mahajan Imaging, Apollo Hospitals, Medanta">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0c4a6e);"><i class="fa-solid fa-x-ray"></i></div>
          <div>
            <h4>Radiologist & Imaging Expert</h4>
            <span class="category-badge">Diagnostic Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹15L - 55L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: General & Laparoscopic Surgeon -->
      <div class="marquee-card" 
           data-title="General & Laparoscopic Surgeon" 
           data-category="Surgical Specialty" 
           data-icon="fa-solid fa-scissors" 
           data-color="linear-gradient(135deg, #e11d48, #881337)" 
           data-description="Performs minimally invasive abdominal surgeries, trauma interventions, and surgical oncology procedures."
           data-skills="Laparoscopic Surgery, Appendectomy, Hernia Repair, Surgical Asepsis, Trauma Management"
           data-pathway="MBBS + MS in General Surgery + fellowship in Minimal Access Surgery (FMAS)."
           data-companies="Max Healthcare, Fortis Hospitals, Sir Ganga Ram Hospital, Army Medical Corps">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #881337);"><i class="fa-solid fa-scissors"></i></div>
          <div>
            <h4>General & Laparoscopic Surgeon</h4>
            <span class="category-badge">Surgical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹14L - 50L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Anesthesiologist & ICU Doctor -->
      <div class="marquee-card" 
           data-title="Anesthesiologist & ICU Doctor" 
           data-category="Critical Care" 
           data-icon="fa-solid fa-syringe" 
           data-color="linear-gradient(135deg, #7c3aed, #4c1d95)" 
           data-description="Administers general and regional anesthesia during surgeries and monitors vital organ functions in intensive care units."
           data-skills="Endotracheal Intubation, Epidural Anesthesia, Hemodynamic Monitoring, ICU Ventilator Management"
           data-pathway="MBBS + MD in Anesthesiology / DNB + IDCCM (Critical Care Fellowship)."
           data-companies="Multi-specialty Surgical Hospitals, Cardiac Centers, Trauma Institutes">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #4c1d95);"><i class="fa-solid fa-syringe"></i></div>
          <div>
            <h4>Anesthesiologist & ICU Doctor</h4>
            <span class="category-badge">Critical Care</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Psychiatrist & Neuropsychiatrist -->
      <div class="marquee-card" 
           data-title="Psychiatrist & Neuropsychiatrist" 
           data-category="Mental Health" 
           data-icon="fa-solid fa-head-side-virus" 
           data-color="linear-gradient(135deg, #9333ea, #581c87)" 
           data-description="Diagnoses and treats complex mental health disorders, psychoses, depression, and chemical dependencies through pharmacotherapy."
           data-skills="Psychopharmacology, Psychiatric Evaluation, Cognitive Assessments, Psychotherapy Integration"
           data-pathway="MBBS + MD in Psychiatry / DNB Psychiatry."
           data-companies="NIMHANS Bengaluru, CIP Ranchi, Apollo Behavioral Health, Private Clinics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #9333ea, #581c87);"><i class="fa-solid fa-head-side-virus"></i></div>
          <div>
            <h4>Psychiatrist & Neuropsychiatrist</h4>
            <span class="category-badge">Mental Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: BAMS Ayurvedic Doctor -->
      <div class="marquee-card" 
           data-title="BAMS Ayurvedic Doctor" 
           data-category="AYUSH & Wellness" 
           data-icon="fa-solid fa-leaf" 
           data-color="linear-gradient(135deg, #16a34a, #14532d)" 
           data-description="Practices holistic healthcare through herbal pharmacology, Nadi Pariksha, Panchakarma detox, and lifestyle balance."
           data-skills="Nadi Pariksha, Ayurvedic Formulations, Panchakarma Therapy, Dietetics & Dinacharya"
           data-pathway="5.5-Year BAMS (Bachelor of Ayurvedic Medicine and Surgery) + MD (Ayurveda)."
           data-companies="Patanjali, Kottakkal Arya Vaidya Sala, Dabur Clinics, Kerala Ayurveda Resorts">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #16a34a, #14532d);"><i class="fa-solid fa-leaf"></i></div>
          <div>
            <h4>BAMS Ayurvedic Doctor</h4>
            <span class="category-badge">AYUSH & Wellness</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: BDS Dental Surgeon -->
      <div class="marquee-card" 
           data-title="BDS Dental Surgeon" 
           data-category="Dental Medicine" 
           data-icon="fa-solid fa-tooth" 
           data-color="linear-gradient(135deg, #0ea5e9, #0369a1)" 
           data-description="Diagnoses and treats oral diseases, performs root canals, teeth extractions, and cosmetic smiles restorations."
           data-skills="Root Canal Treatment (RCT), Prosthodontics, Dental Implants, Oral Radiography, Cosmetic Dentistry"
           data-pathway="5-Year BDS (Bachelor of Dental Surgery) + MDS (Orthodontics / Endodontics)."
           data-companies="Clove Dental, Apollo White Dental, Private Dental Clinics, Govt Dental Colleges">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0ea5e9, #0369a1);"><i class="fa-solid fa-tooth"></i></div>
          <div>
            <h4>BDS Dental Surgeon</h4>
            <span class="category-badge">Dental Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: BHMS Homeopathic Doctor -->
      <div class="marquee-card" 
           data-title="BHMS Homeopathic Doctor" 
           data-category="AYUSH & Wellness" 
           data-icon="fa-solid fa-seedling" 
           data-color="linear-gradient(135deg, #65a30d, #365314)" 
           data-description="Treats chronic ailments using the law of similars, constitutional remedies, and individualized natural medicine."
           data-skills="Homeopathic Case Taking, Materia Medica, Repertorization, Chronic Disease Management"
           data-pathway="5.5-Year BHMS (Bachelor of Homeopathic Medicine and Surgery) + MD (Homeopathy)."
           data-companies="Dr. Batra's Healthcare, Bakson's, SBL Clinics, Private Holistic Practices">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #65a30d, #365314);"><i class="fa-solid fa-seedling"></i></div>
          <div>
            <h4>BHMS Homeopathic Doctor</h4>
            <span class="category-badge">AYUSH & Wellness</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 15L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Pharmacist -->
      <div class="marquee-card" 
           data-title="Clinical Pharmacist" 
           data-category="Pharmaceuticals" 
           data-icon="fa-solid fa-pills" 
           data-color="linear-gradient(135deg, #f59e0b, #b45309)" 
           data-description="Formulates lifesaving drug compositions, evaluates drug interactions, and conducts quality assurance in pharma plants."
           data-skills="Drug Formulations, HPLC, GMP Regulations, Pharmacovigilance, Dosage Optimization"
           data-pathway="B.Pharm / Pharm.D + M.Pharm in Pharmaceutics or Clinical Pharmacology."
           data-companies="Sun Pharma, Dr. Reddy's Laboratories, Cipla, Lupin, Pfizer India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #b45309);"><i class="fa-solid fa-pills"></i></div>
          <div>
            <h4>Clinical Pharmacist</h4>
            <span class="category-badge">Pharmaceuticals</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Physiotherapist & Sports Rehab -->
      <div class="marquee-card" 
           data-title="Physiotherapist & Sports Rehab" 
           data-category="Physical Therapy" 
           data-icon="fa-solid fa-person-walking" 
           data-color="linear-gradient(135deg, #10b981, #065f46)" 
           data-description="Restores physical mobility, relieves chronic pain, and rehabilitates professional athletes following sports injuries."
           data-skills="Manual Therapy, Electrotherapy, Kinesiology, Sports Injury Rehabilitation, Ergonomics"
           data-pathway="4.5-Year BPT (Bachelor of Physiotherapy) + MPT in Sports / Orthopedics / Neurology."
           data-companies="Sports Authority of India (SAI), IPL Teams, Apollo Rehab, QI Spine Clinic">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #065f46);"><i class="fa-solid fa-person-walking"></i></div>
          <div>
            <h4>Physiotherapist & Sports Rehab</h4>
            <span class="category-badge">Physical Therapy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Psychologist -->
      <div class="marquee-card" 
           data-title="Clinical Psychologist" 
           data-category="Mental Health" 
           data-icon="fa-solid fa-brain" 
           data-color="linear-gradient(135deg, #a855f7, #6b21a8)" 
           data-description="Evaluates mental conditions using psychometric testing and provides evidence-based therapies (CBT, DBT, psychoanalysis)."
           data-skills="Cognitive Behavioral Therapy (CBT), Psychometric Assessments, Crisis Intervention, Counseling"
           data-pathway="B.A./B.Sc in Psychology + M.Sc / M.A. + M.Phil in Clinical Psychology (RCI recognized)."
           data-companies="NIMHANS, Fortis Mental Health, Vandrevala Foundation, Mindler, Private Counseling">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #a855f7, #6b21a8);"><i class="fa-solid fa-brain"></i></div>
          <div>
            <h4>Clinical Psychologist</h4>
            <span class="category-badge">Mental Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Nursing Officer & Specialist -->
      <div class="marquee-card" 
           data-title="Nursing Officer & Specialist" 
           data-category="Healthcare Nursing" 
           data-icon="fa-solid fa-user-nurse" 
           data-color="linear-gradient(135deg, #06b6d4, #155e75)" 
           data-description="Delivers compassionate bedside care, administers medication, coordinates patient recovery, and supports surgical teams."
           data-skills="Patient Triage, IV Administration, Vital Signs Monitoring, Infection Control, ICU Nursing"
           data-pathway="B.Sc Nursing (4 years) + State Nursing Council Registration / Post Basic B.Sc."
           data-companies="AIIMS (NORCET exam), NHS UK, Apollo Hospitals, Medanta, Gulf Healthcare">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #155e75);"><i class="fa-solid fa-user-nurse"></i></div>
          <div>
            <h4>Nursing Officer & Specialist</h4>
            <span class="category-badge">Healthcare Nursing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L (India) / ₹25L+ (Abroad)</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Medical Lab Technologist -->
      <div class="marquee-card" 
           data-title="Medical Lab Technologist" 
           data-category="Diagnostics" 
           data-icon="fa-solid fa-microscope" 
           data-color="linear-gradient(135deg, #3b82f6, #1e3a8a)" 
           data-description="Analyzes blood samples, cultures, biopsies, and bodily fluids using automated hematology and biochemical analyzers."
           data-skills="Hematology, Clinical Biochemistry, Histopathology, ELISA, Quality Control"
           data-pathway="B.Sc in Medical Laboratory Technology (BMLT) + M.Sc MLT."
           data-companies="Lal PathLabs, SRL Diagnostics, Metropolis Healthcare, Thyrocare">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1e3a8a);"><i class="fa-solid fa-microscope"></i></div>
          <div>
            <h4>Medical Lab Technologist</h4>
            <span class="category-badge">Diagnostics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.2L - 10L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Optometrist & Vision Scientist -->
      <div class="marquee-card" 
           data-title="Optometrist & Vision Scientist" 
           data-category="Allied Health" 
           data-icon="fa-solid fa-eye" 
           data-color="linear-gradient(135deg, #14b8a6, #0f766e)" 
           data-description="Examines visual acuity, detects ocular pathologies, prescribes corrective lenses, and fits therapeutic contact lenses."
           data-skills="Refraction, Retinoscopy, Contact Lens Fitting, Glaucoma Screening, Low Vision Aids"
           data-pathway="4-Year Bachelor of Optometry (B.Optom) + Master of Optometry."
           data-companies="Lenskart, Titan Eyeplus, Sankara Nethralaya, L V Prasad Eye Institute">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #14b8a6, #0f766e);"><i class="fa-solid fa-eye"></i></div>
          <div>
            <h4>Optometrist & Vision Scientist</h4>
            <span class="category-badge">Allied Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 12L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Occupational Therapist -->
      <div class="marquee-card" 
           data-title="Occupational Therapist" 
           data-category="Rehabilitation" 
           data-icon="fa-solid fa-hands-holding" 
           data-color="linear-gradient(135deg, #f97316, #9a3412)" 
           data-description="Helps individuals recover everyday functional motor and sensory skills impaired by injuries or neurological conditions."
           data-skills="Sensory Integration, ADL Training, Pediatric Motor Skills, Splinting, Ergonomics"
           data-pathway="4.5-Year Bachelor of Occupational Therapy (BOT) + MOT."
           data-companies="Specialized Rehabilitation Centers, Child Development Clinics, AIIMS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #9a3412);"><i class="fa-solid fa-hands-holding"></i></div>
          <div>
            <h4>Occupational Therapist</h4>
            <span class="category-badge">Rehabilitation</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 14L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Speech-Language Pathologist -->
      <div class="marquee-card" 
           data-title="Speech-Language Pathologist" 
           data-category="Allied Health" 
           data-icon="fa-solid fa-ear-listen" 
           data-color="linear-gradient(135deg, #8b5cf6, #581c87)" 
           data-description="Diagnoses and treats speech fluency, voice disorders, swallowing difficulties, and hearing impairments."
           data-skills="Pure Tone Audiometry, Hearing Aid Programming, Speech Therapy, Dysphagia Care"
           data-pathway="4-Year BASLP (Bachelor in Audiology and Speech-Language Pathology) + MASLP."
           data-companies="AIISH Mysuru, Hear.com, Cochlear India, ENT Clinics, Special Education Schools">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #581c87);"><i class="fa-solid fa-ear-listen"></i></div>
          <div>
            <h4>Speech-Language Pathologist</h4>
            <span class="category-badge">Allied Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 15L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Biotechnologist & Geneticist -->
      <div class="marquee-card" 
           data-title="Biotechnologist & Geneticist" 
           data-category="Biotechnology" 
           data-icon="fa-solid fa-dna" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Conducts gene editing, recombinant DNA research, stem cell engineering, and develops biological vaccines."
           data-skills="CRISPR-Cas9, PCR, DNA Sequencing, Gel Electrophoresis, Cell Culture, Bioinformatics"
           data-pathway="B.Tech / B.Sc in Biotechnology + M.Sc / M.Tech / Ph.D in Genetics or Molecular Biology."
           data-companies="Biocon, Bharat Biotech, Serum Institute of India, Syngene, Novozymes">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-dna"></i></div>
          <div>
            <h4>Biotechnologist & Geneticist</h4>
            <span class="category-badge">Biotechnology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Research Associate -->
      <div class="marquee-card" 
           data-title="Clinical Research Associate" 
           data-category="Clinical Research" 
           data-icon="fa-solid fa-clipboard-check" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Monitors clinical drug trials across hospitals, ensuring strict adherence to GCP, safety protocols, and FDA guidelines."
           data-skills="Good Clinical Practice (GCP), Protocol Compliance, Trial Monitoring, Regulatory Reporting"
           data-pathway="B.Pharm / M.Pharm / M.Sc Life Sciences + Post Graduate Diploma in Clinical Research (PGDCR)."
           data-companies="IQVIA, ICON plc, Parexel, Syneos Health, Novartis, AstraZeneca">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-clipboard-check"></i></div>
          <div>
            <h4>Clinical Research Associate</h4>
            <span class="category-badge">Clinical Research</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Registered Clinical Dietitian -->
      <div class="marquee-card" 
           data-title="Registered Clinical Dietitian" 
           data-category="Nutrition & Dietetics" 
           data-icon="fa-solid fa-apple-whole" 
           data-color="linear-gradient(135deg, #84cc16, #3f6212)" 
           data-description="Formulates specialized medical nutritional therapies for diabetes, cardiovascular disease, weight loss, and athletic performance."
           data-skills="Nutritional Assessment, Medical Dietetics, Macro Planning, BMR Calculation, Patient Counseling"
           data-pathway="B.Sc in Food & Nutrition / Dietetics + M.Sc + Registered Dietitian (RD) exam."
           data-companies="HealthifyMe, Apollo Hospitals, VLCC, Cult.fit, Sports Academies">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #84cc16, #3f6212);"><i class="fa-solid fa-apple-whole"></i></div>
          <div>
            <h4>Registered Clinical Dietitian</h4>
            <span class="category-badge">Nutrition & Dietetics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 14L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Veterinary Doctor -->
      <div class="marquee-card" 
           data-title="Veterinary Doctor" 
           data-category="Veterinary Sciences" 
           data-icon="fa-solid fa-paw" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Diagnoses and surgically treats domestic companion animals, exotic wildlife, and farm livestock."
           data-skills="Veterinary Surgery, Animal Diagnostics, Zoonotic Disease Control, Pharmacology"
           data-pathway="5.5-Year B.V.Sc & A.H. (NEET-UG qualified) + State Veterinary Council Registration."
           data-companies="Max Vets, DCC Animal Hospital, Government Veterinary Polyclinics, Zoos, Wildlife Trusts">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-paw"></i></div>
          <div>
            <h4>Veterinary Doctor</h4>
            <span class="category-badge">Veterinary Sciences</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Forensic Pathologist -->
      <div class="marquee-card" 
           data-title="Forensic Pathologist" 
           data-category="Forensic Medicine" 
           data-icon="fa-solid fa-fingerprint" 
           data-color="linear-gradient(135deg, #475569, #1e293b)" 
           data-description="Conducts autopsies, investigates unnatural deaths, and provides conclusive medical evidence for criminal courts."
           data-skills="Medico-Legal Autopsy, Forensic Toxicology, Injury Pattern Analysis, Expert Court Testimony"
           data-pathway="MBBS + MD in Forensic Medicine & Toxicology."
           data-companies="State Forensic Science Laboratories (FSL), Central FSL, Govt Medical Colleges, CBI">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #475569, #1e293b);"><i class="fa-solid fa-fingerprint"></i></div>
          <div>
            <h4>Forensic Pathologist</h4>
            <span class="category-badge">Forensic Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 25L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Industrial Microbiologist -->
      <div class="marquee-card" 
           data-title="Industrial Microbiologist" 
           data-category="Microbiology" 
           data-icon="fa-solid fa-virus-covid" 
           data-color="linear-gradient(135deg, #059669, #064e3b)" 
           data-description="Harnesses microorganisms for industrial fermentation, vaccine production, bioplastics, and food preservation."
           data-skills="Microbial Culture, Fermentation Technology, Sterility Testing, Aseptic Techniques, QC"
           data-pathway="B.Sc in Microbiology + M.Sc / Ph.D in Industrial Microbiology or Applied Microbiology."
           data-companies="Amul, Carlsberg, United Breweries, Biocon, Mother Dairy, Food Testing Labs">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #064e3b);"><i class="fa-solid fa-virus-covid"></i></div>
          <div>
            <h4>Industrial Microbiologist</h4>
            <span class="category-badge">Microbiology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>

      <!-- Duplicated for seamless marquee loop -->
      <!-- Card: MBBS General Physician -->
      <div class="marquee-card" 
           data-title="MBBS General Physician" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-stethoscope" 
           data-color="linear-gradient(135deg, #ef4444, #b91c1c)" 
           data-description="Diagnoses acute and chronic medical conditions, administers preventative primary care, and manages clinical wellness."
           data-skills="Clinical Diagnosis, Pharmacotherapy, Patient Assessment, Emergency Care, Medical Ethics"
           data-pathway="5.5-Year MBBS (NEET-UG qualified) + 1-year compulsory rotating hospital internship."
           data-companies="AIIMS, Apollo Hospitals, Fortis, Max Healthcare, Private Practice, Armed Forces Medical Services">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i class="fa-solid fa-stethoscope"></i></div>
          <div>
            <h4>MBBS General Physician</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Interventional Cardiologist -->
      <div class="marquee-card" 
           data-title="Interventional Cardiologist" 
           data-category="Medical Super-Specialty" 
           data-icon="fa-solid fa-heart" 
           data-color="linear-gradient(135deg, #dc2626, #7f1d1d)" 
           data-description="Specializes in diagnosing and treating cardiovascular diseases, performing angioplasties, and managing heart failure."
           data-skills="Cardiac Angiography, Stent Placement, Echocardiography, Catheterization, Intensive Cardiac Care"
           data-pathway="MBBS + MD (General Medicine) + DM in Cardiology (NEET-SS qualified)."
           data-companies="Narayana Health, Medanta The Medicity, Fortis Escorts, Apollo Heart Centre">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #7f1d1d);"><i class="fa-solid fa-heart"></i></div>
          <div>
            <h4>Interventional Cardiologist</h4>
            <span class="category-badge">Medical Super-Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹20L - 75L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Orthopedic Surgeon -->
      <div class="marquee-card" 
           data-title="Orthopedic Surgeon" 
           data-category="Surgical Specialty" 
           data-icon="fa-solid fa-bone" 
           data-color="linear-gradient(135deg, #ea580c, #9a3412)" 
           data-description="Performs joint replacement surgeries, corrects spine trauma, reconstructs ligaments, and restores musculoskeletal mobility."
           data-skills="Arthroscopy, Knee/Hip Arthroplasty, Fracture Fixation, Trauma Surgery, Bone Biomechanics"
           data-pathway="MBBS + MS in Orthopedics + M.Ch or specialized arthroplasty fellowship."
           data-companies="Ganga Hospital Coimbatore, Max Healthcare, Apollo Orthopedics, Manipal Hospitals">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ea580c, #9a3412);"><i class="fa-solid fa-bone"></i></div>
          <div>
            <h4>Orthopedic Surgeon</h4>
            <span class="category-badge">Surgical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹15L - 60L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Pediatrician & Neonatologist -->
      <div class="marquee-card" 
           data-title="Pediatrician & Neonatologist" 
           data-category="Healthcare" 
           data-icon="fa-solid fa-baby" 
           data-color="linear-gradient(135deg, #ec4899, #9d174d)" 
           data-description="Cares for newborn infants, children, and adolescents, treating developmental disorders and childhood diseases."
           data-skills="Pediatric Resuscitation, NICU/PICU Care, Child Immunization, Growth Monitoring"
           data-pathway="MBBS + MD in Pediatrics / DNB Pediatrics + Fellowship in Neonatology."
           data-companies="Rainbow Children's Hospital, Cloudnine, Surya Hospitals, AIIMS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #9d174d);"><i class="fa-solid fa-baby"></i></div>
          <div>
            <h4>Pediatrician & Neonatologist</h4>
            <span class="category-badge">Healthcare</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 35L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Dermatologist & Cosmetologist -->
      <div class="marquee-card" 
           data-title="Dermatologist & Cosmetologist" 
           data-category="Medical Specialty" 
           data-icon="fa-solid fa-hand-holding-medical" 
           data-color="linear-gradient(135deg, #db2777, #831843)" 
           data-description="Treats skin, hair, and nail pathology alongside cosmetic laser procedures, aesthetic therapies, and derma-surgery."
           data-skills="Dermatosurgery, Laser Therapies, Trichology, Chemical Peels, Clinical Dermatology"
           data-pathway="MBBS + MD in Dermatology, Venereology & Leprosy (DVD/DNB)."
           data-companies="Kaya Skin Clinic, Oliva Skin & Hair, Max Healthcare, Private Aesthetics Clinics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #db2777, #831843);"><i class="fa-solid fa-hand-holding-medical"></i></div>
          <div>
            <h4>Dermatologist & Cosmetologist</h4>
            <span class="category-badge">Medical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Radiologist & Imaging Expert -->
      <div class="marquee-card" 
           data-title="Radiologist & Imaging Expert" 
           data-category="Diagnostic Medicine" 
           data-icon="fa-solid fa-x-ray" 
           data-color="linear-gradient(135deg, #0284c7, #0c4a6e)" 
           data-description="Diagnoses complex conditions by interpreting MRI scans, CT scans, ultrasounds, and mammograms."
           data-skills="MRI/CT Interpretation, Ultrasound, PET-CT, Interventional Radiology, Teleradiology"
           data-pathway="MBBS + MD/DNB in Radio-diagnosis (NEET-PG top ranks)."
           data-companies="Vijaya Diagnostic, Dr. Lal PathLabs, Mahajan Imaging, Apollo Hospitals, Medanta">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0c4a6e);"><i class="fa-solid fa-x-ray"></i></div>
          <div>
            <h4>Radiologist & Imaging Expert</h4>
            <span class="category-badge">Diagnostic Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹15L - 55L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: General & Laparoscopic Surgeon -->
      <div class="marquee-card" 
           data-title="General & Laparoscopic Surgeon" 
           data-category="Surgical Specialty" 
           data-icon="fa-solid fa-scissors" 
           data-color="linear-gradient(135deg, #e11d48, #881337)" 
           data-description="Performs minimally invasive abdominal surgeries, trauma interventions, and surgical oncology procedures."
           data-skills="Laparoscopic Surgery, Appendectomy, Hernia Repair, Surgical Asepsis, Trauma Management"
           data-pathway="MBBS + MS in General Surgery + fellowship in Minimal Access Surgery (FMAS)."
           data-companies="Max Healthcare, Fortis Hospitals, Sir Ganga Ram Hospital, Army Medical Corps">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #881337);"><i class="fa-solid fa-scissors"></i></div>
          <div>
            <h4>General & Laparoscopic Surgeon</h4>
            <span class="category-badge">Surgical Specialty</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹14L - 50L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Anesthesiologist & ICU Doctor -->
      <div class="marquee-card" 
           data-title="Anesthesiologist & ICU Doctor" 
           data-category="Critical Care" 
           data-icon="fa-solid fa-syringe" 
           data-color="linear-gradient(135deg, #7c3aed, #4c1d95)" 
           data-description="Administers general and regional anesthesia during surgeries and monitors vital organ functions in intensive care units."
           data-skills="Endotracheal Intubation, Epidural Anesthesia, Hemodynamic Monitoring, ICU Ventilator Management"
           data-pathway="MBBS + MD in Anesthesiology / DNB + IDCCM (Critical Care Fellowship)."
           data-companies="Multi-specialty Surgical Hospitals, Cardiac Centers, Trauma Institutes">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #4c1d95);"><i class="fa-solid fa-syringe"></i></div>
          <div>
            <h4>Anesthesiologist & ICU Doctor</h4>
            <span class="category-badge">Critical Care</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Psychiatrist & Neuropsychiatrist -->
      <div class="marquee-card" 
           data-title="Psychiatrist & Neuropsychiatrist" 
           data-category="Mental Health" 
           data-icon="fa-solid fa-head-side-virus" 
           data-color="linear-gradient(135deg, #9333ea, #581c87)" 
           data-description="Diagnoses and treats complex mental health disorders, psychoses, depression, and chemical dependencies through pharmacotherapy."
           data-skills="Psychopharmacology, Psychiatric Evaluation, Cognitive Assessments, Psychotherapy Integration"
           data-pathway="MBBS + MD in Psychiatry / DNB Psychiatry."
           data-companies="NIMHANS Bengaluru, CIP Ranchi, Apollo Behavioral Health, Private Clinics">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #9333ea, #581c87);"><i class="fa-solid fa-head-side-virus"></i></div>
          <div>
            <h4>Psychiatrist & Neuropsychiatrist</h4>
            <span class="category-badge">Mental Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: BAMS Ayurvedic Doctor -->
      <div class="marquee-card" 
           data-title="BAMS Ayurvedic Doctor" 
           data-category="AYUSH & Wellness" 
           data-icon="fa-solid fa-leaf" 
           data-color="linear-gradient(135deg, #16a34a, #14532d)" 
           data-description="Practices holistic healthcare through herbal pharmacology, Nadi Pariksha, Panchakarma detox, and lifestyle balance."
           data-skills="Nadi Pariksha, Ayurvedic Formulations, Panchakarma Therapy, Dietetics & Dinacharya"
           data-pathway="5.5-Year BAMS (Bachelor of Ayurvedic Medicine and Surgery) + MD (Ayurveda)."
           data-companies="Patanjali, Kottakkal Arya Vaidya Sala, Dabur Clinics, Kerala Ayurveda Resorts">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #16a34a, #14532d);"><i class="fa-solid fa-leaf"></i></div>
          <div>
            <h4>BAMS Ayurvedic Doctor</h4>
            <span class="category-badge">AYUSH & Wellness</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: BDS Dental Surgeon -->
      <div class="marquee-card" 
           data-title="BDS Dental Surgeon" 
           data-category="Dental Medicine" 
           data-icon="fa-solid fa-tooth" 
           data-color="linear-gradient(135deg, #0ea5e9, #0369a1)" 
           data-description="Diagnoses and treats oral diseases, performs root canals, teeth extractions, and cosmetic smiles restorations."
           data-skills="Root Canal Treatment (RCT), Prosthodontics, Dental Implants, Oral Radiography, Cosmetic Dentistry"
           data-pathway="5-Year BDS (Bachelor of Dental Surgery) + MDS (Orthodontics / Endodontics)."
           data-companies="Clove Dental, Apollo White Dental, Private Dental Clinics, Govt Dental Colleges">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0ea5e9, #0369a1);"><i class="fa-solid fa-tooth"></i></div>
          <div>
            <h4>BDS Dental Surgeon</h4>
            <span class="category-badge">Dental Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: BHMS Homeopathic Doctor -->
      <div class="marquee-card" 
           data-title="BHMS Homeopathic Doctor" 
           data-category="AYUSH & Wellness" 
           data-icon="fa-solid fa-seedling" 
           data-color="linear-gradient(135deg, #65a30d, #365314)" 
           data-description="Treats chronic ailments using the law of similars, constitutional remedies, and individualized natural medicine."
           data-skills="Homeopathic Case Taking, Materia Medica, Repertorization, Chronic Disease Management"
           data-pathway="5.5-Year BHMS (Bachelor of Homeopathic Medicine and Surgery) + MD (Homeopathy)."
           data-companies="Dr. Batra's Healthcare, Bakson's, SBL Clinics, Private Holistic Practices">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #65a30d, #365314);"><i class="fa-solid fa-seedling"></i></div>
          <div>
            <h4>BHMS Homeopathic Doctor</h4>
            <span class="category-badge">AYUSH & Wellness</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 15L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Pharmacist -->
      <div class="marquee-card" 
           data-title="Clinical Pharmacist" 
           data-category="Pharmaceuticals" 
           data-icon="fa-solid fa-pills" 
           data-color="linear-gradient(135deg, #f59e0b, #b45309)" 
           data-description="Formulates lifesaving drug compositions, evaluates drug interactions, and conducts quality assurance in pharma plants."
           data-skills="Drug Formulations, HPLC, GMP Regulations, Pharmacovigilance, Dosage Optimization"
           data-pathway="B.Pharm / Pharm.D + M.Pharm in Pharmaceutics or Clinical Pharmacology."
           data-companies="Sun Pharma, Dr. Reddy's Laboratories, Cipla, Lupin, Pfizer India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #b45309);"><i class="fa-solid fa-pills"></i></div>
          <div>
            <h4>Clinical Pharmacist</h4>
            <span class="category-badge">Pharmaceuticals</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Physiotherapist & Sports Rehab -->
      <div class="marquee-card" 
           data-title="Physiotherapist & Sports Rehab" 
           data-category="Physical Therapy" 
           data-icon="fa-solid fa-person-walking" 
           data-color="linear-gradient(135deg, #10b981, #065f46)" 
           data-description="Restores physical mobility, relieves chronic pain, and rehabilitates professional athletes following sports injuries."
           data-skills="Manual Therapy, Electrotherapy, Kinesiology, Sports Injury Rehabilitation, Ergonomics"
           data-pathway="4.5-Year BPT (Bachelor of Physiotherapy) + MPT in Sports / Orthopedics / Neurology."
           data-companies="Sports Authority of India (SAI), IPL Teams, Apollo Rehab, QI Spine Clinic">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #065f46);"><i class="fa-solid fa-person-walking"></i></div>
          <div>
            <h4>Physiotherapist & Sports Rehab</h4>
            <span class="category-badge">Physical Therapy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Psychologist -->
      <div class="marquee-card" 
           data-title="Clinical Psychologist" 
           data-category="Mental Health" 
           data-icon="fa-solid fa-brain" 
           data-color="linear-gradient(135deg, #a855f7, #6b21a8)" 
           data-description="Evaluates mental conditions using psychometric testing and provides evidence-based therapies (CBT, DBT, psychoanalysis)."
           data-skills="Cognitive Behavioral Therapy (CBT), Psychometric Assessments, Crisis Intervention, Counseling"
           data-pathway="B.A./B.Sc in Psychology + M.Sc / M.A. + M.Phil in Clinical Psychology (RCI recognized)."
           data-companies="NIMHANS, Fortis Mental Health, Vandrevala Foundation, Mindler, Private Counseling">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #a855f7, #6b21a8);"><i class="fa-solid fa-brain"></i></div>
          <div>
            <h4>Clinical Psychologist</h4>
            <span class="category-badge">Mental Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Nursing Officer & Specialist -->
      <div class="marquee-card" 
           data-title="Nursing Officer & Specialist" 
           data-category="Healthcare Nursing" 
           data-icon="fa-solid fa-user-nurse" 
           data-color="linear-gradient(135deg, #06b6d4, #155e75)" 
           data-description="Delivers compassionate bedside care, administers medication, coordinates patient recovery, and supports surgical teams."
           data-skills="Patient Triage, IV Administration, Vital Signs Monitoring, Infection Control, ICU Nursing"
           data-pathway="B.Sc Nursing (4 years) + State Nursing Council Registration / Post Basic B.Sc."
           data-companies="AIIMS (NORCET exam), NHS UK, Apollo Hospitals, Medanta, Gulf Healthcare">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #06b6d4, #155e75);"><i class="fa-solid fa-user-nurse"></i></div>
          <div>
            <h4>Nursing Officer & Specialist</h4>
            <span class="category-badge">Healthcare Nursing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L (India) / ₹25L+ (Abroad)</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Medical Lab Technologist -->
      <div class="marquee-card" 
           data-title="Medical Lab Technologist" 
           data-category="Diagnostics" 
           data-icon="fa-solid fa-microscope" 
           data-color="linear-gradient(135deg, #3b82f6, #1e3a8a)" 
           data-description="Analyzes blood samples, cultures, biopsies, and bodily fluids using automated hematology and biochemical analyzers."
           data-skills="Hematology, Clinical Biochemistry, Histopathology, ELISA, Quality Control"
           data-pathway="B.Sc in Medical Laboratory Technology (BMLT) + M.Sc MLT."
           data-companies="Lal PathLabs, SRL Diagnostics, Metropolis Healthcare, Thyrocare">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #3b82f6, #1e3a8a);"><i class="fa-solid fa-microscope"></i></div>
          <div>
            <h4>Medical Lab Technologist</h4>
            <span class="category-badge">Diagnostics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.2L - 10L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Optometrist & Vision Scientist -->
      <div class="marquee-card" 
           data-title="Optometrist & Vision Scientist" 
           data-category="Allied Health" 
           data-icon="fa-solid fa-eye" 
           data-color="linear-gradient(135deg, #14b8a6, #0f766e)" 
           data-description="Examines visual acuity, detects ocular pathologies, prescribes corrective lenses, and fits therapeutic contact lenses."
           data-skills="Refraction, Retinoscopy, Contact Lens Fitting, Glaucoma Screening, Low Vision Aids"
           data-pathway="4-Year Bachelor of Optometry (B.Optom) + Master of Optometry."
           data-companies="Lenskart, Titan Eyeplus, Sankara Nethralaya, L V Prasad Eye Institute">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #14b8a6, #0f766e);"><i class="fa-solid fa-eye"></i></div>
          <div>
            <h4>Optometrist & Vision Scientist</h4>
            <span class="category-badge">Allied Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 12L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Occupational Therapist -->
      <div class="marquee-card" 
           data-title="Occupational Therapist" 
           data-category="Rehabilitation" 
           data-icon="fa-solid fa-hands-holding" 
           data-color="linear-gradient(135deg, #f97316, #9a3412)" 
           data-description="Helps individuals recover everyday functional motor and sensory skills impaired by injuries or neurological conditions."
           data-skills="Sensory Integration, ADL Training, Pediatric Motor Skills, Splinting, Ergonomics"
           data-pathway="4.5-Year Bachelor of Occupational Therapy (BOT) + MOT."
           data-companies="Specialized Rehabilitation Centers, Child Development Clinics, AIIMS">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #9a3412);"><i class="fa-solid fa-hands-holding"></i></div>
          <div>
            <h4>Occupational Therapist</h4>
            <span class="category-badge">Rehabilitation</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 14L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Speech-Language Pathologist -->
      <div class="marquee-card" 
           data-title="Speech-Language Pathologist" 
           data-category="Allied Health" 
           data-icon="fa-solid fa-ear-listen" 
           data-color="linear-gradient(135deg, #8b5cf6, #581c87)" 
           data-description="Diagnoses and treats speech fluency, voice disorders, swallowing difficulties, and hearing impairments."
           data-skills="Pure Tone Audiometry, Hearing Aid Programming, Speech Therapy, Dysphagia Care"
           data-pathway="4-Year BASLP (Bachelor in Audiology and Speech-Language Pathology) + MASLP."
           data-companies="AIISH Mysuru, Hear.com, Cochlear India, ENT Clinics, Special Education Schools">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #581c87);"><i class="fa-solid fa-ear-listen"></i></div>
          <div>
            <h4>Speech-Language Pathologist</h4>
            <span class="category-badge">Allied Health</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 15L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Biotechnologist & Geneticist -->
      <div class="marquee-card" 
           data-title="Biotechnologist & Geneticist" 
           data-category="Biotechnology" 
           data-icon="fa-solid fa-dna" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Conducts gene editing, recombinant DNA research, stem cell engineering, and develops biological vaccines."
           data-skills="CRISPR-Cas9, PCR, DNA Sequencing, Gel Electrophoresis, Cell Culture, Bioinformatics"
           data-pathway="B.Tech / B.Sc in Biotechnology + M.Sc / M.Tech / Ph.D in Genetics or Molecular Biology."
           data-companies="Biocon, Bharat Biotech, Serum Institute of India, Syngene, Novozymes">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-dna"></i></div>
          <div>
            <h4>Biotechnologist & Geneticist</h4>
            <span class="category-badge">Biotechnology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Clinical Research Associate -->
      <div class="marquee-card" 
           data-title="Clinical Research Associate" 
           data-category="Clinical Research" 
           data-icon="fa-solid fa-clipboard-check" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Monitors clinical drug trials across hospitals, ensuring strict adherence to GCP, safety protocols, and FDA guidelines."
           data-skills="Good Clinical Practice (GCP), Protocol Compliance, Trial Monitoring, Regulatory Reporting"
           data-pathway="B.Pharm / M.Pharm / M.Sc Life Sciences + Post Graduate Diploma in Clinical Research (PGDCR)."
           data-companies="IQVIA, ICON plc, Parexel, Syneos Health, Novartis, AstraZeneca">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-clipboard-check"></i></div>
          <div>
            <h4>Clinical Research Associate</h4>
            <span class="category-badge">Clinical Research</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Registered Clinical Dietitian -->
      <div class="marquee-card" 
           data-title="Registered Clinical Dietitian" 
           data-category="Nutrition & Dietetics" 
           data-icon="fa-solid fa-apple-whole" 
           data-color="linear-gradient(135deg, #84cc16, #3f6212)" 
           data-description="Formulates specialized medical nutritional therapies for diabetes, cardiovascular disease, weight loss, and athletic performance."
           data-skills="Nutritional Assessment, Medical Dietetics, Macro Planning, BMR Calculation, Patient Counseling"
           data-pathway="B.Sc in Food & Nutrition / Dietetics + M.Sc + Registered Dietitian (RD) exam."
           data-companies="HealthifyMe, Apollo Hospitals, VLCC, Cult.fit, Sports Academies">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #84cc16, #3f6212);"><i class="fa-solid fa-apple-whole"></i></div>
          <div>
            <h4>Registered Clinical Dietitian</h4>
            <span class="category-badge">Nutrition & Dietetics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹3.5L - 14L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Veterinary Doctor -->
      <div class="marquee-card" 
           data-title="Veterinary Doctor" 
           data-category="Veterinary Sciences" 
           data-icon="fa-solid fa-paw" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Diagnoses and surgically treats domestic companion animals, exotic wildlife, and farm livestock."
           data-skills="Veterinary Surgery, Animal Diagnostics, Zoonotic Disease Control, Pharmacology"
           data-pathway="5.5-Year B.V.Sc & A.H. (NEET-UG qualified) + State Veterinary Council Registration."
           data-companies="Max Vets, DCC Animal Hospital, Government Veterinary Polyclinics, Zoos, Wildlife Trusts">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-paw"></i></div>
          <div>
            <h4>Veterinary Doctor</h4>
            <span class="category-badge">Veterinary Sciences</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 18L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Demand</span>
        </div>
      </div>
      <!-- Card: Forensic Pathologist -->
      <div class="marquee-card" 
           data-title="Forensic Pathologist" 
           data-category="Forensic Medicine" 
           data-icon="fa-solid fa-fingerprint" 
           data-color="linear-gradient(135deg, #475569, #1e293b)" 
           data-description="Conducts autopsies, investigates unnatural deaths, and provides conclusive medical evidence for criminal courts."
           data-skills="Medico-Legal Autopsy, Forensic Toxicology, Injury Pattern Analysis, Expert Court Testimony"
           data-pathway="MBBS + MD in Forensic Medicine & Toxicology."
           data-companies="State Forensic Science Laboratories (FSL), Central FSL, Govt Medical Colleges, CBI">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #475569, #1e293b);"><i class="fa-solid fa-fingerprint"></i></div>
          <div>
            <h4>Forensic Pathologist</h4>
            <span class="category-badge">Forensic Medicine</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 25L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Industrial Microbiologist -->
      <div class="marquee-card" 
           data-title="Industrial Microbiologist" 
           data-category="Microbiology" 
           data-icon="fa-solid fa-virus-covid" 
           data-color="linear-gradient(135deg, #059669, #064e3b)" 
           data-description="Harnesses microorganisms for industrial fermentation, vaccine production, bioplastics, and food preservation."
           data-skills="Microbial Culture, Fermentation Technology, Sterility Testing, Aseptic Techniques, QC"
           data-pathway="B.Sc in Microbiology + M.Sc / Ph.D in Industrial Microbiology or Applied Microbiology."
           data-companies="Amul, Carlsberg, United Breweries, Biocon, Mother Dairy, Food Testing Labs">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #064e3b);"><i class="fa-solid fa-virus-covid"></i></div>
          <div>
            <h4>Industrial Microbiologist</h4>
            <span class="category-badge">Microbiology</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 16L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Track: marquee-track-3 -->
  <div class="marquee-container marquee-track-3">
    <div class="marquee-inner">
      <!-- Card: Chartered Accountant (CA) -->
      <div class="marquee-card" 
           data-title="Chartered Accountant (CA)" 
           data-category="Finance & Audit" 
           data-icon="fa-solid fa-calculator" 
           data-color="linear-gradient(135deg, #f59e0b, #b45309)" 
           data-description="Manages financial auditing, corporate taxation, statutory compliance, and strategic financial management."
           data-skills="Financial Auditing, Direct & Indirect Tax (GST), Ind AS/IFRS, Financial Reporting, Forensic Audit"
           data-pathway="ICAI Foundation + Intermediate + 2-3 Years Mandatory Articleship + CA Final."
           data-companies="Big 4 (Deloitte, PwC, EY, KPMG), BDO, Reliance, Tata Sons, Private CA Practice">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #b45309);"><i class="fa-solid fa-calculator"></i></div>
          <div>
            <h4>Chartered Accountant (CA)</h4>
            <span class="category-badge">Finance & Audit</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Investment Banker -->
      <div class="marquee-card" 
           data-title="Investment Banker" 
           data-category="Investment Banking" 
           data-icon="fa-solid fa-hand-holding-dollar" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Structures high-stakes mergers and acquisitions (M&A), initial public offerings (IPOs), and corporate debt restructuring."
           data-skills="Financial Modeling, DCF Valuation, Pitch Decks, M&A Diligence, Capital Markets"
           data-pathway="Top B-School MBA (IIM A/B/C) or CFA Charterholder + B.Com/B.Tech background."
           data-companies="Goldman Sachs, JPMorgan Chase, Morgan Stanley, Avendus Capital, Kotak Investment Banking">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-hand-holding-dollar"></i></div>
          <div>
            <h4>Investment Banker</h4>
            <span class="category-badge">Investment Banking</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹16L - 55L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Portfolio Manager (CFA) -->
      <div class="marquee-card" 
           data-title="Portfolio Manager (CFA)" 
           data-category="Wealth Management" 
           data-icon="fa-solid fa-chart-line" 
           data-color="linear-gradient(135deg, #2563eb, #1e40af)" 
           data-description="Manages multi-asset investment portfolios, evaluates mutual funds, equities, and alternative asset classes."
           data-skills="Equity Research, Fixed Income, Portfolio Optimization, Derivatives, Risk Management"
           data-pathway="Clear CFA Level I, II, and III exams (CFA Institute, USA) + 36 months of relevant work experience."
           data-companies="BlackRock, Fidelity Investments, ICICI Prudential AMC, HDFC Mutual Fund, Nomura">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1e40af);"><i class="fa-solid fa-chart-line"></i></div>
          <div>
            <h4>Portfolio Manager (CFA)</h4>
            <span class="category-badge">Wealth Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 40L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Management Consultant -->
      <div class="marquee-card" 
           data-title="Management Consultant" 
           data-category="Strategy Consulting" 
           data-icon="fa-solid fa-briefcase" 
           data-color="linear-gradient(135deg, #6366f1, #3730a3)" 
           data-description="Solves complex operational, strategic, and cost-efficiency challenges for Fortune 500 leadership."
           data-skills="Problem Structuring, MECE Framework, Case Analysis, Financial Feasibility, Executive Presentations"
           data-pathway="MBA from premier institutions (IIM, ISB, Harvard, INSEAD) or top-tier undergraduate engineering."
           data-companies="McKinsey & Company, Boston Consulting Group (BCG), Bain & Company, Oliver Wyman">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #6366f1, #3730a3);"><i class="fa-solid fa-briefcase"></i></div>
          <div>
            <h4>Management Consultant</h4>
            <span class="category-badge">Strategy Consulting</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹18L - 50L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Corporate Lawyer -->
      <div class="marquee-card" 
           data-title="Corporate Lawyer" 
           data-category="Corporate Law" 
           data-icon="fa-solid fa-scale-balanced" 
           data-color="linear-gradient(135deg, #8b5cf6, #581c87)" 
           data-description="Drafts high-value contracts, guides corporate governance, and oversees regulatory compliance during business acquisitions."
           data-skills="Contract Drafting, Due Diligence, Companies Act, Arbitration, Commercial Negotiation"
           data-pathway="5-Year Integrated BA/BBA LLB from NLUs (CLAT exam) + Bar Council of India (AIBE) license."
           data-companies="Cyril Amarchand Mangaldas, Shardul Amarchand, Khaitan & Co, Trilegal, In-House MNC Legal">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #581c87);"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <h4>Corporate Lawyer</h4>
            <span class="category-badge">Corporate Law</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: IAS Officer (Civil Services) -->
      <div class="marquee-card" 
           data-title="IAS Officer (Civil Services)" 
           data-category="Civil Services" 
           data-icon="fa-solid fa-landmark-dome" 
           data-color="linear-gradient(135deg, #d97706, #92400e)" 
           data-description="Leads district administration, implements national public policy, and heads government ministries and departments."
           data-skills="Public Administration, Crisis Leadership, Policy Formulation, Governance, Law & Order"
           data-pathway="Any Bachelor's Degree + cracking the UPSC Civil Services Examination (Prelims, Mains, Interview)."
           data-companies="Government of India, State Governments, Cabinet Secretariat, NITI Aayog">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d97706, #92400e);"><i class="fa-solid fa-landmark-dome"></i></div>
          <div>
            <h4>IAS Officer (Civil Services)</h4>
            <span class="category-badge">Civil Services</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 25L + Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: IPS Officer (Police) -->
      <div class="marquee-card" 
           data-title="IPS Officer (Police)" 
           data-category="Law Enforcement" 
           data-icon="fa-solid fa-shield" 
           data-color="linear-gradient(135deg, #dc2626, #7f1d1d)" 
           data-description="Commands police forces, maintains public order, investigates serious crimes, and directs national internal security."
           data-skills="Crime Investigation, Intelligence Gathering, Tactical Operations, Public Order Management"
           data-pathway="Any Bachelor's Degree + UPSC Civil Services Examination (Top Police Service rank)."
           data-companies="Indian Police Service, Intelligence Bureau (IB), RAW, CBI, NIA, State Police">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #7f1d1d);"><i class="fa-solid fa-shield"></i></div>
          <div>
            <h4>IPS Officer (Police)</h4>
            <span class="category-badge">Law Enforcement</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 24L + Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: Commercial Airline Pilot -->
      <div class="marquee-card" 
           data-title="Commercial Airline Pilot" 
           data-category="Aviation" 
           data-icon="fa-solid fa-plane-departure" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Navigates commercial jetliners across domestic and international skies adhering to stringent flight safety standards."
           data-skills="Flight Instrumentation, Cockpit Resource Management, Meteorology, Emergency Protocols"
           data-pathway="10+2 with Physics & Math + Commercial Pilot License (CPL) training (200 flying hours) + Type Rating."
           data-companies="IndiGo, Air India, Emirates, Singapore Airlines, Qatar Airways">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-plane-departure"></i></div>
          <div>
            <h4>Commercial Airline Pilot</h4>
            <span class="category-badge">Aviation</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹18L - 75L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Actuary & Risk Scientist -->
      <div class="marquee-card" 
           data-title="Actuary & Risk Scientist" 
           data-category="Actuarial Science" 
           data-icon="fa-solid fa-chart-line-down" 
           data-color="linear-gradient(135deg, #059669, #064e3b)" 
           data-description="Calculates statistical probabilities of future events to price insurance policies and safeguard pension funds."
           data-skills="Actuarial Mathematics, Stochastic Modeling, Probability, Life Insurance Pricing, R/Python"
           data-pathway="Passing Actuarial examinations conducted by IAI (India) or IFoA (UK)."
           data-companies="LIC of India, Swiss Re, Munich Re, HDFC Life, Max Life, Aon Hewitt">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #064e3b);"><i class="fa-solid fa-chart-line-down"></i></div>
          <div>
            <h4>Actuary & Risk Scientist</h4>
            <span class="category-badge">Actuarial Science</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Armed Forces Officer -->
      <div class="marquee-card" 
           data-title="Armed Forces Officer" 
           data-category="National Defence" 
           data-icon="fa-solid fa-medal" 
           data-color="linear-gradient(135deg, #65a30d, #365314)" 
           data-description="Commands combat units, safeguards territorial sovereignty, and leads tactical strategic defense operations."
           data-skills="Military Tactics, Combat Leadership, Weaponry Systems, Strategic Decision Making"
           data-pathway="NDA (after 12th) or CDS / AFCAT exam (after graduation) + 5-day SSB interview."
           data-companies="Indian Army, Indian Navy, Indian Air Force">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #65a30d, #365314);"><i class="fa-solid fa-medal"></i></div>
          <div>
            <h4>Armed Forces Officer</h4>
            <span class="category-badge">National Defence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 28L + Honors</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Honor</span>
        </div>
      </div>
      <!-- Card: Judicial Magistrate & Judge -->
      <div class="marquee-card" 
           data-title="Judicial Magistrate & Judge" 
           data-category="Judiciary" 
           data-icon="fa-solid fa-gavel" 
           data-color="linear-gradient(135deg, #78350f, #451a03)" 
           data-description="Presides over courtroom trials, evaluates legal evidence, and delivers binding judgments in civil and criminal law."
           data-skills="Jurisprudence, Statutory Interpretation, Court Procedure, Legal Analysis, Impartiality"
           data-pathway="LLB Degree + cracking State Judicial Services Examination (PCS-J)."
           data-companies="District & Sessions Courts, High Courts of India, Supreme Court">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #78350f, #451a03);"><i class="fa-solid fa-gavel"></i></div>
          <div>
            <h4>Judicial Magistrate & Judge</h4>
            <span class="category-badge">Judiciary</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 26L + Judicial Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Chief HR Officer (CHRO) -->
      <div class="marquee-card" 
           data-title="Chief HR Officer (CHRO)" 
           data-category="Human Resources" 
           data-icon="fa-solid fa-users-gear" 
           data-color="linear-gradient(135deg, #ec4899, #9d174d)" 
           data-description="Directs talent acquisition, employee retention frameworks, executive compensation, and enterprise company culture."
           data-skills="Talent Management, Organizational Development, Labor Laws, Compensation & Benefits, HR Analytics"
           data-pathway="MBA in Human Resources (XLRI, TISS, IIMs) or equivalent Masters in HR."
           data-companies="Google, Unilever, Reliance Industries, Tata Consultancy Services, HDFC Bank">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #9d174d);"><i class="fa-solid fa-users-gear"></i></div>
          <div>
            <h4>Chief HR Officer (CHRO)</h4>
            <span class="category-badge">Human Resources</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Digital Marketing Director -->
      <div class="marquee-card" 
           data-title="Digital Marketing Director" 
           data-category="Marketing" 
           data-icon="fa-solid fa-bullhorn" 
           data-color="linear-gradient(135deg, #f97316, #c2410c)" 
           data-description="Scales customer acquisition channels, optimizes conversion funnels, and leads viral multi-channel marketing campaigns."
           data-skills="Performance Marketing, SEO/SEM, Google Analytics 4, Meta Ads, Growth Hacking, Retention"
           data-pathway="Bachelor's degree + proven growth portfolio or MBA in Marketing."
           data-companies="Nykaa, Mamaearth, Swiggy, Flipkart, Dentsu, GroupM">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #c2410c);"><i class="fa-solid fa-bullhorn"></i></div>
          <div>
            <h4>Digital Marketing Director</h4>
            <span class="category-badge">Marketing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Brand Strategist & Director -->
      <div class="marquee-card" 
           data-title="Brand Strategist & Director" 
           data-category="Advertising" 
           data-icon="fa-solid fa-wand-magic-sparkles" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Crafts compelling brand identities, storytelling narratives, and high-impact advertising campaigns for global consumer brands."
           data-skills="Brand Positioning, Creative Copywriting, Consumer Psychology, Campaign Direction"
           data-pathway="Degree in Mass Communication / Advertising / MBA in Marketing + creative portfolio."
           data-companies="Ogilvy & Mather, McCann Worldgroup, Leo Burnett, DDB Mudra, ITC Brands">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
          <div>
            <h4>Brand Strategist & Director</h4>
            <span class="category-badge">Advertising</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Supply Chain Director -->
      <div class="marquee-card" 
           data-title="Supply Chain Director" 
           data-category="Supply Chain" 
           data-icon="fa-solid fa-truck-fast" 
           data-color="linear-gradient(135deg, #0284c7, #0369a1)" 
           data-description="Optimizes end-to-end global freight movements, warehouse automation, procurement, and inventory replenishment."
           data-skills="ERP (SAP/Oracle), Demand Forecasting, Inventory Optimization, Logistics Analytics, Vendor Management"
           data-pathway="B.Tech / BBA + MBA in Operations / Supply Chain Management (NITIE / IIMs)."
           data-companies="Amazon, DHL, Maersk, Delhivery, Procter & Gamble, Hindustan Unilever">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0369a1);"><i class="fa-solid fa-truck-fast"></i></div>
          <div>
            <h4>Supply Chain Director</h4>
            <span class="category-badge">Supply Chain</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 36L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Film Director & Screenwriter -->
      <div class="marquee-card" 
           data-title="Film Director & Screenwriter" 
           data-category="Media & Entertainment" 
           data-icon="fa-solid fa-clapperboard" 
           data-color="linear-gradient(135deg, #e11d48, #9f1239)" 
           data-description="Directs cinematic vision, guides actors' performances, shapes screenplays, and oversees film production."
           data-skills="Visual Storytelling, Cinematography, Screenwriting, Film Editing, Production Direction"
           data-pathway="Degree / Diploma from FTII Pune, SRFTI Kolkata, Whistling Woods, or filmmaking apprenticeship."
           data-companies="Dharma Productions, Yash Raj Films, Netflix India, Amazon Prime Video, Excel Entertainment">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #9f1239);"><i class="fa-solid fa-clapperboard"></i></div>
          <div>
            <h4>Film Director & Screenwriter</h4>
            <span class="category-badge">Media & Entertainment</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 50L+</strong></span>
          <span style="color: #a855f7; font-weight: 700;">High Passion</span>
        </div>
      </div>
      <!-- Card: Fashion Designer & Couturier -->
      <div class="marquee-card" 
           data-title="Fashion Designer & Couturier" 
           data-category="Fashion Design" 
           data-icon="fa-solid fa-shirt" 
           data-color="linear-gradient(135deg, #d946ef, #a21caf)" 
           data-description="Designs haute couture collections, selects luxury textiles, illustrates fashion lines, and directs runway presentations."
           data-skills="Fashion Illustration, Textile Selection, Garment Construction, Draping, Trend Forecasting"
           data-pathway="4-Year B.Des in Fashion Design from NIFT (National Institute of Fashion Technology) or Pearl Academy."
           data-companies="Sabyasachi, Manish Malhotra, Anita Dongre, Zara, Aditya Birla Fashion & Retail">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d946ef, #a21caf);"><i class="fa-solid fa-shirt"></i></div>
          <div>
            <h4>Fashion Designer & Couturier</h4>
            <span class="category-badge">Fashion Design</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 25L+</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Interior Architect & Designer -->
      <div class="marquee-card" 
           data-title="Interior Architect & Designer" 
           data-category="Interior Design" 
           data-icon="fa-solid fa-couch" 
           data-color="linear-gradient(135deg, #ca8a04, #854d0e)" 
           data-description="Transforms residential luxury estates and commercial workspaces with functional, aesthetic spatial architecture."
           data-skills="3D AutoCAD, SketchUp, 3ds Max, Lighting Design, Material Sourcing, Space Planning"
           data-pathway="B.Des (Interior Design) or B.Arch with specialized interior architecture portfolio."
           data-companies="Livspace, HomeLane, Architect Hafeez Contractor, Urban Ladder, Studio Lotus">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ca8a04, #854d0e);"><i class="fa-solid fa-couch"></i></div>
          <div>
            <h4>Interior Architect & Designer</h4>
            <span class="category-badge">Interior Design</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: 3D Animator & VFX Artist -->
      <div class="marquee-card" 
           data-title="3D Animator & VFX Artist" 
           data-category="Animation & VFX" 
           data-icon="fa-solid fa-dragon" 
           data-color="linear-gradient(135deg, #7c3aed, #4c1d95)" 
           data-description="Creates photorealistic computer-generated imagery (CGI), character animations, and visual effects for blockbusters."
           data-skills="Maya, Blender, Houdini, Nuke, ZBrush, Character Rigging, Compositing"
           data-pathway="Degree / Diploma in Animation & VFX from institutions like MAAC, Arena, or self-taught demo reel."
           data-companies="MPC, DNEG, Redchillies VFX, Framestore, Sony Pictures Imageworks">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #4c1d95);"><i class="fa-solid fa-dragon"></i></div>
          <div>
            <h4>3D Animator & VFX Artist</h4>
            <span class="category-badge">Animation & VFX</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Sports Coach & Performance Director -->
      <div class="marquee-card" 
           data-title="Sports Coach & Performance Director" 
           data-category="Sports & Athletics" 
           data-icon="fa-solid fa-trophy" 
           data-color="linear-gradient(135deg, #eab308, #a16207)" 
           data-description="Trains elite athletes in physical conditioning, tactical play, mental resilience, and sports tournament strategy."
           data-skills="Athletic Conditioning, Biomechanics, Performance Analytics, Tactical Drills, Sports Psychology"
           data-pathway="B.P.Ed / M.P.Ed from NIS Patiala + National federation / AFC / ICC coaching licenses."
           data-companies="Sports Authority of India, BCCI, Indian Super League, Gopichand Badminton Academy">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #eab308, #a16207);"><i class="fa-solid fa-trophy"></i></div>
          <div>
            <h4>Sports Coach & Performance Director</h4>
            <span class="category-badge">Sports & Athletics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 28L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: Event & Experiential Director -->
      <div class="marquee-card" 
           data-title="Event & Experiential Director" 
           data-category="Event Management" 
           data-icon="fa-solid fa-champagne-glasses" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Orchestrates grand luxury weddings, international music festivals, sports leagues, and global corporate summits."
           data-skills="Event Logistics, Vendor Coordination, Budgeting, Stage Production, Crisis Protocol"
           data-pathway="Degree / Diploma in Event Management (NAEMD) or Mass Communication."
           data-companies="Wizcraft, Percept, DNA Networks, Wedding Design Company, Fountainhead MKTG">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-champagne-glasses"></i></div>
          <div>
            <h4>Event & Experiential Director</h4>
            <span class="category-badge">Event Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Investigative Journalist -->
      <div class="marquee-card" 
           data-title="Investigative Journalist" 
           data-category="Journalism & Media" 
           data-icon="fa-solid fa-newspaper" 
           data-color="linear-gradient(135deg, #475569, #0f172a)" 
           data-description="Uncovers public interest stories, investigates corruption, conducts hard-hitting interviews, and crafts editorial features."
           data-skills="Investigative Reporting, Media Ethics, Fact-Checking, Video Journalism, Editorial Writing"
           data-pathway="Bachelor's / Master's in Journalism & Mass Communication (IIMC Delhi, ACJ Chennai)."
           data-companies="The Hindu, Indian Express, BBC News India, NDTV, Reuters, Scroll.in">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #475569, #0f172a);"><i class="fa-solid fa-newspaper"></i></div>
          <div>
            <h4>Investigative Journalist</h4>
            <span class="category-badge">Journalism & Media</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Public Relations (PR) Director -->
      <div class="marquee-card" 
           data-title="Public Relations (PR) Director" 
           data-category="Public Relations" 
           data-icon="fa-solid fa-comments-dollar" 
           data-color="linear-gradient(135deg, #2563eb, #1d4ed8)" 
           data-description="Builds high-profile media relationships, manages corporate crisis communication, and steers executive public image."
           data-skills="Crisis Communication, Press Releases, Media Relations, Strategic Messaging, Media Pitching"
           data-pathway="Degree in Public Relations / Mass Communication / MBA in Marketing."
           data-companies="Edelman, Weber Shandwick, Genesis BCW, Adfactors PR, MSL India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);"><i class="fa-solid fa-comments-dollar"></i></div>
          <div>
            <h4>Public Relations (PR) Director</h4>
            <span class="category-badge">Public Relations</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: General Manager (Hospitality) -->
      <div class="marquee-card" 
           data-title="General Manager (Hospitality)" 
           data-category="Hospitality" 
           data-icon="fa-solid fa-hotel" 
           data-color="linear-gradient(135deg, #b45309, #78350f)" 
           data-description="Manages luxury 5-star hotel properties, oversees VIP guest experiences, F&B operations, and resort profitability."
           data-skills="Hospitality Operations, Revenue Management, Guest Relations, Food & Beverage Standards"
           data-pathway="3-Year B.Sc in Hospitality & Hotel Administration (NCHMCT JEE qualified) + IHM graduation."
           data-companies="The Taj Mahal Palace, Oberoi Hotels & Resorts, ITC Hotels, Marriott International, Hyatt">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #b45309, #78350f);"><i class="fa-solid fa-hotel"></i></div>
          <div>
            <h4>General Manager (Hospitality)</h4>
            <span class="category-badge">Hospitality</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Diplomat & Foreign Service (IFS) -->
      <div class="marquee-card" 
           data-title="Diplomat & Foreign Service (IFS)" 
           data-category="Diplomacy" 
           data-icon="fa-solid fa-earth-americas" 
           data-color="linear-gradient(135deg, #1e40af, #172554)" 
           data-description="Represents the country at embassies worldwide, conducts bilateral trade negotiations, and shapes geopolitical foreign policy."
           data-skills="International Relations, Bilateral Negotiation, Diplomatic Protocol, Foreign Languages"
           data-pathway="Any Bachelor's Degree + UPSC Civil Services Examination (IFS ranking)."
           data-companies="Ministry of External Affairs (MEA), Indian Embassies Worldwide, United Nations (UN)">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #1e40af, #172554);"><i class="fa-solid fa-earth-americas"></i></div>
          <div>
            <h4>Diplomat & Foreign Service (IFS)</h4>
            <span class="category-badge">Diplomacy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 35L + Foreign Allowance</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: Economist & Policy Researcher -->
      <div class="marquee-card" 
           data-title="Economist & Policy Researcher" 
           data-category="Economics & Policy" 
           data-icon="fa-solid fa-chart-column" 
           data-color="linear-gradient(135deg, #0d9488, #115e59)" 
           data-description="Analyzes macroeconomic trends, inflation forecasting, fiscal policy models, and advises central banks and think tanks."
           data-skills="Econometrics, Stata, Macroeconomic Modeling, Policy Analysis, Game Theory"
           data-pathway="B.A./B.Sc in Economics + Master's (DSE, ISI Kolkata, JNU) or Ph.D in Economics."
           data-companies="Reserve Bank of India (RBI), World Bank, IMF, NITI Aayog, ICRIER, CRISIL">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0d9488, #115e59);"><i class="fa-solid fa-chart-column"></i></div>
          <div>
            <h4>Economist & Policy Researcher</h4>
            <span class="category-badge">Economics & Policy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 35L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>

      <!-- Duplicated for seamless marquee loop -->
      <!-- Card: Chartered Accountant (CA) -->
      <div class="marquee-card" 
           data-title="Chartered Accountant (CA)" 
           data-category="Finance & Audit" 
           data-icon="fa-solid fa-calculator" 
           data-color="linear-gradient(135deg, #f59e0b, #b45309)" 
           data-description="Manages financial auditing, corporate taxation, statutory compliance, and strategic financial management."
           data-skills="Financial Auditing, Direct & Indirect Tax (GST), Ind AS/IFRS, Financial Reporting, Forensic Audit"
           data-pathway="ICAI Foundation + Intermediate + 2-3 Years Mandatory Articleship + CA Final."
           data-companies="Big 4 (Deloitte, PwC, EY, KPMG), BDO, Reliance, Tata Sons, Private CA Practice">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f59e0b, #b45309);"><i class="fa-solid fa-calculator"></i></div>
          <div>
            <h4>Chartered Accountant (CA)</h4>
            <span class="category-badge">Finance & Audit</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">Very High Demand</span>
        </div>
      </div>
      <!-- Card: Investment Banker -->
      <div class="marquee-card" 
           data-title="Investment Banker" 
           data-category="Investment Banking" 
           data-icon="fa-solid fa-hand-holding-dollar" 
           data-color="linear-gradient(135deg, #10b981, #047857)" 
           data-description="Structures high-stakes mergers and acquisitions (M&A), initial public offerings (IPOs), and corporate debt restructuring."
           data-skills="Financial Modeling, DCF Valuation, Pitch Decks, M&A Diligence, Capital Markets"
           data-pathway="Top B-School MBA (IIM A/B/C) or CFA Charterholder + B.Com/B.Tech background."
           data-companies="Goldman Sachs, JPMorgan Chase, Morgan Stanley, Avendus Capital, Kotak Investment Banking">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #10b981, #047857);"><i class="fa-solid fa-hand-holding-dollar"></i></div>
          <div>
            <h4>Investment Banker</h4>
            <span class="category-badge">Investment Banking</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹16L - 55L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Portfolio Manager (CFA) -->
      <div class="marquee-card" 
           data-title="Portfolio Manager (CFA)" 
           data-category="Wealth Management" 
           data-icon="fa-solid fa-chart-line" 
           data-color="linear-gradient(135deg, #2563eb, #1e40af)" 
           data-description="Manages multi-asset investment portfolios, evaluates mutual funds, equities, and alternative asset classes."
           data-skills="Equity Research, Fixed Income, Portfolio Optimization, Derivatives, Risk Management"
           data-pathway="Clear CFA Level I, II, and III exams (CFA Institute, USA) + 36 months of relevant work experience."
           data-companies="BlackRock, Fidelity Investments, ICICI Prudential AMC, HDFC Mutual Fund, Nomura">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1e40af);"><i class="fa-solid fa-chart-line"></i></div>
          <div>
            <h4>Portfolio Manager (CFA)</h4>
            <span class="category-badge">Wealth Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 40L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Management Consultant -->
      <div class="marquee-card" 
           data-title="Management Consultant" 
           data-category="Strategy Consulting" 
           data-icon="fa-solid fa-briefcase" 
           data-color="linear-gradient(135deg, #6366f1, #3730a3)" 
           data-description="Solves complex operational, strategic, and cost-efficiency challenges for Fortune 500 leadership."
           data-skills="Problem Structuring, MECE Framework, Case Analysis, Financial Feasibility, Executive Presentations"
           data-pathway="MBA from premier institutions (IIM, ISB, Harvard, INSEAD) or top-tier undergraduate engineering."
           data-companies="McKinsey & Company, Boston Consulting Group (BCG), Bain & Company, Oliver Wyman">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #6366f1, #3730a3);"><i class="fa-solid fa-briefcase"></i></div>
          <div>
            <h4>Management Consultant</h4>
            <span class="category-badge">Strategy Consulting</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹18L - 50L</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Corporate Lawyer -->
      <div class="marquee-card" 
           data-title="Corporate Lawyer" 
           data-category="Corporate Law" 
           data-icon="fa-solid fa-scale-balanced" 
           data-color="linear-gradient(135deg, #8b5cf6, #581c87)" 
           data-description="Drafts high-value contracts, guides corporate governance, and oversees regulatory compliance during business acquisitions."
           data-skills="Contract Drafting, Due Diligence, Companies Act, Arbitration, Commercial Negotiation"
           data-pathway="5-Year Integrated BA/BBA LLB from NLUs (CLAT exam) + Bar Council of India (AIBE) license."
           data-companies="Cyril Amarchand Mangaldas, Shardul Amarchand, Khaitan & Co, Trilegal, In-House MNC Legal">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #581c87);"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <h4>Corporate Lawyer</h4>
            <span class="category-badge">Corporate Law</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 38L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: IAS Officer (Civil Services) -->
      <div class="marquee-card" 
           data-title="IAS Officer (Civil Services)" 
           data-category="Civil Services" 
           data-icon="fa-solid fa-landmark-dome" 
           data-color="linear-gradient(135deg, #d97706, #92400e)" 
           data-description="Leads district administration, implements national public policy, and heads government ministries and departments."
           data-skills="Public Administration, Crisis Leadership, Policy Formulation, Governance, Law & Order"
           data-pathway="Any Bachelor's Degree + cracking the UPSC Civil Services Examination (Prelims, Mains, Interview)."
           data-companies="Government of India, State Governments, Cabinet Secretariat, NITI Aayog">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d97706, #92400e);"><i class="fa-solid fa-landmark-dome"></i></div>
          <div>
            <h4>IAS Officer (Civil Services)</h4>
            <span class="category-badge">Civil Services</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 25L + Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: IPS Officer (Police) -->
      <div class="marquee-card" 
           data-title="IPS Officer (Police)" 
           data-category="Law Enforcement" 
           data-icon="fa-solid fa-shield" 
           data-color="linear-gradient(135deg, #dc2626, #7f1d1d)" 
           data-description="Commands police forces, maintains public order, investigates serious crimes, and directs national internal security."
           data-skills="Crime Investigation, Intelligence Gathering, Tactical Operations, Public Order Management"
           data-pathway="Any Bachelor's Degree + UPSC Civil Services Examination (Top Police Service rank)."
           data-companies="Indian Police Service, Intelligence Bureau (IB), RAW, CBI, NIA, State Police">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #dc2626, #7f1d1d);"><i class="fa-solid fa-shield"></i></div>
          <div>
            <h4>IPS Officer (Police)</h4>
            <span class="category-badge">Law Enforcement</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 24L + Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: Commercial Airline Pilot -->
      <div class="marquee-card" 
           data-title="Commercial Airline Pilot" 
           data-category="Aviation" 
           data-icon="fa-solid fa-plane-departure" 
           data-color="linear-gradient(135deg, #0284c7, #075985)" 
           data-description="Navigates commercial jetliners across domestic and international skies adhering to stringent flight safety standards."
           data-skills="Flight Instrumentation, Cockpit Resource Management, Meteorology, Emergency Protocols"
           data-pathway="10+2 with Physics & Math + Commercial Pilot License (CPL) training (200 flying hours) + Type Rating."
           data-companies="IndiGo, Air India, Emirates, Singapore Airlines, Qatar Airways">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #075985);"><i class="fa-solid fa-plane-departure"></i></div>
          <div>
            <h4>Commercial Airline Pilot</h4>
            <span class="category-badge">Aviation</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹18L - 75L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Actuary & Risk Scientist -->
      <div class="marquee-card" 
           data-title="Actuary & Risk Scientist" 
           data-category="Actuarial Science" 
           data-icon="fa-solid fa-chart-line-down" 
           data-color="linear-gradient(135deg, #059669, #064e3b)" 
           data-description="Calculates statistical probabilities of future events to price insurance policies and safeguard pension funds."
           data-skills="Actuarial Mathematics, Stochastic Modeling, Probability, Life Insurance Pricing, R/Python"
           data-pathway="Passing Actuarial examinations conducted by IAI (India) or IFoA (UK)."
           data-companies="LIC of India, Swiss Re, Munich Re, HDFC Life, Max Life, Aon Hewitt">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #059669, #064e3b);"><i class="fa-solid fa-chart-line-down"></i></div>
          <div>
            <h4>Actuary & Risk Scientist</h4>
            <span class="category-badge">Actuarial Science</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Armed Forces Officer -->
      <div class="marquee-card" 
           data-title="Armed Forces Officer" 
           data-category="National Defence" 
           data-icon="fa-solid fa-medal" 
           data-color="linear-gradient(135deg, #65a30d, #365314)" 
           data-description="Commands combat units, safeguards territorial sovereignty, and leads tactical strategic defense operations."
           data-skills="Military Tactics, Combat Leadership, Weaponry Systems, Strategic Decision Making"
           data-pathway="NDA (after 12th) or CDS / AFCAT exam (after graduation) + 5-day SSB interview."
           data-companies="Indian Army, Indian Navy, Indian Air Force">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #65a30d, #365314);"><i class="fa-solid fa-medal"></i></div>
          <div>
            <h4>Armed Forces Officer</h4>
            <span class="category-badge">National Defence</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 28L + Honors</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Honor</span>
        </div>
      </div>
      <!-- Card: Judicial Magistrate & Judge -->
      <div class="marquee-card" 
           data-title="Judicial Magistrate & Judge" 
           data-category="Judiciary" 
           data-icon="fa-solid fa-gavel" 
           data-color="linear-gradient(135deg, #78350f, #451a03)" 
           data-description="Presides over courtroom trials, evaluates legal evidence, and delivers binding judgments in civil and criminal law."
           data-skills="Jurisprudence, Statutory Interpretation, Court Procedure, Legal Analysis, Impartiality"
           data-pathway="LLB Degree + cracking State Judicial Services Examination (PCS-J)."
           data-companies="District & Sessions Courts, High Courts of India, Supreme Court">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #78350f, #451a03);"><i class="fa-solid fa-gavel"></i></div>
          <div>
            <h4>Judicial Magistrate & Judge</h4>
            <span class="category-badge">Judiciary</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 26L + Judicial Perks</strong></span>
          <span style="color: #d97706; font-weight: 700;">High Prestige</span>
        </div>
      </div>
      <!-- Card: Chief HR Officer (CHRO) -->
      <div class="marquee-card" 
           data-title="Chief HR Officer (CHRO)" 
           data-category="Human Resources" 
           data-icon="fa-solid fa-users-gear" 
           data-color="linear-gradient(135deg, #ec4899, #9d174d)" 
           data-description="Directs talent acquisition, employee retention frameworks, executive compensation, and enterprise company culture."
           data-skills="Talent Management, Organizational Development, Labor Laws, Compensation & Benefits, HR Analytics"
           data-pathway="MBA in Human Resources (XLRI, TISS, IIMs) or equivalent Masters in HR."
           data-companies="Google, Unilever, Reliance Industries, Tata Consultancy Services, HDFC Bank">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #9d174d);"><i class="fa-solid fa-users-gear"></i></div>
          <div>
            <h4>Chief HR Officer (CHRO)</h4>
            <span class="category-badge">Human Resources</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 45L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Digital Marketing Director -->
      <div class="marquee-card" 
           data-title="Digital Marketing Director" 
           data-category="Marketing" 
           data-icon="fa-solid fa-bullhorn" 
           data-color="linear-gradient(135deg, #f97316, #c2410c)" 
           data-description="Scales customer acquisition channels, optimizes conversion funnels, and leads viral multi-channel marketing campaigns."
           data-skills="Performance Marketing, SEO/SEM, Google Analytics 4, Meta Ads, Growth Hacking, Retention"
           data-pathway="Bachelor's degree + proven growth portfolio or MBA in Marketing."
           data-companies="Nykaa, Mamaearth, Swiggy, Flipkart, Dentsu, GroupM">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #f97316, #c2410c);"><i class="fa-solid fa-bullhorn"></i></div>
          <div>
            <h4>Digital Marketing Director</h4>
            <span class="category-badge">Marketing</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Brand Strategist & Director -->
      <div class="marquee-card" 
           data-title="Brand Strategist & Director" 
           data-category="Advertising" 
           data-icon="fa-solid fa-wand-magic-sparkles" 
           data-color="linear-gradient(135deg, #8b5cf6, #6d28d9)" 
           data-description="Crafts compelling brand identities, storytelling narratives, and high-impact advertising campaigns for global consumer brands."
           data-skills="Brand Positioning, Creative Copywriting, Consumer Psychology, Campaign Direction"
           data-pathway="Degree in Mass Communication / Advertising / MBA in Marketing + creative portfolio."
           data-companies="Ogilvy & Mather, McCann Worldgroup, Leo Burnett, DDB Mudra, ITC Brands">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
          <div>
            <h4>Brand Strategist & Director</h4>
            <span class="category-badge">Advertising</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹7L - 30L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Supply Chain Director -->
      <div class="marquee-card" 
           data-title="Supply Chain Director" 
           data-category="Supply Chain" 
           data-icon="fa-solid fa-truck-fast" 
           data-color="linear-gradient(135deg, #0284c7, #0369a1)" 
           data-description="Optimizes end-to-end global freight movements, warehouse automation, procurement, and inventory replenishment."
           data-skills="ERP (SAP/Oracle), Demand Forecasting, Inventory Optimization, Logistics Analytics, Vendor Management"
           data-pathway="B.Tech / BBA + MBA in Operations / Supply Chain Management (NITIE / IIMs)."
           data-companies="Amazon, DHL, Maersk, Delhivery, Procter & Gamble, Hindustan Unilever">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0284c7, #0369a1);"><i class="fa-solid fa-truck-fast"></i></div>
          <div>
            <h4>Supply Chain Director</h4>
            <span class="category-badge">Supply Chain</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹10L - 36L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Film Director & Screenwriter -->
      <div class="marquee-card" 
           data-title="Film Director & Screenwriter" 
           data-category="Media & Entertainment" 
           data-icon="fa-solid fa-clapperboard" 
           data-color="linear-gradient(135deg, #e11d48, #9f1239)" 
           data-description="Directs cinematic vision, guides actors' performances, shapes screenplays, and oversees film production."
           data-skills="Visual Storytelling, Cinematography, Screenwriting, Film Editing, Production Direction"
           data-pathway="Degree / Diploma from FTII Pune, SRFTI Kolkata, Whistling Woods, or filmmaking apprenticeship."
           data-companies="Dharma Productions, Yash Raj Films, Netflix India, Amazon Prime Video, Excel Entertainment">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #e11d48, #9f1239);"><i class="fa-solid fa-clapperboard"></i></div>
          <div>
            <h4>Film Director & Screenwriter</h4>
            <span class="category-badge">Media & Entertainment</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹6L - 50L+</strong></span>
          <span style="color: #a855f7; font-weight: 700;">High Passion</span>
        </div>
      </div>
      <!-- Card: Fashion Designer & Couturier -->
      <div class="marquee-card" 
           data-title="Fashion Designer & Couturier" 
           data-category="Fashion Design" 
           data-icon="fa-solid fa-shirt" 
           data-color="linear-gradient(135deg, #d946ef, #a21caf)" 
           data-description="Designs haute couture collections, selects luxury textiles, illustrates fashion lines, and directs runway presentations."
           data-skills="Fashion Illustration, Textile Selection, Garment Construction, Draping, Trend Forecasting"
           data-pathway="4-Year B.Des in Fashion Design from NIFT (National Institute of Fashion Technology) or Pearl Academy."
           data-companies="Sabyasachi, Manish Malhotra, Anita Dongre, Zara, Aditya Birla Fashion & Retail">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #d946ef, #a21caf);"><i class="fa-solid fa-shirt"></i></div>
          <div>
            <h4>Fashion Designer & Couturier</h4>
            <span class="category-badge">Fashion Design</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 25L+</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Interior Architect & Designer -->
      <div class="marquee-card" 
           data-title="Interior Architect & Designer" 
           data-category="Interior Design" 
           data-icon="fa-solid fa-couch" 
           data-color="linear-gradient(135deg, #ca8a04, #854d0e)" 
           data-description="Transforms residential luxury estates and commercial workspaces with functional, aesthetic spatial architecture."
           data-skills="3D AutoCAD, SketchUp, 3ds Max, Lighting Design, Material Sourcing, Space Planning"
           data-pathway="B.Des (Interior Design) or B.Arch with specialized interior architecture portfolio."
           data-companies="Livspace, HomeLane, Architect Hafeez Contractor, Urban Ladder, Studio Lotus">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ca8a04, #854d0e);"><i class="fa-solid fa-couch"></i></div>
          <div>
            <h4>Interior Architect & Designer</h4>
            <span class="category-badge">Interior Design</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: 3D Animator & VFX Artist -->
      <div class="marquee-card" 
           data-title="3D Animator & VFX Artist" 
           data-category="Animation & VFX" 
           data-icon="fa-solid fa-dragon" 
           data-color="linear-gradient(135deg, #7c3aed, #4c1d95)" 
           data-description="Creates photorealistic computer-generated imagery (CGI), character animations, and visual effects for blockbusters."
           data-skills="Maya, Blender, Houdini, Nuke, ZBrush, Character Rigging, Compositing"
           data-pathway="Degree / Diploma in Animation & VFX from institutions like MAAC, Arena, or self-taught demo reel."
           data-companies="MPC, DNEG, Redchillies VFX, Framestore, Sony Pictures Imageworks">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #7c3aed, #4c1d95);"><i class="fa-solid fa-dragon"></i></div>
          <div>
            <h4>3D Animator & VFX Artist</h4>
            <span class="category-badge">Animation & VFX</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Sports Coach & Performance Director -->
      <div class="marquee-card" 
           data-title="Sports Coach & Performance Director" 
           data-category="Sports & Athletics" 
           data-icon="fa-solid fa-trophy" 
           data-color="linear-gradient(135deg, #eab308, #a16207)" 
           data-description="Trains elite athletes in physical conditioning, tactical play, mental resilience, and sports tournament strategy."
           data-skills="Athletic Conditioning, Biomechanics, Performance Analytics, Tactical Drills, Sports Psychology"
           data-pathway="B.P.Ed / M.P.Ed from NIS Patiala + National federation / AFC / ICC coaching licenses."
           data-companies="Sports Authority of India, BCCI, Indian Super League, Gopichand Badminton Academy">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #eab308, #a16207);"><i class="fa-solid fa-trophy"></i></div>
          <div>
            <h4>Sports Coach & Performance Director</h4>
            <span class="category-badge">Sports & Athletics</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5L - 28L</strong></span>
          <span style="color: #0ea5e9; font-weight: 700;">Growing Fast</span>
        </div>
      </div>
      <!-- Card: Event & Experiential Director -->
      <div class="marquee-card" 
           data-title="Event & Experiential Director" 
           data-category="Event Management" 
           data-icon="fa-solid fa-champagne-glasses" 
           data-color="linear-gradient(135deg, #ec4899, #be185d)" 
           data-description="Orchestrates grand luxury weddings, international music festivals, sports leagues, and global corporate summits."
           data-skills="Event Logistics, Vendor Coordination, Budgeting, Stage Production, Crisis Protocol"
           data-pathway="Degree / Diploma in Event Management (NAEMD) or Mass Communication."
           data-companies="Wizcraft, Percept, DNA Networks, Wedding Design Company, Fountainhead MKTG">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #ec4899, #be185d);"><i class="fa-solid fa-champagne-glasses"></i></div>
          <div>
            <h4>Event & Experiential Director</h4>
            <span class="category-badge">Event Management</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4L - 22L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Investigative Journalist -->
      <div class="marquee-card" 
           data-title="Investigative Journalist" 
           data-category="Journalism & Media" 
           data-icon="fa-solid fa-newspaper" 
           data-color="linear-gradient(135deg, #475569, #0f172a)" 
           data-description="Uncovers public interest stories, investigates corruption, conducts hard-hitting interviews, and crafts editorial features."
           data-skills="Investigative Reporting, Media Ethics, Fact-Checking, Video Journalism, Editorial Writing"
           data-pathway="Bachelor's / Master's in Journalism & Mass Communication (IIMC Delhi, ACJ Chennai)."
           data-companies="The Hindu, Indian Express, BBC News India, NDTV, Reuters, Scroll.in">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #475569, #0f172a);"><i class="fa-solid fa-newspaper"></i></div>
          <div>
            <h4>Investigative Journalist</h4>
            <span class="category-badge">Journalism & Media</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹4.5L - 20L</strong></span>
          <span style="color: #2563eb; font-weight: 700;">Steady Demand</span>
        </div>
      </div>
      <!-- Card: Public Relations (PR) Director -->
      <div class="marquee-card" 
           data-title="Public Relations (PR) Director" 
           data-category="Public Relations" 
           data-icon="fa-solid fa-comments-dollar" 
           data-color="linear-gradient(135deg, #2563eb, #1d4ed8)" 
           data-description="Builds high-profile media relationships, manages corporate crisis communication, and steers executive public image."
           data-skills="Crisis Communication, Press Releases, Media Relations, Strategic Messaging, Media Pitching"
           data-pathway="Degree in Public Relations / Mass Communication / MBA in Marketing."
           data-companies="Edelman, Weber Shandwick, Genesis BCW, Adfactors PR, MSL India">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);"><i class="fa-solid fa-comments-dollar"></i></div>
          <div>
            <h4>Public Relations (PR) Director</h4>
            <span class="category-badge">Public Relations</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹5.5L - 24L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: General Manager (Hospitality) -->
      <div class="marquee-card" 
           data-title="General Manager (Hospitality)" 
           data-category="Hospitality" 
           data-icon="fa-solid fa-hotel" 
           data-color="linear-gradient(135deg, #b45309, #78350f)" 
           data-description="Manages luxury 5-star hotel properties, oversees VIP guest experiences, F&B operations, and resort profitability."
           data-skills="Hospitality Operations, Revenue Management, Guest Relations, Food & Beverage Standards"
           data-pathway="3-Year B.Sc in Hospitality & Hotel Administration (NCHMCT JEE qualified) + IHM graduation."
           data-companies="The Taj Mahal Palace, Oberoi Hotels & Resorts, ITC Hotels, Marriott International, Hyatt">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #b45309, #78350f);"><i class="fa-solid fa-hotel"></i></div>
          <div>
            <h4>General Manager (Hospitality)</h4>
            <span class="category-badge">Hospitality</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹8L - 32L</strong></span>
          <span style="color: #16a34a; font-weight: 700;">High Demand</span>
        </div>
      </div>
      <!-- Card: Diplomat & Foreign Service (IFS) -->
      <div class="marquee-card" 
           data-title="Diplomat & Foreign Service (IFS)" 
           data-category="Diplomacy" 
           data-icon="fa-solid fa-earth-americas" 
           data-color="linear-gradient(135deg, #1e40af, #172554)" 
           data-description="Represents the country at embassies worldwide, conducts bilateral trade negotiations, and shapes geopolitical foreign policy."
           data-skills="International Relations, Bilateral Negotiation, Diplomatic Protocol, Foreign Languages"
           data-pathway="Any Bachelor's Degree + UPSC Civil Services Examination (IFS ranking)."
           data-companies="Ministry of External Affairs (MEA), Indian Embassies Worldwide, United Nations (UN)">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #1e40af, #172554);"><i class="fa-solid fa-earth-americas"></i></div>
          <div>
            <h4>Diplomat & Foreign Service (IFS)</h4>
            <span class="category-badge">Diplomacy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹12L - 35L + Foreign Allowance</strong></span>
          <span style="color: #d97706; font-weight: 700;">Highest Prestige</span>
        </div>
      </div>
      <!-- Card: Economist & Policy Researcher -->
      <div class="marquee-card" 
           data-title="Economist & Policy Researcher" 
           data-category="Economics & Policy" 
           data-icon="fa-solid fa-chart-column" 
           data-color="linear-gradient(135deg, #0d9488, #115e59)" 
           data-description="Analyzes macroeconomic trends, inflation forecasting, fiscal policy models, and advises central banks and think tanks."
           data-skills="Econometrics, Stata, Macroeconomic Modeling, Policy Analysis, Game Theory"
           data-pathway="B.A./B.Sc in Economics + Master's (DSE, ISI Kolkata, JNU) or Ph.D in Economics."
           data-companies="Reserve Bank of India (RBI), World Bank, IMF, NITI Aayog, ICRIER, CRISIL">
        <div class="marquee-card-header">
          <div class="marquee-icon-wrap" style="background: linear-gradient(135deg, #0d9488, #115e59);"><i class="fa-solid fa-chart-column"></i></div>
          <div>
            <h4>Economist & Policy Researcher</h4>
            <span class="category-badge">Economics & Policy</span>
          </div>
        </div>
        <div class="marquee-card-meta">
          <span>Avg Salary: <strong>₹9L - 35L</strong></span>
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

<!-- ─── Connected Career & Education Ecosystem ─── -->
<section style="padding: 80px 0; background: #ffffff; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <div class="section-label">
        <i class="fa-solid fa-network-wired"></i> Connected Platform
      </div>
      <h2 class="section-title">Explore All of CareerGyan</h2>
      <p style="color:var(--text-2); font-size:16px;">
        Everything you need to navigate exams, admissions, college choices, and professional growth — interconnected for seamless student exploration.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 26px;">
      
      <!-- Card 1: Daily Quiz -->
      <a href="{{ route('daily-quiz.index') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#6366f1'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#eff6ff; color:#4f46e5; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-brain"></i>
          </div>
          <span style="background:#e0e7ff; color:#4338ca; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            Live Daily
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          Daily Career & GK Quiz
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Take 5 quick daily questions covering reasoning, quantitative aptitude, and current affairs. Build streaks and compete on the leaderboard.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#4f46e5; display:inline-flex; align-items:center; gap:6px;">
          Play Today's Quiz <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Card 2: College Predictor & Cutoffs -->
      <a href="{{ route('tools.college-predictor') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#2563eb'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-crosshairs"></i>
          </div>
          <span style="background:#dbeafe; color:#1e40af; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            CAP 2026 Engine
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          College Predictor & Cutoffs
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Filter 2,149+ engineering allotments across Maharashtra. Find your exact Safe, Target, Reach, and Dream college options in seconds.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#2563eb; display:inline-flex; align-items:center; gap:6px;">
          Predict My Colleges <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Card 3: Free Aptitude Test -->
      <a href="{{ route('quick-test.start') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#d97706'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#fef3c7; color:#d97706; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-bolt"></i>
          </div>
          <span style="background:#fef3c7; color:#92400e; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            100% Free
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          Scientific Aptitude Test
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Unsure about science, commerce, humanities, or engineering? Take our 5-minute test to map your core cognitive affinities.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#d97706; display:inline-flex; align-items:center; gap:6px;">
          Start Assessment <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Card 4: 90,000+ Colleges -->
      <a href="{{ route('indian-colleges.index') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#059669'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#ecfdf5; color:#059669; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-building-columns"></i>
          </div>
          <span style="background:#d1fae5; color:#065f46; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            90k+ Database
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          All-India Colleges Directory
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Filter government, autonomous, and private colleges by state, district, affiliated university, and course offerings.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#059669; display:inline-flex; align-items:center; gap:6px;">
          Explore Colleges <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Card 5: National Guidance Hubs -->
      <a href="{{ route('guidance.mht-cet') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#ea580c'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#fff7ed; color:#ea580c; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-book-open-reader"></i>
          </div>
          <span style="background:#ffedd5; color:#9a3412; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            MHT CET · JEE · UPSC
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          Exam Strategy & Guidance
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Comprehensive preparation roadmaps, high-yield topics, textbook strategies, and counseling guides for major national tests.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#ea580c; display:inline-flex; align-items:center; gap:6px;">
          Read Exam Guidance <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

      <!-- Card 6: Job Corner -->
      <a href="{{ route('jobs.index') }}" style="background: #f8fafc; border: 1.5px solid var(--border); border-radius: var(--radius-xl); padding: 30px; text-decoration: none; display: flex; flex-direction: column; transition: all 0.25s;" onmouseover="this.style.borderColor='#0284c7'; this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'; this.style.boxShadow='none';">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:18px;">
          <div style="width:50px; height:50px; border-radius:14px; background:#f0f9ff; color:#0284c7; display:flex; align-items:center; justify-content:center; font-size:24px;">
            <i class="fa-solid fa-briefcase"></i>
          </div>
          <span style="background:#e0f2fe; color:#0369a1; font-size:11.5px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">
            Freshers & Govt
          </span>
        </div>
        <h3 style="font-family:'Sora', sans-serif; font-size:18px; font-weight:800; color:var(--text-1); margin:0 0 8px;">
          Job Corner & Hiring Alerts
        </h3>
        <p style="font-size:14px; color:var(--text-2); line-height:1.6; margin:0 0 20px; flex:1;">
          Browse verified government job circulars, private sector fresh graduate openings, and internship drives with direct links.
        </p>
        <span style="font-size:13.5px; font-weight:700; color:#0284c7; display:inline-flex; align-items:center; gap:6px;">
          Explore Job Vacancies <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>

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

@php
  $membershipPlan = $membershipPlan ?? \App\Models\MembershipPlan::getDefaultPlan();
  $isUserMember = auth()->check() ? auth()->user()->hasActiveMembership() : false;
@endphp

@if($membershipPlan && $membershipPlan->is_active)
<!-- ─── Premium Membership Section ─── -->
<section class="premium-membership-section" id="membershipSection">
  <div class="mem-glow-orb mem-glow-orb-1"></div>
  <div class="mem-glow-orb mem-glow-orb-2"></div>

  <div class="container">
    
    <div class="mem-section-head">
      <div class="mem-section-badge">
        <i class="{{ $membershipPlan->symbol ?: 'fa-solid fa-crown' }}"></i> {{ $membershipPlan->name }}
      </div>
      <h2>Accelerate Your Career with Elite Access</h2>
      <p>
        {{ $membershipPlan->description ?: 'Gain exclusive access to private mentor guidance, advanced assessment tools, verified executive certifications, and our private student WhatsApp community.' }}
      </p>
    </div>

    <div class="mem-two-col">
      <!-- Left: Key Pillars -->
      <div class="mem-features-col">
        <div class="mem-feature-card">
          <div class="mem-feature-icon-box">
            <i class="fa-solid fa-brain"></i>
          </div>
          <div class="mem-feature-text">
            <h4>Psychological & Aptitude Deep-Dive</h4>
            <p>Go beyond surface questionnaires. Identify subconscious behavioral tendencies, leadership metrics, and exact industry matches.</p>
          </div>
        </div>

        <div class="mem-feature-card">
          <div class="mem-feature-icon-box">
            <i class="fa-solid fa-user-tie"></i>
          </div>
          <div class="mem-feature-text">
            <h4>1-on-1 Certified Mentorship Booking</h4>
            <p>Schedule private, focused counseling appointments with industry experts and college admission advisors.</p>
          </div>
        </div>

        <div class="mem-feature-card">
          <div class="mem-feature-icon-box">
            <i class="fa-solid fa-comments"></i>
          </div>
          <div class="mem-feature-text">
            <h4>VIP WhatsApp Counseling Community</h4>
            <p>Never miss critical cutoff updates, internship announcements, and direct Q&A in our private members-only WhatsApp circle.</p>
          </div>
        </div>

        <div class="mem-feature-card">
          <div class="mem-feature-icon-box">
            <i class="fa-solid fa-certificate"></i>
          </div>
          <div class="mem-feature-text">
            <h4>Government & Institute Endorsed Certificates</h4>
            <p>Download verifiable, high-resolution credential certificates signed by the CEO and Indian Institute of Career Management.</p>
          </div>
        </div>
      </div>

      <!-- Right: Premium Price Card -->
      <div class="mem-pricing-glass-card">
        @if($membershipPlan->badge_text)
          <div class="mem-ribbon-tag">{{ $membershipPlan->badge_text }}</div>
        @endif

        <!-- Admin-Set Symbol Display -->
        <div class="mem-symbol-display">
          <i class="{{ $membershipPlan->symbol ?: 'fa-solid fa-crown' }}"></i>
        </div>

        <h3 class="mem-card-title">{{ $membershipPlan->name }}</h3>
        <p class="mem-card-desc">Complete all-in-one pass for ambitious students & aspiring professionals</p>

        <!-- Price Area -->
        <div class="mem-price-area">
          @if($membershipPlan->original_price_in_rupees && $membershipPlan->original_price_in_rupees > $membershipPlan->price_in_rupees)
            <div class="mem-strike-price-wrap">
              <span class="mem-strike-price">
                {{ $membershipPlan->currency_symbol ?: '₹' }}{{ number_format($membershipPlan->original_price_in_rupees) }}
              </span>
              <span class="mem-save-badge">
                SAVE {{ $membershipPlan->discount_percentage }}%
              </span>
            </div>
          @endif

          <div class="mem-main-price">
            <span class="mem-main-currency">{{ $membershipPlan->currency_symbol ?: '₹' }}</span>
            <span class="mem-main-amount">{{ number_format($membershipPlan->price_in_rupees) }}</span>
            <span class="mem-main-period">/ {{ $membershipPlan->billing_period ?: ($membershipPlan->duration_days == 365 ? 'yr' : 'mo') }}</span>
          </div>
        </div>

        <!-- Checklist -->
        <ul class="mem-checklist">
          @if(is_array($membershipPlan->features) && count($membershipPlan->features) > 0)
            @foreach($membershipPlan->features as $feat)
              <li>
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ $feat }}</span>
              </li>
            @endforeach
          @else
            <li><i class="fa-solid fa-circle-check"></i> <span>All 4 Advanced Personality & Role Profilers</span></li>
            <li><i class="fa-solid fa-circle-check"></i> <span>1-on-1 Direct Counseling Appointment Booking</span></li>
            <li><i class="fa-solid fa-circle-check"></i> <span>Private Mentor WhatsApp Group & Direct Q&A</span></li>
            <li><i class="fa-solid fa-circle-check"></i> <span>Verifiable Downloadable PDF Reports & Badge</span></li>
          @endif
        </ul>

        @if($isUserMember)
          <a href="{{ route('membership.dashboard') }}" class="mem-cta-btn" style="background: linear-gradient(90deg, #10b981 0%, #059669 100%); color: #ffffff;">
            Go to Pro Member Dashboard <i class="fa-solid fa-arrow-right"></i>
          </a>
        @else
          <a href="{{ route('membership.index') }}" class="mem-cta-btn">
            Get {{ $membershipPlan->name }} Access <i class="fa-solid fa-arrow-right"></i>
          </a>
        @endif

        <div class="mem-trust-tag">
          <i class="fa-solid fa-shield-halved" style="color: #fbbf24;"></i> Instant Activation • 100% Secure Checkout via Razorpay
        </div>
      </div>
    </div>

  </div>
</section>
@endif

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
  // ─── Home Cutoff Mini-Search ───
  (function() {
    const input = document.getElementById('homeCutoffSearch');
    const btn = document.getElementById('homeCutoffSearchBtn');
    if (input && btn) {
      function goToCutoff() {
        const q = input.value.trim();
        const url = @json(route('tools.mh-cutoff'));
        window.location.href = q ? url + '?q=' + encodeURIComponent(q) : url;
      }
      btn.addEventListener('click', goToCutoff);
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); goToCutoff(); }
      });
    }
  })();

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

      // Timeline items activation
      const timelineItems = document.querySelectorAll('.timeline-item');
      timelineItems.forEach(item => item.classList.add('active'));
      const line = document.querySelector('.timeline-line');
      if (line) line.style.height = 'calc(100% - 60px)';

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

      // Count up statistics animation
      const counters = document.querySelectorAll('.counter-val');
      const duration = 1200; // Total count duration in ms
      
      const startCounting = (counter) => {
          const target = parseInt(counter.getAttribute('data-target'));
          if (isNaN(target)) return;
          
          const suffix = counter.getAttribute('data-suffix') || '';
          const increment = Math.ceil(target / (duration / 20)); // ~50 FPS
          let currentVal = 0;
          counter.textContent = '0' + suffix;
          
          const timer = setInterval(() => {
              currentVal += increment;
              if (currentVal >= target) {
                  counter.textContent = target + suffix;
                  clearInterval(timer);
              } else {
                  counter.textContent = currentVal + suffix;
              }
          }, 20);
      };
      
      counters.forEach(counter => {
          startCounting(counter);
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
@endsection
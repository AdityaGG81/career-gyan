@extends('layouts.app')

@section('title', 'Welcome to Pro! | CareerGyan')

@section('styles')
<style>
    .success-page {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 80px 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .success-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        max-width: 600px;
        width: 100%;
        padding: 60px 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
    }

    .badge-icon {
        width: 80px;
        height: 80px;
        background: #fef3c7;
        color: #d97706;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        margin: 0 auto 30px auto;
        box-shadow: 0 10px 20px rgba(217, 119, 6, 0.15);
        animation: scaleUp 0.5s ease-out;
    }

    @keyframes scaleUp {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-card h1 {
        font-family: 'Sora';
        font-size: 32px;
        color: var(--text-1);
        font-weight: 800;
        margin-bottom: 15px;
    }

    .success-card p {
        font-size: 16px;
        color: var(--text-2);
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 600px) {
        .action-grid {
            grid-template-columns: 1fr;
        }
    }

    .success-action-card {
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 24px;
        text-align: left;
        transition: all 0.2s;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .success-action-card:hover {
        border-color: var(--brand);
        box-shadow: var(--shadow-sm);
        transform: translateY(-2px);
    }

    .success-action-card h3 {
        font-family: 'Sora';
        font-size: 16px;
        color: var(--text-1);
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .success-action-card p {
        font-size: 13px;
        color: var(--text-2);
        line-height: 1.5;
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="success-page">
    <div class="success-card">
        <div class="badge-icon">
            <i class="fa-solid fa-crown"></i>
        </div>
        
        <h1>Welcome to Pro!</h1>
        <p>Your payment was verified successfully and your Pro Membership is now active. Explore your new premium assessments and exclusive features below.</p>

        <div class="action-grid">
            <a href="{{ route('membership.dashboard') }}" class="success-action-card">
                <div>
                    <h3><i class="fa-solid fa-gauge" style="color: var(--brand);"></i> Pro Dashboard</h3>
                    <p>Go to your member center to join the private WhatsApp group and book 1-on-1 counselor slots.</p>
                </div>
                <div style="font-size: 13px; font-weight: 700; color: var(--brand); margin-top: 15px;">
                    Open Dashboard <i class="fa-solid fa-arrow-right" style="font-size: 10px;"></i>
                </div>
            </a>

            <a href="{{ route('advanced-test.index') }}" class="success-action-card">
                <div>
                    <h3><i class="fa-solid fa-brain" style="color: #8b5cf6;"></i> Advanced Tests</h3>
                    <p>Take detailed personality profilers, leadership aptitude assessments, and role readiness tests.</p>
                </div>
                <div style="font-size: 13px; font-weight: 700; color: #8b5cf6; margin-top: 15px;">
                    View Assessments <i class="fa-solid fa-arrow-right" style="font-size: 10px;"></i>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

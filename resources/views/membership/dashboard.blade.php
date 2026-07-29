@extends('layouts.app')

@section('title', 'Pro Member Center | CareerGyan')

@section('styles')
<style>
    .member-dashboard {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 60px 24px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        max-width: 1100px;
        margin: 0 auto;
    }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    .dashboard-header {
        max-width: 1100px;
        margin: 0 auto 40px auto;
    }

    .status-banner {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        border-radius: var(--radius-lg);
        padding: 30px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        box-shadow: var(--shadow-md);
    }

    @media (max-width: 600px) {
        .status-banner {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }
    }

    .status-info h2 {
        font-family: 'Sora';
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-info p {
        font-size: 14px;
        color: #c7d2fe;
    }

    .status-badge {
        background: rgba(251, 191, 36, 0.15);
        border: 1px solid #fbbf24;
        color: #fbbf24;
        padding: 8px 16px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 14px;
    }

    .card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 35px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-sm);
    }

    .card-title {
        font-family: 'Sora';
        font-size: 20px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .features-list-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 600px) {
        .features-list-grid {
            grid-template-columns: 1fr;
        }
    }

    .feature-box {
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s;
    }

    .feature-box:hover {
        border-color: var(--brand);
        box-shadow: var(--shadow-sm);
    }

    .feature-box h4 {
        font-family: 'Sora';
        font-size: 16px;
        font-weight: 700;
        color: var(--text-1);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .feature-box p {
        font-size: 13px;
        color: var(--text-2);
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .feature-link {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--brand);
        text-decoration: none;
    }

    .feature-link:hover {
        color: var(--brand-dark);
    }

    /* WhatsApp & Calendar details */
    .whatsapp-card {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
    }

    .whatsapp-card .card-title {
        color: #065f46;
    }

    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #10b981;
        color: white;
        border-radius: var(--radius-md);
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        transition: all 0.2s;
    }

    .whatsapp-btn:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .interaction-card {
        background: #fef8f0;
        border: 1px solid #fed7aa;
    }

    .interaction-card .card-title {
        color: #9a3412;
    }

    .interaction-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #f97316;
        color: white;
        border-radius: var(--radius-md);
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
        transition: all 0.2s;
    }

    .interaction-btn:hover {
        background: #ea580c;
        transform: translateY(-1px);
        box-shadow: 0 8px 16px rgba(249, 115, 22, 0.3);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="member-dashboard">
    <div class="container">
        
        <div class="dashboard-header">
            <h1 style="font-family: 'Sora'; font-size: 32px; font-weight: 800; color: var(--text-1); margin-bottom: 8px;">Pro Member Dashboard</h1>
            <p style="color: var(--text-2); font-size: 15px;">Manage your premium subscriptions, certificates, and direct access items.</p>
        </div>

        <div class="dashboard-grid">
            <!-- Left Side: Main area -->
            <div>
                <!-- Status Banner -->
                <div class="status-banner">
                    <div class="status-info">
                        <h2><i class="fa-solid fa-crown" style="color: #fbbf24;"></i> Active Pro Account</h2>
                        <p>Your subscription is active and valid until {{ $membership->expires_at ? $membership->expires_at->format('F d, Y') : 'N/A' }} ({{ $membership->daysRemaining() }} days left)</p>
                    </div>
                    <div class="status-badge">
                        PRO PLAN ACTIVE
                    </div>
                </div>

                <!-- Premium Features Grid -->
                <div class="card">
                    <div class="card-title">
                        <i class="fa-solid fa-star" style="color: #fbbf24;"></i> Premium Features Quick Access
                    </div>
                    
                    <div class="features-list-grid">
                        <div class="feature-box">
                            <div>
                                <h4>🧠 Advanced Tests</h4>
                                <p>Uncover personality traits, role fitness, adaptive skills, and leadership potential.</p>
                            </div>
                            <a href="{{ route('advanced-test.index') }}" class="feature-link">
                                Take Assessments <i class="fa-solid fa-arrow-right" style="font-size: 10px;"></i>
                            </a>
                        </div>

                        <div class="feature-box">
                            <div>
                                <h4>⚡ Unlimited AI Advisor</h4>
                                <p>The daily limitation on our AI Chat advisor is completely removed for you.</p>
                            </div>
                            <a href="{{ url('/') }}#chat-section" class="feature-link">
                                Start Advising <i class="fa-solid fa-arrow-right" style="font-size: 10px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact & Group links -->
            <div>
                <!-- WhatsApp Group Card -->
                <div class="card whatsapp-card">
                    <div class="card-title">
                        <i class="fa-brands fa-whatsapp"></i> Private Mentor Group
                    </div>
                    <p style="font-size: 13.5px; color: #0f5132; line-height: 1.6; margin-bottom: 25px;">
                        Connect directly with our career coaches and peers inside our exclusive private WhatsApp group.
                    </p>
                    <a href="{{ route('membership.whatsapp') }}" target="_blank" class="whatsapp-btn">
                        <i class="fa-brands fa-whatsapp"></i> Join WhatsApp Group
                    </a>
                </div>

                <!-- 1-on-1 counseling Card -->
                <div class="card interaction-card">
                    <div class="card-title">
                        <i class="fa-solid fa-comments"></i> 1-on-1 Personal Session
                    </div>
                    <p style="font-size: 13.5px; color: #7c2d12; line-height: 1.6; margin-bottom: 25px;">
                        Book a personal virtual session with our counseling experts to discuss your aptitude report.
                    </p>
                    <a href="https://calendly.com/careergyan-demo" target="_blank" class="interaction-btn">
                        <i class="fa-solid fa-calendar-days"></i> Schedule Appointment
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

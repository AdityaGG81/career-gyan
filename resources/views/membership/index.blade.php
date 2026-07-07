@extends('layouts.app')

@section('title', 'Get Pro Membership | CareerGyan')

@section('styles')
<style>
    .premium-page {
        background: radial-gradient(circle at top, #1e1b4b 0%, #0f172a 100%);
        color: white;
        padding: 80px 0;
        min-height: calc(100vh - 100px);
    }
    
    .premium-hero {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 60px auto;
        padding: 0 20px;
    }
    
    .premium-badge {
        background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        color: #78350f;
        padding: 6px 16px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 13px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    
    .premium-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .premium-hero p {
        font-size: 18px;
        color: #94a3b8;
        line-height: 1.6;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 50px;
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 24px;
        align-items: center;
    }

    @media (max-width: 900px) {
        .pricing-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }

    /* Left Side: Features list */
    .features-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-xl);
        padding: 40px;
        backdrop-filter: blur(10px);
    }

    .features-card h3 {
        font-family: 'Sora';
        font-size: 24px;
        margin-bottom: 30px;
        color: #fff;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 15px;
    }

    .feature-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        align-items: flex-start;
    }

    .feature-item:last-child {
        margin-bottom: 0;
    }

    .feature-icon {
        width: 32px;
        height: 32px;
        background: rgba(251, 191, 36, 0.1);
        color: #fbbf24;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .feature-text h4 {
        font-size: 16px;
        font-weight: 700;
        color: #f8fafc;
        margin-bottom: 4px;
    }

    .feature-text p {
        font-size: 13.5px;
        color: #94a3b8;
        line-height: 1.5;
    }

    /* Right Side: Pricing Buy Card */
    .pricing-card {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
        border: 2px solid #fbbf24;
        border-radius: var(--radius-xl);
        padding: 50px 40px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 40px rgba(251, 191, 36, 0.1);
        position: relative;
        overflow: hidden;
    }

    .pricing-card::before {
        content: 'MOST POPULAR';
        position: absolute;
        top: 25px;
        right: -35px;
        background: #fbbf24;
        color: #78350f;
        font-size: 10px;
        font-weight: 800;
        padding: 6px 40px;
        transform: rotate(45deg);
        letter-spacing: 1px;
    }

    .pricing-plan-name {
        font-family: 'Sora';
        font-size: 26px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
    }

    .pricing-price-wrap {
        margin: 30px 0;
    }

    .pricing-currency {
        font-size: 24px;
        font-weight: 700;
        color: #fbbf24;
        vertical-align: super;
        margin-right: 2px;
    }

    .pricing-amount {
        font-family: 'Sora';
        font-size: 64px;
        font-weight: 800;
        color: #fff;
    }

    .pricing-period {
        font-size: 16px;
        color: #94a3b8;
        margin-left: 5px;
    }

    .pricing-desc {
        color: #cbd5e1;
        font-size: 14.5px;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .buy-btn {
        display: block;
        width: 100%;
        padding: 16px 32px;
        background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        color: #78350f;
        border-radius: var(--radius-md);
        font-size: 16px;
        font-weight: 800;
        text-decoration: none;
        border: none;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
        transition: all 0.3s;
    }

    .buy-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.35);
        color: #78350f;
    }

    .pricing-guarantee {
        font-size: 12px;
        color: #64748b;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
</style>
@endsection

@section('content')
<div class="premium-page">
    <div class="container">
        
        @if(session('error'))
            <div style="max-width: 600px; margin: 0 auto 30px auto; background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 14px 20px; border-radius: 10px; font-weight: 600; text-align: center;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        <div class="premium-hero">
            <span class="premium-badge">CareerGyan Pro</span>
            <h1>Supercharge Your Career Direction</h1>
            <p>Access very advanced assessments, 1-on-1 counseling booking, mentor community WhatsApp group access, and premium PDF certifications signed by industry experts.</p>
        </div>

        <div class="pricing-grid">
            <!-- Left: Features -->
            <div class="features-card">
                <h3>What's included in Pro</h3>
                
                <div class="feature-item">
                    <div class="feature-icon"><i class="fa-solid fa-brain"></i></div>
                    <div class="feature-text">
                        <h4>4 Very Advanced Tests</h4>
                        <p>Assess personality traits, role readiness, corporate soft skills, and entrepreneurial potential.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon"><i class="fa-solid fa-award"></i></div>
                    <div class="feature-text">
                        <h4>Digital Certificates of Completion</h4>
                        <p>Earn custom certificates verified and stamped with the signatures of the Founder & CEO.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="feature-text">
                        <h4>Private Mentor WhatsApp Group</h4>
                        <p>Join a separate, members-only WhatsApp group for networking, counseling, and direct Q&A.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="feature-text">
                        <h4>1-on-1 Counselor Interaction</h4>
                        <p>Book private online counseling slots with our career guidance experts.</p>
                    </div>
                </div>
            </div>

            <!-- Right: Price card -->
            <div class="pricing-card">
                <div class="pricing-plan-name">{{ $plan->name }}</div>
                
                <div class="pricing-price-wrap">
                    <span class="pricing-currency">₹</span>
                    <span class="pricing-amount">{{ number_format($plan->price / 100) }}</span>
                    <span class="pricing-period">/ {{ $plan->duration_days == 365 ? 'yr' : 'mo' }}</span>
                </div>
                
                <p class="pricing-desc">
                    Get full, unrestricted access to the entire CareerGyan ecosystem for one full year. No monthly fees, no hidden limits.
                </p>

                @if($isMember)
                    <a href="{{ route('membership.dashboard') }}" class="buy-btn" style="background: linear-gradient(90deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
                        Go to Member Dashboard <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('membership.checkout') }}" class="buy-btn">
                        Upgrade to Pro Now
                    </a>
                @endif

                <div class="pricing-guarantee">
                    <i class="fa-solid fa-shield-halved"></i> 100% Secure Checkout via Razorpay
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

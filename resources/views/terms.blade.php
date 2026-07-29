@extends('layouts.app')

@section('title', 'Terms of Use | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
:root {
    --brand: #1a56db;
    --brand-light: #e8f0fe;
    --bg: #f8fafc;
    --surface: #ffffff;
    --border: #e2e8f0;
    --text-1: #0f172a;
    --text-2: #475569;
    --radius-xl: 22px;
}

.policy-hero {
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 60%, #2563eb 100%);
    color: #fff;
    padding: 100px 0 60px;
    text-align: center;
}
.policy-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 40px);
    font-weight: 800;
    margin-bottom: 12px;
}
.policy-breadcrumb {
    font-size: 14px;
    color: rgba(255,255,255,.7);
}
.policy-breadcrumb a { color: inherit; text-decoration: none; }
.policy-breadcrumb a:hover { color: #fff; }

.policy-content {
    padding: 60px 0;
    background: var(--bg);
}
.policy-card {
    background: var(--surface);
    border-radius: var(--radius-xl);
    padding: 40px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 20px rgba(0,0,0,.04);
    max-width: 900px;
    margin: 0 auto;
}
.policy-card h2 {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--text-1);
    margin-top: 32px;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
}
.policy-card h2:first-child { margin-top: 0; }
.policy-card p, .policy-card li {
    color: var(--text-2);
    line-height: 1.7;
    font-size: 15px;
    margin-bottom: 16px;
}
.policy-card ul {
    margin-left: 24px;
    margin-bottom: 16px;
}
</style>
@endsection

@section('content')
<section class="policy-hero">
    <div class="container">
        <h1>Terms of Use</h1>
        <div class="policy-breadcrumb">
            <a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:10px;margin:0 8px;"></i> <span>Terms of Use</span>
        </div>
    </div>
</section>

<section class="policy-content">
    <div class="container">
        <div class="policy-card">
            <h2>1. Agreement to Terms</h2>
            <p>By accessing or using CareerGyan, you agree to be bound by these Terms of Use and our Privacy Policy. If you do not agree with any part of these terms, you must not use our website.</p>

            <h2>2. Educational and Informational Purpose</h2>
            <p>The content provided on CareerGyan, including career paths, college data, aptitude tests, and AI guidance, is for informational and educational purposes only. It does not constitute professional counseling or guaranteed employment advice.</p>

            <h2>3. User Accounts</h2>
            <p>To access certain features (like aptitude tests and saved preferences), you may be required to register. You agree to provide accurate information and are responsible for maintaining the confidentiality of your account credentials.</p>

            <h2>4. Intellectual Property</h2>
            <p>The website and its original content, features, and functionality are owned by Indian Institute of Career Management and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>

            <h2>5. User Generated Content</h2>
            <p>When you post reviews or comments on colleges or articles, you grant us a non-exclusive, royalty-free license to use, modify, publicly perform, publicly display, reproduce, and distribute such content. You represent and warrant that you own or have the necessary rights to use and authorize the use of your content.</p>

            <h2>6. Third-Party Links and Ads</h2>
            <p>Our website may contain links to third-party web sites or services (such as advertisers like Google AdSense) that are not owned or controlled by us. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third party web sites or services.</p>

            <h2>7. Limitation of Liability</h2>
            <p>In no event shall CareerGyan, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>

            <h2>8. Changes to Terms</h2>
            <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. What constitutes a material change will be determined at our sole discretion.</p>

            <h2>9. Contact Us</h2>
            <p>If you have any questions about these Terms, please contact us at admin@careergyan.in.</p>
            <p><em>Last Updated: {{ date('F d, Y') }}</em></p>
        </div>
    </div>
</section>
@endsection

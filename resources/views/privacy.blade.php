@extends('layouts.app')

@section('title', 'Privacy Policy | INDIAN INSTITUTE OF CAREER MANAGEMENT')

@section('styles')
<style>
:root {
    --brand: #1a56db;
    --brand-dark: #1341a8;
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
        <h1>Privacy Policy</h1>
        <div class="policy-breadcrumb">
            <a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:10px;margin:0 8px;"></i> <span>Privacy Policy</span>
        </div>
    </div>
</section>

<section class="policy-content">
    <div class="container">
        <div class="policy-card">
            <h2>1. Introduction</h2>
            <p>Welcome to CareerGyan ("we", "our", or "us"). We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us at admin@careergyan.in.</p>

            <h2>2. Information We Collect</h2>
            <p>We collect personal information that you voluntarily provide to us when registering at the Website expressing an interest in obtaining information about us or our products and services, when participating in activities on the Website or otherwise contacting us.</p>
            <ul>
                <li><strong>Personal Data:</strong> Name, email address, passwords, contact data, and educational background.</li>
                <li><strong>Derived Data:</strong> Information our servers automatically collect when you access the Site, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the Site.</li>
            </ul>

            <h2>3. Google AdSense and DoubleClick DART Cookie</h2>
            <p>Google, as a third-party advertisement vendor, uses cookies to serve ads on this site. The use of DART cookies by Google enables them to serve adverts to visitors that are based on their visits to this website as well as other sites on the internet.</p>
            <p>To opt out of the DART cookies you may visit the Google ad and content network privacy policy at the following url <a href="http://www.google.com/privacy_ads.html" target="_blank" rel="noopener noreferrer">http://www.google.com/privacy_ads.html</a>. Tracking of users through the DART cookie mechanisms are subject to Google's own privacy policies.</p>

            <h2>4. Use of Your Information</h2>
            <p>Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the Site to:</p>
            <ul>
                <li>Create and manage your account.</li>
                <li>Deliver targeted advertising, coupons, newsletters, and other information regarding promotions and the Site to you.</li>
                <li>Compile anonymous statistical data and analysis for use internally or with third parties.</li>
                <li>Increase the efficiency and operation of the Site.</li>
            </ul>

            <h2>5. Disclosure of Your Information</h2>
            <p>We may share information we have collected about you in certain situations. Your information may be disclosed as follows:</p>
            <ul>
                <li><strong>By Law or to Protect Rights:</strong> If we believe the release of information about you is necessary to respond to legal process.</li>
                <li><strong>Third-Party Service Providers:</strong> We may share your information with third parties that perform services for us or on our behalf.</li>
                <li><strong>Third-Party Advertisers:</strong> We may use third-party advertising companies to serve ads when you visit the Site. These companies may use information about your visits to our Site and other websites that are contained in web cookies in order to provide advertisements about goods and services of interest to you.</li>
            </ul>

            <h2>6. Security of Your Information</h2>
            <p>We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable.</p>

            <h2>7. Contact Us</h2>
            <p>If you have questions or comments about this Privacy Policy, please contact us at:</p>
            <p>Indian Institute of Career Management<br>Nashik, Maharashtra, India<br>Email: admin@careergyan.in</p>
            <p><em>Last Updated: {{ date('F d, Y') }}</em></p>
        </div>
    </div>
</section>
@endsection

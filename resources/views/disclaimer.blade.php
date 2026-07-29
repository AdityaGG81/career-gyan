@extends('layouts.app')

@section('title', 'Disclaimer | INDIAN INSTITUTE OF CAREER MANAGEMENT')

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
        <h1>Disclaimer</h1>
        <div class="policy-breadcrumb">
            <a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:10px;margin:0 8px;"></i> <span>Disclaimer</span>
        </div>
    </div>
</section>

<section class="policy-content">
    <div class="container">
        <div class="policy-card">
            <h2>1. General Information</h2>
            <p>The information provided by CareerGyan ("we", "our", or "us") on our website is for general informational and educational purposes only. All information on the Site is provided in good faith, however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the Site.</p>

            <h2>2. Educational and Career Advice Disclaimer</h2>
            <p>The Site offers career guidance, aptitude testing, and college information. This information is designed for educational purposes only. You should not rely on this information as a substitute for, nor does it replace, professional career counseling or legal advice. If you have any concerns or questions about your career choices or educational path, you should always consult with a professional counselor or educational advisor.</p>

            <h2>3. External Links Disclaimer</h2>
            <p>The Site may contain (or you may be sent through the Site) links to other websites or content belonging to or originating from third parties or links to websites and features in banners or other advertising. Such external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability or completeness by us.</p>
            <p>We do not warrant, endorse, guarantee, or assume responsibility for the accuracy or reliability of any information offered by third-party websites linked through the site or any website or feature linked in any banner or other advertising.</p>

            <h2>4. Reviews and Testimonials</h2>
            <p>The Site may contain reviews and testimonials by users of our services or various colleges and institutions. These testimonials reflect the real-life experiences and opinions of such users. However, the experiences are personal to those particular users, and may not necessarily be representative of all users of our products and/or services or the institutions mentioned. We do not claim, and you should not assume, that all users will have the same experiences.</p>

            <h2>5. Affiliate and Advertising Disclaimer</h2>
            <p>We may partner with third-party advertisers (such as Google AdSense) to serve ads when you visit the Site. We are not responsible for the products, services, or actions of these third-party advertisers. Any dealings you have with advertisers found on our Site are strictly between you and the advertiser.</p>
            
            <p><em>Last Updated: {{ date('F d, Y') }}</em></p>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Return & Refund Policy | CareerGyan')

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
    position: relative;
}
.policy-hero h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
}
.policy-hero p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.85);
    max-width: 600px;
    margin: 0 auto 16px;
}
.policy-breadcrumb {
    font-size: 14px;
    color: rgba(255,255,255,.75);
}
.policy-breadcrumb a { color: inherit; text-decoration: none; }
.policy-breadcrumb a:hover { color: #fff; text-decoration: underline; }

.policy-content {
    padding: 60px 0 90px;
    background: var(--bg);
}
.policy-card {
    background: var(--surface);
    border-radius: var(--radius-xl);
    padding: 44px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 20px rgba(0,0,0,.04);
    max-width: 900px;
    margin: 0 auto;
    color: var(--text-2);
    font-size: 15px;
    line-height: 1.8;
}
.policy-card h2 {
    font-family: 'Sora', sans-serif;
    font-size: 21px;
    font-weight: 700;
    color: var(--text-1);
    margin-top: 36px;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
}
.policy-card h2 i {
    color: var(--brand);
    font-size: 18px;
}
.policy-card p {
    margin-bottom: 16px;
}
.policy-card ul, .policy-card ol {
    margin-bottom: 20px;
    padding-left: 24px;
}
.policy-card li {
    margin-bottom: 10px;
}

/* Callout Box - Strict Policy Notice */
.policy-alert {
    background: #fef2f2;
    border: 1.5px solid #fecaca;
    border-left: 5px solid #dc2626;
    border-radius: 14px;
    padding: 22px 24px;
    margin: 28px 0;
    color: #991b1b;
}
.policy-alert-title {
    font-weight: 800;
    font-size: 16px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #b91c1c;
}
.policy-alert p {
    margin-bottom: 0;
    color: #7f1d1d;
    font-size: 14.5px;
    line-height: 1.6;
}

/* Exception Box */
.exception-box {
    background: #eff6ff;
    border: 1.5px solid #bfdbfe;
    border-left: 5px solid #2563eb;
    border-radius: 14px;
    padding: 22px 24px;
    margin: 24px 0;
    color: #1e40af;
}
.exception-box-title {
    font-weight: 800;
    font-size: 16px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #1e3a8a;
}

/* Steps Box */
.steps-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 26px;
    margin: 24px 0;
}
.step-item {
    display: flex;
    gap: 16px;
    margin-bottom: 18px;
}
.step-item:last-child {
    margin-bottom: 0;
}
.step-num {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--brand);
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.step-text h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 4px;
}
.step-text p {
    font-size: 14px;
    color: var(--text-2);
    margin-bottom: 0;
    line-height: 1.5;
}

.contact-highlight {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 14px;
    padding: 22px 24px;
    margin: 28px 0;
}
.contact-highlight h4 {
    color: #166534;
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.contact-highlight a {
    color: #15803d;
    font-weight: 700;
    text-decoration: underline;
}

@media(max-width: 768px) {
    .policy-card {
        padding: 26px 20px;
    }
}
</style>
@endsection

@section('content')
<div class="policy-hero">
    <div class="container">
        <h1>Return & Refund Policy</h1>
        <p>Cancellation, Return, and Refund Policy for CareerGyan digital services and memberships.</p>
        <div class="policy-breadcrumb">
            <a href="{{ url('/') }}">Home</a> / <span>Return & Refund Policy</span>
        </div>
    </div>
</div>

<div class="policy-content">
    <div class="container">
        <div class="policy-card">
            
            <p style="font-size: 14px; color: var(--text-3); margin-bottom: 24px;">
                <strong>Last Updated:</strong> November 2026 | <strong>Applies To:</strong> careergyan.in (Indian Institute of Career Management)
            </p>

            <p>Welcome to <strong>CareerGyan</strong> (a platform owned and operated by the <strong>Indian Institute of Career Management</strong>). We are committed to providing high-quality digital career counselling, structured roadmaps, psychometric assessments, AI-driven evaluation tools, and VIP premium student memberships.</p>

            <p>Please read this Return & Refund Policy carefully before making any purchase on our platform.</p>

            {{-- 1. STRICT NO-REFUND POLICY --}}
            <div class="policy-alert">
                <div class="policy-alert-title">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    1. Strict No-Refund Policy on Successful Payments
                </div>
                <p>
                    <strong>Once a payment is successful, no payment will be refunded under any circumstances</strong>, except in verified cases where a technical error or glitch has occurred directly from the <strong>CareerGyan team or platform side</strong>.
                </p>
                <p style="margin-top: 10px;">
                    Because our services consist of instant-access digital goods (such as instant VIP membership activation, downloadable reports, career aptitude scoring algorithms, and premium AI features), digital access is provisioned immediately upon transaction completion and cannot be returned, cancelled, or reversed once utilized.
                </p>
            </div>

            {{-- 2. ELIGIBLE EXCEPTIONS --}}
            <h2><i class="fa-solid fa-circle-check"></i> 2. Exceptions Where Refunds Are Considered</h2>
            <p>A refund or transaction reversal will be evaluated and granted <strong>strictly and exclusively</strong> in cases where an error is proven to originate from the CareerGyan team, infrastructure, or payment processing systems, including:</p>

            <div class="exception-box">
                <div class="exception-box-title">
                    <i class="fa-solid fa-shield-halved"></i>
                    Valid Refund Grounds (Platform Errors Only)
                </div>
                <ul style="margin-bottom: 0; padding-left: 20px;">
                    <li><strong>Duplicate / Multiple Deductions:</strong> Your bank account, card, or UPI was debited multiple times for a single order/membership due to a payment gateway timeout or network retry error.</li>
                    <li><strong>Payment Deducted but Access Not Activated:</strong> Your payment was debited from your account, but your VIP membership or test access was not unlocked on CareerGyan, and our technical team is unable to manually activate access within <strong>48 to 72 business hours</strong> after notification.</li>
                    <li><strong>Verified System Billing Glitch:</strong> Any technical failure directly attributable to CareerGyan's platform software that prevents service fulfillment.</li>
                </ul>
            </div>

            {{-- 3. NON-REFUNDABLE SCENARIOS --}}
            <h2><i class="fa-solid fa-circle-xmark"></i> 3. Non-Refundable Scenarios</h2>
            <p>Refunds will <strong>NOT</strong> be issued under the following circumstances:</p>
            <ul>
                <li><strong>Change of Mind:</strong> Deciding that you no longer want or need the membership or test after completing payment.</li>
                <li><strong>Accidental Purchase:</strong> Ordering or subscribing by mistake.</li>
                <li><strong>Dissatisfaction with Results:</strong> Disagreement or dissatisfaction with psychometric test scores, stream fitment results, AI recommendations, or college cutoffs.</li>
                <li><strong>Unused Services:</strong> Failure by the student to take tests, access roadmaps, or utilize the VIP benefits during the active subscription period.</li>
                <li><strong>Account Termination:</strong> Suspensions or cancellations of accounts resulting from fraudulent activity, abusive behavior, or violations of our Terms of Service.</li>
            </ul>

            {{-- 4. REPORTING PROCESS & MAILING INSTRUCTIONS --}}
            <h2><i class="fa-solid fa-envelope-open-text"></i> 4. How to Report an Error to Request a Refund</h2>
            <p>If you believe a payment error occurred from the CareerGyan team side, <strong>you must report the issue by sending an email to our official support team</strong>.</p>

            <div class="steps-card">
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">
                        <h4>Send an Email to our Official Support Desk</h4>
                        <p>Write an email to <a href="mailto:admin.careergyan@gmail.com" style="font-weight: 700; color: var(--brand);">admin.careergyan@gmail.com</a> with the subject line:<br>
                        <code style="background: #e2e8f0; padding: 3px 8px; border-radius: 6px; font-size: 13px; color: #0f172a;">Payment Error & Refund Request - [Your Full Name] - [Registered Email]</code></p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">
                        <h4>Provide Required Transaction Details</h4>
                        <p>To help us trace your payment in banking logs, you must provide the following information in your email:</p>
                        <ul style="margin-top: 8px; margin-bottom: 0; font-size: 13.5px;">
                            <li><strong>Full Student Name</strong> (as registered on your CareerGyan profile)</li>
                            <li><strong>Registered Email Address and Mobile Number</strong></li>
                            <li><strong>Transaction ID / Payment Gateway Reference Number</strong> (e.g., Razorpay Payment ID or Bank UTR)</li>
                            <li><strong>Date and Exact Time</strong> of the transaction</li>
                            <li><strong>Exact Amount Deducted</strong> (in INR ₹)</li>
                            <li><strong>Screenshot / Bank Debit Proof</strong> clearly displaying the transaction reference and deduction details</li>
                            <li><strong>Description of Error Encountered</strong> (e.g., double deduction, failed activation screen)</li>
                        </ul>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">
                        <h4>Report Within 7 Days</h4>
                        <p>All claims must be mailed to us within <strong>7 calendar days</strong> from the date of the disputed transaction. Requests sent after 7 days cannot be entertained due to payment processor reconciliation windows.</p>
                    </div>
                </div>
            </div>

            {{-- 5. REVIEW & TIMELINE --}}
            <h2><i class="fa-solid fa-clock-rotate-left"></i> 5. Investigation and Payout Timeline</h2>
            <ol>
                <li><strong>Verification:</strong> Upon receiving your email, our accounts and technical team will cross-check the transaction logs with the payment gateway partner within <strong>3 to 5 business days</strong>.</li>
                <li><strong>Approval & Reversal:</strong> If an error from the CareerGyan side is verified, the refund will be initiated immediately.</li>
                <li><strong>Bank Processing:</strong> The refund will be credited back to the <strong>original payment method</strong> (UPI, Debit/Credit Card, or Net Banking) within <strong>7 to 10 working days</strong>, subject to your issuing bank's clearing timelines.</li>
            </ol>

            {{-- 6. CONTACT --}}
            <h2><i class="fa-solid fa-headset"></i> 6. Contact Information</h2>
            <p>For any billing queries, technical difficulties, or payment dispute reports, please contact our support team:</p>

            <div class="contact-highlight">
                <h4><i class="fa-solid fa-building-columns"></i> Indian Institute of Career Management (CareerGyan)</h4>
                <p style="margin-bottom: 6px;"><strong>Email:</strong> <a href="mailto:admin.careergyan@gmail.com">admin.careergyan@gmail.com</a></p>
                <p style="margin-bottom: 6px;"><strong>Phone / WhatsApp:</strong> <a href="tel:+919373912370">+91 93739 12370</a></p>
                <p style="margin-bottom: 6px;"><strong>Address:</strong> Nashik, Maharashtra, India</p>
                <p style="margin-bottom: 0;"><strong>Support Hours:</strong> Monday – Saturday, 8:00 AM to 6:00 PM IST</p>
            </div>

        </div>
    </div>
</div>
@endsection

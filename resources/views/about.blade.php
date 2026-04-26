@extends('layouts.app')

@section('title', 'About Us | Indian Institute of Career Management')

@section('styles')
<style>
.about-hero {
    background: linear-gradient(135deg, #0e1f6b 0%, #1a56db 100%); 
    color: #fff; padding: 100px 0 80px; text-align: center;
}
.about-hero h1 { font-family:'Sora'; font-size:36px; margin-bottom:16px; }
.about-hero p { font-size: 18px; color: rgba(255,255,255,.8); max-width: 600px; margin: 0 auto; }

.contact-card {
    background: #fff; border: 1px solid var(--border); border-radius: var(--radius-xl);
    padding: 40px; box-shadow: var(--shadow-md); margin-top: -40px; position:relative;
    display:grid; grid-template-columns: 1fr 1fr; gap:40px;
}
@media(max-width:768px) {
    .contact-card { grid-template-columns: 1fr; padding:30px; }
}

.ct-block { margin-bottom: 24px; }
.ct-block h3 { color:var(--brand); font-family:'Sora'; font-size:16px; margin-bottom:8px; display:flex; align-items:center; gap:8px;}
.ct-block p { color:var(--text-2); font-size:16px; }

</style>
@endsection

@section('content')
<section class="about-hero">
    <div class="container">
        <h1>Indian Institute of Career Management</h1>
        <p>Empowering students and professionals to make data-driven, confident career choices through the CareerGyan platform.</p>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="contact-card">
            <div>
                <h2 style="font-family:'Sora'; font-size:28px; margin-bottom:16px;">Get In Touch</h2>
                <p style="color:var(--text-2); margin-bottom:32px;">Have questions about the CareerGyan platform, need career counseling, or looking for partnerships? We are here to help!</p>

                <div class="ct-block">
                    <h3><i class="fa-solid fa-phone"></i> Phone</h3>
                    <p><a href="tel:9373912370">9373912370</a></p>
                </div>
                
                <div class="ct-block">
                    <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                    <p><a href="mailto:dkakad.dk@gmail.com">dkakad.dk@gmail.com</a></p>
                </div>
            </div>
            
            <div style="background:var(--bg); border:1px solid var(--border); padding:32px; border-radius:var(--radius-lg);">
                <div class="ct-block">
                    <h3><i class="fa-solid fa-location-dot"></i> Address</h3>
                    <p>B wing 95,96 Business Index,<br>Hanumanwadi Makhmalabad road,<br>Nashik-3, Maharashtra, India</p>
                </div>

                <div class="ct-block" style="margin-bottom:0;">
                    <h3><i class="fa-solid fa-clock"></i> Working Hours</h3>
                    <p>Mon-Sat: <strong>8:00 AM – 6:00 PM</strong><br>Sunday: <strong style="color:var(--rose);">Closed</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

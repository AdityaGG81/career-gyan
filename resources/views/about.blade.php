@extends('layouts.app')

@section('title', 'About Us | INDIAN INSTITUTE OF CAREER MANAGEMENT')

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
    
    .ct-block .working-hours {
        font-size: 14px !important;
    }
    
    .ct-block .working-hours .closed-badge {
        font-size: 14px !important;
        padding: 1px 4px !important;
    }
}

.ct-block { margin-bottom: 24px; }
.ct-block h3 { color:var(--brand); font-family:'Sora'; font-size:16px; margin-bottom:8px; display:flex; align-items:center; gap:8px;}
.ct-block p { color:var(--text-2); font-size:16px; }


/* Our Team Section */
.about-team-section {
    margin-top: 56px;
}
.about-team-header {
    text-align: center;
    margin-bottom: 40px;
}
.about-team-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(24px, 4vw, 32px);
    font-weight: 800;
    color: var(--text-1);
    margin-top: 8px;
}
.about-team-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}
.team-role-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    box-shadow: 0 2px 12px rgba(0,0,0,.04);
    transition: transform .3s ease, box-shadow .3s ease;
}
.team-role-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}
.team-role-card--wide {
    grid-column: span 2;
}
.team-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 999px;
    margin-bottom: 24px;
}
.role-principal { background: #dbeafe; color: #1e3a8a; }
.role-ceo       { background: #ede9fe; color: #5b21b6; }
.role-creative  { background: #d1fae5; color: #065f46; }
.role-thanks    { background: #fce7f3; color: #9d174d; }

.team-members-list {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
}
.team-member {
    display: flex;
    align-items: center;
    gap: 14px;
}
.team-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: .03em;
}
.team-member-name {
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--text-1);
}

@media (max-width: 768px) {
    .about-team-grid { grid-template-columns: 1fr; }
    .team-role-card--wide { grid-column: span 1; }
    .team-members-list { flex-direction: column; gap: 16px; }
    .team-role-card { padding: 24px; }
}

</style>
@endsection

@section('content')
<section class="about-hero">
    <div class="container">
        <h1>INDIAN INSTITUTE OF CAREER MANAGEMENT</h1>
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
                    <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                    <p><a href="mailto:admin@careergyan.in">admin@careergyan.in</a></p>
                </div>
            </div>
            
            <div style="background:var(--bg); border:1px solid var(--border); padding:32px; border-radius:var(--radius-lg);">
                <div class="ct-block">
                    <h3><i class="fa-solid fa-location-dot"></i> Address</h3>
                    <p>B wing 95,96 Business Index,<br>Hanumanwadi Makhmalabad road,<br>Nashik-3, Maharashtra, India</p>
                </div>

                <div class="ct-block" style="margin-bottom:0;">
                    <h3><i class="fa-solid fa-clock"></i> Working Hours</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <div class="working-hours" style="font-size: 16px; font-weight: 700; color: #475569;">
                            Mon-Sat: 8:00 AM – 6:00 PM
                        </div>
                        <div class="working-hours" style="font-size: 16px; font-weight: 400; color: #475569;">
                            Sunday: <span class="closed-badge" style="color: #64748b;">Closed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Team Section -->
        <div class="about-team-section">
            <div class="about-team-header">
                <div class="section-label"><i class="fa-solid fa-users"></i> OUR TEAM</div>
                <h2 class="about-team-title">Meet the People Behind CareerGyan</h2>
            </div>

            <div class="about-team-grid">
                <!-- Principal -->
                <div class="team-role-card">
                    <div class="team-role-badge role-principal"><i class="fa-solid fa-crown"></i> Principal</div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #1e3a8a, #1d4ed8);">DD</div>
                        <div class="team-member-name">Mr. Dynaneshwar D. Kakad</div>
                    </div>
                </div>

                <!-- CEO -->
                <div class="team-role-card">
                    <div class="team-role-badge role-ceo"><i class="fa-solid fa-star"></i> CEO</div>
                    <div class="team-member">
                        <div class="team-avatar" style="background: linear-gradient(135deg, #7c3aed, #4f46e5);">SK</div>
                        <div class="team-member-name">Er. Sudarshan D. Kakad</div>
                    </div>
                </div>

                <!-- Creative Team -->
                <div class="team-role-card team-role-card--wide">
                    <div class="team-role-badge role-creative"><i class="fa-solid fa-palette"></i> Creative Team</div>
                    <div class="team-members-list">
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #0284c7, #38bdf8);">AG</div>
                            <div class="team-member-name">Er. Abhishek Gite</div>
                        </div>
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #7c3aed, #a78bfa);">OA</div>
                            <div class="team-member-name">Er. Omkar Avhad</div>
                        </div>
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #059669, #10b981);">AG</div>
                            <div class="team-member-name">Er. Aditya Ghorpade</div>
                        </div>
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #d97706, #f59e0b);">SC</div>
                            <div class="team-member-name">Er. Shubham Chitte</div>
                        </div>
                    </div>
                </div>

                <!-- Special Thanks -->
                <div class="team-role-card team-role-card--wide">
                    <div class="team-role-badge role-thanks"><i class="fa-solid fa-heart"></i> Special Thanks &amp; Gratitude</div>
                    <div class="team-members-list">
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #be185d, #ec4899);">JP</div>
                            <div class="team-member-name">Er. Jay Pardeshi</div>
                        </div>
                        <div class="team-member">
                            <div class="team-avatar" style="background: linear-gradient(135deg, #9333ea, #c084fc);">SJ</div>
                            <div class="team-member-name">Mr. Sujit Jadhav</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

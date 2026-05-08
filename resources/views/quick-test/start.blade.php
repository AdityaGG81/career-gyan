@extends('layouts.app')

@section('title', 'Quick Test | CareerGyan')

@section('content')
<div class="section" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: var(--radius-xl); box-shadow: var(--shadow-md); border: 1px solid var(--border);">
            <div style="text-align: center; margin-bottom: 30px;">
                <span class="section-label">Aptitude Discovery</span>
                <h1 class="section-title" style="margin-top: 10px;">Quick Career Aptitude Test</h1>
                <p class="section-sub" style="margin: 20px auto;">A short, focused assessment to help you identify your primary career strengths in just 20 minutes.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div style="background: var(--bg); padding: 20px; border-radius: var(--radius-md); text-align: center; border: 1px solid var(--border);">
                    <i class="fa-solid fa-clock" style="font-size: 24px; color: var(--brand); margin-bottom: 10px;"></i>
                    <h3 style="font-size: 16px; margin-bottom: 5px;">Timer</h3>
                    <p style="font-size: 14px; color: var(--text-2);">20 Minutes</p>
                </div>
                <div style="background: var(--bg); padding: 20px; border-radius: var(--radius-md); text-align: center; border: 1px solid var(--border);">
                    <i class="fa-solid fa-list-check" style="font-size: 24px; color: var(--brand); margin-bottom: 10px;"></i>
                    <h3 style="font-size: 16px; margin-bottom: 5px;">Questions</h3>
                    <p style="font-size: 14px; color: var(--text-2);">16 MCQ Questions</p>
                </div>
                <div style="background: var(--bg); padding: 20px; border-radius: var(--radius-md); text-align: center; border: 1px solid var(--border);">
                    <i class="fa-solid fa-layer-group" style="font-size: 24px; color: var(--brand); margin-bottom: 10px;"></i>
                    <h3 style="font-size: 16px; margin-bottom: 5px;">Sections</h3>
                    <p style="font-size: 14px; color: var(--text-2);">7 Key Aptitudes</p>
                </div>
            </div>

            <div style="background: #fff8f1; border-left: 4px solid var(--accent); padding: 20px; border-radius: 4px; margin-bottom: 40px;">
                <h4 style="color: #9a3412; font-size: 15px; margin-bottom: 8px;"><i class="fa-solid fa-circle-info"></i> Instructions</h4>
                <ul style="font-size: 14px; color: #9a3412; list-style: disc; padding-left: 20px; line-height: 1.6;">
                    <li>Read each question carefully before answering.</li>
                    <li>Some questions contain diagrams or images to analyze.</li>
                    <li>The test will auto-submit once the 20-minute timer expires.</li>
                    <li>Do not refresh the page during the test.</li>
                </ul>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('quick-test.quiz') }}" class="nav-cta" style="display: inline-flex; height: 54px; padding: 0 40px; font-size: 16px;">
                    Start Quick Test <i class="fa-solid fa-arrow-right" style="margin-left: 10px;"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

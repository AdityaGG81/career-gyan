@extends('layouts.app')

@section('title', 'Aptitude Test | CareerGyan')

@section('content')
<main>
    <div style="background: linear-gradient(135deg, var(--brand-dark), var(--brand)); color: white; padding: 100px 0 80px; text-align: center;">
        <div class="container fade-up">
            <span class="section-label" style="background: rgba(255,255,255,0.2); color: white; margin-bottom: 20px;">
                <i class="fa-solid fa-brain"></i> A.I. Career Matching
            </span>
            <h1 style="font-family: 'Sora'; font-size: clamp(32px, 5vw, 48px); font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                Discover Your Perfect Career Path
            </h1>
            <p style="font-size: 18px; opacity: 0.9; max-width: 600px; margin: 0 auto 40px;">
                Take our comprehensive 21-question aptitude test. We analyze your strengths across 7 core dimensions to recommend the exact careers built for your mind.
            </p>
            <a href="{{ route('test.quiz') }}" style="display: inline-block; background: var(--accent); color: white; padding: 16px 36px; font-size: 18px; font-weight: 600; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); transition: transform 0.2s;">
                Start Free Test <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
            </a>
            <p style="margin-top: 16px; font-size: 14px; opacity: 0.7;">Takes approximately 15 minutes. No account required.</p>
        </div>
    </div>

    <div class="container section">
        <div style="text-align: center; margin-bottom: 60px;" class="fade-up">
            <h2 class="section-title">What we evaluate</h2>
            <p class="section-sub" style="margin: 10px auto 0;">The 7 dimensions of your unique aptitude profile.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            <div style="background: white; padding: 30px; border-radius: var(--radius-lg); border: 1px solid var(--border);" class="fade-up fade-up-1">
                <div style="font-size: 24px; color: var(--brand); margin-bottom: 15px;"><i class="fa-solid fa-language"></i></div>
                <h3 style="font-family: 'Sora'; font-weight: 600; margin-bottom: 10px; font-size: 18px;">Language & Verbal</h3>
                <p style="color: var(--text-2); font-size: 15px;">Your ability to dissect arguments, understand complex texts, and communicate effectively.</p>
            </div>
            <div style="background: white; padding: 30px; border-radius: var(--radius-lg); border: 1px solid var(--border);" class="fade-up fade-up-2">
                <div style="font-size: 24px; color: var(--accent); margin-bottom: 15px;"><i class="fa-solid fa-calculator"></i></div>
                <h3 style="font-family: 'Sora'; font-weight: 600; margin-bottom: 10px; font-size: 18px;">Numerical & Spatial</h3>
                <p style="color: var(--text-2); font-size: 15px;">Your capacity for logical deduction, mathematical operations, and visualizing 3D objects.</p>
            </div>

            <div style="background: white; padding: 30px; border-radius: var(--radius-lg); border: 1px solid var(--border);" class="fade-up fade-up-3">
                <div style="font-size: 24px; color: var(--teal); margin-bottom: 15px;"><i class="fa-solid fa-shapes"></i></div>
                <h3 style="font-family: 'Sora'; font-weight: 600; margin-bottom: 10px; font-size: 18px;">Abstract & Mechanical</h3>
                <p style="color: var(--text-2); font-size: 15px;">How you recognize non-verbal patterns, rules, and understand physical principles.</p>
            </div>
        </div>
    </div>
</main>
@endsection

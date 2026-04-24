@extends('layouts.app')

@section('title', $field->name . ' - Modern Career Guide')

@section('styles')
<style>
body { background: #0f172a; }
.hero-modern { padding: 100px 0; background: radial-gradient(circle at top right, #1e1b4b, #0f172a); color: white; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
.hero-modern h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 48px; background: linear-gradient(to right, #fff, {{ $field->color }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

.career-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-top: 60px; }
.career-card { background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 32px; padding: 40px; transition: 0.4s; position: relative; overflow: hidden; }
.career-card:hover { transform: translateY(-10px) scale(1.02); border-color: {{ $field->color }}; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }

.career-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, transparent, {{ $field->color }}, transparent); }

.career-name { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 800; color: white; margin-bottom: 20px; }
.income-tag { display: inline-block; padding: 6px 16px; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 50px; font-weight: 800; font-size: 12px; margin-bottom: 20px; border: 1px solid rgba(16, 185, 129, 0.3); }

.detail-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; }
.detail-item i { color: {{ $field->color }}; font-size: 18px; margin-top: 3px; }
.detail-item h5 { color: rgba(255,255,255,0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.detail-item p { color: white; font-size: 14px; line-height: 1.5; }

.btn-roadmap { display: block; width: 100%; padding: 15px; background: {{ $field->color }}; color: white; border-radius: 16px; text-align: center; text-decoration: none; font-weight: 800; margin-top: 30px; transition: 0.3s; }
.btn-roadmap:hover { opacity: 0.9; transform: scale(0.98); }
</style>
@endsection

@section('content')
<section class="hero-modern">
    <div class="container">
        <span style="color:{{ $field->color }}; font-weight:800; letter-spacing:2px; text-transform:uppercase; font-size:12px;">The Future of Work</span>
        <h1 style="margin-top:10px;"><i class="fa-solid {{ $field->icon }}"></i> {{ $field->name }}</h1>
        <p style="opacity:0.7; max-width:600px; margin:20px auto 0;">Master the skills of tomorrow. No traditional degree required—just passion and consistency.</p>
    </div>
</section>

<div class="container">
    <div class="career-grid">
        @foreach($careers as $career)
        <div class="career-card">
            <span class="income-tag">POTENTIAL: {{ $career->income_potential }}</span>
            <h4 class="career-name">{{ $career->name }}</h4>
            
            <div class="detail-item">
                <i class="fa-solid fa-brain"></i>
                <div>
                    <h5>Core Skills</h5>
                    <p>{{ $career->required_skills }}</p>
                </div>
            </div>

            <div class="detail-item">
                <i class="fa-solid fa-route"></i>
                <div>
                    <h5>Learning Path</h5>
                    @if(is_array($career->learning_path))
                        <ul style="padding:0; list-style:none; margin:0;">
                            @foreach($career->learning_path as $step)
                                <li style="color:white; font-size:13px; margin-bottom:5px;">{{ $step }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $career->learning_path }}</p>
                    @endif
                </div>
            </div>

            <div class="detail-item">
                <i class="fa-solid fa-toolbox"></i>
                <div>
                    <h5>Top Platforms</h5>
                    <p>{{ $career->platforms }}</p>
                </div>
            </div>

            <div class="detail-item" style="margin-bottom:0;">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <h5>Est. Duration</h5>
                    <p>{{ $career->duration_to_learn }}</p>
                </div>
            </div>

            <a href="#" class="btn-roadmap">Build My Roadmap &rarr;</a>
        </div>
        @endforeach
    </div>
</div>

<br><br><br>
@endsection

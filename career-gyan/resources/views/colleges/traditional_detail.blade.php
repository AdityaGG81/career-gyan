@extends('layouts.app')

@section('title', $field->name . ' - Career Paths')

@section('styles')
<style>
.hero-sec { padding: 80px 0; background: {{ $field->bg_color }}; color: {{ $field->color }}; text-align: center; border-radius: 0 0 50px 50px; }
.hero-sec h1 { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 42px; margin-bottom: 15px; }

.career-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; margin-top: 60px; }
.career-card { background: white; border-radius: 24px; padding: 35px; border: 1px solid #e2e8f0; border-left: 8px solid {{ $field->color }}; transition: 0.3s; }
.career-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

.career-name { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 20px; }
.meta-list { list-style: none; padding: 0; margin: 0; }
.meta-list li { display: flex; align-items: center; gap: 12px; font-size: 14px; color: #475569; margin-bottom: 12px; }
.meta-list li i { color: {{ $field->color }}; width: 20px; text-align: center; }
.meta-list b { color: #1e293b; }

.stability-badge { display: inline-block; padding: 4px 12px; background: #dcfce7; color: #166534; font-size: 11px; font-weight: 800; border-radius: 30px; margin-bottom: 15px; text-transform: uppercase; }
</style>
@endsection

@section('content')
<section class="hero-sec">
    <div class="container">
        <h1><i class="fa-solid {{ $field->icon }}"></i> {{ $field->name }}</h1>
        <p>Explore specialized, stable, and respected career paths in this field.</p>
    </div>
</section>

<div class="container">
    <div class="career-grid">
        @foreach($careers as $career)
        <div class="career-card">
            <span class="stability-badge">{{ $career->stability }} Stability</span>
            <h4 class="career-name">{{ $career->name }}</h4>
            <ul class="meta-list">
                <li><i class="fa-solid fa-graduation-cap"></i> Education: <b>{{ $career->education }}</b></li>
                <li><i class="fa-solid fa-file-pen"></i> Key Exam: <b>{{ $career->exam }}</b></li>
                <li><i class="fa-solid fa-hourglass-start"></i> Journey: <b>{{ $career->duration }}</b></li>
                <li><i class="fa-solid fa-indian-rupee-sign"></i> Avg. Salary: <b>{{ $career->salary }}</b></li>
            </ul>
        </div>
        @endforeach
    </div>
</div>

<br><br><br>
@endsection

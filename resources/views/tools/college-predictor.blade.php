@extends('layouts.app')

@section('title', 'Engineering & Medical College Predictor | CareerGyan')
@section('meta_description', 'Predict your admission chances in top engineering and medical colleges in India based on your JEE Main, NEET, or MHT CET scores.')
@section('meta_keywords', 'college predictor, jee main college predictor, neet college predictor, mht cet college predictor, engineering admission predictor')

@section('content')
<div style="background:var(--bg); min-height:80vh; padding:60px 0;">
    <div class="container">
        <h1 style="font-size:32px; margin-bottom:20px;">College Predictor</h1>
        <p style="font-size:16px; color:var(--text-2); margin-bottom:40px;">
            Find out which colleges you can get into based on your entrance exam scores (JEE Main, NEET, MHT CET).
        </p>

        <div style="background:#fff; border:1px solid var(--border); border-radius:var(--radius-lg); padding:40px; text-align:center;">
            <i class="fa-solid fa-building-columns" style="font-size:48px; color:var(--brand); margin-bottom:20px;"></i>
            <h2 style="font-size:24px; margin-bottom:10px;">Predictor Coming Soon</h2>
            <p style="color:var(--text-3); max-width:600px; margin:0 auto;">
                Our AI-based college prediction tool is currently in development. It will analyze historical cutoffs to provide you with the most accurate admission probabilities.
            </p>
        </div>
    </div>
</div>
@endsection

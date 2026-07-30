@extends('layouts.app')

@section('title', 'MHT CET Percentile Calculator | CareerGyan')
@section('meta_description', 'Calculate your expected MHT CET percentile based on your marks. Use our advanced MHT CET marks to percentile calculator to predict your rank.')
@section('meta_keywords', 'percentile calculator, mht cet marks to percentile, mht cet rank predictor, calculate percentile')

@section('content')
<div style="background:var(--bg); min-height:80vh; padding:60px 0;">
    <div class="container">
        <h1 style="font-size:32px; margin-bottom:20px;">MHT CET Percentile Calculator</h1>
        <p style="font-size:16px; color:var(--text-2); margin-bottom:40px;">
            Input your expected marks to estimate your MHT CET percentile and rank.
        </p>

        <div style="background:#fff; border:1px solid var(--border); border-radius:var(--radius-lg); padding:40px; text-align:center;">
            <i class="fa-solid fa-calculator" style="font-size:48px; color:var(--brand); margin-bottom:20px;"></i>
            <h2 style="font-size:24px; margin-bottom:10px;">Calculator Coming Soon</h2>
            <p style="color:var(--text-3); max-width:600px; margin:0 auto;">
                We are currently building our advanced percentile calculator algorithm for the latest exam pattern. Stay tuned!
            </p>
        </div>
    </div>
</div>
@endsection

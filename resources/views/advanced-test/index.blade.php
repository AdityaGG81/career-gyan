@extends('layouts.app')

@section('title', 'Advanced Assessments Hub | CareerGyan')

@section('styles')
<style>
    .assessment-hub {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 60px 24px;
    }

    .hub-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .hub-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .hub-header h1 {
        font-family: 'Sora';
        font-size: 32px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 8px;
    }

    .hub-header p {
        color: var(--text-2);
        font-size: 15.5px;
    }

    .assessment-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 50px;
    }

    @media(max-width: 768px) {
        .assessment-grid {
            grid-template-columns: 1fr;
        }
    }

    .assessment-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 35px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .assessment-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--card-color, var(--brand));
    }

    .assessment-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .card-top {
        margin-bottom: 25px;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: var(--brand-light);
        color: var(--card-color, var(--brand));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .card-top h3 {
        font-family: 'Sora';
        font-size: 19px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 10px;
    }

    .card-top p {
        font-size: 13.5px;
        color: var(--text-2);
        line-height: 1.5;
    }

    .card-meta {
        display: flex;
        gap: 15px;
        font-size: 12.5px;
        color: var(--text-3);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .card-meta span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .start-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 46px;
        background: var(--card-color, var(--brand));
        color: white;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 14.5px;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .start-btn:hover {
        opacity: 0.9;
        color: white;
    }

    /* History table */
    .history-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 35px;
        box-shadow: var(--shadow-sm);
    }

    .history-card h3 {
        font-family: 'Sora';
        font-size: 20px;
        font-weight: 800;
        color: var(--text-1);
        margin-bottom: 25px;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .history-table th {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-3);
        font-weight: 700;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border);
    }

    .history-table td {
        padding: 15px 0;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
        color: var(--text-2);
    }

    .history-table tr:last-child td {
        border-bottom: none;
    }

    .result-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        background: var(--brand-light);
        color: var(--brand);
        display: inline-block;
    }
</style>
@endsection

@section('content')
<div class="assessment-hub">
    <div class="hub-container">
        
        <div class="hub-header">
            <h1>Advanced Assessments Hub</h1>
            <p>Select a detailed testing track to uncover key parameters for your career roadmap.</p>
        </div>

        <div class="assessment-grid">
            @foreach($tests as $test)
                <div class="assessment-card" style="--card-color: {{ $test['color'] }}">
                    <div class="card-top">
                        <div class="card-icon" style="background: {{ $test['color'] }}15;">
                            <i class="{{ $test['icon'] }}"></i>
                        </div>
                        <h3>{{ $test['title'] }}</h3>
                        <p>{{ $test['desc'] }}</p>
                    </div>
                    
                    <div>
                        <div class="card-meta">
                            <span><i class="fa-solid fa-list-check"></i> {{ $test['questions_count'] }} Questions</span>
                            <span><i class="fa-solid fa-clock"></i> {{ $test['duration'] }}</span>
                        </div>
                        
                        <a href="{{ route('advanced-test.start', $test['id']) }}" class="start-btn">
                            Begin Assessment <i class="fa-solid fa-play" style="font-size: 11px;"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- History -->
        <div class="history-card">
            <h3>Your Assessment History</h3>
            
            @if($attempts->isEmpty())
                <div style="text-align: center; padding: 40px 0;">
                    <i class="fa-solid fa-box-open" style="font-size: 40px; color: var(--text-3); opacity: 0.5; margin-bottom: 15px;"></i>
                    <p style="color: var(--text-3);">You haven’t completed any advanced assessments yet.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Assessment</th>
                                <th>Date Completed</th>
                                <th>Archetype / Match</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attempts as $attempt)
                                <tr>
                                    <td style="font-weight: 700; color: var(--text-1); text-transform: capitalize;">
                                        {{ str_replace('-', ' ', $attempt->test_type) }}
                                    </td>
                                    <td>{{ $attempt->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <span class="result-badge">
                                            {{ $attempt->recommendations['archetype'] ?? 'Completed' }}
                                        </span>
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('advanced-test.results', $attempt->uuid) }}" style="font-weight: 700; color: var(--brand); text-decoration: none; margin-right: 15px;">
                                            View Report
                                        </a>
                                        <a href="{{ route('advanced-test.certificate', $attempt->uuid) }}" target="_blank" style="font-weight: 700; color: #10b981; text-decoration: none;">
                                            <i class="fa-solid fa-award"></i> Certificate
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

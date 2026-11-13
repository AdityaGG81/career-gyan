@extends('layouts.app')

@section('title', 'My Career Analysis Reports | CareerGyan')

@section('styles')
<style>
  .my-analyses-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    padding: 50px 20px 90px;
    font-family: 'Inter', system-ui, sans-serif;
  }
  .analyses-container {
    max-width: 960px;
    margin: 0 auto;
  }
  .header-card {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    color: #ffffff;
    border-radius: 20px;
    padding: 36px 32px;
    margin-bottom: 28px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
  }
  .header-title {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 8px;
    letter-spacing: -0.02em;
  }
  .header-subtitle {
    font-size: 15px;
    opacity: 0.9;
    max-width: 540px;
    line-height: 1.5;
  }
  .btn-new-analysis {
    background: #ffffff;
    color: #1e3a8a;
    font-weight: 700;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
  .btn-new-analysis:hover {
    background: #f1f5f9;
    transform: translateY(-2px);
    color: #1d4ed8;
  }
  .analysis-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
  }
  .analysis-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px 28px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;
    transition: all 0.2s;
  }
  .analysis-card:hover {
    border-color: #93c5fd;
    box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1);
    transform: translateY(-2px);
  }
  .student-name {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
  }
  .student-meta {
    font-size: 13.5px;
    color: #64748b;
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
  }
  .student-meta span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-class {
    background: #eff6ff;
    color: #2563eb;
    padding: 4px 10px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 12px;
  }
  .btn-view-report {
    background: #2563eb;
    color: #ffffff;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
  }
  .btn-view-report:hover {
    background: #1d4ed8;
    color: #ffffff;
  }
  .empty-state {
    background: #ffffff;
    border-radius: 16px;
    padding: 60px 24px;
    text-align: center;
    border: 1px dashed #cbd5e1;
  }
  .empty-icon {
    font-size: 48px;
    color: #94a3b8;
    margin-bottom: 16px;
  }
  .empty-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
  }
  .empty-desc {
    color: #64748b;
    font-size: 14px;
    max-width: 440px;
    margin: 0 auto 24px;
  }
</style>
@endsection

@section('content')
<div class="my-analyses-page">
  <div class="analyses-container">
    <div class="header-card">
      <div>
        <h1 class="header-title">My Career Analysis Reports</h1>
        <p class="header-subtitle">Review your AI-powered career evaluation reports, performance profiles, and personalized guidance.</p>
      </div>
      <div>
        <a href="{{ route('student-analysis.create') }}" class="btn-new-analysis">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
          New Analysis
        </a>
      </div>
    </div>

    @if($analyses->isEmpty())
      <div class="empty-state">
        <div class="empty-icon">📊</div>
        <h3 class="empty-title">No Career Analysis Reports Yet</h3>
        <p class="empty-desc">Complete a 2-minute comprehensive student analysis to receive AI career recommendations, stream fitment, and detailed roadmap guidance.</p>
        <a href="{{ route('student-analysis.create') }}" class="btn-new-analysis" style="background:#2563eb; color:#ffffff;">Start Career Analysis Now</a>
      </div>
    @else
      <div class="analysis-grid">
        @foreach($analyses as $item)
          <div class="analysis-card">
            <div>
              <div class="student-name">
                {{ $item->full_name }}
                <span class="badge-class">{{ $item->current_class }} • {{ $item->current_stream }}</span>
              </div>
              <div class="student-meta">
                <span>📍 {{ $item->city_district ?? 'India' }}</span>
                @if($item->desired_admission_course)
                  <span>🎯 Desired: {{ $item->desired_admission_course }}</span>
                @endif
                <span>📅 {{ $item->created_at->format('d M Y, h:i A') }}</span>
              </div>
            </div>
            <div>
              <a href="{{ route('student-analysis.show', $item->uuid) }}" class="btn-view-report">
                View Report
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection

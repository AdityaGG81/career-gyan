@extends('layouts.app')

@section('title', 'Advanced Career Assessment | CareerGyan Pro')

@section('styles')
<style>
  .adv-test-page {
    background: #f8fafc;
    min-height: calc(100vh - 80px);
    padding: 60px 20px 90px;
    font-family: 'Inter', system-ui, sans-serif;
  }

  .adv-test-container {
    max-width: 860px;
    margin: 0 auto;
  }

  .adv-test-header {
    text-align: center;
    margin-bottom: 40px;
  }

  .adv-pro-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    font-size: 13px;
    font-weight: 800;
    padding: 6px 16px;
    border-radius: 999px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(245, 158, 11, 0.15);
    margin-bottom: 16px;
  }

  .adv-test-header h1 {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 36px;
    font-weight: 800;
    color: var(--text-1, #0f172a);
    margin-bottom: 12px;
    letter-spacing: -0.02em;
  }

  .adv-test-header p {
    color: var(--text-2, #64748b);
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
  }

  /* Card Container */
  .adv-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 50px 40px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  /* Active Member State (Left Empty for now as requested) */
  .adv-empty-state-icon {
    width: 80px;
    height: 80px;
    border-radius: 24px;
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    margin: 0 auto 24px;
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.15);
  }

  .adv-empty-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 12px;
  }

  .adv-empty-desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    max-width: 520px;
    margin: 0 auto 30px;
  }

  .adv-status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    font-size: 13.5px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 999px;
    margin-bottom: 30px;
  }

  .adv-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .btn-adv-primary {
    background: #2563eb;
    color: #ffffff;
    font-size: 14.5px;
    font-weight: 700;
    padding: 12px 26px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    transition: transform 0.2s, background 0.2s;
  }

  .btn-adv-primary:hover {
    background: #1d4ed8;
    color: #ffffff;
    transform: translateY(-2px);
  }

  .btn-adv-secondary {
    background: #f1f5f9;
    color: #334155;
    font-size: 14.5px;
    font-weight: 700;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
  }

  .btn-adv-secondary:hover {
    background: #e2e8f0;
    color: #0f172a;
  }

  /* Locked Non-Member State */
  .adv-lock-icon {
    width: 80px;
    height: 80px;
    border-radius: 24px;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #b45309;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    margin: 0 auto 24px;
    box-shadow: 0 6px 18px rgba(245, 158, 11, 0.2);
  }

  .btn-upgrade-pro {
    background: linear-gradient(135deg, #d97706, #b45309);
    color: #ffffff;
    font-size: 15px;
    font-weight: 800;
    padding: 14px 30px;
    border-radius: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 6px 20px rgba(180, 83, 9, 0.35);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .btn-upgrade-pro:hover {
    transform: translateY(-2px);
    color: #ffffff;
    box-shadow: 0 10px 25px rgba(180, 83, 9, 0.45);
  }
</style>
@endsection

@section('content')
<div class="adv-test-page">
  <div class="adv-test-container">

    <div class="adv-test-header">
      <div class="adv-pro-badge">
        <i class="fa-solid fa-crown" style="color: #d97706;"></i> Pro Member Assessment
      </div>
      <h1>Advanced Career Assessment</h1>
      <p>High-tier psychometric analysis, leadership profiling, and tailored career matching for CareerGyan Pro members.</p>
    </div>

    @if($isMember)
      <!-- Pro Member Access State -->
      <div class="adv-card">
        <div class="adv-empty-state-icon" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #b45309;">
          <i class="fa-solid fa-crown"></i>
        </div>

        <h2 class="adv-empty-title">Advanced Cognitive Assessment</h2>
        
        <p class="adv-empty-desc">
          Welcome, <strong>{{ $user->name ?? $user->first_name }}</strong>! Your Pro Membership access is fully active. 
          Take the comprehensive 20-question randomized psychometric and aptitude assessment covering all 7 cognitive dimensions.
        </p>

        <div class="adv-status-pill">
          <i class="fa-solid fa-circle-check"></i> 20 Randomized Questions &bull; 25 Minutes &bull; Immediate Cognitive Archetype
        </div>

        <div class="adv-actions">
          <a href="{{ route('advanced-test.quiz') }}" class="btn-adv-primary" style="font-size: 16px; padding: 14px 34px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
            <i class="fa-solid fa-play"></i> Start Advanced Assessment &rarr;
          </a>

          @if(isset($latestAttempt) && $latestAttempt)
            <a href="{{ route('advanced-test.results', $latestAttempt->uuid) }}" class="btn-adv-secondary">
              <i class="fa-solid fa-chart-pie"></i> View Last Attempt Results
            </a>
            <a href="{{ route('advanced-test.certificate', $latestAttempt->uuid) }}" target="_blank" class="btn-adv-secondary" style="border-color: #10b981; color: #047857;">
              <i class="fa-solid fa-award"></i> Certificate
            </a>
          @endif

          <a href="{{ route('explore.index') }}#career-assessments" class="btn-adv-secondary">
            <i class="fa-solid fa-arrow-left"></i> All Assessments
          </a>
        </div>
      </div>

    @else
      <!-- Locked State for Non-Members -->
      <div class="adv-card" style="border-color: #fde68a;">
        <div class="adv-lock-icon">
          <i class="fa-solid fa-lock"></i>
        </div>

        <h2 class="adv-empty-title">Pro Membership Required</h2>
        
        <p class="adv-empty-desc">
          The <strong>Advanced Career Assessment</strong> is reserved exclusively for CareerGyan Pro Members. 
          Upgrade your plan to unlock premium psychometric tests, one-on-one counselor reviews, and customized admission strategies.
        </p>

        <div class="adv-actions">
          <a href="{{ route('membership.index') }}" class="btn-upgrade-pro">
            <i class="fa-solid fa-crown"></i> Upgrade to Pro Membership
          </a>
          <a href="{{ route('student-analysis.create') }}" class="btn-adv-secondary">
            Take Free Student Analysis &rarr;
          </a>
        </div>
      </div>
    @endif

  </div>
</div>
@endsection

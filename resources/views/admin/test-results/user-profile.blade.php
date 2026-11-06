@extends('admin.layout')

@section('title', 'Candidate Dossier - ' . ($user->name ?? $user->first_name . ' ' . $user->last_name))
@section('page_title', 'Student Assessment Dossier')

@section('styles')
<style>
  .profile-hero {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 28px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
  }

  .user-badge-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .user-avatar-circle {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #eff6ff;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: 700;
    border: 2px solid #bfdbfe;
  }

  .user-main-info h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 4px;
  }

  .user-meta-tags {
    display: flex;
    gap: 12px;
    font-size: 13px;
    color: var(--admin-text-2);
    flex-wrap: wrap;
  }

  .card-block {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 24px;
    margin-bottom: 24px;
  }

  .card-block-title {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--admin-border);
  }

  .sub-test-item {
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    padding: 16px 20px;
    margin-bottom: 14px;
    background: #fafafa;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    transition: all 0.2s;
  }

  .sub-test-item:hover {
    background: #ffffff;
    border-color: #3b82f6;
  }
</style>
@endsection

@section('content')

<!-- Back Link -->
<div style="margin-bottom: 18px;">
  <a href="{{ route('admin.users') }}" style="color: var(--admin-text-2); text-decoration: none; font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
    <i class="fa-solid fa-arrow-left"></i> Back to Users Directory
  </a>
</div>

<!-- Hero Card -->
<div class="profile-hero">
  <div class="user-badge-wrap">
    <div class="user-avatar-circle">
      {{ strtoupper(substr($user->first_name ?: ($user->name ?: 'U'), 0, 1)) }}
    </div>
    <div class="user-main-info">
      <h2>{{ $user->first_name }} {{ $user->last_name }} (#{{ $user->id }})</h2>
      <div class="user-meta-tags">
        <span><i class="fa-solid fa-envelope"></i> {{ $user->email }}</span>
        <span><i class="fa-solid fa-phone"></i> {{ $user->phone ?: 'No phone provided' }}</span>
        <span><i class="fa-solid fa-calendar-day"></i> Joined {{ $user->created_at->format('d M, Y') }}</span>
        @if($user->hasActiveMembership())
          <span style="background: #fef3c7; color: #92400e; padding: 2px 8px; border-radius: 999px; font-weight: 700; font-size: 11px;">
            <i class="fa-solid fa-crown" style="color: #f59e0b;"></i> Pro Member
          </span>
        @else
          <span style="background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 999px; font-weight: 600; font-size: 11px;">
            Free Tier
          </span>
        @endif
      </div>
    </div>
  </div>

  <div>
    <a href="{{ route('admin.test-results.index') }}" class="action-btn-sm" style="background:#eff6ff; color:#2563eb; padding: 10px 16px; border: 1px solid #bfdbfe;">
      <i class="fa-solid fa-square-poll-vertical"></i> View All Results Hub
    </a>
  </div>
</div>

<!-- Section 1: Aptitude Tests -->
<div class="card-block">
  <div class="card-block-title">
    <i class="fa-solid fa-brain" style="color: #059669;"></i>
    <span>Aptitude Test Sessions ({{ $user->testSessions->count() }})</span>
  </div>

  @forelse($user->testSessions as $session)
    @php
      $scores = $session->aptitude_scores ?? [];
      $recommended = $session->recommended_careers ?? [];
    @endphp
    <div class="sub-test-item">
      <div>
        <div style="font-weight: 700; font-size: 15px; color: var(--admin-text-1); margin-bottom: 4px;">
          Aptitude Assessment - {{ $session->created_at->format('d M, Y \a\t h:i A') }}
        </div>
        <div style="font-size: 12.5px; color: var(--admin-text-2); margin-bottom: 8px;">
          UUID: <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $session->uuid }}</code>
        </div>
        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
          @foreach($scores as $dim => $sc)
            <span style="font-size: 11px; padding: 2px 8px; border-radius: 4px; background: {{ (float)$sc >= 7 ? '#dcfce7' : '#f1f5f9' }}; color: {{ (float)$sc >= 7 ? '#15803d' : '#334155' }}; font-weight: 600;">
              {{ ucwords(str_replace(['-aptitude', '-reasoning'], '', $dim)) }}: {{ $sc }}/10
            </span>
          @endforeach
        </div>
      </div>

      <div style="display: flex; gap: 8px; align-items: center;">
        <span style="font-size: 12.5px; font-weight: 700; color: #059669;">
          {{ count($recommended) }} Matched Careers
        </span>
        <a href="{{ route('admin.test-results.aptitude.show', $session->uuid) }}" class="action-btn-sm" style="background: #2563eb; color: #ffffff;">
          <i class="fa-solid fa-chart-pie"></i> Detailed Report
        </a>
      </div>
    </div>
  @empty
    <p style="color: var(--admin-text-3); font-size: 14px; margin: 0;">This user has not completed the Aptitude Test yet.</p>
  @endforelse
</div>

<!-- Section 2: Student Analyses -->
<div class="card-block">
  <div class="card-block-title">
    <i class="fa-solid fa-clipboard-user" style="color: #6366f1;"></i>
    <span>Student Analyses - 47 Questions ({{ $user->studentAnalyses->count() }})</span>
  </div>

  @forelse($user->studentAnalyses as $analysis)
    <div class="sub-test-item">
      <div>
        <div style="font-weight: 700; font-size: 15px; color: var(--admin-text-1); margin-bottom: 4px;">
          Student Questionnaire - {{ $analysis->created_at->format('d M, Y \a\t h:i A') }}
        </div>
        <div style="font-size: 13px; color: var(--admin-text-2);">
          Class: <strong>{{ $analysis->current_class }}</strong> | Stream: <strong>{{ $analysis->current_stream }}</strong> | Target: <strong style="color: #2563eb;">{{ $analysis->desired_admission_course }}</strong>
        </div>
      </div>

      <div style="display: flex; gap: 8px;">
        <a href="{{ route('admin.student-analyses.show', $analysis->id) }}" class="action-btn-sm" style="background: #6366f1; color: #ffffff;">
          <i class="fa-solid fa-clipboard-check"></i> Inspect 47 Questions
        </a>
        <a href="{{ route('student-analysis.show', $analysis->uuid) }}" target="_blank" class="action-btn-sm" style="background: #f1f5f9; color: #1e293b;">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> Student Report
        </a>
      </div>
    </div>
  @empty
    <p style="color: var(--admin-text-3); font-size: 14px; margin: 0;">This user has not submitted the 47-Question Student Analysis form yet.</p>
  @endforelse
</div>

<!-- Section 3: Quick Tests -->
@if($quickAttempts->isNotEmpty())
  <div class="card-block">
    <div class="card-block-title">
      <i class="fa-solid fa-bolt" style="color: #d97706;"></i>
      <span>Quick Stream Tests ({{ $quickAttempts->count() }})</span>
    </div>

    @foreach($quickAttempts as $quick)
      <div class="sub-test-item">
        <div>
          <div style="font-weight: 700; font-size: 14px;">Taken on {{ $quick->created_at->format('d M, Y') }}</div>
          <div style="font-size: 12.5px; color: var(--admin-text-2);">
            Score: <strong>{{ $quick->total_score }} pts</strong> | Stream Recommendations: {{ is_array($quick->recommended_careers) ? implode(', ', $quick->recommended_careers) : $quick->recommended_careers }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif

<!-- Section 4: AI Chat Queries asked by this user -->
<div class="card-block">
  <div class="card-block-title">
    <i class="fa-solid fa-robot" style="color: #0284c7;"></i>
    <span>AI Chatbot Queries by this User ({{ $user->aiChatLogs->count() }})</span>
  </div>

  @forelse($user->aiChatLogs->take(5) as $chat)
    <div style="padding: 12px 0; border-bottom: 1px solid var(--admin-border);">
      <div style="font-weight: 600; font-size: 13.5px; color: #0284c7; margin-bottom: 4px;">
        <i class="fa-solid fa-user-circle"></i> {{ $chat->question }}
      </div>
      <div style="font-size: 12.5px; color: var(--admin-text-2); line-height: 1.5;">
        {{ Str::limit($chat->reply, 150) }}
      </div>
      <div style="font-size: 11px; color: var(--admin-text-3); margin-top: 4px;">
        {{ $chat->created_at->diffForHumans() }} (Model: {{ $chat->model_used }})
      </div>
    </div>
  @empty
    <p style="color: var(--admin-text-3); font-size: 14px; margin: 0;">No chatbot questions logged for this user.</p>
  @endforelse
</div>

@endsection

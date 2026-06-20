@extends('admin.layout')

@section('title', 'Quiz Leaderboard')
@section('page_title', 'Daily Quiz Leaderboard')

@section('styles')
<style>
  .quiz-index-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
  }

  .btn-admin-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    color: var(--admin-text-1, #09090b);
    border: 1px solid var(--admin-border, #e4e4e7);
    padding: 10px 18px;
    border-radius: var(--admin-radius-md, 10px);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-admin-secondary:hover {
    background: var(--admin-bg, #f4f4f5);
  }

  .table-card {
    background: var(--admin-surface, #ffffff);
    border: 1px solid var(--admin-border, #e4e4e7);
    border-radius: var(--admin-radius-lg, 16px);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
    margin-bottom: 24px;
  }

  .badge {
    display: inline-flex;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .badge-secondary { background: #f1f5f9; color: #475569; }

  .user-cell {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .user-avatar-small {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #475569;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 11px;
    border: 1px solid #cbd5e1;
  }

  .badge-emoji-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(251,191,36,0.1);
    border: 1px solid rgba(251,191,36,0.2);
    color: #b45309;
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 600;
  }

  .rank-badge {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
  }

  .rank-1 { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
  .rank-2 { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
  .rank-3 { background: #ffedd5; color: #ea580c; border: 1px solid #fed7aa; }
  .rank-other { background: #f4f4f5; color: #71717a; }
</style>
@endsection

@section('content')

<div class="quiz-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">View top-performing participants ranked by total quiz points accumulated.</p>
  </div>
  <div style="display: flex; gap: 12px;">
    <a href="{{ route('admin.quiz.index') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-arrow-left"></i> Back to Questions
    </a>
    <a href="{{ route('admin.quiz.scores') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-list-check"></i> View Attempts
    </a>
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th style="width: 80px; text-align: center;">Rank</th>
          <th>Participant</th>
          <th style="text-align: center;">Total Points</th>
          <th style="text-align: center;">Current Streak</th>
          <th style="text-align: center;">Longest Streak</th>
          <th style="text-align: center;">Quizzes Taken</th>
          <th style="text-align: center;">Accuracy</th>
          <th>Badges Unlocked</th>
        </tr>
      </thead>
      <tbody>
        @forelse($stats as $index => $stat)
          <tr>
            <td style="text-align: center; display: flex; justify-content: center;">
              <span class="rank-badge {{ $index == 0 ? 'rank-1' : ($index == 1 ? 'rank-2' : ($index == 2 ? 'rank-3' : 'rank-other')) }}">
                {{ $index + 1 }}
              </span>
            </td>
            <td>
              @if($stat->user)
                <div class="user-cell">
                  <div class="user-avatar-small">{{ strtoupper(substr($stat->user->first_name ?: $stat->user->name ?: 'U', 0, 1)) }}</div>
                  <span style="font-weight: 500; color: var(--admin-text-1);">
                    {{ $stat->user->name ?: ($stat->user->first_name . ' ' . $stat->user->last_name) }}
                  </span>
                </div>
              @else
                <span style="color: var(--admin-text-3); font-style: italic;">Deleted User</span>
              @endif
            </td>
            <td style="text-align: center; font-weight: 700; color: #d97706;">
              {{ number_format($stat->total_points) }} pts
            </td>
            <td style="text-align: center; font-weight: 600;">
              🔥 {{ $stat->current_streak }} days
            </td>
            <td style="text-align: center; color: var(--admin-text-3);">
              {{ $stat->longest_streak }} days
            </td>
            <td style="text-align: center; font-weight: 500;">
              {{ $stat->quizzes_taken }}
            </td>
            <td style="text-align: center; font-weight: 600; color: #059669;">
              {{ $stat->accuracy }}%
            </td>
            <td>
              <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                @php
                  $badgeDefs = \App\Models\UserQuizStat::allBadgeDefinitions();
                @endphp
                @forelse($stat->badges ?? [] as $badgeKey)
                  @if(isset($badgeDefs[$badgeKey]))
                    <span class="badge-emoji-pill" title="{{ $badgeDefs[$badgeKey]['desc'] }}">
                      {{ $badgeDefs[$badgeKey]['emoji'] }} {{ $badgeDefs[$badgeKey]['label'] }}
                    </span>
                  @endif
                @empty
                  <span style="color: var(--admin-text-3); font-size: 12.5px; font-style: italic;">No badges yet</span>
                @endforelse
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-trophy" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No participants on the leaderboard yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

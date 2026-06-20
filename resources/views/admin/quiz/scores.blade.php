@extends('admin.layout')

@section('title', 'Daily Quiz Attempts')
@section('page_title', 'Quiz Participant Attempts')

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

  .stats-summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
  }

  .summary-card {
    background: var(--admin-surface, #ffffff);
    border: 1px solid var(--admin-border, #e4e4e7);
    border-radius: var(--admin-radius-lg, 16px);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--admin-shadow);
  }

  .summary-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  /* Filter Panel */
  .filter-card {
    background: var(--admin-surface, #ffffff);
    border: 1px solid var(--admin-border, #e4e4e7);
    border-radius: var(--admin-radius-lg, 16px);
    padding: 20px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
  }

  .filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) auto;
    gap: 16px;
    align-items: flex-end;
  }

  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .filter-group label {
    font-size: 12px;
    font-weight: 600;
    color: var(--admin-text-2, #52525b);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .filter-control {
    width: 100%;
    padding: 8px 12px;
    border-radius: var(--admin-radius-md, 10px);
    border: 1px solid var(--admin-border, #e4e4e7);
    font-family: inherit;
    font-size: 13.5px;
    background: #ffffff;
  }

  .filter-control:focus {
    outline: none;
    border-color: var(--admin-brand, #000000);
  }

  .btn-filter-submit {
    background: var(--admin-brand, #000000);
    color: #ffffff;
    padding: 9px 20px;
    border-radius: var(--admin-radius-md, 10px);
    font-weight: 600;
    font-size: 13.5px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    height: 38px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .btn-filter-submit:hover {
    background: var(--admin-brand-light, #27272a);
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

  .badge-success { background: #dcfce7; color: #166534; }
  .badge-danger { background: #fee2e2; color: #991b1b; }
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

  .pagination-wrap {
    padding: 20px 24px;
    border-top: 1px solid var(--admin-border, #e4e4e7);
  }
</style>
@endsection

@section('content')

<div class="quiz-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">View detailed logs of user daily quiz attempts, correctness, time taken, and points awarded.</p>
  </div>
  <div style="display: flex; gap: 12px;">
    <a href="{{ route('admin.quiz.index') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-arrow-left"></i> Back to Questions
    </a>
    <a href="{{ route('admin.quiz.leaderboard') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-trophy"></i> Leaderboard
    </a>
  </div>
</div>

<!-- Stats Summary Grid -->
<div class="stats-summary-grid">
  <div class="summary-card">
    <div class="summary-icon" style="background: #eff6ff; color: #2563eb;">
      <i class="fa-solid fa-user-check"></i>
    </div>
    <div>
      <div style="font-size: 12px; color: var(--admin-text-3); text-transform: uppercase; font-weight: 600;">Total Attempts</div>
      <div style="font-size: 24px; font-weight: 700; color: var(--admin-text-1);">{{ number_format($totalAttempts) }}</div>
    </div>
  </div>
  
  <div class="summary-card">
    <div class="summary-icon" style="background: #ecfdf5; color: #059669;">
      <i class="fa-solid fa-circle-check"></i>
    </div>
    <div>
      <div style="font-size: 12px; color: var(--admin-text-3); text-transform: uppercase; font-weight: 600;">Correct Answers</div>
      <div style="font-size: 24px; font-weight: 700; color: var(--admin-text-1);">
        {{ number_format($correctCount) }}
        <span style="font-size: 14px; font-weight: 500; color: var(--admin-text-2);">
          ({{ $totalAttempts > 0 ? round(($correctCount / $totalAttempts) * 100, 1) : 0 }}%)
        </span>
      </div>
    </div>
  </div>

  <div class="summary-card">
    <div class="summary-icon" style="background: #fffbeb; color: #d97706;">
      <i class="fa-solid fa-star"></i>
    </div>
    <div>
      <div style="font-size: 12px; color: var(--admin-text-3); text-transform: uppercase; font-weight: 600;">Points Awarded</div>
      <div style="font-size: 24px; font-weight: 700; color: var(--admin-text-1);">{{ number_format($totalPoints) }} pts</div>
    </div>
  </div>
</div>

<!-- Filter Panel -->
<div class="filter-card">
  <form action="{{ route('admin.quiz.scores') }}" method="GET">
    <div class="filter-grid">
      <!-- Date filter -->
      <div class="filter-group">
        <label for="date">Attempt Date</label>
        <input type="date" name="date" id="date" class="filter-control" value="{{ request('date') }}">
      </div>

      <!-- User name filter -->
      <div class="filter-group">
        <label for="user_name">Participant Name</label>
        <input type="text" name="user_name" id="user_name" class="filter-control" placeholder="Search participant..." value="{{ request('user_name') }}">
      </div>

      <!-- Correct filter -->
      <div class="filter-group">
        <label for="correct">Result Status</label>
        <select name="correct" id="correct" class="filter-control">
          <option value="">All Results</option>
          <option value="yes" {{ request('correct') == 'yes' ? 'selected' : '' }}>Correct Only</option>
          <option value="no" {{ request('correct') == 'no' ? 'selected' : '' }}>Incorrect / Timed Out</option>
        </select>
      </div>

      <div style="display: flex; gap: 8px;">
        <button type="submit" class="btn-filter-submit">
          <i class="fa-solid fa-magnifying-glass"></i> Filter
        </button>
        @if(request()->anyFilled(['date', 'user_name', 'correct']))
          <a href="{{ route('admin.quiz.scores') }}" class="btn-admin-secondary" style="height: 38px; display: inline-flex; align-items: center; justify-content: center; padding: 0 16px;">
            Clear
          </a>
        @endif
      </div>
    </div>
  </form>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Attempted Date</th>
          <th>Participant</th>
          <th>Question</th>
          <th style="text-align: center;">Selected</th>
          <th style="text-align: center;">Result</th>
          <th style="text-align: center;">Points</th>
          <th style="text-align: center;">Time Taken</th>
        </tr>
      </thead>
      <tbody>
        @forelse($attempts as $attempt)
          <tr>
            <td style="font-weight: 600; color: var(--admin-text-1);">
              {{ $attempt->attempted_at->format('Y-m-d') }}
            </td>
            <td>
              @if($attempt->user)
                <div class="user-cell">
                  <div class="user-avatar-small">{{ strtoupper(substr($attempt->user->first_name ?: $attempt->user->name ?: 'U', 0, 1)) }}</div>
                  <span style="font-weight: 500; color: var(--admin-text-1);">
                    {{ $attempt->user->name ?: ($attempt->user->first_name . ' ' . $attempt->user->last_name) }}
                  </span>
                </div>
              @else
                <span style="color: var(--admin-text-3); font-style: italic;">Deleted User</span>
              @endif
            </td>
            <td style="max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
              @if($attempt->question)
                <span title="{{ $attempt->question->question_text }}">{{ $attempt->question->question_text }}</span>
              @else
                <span style="color: var(--admin-text-3); font-style: italic;">Deleted Question</span>
              @endif
            </td>
            <td style="text-align: center; font-weight: 700;">
              @if($attempt->selected_option)
                <span class="badge badge-secondary" style="font-size: 11px;">
                  {{ strtoupper($attempt->selected_option) }}
                </span>
              @else
                <span style="color: var(--admin-text-3); font-style: italic; font-size: 12px;">Timed Out</span>
              @endif
            </td>
            <td style="text-align: center;">
              @if($attempt->is_correct)
                <span class="badge badge-success">Correct</span>
              @else
                <span class="badge badge-danger">Incorrect</span>
              @endif
            </td>
            <td style="text-align: center; font-weight: 700; color: #d97706;">
              +{{ $attempt->points_earned }} pts
            </td>
            <td style="text-align: center; font-weight: 500;">
              <i class="fa-regular fa-clock" style="font-size: 12px; color: var(--admin-text-3); margin-right: 4px;"></i>
              {{ $attempt->time_taken_seconds }}s
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-list-check" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No quiz attempts logged with these filters.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($attempts->hasPages())
    <div class="pagination-wrap">
      <style>
        .pagination { display: flex; list-style: none; padding: 0; margin: 0; gap: 4px; flex-wrap: wrap; }
        .page-item .page-link { padding: 6px 12px; border: 1px solid #e4e4e7; border-radius: 6px; color: #09090b; text-decoration: none; font-size: 14px; background: #fff; }
        .page-item.active .page-link { background: #09090b; color: #fff; border-color: #09090b; }
        .page-item.disabled .page-link { color: #a1a1aa; cursor: not-allowed; background: #f4f4f5; }
      </style>
      {{ $attempts->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
  @endif
</div>

@endsection

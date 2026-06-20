@extends('admin.layout')

@section('title', 'Manage Daily Quiz')
@section('page_title', 'Daily Career Quiz')

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

  .btn-admin-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--admin-brand, #000000);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md, 10px);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-admin-primary:hover {
    background: var(--admin-brand-light, #27272a);
    transform: translateY(-1px);
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

  /* Difficulty colors */
  .diff-easy { background: rgba(34,197,94,0.15);  color: #166534; }
  .diff-medium { background: rgba(251,191,36,0.15); color: #9a3412; }
  .diff-hard { background: rgba(239,68,68,0.15);  color: #991b1b; }

  /* Category colors */
  .cat-badge {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #cbd5e1;
  }

  .btn-action-edit {
    color: #2563eb;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s;
  }

  .btn-action-edit:hover {
    background: #2563eb;
    color: #ffffff;
  }

  .btn-action-delete {
    color: #ef4444;
    background: #fef2f2;
    border: 1px solid #fecaca;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-action-delete:hover {
    background: #ef4444;
    color: #ffffff;
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
    <p style="color: var(--admin-text-2); font-size: 14.5px;">Schedule daily career quiz questions, view participant attempts, and track leaderboards.</p>
  </div>
  <div style="display: flex; gap: 12px;">
    <a href="{{ route('admin.quiz.scores') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-list-check"></i> View Attempts
    </a>
    <a href="{{ route('admin.quiz.leaderboard') }}" class="btn-admin-secondary">
      <i class="fa-solid fa-trophy"></i> Leaderboard
    </a>
    <a href="{{ route('admin.quiz.create') }}" class="btn-admin-primary">
      <i class="fa-solid fa-circle-plus"></i> Create Daily Question
    </a>
  </div>
</div>

<!-- Stats Summary Grid -->
<div class="stats-summary-grid">
  <div class="summary-card">
    <div class="summary-icon" style="background: #e0f2fe; color: #0369a1;">
      <i class="fa-solid fa-circle-question"></i>
    </div>
    <div>
      <div style="font-size: 12px; color: var(--admin-text-3); text-transform: uppercase; font-weight: 600;">Total Questions</div>
      <div style="font-size: 24px; font-weight: 700; color: var(--admin-text-1);">{{ number_format($totalQuestions) }}</div>
    </div>
  </div>
  
  <div class="summary-card">
    <div class="summary-icon" style="background: #fdf2f8; color: #be185d;">
      <i class="fa-solid fa-user-check"></i>
    </div>
    <div>
      <div style="font-size: 12px; color: var(--admin-text-3); text-transform: uppercase; font-weight: 600;">Total Attempts</div>
      <div style="font-size: 24px; font-weight: 700; color: var(--admin-text-1);">{{ number_format($totalAttempts) }}</div>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Quiz Date</th>
          <th>Question Text</th>
          <th>Category</th>
          <th>Difficulty</th>
          <th>Points</th>
          <th>Status</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($questions as $question)
          <tr>
            <td style="font-weight: 700; color: var(--admin-text-1);">
              {{ $question->quiz_date->format('Y-m-d') }}
              @if($question->quiz_date->isToday())
                <span class="badge badge-success" style="padding: 2px 6px; font-size: 9px; margin-left: 4px;">Today</span>
              @endif
            </td>
            <td style="color: var(--admin-text-1); font-weight: 500; max-width: 320px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
              {{ $question->question_text }}
            </td>
            <td>
              <span class="badge cat-badge">
                <i class="fa-solid {{ $question->category_icon }}" style="margin-right: 4px; font-size: 10px;"></i>
                {{ ucfirst($question->category) }}
              </span>
            </td>
            <td>
              <span class="badge diff-{{ $question->difficulty }}">
                {{ ucfirst($question->difficulty) }}
              </span>
            </td>
            <td style="font-weight: 600; color: #f59e0b;">
              ⚡ {{ $question->points }} pts
            </td>
            <td>
              @if($question->is_active)
                <span class="badge badge-success">Active</span>
              @else
                <span class="badge badge-secondary">Inactive</span>
              @endif
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 8px; justify-content: center;">
                <a href="{{ route('admin.quiz.edit', $question->id) }}" class="btn-action-edit" title="Edit Question">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                <form action="{{ route('admin.quiz.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quiz question? This will delete all user attempts associated with it.');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action-delete" title="Delete Question">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-circle-question" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No quiz questions created yet. Add a question to start the daily quiz engagement!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($questions->hasPages())
    <div class="pagination-wrap">
      <style>
        .pagination { display: flex; list-style: none; padding: 0; margin: 0; gap: 4px; flex-wrap: wrap; }
        .page-item .page-link { padding: 6px 12px; border: 1px solid #e4e4e7; border-radius: 6px; color: #09090b; text-decoration: none; font-size: 14px; background: #fff; }
        .page-item.active .page-link { background: #09090b; color: #fff; border-color: #09090b; }
        .page-item.disabled .page-link { color: #a1a1aa; cursor: not-allowed; background: #f4f4f5; }
      </style>
      {{ $questions->links('pagination::bootstrap-4') }}
    </div>
  @endif
</div>

@endsection

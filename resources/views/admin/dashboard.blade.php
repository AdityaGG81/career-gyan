@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page_title', 'Overview')

@section('styles')
<style>
  /* ─── Dashboard Specific Styles ─── */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
  }

  .stat-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: var(--admin-shadow);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
  }

  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-hover);
  }

  .stat-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
  }

  .stat-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--admin-text-2);
  }

  .stat-icon-wrap {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .icon-users { background: #eff6ff; color: #3b82f6; }
  .icon-careers { background: #f0fdf4; color: #22c55e; }
  .icon-blogs { background: #fdf4ff; color: #d946ef; }
  .icon-suggestions { background: #fffbeb; color: #f59e0b; }

  .stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--admin-text-1);
    letter-spacing: -0.02em;
  }

  /* ─── Action Cards & Rows ─── */
  .dashboard-grid {
    display: grid;
    grid-template-columns: 1.4fr 0.8fr;
    gap: 24px;
    margin-bottom: 32px;
  }

  .panel-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    display: flex;
    flex-direction: column;
  }

  .panel-header {
    padding: 24px 24px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--admin-border);
  }

  .panel-header h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--admin-text-1);
  }

  .panel-action-link {
    font-size: 13px;
    font-weight: 600;
    color: #3b82f6;
    text-decoration: none;
    transition: color 0.2s;
  }

  .panel-action-link:hover {
    color: #2563eb;
    text-decoration: underline;
  }

  .panel-body {
    padding: 0;
  }

  /* Tables */
  .admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
  }

  .admin-table th {
    text-align: left;
    padding: 14px 24px;
    color: var(--admin-text-3);
    font-weight: 500;
    font-size: 13px;
    border-bottom: 1px solid var(--admin-border);
    background: #fafafa;
  }

  .admin-table td {
    padding: 16px 24px;
    border-bottom: 1px solid var(--admin-border);
    color: var(--admin-text-2);
    vertical-align: middle;
  }

  .admin-table tr:last-child td {
    border-bottom: none;
  }
  
  .user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .user-avatar-small {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    font-weight: 600;
    font-size: 12px;
  }

  /* Quick Actions List */
  .quick-actions-wrap {
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .action-btn-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
    border: 1px solid var(--admin-border);
    padding: 16px 20px;
    border-radius: var(--admin-radius-md);
    text-decoration: none;
    color: var(--admin-text-1);
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
  }

  .action-btn-link:hover {
    border-color: #3b82f6;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
  }

  .action-btn-left {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .action-btn-left i {
    color: #64748b;
    font-size: 18px;
    transition: color 0.2s;
  }
  
  .action-btn-link:hover .action-btn-left i {
    color: #3b82f6;
  }

  /* Suggestions List */
  .suggestions-list {
    padding: 12px 24px 24px;
  }
  
  .suggestion-item {
    padding: 16px 0;
    border-bottom: 1px solid var(--admin-border);
  }

  .suggestion-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }

  .suggestion-meta {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
  }

  .suggestion-name {
    font-weight: 600;
    color: var(--admin-text-1);
    font-size: 14px;
    display: block;
  }
  
  .suggestion-time {
    font-size: 12px;
    color: var(--admin-text-3);
    margin-top: 2px;
  }

  .suggestion-role {
    background: #f1f5f9;
    color: #475569;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  .suggestion-message {
    font-size: 14px;
    color: var(--admin-text-2);
    line-height: 1.5;
  }

  @media (max-width: 1024px) {
    .dashboard-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')

<!-- Stats Grid -->
<div class="stats-grid">
  <!-- Stat Card: Users -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Total Users</span>
      <div class="stat-icon-wrap icon-users">
        <i class="fa-solid fa-users"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($userCount) }}</div>
  </div>

  <!-- Stat Card: Careers -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Career Roadmaps</span>
      <div class="stat-icon-wrap icon-careers">
        <i class="fa-solid fa-briefcase"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($careerCount) }}</div>
  </div>

  <!-- Stat Card: Blogs -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Published Blogs</span>
      <div class="stat-icon-wrap icon-blogs">
        <i class="fa-solid fa-newspaper"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($blogCount) }}</div>
  </div>

  <!-- Stat Card: Categories -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Categories</span>
      <div class="stat-icon-wrap" style="background: #ecfdf5; color: #059669;">
        <i class="fa-solid fa-shapes"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($fieldCount) }}</div>
  </div>

  <!-- Stat Card: Colleges -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Colleges / Institutes</span>
      <div class="stat-icon-wrap" style="background: #f0f9ff; color: #0284c7;">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($collegeCount) }}</div>
  </div>

  <!-- Stat Card: Suggestions -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Platform Suggestions</span>
      <div class="stat-icon-wrap icon-suggestions">
        <i class="fa-solid fa-lightbulb"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($suggestionCount) }}</div>
  </div>

  <!-- Stat Card: Quiz Attempts -->
  <div class="stat-card">
    <div class="stat-header">
      <span class="stat-title">Quiz Attempts</span>
      <div class="stat-icon-wrap" style="background: #fff5f5; color: #ef4444;">
        <i class="fa-solid fa-circle-question"></i>
      </div>
    </div>
    <div class="stat-value">{{ number_format($quizAttemptCount ?? 0) }}</div>
  </div>
</div>

<!-- Main Dashboard Split Layout -->
<div class="dashboard-grid">
  <!-- Left Side: Recent Signups Table -->
  <div class="panel-card">
    <div class="panel-header">
      <h2>Recent Signups</h2>
      <a href="{{ route('admin.users') }}" class="panel-action-link">View all users</a>
    </div>

    <div class="panel-body" style="overflow-x: auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>User</th>
            <th>Email</th>
            <th>Joined</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentUsers as $user)
            <tr>
              <td>
                <div class="user-cell">
                  <div class="user-avatar-small">{{ strtoupper(substr($user->first_name, 0, 1)) }}</div>
                  <span style="font-weight: 500; color: var(--admin-text-1);">{{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
              </td>
              <td>{{ $user->email }}</td>
              <td style="color: var(--admin-text-3); font-size: 13px;">{{ $user->created_at->format('M d, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" style="text-align: center; color: var(--admin-text-3); padding: 40px;">
                No registered users found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Right Side: Quick Actions -->
  <div class="panel-card">
    <div class="panel-header">
      <h2>Quick Actions</h2>
    </div>
    <div class="quick-actions-wrap">
      <a href="{{ route('admin.quiz.index') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-circle-question"></i>
          <span>Manage Daily Quiz</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
      <a href="{{ route('admin.blogs.create') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-pen-to-square"></i>
          <span>Draft New Article</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
      <a href="{{ route('admin.careers.index') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-map-location-dot"></i>
          <span>Manage Roadmaps</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
      <a href="{{ route('admin.fields.index') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-shapes"></i>
          <span>Manage Categories</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
      <a href="{{ route('admin.colleges.index') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-graduation-cap"></i>
          <span>Manage Colleges</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
      <a href="{{ route('admin.users') }}" class="action-btn-link">
        <div class="action-btn-left">
          <i class="fa-solid fa-user-shield"></i>
          <span>User Directory</span>
        </div>
        <i class="fa-solid fa-arrow-right" style="font-size: 14px; color: #cbd5e1;"></i>
      </a>
    </div>
  </div>
</div>

<!-- Secondary Row: Recent Suggestions -->
<div class="panel-card" style="margin-bottom: 24px;">
  <div class="panel-header">
    <h2>Recent Suggestions</h2>
    <a href="{{ route('admin.suggestions') }}" class="panel-action-link">View all suggestions</a>
  </div>

  <div class="suggestions-list">
    @forelse($recentSuggestions as $sug)
      <div class="suggestion-item">
        <div class="suggestion-meta">
          <div>
            <span class="suggestion-name">{{ $sug->name ?: 'Anonymous User' }}</span>
            <div class="suggestion-time">{{ $sug->created_at->diffForHumans() }}</div>
          </div>
          <span class="suggestion-role">{{ $sug->role }}</span>
        </div>
        <p class="suggestion-message">{{ $sug->message }}</p>
      </div>
    @empty
      <div style="text-align: center; color: var(--admin-text-3); padding: 40px;">
        No platform suggestions shared yet.
      </div>
    @endforelse
  </div>
</div>

@endsection

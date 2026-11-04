@extends('admin.layout')

@section('title', 'Chatbot Queries & Analytics')
@section('page_title', 'AI Chatbot Queries')

@section('styles')
<style>
  /* ─── Metric KPI Cards ─── */
  .chatbot-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
  }

  .metric-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--admin-shadow);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .metric-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-hover);
  }

  .metric-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .metric-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--admin-text-2);
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .metric-value {
    font-family: 'Outfit', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: var(--admin-text-1);
    line-height: 1.1;
  }

  .metric-subtext {
    font-size: 12px;
    color: var(--admin-text-3);
    margin-top: 2px;
  }

  .metric-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .icon-blue { background: #eff6ff; color: #2563eb; }
  .icon-purple { background: #faf5ff; color: #9333ea; }
  .icon-green { background: #f0fdf4; color: #16a34a; }
  .icon-amber { background: #fffbeb; color: #d97706; }

  /* ─── Filter & Action Bar ─── */
  .filter-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 18px 24px;
    margin-bottom: 24px;
    box-shadow: var(--admin-shadow);
  }

  .filter-form {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px;
  }

  .search-wrap {
    position: relative;
    flex: 1 1 280px;
  }

  .search-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-text-3);
    font-size: 14px;
  }

  .search-input {
    width: 100%;
    padding: 10px 14px 10px 38px;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    font-size: 14px;
    background: #fafafa;
    color: var(--admin-text-1);
    outline: none;
    transition: border-color 0.2s, background 0.2s;
  }

  .search-input:focus {
    border-color: #2563eb;
    background: #ffffff;
  }

  .filter-select {
    padding: 10px 14px;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    font-size: 13.5px;
    background: #fafafa;
    color: var(--admin-text-1);
    outline: none;
    cursor: pointer;
  }

  .filter-select:focus {
    border-color: #2563eb;
    background: #ffffff;
  }

  .btn-filter {
    background: #09090b;
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s;
  }

  .btn-filter:hover {
    opacity: 0.9;
  }

  .btn-secondary {
    background: #f4f4f5;
    color: var(--admin-text-1);
    border: 1px solid var(--admin-border);
    padding: 10px 16px;
    border-radius: var(--admin-radius-md);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
  }

  .btn-secondary:hover {
    background: #e4e4e7;
    color: var(--admin-text-1);
  }

  .action-buttons-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: auto;
  }

  .btn-export {
    background: #10b981;
    color: #ffffff;
    border: none;
    padding: 10px 16px;
    border-radius: var(--admin-radius-md);
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
  }

  .btn-export:hover {
    background: #059669;
    color: #ffffff;
  }

  .btn-clear-logs {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    padding: 10px 16px;
    border-radius: var(--admin-radius-md);
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
  }

  .btn-clear-logs:hover {
    background: #fca5a5;
  }

  /* ─── Table ─── */
  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
  }

  .table-responsive {
    overflow-x: auto;
  }

  .table-header-info {
    padding: 18px 24px;
    border-bottom: 1px solid var(--admin-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fafafa;
  }

  .table-header-title {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--admin-text-1);
  }

  .badge-count {
    background: #e4e4e7;
    color: var(--admin-text-1);
    font-size: 12px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    margin-left: 6px;
  }

  .admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
  }

  .admin-table th {
    text-align: left;
    padding: 14px 20px;
    color: var(--admin-text-3);
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--admin-border);
    background: #fafafa;
    white-space: nowrap;
  }

  .admin-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--admin-border);
    color: var(--admin-text-2);
    vertical-align: middle;
  }

  .admin-table tr:hover td {
    background: #fafafa;
  }

  /* User Info Cell */
  .user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 180px;
  }

  .user-avatar-pill {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
  }

  .user-meta-name {
    font-weight: 600;
    color: var(--admin-text-1);
    font-size: 14px;
    line-height: 1.2;
  }

  .user-meta-email {
    font-size: 12px;
    color: var(--admin-text-3);
    margin-top: 2px;
  }

  /* Question & Answer cell */
  .question-text {
    font-weight: 600;
    color: var(--admin-text-1);
    font-size: 14px;
    margin-bottom: 4px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    cursor: pointer;
  }

  .question-text:hover {
    color: #2563eb;
  }

  .reply-preview {
    font-size: 13px;
    color: var(--admin-text-2);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Status Badges */
  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
  }

  .status-badge.success {
    background: #dcfce7;
    color: #15803d;
  }

  .status-badge.failed {
    background: #fee2e2;
    color: #b91c1c;
  }

  .status-badge.rate_limited {
    background: #fef3c7;
    color: #b45309;
  }

  .engine-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 600;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    white-space: nowrap;
  }

  .latency-tag {
    font-size: 12px;
    color: var(--admin-text-3);
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
  }

  .action-btn-sm {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    transition: all 0.2s;
  }

  .btn-view {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }

  .btn-view:hover {
    background: #dbeafe;
    color: #1e40af;
  }

  .btn-delete-row {
    background: #fff1f2;
    color: #e11d48;
    border: 1px solid #fecdd3;
    cursor: pointer;
  }

  .btn-delete-row:hover {
    background: #ffe4e6;
  }

  /* ─── Modal Styles ─── */
  .modal-backdrop-custom {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    z-index: 1050;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .modal-backdrop-custom.active {
    display: flex;
  }

  .modal-dialog-custom {
    background: #ffffff;
    border-radius: var(--admin-radius-xl);
    width: 100%;
    max-width: 760px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: column;
    animation: modalFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  @keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.96) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }

  .modal-header-custom {
    padding: 20px 24px;
    border-bottom: 1px solid var(--admin-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    background: #ffffff;
    z-index: 10;
  }

  .modal-title-custom {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--admin-text-1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .modal-close-btn {
    background: #f4f4f5;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-text-2);
    cursor: pointer;
    font-size: 14px;
    transition: background 0.2s;
  }

  .modal-close-btn:hover {
    background: #e4e4e7;
    color: var(--admin-text-1);
  }

  .modal-body-custom {
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  /* Chat Bubble in Modal */
  .chat-bubble-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .chat-bubble {
    border-radius: 16px;
    padding: 16px 20px;
    line-height: 1.6;
    font-size: 14.5px;
    max-width: 100%;
  }

  .chat-bubble-user {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1e3a8a;
  }

  .chat-bubble-user-label {
    font-size: 12px;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .chat-bubble-bot {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #0f172a;
  }

  .chat-bubble-bot-label {
    font-size: 12px;
    font-weight: 700;
    color: #0284c7;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .sources-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    margin-top: 10px;
  }

  .sources-title {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 8px;
  }

  .meta-grid-modal {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    background: #f8fafc;
    padding: 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
  }

  .meta-item-label {
    font-size: 11px;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
  }

  .meta-item-val {
    font-size: 13px;
    color: #0f172a;
    font-weight: 600;
    word-break: break-all;
  }

  .thread-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 8px;
    max-height: 240px;
    overflow-y: auto;
    padding-right: 6px;
  }

  .thread-item {
    padding: 10px 14px;
    border-radius: 8px;
    background: #f1f5f9;
    font-size: 13px;
    border-left: 3px solid #3b82f6;
  }

  .thread-item.current {
    background: #e0f2fe;
    border-left-color: #0284c7;
    font-weight: 600;
  }

  .pagination-container {
    padding: 18px 24px;
    border-top: 1px solid var(--admin-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    background: #ffffff;
  }

  /* Empty state */
  .empty-state {
    padding: 60px 20px;
    text-align: center;
    color: var(--admin-text-3);
  }

  .empty-state i {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 16px;
  }

  .empty-state h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--admin-text-1);
    margin-bottom: 8px;
  }

  .empty-state p {
    font-size: 14px;
    color: var(--admin-text-2);
    max-width: 400px;
    margin: 0 auto;
  }
</style>
@endsection

@section('content')

<!-- Metric KPI Cards -->
<div class="chatbot-metrics-grid">
  <!-- Total Questions -->
  <div class="metric-card">
    <div class="metric-info">
      <span class="metric-label">Total Questions</span>
      <span class="metric-value">{{ number_format($totalQueries) }}</span>
      <span class="metric-subtext">Lifetime questions asked</span>
    </div>
    <div class="metric-icon icon-blue">
      <i class="fa-solid fa-comments"></i>
    </div>
  </div>

  <!-- Today's Questions -->
  <div class="metric-card">
    <div class="metric-info">
      <span class="metric-label">Questions Today</span>
      <span class="metric-value">{{ number_format($todayQueries) }}</span>
      <span class="metric-subtext">{{ now()->format('d M, Y') }}</span>
    </div>
    <div class="metric-icon icon-purple">
      <i class="fa-solid fa-calendar-day"></i>
    </div>
  </div>

  <!-- Unique Students -->
  <div class="metric-card">
    <div class="metric-info">
      <span class="metric-label">Unique Students</span>
      <span class="metric-value">{{ number_format($uniqueUsersCount) }}</span>
      <span class="metric-subtext">Registered askers</span>
    </div>
    <div class="metric-icon icon-green">
      <i class="fa-solid fa-user-astronaut"></i>
    </div>
  </div>

  <!-- Success Rate & Latency -->
  <div class="metric-card">
    <div class="metric-info">
      <span class="metric-label">Success Rate</span>
      <span class="metric-value">{{ $successRate }}%</span>
      <span class="metric-subtext">Avg latency: {{ $avgResponseTime }} ms</span>
    </div>
    <div class="metric-icon icon-amber">
      <i class="fa-solid fa-bolt"></i>
    </div>
  </div>
</div>

<!-- Filters & Actions Card -->
<div class="filter-card">
  <form method="GET" action="{{ route('admin.chatbot.index') }}" class="filter-form">
    <div class="search-wrap">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        class="search-input"
        placeholder="Search question, answer, user name or email..."
      >
    </div>

    <!-- Date Range Filter -->
    <select name="date" class="filter-select">
      <option value="" {{ request('date') == '' ? 'selected' : '' }}>All Time</option>
      <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
      <option value="yesterday" {{ request('date') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
      <option value="last_7_days" {{ request('date') == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
      <option value="last_30_days" {{ request('date') == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
      <option value="this_month" {{ request('date') == 'this_month' ? 'selected' : '' }}>This Month</option>
    </select>

    <!-- Status Filter -->
    <select name="status" class="filter-select">
      <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>All Statuses</option>
      <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success Only</option>
      <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed / Error</option>
      <option value="rate_limited" {{ request('status') == 'rate_limited' ? 'selected' : '' }}>Rate Limited</option>
    </select>

    <button type="submit" class="btn-filter">
      <i class="fa-solid fa-filter"></i> Apply
    </button>

    @if(request()->hasAny(['q', 'date', 'status', 'user_id']))
      <a href="{{ route('admin.chatbot.index') }}" class="btn-secondary">
        <i class="fa-solid fa-rotate-left"></i> Reset
      </a>
    @endif

    <div class="action-buttons-wrap">
      <a href="{{ route('admin.chatbot.export', request()->query()) }}" class="btn-export" title="Download filtered questions as CSV">
        <i class="fa-solid fa-file-csv"></i> Export CSV
      </a>

      <button type="button" class="btn-clear-logs" onclick="openClearLogsModal()">
        <i class="fa-solid fa-trash-can"></i> Clear Logs
      </button>
    </div>
  </form>
</div>

<!-- Table Card -->
<div class="table-card">
  <div class="table-header-info">
    <div class="table-header-title">
      Question Log
      <span class="badge-count">{{ $logs->total() }} records</span>
    </div>
    <div style="font-size: 13px; color: var(--admin-text-3);">
      Showing page {{ $logs->currentPage() }} of {{ max(1, $logs->lastPage()) }}
    </div>
  </div>

  <div class="table-responsive">
    <table class="admin-table">
      <thead>
        <tr>
          <th style="width: 220px;">Student / User</th>
          <th>Question Asked</th>
          <th>AI Response Preview</th>
          <th style="width: 130px;">Engine / Latency</th>
          <th style="width: 110px;">Status</th>
          <th style="width: 140px;">Time</th>
          <th style="width: 100px; text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($logs as $log)
          <tr>
            <!-- Student / User -->
            <td>
              <div class="user-cell">
                <div class="user-avatar-pill">
                  {{ strtoupper(substr($log->user_name ?: ($log->user ? $log->user->name : 'U'), 0, 1)) }}
                </div>
                <div>
                  <div class="user-meta-name">
                    {{ $log->user_name ?: ($log->user ? $log->user->name : 'Guest Student') }}
                  </div>
                  <div class="user-meta-email">
                    {{ $log->user_email ?: ($log->user ? $log->user->email : 'N/A') }}
                  </div>
                </div>
              </div>
            </td>

            <!-- Question -->
            <td style="max-width: 320px;">
              <div class="question-text" onclick="showLogDetails({{ $log->id }})" title="Click to view full detail">
                {{ $log->question }}
              </div>
              @if(!empty($log->session_id))
                <span style="font-size: 11px; color: #94a3b8;" title="Session identifier">
                  <i class="fa-solid fa-hashtag"></i> {{ substr($log->session_id, 0, 12) }}...
                </span>
              @endif
            </td>

            <!-- AI Response Preview -->
            <td style="max-width: 320px;">
              <div class="reply-preview">
                {{ $log->reply ?: ($log->error_message ?: 'No response recorded.') }}
              </div>
              @if(!empty($log->sources) && is_array($log->sources) && count($log->sources) > 0)
                <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 11px; color: #2563eb; background: #eff6ff; padding: 2px 6px; border-radius: 4px; margin-top: 4px;">
                  <i class="fa-solid fa-book-open"></i> {{ count($log->sources) }} source(s) cited
                </span>
              @endif
            </td>

            <!-- Engine / Latency -->
            <td>
              <span class="engine-badge">{{ $log->model_used ?: 'Scrapper RAG' }}</span>
              <div class="latency-tag">
                <i class="fa-regular fa-clock" style="font-size: 11px;"></i>
                {{ $log->response_time_ms ? $log->response_time_ms . ' ms' : 'N/A' }}
              </div>
            </td>

            <!-- Status -->
            <td>
              @if($log->status === 'success')
                <span class="status-badge success">
                  <i class="fa-solid fa-circle-check"></i> Success
                </span>
              @elseif($log->status === 'rate_limited')
                <span class="status-badge rate_limited">
                  <i class="fa-solid fa-shield-halved"></i> Rate Limit
                </span>
              @else
                <span class="status-badge failed">
                  <i class="fa-solid fa-triangle-exclamation"></i> Failed
                </span>
              @endif
            </td>

            <!-- Time -->
            <td style="font-size: 13px; color: var(--admin-text-2);">
              <div style="font-weight: 600;">{{ $log->created_at->format('d M, Y') }}</div>
              <div style="font-size: 11.5px; color: var(--admin-text-3);">
                {{ $log->created_at->format('h:i A') }} ({{ $log->created_at->diffForHumans() }})
              </div>
            </td>

            <!-- Actions -->
            <td style="text-align: center;">
              <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                <button type="button" class="action-btn-sm btn-view" onclick="showLogDetails({{ $log->id }})" title="View Details">
                  <i class="fa-solid fa-eye"></i>
                </button>

                <form method="POST" action="{{ route('admin.chatbot.destroy', $log->id) }}" onsubmit="return confirm('Delete this chatbot query log permanently?');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="action-btn-sm btn-delete-row" title="Delete record">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <i class="fa-solid fa-robot"></i>
                <h3>No Chatbot Questions Found</h3>
                <p>No questions match your current search and filter criteria. Questions asked by students to AI Career Guruji will appear here automatically.</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($logs->hasPages())
    <div class="pagination-container">
      <div style="font-size: 13px; color: var(--admin-text-2);">
        Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} queries
      </div>
      <div>
        {{ $logs->links() }}
      </div>
    </div>
  @endif
</div>

<!-- Log Details Modal -->
<div class="modal-backdrop-custom" id="logDetailsModal">
  <div class="modal-dialog-custom">
    <div class="modal-header-custom">
      <div class="modal-title-custom">
        <i class="fa-solid fa-comments" style="color: #2563eb;"></i>
        <span>Chat Conversation Details</span>
        <span id="modalStatusBadge"></span>
      </div>
      <button type="button" class="modal-close-btn" onclick="closeLogDetailsModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="modal-body-custom">
      <!-- Metadata Grid -->
      <div class="meta-grid-modal">
        <div>
          <div class="meta-item-label">Student Name</div>
          <div class="meta-item-val" id="modalUserName">Loading...</div>
        </div>
        <div>
          <div class="meta-item-label">Student Email</div>
          <div class="meta-item-val" id="modalUserEmail">Loading...</div>
        </div>
        <div>
          <div class="meta-item-label">Date & Time</div>
          <div class="meta-item-val" id="modalDate">Loading...</div>
        </div>
        <div>
          <div class="meta-item-label">Response Latency</div>
          <div class="meta-item-val" id="modalLatency">Loading...</div>
        </div>
        <div>
          <div class="meta-item-label">Engine / Model</div>
          <div class="meta-item-val" id="modalModel">Loading...</div>
        </div>
        <div>
          <div class="meta-item-label">IP Address</div>
          <div class="meta-item-val" id="modalIp">Loading...</div>
        </div>
      </div>

      <!-- Chat Bubble Container -->
      <div class="chat-bubble-container">
        <!-- User Question -->
        <div class="chat-bubble chat-bubble-user">
          <div class="chat-bubble-user-label">
            <i class="fa-solid fa-circle-user"></i> Student Question
          </div>
          <div id="modalQuestionText" style="white-space: pre-wrap; font-weight: 600;"></div>
        </div>

        <!-- AI Reply -->
        <div class="chat-bubble chat-bubble-bot">
          <div class="chat-bubble-bot-label">
            <i class="fa-solid fa-robot"></i> AI Career Guruji Response
          </div>
          <div id="modalReplyText" style="white-space: pre-wrap; line-height: 1.6;"></div>

          <!-- Sources -->
          <div id="modalSourcesSection" class="sources-card" style="display: none;">
            <div class="sources-title">
              <i class="fa-solid fa-book-bookmark"></i> Knowledge Sources & Citations
            </div>
            <div id="modalSourcesList" style="font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 8px;"></div>
          </div>
        </div>
      </div>

      <!-- Session Thread (if multiple questions in same session) -->
      <div id="modalSessionThreadWrap" style="display: none;">
        <div style="font-size: 13px; font-weight: 700; color: var(--admin-text-1); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
          <i class="fa-solid fa-list-timeline" style="color: #6366f1;"></i> Other Questions in this Session (<span id="modalSessionThreadCount">0</span>)
        </div>
        <div class="thread-list" id="modalSessionThreadList"></div>
      </div>
    </div>
  </div>
</div>

<!-- Clear Logs Modal -->
<div class="modal-backdrop-custom" id="clearLogsModal">
  <div class="modal-dialog-custom" style="max-width: 480px;">
    <div class="modal-header-custom">
      <div class="modal-title-custom" style="color: #dc2626;">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Clear Chatbot Logs</span>
      </div>
      <button type="button" class="modal-close-btn" onclick="closeClearLogsModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="{{ route('admin.chatbot.clear') }}" style="display: contents;">
      @csrf
      <div class="modal-body-custom">
        <p style="font-size: 14px; color: var(--admin-text-2); line-height: 1.5;">
          Select the range of chatbot logs you want to clear from the database. This action cannot be undone.
        </p>

        <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 6px;">
          <label style="display: flex; align-items: center; gap: 10px; font-size: 14px; cursor: pointer;">
            <input type="radio" name="range" value="older_30" checked>
            <span>Delete logs older than 30 days (Recommended)</span>
          </label>

          <label style="display: flex; align-items: center; gap: 10px; font-size: 14px; cursor: pointer;">
            <input type="radio" name="range" value="failed">
            <span>Delete failed & rate-limited queries only</span>
          </label>

          <label style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #dc2626; font-weight: 600; cursor: pointer;">
            <input type="radio" name="range" value="all">
            <span>Delete ALL chatbot logs (Full Wipe)</span>
          </label>
        </div>
      </div>

      <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border); display: flex; justify-content: flex-end; gap: 12px; background: #fafafa; border-radius: 0 0 var(--admin-radius-xl) var(--admin-radius-xl);">
        <button type="button" class="btn-secondary" onclick="closeClearLogsModal()">Cancel</button>
        <button type="submit" class="btn-clear-logs" onclick="return confirm('Are you sure you want to proceed with clearing the logs?');">
          <i class="fa-solid fa-trash-can"></i> Confirm Delete
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  const logModal = document.getElementById('logDetailsModal');
  const clearModal = document.getElementById('clearLogsModal');

  function openClearLogsModal() {
    clearModal.classList.add('active');
  }

  function closeClearLogsModal() {
    clearModal.classList.remove('active');
  }

  function closeLogDetailsModal() {
    logModal.classList.remove('active');
  }

  // Close modals on backdrop click
  window.addEventListener('click', function(e) {
    if (e.target === logModal) closeLogDetailsModal();
    if (e.target === clearModal) closeClearLogsModal();
  });

  // Close modals on Escape key
  window.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeLogDetailsModal();
      closeClearLogsModal();
    }
  });

  async function showLogDetails(id) {
    logModal.classList.add('active');

    // Show loading state
    document.getElementById('modalUserName').textContent = 'Loading...';
    document.getElementById('modalUserEmail').textContent = 'Loading...';
    document.getElementById('modalDate').textContent = 'Loading...';
    document.getElementById('modalLatency').textContent = '...';
    document.getElementById('modalModel').textContent = '...';
    document.getElementById('modalIp').textContent = '...';
    document.getElementById('modalQuestionText').textContent = 'Loading question details...';
    document.getElementById('modalReplyText').textContent = 'Loading answer...';
    document.getElementById('modalSourcesSection').style.display = 'none';
    document.getElementById('modalSessionThreadWrap').style.display = 'none';

    try {
      const response = await fetch(`/admin/chatbot-queries/${id}`, {
        headers: { 'Accept': 'application/json' }
      });

      if (!response.ok) throw new Error('Failed to load details');
      const data = await response.json();
      const log = data.log;

      document.getElementById('modalUserName').textContent = log.user_name || (log.user ? log.user.name : 'Anonymous / Guest');
      document.getElementById('modalUserEmail').textContent = log.user_email || (log.user ? log.user.email : 'N/A');
      document.getElementById('modalDate').textContent = `${data.formatted_date} (${data.relative_date})`;
      document.getElementById('modalLatency').textContent = log.response_time_ms ? `${log.response_time_ms} ms` : 'N/A';
      document.getElementById('modalModel').textContent = log.model_used || 'RAG Scrapper';
      document.getElementById('modalIp').textContent = log.ip_address || 'N/A';

      // Status Badge in modal
      let badgeHtml = '';
      if (log.status === 'success') {
        badgeHtml = '<span class="status-badge success"><i class="fa-solid fa-circle-check"></i> Success</span>';
      } else if (log.status === 'rate_limited') {
        badgeHtml = '<span class="status-badge rate_limited"><i class="fa-solid fa-shield-halved"></i> Rate Limited</span>';
      } else {
        badgeHtml = '<span class="status-badge failed"><i class="fa-solid fa-triangle-exclamation"></i> Failed</span>';
      }
      document.getElementById('modalStatusBadge').innerHTML = badgeHtml;

      document.getElementById('modalQuestionText').textContent = log.question;
      document.getElementById('modalReplyText').textContent = log.reply || log.error_message || '(No response captured)';

      // Sources
      if (log.sources && Array.isArray(log.sources) && log.sources.length > 0) {
        const sourcesList = document.getElementById('modalSourcesList');
        sourcesList.innerHTML = '';
        log.sources.forEach((src, idx) => {
          const item = document.createElement('div');
          item.style.padding = '8px 12px';
          item.style.background = '#f8fafc';
          item.style.borderRadius = '8px';
          item.style.border = '1px solid #e2e8f0';

          let title = src.title || (typeof src === 'string' ? src : `Source #${idx + 1}`);
          let url = src.url || src.link || '';
          let text = src.text || src.snippet || '';

          item.innerHTML = `
            <div style="font-weight: 600; color: #1e293b;">
              ${url ? `<a href="${url}" target="_blank" style="color: #2563eb; text-decoration: underline;">${title}</a>` : title}
            </div>
            ${text ? `<div style="font-size: 12px; color: #64748b; margin-top: 4px;">${text}</div>` : ''}
          `;
          sourcesList.appendChild(item);
        });
        document.getElementById('modalSourcesSection').style.display = 'block';
      } else {
        document.getElementById('modalSourcesSection').style.display = 'none';
      }

      // Sibling session thread
      if (data.session_thread && data.session_thread.length > 1) {
        const threadList = document.getElementById('modalSessionThreadList');
        threadList.innerHTML = '';
        document.getElementById('modalSessionThreadCount').textContent = data.session_thread.length;

        data.session_thread.forEach((threadItem) => {
          const item = document.createElement('div');
          item.className = 'thread-item' + (threadItem.id === log.id ? ' current' : '');
          item.innerHTML = `
            <div style="font-size: 11px; color: #64748b; margin-bottom: 2px;">
              ${new Date(threadItem.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} ${threadItem.id === log.id ? '• (Current Question)' : ''}
            </div>
            <div style="color: #0f172a;">${threadItem.question}</div>
          `;
          if (threadItem.id !== log.id) {
            item.style.cursor = 'pointer';
            item.onclick = () => showLogDetails(threadItem.id);
          }
          threadList.appendChild(item);
        });
        document.getElementById('modalSessionThreadWrap').style.display = 'block';
      } else {
        document.getElementById('modalSessionThreadWrap').style.display = 'none';
      }

    } catch (err) {
      console.error(err);
      document.getElementById('modalQuestionText').textContent = 'Error loading question details.';
      document.getElementById('modalReplyText').textContent = err.message;
    }
  }
</script>
@endsection


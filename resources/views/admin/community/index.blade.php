@extends('admin.layout')

@section('title', 'Community Forum Moderation')
@section('page_title', 'Community Forum Management')

@section('styles')
<style>
  .stat-card-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }
  .stat-card-mini {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 16px 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .stat-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
  }

  /* Tabs navigation */
  .comm-tabs-nav {
    display: flex;
    gap: 8px;
    border-bottom: 1px solid var(--admin-border);
    padding: 0 24px;
    background: #fafafa;
    overflow-x: auto;
  }
  .comm-tab-btn {
    padding: 14px 18px;
    font-size: 14px;
    font-weight: 600;
    color: var(--admin-text-2);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-bottom: 2px solid transparent;
    transition: all 0.15s ease;
  }
  .comm-tab-btn:hover {
    color: var(--admin-text-1);
  }
  .comm-tab-btn.active {
    color: #ff4500;
    border-bottom-color: #ff4500;
    font-weight: 700;
  }
  .tab-badge {
    background: #e2e8f0;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 999px;
  }
  .comm-tab-btn.active .tab-badge {
    background: #fff0eb;
    color: #ff4500;
  }

  /* Persona badges */
  .persona-badge {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .persona-student { background: #eff6ff; color: #2563eb; }
  .persona-college { background: #eef2ff; color: #6366f1; }
  .persona-professional { background: #ecfdf5; color: #059669; }
  .persona-counselor { background: #fffbeb; color: #d97706; }
  .persona-parent { background: #fff1f2; color: #e11d48; }
  .persona-mentor { background: #f5f3ff; color: #7c3aed; }
  .persona-default { background: #f1f5f9; color: #475569; }

  /* Verified expert pill */
  .expert-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 6px rgba(245, 158, 11, 0.25);
  }

  /* Modals */
  .admin-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    padding: 16px;
  }
  .admin-modal-card {
    background: #ffffff;
    border-radius: 16px;
    width: 100%;
    max-width: 620px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    overflow: hidden;
  }
  .admin-modal-header {
    padding: 16px 20px;
    background: #f8fafc;
    border-bottom: 1px solid var(--admin-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .admin-modal-body {
    padding: 20px;
    max-height: 75vh;
    overflow-y: auto;
  }
</style>
@endsection

@section('content')

@if(session('success'))
  <div class="admin-alert admin-alert-success">
    <i class="fa-solid fa-circle-check"></i>
    <span>{{ session('success') }}</span>
  </div>
@endif

@if(isset($errors) && $errors->any())
  <div class="admin-alert admin-alert-error">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <span>{{ $errors->first() }}</span>
  </div>
@endif

<!-- Summary Metric Cards -->
<div class="stat-card-row">
  <div class="stat-card-mini">
    <div class="stat-card-icon" style="background: #fff0eb; color: #ff4500;">
      <i class="fa-solid fa-question"></i>
    </div>
    <div>
      <div style="font-size: 11.5px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Total Questions</div>
      <div style="font-size: 22px; font-weight: 800; color: var(--admin-text-1);">{{ number_format($stats['total_questions']) }}</div>
    </div>
  </div>

  <div class="stat-card-mini">
    <div class="stat-card-icon" style="background: #eff6ff; color: #2563eb;">
      <i class="fa-solid fa-comments"></i>
    </div>
    <div>
      <div style="font-size: 11.5px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Total Answers</div>
      <div style="font-size: 22px; font-weight: 800; color: var(--admin-text-1);">{{ number_format($stats['total_answers']) }}</div>
    </div>
  </div>

  <div class="stat-card-mini">
    <div class="stat-card-icon" style="background: #fffbeb; color: #d97706;">
      <i class="fa-solid fa-certificate"></i>
    </div>
    <div>
      <div style="font-size: 11.5px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Verified Experts</div>
      <div style="font-size: 22px; font-weight: 800; color: #d97706;">{{ number_format($stats['verified_experts']) }}</div>
    </div>
  </div>

  <div class="stat-card-mini">
    <div class="stat-card-icon" style="background: #ecfdf5; color: #059669;">
      <i class="fa-solid fa-award"></i>
    </div>
    <div>
      <div style="font-size: 11.5px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Expert Answers</div>
      <div style="font-size: 22px; font-weight: 800; color: #059669;">{{ number_format($stats['expert_answers']) }}</div>
    </div>
  </div>

  <div class="stat-card-mini">
    <div class="stat-card-icon" style="background: #fdf2f8; color: #db2777;">
      <i class="fa-solid fa-thumbtack"></i>
    </div>
    <div>
      <div style="font-size: 11.5px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Pinned Posts</div>
      <div style="font-size: 22px; font-weight: 800; color: var(--admin-text-1);">{{ number_format($stats['pinned_posts']) }}</div>
    </div>
  </div>
</div>

<!-- Main Panel Card -->
<div class="panel-card">

  <!-- Tabs Header -->
  <div class="comm-tabs-nav">
    <a href="{{ route('admin.community.index', ['tab' => 'questions']) }}" class="comm-tab-btn {{ $tab === 'questions' ? 'active' : '' }}">
      <i class="fa-solid fa-circle-question"></i>
      <span>Review Questions</span>
      <span class="tab-badge">{{ number_format($stats['total_questions']) }}</span>
    </a>
    <a href="{{ route('admin.community.index', ['tab' => 'answers']) }}" class="comm-tab-btn {{ $tab === 'answers' ? 'active' : '' }}">
      <i class="fa-solid fa-comments"></i>
      <span>Review Answers</span>
      <span class="tab-badge">{{ number_format($stats['total_answers']) }}</span>
    </a>
    <a href="{{ route('admin.community.index', ['tab' => 'profiles']) }}" class="comm-tab-btn {{ $tab === 'profiles' ? 'active' : '' }}">
      <i class="fa-solid fa-user-check"></i>
      <span>Members & Verified Experts</span>
      <span class="tab-badge">{{ number_format($stats['verified_experts']) }} verified</span>
    </a>

    <div style="margin-left: auto; display: flex; align-items: center; gap: 8px;">
      <a href="{{ route('community.index') }}" target="_blank" style="font-size: 12.5px; font-weight: 700; color: #ff4500; text-decoration: none; display: flex; align-items: center; gap: 5px; background: #fff0eb; padding: 6px 12px; border-radius: 8px;">
        <i class="fa-brands fa-reddit-alien"></i> View Public Community <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></i>
      </a>
    </div>
  </div>

  <!-- Search & Filter Bar -->
  <div style="padding: 16px 24px; border-bottom: 1px solid var(--admin-border); background: #ffffff;">
    <form method="GET" action="{{ route('admin.community.index') }}" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
      <input type="hidden" name="tab" value="{{ $tab }}">

      <div style="flex: 1; min-width: 240px; position: relative;">
        <input type="text" name="q" value="{{ $search }}" placeholder="Search by title, author name, or content..." class="form-control" style="padding-left: 36px;">
        <i class="fa-solid fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--admin-text-3);"></i>
      </div>

      @if($tab === 'questions')
        <select name="channel" class="form-control" style="width: auto; min-width: 170px;" onchange="this.form.submit()">
          <option value="all">All Channels</option>
          @foreach($channels as $k => $c)
            @if($k !== 'all')
              <option value="{{ $k }}" {{ $channelFilter === $k ? 'selected' : '' }}>{{ $c['name'] }}</option>
            @endif
          @endforeach
        </select>
      @endif

      <select name="status" class="form-control" style="width: auto; min-width: 150px;" onchange="this.form.submit()">
        <option value="all">All Statuses</option>
        @if($tab === 'questions')
          <option value="pinned" {{ $statusFilter === 'pinned' ? 'selected' : '' }}>Pinned Only</option>
          <option value="resolved" {{ $statusFilter === 'resolved' ? 'selected' : '' }}>Resolved Only</option>
          <option value="unanswered" {{ $statusFilter === 'unanswered' ? 'selected' : '' }}>Unanswered</option>
        @elseif($tab === 'answers')
          <option value="expert" {{ $statusFilter === 'expert' ? 'selected' : '' }}>Verified Expert Only</option>
          <option value="accepted" {{ $statusFilter === 'accepted' ? 'selected' : '' }}>Accepted Only</option>
        @elseif($tab === 'profiles')
          <option value="expert" {{ $statusFilter === 'expert' ? 'selected' : '' }}>Verified Experts Only</option>
        @endif
      </select>

      <button type="submit" style="background: #09090b; color: #fff; border: none; padding: 10px 18px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 13px; cursor: pointer;">
        Filter
      </button>

      @if($search || $channelFilter !== 'all' || $statusFilter !== 'all')
        <a href="{{ route('admin.community.index', ['tab' => $tab]) }}" style="font-size: 13px; color: #64748b; text-decoration: none; padding: 6px 10px;">
          Clear
        </a>
      @endif
    </form>
  </div>

  <!-- TAB 1: QUESTIONS REVIEW -->
  @if($tab === 'questions')
    <div class="panel-body" style="overflow-x: auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width: 42%;">Question & Content</th>
            <th>Channel</th>
            <th>Author & Persona</th>
            <th>Engagement</th>
            <th>Status</th>
            <th style="text-align: right;">Moderation Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($questions as $post)
            @php
              $pSlug = Str::slug($post->author_persona);
              $pClass = match(true) {
                str_contains($pSlug, '10th') || str_contains($pSlug, '12th') => 'persona-student',
                str_contains($pSlug, 'college') => 'persona-college',
                str_contains($pSlug, 'professional') => 'persona-professional',
                str_contains($pSlug, 'counselor') => 'persona-counselor',
                str_contains($pSlug, 'parent') => 'persona-parent',
                str_contains($pSlug, 'mentor') => 'persona-mentor',
                default => 'persona-default'
              };
              $chMeta = $post->channel_meta;
            @endphp
            <tr>
              <td>
                <div style="font-weight: 700; color: var(--admin-text-1); font-size: 14.5px; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                  @if($post->is_pinned)
                    <i class="fa-solid fa-thumbtack" style="color: #db2777; font-size: 12px;" title="Pinned to top"></i>
                  @endif
                  <a href="{{ route('community.show', $post->slug) }}" target="_blank" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='#ff4500'" onmouseout="this.style.color='var(--admin-text-1)'">
                    {{ $post->title }}
                  </a>
                </div>
                <div style="font-size: 12.5px; color: var(--admin-text-3); line-height: 1.4; max-height: 38px; overflow: hidden; text-overflow: ellipsis;">
                  {{ Str::limit(strip_tags($post->content), 120) }}
                </div>
                @if(!empty($post->tags) && is_array($post->tags))
                  <div style="margin-top: 6px; display: flex; gap: 4px; flex-wrap: wrap;">
                    @foreach($post->tags as $t)
                      <span style="font-size: 10px; background: #f1f5f9; color: #475569; padding: 1px 6px; border-radius: 4px;">#{{ ltrim($t, '#') }}</span>
                    @endforeach
                  </div>
                @endif
              </td>

              <td>
                <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; font-weight: 700; padding: 3px 8px; border-radius: 6px; background: {{ $chMeta['bg'] }}; color: {{ $chMeta['color'] }};">
                  <i class="{{ $chMeta['icon'] }}" style="font-size: 10px;"></i>
                  {{ $chMeta['prefix'] }}
                </span>
              </td>

              <td>
                <div style="font-weight: 600; color: var(--admin-text-1); font-size: 13.5px;">{{ $post->author_name }}</div>
                <div style="margin-top: 3px;">
                  <span class="persona-badge {{ $pClass }}">{{ $post->author_persona }}</span>
                </div>
                @if($post->author_headline)
                  <div style="font-size: 11px; color: var(--admin-text-3); font-style: italic; margin-top: 2px;">{{ Str::limit($post->author_headline, 28) }}</div>
                @endif
              </td>

              <td>
                <div style="display: flex; flex-direction: column; gap: 3px; font-size: 12px; color: var(--admin-text-2);">
                  <span><i class="fa-solid fa-arrow-up" style="color: #ff4500;"></i> {{ $post->upvotes_count }} upvotes</span>
                  <span><i class="fa-regular fa-comment" style="color: #2563eb;"></i> {{ $post->answers_count }} answers</span>
                  <span style="color: var(--admin-text-3);"><i class="fa-regular fa-eye"></i> {{ number_format($post->views_count) }} views</span>
                </div>
              </td>

              <td>
                @if($post->is_pinned)
                  <span style="display: inline-block; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 999px; background: #fdf2f8; color: #db2777; margin-bottom: 3px;">
                    <i class="fa-solid fa-thumbtack"></i> Pinned
                  </span><br>
                @endif
                @if($post->is_resolved)
                  <span style="display: inline-block; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 999px; background: #ecfdf5; color: #059669;">
                    <i class="fa-solid fa-check-circle"></i> Resolved
                  </span>
                @else
                  <span style="display: inline-block; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 999px; background: #f8fafc; color: #64748b;">
                    Open
                  </span>
                @endif
              </td>

              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 6px; align-items: center;">
                  <!-- View Live -->
                  <a href="{{ route('community.show', $post->slug) }}" target="_blank" title="View discussion" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: var(--admin-text-2); display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                    <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
                  </a>

                  <!-- Toggle Pin -->
                  <form action="{{ route('admin.community.post.pin', $post->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" title="{{ $post->is_pinned ? 'Unpin' : 'Pin to top' }}" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: {{ $post->is_pinned ? '#fdf2f8' : '#fff' }}; color: {{ $post->is_pinned ? '#db2777' : 'var(--admin-text-2)' }}; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-thumbtack" style="font-size: 11px;"></i>
                    </button>
                  </form>

                  <!-- Toggle Resolve -->
                  <form action="{{ route('admin.community.post.resolve', $post->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" title="{{ $post->is_resolved ? 'Reopen' : 'Mark Resolved' }}" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: {{ $post->is_resolved ? '#ecfdf5' : '#fff' }}; color: {{ $post->is_resolved ? '#059669' : 'var(--admin-text-2)' }}; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-check" style="font-size: 11px;"></i>
                    </button>
                  </form>

                  <!-- Edit Modal Trigger -->
                  <button type="button" onclick="openEditPostModal({{ json_encode($post) }})" title="Edit Question" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #2563eb; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i>
                  </button>

                  <!-- Delete -->
                  <form action="{{ route('admin.community.post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this question and all its answers? This cannot be undone.');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete Question" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-trash-can" style="font-size: 11px;"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 40px; color: var(--admin-text-3);">
                No questions found matching your criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($questions->hasPages())
      <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
        {{ $questions->links() }}
      </div>
    @endif
  @endif

  <!-- TAB 2: ANSWERS REVIEW -->
  @if($tab === 'answers')
    <div class="panel-body" style="overflow-x: auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width: 25%;">Question Discussed</th>
            <th style="width: 35%;">Answer Content</th>
            <th>Author Details</th>
            <th>Upvotes</th>
            <th>Expert Badge</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($answers as $ans)
            @php
              $ansSlug = Str::slug($ans->author_persona);
              $ansClass = match(true) {
                str_contains($ansSlug, '10th') || str_contains($ansSlug, '12th') => 'persona-student',
                str_contains($ansSlug, 'college') => 'persona-college',
                str_contains($ansSlug, 'professional') => 'persona-professional',
                str_contains($ansSlug, 'counselor') => 'persona-counselor',
                str_contains($ansSlug, 'parent') => 'persona-parent',
                str_contains($ansSlug, 'mentor') => 'persona-mentor',
                default => 'persona-default'
              };
            @endphp
            <tr id="ans-row-{{ $ans->id }}">
              <td>
                @if($ans->post)
                  <div style="font-weight: 700; color: var(--admin-text-1); font-size: 13.5px; line-height: 1.35;">
                    <a href="{{ route('community.show', $ans->post->slug) }}#answer-{{ $ans->id }}" target="_blank" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='#ff4500'" onmouseout="this.style.color='var(--admin-text-1)'">
                      {{ $ans->post->title }}
                    </a>
                  </div>
                  <span style="font-size: 11px; color: var(--admin-text-3);">in c/{{ $ans->post->channel }}</span>
                @else
                  <span style="color: #94a3b8; font-style: italic;">[Question deleted]</span>
                @endif
              </td>

              <td>
                <div style="font-size: 13px; color: var(--admin-text-2); line-height: 1.5; white-space: pre-line; max-height: 80px; overflow: hidden; text-overflow: ellipsis;">
                  {{ Str::limit($ans->content, 200) }}
                </div>
                <div style="font-size: 11px; color: var(--admin-text-3); margin-top: 4px;">
                  Posted {{ $ans->created_at->diffForHumans() }}
                </div>
              </td>

              <td>
                <div style="font-weight: 600; color: var(--admin-text-1); font-size: 13.5px;">{{ $ans->author_name }}</div>
                <div style="margin-top: 3px;">
                  <span class="persona-badge {{ $ansClass }}">{{ $ans->author_persona }}</span>
                </div>
                @if($ans->author_headline)
                  <div style="font-size: 11px; color: var(--admin-text-3); font-style: italic; margin-top: 2px;">{{ Str::limit($ans->author_headline, 30) }}</div>
                @endif
              </td>

              <td>
                <span style="font-weight: 700; color: #ff4500; font-size: 13px;">
                  <i class="fa-solid fa-arrow-up"></i> {{ $ans->upvotes_count }}
                </span>
              </td>

              <td>
                <!-- PROVISION: MAKE VERIFIED EXPERT ON THIS ANSWER -->
                @if($ans->is_expert_answer)
                  <form action="{{ route('admin.community.answer.expert', $ans->id) }}" method="POST" style="margin-bottom: 4px;">
                    @csrf
                    <button type="submit" title="Click to remove expert badge" class="expert-pill" style="border: none; cursor: pointer;">
                      <i class="fa-solid fa-certificate"></i> Verified Expert
                    </button>
                  </form>
                  <span style="font-size: 10px; color: #d97706; display: block;">Promoted to Expert</span>
                @else
                  <form action="{{ route('admin.community.answer.expert', $ans->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" title="Make this answer a Verified Expert Answer" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; color: #475569; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;" onmouseover="this.style.borderColor='#f59e0b'; this.style.color='#d97706'" onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#475569'">
                      <i class="fa-regular fa-star"></i> Grant Expert
                    </button>
                  </form>
                @endif

                @if($ans->is_accepted)
                  <div style="margin-top: 4px;">
                    <span style="display: inline-flex; align-items: center; gap: 3px; font-size: 10px; font-weight: 800; background: #ecfdf5; color: #059669; padding: 2px 7px; border-radius: 999px;">
                      <i class="fa-solid fa-circle-check"></i> Accepted Solution
                    </span>
                  </div>
                @endif
              </td>

              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 6px; align-items: center;">
                  <!-- Toggle Accepted -->
                  <form action="{{ route('admin.community.answer.accepted', $ans->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" title="{{ $ans->is_accepted ? 'Unmark Accepted' : 'Mark as Accepted' }}" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: {{ $ans->is_accepted ? '#ecfdf5' : '#fff' }}; color: {{ $ans->is_accepted ? '#059669' : 'var(--admin-text-2)' }}; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-check-double" style="font-size: 11px;"></i>
                    </button>
                  </form>

                  <!-- Edit Answer Modal Trigger -->
                  <button type="button" onclick="openEditAnswerModal({{ json_encode($ans) }})" title="Edit Answer" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #2563eb; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-to-square" style="font-size: 11px;"></i>
                  </button>

                  <!-- Delete -->
                  <form action="{{ route('admin.community.answer.destroy', $ans->id) }}" method="POST" onsubmit="return confirm('Delete this answer?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete Answer" style="width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-trash-can" style="font-size: 11px;"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 40px; color: var(--admin-text-3);">
                No community answers found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($answers->hasPages())
      <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
        {{ $answers->links() }}
      </div>
    @endif
  @endif

  <!-- TAB 3: MEMBERS & VERIFIED EXPERTS PROVISIONING -->
  @if($tab === 'profiles')
    <div class="panel-body" style="overflow-x: auto;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Member Details</th>
            <th>Persona Role</th>
            <th>Headline / Bio</th>
            <th>Reputation Points</th>
            <th>Verified Expert Status</th>
            <th style="text-align: right;">Provisioning Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($profiles as $prof)
            @php
              $profSlug = Str::slug($prof->persona);
              $profClass = match(true) {
                str_contains($profSlug, '10th') || str_contains($profSlug, '12th') => 'persona-student',
                str_contains($profSlug, 'college') => 'persona-college',
                str_contains($profSlug, 'professional') => 'persona-professional',
                str_contains($profSlug, 'counselor') => 'persona-counselor',
                str_contains($profSlug, 'parent') => 'persona-parent',
                str_contains($profSlug, 'mentor') => 'persona-mentor',
                default => 'persona-default'
              };
              $firstChar = strtoupper(substr($prof->display_name ?: 'M', 0, 1));
            @endphp
            <tr>
              <td>
                <div style="display: flex; align-items: center; gap: 10px;">
                  <div style="width: 34px; height: 34px; border-radius: 50%; background: {{ $prof->avatar_color ?: '#ff4500' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; flex-shrink: 0;">
                    {{ $firstChar }}
                  </div>
                  <div>
                    <div style="font-weight: 700; color: var(--admin-text-1); font-size: 14px;">
                      {{ $prof->display_name }}
                    </div>
                    <div style="font-size: 11.5px; color: var(--admin-text-3);">
                      @if($prof->user)
                        <i class="fa-solid fa-circle-check" style="color: #2563eb;"></i> Registered: {{ $prof->user->email }}
                      @else
                        <i class="fa-solid fa-user-clock" style="color: #94a3b8;"></i> Guest Contributor
                      @endif
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <span class="persona-badge {{ $profClass }}">{{ $prof->persona }}</span>
              </td>

              <td>
                <div style="font-size: 12.5px; color: var(--admin-text-2); font-style: italic;">
                  {{ $prof->headline ?: 'No headline set' }}
                </div>
                @if($prof->target_stream)
                  <span style="font-size: 10.5px; background: #f1f5f9; color: #475569; padding: 1px 6px; border-radius: 4px; display: inline-block; margin-top: 3px;">
                    Stream: {{ $prof->target_stream }}
                  </span>
                @endif
              </td>

              <td>
                <span style="font-weight: 800; color: #92400e; background: #fef3c7; border: 1px solid #fde68a; padding: 3px 10px; border-radius: 999px; font-size: 12px;">
                  <i class="fa-solid fa-coins" style="color: #f59e0b;"></i> {{ number_format($prof->reputation_points) }} pts
                </span>
              </td>

              <td>
                <!-- PROVISION STATUS -->
                @if($prof->is_verified_expert)
                  <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span class="expert-pill">
                      <i class="fa-solid fa-certificate"></i> Verified Expert
                    </span>
                    <div style="font-size: 11px; font-weight: 700; color: #b45309;">
                      {{ $prof->expert_title ?: 'Official Career Counselor' }}
                    </div>
                  </div>
                @else
                  <span style="font-size: 12px; color: #64748b; font-weight: 500;">
                    Standard Member
                  </span>
                @endif
              </td>

              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 6px; align-items: center;">
                  <!-- Provision: Make / Revoke Verified Expert -->
                  <button type="button" onclick="openExpertProvisionModal({{ json_encode($prof) }})" style="background: {{ $prof->is_verified_expert ? '#fef3c7' : '#09090b' }}; color: {{ $prof->is_verified_expert ? '#92400e' : '#fff' }}; border: 1px solid {{ $prof->is_verified_expert ? '#fde68a' : '#09090b' }}; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-certificate" style="color: {{ $prof->is_verified_expert ? '#f59e0b' : '#fbbf24' }};"></i>
                    {{ $prof->is_verified_expert ? 'Manage Expert Status' : 'Verify as Expert' }}
                  </button>

                  <!-- Edit Profile -->
                  <button type="button" onclick="openEditProfileModal({{ json_encode($prof) }})" title="Edit Profile Details" style="width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #2563eb; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-user-pen" style="font-size: 12px;"></i>
                  </button>

                  <!-- Delete Profile -->
                  <form action="{{ route('admin.community.profile.destroy', $prof->id) }}" method="POST" onsubmit="return confirm('Delete this community profile?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete Profile" style="width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--admin-border); background: #fff; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-trash-can" style="font-size: 12px;"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 40px; color: var(--admin-text-3);">
                No community profiles registered yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($profiles->hasPages())
      <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
        {{ $profiles->links() }}
      </div>
    @endif
  @endif

</div>

<!-- ══════════════════════════════════════════════════
     MODAL 1: EDIT QUESTION (POST)
     ══════════════════════════════════════════════════ -->
<div class="admin-modal-overlay" id="editPostModal" onclick="if(event.target === this) closeEditPostModal()">
  <div class="admin-modal-card">
    <div class="admin-modal-header">
      <h3 style="font-size: 16px; font-weight: 700; color: var(--admin-text-1); margin: 0;">
        <i class="fa-solid fa-pen-to-square" style="color: #ff4500;"></i> Moderate Question
      </h3>
      <button type="button" onclick="closeEditPostModal()" style="background:none; border:none; font-size:20px; color:#94a3b8; cursor:pointer;">&times;</button>
    </div>

    <form id="editPostForm" method="POST" action="" class="admin-modal-body">
      @csrf
      @method('PUT')

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Question Title *</label>
        <input type="text" name="title" id="editPostTitle" class="form-control" required>
      </div>

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Channel *</label>
          <select name="channel" id="editPostChannel" class="form-control" required>
            @foreach($channels as $k => $c)
              @if($k !== 'all')
                <option value="{{ $k }}">{{ $c['name'] }} ({{ $c['prefix'] }})</option>
              @endif
            @endforeach
          </select>
        </div>
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Persona *</label>
          <select name="author_persona" id="editPostPersona" class="form-control" required>
            <option value="10th/12th Student">10th/12th Student</option>
            <option value="College Student">College Student</option>
            <option value="Working Professional">Working Professional</option>
            <option value="Career Counselor">Career Counselor</option>
            <option value="Parent / Guardian">Parent / Guardian</option>
            <option value="Alumnus / Mentor">Alumnus / Mentor</option>
          </select>
        </div>
      </div>

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Name *</label>
          <input type="text" name="author_name" id="editPostAuthorName" class="form-control" required>
        </div>
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Headline</label>
          <input type="text" name="author_headline" id="editPostHeadline" class="form-control">
        </div>
      </div>

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Question Content *</label>
        <textarea name="content" id="editPostContent" class="form-control" rows="5" required></textarea>
      </div>

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Tags (Comma separated)</label>
        <input type="text" name="tags" id="editPostTags" class="form-control" placeholder="NEET, MBBS, Cutoff">
      </div>

      <div style="display:flex; gap: 20px; margin-bottom: 20px;">
        <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; cursor:pointer;">
          <input type="checkbox" name="is_pinned" id="editPostIsPinned" value="1">
          <span>Pin to Top of Community</span>
        </label>
        <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; cursor:pointer;">
          <input type="checkbox" name="is_resolved" id="editPostIsResolved" value="1">
          <span>Mark as Resolved</span>
        </label>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:10px;">
        <button type="button" onclick="closeEditPostModal()" style="padding:10px 16px; border-radius:8px; border:1px solid var(--admin-border); background:#f8fafc; font-weight:600; cursor:pointer;">
          Cancel
        </button>
        <button type="submit" style="padding:10px 22px; border-radius:8px; border:none; background:#ff4500; color:#fff; font-weight:700; cursor:pointer;">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════════════════════════
     MODAL 2: EDIT ANSWER
     ══════════════════════════════════════════════════ -->
<div class="admin-modal-overlay" id="editAnswerModal" onclick="if(event.target === this) closeEditAnswerModal()">
  <div class="admin-modal-card">
    <div class="admin-modal-header">
      <h3 style="font-size: 16px; font-weight: 700; color: var(--admin-text-1); margin: 0;">
        <i class="fa-solid fa-pen-to-square" style="color: #2563eb;"></i> Moderate Answer
      </h3>
      <button type="button" onclick="closeEditAnswerModal()" style="background:none; border:none; font-size:20px; color:#94a3b8; cursor:pointer;">&times;</button>
    </div>

    <form id="editAnswerForm" method="POST" action="" class="admin-modal-body">
      @csrf
      @method('PUT')

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Name *</label>
          <input type="text" name="author_name" id="editAnsAuthorName" class="form-control" required>
        </div>
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Persona *</label>
          <select name="author_persona" id="editAnsPersona" class="form-control" required>
            <option value="10th/12th Student">10th/12th Student</option>
            <option value="College Student">College Student</option>
            <option value="Working Professional">Working Professional</option>
            <option value="Career Counselor">Career Counselor</option>
            <option value="Parent / Guardian">Parent / Guardian</option>
            <option value="Alumnus / Mentor">Alumnus / Mentor</option>
          </select>
        </div>
      </div>

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Author Headline</label>
        <input type="text" name="author_headline" id="editAnsHeadline" class="form-control">
      </div>

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Answer Content *</label>
        <textarea name="content" id="editAnsContent" class="form-control" rows="6" required></textarea>
      </div>

      <div style="display:flex; gap: 20px; margin-bottom: 20px;">
        <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:#d97706; cursor:pointer;">
          <input type="checkbox" name="is_expert_answer" id="editAnsIsExpert" value="1">
          <span><i class="fa-solid fa-certificate"></i> Verified Expert Answer</span>
        </label>
        <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:#059669; cursor:pointer;">
          <input type="checkbox" name="is_accepted" id="editAnsIsAccepted" value="1">
          <span><i class="fa-solid fa-circle-check"></i> Accepted Solution</span>
        </label>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:10px;">
        <button type="button" onclick="closeEditAnswerModal()" style="padding:10px 16px; border-radius:8px; border:1px solid var(--admin-border); background:#f8fafc; font-weight:600; cursor:pointer;">
          Cancel
        </button>
        <button type="submit" style="padding:10px 22px; border-radius:8px; border:none; background:#2563eb; color:#fff; font-weight:700; cursor:pointer;">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════════════════════════
     MODAL 3: PROVISION VERIFIED EXPERT STATUS
     ══════════════════════════════════════════════════ -->
<div class="admin-modal-overlay" id="expertProvisionModal" onclick="if(event.target === this) closeExpertProvisionModal()">
  <div class="admin-modal-card">
    <div class="admin-modal-header" style="background: linear-gradient(135deg, #fffbeb, #fef3c7);">
      <h3 style="font-size: 16px; font-weight: 800; color: #92400e; margin: 0; display:flex; align-items:center; gap:8px;">
        <i class="fa-solid fa-certificate" style="color: #f59e0b;"></i> Verified Expert Provisioning
      </h3>
      <button type="button" onclick="closeExpertProvisionModal()" style="background:none; border:none; font-size:20px; color:#94a3b8; cursor:pointer;">&times;</button>
    </div>

    <form id="expertProvisionForm" method="POST" action="" class="admin-modal-body">
      @csrf

      <p style="font-size:13.5px; color: var(--admin-text-2); margin-bottom: 16px; line-height: 1.5;">
        You are adjusting the official <strong>Verified Expert</strong> status for <strong id="provisionMemberName">Member</strong>.
        Verified experts gain an official badge, higher community authority, and all their answers automatically receive the expert badge.
      </p>

      <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 12px; padding: 14px; margin-bottom: 16px;">
        <label style="display:block; font-size:12.5px; font-weight:700; color: var(--admin-text-1); margin-bottom:6px;">
          Official Expert Title / Accreditation
        </label>
        <input type="text" name="expert_title" id="provisionExpertTitle" class="form-control" placeholder="e.g. Senior Career Counselor, MBBS & Medical Mentor, IIT Alumnus">
        <span style="font-size: 11.5px; color: var(--admin-text-3); margin-top: 4px; display: block;">
          This title will be displayed next to their verified expert badge on community threads.
        </span>
      </div>

      <div style="display:flex; justify-content:space-between; align-items:center;">
        <button type="button" onclick="closeExpertProvisionModal()" style="padding:10px 16px; border-radius:8px; border:1px solid var(--admin-border); background:#f8fafc; font-weight:600; cursor:pointer;">
          Cancel
        </button>

        <button type="submit" id="btnProvisionSubmit" style="padding:10px 24px; border-radius:8px; border:none; background: linear-gradient(135deg, #f59e0b, #d97706); color:#fff; font-weight:800; font-size:14px; cursor:pointer; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);">
          Confirm Verified Expert Status
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════════════════════════
     MODAL 4: EDIT MEMBER PROFILE
     ══════════════════════════════════════════════════ -->
<div class="admin-modal-overlay" id="editProfileModal" onclick="if(event.target === this) closeEditProfileModal()">
  <div class="admin-modal-card">
    <div class="admin-modal-header">
      <h3 style="font-size: 16px; font-weight: 700; color: var(--admin-text-1); margin: 0;">
        <i class="fa-solid fa-user-pen" style="color: #2563eb;"></i> Edit Community Profile
      </h3>
      <button type="button" onclick="closeEditProfileModal()" style="background:none; border:none; font-size:20px; color:#94a3b8; cursor:pointer;">&times;</button>
    </div>

    <form id="editProfileForm" method="POST" action="" class="admin-modal-body">
      @csrf
      @method('PUT')

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Display Name *</label>
          <input type="text" name="display_name" id="editProfName" class="form-control" required>
        </div>
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Persona *</label>
          <select name="persona" id="editProfPersona" class="form-control" required>
            <option value="10th/12th Student">10th/12th Student</option>
            <option value="College Student">College Student</option>
            <option value="Working Professional">Working Professional</option>
            <option value="Career Counselor">Career Counselor</option>
            <option value="Parent / Guardian">Parent / Guardian</option>
            <option value="Alumnus / Mentor">Alumnus / Mentor</option>
          </select>
        </div>
      </div>

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Headline / Bio</label>
        <input type="text" name="headline" id="editProfHeadline" class="form-control">
      </div>

      <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Reputation Points</label>
          <input type="number" name="reputation_points" id="editProfPoints" class="form-control" min="0" required>
        </div>
        <div>
          <label style="display:block; font-size:12.5px; font-weight:700; margin-bottom:5px;">Expert Title</label>
          <input type="text" name="expert_title" id="editProfExpertTitle" class="form-control" placeholder="e.g. Senior Counselor">
        </div>
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:700; color:#d97706; cursor:pointer;">
          <input type="checkbox" name="is_verified_expert" id="editProfIsExpert" value="1">
          <span><i class="fa-solid fa-certificate"></i> Is Verified Expert</span>
        </label>
      </div>

      <div style="display:flex; justify-content:flex-end; gap:10px;">
        <button type="button" onclick="closeEditProfileModal()" style="padding:10px 16px; border-radius:8px; border:1px solid var(--admin-border); background:#f8fafc; font-weight:600; cursor:pointer;">
          Cancel
        </button>
        <button type="submit" style="padding:10px 22px; border-radius:8px; border:none; background:#09090b; color:#fff; font-weight:700; cursor:pointer;">
          Save Profile
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Edit Question Modal
  function openEditPostModal(post) {
    document.getElementById('editPostForm').action = `/admin/community/post/${post.id}`;
    document.getElementById('editPostTitle').value = post.title || '';
    document.getElementById('editPostChannel').value = post.channel || 'career-advice';
    document.getElementById('editPostPersona').value = post.author_persona || '10th/12th Student';
    document.getElementById('editPostAuthorName').value = post.author_name || '';
    document.getElementById('editPostHeadline').value = post.author_headline || '';
    document.getElementById('editPostContent').value = post.content || '';
    document.getElementById('editPostTags').value = Array.isArray(post.tags) ? post.tags.join(', ') : (post.tags || '');
    document.getElementById('editPostIsPinned').checked = Boolean(post.is_pinned);
    document.getElementById('editPostIsResolved').checked = Boolean(post.is_resolved);

    document.getElementById('editPostModal').style.display = 'flex';
  }
  function closeEditPostModal() {
    document.getElementById('editPostModal').style.display = 'none';
  }

  // Edit Answer Modal
  function openEditAnswerModal(ans) {
    document.getElementById('editAnswerForm').action = `/admin/community/answer/${ans.id}`;
    document.getElementById('editAnsAuthorName').value = ans.author_name || '';
    document.getElementById('editAnsPersona').value = ans.author_persona || 'College Student';
    document.getElementById('editAnsHeadline').value = ans.author_headline || '';
    document.getElementById('editAnsContent').value = ans.content || '';
    document.getElementById('editAnsIsExpert').checked = Boolean(ans.is_expert_answer);
    document.getElementById('editAnsIsAccepted').checked = Boolean(ans.is_accepted);

    document.getElementById('editAnswerModal').style.display = 'flex';
  }
  function closeEditAnswerModal() {
    document.getElementById('editAnswerModal').style.display = 'none';
  }

  // Expert Provision Modal
  function openExpertProvisionModal(prof) {
    document.getElementById('expertProvisionForm').action = `/admin/community/profile/${prof.id}/expert`;
    document.getElementById('provisionMemberName').textContent = prof.display_name;
    document.getElementById('provisionExpertTitle').value = prof.expert_title || (prof.persona === 'Career Counselor' ? 'Certified Career Counselor' : 'Verified Academic Expert');
    
    const btn = document.getElementById('btnProvisionSubmit');
    if (prof.is_verified_expert) {
      btn.textContent = 'Revoke / Update Expert Status';
      btn.style.background = '#dc2626';
    } else {
      btn.textContent = 'Verify as Expert Now';
      btn.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
    }

    document.getElementById('expertProvisionModal').style.display = 'flex';
  }
  function closeExpertProvisionModal() {
    document.getElementById('expertProvisionModal').style.display = 'none';
  }

  // Edit Profile Modal
  function openEditProfileModal(prof) {
    document.getElementById('editProfileForm').action = `/admin/community/profile/${prof.id}`;
    document.getElementById('editProfName').value = prof.display_name || '';
    document.getElementById('editProfPersona').value = prof.persona || '10th/12th Student';
    document.getElementById('editProfHeadline').value = prof.headline || '';
    document.getElementById('editProfPoints').value = prof.reputation_points || 0;
    document.getElementById('editProfExpertTitle').value = prof.expert_title || '';
    document.getElementById('editProfIsExpert').checked = Boolean(prof.is_verified_expert);

    document.getElementById('editProfileModal').style.display = 'flex';
  }
  function closeEditProfileModal() {
    document.getElementById('editProfileModal').style.display = 'none';
  }

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeEditPostModal();
      closeEditAnswerModal();
      closeExpertProvisionModal();
      closeEditProfileModal();
    }
  });
</script>
@endsection

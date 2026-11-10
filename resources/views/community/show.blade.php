@extends('layouts.app')

@section('title', e($post->title) . ' | CareerGyan Community')
@section('meta_description', Str::limit(strip_tags($post->content), 155))

@section('content')
<style>
  :root {
    --reddit-orange: #ff4500;
    --reddit-orange-dark: #e03d00;
    --reddit-bg: #f1f5f9;
    --reddit-card-bg: #ffffff;
    --reddit-border: #e2e8f0;
    --reddit-text-1: #0f172a;
    --reddit-text-2: #334155;
    --reddit-text-3: #64748b;
  }

  .community-layout {
    background: #f1f5f9;
    min-height: 90vh;
    padding: 20px 16px 80px;
  }
  .community-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Breadcrumbs */
  .comm-breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--reddit-text-3);
    margin-bottom: 16px;
    flex-wrap: wrap;
  }
  .comm-breadcrumbs a {
    color: #475569;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.15s;
  }
  .comm-breadcrumbs a:hover {
    color: var(--reddit-orange);
  }

  /* Main Grid */
  .community-thread-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 22px;
    align-items: start;
  }
  @media (max-width: 992px) {
    .community-thread-grid {
      grid-template-columns: 1fr;
    }
    .thread-sidebar-right {
      order: 2;
    }
  }

  /* Question Card */
  .thread-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid var(--reddit-border);
    display: flex;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
    margin-bottom: 24px;
    overflow: hidden;
  }

  /* Left Vote Bar */
  .vote-sidebar {
    width: 52px;
    background: #f8fafc;
    border-right: 1px solid #f1f5f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px 4px;
    gap: 6px;
    flex-shrink: 0;
  }
  .vote-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #94a3b8;
    padding: 6px 8px;
    border-radius: 8px;
    transition: all 0.15s;
    line-height: 1;
  }
  .vote-btn:hover {
    background: #e2e8f0;
    color: var(--reddit-text-1);
  }
  .vote-btn.upvoted {
    color: var(--reddit-orange) !important;
  }
  .vote-btn.downvoted {
    color: #3b82f6 !important;
  }
  .vote-count {
    font-size: 14px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Outfit', sans-serif;
  }

  .thread-body {
    padding: 24px 26px;
    flex-grow: 1;
  }
  @media (max-width: 600px) {
    .thread-body {
      padding: 16px;
    }
  }

  .thread-top-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    font-size: 13px;
    color: var(--reddit-text-3);
    margin-bottom: 14px;
  }
  .channel-pill {
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  /* Persona badges */
  .persona-tag {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .persona-badge-student { background: #eff6ff; color: #2563eb; }
  .persona-badge-college { background: #eef2ff; color: #6366f1; }
  .persona-badge-professional { background: #ecfdf5; color: #059669; }
  .persona-badge-counselor { background: #fffbeb; color: #d97706; }
  .persona-badge-parent { background: #fff1f2; color: #e11d48; }
  .persona-badge-mentor { background: #f5f3ff; color: #7c3aed; }
  .persona-badge-default { background: #f1f5f9; color: #475569; }

  .thread-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 24px;
    font-weight: 800;
    color: var(--reddit-text-1);
    line-height: 1.35;
    margin-bottom: 14px;
  }
  @media (max-width: 600px) {
    .thread-title {
      font-size: 19px;
    }
  }

  .thread-content {
    font-size: 15.5px;
    color: var(--reddit-text-2);
    line-height: 1.7;
    margin-bottom: 20px;
    white-space: pre-line;
    word-break: break-word;
  }

  .thread-tags-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 18px;
  }
  .thread-tag {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #475569;
    font-size: 12px;
    font-weight: 600;
  }

  .thread-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 13px;
    color: var(--reddit-text-3);
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
    flex-wrap: wrap;
  }
  .thread-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: none;
    border: none;
    color: var(--reddit-text-3);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 6px;
    transition: all 0.15s;
  }
  .thread-action-btn:hover {
    background: #f1f5f9;
    color: var(--reddit-text-1);
  }

  /* Answer Form Box */
  .reply-form-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid var(--reddit-border);
    padding: 24px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
    margin-bottom: 30px;
  }
  .reply-form-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 10px;
  }
  .answering-as-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 13px;
    color: #1e293b;
    font-weight: 600;
  }

  .reply-textarea {
    width: 100%;
    min-height: 140px;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    font-size: 14.5px;
    font-family: inherit;
    line-height: 1.6;
    color: var(--reddit-text-1);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    resize: vertical;
  }
  .reply-textarea:focus {
    border-color: var(--reddit-orange);
    box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.12);
  }

  .reply-bottom-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .comm-btn-reddit {
    background: var(--reddit-orange);
    color: #ffffff;
    border: none;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 800;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.15s, transform 0.15s;
    box-shadow: 0 3px 12px rgba(255, 69, 0, 0.25);
  }
  .comm-btn-reddit:hover {
    background: var(--reddit-orange-dark);
    transform: translateY(-1px);
  }

  /* Answers List */
  .answers-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
  }
  .answers-count-title {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 20px;
    font-weight: 800;
    color: var(--reddit-text-1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .answer-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    display: flex;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    margin-bottom: 16px;
    overflow: hidden;
    transition: border-color 0.2s;
  }
  .answer-card.is-expert {
    border: 1.5px solid #fed7aa;
    background: linear-gradient(180deg, #fffbf6 0%, #ffffff 100px);
  }

  .answer-body {
    padding: 20px 22px;
    flex-grow: 1;
  }
  @media (max-width: 600px) {
    .answer-body {
      padding: 14px;
    }
  }

  .answer-author-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    font-size: 13px;
    color: var(--reddit-text-3);
    margin-bottom: 12px;
  }
  .author-avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 14px;
    flex-shrink: 0;
  }
  .expert-verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
  }

  .answer-content {
    font-size: 14.8px;
    color: var(--reddit-text-2);
    line-height: 1.68;
    white-space: pre-line;
    word-break: break-word;
  }

  /* Right Sidebar */
  .sidebar-box {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    padding: 18px 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    margin-bottom: 20px;
  }
  .sidebar-box-title {
    font-size: 14.5px;
    font-weight: 800;
    color: var(--reddit-text-1);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* Persona selection chips in inline answer box */
  .persona-inline-selector {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 8px;
    margin-bottom: 14px;
  }
  .persona-inline-chip {
    padding: 5px 12px;
    border-radius: 999px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s;
    color: #475569;
  }
  .persona-inline-chip.active {
    background: #ff4500;
    color: #ffffff;
    border-color: #ff4500;
  }

  /* Persona modal */
  .comm-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    padding: 16px;
  }
  .comm-modal-card {
    background: #ffffff;
    border-radius: 18px;
    width: 100%;
    max-width: 580px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: modalPop 0.2s cubic-bezier(.22,.68,0,1);
  }
  @keyframes modalPop {
    0% { transform: scale(0.95); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
  }
  .comm-modal-header {
    padding: 18px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .comm-modal-body {
    padding: 24px;
    max-height: 75vh;
    overflow-y: auto;
  }
  .persona-choice-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-bottom: 20px;
  }
  @media (max-width: 480px) {
    .persona-choice-grid {
      grid-template-columns: 1fr;
    }
  }
  .persona-choice-card {
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    cursor: pointer;
    transition: all 0.15s;
    background: #ffffff;
    text-align: left;
  }
  .persona-choice-card:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
  }
  .persona-choice-card.selected {
    border-color: #ff4500;
    background: #fff5f0;
    box-shadow: 0 0 0 2px rgba(255, 69, 0, 0.15);
  }
</style>

<div class="community-layout">
  <div class="community-container">

    <!-- Breadcrumbs -->
    <div class="comm-breadcrumbs">
      <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Home</a>
      <i class="fa-solid fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
      <a href="{{ route('community.index') }}"><i class="fa-brands fa-reddit-alien" style="color: var(--reddit-orange);"></i> Community</a>
      <i class="fa-solid fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
      @php
        $chMeta = $post->channel_meta;
      @endphp
      <a href="{{ route('community.index', ['channel' => $post->channel]) }}" style="font-weight: 700; color: {{ $chMeta['color'] }};">
        {{ $chMeta['prefix'] }}
      </a>
      <i class="fa-solid fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
      <span style="color: #1e293b; font-weight: 600;">Question Details</span>
    </div>

    @if(session('success'))
      <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 700; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 18px;"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="community-thread-grid">

      <!-- Left / Center: Question & Answers -->
      <div class="thread-main-col">

        <!-- Main Question Card -->
        <article class="thread-card">
          <!-- Upvote Bar -->
          <div class="vote-sidebar">
            <button type="button" class="vote-btn" onclick="castVote('post', {{ $post->id }}, 1, this)" title="Upvote this discussion">
              <i class="fa-solid fa-arrow-up"></i>
            </button>
            <span class="vote-count" id="voteCount_post_{{ $post->id }}">{{ $post->upvotes_count }}</span>
            <button type="button" class="vote-btn" onclick="castVote('post', {{ $post->id }}, -1, this)" title="Downvote">
              <i class="fa-solid fa-arrow-down"></i>
            </button>
          </div>

          <!-- Question Content -->
          <div class="thread-body">
            <div class="thread-top-meta">
              <a href="{{ route('community.index', ['channel' => $post->channel]) }}" class="channel-pill" style="background: {{ $chMeta['bg'] }}; color: {{ $chMeta['color'] }};">
                <i class="{{ $chMeta['icon'] }}"></i> {{ $chMeta['prefix'] }}
              </a>

              @php
                $personaSlug = Str::slug($post->author_persona);
                $badgeClass = match(true) {
                  str_contains($personaSlug, '10th') || str_contains($personaSlug, '12th') => 'persona-badge-student',
                  str_contains($personaSlug, 'college') => 'persona-badge-college',
                  str_contains($personaSlug, 'professional') => 'persona-badge-professional',
                  str_contains($personaSlug, 'counselor') => 'persona-badge-counselor',
                  str_contains($personaSlug, 'parent') => 'persona-badge-parent',
                  str_contains($personaSlug, 'mentor') || str_contains($personaSlug, 'alumnus') => 'persona-badge-mentor',
                  default => 'persona-badge-default'
                };
                $firstLetter = strtoupper(substr($post->author_name ?: 'S', 0, 1));
              @endphp

              <div style="display: inline-flex; align-items: center; gap: 6px;">
                <div class="author-avatar-circle" style="background: {{ $chMeta['color'] }}; width: 24px; height: 24px; font-size: 11px;">
                  {{ $firstLetter }}
                </div>
                <strong style="color: #1e293b;">{{ $post->author_name }}</strong>
              </div>

              <span class="persona-tag {{ $badgeClass }}">
                <i class="fa-solid fa-user-tag" style="font-size: 9px;"></i> {{ $post->author_persona }}
              </span>

              @if($post->author_headline)
                <span style="font-style: italic; color: #64748b; font-size: 12px;">• {{ $post->author_headline }}</span>
              @endif

              <span style="margin-left: auto;">{{ $post->created_at->diffForHumans() }}</span>
            </div>

            <h1 class="thread-title">{{ $post->title }}</h1>

            <div class="thread-content">{!! nl2br(e($post->content)) !!}</div>

            @if(!empty($post->tags) && is_array($post->tags))
              <div class="thread-tags-wrap">
                @foreach($post->tags as $tg)
                  <span class="thread-tag">#{{ ltrim($tg, '#') }}</span>
                @endforeach
              </div>
            @endif

            <div class="thread-actions">
              <span class="thread-action-btn" style="cursor: default;">
                <i class="fa-regular fa-comment-dots"></i> {{ $post->answers->count() }} Answers
              </span>
              <span class="thread-action-btn" style="cursor: default;">
                <i class="fa-solid fa-eye"></i> {{ number_format($post->views_count) }} views
              </span>
              <button type="button" class="thread-action-btn" onclick="sharePost('{{ url()->current() }}')">
                <i class="fa-solid fa-share-nodes"></i> Share
              </button>
              <a href="#replyBox" class="thread-action-btn" style="margin-left: auto; color: var(--reddit-orange); font-weight: 700;">
                <i class="fa-solid fa-reply"></i> Answer this
              </a>
            </div>
          </div>
        </article>

        <!-- Answering Box (Open to Everyone - Zero Signup Barrier) -->
        <div class="reply-form-card" id="replyBox">
          <form action="{{ route('community.answer.store', $post->id) }}" method="POST">
            @csrf

            <div class="reply-form-header">
              <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-pen-to-square" style="color: var(--reddit-orange); font-size: 18px;"></i>
                <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Add Your Answer</h3>
              </div>

              <!-- Identity indicator -->
              <div class="answering-as-pill">
                <div class="author-avatar-circle" style="width: 22px; height: 22px; font-size: 10px; background: {{ $profile['color'] }};">
                  {{ strtoupper(substr($profile['name'] ?: 'G', 0, 1)) }}
                </div>
                <span>Answering as: <strong>{{ $profile['name'] ?: 'Anonymous Student' }}</strong> ({{ $profile['persona'] }})</span>
                <button type="button" onclick="openProfileModal()" style="background: none; border: none; color: var(--reddit-orange); font-size: 11.5px; font-weight: 700; cursor: pointer; text-decoration: underline; margin-left: 4px;">
                  Switch Persona
                </button>
              </div>
            </div>

            <!-- If guest name is empty, provide fast inline fields -->
            @if(empty($profile['name']))
              <div style="background: #fff8f5; border: 1px dashed #fdba74; padding: 14px 16px; border-radius: 12px; margin-bottom: 16px;">
                <div style="font-size: 12.5px; font-weight: 700; color: #9a3412; margin-bottom: 8px;">
                  <i class="fa-solid fa-user-check"></i> Tell the community who you are (No signup needed!):
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                  <div>
                    <input type="text" name="author_name" placeholder="Your Name or Nickname *" required value="{{ old('author_name', $profile['name']) }}" style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13.5px;">
                  </div>
                  <div>
                    <input type="text" name="author_headline" placeholder="e.g. 1st Yr COEP or Career Counselor" value="{{ old('author_headline', $profile['headline']) }}" style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13.5px;">
                  </div>
                </div>

                <div style="font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 4px;">Choose your persona:</div>
                <div class="persona-inline-selector">
                  @foreach(['10th/12th Student', 'College Student', 'Working Professional', 'Career Counselor', 'Parent / Guardian', 'Alumnus / Mentor'] as $pChoice)
                    <button type="button" class="persona-inline-chip {{ $profile['persona'] === $pChoice ? 'active' : '' }}" onclick="selectInlinePersona('{{ $pChoice }}', this)">
                      {{ $pChoice }}
                    </button>
                  @endforeach
                </div>
                <input type="hidden" name="author_persona" id="inlinePersonaInput" value="{{ $profile['persona'] }}">
              </div>
            @else
              <input type="hidden" name="author_name" value="{{ $profile['name'] }}">
              <input type="hidden" name="author_persona" value="{{ $profile['persona'] }}">
              <input type="hidden" name="author_headline" value="{{ $profile['headline'] }}">
            @endif

            <textarea name="content" class="reply-textarea" placeholder="What is your advice, real-world experience, or recommendation? Be honest and respectful to help this student make the best career choice." required minlength="10">{{ old('content') }}</textarea>

            <div class="reply-bottom-bar">
              <span style="font-size: 12px; color: #64748b;">
                <i class="fa-solid fa-circle-info" style="color: #3b82f6;"></i> Your answer is visible immediately. No password or email needed.
              </span>
              <button type="submit" class="comm-btn-reddit">
                <i class="fa-solid fa-paper-plane"></i> Post Your Answer
              </button>
            </div>
          </form>
        </div>

        <!-- Answers Section -->
        <div id="answers">
          <div class="answers-header">
            <h2 class="answers-count-title">
              <i class="fa-solid fa-comments" style="color: var(--reddit-orange);"></i>
              {{ $post->answers->count() }} {{ Str::plural('Answer', $post->answers->count()) }}
            </h2>
            <span style="font-size: 12.5px; color: #64748b; font-weight: 600;">
              <i class="fa-solid fa-arrow-down-short-wide"></i> Top Voted First
            </span>
          </div>

          @forelse($post->answers as $answer)
            @php
              $ansPersonaSlug = Str::slug($answer->author_persona);
              $ansBadgeClass = match(true) {
                str_contains($ansPersonaSlug, '10th') || str_contains($ansPersonaSlug, '12th') => 'persona-badge-student',
                str_contains($ansPersonaSlug, 'college') => 'persona-badge-college',
                str_contains($ansPersonaSlug, 'professional') => 'persona-badge-professional',
                str_contains($ansPersonaSlug, 'counselor') => 'persona-badge-counselor',
                str_contains($ansPersonaSlug, 'parent') => 'persona-badge-parent',
                str_contains($ansPersonaSlug, 'mentor') || str_contains($ansPersonaSlug, 'alumnus') => 'persona-badge-mentor',
                default => 'persona-badge-default'
              };
              $ansLetter = strtoupper(substr($answer->author_name ?: 'U', 0, 1));
              $avatarColor = match(true) {
                str_contains($ansPersonaSlug, 'counselor') => '#d97706',
                str_contains($ansPersonaSlug, 'professional') => '#059669',
                str_contains($ansPersonaSlug, 'college') => '#6366f1',
                str_contains($ansPersonaSlug, 'mentor') => '#7c3aed',
                default => '#2563eb'
              };
            @endphp

            <div class="answer-card {{ $answer->is_expert_answer ? 'is-expert' : '' }}" id="answer-{{ $answer->id }}">
              <!-- Answer Upvote Sidebar -->
              <div class="vote-sidebar">
                <button type="button" class="vote-btn" onclick="castVote('answer', {{ $answer->id }}, 1, this)" title="Upvote answer">
                  <i class="fa-solid fa-arrow-up"></i>
                </button>
                <span class="vote-count" id="voteCount_answer_{{ $answer->id }}">{{ $answer->upvotes_count }}</span>
                <button type="button" class="vote-btn" onclick="castVote('answer', {{ $answer->id }}, -1, this)" title="Downvote">
                  <i class="fa-solid fa-arrow-down"></i>
                </button>
              </div>

              <!-- Answer Body -->
              <div class="answer-body">
                <div class="answer-author-row">
                  <div class="author-avatar-circle" style="background: {{ $avatarColor }};">
                    {{ $ansLetter }}
                  </div>
                  <strong style="color: #0f172a; font-size: 14px;">{{ $answer->author_name }}</strong>

                  <span class="persona-tag {{ $ansBadgeClass }}">
                    <i class="fa-solid fa-user-tag" style="font-size: 9px;"></i> {{ $answer->author_persona }}
                  </span>

                  @if($answer->is_expert_answer)
                    <span class="expert-verified-badge">
                      <i class="fa-solid fa-certificate"></i> Verified Expert
                    </span>
                  @endif

                  @if($answer->author_headline)
                    <span style="font-style: italic; color: #64748b; font-size: 12px;">• {{ $answer->author_headline }}</span>
                  @endif

                  <span style="margin-left: auto; font-size: 12px; color: #94a3b8;">
                    {{ $answer->created_at->diffForHumans() }}
                  </span>
                </div>

                <div class="answer-content">{!! nl2br(e($answer->content)) !!}</div>

                <div style="margin-top: 14px; display: flex; align-items: center; gap: 14px; font-size: 12px; color: #94a3b8;">
                  <button type="button" class="thread-action-btn" onclick="sharePost('{{ url()->current() }}#answer-{{ $answer->id }}')">
                    <i class="fa-solid fa-share-nodes"></i> Share
                  </button>
                  <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fa-regular fa-thumbs-up" style="color: #10b981;"></i> Helpful community perspective
                  </span>
                </div>
              </div>
            </div>
          @empty
            <div style="background: #ffffff; border-radius: 14px; border: 1px dashed #cbd5e1; padding: 40px 20px; text-align: center;">
              <i class="fa-regular fa-comment-dots" style="font-size: 38px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
              <h4 style="font-size: 17px; font-weight: 700; color: #334155; margin-bottom: 6px;">No answers yet</h4>
              <p style="font-size: 13.5px; color: #64748b; margin-bottom: 16px;">Be the first person to share your advice and help this student!</p>
              <a href="#replyBox" class="comm-btn-reddit" style="font-size: 13px; padding: 8px 18px;">
                <i class="fa-solid fa-pen"></i> Write the First Answer
              </a>
            </div>
          @endforelse
        </div>

      </div>

      <!-- Right Sidebar -->
      <aside class="thread-sidebar-right">

        <!-- Channel Info Box -->
        <div class="sidebar-box">
          <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
            <div style="width: 36px; height: 36px; border-radius: 10px; background: {{ $chMeta['bg'] }}; color: {{ $chMeta['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 16px;">
              <i class="{{ $chMeta['icon'] }}"></i>
            </div>
            <div>
              <div style="font-size: 15px; font-weight: 800; color: #0f172a;">{{ $chMeta['prefix'] }}</div>
              <div style="font-size: 11.5px; color: #64748b;">{{ $chMeta['name'] }}</div>
            </div>
          </div>
          <p style="font-size: 13px; color: #475569; line-height: 1.5; margin-bottom: 14px;">
            {{ $chMeta['desc'] }}
          </p>
          <a href="{{ route('community.index', ['channel' => $post->channel]) }}" style="display: block; text-align: center; background: #f8fafc; border: 1px solid #cbd5e1; color: #1e293b; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; transition: 0.15s;">
            <i class="fa-solid fa-list"></i> Browse All in {{ $chMeta['prefix'] }}
          </a>
        </div>

        <!-- Identity / Who You Are Box -->
        <div class="sidebar-box" style="border-top: 3px solid var(--reddit-orange);">
          <div class="sidebar-box-title">
            <i class="fa-solid fa-id-badge" style="color: var(--reddit-orange);"></i> Your Community Persona
          </div>
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div class="author-avatar-circle" style="width: 42px; height: 42px; font-size: 16px; background: {{ $profile['color'] }};">
              {{ strtoupper(substr($profile['name'] ?: 'Y', 0, 1)) }}
            </div>
            <div>
              <div style="font-weight: 800; font-size: 14.5px; color: #0f172a;">
                {{ $profile['name'] ?: 'Guest Visitor' }}
              </div>
              <div style="font-size: 12px; color: #64748b;">
                {{ $profile['persona'] }}
              </div>
            </div>
          </div>
          @if($profile['headline'])
            <div style="font-size: 12px; color: #475569; font-style: italic; margin-bottom: 12px; background: #f8fafc; padding: 6px 10px; border-radius: 6px;">
              "{{ $profile['headline'] }}"
            </div>
          @endif
          <button type="button" onclick="openProfileModal()" style="width: 100%; background: #0f172a; color: #ffffff; border: none; padding: 9px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
            <i class="fa-solid fa-user-pen"></i> Switch Who You Are
          </button>
        </div>

        <!-- Related Discussions -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
          <div class="sidebar-box">
            <div class="sidebar-box-title">
              <i class="fa-solid fa-fire" style="color: #f59e0b;"></i> Related in {{ $chMeta['prefix'] }}
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px;">
              @foreach($relatedPosts as $rPost)
                <a href="{{ route('community.show', $rPost->slug) }}" style="text-decoration: none; group; display: block; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                  <div style="font-size: 13.5px; font-weight: 700; color: #1e293b; line-height: 1.4; margin-bottom: 4px; transition: color 0.15s;" onmouseover="this.style.color='var(--reddit-orange)'" onmouseout="this.style.color='#1e293b'">
                    {{ $rPost->title }}
                  </div>
                  <div style="display: flex; align-items: center; gap: 10px; font-size: 11.5px; color: #94a3b8;">
                    <span><i class="fa-solid fa-arrow-up"></i> {{ $rPost->upvotes_count }}</span>
                    <span><i class="fa-regular fa-comment"></i> {{ $rPost->answers_count }} replies</span>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Community Guidelines -->
        <div class="sidebar-box">
          <div class="sidebar-box-title">
            <i class="fa-solid fa-shield-halved" style="color: #10b981;"></i> Community Rules
          </div>
          <ul style="list-style: none; padding: 0; margin: 0; font-size: 12.5px; color: #475569; display: flex; flex-direction: column; gap: 8px;">
            <li style="display: flex; gap: 8px;">
              <i class="fa-solid fa-check" style="color: #10b981; margin-top: 2px;"></i>
              <span><strong>Be helpful & honest:</strong> Share genuine college cutoffs, syllabus tips, and work experiences.</span>
            </li>
            <li style="display: flex; gap: 8px;">
              <i class="fa-solid fa-check" style="color: #10b981; margin-top: 2px;"></i>
              <span><strong>Zero gatekeeping:</strong> Everyone can ask and answer freely without account barriers.</span>
            </li>
            <li style="display: flex; gap: 8px;">
              <i class="fa-solid fa-check" style="color: #10b981; margin-top: 2px;"></i>
              <span><strong>No spam or promotional links:</strong> Keep discussions focused on genuine student mentorship.</span>
            </li>
          </ul>
        </div>

        <a href="{{ route('community.index') }}" style="display: block; text-align: center; color: var(--reddit-orange); font-size: 13.5px; font-weight: 700; text-decoration: none;">
          <i class="fa-solid fa-arrow-left"></i> Back to All Community Discussions
        </a>

      </aside>

    </div>

  </div>
</div>

<!-- Persona / Who You Are Modal -->
<div class="comm-modal-overlay" id="profileModal" onclick="if(event.target === this) closeProfileModal()">
  <div class="comm-modal-card">
    <div class="comm-modal-header">
      <div style="display: flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-id-card" style="color: var(--reddit-orange); font-size: 18px;"></i>
        <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0;">Choose Who You Are</h3>
      </div>
      <button type="button" onclick="closeProfileModal()" style="background: none; border: none; font-size: 20px; color: #94a3b8; cursor: pointer;">&times;</button>
    </div>

    <form id="profileSetupForm" onsubmit="handleProfileSubmit(event)" class="comm-modal-body">
      @csrf
      <p style="font-size: 13px; color: #64748b; margin-bottom: 16px;">
        Pick your role so other students and peers recognize your perspective. No account or email needed.
      </p>

      <div style="font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Select Your Persona *</div>
      <div class="persona-choice-grid">
        <div class="persona-choice-card {{ $profile['persona'] === '10th/12th Student' ? 'selected' : '' }}" onclick="selectPersonaOption('10th/12th Student', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #2563eb; margin-bottom: 2px;"><i class="fa-solid fa-graduation-cap"></i> 10th/12th Student</div>
          <div style="font-size: 11px; color: #64748b;">School student / Aspirant</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'College Student' ? 'selected' : '' }}" onclick="selectPersonaOption('College Student', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #6366f1; margin-bottom: 2px;"><i class="fa-solid fa-building-columns"></i> College Student</div>
          <div style="font-size: 11px; color: #64748b;">B.Tech, MBBS, BBA, B.Sc</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Working Professional' ? 'selected' : '' }}" onclick="selectPersonaOption('Working Professional', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #059669; margin-bottom: 2px;"><i class="fa-solid fa-briefcase"></i> Working Professional</div>
          <div style="font-size: 11px; color: #64748b;">Industry experience</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Career Counselor' ? 'selected' : '' }}" onclick="selectPersonaOption('Career Counselor', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #d97706; margin-bottom: 2px;"><i class="fa-solid fa-award"></i> Career Counselor</div>
          <div style="font-size: 11px; color: #64748b;">Professional advisor</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Parent / Guardian' ? 'selected' : '' }}" onclick="selectPersonaOption('Parent / Guardian', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #e11d48; margin-bottom: 2px;"><i class="fa-solid fa-people-roof"></i> Parent / Guardian</div>
          <div style="font-size: 11px; color: #64748b;">Guidance for children</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Alumnus / Mentor' ? 'selected' : '' }}" onclick="selectPersonaOption('Alumnus / Mentor', this)">
          <div style="font-size: 13.5px; font-weight: 800; color: #7c3aed; margin-bottom: 2px;"><i class="fa-solid fa-handshake-angle"></i> Alumnus / Mentor</div>
          <div style="font-size: 11px; color: #64748b;">Senior graduate & guide</div>
        </div>
      </div>

      <input type="hidden" name="persona" id="selectedPersonaInput" value="{{ $profile['persona'] }}">

      <div style="margin-bottom: 14px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Your Display Name *</label>
        <input type="text" name="display_name" id="profileDisplayNameInput" placeholder="e.g. Aryan Sharma or Techie_99" value="{{ $profile['name'] }}" required style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Headline or Bio (Optional)</label>
        <input type="text" name="headline" id="profileHeadlineInput" placeholder="e.g. 12th PCB Aspirant or Software Developer at Infosys" value="{{ $profile['headline'] }}" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13px;">
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeProfileModal()" style="padding: 10px 18px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; cursor: pointer;">
          Cancel
        </button>
        <button type="submit" id="btnSavePersona" style="padding: 10px 24px; border-radius: 8px; border: none; background: #0f172a; color: #fff; font-weight: 800; font-size: 14px; cursor: pointer;">
          Save Persona Profile
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function openProfileModal() {
    document.getElementById('profileModal').style.display = 'flex';
  }
  function closeProfileModal() {
    document.getElementById('profileModal').style.display = 'none';
  }

  function selectPersonaOption(val, el) {
    document.querySelectorAll('.persona-choice-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('selectedPersonaInput').value = val;
  }

  function selectInlinePersona(val, el) {
    document.querySelectorAll('.persona-inline-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    const input = document.getElementById('inlinePersonaInput');
    if (input) input.value = val;
  }

  function handleProfileSubmit(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSavePersona');
    btn.disabled = true;
    btn.textContent = 'Saving...';

    const formData = new FormData(document.getElementById('profileSetupForm'));

    fetch("{{ route('community.profile.save') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        closeProfileModal();
        window.location.reload();
      } else {
        alert(data.message || 'Error saving profile.');
        btn.disabled = false;
        btn.textContent = 'Save Persona Profile';
      }
    })
    .catch(err => {
      console.error(err);
      btn.disabled = false;
      btn.textContent = 'Save Persona Profile';
      window.location.reload();
    });
  }

  function castVote(type, id, direction, btnEl) {
    fetch("{{ route('community.vote') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ type: type, id: id, direction: direction })
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        const countEl = document.getElementById(`voteCount_${type}_${id}`);
        if (countEl) countEl.textContent = data.new_count;

        const parent = btnEl.parentElement;
        parent.querySelectorAll('.vote-btn').forEach(b => {
          b.classList.remove('upvoted', 'downvoted');
        });

        if (data.action === 'voted' || data.action === 'switched') {
          if (direction === 1) btnEl.classList.add('upvoted');
          if (direction === -1) btnEl.classList.add('downvoted');
        }
      }
    })
    .catch(err => console.error(err));
  }

  function sharePost(url) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(url).then(() => {
        alert('Discussion link copied to clipboard!');
      });
    } else {
      window.prompt('Copy discussion link:', url);
    }
  }

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeProfileModal();
    }
  });
</script>
@endsection


@extends('layouts.app')

@section('title', 'Community - Student & Career Discussions | CareerGyan')
@section('meta_description', 'Join the CareerGyan student community. Ask questions, share college cutoffs, get career advice from industry experts, and participate without signing up.')

@section('content')
<style>
  :root {
    --reddit-orange: #ff4500;
    --reddit-orange-dark: #e03d00;
    --reddit-bg: #f8fafc;
    --reddit-card-bg: #ffffff;
    --reddit-border: #e2e8f0;
    --reddit-text-1: #0f172a;
    --reddit-text-2: #475569;
    --reddit-text-3: #94a3b8;
  }

  .community-layout {
    background: #f1f5f9;
    min-height: 90vh;
    padding: 24px 16px 80px;
  }
  .community-container {
    max-width: 1240px;
    margin: 0 auto;
  }

  /* Main 3-Column Grid */
  .community-grid {
    display: grid;
    grid-template-columns: 240px 1fr 310px;
    gap: 20px;
    align-items: start;
  }
  @media (max-width: 1100px) {
    .community-grid {
      grid-template-columns: 220px 1fr;
    }
    .community-sidebar-right {
      display: none;
    }
  }
  @media (max-width: 768px) {
    .community-grid {
      grid-template-columns: 1fr;
    }
    .community-sidebar-left {
      display: none;
    }
    .community-layout {
      padding: 12px 8px 60px;
    }
  }

  /* Left Sidebar: Channels List */
  .channel-nav-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    padding: 16px 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    position: sticky;
    top: 90px;
  }
  .channel-nav-title {
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--reddit-text-3);
    letter-spacing: 0.5px;
    padding: 0 10px 10px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .channel-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--reddit-text-2);
    font-size: 13.5px;
    font-weight: 600;
    transition: all 0.15s ease;
    margin-bottom: 2px;
  }
  .channel-nav-link:hover {
    background: #f8fafc;
    color: var(--reddit-text-1);
    transform: translateX(2px);
  }
  .channel-nav-link.active {
    background: #fff0eb;
    color: var(--reddit-orange);
    font-weight: 700;
  }
  .channel-nav-icon {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
  }
  .channel-count-badge {
    margin-left: auto;
    font-size: 11px;
    color: var(--reddit-text-3);
    font-weight: 600;
  }

  /* Center Column: Feed */
  .feed-create-bar {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    padding: 12px 18px;
    margin-bottom: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .feed-user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 800;
    font-size: 15px;
    flex-shrink: 0;
  }
  .feed-create-input-btn {
    flex-grow: 1;
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    padding: 10px 18px;
    font-size: 14px;
    color: #64748b;
    cursor: pointer;
    text-align: left;
    transition: all 0.2s;
  }
  .feed-create-input-btn:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
    color: #1e293b;
  }

  /* Sort / Filter Ribbon */
  .feed-sort-bar {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid var(--reddit-border);
    padding: 8px 12px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
  }
  .sort-pills {
    display: flex;
    gap: 6px;
  }
  .sort-pill-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    color: var(--reddit-text-2);
    transition: all 0.15s;
  }
  .sort-pill-btn:hover {
    background: #f8fafc;
    color: var(--reddit-text-1);
  }
  .sort-pill-btn.active {
    background: #0f172a;
    color: #ffffff;
  }

  /* Post Card (Reddit-style) */
  .reddit-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    margin-bottom: 14px;
    display: flex;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    transition: border-color 0.2s, box-shadow 0.2s;
    overflow: hidden;
  }
  .reddit-card:hover {
    border-color: #cbd5e1;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
  }

  /* Left Upvote Bar */
  .vote-sidebar {
    width: 48px;
    background: #f8fafc;
    border-right: 1px solid #f1f5f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px 4px;
    gap: 4px;
    flex-shrink: 0;
  }
  .vote-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #94a3b8;
    padding: 4px 6px;
    border-radius: 6px;
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
    font-size: 13px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Outfit', sans-serif;
  }

  /* Post Content Area */
  .reddit-post-body {
    padding: 16px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .post-top-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    font-size: 12.5px;
    color: var(--reddit-text-3);
    margin-bottom: 8px;
  }
  .channel-pill {
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 11.5px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .author-name-text {
    font-weight: 700;
    color: var(--reddit-text-1);
  }

  /* Persona Badges */
  .persona-tag {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 7px;
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

  .post-headline-text {
    font-size: 11.5px;
    color: #64748b;
    font-style: italic;
  }

  .post-title-link {
    font-family: 'Outfit', 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: var(--reddit-text-1);
    line-height: 1.35;
    text-decoration: none;
    margin-bottom: 8px;
    display: block;
    transition: color 0.15s;
  }
  .post-title-link:hover {
    color: var(--reddit-orange);
  }

  .post-snippet {
    font-size: 14px;
    color: var(--reddit-text-2);
    line-height: 1.55;
    margin-bottom: 14px;
    white-space: pre-line;
  }

  .post-tag-pill {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    background: #f1f5f9;
    color: #475569;
    font-size: 11.5px;
    font-weight: 600;
    margin-right: 6px;
    margin-bottom: 6px;
  }

  .post-footer-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 13px;
    color: #64748b;
    font-weight: 600;
    padding-top: 10px;
    border-top: 1px solid #f8fafc;
  }
  .post-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    text-decoration: none;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.15s;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 13px;
  }
  .post-action-btn:hover {
    background: #f1f5f9;
    color: var(--reddit-text-1);
  }

  /* Right Sidebar */
  .sidebar-box-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid var(--reddit-border);
    padding: 20px;
    margin-bottom: 18px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
  }
  .sidebar-box-header {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--reddit-text-1);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* Identity Card */
  .identity-card-box {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #ffffff;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 18px;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15);
  }

  /* Modal Overlay */
  .comm-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(4px);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }
  .comm-modal-box {
    background: #ffffff;
    border-radius: 18px;
    width: 100%;
    max-width: 640px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
  }
  .comm-modal-head {
    background: #0f172a;
    color: #ffffff;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .comm-modal-body {
    padding: 24px;
  }
  .persona-choice-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 10px;
    margin-bottom: 16px;
  }
  .persona-choice-card {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    background: #ffffff;
  }
  .persona-choice-card:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
  }
  .persona-choice-card.selected {
    border-color: var(--reddit-orange);
    background: #fff5f2;
  }
</style>

<div class="community-layout">
  <div class="community-container">

    <!-- Flash message -->
    @if(session('success'))
      <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 18px;"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="community-grid">

      <!-- ─── LEFT COLUMN: CHANNELS & COMMUNITIES ─── -->
      <aside class="community-sidebar-left">
        <div class="channel-nav-card">
          <div class="channel-nav-title">
            <span><i class="fa-solid fa-shapes"></i> Channels</span>
            <span>Reddit View</span>
          </div>

          @foreach($channels as $k => $c)
            @php
              $isActive = ($selectedChannel === $k);
              $count = $channelCounts[$k] ?? 0;
            @endphp
            <a href="{{ route('community.index', ['channel' => $k === 'all' ? null : $k, 'sort' => $sort, 'search' => $search]) }}" class="channel-nav-link {{ $isActive ? 'active' : '' }}">
              <div class="channel-nav-icon" style="background: {{ $c['bg'] }}; color: {{ $c['color'] }};">
                <i class="{{ $c['icon'] }}"></i>
              </div>
              <span>{{ $c['prefix'] }}</span>
              @if($count > 0 && $k !== 'all')
                <span class="channel-count-badge">{{ $count }}</span>
              @endif
            </a>
          @endforeach

          <div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid #f1f5f9;">
            <button type="button" onclick="openProfileModal()" style="width: 100%; padding: 10px 14px; border-radius: 10px; background: #f8fafc; border: 1px solid #e2e8f0; color: #334155; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s;">
              <i class="fa-solid fa-user-pen" style="color: var(--reddit-orange);"></i> Switch Persona
            </button>
          </div>
        </div>
      </aside>

      <!-- ─── CENTER COLUMN: DISCUSSIONS FEED ─── -->
      <main>

        <!-- Create Post Bar -->
        <div class="feed-create-bar">
          <div class="feed-user-avatar" style="background: {{ $profile['color'] }};">
            {{ strtoupper(substr($profile['name'] ?: 'C', 0, 1)) }}
          </div>
          <button type="button" onclick="openAskModal()" class="feed-create-input-btn">
            Ask a college, career, or exam question... (No signup required)
          </button>
          <button type="button" onclick="openAskModal()" style="background: var(--reddit-orange); color: #fff; border: none; padding: 10px 18px; border-radius: 999px; font-weight: 700; font-size: 13.5px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; flex-shrink: 0;">
            <i class="fa-solid fa-plus"></i> Ask
          </button>
        </div>

        <!-- Sort & Search Bar -->
        <div class="feed-sort-bar">
          <div class="sort-pills">
            <a href="{{ route('community.index', ['channel' => $selectedChannel !== 'all' ? $selectedChannel : null, 'sort' => 'hot', 'search' => $search]) }}" class="sort-pill-btn {{ $sort === 'hot' ? 'active' : '' }}">
              <i class="fa-solid fa-fire" style="{{ $sort === 'hot' ? 'color:#ff4500;' : '' }}"></i> Hot
            </a>
            <a href="{{ route('community.index', ['channel' => $selectedChannel !== 'all' ? $selectedChannel : null, 'sort' => 'new', 'search' => $search]) }}" class="sort-pill-btn {{ $sort === 'new' ? 'active' : '' }}">
              <i class="fa-solid fa-bolt" style="{{ $sort === 'new' ? 'color:#3b82f6;' : '' }}"></i> New
            </a>
            <a href="{{ route('community.index', ['channel' => $selectedChannel !== 'all' ? $selectedChannel : null, 'sort' => 'top', 'search' => $search]) }}" class="sort-pill-btn {{ $sort === 'top' ? 'active' : '' }}">
              <i class="fa-solid fa-trophy" style="{{ $sort === 'top' ? 'color:#f59e0b;' : '' }}"></i> Top
            </a>
            <a href="{{ route('community.index', ['channel' => $selectedChannel !== 'all' ? $selectedChannel : null, 'sort' => 'unanswered', 'search' => $search]) }}" class="sort-pill-btn {{ $sort === 'unanswered' ? 'active' : '' }}">
              <i class="fa-regular fa-circle-question"></i> Unanswered
            </a>
          </div>

          <form method="GET" action="{{ route('community.index') }}" style="display: flex; gap: 6px; align-items: center;">
            @if($selectedChannel !== 'all')
              <input type="hidden" name="channel" value="{{ $selectedChannel }}">
            @endif
            <input type="hidden" name="sort" value="{{ $sort }}">
            <div style="position: relative;">
              <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); font-size: 11px; color: #94a3b8;"></i>
              <input type="text" name="search" placeholder="Search posts..." value="{{ $search }}" style="padding: 6px 10px 6px 28px; border-radius: 999px; border: 1px solid #cbd5e1; font-size: 12.5px; width: 170px;">
            </div>
            @if($search)
              <a href="{{ route('community.index', ['channel' => $selectedChannel !== 'all' ? $selectedChannel : null, 'sort' => $sort]) }}" style="font-size: 12px; color: #64748b; text-decoration: none;">Clear</a>
            @endif
          </form>
        </div>

        <!-- Posts Feed List -->
        @forelse($posts as $post)
          @php
            $chMeta = $post->channel_meta;
            $personaMeta = \App\Models\CommunityProfile::getPersonaMeta($post->author_persona);
          @endphp
          <article class="reddit-card">
            <!-- Left Voting -->
            <div class="vote-sidebar">
              <button type="button" class="vote-btn" onclick="castVote('post', {{ $post->id }}, 1, this)" title="Upvote">
                <i class="fa-solid fa-chevron-up"></i>
              </button>
              <span class="vote-count" id="voteCount_post_{{ $post->id }}">{{ $post->upvotes_count }}</span>
              <button type="button" class="vote-btn" onclick="castVote('post', {{ $post->id }}, -1, this)" title="Downvote">
                <i class="fa-solid fa-chevron-down"></i>
              </button>
            </div>

            <!-- Content -->
            <div class="reddit-post-body">
              <div>
                <div class="post-top-meta">
                  <a href="{{ route('community.index', ['channel' => $post->channel]) }}" class="channel-pill" style="background: {{ $chMeta['bg'] }}; color: {{ $chMeta['color'] }};">
                    <i class="{{ $chMeta['icon'] }}"></i> {{ $chMeta['prefix'] }}
                  </a>
                  <span>&bull;</span>
                  <span>Posted by <strong class="author-name-text">{{ $post->author_name }}</strong></span>
                  <span class="persona-tag {{ $personaMeta['badge_class'] }}">
                    <i class="{{ $personaMeta['icon'] }}"></i> {{ $post->author_persona }}
                  </span>
                  @if($post->author_headline)
                    <span class="post-headline-text">({{ $post->author_headline }})</span>
                  @endif
                  <span>&bull;</span>
                  <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>

                <a href="{{ route('community.show', $post->slug) }}" class="post-title-link">
                  {{ $post->title }}
                </a>

                <p class="post-snippet">
                  {{ Str::limit($post->content, 220) }}
                </p>

                @if(!empty($post->tags) && is_array($post->tags))
                  <div style="margin-bottom: 8px;">
                    @foreach($post->tags as $t)
                      <span class="post-tag-pill">#{{ $t }}</span>
                    @endforeach
                  </div>
                @endif
              </div>

              <div class="post-footer-actions">
                <a href="{{ route('community.show', $post->slug) }}#answers" class="post-action-btn">
                  <i class="fa-regular fa-comment-dots"></i>
                  <span>{{ $post->answers_count }} {{ Str::plural('Answer', $post->answers_count) }}</span>
                </a>
                <span class="post-action-btn" title="Total Views">
                  <i class="fa-regular fa-eye"></i> {{ number_format($post->views_count) }}
                </span>
                <button type="button" class="post-action-btn" onclick="sharePost('{{ route('community.show', $post->slug) }}')">
                  <i class="fa-solid fa-share-nodes"></i> Share
                </button>
                <a href="{{ route('community.show', $post->slug) }}#replyBox" class="post-action-btn" style="margin-left: auto; color: var(--reddit-orange); font-weight: 700;">
                  <i class="fa-solid fa-reply"></i> Answer
                </a>
              </div>
            </div>
          </article>
        @empty
          <div style="background: #ffffff; border-radius: 14px; border: 1px solid var(--reddit-border); padding: 50px 20px; text-align: center; color: #94a3b8;">
            <i class="fa-regular fa-comments" style="font-size: 40px; margin-bottom: 12px; display: block; opacity: 0.4;"></i>
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 18px; color: #1e293b; margin-bottom: 6px;">No discussions found in this channel</h3>
            <p style="font-size: 13.5px; margin-bottom: 18px;">Be the first to ask a question or start a conversation!</p>
            <button type="button" onclick="openAskModal()" style="background: var(--reddit-orange); color: #fff; border: none; padding: 10px 22px; border-radius: 999px; font-weight: 700; font-size: 13.5px; cursor: pointer;">
              <i class="fa-solid fa-plus"></i> Ask Question
            </button>
          </div>
        @endforelse

        <!-- Pagination -->
        @if($posts->hasPages())
          <div style="margin-top: 24px;">
            {{ $posts->links() }}
          </div>
        @endif

      </main>

      <!-- ─── RIGHT COLUMN: ABOUT & PERSONA PROFILE ─── -->
      <aside class="community-sidebar-right">

        <!-- Identity / Persona Box -->
        <div class="identity-card-box">
          <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #ff8a65; letter-spacing: 0.5px; margin-bottom: 8px;">
            Your Community Persona
          </div>
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: {{ $profile['color'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 800; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
              {{ strtoupper(substr($profile['name'] ?: 'G', 0, 1)) }}
            </div>
            <div>
              <div style="font-size: 16px; font-weight: 800; color: #ffffff; line-height: 1.2;">
                {{ $profile['name'] ?: 'Guest Participant' }}
              </div>
              <div style="font-size: 12px; color: #cbd5e1; margin-top: 2px;">
                {{ $profile['persona'] }}
              </div>
              @if(!empty($profile['is_verified_expert']))
                <div style="margin-top: 4px;">
                  <span style="display: inline-flex; align-items: center; gap: 4px; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: 800; letter-spacing: 0.3px;">
                    <i class="fa-solid fa-certificate"></i> {{ $profile['expert_title'] ?: 'Verified Expert' }}
                  </span>
                </div>
              @endif
            </div>
          </div>

          <p style="font-size: 12px; color: #94a3b8; line-height: 1.45; margin-bottom: 14px;">
            You can ask and answer questions freely without signing up. Choose who you are to build domain reputation!
          </p>

          <button type="button" onclick="openProfileModal()" style="width: 100%; padding: 8px 14px; border-radius: 8px; background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25); color: #fff; font-size: 12.5px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
            <i class="fa-solid fa-sliders"></i> Edit Persona Profile
          </button>
        </div>

        <!-- About Community Card -->
        <div class="sidebar-box-card">
          <div class="sidebar-box-header">
            <i class="fa-brands fa-reddit-alien" style="color: var(--reddit-orange); font-size: 20px;"></i>
            <span>CareerGyan Community</span>
          </div>

          <p style="font-size: 13px; color: var(--reddit-text-2); line-height: 1.5; margin-bottom: 16px;">
            A student-first forum inspired by Reddit. Connect with seniors, teachers, working professionals, and peer aspirants across India.
          </p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; background: #f8fafc; padding: 12px; border-radius: 10px; margin-bottom: 16px;">
            <div>
              <div style="font-size: 18px; font-weight: 800; color: var(--reddit-text-1);">{{ number_format($totalQuestions) }}</div>
              <div style="font-size: 11px; color: #64748b; font-weight: 600;">Discussions</div>
            </div>
            <div>
              <div style="font-size: 18px; font-weight: 800; color: #059669;">{{ number_format($totalAnswers) }}</div>
              <div style="font-size: 11px; color: #64748b; font-weight: 600;">Answers Given</div>
            </div>
          </div>

          <button type="button" onclick="openAskModal()" style="width: 100%; padding: 11px; border-radius: 10px; background: var(--reddit-orange); color: #fff; border: none; font-weight: 700; font-size: 14px; cursor: pointer;">
            <i class="fa-solid fa-plus"></i> Ask a Question
          </button>
        </div>

        <!-- Community Guidelines -->
        <div class="sidebar-box-card">
          <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; margin-bottom: 10px;">
            Community Rules
          </div>
          <ul style="margin: 0; padding-left: 18px; font-size: 12px; color: #475569; line-height: 1.6;">
            <li>Be respectful, supportive, and kind to all learners.</li>
            <li>No promotional spam, affiliate links, or scams.</li>
            <li>Back claims with cutoff data and university links.</li>
            <li>Honest identity: choose the persona matching your background.</li>
          </ul>
        </div>

      </aside>

    </div>
  </div>
</div>

<!-- ─── MODAL 1: ASK A QUESTION ─── -->
<div class="comm-modal-overlay" id="askModal">
  <div class="comm-modal-box">
    <div class="comm-modal-head">
      <div style="display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-pen-to-square" style="color: var(--reddit-orange); font-size: 18px;"></i>
        <h3 style="margin: 0; font-size: 17px; font-weight: 800;">Ask the Community</h3>
      </div>
      <button type="button" onclick="closeAskModal()" style="background: none; border: none; color: #94a3b8; font-size: 20px; cursor: pointer;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form action="{{ route('community.post.store') }}" method="POST" class="comm-modal-body">
      @csrf

      <!-- Author info for guests -->
      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px;">
        <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">Posting As:</div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
          <input type="text" name="author_name" placeholder="Your Display Name *" value="{{ $profile['name'] }}" required style="flex: 1; min-width: 140px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px;">
          <select name="author_persona" style="flex: 1; min-width: 160px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; background: #fff;">
            <option value="10th/12th Student" {{ $profile['persona'] === '10th/12th Student' ? 'selected' : '' }}>High School Student (10th/12th)</option>
            <option value="College Student" {{ $profile['persona'] === 'College Student' ? 'selected' : '' }}>College / University Student</option>
            <option value="Working Professional" {{ $profile['persona'] === 'Working Professional' ? 'selected' : '' }}>Working Professional / Expert</option>
            <option value="Career Counselor" {{ $profile['persona'] === 'Career Counselor' ? 'selected' : '' }}>Career Counselor / Educator</option>
            <option value="Parent / Guardian" {{ $profile['persona'] === 'Parent / Guardian' ? 'selected' : '' }}>Parent / Guardian</option>
            <option value="Alumnus / Mentor" {{ $profile['persona'] === 'Alumnus / Mentor' ? 'selected' : '' }}>Alumnus / Mentor</option>
          </select>
        </div>
      </div>

      <!-- Channel Select -->
      <div style="margin-bottom: 14px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Choose Channel / Topic *</label>
        <select name="channel" required style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13.5px; background: #fff;">
          @foreach($channels as $k => $c)
            @if($k !== 'all')
              <option value="{{ $k }}" {{ $selectedChannel === $k ? 'selected' : '' }}>{{ $c['prefix'] }} &mdash; {{ $c['name'] }}</option>
            @endif
          @endforeach
        </select>
      </div>

      <!-- Title -->
      <div style="margin-bottom: 14px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Question Title *</label>
        <input type="text" name="title" placeholder="e.g. Can I get COEP CS with 98.5 percentile in MHT-CET?" required minlength="8" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; font-weight: 600;">
      </div>

      <!-- Details Body -->
      <div style="margin-bottom: 14px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Explain Details, Background or Question *</label>
        <textarea name="content" rows="5" placeholder="Share your academic background, current scores, doubts, or specific colleges you are targeting..." required minlength="15" style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13.5px; line-height: 1.5; font-family: inherit;"></textarea>
      </div>

      <!-- Tags -->
      <div style="margin-bottom: 20px;">
        <label style="display: block; font-size: 12.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Tags (Comma-separated)</label>
        <input type="text" name="tags" placeholder="e.g. MHT-CET, Cutoffs, Engineering" style="width: 100%; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px;">
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeAskModal()" style="padding: 10px 18px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; cursor: pointer;">
          Cancel
        </button>
        <button type="submit" style="padding: 10px 24px; border-radius: 8px; border: none; background: var(--reddit-orange); color: #fff; font-weight: 800; font-size: 14px; cursor: pointer;">
          Publish to Community
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ─── MODAL 2: PERSONA / PROFILE SETUP ─── -->
<div class="comm-modal-overlay" id="profileModal">
  <div class="comm-modal-box">
    <div class="comm-modal-head">
      <div style="display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-id-badge" style="color: #38bdf8; font-size: 18px;"></i>
        <h3 style="margin: 0; font-size: 17px; font-weight: 800;">Choose Who You Are</h3>
      </div>
      <button type="button" onclick="closeProfileModal()" style="background: none; border: none; color: #94a3b8; font-size: 20px; cursor: pointer;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form id="profileSetupForm" onsubmit="handleProfileSubmit(event)" class="comm-modal-body">
      @csrf
      <p style="font-size: 13.5px; color: #64748b; margin-top: 0; margin-bottom: 16px;">
        Select your role in the education ecosystem. This helps other students know who is answering and builds credibility!
      </p>

      <div class="persona-choice-grid">
        <div class="persona-choice-card {{ $profile['persona'] === '10th/12th Student' ? 'selected' : '' }}" onclick="selectPersonaOption('10th/12th Student', this)">
          <i class="fa-solid fa-graduation-cap" style="font-size: 24px; color: #2563eb; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">10th/12th Student</strong>
          <div style="font-size: 11px; color: #64748b;">School / Aspirant</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'College Student' ? 'selected' : '' }}" onclick="selectPersonaOption('College Student', this)">
          <i class="fa-solid fa-building-columns" style="font-size: 24px; color: #6366f1; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">College Student</strong>
          <div style="font-size: 11px; color: #64748b;">Undergraduate / Senior</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Working Professional' ? 'selected' : '' }}" onclick="selectPersonaOption('Working Professional', this)">
          <i class="fa-solid fa-briefcase" style="font-size: 24px; color: #059669; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">Professional</strong>
          <div style="font-size: 11px; color: #64748b;">Industry / Tech</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Career Counselor' ? 'selected' : '' }}" onclick="selectPersonaOption('Career Counselor', this)">
          <i class="fa-solid fa-compass" style="font-size: 24px; color: #d97706; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">Counselor</strong>
          <div style="font-size: 11px; color: #64748b;">Teacher / Mentor</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Parent / Guardian' ? 'selected' : '' }}" onclick="selectPersonaOption('Parent / Guardian', this)">
          <i class="fa-solid fa-people-roof" style="font-size: 24px; color: #e11d48; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">Parent</strong>
          <div style="font-size: 11px; color: #64748b;">Guardian</div>
        </div>

        <div class="persona-choice-card {{ $profile['persona'] === 'Alumnus / Mentor' ? 'selected' : '' }}" onclick="selectPersonaOption('Alumnus / Mentor', this)">
          <i class="fa-solid fa-award" style="font-size: 24px; color: #7c3aed; margin-bottom: 6px; display: block;"></i>
          <strong style="font-size: 13px; color: #0f172a;">Alumnus</strong>
          <div style="font-size: 11px; color: #64748b;">College Alumni</div>
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
  function openAskModal() {
    document.getElementById('askModal').style.display = 'flex';
  }
  function closeAskModal() {
    document.getElementById('askModal').style.display = 'none';
  }

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
      closeAskModal();
      closeProfileModal();
    }
  });
</script>
@endsection


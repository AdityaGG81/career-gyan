@extends('admin.layout')

@section('title', 'Inauguration Control')
@section('page_title', '🎀 Inauguration')

@section('styles')
<style>
  /* ─── Inauguration Dashboard ─── */
  .inaug-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4c1d95 100%);
    border-radius: var(--admin-radius-lg);
    padding: 48px 40px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    margin-bottom: 32px;
  }

  .inaug-hero::before {
    content: '';
    position: absolute;
    top: -60%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(251, 191, 36, 0.15) 0%, transparent 70%);
    pointer-events: none;
  }

  .inaug-hero::after {
    content: '🎀';
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 80px;
    opacity: 0.15;
    pointer-events: none;
  }

  .inaug-hero h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 8px;
    position: relative;
  }

  .inaug-hero p {
    font-size: 15px;
    opacity: 0.8;
    max-width: 500px;
    line-height: 1.6;
    position: relative;
  }

  /* Status Badge */
  .status-section {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 32px;
    flex-wrap: wrap;
  }

  .status-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--admin-text-2);
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.02em;
  }

  .status-badge .pulse-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    animation: pulse-glow 2s ease-in-out infinite;
  }

  @keyframes pulse-glow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.3); }
  }

  .status-hidden {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
  }
  .status-hidden .pulse-dot { background: #94a3b8; }

  .status-visible {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
  }
  .status-visible .pulse-dot { background: #f59e0b; }

  .status-cut {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #86efac;
  }
  .status-cut .pulse-dot { background: #22c55e; }

  /* Control Cards */
  .controls-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
  }

  .control-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 32px;
    text-align: center;
    box-shadow: var(--admin-shadow);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
  }

  .control-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-hover);
  }

  .control-card .card-icon {
    font-size: 48px;
    margin-bottom: 16px;
    display: block;
  }

  .control-card h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--admin-text-1);
  }

  .control-card p {
    font-size: 13px;
    color: var(--admin-text-2);
    margin-bottom: 24px;
    line-height: 1.6;
  }

  .inaug-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-family: 'Outfit', sans-serif;
  }

  .inaug-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
  }

  .btn-show-ribbon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(245, 158, 11, 0.4);
  }
  .btn-show-ribbon:not(:disabled):hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(245, 158, 11, 0.5);
  }

  .btn-cut-ribbon {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(239, 68, 68, 0.4);
    font-size: 16px;
  }
  .btn-cut-ribbon:not(:disabled):hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 8px 24px rgba(239, 68, 68, 0.5);
  }

  .btn-reset {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
  }
  .btn-reset:not(:disabled):hover {
    background: #e2e8f0;
    color: #475569;
  }

  /* Step indicator */
  .steps-timeline {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    margin-bottom: 32px;
    padding: 24px;
    background: var(--admin-surface);
    border-radius: var(--admin-radius-lg);
    border: 1px solid var(--admin-border);
    box-shadow: var(--admin-shadow);
  }

  .step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    position: relative;
    z-index: 1;
  }

  .step-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 700;
    border: 3px solid #e2e8f0;
    background: #ffffff;
    color: #94a3b8;
    transition: all 0.3s;
  }

  .step-circle.active {
    border-color: #6366f1;
    background: #6366f1;
    color: #ffffff;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
  }

  .step-circle.completed {
    border-color: #22c55e;
    background: #22c55e;
    color: #ffffff;
  }

  .step-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--admin-text-3);
    text-align: center;
  }

  .step-label.active {
    color: #6366f1;
  }

  .step-label.completed {
    color: #22c55e;
  }

  .step-connector {
    width: 80px;
    height: 3px;
    background: #e2e8f0;
    margin-bottom: 28px;
  }

  .step-connector.completed {
    background: #22c55e;
  }

  /* Live Preview */
  .preview-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 24px;
    box-shadow: var(--admin-shadow);
  }

  .preview-card h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 16px;
    color: var(--admin-text-1);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .preview-frame {
    background: #0f172a;
    border-radius: 12px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .preview-text {
    color: rgba(255,255,255,0.5);
    font-size: 14px;
    font-weight: 500;
  }

  .mini-ribbon {
    position: absolute;
    width: 100%;
    height: 40px;
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(180deg, #fbbf24, #ef4444, #dc2626, #ef4444, #fbbf24);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .mini-ribbon.cut {
    clip-path: polygon(0% 0%, 42% 0%, 38% 100%, 0% 100%, 0% 0%, 58% 0%, 62% 100%, 100% 100%, 100% 0%, 58% 0%);
    opacity: 0.6;
  }

  .mini-ribbon-text {
    color: #ffffff;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.15em;
    text-shadow: 0 1px 3px rgba(0,0,0,0.3);
  }

  @media (max-width: 768px) {
    .inaug-hero { padding: 32px 24px; }
    .inaug-hero::after { display: none; }
    .steps-timeline { flex-wrap: wrap; gap: 8px; }
    .step-connector { width: 40px; }
  }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="inaug-hero">
  <h2>🎉 Grand Inauguration Control</h2>
  <p>Control the live ribbon-cutting ceremony for your website launch. Everyone watching the website will see the ribbon in real-time!</p>
</div>

<!-- Step Timeline -->
<div class="steps-timeline">
  <div class="step-item">
    <div class="step-circle {{ $state === 'ribbon_hidden' ? 'active' : 'completed' }}">
      @if($state !== 'ribbon_hidden') <i class="fa-solid fa-check"></i> @else 1 @endif
    </div>
    <span class="step-label {{ $state === 'ribbon_hidden' ? 'active' : 'completed' }}">Hidden</span>
  </div>
  <div class="step-connector {{ $state !== 'ribbon_hidden' ? 'completed' : '' }}"></div>
  <div class="step-item">
    <div class="step-circle {{ $state === 'ribbon_visible' ? 'active' : ($state === 'ribbon_cut' ? 'completed' : '') }}">
      @if($state === 'ribbon_cut') <i class="fa-solid fa-check"></i> @else 2 @endif
    </div>
    <span class="step-label {{ $state === 'ribbon_visible' ? 'active' : ($state === 'ribbon_cut' ? 'completed' : '') }}">Ribbon Shown</span>
  </div>
  <div class="step-connector {{ $state === 'ribbon_cut' ? 'completed' : '' }}"></div>
  <div class="step-item">
    <div class="step-circle {{ $state === 'ribbon_cut' ? 'active' : '' }}">
      @if($state === 'ribbon_cut') <i class="fa-solid fa-check"></i> @else 3 @endif
    </div>
    <span class="step-label {{ $state === 'ribbon_cut' ? 'active' : '' }}">Ribbon Cut 🎉</span>
  </div>
</div>

<!-- Current Status -->
<div class="status-section">
  <span class="status-label">Current Status:</span>
  @if($state === 'ribbon_hidden')
    <span class="status-badge status-hidden"><span class="pulse-dot"></span> Ribbon Hidden</span>
  @elseif($state === 'ribbon_visible')
    <span class="status-badge status-visible"><span class="pulse-dot"></span> Ribbon Visible (Live!)</span>
  @else
    <span class="status-badge status-cut"><span class="pulse-dot"></span> Ribbon Cut — Confetti! 🎊</span>
  @endif
</div>

<!-- Control Cards -->
<div class="controls-grid">
  <!-- Show Ribbon -->
  <div class="control-card">
    <span class="card-icon">🎀</span>
    <h3>Show Ribbon</h3>
    <p>Display the inauguration ribbon on the landing page for all visitors. This is Step 1.</p>
    <form action="{{ route('admin.inauguration.show') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="inaug-btn btn-show-ribbon" {{ $state !== 'ribbon_hidden' ? 'disabled' : '' }}
        onclick="return confirm('Show the ribbon to ALL visitors now?')">
        <i class="fa-solid fa-eye"></i> Show Ribbon
      </button>
    </form>
  </div>

  <!-- Cut Ribbon -->
  <div class="control-card">
    <span class="card-icon">✂️</span>
    <h3>Cut the Ribbon</h3>
    <p>Cut the ribbon and trigger a full-screen confetti celebration on everyone's screen!</p>
    <form action="{{ route('admin.inauguration.cut') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="inaug-btn btn-cut-ribbon" {{ $state !== 'ribbon_visible' ? 'disabled' : '' }}
        onclick="return confirm('🎉 CUT THE RIBBON? Confetti will blast on all screens!')">
        <i class="fa-solid fa-scissors"></i> Cut Ribbon
      </button>
    </form>
  </div>

  <!-- Reset -->
  <div class="control-card">
    <span class="card-icon">🔄</span>
    <h3>Reset</h3>
    <p>Reset the inauguration state back to hidden. Use this for rehearsals or to re-do the ceremony.</p>
    <form action="{{ route('admin.inauguration.reset') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="inaug-btn btn-reset" {{ $state === 'ribbon_hidden' ? 'disabled' : '' }}
        onclick="return confirm('Reset inauguration? The ribbon will be hidden again.')">
        <i class="fa-solid fa-rotate-left"></i> Reset
      </button>
    </form>
  </div>
</div>

<!-- Live Preview -->
<div class="preview-card">
  <h3><i class="fa-solid fa-desktop"></i> Live Preview</h3>
  <div class="preview-frame" id="previewFrame">
    @if($state === 'ribbon_hidden')
      <span class="preview-text">Ribbon is hidden — normal website view</span>
    @elseif($state === 'ribbon_visible')
      <div class="mini-ribbon">
        <span class="mini-ribbon-text">✦ GRAND OPENING ✦</span>
      </div>
    @else
      <div class="mini-ribbon cut">
        <span class="mini-ribbon-text">✦ GRAND OPENING ✦</span>
      </div>
      <span class="preview-text" style="position:relative; z-index:2; color: #22c55e;">🎉 Website is live!</span>
    @endif
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Auto-refresh the page every 5 seconds to keep status in sync
  setTimeout(function() {
    window.location.reload();
  }, 5000);
</script>
@endsection

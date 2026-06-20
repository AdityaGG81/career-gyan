@extends('admin.layout')

@section('title', 'Platform Feedback')
@section('page_title', 'Suggestions & Feedback')

@section('styles')
<style>
  .suggestions-header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
  }

  .search-container {
    position: relative;
    flex-grow: 1;
    max-width: 400px;
  }

  .search-container i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-text-3);
  }

  .search-container input {
    padding-left: 40px;
  }

  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
  }

  .role-badge {
    display: inline-flex;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: #e8f0fe;
    color: var(--admin-brand);
  }
</style>
@endsection

@section('content')

<div class="suggestions-header-actions">
  <div class="search-container">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="suggestionSearch" class="form-control" placeholder="Search suggestions by name, email, or message...">
  </div>

  <div style="background: var(--admin-surface); border: 1px solid var(--admin-border); color: var(--admin-text-2); padding: 9px 18px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px; box-shadow: var(--admin-shadow);">
    Total Suggestions: <span id="suggestionCount">{{ $suggestions->count() }}</span>
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>User Info</th>
          <th>Role</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($suggestions as $sug)
          <tr class="suggestion-row">
            <td style="width: 220px;">
              <div class="sug-name" style="font-weight: 700; color: var(--admin-text-1);">{{ $sug->name ?: 'Anonymous' }}</div>
              <div class="sug-email" style="font-size: 13px; color: var(--admin-text-3);">{{ $sug->email ?: 'No Email' }}</div>
            </td>
            <td style="width: 140px;">
              <span class="role-badge">{{ $sug->role }}</span>
            </td>
            <td class="sug-message" style="font-size: 14px; color: var(--admin-text-2); line-height: 1.5; max-width: 450px; white-space: normal;">
              {{ $sug->message }}
            </td>
            <td style="width: 160px; font-size: 13px; color: var(--admin-text-3);">
              {{ $sug->created_at->format('d M, Y') }}
              <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $sug->created_at->format('h:i A') }}</div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-comment-slash" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No suggestions shared yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Client-side search filtering
  document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('suggestionSearch');
    const rows = document.querySelectorAll('.suggestion-row');
    const suggestionCountSpan = document.getElementById('suggestionCount');

    searchInput.addEventListener('input', () => {
      const query = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;

      rows.forEach(row => {
        const name = row.querySelector('.sug-name').textContent.toLowerCase();
        const email = row.querySelector('.sug-email').textContent.toLowerCase();
        const message = row.querySelector('.sug-message').textContent.toLowerCase();

        if (name.includes(query) || email.includes(query) || message.includes(query)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      suggestionCountSpan.textContent = visibleCount;
    });
  });
</script>
@endsection

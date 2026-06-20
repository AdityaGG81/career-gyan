@extends('admin.layout')

@section('title', 'Manage Careers')
@section('page_title', 'Careers & Roadmaps')

@section('styles')
<style>
  .search-bar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    gap: 16px;
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 16px 24px;
    box-shadow: var(--admin-shadow);
  }

  .search-form {
    display: flex;
    gap: 12px;
    flex-grow: 1;
    max-width: 500px;
  }

  .btn-search {
    background: var(--admin-brand);
    color: #fff;
    border: none;
    padding: 0 20px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-search:hover {
    background: var(--admin-brand-hover);
  }

  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
  }

  /* Badge styling */
  .badge {
    display: inline-flex;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .badge-high { background: #dcfce7; color: #166534; }
  .badge-medium { background: #fef3c7; color: #d97706; }
  .badge-moderate { background: #eff6ff; color: #1d4ed8; }
  .badge-low { background: #f1f5f9; color: #475569; }

  .btn-action-edit {
    color: var(--admin-brand);
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
    background: var(--admin-brand);
    color: #ffffff;
  }
</style>
@endsection

@section('content')

<div class="search-bar-container">
  <form action="{{ route('admin.careers.index') }}" method="GET" class="search-form">
    <input type="text" name="search" class="form-control" placeholder="Search by career name or stream..." value="{{ request('search') }}">
    <button type="submit" class="btn-search">Search</button>
  </form>
  <div style="background: var(--admin-bg); color: var(--admin-text-2); padding: 8px 16px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px;">
    Total Careers: {{ $careers->count() }}
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Field / Category</th>
          <th>Stream</th>
          <th>Demand Level</th>
          <th>Salary Range</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($careers as $career)
          <tr>
            <td style="font-weight: 700; color: var(--admin-text-1);">
              {{ $career->name }}
            </td>
            <td>
              <span style="font-weight: 500;">{{ $career->field->name ?? 'N/A' }}</span>
            </td>
            <td style="font-size: 13.5px; color: var(--admin-text-2);">
              {{ $career->stream ?: 'N/A' }}
            </td>
            <td>
              @php
                $dl = strtolower($career->demand_level);
              @endphp
              @if($dl == 'high')
                <span class="badge badge-high">High</span>
              @elseif($dl == 'medium')
                <span class="badge badge-medium">Medium</span>
              @elseif($dl == 'moderate')
                <span class="badge badge-moderate">Moderate</span>
              @else
                <span class="badge badge-low">{{ $career->demand_level ?: 'Low' }}</span>
              @endif
            </td>
            <td style="font-weight: 600; color: var(--admin-text-1);">
              {{ $career->salary_range ?: 'N/A' }}
            </td>
            <td style="text-align: center;">
              <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn-action-edit" title="Edit Career Details">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-briefcase" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No careers found matching your search.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

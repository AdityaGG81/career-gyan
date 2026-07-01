@extends('admin.layout')

@section('title', 'Manage All India Colleges')
@section('page_title', 'All India Colleges')

@section('styles')
<style>
  .colleges-index-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
  }

  .search-box-wrap {
    display: flex;
    gap: 8px;
    width: 100%;
    max-width: 450px;
  }

  .btn-admin-search {
    background: #27272a;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    cursor: pointer;
  }

  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
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
  }

  .badge-success { background: #dcfce7; color: #166534; }
  .badge-secondary { background: #f1f5f9; color: #475569; }

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

  .pagination-wrapper {
    display: flex;
    justify-content: center;
    padding: 20px 24px;
    background: #fafafa;
    border-top: 1px solid var(--admin-border);
  }

  .pagination-wrapper svg {
    width: 16px;
    height: 16px;
  }

  .pagination-wrapper nav {
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;
  }

  .pagination-wrapper nav div {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .pagination-wrapper nav a, .pagination-wrapper nav span {
    padding: 8px 14px;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-md);
    text-decoration: none;
    color: var(--admin-text-2);
    font-size: 13px;
    background: white;
  }

  .pagination-wrapper nav span.cursor-default {
    background: #f4f4f5;
  }
</style>
@endsection

@section('content')

<div class="colleges-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">Search and manage entries in the main 90k+ Indian Colleges database.</p>
  </div>
  
  <form action="{{ route('admin.indian-colleges.index') }}" method="GET" class="search-box-wrap">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, city, university, state..." class="form-control">
    <button type="submit" class="btn-admin-search"><i class="fa-solid fa-magnifying-glass"></i></button>
    @if(request('search'))
      <a href="{{ route('admin.indian-colleges.index') }}" class="btn-admin-search" style="background:#f4f4f5; color:#000; display:flex; align-items:center; text-decoration:none;"><i class="fa-solid fa-xmark"></i></a>
    @endif
  </form>
</div>

<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>State & District</th>
          <th>Management</th>
          <th>University</th>
          <th>Type</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($colleges as $college)
          <tr>
            <td style="font-weight: 700; color: var(--admin-text-1); max-width: 320px;">
              {{ $college->college_name }}
              @if($college->course_name)
                <div style="font-size:11.5px; font-weight:400; color:var(--admin-text-3); margin-top:4px;">
                  Course: {{ $college->course_name }} ({{ $college->course_type ?: 'General' }})
                </div>
              @endif
            </td>
            <td>
              {{ $college->district ?? 'N/A' }}, {{ $college->state }}
            </td>
            <td>
              <span class="badge badge-secondary" style="background: {{ $college->management_badge_color }}20; color: {{ $college->management_badge_color }};">
                {{ $college->management ?: 'N/A' }}
              </span>
            </td>
            <td style="max-width: 250px; font-size: 13px;">
              {{ $college->university_name ?: 'N/A' }}
            </td>
            <td>
              {{ $college->college_type ?: 'General' }}
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 8px; justify-content: center;">
                <a href="{{ route('admin.indian-colleges.edit', $college->id) }}" class="btn-action-edit" title="Edit College">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                <form action="{{ route('admin.indian-colleges.destroy', $college->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this college from the master database? This cannot be undone.');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action-delete" title="Delete College">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-graduation-cap" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No colleges found matching search criteria.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($colleges->hasPages())
    <div class="pagination-wrapper">
      {{ $colleges->links() }}
    </div>
  @endif
</div>

@endsection

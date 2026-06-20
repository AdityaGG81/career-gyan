@extends('admin.layout')

@section('title', 'Manage Colleges')
@section('page_title', 'Colleges')

@section('styles')
<style>
  .colleges-index-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
  }

  .btn-admin-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--admin-brand);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-admin-primary:hover {
    background: var(--admin-brand-light);
    transform: translateY(-1px);
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

  .badge-success { background: #dcfce7; color: #166534; }
  .badge-warning { background: #fffbeb; color: #b45309; }
  .badge-secondary { background: #f1f5f9; color: #475569; }

  /* Action Buttons */
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
</style>
@endsection

@section('content')

<div class="colleges-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">Manage top colleges, state rankings, cutoff details, and YouTube video guides.</p>
  </div>
  <a href="{{ route('admin.colleges.create') }}" class="btn-admin-primary">
    <i class="fa-solid fa-circle-plus"></i> Add College
  </a>
</div>

<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Category</th>
          <th>Location</th>
          <th>Type</th>
          <th style="text-align: center;">Rankings</th>
          <th style="text-align: center;">Video</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($colleges as $college)
          <tr>
            <td style="font-weight: 700; color: var(--admin-text-1); max-width: 280px;">
              {{ $college->name }}
            </td>
            <td>
              <span class="badge badge-secondary" style="background: {{ $college->field->bg_color ?: '#f1f5f9' }}; color: {{ $college->field->color ?: '#475569' }};">
                {{ $college->field ? $college->field->name : 'General' }}
              </span>
            </td>
            <td>
              {{ $college->location }}, {{ $college->state }}
            </td>
            <td>
              <span class="badge {{ $college->type == 'Government' ? 'badge-success' : 'badge-secondary' }}">
                {{ $college->type }}
              </span>
            </td>
            <td style="text-align: center; font-size: 13px;">
              @if($college->rank)
                <div style="margin-bottom: 4px;"><span class="badge badge-warning" style="padding:2px 8px;">CG: #{{ $college->rank }}</span></div>
              @endif
              @if($college->government_rank)
                <div style="margin-bottom: 4px;"><span class="badge badge-secondary" style="padding:2px 8px; background:#e0f2fe; color:#0369a1;">Govt: #{{ $college->government_rank }}</span></div>
              @endif
              @if($college->naac_grade)
                <div><span class="badge badge-success" style="padding:2px 8px; background:#dcfce7; color:#14532d;">NAAC: {{ $college->naac_grade }}</span></div>
              @endif
              @if(!$college->rank && !$college->government_rank && !$college->naac_grade)
                <span style="color:var(--admin-text-3); font-size:12px;">N/A</span>
              @endif
            </td>
            <td style="text-align: center;">
              @if($college->youtube_url)
                <span style="color:#ff0000; font-size: 16px;" title="YouTube Video Available"><i class="fa-brands fa-youtube"></i></span>
              @else
                <span style="color:var(--admin-text-3); font-size: 14px;"><i class="fa-regular fa-eye-slash"></i></span>
              @endif
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 8px; justify-content: center;">
                <a href="{{ route('admin.colleges.edit', $college->id) }}" class="btn-action-edit" title="Edit College">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                <form action="{{ route('admin.colleges.destroy', $college->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this college? This action cannot be undone.');" style="display: inline;">
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
            <td colspan="7" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-graduation-cap" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No colleges added yet. Add your first college now!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

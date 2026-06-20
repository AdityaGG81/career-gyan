@extends('admin.layout')

@section('title', 'Manage Categories')
@section('page_title', 'Categories')

@section('styles')
<style>
  .fields-index-header {
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

  .icon-preview {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }

  .cover-preview {
    width: 60px;
    height: 40px;
    border-radius: 4px;
    background: #f1f5f9;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-text-3);
  }

  .cover-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

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

<div class="fields-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">Manage career sectors, icons, branding colors, and cover pages.</p>
  </div>
  <a href="{{ route('admin.fields.create') }}" class="btn-admin-primary">
    <i class="fa-solid fa-circle-plus"></i> Create Category
  </a>
</div>

<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Cover Image</th>
          <th>Branding Colors</th>
          <th style="text-align: center;">Careers</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($fields as $field)
          <tr>
            <td style="width: 60px;">
              <div class="icon-preview" style="background: {{ $field->bg_color ?: '#e8f0fe' }}; color: {{ $field->color ?: '#1a56db' }};">
                <i class="fa-solid {{ $field->icon ?: 'fa-briefcase' }}"></i>
              </div>
            </td>
            <td style="font-weight: 700; color: var(--admin-text-1);">
              {{ $field->name }}
            </td>
            <td style="font-family: monospace; font-size: 13px;">
              {{ $field->slug }}
            </td>
            <td>
              <div class="cover-preview">
                @if($field->cover_image)
                  <img src="{{ $field->cover_image }}" alt="Cover">
                @else
                  <i class="fa-solid fa-image"></i>
                @endif
              </div>
            </td>
            <td>
              <div style="display: flex; gap: 8px; align-items: center; font-size: 12px; font-weight: 500;">
                <span style="display: inline-block; width: 14px; height: 14px; border-radius: 4px; background: {{ $field->color ?: '#1a56db' }}; border: 1px solid var(--admin-border);"></span>
                <span>{{ $field->color ?: '#1a56db' }}</span>
                <span style="display: inline-block; width: 14px; height: 14px; border-radius: 4px; background: {{ $field->bg_color ?: '#e8f0fe' }}; border: 1px solid var(--admin-border); margin-left: 8px;"></span>
                <span>{{ $field->bg_color ?: '#e8f0fe' }}</span>
              </div>
            </td>
            <td style="text-align: center; font-weight: 600;">
              {{ $field->careers_count }}
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 8px; justify-content: center;">
                <a href="{{ route('admin.fields.edit', $field->id) }}" class="btn-action-edit" title="Edit Category">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                @if($field->slug !== 'others')
                  <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? All career roadmaps in this category will be deleted. This action cannot be undone.');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action-delete" title="Delete Category">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-shapes" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No categories created yet. Create your first category now!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

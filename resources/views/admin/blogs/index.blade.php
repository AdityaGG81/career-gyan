@extends('admin.layout')

@section('title', 'Manage Blogs')
@section('page_title', 'Blog Posts')

@section('styles')
<style>
  .blog-index-header {
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
    box-shadow: 0 4px 10px rgba(26, 86, 219, 0.2);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-admin-primary:hover {
    background: var(--admin-brand-hover);
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

<div class="blog-index-header">
  <div>
    <p style="color: var(--admin-text-2); font-size: 14.5px;">Write, publish, and manage all your career guide articles.</p>
  </div>
  <a href="{{ route('admin.blogs.create') }}" class="btn-admin-primary">
    <i class="fa-solid fa-circle-plus"></i> Create New Post
  </a>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Cover</th>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th style="text-align: center;">Views</th>
          <th>Date</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($blogs as $blog)
          <tr>
            <td style="width: 80px;">
              <div style="width: 50px; height: 35px; border-radius: 4px; background: linear-gradient(135deg, #eff6ff, #dbeafe); overflow: hidden; display: flex; align-items: center; justify-content: center; color: var(--admin-brand);">
                @if($blog->cover_image)
                  <img src="{{ $blog->cover_image }}" alt="Cover" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <i class="fa-solid fa-image" style="font-size: 14px;"></i>
                @endif
              </div>
            </td>
            <td style="font-weight: 700; color: var(--admin-text-1); max-width: 250px;">
              {{ $blog->title }}
            </td>
            <td>
              <span class="badge badge-secondary" style="background: #f1f5f9; color: var(--admin-text-2);">
                {{ $blog->category }}
              </span>
            </td>
            <td>
              @if($blog->is_published)
                <span class="badge badge-success">Published</span>
              @else
                <span class="badge badge-secondary">Draft</span>
              @endif
            </td>
            <td style="text-align: center; font-weight: 600;">
              <i class="fa-regular fa-eye" style="font-size: 12px; color: var(--admin-text-3); margin-right: 4px;"></i>
              {{ $blog->views_count }}
            </td>
            <td>
              @if($blog->is_published && $blog->published_at)
                {{ $blog->published_at->format('d M, Y') }}
              @else
                <span style="color: var(--admin-text-3);">Drafted</span>
              @endif
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 8px; justify-content: center;">
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-action-edit" title="Edit Post">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action-delete" title="Delete Post">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-newspaper" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No blog posts created yet. Write your first post now!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection

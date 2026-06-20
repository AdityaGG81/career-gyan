@extends('admin.layout')

@section('title', 'Create Blog Post')
@section('page_title', 'Create New Post')

@section('styles')
<style>
  .form-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 32px;
    box-shadow: var(--admin-shadow);
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    margin-bottom: 30px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-group label {
    font-size: 14px;
    font-weight: 600;
    color: var(--admin-text-1);
  }

  .form-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: var(--admin-radius-md);
    border: 1.5px solid var(--admin-border);
    font-family: inherit;
    font-size: 14.5px;
    transition: all 0.2s;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--admin-brand);
    box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.1);
  }

  /* Toggle Switch */
  .switch-container {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 46px;
    height: 24px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #cbd5e1;
    transition: .3s;
    border-radius: 24px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
  }

  input:checked + .slider {
    background-color: var(--admin-brand);
  }

  input:checked + .slider:before {
    transform: translateX(22px);
  }

  .form-actions {
    display: flex;
    gap: 16px;
    border-top: 1px solid var(--admin-border);
    padding-top: 24px;
  }

  .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    color: var(--admin-text-2);
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    border: 1px solid var(--admin-border);
    transition: all 0.2s;
  }

  .btn-cancel:hover {
    background: #e2e8f0;
  }
</style>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.blogs.store') }}" method="POST">
    @csrf

    <div class="form-grid">
      <!-- Title -->
      <div class="form-group">
        <label for="title">Title <span style="color: #ef4444;">*</span></label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" value="{{ old('title') }}" required>
        @error('title')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Slug -->
      <div class="form-group">
        <label for="slug">Slug (Auto-generated)</label>
        <input type="text" id="slug" class="form-control" placeholder="slug-format-here" readonly style="background: #f8fafc; color: var(--admin-text-3);">
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Category -->
        <div class="form-group">
          <label for="category">Category <span style="color: #ef4444;">*</span></label>
          <select name="category" id="category" class="form-control" required>
            @foreach($categories as $cat)
              <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
          </select>
        </div>

        <!-- Author -->
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" name="author" id="author" class="form-control" placeholder="CareerGyan Team" value="{{ old('author', 'CareerGyan Team') }}">
        </div>
      </div>

      <!-- Cover Image URL -->
      <div class="form-group">
        <label for="cover_image">Cover Image URL</label>
        <input type="url" name="cover_image" id="cover_image" class="form-control" placeholder="https://example.com/image.jpg" value="{{ old('cover_image') }}">
      </div>

      <!-- Excerpt -->
      <div class="form-group">
        <label for="excerpt">Excerpt / Short Description</label>
        <textarea name="excerpt" id="excerpt" rows="3" class="form-control" placeholder="Brief summary of the article (displays on listings page)" style="resize: vertical;">{{ old('excerpt') }}</textarea>
      </div>

      <!-- Content -->
      <div class="form-group">
        <label for="content">Article Content (HTML is supported) <span style="color: #ef4444;">*</span></label>
        <textarea name="content" id="content" rows="15" class="form-control" placeholder="Write your full article here..." style="resize: vertical;" required>{{ old('content') }}</textarea>
        @error('content')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tags -->
      <div class="form-group">
        <label for="tags">Tags (Comma-separated)</label>
        <input type="text" name="tags" id="tags" class="form-control" placeholder="career, guide, jobs" value="{{ old('tags') }}">
      </div>

      <!-- Publish Toggle -->
      <div class="form-group">
        <label>Publish Settings</label>
        <div class="switch-container">
          <label class="switch">
            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
            <span class="slider"></span>
          </label>
          <span style="font-size: 14.5px; font-weight: 600; color: var(--admin-text-2);">Publish immediately (Draft if disabled)</span>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="form-actions">
      <button type="submit" class="btn-admin-primary">
        <i class="fa-solid fa-paper-plane"></i> Save Post
      </button>
      <a href="{{ route('admin.blogs.index') }}" class="btn-cancel">
        Cancel
      </a>
    </div>
  </form>
</div>

@endsection

@section('scripts')
<script>
  // Auto slug preview JS
  document.addEventListener('DOMContentLoaded', () => {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    function generateSlug(text) {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start
        .replace(/-+$/, '');            // Trim - from end
    }

    titleInput.addEventListener('input', () => {
      slugInput.value = generateSlug(titleInput.value);
    });
  });
</script>
@endsection

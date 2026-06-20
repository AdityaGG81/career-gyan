@extends('admin.layout')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category')

@section('styles')
<style>
  .form-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 32px;
    max-width: 700px;
    margin: 0 auto;
  }

  .form-group {
    margin-bottom: 24px;
  }

  .form-group label {
    display: block;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--admin-text-2);
    margin-bottom: 8px;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .btn-submit-wrap {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 32px;
  }

  .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f4f4f5;
    color: var(--admin-text-1);
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    border: 1px solid var(--admin-border);
    transition: all 0.2s;
  }

  .btn-cancel:hover {
    background: #e4e4e7;
  }
</style>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.fields.update', $field->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name">Category Name <span style="color:#ef4444;">*</span></label>
      <input type="text" name="name" id="name" class="form-control" placeholder="E.g. Engineering & Technology" required value="{{ old('name', $field->name) }}">
      @error('name')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="icon">FontAwesome Icon Class</label>
      <input type="text" name="icon" id="icon" class="form-control" placeholder="E.g. fa-laptop-code" value="{{ old('icon', $field->icon) }}">
      <small style="color:var(--admin-text-3); font-size:11px; margin-top:4px; display:block;">Refer to FontAwesome 6 icons list.</small>
      @error('icon')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="color">Text Color Hex Code</label>
        <input type="color" name="color" id="color" class="form-control" style="height:44px; padding:4px;" value="{{ old('color', $field->color) }}">
        @error('color')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="bg_color">Background Color Hex Code</label>
        <input type="color" name="bg_color" id="bg_color" class="form-control" style="height:44px; padding:4px;" value="{{ old('bg_color', $field->bg_color) }}">
        @error('bg_color')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label for="cover_image">Cover Image URL</label>
      <input type="text" name="cover_image" id="cover_image" class="form-control" placeholder="E.g. https://images.unsplash.com/photo-..." value="{{ old('cover_image', $field->cover_image) }}">
      <small style="color:var(--admin-text-3); font-size:11px; margin-top:4px; display:block;">Provide a direct image URL for the category card cover.</small>
      @error('cover_image')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="btn-submit-wrap">
      <a href="{{ route('admin.fields.index') }}" class="btn-cancel">Cancel</a>
      <button type="submit" class="btn-admin-primary">
        <i class="fa-solid fa-circle-check"></i> Update Category
      </button>
    </div>
  </form>
</div>

@endsection

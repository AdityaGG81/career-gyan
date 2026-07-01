@extends('admin.layout')

@section('title', 'Edit All India College')
@section('page_title', 'Edit College')

@section('styles')
<style>
  .form-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 32px;
    max-width: 800px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .form-group-full {
    grid-column: span 2;
  }

  .form-group label {
    font-size: 13px;
    font-weight: 600;
    color: var(--admin-text-2);
  }

  .btn-submit-form {
    background: var(--admin-brand);
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: var(--admin-radius-md);
    font-weight: 700;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s;
  }

  .btn-submit-form:hover {
    background: var(--admin-brand-light);
  }

  .btn-cancel-form {
    background: #f4f4f5;
    color: #000;
    border: 1px solid var(--admin-border);
    padding: 12px 24px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    text-align: center;
    transition: all 0.2s;
  }

  .btn-cancel-form:hover {
    background: #e4e4e7;
  }

  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }
    .form-group-full {
      grid-column: span 1;
    }
  }
</style>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.indian-colleges.update', $college->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-grid">
      
      <!-- College Name -->
      <div class="form-group form-group-full">
        <label for="college_name">College / Institution Name</label>
        <input type="text" name="college_name" id="college_name" value="{{ old('college_name', $college->college_name) }}" class="form-control" required>
        @error('college_name') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- State -->
      <div class="form-group">
        <label for="state">State</label>
        <input type="text" name="state" id="state" value="{{ old('state', $college->state) }}" class="form-control" required>
        @error('state') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- District -->
      <div class="form-group">
        <label for="district">District</label>
        <input type="text" name="district" id="district" value="{{ old('district', $college->district) }}" class="form-control" required>
        @error('district') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- Management -->
      <div class="form-group">
        <label for="management">Management Type</label>
        <input type="text" name="management" id="management" value="{{ old('management', $college->management) }}" class="form-control" placeholder="E.g., Private, Government, Aided...">
        @error('management') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- College Type -->
      <div class="form-group">
        <label for="college_type">Institution Type / Category</label>
        <input type="text" name="college_type" id="college_type" value="{{ old('college_type', $college->college_type) }}" class="form-control" placeholder="E.g., Engineering, Medical, General...">
        @error('college_type') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- University Name -->
      <div class="form-group form-group-full">
        <label for="university_name">Affiliated University Name</label>
        <input type="text" name="university_name" id="university_name" value="{{ old('university_name', $college->university_name) }}" class="form-control">
        @error('university_name') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- City -->
      <div class="form-group">
        <label for="city">City / Town</label>
        <input type="text" name="city" id="city" value="{{ old('city', $college->city) }}" class="form-control">
        @error('city') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- Website -->
      <div class="form-group">
        <label for="website">Website Link</label>
        <input type="url" name="website" id="website" value="{{ old('website', $college->website) }}" class="form-control" placeholder="https://example.com">
        @error('website') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

      <!-- Full Address -->
      <div class="form-group form-group-full">
        <label for="address">Full Address</label>
        <textarea name="address" id="address" rows="3" class="form-control">{{ old('address', $college->address) }}</textarea>
        @error('address') <span style="color:#ef4444; font-size:12px;">{{ $message }}</span> @enderror
      </div>

    </div>

    <div style="display: flex; gap: 12px; justify-content: flex-end;">
      <a href="{{ route('admin.indian-colleges.index') }}" class="btn-cancel-form">Cancel</a>
      <button type="submit" class="btn-submit-form">Save Changes</button>
    </div>

  </form>
</div>

@endsection

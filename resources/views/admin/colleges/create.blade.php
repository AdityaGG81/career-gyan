@extends('admin.layout')

@section('title', 'Add College')
@section('page_title', 'Add College')

@section('styles')
<style>
  .form-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    padding: 32px;
    max-width: 800px;
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
  <form action="{{ route('admin.colleges.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="name">College Name <span style="color:#ef4444;">*</span></label>
      <input type="text" name="name" id="name" class="form-control" placeholder="E.g. FLAME University" required value="{{ old('name') }}">
      @error('name')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="field_id">Category (Field) <span style="color:#ef4444;">*</span></label>
        <select name="field_id" id="field_id" class="form-control" required>
          <option value="">Select Category</option>
          @foreach($fields as $field)
            <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
          @endforeach
        </select>
        @error('field_id')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="type">College Type <span style="color:#ef4444;">*</span></label>
        <select name="type" id="type" class="form-control" required>
          <option value="Government" {{ old('type') == 'Government' ? 'selected' : '' }}>Government</option>
          <option value="Private" {{ old('type', 'Private') == 'Private' ? 'selected' : '' }}>Private</option>
          <option value="Deemed" {{ old('type') == 'Deemed' ? 'selected' : '' }}>Deemed</option>
          <option value="Central" {{ old('type') == 'Central' ? 'selected' : '' }}>Central</option>
          <option value="Autonomous" {{ old('type') == 'Autonomous' ? 'selected' : '' }}>Autonomous</option>
        </select>
        @error('type')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="location">City/District <span style="color:#ef4444;">*</span></label>
        <input type="text" name="location" id="location" class="form-control" placeholder="E.g. Pune" required value="{{ old('location') }}">
        @error('location')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="state">State <span style="color:#ef4444;">*</span></label>
        <input type="text" name="state" id="state" class="form-control" placeholder="E.g. Maharashtra" required value="{{ old('state', 'Maharashtra') }}">
        @error('state')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="fees_range">Fees Range <span style="color:#ef4444;">*</span></label>
        <input type="text" name="fees_range" id="fees_range" class="form-control" placeholder="E.g. ₹2L - ₹3L/year or ₹1.5L/year" required value="{{ old('fees_range') }}">
        @error('fees_range')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="rank">State Rank (Optional)</label>
        <input type="number" name="rank" id="rank" class="form-control" placeholder="E.g. 1" min="1" value="{{ old('rank') }}">
        @error('rank')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="website">Website Link (URL)</label>
        <input type="url" name="website" id="website" class="form-control" placeholder="E.g. https://www.iitb.ac.in" value="{{ old('website') }}">
        @error('website')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="youtube_url">YouTube Video URL (For Detail Modal Preview)</label>
        <input type="text" name="youtube_url" id="youtube_url" class="form-control" placeholder="E.g. https://youtu.be/..." value="{{ old('youtube_url') }}">
        @error('youtube_url')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="naac_grade">NAAC Accreditation Grade (Optional)</label>
        <input type="text" name="naac_grade" id="naac_grade" class="form-control" placeholder="E.g. A++, A+, A" value="{{ old('naac_grade') }}">
        @error('naac_grade')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="government_rank">Government / NIRF Rank (Optional)</label>
        <input type="number" name="government_rank" id="government_rank" class="form-control" placeholder="E.g. 15" min="1" value="{{ old('government_rank') }}">
        @error('government_rank')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="popular_branches">Popular Branches / Majors</label>
        <input type="text" name="popular_branches" id="popular_branches" class="form-control" placeholder="E.g. Computer Science, Mechanical" value="{{ old('popular_branches') }}">
        @error('popular_branches')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="cutoff">Entrance Exams & Cutoff</label>
        <input type="text" name="cutoff" id="cutoff" class="form-control" placeholder="E.g. JEE Main, MHT-CET (98%ile)" value="{{ old('cutoff') }}">
        @error('cutoff')
          <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label for="description">About the College / Description</label>
      <textarea name="description" id="description" rows="4" class="form-control" placeholder="Briefly describe the institute, its culture, and highlights...">{{ old('description') }}</textarea>
      @error('description')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="facilities">Campus Facilities</label>
      <textarea name="facilities" id="facilities" rows="3" class="form-control" placeholder="E.g. Library, Sports Complex, High-tech labs...">{{ old('facilities') }}</textarea>
      @error('facilities')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="placement_support">Placement Support & Recruiters</label>
      <textarea name="placement_support" id="placement_support" rows="3" class="form-control" placeholder="E.g. 100% placements, average package 7LPA, top recruiters: Infosys, TCS...">{{ old('placement_support') }}</textarea>
      @error('placement_support')
        <span style="color:#ef4444; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span>
      @enderror
    </div>

    <div class="btn-submit-wrap">
      <a href="{{ route('admin.colleges.index') }}" class="btn-cancel">Cancel</a>
      <button type="submit" class="btn-admin-primary">
        <i class="fa-solid fa-circle-check"></i> Save College
      </button>
    </div>
  </form>
</div>

@endsection

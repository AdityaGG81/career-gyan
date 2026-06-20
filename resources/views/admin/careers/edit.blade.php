@extends('admin.layout')

@section('title', 'Edit Career Path')
@section('page_title', 'Edit Career Details')

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
  <form action="{{ route('admin.careers.update', $career->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-grid">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Career Name -->
        <div class="form-group">
          <label for="name">Career Name <span style="color: #ef4444;">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $career->name) }}" required>
          @error('name')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>

        <!-- Field (Parent Category) -->
        <div class="form-group">
          <label for="field_id">Field / Category <span style="color: #ef4444;">*</span></label>
          <select name="field_id" id="field_id" class="form-control" required>
            @foreach($fields as $field)
              <option value="{{ $field->id }}" {{ old('field_id', $career->field_id) == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Qualification -->
        <div class="form-group">
          <label for="qualification">qualification</label>
          <input type="text" name="qualification" id="qualification" class="form-control" placeholder="e.g. 12th Commerce, Graduation" value="{{ old('qualification', $career->qualification) }}">
        </div>

        <!-- Stream -->
        <div class="form-group">
          <label for="stream">Stream</label>
          <input type="text" name="stream" id="stream" class="form-control" placeholder="e.g. Commerce, Science" value="{{ old('stream', $career->stream) }}">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Salary Range -->
        <div class="form-group">
          <label for="salary_range">Salary Range</label>
          <input type="text" name="salary_range" id="salary_range" class="form-control" placeholder="e.g. ₹4L - 12L" value="{{ old('salary_range', $career->salary_range) }}">
        </div>

        <!-- Demand Level -->
        <div class="form-group">
          <label for="demand_level">Demand Level <span style="color: #ef4444;">*</span></label>
          <select name="demand_level" id="demand_level" class="form-control" required>
            <option value="High" {{ old('demand_level', $career->demand_level) == 'High' ? 'selected' : '' }}>High</option>
            <option value="Medium" {{ old('demand_level', $career->demand_level) == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="Moderate" {{ old('demand_level', $career->demand_level) == 'Moderate' ? 'selected' : '' }}>Moderate</option>
            <option value="Low" {{ old('demand_level', $career->demand_level) == 'Low' ? 'selected' : '' }}>Low</option>
          </select>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Video URL -->
        <div class="form-group">
          <label for="video_url">YouTube Video Guide URL</label>
          <input type="text" name="video_url" id="video_url" class="form-control" placeholder="e.g. https://youtu.be/..." value="{{ old('video_url', $career->video_url) }}">
          @error('video_url')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>

        <!-- Cover Image URL -->
        <div class="form-group">
          <label for="image">Cover Image URL</label>
          <input type="text" name="image" id="image" class="form-control" placeholder="e.g. https://images.unsplash.com/photo-..." value="{{ old('image', $career->image) }}">
          @error('image')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Icon Class -->
        <div class="form-group">
          <label for="icon">FontAwesome Icon Class</label>
          <input type="text" name="icon" id="icon" class="form-control" placeholder="e.g. fa-briefcase" value="{{ old('icon', $career->icon) }}">
          @error('icon')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Description -->
      <div class="form-group">
        <label for="description">Description <span style="color: #ef4444;">*</span></label>
        <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $career->description) }}</textarea>
      </div>

      <!-- Future Scope -->
      <div class="form-group">
        <label for="future_scope">Future Scope</label>
        <textarea name="future_scope" id="future_scope" rows="5" class="form-control">{{ old('future_scope', $career->future_scope) }}</textarea>
      </div>

      <!-- Skills (One per line) -->
      <div class="form-group">
        <label for="skills">Skills Required (One skill per line)</label>
        <textarea name="skills" id="skills" rows="6" class="form-control" placeholder="Coding&#10;Data Analysis&#10;Problem Solving">{{ old('skills', $skillsText) }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Entrance Exams (One per line) -->
        <div class="form-group">
          <label for="entrance_exams">Entrance Exams (One exam per line)</label>
          <textarea name="entrance_exams" id="entrance_exams" rows="6" class="form-control" placeholder="JEE Main&#10;MHT CET">{{ old('entrance_exams', $examsText) }}</textarea>
        </div>

        <!-- Job Opportunities (One per line) -->
        <div class="form-group">
          <label for="job_opportunities">Job Opportunities (One role per line)</label>
          <textarea name="job_opportunities" id="job_opportunities" rows="6" class="form-control" placeholder="Software Engineer&#10;System Analyst">{{ old('job_opportunities', $jobsText) }}</textarea>
        </div>
      </div>

      <!-- Roadmap (JSON Format) -->
      <div class="form-group">
        <label for="roadmap">Visual Roadmap steps (JSON Format)</label>
        <textarea name="roadmap" id="roadmap" rows="12" class="form-control" style="font-family: monospace; background: #f8fafc;">{{ old('roadmap', $roadmapJson) }}</textarea>
        <small style="color: var(--admin-text-3); font-size: 12px; margin-top: 4px;">Must be a valid JSON array of step objects, e.g. <code>[{"step": 1, "title": "Choose Science Stream", "description": "Opt for PCM in 11th & 12th"}, ...]</code></small>
        @error('roadmap')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <!-- Actions -->
    <div class="form-actions">
      <button type="submit" class="btn-admin-primary">
        <i class="fa-solid fa-square-check"></i> Save Career Details
      </button>
      <a href="{{ route('admin.careers.index') }}" class="btn-cancel">
        Cancel
      </a>
    </div>
  </form>
</div>

@endsection

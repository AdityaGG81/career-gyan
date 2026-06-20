@extends('admin.layout')

@section('title', 'Create Daily Quiz Question')
@section('page_title', 'Create Daily Question')

@section('styles')
<style>
  .form-card {
    background: var(--admin-surface, #ffffff);
    border: 1px solid var(--admin-border, #e4e4e7);
    border-radius: var(--admin-radius-lg, 16px);
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
    color: var(--admin-text-1, #09090b);
  }

  .form-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: var(--admin-radius-md, 10px);
    border: 1.5px solid var(--admin-border, #e4e4e7);
    font-family: inherit;
    font-size: 14.5px;
    transition: all 0.2s;
  }

  .form-control:focus {
    outline: none;
    border-color: var(--admin-brand, #000000);
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
  }

  .options-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

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
    background-color: var(--admin-brand, #000000);
  }

  input:checked + .slider:before {
    transform: translateX(22px);
  }

  .form-actions {
    display: flex;
    gap: 16px;
    border-top: 1px solid var(--admin-border, #e4e4e7);
    padding-top: 24px;
  }

  .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    color: var(--admin-text-2, #52525b);
    padding: 10px 18px;
    border-radius: var(--admin-radius-md, 10px);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    border: 1px solid var(--admin-border, #e4e4e7);
    transition: all 0.2s;
  }

  .btn-cancel:hover {
    background: #e2e8f0;
  }

  .btn-admin-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--admin-brand, #000000);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md, 10px);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-admin-primary:hover {
    background: var(--admin-brand-light, #27272a);
    transform: translateY(-1px);
  }
</style>
@endsection

@section('content')

<div class="form-card">
  <form action="{{ route('admin.quiz.store') }}" method="POST">
    @csrf

    <div class="form-grid">
      <!-- Quiz Date -->
      <div class="form-group">
        <label for="quiz_date">Quiz Date <span style="color: #ef4444;">*</span></label>
        <input type="date" name="quiz_date" id="quiz_date" class="form-control" value="{{ old('quiz_date', date('Y-m-d')) }}" required>
        @error('quiz_date')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Question Text -->
      <div class="form-group">
        <label for="question_text">Question Text <span style="color: #ef4444;">*</span></label>
        <textarea name="question_text" id="question_text" rows="3" class="form-control" placeholder="Enter the daily quiz question text here..." required style="resize: vertical;">{{ old('question_text') }}</textarea>
        @error('question_text')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Options Container -->
      <div class="form-group">
        <label>Options <span style="color: #ef4444;">*</span></label>
        <div class="options-container">
          <div class="form-group">
            <label for="option_a" style="font-size: 12px; color: var(--admin-text-2);">Option A</label>
            <input type="text" name="option_a" id="option_a" class="form-control" placeholder="Option A text" value="{{ old('option_a') }}" required>
            @error('option_a')
              <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="option_b" style="font-size: 12px; color: var(--admin-text-2);">Option B</label>
            <input type="text" name="option_b" id="option_b" class="form-control" placeholder="Option B text" value="{{ old('option_b') }}" required>
            @error('option_b')
              <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="option_c" style="font-size: 12px; color: var(--admin-text-2);">Option C</label>
            <input type="text" name="option_c" id="option_c" class="form-control" placeholder="Option C text" value="{{ old('option_c') }}" required>
            @error('option_c')
              <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="option_d" style="font-size: 12px; color: var(--admin-text-2);">Option D</label>
            <input type="text" name="option_d" id="option_d" class="form-control" placeholder="Option D text" value="{{ old('option_d') }}" required>
            @error('option_d')
              <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Correct Option -->
        <div class="form-group">
          <label for="correct_option">Correct Option <span style="color: #ef4444;">*</span></label>
          <select name="correct_option" id="correct_option" class="form-control" required>
            <option value="">Select correct answer</option>
            <option value="a" {{ old('correct_option') == 'a' ? 'selected' : '' }}>Option A</option>
            <option value="b" {{ old('correct_option') == 'b' ? 'selected' : '' }}>Option B</option>
            <option value="c" {{ old('correct_option') == 'c' ? 'selected' : '' }}>Option C</option>
            <option value="d" {{ old('correct_option') == 'd' ? 'selected' : '' }}>Option D</option>
          </select>
          @error('correct_option')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>

        <!-- Points -->
        <div class="form-group">
          <label for="points">Points Value <span style="color: #ef4444;">*</span></label>
          <input type="number" name="points" id="points" class="form-control" placeholder="10" min="5" max="50" value="{{ old('points', 10) }}" required>
          @error('points')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <!-- Category -->
        <div class="form-group">
          <label for="category">Category <span style="color: #ef4444;">*</span></label>
          <select name="category" id="category" class="form-control" required>
            <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
            <option value="engineering" {{ old('category') == 'engineering' ? 'selected' : '' }}>Engineering</option>
            <option value="science" {{ old('category') == 'science' ? 'selected' : '' }}>Science</option>
            <option value="arts" {{ old('category') == 'arts' ? 'selected' : '' }}>Arts</option>
            <option value="commerce" {{ old('category') == 'commerce' ? 'selected' : '' }}>Commerce</option>
            <option value="technology" {{ old('category', 'technology') == 'technology' ? 'selected' : '' }}>Technology</option>
          </select>
          @error('category')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>

        <!-- Difficulty -->
        <div class="form-group">
          <label for="difficulty">Difficulty <span style="color: #ef4444;">*</span></label>
          <select name="difficulty" id="difficulty" class="form-control" required>
            <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
            <option value="medium" {{ old('difficulty', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
          </select>
          @error('difficulty')
            <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Explanation -->
      <div class="form-group">
        <label for="explanation">Explanation / Learnings (displays after submission)</label>
        <textarea name="explanation" id="explanation" rows="3" class="form-control" placeholder="Provide a brief explanation of the answer..." style="resize: vertical;">{{ old('explanation') }}</textarea>
        @error('explanation')
          <span style="color: #ef4444; font-size: 12.5px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Active Status Switch -->
      <div class="form-group">
        <label>Active Status</label>
        <div class="switch-container">
          <label class="switch">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
            <span class="slider"></span>
          </label>
          <span style="font-size: 14.5px; font-weight: 600; color: var(--admin-text-2, #52525b);">Active immediately (Inactive to hide)</span>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="form-actions">
      <button type="submit" class="btn-admin-primary">
        <i class="fa-solid fa-paper-plane"></i> Save Question
      </button>
      <a href="{{ route('admin.quiz.index') }}" class="btn-cancel">
        Cancel
      </a>
    </div>
  </form>
</div>

@endsection

@extends('admin.layout')

@section('title', 'Student Analysis Submissions')
@section('page_title', 'Student Analyses')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; gap: 16px; flex-wrap: wrap;">
  <form method="GET" action="{{ route('admin.student-analyses.index') }}" style="display: flex; gap: 10px; flex-grow: 1; max-width: 480px;">
    <div style="position: relative; width: 100%;">
      <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--admin-text-3);"></i>
      <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search student name, email, course, city..." style="padding-left: 38px; width: 100%;">
    </div>
    <button type="submit" class="btn" style="background: var(--admin-brand); color: #fff; padding: 0 18px; border-radius: var(--admin-radius-md);">
      Search
    </button>
  </form>

  <div style="background: var(--admin-surface); border: 1px solid var(--admin-border); padding: 9px 18px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px;">
    Total Submissions: {{ $totalCount }}
  </div>
</div>

<div class="table-card" style="background: var(--admin-surface); border: 1px solid var(--admin-border); border-radius: var(--admin-radius-lg); overflow: hidden;">
  <div style="overflow-x: auto;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Student Details</th>
          <th>Class & Stream</th>
          <th>City</th>
          <th>Target Course</th>
          <th>Aptitude Test</th>
          <th>Submitted</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($analyses as $item)
          <tr>
            <td>
              <div style="font-weight: 700; color: var(--admin-text-1);">{{ $item->full_name }}</div>
              <div style="font-size: 12px; color: var(--admin-text-3);">{{ $item->email }} &bull; {{ $item->mobile_number }}</div>
            </td>
            <td>
              <span style="font-weight: 600; color: #1e3a8a; background: #eff6ff; padding: 3px 8px; border-radius: 6px; font-size: 12px;">
                {{ $item->current_class }}
              </span>
              <div style="font-size: 12px; color: var(--admin-text-3); margin-top: 3px;">{{ $item->current_stream }}</div>
            </td>
            <td>{{ $item->city_district }}</td>
            <td style="max-width: 220px; font-weight: 500; font-size: 13px;">{{ $item->desired_admission_course }}</td>
            <td>
              @if($item->completed_aptitude_test === 'Yes')
                <span style="color: #16a34a; font-weight: 700; font-size: 12px;"><i class="fa-solid fa-circle-check"></i> Yes</span>
              @else
                <span style="color: #94a3b8; font-size: 12px;">No</span>
              @endif
            </td>
            <td style="font-size: 12.5px; color: var(--admin-text-3);">
              {{ $item->created_at->format('d M, Y') }}
              <div style="font-size: 11px;">{{ $item->created_at->diffForHumans() }}</div>
            </td>
            <td style="text-align: center;">
              <div style="display: flex; gap: 6px; justify-content: center;">
                <a href="{{ route('admin.student-analyses.show', $item->id) }}" class="btn" style="background: #eff6ff; color: #2563eb; padding: 6px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none;" title="View Full Questionnaire">
                  <i class="fa-solid fa-eye"></i> View
                </a>
                <form method="POST" action="{{ route('admin.student-analyses.destroy', $item->id) }}" onsubmit="return confirm('Delete this student analysis permanently?');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn" style="background: #fef2f2; color: #dc2626; padding: 6px 10px; border-radius: 6px; font-size: 12px; border: none; cursor: pointer;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center; color: var(--admin-text-3); padding: 40px;">
              No student analysis submissions recorded yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($analyses->hasPages())
    <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
      {{ $analyses->links() }}
    </div>
  @endif
</div>
@endsection

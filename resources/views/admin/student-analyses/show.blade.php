@extends('admin.layout')

@section('title', 'Student Analysis - ' . $analysis->full_name)
@section('page_title', 'Student Questionnaire Details')

@section('content')
<div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
  <a href="{{ route('admin.student-analyses.index') }}" class="btn" style="background: #f4f4f5; color: var(--admin-text-1); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px;">
    &larr; Back to All Submissions
  </a>
  <div style="display: flex; gap: 12px; align-items: center;">
    <div style="font-size: 13px; color: var(--admin-text-3);">
      Submitted: {{ $analysis->created_at->format('d M, Y h:i A') }} ({{ $analysis->created_at->diffForHumans() }})
    </div>
    <form method="POST" action="{{ route('admin.student-analyses.destroy', $analysis->id) }}" onsubmit="return confirm('Delete this student analysis permanently?');" style="margin: 0; display: inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
        <i class="fa-solid fa-trash"></i> Delete Analysis
      </button>
    </form>
  </div>
</div>

<div style="background: #ffffff; border: 1px solid var(--admin-border); border-radius: var(--admin-radius-lg); padding: 32px; box-shadow: var(--admin-shadow); margin-bottom: 24px;">
  <div style="border-bottom: 1px solid var(--admin-border); padding-bottom: 20px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
    <div>
      <h2 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: var(--admin-text-1);">
        {{ $analysis->full_name }}
      </h2>
      <div style="font-size: 14px; color: var(--admin-text-2); margin-top: 4px;">
        <i class="fa-solid fa-envelope"></i> {{ $analysis->email }} &bull; 
        <i class="fa-solid fa-phone"></i> {{ $analysis->mobile_number }} &bull; 
        <i class="fa-solid fa-location-dot"></i> {{ $analysis->city_district }}
      </div>
    </div>
    <div>
      <span style="display: inline-block; background: #eff6ff; color: #1e40af; padding: 6px 14px; border-radius: 999px; font-weight: 700; font-size: 13px;">
        {{ $analysis->current_class }} &bull; {{ $analysis->current_stream }}
      </span>
    </div>
  </div>

  <div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Q1 to Q9: Academic -->
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: #1e3a8a; margin-bottom: 12px; border-left: 4px solid #2563eb; padding-left: 10px;">
        1. Academic Profile & Target Courses
      </h3>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; background: #f8fafc; padding: 18px; border-radius: 12px;">
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Target Course (Q9)</div>
          <div style="font-weight: 700; color: #0f172a;">{{ $analysis->desired_admission_course }}</div>
        </div>
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Past 3-Year Results (Q7)</div>
          <div style="font-weight: 500; color: #334155;">{{ $analysis->exam_results_last_3_years }}</div>
        </div>
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Top 3 Subjects Performed Well (Q8)</div>
          <div style="font-weight: 500; color: #334155;">{{ $analysis->top_subjects_last_3_years }}</div>
        </div>
      </div>
    </div>

    <!-- Q10 to Q15: Subject Inclinations & Aptitude -->
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: #059669; margin-bottom: 12px; border-left: 4px solid #059669; padding-left: 10px;">
        2. Subject Preferences & Aptitude
      </h3>
      <div style="background: #f8fafc; padding: 18px; border-radius: 12px; display: flex; flex-direction: column; gap: 14px;">
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; margin-bottom: 6px;">Enjoyed Subjects (Q10)</div>
          <div style="display: flex; gap: 6px; flex-wrap: wrap;">
            @foreach($analysis->enjoyed_subjects ?? [] as $s)
              <span style="background: #dcfce7; color: #166534; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px;">{{ $s }}</span>
            @endforeach
          </div>
        </div>
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; margin-bottom: 6px;">Difficult / Disliked Subjects (Q11)</div>
          <div style="display: flex; gap: 6px; flex-wrap: wrap;">
            @foreach($analysis->difficult_subjects ?? [] as $s)
              <span style="background: #fee2e2; color: #991b1b; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px;">{{ $s }}</span>
            @endforeach
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 12px; border-top: 1px solid #e2e8f0; padding-top: 10px;">
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Completed Aptitude Test? (Q12)</div>
            <div style="font-weight: 700;">{{ $analysis->completed_aptitude_test }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Aptitude Scores (Q13)</div>
            <div>{{ $analysis->aptitude_test_scores ?: 'N/A' }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Uploaded Report (Q15)</div>
            @if($analysis->aptitude_report_file)
              <a href="{{ asset($analysis->aptitude_report_file) }}" target="_blank" style="color: #2563eb; font-weight: 700; text-decoration: underline;">
                <i class="fa-solid fa-file-arrow-down"></i> Download Attached Report
              </a>
            @else
              <span style="color: #94a3b8;">No file uploaded</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Q16 to Q25: Interests & Skills -->
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: #d97706; margin-bottom: 12px; border-left: 4px solid #f59e0b; padding-left: 10px;">
        3. Personal Interests, Skills & Personality
      </h3>
      <div style="background: #f8fafc; padding: 18px; border-radius: 12px; display: flex; flex-direction: column; gap: 14px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Main Interests (Q16)</div>
            <div style="font-weight: 600;">{{ $analysis->personal_interests }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Free Day Ideal Activity (Q19)</div>
            <div>{{ $analysis->free_day_preference ?: 'N/A' }}</div>
          </div>
        </div>
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; margin-bottom: 6px;">Strongest Skills (Q20)</div>
          <div style="display: flex; gap: 6px; flex-wrap: wrap;">
            @foreach($analysis->strongest_skills ?? [] as $sk)
              <span style="background: #e0f2fe; color: #0369a1; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px;">{{ $sk }}</span>
            @endforeach
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Work With Preference (Q21)</div>
            <div style="font-weight: 600;">{{ $analysis->work_with_preference }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Work Style (Q22)</div>
            <div style="font-weight: 600;">{{ $analysis->work_style }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Problem Solving Rating (Q24)</div>
            <div style="font-weight: 700; color: #2563eb;">{{ $analysis->problem_solving_rating }} / 5</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Learning Tech Rating (Q25)</div>
            <div style="font-weight: 700; color: #2563eb;">{{ $analysis->learning_tech_rating }} / 5</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Q26 to Q33: Career Fields & Environment -->
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: #7c3aed; margin-bottom: 12px; border-left: 4px solid #7c3aed; padding-left: 10px;">
        4. Career Fields, Priorities & Work Environments
      </h3>
      <div style="background: #f8fafc; padding: 18px; border-radius: 12px; display: flex; flex-direction: column; gap: 14px;">
        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; margin-bottom: 6px;">Interested Career Fields (Q26)</div>
          <div style="display: flex; gap: 6px; flex-wrap: wrap;">
            @foreach($analysis->interested_career_fields ?? [] as $cf)
              <span style="background: #f3e8ff; color: #6b21a8; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px;">{{ $cf }}</span>
            @endforeach
          </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Dream Career & Why (Q27-Q28)</div>
            <div style="font-weight: 700;">{{ $analysis->dream_career ?: 'Not specified' }}</div>
            <div style="font-size: 12px; color: #475569;">{{ $analysis->dream_career_reason }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Startup Interest (Q30)</div>
            <div style="font-weight: 600;">{{ $analysis->business_startup_interest }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Q34 to Q47: Education & Practical Considerations -->
    <div>
      <h3 style="font-size: 16px; font-weight: 700; color: #0284c7; margin-bottom: 12px; border-left: 4px solid #0284c7; padding-left: 10px;">
        5. Future Vision, Parents & Guidance Needed
      </h3>
      <div style="background: #f8fafc; padding: 18px; border-radius: 12px; display: flex; flex-direction: column; gap: 14px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Preferred Study Location (Q36)</div>
            <div style="font-weight: 600;">{{ $analysis->preferred_study_location }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Annual Education Budget (Q37)</div>
            <div style="font-weight: 600;">{{ $analysis->annual_education_budget ?: 'Not mentioned' }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Parents' Suggested Career (Q40)</div>
            <div style="font-weight: 600;">{{ $analysis->parent_suggested_career ?: 'N/A' }}</div>
          </div>
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Parent Preference Alignment (Q41)</div>
            <div style="font-weight: 600;">{{ $analysis->parent_preference_alignment }}</div>
          </div>
        </div>

        <div>
          <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Top 3 Careers / Courses Interested (Q39)</div>
          <div style="font-weight: 600; color: #0f172a; white-space: pre-line;">{{ $analysis->top_three_careers_courses }}</div>
        </div>

        @if($analysis->biggest_career_confusion)
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700;">Biggest Career Confusion (Q45)</div>
            <div style="color: #991b1b; font-weight: 600;">{{ $analysis->biggest_career_confusion }}</div>
          </div>
        @endif

        @if($analysis->help_requested)
          <div>
            <div style="font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; margin-bottom: 4px;">CareerGyan Help Requested (Q46)</div>
            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
              @foreach($analysis->help_requested as $h)
                <span style="background: #fef3c7; color: #92400e; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px;">{{ $h }}</span>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

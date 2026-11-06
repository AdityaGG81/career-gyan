@extends('admin.layout')

@section('title', 'Candidate Test Results')
@section('page_title', 'Assessment Results')

@section('styles')
<style>
  .results-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
  }

  .res-stat-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--admin-shadow);
  }

  .res-stat-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--admin-text-2);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .res-stat-value {
    font-family: 'Outfit', sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: var(--admin-text-1);
  }

  .res-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .icon-blue { background: #eff6ff; color: #2563eb; }
  .icon-emerald { background: #ecfdf5; color: #059669; }
  .icon-indigo { background: #eef2ff; color: #6366f1; }
  .icon-amber { background: #fffbeb; color: #d97706; }

  /* Tab Navigation */
  .results-tabs {
    display: flex;
    gap: 8px;
    border-bottom: 2px solid var(--admin-border);
    margin-bottom: 24px;
    padding-bottom: 2px;
    flex-wrap: wrap;
  }

  .results-tab-btn {
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px 10px 0 0;
    text-decoration: none;
    color: var(--admin-text-2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    border-bottom: 2px solid transparent;
    margin-bottom: -4px;
  }

  .results-tab-btn:hover {
    color: var(--admin-text-1);
    background: rgba(0,0,0,0.02);
  }

  .results-tab-btn.active {
    color: #2563eb;
    border-bottom-color: #2563eb;
    background: var(--admin-surface);
  }

  .tab-badge {
    padding: 2px 8px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    background: #f1f5f9;
    color: #475569;
  }

  .results-tab-btn.active .tab-badge {
    background: #eff6ff;
    color: #1d4ed8;
  }

  /* Filter bar */
  .table-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }

  .search-wrap {
    position: relative;
    flex-grow: 1;
    max-width: 420px;
  }

  .search-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-text-3);
  }

  .search-wrap input {
    padding-left: 38px;
  }

  .pill-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
  }

  .pill-aptitude { background: #ecfdf5; color: #047857; }
  .pill-analysis { background: #eff6ff; color: #1d4ed8; }
  .pill-quick { background: #fdf4ff; color: #a21caf; }

  .action-btn-sm {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
  }

  .btn-view-report {
    background: #2563eb;
    color: #ffffff;
  }
  .btn-view-report:hover {
    background: #1d4ed8;
    color: #ffffff;
    transform: translateY(-1px);
  }

  .btn-delete-report {
    background: #fee2e2;
    color: #b91c1c;
    border: none;
    cursor: pointer;
  }
  .btn-delete-report:hover {
    background: #fecaca;
  }

  .dimension-preview-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    max-width: 320px;
  }

  .dim-chip {
    font-size: 11px;
    padding: 2px 7px;
    border-radius: 4px;
    background: #f1f5f9;
    color: #334155;
    font-weight: 600;
  }

  .dim-chip.high {
    background: #dcfce7;
    color: #15803d;
  }

  .row-select-checkbox {
    width: 17px;
    height: 17px;
    cursor: pointer;
    accent-color: #2563eb;
  }
</style>
@endsection

@section('content')

@if(session('success'))
  <div class="admin-alert admin-alert-success">
    <i class="fa-solid fa-circle-check"></i>
    <span>{{ session('success') }}</span>
  </div>
@endif

<!-- Stats Header -->
<div class="results-stats-grid">
  <div class="res-stat-card">
    <div>
      <div class="res-stat-title">Total Assessments</div>
      <div class="res-stat-value">{{ number_format($totalTests) }}</div>
    </div>
    <div class="res-stat-icon icon-blue">
      <i class="fa-solid fa-square-poll-vertical"></i>
    </div>
  </div>

  <div class="res-stat-card">
    <div>
      <div class="res-stat-title">Aptitude Tests</div>
      <div class="res-stat-value" style="color: #059669;">{{ number_format($aptitudeCount) }}</div>
    </div>
    <div class="res-stat-icon icon-emerald">
      <i class="fa-solid fa-brain"></i>
    </div>
  </div>

  <div class="res-stat-card">
    <div>
      <div class="res-stat-title">Student Analyses (47-Q)</div>
      <div class="res-stat-value" style="color: #6366f1;">{{ number_format($analysisCount) }}</div>
    </div>
    <div class="res-stat-icon icon-indigo">
      <i class="fa-solid fa-clipboard-user"></i>
    </div>
  </div>

  <div class="res-stat-card">
    <div>
      <div class="res-stat-title">Quick Tests</div>
      <div class="res-stat-value" style="color: #d97706;">{{ number_format($quickCount) }}</div>
    </div>
    <div class="res-stat-icon icon-amber">
      <i class="fa-solid fa-bolt"></i>
    </div>
  </div>
</div>

<!-- Tab Navigation -->
<div class="results-tabs">
  <a href="{{ route('admin.test-results.index', ['tab' => 'aptitude']) }}" class="results-tab-btn {{ $tab === 'aptitude' ? 'active' : '' }}">
    <i class="fa-solid fa-brain"></i> Aptitude Test Sessions
    <span class="tab-badge">{{ $aptitudeCount }}</span>
  </a>
  <a href="{{ route('admin.test-results.index', ['tab' => 'analysis']) }}" class="results-tab-btn {{ $tab === 'analysis' ? 'active' : '' }}">
    <i class="fa-solid fa-clipboard-user"></i> Student Analyses (47 Questions)
    <span class="tab-badge">{{ $analysisCount }}</span>
  </a>
  <a href="{{ route('admin.test-results.index', ['tab' => 'quick']) }}" class="results-tab-btn {{ $tab === 'quick' ? 'active' : '' }}">
    <i class="fa-solid fa-bolt"></i> Quick Stream Tests
    <span class="tab-badge">{{ $quickCount }}</span>
  </a>
</div>

<!-- Toolbar -->
<div class="table-toolbar">
  <form method="GET" action="{{ route('admin.test-results.index') }}" class="search-wrap">
    <input type="hidden" name="tab" value="{{ $tab }}">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" class="form-control" placeholder="Search by student name, email, or course..." value="{{ $search }}">
  </form>

  <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    @if($search)
      <a href="{{ route('admin.test-results.index', ['tab' => $tab]) }}" class="action-btn-sm" style="background:#f1f5f9; color:#475569;">
        <i class="fa-solid fa-xmark"></i> Clear Search
      </a>
    @endif

    <button type="button" id="btnDeleteSelected" onclick="submitBulkDelete()" class="action-btn-sm" style="display: none; background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; cursor: pointer; padding: 8px 14px; font-weight: 700; border-radius: 6px;">
      <i class="fa-solid fa-trash"></i> Delete Selected (<span id="selectedCountText">0</span>)
    </button>

    <button type="button" onclick="openClearModal()" class="action-btn-sm" style="background: #ffffff; color: #475569; border: 1px solid #cbd5e1; cursor: pointer; padding: 8px 14px; font-weight: 600; border-radius: 6px;" title="Purge older test records or clear by category">
      <i class="fa-solid fa-broom"></i> Clean Up Records...
    </button>
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    @if($tab === 'aptitude')
      <!-- TAB 1: APTITUDE TESTS -->
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width: 40px; text-align: center;"><input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="row-select-checkbox" title="Select all on this page"></th>
            <th>Candidate</th>
            <th>Email / Phone</th>
            <th>Aptitude Scores Breakdown</th>
            <th>Top Matched Careers</th>
            <th>Date Taken</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($aptitudeSessions as $sess)
            @php
              $candidateName = $sess->candidate_name;
              $candidateEmail = $sess->candidate_email;
              $scores = $sess->aptitude_scores ?? [];
              $recommended = $sess->recommended_careers ?? [];
            @endphp
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" value="{{ $sess->id }}" class="row-select-checkbox item-checkbox" onchange="updateSelectedCount()">
              </td>
              <td>
                <div style="font-weight: 700; color: var(--admin-text-1);">
                  @if($sess->user_id)
                    <a href="{{ route('admin.test-results.user', $sess->user_id) }}" style="color: inherit; text-decoration: underline;">
                      {{ $candidateName }}
                    </a>
                  @else
                    {{ $candidateName }}
                  @endif
                </div>
                <div style="font-size: 11.5px; color: var(--admin-text-3);">
                  @if($sess->user_id)
                    <span class="pill-badge pill-aptitude" style="padding: 1px 6px; font-size: 10.5px;">User #{{ $sess->user_id }}</span>
                  @else
                    <span style="color: #94a3b8;">Guest Candidate</span>
                  @endif
                </div>
              </td>
              <td>
                <div style="font-size: 13.5px; color: var(--admin-text-2);">{{ $candidateEmail }}</div>
              </td>
              <td>
                <div class="dimension-preview-pills">
                  @foreach(array_slice($scores, 0, 4, true) as $dim => $sc)
                    <span class="dim-chip {{ (float)$sc >= 7.0 ? 'high' : '' }}" title="{{ ucwords(str_replace('-', ' ', $dim)) }}: {{ $sc }}/10">
                      {{ ucwords(str_replace(['-aptitude', '-reasoning'], '', $dim)) }}: {{ $sc }}/10
                    </span>
                  @endforeach
                  @if(count($scores) > 4)
                    <span class="dim-chip">+{{ count($scores) - 4 }} more</span>
                  @endif
                </div>
              </td>
              <td>
                <div style="font-size: 13px; font-weight: 600; color: var(--admin-text-1);">
                  {{ count($recommended) }} recommended careers
                </div>
                <div style="font-size: 11px; color: var(--admin-text-3);">
                  Match weights up to {{ !empty($recommended) ? max(array_values($recommended)) : 0 }}%
                </div>
              </td>
              <td>
                <div style="font-size: 13px; color: var(--admin-text-1);">{{ $sess->created_at->format('d M, Y') }}</div>
                <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $sess->created_at->format('h:i A') }}</div>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 8px;">
                  <a href="{{ route('admin.test-results.aptitude.show', $sess->uuid) }}" class="action-btn-sm btn-view-report" title="View Detailed Breakdown">
                    <i class="fa-solid fa-chart-pie"></i> View Report
                  </a>
                  <form action="{{ route('admin.test-results.aptitude.destroy', $sess->id) }}" method="POST" onsubmit="return confirm('Delete this aptitude test record?');" style="margin: 0; display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn-sm btn-delete-report" title="Delete record">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 48px; color: var(--admin-text-3);">
                <i class="fa-solid fa-brain" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                No aptitude test sessions found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      @if($aptitudeSessions->hasPages())
        <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
          {{ $aptitudeSessions->appends(['tab' => 'aptitude', 'search' => $search])->links() }}
        </div>
      @endif

    @elseif($tab === 'analysis')
      <!-- TAB 2: STUDENT ANALYSES -->
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width: 40px; text-align: center;"><input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="row-select-checkbox" title="Select all on this page"></th>
            <th>Student Name</th>
            <th>Contact Info</th>
            <th>Class & Stream</th>
            <th>Target Course</th>
            <th>Status / Archetype</th>
            <th>Submission Date</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($studentAnalyses as $analysis)
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" value="{{ $analysis->id }}" class="row-select-checkbox item-checkbox" onchange="updateSelectedCount()">
              </td>
              <td>
                <div style="font-weight: 700; color: var(--admin-text-1);">
                  @if($analysis->user_id)
                    <a href="{{ route('admin.test-results.user', $analysis->user_id) }}" style="color: inherit; text-decoration: underline;">
                      {{ $analysis->full_name }}
                    </a>
                  @else
                    {{ $analysis->full_name }}
                  @endif
                </div>
                <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $analysis->city_district }}</div>
              </td>
              <td>
                <div style="font-size: 13px;">{{ $analysis->email }}</div>
                <div style="font-size: 12px; color: var(--admin-text-3); font-weight: 600;">{{ $analysis->mobile_number }}</div>
              </td>
              <td>
                <div style="font-weight: 600; font-size: 13px; color: var(--admin-text-1);">{{ $analysis->current_class }}</div>
                <div style="font-size: 12px; color: var(--admin-text-2);">{{ $analysis->current_stream }}</div>
              </td>
              <td>
                <div style="font-size: 13px; font-weight: 600; color: #2563eb; max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $analysis->desired_admission_course }}">
                  {{ $analysis->desired_admission_course }}
                </div>
              </td>
              <td>
                <span class="pill-badge pill-analysis">
                  <i class="fa-solid fa-circle-check"></i> 47-Q Completed
                </span>
              </td>
              <td>
                <div style="font-size: 13px;">{{ $analysis->created_at->format('d M, Y') }}</div>
                <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $analysis->created_at->format('h:i A') }}</div>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 8px; justify-content: flex-end;">
                  <a href="{{ route('admin.student-analyses.show', $analysis->id) }}" class="action-btn-sm btn-view-report" title="Inspect Full 47 Questions">
                    <i class="fa-solid fa-clipboard-check"></i> Inspect 47-Q
                  </a>
                  <a href="{{ route('student-analysis.show', $analysis->uuid) }}" target="_blank" class="action-btn-sm" style="background:#f1f5f9; color:#1e293b;" title="View Student Report Page">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                  <form action="{{ route('admin.student-analyses.destroy', $analysis->id) }}" method="POST" onsubmit="return confirm('Delete this student analysis questionnaire record?');" style="margin: 0; display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn-sm btn-delete-report" title="Delete record">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align: center; padding: 48px; color: var(--admin-text-3);">
                <i class="fa-solid fa-clipboard-user" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                No student questionnaire submissions found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      @if($studentAnalyses->hasPages())
        <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
          {{ $studentAnalyses->appends(['tab' => 'analysis', 'search' => $search])->links() }}
        </div>
      @endif

    @else
      <!-- TAB 3: QUICK STREAM TESTS -->
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width: 40px; text-align: center;"><input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="row-select-checkbox" title="Select all on this page"></th>
            <th>Student</th>
            <th>Email</th>
            <th>Total Score</th>
            <th>Recommended Stream / Careers</th>
            <th>Date Taken</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($quickAttempts as $quick)
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" value="{{ $quick->id }}" class="row-select-checkbox item-checkbox" onchange="updateSelectedCount()">
              </td>
              <td style="font-weight: 700; color: var(--admin-text-1);">
                {{ $quick->student_name ?: 'Candidate #' . $quick->id }}
              </td>
              <td style="font-size: 13.5px; color: var(--admin-text-2);">
                {{ $quick->student_email ?: 'Anonymous' }}
              </td>
              <td>
                <span class="pill-badge pill-quick" style="font-weight: 800; font-size: 13px;">
                  {{ $quick->total_score ?? 'N/A' }} pts
                </span>
              </td>
              <td>
                <div style="max-width: 320px; font-size: 13px; color: var(--admin-text-1);">
                  @php
                    $recItems = $quick->recommended_careers ?? [];
                  @endphp
                  @if(is_array($recItems) && count($recItems) > 0)
                    @foreach(array_slice($recItems, 0, 3) as $r)
                      @if(is_array($r) && isset($r['section']))
                        <div style="margin-bottom: 4px;">
                          <strong style="color: #7c3aed;">{{ $r['section'] }}</strong>
                          @if(!empty($r['areas']) && is_array($r['areas']))
                            <div style="color: var(--admin-text-2); font-size: 11.5px;">
                              {{ implode(', ', array_slice($r['areas'], 0, 2)) }}
                            </div>
                          @endif
                        </div>
                      @elseif(is_string($r))
                        <span class="pill-badge pill-quick" style="margin: 2px;">{{ $r }}</span>
                      @endif
                    @endforeach
                  @elseif(is_string($recItems))
                    {{ $recItems }}
                  @else
                    <span style="color: var(--admin-text-3);">Aptitude Stream Analyzed</span>
                  @endif
                </div>
              </td>
              <td>
                <div style="font-size: 13px;">{{ $quick->created_at->format('d M, Y') }}</div>
                <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $quick->created_at->format('h:i A') }}</div>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 8px; justify-content: flex-end;">
                  <a href="{{ route('admin.test-results.quick.show', $quick->uuid) }}" class="action-btn-sm" style="background: #7c3aed; color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; font-size: 12.5px;">
                    <i class="fa-solid fa-list-check"></i> Inspect Answers &rarr;
                  </a>
                  <form action="{{ route('admin.test-results.quick.destroy', $quick->id) }}" method="POST" onsubmit="return confirm('Delete this quick test record?');" style="margin: 0; display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn-sm btn-delete-report" title="Delete record">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 48px; color: var(--admin-text-3);">
                <i class="fa-solid fa-bolt" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                No quick test attempts found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      @if($quickAttempts->hasPages())
        <div style="padding: 16px 24px; border-top: 1px solid var(--admin-border);">
          {{ $quickAttempts->appends(['tab' => 'quick', 'search' => $search])->links() }}
        </div>
      @endif
    @endif
  </div>
</div>

<!-- Hidden Bulk Delete Form -->
<form id="bulkDeleteForm" action="{{ route('admin.test-results.bulk-delete') }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="type" value="{{ $tab }}">
  <div id="bulkDeleteInputs"></div>
</form>

<!-- Clean Up Records Modal -->
<div id="clearRecordsModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
  <div style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 480px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); overflow: hidden;">
    <div style="background: #1e293b; padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-broom" style="color: #f59e0b; font-size: 18px;"></i>
        <h3 style="margin: 0; font-size: 17px; font-weight: 700;">Clean Up Test Records</h3>
      </div>
      <button type="button" onclick="closeClearModal()" style="background: none; border: none; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 4px; line-height: 1;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form action="{{ route('admin.test-results.clear') }}" method="POST" style="padding: 24px;" onsubmit="return confirm('Are you sure you want to proceed with clearing these test records? This action cannot be undone.');">
      @csrf
      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
          Select Category to Clean:
        </label>
        <select name="category" class="form-control" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13.5px;">
          <option value="{{ $tab }}" selected>Current Tab Only ({{ ucfirst($tab) }})</option>
          <option value="aptitude">Aptitude Tests Only ({{ $aptitudeCount }} total)</option>
          <option value="analysis">Student Analyses Only ({{ $analysisCount }} total)</option>
          <option value="quick">Quick Stream Tests Only ({{ $quickCount }} total)</option>
          <option value="all">All Test Categories Platform-wide ({{ $totalTests }} total)</option>
        </select>
      </div>

      <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
          Retention Age / Purge Range:
        </label>
        <select name="range" class="form-control" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13.5px;">
          <option value="older_30">Delete records older than 30 days (Recommended)</option>
          <option value="older_60">Delete records older than 60 days</option>
          <option value="older_90">Delete records older than 90 days</option>
          <option value="all" style="color: #dc2626; font-weight: 700;">⚠ Delete ALL records in selected category</option>
        </select>
        <div style="font-size: 11.5px; color: #64748b; margin-top: 6px;">
          Permanent deletion will remove matching attempts and their answersheets.
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeClearModal()" style="padding: 10px 18px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 13px; cursor: pointer;">
          Cancel
        </button>
        <button type="submit" style="padding: 10px 22px; border-radius: 8px; border: none; background: #dc2626; color: #fff; font-weight: 700; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fa-solid fa-trash"></i> Confirm Purge
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  function toggleSelectAll(master) {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach(cb => {
      cb.checked = master.checked;
    });
    updateSelectedCount();
  }

  function updateSelectedCount() {
    const checked = document.querySelectorAll('.item-checkbox:checked');
    const count = checked.length;
    const btn = document.getElementById('btnDeleteSelected');
    const text = document.getElementById('selectedCountText');
    const master = document.getElementById('selectAllCheckbox');

    if (text) text.textContent = count;
    if (btn) {
      btn.style.display = count > 0 ? 'inline-flex' : 'none';
    }

    const all = document.querySelectorAll('.item-checkbox');
    if (master && all.length > 0) {
      master.checked = count === all.length;
    }
  }

  function submitBulkDelete() {
    const checked = document.querySelectorAll('.item-checkbox:checked');
    if (checked.length === 0) return;

    if (!confirm(`Are you sure you want to permanently delete the ${checked.length} selected test record(s)?`)) {
      return;
    }

    const container = document.getElementById('bulkDeleteInputs');
    container.innerHTML = '';

    checked.forEach(cb => {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'ids[]';
      input.value = cb.value;
      container.appendChild(input);
    });

    document.getElementById('bulkDeleteForm').submit();
  }

  function openClearModal() {
    document.getElementById('clearRecordsModal').style.display = 'flex';
  }

  function closeClearModal() {
    document.getElementById('clearRecordsModal').style.display = 'none';
  }

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeClearModal();
  });
</script>
@endsection


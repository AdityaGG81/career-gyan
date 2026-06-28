@extends('admin.layout')

@section('title', 'Manage Job Corner')
@section('page_title', 'Job Corner')

@section('content')
<div class="panel-card">
    <div class="panel-header">
        <h2>Recruitment Notifications</h2>
        <a href="{{ route('admin.jobs.create') }}" style="display: flex; align-items: center; gap: 8px; background: #09090b; color: #fff; text-decoration: none; padding: 10px 18px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 13px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
            <i class="fa-solid fa-plus"></i> Add Job Notification
        </a>
    </div>

    <div class="panel-body" style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Job Details</th>
                    <th>Category</th>
                    <th>Qualification</th>
                    <th>Location</th>
                    <th>Last Date</th>
                    <th>Notification File</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--admin-text-1);">{{ $job->job_title }}</div>
                            <div style="font-size: 12px; color: var(--admin-text-3); margin-top: 2px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                                <span>{{ $job->company_name }}</span>
                                @if($job->job_type === 'both')
                                    <span style="display: inline-block; font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 4px; text-transform: uppercase; background: #ede9fe; color: #5b21b6;">
                                        Govt & Pvt
                                    </span>
                                @elseif($job->job_type === 'pvt')
                                    <span style="display: inline-block; font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 4px; text-transform: uppercase; background: #ccfbf1; color: #134e4a;">
                                        Private
                                    </span>
                                @else
                                    <span style="display: inline-block; font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 4px; text-transform: uppercase; background: #fef3c7; color: #92400e;">
                                        Govt
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span style="display: inline-block; font-size: 11.5px; font-weight: 600; padding: 3px 10px; border-radius: 999px; background: #e0f2fe; color: #0369a1;">
                                {{ $job->category }}
                            </span>
                        </td>
                        <td>{{ $job->qualification }}</td>
                        <td>{{ $job->location }}</td>
                        <td>
                            <span style="font-weight: 600; color: {{ $job->isExpired() ? '#dc2626' : 'var(--admin-text-2)' }}">
                                {{ $job->last_date->format('Y-m-d') }}
                            </span>
                        </td>
                        <td>
                            @if($job->notification_file)
                                @php
                                    $ext = strtolower(pathinfo($job->notification_file, PATHINFO_EXTENSION));
                                @endphp
                                <a href="{{ asset($job->notification_file) }}" target="_blank" style="color: #3b82f6; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 13px;">
                                    @if($ext === 'pdf')
                                        <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> PDF Document
                                    @elseif(in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <i class="fa-solid fa-file-image" style="color: #10b981;"></i> Photo Notification
                                    @else
                                        <i class="fa-solid fa-file-lines" style="color: #6b7280;"></i> Document
                                    @endif
                                </a>
                            @else
                                <span style="color: var(--admin-text-3); font-style: italic; font-size: 13px;">No File</span>
                            @endif
                        </td>
                        <td>
                            @if($job->isExpired())
                                <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; background: #fef2f2; color: #991b1b;">
                                    Expired
                                </span>
                            @elseif($job->status === 'archived')
                                <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; background: #f4f4f5; color: #71717a;">
                                    Archived
                                </span>
                            @else
                                <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; background: #f0fdf4; color: #166534;">
                                    Active
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="{{ route('admin.jobs.edit', $job->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--admin-border); color: var(--admin-text-2); background: #fff; transition: all 0.2s;" onmouseover="this.style.borderColor='#3b82f6'; this.style.color='#3b82f6'" onmouseout="this.style.borderColor='var(--admin-border)'; this.style.color='var(--admin-text-2)'" title="Edit">
                                    <i class="fa-solid fa-pen-to-square" style="font-size: 13px;"></i>
                                </a>
                                <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recruitment notification?');" style="margin: 0; display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: 1px solid #fee2e2; color: #ef4444; background: #fef2f2; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.borderColor='#f87171'" onmouseout="this.style.background='#fef2f2'; this.style.borderColor='#fee2e2'" title="Delete">
                                        <i class="fa-solid fa-trash" style="font-size: 13px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--admin-text-3); padding: 48px;">
                            <i class="fa-solid fa-briefcase" style="font-size: 32px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                            No job listings added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

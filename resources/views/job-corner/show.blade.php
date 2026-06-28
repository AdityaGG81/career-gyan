@extends('layouts.app')

@section('title', $job->job_title . ' - Job Corner')

@section('content')
<div class="section" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); padding-top: 48px; min-height: calc(100vh - 200px);">
    <div class="container">
        
        <!-- Breadcrumbs & Navigation Back -->
        <div style="margin-bottom: 24px;">
            <a href="{{ route('jobs.index') }}" style="color: var(--text-2); font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: color var(--transition);" onmouseover="this.style.color='var(--brand)'" onmouseout="this.style.color='var(--text-2)'">
                <i class="fa-solid fa-arrow-left"></i> Back to Job Corner
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 32px; align-items: start;">
            
            <!-- LEFT COLUMN: Description & Document Preview -->
            <div>
                <!-- Primary Header card -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); margin-bottom: 24px;">
                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px;">
                        @if($job->job_type === 'both')
                            <span class="tag badge-purple"><i class="fa-solid fa-briefcase"></i> Govt & Pvt</span>
                        @elseif($job->job_type === 'pvt')
                            <span class="tag badge-teal"><i class="fa-solid fa-building"></i> Private</span>
                        @else
                            <span class="tag badge-amber"><i class="fa-solid fa-building-columns"></i> Govt</span>
                        @endif
                        <span class="tag badge-blue">{{ $job->category }}</span>
                        <span class="tag badge-purple">{{ $job->qualification }}</span>
                        @if($job->isExpired())
                            <span class="tag badge-rose"><i class="fa-solid fa-circle-xmark"></i> Expired</span>
                        @else
                            <span class="tag badge-green"><i class="fa-solid fa-circle-check"></i> Open & Active</span>
                        @endif
                    </div>

                    <h1 style="font-family: 'Sora', sans-serif; font-size: clamp(20px, 3vw, 26px); font-weight: 800; color: var(--text-1); line-height: 1.25; margin-bottom: 8px;">
                        {{ $job->job_title }}
                    </h1>
                    <p style="font-size: 16px; font-weight: 600; color: var(--text-2); display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-building" style="color: var(--text-3);"></i> {{ $job->company_name }}
                    </p>
                </div>

                <!-- Description / Job Details Card -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); margin-bottom: 24px;">
                    <h2 style="font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-1); border-bottom: 2px solid var(--border); padding-bottom: 10px; margin-bottom: 16px;">
                        Recruitment Details / Description
                    </h2>
                    
                    @if($job->description)
                        <div style="font-size: 15px; color: var(--text-2); line-height: 1.7; white-space: pre-line;">
                            {{ $job->description }}
                        </div>
                    @else
                        <p style="font-style: italic; color: var(--text-3); font-size: 14px;">No detailed description provided. Please refer to the official notification document below.</p>
                    @endif
                </div>

                <!-- Document Preview / Notification Attachment Card -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm);">
                    <h2 style="font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-1); border-bottom: 2px solid var(--border); padding-bottom: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <span>Official Notification Document</span>
                        @if($job->notification_file)
                            <a href="{{ asset($job->notification_file) }}" download style="font-size: 13px; color: var(--brand); font-weight: 700; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-download"></i> Download File
                            </a>
                        @endif
                    </h2>

                    @if($job->notification_file)
                        @php
                            $extension = strtolower(pathinfo($job->notification_file, PATHINFO_EXTENSION));
                        @endphp

                        @if($extension === 'pdf')
                            <!-- PDF Preview -->
                            <div style="border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; background: #f8fafc; height: 500px;">
                                <iframe src="{{ asset($job->notification_file) }}" style="width: 100%; height: 100%; border: none;"></iframe>
                            </div>
                        @elseif(in_array($extension, ['jpg', 'jpeg', 'png']))
                            <!-- Image Preview -->
                            <div style="border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; text-align: center; background: #f8fafc; padding: 20px;">
                                <img src="{{ asset($job->notification_file) }}" alt="Notification Photo" style="max-height: 500px; margin: 0 auto; display: block; box-shadow: var(--shadow-md);">
                            </div>
                        @else
                            <!-- Doc/Docx (No preview, download only) -->
                            <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px; text-align: center; background: #f8fafc;">
                                <i class="fa-solid fa-file-word" style="font-size: 48px; color: #1e3a8a; margin-bottom: 16px;"></i>
                                <h4 style="font-family: 'Sora', sans-serif; font-size: 16px; margin-bottom: 8px; color: var(--text-1);">Word Document Attached</h4>
                                <p style="font-size: 13px; color: var(--text-2); margin-bottom: 16px;">Preview is not supported for Word files. Please download and view the document offline.</p>
                                <a href="{{ asset($job->notification_file) }}" download 
                                    style="display: inline-flex; align-items: center; gap: 8px; background: var(--brand); color: #fff; padding: 10px 20px; font-weight: 700; font-size: 14px; border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                                    <i class="fa-solid fa-download"></i> Download Notification
                                </a>
                            </div>
                        @endif
                    @else
                        <!-- No file attached -->
                        <div style="border: 1px dashed var(--border); border-radius: var(--radius-md); padding: 40px; text-align: center; color: var(--text-3);">
                            <i class="fa-solid fa-file-invoice" style="font-size: 40px; margin-bottom: 12px; opacity: 0.5;"></i>
                            <p style="font-size: 14px;">No official notification document has been uploaded for this posting.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- RIGHT COLUMN: Highlights Card & Actions -->
            <div style="position: sticky; top: 100px;">
                
                <!-- Quick Info Box -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow-sm); margin-bottom: 24px;">
                    <h3 style="font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: var(--text-1); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">
                        Job Overview
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 14px; font-size: 14px;">
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">ORGANIZATION</span>
                            <span style="color: var(--text-1); font-weight: 700;">{{ $job->company_name }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">CATEGORY</span>
                            <span style="color: var(--text-1); font-weight: 700;">{{ $job->category }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">MINIMUM QUALIFICATION</span>
                            <span style="color: var(--text-1); font-weight: 700;">{{ $job->qualification }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">LOCATION</span>
                            <span style="color: var(--text-1); font-weight: 700;">{{ $job->location }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">POSTED DATE</span>
                            <span style="color: var(--text-1); font-weight: 700;">{{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-3); font-size: 12px; display: block; font-weight: 600;">LAST DATE TO APPLY</span>
                            <span style="color: {{ $job->isExpired() ? '#b91c1c' : 'var(--text-1)' }}; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-calendar-xmark"></i> {{ $job->last_date->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Button Block -->
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @if($job->isExpired())
                        <button disabled 
                            style="width: 100%; height: 50px; background: #e2e8f0; color: #94a3b8; font-weight: 700; font-size: 15px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; cursor: not-allowed;">
                            <i class="fa-solid fa-ban"></i> Application Closed
                        </button>
                    @elseif($job->apply_link)
                        <a href="{{ $job->apply_link }}" target="_blank" 
                            style="width: 100%; height: 50px; background: linear-gradient(135deg, #1e3a8a, #1d4ed8); color: #ffffff; font-weight: 700; font-size: 15px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: var(--shadow-sm); transition: transform var(--transition);"
                            onmouseover="this.style.transform='translateY(-1px)'"
                            onmouseout="this.style.transform='translateY(0)'">
                            <i class="fa-solid fa-paper-plane" style="color: #fbbf24;"></i> Apply Online <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 12px;"></i>
                        </a>
                    @else
                        <button disabled 
                            style="width: 100%; height: 50px; background: #f1f5f9; color: var(--text-2); font-weight: 700; font-size: 14px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid var(--border);">
                            <i class="fa-solid fa-circle-exclamation"></i> Link Not Released Yet
                        </button>
                    @endif
                    
                    @if($job->notification_file)
                        <a href="{{ asset($job->notification_file) }}" download 
                            style="width: 100%; height: 48px; background: #ffffff; color: var(--text-1); border: 1px solid var(--border); font-weight: 700; font-size: 14px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; transition: background var(--transition);"
                            onmouseover="this.style.background='#f8fafc'"
                            onmouseout="this.style.background='#ffffff'">
                            <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> Download Notification
                        </a>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

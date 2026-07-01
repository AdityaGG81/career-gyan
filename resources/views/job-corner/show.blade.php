@extends('layouts.app')

@section('title', $job->job_title . ' - Job Corner')

@section('styles')
<style>
  .job-detail-wrapper {
    background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    padding-top: 48px;
    min-height: calc(100vh - 200px);
  }

  .job-detail-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 32px;
    align-items: start;
  }

  .job-detail-main {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .job-detail-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px;
    box-shadow: var(--shadow-sm);
  }

  .job-detail-header-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px;
    box-shadow: var(--shadow-sm);
    margin-bottom: 0;
  }

  .job-detail-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .job-detail-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(20px, 3vw, 26px);
    font-weight: 800;
    color: var(--text-1);
    line-height: 1.25;
    margin-bottom: 8px;
  }

  .job-detail-company {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-2);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .job-detail-company i {
    color: var(--text-3);
  }

  .job-detail-section-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-1);
    border-bottom: 2px solid var(--border);
    padding-bottom: 10px;
    margin-bottom: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .job-detail-description {
    font-size: 15px;
    color: var(--text-2);
    line-height: 1.7;
    white-space: pre-line;
  }

  .pdf-preview-container {
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    background: #f8fafc;
    height: 500px;
  }

  .image-preview-container {
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    text-align: center;
    background: #f8fafc;
    padding: 20px;
  }

  .image-preview-container img {
    max-height: 500px;
    max-width: 100%;
    margin: 0 auto;
    display: block;
    box-shadow: var(--shadow-md);
  }

  .word-doc-container {
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 32px;
    text-align: center;
    background: #f8fafc;
  }

  .word-doc-container i {
    font-size: 48px;
    color: #1e3a8a;
    margin-bottom: 16px;
  }

  .no-doc-container {
    border: 1px dashed var(--border);
    border-radius: var(--radius-md);
    padding: 40px;
    text-align: center;
    color: var(--text-3);
  }

  .no-doc-container i {
    font-size: 40px;
    margin-bottom: 12px;
    opacity: 0.5;
  }

  /* Sidebar styling */
  .job-detail-sidebar {
    position: sticky;
    top: 100px;
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .job-overview-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-sm);
  }

  .job-overview-title {
    font-family: 'Sora', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-1);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 16px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 8px;
  }

  .job-overview-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    font-size: 14px;
  }

  .job-overview-item-label {
    color: var(--text-3);
    font-size: 12px;
    display: block;
    font-weight: 600;
  }

  .job-overview-item-value {
    color: var(--text-1);
    font-weight: 700;
  }

  .job-actions-block {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .btn-apply-online {
    width: 100%;
    height: 50px;
    background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
    color: #ffffff;
    font-weight: 700;
    font-size: 15px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition);
    text-decoration: none;
  }

  .btn-apply-online:hover {
    transform: translateY(-1px);
    color: #ffffff;
  }

  .btn-download-pdf {
    width: 100%;
    height: 48px;
    background: #ffffff;
    color: var(--text-1);
    border: 1px solid var(--border);
    font-weight: 700;
    font-size: 14px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background var(--transition);
    text-decoration: none;
  }

  .btn-download-pdf:hover {
    background: #f8fafc;
  }

  /* ══════════════════════════════════════════════
     RESPONSIVE — TABLET & MOBILE (≤ 991px)
     ══════════════════════════════════════════════ */
  @media (max-width: 991px) {
    .job-detail-layout {
      grid-template-columns: 1fr;
      gap: 24px;
    }

    .job-detail-sidebar {
      position: relative;
      top: 0;
    }
  }

  @media (max-width: 768px) {
    .job-detail-wrapper {
      padding-top: 24px;
    }

    .job-detail-card, .job-detail-header-card {
      padding: 20px;
    }

    .pdf-preview-container {
      height: 350px;
    }
  }

  @media (max-width: 480px) {
    .pdf-preview-container {
      height: 250px;
    }
  }
</style>
@endsection

@section('content')
<div class="section job-detail-wrapper">
    <div class="container">
        
        <!-- Breadcrumbs & Navigation Back -->
        <div style="margin-bottom: 24px;">
            <a href="{{ route('jobs.index') }}" style="color: var(--text-2); font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: color var(--transition);" onmouseover="this.style.color='var(--brand)'" onmouseout="this.style.color='var(--text-2)'">
                <i class="fa-solid fa-arrow-left"></i> Back to Job Corner
            </a>
        </div>

        <div class="job-detail-layout">
            
            <!-- LEFT COLUMN: Description & Document Preview -->
            <div class="job-detail-main">
                <!-- Primary Header card -->
                <div class="job-detail-header-card">
                    <div class="job-detail-badges">
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

                    <h1 class="job-detail-title">
                        {{ $job->job_title }}
                    </h1>
                    <p class="job-detail-company">
                        <i class="fa-solid fa-building"></i> {{ $job->company_name }}
                    </p>
                </div>

                <!-- Description / Job Details Card -->
                <div class="job-detail-card">
                    <h2 class="job-detail-section-title">
                        Recruitment Details / Description
                    </h2>
                    
                    @if($job->description)
                        <div class="job-detail-description">
                            {{ $job->description }}
                        </div>
                    @else
                        <p style="font-style: italic; color: var(--text-3); font-size: 14px;">No detailed description provided. Please refer to the official notification document below.</p>
                    @endif
                </div>

                <!-- Document Preview / Notification Attachment Card -->
                <div class="job-detail-card">
                    <h2 class="job-detail-section-title">
                        <span>Official Notification Document</span>
                        @if($job->notification_file)
                            <a href="{{ asset($job->notification_file) }}" download style="font-size: 13px; color: var(--brand); font-weight: 700; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-download"></i> Download
                            </a>
                        @endif
                    </h2>

                    @if($job->notification_file)
                        @php
                            $extension = strtolower(pathinfo($job->notification_file, PATHINFO_EXTENSION));
                        @endphp

                        @if($extension === 'pdf')
                            <!-- PDF Preview -->
                            <div class="pdf-preview-container">
                                <iframe src="{{ asset($job->notification_file) }}" style="width: 100%; height: 100%; border: none;"></iframe>
                            </div>
                        @elseif(in_array($extension, ['jpg', 'jpeg', 'png']))
                            <!-- Image Preview -->
                            <div class="image-preview-container">
                                <img src="{{ asset($job->notification_file) }}" alt="Notification Photo">
                            </div>
                        @else
                            <!-- Doc/Docx (No preview, download only) -->
                            <div class="word-doc-container">
                                <i class="fa-solid fa-file-word"></i>
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
                        <div class="no-doc-container">
                            <i class="fa-solid fa-file-invoice"></i>
                            <p style="font-size: 14px;">No official notification document has been uploaded for this posting.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- RIGHT COLUMN: Highlights Card & Actions -->
            <div class="job-detail-sidebar">
                
                <!-- Quick Info Box -->
                <div class="job-overview-card">
                    <h3 class="job-overview-title">
                        Job Overview
                    </h3>

                    <div class="job-overview-list">
                        <div>
                            <span class="job-overview-item-label">ORGANIZATION</span>
                            <span class="job-overview-item-value">{{ $job->company_name }}</span>
                        </div>
                        <div>
                            <span class="job-overview-item-label">CATEGORY</span>
                            <span class="job-overview-item-value">{{ $job->category }}</span>
                        </div>
                        <div>
                            <span class="job-overview-item-label">MINIMUM QUALIFICATION</span>
                            <span class="job-overview-item-value">{{ $job->qualification }}</span>
                        </div>
                        <div>
                            <span class="job-overview-item-label">LOCATION</span>
                            <span class="job-overview-item-value">{{ $job->location }}</span>
                        </div>
                        <div>
                            <span class="job-overview-item-label">POSTED DATE</span>
                            <span class="job-overview-item-value">{{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="job-overview-item-label">LAST DATE TO APPLY</span>
                            <span class="job-overview-item-value" style="color: {{ $job->isExpired() ? '#b91c1c' : 'var(--text-1)' }}; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-solid fa-calendar-xmark"></i> {{ $job->last_date->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Button Block -->
                <div class="job-actions-block">
                    @if($job->isExpired())
                        <button disabled 
                            style="width: 100%; height: 50px; background: #e2e8f0; color: #94a3b8; font-weight: 700; font-size: 15px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; cursor: not-allowed; border: none;">
                            <i class="fa-solid fa-ban"></i> Application Closed
                        </button>
                    @elseif($job->apply_link)
                        <a href="{{ $job->apply_link }}" target="_blank" class="btn-apply-online">
                            <i class="fa-solid fa-paper-plane" style="color: #fbbf24;"></i> Apply Online <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 12px;"></i>
                        </a>
                    @else
                        <button disabled 
                            style="width: 100%; height: 50px; background: #f1f5f9; color: var(--text-2); font-weight: 700; font-size: 14px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid var(--border);">
                            <i class="fa-solid fa-circle-exclamation"></i> Link Not Released Yet
                        </button>
                    @endif
                    
                    @if($job->notification_file)
                        <a href="{{ asset($job->notification_file) }}" download class="btn-download-pdf">
                            <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> Download Notification
                        </a>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

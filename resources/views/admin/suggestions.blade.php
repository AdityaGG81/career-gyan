@extends('layouts.app')

@section('title', 'Admin - Platform Suggestions')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 700; color: var(--text-1); margin-bottom: 5px;">
                Platform Suggestions
            </h1>
            <p style="color: var(--text-2); font-size: 15px;">Manage and view feedback shared by users.</p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="background: var(--brand-light); color: var(--brand); padding: 8px 16px; border-radius: var(--radius-md); font-weight: 600;">
                Total: {{ $suggestions->count() }}
            </div>
            <a href="{{ route('admin.logout') }}" style="background: #fef2f2; color: #b91c1c; padding: 8px 16px; border-radius: var(--radius-md); font-weight: 600; text-decoration: none; font-size: 14px; border: 1px solid #fecaca; transition: all 0.2s;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <div style="background: #fff; border-radius: var(--radius-xl); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow-sm);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid var(--border);">
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">User Info</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Role</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Suggestion</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suggestions as $sug)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px;">
                            <div style="font-weight: 600; color: var(--text-1);">{{ $sug->name ?: 'Anonymous' }}</div>
                            <div style="font-size: 13px; color: var(--text-3);">{{ $sug->email ?: 'No Email' }}</div>
                        </td>
                        <td style="padding: 16px;">
                            <span style="background: var(--brand-light); color: var(--brand); padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700;">
                                {{ $sug->role }}
                            </span>
                        </td>
                        <td style="padding: 16px; font-size: 14px; color: var(--text-2); max-width: 400px; line-height: 1.5;">
                            {{ $sug->message }}
                        </td>
                        <td style="padding: 16px; font-size: 13px; color: var(--text-3);">
                            {{ $sug->created_at->format('d M, Y') }}
                            <div style="font-size: 11px;">{{ $sug->created_at->format('h:i A') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-3);">
                            No suggestions found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

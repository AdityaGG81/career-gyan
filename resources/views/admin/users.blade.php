@extends('layouts.app')

@section('title', 'Admin - Registered Users')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 700; color: var(--text-1); margin-bottom: 5px;">
                Registered Users
            </h1>
            <p style="color: var(--text-2); font-size: 15px;">Manage and view users who have signed up on the platform.</p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center;">
            <a href="{{ route('admin.suggestions') }}" style="background: var(--surface); color: var(--text-2); padding: 8px 16px; border-radius: var(--radius-md); font-weight: 600; text-decoration: none; font-size: 14px; border: 1px solid var(--border); transition: all 0.2s;">
                <i class="fa-solid fa-lightbulb"></i> View Suggestions
            </a>
            <div style="background: var(--brand-light); color: var(--brand); padding: 8px 16px; border-radius: var(--radius-md); font-weight: 600;">
                Total: {{ $users->count() }}
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
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Name</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Email</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Phone</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 700; color: var(--text-2); text-transform: uppercase; letter-spacing: 0.05em;">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 16px;">
                            <div style="font-weight: 600; color: var(--text-1);">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div style="font-size: 13px; color: var(--text-3);">ID: {{ $user->id }}</div>
                        </td>
                        <td style="padding: 16px; font-size: 14px; color: var(--text-2);">
                            {{ $user->email }}
                        </td>
                        <td style="padding: 16px; font-size: 14px; color: var(--text-2);">
                            {{ $user->phone ?: 'Not Provided' }}
                        </td>
                        <td style="padding: 16px; font-size: 13px; color: var(--text-3);">
                            {{ $user->created_at->format('d M, Y') }}
                            <div style="font-size: 11px;">{{ $user->created_at->format('h:i A') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-3);">
                            No users have signed up yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

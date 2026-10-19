@extends('admin.layout')

@section('title', 'Manage Business Corner')
@section('page_title', 'Business Corner')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
    <div style="display: flex; gap: 16px; align-items: center;">
        <div style="background: #ffffff; padding: 12px 20px; border-radius: 12px; border: 1px solid var(--admin-border); display: flex; align-items: center; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div>
                <div style="font-size: 11px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Total Businesses</div>
                <div style="font-size: 20px; font-weight: 800; color: var(--admin-text-1);">{{ $totalCount }}</div>
            </div>
        </div>

        <div style="background: #ffffff; padding: 12px 20px; border-radius: 12px; border: 1px solid var(--admin-border); display: flex; align-items: center; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <div style="font-size: 11px; font-weight: 700; color: var(--admin-text-3); text-transform: uppercase;">Categories</div>
                <div style="font-size: 20px; font-weight: 800; color: var(--admin-text-1);">{{ $categoryCount }}</div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.businesses.create') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #09090b; color: #ffffff; text-decoration: none; padding: 11px 20px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 13.5px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); transition: background 0.2s;" onmouseover="this.style.background='#27272a'" onmouseout="this.style.background='#09090b'">
        <i class="fa-solid fa-plus"></i> Add Business Opportunity
    </a>
</div>

<!-- Search & Filters -->
<div class="panel-card" style="margin-bottom: 24px; padding: 18px 24px;">
    <form method="GET" action="{{ route('admin.businesses.index') }}" style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 240px; position: relative;">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--admin-text-3); font-size: 14px;"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, skills, category..." class="form-control" style="padding-left: 38px; width: 100%;">
        </div>

        <div style="min-width: 180px;">
            <select name="category" class="form-control" style="background: #ffffff;" onchange="this.form.submit()">
                <option value="all">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div style="min-width: 140px;">
            <select name="risk" class="form-control" style="background: #ffffff;" onchange="this.form.submit()">
                <option value="all">All Risk Levels</option>
                <option value="Low" {{ request('risk') == 'Low' ? 'selected' : '' }}>Low Risk</option>
                <option value="Medium" {{ request('risk') == 'Medium' ? 'selected' : '' }}>Medium Risk</option>
                <option value="High" {{ request('risk') == 'High' ? 'selected' : '' }}>High Risk</option>
            </select>
        </div>

        <button type="submit" style="padding: 10px 18px; background: #2563eb; color: #fff; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 13px; border: none; cursor: pointer;">
            Filter
        </button>

        @if(request()->hasAny(['search', 'category', 'risk']))
            <a href="{{ route('admin.businesses.index') }}" style="padding: 10px 14px; color: var(--admin-text-2); font-size: 13px; text-decoration: none; font-weight: 500;">
                Reset
            </a>
        @endif
    </form>
</div>

<!-- Business Opportunities Table -->
<div class="panel-card">
    <div class="panel-header">
        <h2>Business Directory</h2>
        <span style="font-size: 13px; color: var(--admin-text-3);">Showing {{ $businesses->count() }} of {{ $businesses->total() }} entries</span>
    </div>

    <div class="panel-body" style="overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="min-width: 220px;">Business Opportunity</th>
                    <th>Category</th>
                    <th>Initial Investment</th>
                    <th>Profit & Risk</th>
                    <th style="min-width: 200px;">Required Skills (Hard)</th>
                    <th style="min-width: 180px;">Soft Skills</th>
                    <th>Status</th>
                    <th style="text-align: right; min-width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($businesses as $item)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f1f5f9; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; margin-top: 2px;">
                                    <i class="fa-solid {{ $item->icon ?: 'fa-store' }}"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: var(--admin-text-1); font-size: 14px;">{{ $item->name }}</div>
                                    <div style="font-size: 12px; color: var(--admin-text-3); margin-top: 2px; line-height: 1.4;">
                                        {{ Str::limit($item->description, 75) }}
                                    </div>
                                    @if($item->break_even_period)
                                        <div style="font-size: 11px; color: #0284c7; margin-top: 3px; font-weight: 600;">
                                            <i class="fa-regular fa-clock"></i> Break-even: {{ $item->break_even_period }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $catColors = [
                                    'Retail' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                    'Wholesale' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                    'IT & Software' => ['bg' => '#ede9fe', 'text' => '#5b21b6'],
                                    'Electronics' => ['bg' => '#e0e7ff', 'text' => '#3730a3'],
                                    'Food & Hospitality' => ['bg' => '#ffedd5', 'text' => '#9a3412'],
                                    'Manufacturing & Production' => ['bg' => '#f1f5f9', 'text' => '#334155'],
                                    'Education & Services' => ['bg' => '#ccfbf1', 'text' => '#115e59'],
                                    'Agriculture & Allied' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                ];
                                $cStyle = $catColors[$item->category] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 999px; background: {{ $cStyle['bg'] }}; color: {{ $cStyle['text'] }}; white-space: nowrap;">
                                {{ $item->category }}
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #0f172a; font-size: 13.5px;">
                                {{ $item->effective_investment }}
                            </div>
                            <div style="font-size: 11px; color: var(--admin-text-3);">
                                Launch in: {{ $item->start_time ?: '2-4 Weeks' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; font-size: 12.5px; color: #166534;">
                                Margin: {{ $item->profit_margin ?: '20% - 35%' }}
                            </div>
                            @if(strtolower($item->risk_level) === 'low')
                                <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase; background: #dcfce7; color: #15803d; margin-top: 4px;">
                                    Low Risk
                                </span>
                            @elseif(strtolower($item->risk_level) === 'medium')
                                <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase; background: #fef9c3; color: #a16207; margin-top: 4px;">
                                    Med Risk
                                </span>
                            @else
                                <span style="display: inline-block; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase; background: #fee2e2; color: #b91c1c; margin-top: 4px;">
                                    High Risk
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                @forelse(array_slice($item->skills_list, 0, 3) as $skill)
                                    <span style="font-size: 11px; background: #f8fafc; border: 1px solid #e2e8f0; color: #334155; padding: 2px 7px; border-radius: 6px; font-weight: 500;">
                                        {{ $skill }}
                                    </span>
                                @empty
                                    <span style="color: var(--admin-text-3); font-size: 12px; font-style: italic;">Not specified</span>
                                @endforelse
                                @if(count($item->skills_list) > 3)
                                    <span style="font-size: 10px; color: #64748b; font-weight: 700; align-self: center;">
                                        +{{ count($item->skills_list) - 3 }} more
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                @forelse(array_slice($item->soft_skills_list, 0, 3) as $soft)
                                    <span style="font-size: 11px; background: #fdf2f8; border: 1px solid #fbcfe8; color: #9d174d; padding: 2px 7px; border-radius: 6px; font-weight: 500;">
                                        {{ $soft }}
                                    </span>
                                @empty
                                    <span style="color: var(--admin-text-3); font-size: 12px; font-style: italic;">Not specified</span>
                                @endforelse
                                @if(count($item->soft_skills_list) > 3)
                                    <span style="font-size: 10px; color: #9d174d; font-weight: 700; align-self: center;">
                                        +{{ count($item->soft_skills_list) - 3 }} more
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($item->status === 'active')
                                <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 99px; background: #f0fdf4; color: #166534;">
                                    Active
                                </span>
                            @else
                                <span style="display: inline-block; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 99px; background: #f4f4f5; color: #71717a;">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="{{ route('admin.businesses.edit', $item->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--admin-border); color: var(--admin-text-2); background: #ffffff; transition: all 0.2s;" onmouseover="this.style.borderColor='#2563eb'; this.style.color='#2563eb'" onmouseout="this.style.borderColor='var(--admin-border)'; this.style.color='var(--admin-text-2)'" title="Edit">
                                    <i class="fa-solid fa-pen-to-square" style="font-size: 13px;"></i>
                                </a>
                                <form action="{{ route('admin.businesses.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this business opportunity?');" style="margin: 0; display: inline-block;">
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
                        <td colspan="8" style="text-align: center; color: var(--admin-text-3); padding: 50px;">
                            <i class="fa-solid fa-briefcase" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.4;"></i>
                            No business opportunities found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($businesses->hasPages())
        <div style="padding: 20px 24px; border-top: 1px solid var(--admin-border);">
            {{ $businesses->links() }}
        </div>
    @endif
</div>
@endsection

<li class="tree-node-item">
  <div class="node-card {{ !empty($isRoot) ? 'root-card' : '' }}" onclick="openUserModal({{ $node['id'] }})">
    @if(!empty($node['children']) && count($node['children']) > 0)
      <button type="button" class="btn-toggle-branch" onclick="toggleBranch(this, event)" title="Toggle Branch">
        <i class="fa-solid fa-minus"></i>
      </button>
    @else
      <span style="width: 14px; height: 14px; border-radius: 50%; background: #e4e4e7; display: inline-block;"></span>
    @endif

    <div class="node-avatar" style="{{ !empty($isRoot) ? 'background: #2563eb;' : '' }}">
      {{ strtoupper(substr($node['name'], 0, 1)) }}
    </div>

    <div class="node-info-main">
      <div class="name">
        <span>{{ $node['name'] }}</span>
        <span style="font-size: 11px; font-weight: normal; color: var(--admin-text-3);">#{{ $node['id'] }}</span>
        <span style="font-family: monospace; font-size: 11px; background: #f4f4f5; padding: 2px 6px; border-radius: 4px; color: #2563eb;">
          {{ $node['referral_code'] }}
        </span>
      </div>
      <div class="meta">
        Joined {{ $node['created_at'] }}
      </div>
    </div>

    <div style="display: flex; gap: 6px; margin-left: 8px;">
      <span class="badge-metric direct" title="Direct Friends Referred">
        <i class="fa-solid fa-user-plus"></i> Direct: {{ $node['direct_count'] }}
      </span>
      <span class="badge-metric chain" title="Total Descendants in Referral Chain">
        <i class="fa-solid fa-network-wired"></i> Chain: {{ $node['descendants_count'] }}
      </span>
      <span class="badge-metric pts" title="Points Balance">
        <i class="fa-solid fa-coins"></i> {{ number_format($node['points_balance']) }} pts
      </span>
    </div>
  </div>

  @if(!empty($node['children']) && count($node['children']) > 0)
    <ul class="tree-node-list">
      @foreach($node['children'] as $child)
        @include('admin.referrals.partials.tree_node', ['node' => $child, 'isRoot' => false])
      @endforeach
    </ul>
  @endif
</li>


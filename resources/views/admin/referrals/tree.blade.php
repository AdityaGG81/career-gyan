@extends('admin.layout')

@section('title', 'Referral Genealogy Tree Tracking')

@section('styles')
<style>
  .admin-subnav {
    display: flex;
    gap: 10px;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--admin-border);
    padding-bottom: 12px;
    flex-wrap: wrap;
  }

  .admin-subnav a {
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    color: var(--admin-text-2);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
  }

  .admin-subnav a:hover {
    background: #e4e4e7;
    color: var(--admin-text-1);
  }

  .admin-subnav a.active {
    background: #18181b;
    color: #ffffff;
    font-weight: 700;
  }

  /* Tree Styles */
  .genealogy-wrapper {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 32px;
    box-shadow: var(--admin-shadow);
    min-height: 500px;
    overflow-x: auto;
  }

  .tree-node-list {
    list-style: none;
    padding-left: 28px;
    position: relative;
  }

  .tree-node-list.root-list {
    padding-left: 0;
  }

  .tree-node-list::before {
    content: '';
    position: absolute;
    left: 12px;
    top: 0;
    bottom: 20px;
    width: 2px;
    background: #e4e4e7;
  }

  .tree-node-list.root-list::before {
    display: none;
  }

  .tree-node-item {
    position: relative;
    margin: 14px 0;
  }

  .tree-node-item::before {
    content: '';
    position: absolute;
    left: -16px;
    top: 22px;
    width: 16px;
    height: 2px;
    background: #e4e4e7;
  }

  .root-list > .tree-node-item::before {
    display: none;
  }

  .node-card {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    background: #ffffff;
    border: 1.5px solid var(--admin-border);
    border-radius: 12px;
    padding: 10px 18px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
  }

  .node-card:hover {
    border-color: #2563eb;
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12);
    transform: translateY(-2px);
  }

  .node-card.root-card {
    background: linear-gradient(135deg, #f8fafc, #eff6ff);
    border-color: #93c5fd;
  }

  .node-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #18181b;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
  }

  .node-info-main .name {
    font-size: 14px;
    font-weight: 700;
    color: var(--admin-text-1);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .node-info-main .meta {
    font-size: 12px;
    color: var(--admin-text-3);
    margin-top: 2px;
  }

  .badge-metric {
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 6px;
  }

  .badge-metric.direct {
    background: #e0f2fe;
    color: #0369a1;
  }

  .badge-metric.chain {
    background: #fef3c7;
    color: #92400e;
  }

  .badge-metric.pts {
    background: #dcfce7;
    color: #15803d;
  }

  .btn-toggle-branch {
    background: #f4f4f5;
    border: 1px solid var(--admin-border);
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    color: var(--admin-text-2);
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-toggle-branch:hover {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
  }

  /* Modal Details */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(4px);
  }

  .modal-overlay.active {
    display: flex;
  }

  .modal-card {
    background: #ffffff;
    border-radius: var(--admin-radius-xl);
    width: 100%;
    max-width: 580px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    overflow: hidden;
    animation: modalSlide 0.25s ease-out;
  }

  @keyframes modalSlide {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .modal-header {
    padding: 20px 24px;
    background: #f8fafc;
    border-bottom: 1px solid var(--admin-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>
@endsection

@section('content')
<div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
  <div>
    <h1 class="page-title"><i class="fa-solid fa-sitemap" style="color: #3b82f6;"></i> Referral Chain & Genealogy Tracking</h1>
    <p style="font-size: 14px; color: var(--admin-text-2); margin-top: 4px;">Track who referred whom across infinite depth. Direct referrals only receive the 100-point reward.</p>
  </div>
  <div style="display: flex; gap: 10px;">
    <button type="button" class="btn-primary" onclick="expandAllBranches()" style="background: #ffffff; color: var(--admin-text-1); border: 1px solid var(--admin-border); padding: 8px 16px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13px; cursor: pointer;">
      <i class="fa-solid fa-expand"></i> Expand All
    </button>
    <button type="button" class="btn-primary" onclick="collapseAllBranches()" style="background: #ffffff; color: var(--admin-text-1); border: 1px solid var(--admin-border); padding: 8px 16px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13px; cursor: pointer;">
      <i class="fa-solid fa-compress"></i> Collapse All
    </button>
  </div>
</div>

{{-- Subnavigation Tabs --}}
<div class="admin-subnav">
  <a href="{{ route('admin.referrals.index') }}">
    <i class="fa-solid fa-table-list"></i> All Referrals & Overview
  </a>
  <a href="{{ route('admin.referrals.tree') }}" class="active">
    <i class="fa-solid fa-sitemap"></i> Referral Genealogy Tree
  </a>
  <a href="{{ route('admin.referrals.user-rewards') }}">
    <i class="fa-solid fa-user-gear"></i> Student Reward Management
  </a>
  <a href="{{ route('admin.referrals.reports') }}">
    <i class="fa-solid fa-chart-column"></i> Analytics & Reports
  </a>
</div>

{{-- Search for any student to view their complete tree --}}
<div style="background: var(--admin-surface); border: 1px solid var(--admin-border); border-radius: var(--admin-radius-lg); padding: 18px 24px; margin-bottom: 24px; box-shadow: var(--admin-shadow);">
  <form method="GET" action="{{ route('admin.referrals.tree') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 280px; position: relative;">
      <i class="fa-solid fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--admin-text-3);"></i>
      <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search user by name, email, referral code or user ID..." style="padding-left: 40px;">
    </div>
    <button type="submit" style="background: #18181b; color: #ffffff; padding: 10px 20px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px; border: none; cursor: pointer;">
      Search Tree
    </button>
    @if($search)
      <a href="{{ route('admin.referrals.tree') }}" style="background: #f4f4f5; color: var(--admin-text-1); padding: 10px 16px; border-radius: var(--admin-radius-md); font-weight: 600; font-size: 13px; text-decoration: none;">
        Clear Filter
      </a>
    @endif
  </form>
</div>

{{-- Interactive Genealogy Tree Area --}}
<div class="genealogy-wrapper">
  @if(empty($treeData))
    <div style="text-align: center; padding: 60px 20px; color: var(--admin-text-3);">
      <i class="fa-solid fa-diagram-project" style="font-size: 48px; margin-bottom: 16px; opacity: 0.4;"></i>
      <h3 style="font-size: 18px; color: var(--admin-text-1); margin-bottom: 6px;">No Referral Tree Nodes Found</h3>
      <p style="font-size: 14px;">Try searching for another student name, email, or referral code.</p>
    </div>
  @else
    <ul class="tree-node-list root-list" id="genealogyRoot">
      @foreach($treeData as $rootNode)
        @include('admin.referrals.partials.tree_node', ['node' => $rootNode, 'isRoot' => true])
      @endforeach
    </ul>
  @endif
</div>

{{-- Quick Details Modal --}}
<div class="modal-overlay" id="userModal">
  <div class="modal-card">
    <div class="modal-header">
      <div style="display: flex; align-items: center; gap: 12px;">
        <div style="width: 36px; height: 36px; border-radius: 50%; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700;" id="mAvatar">
          U
        </div>
        <div>
          <h3 style="font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; color: var(--admin-text-1);" id="mName">User Name</h3>
          <span style="font-size: 12px; color: var(--admin-text-3);" id="mEmail">user@example.com</span>
        </div>
      </div>
      <button type="button" onclick="closeUserModal()" style="border: none; background: transparent; font-size: 20px; cursor: pointer; color: var(--admin-text-3);">&times;</button>
    </div>

    <div style="padding: 24px;">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
        <div style="background: #f8fafc; padding: 12px 14px; border-radius: 8px; border: 1px solid var(--admin-border);">
          <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--admin-text-3);">Referral Code</div>
          <div style="font-family: monospace; font-size: 16px; font-weight: 800; color: #2563eb;" id="mCode">VEDANT2026</div>
        </div>
        <div style="background: #f8fafc; padding: 12px 14px; border-radius: 8px; border: 1px solid var(--admin-border);">
          <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--admin-text-3);">Wallet Balance</div>
          <div style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: #16a34a;" id="mBalance">0 PTS</div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
        <div style="background: #f8fafc; padding: 12px 14px; border-radius: 8px; border: 1px solid var(--admin-border);">
          <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--admin-text-3);">Direct Referrals</div>
          <div style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: var(--admin-text-1);" id="mDirect">0</div>
        </div>
        <div style="background: #f8fafc; padding: 12px 14px; border-radius: 8px; border: 1px solid var(--admin-border);">
          <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--admin-text-3);">Total Chain Members</div>
          <div style="font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: #d97706;" id="mChain">0</div>
        </div>
      </div>

      <div style="font-size: 13.5px; color: var(--admin-text-2); margin-bottom: 24px;">
        <div><strong>Referred By:</strong> <span id="mSponsor">None</span></div>
        <div style="margin-top: 6px;"><strong>Joined On:</strong> <span id="mJoined">N/A</span></div>
        <div style="margin-top: 6px;">
          <strong>Test Rewards:</strong> 
          <span id="mAptitudeBadge" style="margin-left: 6px;"></span>
          <span id="mAnalysisBadge" style="margin-left: 6px;"></span>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <a id="mManageLink" href="#" style="background: #18181b; color: #fff; padding: 10px 18px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px; text-decoration: none;">
          <i class="fa-solid fa-sliders"></i> Adjust Points & View Ledger
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleBranch(btn, event) {
    if (event) event.stopPropagation();
    const branchUl = btn.closest('.tree-node-item').querySelector(':scope > ul');
    if (!branchUl) return;

    if (branchUl.style.display === 'none') {
      branchUl.style.display = 'block';
      btn.innerHTML = '<i class="fa-solid fa-minus"></i>';
    } else {
      branchUl.style.display = 'none';
      btn.innerHTML = '<i class="fa-solid fa-plus"></i>';
    }
  }

  function expandAllBranches() {
    document.querySelectorAll('.tree-node-list ul').forEach(ul => ul.style.display = 'block');
    document.querySelectorAll('.btn-toggle-branch').forEach(btn => btn.innerHTML = '<i class="fa-solid fa-minus"></i>');
  }

  function collapseAllBranches() {
    document.querySelectorAll('.tree-node-list ul').forEach(ul => ul.style.display = 'none');
    document.querySelectorAll('.btn-toggle-branch').forEach(btn => btn.innerHTML = '<i class="fa-solid fa-plus"></i>');
  }

  function openUserModal(userId) {
    fetch('/admin/referrals/user/' + userId)
      .then(res => res.json())
      .then(data => {
        document.getElementById('mName').innerText = data.name + ' (#' + data.id + ')';
        document.getElementById('mEmail').innerText = data.email;
        document.getElementById('mCode').innerText = data.referral_code;
        document.getElementById('mBalance').innerText = data.points_balance + ' PTS';
        document.getElementById('mDirect').innerText = data.direct_referrals;
        document.getElementById('mChain').innerText = data.chain_members;
        document.getElementById('mSponsor').innerText = data.referred_by;
        document.getElementById('mJoined').innerText = data.created_at;
        document.getElementById('mAvatar').innerText = data.name.substring(0, 1).toUpperCase();

        document.getElementById('mAptitudeBadge').innerHTML = data.aptitude_claimed ?
          '<span style="background: #dcfce7; color: #15803d; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700;">Aptitude: Claimed</span>' :
          '<span style="background: #f4f4f5; color: #71717a; padding: 2px 8px; border-radius: 4px; font-size: 11px;">Aptitude: Unclaimed</span>';

        document.getElementById('mAnalysisBadge').innerHTML = data.analysis_claimed ?
          '<span style="background: #dcfce7; color: #15803d; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700;">Analysis: Claimed</span>' :
          '<span style="background: #f4f4f5; color: #71717a; padding: 2px 8px; border-radius: 4px; font-size: 11px;">Analysis: Unclaimed</span>';

        document.getElementById('mManageLink').href = '/admin/referrals/user-rewards?user_id=' + data.id;

        document.getElementById('userModal').classList.add('active');
      });
  }

  function closeUserModal() {
    document.getElementById('userModal').classList.remove('active');
  }
</script>
@endsection


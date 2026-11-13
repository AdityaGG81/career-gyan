@extends('admin.layout')

@section('title', 'CareerGuru Partner Accounts')
@section('page_title', 'CareerGuru Management')

@section('styles')
<style>
  .stats-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }
  @media (max-width: 1100px) {
    .stats-strip { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 600px) {
    .stats-strip { grid-template-columns: 1fr; }
  }

  .stat-box {
    background: #ffffff;
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    padding: 18px 20px;
    box-shadow: var(--admin-shadow);
  }
  .stat-label {
    font-size: 11.5px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--admin-text-2);
    font-weight: 600;
    margin-bottom: 6px;
  }
  .stat-number {
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--admin-text-1);
    line-height: 1.1;
  }
  .stat-sub {
    font-size: 11.5px;
    color: var(--admin-text-3);
    margin-top: 4px;
  }

  /* Credentials Banner */
  .credentials-banner {
    background: linear-gradient(135deg, #1e1b4b, #0f172a);
    color: #ffffff;
    border-radius: var(--admin-radius-lg);
    padding: 24px;
    margin-bottom: 26px;
    border: 1px solid rgba(255,255,255,0.12);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
  .cred-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }
  .cred-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    background: rgba(255,255,255,0.06);
    padding: 16px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.08);
  }
  @media (max-width: 800px) {
    .cred-grid { grid-template-columns: 1fr; }
  }
  .cred-field label {
    font-size: 11px;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 0.05em;
    font-weight: 600;
    display: block;
    margin-bottom: 2px;
  }
  .cred-field div {
    font-family: monospace;
    font-size: 13.5px;
    color: #fde047;
    font-weight: 700;
    word-break: break-all;
  }

  .table-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 6px;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
  }
  .status-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
  .status-inactive { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
  .status-revoked { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

  .guru-action-btn {
    padding: 5px 9px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid var(--admin-border);
    background: #fff;
    color: var(--admin-text-1);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.15s;
  }
  .guru-action-btn:hover {
    background: #f4f4f5;
  }
</style>
@endsection

@section('content')

  {{-- New Guru Created Credentials Banner --}}
  @if(session('new_guru_created'))
    @php $cred = session('new_guru_created'); @endphp
    <div class="credentials-banner">
      <div class="cred-header">
        <div>
          <h3 style="font-family:'Outfit',sans-serif; font-size:18px; font-weight:700; color:#86efac;">
            <i class="fa-solid fa-circle-check"></i> CareerGuru Account Created Successfully!
          </h3>
          <p style="font-size:13px; color:#cbd5e1; margin-top:2px;">
            Copy these credentials now and share them with the partner. The initial password will not be shown again.
          </p>
        </div>
        <button type="button" class="btn" style="background:#2563eb; color:#fff;" onclick="copyAllCredentials()">
          <i class="fa-regular fa-copy"></i> <span id="copyAllText">Copy All Credentials</span>
        </button>
      </div>

      <div class="cred-grid" id="credentialsDetails">
        <div class="cred-field">
          <label>CareerGuru ID</label>
          <div id="c_id">{{ $cred['guru_id'] }}</div>
        </div>
        <div class="cred-field">
          <label>Full Name</label>
          <div id="c_name" style="color:#fff;">{{ $cred['name'] }}</div>
        </div>
        <div class="cred-field">
          <label>Login Gmail / Email</label>
          <div id="c_email">{{ $cred['email'] }}</div>
        </div>
        <div class="cred-field">
          <label>Initial Password</label>
          <div id="c_pass" style="color:#f43f5e; font-weight:800;">{{ $cred['password'] }}</div>
        </div>
        <div class="cred-field">
          <label>Referral Code</label>
          <div id="c_code" style="color:#38bdf8;">{{ $cred['referral_code'] }}</div>
        </div>
        <div class="cred-field">
          <label>Login Portal URL</label>
          <div id="c_login" style="color:#a78bfa;">{{ $cred['login_url'] }}</div>
        </div>
      </div>
    </div>
  @endif

  <!-- Platform Stats Strip -->
  <div class="stats-strip">
    <div class="stat-box">
      <div class="stat-label">Total Partners</div>
      <div class="stat-number">{{ number_format($totalGurus) }}</div>
      <div class="stat-sub"><strong style="color:#10b981;">{{ $activeGurus }} active</strong> · {{ $totalGurus - $activeGurus }} inactive/revoked</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">Total Student Leads</div>
      <div class="stat-number">{{ number_format($totalLeads) }}</div>
      <div class="stat-sub">{{ number_format($totalRegistered) }} converted to registered users</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">VIP Conversions</div>
      <div class="stat-number" style="color:#f59e0b;">{{ number_format($totalPremiumConversions) }}</div>
      <div class="stat-sub">Verified paying members attributed to Gurus</div>
    </div>

    <div class="stat-box">
      <div class="stat-label">Commissions Overview</div>
      <div class="stat-number" style="color:#10b981;">₹{{ number_format($totalCommissionEarned, 2) }}</div>
      <div class="stat-sub">Paid: ₹{{ number_format($totalCommissionPaid, 2) }} · Pending: ₹{{ number_format($pendingCommissionLiability, 2) }}</div>
    </div>
  </div>

  <!-- Header Actions -->
  <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); padding:18px 20px; margin-bottom:24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px;">
    <!-- Search & Filter Form -->
    <form method="GET" action="{{ route('admin.careergurus.index') }}" style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; flex:1; max-width:600px;">
      <div style="position:relative; flex:1; min-width:200px;">
        <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--admin-text-3);"></i>
        <input type="text" name="search" class="form-control" style="padding-left:36px;" placeholder="Search by Guru ID, name, email, phone..." value="{{ $search }}">
      </div>

      <select name="status" class="form-control" style="width:auto;" onchange="this.form.submit()">
        <option value="all">All Statuses</option>
        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="revoked" {{ $status == 'revoked' ? 'selected' : '' }}>Revoked</option>
      </select>

      <button type="submit" class="guru-action-btn" style="height:38px; padding:0 14px;">Filter</button>
      @if($search || $status !== 'all')
        <a href="{{ route('admin.careergurus.index') }}" class="guru-action-btn" style="height:38px; padding:0 10px;" title="Reset"><i class="fa-solid fa-rotate-left"></i></a>
      @endif
    </form>

    <!-- Create & Export Buttons -->
    <div style="display:flex; align-items:center; gap:10px;">
      <a href="{{ route('admin.careergurus.export.gurus') }}" class="guru-action-btn" style="background:#ecfdf5; color:#047857; border-color:#a7f3d0;">
        <i class="fa-solid fa-file-csv"></i> Export CSV
      </a>
      <a href="{{ route('admin.careergurus.create') }}" class="guru-action-btn" style="background:#2563eb; color:#fff; border-color:#2563eb; padding:8px 16px; font-weight:700;">
        <i class="fa-solid fa-user-plus"></i> Create CareerGuru Account
      </a>
    </div>
  </div>

  <!-- Accounts Table -->
  <div style="background:#ffffff; border:1px solid var(--admin-border); border-radius:var(--admin-radius-lg); overflow:hidden; box-shadow:var(--admin-shadow);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
      <h3 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; color:var(--admin-text-1);">
        <i class="fa-solid fa-user-tie" style="color:#6366f1; margin-right:6px;"></i> CareerGuru Accounts Table
      </h3>
      <span style="font-size:12px; color:var(--admin-text-2);">
        Showing {{ $gurus->firstItem() ?? 0 }} - {{ $gurus->lastItem() ?? 0 }} of {{ $gurus->total() }} accounts
      </span>
    </div>

    <div style="width:100%; overflow-x:auto;">
      <table style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:1px solid var(--admin-border);">
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">ID</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Partner Name</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Email & Phone</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Registration Date</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Leads</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Registered</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:center;">Premium</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Commission Earned</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Commission Paid</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2);">Status</th>
            <th style="padding:12px 16px; font-size:11px; text-transform:uppercase; color:var(--admin-text-2); text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($gurus as $g)
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px 16px; font-family:monospace; font-weight:700; color:#2563eb;">
                <a href="{{ route('admin.careergurus.show', $g->id) }}" style="color:inherit; text-decoration:none;">
                  {{ $g->guru_id }}
                </a>
              </td>
              <td style="padding:14px 16px;">
                <strong style="color:var(--admin-text-1);">
                  <a href="{{ route('admin.careergurus.show', $g->id) }}" style="color:inherit; text-decoration:none;">
                    {{ $g->name }}
                  </a>
                </strong>
                <div style="font-size:11px; color:var(--admin-text-3);">
                  Code: <strong style="color:#6366f1;">{{ $g->referral_code }}</strong> · {{ $g->commission_percentage }}% comm.
                </div>
              </td>
              <td style="padding:14px 16px;">
                <div><a href="mailto:{{ $g->email }}" style="color:#2563eb; text-decoration:none;">{{ $g->email }}</a></div>
                <div style="font-size:11.5px; color:var(--admin-text-2);"><a href="tel:{{ $g->phone }}" style="color:inherit; text-decoration:none;">{{ $g->phone }}</a></div>
              </td>
              <td style="padding:14px 16px; font-size:12px; color:var(--admin-text-2); white-space:nowrap;">
                {{ $g->created_at->format('d M Y') }}
              </td>
              <td style="padding:14px 16px; text-align:center; font-weight:700;">
                {{ $g->totalLeadsCount() }}
              </td>
              <td style="padding:14px 16px; text-align:center; font-weight:700; color:#2563eb;">
                {{ $g->registeredCount() }}
              </td>
              <td style="padding:14px 16px; text-align:center; font-weight:700; color:#f59e0b;">
                {{ $g->premiumCount() }}
              </td>
              <td style="padding:14px 16px; font-weight:700; color:#059669;">
                ₹{{ number_format($g->totalCommissionEarned(), 2) }}
              </td>
              <td style="padding:14px 16px; font-weight:600; color:#4f46e5;">
                ₹{{ number_format($g->paidCommission(), 2) }}
              </td>
              <td style="padding:14px 16px;">
                @if($g->status === 'active')
                  <span class="status-badge status-active"><i class="fa-solid fa-check"></i> Active</span>
                @elseif($g->status === 'inactive')
                  <span class="status-badge status-inactive"><i class="fa-solid fa-pause"></i> Inactive</span>
                @else
                  <span class="status-badge status-revoked"><i class="fa-solid fa-ban"></i> Revoked</span>
                @endif
              </td>
              <td style="padding:14px 16px;">
                <div class="table-actions">
                  <a href="{{ route('admin.careergurus.show', $g->id) }}" class="guru-action-btn" title="View Performance & Analytics">
                    <i class="fa-solid fa-chart-line"></i>
                  </a>
                  <a href="{{ route('admin.careergurus.edit', $g->id) }}" class="guru-action-btn" title="Edit Partner">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <button type="button" class="guru-action-btn" title="Reset Password" onclick="openResetModal('{{ $g->id }}', '{{ $g->name }}')">
                    <i class="fa-solid fa-key"></i>
                  </button>
                  <form method="POST" action="{{ route('admin.careergurus.toggle-status', $g->id) }}" style="display:inline;">
                    @csrf
                    @if($g->status === 'active')
                      <button type="submit" class="guru-action-btn" title="Deactivate" onclick="return confirm('Deactivate account for {{ $g->name }}? They will be logged out.')" style="color:#d97706;">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    @else
                      <button type="submit" class="guru-action-btn" title="Activate" onclick="return confirm('Activate account for {{ $g->name }}?')" style="color:#059669;">
                        <i class="fa-solid fa-play"></i>
                      </button>
                    @endif
                  </form>
                  @if($g->status !== 'revoked')
                    <form method="POST" action="{{ route('admin.careergurus.revoke', $g->id) }}" style="display:inline;">
                      @csrf
                      <button type="submit" class="guru-action-btn" title="Revoke Access (Permanent Lock)" onclick="return confirm('REVOKE ACCESS for {{ $g->name }}? They will immediately lose access permanently. Historical leads & commissions are safely preserved.')" style="color:#dc2626;">
                        <i class="fa-solid fa-ban"></i>
                      </button>
                    </form>
                  @endif
                  <form method="POST" action="{{ route('admin.careergurus.destroy', $g->id) }}" style="display:inline;" onsubmit="return confirm('PERMANENTLY DELETE CareerGuru {{ $g->name }} ({{ $g->guru_id }}) and all their leads, commissions, and data? This action CANNOT be undone!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="guru-action-btn" title="Delete CareerGuru and All Data" style="color:#ef4444; border-color:#fecaca;">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="11" style="text-align:center; padding:36px; color:var(--admin-text-3);">
                No CareerGuru accounts found.
                <div style="margin-top:10px;">
                  <a href="{{ route('admin.careergurus.create') }}" class="guru-action-btn" style="background:#2563eb; color:#fff; padding:8px 16px;">
                    <i class="fa-solid fa-user-plus"></i> Create First CareerGuru
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($gurus->hasPages())
      <div style="padding:16px 20px; border-top:1px solid var(--admin-border);">
        {{ $gurus->links() }}
      </div>
    @endif
  </div>

  <!-- Admin Reset Password Modal -->
  <div id="resetPwdModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:#fff; border-radius:var(--admin-radius-lg); width:100%; max-width:440px; box-shadow:0 20px 25px rgba(0,0,0,0.2); overflow:hidden;">
      <div style="padding:18px 24px; border-bottom:1px solid var(--admin-border); display:flex; justify-content:space-between; align-items:center;">
        <h4 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:700;">Reset CareerGuru Password</h4>
        <button type="button" onclick="closeResetModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
      </div>
      <form id="resetPwdForm" method="POST" action="">
        @csrf
        <div style="padding:22px 24px;">
          <p id="resetModalMsg" style="font-size:13px; color:var(--admin-text-2); margin-bottom:16px;"></p>
          <div class="form-group">
            <label class="form-label" for="admin_new_password">New Password</label>
            <input type="password" id="admin_new_password" name="password" class="form-control" placeholder="Min. 8 characters" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="admin_new_password_confirmation">Confirm Password</label>
            <input type="password" id="admin_new_password_confirmation" name="password_confirmation" class="form-control" required>
          </div>
        </div>
        <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid var(--admin-border); display:flex; justify-content:flex-end; gap:10px;">
          <button type="button" class="guru-action-btn" onclick="closeResetModal()">Cancel</button>
          <button type="submit" class="guru-action-btn" style="background:#2563eb; color:#fff;">Save New Password</button>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  function copyAllCredentials() {
    const id = document.getElementById('c_id').innerText;
    const name = document.getElementById('c_name').innerText;
    const email = document.getElementById('c_email').innerText;
    const pass = document.getElementById('c_pass').innerText;
    const code = document.getElementById('c_code').innerText;
    const login = document.getElementById('c_login').innerText;

    const text = `CareerGyan CareerGuru Partner Credentials:\n` +
                 `CareerGuru ID: ${id}\n` +
                 `Name: ${name}\n` +
                 `Login Email: ${email}\n` +
                 `Password: ${pass}\n` +
                 `Referral Code: ${code}\n` +
                 `Login Portal: ${login}`;

    navigator.clipboard.writeText(text).then(function() {
      const btnText = document.getElementById('copyAllText');
      btnText.innerText = 'Copied to Clipboard!';
      setTimeout(function() { btnText.innerText = 'Copy All Credentials'; }, 2500);
    });
  }

  function openResetModal(guruId, guruName) {
    const modal = document.getElementById('resetPwdModal');
    const form = document.getElementById('resetPwdForm');
    const msg = document.getElementById('resetModalMsg');
    form.action = `/admin/careergurus/${guruId}/reset-password`;
    msg.innerText = `Set a new secure password for partner: ${guruName}`;
    modal.style.display = 'flex';
  }

  function closeResetModal() {
    document.getElementById('resetPwdModal').style.display = 'none';
  }
</script>
@endsection


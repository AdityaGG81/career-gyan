@extends('admin.layout')

@section('title', 'Registered Users')
@section('page_title', 'Users Management')

@section('styles')
<style>
  .users-header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
  }

  .search-container {
    position: relative;
    flex-grow: 1;
    max-width: 400px;
  }

  .search-container i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-text-3);
  }

  .search-container input {
    padding-left: 40px;
  }

  .btn-export-csv {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #10b981;
    color: #ffffff;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-export-csv:hover {
    background: #059669;
    transform: translateY(-1px);
  }

  .btn-grant-pro {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: var(--admin-radius-md);
    font-weight: 700;
    text-decoration: none;
    font-size: 14px;
    box-shadow: 0 4px 12px rgba(180, 83, 9, 0.25);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-grant-pro:hover {
    background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
    transform: translateY(-1px);
  }

  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
  }

  @keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.96); }
    to { opacity: 1; transform: scale(1); }
  }
</style>
@endsection

@section('content')

<div class="users-header-actions">
  <div class="search-container">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="userSearch" class="form-control" placeholder="Search by name, email, or phone...">
  </div>

  <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    <button type="button" onclick="openGrantModal()" class="btn-grant-pro">
      <i class="fa-solid fa-crown" style="color: #fde68a;"></i> Grant Pro Access
    </button>
    <button onclick="exportTableToCSV('careergyan-users.csv')" class="btn-export-csv">
      <i class="fa-solid fa-file-csv"></i> Export CSV
    </button>
    <div style="background: var(--admin-surface); border: 1px solid var(--admin-border); color: var(--admin-text-2); padding: 9px 18px; border-radius: var(--admin-radius-md); font-weight: 700; font-size: 13.5px; box-shadow: var(--admin-shadow);">
      Total Users: <span id="userCount">{{ $users->count() }}</span>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="table-card">
  <div style="overflow-x: auto;">
    <table class="admin-table" id="usersTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Membership</th>
          <th>Assessments / Tests</th>
          <th>Joined Date</th>
          <th style="text-align: right;">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr class="user-row">
            <td style="color: var(--admin-text-3); font-weight: 600; font-size: 13px;">#{{ $user->id }}</td>
            <td class="user-name" style="font-weight: 700; color: var(--admin-text-1);">
              {{ $user->first_name }} {{ $user->last_name }}
              @if($user->hasActiveMembership())
                <span style="background: #fef3c7; color: #92400e; padding: 1px 6px; border-radius: 999px; font-size: 10px; font-weight: 700; margin-left: 4px;">
                  <i class="fa-solid fa-crown" style="color: #f59e0b;"></i> Pro
                </span>
              @endif
            </td>
            <td class="user-email">{{ $user->email }}</td>
            <td class="user-phone">{{ $user->phone ?: 'Not Provided' }}</td>
            <td>
              @if($user->hasActiveMembership())
                <span style="display: inline-flex; align-items: center; gap: 5px; background: #fef3c7; color: #92400e; padding: 3px 8px; border-radius: 999px; font-size: 11px; font-weight: 700; border: 1px solid #fde68a;">
                  <i class="fa-solid fa-crown" style="color: #f59e0b;"></i> Pro Active
                </span>
                <div style="font-size: 10.5px; color: #64748b; margin-top: 3px;">
                  {{ $user->membership_expires_at ? 'Exp: ' . $user->membership_expires_at->format('d M Y') : 'Lifetime' }}
                </div>
              @else
                <span style="color: #94a3b8; font-size: 12px; font-weight: 500;">Free User</span>
              @endif
            </td>
            <td>
              @php
                $aptCount = $user->testSessions ? $user->testSessions->count() : 0;
                $saCount = $user->studentAnalyses ? $user->studentAnalyses->count() : 0;
              @endphp
              <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                @if($aptCount > 0)
                  <span style="background: #ecfdf5; color: #047857; font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" title="Completed {{ $aptCount }} Aptitude Test(s)">
                    <i class="fa-solid fa-brain"></i> Aptitude ({{ $aptCount }})
                  </span>
                @endif
                @if($saCount > 0)
                  <span style="background: #eff6ff; color: #1d4ed8; font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;" title="Completed 47-Question Student Analysis">
                    <i class="fa-solid fa-clipboard-user"></i> Analysis
                  </span>
                @endif
                @if($aptCount == 0 && $saCount == 0)
                  <span style="color: #94a3b8; font-size: 12px;">No tests yet</span>
                @endif
              </div>
            </td>
            <td>
              {{ $user->created_at->format('d M, Y') }}
              <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $user->created_at->format('h:i A') }}</div>
            </td>
            <td style="text-align: right; white-space: nowrap;">
              <div style="display: inline-flex; align-items: center; gap: 6px; justify-content: flex-end;">
                <a href="{{ route('admin.test-results.user', $user->id) }}" style="display: inline-flex; align-items: center; gap: 5px; background: #2563eb; color: #ffffff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: background 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                  <i class="fa-solid fa-square-poll-vertical"></i> View Results
                </a>

                @if($user->hasActiveMembership())
                  <form action="{{ route('admin.membership.revoke', $user->id) }}" method="POST" onsubmit="return confirm('Revoke Pro membership for {{ $user->email }}?');" style="margin: 0; display: inline;">
                    @csrf
                    <button type="submit" style="display: inline-flex; align-items: center; gap: 4px; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 6px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" title="Revoke Pro Access" onmouseover="this.style.background='#fca5a5'" onmouseout="this.style.background='#fee2e2'">
                      <i class="fa-solid fa-ban"></i> Revoke Pro
                    </button>
                  </form>
                @else
                  <button type="button" onclick="openGrantModal('{{ $user->email }}')" style="display: inline-flex; align-items: center; gap: 4px; background: #fef3c7; color: #92400e; border: 1px solid #fde68a; padding: 6px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s;" title="Grant Pro Access to this user" onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                    <i class="fa-solid fa-crown" style="color: #d97706;"></i> Grant Pro
                  </button>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-users-slash" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No registered users found yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- Grant Pro Modal -->
<div id="grantProModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
  <div style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 500px; box-shadow: 0 20px 40px rgba(0,0,0,0.25); overflow: hidden; animation: modalFadeIn 0.2s ease-out;">
    <div style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); padding: 20px 24px; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(251, 191, 36, 0.2); border: 1px solid rgba(251, 191, 36, 0.4); display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 16px;">
          <i class="fa-solid fa-crown"></i>
        </div>
        <div>
          <h3 style="margin: 0; font-size: 17px; font-weight: 700; color: #ffffff;">Grant Pro Membership</h3>
          <p style="margin: 2px 0 0; font-size: 12px; color: #cbd5e1;">Provide instant Pro privileges to desired email</p>
        </div>
      </div>
      <button type="button" onclick="closeGrantModal()" style="background: none; border: none; color: #cbd5e1; font-size: 20px; cursor: pointer; padding: 4px; line-height: 1;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form action="{{ route('admin.membership.grant') }}" method="POST" style="padding: 24px;">
      @csrf
      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
          Candidate / Student Email <span style="color: #dc2626;">*</span>
        </label>
        <input 
          type="email" 
          name="email" 
          id="modalEmailInput" 
          required 
          placeholder="e.g. student@gmail.com"
          style="width: 100%; padding: 11px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; box-sizing: border-box;"
        >
        <div style="font-size: 11.5px; color: #64748b; margin-top: 4px;">
          Works for existing users or new uncreated accounts.
        </div>
      </div>

      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
          Access Duration
        </label>
        <select name="duration_days" id="modalDurationSelect" style="width: 100%; padding: 11px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13.5px; box-sizing: border-box; background: #fff;">
          <option value="365" selected>1 Year (365 Days) — Standard</option>
          <option value="180">6 Months (180 Days)</option>
          <option value="90">3 Months (90 Days)</option>
          <option value="30">1 Month (30 Days)</option>
          <option value="730">2 Years (730 Days)</option>
        </select>
        <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #475569; margin-top: 6px; cursor: pointer;">
          <input type="checkbox" name="is_lifetime" value="1" id="modalIsLifetime" onchange="document.getElementById('modalDurationSelect').disabled = this.checked;">
          Lifetime Access (No Expiry)
        </label>
      </div>

      <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">
          Admin Memo / Note (Optional)
        </label>
        <input 
          type="text" 
          name="admin_note" 
          placeholder="e.g. Manual Grant / Scholarship"
          style="width: 100%; padding: 11px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 13px; box-sizing: border-box;"
        >
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <button type="button" onclick="closeGrantModal()" style="padding: 10px 18px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 13px; cursor: pointer;">
          Cancel
        </button>
        <button type="submit" style="padding: 10px 22px; border-radius: 8px; border: none; background: linear-gradient(135deg, #d97706 0%, #b45309 100%); color: #fff; font-weight: 700; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(180, 83, 9, 0.25);">
          <i class="fa-solid fa-crown" style="color: #fde68a;"></i> Grant Membership Now
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Client-side search filtering
  document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('userSearch');
    const rows = document.querySelectorAll('.user-row');
    const userCountSpan = document.getElementById('userCount');

    searchInput.addEventListener('input', () => {
      const query = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;

      rows.forEach(row => {
        const name = row.querySelector('.user-name').textContent.toLowerCase();
        const email = row.querySelector('.user-email').textContent.toLowerCase();
        const phone = row.querySelector('.user-phone').textContent.toLowerCase();

        if (name.includes(query) || email.includes(query) || phone.includes(query)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      userCountSpan.textContent = visibleCount;
    });
  });

  // Client-side CSV Exporter
  function exportTableToCSV(filename) {
    const csv = [];
    const rows = document.querySelectorAll("#usersTable tr");
    
    for (let i = 0; i < rows.length; i++) {
      // Exclude hidden rows (filtered out)
      if (rows[i].style.display === 'none') continue;
      
      const row = [];
      const cols = rows[i].querySelectorAll("td, th");
      
      for (let j = 0; j < cols.length; j++) {
        // Strip out newlines and double quotes from content
        let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
        data = data.replace(/"/g, '""');
        
        // Push double-quoted column value
        row.push('"' + data + '"');
      }
      
      csv.push(row.join(","));
    }

    // Create Download Link
    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }

  // Grant Pro Modal Controllers
  function openGrantModal(email = '') {
    const modal = document.getElementById('grantProModal');
    const emailInput = document.getElementById('modalEmailInput');
    if (email) {
      emailInput.value = email;
    } else {
      emailInput.value = '';
    }
    modal.style.display = 'flex';
    setTimeout(() => emailInput.focus(), 50);
  }

  function closeGrantModal() {
    const modal = document.getElementById('grantProModal');
    modal.style.display = 'none';
  }

  // Close modal when clicking outside or pressing Escape
  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeGrantModal();
    }
  });

  document.addEventListener('click', (e) => {
    const modal = document.getElementById('grantProModal');
    if (e.target === modal) {
      closeGrantModal();
    }
  });
</script>
@endsection

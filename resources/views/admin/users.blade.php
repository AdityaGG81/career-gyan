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

  .table-card {
    background: var(--admin-surface);
    border: 1px solid var(--admin-border);
    border-radius: var(--admin-radius-lg);
    box-shadow: var(--admin-shadow);
    overflow: hidden;
  }
</style>
@endsection

@section('content')

<div class="users-header-actions">
  <div class="search-container">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="userSearch" class="form-control" placeholder="Search by name, email, or phone...">
  </div>

  <div style="display: flex; gap: 12px; align-items: center;">
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
          <th>Joined Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr class="user-row">
            <td style="color: var(--admin-text-3); font-weight: 600; font-size: 13px;">#{{ $user->id }}</td>
            <td class="user-name" style="font-weight: 700; color: var(--admin-text-1);">
              {{ $user->first_name }} {{ $user->last_name }}
            </td>
            <td class="user-email">{{ $user->email }}</td>
            <td class="user-phone">{{ $user->phone ?: 'Not Provided' }}</td>
            <td>
              {{ $user->created_at->format('d M, Y') }}
              <div style="font-size: 11.5px; color: var(--admin-text-3);">{{ $user->created_at->format('h:i A') }}</div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align: center; padding: 50px; color: var(--admin-text-3);">
              <i class="fa-solid fa-users-slash" style="font-size: 40px; margin-bottom: 16px; color: var(--admin-text-3); display: block;"></i>
              No registered users found yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
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
</script>
@endsection

@extends('layouts.app')

@section('title', 'My Profile | Career Gyan')

@section('content')
<div class="container" style="padding: 80px 24px; min-height: calc(100vh - 100px); display: flex; flex-direction: column; justify-content: center; align-items: center; background: #f8fafc;">
    
    @if(session('success'))
        <div style="max-width: 480px; width:100%; background:#dcfce7; border:1px solid #bbf7d0; color:#166534; padding:12px 16px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600; text-align:center;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Profile Main Card -->
    <div class="profile-card" id="profileCard">
        <!-- FRONT / VIEW MODE -->
        <div class="card-side card-view" id="cardView" onclick="toggleEditMode(true)">
            <div class="card-header-bg"></div>
            <div class="profile-avatar-wrap">
                <img src="{{ $user->profile_photo ? (str_starts_with($user->profile_photo, 'http') || str_starts_with($user->profile_photo, 'uploads/') ? asset($user->profile_photo) : asset($user->profile_photo)) : 'https://api.dicebear.com/7.x/adventurer/svg?seed=Felix' }}" alt="Avatar" id="viewAvatarImg">
            </div>
            <div class="profile-details-wrap">
                <h2>{{ $user->name }}</h2>
                <p class="profile-role"><i class="fa-solid fa-graduation-cap"></i> Student Aspirant</p>
                
                <div class="details-divider"></div>
                
                <div class="info-row">
                    <span class="info-label"><i class="fa-solid fa-envelope"></i> Email</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="fa-solid fa-phone"></i> Phone</span>
                    <span class="info-value">{{ $user->phone }}</span>
                </div>
                
                <div class="click-to-edit-badge">
                    <i class="fa-solid fa-pen-to-square"></i> Click Card to Edit
                </div>
            </div>
        </div>

        <!-- BACK / EDIT MODE -->
        <div class="card-side card-edit" id="cardEdit" style="display: none;">
            <div class="edit-header">
                <h3>Edit Profile Details</h3>
                <button type="button" class="close-edit-btn" onclick="event.stopPropagation(); toggleEditMode(false)">&times;</button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" onclick="event.stopPropagation()">
                @csrf
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" required>
                </div>

                <!-- Custom Profile Upload -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label>Upload Profile Photo</label>
                    <input type="file" name="photo_file" accept="image/*" class="custom-file-input">
                </div>

                <!-- Avatar Presets (Clickable Character List) -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Or select a Character Avatar</label>
                    <input type="hidden" name="avatar_preset" id="avatarPresetInput" value="{{ $user->profile_photo }}">
                    <div class="avatar-presets-grid">
                        @php
                          $presets = [
                              'https://api.dicebear.com/7.x/adventurer/svg?seed=Felix',
                              'https://api.dicebear.com/7.x/adventurer/svg?seed=Aneka',
                              'https://api.dicebear.com/7.x/adventurer/svg?seed=Nala',
                              'https://api.dicebear.com/7.x/adventurer/svg?seed=Charlie',
                              'https://api.dicebear.com/7.x/bottts/svg?seed=Robo',
                              'https://api.dicebear.com/7.x/avataaars/svg?seed=Jack',
                              'https://api.dicebear.com/7.x/avataaars/svg?seed=Lily',
                              'https://api.dicebear.com/7.x/pixel-art/svg?seed=Pixel',
                          ];
                        @endphp
                        @foreach($presets as $preset)
                            <div class="preset-option {{ $user->profile_photo == $preset ? 'selected' : '' }}" onclick="selectPreset('{{ $preset }}', this)">
                                <img src="{{ $preset }}" alt="Preset">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="toggleEditMode(false)">Cancel</button>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.profile-card {
    background: #ffffff;
    max-width: 480px;
    width: 100%;
    border-radius: var(--radius-xl);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(15, 23, 42, 0.04);
    border: 1px solid var(--border);
    overflow: hidden;
    position: relative;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
}

.profile-card:hover {
    box-shadow: 0 30px 60px rgba(26, 86, 219, 0.12), 0 1px 5px rgba(26, 86, 219, 0.06);
    transform: translateY(-4px);
}

.card-side {
    transition: all 0.3s ease;
}

.card-view {
    cursor: pointer;
    position: relative;
}

.card-header-bg {
    height: 140px;
    background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%);
    position: relative;
}

.card-header-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1' fill='%23ffffff' fill-opacity='0.08'/%3E%3C/svg%3E");
}

.profile-avatar-wrap {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #ffffff;
    padding: 6px;
    border: 1px solid var(--border);
    position: absolute;
    top: 80px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}

.profile-avatar-wrap img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.profile-details-wrap {
    padding: 80px 32px 32px;
    text-align: center;
}

.profile-details-wrap h2 {
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 24px;
    color: var(--text-1);
    margin-bottom: 4px;
}

.profile-role {
    font-size: 14px;
    font-weight: 600;
    color: var(--brand);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.details-divider {
    height: 1px;
    background: var(--border);
    margin: 24px 0;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
    font-size: 15px;
}

.info-label {
    color: var(--text-3);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-value {
    color: var(--text-1);
    font-weight: 700;
}

.click-to-edit-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 24px;
    background: var(--brand-light);
    color: var(--brand);
    font-weight: 700;
    font-size: 13px;
    padding: 6px 16px;
    border-radius: 99px;
    transition: 0.2s;
}

.profile-card:hover .click-to-edit-badge {
    background: var(--brand);
    color: #ffffff;
}

/* Edit Mode Styles */
.card-edit {
    padding: 32px;
}

.edit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
}

.edit-header h3 {
    font-family: 'Sora', sans-serif;
    font-weight: 800;
    font-size: 20px;
    color: var(--text-1);
}

.close-edit-btn {
    font-size: 28px;
    color: var(--text-3);
    cursor: pointer;
    line-height: 1;
}

.close-edit-btn:hover {
    color: var(--text-1);
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-2);
}

.form-group input {
    border: 1px solid var(--border);
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    background: #f8fafc;
    transition: 0.2s;
}

.form-group input:focus {
    border-color: var(--brand);
    background: #ffffff;
    box-shadow: 0 0 0 2px var(--brand-light);
}

.custom-file-input {
    padding: 6px !important;
}

.avatar-presets-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-top: 6px;
}

.preset-option {
    border: 2px solid var(--border);
    border-radius: 10px;
    padding: 4px;
    cursor: pointer;
    transition: 0.2s;
    background: #f8fafc;
}

.preset-option:hover {
    border-color: var(--brand);
    transform: scale(1.05);
}

.preset-option.selected {
    border-color: var(--brand);
    background: var(--brand-light);
}

.preset-option img {
    width: 100%;
    height: auto;
    border-radius: 6px;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 24px;
}

.btn-cancel {
    flex: 1;
    text-align: center;
    padding: 12px;
    background: #f1f5f9;
    color: var(--text-2);
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-cancel:hover {
    background: #e2e8f0;
}

.btn-save {
    flex: 1.5;
    text-align: center;
    padding: 12px;
    background: var(--brand);
    color: #ffffff;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-save:hover {
    background: var(--brand-dark);
}
</style>

@section('scripts')
<script>
function toggleEditMode(isEditing) {
    const cardView = document.getElementById('cardView');
    const cardEdit = document.getElementById('cardEdit');
    const profileCard = document.getElementById('profileCard');

    if (isEditing) {
        profileCard.style.transform = 'scale(0.98)';
        setTimeout(() => {
            cardView.style.display = 'none';
            cardEdit.style.display = 'block';
            profileCard.style.transform = 'scale(1)';
        }, 150);
    } else {
        profileCard.style.transform = 'scale(0.98)';
        setTimeout(() => {
            cardEdit.style.display = 'none';
            cardView.style.display = 'block';
            profileCard.style.transform = 'scale(1)';
        }, 150);
    }
}

function selectPreset(url, element) {
    document.getElementById('avatarPresetInput').value = url;
    document.querySelectorAll('.preset-option').forEach(el => el.classList.remove('selected'));
    element.classList.add('selected');
}
</script>
@endsection
@endsection

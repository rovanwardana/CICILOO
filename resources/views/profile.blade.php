@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div style="max-width: 896px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 24px;">
    <!-- Profile Header -->
    <div style="display: flex; align-items: center; gap: 24px; margin-bottom: 32px;">
        <!-- Profile Picture -->
        <div style="position: relative;">
            <img id="profile-picture" src="/storage/circle-user-round.svg" alt="Profile Picture" style="width: 96px; height: 96px; border-radius: 50%; object-fit: cover; border: 2px solid #4B6382;">
            <label for="profile-picture-upload" style="position: absolute; bottom: 0; right: 0; background-color: #071739; color: #ffffff; border-radius: 50%; padding: 8px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </label>
            <input id="profile-picture-upload" type="file" accept="image/*" style="display: none;" onchange="previewProfilePicture(event)">
        </div>
        <!-- Profile Info -->
        <div>
            <h2 style="font-size: 24px; font-weight: bold; color: #071739;">Nama Pengguna</h2>
            <p style="color: #6b7280; font-size: 14px;">Terakhir aktif: {{ now()->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <!-- Profile Details -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 32px;">
        <!-- Personal Information -->
        <div>
            <h3 style="font-size: 18px; font-weight: 600; color: #071739; margin-bottom: 16px;">Informasi Pribadi</h3>
            <form>
                <div style="margin-bottom: 16px;">
                    <label for="name" style="font-size: 14px; color: #6b7280; display: block; margin-bottom: 4px;">Nama Lengkap</label>
                    <input type="text" id="name" value="Nama Pengguna" style="width: 100%; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; color: #071739; font-size: 14px;">
                </div>
                <div style="margin-bottom: 16px;">
                    <label for="email" style="font-size: 14px; color: #6b7280; display: block; margin-bottom: 4px;">Email</label>
                    <input type="email" id="email" value="user@example.com" style="width: 100%; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; color: #071739; font-size: 14px;">
                </div>
                <div style="margin-bottom: 16px;">
                    <label for="phone" style="font-size: 14px; color: #6b7280; display: block; margin-bottom: 4px;">Nomor Telepon</label>
                    <div style="display: flex; gap: 8px;">
                        <select id="country-code" style="padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; font-size: 14px; color: #071739; background-color: #ffffff;">
                            <option value="+62" style="background: url('https://flagcdn.com/w20/id.png') no-repeat left center; padding-left: 24px;">+62 (Indonesia)</option>
                            <option value="+1" style="background: url('https://flagcdn.com/w20/us.png') no-repeat left center; padding-left: 24px;">+1 (USA)</option>
                            <option value="+60" style="background: url('https://flagcdn.com/w20/my.png') no-repeat left center; padding-left: 24px;">+60 (Malaysia)</option>
                            <option value="+65" style="background: url('https://flagcdn.com/w20/sg.png') no-repeat left center; padding-left: 24px;">+65 (Singapore)</option>
                        </select>
                        <input type="text" id="phone" value="1234567890" style="flex: 1; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; color: #071739; font-size: 14px;">
                    </div>
                </div>
                <button type="submit" style="padding: 8px 16px; background-color: #071739; color: #ffffff; border-radius: 6px; font-size: 14px;">Save</button>
            </form>
        </div>

@push('scripts')
<script>
    function previewProfilePicture(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profile-picture');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('title', 'Profile')

@section('content')
<div style="max-width: 90vw; width: 100%; margin: 0 auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); padding: 2rem; min-height: 80vh;">
    <!-- Notifikasi -->
    @if (session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Profile Header -->
    <div style="display: flex; align-items: center; gap: 2rem; margin-bottom: 3rem; flex-wrap: wrap;">
        <!-- Profile Picture -->
        <div style="position: relative; flex-shrink: 0;">
            <img id="profile-picture" src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : '/storage/circle-user-round.svg' }}" alt="Profile Picture" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #4B6382;">
            <label for="profile-picture-upload" style="position: absolute; bottom: 0; right: 0; background-color: #071739; color: #ffffff; border-radius: 50%; padding: 10px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </label>
            <input id="profile-picture-upload" type="file" name="profile_picture" accept="image/*" style="display: none;" onchange="previewProfilePicture(event)">
        </div>
        <!-- Profile Info -->
        <div style="flex: 1; min-width: 200px;">
            <h2 style="font-size: clamp(1.5rem, 2.5vw, 1.75rem); font-weight: bold; color: #071739;">{{ $user->name }}</h2>
            <p style="color: #6b7280; font-size: clamp(0.875rem, 1.5vw, 1rem);">Terakhir aktif: {{ $user->updated_at->setTimezone('Asia/Makassar')->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <!-- Profile Details -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <!-- Personal Information -->
        <div>
            <h3 style="font-size: clamp(1.125rem, 2vw, 1.25rem); font-weight: 600; color: #071739; margin-bottom: 1.5rem;">Informasi Pribadi</h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="font-size: clamp(0.875rem, 1.5vw, 1rem); color: #6b7280; display: block; margin-bottom: 0.5rem;">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; outline: none; color: #071739; font-size: clamp(0.875rem, 1.5vw, 1rem);" required>
                    @error('name')
                        <span style="color: #991b1b; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="font-size: clamp(0.875rem, 1.5vw, 1rem); color: #6b7280; display: block; margin-bottom: 0.5rem;">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; outline: none; color: #071739; font-size: clamp(0.875rem, 1.5vw, 1rem);" required>
                    @error('email')
                        <span style="color: #991b1b; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label for="phone" style="font-size: clamp(0.875rem, 1.5vw, 1rem); color: #6b7280; display: block; margin-bottom: 0.5rem;">Nomor Telepon</label>
                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                        @php
                            // Default jika phone kosong
                            $countryCode = '+62';
                            $phoneNumber = '';
                            
                            if ($user->phone) {
                                // Coba pisahkan kode negara dan nomor
                                if (preg_match('/^(\+\d{1,3})\s*(.*)$/', $user->phone, $matches)) {
                                    $countryCode = $matches[1];
                                    $phoneNumber = $matches[2];
                                } else {
                                    $phoneNumber = $user->phone;
                                }
                            }
                        @endphp
                        <select id="country-code" name="country_code" style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; outline: none; font-size: clamp(0.875rem, 1.5vw, 1rem); color: #071739; background-color: #ffffff; min-width: 120px;">
                            <option value="+62" {{ $countryCode == '+62' ? 'selected' : '' }} style="background: url('https://flagcdn.com/w20/id.png') no-repeat left center; padding-left: 2rem;">+62 (Indonesia)</option>
                            <option value="+1" {{ $countryCode == '+1' ? 'selected' : '' }} style="background: url('https://flagcdn.com/w20/us.png') no-repeat left center; padding-left: 2rem;">+1 (USA)</option>
                            <option value="+60" {{ $countryCode == '+60' ? 'selected' : '' }} style="background: url('https://flagcdn.com/w20/my.png') no-repeat left center; padding-left: 2rem;">+60 (Malaysia)</option>
                            <option value="+65" {{ $countryCode == '+65' ? 'selected' : '' }} style="background: url('https://flagcdn.com/w20/sg.png') no-repeat left center; padding-left: 2rem;">+65 (Singapore)</option>
                        </select>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $phoneNumber) }}" style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; outline: none; color: #071739; font-size: clamp(0.875rem, 1.5vw, 1rem); min-width: 150px;">
                        @error('phone')
                            <span style="color: #991b1b; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" style="padding: 0.75rem 1.5rem; background-color: #071739; color: #ffffff; border-radius: 8px; font-size: clamp(0.875rem, 1.5vw, 1rem); transition: background-color 0.3s;">Save</button>
            </form>
        </div>
    </div>
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
@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
        <a href="{{ route('admin.users.index') }}" style="color: #6366f1; font-size: 1.5rem; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#6366f1'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1>Edit User</h1>
            <p style="color: #9ca3af; font-size: 0.9rem; margin: 0.25rem 0 0 0;">{{ $user->name }}</p>
        </div>
    </div>
</div>

<div class="data-card" style="max-width: 600px;">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Nama Lengkap <span style="color: #ef4444;">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
            @error('name')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Email <span style="color: #ef4444;">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
            @error('email')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Nomor Telepon
            </label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Masukkan nomor telepon" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
            @error('phone')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Address -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Alamat
            </label>
            <textarea name="address" placeholder="Masukkan alamat" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                resize: vertical;
                min-height: 100px;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Role <span style="color: #ef4444;">*</span>
            </label>
            <select name="role" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
                <option value="">-- Pilih Role --</option>
                <option value="administrator" {{ old('role', $user->role) === 'administrator' ? 'selected' : '' }}>Administrator</option>
                <option value="karyawan" {{ old('role', $user->role) === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Password Section -->
        <div style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
            <p style="color: #6366f1; font-weight: 600; margin: 0 0 0.75rem 0;">
                <i class="bi bi-info-circle"></i> Ubah Password (Opsional)
            </p>
            <p style="color: #9ca3af; font-size: 0.85rem; margin: 0;">Kosongkan jika tidak ingin mengubah password user</p>
        </div>

        <!-- New Password -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Password Baru
            </label>
            <input type="password" name="password" placeholder="Masukkan password baru (minimal 8 karakter)" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
            <p style="color: #9ca3af; font-size: 0.8rem; margin-top: 0.25rem;"><i class="bi bi-info-circle"></i> Minimal 8 karakter</p>
            @error('password')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; color: #e5e7eb; font-weight: 600; margin-bottom: 0.5rem;">
                Konfirmasi Password Baru
            </label>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            " onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99, 102, 241, 0.1)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
            @error('password_confirmation')
                <p style="color: #f87171; font-size: 0.85rem; margin-top: 0.25rem;"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div style="margin-bottom: 2rem;">
            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }} style="
                    width: 20px;
                    height: 20px;
                    cursor: pointer;
                    accent-color: #6366f1;
                ">
                <span style="color: #e5e7eb; font-weight: 600;">User Aktif</span>
            </label>
            <p style="color: #9ca3af; font-size: 0.85rem; margin: 0.5rem 0 0 2rem;"><i class="bi bi-info-circle"></i> User aktif dapat login ke sistem</p>
        </div>

        <!-- User Info -->
        <div style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 2rem;">
            <p style="color: #9ca3af; font-size: 0.85rem; margin: 0;">
                <i class="bi bi-clock-history"></i> Dibuat: {{ $user->created_at->format('d M Y H:i') }}<br>
                <i class="bi bi-pencil"></i> Diubah: {{ $user->updated_at->format('d M Y H:i') }}
            </p>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.users.index') }}" style="
                padding: 0.75rem 1.5rem;
                background-color: rgba(99, 102, 241, 0.2);
                color: #6366f1;
                border: 1px solid rgba(99, 102, 241, 0.3);
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" style="
                padding: 0.75rem 1.5rem;
                background-color: #6366f1;
                color: white;
                border: none;
                border-radius: 0.5rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            " onmouseover="this.style.backgroundColor='#4f46e5'" onmouseout="this.style.backgroundColor='#6366f1'">
                <i class="bi bi-check-circle"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
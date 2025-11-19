@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
        <a href="{{ route('admin.users.index') }}" style="color: #16a34a; font-size: 1.5rem; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#22c55e'" onmouseout="this.style.color='#16a34a'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1>Edit User</h1>
            <p>Update informasi user: {{ $user->name }}</p>
        </div>
    </div>
</div>

<div class="data-card" style="max-width: 700px; margin: 0 auto;">
    <h4><i class="bi bi-pencil-square"></i> Form Edit User</h4>
    
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">
                Nama Lengkap <span style="color: #ef4444;">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   placeholder="Masukkan nama lengkap" 
                   class="form-control" required>
            @error('name')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">
                Email <span style="color: #ef4444;">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   placeholder="Masukkan email" 
                   class="form-control" required>
            @error('email')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label class="form-label">
                Nomor Telepon
            </label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                   placeholder="Masukkan nomor telepon" 
                   class="form-control">
            @error('phone')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label class="form-label">
                Alamat
            </label>
            <textarea name="address" placeholder="Masukkan alamat lengkap" 
                      class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label">
                Role <span style="color: #ef4444;">*</span>
            </label>
            <select name="role" class="form-select" required style="
                background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2316a34a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e');
                background-repeat: no-repeat;
                background-position: right 0.75rem center;
                background-size: 20px;
                padding-right: 2.5rem;
                cursor: pointer;
            ">
                <option value="" style="background-color: #0a1f0a; color: rgba(255, 255, 255, 0.5);">-- Pilih Role --</option>
                <option value="administrator" {{ old('role', $user->role) === 'administrator' ? 'selected' : '' }} 
                        style="background-color: #0a1f0a; color: white; padding: 0.5rem;">
                    👑 Administrator
                </option>
                <option value="karyawan" {{ old('role', $user->role) === 'karyawan' ? 'selected' : '' }}
                        style="background-color: #0a1f0a; color: white; padding: 0.5rem;">
                    👔 Karyawan
                </option>
                <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}
                        style="background-color: #0a1f0a; color: white; padding: 0.5rem;">
                    👤 Customer
                </option>
            </select>
            @error('role')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Section Info -->
        <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
            <p style="color: #22c55e; font-weight: 600; margin: 0 0 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-info-circle-fill"></i> Ubah Password (Opsional)
            </p>
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.85rem; margin: 0;">
                Kosongkan field password jika tidak ingin mengubah password user
            </p>
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label class="form-label">
                Password Baru
            </label>
            <input type="password" name="password" 
                   placeholder="Masukkan password baru (minimal 8 karakter)" 
                   class="form-control">
            <small style="color: rgba(255, 255, 255, 0.6); display: block; margin-top: 0.5rem;">
                <i class="bi bi-info-circle"></i> Minimal 8 karakter
            </small>
            @error('password')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div class="mb-3">
            <label class="form-label">
                Konfirmasi Password Baru
            </label>
            <input type="password" name="password_confirmation" 
                   placeholder="Konfirmasi password baru" 
                   class="form-control">
            @error('password_confirmation')
                <p style="color: #fca5a5; font-size: 0.85rem; margin-top: 0.5rem;">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <div class="form-check" style="padding-left: 0;">
                <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }}
                           style="width: 20px; height: 20px; cursor: pointer; accent-color: #16a34a;">
                    <span style="color: rgba(255, 255, 255, 0.9); font-weight: 500;">
                        User Aktif
                    </span>
                </label>
                <small style="color: rgba(255, 255, 255, 0.6); display: block; margin-top: 0.5rem; margin-left: 2rem;">
                    <i class="bi bi-info-circle"></i> User aktif dapat login ke sistem
                </small>
            </div>
        </div>

        <!-- User Info -->
        <div style="background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.15); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.85rem; margin: 0; line-height: 1.8;">
                <i class="bi bi-clock-history" style="color: #16a34a;"></i> <strong>Dibuat:</strong> {{ $user->created_at->format('d M Y H:i') }}<br>
                <i class="bi bi-pencil" style="color: #16a34a;"></i> <strong>Terakhir Diubah:</strong> {{ $user->updated_at->format('d M Y H:i') }}
            </p>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1rem; border-top: 1px solid rgba(34, 197, 94, 0.2);">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update User
            </button>
        </div>
    </form>
</div>
@endsection
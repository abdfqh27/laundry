@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Kelola User</h1>
        <a href="{{ route('admin.users.create') }}" style="
            background-color: #6366f1;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        " onmouseover="this.style.backgroundColor='#4f46e5'" onmouseout="this.style.backgroundColor='#6366f1'">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>
</div>

<!-- Filter Section -->
<div class="data-card" style="margin-bottom: 2rem;">
    <form method="GET" action="{{ route('admin.users.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <!-- Search -->
        <div>
            <input type="text" name="search" placeholder="Cari nama, email, atau telepon..." value="{{ request('search') }}" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
            " onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'">
        </div>

        <!-- Role Filter -->
        <div>
            <select name="role" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
            " onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'">
                <option value="">Semua Role</option>
                <option value="administrator" {{ request('role') === 'administrator' ? 'selected' : '' }}>Administrator</option>
                <option value="karyawan" {{ request('role') === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <!-- Status Filter -->
        <div>
            <select name="status" style="
                width: 100%;
                padding: 0.75rem;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                color: white;
                font-size: 0.9rem;
            " onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
            <button type="submit" style="
                flex: 1;
                padding: 0.75rem;
                background-color: #6366f1;
                color: white;
                border: none;
                border-radius: 0.5rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;
            " onmouseover="this.style.backgroundColor='#4f46e5'" onmouseout="this.style.backgroundColor='#6366f1'">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.users.index') }}" style="
                padding: 0.75rem 1rem;
                background-color: rgba(99, 102, 241, 0.2);
                color: #6366f1;
                border: 1px solid rgba(99, 102, 241, 0.3);
                border-radius: 0.5rem;
                text-decoration: none;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="data-card">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Nama</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Email</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Telepon</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Role</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 1rem; color: #e5e7eb;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <img src="https://via.placeholder.com/40" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" alt="Avatar">
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #e5e7eb;">{{ $user->email }}</td>
                        <td style="padding: 1rem; color: #e5e7eb;">{{ $user->phone ?? '-' }}</td>
                        <td style="padding: 1rem;">
                            @php
                                $roleClass = '';
                                $roleText = '';
                                if($user->role === 'administrator') {
                                    $roleClass = 'badge-danger';
                                    $roleText = 'Administrator';
                                } elseif($user->role === 'karyawan') {
                                    $roleClass = 'badge-processing';
                                    $roleText = 'Karyawan';
                                } else {
                                    $roleClass = 'badge-success';
                                    $roleText = 'Customer';
                                }
                            @endphp
                            <span class="badge {{ $roleClass }}">{{ $roleText }}</span>
                        </td>
                        <td style="padding: 1rem;">
                            @if($user->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" style="
                                    background-color: rgba(99, 102, 241, 0.2);
                                    color: #6366f1;
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 0.25rem;
                                    text-decoration: none;
                                    font-size: 0.85rem;
                                    transition: all 0.3s ease;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.3rem;
                                " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <!-- Toggle Status Button -->
                                <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="
                                        background-color: rgba(249, 115, 22, 0.2);
                                        color: #fb923c;
                                        padding: 0.4rem 0.8rem;
                                        border-radius: 0.25rem;
                                        border: none;
                                        font-size: 0.85rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 0.3rem;
                                    " onmouseover="this.style.backgroundColor='rgba(249, 115, 22, 0.3)'" onmouseout="this.style.backgroundColor='rgba(249, 115, 22, 0.2)'">
                                        <i class="bi bi-{{ $user->is_active ? 'lock' : 'unlock' }}"></i> {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="
                                        background-color: rgba(239, 68, 68, 0.2);
                                        color: #f87171;
                                        padding: 0.4rem 0.8rem;
                                        border-radius: 0.25rem;
                                        border: none;
                                        font-size: 0.85rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 0.3rem;
                                    " onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.3)'" onmouseout="this.style.backgroundColor='rgba(239, 68, 68, 0.2)'">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 2rem; text-align: center; color: #9ca3af;">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            Tidak ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 2rem; gap: 0.5rem;">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
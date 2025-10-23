@extends('layouts.app')

@section('content')
<div style="padding: 2rem; min-height: calc(100vh - 80px);">
    <div style="max-width: 100%; margin: 0 auto;">
        <!-- Header Section -->
        <div style="margin-bottom: 2.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <div>
                    <h1 style="color: white; font-size: 2.25rem; font-weight: 700; margin: 0 0 0.5rem 0; background: linear-gradient(135deg, #fff 0%, #16a34a 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Data Harga Laundry
                    </h1>
                    <p style="color: rgba(255, 255, 255, 0.6); margin: 0; font-size: 0.95rem;">
                        <i class="bi bi-leaf"></i> Kelola layanan eco-friendly Hejo Laundry
                    </p>
                </div>
                <a href="{{ route('admin.services.create') }}" style="
                    background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                    color: white;
                    padding: 0.875rem 1.75rem;
                    border-radius: 12px;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.625rem;
                    font-weight: 600;
                    font-size: 0.95rem;
                    box-shadow: 0 4px 20px rgba(34, 197, 94, 0.4);
                    transition: all 0.3s ease;
                    border: 1px solid rgba(34, 197, 94, 0.3);
                " onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(34, 197, 94, 0.6)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(34, 197, 94, 0.4)';">
                    <i class="bi bi-plus-circle-fill" style="font-size: 1.1rem;"></i>
                    Tambah Service Baru
                </a>
            </div>
            
            <!-- Stats Bar -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
                <div style="background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;" onmouseover="this.style.borderColor='rgba(34, 197, 94, 0.4)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(34, 197, 94, 0.2)'; this.style.transform='translateY(0)';">
                    <div style="width: 48px; height: 48px; background: rgba(34, 197, 94, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-list-check" style="color: #16a34a; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Service</p>
                        <h3 style="margin: 0; color: white; font-size: 1.75rem; font-weight: 700;">{{ $services->count() }}</h3>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;" onmouseover="this.style.borderColor='rgba(34, 197, 94, 0.4)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(34, 197, 94, 0.2)'; this.style.transform='translateY(0)';">
                    <div style="width: 48px; height: 48px; background: rgba(34, 197, 94, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-circle-fill" style="color: #22c55e; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</p>
                        <h3 style="margin: 0; color: white; font-size: 1.75rem; font-weight: 700;">{{ $services->where('is_active', true)->count() }}</h3>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;" onmouseover="this.style.borderColor='rgba(34, 197, 94, 0.4)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='rgba(34, 197, 94, 0.2)'; this.style.transform='translateY(0)';">
                    <div style="width: 48px; height: 48px; background: rgba(239, 68, 68, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-x-circle-fill" style="color: #ef4444; font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Nonaktif</p>
                        <h3 style="margin: 0; color: white; font-size: 1.75rem; font-weight: 700;">{{ $services->where('is_active', false)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div style="
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideIn 0.3s ease;
        ">
            <div style="width: 40px; height: 40px; background: rgba(34, 197, 94, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-check-circle-fill" style="color: #22c55e; font-size: 1.25rem;"></i>
            </div>
            <span style="color: #22c55e; font-weight: 500; flex: 1;">{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; color: rgba(34, 197, 94, 0.7); cursor: pointer; font-size: 1.25rem; padding: 0; width: 24px; height: 24px;">×</button>
        </div>
        @endif

        @if(session('error'))
        <div style="
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideIn 0.3s ease;
        ">
            <div style="width: 40px; height: 40px; background: rgba(239, 68, 68, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-exclamation-circle-fill" style="color: #ef4444; font-size: 1.25rem;"></i>
            </div>
            <span style="color: #ef4444; font-weight: 500; flex: 1;">{{ session('error') }}</span>
            <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; color: rgba(239, 68, 68, 0.7); cursor: pointer; font-size: 1.25rem; padding: 0; width: 24px; height: 24px;">×</button>
        </div>
        @endif

        <!-- Services Grid View -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
            @forelse($services as $index => $service)
            <div style="
                background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(34, 197, 94, 0.2);
                border-radius: 16px;
                padding: 1.75rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            " onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='rgba(34, 197, 94, 0.5)'; this.style.boxShadow='0 12px 30px rgba(34, 197, 94, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; this.style.boxShadow='none';">
                
                <!-- Decorative Element -->
                <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
                
                <!-- Header Card -->
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1.25rem; position: relative; z-index: 1;">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <div style="width: 42px; height: 42px; background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);">
                                <i class="bi bi-droplet-fill" style="color: white; font-size: 1.25rem;"></i>
                            </div>
                            <h3 style="color: white; font-size: 1.25rem; font-weight: 700; margin: 0;">{{ $service->name }}</h3>
                        </div>
                    </div>
                    <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" style="
                            background: {{ $service->is_active ? 'rgba(34, 197, 94, 0.15)' : 'rgba(239, 68, 68, 0.15)' }};
                            color: {{ $service->is_active ? '#22c55e' : '#ef4444' }};
                            border: 1px solid {{ $service->is_active ? 'rgba(34, 197, 94, 0.3)' : 'rgba(239, 68, 68, 0.3)' }};
                            padding: 0.4rem 0.9rem;
                            border-radius: 20px;
                            font-size: 0.75rem;
                            font-weight: 600;
                            text-transform: uppercase;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            letter-spacing: 0.5px;
                        " onmouseover="this.style.opacity='0.8'; this.style.transform='scale(1.05)';" onmouseout="this.style.opacity='1'; this.style.transform='scale(1)';">
                            <i class="bi bi-{{ $service->is_active ? 'check-circle' : 'x-circle' }}"></i>
                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </div>

                <!-- Description -->
                <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; line-height: 1.6; margin: 0 0 1.25rem 0; min-height: 45px;">
                    {{ Str::limit($service->description, 80) ?? 'Tidak ada deskripsi' }}
                </p>

                <!-- Price & Unit -->
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: rgba(34, 197, 94, 0.05); border-radius: 10px; margin-bottom: 1.25rem; border: 1px solid rgba(34, 197, 94, 0.15);">
                    <div style="flex: 1;">
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;">Harga</p>
                        <p style="margin: 0; color: #22c55e; font-size: 1.5rem; font-weight: 700;">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                    </div>
                    <div style="width: 1px; height: 40px; background: rgba(34, 197, 94, 0.2);"></div>
                    <div style="flex: 1;">
                        <p style="margin: 0; color: rgba(255, 255, 255, 0.6); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;">Unit</p>
                        <p style="margin: 0; color: white; font-size: 1.25rem; font-weight: 600;">{{ $service->unit }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.5rem;">
                    <a href="{{ route('admin.services.show', $service->id) }}" style="
                        background: rgba(168, 85, 247, 0.15);
                        color: #a855f7;
                        border: 1px solid rgba(168, 85, 247, 0.3);
                        padding: 0.65rem;
                        border-radius: 10px;
                        text-decoration: none;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 0.25rem;
                        font-size: 0.8rem;
                        font-weight: 600;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.background='rgba(168, 85, 247, 0.25)'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='rgba(168, 85, 247, 0.15)'; this.style.transform='scale(1)';">
                        <i class="bi bi-eye-fill" style="font-size: 1.1rem;"></i>
                        Detail
                    </a>
                    <a href="{{ route('admin.services.edit', $service->id) }}" style="
                        background: rgba(59, 130, 246, 0.15);
                        color: #3b82f6;
                        border: 1px solid rgba(59, 130, 246, 0.3);
                        padding: 0.65rem;
                        border-radius: 10px;
                        text-decoration: none;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 0.25rem;
                        font-size: 0.8rem;
                        font-weight: 600;
                        transition: all 0.3s ease;
                    " onmouseover="this.style.background='rgba(59, 130, 246, 0.25)'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='rgba(59, 130, 246, 0.15)'; this.style.transform='scale(1)';">
                        <i class="bi bi-pencil-fill" style="font-size: 1.1rem;"></i>
                        Edit
                    </a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus service ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="
                            width: 100%;
                            background: rgba(239, 68, 68, 0.15);
                            color: #ef4444;
                            border: 1px solid rgba(239, 68, 68, 0.3);
                            padding: 0.65rem;
                            border-radius: 10px;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 0.25rem;
                            font-size: 0.8rem;
                            font-weight: 600;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='rgba(239, 68, 68, 0.25)'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='rgba(239, 68, 68, 0.15)'; this.style.transform='scale(1)';">
                            <i class="bi bi-trash-fill" style="font-size: 1.1rem;"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; padding: 4rem; text-align: center;">
                <div style="max-width: 400px; margin: 0 auto;">
                    <div style="width: 120px; height: 120px; background: rgba(34, 197, 94, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <i class="bi bi-droplet" style="font-size: 3.5rem; color: rgba(34, 197, 94, 0.4);"></i>
                    </div>
                    <h3 style="color: white; font-size: 1.5rem; font-weight: 700; margin: 0 0 0.5rem 0;">Belum Ada Service</h3>
                    <p style="margin: 0 0 1.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.95rem;">Mulai dengan menambahkan service eco-friendly pertama Anda</p>
                    <a href="{{ route('admin.services.create') }}" style="
                        background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                        color: white;
                        padding: 0.875rem 1.75rem;
                        border-radius: 12px;
                        text-decoration: none;
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        font-weight: 600;
                        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
                        transition: all 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(34, 197, 94, 0.6)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 197, 94, 0.4)';">
                        <i class="bi bi-plus-circle-fill"></i>
                        Tambah Service
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .layout-content {
        padding: 1rem !important;
    }
    
    div[style*="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr))"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection
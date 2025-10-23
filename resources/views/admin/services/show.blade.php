@extends('layouts.app')

@section('content')
<div style="padding: 2rem; min-height: calc(100vh - 80px);">
    <div style="max-width: 1000px; margin: 0 auto;">
        <!-- Back Button with Animation -->
        <a href="{{ route('admin.services') }}" style="
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
        " onmouseover="this.style.color='#16a34a'; this.style.background='rgba(34, 197, 94, 0.2)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.7)'; this.style.background='rgba(34, 197, 94, 0.1)'; this.style.transform='translateX(0)'">
            <i class="bi bi-arrow-left-circle-fill" style="font-size: 1.2rem;"></i>
            <span style="font-weight: 500;">Kembali ke Data Service</span>
        </a>

        <!-- Main Content Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <!-- Left Column - Service Details -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <!-- Service Card -->
                <div style="
                    background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
                    backdrop-filter: blur(20px);
                    border-radius: 24px;
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    padding: 2.5rem;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
                    position: relative;
                    overflow: hidden;
                ">
                    <!-- Decorative Background -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(168, 85, 247, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>
                    
                    <!-- Icon & Title -->
                    <div style="position: relative; z-index: 1; margin-bottom: 2rem;">
                        <div style="
                            width: 80px;
                            height: 80px;
                            background: linear-gradient(135deg, #a855f7 0%, #6366f1 100%);
                            border-radius: 20px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 1.5rem;
                            box-shadow: 0 10px 30px rgba(168, 85, 247, 0.4);
                        ">
                            <i class="bi bi-droplet-fill" style="color: white; font-size: 2.5rem;"></i>
                        </div>
                        <h1 style="color: white; font-size: 2.25rem; font-weight: 700; margin: 0 0 0.5rem 0;">
                            {{ $service->name }}
                        </h1>
                        <div style="display: inline-block;">
                            @if($service->is_active)
                            <span style="
                                background: rgba(34, 197, 94, 0.15);
                                color: #22c55e;
                                border: 1px solid rgba(34, 197, 94, 0.3);
                                padding: 0.5rem 1rem;
                                border-radius: 20px;
                                font-size: 0.875rem;
                                font-weight: 600;
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                                display: inline-flex;
                                align-items: center;
                                gap: 0.5rem;
                            ">
                                <i class="bi bi-check-circle-fill"></i>
                                Aktif
                            </span>
                            @else
                            <span style="
                                background: rgba(239, 68, 68, 0.15);
                                color: #ef4444;
                                border: 1px solid rgba(239, 68, 68, 0.3);
                                padding: 0.5rem 1rem;
                                border-radius: 20px;
                                font-size: 0.875rem;
                                font-weight: 600;
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                                display: inline-flex;
                                align-items: center;
                                gap: 0.5rem;
                            ">
                                <i class="bi bi-x-circle-fill"></i>
                                Nonaktif
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div style="position: relative; z-index: 1; margin-bottom: 2rem;">
                        <h3 style="
                            color: rgba(255, 255, 255, 0.6);
                            font-size: 0.875rem;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            margin: 0 0 0.75rem 0;
                        ">
                            <i class="bi bi-file-text" style="margin-right: 0.5rem; color: #16a34a;"></i>
                            Deskripsi
                        </h3>
                        <p style="
                            color: rgba(255, 255, 255, 0.8);
                            font-size: 1.05rem;
                            line-height: 1.8;
                            margin: 0;
                        ">
                            {{ $service->description ?? 'Tidak ada deskripsi tersedia untuk layanan ini.' }}
                        </p>
                    </div>

                    <!-- Divider -->
                    <div style="height: 1px; background: linear-gradient(90deg, transparent, rgba(34, 197, 94, 0.2), transparent); margin: 2rem 0;"></div>

                    <!-- Service Info Grid -->
                    <div style="position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <!-- Price Info -->
                        <div style="
                            background: rgba(34, 197, 94, 0.05);
                            border-radius: 16px;
                            padding: 1.5rem;
                            border: 1px solid rgba(34, 197, 94, 0.2);
                        ">
                            <div style="
                                width: 48px;
                                height: 48px;
                                background: rgba(34, 197, 94, 0.2);
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-bottom: 1rem;
                            ">
                                <i class="bi bi-cash-coin" style="color: #22c55e; font-size: 1.5rem;"></i>
                            </div>
                            <p style="margin: 0 0 0.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                Harga
                            </p>
                            <p style="margin: 0; color: #22c55e; font-size: 1.75rem; font-weight: 700;">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Unit Info -->
                        <div style="
                            background: rgba(59, 130, 246, 0.05);
                            border-radius: 16px;
                            padding: 1.5rem;
                            border: 1px solid rgba(59, 130, 246, 0.2);
                        ">
                            <div style="
                                width: 48px;
                                height: 48px;
                                background: rgba(59, 130, 246, 0.2);
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-bottom: 1rem;
                            ">
                                <i class="bi bi-rulers" style="color: #3b82f6; font-size: 1.5rem;"></i>
                            </div>
                            <p style="margin: 0 0 0.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                Unit
                            </p>
                            <p style="margin: 0; color: #3b82f6; font-size: 1.75rem; font-weight: 700; text-transform: uppercase;">
                                {{ $service->unit }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Actions & Timeline -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <!-- Quick Actions Card -->
                <div style="
                    background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
                    backdrop-filter: blur(20px);
                    border-radius: 24px;
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    padding: 2rem;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
                ">
                    <h3 style="
                        color: white;
                        font-size: 1.25rem;
                        font-weight: 700;
                        margin: 0 0 1.5rem 0;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="bi bi-lightning-charge-fill" style="color: #f59e0b;"></i>
                        Quick Actions
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.services.edit', $service->id) }}" style="
                            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
                            border: 1px solid rgba(59, 130, 246, 0.3);
                            color: #3b82f6;
                            padding: 1.25rem;
                            border-radius: 16px;
                            text-decoration: none;
                            display: flex;
                            align-items: center;
                            gap: 1rem;
                            font-weight: 600;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='linear-gradient(135deg, rgba(59, 130, 246, 0.25) 0%, rgba(59, 130, 246, 0.1) 100%)'; this.style.transform='translateX(5px)'" onmouseout="this.style.background='linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%)'; this.style.transform='translateX(0)'">
                            <div style="
                                width: 48px;
                                height: 48px;
                                background: rgba(59, 130, 246, 0.2);
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <i class="bi bi-pencil-fill" style="font-size: 1.25rem;"></i>
                            </div>
                            <div style="flex: 1;">
                                <p style="margin: 0; font-size: 1rem;">Edit Service</p>
                                <p style="margin: 0; font-size: 0.875rem; color: rgba(59, 130, 246, 0.7);">Ubah informasi service</p>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <!-- Toggle Status Button -->
                        <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="
                                width: 100%;
                                background: linear-gradient(135deg, {{ $service->is_active ? 'rgba(239, 68, 68, 0.15)' : 'rgba(34, 197, 94, 0.15)' }} 0%, {{ $service->is_active ? 'rgba(239, 68, 68, 0.05)' : 'rgba(34, 197, 94, 0.05)' }} 100%);
                                border: 1px solid {{ $service->is_active ? 'rgba(239, 68, 68, 0.3)' : 'rgba(34, 197, 94, 0.3)' }};
                                color: {{ $service->is_active ? '#ef4444' : '#22c55e' }};
                                padding: 1.25rem;
                                border-radius: 16px;
                                display: flex;
                                align-items: center;
                                gap: 1rem;
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                                <div style="
                                    width: 48px;
                                    height: 48px;
                                    background: {{ $service->is_active ? 'rgba(239, 68, 68, 0.2)' : 'rgba(34, 197, 94, 0.2)' }};
                                    border-radius: 12px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                    <i class="bi bi-{{ $service->is_active ? 'x-circle' : 'check-circle' }}-fill" style="font-size: 1.25rem;"></i>
                                </div>
                                <div style="flex: 1; text-align: left;">
                                    <p style="margin: 0; font-size: 1rem;">{{ $service->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Service</p>
                                    <p style="margin: 0; font-size: 0.875rem; color: {{ $service->is_active ? 'rgba(239, 68, 68, 0.7)' : 'rgba(34, 197, 94, 0.7)' }};">{{ $service->is_active ? 'Sembunyikan dari pelanggan' : 'Tampilkan ke pelanggan' }}</p>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus service ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="
                                width: 100%;
                                background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
                                border: 1px solid rgba(239, 68, 68, 0.3);
                                color: #ef4444;
                                padding: 1.25rem;
                                border-radius: 16px;
                                display: flex;
                                align-items: center;
                                gap: 1rem;
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            " onmouseover="this.style.background='linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(239, 68, 68, 0.1) 100%)'; this.style.transform='translateX(5px)'" onmouseout="this.style.background='linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%)'; this.style.transform='translateX(0)'">
                                <div style="
                                    width: 48px;
                                    height: 48px;
                                    background: rgba(239, 68, 68, 0.2);
                                    border-radius: 12px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                    <i class="bi bi-trash-fill" style="font-size: 1.25rem;"></i>
                                </div>
                                <div style="flex: 1; text-align: left;">
                                    <p style="margin: 0; font-size: 1rem;">Hapus Service</p>
                                    <p style="margin: 0; font-size: 0.875rem; color: rgba(239, 68, 68, 0.7);">Hapus permanent dari sistem</p>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Service Timeline Card -->
                <div style="
                    background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
                    backdrop-filter: blur(20px);
                    border-radius: 24px;
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    padding: 2rem;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
                ">
                    <h3 style="
                        color: white;
                        font-size: 1.25rem;
                        font-weight: 700;
                        margin: 0 0 1.5rem 0;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="bi bi-clock-history" style="color: #a855f7;"></i>
                        Informasi Waktu
                    </h3>

                    <!-- Timeline Items -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <!-- Created At -->
                        <div style="display: flex; gap: 1rem; align-items: start;">
                            <div style="
                                width: 40px;
                                height: 40px;
                                background: rgba(168, 85, 247, 0.2);
                                border-radius: 10px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                            ">
                                <i class="bi bi-plus-circle-fill" style="color: #a855f7; font-size: 1.1rem;"></i>
                            </div>
                            <div style="flex: 1;">
                                <p style="margin: 0 0 0.25rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Dibuat
                                </p>
                                <p style="margin: 0; color: white; font-size: 1rem; font-weight: 500;">
                                    {{ $service->created_at->format('d M Y, H:i') }}
                                </p>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255, 255, 255, 0.4); font-size: 0.875rem;">
                                    {{ $service->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div style="height: 1px; background: linear-gradient(90deg, transparent, rgba(34, 197, 94, 0.2), transparent);"></div>

                        <!-- Updated At -->
                        <div style="display: flex; gap: 1rem; align-items: start;">
                            <div style="
                                width: 40px;
                                height: 40px;
                                background: rgba(59, 130, 246, 0.2);
                                border-radius: 10px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                            ">
                                <i class="bi bi-pencil-fill" style="color: #3b82f6; font-size: 1.1rem;"></i>
                            </div>
                            <div style="flex: 1;">
                                <p style="margin: 0 0 0.25rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Terakhir Diupdate
                                </p>
                                <p style="margin: 0; color: white; font-size: 1rem; font-weight: 500;">
                                    {{ $service->updated_at->format('d M Y, H:i') }}
                                </p>
                                <p style="margin: 0.25rem 0 0 0; color: rgba(255, 255, 255, 0.4); font-size: 0.875rem;">
                                    {{ $service->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service ID Card -->
                <div style="
                    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0.05) 100%);
                    border: 1px solid rgba(99, 102, 241, 0.3);
                    border-radius: 16px;
                    padding: 1.5rem;
                ">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="
                            width: 48px;
                            height: 48px;
                            background: rgba(99, 102, 241, 0.2);
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="bi bi-hash" style="color: #6366f1; font-size: 1.5rem;"></i>
                        </div>
                        <div style="flex: 1;">
                            <p style="margin: 0 0 0.25rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                Service ID
                            </p>
                            <p style="margin: 0; color: #6366f1; font-size: 1.25rem; font-weight: 700; font-family: monospace;">
                                #{{ str_pad($service->id, 6, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Section -->
        <div style="
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(34, 197, 94, 0.2);
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        ">
            <!-- Decorative Background -->
            <div style="position: absolute; bottom: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>
            
            <div style="position: relative; z-index: 1;">
                <h3 style="
                    color: white;
                    font-size: 1.5rem;
                    font-weight: 700;
                    margin: 0 0 2rem 0;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                ">
                    <i class="bi bi-graph-up-arrow" style="color: #22c55e;"></i>
                    Pricing Summary
                </h3>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                    <!-- Price per Unit -->
                    <div style="text-align: center;">
                        <div style="
                            width: 64px;
                            height: 64px;
                            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: 0 auto 1rem;
                            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
                        ">
                            <i class="bi bi-cash-stack" style="color: white; font-size: 1.75rem;"></i>
                        </div>
                        <p style="margin: 0 0 0.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                            Harga / {{ $service->unit }}
                        </p>
                        <p style="margin: 0; color: #22c55e; font-size: 1.75rem; font-weight: 700;">
                            {{ number_format($service->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Estimated 5 Units -->
                    <div style="text-align: center;">
                        <div style="
                            width: 64px;
                            height: 64px;
                            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: 0 auto 1rem;
                            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
                        ">
                            <i class="bi bi-calculator" style="color: white; font-size: 1.75rem;"></i>
                        </div>
                        <p style="margin: 0 0 0.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                            Est. 5 {{ $service->unit }}
                        </p>
                        <p style="margin: 0; color: #3b82f6; font-size: 1.75rem; font-weight: 700;">
                            {{ number_format($service->price * 5, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Estimated 10 Units -->
                    <div style="text-align: center;">
                        <div style="
                            width: 64px;
                            height: 64px;
                            background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: 0 auto 1rem;
                            box-shadow: 0 8px 20px rgba(168, 85, 247, 0.4);
                        ">
                            <i class="bi bi-bar-chart-fill" style="color: white; font-size: 1.75rem;"></i>
                        </div>
                        <p style="margin: 0 0 0.5rem 0; color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                            Est. 10 {{ $service->unit }}
                        </p>
                        <p style="margin: 0; color: #a855f7; font-size: 1.75rem; font-weight: 700;">
                            {{ number_format($service->price * 10, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 968px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection
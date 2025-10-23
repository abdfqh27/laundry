@extends('layouts.app')

@section('content')
<div style="padding: 2rem; min-height: calc(100vh - 80px);">
    <div style="max-width: 900px; margin: 0 auto;">
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

        <!-- Header with Gradient -->
        <div style="margin-bottom: 2.5rem; text-align: center;">
            <div style="
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4);
                animation: pulse 2s ease-in-out infinite;
            ">
                <i class="bi bi-pencil-square" style="color: white; font-size: 2.5rem;"></i>
            </div>
            <h1 style="color: white; font-size: 2.5rem; font-weight: 700; margin: 0 0 0.75rem 0; background: linear-gradient(135deg, #fff 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Edit Service
            </h1>
            <p style="color: rgba(255, 255, 255, 0.6); margin: 0; font-size: 1.05rem;">
                <i class="bi bi-pencil"></i> Update informasi layanan eco-friendly Anda
            </p>
        </div>

        <!-- Form Card with Glass Effect -->
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
            <!-- Decorative Elements -->
            <div style="position: absolute; top: -100px; right: -100px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -80px; left: -80px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" style="position: relative; z-index: 1;">
                @csrf
                @method('PUT')

                <!-- Name Field with Icon -->
                <div style="margin-bottom: 2rem;">
                    <label style="
                        display: block;
                        color: white;
                        font-weight: 600;
                        margin-bottom: 0.75rem;
                        font-size: 1rem;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="bi bi-tag-fill" style="color: #3b82f6;"></i>
                        Nama Service <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="position: relative;">
                        <input type="text" name="name" value="{{ old('name', $service->name) }}" required style="
                            width: 100%;
                            padding: 1rem 1rem 1rem 3rem;
                            background: rgba(10, 31, 10, 0.5);
                            border: 2px solid {{ $errors->has('name') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }};
                            border-radius: 12px;
                            color: white;
                            font-size: 1rem;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                        " onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(59, 130, 246, 0.1)'; this.style.transform='scale(1.01)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'" onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }}'; this.style.background='rgba(10, 31, 10, 0.5)'; this.style.transform='scale(1)'; this.style.boxShadow='none'" placeholder="Contoh: Green Wash Premium">
                        <i class="bi bi-droplet-fill" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: rgba(59, 130, 246, 0.5); font-size: 1.1rem;"></i>
                    </div>
                    @error('name')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </span>
                    @enderror
                </div>

                <!-- Description Field with Counter -->
                <div style="margin-bottom: 2rem;">
                    <label style="
                        display: block;
                        color: white;
                        font-weight: 600;
                        margin-bottom: 0.75rem;
                        font-size: 1rem;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="bi bi-file-text-fill" style="color: #3b82f6;"></i>
                        Deskripsi
                    </label>
                    <textarea name="description" rows="4" id="description" maxlength="200" style="
                        width: 100%;
                        padding: 1rem;
                        background: rgba(10, 31, 10, 0.5);
                        border: 2px solid {{ $errors->has('description') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }};
                        border-radius: 12px;
                        color: white;
                        font-size: 1rem;
                        transition: all 0.3s ease;
                        resize: vertical;
                        font-family: inherit;
                        box-sizing: border-box;
                    " onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(59, 130, 246, 0.1)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'" onblur="this.style.borderColor='{{ $errors->has('description') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }}'; this.style.background='rgba(10, 31, 10, 0.5)'; this.style.boxShadow='none'" oninput="updateCharCount()" placeholder="Deskripsikan layanan eco-friendly Anda...">{{ old('description', $service->description) }}</textarea>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
                        @error('description')
                        <span style="color: #ef4444; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </span>
                        @else
                        <span></span>
                        @enderror
                        <span id="charCount" style="color: rgba(255, 255, 255, 0.4); font-size: 0.875rem;">0/200</span>
                    </div>
                </div>

                <!-- Price and Unit Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <!-- Price with Currency Symbol -->
                    <div>
                        <label style="
                            display: block;
                            color: white;
                            font-weight: 600;
                            margin-bottom: 0.75rem;
                            font-size: 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                        ">
                            <i class="bi bi-cash-coin" style="color: #22c55e;"></i>
                            Harga <span style="color: #ef4444;">*</span>
                        </label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: rgba(34, 197, 94, 0.7); font-weight: 600; font-size: 1.1rem;">Rp</span>
                            <input type="number" name="price" value="{{ old('price', $service->price) }}" required min="0" step="1000" style="
                                width: 100%;
                                padding: 1rem 1rem 1rem 3.5rem;
                                background: rgba(10, 31, 10, 0.5);
                                border: 2px solid {{ $errors->has('price') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }};
                                border-radius: 12px;
                                color: white;
                                font-size: 1rem;
                                transition: all 0.3s ease;
                                box-sizing: border-box;
                            " onfocus="this.style.borderColor='#22c55e'; this.style.background='rgba(34, 197, 94, 0.1)'; this.style.transform='scale(1.01)'; this.style.boxShadow='0 0 0 3px rgba(34, 197, 94, 0.15)'" onblur="this.style.borderColor='{{ $errors->has('price') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }}'; this.style.background='rgba(10, 31, 10, 0.5)'; this.style.transform='scale(1)'; this.style.boxShadow='none'" placeholder="6000">
                        </div>
                        @error('price')
                        <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- Unit with Custom Select -->
                    <div>
                        <label style="
                            display: block;
                            color: white;
                            font-weight: 600;
                            margin-bottom: 0.75rem;
                            font-size: 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                        ">
                            <i class="bi bi-rulers" style="color: #3b82f6;"></i>
                            Unit <span style="color: #ef4444;">*</span>
                        </label>
                        <select name="unit" required style="
                            width: 100%;
                            padding: 1rem;
                            background: rgba(10, 31, 10, 0.5);
                            border: 2px solid {{ $errors->has('unit') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }};
                            border-radius: 12px;
                            color: white;
                            font-size: 1rem;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                            cursor: pointer;
                        " onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(59, 130, 246, 0.1)'; this.style.transform='scale(1.01)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'" onblur="this.style.borderColor='{{ $errors->has('unit') ? '#ef4444' : 'rgba(34, 197, 94, 0.3)' }}'; this.style.background='rgba(10, 31, 10, 0.5)'; this.style.transform='scale(1)'; this.style.boxShadow='none'">
                            <option value="" style="background: #0a1f0a;">Pilih Unit</option>
                            <option value="kg" {{ old('unit', $service->unit) == 'kg' ? 'selected' : '' }} style="background: #0a1f0a;">📦 Kilogram (kg)</option>
                            <option value="pcs" {{ old('unit', $service->unit) == 'pcs' ? 'selected' : '' }} style="background: #0a1f0a;">👕 Pieces (pcs)</option>
                            <option value="paket" {{ old('unit', $service->unit) == 'paket' ? 'selected' : '' }} style="background: #0a1f0a;">🎁 Paket</option>
                        </select>
                        @error('unit')
                        <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Status Toggle with Modern Switch -->
                <div style="
                    margin-bottom: 2.5rem;
                    padding: 1.5rem;
                    background: rgba(34, 197, 94, 0.05);
                    border-radius: 12px;
                    border: 1px solid rgba(34, 197, 94, 0.2);
                ">
                    <label style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        cursor: pointer;
                    ">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="
                                width: 48px;
                                height: 48px;
                                background: rgba(34, 197, 94, 0.2);
                                border-radius: 10px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <i class="bi bi-toggle-on" style="color: #22c55e; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <span style="color: white; font-weight: 600; display: block; margin-bottom: 0.25rem;">Status Service</span>
                                <span style="color: rgba(255, 255, 255, 0.6); font-size: 0.875rem;">Aktifkan atau nonaktifkan service eco-friendly ini</span>
                            </div>
                        </div>
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} style="
                            width: 24px;
                            height: 24px;
                            cursor: pointer;
                            accent-color: #22c55e;
                        ">
                    </label>
                </div>

                <!-- Action Buttons with Gradient -->
                <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1rem; border-top: 1px solid rgba(34, 197, 94, 0.2);">
                    <a href="{{ route('admin.services') }}" style="
                        background: rgba(34, 197, 94, 0.05);
                        color: rgba(255, 255, 255, 0.8);
                        padding: 1rem 2rem;
                        border-radius: 12px;
                        text-decoration: none;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        border: 1px solid rgba(34, 197, 94, 0.2);
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                    " onmouseover="this.style.background='rgba(34, 197, 94, 0.15)'; this.style.color='white'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(34, 197, 94, 0.05)'; this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateY(0)'">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                    <button type="submit" style="
                        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                        color: white;
                        padding: 1rem 2.5rem;
                        border-radius: 12px;
                        border: none;
                        font-weight: 600;
                        cursor: pointer;
                        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
                        transition: all 0.3s ease;
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                        font-size: 1rem;
                    " onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 35px rgba(59, 130, 246, 0.6)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.4)'">
                        <i class="bi bi-save-fill"></i>
                        Update Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Custom scrollbar untuk textarea */
textarea::-webkit-scrollbar {
    width: 8px;
}

textarea::-webkit-scrollbar-track {
    background: rgba(34, 197, 94, 0.05);
    border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb {
    background: rgba(34, 197, 94, 0.3);
    border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: rgba(34, 197, 94, 0.5);
}

@media (max-width: 768px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<script>
function updateCharCount() {
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    const current = textarea.value.length;
    charCount.textContent = current + '/200';
    
    if (current > 180) {
        charCount.style.color = '#ef4444';
    } else if (current > 150) {
        charCount.style.color = '#f59e0b';
    } else {
        charCount.style.color = 'rgba(255, 255, 255, 0.4)';
    }
}

// Initialize char count on page load
document.addEventListener('DOMContentLoaded', updateCharCount);
</script>
@endsection
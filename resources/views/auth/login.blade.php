@extends('layouts.auth')

@section('title', 'Login - Hejo Laundry')

@section('content')
<div style="
    min-height: calc(100vh - 80px);
    background: #0a1f0a;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem 1rem;
    position: relative;
    overflow: hidden;
">
    <!-- Animated Background Elements -->
    <div style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
    ">
        <!-- Main gradient orbs -->
        <div style="
            position: absolute;
            top: -20%;
            right: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        "></div>
        <div style="
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        "></div>
        
        <!-- Decorative elements -->
        <div style="
            position: absolute;
            top: 15%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        "></div>
        <div style="
            position: absolute;
            bottom: 25%;
            right: 15%;
            width: 60px;
            height: 60px;
            background: rgba(22, 163, 74, 0.08);
            border-radius: 50%;
            animation: pulse 5s ease-in-out infinite reverse;
        "></div>
    </div>

    <!-- Main Login Card -->
    <div style="
        background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 80px rgba(34, 197, 94, 0.1);
        position: relative;
        z-index: 1;
    ">
        <!-- Decorative corner accent -->
        <div style="
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            height: 4px;
            background: linear-gradient(90deg, #16a34a 0%, transparent 100%);
            border-radius: 20px 20px 0 0;
        "></div>

        <!-- Logo & Title -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div style="
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 90px;
                height: 90px;
                background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                border-radius: 50%;
                margin-bottom: 1.5rem;
                box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
                position: relative;
            ">
                <i class="bi bi-droplet-fill" style="
                    font-size: 3rem;
                    color: white;
                "></i>
                <!-- Glow effect -->
                <div style="
                    position: absolute;
                    inset: -5px;
                    background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                    border-radius: 50%;
                    opacity: 0.3;
                    filter: blur(15px);
                    z-index: -1;
                "></div>
            </div>
            
            <h1 style="
                font-size: 2.5rem;
                font-weight: 800;
                margin: 0 0 0.5rem 0;
                background: linear-gradient(135deg, #fff 0%, #16a34a 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: none;
            ">Hejo Laundry</h1>
            
            <p style="
                color: rgba(255, 255, 255, 0.7);
                font-size: 1rem;
                margin: 0;
                font-weight: 500;
            ">
                <i class="bi bi-leaf" style="color: #16a34a; margin-right: 0.25rem;"></i>
                Masuk ke Dashboard Hijau Anda
            </p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.store') }}" style="margin-bottom: 2rem;">
            @csrf

            <!-- Email Field -->
            <div style="margin-bottom: 1.5rem;">
                <label style="
                    display: block;
                    color: rgba(255, 255, 255, 0.9);
                    font-weight: 600;
                    margin-bottom: 0.75rem;
                    font-size: 0.95rem;
                ">
                    <i class="bi bi-envelope" style="margin-right: 0.5rem; color: #16a34a;"></i>Email
                </label>
                <div style="position: relative;">
                    <input type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        placeholder="contoh@email.com"
                        style="
                            width: 100%;
                            padding: 1rem 1rem 1rem 3rem;
                            background: rgba(10, 31, 10, 0.5);
                            border: 1px solid rgba(34, 197, 94, 0.3);
                            border-radius: 12px;
                            color: white;
                            font-size: 1rem;
                            transition: all 0.3s ease;
                            outline: none;
                        "
                        onfocus="this.style.borderColor='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.boxShadow='0 0 0 3px rgba(34, 197, 94, 0.15)'; this.previousElementSibling.style.color='#16a34a'"
                        onblur="this.style.borderColor='rgba(34, 197, 94, 0.3)'; this.style.backgroundColor='rgba(10, 31, 10, 0.5)'; this.style.boxShadow='none'; this.previousElementSibling.style.color='rgba(255,255,255,0.4)'"
                    >
                    <i class="bi bi-envelope" style="
                        position: absolute;
                        left: 1rem;
                        top: 50%;
                        transform: translateY(-50%);
                        color: rgba(255, 255, 255, 0.4);
                        transition: color 0.3s ease;
                    "></i>
                </div>
                @error('email')
                    <p style="
                        color: #fca5a5;
                        font-size: 0.875rem;
                        margin-top: 0.5rem;
                        margin-bottom: 0;
                        display: flex;
                        align-items: center;
                        gap: 0.25rem;
                    ">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Field -->
            <div style="margin-bottom: 1.25rem;">
                <label style="
                    display: block;
                    color: rgba(255, 255, 255, 0.9);
                    font-weight: 600;
                    margin-bottom: 0.75rem;
                    font-size: 0.95rem;
                ">
                    <i class="bi bi-lock" style="margin-right: 0.5rem; color: #16a34a;"></i>Password
                </label>
                <div style="position: relative;">
                    <input type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="Masukkan password Anda"
                        style="
                            width: 100%;
                            padding: 1rem 1rem 1rem 3rem;
                            background: rgba(10, 31, 10, 0.5);
                            border: 1px solid rgba(34, 197, 94, 0.3);
                            border-radius: 12px;
                            color: white;
                            font-size: 1rem;
                            transition: all 0.3s ease;
                            outline: none;
                        "
                        onfocus="this.style.borderColor='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.boxShadow='0 0 0 3px rgba(34, 197, 94, 0.15)'; this.previousElementSibling.style.color='#16a34a'"
                        onblur="this.style.borderColor='rgba(34, 197, 94, 0.3)'; this.style.backgroundColor='rgba(10, 31, 10, 0.5)'; this.style.boxShadow='none'; this.previousElementSibling.style.color='rgba(255,255,255,0.4)'"
                    >
                    <i class="bi bi-lock" style="
                        position: absolute;
                        left: 1rem;
                        top: 50%;
                        transform: translateY(-50%);
                        color: rgba(255, 255, 255, 0.4);
                        transition: color 0.3s ease;
                    "></i>
                </div>
                @error('password')
                    <p style="
                        color: #fca5a5;
                        font-size: 0.875rem;
                        margin-top: 0.5rem;
                        margin-bottom: 0;
                        display: flex;
                        align-items: center;
                        gap: 0.25rem;
                    ">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 2rem;
            ">
                <div style="display: flex; align-items: center;">
                    <input type="checkbox" 
                        id="remember" 
                        name="remember" 
                        style="
                            width: 18px;
                            height: 18px;
                            cursor: pointer;
                            accent-color: #16a34a;
                        "
                    >
                    <label for="remember" style="
                        color: rgba(255, 255, 255, 0.7);
                        font-size: 0.9rem;
                        cursor: pointer;
                        margin-left: 0.5rem;
                    ">
                        Ingat saya
                    </label>
                </div>
                <a href="#" style="
                    color: #16a34a;
                    text-decoration: none;
                    font-size: 0.9rem;
                    font-weight: 500;
                    transition: color 0.3s ease;
                "
                    onmouseover="this.style.color='#22c55e'"
                    onmouseout="this.style.color='#16a34a'"
                >
                    Lupa Password?
                </a>
            </div>

            <!-- Login Button -->
            <button type="submit" style="
                width: 100%;
                padding: 1rem;
                background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                color: white;
                border: none;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1.05rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
                position: relative;
                overflow: hidden;
            "
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 197, 94, 0.6)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 197, 94, 0.4)'"
            >
                <i class="bi bi-box-arrow-in-right"></i>
                Login ke Dashboard
            </button>
        </form>

        <!-- Divider -->
        <div style="
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
        ">
            <div style="flex: 1; height: 1px; background: rgba(34, 197, 94, 0.2);"></div>
            <span style="color: rgba(255, 255, 255, 0.5); font-size: 0.875rem;">atau</span>
            <div style="flex: 1; height: 1px; background: rgba(34, 197, 94, 0.2);"></div>
        </div>

        <!-- Register Link -->
        <div style="
            text-align: center;
            background: rgba(34, 197, 94, 0.05);
            border: 1px solid rgba(34, 197, 94, 0.15);
            border-radius: 12px;
            padding: 1.5rem;
        ">
            <p style="
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.95rem;
                margin: 0 0 1rem 0;
            ">
                Belum bergabung dengan gerakan hijau kami?
            </p>
            <a href="{{ route('register') }}" style="
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: #16a34a;
                text-decoration: none;
                font-weight: 600;
                padding: 0.875rem 1.75rem;
                border: 2px solid rgba(34, 197, 94, 0.4);
                border-radius: 12px;
                transition: all 0.3s ease;
                background: rgba(34, 197, 94, 0.1);
            "
                onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.2)'; this.style.borderColor='#16a34a'; this.style.transform='translateY(-2px)'"
                onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.4)'; this.style.transform='translateY(0)'"
            >
                <i class="bi bi-person-plus"></i> Daftar Sekarang
            </a>
        </div>
    </div>

    <!-- Bottom Info -->
    <div style="
        text-align: center;
        margin-top: 3rem;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.875rem;
        position: relative;
        z-index: 1;
    ">
        <p style="margin: 0 0 0.5rem 0;">
            <i class="bi bi-leaf" style="color: #16a34a;"></i> 
            Bersama menjaga bumi untuk masa depan yang lebih hijau
        </p>
        <p style="margin: 0;">
            © 2025 Hejo Laundry. All rights reserved.
        </p>
    </div>
</div>

<!-- Animations & Styles -->
<style>
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px); 
        }
        50% { 
            transform: translateY(-20px); 
        }
    }

    @keyframes pulse {
        0%, 100% { 
            transform: scale(1);
            opacity: 0.5;
        }
        50% { 
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-text-fill-color: white !important;
        -webkit-box-shadow: 0 0 0px 1000px rgba(10, 31, 10, 0.5) inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }

    @media (max-width: 640px) {
        input, button, select, textarea {
            font-size: 16px !important;
        }
    }
</style>
@endsection
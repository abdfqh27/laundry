<nav style="
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background: rgba(10, 31, 10, 0.95);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    box-shadow: 0 4px 20px rgba(34, 197, 94, 0.2);
    border-bottom: 1px solid rgba(34, 197, 94, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
    transition: all 0.3s ease;
">
    <!-- Logo & Brand -->
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="{{ route('index') }}" style="
            font-size: 1.5rem;
            font-weight: 700;
            color: #16a34a;
            text-decoration: none;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        "
            onmouseover="this.style.transform='scale(1.05)'; this.style.color='#22c55e'"
            onmouseout="this.style.transform='scale(1)'; this.style.color='#16a34a'"
        >
            <i class="bi bi-droplet-fill"></i>
            Hejo Laundry
        </a>
    </div>

    <!-- Right Side Navigation -->
    <div style="display: flex; align-items: center; gap: 1.5rem;">
        
        @guest
            <!-- UNTUK GUEST (TIDAK LOGIN) -->
            
            <!-- Login Button -->
            <a href="{{ route('login') }}" style="
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                padding: 0.5rem 1rem;
                border-radius: 8px;
            " 
                onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
            >
                <i class="bi bi-box-arrow-in-right" style="margin-right: 0.25rem;"></i>
                Login
            </a>

            <!-- Register Button -->
            <a href="{{ route('register') }}" style="
                background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
                color: white;
                padding: 0.625rem 1.5rem;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            " 
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(34, 197, 94, 0.6)'" 
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 197, 94, 0.4)'"
            >
                <i class="bi bi-leaf"></i>
                Daftar Sekarang
            </a>

        @else
            <!-- UNTUK AUTHENTICATED USER (SUDAH LOGIN) -->
            
            <!-- Notification Bell -->
            <button style="
                background: rgba(34, 197, 94, 0.1);
                border: 1px solid rgba(34, 197, 94, 0.2);
                color: #16a34a;
                font-size: 1.2rem;
                cursor: pointer;
                position: relative;
                transition: all 0.3s ease;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            " 
                onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.2)'; this.style.borderColor='#16a34a'; this.style.transform='scale(1.1)'" 
                onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; this.style.transform='scale(1)'"
            >
                <i class="bi bi-bell-fill"></i>
                <span style="
                    position: absolute;
                    top: -2px;
                    right: -2px;
                    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                    color: white;
                    width: 18px;
                    height: 18px;
                    border-radius: 50%;
                    font-size: 0.65rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 700;
                    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
                ">3</span>
            </button>

            <!-- User Profile Dropdown -->
            <div class="dropdown" style="position: relative; display: inline-block;">
                <button style="
                    background: rgba(34, 197, 94, 0.1);
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    color: rgba(255, 255, 255, 0.9);
                    font-size: 0.95rem;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    transition: all 0.3s ease;
                    padding: 0.5rem 1rem;
                    border-radius: 50px;
                " 
                    class="dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.2)'; this.style.borderColor='#16a34a'"
                    onmouseout="this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'"
                >
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 700;
                        font-size: 0.9rem;
                        box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
                    ">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span style="font-weight: 600;">{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down" style="font-size: 0.75rem; color: #16a34a;"></i>
                </button>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" style="
                    background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
                    border: 1px solid rgba(34, 197, 94, 0.2);
                    min-width: 220px;
                    border-radius: 12px;
                    padding: 0.5rem;
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
                    margin-top: 0.5rem;
                ">
                    <!-- User Info Header -->
                    <li style="
                        padding: 0.75rem 1rem;
                        border-bottom: 1px solid rgba(34, 197, 94, 0.2);
                        margin-bottom: 0.5rem;
                    ">
                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;
                        ">
                            <div style="
                                width: 40px;
                                height: 40px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: 700;
                                font-size: 1rem;
                                box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
                            ">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="
                                    color: white;
                                    font-weight: 600;
                                    font-size: 0.9rem;
                                ">{{ auth()->user()->name }}</div>
                                <div style="
                                    color: #16a34a;
                                    font-size: 0.75rem;
                                    font-weight: 500;
                                    text-transform: capitalize;
                                ">{{ auth()->user()->role }}</div>
                            </div>
                        </div>
                    </li>

                    <!-- Profile Menu Item -->
                    <li>
                        <a class="dropdown-item" href="#" style="
                            color: rgba(255, 255, 255, 0.8);
                            padding: 0.75rem 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;
                            transition: all 0.3s ease;
                            border-radius: 8px;
                            text-decoration: none;
                        " 
                            onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                            onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
                        >
                            <i class="bi bi-person-circle" style="font-size: 1.1rem;"></i> 
                            <span>Profil Saya</span>
                        </a>
                    </li>

                    <!-- Role-based Menu Items -->
                    @if(auth()->user()->role === 'administrator')
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}" style="
                                color: rgba(255, 255, 255, 0.8);
                                padding: 0.75rem 1rem;
                                display: flex;
                                align-items: center;
                                gap: 0.75rem;
                                transition: all 0.3s ease;
                                border-radius: 8px;
                                text-decoration: none;
                            " 
                                onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                                onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
                            >
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i> 
                                <span>Admin Dashboard</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->role === 'karyawan')
                        <li>
                            <a class="dropdown-item" href="{{ route('karyawan.dashboard') }}" style="
                                color: rgba(255, 255, 255, 0.8);
                                padding: 0.75rem 1rem;
                                display: flex;
                                align-items: center;
                                gap: 0.75rem;
                                transition: all 0.3s ease;
                                border-radius: 8px;
                                text-decoration: none;
                            " 
                                onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                                onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
                            >
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i> 
                                <span>Karyawan Dashboard</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item" href="{{ route('customer.dashboard') }}" style="
                                color: rgba(255, 255, 255, 0.8);
                                padding: 0.75rem 1rem;
                                display: flex;
                                align-items: center;
                                gap: 0.75rem;
                                transition: all 0.3s ease;
                                border-radius: 8px;
                                text-decoration: none;
                            " 
                                onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                                onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
                            >
                                <i class="bi bi-speedometer2" style="font-size: 1.1rem;"></i> 
                                <span>Customer Dashboard</span>
                            </a>
                        </li>
                    @endif

                    <!-- Settings Menu Item -->
                    <li>
                        <a class="dropdown-item" href="#" style="
                            color: rgba(255, 255, 255, 0.8);
                            padding: 0.75rem 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;
                            transition: all 0.3s ease;
                            border-radius: 8px;
                            text-decoration: none;
                        " 
                            onmouseover="this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'" 
                            onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.backgroundColor='transparent'"
                        >
                            <i class="bi bi-gear-fill" style="font-size: 1.1rem;"></i> 
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li><hr class="dropdown-divider" style="border-color: rgba(34, 197, 94, 0.2); margin: 0.5rem 0;"></li>

                    <!-- Logout Menu Item -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="
                                color: #fca5a5;
                                padding: 0.75rem 1rem;
                                display: flex;
                                align-items: center;
                                gap: 0.75rem;
                                width: 100%;
                                text-align: left;
                                border: none;
                                background: none;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                border-radius: 8px;
                            " 
                                onmouseover="this.style.color='#ef4444'; this.style.backgroundColor='rgba(239, 68, 68, 0.1)'" 
                                onmouseout="this.style.color='#fca5a5'; this.style.backgroundColor='transparent'"
                            >
                                <i class="bi bi-box-arrow-right" style="font-size: 1.1rem;"></i> 
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </div>
</nav>

<!-- Navbar Scroll Effect Script -->
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(10, 31, 10, 0.98)';
            navbar.style.boxShadow = '0 4px 30px rgba(34, 197, 94, 0.3)';
        } else {
            navbar.style.background = 'rgba(10, 31, 10, 0.95)';
            navbar.style.boxShadow = '0 4px 20px rgba(34, 197, 94, 0.2)';
        }
    });
</script>
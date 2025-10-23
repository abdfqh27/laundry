<aside style="
    background: linear-gradient(180deg, #1a3a1a 0%, #0f2a0f 100%);
    width: 250px;
    min-height: calc(100vh - 80px);
    padding: 2rem 0;
    border-right: 1px solid rgba(34, 197, 94, 0.2);
    position: fixed;
    left: 0;
    top: 80px;
    overflow-y: auto;
    z-index: 999;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
">
    <!-- Sidebar Header -->
    <div style="
        padding: 0 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(34, 197, 94, 0.2);
        margin-bottom: 1.5rem;
    ">
        <div style="
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
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
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            ">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h6 style="
                    font-size: 0.95rem;
                    font-weight: 600;
                    color: white;
                    margin: 0 0 0.25rem 0;
                ">{{ auth()->user()->name }}</h6>
                <span style="
                    font-size: 0.75rem;
                    color: #16a34a;
                    font-weight: 500;
                    text-transform: capitalize;
                    background: rgba(34, 197, 94, 0.1);
                    padding: 0.15rem 0.5rem;
                    border-radius: 0.25rem;
                    border: 1px solid rgba(34, 197, 94, 0.3);
                ">{{ auth()->user()->role }}</span>
            </div>
        </div>
        <h5 style="
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.5);
            margin: 0;
        ">
            <i class="bi bi-list" style="margin-right: 0.5rem; color: #16a34a;"></i>
            MENU
        </h5>
    </div>

    <!-- Navigation -->
    <nav style="
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        padding: 0 0.75rem;
    ">
        @if(auth()->user()->role === 'administrator')
            <!-- Admin Menu -->
            <a href="{{ route('admin.dashboard') }}" style="
                color: {{ Route::currentRouteName() === 'admin.dashboard' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'admin.dashboard' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'admin.dashboard' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'admin.dashboard') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'admin.dashboard') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-speedometer2" style="font-size: 1.15rem; width: 20px;"></i>
                Dashboard
                @if(Route::currentRouteName() === 'admin.dashboard')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('admin.users.index') }}" style="
                color: {{ str_contains(Route::currentRouteName(), 'admin.users') ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ str_contains(Route::currentRouteName(), 'admin.users') ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ str_contains(Route::currentRouteName(), 'admin.users') ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if(!'{{ str_contains(Route::currentRouteName(), 'admin.users') }}') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if(!'{{ str_contains(Route::currentRouteName(), 'admin.users') }}') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-people-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Kelola User
                @if(str_contains(Route::currentRouteName(), 'admin.users'))
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('transaction.index') }}" style="
                color: {{ str_contains(Route::currentRouteName(), 'transaction') ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ str_contains(Route::currentRouteName(), 'transaction') ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ str_contains(Route::currentRouteName(), 'transaction') ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if(!'{{ str_contains(Route::currentRouteName(), 'transaction') }}') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if(!'{{ str_contains(Route::currentRouteName(), 'transaction') }}') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-credit-card-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Data Transaksi
                @if(str_contains(Route::currentRouteName(), 'transaction'))
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('admin.services') }}" style="
                color: {{ Route::currentRouteName() === 'admin.services' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'admin.services' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'admin.services' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'admin.services') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'admin.services') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-tags-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Data Harga
                @if(Route::currentRouteName() === 'admin.services')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('admin.targets') }}" style="
                color: {{ Route::currentRouteName() === 'admin.targets' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'admin.targets' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'admin.targets' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'admin.targets') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'admin.targets') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-bullseye" style="font-size: 1.15rem; width: 20px;"></i>
                Target Laundry
                @if(Route::currentRouteName() === 'admin.targets')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('admin.settings') }}" style="
                color: {{ Route::currentRouteName() === 'admin.settings' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'admin.settings' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'admin.settings' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'admin.settings') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'admin.settings') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-gear-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Setting
                @if(Route::currentRouteName() === 'admin.settings')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

        @elseif(auth()->user()->role === 'karyawan')
            <!-- Karyawan Menu -->
            <a href="{{ route('karyawan.dashboard') }}" style="
                color: {{ Route::currentRouteName() === 'karyawan.dashboard' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'karyawan.dashboard' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'karyawan.dashboard' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'karyawan.dashboard') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'karyawan.dashboard') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-speedometer2" style="font-size: 1.15rem; width: 20px;"></i>
                Dashboard
                @if(Route::currentRouteName() === 'karyawan.dashboard')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('karyawan.orders') }}" style="
                color: {{ Route::currentRouteName() === 'karyawan.orders' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'karyawan.orders' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'karyawan.orders' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'karyawan.orders') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'karyawan.orders') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-clipboard-check-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Data Order
                @if(Route::currentRouteName() === 'karyawan.orders')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('karyawan.customers') }}" style="
                color: {{ Route::currentRouteName() === 'karyawan.customers' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'karyawan.customers' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'karyawan.customers' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'karyawan.customers') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'karyawan.customers') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-people-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Data Customer
                @if(Route::currentRouteName() === 'karyawan.customers')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('transaction.index') }}" style="
                color: {{ str_contains(Route::currentRouteName(), 'transaction') ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ str_contains(Route::currentRouteName(), 'transaction') ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ str_contains(Route::currentRouteName(), 'transaction') ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if(!'{{ str_contains(Route::currentRouteName(), 'transaction') }}') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if(!'{{ str_contains(Route::currentRouteName(), 'transaction') }}') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-credit-card-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Pembayaran
                @if(str_contains(Route::currentRouteName(), 'transaction'))
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('karyawan.reports') }}" style="
                color: {{ Route::currentRouteName() === 'karyawan.reports' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'karyawan.reports' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'karyawan.reports' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'karyawan.reports') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'karyawan.reports') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-file-earmark-text-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Laporan
                @if(Route::currentRouteName() === 'karyawan.reports')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

        @elseif(auth()->user()->role === 'customer')
            <!-- Customer Menu -->
            <a href="{{ route('customer.dashboard') }}" style="
                color: {{ Route::currentRouteName() === 'customer.dashboard' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'customer.dashboard' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'customer.dashboard' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'customer.dashboard') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'customer.dashboard') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-speedometer2" style="font-size: 1.15rem; width: 20px;"></i>
                Dashboard
                @if(Route::currentRouteName() === 'customer.dashboard')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('customer.orders.create') }}" style="
                color: {{ Route::currentRouteName() === 'customer.orders.create' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'customer.orders.create' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'customer.orders.create' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'customer.orders.create') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'customer.orders.create') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-plus-circle-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Pesan Laundry
                @if(Route::currentRouteName() === 'customer.orders.create')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('customer.orders.index') }}" style="
                color: {{ str_contains(Route::currentRouteName(), 'customer.orders.index') ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ str_contains(Route::currentRouteName(), 'customer.orders.index') ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ str_contains(Route::currentRouteName(), 'customer.orders.index') ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if(!'{{ str_contains(Route::currentRouteName(), 'customer.orders.index') }}') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if(!'{{ str_contains(Route::currentRouteName(), 'customer.orders.index') }}') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-clipboard-check-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Order Saya
                @if(str_contains(Route::currentRouteName(), 'customer.orders.index'))
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>

            <a href="{{ route('customer.notifications') }}" style="
                color: {{ Route::currentRouteName() === 'customer.notifications' ? '#16a34a' : 'rgba(255, 255, 255, 0.7)' }};
                text-decoration: none;
                padding: 0.875rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: all 0.3s ease;
                border-radius: 0.75rem;
                font-size: 0.95rem;
                font-weight: 500;
                background-color: {{ Route::currentRouteName() === 'customer.notifications' ? 'rgba(34, 197, 94, 0.15)' : 'transparent' }};
                border: 1px solid {{ Route::currentRouteName() === 'customer.notifications' ? 'rgba(34, 197, 94, 0.3)' : 'transparent' }};
                position: relative;
            " onmouseover="if('{{ Route::currentRouteName() }}' !== 'customer.notifications') { this.style.color='#16a34a'; this.style.backgroundColor='rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)'; }" onmouseout="if('{{ Route::currentRouteName() }}' !== 'customer.notifications') { this.style.color='rgba(255, 255, 255, 0.7)'; this.style.backgroundColor='transparent'; this.style.borderColor='transparent'; }">
                <i class="bi bi-bell-fill" style="font-size: 1.15rem; width: 20px;"></i>
                Notifikasi
                @if(Route::currentRouteName() === 'customer.notifications')
                    <div style="
                        position: absolute;
                        right: 0.75rem;
                        width: 6px;
                        height: 6px;
                        background: #16a34a;
                        border-radius: 50%;
                        box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                    "></div>
                @endif
            </a>
        @endif
    </nav>

    <!-- Eco Badge -->
    <div style="
        margin: 2rem 1.5rem 1rem;
        padding: 1rem;
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 0.75rem;
        text-align: center;
    ">
        <div style="
            font-size: 2rem;
            margin-bottom: 0.5rem;
        ">🌿</div>
        <div style="
            color: #16a34a;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        ">Eco-Friendly Mode</div>
        <div style="
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
        ">Bersama jaga bumi</div>
    </div>
</aside>

<!-- Custom Scrollbar for Sidebar -->
<style>
    aside::-webkit-scrollbar {
        width: 6px;
    }
    
    aside::-webkit-scrollbar-track {
        background: rgba(34, 197, 94, 0.05);
    }
    
    aside::-webkit-scrollbar-thumb {
        background: rgba(34, 197, 94, 0.3);
        border-radius: 3px;
    }
    
    aside::-webkit-scrollbar-thumb:hover {
        background: rgba(34, 197, 94, 0.5);
    }
</style>
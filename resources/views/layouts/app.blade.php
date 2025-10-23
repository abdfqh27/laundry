<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Hejo Laundry</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0a1f0a;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }

        .layout-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .layout-body {
            display: flex;
            flex: 1;
            margin-top: 80px;
        }

        .layout-sidebar {
            flex-shrink: 0;
        }

        .layout-content {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background-color: transparent;
            margin-left: 250px;
        }

        /* Stat Cards - Tema Hijau */
        .stat-card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .stat-card:hover {
            border-color: rgba(34, 197, 94, 0.5);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
            transform: translateY(-5px);
        }

        .stat-card-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-card-info h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #16a34a;
        }

        .stat-card-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            margin: 0;
            font-weight: 500;
        }

        .stat-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: rgba(34, 197, 94, 0.2);
            color: #16a34a;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.2);
        }

        /* Color Variations */
        .stat-card.green .stat-card-icon { 
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }
        .stat-card.green .stat-card-info h3 { color: #22c55e; }

        .stat-card.blue .stat-card-icon { 
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }
        .stat-card.blue .stat-card-info h3 { color: #60a5fa; }

        .stat-card.purple .stat-card-icon { 
            background: rgba(168, 85, 247, 0.2);
            color: #c084fc;
        }
        .stat-card.purple .stat-card-info h3 { color: #c084fc; }

        .stat-card.orange .stat-card-icon { 
            background: rgba(249, 115, 22, 0.2);
            color: #fb923c;
        }
        .stat-card.orange .stat-card-info h3 { color: #fb923c; }

        .stat-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Data Cards */
        .data-card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .data-card:hover {
            border-color: rgba(34, 197, 94, 0.4);
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.15);
        }

        .data-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .data-card h4 i {
            color: #16a34a;
        }

        /* Badges - Tema Hijau */
        .badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 0.5rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .badge-warning { 
            background-color: rgba(249, 115, 22, 0.2); 
            color: #fb923c;
            border: 1px solid rgba(249, 115, 22, 0.3);
        }
        
        .badge-processing { 
            background-color: rgba(59, 130, 246, 0.2); 
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .badge-success { 
            background-color: rgba(34, 197, 94, 0.2); 
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .badge-danger { 
            background-color: rgba(239, 68, 68, 0.2); 
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Page Header */
        .page-header { 
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
        }
        
        .page-header h1 { 
            font-size: 2.25rem; 
            font-weight: 700; 
            color: #fff; 
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff 0%, #16a34a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
        }

        /* Alerts - Tema Hijau */
        .alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert i {
            font-size: 1.25rem;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-dismissible .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.6;
        }

        .alert-dismissible .btn-close:hover {
            opacity: 1;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        /* Tables */
        .table {
            color: rgba(255, 255, 255, 0.9);
        }

        .table thead th {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.2);
            color: #16a34a;
            font-weight: 600;
        }

        .table tbody tr {
            border-color: rgba(34, 197, 94, 0.1);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(34, 197, 94, 0.05);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            border: none;
            color: white;
            padding: 0.625rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid rgba(34, 197, 94, 0.3);
            color: #16a34a;
        }

        .btn-secondary:hover {
            background: rgba(34, 197, 94, 0.1);
            border-color: #16a34a;
            color: #22c55e;
        }

        /* Forms */
        .form-control, .form-select {
            background: rgba(10, 31, 10, 0.5);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: white;
            border-radius: 0.5rem;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(34, 197, 94, 0.1);
            border-color: #16a34a;
            color: white;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { 
            width: 10px; 
            height: 10px;
        }
        
        ::-webkit-scrollbar-track { 
            background: rgba(34, 197, 94, 0.05);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb { 
            background: rgba(34, 197, 94, 0.3);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(34, 197, 94, 0.5);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .layout-body { 
                margin-top: 70px; 
                flex-direction: column; 
            }
            .layout-sidebar { 
                display: none; 
            }
            .layout-content { 
                padding: 1rem; 
                margin-left: 0; 
            }
            .stat-card-grid { 
                grid-template-columns: 1fr; 
            }
            .page-header h1 { 
                font-size: 1.75rem; 
            }
            .stat-card-info h3 {
                font-size: 2rem;
            }
        }

        /* Card Hover Effects */
        .card {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: rgba(34, 197, 94, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.15);
        }

        /* Modal */
        .modal-content {
            background: linear-gradient(135deg, #1a3a1a 0%, #16321e 100%);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: white;
        }

        .modal-header {
            border-bottom-color: rgba(34, 197, 94, 0.2);
        }

        .modal-footer {
            border-top-color: rgba(34, 197, 94, 0.2);
        }

        /* Pagination */
        .pagination .page-link {
            background: rgba(10, 31, 10, 0.5);
            border-color: rgba(34, 197, 94, 0.3);
            color: #16a34a;
        }

        .pagination .page-link:hover {
            background: rgba(34, 197, 94, 0.2);
            border-color: #16a34a;
            color: #22c55e;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #16a34a 0%, #16a34a 100%);
            border-color: #16a34a;
        }
    </style>
</head>
<body>
    <div class="layout-wrapper">
        <!-- NAVBAR -->
        @include('components.navbar')

        <!-- BODY -->
        <div class="layout-body">
            <!-- SIDEBAR -->
            @auth
                @if(auth()->user()->role === 'administrator' || auth()->user()->role === 'karyawan' || auth()->user()->role === 'customer')
                    <div class="layout-sidebar">
                        @include('components.sidebar')
                    </div>
                @endif
            @endauth

            <!-- MAIN CONTENT -->
            <main class="layout-content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <div>
                            <strong>Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
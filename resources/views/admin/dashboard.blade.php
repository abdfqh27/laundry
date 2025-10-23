@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
</div>

<!-- Stat Cards - 4 Columns -->
<div class="stat-card-grid">
    <!-- Total Customer -->
    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>1</h3>
                <p>Jumlah Customer</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
    </div>

    <!-- Laundry Masuk -->
    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>5</h3>
                <p>Laundry Masuk</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-box"></i>
            </div>
        </div>
    </div>

    <!-- Laundry Selesai -->
    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>1</h3>
                <p>Laundry Selesai</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
    </div>

    <!-- Laundry Diambil -->
    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-info">
                <h3>4</h3>
                <p>Laundry Diambil</p>
            </div>
            <div class="stat-card-icon">
                <i class="bi bi-arrow-left-right"></i>
            </div>
        </div>
    </div>
</div>

<!-- Pendapatan Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Pendapatan Tahun & Bulan -->
    <div class="data-card">
        <h4>Pendapatan <span style="color: #9ca3af; font-size: 0.85rem;">Tahun & Bulan</span></h4>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 120px; padding: 1rem; background: rgba(99, 102, 241, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Tahun lalu 2023</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #fbbf24;">Rp 144.000</p>
            </div>
            <div style="flex: 1; min-width: 120px; padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Bulan ini</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #86efac;">Rp 144.000</p>
            </div>
        </div>
    </div>

    <!-- Pendapatan Harian -->
    <div class="data-card">
        <h4>Pendapatan <span style="color: #9ca3af; font-size: 0.85rem;">Harian</span></h4>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 120px; padding: 1rem; background: rgba(34, 197, 94, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Hari ini Friday</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #86efac;">Rp 108.000</p>
            </div>
            <div style="flex: 1; min-width: 120px; padding: 1rem; background: rgba(249, 115, 22, 0.1); border-radius: 0.5rem;">
                <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 0.25rem;">Kemarin Thursday</p>
                <p style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #fbbf24;">Rp 12.000</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="data-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h4 style="margin: 0;">Order Terbaru</h4>
        <a href="#" style="color: #6366f1; text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#6366f1'">Lihat Semua →</a>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">No. Order</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Customer</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Total</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Status</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Bayar</th>
                    <th style="padding: 1rem; text-align: left; color: #9ca3af; font-weight: 600; font-size: 0.9rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 1rem; color: #e5e7eb;">#001</td>
                    <td style="padding: 1rem; color: #e5e7eb;">John Doe</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Rp 150.000</td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-warning">Pending</span>
                    </td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-danger">Belum Bayar</span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="#" style="
                            background-color: rgba(99, 102, 241, 0.2);
                            color: #6366f1;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 0.25rem;
                            text-decoration: none;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                            display: inline-block;
                        " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'; this.style.transform='translateY(0)'">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 1rem; color: #e5e7eb;">#002</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Jane Smith</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Rp 200.000</td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-processing">Diproses</span>
                    </td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-danger">Belum Bayar</span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="#" style="
                            background-color: rgba(99, 102, 241, 0.2);
                            color: #6366f1;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 0.25rem;
                            text-decoration: none;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                            display: inline-block;
                        " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'; this.style.transform='translateY(0)'">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 1rem; color: #e5e7eb;">#003</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Ahmad Rahman</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Rp 120.000</td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-success">Selesai</span>
                    </td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-success">Lunas</span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="#" style="
                            background-color: rgba(99, 102, 241, 0.2);
                            color: #6366f1;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 0.25rem;
                            text-decoration: none;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                            display: inline-block;
                        " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'; this.style.transform='translateY(0)'">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 1rem; color: #e5e7eb;">#004</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Siti Nurhaliza</td>
                    <td style="padding: 1rem; color: #e5e7eb;">Rp 180.000</td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-processing">Diproses</span>
                    </td>
                    <td style="padding: 1rem;">
                        <span class="badge badge-success">Lunas</span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="#" style="
                            background-color: rgba(99, 102, 241, 0.2);
                            color: #6366f1;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 0.25rem;
                            text-decoration: none;
                            font-size: 0.85rem;
                            transition: all 0.3s ease;
                            display: inline-block;
                        " onmouseover="this.style.backgroundColor='rgba(99, 102, 241, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='rgba(99, 102, 241, 0.2)'; this.style.transform='translateY(0)'">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Manage Users Card -->
    <div class="data-card" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(59, 130, 246, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-people" style="color: #60a5fa;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Kelola User</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Atur data pengguna dan role</p>
        <a href="#" style="display: inline-block; margin-top: 1rem; color: #6366f1; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <!-- Transactions Card -->
    <div class="data-card" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(34, 197, 94, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-credit-card" style="color: #86efac;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Data Transaksi</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Lihat riwayat transaksi</p>
        <a href="#" style="display: inline-block; margin-top: 1rem; color: #6366f1; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <!-- Services Card -->
    <div class="data-card" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(168, 85, 247, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-gear" style="color: #c084fc;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Data Harga</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Kelola layanan dan tarif</p>
        <a href="#" style="display: inline-block; margin-top: 1rem; color: #6366f1; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <!-- Targets Card -->
    <div class="data-card" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="width: 48px; height: 48px; background: rgba(249, 115, 22, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="bi bi-target" style="color: #fb923c;"></i>
            </div>
            <h4 style="margin: 0; color: #fff;">Target Laundry</h4>
        </div>
        <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">Atur target pendapatan</p>
        <a href="#" style="display: inline-block; margin-top: 1rem; color: #6366f1; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            Buka <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
@endsection
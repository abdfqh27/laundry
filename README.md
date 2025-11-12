<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

## 🧺 Tentang Aplikasi

**Laundry Ramah Lingkungan** adalah aplikasi manajemen laundry berbasis web yang dibangun menggunakan **Laravel Framework**.  
Aplikasi ini bertujuan membantu pemilik usaha laundry mengelola proses operasional secara efisien dan ramah lingkungan.

### ✨ Fitur Utama:
- Manajemen pelanggan & transaksi laundry.  
- Pencatatan penggunaan bahan dan energi untuk efisiensi sumber daya.  
- Pelacakan status cucian (masuk, proses, selesai, diambil).  
- Laporan keuangan dan rekap operasional.  
- Dashboard analitik untuk pemantauan performa.  
- Notifikasi otomatis kepada pelanggan.

Dengan sistem ini, proses laundry dapat dilakukan **lebih cepat, transparan, dan berkelanjutan**.

---

## ⚙️ Panduan Instalasi dan Menjalankan Proyek

Berikut langkah-langkah lengkap untuk menjalankan proyek ini di komputer lokal:

---

### 1 Clone Repository
Pastikan komputer Anda sudah terinstal **Git** dan **Composer**.

### 2 Instal Dependensi Laravel
composer install

### 3 Duplikasi File .env
cp .env.example .env

### 4 Konfigurasi Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry_ramah
DB_USERNAME=root
DB_PASSWORD=

### 5 Generate Application Key
php artisan key:generate

### 6 Jalankan Migrasi dan Seeder
php artisan migrate --seed

### 7 Jalankan Server Laravel
php artisan serve

@extends('layouts.app')

@section('title', 'Karyawan Dashboard')

@section('content')
<div class="p-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Dashboard Karyawan</h1>

    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Order</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalOrders }}</p>
                </div>
                <div class="text-4xl">📦</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
                </div>
                <div class="text-4xl">⏳</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Diproses</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $processingOrders }}</p>
                </div>
                <div class="text-4xl">⚙️</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600">{{ $completedOrders }}</p>
                </div>
                <div class="text-4xl">✅</div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Menu Cepat</h3>
        <div class="grid grid-cols-3 gap-4">
            <a href="{{ route('karyawan.orders') }}" class="block bg-blue-50 p-4 rounded hover:bg-blue-100">
                <div class="text-2xl mb-2">📋</div>
                <p class="font-semibold">Kelola Order</p>
            </a>
            <a href="{{ route('karyawan.customers') }}" class="block bg-green-50 p-4 rounded hover:bg-green-100">
                <div class="text-2xl mb-2">👥</div>
                <p class="font-semibold">Data Customer</p>
            </a>
            <a href="{{ route('karyawan.transactions') }}" class="block bg-purple-50 p-4 rounded hover:bg-purple-100">
                <div class="text-2xl mb-2">💳</div>
                <p class="font-semibold">Pembayaran</p>
            </a>
        </div>
    </div>
</div>
@endsection
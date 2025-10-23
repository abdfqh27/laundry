@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="p-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Laporan</h1>

    <div class="grid grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Export Laporan</h3>
            <div class="space-y-2">
                <button class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    📊 Export Excel
                </button>
                <button class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    📄 Export PDF
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Laporan</h3>
            <form class="space-y-2">
                <input type="month" class="w-full px-3 py-2 border border-gray-300 rounded">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-gray-600 text-sm">Total Order</p>
                <p class="text-2xl font-bold text-blue-600">0</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <p class="text-gray-600 text-sm">Total Pendapatan</p>
                <p class="text-2xl font-bold text-green-600">Rp 0</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <p class="text-gray-600 text-sm">Order Selesai</p>
                <p class="text-2xl font-bold text-purple-600">0</p>
            </div>
        </div>
    </div>
</div>
@endsection
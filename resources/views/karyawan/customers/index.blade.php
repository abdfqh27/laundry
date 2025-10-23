@extends('layouts.app')

@section('title', 'Data Customer')

@section('content')
<div class="p-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Data Customer</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Telepon</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Alamat</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $customer->name }}</td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->phone }}</td>
                    <td class="px-6 py-4">{{ $customer->address }}</td>
                    <td class="px-6 py-4">
                        <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $customer->phone) }}" target="_blank" 
                           class="text-green-600 hover:underline">
                            WhatsApp
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada customer
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $customers->links() }}
    </div>
</div>
@endsection
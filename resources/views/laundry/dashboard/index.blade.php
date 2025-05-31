@extends('laundry.layouts.app')

@section('content')
    <header class="flex flex-col gap-4 h-18">
        <div>
            <h1 class="text-2xl font-bold text-[#2D4559]">Dashboard</h1>
            <p class="text-sm text-[#]">Pantau dan kelola Laundry anda</p>
        </div>
    </header>

    <!-- Pesanan -->
    <div class="grid grid-cols-4 gap-4 mb-4">
        <!-- Card 1: Pesanan Hari Ini -->
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between min-h-[110px]">
            <div class="flex items-center justify-between">
                <span class="text-sm text-[#2D4559] font-bold">Pesanan Hari ini</span>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-2xl font-regular text-[#2D4559]">{{ $ordersTotalToday }}</span>
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
            </div>
        </div>

        <!-- Card 2: Total Pesanan -->
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between min-h-[110px]">
            <div class="flex items-center justify-between">
                <span class="text-sm text-[#2D4559] font-bold">Total Pesanan</span>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-2xl font-regular text-[#2D4559]">{{ $ordersTotal }}</span>
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
            </div>
        </div>

        <!-- Card 3: Pesanan Selesai -->
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between min-h-[110px]">
            <div class="flex items-center justify-between">
                <span class="text-sm text-[#2D4559] font-bold">Pesanan Selesai</span>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-2xl font-regular text-[#2D4559]">{{ $ordersDone }}</span>
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
            </div>
        </div>

        <!-- Card 4: Pesanan dalam Progress -->
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between min-h-[110px]">
            <div class="flex items-center justify-between">
                <span class="text-sm text-[#2D4559] font-bold">Pesanan Dalam Pengerjaan</span>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-2xl font-regular text-[#2D4559]">{{ $ordersProcess }}</span>
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7 7 7" />
            </div>
        </div>
    </div>

    <!-- Layanan -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 overflow-x-auto mb-4">
        <span class="text-sm font-bold text-[#2D4559] mb-4">Daftar Layanan</span>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Layanan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga per
                        Kilo</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $service->service_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($service->price_per_kg, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Review -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
    </div>
    <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
        </p>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </p>
        </div>
    </div>
@endsection
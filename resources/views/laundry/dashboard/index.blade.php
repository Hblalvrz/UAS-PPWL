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
    <!-- Review Terbaru -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 overflow-x-auto mb-4">
        <span class="text-sm font-bold text-[#2D4559] mb-4 block">Review Terbaru Customer</span>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Customer
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reviews->sortByDesc('created_at')->take(7) as $review)
                    <tr>
                        <!-- Rating -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            @for($i = 0; $i < ($review->rating ?? 5); $i++)
                                <span class="text-yellow-400">&#9733;</span>
                            @endfor
                        </td>
                        <!-- Isi Review -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 max-w-xs truncate"
                            title="{{ $review->contents }}">
                            {{ Str::limit($review->contents, 60) }}
                        </td>
                        <!-- Nama Customer -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2D4559] font-semibold flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#F9A825]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $review->user->name ?? '-' }}
                        </td>
                        <!-- Tanggal -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y • H:i') }}
                        </td>
                        <!-- Link (jika ada) -->
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            @if(!empty($review->link))
                                <a href="{{ $review->link }}" target="_blank"
                                    class="text-[#2D4559] underline truncate max-w-[120px] inline-block">{{ Str::limit($review->link, 20) }}</a>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
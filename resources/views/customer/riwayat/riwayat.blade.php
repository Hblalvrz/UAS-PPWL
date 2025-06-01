@extends('customer.layouts.app2')

@section('content2')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Pemesanan</h1>
            <p class="text-gray-600 mt-1">Daftar semua pemesanan laundry Anda</p>
        </div>

        <div class="p-6">
            @if($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            {{ $order->provider->laundry_name ?? 'Provider tidak tersedia' }}
                                        </h3>
                                        <span class="ml-3 px-3 py-1 rounded-full text-sm font-medium
                                            @if($order->status == 'process')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($order->status == 'done')
                                                bg-green-100 text-green-800
                                            @else
                                                bg-gray-100 text-gray-800
                                            @endif">
                                            @if($order->status == 'process')
                                                Sedang Diproses
                                            @elseif($order->status == 'done')
                                                Selesai
                                            @else
                                                {{ ucfirst($order->status) }}
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <p class="text-sm text-gray-600">Layanan:</p>
                                            <p class="font-medium text-gray-800">
                                                {{ $order->service->service_name ?? 'Layanan tidak tersedia' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Jumlah:</p>
                                            <p class="font-medium text-gray-800">{{ $order->quantity }} kg</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Total Harga:</p>
                                            <p class="font-bold text-blue-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Tanggal Pemesanan:</p>
                                            <p class="font-medium text-gray-800">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($order->pickup_date)
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600">Tanggal Pickup:</p>
                                            <p class="font-medium text-gray-800">
                                                {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="{{ route('orders.showDetail', $order->order_id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                                        Detail
                                    </a>
                                    
                                    @if($order->status == 'done')
                                        <a href="{{ route('customer.ulasan', $order->order_id) }}" 
                                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-center">
                                            Beri Ulasan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination jika diperlukan -->
                <div class="mt-6 flex justify-center">
                    {{-- {{ $orders->links() }} --}}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada riwayat pemesanan</h3>
                    <p class="text-gray-600 mb-4">Anda belum melakukan pemesanan laundry apapun.</p>
                    <a href="{{ route('customer.dashboard.index') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200">
                        Mulai Pesan Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

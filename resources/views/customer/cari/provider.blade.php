@extends('customer.layouts.app2')

@section('content2')
    <main class="max-w-4xl mx-auto px-4 pb-12">
        <!-- Hero Section -->
        <section
            class="text-center mt-8 mb-10 py-8 rounded-xl bg-gradient-to-r from-blue-100 via-blue-50 to-indigo-50 shadow-lg">
            <div class="flex justify-center mb-3">
                <i class="fas fa-search-location text-4xl text-blue-500"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Cari Laundry Terdekat
            </h1>
            <p class="mt-3 text-sm md:text-base text-slate-600 max-w-md mx-auto">
                Temukan laundry dengan pelayanan terbaik, hasil maksimal, dan harga yang memuaskan.
            </p>
        </section>

        <!-- Provider List -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($providers as $provider)
                <article
                    class="border border-slate-200 rounded-xl p-6 flex flex-col md:flex-row justify-between items-center bg-white shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 ease-in-out">
                    <div class="flex-1 flex flex-col gap-2 mb-4 md:mb-0">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-store-alt text-blue-500 text-base"></i>
                            <h2 class="font-semibold text-lg text-slate-900 truncate max-w-[180px]">
                                {{ $provider->laundry_name }}
                            </h2>
                        </div>
                        <p class="flex items-center gap-2 text-sm md:text-sm text-slate-700">
                            <i class="fas fa-map-marker-alt text-slate-500 text-sm"></i>
                            <span class="truncate max-w-[180px]">{{ $provider->address }}</span>
                        </p>
                        <p class="flex items-center gap-2 text-sm md:text-sm text-slate-700">
                            <i class="fas fa-phone-alt text-slate-500 text-sm"></i>
                            <span>{{ $provider->phone }}</span>
                        </p>
                        <div class="mt-3">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-check-circle mr-1 text-xs"></i> Layanan Terbaik
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a class="bg-[#0F172A] hover:bg-[#1E293B] text-white font-semibold text-sm py-2 px-5 rounded-lg transition-colors duration-200 ease-in-out shadow-sm hover:shadow flex items-center gap-2"
                            href="{{ route('customer.order', $provider->laundryProvider) }}">
                            <i class="fas fa-shopping-basket text-white text-sm"></i>
                            <span>Pesan</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
@endsection

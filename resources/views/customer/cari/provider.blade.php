@extends('customer.layouts.app2')

@section('content2')
    <main class="max-w-6xl mx-auto px-4 pb-16">
        <!-- Hero Section -->
        <section
            class="text-center mt-8 mb-12 py-12 rounded-2xl bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 shadow-xl border border-blue-100 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-4 left-4 w-8 h-8 bg-blue-500 rounded-full"></div>
                <div class="absolute top-12 right-8 w-6 h-6 bg-indigo-500 rounded-full"></div>
                <div class="absolute bottom-8 left-12 w-4 h-4 bg-purple-500 rounded-full"></div>
                <div class="absolute bottom-4 right-4 w-10 h-10 bg-blue-400 rounded-full"></div>
            </div>

            <div class="relative z-10">
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 rounded-full blur-xl opacity-20 scale-110"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <i class="fas fa-search-location text-4xl text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
                    Cari Laundry
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Terdekat
                    </span>
                </h1>
                <p class="mt-4 text-base md:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Temukan laundry dengan pelayanan terbaik, hasil maksimal, dan harga yang memuaskan.
                    <span class="font-semibold text-blue-600">Kualitas terjamin, kepercayaan terdepan.</span>
                </p>

                <!-- Stats -->
                <div class="mt-8 flex justify-center gap-8 text-sm">
                    <div class="flex items-center gap-2 text-slate-600">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="font-medium">{{ count($providers) }} Provider Aktif</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                        <span class="font-medium">Layanan 24/7</span>
                    </div>
                </div>
            </div>
        </section>



        <!-- Provider List -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($providers as $index => $provider)
                <article
                    class="group border border-slate-200 rounded-2xl p-6 bg-white shadow-sm hover:shadow-2xl hover:border-blue-300 transition-all duration-500 ease-out transform hover:-translate-y-1 relative overflow-hidden">

                    <!-- Background Gradient -->
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50/0 to-indigo-50/0 group-hover:from-blue-50/30 group-hover:to-indigo-50/30 transition-all duration-500 rounded-2xl">
                    </div>



                    <div class="relative z-10 flex flex-col h-full">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-store-alt text-white text-lg"></i>
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse">
                                    </div>
                                </div>
                                <div>
                                    <h2
                                        class="font-bold text-xl text-slate-900 group-hover:text-blue-700 transition-colors">
                                        {{ $provider->laundry_name }}
                                    </h2>
                                    <div class="flex items-center gap-1 mt-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        @endfor
                                        <span class="text-xs text-slate-500 ml-1">(4.9)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-slate-500">Mulai dari</div>
                                <div class="font-bold text-lg text-green-600">Rp 3.500/kg</div>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="flex-1 space-y-3 mb-6">
                            <div class="flex items-start gap-3 group/item">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center group-hover/item:bg-blue-100 transition-colors">
                                    <i
                                        class="fas fa-map-marker-alt text-slate-500 group-hover/item:text-blue-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-700 leading-relaxed">{{ $provider->address }}</p>
                                    <span class="inline-block mt-1 text-xs text-blue-600 font-medium">2.3 km dari lokasi
                                        Anda</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 group/item">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center group-hover/item:bg-green-100 transition-colors">
                                    <i class="fas fa-phone-alt text-slate-500 group-hover/item:text-green-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-slate-700 font-medium">{{ $provider->phone }}</p>
                                    <span class="text-xs text-slate-500">Respon cepat dalam 5 menit</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 group/item">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center group-hover/item:bg-purple-100 transition-colors">
                                    <i class="fas fa-clock text-slate-500 group-hover/item:text-purple-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-slate-700 font-medium">Layanan Cepat</p>
                                    <span class="text-xs text-slate-500">Siap melayani setiap hari</span>
                                </div>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i> Layanan Terbaik
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-leaf mr-1 text-xs"></i> Eco Friendly
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                    <i class="fas fa-truck mr-1 text-xs"></i> Antar Jemput
                                </span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="flex">
                            <a class="w-full bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white font-semibold text-sm py-3 px-6 rounded-xl transition-all duration-300 ease-out shadow-lg hover:shadow-xl flex items-center justify-center gap-2 transform hover:scale-105"
                                href="{{ route('customer.order', $provider->laundryProvider) }}">
                                <i class="fas fa-shopping-basket text-white text-sm"></i>
                                <span>Pesan Sekarang</span>
                                <i
                                    class="fas fa-arrow-right text-white text-xs ml-1 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <!-- Empty State (if no providers) -->
        @if (count($providers) === 0)
            <section class="text-center py-16">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-search text-3xl text-slate-400"></i>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">Belum Ada Provider</h3>
                <p class="text-slate-500 max-w-md mx-auto">
                    Saat ini belum ada provider laundry yang tersedia di area Anda. Silakan coba lagi nanti.
                </p>
            </section>
        @endif

        <!-- Call to Action -->
        <section
            class="mt-16 text-center bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-2xl">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Punya Usaha Laundry?</h3>
                <p class="text-blue-100 mb-6">Bergabunglah dengan platform kami dan jangkau lebih banyak pelanggan</p>
                <a href="{{ route('register') }}"
                    class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-lg inline-block">
                    <i class="fas fa-plus mr-2"></i>Daftar Sebagai Provider
                </a>
            </div>
        </section>
    </main>

    <!-- Custom Styles -->
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .group:hover .animate-float {
            animation-duration: 1.5s;
        }
    </style>
@endsection

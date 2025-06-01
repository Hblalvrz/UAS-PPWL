@extends('customer.layouts.app2')

@section('content2')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">

            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute top-40 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-8">
            <!-- Hero Search Section - Enhanced -->
            <section class="relative mb-16">
                <div
                    class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 rounded-3xl p-12 shadow-2xl transform hover:scale-[1.02] transition-all duration-500 group overflow-hidden">
                    <!-- Floating particles effect -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-10 left-10 w-2 h-2 bg-white rounded-full opacity-60 animate-ping"></div>
                        <div
                            class="absolute top-32 right-20 w-1 h-1 bg-white rounded-full opacity-40 animate-pulse animation-delay-1000">
                        </div>
                        <div
                            class="absolute bottom-20 left-1/4 w-3 h-3 bg-white rounded-full opacity-30 animate-bounce animation-delay-2000">
                        </div>
                        <div
                            class="absolute bottom-32 right-1/3 w-2 h-2 bg-white rounded-full opacity-50 animate-ping animation-delay-3000">
                        </div>
                    </div>

                    <div class="relative max-w-3xl mx-auto text-center">
                        <div class="mb-8 transform group-hover:scale-105 transition-transform duration-500">
                            <h1 class="text-4xl md:text-6xl font-black text-white mb-4 leading-tight">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">
                                    Clean Waves
                                </span>
                            </h1>
                            <h2 class="text-xl md:text-2xl font-bold text-white mb-4">
                                🌊 Cari Laundry Terdekat
                            </h2>
                            <p class="text-base md:text-lg text-blue-100 max-w-xl mx-auto leading-relaxed">
                                Temukan laundry dengan pelayanan terbaik, hasil maksimal, dan harga transparan di sekitar
                                Anda.
                            </p>
                        </div>

                        <form action="{{ route('customer.dashboard.index') }}" method="GET"
                            class="relative max-w-2xl mx-auto">
                            <div
                                class="flex flex-col sm:flex-row gap-4 p-2 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30">
                                <div class="relative flex-1 group">
                                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-map-marker-alt text-blue-400 group-focus-within:text-blue-600 transition-colors"></i>
                                    </div>
                                    <input
                                        class="w-full bg-white/90 backdrop-blur-sm rounded-xl border-0 py-4 pl-12 pr-16 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-white/50 focus:bg-white transition-all duration-300 text-sm font-medium"
                                        id="search" name="search" placeholder="Masukkan lokasi atau nama laundry..."
                                        type="search" value="{{ request('search') }}" />
                                    <div class="absolute inset-y-0 right-4 flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-search text-white text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-white font-bold px-8 py-4 rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 text-sm">
                                    <i class="fas fa-rocket"></i>
                                    <span>Cari Sekarang</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Results Section - Enhanced -->
            @if (request('search'))
                <section class="mb-16">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-black text-gray-800 mb-4">
                            🎯 Hasil Pencarian
                        </h3>
                        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
                    </div>
                    <div class="flex left-center mb-8">
                        <a href="{{ route('customer.dashboard.index') }}"
                            class="bg-gradient-to-r from-blue-500 to-purple-500  text-white font-bold px-6 py-3 rounded-xl hover:from-blue-400 hover:to-blue-400 transition-all shadow-md">
                            Reset Pencarian
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($providers as $provider)
                            <div class="group relative">
                                <!-- Glowing border effect -->
                                <div
                                    class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000 group-hover:duration-200">
                                </div>

                                <div
                                    class="relative bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 transition-all duration-500 group-hover:shadow-2xl">
                                    <div
                                        class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
                                    </div>

                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h4
                                                    class="text-lg font-black text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                                    {{ $provider->laundry_name }}
                                                </h4>
                                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                                    <i class="fas fa-phone-alt mr-2 text-green-500"></i>
                                                    <span class="font-medium">{{ $provider->phone }}</span>
                                                </div>
                                            </div>
                                            <div
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 border-2 border-blue-200">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                {{ $provider->address }}
                                            </div>
                                        </div>

                                        <!-- Stats Row -->
                                        <div class="grid grid-cols-2 gap-4 mb-6">
                                            <div
                                                class="text-center p-3 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl">
                                                <div class="flex items-center justify-center mb-1">
                                                    <i class="fas fa-star text-yellow-500 mr-1"></i>
                                                    <span class="font-black text-gray-800">4.8</span>
                                                </div>
                                                <span class="text-xs text-gray-600 font-medium">120+ rating</span>
                                            </div>
                                            <div
                                                class="text-center p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                                <div class="flex items-center justify-center mb-1">
                                                    <i class="fas fa-clock text-green-500 mr-1"></i>
                                                    <span class="font-black text-gray-800">24</span>
                                                </div>
                                                <span class="text-xs text-gray-600 font-medium">Jam</span>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <div class="relative">
                                            <a href="{{ route('customer.order', $provider->laundryProvider) }}"
                                                class="block w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-black text-center py-4 rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl group/btn">
                                                <span class="flex items-center justify-center space-x-2">
                                                    <i class="fas fa-shopping-cart group-hover/btn:animate-bounce"></i>
                                                    <span>Pesan Sekarang</span>
                                                    <i
                                                        class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-16 bg-white rounded-3xl shadow-xl">
                                    <div class="mb-6">
                                        <i class="fas fa-search text-6xl text-gray-300 mb-4 animate-pulse"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-700 mb-2">Oops! Tidak ada hasil</h4>
                                    <p class="text-gray-500 font-medium">
                                        Tidak ada laundry ditemukan untuk pencarian "<span
                                            class="text-blue-600 font-bold">{{ request('search') }}</span>"
                                    </p>
                                    <div class="mt-6">
                                        <button
                                            onclick="document.getElementById('search').value=''; document.querySelector('form').submit();"
                                            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white font-bold px-6 py-3 rounded-xl hover:shadow-lg transition-all">
                                            Coba Lagi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>
            @endif

            <!-- Value Proposition Section - Enhanced -->
            <section class="mb-16">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-6">
                        ✨ Mengapa Memilih
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                            Clean Waves?
                        </span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Kami memberikan pelayanan terbaik, hasil maksimal, dan harga transparan untuk kebutuhan laundry Anda
                        dengan teknologi terdepan.
                    </p>
                    <div class="w-32 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl p-8 text-center transform hover:-translate-y-3 transition-all duration-500 group-hover:shadow-2xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                            <div class="relative">
                                <div
                                    class="w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg">
                                    <i class="fas fa-home text-white text-2xl group-hover:animate-bounce"></i>
                                </div>
                                <h3
                                    class="text-xl font-black text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">
                                    Antar Jemput Gratis
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Kami jemput dan antar ke tempat Anda dengan layanan door-to-door tanpa biaya tambahan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl p-8 text-center transform hover:-translate-y-3 transition-all duration-500 group-hover:shadow-2xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500">
                            </div>
                            <div class="relative">
                                <div
                                    class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg">
                                    <i class="fas fa-bolt text-white text-2xl group-hover:animate-bounce"></i>
                                </div>
                                <h3
                                    class="text-xl font-black text-gray-800 mb-4 group-hover:text-purple-600 transition-colors">
                                    Proses Kilat
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Teknologi modern untuk hasil maksimal dalam waktu singkat, tanpa menunggu lama.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl p-8 text-center transform hover:-translate-y-3 transition-all duration-500 group-hover:shadow-2xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-teal-500">
                            </div>
                            <div class="relative">
                                <div
                                    class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 shadow-lg">
                                    <i class="fas fa-lock text-white text-2xl group-hover:animate-bounce"></i>
                                </div>
                                <h3
                                    class="text-xl font-black text-gray-800 mb-4 group-hover:text-green-600 transition-colors">
                                    Harga Transparan
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Tidak ada biaya tersembunyi, semua tarif jelas dan terjangkau untuk semua kalangan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section - Enhanced -->
            <section class="mb-16 bg-gradient-to-r from-gray-50 to-blue-50 rounded-3xl p-12">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-6">
                        🌟 Pelayanan Terbaik Kami
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Nikmati berbagai layanan laundry premium dengan teknologi terdepan dan hasil yang memuaskan.
                    </p>
                    <div class="w-32 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 hover:rotate-1 transition-all duration-500 group-hover:shadow-2xl min-h-[280px]">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500">
                            </div>
                            <div class="p-8 h-full flex flex-col items-center justify-center text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                                        <img alt="Order Antar Jemput"
                                            class="w-12 h-12 object-contain group-hover:animate-bounce"
                                            src="https://storage.googleapis.com/a1aa/image/2a6f036e-2b23-42a8-31af-deb422bfb9ae.jpg">
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-star text-white text-xs"></i>
                                    </div>
                                </div>
                                <h4
                                    class="text-lg font-black text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                                    Order Antar Jemput
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Layanan door-to-door dengan tracking real-time dan notifikasi WhatsApp
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 hover:rotate-1 transition-all duration-500 group-hover:shadow-2xl min-h-[280px]">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-purple-500 to-pink-500">
                            </div>
                            <div class="p-8 h-full flex flex-col items-center justify-center text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                                        <img alt="Proses Kilat"
                                            class="w-12 h-12 object-contain group-hover:animate-bounce"
                                            src="https://storage.googleapis.com/a1aa/image/5d98a76a-f7f3-47b2-3927-c8ca84a67da8.jpg">
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-bolt text-white text-xs"></i>
                                    </div>
                                </div>
                                <h4
                                    class="text-lg font-black text-gray-800 mb-3 group-hover:text-purple-600 transition-colors">
                                    Proses Kilat
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Teknologi mesin modern untuk hasil express tanpa mengurangi kualitas
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 hover:rotate-1 transition-all duration-500 group-hover:shadow-2xl min-h-[280px]">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-500 to-teal-500">
                            </div>
                            <div class="p-8 h-full flex flex-col items-center justify-center text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-r from-green-100 to-teal-100 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                                        <img alt="Harga Transparan"
                                            class="w-12 h-12 object-contain group-hover:animate-bounce"
                                            src="https://storage.googleapis.com/a1aa/image/27a9cfc3-16c3-47ce-2580-127c3a9e6cb2.jpg">
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-dollar-sign text-white text-xs"></i>
                                    </div>
                                </div>
                                <h4
                                    class="text-lg font-black text-gray-800 mb-3 group-hover:text-green-600 transition-colors">
                                    Harga Transparan
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Kalkulasi harga otomatis tanpa biaya tersembunyi dan promo menarik
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-1000">
                        </div>
                        <div
                            class="relative bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 hover:rotate-1 transition-all duration-500 group-hover:shadow-2xl min-h-[280px]">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-500 to-orange-500">
                            </div>
                            <div class="p-8 h-full flex flex-col items-center justify-center text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                                        <img alt="Rating Terverifikasi"
                                            class="w-12 h-12 object-contain group-hover:animate-bounce"
                                            src="https://storage.googleapis.com/a1aa/image/23349318-3dc9-49cc-016f-abffb87a576e.jpg">
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-crown text-white text-xs"></i>
                                    </div>
                                </div>
                                <h4
                                    class="text-lg font-black text-gray-800 mb-3 group-hover:text-yellow-600 transition-colors">
                                    Rating Terverifikasi
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Sistem review authentic dari pelanggan asli dengan verifikasi identitas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-16">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-6">
                        💬 Testimoni Pelanggan
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Dengarkan langsung dari pelanggan setia kami tentang pengalaman menggunakan layanan Clean Waves.
                    </p>
                    <div class="w-32 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($providers as $provider)
                        @foreach ($provider->reviews as $review)
                            <div class="group relative">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000">
                                </div>
                                <div
                                    class="relative bg-white rounded-2xl shadow-xl p-8 transform hover:-translate-y-2 transition-all duration-500 group-hover:shadow-2xl">
                                    <div class="absolute -top-4 left-8">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-quote-left text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <div class="flex items-center mb-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-user text-blue-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-black text-gray-800 text-lg">{{ $review->user->name }}</h4>
                                                <p class="text-sm text-gray-500 font-medium">⭐ Pelanggan
                                                    {{ $review->provider->laundry_name }}</p>
                                            </div>
                                        </div>
                                        <blockquote class="text-gray-700 italic text-lg leading-relaxed mb-4">
                                            "{{ $review->contents }}"
                                        </blockquote>
                                        <div class="flex justify-center">
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= $review->value; $i++)
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
            <!-- Call to Action Section -->
            <section class="text-center mb-16">
                <div
                    class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-3xl p-12 overflow-hidden">
                    <!-- Animated background elements -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div
                            class="absolute top-0 left-1/4 w-32 h-32 bg-white rounded-full opacity-10 animate-pulse animation-delay-1000">
                        </div>
                        <div
                            class="absolute bottom-0 right-1/4 w-24 h-24 bg-white rounded-full opacity-10 animate-pulse animation-delay-3000">
                        </div>
                        <div
                            class="absolute top-1/2 right-0 w-16 h-16 bg-white rounded-full opacity-10 animate-bounce animation-delay-2000">
                        </div>
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-4xl font-black text-white mb-6">
                            🚀 Siap Untuk Pengalaman Laundry Terbaik?
                        </h2>
                        <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto leading-relaxed">
                            Bergabunglah dengan ribuan pelanggan yang telah merasakan kemudahan dan kualitas layanan Clean
                            Waves.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <button onclick="document.getElementById('search').focus()"
                                class="bg-white text-blue-600 font-black px-8 py-4 rounded-xl hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                <i class="fas fa-search"></i>
                                <span>Cari Laundry Sekarang</span>
                            </button>
                            <a href="https://wa.me/6285895675549?text=Halo%20Clean%20Waves,%20saya%20ingin%20bertanya%20tentang%20layanan%20laundry."
                                target="_blank" rel="noopener noreferrer"
                                class="bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-white font-black px-8 py-4 rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                <i class="fas fa-phone"></i>
                                <span>Hubungi Kami</span>
                            </a>

                        </div>

                        <div class="mt-8 flex justify-center items-center space-x-8 text-white/80">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-shield-alt"></i>
                                <span class="text-sm">100% Aman</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock"></i>
                                <span class="text-sm">24/7 Support</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-heart"></i>
                                <span class="text-sm">1000+ Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-3000 {
            animation-delay: 3s;
        }

        /* Glassmorphism effect */
        .backdrop-blur-md {
            backdrop-filter: blur(12px);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Enhanced hover effects */
        .group:hover .group-hover\:animate-bounce {
            animation: bounce 1s infinite;
        }

        /* Custom gradient text */
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Loading animation for search */
        .search-loading {
            position: relative;
            overflow: hidden;
        }

        .search-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }
    </style>

    <!-- JavaScript for Enhanced Interactions -->
    <script>
        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Search enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchForm = searchInput.closest('form');

            searchInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-4', 'ring-blue-200');
            });

            searchInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-4', 'ring-blue-200');
            });

            // Add loading state to form submission
            searchForm.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari...';
                submitBtn.disabled = true;
            });
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
@endsection

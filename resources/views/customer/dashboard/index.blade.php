@extends('customer.layouts.app2')

@section('content2')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Hero Search Section -->
        <section class="bg-gradient-to-r from-blue-300 to-indigo-400 rounded-xl p-8 mb-8 shadow-lg">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Cari Laundry Terdekat</h2>
                <p class="text-sm md:text-base text-blue-100 mb-6">
                    Temukan laundry dengan pelayanan terbaik, hasil maksimal, dan harga transparan.
                </p>
                <form action="{{ route('customer.dashboard.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto">
                    <div class="relative flex-1">
                        <input
                            class="w-full rounded-lg border-0 py-3 pl-4 pr-12 text-sm placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                            id="search" name="search" placeholder="Masukkan lokasi atau nama laundry" type="search"
                            value="{{ request('search') }}" />
                        <button aria-label="Search" class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-500"
                            type="submit">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                    <button type="submit"
                        class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-100 transition-all text-sm">
                        Cari Sekarang
                    </button>
                </form>
            </div>
        </section>

        <!-- Results Section (Conditional) -->
        @if (request('search'))
            <section class="mb-10">
                <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Hasil Pencarian</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($providers as $provider)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-base font-bold text-gray-900">{{ $provider->laundry_name }}</h4>
                                    <div
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $provider->address }}
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">
                                    <i class="fas fa-phone-alt mr-1"></i> {{ $provider->phone }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                    <span class="inline-flex items-center">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        4.8 (120+ rating)
                                    </span>
                                    <span class="inline-flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        24 Jam
                                    </span>
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('customer.order', $provider->laundryProvider) }}"
                                        class="bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition-all">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <div class="bg-white rounded-xl p-6 shadow-sm">
                                <i class="fas fa-search text-3xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 font-medium">
                                    Tidak ada laundry ditemukan untuk pencarian "{{ request('search') }}"
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        @endif

        <!-- Value Proposition Section -->
        <section class="max-w-7xl mx-auto px-6 py-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Mengapa Memilih Clean Waves?</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Kami memberikan pelayanan terbaik, hasil maksimal, dan harga transparan untuk kebutuhan laundry Anda.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Antar Jemput Gratis</h3>
                    <p class="text-gray-600">Kami jemput dan antar ke tempat Anda, gratis biaya tambahan.</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bolt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Proses Kilat</h3>
                    <p class="text-gray-600">Selesai lebih cepat, tanpa menunggu lama.</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lock text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Harga Transparan</h3>
                    <p class="text-gray-600">Tidak ada biaya tambahan tersembunyi.</p>
                </div>
            </div>
        </section>


        <section class="max-w-7xl mx-auto px-6 py-16 bg-gray-50">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Pelayanan Terbaik Kami</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Nikmati berbagai layanan laundry terbaik dengan hasil maksimal.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 group min-h-[200px]">
                    <div class="p-6 h-full flex flex-col items-center justify-center">
                        <img alt="Order Antar Jemput" class="mb-4 w-16 h-16 object-contain"
                            src="https://storage.googleapis.com/a1aa/image/2a6f036e-2b23-42a8-31af-deb422bfb9ae.jpg">
                        <p class="text-sm font-semibold text-center text-gray-800">Order Antar Jemput</p>
                        <p class="text-xs text-gray-500 mt-1 text-center">Kami jemput dan antar ke tempat Anda</p>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 group min-h-[200px]">
                    <div class="p-6 h-full flex flex-col items-center justify-center">
                        <img alt="Proses Kilat" class="mb-4 w-16 h-16 object-contain"
                            src="https://storage.googleapis.com/a1aa/image/5d98a76a-f7f3-47b2-3927-c8ca84a67da8.jpg">
                        <p class="text-sm font-semibold text-center text-gray-800">Proses Kilat</p>
                        <p class="text-xs text-gray-500 mt-1 text-center">Selesai lebih cepat, tanpa menunggu lama</p>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 group min-h-[200px]">
                    <div class="p-6 h-full flex flex-col items-center justify-center">
                        <img alt="Harga Transparan" class="mb-4 w-16 h-16 object-contain"
                            src="https://storage.googleapis.com/a1aa/image/27a9cfc3-16c3-47ce-2580-127c3a9e6cb2.jpg">
                        <p class="text-sm font-semibold text-center text-gray-800">Harga Transparan</p>
                        <p class="text-xs text-gray-500 mt-1 text-center">Tidak ada biaya tambahan tersembunyi</p>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 group min-h-[200px]">
                    <div class="p-6 h-full flex flex-col items-center justify-center">
                        <img alt="Rating Terverifikasi" class="mb-4 w-16 h-16 object-contain"
                            src="https://storage.googleapis.com/a1aa/image/23349318-3dc9-49cc-016f-abffb87a576e.jpg">
                        <p class="text-sm font-semibold text-center text-gray-800">Rating Terverifikasi</p>
                        <p class="text-xs text-gray-500 mt-1 text-center">Testimoni asli dari pelanggan kami</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 py-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Testimoni Pelanggan</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Apa kata pelanggan tentang pelayanan kami?
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Budi Santoso</h4>
                            <p class="text-xs text-gray-500">Pelanggan Setia</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Pelayanan cepat, hasil maksimal, harga terjangkau. Saya sangat puas!"
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Siti Aisyah</h4>
                            <p class="text-xs text-gray-500">Pelanggan Setia</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Antar jemput gratis, tidak perlu repot ke laundry lagi. Sangat membantu!"
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Andi Pratama</h4>
                            <p class="text-xs text-gray-500">Pelanggan Setia</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Rating terverifikasi, pelayanan ramah, dan hasil laundry selalu bersih."
                    </p>
                </div>
            </div>
        </section>

    </div>
@endsection

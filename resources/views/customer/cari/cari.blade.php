@extends('customer.layouts.app2')

@section('content2')
    <!-- Hero Section -->
    <section class="py-12 md:py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-[#0F172A] mb-3">
                    <span class="text-blue-600">Cari Laundry Terdekat</span>
                </h1>
                <p class="text-base text-[#475569] max-w-2xl mx-auto">
                    Temukan laundry dengan pelayanan terbaik, hasil maksimal, dan harga transparan.
                </p>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Illustration of a woman doing laundry with washing machines and clothes rack in a laundry room with window"
                    class="mx-auto mb-8 w-64 md:w-80 transform hover:scale-105 transition-all duration-300"
                    src="https://storage.googleapis.com/a1aa/image/40e40467-04d8-4b63-b5e0-0b15fc36c7b3.jpg" />
                <a href="{{ route('provider.list') }}"
                    class="bg-[#0F172A] text-white text-sm font-semibold py-3 px-8 rounded-full hover:bg-blue-800 transition-all shadow-md hover:shadow-lg">
                    Cari Laundry Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection

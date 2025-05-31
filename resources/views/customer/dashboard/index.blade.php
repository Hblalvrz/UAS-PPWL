@extends('customer.layouts.app2')

@section('content2')
    <section class="bg-[#D9E0FF] max-w-7xl mx-auto rounded-md px-6 py-6 mb-8">
        <h2 class="font-semibold text-lg mb-1">
            Cari laundry terdekat
        </h2>
        <p class="text-xs mb-4 max-w-md">
            Temukan laundry dengan pelayanan terbaik dengan hasil dan harga yang memuaskan
        </p>
        <form class="max-w-md">
            <label class="sr-only" for="search">
                Cari laundry
            </label>
            <div class="relative">
                <input
                    class="w-full rounded-md border border-[#2B3A55] border-opacity-20 bg-white py-2 pl-3 pr-10 text-xs placeholder:text-[#9CA3AF] focus:outline-none focus:ring-1 focus:ring-[#2B3A55]"
                    id="search" placeholder="Masukkan lokasi atau nama laundry" type="search" />
                <button aria-label="Search" class="absolute right-2 top-1/2 -translate-y-1/2 text-[#2B3A55] text-xs"
                    type="submit">
                    <i class="fas fa-search">
                    </i>
                </button>
            </div>
        </form>
    </section>
    <section class="max-w-7xl mx-auto px-6">
        <h3 class="font-semibold text-center mb-6">
            Pelayanan Terbaik
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="border border-[#2B3A55] border-opacity-20 rounded-md bg-white p-4 flex flex-col items-center">
                <img alt="Illustration of a delivery person riding a motorbike with laundry bags and a location pin"
                    class="mb-6" height="80"
                    src="https://storage.googleapis.com/a1aa/image/2a6f036e-2b23-42a8-31af-deb422bfb9ae.jpg"
                    width="80" />
                <p class="text-xs font-semibold text-center">
                    Order Antar Jemput
                </p>
            </div>
            <div class="border-2 border-[#F7C948] rounded-md bg-white p-4 flex flex-col items-center">
                <img alt="Illustration of a person running with a clock and laundry bag symbolizing fast process"
                    class="mb-3" height="80"
                    src="https://storage.googleapis.com/a1aa/image/5d98a76a-f7f3-47b2-3927-c8ca84a67da8.jpg"
                    width="80" />
                <p class="text-xs font-semibold text-center">
                    Proses Kilat
                </p>
            </div>
            <div class="border-2 border-[#F7C948] rounded-md bg-white p-4 flex flex-col items-center">
                <img alt="Illustration of two people holding a large dollar bill representing transparent pricing"
                    class="mb-3" height="80"
                    src="https://storage.googleapis.com/a1aa/image/27a9cfc3-16c3-47ce-2580-127c3a9e6cb2.jpg"
                    width="80" />
                <p class="text-xs font-semibold text-center">
                    Harga Transparan
                </p>
            </div>
            <div class="border-2 border-[#F7C948] rounded-md bg-white p-4 flex flex-col items-center">
                <img alt="Illustration of people interacting with rating and verification icons" class="mb-3"
                    height="80" src="https://storage.googleapis.com/a1aa/image/23349318-3dc9-49cc-016f-abffb87a576e.jpg"
                    width="80" />
                <p class="text-xs font-semibold text-center">
                    Rating Terverifikasi
                </p>
            </div>
        </div>
    </section>
@endsection

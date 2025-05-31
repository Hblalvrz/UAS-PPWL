@extends('customer.layouts.app2')

@section('content2')
    <main class="flex flex-col items-center px-4 mt-10">
        <h1 class="text-lg font-semibold text-[#1B2A41]">
            Pesan Layanan
        </h1>
        <p class="text-sm text-[#4B5563] mt-1">
            Pesan layanan laundry anda dibawah
        </p>
        <form aria-label="Laundry order form" class="mt-6 w-full max-w-md border border-[#1B2A41]/20 rounded-lg p-6">
            <h2 class="text-sm font-semibold text-[#1B2A41] mb-4 text-center">
                Fuad Laundry
            </h2>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-[#1B2A41] mb-1" for="service">
                    Pilih Layanan
                </label>
                <select
                    class="w-full border border-[#1B2A41]/20 rounded-md text-xs text-[#1B2A41] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#1B2A41]"
                    id="service" name="service">
                    <option>
                        Cuci Setrika
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-[#1B2A41] mb-1" for="quantity">
                    Kuantitas
                </label>
                <div class="flex items-center border border-[#1B2A41]/20 rounded-md overflow-hidden">
                    <input class="w-full text-xs text-[#1B2A41] py-2 px-3 focus:outline-none" id="quantity" min="0"
                        name="quantity" type="number" value="2" />
                    <span class="text-xs text-[#1B2A41] bg-white border-l border-[#1B2A41]/20 px-2 select-none">
                        Kg
                    </span>
                </div>
            </div>
            <div class="text-[9px] text-[#1B2A41] mb-4 grid grid-cols-2 gap-x-2">
                <div>
                    <p class="leading-4">
                        Estimasi Penyelesaian
                    </p>
                    <p class="leading-4 font-normal">
                        Total Harga Layanan
                    </p>
                    <p class="leading-4 font-normal">
                        Total kuantitas Laundry
                    </p>
                </div>
                <div class="text-right">
                    <p class="leading-4">
                        01 Juni 2025
                    </p>
                    <p class="leading-4 font-normal">
                        Rp 7.500/kg
                    </p>
                    <p class="leading-4 font-normal">
                        2 Kg
                    </p>
                </div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-[#1B2A41] mb-4">
                <span>
                    Total Harga
                </span>
                <span>
                    Rp 15.000
                </span>
            </div>
            <div class="flex space-x-3">
                <button class="flex-1 bg-[#8CA3B7] text-white text-xs py-2 rounded-md disabled:opacity-50" type="submit">
                    Pesan
                </button>
                <button
                    class="flex-1 border border-[#8CA3B7] text-[#8CA3B7] text-xs py-2 rounded-md hover:bg-[#8CA3B7] hover:text-white transition"
                    type="button">
                    Batal
                </button>
            </div>
        </form>
    </main>
@endsection

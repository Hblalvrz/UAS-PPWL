@extends('customer.layouts.app2')

@section('content2')

<main class="max-w-5xl mx-auto px-6">
   <h1 class="text-2xl font-semibold text-center mt-10 mb-8">
    Riwayat Pemesanan
   </h1>
   <section class="border border-gray-400 rounded-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0">
    <div class="flex flex-col space-y-1">
     <span class="text-[#8ea9c3] text-sm">
      31 Mei 2025
     </span>
     <div class="flex items-center space-x-2">
      <h2 class="font-semibold text-[#1f3646] text-lg">
       Fuad Laundry
      </h2>
      <span class="bg-[#7ac47a] text-xs font-semibold text-[#1f3646] rounded-md px-2 py-0.5 select-none">
       Selesai
      </span>
     </div>
     <p class="text-[#1f3646]">
      Cuci Setrika
     </p>
     <p class="text-[#1f3646]">
      1 Kg x Rp7.500
     </p>
    </div>
    <div class="flex flex-col md:flex-row md:items-center md:space-x-6 text-[#1f3646]">
     <div class="text-right mb-4 md:mb-0">
      <p class="text-sm">
       Total Pemesanan
      </p>
      <p class="font-bold text-lg">
       Rp15.000
      </p>
     </div>
     <div class="flex items-center space-x-4">
      <button class="text-xs font-semibold text-[#1f3646] hover:underline focus:outline-none" type="button">
       Lihat Detail Pesanan
      </button>
      <button class="bg-[#1f3646] text-white text-xs font-semibold rounded-md px-4 py-2 hover:bg-[#16304a] focus:outline-none" type="button">
       Pesan Lagi
      </button>
     </div>
    </div>
   </section>
  </main>

@endsection
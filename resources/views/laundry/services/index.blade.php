{{-- resources/views/laundry/services/index.blade.php --}}
@extends('laundry.layouts.app')

@section('content')
<div class="container mx-auto py-8">

    {{-- Flash message sukses (jika berasal dari store/update/destroy) --}}
    @if(session('success'))
        <div class="mb-4 border border-green-300 bg-green-100 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Judul & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Layanan Laundry</h1>
        <a href="{{ route('services.create') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-blue-700 transition">
           + Tambah Layanan
        </a>
    </div>

    {{-- Jika tidak ada data --}}
    @if($services->isEmpty())
        <div class="bg-white border border-gray-200 py-6 text-center text-gray-500">
            Belum ada layanan.
        </div>
    @else
        {{-- Tabel Sederhana Menggunakan List --}}
        <ul class="space-y-4">
            @foreach($services as $service)
                <li class="bg-[#E6F4FF] border border-gray-200 rounded-lg p-4 flex items-center space-x-4">
                    {{-- Nama Layanan dan Harga --}}
                    <div class="flex-1">
                        <div class="text-lg font-semibold text-gray-700">{{ $service->service_name }}</div>
                        <div class="text-gray-600">
                            Rp {{ number_format($service->price_per_kg, 0, ',', '.') }}/kg
                        </div>
                    </div>

                    {{-- Tampilkan Gambar kalau ada --}}
                    @if($service->image_path)
                        <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden">
                            <img src="{{ asset('storage/' . $service->image_path) }}"
                                 alt="{{ $service->service_name }}"
                                 class="object-contain w-full h-full">
                        </div>
                    @else
                        <div class="w-20 h-20 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif

                    {{-- Aksi: Edit / Hapus --}}
                    <div class="flex space-x-2">
                        {{-- Link Edit --}}
                        <a href="{{ route('services.edit', $service->id) }}"
                           class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">
                            Edit
                        </a>

                        {{-- Form Hapus --}}
                        <form action="{{ route('services.destroy', $service->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

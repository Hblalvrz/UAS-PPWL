{{-- resources/views/laundry/services/edit.blade.php --}}
@extends('laundry.layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-md">
    {{-- 1) Tampilkan flash message sukses --}}
    @if(session('success'))
        <div class="mb-4 border border-green-300 bg-green-100 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
            <div class="mt-2">
                <a href="{{ route('services.index') }}"
                   class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Layanan</a>
            </div>
        </div>
    @endif

    {{-- 2) Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="mb-4 border border-red-300 bg-red-100 text-red-800 px-4 py-3 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Layanan</h1>

    <form action="{{ route('services.update', $service->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4 bg-white shadow rounded-lg p-6">

        @csrf
        @method('PUT')

        {{-- Nama Layanan --}}
        <div>
            <label for="service_name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
            <input type="text"
                   name="service_name"
                   id="service_name"
                   value="{{ old('service_name', $service->service_name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500"
                   placeholder="Misal: Cuci Lipat"
                   required>
        </div>

        {{-- Harga per Kg --}}
        <div>
            <label for="price_per_kg" class="block text-sm font-medium text-gray-700">Harga / Kg</label>
            <input type="number"
                   name="price_per_kg"
                   id="price_per_kg"
                   step="0.01"
                   value="{{ old('price_per_kg', $service->price_per_kg) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500"
                   placeholder="Misal: 5000"
                   required>
        </div>

        {{-- Tampilkan preview gambar lama (jika ada) --}}
        @if($service->image_path)
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                <div class="mt-1 w-32 h-32 bg-gray-100 rounded overflow-hidden shadow">
                    <img src="{{ asset('storage/' . $service->image_path) }}"
                         alt="{{ $service->service_name }}"
                         class="object-contain w-full h-full">
                </div>
                <p class="text-xs text-gray-500 mt-1">Gambar ini akan diganti jika Anda pilih file baru.</p>
            </div>
        @endif

        {{-- Upload Gambar Baru --}}
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Ganti Gambar Layanan (opsional)</label>
            <input type="file"
                   name="image"
                   id="image"
                   accept="image/*"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>

        {{-- Tombol Perbarui & Batal --}}
        <div class="flex justify-end space-x-2">
            <a href="{{ route('services.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection

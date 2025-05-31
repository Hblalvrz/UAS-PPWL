@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-md">
  <h1 class="text-xl font-semibold text-gray-800 mb-6">Edit Layanan Laundry</h1>

  <form action="{{ route('services.update', $service->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label for="service_name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
      <input type="text" name="service_name" id="service_name"
             value="{{ old('service_name', $service->service_name) }}"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>

    <div>
      <label for="price_per_kg" class="block text-sm font-medium text-gray-700">Harga per Kg</label>
      <input type="number" name="price_per_kg" id="price_per_kg" step="0.01"
             value="{{ old('price_per_kg', $service->price_per_kg) }}"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>

    <div class="flex space-x-2">
      <button type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Update
      </button>
      <a href="{{ route('services.index') }}"
         class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection

{{-- resources/views/laundry/services/edit.blade.php --}}
@extends('laundry.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Layanan</h1>

    {{-- Alert --}}
    <div id="alert-container" class="mb-4"></div>

    {{-- Form --}}
    <form id="form-edit" class="bg-white shadow rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        @method('PUT' {{-- ini hanya penanda di HTML, kita akan override di JS --}})

        {{-- Nama Layanan --}}
        <div class="mb-4">
            <label for="service_name" class="block text-gray-700 font-medium mb-2">
                Nama Layanan
            </label>
            <input type="text"
                   name="service_name"
                   id="service_name"
                   class="w-full border-gray-300 rounded-md shadow-sm p-2"
                   placeholder="Loading..." required />
        </div>

        {{-- Harga per Kg --}}
        <div class="mb-4">
            <label for="price_per_kg" class="block text-gray-700 font-medium mb-2">
                Harga / Kg
            </label>
            <input type="number"
                   name="price_per_kg"
                   id="price_per_kg"
                   class="w-full border-gray-300 rounded-md shadow-sm p-2"
                   placeholder="Loading..." required />
        </div>

        {{-- Preview Gambar Lama --}}
        <div id="old-image-container" class="mb-4 hidden">
            <label class="block text-gray-700 font-medium mb-2">Gambar Saat Ini:</label>
            <div id="old-image-box" class="w-32 h-32 bg-white rounded-lg overflow-hidden shadow mb-2"></div>
            <p class="text-sm text-gray-500">Gambar di atas akan diganti jika Anda pilih file baru.</p>
        </div>

        {{-- Upload Gambar Baru --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">
                Ganti Gambar Layanan (opsional)
            </label>
            <input type="file"
                   name="image"
                   id="image"
                   accept="image/*"
                   class="w-full border-gray-300 rounded-md shadow-sm p-2" />
        </div>

        {{-- Submit + Batal --}}
        <div class="flex justify-end">
            <a href="{{ route('services.index') }}"
               class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Perbarui
            </button>
        </div>
    </form>
</div>

{{-- JavaScript untuk mem‐fetch detail, prefilling, dan submit --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form       = document.getElementById('form-edit');
    const alertContainer = document.getElementById('alert-container');
    const serviceId  = @json($id); // dari route, kita terima $id di view

    const inputName  = document.getElementById('service_name');
    const inputPrice = document.getElementById('price_per_kg');
    const oldImageContainer = document.getElementById('old-image-container');
    const oldImageBox = document.getElementById('old-image-box');

    function showAlert(type, message) {
        const colors = {
            success: 'bg-green-100 text-green-800 border-green-300',
            error:   'bg-red-100 text-red-800 border-red-300'
        };
        const alertDiv = document.createElement('div');
        alertDiv.className = `border px-4 py-3 rounded mb-4 ${colors[type]}`;
        alertDiv.innerHTML = `
            <span>${message}</span>
            <button onclick="this.parentElement.remove()" class="float-right font-bold">&times;</button>
        `;
        alertContainer.appendChild(alertDiv);
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 1. Ambil detail layanan dari API
    fetch(`/api/services/${serviceId}`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal memuat detail layanan. Status: ' + response.status);
        }
        return response.json();
    })
    .then(service => {
        // Prefill form
        inputName.value  = service.service_name;
        inputPrice.value = service.price_per_kg;

        // Tampilkan gambar lama jika ada
        if (service.image) {
            oldImageContainer.classList.remove('hidden');
            oldImageBox.innerHTML = `
                <img src="/storage/services/${service.image}" 
                     alt="${service.service_name}"
                     class="object-contain w-full h-full" />
            `;
        }
    })
    .catch(err => {
        showAlert('error', err.message);
    });

    // 2. Submit form (PUT ke API)
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('service_name', inputName.value);
        formData.append('price_per_kg', inputPrice.value);

        const imgInput = document.getElementById('image');
        if (imgInput.files.length > 0) {
            formData.append('image', imgInput.files[0]);
        }

        fetch(`/api/services/${serviceId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: formData
        })
        .then(response => {
            if (response.status === 422) {
                return response.json().then(json => {
                    const errors = json.errors || {};
                    let messages = '';
                    Object.values(errors).forEach(arr => {
                        arr.forEach(msg => { messages += `<li>${msg}</li>`; });
                    });
                    throw new Error(`<ul class="list-disc pl-5 text-sm text-red-700">${messages}</ul>`);
                });
            }
            if (!response.ok) {
                throw new Error('Server error: ' + response.status);
            }
            return response.json();
        })
        .then(json => {
            showAlert('success', 'Layanan berhasil diperbarui.');
            setTimeout(() => {
                window.location.href = '{{ route('services.index') }}';
            }, 1000);
        })
        .catch(err => {
            showAlert('error', err.message);
        });
    });
});
</script>
@endpush
@endsection

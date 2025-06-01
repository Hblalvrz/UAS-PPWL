{{-- resources/views/laundry/services/create.blade.php --}}
@extends('laundry.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Layanan Baru</h1>

    {{-- Alert container --}}
    <div id="alert-container" class="mb-4"></div>

    <form id="form-create" class="bg-white shadow rounded-lg p-6" enctype="multipart/form-data">
        @csrf

        {{-- Nama Layanan --}}
        <div class="mb-4">
            <label for="service_name" class="block text-gray-700 font-medium mb-2">
                Nama Layanan
            </label>
            <input type="text"
                   name="service_name"
                   id="service_name"
                   class="w-full border-gray-300 rounded-md shadow-sm p-2"
                   placeholder="Misal: Cuci Lipat" required />
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
                   placeholder="Misal: 5000" required />
        </div>

        {{-- Upload Gambar --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">
                Gambar Layanan (opsional)
            </label>
            <input type="file"
                   name="image"
                   id="image"
                   accept="image/*"
                   class="w-full border-gray-300 rounded-md shadow-sm p-2" />
        </div>

        {{-- Tombol Batal & Simpan --}}
        <div class="flex justify-end">
            <a href="{{ route('services.index') }}"
               class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-create');
    const alertContainer = document.getElementById('alert-container');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('service_name', document.getElementById('service_name').value);
        formData.append('price_per_kg', document.getElementById('price_per_kg').value);
        const imgInput = document.getElementById('image');
        if (imgInput.files.length > 0) {
            formData.append('image', imgInput.files[0]);
        }

        fetch('/api/services', {
            method: 'POST',
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
                    let messages = '<ul class="list-disc pl-5 text-sm text-red-700">';
                    Object.values(errors).forEach(arr => {
                        arr.forEach(msg => { messages += `<li>${msg}</li>`; });
                    });
                    messages += '</ul>';
                    throw new Error(messages);
                });
            }
            if (!response.ok) {
                throw new Error('Server error: ' + response.status);
            }
            return response.json();
        })
        .then(json => {
            // Tampilkan pesan sukses
            showAlert('success', 'Layanan berhasil ditambahkan.');
            // Reset form agar kosong kembali
            form.reset();
        })
        .catch(err => {
            showAlert('error', err.message);
        });
    });
});
</script>
@endpush
@endsection

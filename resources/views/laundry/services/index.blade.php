{{-- resources/views/laundry/services/index.blade.php --}}
@extends('laundry.layouts.app')

fetch('/api/services', { ... })
    .then(response => response.json())
    .then(data => renderServices(data))

@section('content')
<div class="container mx-auto py-8">
    {{-- Title & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Layanan & Harga</h1>
        <a href="{{ route('services.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            + Tambah Layanan
        </a>
    </div>

    {{-- Kontainer untuk menaruh feedback (error/success) --}}
    <div id="alert-container" class="mb-4"></div>

    {{-- Tabel Header --}}
    <div class="grid grid-cols-12 bg-blue-200 py-2 rounded-t border border-blue-200">
        <div class="col-span-8 px-4 font-medium text-gray-700">Layanan</div>
        <div class="col-span-4 px-4 font-medium text-gray-700 text-center">Harga / Kg</div>
    </div>

    {{-- Container kosong yang akan diisi baris layanan lewat JS --}}
    <div id="services-list">
        {{-- Jika belum men‐fetch data atau data kosong, JS akan menampilkan. --}}
        <div class="bg-white border border-gray-200 py-6 text-center text-gray-500">
            Memuat data layanan...
        </div>
    </div>
</div>

{{-- JavaScript untuk fetch data dan render --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const servicesList = document.getElementById('services-list');
    const alertContainer = document.getElementById('alert-container');

    // Fungsi untuk tampilkan alert (success / error) di atas tabel
    function showAlert(type, message) {
        // type: 'success' | 'error'
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

    // Ambil CSRF token dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fungsi untuk mem‐fetch daftar layanan
    function fetchServices() {
        fetch('/api/services', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            credentials: 'same-origin' // sertakan cookie/session jika dibutuhkan
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memuat data layanan. Status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            renderServices(data);
        })
        .catch(err => {
            servicesList.innerHTML = `
                <div class="bg-red-100 border border-red-300 py-6 text-center text-red-700">
                    ${err.message}
                </div>
            `;
        });
    }

    // Fungsi untuk merender HTML baris‐baris layanan
    function renderServices(services) {
        if (!services.length) {
            servicesList.innerHTML = `
                <div class="bg-white border border-gray-200 py-6 text-center text-gray-500">
                    Belum ada layanan.
                </div>
            `;
            return;
        }

        // Reset kontainer
        servicesList.innerHTML = '';

        services.forEach(service => {
            // Format harga, misalnya "5.000"
            const priceFormatted = Number(service.price_per_kg).toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });

            // Buat elemen row
            const rowDiv = document.createElement('div');
            rowDiv.className = 'grid grid-cols-12 items-center bg-blue-100 py-4 border-y border-blue-200';

            // Col 8: Gambar + Nama Layanan
            const colLeft = document.createElement('div');
            colLeft.className = 'col-span-8 flex items-center px-4 space-x-4';

            // Kotak gambar
            const imgBox = document.createElement('div');
            imgBox.className = 'w-20 h-20 bg-white rounded-lg flex items-center justify-center overflow-hidden shadow';
            if (service.image) {
                const imgEl = document.createElement('img');
                imgEl.src = `/storage/services/${service.image}`; // asumsikan path penyimpanan
                imgEl.alt = service.service_name;
                imgEl.className = 'object-contain w-full h-full';
                imgBox.appendChild(imgEl);
            } else {
                // Placeholder (SVG)
                imgBox.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-10 w-10 text-gray-300"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 3h18v18H3V3z" />
                    </svg>
                `;
            }

            const nameDiv = document.createElement('div');
            nameDiv.innerHTML = `<div class="text-lg font-semibold text-gray-700">${service.service_name}</div>`;

            colLeft.appendChild(imgBox);
            colLeft.appendChild(nameDiv);

            // Col 2: Harga
            const colPrice = document.createElement('div');
            colPrice.className = 'col-span-2 px-4 text-center';
            colPrice.innerHTML = `
                <div class="text-lg font-semibold text-gray-700">
                    Rp ${priceFormatted}/kg
                </div>
            `;

            // Col 2: Aksi (Lihat, Edit, Hapus)
            const colActions = document.createElement('div');
            colActions.className = 'col-span-2 flex justify-center items-center space-x-4 px-4';

            // Tombol “Lihat” (bisa diarahkan ke /services/{id}/show jika Anda punya halaman detail)
            const lihatLink = document.createElement('a');
            lihatLink.href = `/services/${service.id}/show`; // <-- Anda bisa ganti URL show sesuai kebutuhan
            lihatLink.className = 'flex items-center space-x-1 text-gray-700 hover:text-blue-800 transition';
            lihatLink.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="font-medium">Lihat</span>
            `;

            // Tombol “Edit”
            const editLink = document.createElement('a');
            editLink.href = `/services/${service.id}/edit`;
            editLink.className = 'flex items-center space-x-1 text-yellow-500 hover:text-yellow-600 transition';
            editLink.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M11 4H4a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-7m-1.414-1.414L16 4m-5 5l5-5" />
                </svg>
                <span class="font-medium">Edit</span>
            `;

            // Tombol “Hapus”
            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'flex items-center space-x-1 text-red-500 hover:text-red-600 transition';
            deleteBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M20 7H4m2 0v12a2 2 0 002 2h8a2 2 0 002-2V7m-4 0V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v3m8 0H8" />
                </svg>
                <span class="font-medium">Hapus</span>
            `;
            // Event saat tombol Hapus diklik
            deleteBtn.addEventListener('click', function () {
                if (!confirm('Yakin ingin menghapus layanan ini?')) return;

                fetch(`/api/services/${service.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal hapus layanan. Status: ' + res.status);
                    return res.json();
                })
                .then(json => {
                    showAlert('success', 'Layanan berhasil dihapus.');
                    // Refresh daftar setelah berhasil hapus
                    fetchServices();
                })
                .catch(err => {
                    showAlert('error', err.message);
                });
            });

            colActions.appendChild(lihatLink);
            colActions.appendChild(editLink);
            colActions.appendChild(deleteBtn);

            // Satukan ke dalam rowDiv
            rowDiv.appendChild(colLeft);
            rowDiv.appendChild(colPrice);
            rowDiv.appendChild(colActions);

            servicesList.appendChild(rowDiv);
        });
    }

    // Panggil fetchServices saat halaman siap
    fetchServices();
});
</script>
@endpush
@endsection

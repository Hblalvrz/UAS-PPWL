@extends('customer.layouts.app2')

@section('content2')
    <main class="flex flex-col items-center px-4 mt-8">
        <!-- Header Konten -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <i class="fas fa-truck-loading text-3xl text-[#1B2A41]"></i>
            </div>
            <h1 class="text-xl font-bold text-[#1B2A41]">
                Pesan Layanan Laundry
            </h1>
            <p class="text-sm text-[#4B5563] mt-1">
                Silakan lengkapi detail pesanan Anda
            </p>
        </div>

        <!-- Form Pesanan -->
        <form action="{{ route('customer.order.store') }}" method="POST"
            class="w-full max-w-md bg-white rounded-xl shadow-md p-6 border border-[#1B2A41]/10" id="orderForm">
            @csrf
            <input type="hidden" name="laundryProvider" value="{{ $provider->laundryProvider }}">

            <!-- Nama Laundry -->
            <div class="flex items-center justify-center gap-2 mb-4">
                <i class="fas fa-store-alt text-[#1B2A41]"></i>
                <h2 class="text-base font-semibold text-[#1B2A41]">
                    {{ $provider->laundry_name }}
                </h2>
            </div>

            <!-- Input Layanan -->
            <div class="mb-5">
                <label class="block text-xs font-medium text-[#1B2A41] mb-1" for="service">
                    Layanan
                </label>
                <select
                    class="w-full border border-[#1B2A41]/20 rounded-lg text-sm text-[#1B2A41] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#1B2A41]"
                    id="service" name="laundryService" required>
                    @foreach ($services as $service)
                        <option value="{{ $service->laundryService }}" data-price="{{ $service->price_per_kg }}">
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input Kuantitas -->
            <div class="mb-5">
                <label class="block text-xs font-medium text-[#1B2A41] mb-1" for="quantity">
                    Kuantitas (Kg)
                </label>
                <div class="flex items-center border border-[#1B2A41]/20 rounded-lg overflow-hidden">
                    <input class="w-full text-sm text-[#1B2A41] py-2 px-3 focus:outline-none" id="quantity" min="1"
                        name="quantity" type="number" value="2" required />
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="bg-[#F5F7FA] rounded-lg p-4 mb-5">
                <h3 class="text-xs font-semibold text-[#1B2A41] mb-2">Ringkasan Pesanan</h3>
                <div class="grid grid-cols-2 gap-y-2 text-xs text-[#1B2A41]">
                    <span>Estimasi Penyelesaian</span>
                    <span class="text-right" id="estimation">
                        {{ \Carbon\Carbon::now()->addDay()->translatedFormat('d F Y') }}
                    </span>
                    <span>Harga per Kg</span>
                    <span class="text-right" id="pricePerKg">
                        Rp {{ number_format($services->first()->price_per_kg ?? 0, 0, ',', '.') }}
                    </span>
                    <span>Total Kuantitas</span>
                    <span class="text-right" id="totalQuantity">
                        2 Kg
                    </span>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="flex justify-between items-center text-sm font-semibold text-[#1B2A41] mb-6">
                <span>Total Harga</span>
                <span class="text-lg font-bold" id="totalPrice">
                    Rp {{ number_format(($services->first()->price_per_kg ?? 0) * 2, 0, ',', '.') }}
                </span>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3">
                <a href="{{ route('provider.list') }}"
                    class="flex-1 border border-[#1B2A41]/30 text-[#1B2A41] text-sm py-2 rounded-lg hover:bg-[#1B2A41]/10 text-center transition">
                    Batal
                </a>
                <button
                    class="flex-1 bg-[#1B2A41] text-white text-sm py-2 rounded-lg hover:bg-[#1B2A41]/90 transition flex items-center justify-center gap-1"
                    type="button" id="btnPesan">
                    <i class="fas fa-shopping-basket text-white text-sm"></i>
                    Pesan
                </button>
            </div>
        </form>
    </main>

    <!-- Pop-up Konfirmasi -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg p-6 mx-4 max-w-sm w-full">
            <!-- Header Modal -->
            <div class="text-center mb-4">
                <div class="flex justify-center mb-2">
                    <i class="fas fa-exclamation-triangle text-3xl text-yellow-500"></i>
                </div>
                <h3 class="text-lg font-bold text-[#1B2A41]">Konfirmasi Pesanan</h3>
            </div>

            <!-- Detail Konfirmasi -->
            <div class="bg-[#F5F7FA] rounded-lg p-4 mb-4">
                <div class="text-xs text-[#1B2A41] space-y-2">
                    <div class="flex justify-between">
                        <span>Laundry:</span>
                        <span class="font-semibold">{{ $provider->laundry_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Layanan:</span>
                        <span class="font-semibold" id="confirmService"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Kuantitas:</span>
                        <span class="font-semibold" id="confirmQuantity"></span>
                    </div>
                    <div class="flex justify-between border-t pt-2 mt-2">
                        <span>Total Harga:</span>
                        <span class="font-bold text-[#1B2A41]" id="confirmTotal"></span>
                    </div>
                </div>
            </div>

            <p class="text-xs text-[#4B5563] text-center mb-6">
                Apakah Anda yakin ingin melanjutkan pesanan ini?
            </p>

            <!-- Tombol Modal -->
            <div class="flex gap-3">
                <button
                    class="flex-1 border border-[#1B2A41]/30 text-[#1B2A41] text-sm py-2 rounded-lg hover:bg-[#1B2A41]/10 transition"
                    id="cancelOrder">
                    Batal
                </button>
                <button class="flex-1 bg-[#1B2A41] text-white text-sm py-2 rounded-lg hover:bg-[#1B2A41]/90 transition"
                    id="confirmOrder">
                    Ya, Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            const quantityInput = document.getElementById('quantity');
            const pricePerKgEl = document.getElementById('pricePerKg');
            const totalPriceEl = document.getElementById('totalPrice');
            const totalQuantityEl = document.getElementById('totalQuantity');
            const btnPesan = document.getElementById('btnPesan');
            const orderForm = document.getElementById('orderForm');

            // Modal elements
            const confirmationModal = document.getElementById('confirmationModal');
            const confirmService = document.getElementById('confirmService');
            const confirmQuantity = document.getElementById('confirmQuantity');
            const confirmTotal = document.getElementById('confirmTotal');
            const cancelOrder = document.getElementById('cancelOrder');
            const confirmOrder = document.getElementById('confirmOrder');

            function updateTotal() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const pricePerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const total = pricePerKg * quantity;

                pricePerKgEl.textContent = 'Rp ' + pricePerKg.toLocaleString('id-ID');
                totalPriceEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalQuantityEl.textContent = quantity + ' Kg';

                btnPesan.disabled = quantity < 1;
            }

            function showConfirmationModal() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const serviceName = selectedOption.textContent;
                const quantity = quantityInput.value;
                const total = totalPriceEl.textContent;

                confirmService.textContent = serviceName;
                confirmQuantity.textContent = quantity + ' Kg';
                confirmTotal.textContent = total;

                confirmationModal.classList.remove('hidden');
                confirmationModal.classList.add('flex');
            }

            function hideConfirmationModal() {
                confirmationModal.classList.add('hidden');
                confirmationModal.classList.remove('flex');
            }

            // Event listeners
            serviceSelect.addEventListener('change', updateTotal);
            quantityInput.addEventListener('input', updateTotal);

            // Show modal when order button is clicked
            btnPesan.addEventListener('click', function(e) {
                e.preventDefault();
                if (quantityInput.value >= 1) {
                    showConfirmationModal();
                }
            });

            // Hide modal when cancel is clicked
            cancelOrder.addEventListener('click', hideConfirmationModal);

            // Submit form when confirm is clicked
            confirmOrder.addEventListener('click', function() {
                hideConfirmationModal();
                orderForm.submit();
            });

            // Close modal when clicking outside
            confirmationModal.addEventListener('click', function(e) {
                if (e.target === confirmationModal) {
                    hideConfirmationModal();
                }
            });

            updateTotal();
        });
    </script>
@endsection

@extends('customer.layouts.app2')

@section('content2')
    <main class="flex flex-col items-center px-4 mt-10">
        <h1 class="text-lg font-semibold text-[#1B2A41]">
            Pesan Layanan
        </h1>
        <p class="text-sm text-[#4B5563] mt-1">
            Pesan layanan laundry anda dibawah
        </p>

        <form action="{{ route('customer.order.store') }}" method="POST"
            class="mt-6 w-full max-w-md border border-[#1B2A41]/20 rounded-lg p-6">
            @csrf
            <input type="hidden" name="laundryProvider" value="{{ $provider->laundryProvider }}">

            <h2 class="text-sm font-semibold text-[#1B2A41] mb-4 text-center">
                {{ $provider->laundry_name }}
            </h2>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[#1B2A41] mb-1" for="service">
                    Pilih Layanan
                </label>
                <select
                    class="w-full border border-[#1B2A41]/20 rounded-md text-xs text-[#1B2A41] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#1B2A41]"
                    id="service" name="laundryService" required>
                    @foreach ($services as $service)
                        <option value="{{ $service->laundryService }}" data-price="{{ $service->price_per_kg }}">
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[#1B2A41] mb-1" for="quantity">
                    Kuantitas
                </label>
                <div class="flex items-center border border-[#1B2A41]/20 rounded-md overflow-hidden">
                    <input class="w-full text-xs text-[#1B2A41] py-2 px-3 focus:outline-none" id="quantity" min="1"
                        name="quantity" type="number" value="2" required />
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
                    <p class="leading-4" id="estimation">
                        {{ \Carbon\Carbon::now()->addDay()->translatedFormat('d F Y') }}
                    </p>
                    <p class="leading-4 font-normal" id="pricePerKg">
                        Rp {{ number_format($services->first()->price_per_kg ?? 0, 0, ',', '.') }}/kg
                    </p>
                    <p class="leading-4 font-normal" id="totalQuantity">
                        2 Kg
                    </p>
                </div>
            </div>

            <div class="flex justify-between text-xs font-semibold text-[#1B2A41] mb-4">
                <span>
                    Total Harga
                </span>
                <span id="totalPrice">
                    Rp {{ number_format(($services->first()->price_per_kg ?? 0) * 2, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex space-x-3">
                <button class="flex-1 bg-[#8CA3B7] text-white text-xs py-2 rounded-md" type="submit" id="btnPesan">
                    Pesan
                </button>
                <a href="{{ route('provider.list') }}"
                    class="flex-1 border border-[#8CA3B7] text-[#8CA3B7] text-xs py-2 rounded-md hover:bg-[#8CA3B7] hover:text-white transition text-center leading-8">
                    Batal
                </a>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            const quantityInput = document.getElementById('quantity');
            const pricePerKgEl = document.getElementById('pricePerKg');
            const totalPriceEl = document.getElementById('totalPrice');
            const totalQuantityEl = document.getElementById('totalQuantity');
            const btnPesan = document.getElementById('btnPesan');

            function updateTotal() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const pricePerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const total = pricePerKg * quantity;

                pricePerKgEl.textContent = 'Rp ' + pricePerKg.toLocaleString('id-ID') + '/kg';
                totalPriceEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalQuantityEl.textContent = quantity + ' Kg';

                // Disable Pesan button if quantity < 1
                btnPesan.disabled = quantity < 1;
            }

            serviceSelect.addEventListener('change', updateTotal);
            quantityInput.addEventListener('input', updateTotal);

            updateTotal();
        });
    </script>
@endsection

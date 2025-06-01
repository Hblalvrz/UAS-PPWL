@extends('customer.layouts.app2')

@section('content2')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Berikan Ulasan</h1>
                <p class="text-blue-100">Bagikan pengalaman Anda dengan layanan laundry</p>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                <i class="fas fa-star text-yellow-300 text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Ubah peletakan form agar tidak ada space kosong kanan -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">
                <i class="fas fa-edit text-blue-600 mr-2"></i>
                Tulis Ulasan Anda
            </h2>

            <form id="reviewForm" class="space-y-6">
                @csrf

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                        Berikan Rating
                    </label>
                    <div class="flex items-center space-x-1 mb-2">
                        <div id="starRating" class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="{{ $i }}">
                                    <i class="fas fa-star"></i>
                                </button>
                            @endfor
                        </div>
                        <span id="ratingText" class="ml-3 text-gray-600 font-medium">Pilih rating Anda</span>
                    </div>
                    <input type="hidden" name="value" id="ratingValue" value="0">
                    <p class="text-sm text-gray-500">Klik bintang untuk memberikan penilaian (1-5)</p>
                </div>

                <!-- Konten Ulasan -->
                <div>
                    <label for="contents" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-blue-600 mr-1"></i>
                        Tulis Ulasan Anda
                    </label>
                    <textarea name="contents" id="contents" rows="6" required
                              placeholder="Ceritakan pengalaman Anda dengan layanan laundry ini. Apa yang Anda sukai? Bagaimana kualitas pelayanannya? Berikan detail yang membantu pengguna lain..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-colors"></textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-sm text-gray-500">Minimal 20 karakter</p>
                        <span id="charCount" class="text-sm text-gray-400">0/500</span>
                    </div>
                </div>

                <!-- Kategori Review -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <i class="fas fa-tags text-blue-600 mr-1"></i>
                        Aspek yang Dinilai (Opsional)
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="aspects[]" value="kualitas" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Kualitas Cuci</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="aspects[]" value="kecepatan" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Kecepatan</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="aspects[]" value="pelayanan" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Pelayanan</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="aspects[]" value="harga" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Harga</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <button type="submit" id="submitBtn"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Ulasan
                    </button>
                    <button type="button" onclick="resetForm()"
                            class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                        <i class="fas fa-refresh mr-2"></i>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check text-green-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Ulasan Berhasil Dikirim!</h3>
            <p class="text-sm text-gray-500 mb-4">Terima kasih atas ulasan Anda. Ulasan akan ditinjau terlebih dahulu sebelum dipublikasikan.</p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeSuccessModal()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Tutup
                </button>
                <button onclick="writeAnother()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Tulis Lagi
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentRating = 0;
    function setRating(rating) {
        currentRating = rating;
        document.getElementById('ratingValue').value = rating;
        highlightStars(rating);
        updateRatingText(rating);
    }
    function highlightStars(rating) {
        document.querySelectorAll('.star-btn').forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }
    function updateRatingText(rating) {
        const texts = {
            1: 'Sangat Buruk',
            2: 'Buruk',
            3: 'Cukup',
            4: 'Baik',
            5: 'Sangat Baik'
        };
        document.getElementById('ratingText').textContent = texts[rating] || 'Pilih rating Anda';
    }
    document.querySelectorAll('.star-btn').forEach(star => {
        star.addEventListener('click', function(e) {
            e.preventDefault();
            setRating(parseInt(this.dataset.rating));
        });
        star.addEventListener('mouseenter', function() {
            highlightStars(parseInt(this.dataset.rating));
        });
    });
    document.getElementById('starRating').addEventListener('mouseleave', function() {
        highlightStars(currentRating);
    });
</script>
@endpush
@endsection
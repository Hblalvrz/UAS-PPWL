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

        <main class="max-w-5xl mx-auto px-6 py-12">
            <!-- Form Review -->
            <section class="bg-white rounded-xl shadow-md p-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Beri Ulasan</h2>
                <form action="{{ route('customer.review.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="laundryProviders" value="{{ $order->laundryProvider }}">

                    <!-- Rating -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                            Berikan Rating (1-5)
                        </label>
                        <div class="flex items-center space-x-1 mb-2">
                            <div id="starRating" class="flex space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button"
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition-colors"
                                        data-rating="{{ $i }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                @endfor
                            </div>
                            <span id="ratingText" class="ml-3 text-gray-600 font-medium">Pilih rating Anda</span>
                        </div>
                        <input type="hidden" name="value" id="ratingValue" value="0" required>
                    </div>

                    <!-- Konten Ulasan -->
                    <div>
                        <label for="contents" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment-alt text-blue-600 mr-1"></i>
                            Tulis Ulasan Anda
                        </label>
                        <textarea name="contents" id="contents" rows="5" required
                            placeholder="Ceritakan pengalaman Anda dengan layanan laundry ini..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-colors"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </section>


        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const starButtons = document.querySelectorAll('.star-btn');
                const ratingValue = document.getElementById('ratingValue');
                const ratingText = document.getElementById('ratingText');

                starButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const rating = this.getAttribute('data-rating');
                        ratingValue.value = rating;
                        starButtons.forEach((btn, idx) => {
                            if (idx < rating) {
                                btn.classList.add('text-yellow-400');
                                btn.classList.remove('text-gray-300');
                            } else {
                                btn.classList.add('text-gray-300');
                                btn.classList.remove('text-yellow-400');
                            }
                        });
                        ratingText.textContent = `Anda memilih rating ${rating}`;
                    });
                });
            });
        </script>
    @endsection

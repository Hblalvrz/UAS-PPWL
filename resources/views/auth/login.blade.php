@extends ('layouts.auth')

@section('content')

    <div class="flex min-h-screen">
        {{-- Kiri: Form --}}
        <div class="flex flex-1 flex-col justify-center px-8 md:px-24 py-8">
            {{-- Logo --}}
            <div class="mb-10">
                <img src="/logo.png" alt="Clean Waves Logo" class="h-10">
            </div>
            {{-- Heading --}}
            <h1 class="text-3xl md:text-4xl font-bold text-[#2D4559] mb-2">
                Masuk ke Clean Waves
            </h1>
            <p class="text-[#2D4559] text-lg mb-8">
                Selamat datang di Clean Waves!
            </p>
            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm" autocomplete="off">
                @csrf
                {{-- Username --}}
                <div>
                    <label for="name" class="block mb-1 font-bold text-[#2D4559]">
                        Username*
                    </label>
                    <input id="name" name="name" type="text" placeholder="Masukkan username" value="{{ old('name') }}"
                        class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Password --}}
                <div>
                    <label for="password" class="block mb-1 font-bold text-[#2D4559]">
                        Password*
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" placeholder="Masukkan password"
                            class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF] pr-12"
                            required>
                        <button type="button" id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#AEBECD] focus:outline-none"
                            tabindex="-1">
                            {{-- Eye (lihat) --}}
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            {{-- Eye-off (tutup) --}}
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                <path
                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Submit --}}
                <button id="loginBtn" type="submit"
                    class="w-full mt-2 bg-[#AEBECD] text-white font-semibold py-3 rounded-lg transition-colors duration-200 disabled:opacity-50"
                    disabled>
                    Masuk
                </button>
            </form>
            <p class="text-[#25394A] mt-2">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-[#aebecd] hover:text-[#25394A] hover:underline">Buat akun di
                    sini</a></p>
        </div>
        {{-- Kanan: Gambar --}}
        <div class="hidden md:block md:w-1/2 h-screen">
            <img src="/images/laundromat.jpg" alt="Laundry" class="w-full h-full object-cover" />
        </div>
    </div>
    <script>
        // Toggle show/hide password
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeOffIcon.classList.add('hidden');
                }
            });

            // Enable button jika semua field terisi
            const nameInput = document.getElementById('name');
            const btn = document.getElementById('loginBtn');

            function validate() {
                if (
                    nameInput.value.trim() !== '' &&
                    passwordInput.value.trim() !== ''
                ) {
                    btn.disabled = false;
                    btn.classList.remove('bg-[#AEBECD]');
                    btn.classList.add('bg-[#2D4559]', 'hover:bg-[#25394A]');
                } else {
                    btn.disabled = true;
                    btn.classList.remove('bg-[#2D4559]', 'hover:bg-[#25394A]');
                    btn.classList.add('bg-[#AEBECD]');
                }
            }

            nameInput.addEventListener('input', validate);
            passwordInput.addEventListener('input', validate);
        });
    </script>
@endsection
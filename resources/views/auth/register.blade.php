@extends('layouts.app')

@section('content')
    <div class="flex h-screen overflow-hidden">
        {{-- Kiri: Form --}}
        <div class="flex flex-1 flex-col justify-center px-8 md:px-24 py-4">
            <div class="mb-8">
                <img src="/logo.png" alt="Clean Waves Logo" class="h-10">
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-[#2D4559] mb-2">
                Buat Akun Clean Waves
            </h1>
            <p class="text-[#2D4559] text-lg mb-8">
                Buat akun untuk mengakses fitur-fitur CleanWaves
            </p>
            <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf
                <div class="form-group">
                    <label class="block mb-1 font-bold text-[#2D4559]">Username</label>
                    <input type="text" name="name" placeholder="Masukkan username"
                        class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="block mb-1 font-bold text-[#2D4559]">Nomor Telepon</label>
                    <input type="text" name="phone" placeholder="Masukkan nomor telepon"
                        class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
                        required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="block mb-1 font-bold text-[#2D4559]">Alamat</label>
                        <textarea name="address"
                            class="rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD]"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="block mb-1 font-bold text-[#2D4559]">Daftar Sebagai</label>
                        <select name=" user_type"
                            class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
                            required>
                            <option value="" disabled selected>Pilih tipe akun</option>
                            <option value="customer">Customer</option>
                            <option value="laundry_providers">Penyedia Laundry</option>
                        </select>
                    </div>
                </div>
                {{-- Masukkan Password --}}
                <div class="form-group">
                    <label class="block mb-1 font-bold text-[#2D4559]">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="Masukkan password"
                            class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
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
                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label class="block mb-1 font-bold text-[#2D4559]">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Ulangi password"
                            class="block w-full rounded-lg border border-[#AEBECD] px-4 py-3 text-[#2D4559] placeholder-[#AEBECD] focus:outline-none focus:ring-2 focus:ring-[#60B8FF]"
                            required>
                        <button type="button" id="togglePasswordConfirmed"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#AEBECD] focus:outline-none"
                            tabindex="-1">
                            {{-- Eye (lihat) --}}
                            <svg id="eyeIconConfirmed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            {{-- Eye-off (tutup) --}}
                            <svg id="eyeOffIconConfirmed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                <path
                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" id="togglePasswordConfirmed"
                    class="w-full mt-2 bg-[#AEBECD] text-white font-semibold py-3 rounded-lg transition-colors duration-200 disabled:opacity-50">Daftar</button>
            </form>
            <p class="text-[#25394A] mt-2">Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-[#aebecd] hover:text-[#25394A] hover:underline">Login di
                    sini</a></p>
        </div>
        {{-- Kanan: Gambar --}}
        <div id="registerBtn" class="hidden md:block md:w-1/2 h-full">
            <img src="/images/laundromat.jpg" alt="Laundry" class="w-full h-full object-cover" />
        </div>
    </div>
@endsection

<script>
    //Button mata password on/off
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePasswordBtn.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        })
    })

    //Button mata ulangi password on/off
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInputConfirmed = document.getElementById('password_confirmation');
        const togglePasswordBtnConfirmed = document.getElementById('togglePasswordConfirmed');
        const eyeIconConfirmed = document.getElementById('eyeIconConfirmed');
        const eyeOffIconConfirmed = document.getElementById('eyeOffIconConfirmed');

        togglePasswordBtnConfirmed.addEventListener('click', function () {
            if (passwordInputConfirmed.type === 'password') {
                passwordInputConfirmed.type = 'text';
                eyeIconConfirmed.classList.add('hidden');
                eyeOffIconConfirmed.classList.remove('hidden');
            } else {
                passwordInputConfirmed.type = 'password';
                eyeIconConfirmed.classList.remove('hidden');
                eyeOffIconConfirmed.classList.add('hidden');
            }
        })
    })

    //Button enable ketika form terisi semua
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('registerForm');
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        const submitBtn = form.querySelector('button[type="submit"]');

        function validate() {
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                }
            });
            submitBtn.disabled = !allFilled;
            if (allFilled) {
                submitBtn.classList.remove('bg-[#AEBECD]');
                submitBtn.classList.add('bg-[#2D4559]', 'hover:bg-[#25394A]');
            } else {
                submitBtn.classList.add('bg-[#AEBECD]');
                submitBtn.classList.remove('bg-[#2D4559]', 'hover:bg-[#25394A]');
            }
        }

        // Cek setiap kali ada perubahan di input
        inputs.forEach(input => {
            input.addEventListener('input', validate);
            input.addEventListener('change', validate);
        });

        validate(); // cek awal saat page load
    });
</script>
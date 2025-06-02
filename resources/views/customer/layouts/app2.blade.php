<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Clean Waves</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        input::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        /* Animasi dropdown */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease-in-out;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-[#F8FAFF] font-sans text-[#2B3A55] min-h-screen flex flex-col">
    <header class="w-full bg-white border-b border-slate-200">
        <div class="flex items-center justify-between px-6 md:px-8 py-2.5 max-w-7xl mx-auto">
            <div class="flex items-center space-x-2">
                <a href="{{ route('customer.dashboard.index') }}">
                    <img alt="Laundry service logo, dark blue background with white icon"
                        class="w-12 h-12 md:w-14 md:h-14 object-contain" src="/logo.png" />
                </a>
                <span class="text-sm md:text-base font-medium text-slate-700">
                    @auth
                        {{ auth()->user()->name }}
                    @else
                        Guest
                    @endauth
                </span>
            </div>

            <nav class="flex space-x-5 md:space-x-7 text-sm md:text-base font-medium">
                <a class="{{ request()->routeIs('customer.dashboard.index') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-[#9CA3AF] hover:text-blue-700' }} pb-1 transition-all"
                    href="{{ route('customer.dashboard.index') }}">Beranda</a>
                <a class="{{ request()->routeIs('provider.list') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-[#9CA3AF] hover:text-blue-700' }} pb-1 transition-all"
                    href="{{ route('provider.list') }}">Cari Laundry</a>
                <a class="{{ request()->routeIs('customer.riwayat.riwayat') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-[#9CA3AF] hover:text-blue-700' }} pb-1 transition-all"
                    href="{{ route('customer.riwayat.riwayat') }}">Riwayat Pemesanan</a>
            </nav>
            <div class="relative dropdown mt-2">
                <div class="flex items-center space-x-2">
                    <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition-all px-4 py-1">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                            <span class="text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </div>

    </header>

    <main class="flex-1">
        @yield('content2')
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F172A] text-white py-8">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Clean Waves</h4>
                    <p class="text-sm text-blue-100">
                        Layanan laundry modern dengan pelayanan terbaik, harga transparan, dan hasil maksimal.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('customer.dashboard.index') }}"
                                class="text-sm text-blue-100 hover:text-blue-300 transition-all">Beranda</a></li>
                        <li><a href="{{ route('provider.list') }}"
                                class="text-sm text-blue-100 hover:text-blue-300 transition-all">Cari Laundry</a></li>
                        <li><a href="{{ route('customer.riwayat.riwayat') }}"
                                class="text-sm text-blue-100 hover:text-blue-300 transition-all">Riwayat Pemesanan</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone-alt text-sm text-blue-100"></i>
                            <span class="text-sm text-blue-100">+62 858 9567 5549</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-sm text-blue-100"></i>
                            <span class="text-sm text-blue-100">info@cleanwaves.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fab fa-instagram text-sm text-blue-100"></i>
                            <span class="text-sm text-blue-100">@cleanwaves</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-900 mt-8 pt-6 text-center text-sm text-blue-100">
                &copy; {{ date('Y') }} Clean Waves. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Clean Waves
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        /* Custom scrollbar removal for input */
        input::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }
    </style>
</head>

<body class="bg-[#F8FAFF] font-sans text-[#2B3A55]">
    <header class="flex items-center justify-between px-10 py-8 max-w-7xl mx-auto">
        <div class="flex items-center space-x-2">
            <img alt="Laundry service logo, dark blue background with white icon" class="w-35 h-17 object-contain"
                height="100" src="/logo.png" width="60" />
        </div>
        <nav class="flex space-x-6 text-sm font-normal text-[#9CA3AF]">
            <a class="font-semibold text-[#2B3A55]" href="{{ route('customer.dashboard.index') }}">
                Beranda
            </a>
            <a href="{{ route('provider.index') }}">
                Cari Laundry
            </a>
            <a href="#">
                Riwayat Pemesanan
            </a>
        </nav>
        <div>
            <i class="fas fa-user-circle text-[#2B3A55] text-2xl">
            </i>
        </div>
    </header>
    @yield('content2')
</body>

</html>

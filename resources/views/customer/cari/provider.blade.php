@extends('customer.layouts.app2')

@section('content2')
    <main class="max-w-4xl mx-auto px-6">
        <section class="text-center mt-8 mb-10">
            <h1 class="text-lg font-semibold text-slate-900">
                Cari laundry terdekat
            </h1>
            <p class="text-sm text-slate-700 mt-2">
                Temukan laundry dengan pelayanan terbaik dengan hasil dan harga yang memuaskan
            </p>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <article class="border border-slate-300 rounded-md p-4 flex justify-between items-center">
                <div class="text-sm text-slate-700">
                    <h2 class="font-semibold text-slate-900 mb-1">
                        Fuad Laundry
                    </h2>
                    <p class="flex items-center gap-1 mb-1">
                        <i class="fas fa-map-marker-alt text-slate-500 text-xs">
                        </i>
                        Sungai Ngawi No. 69
                    </p>
                    <p class="flex items-center gap-1">
                        <i class="fas fa-phone-alt text-slate-500 text-xs">
                        </i>
                        +6269694646
                    </p>
                </div>
                <button class="bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-md hover:bg-slate-900"
                    type="button">
                    Pesan
                </button>
            </article>
            <article class="border border-slate-300 rounded-md p-4 flex justify-between items-center">
                <div class="text-sm text-slate-700">
                    <h2 class="font-semibold text-slate-900 mb-1">
                        Fuad Laundry
                    </h2>
                    <p class="flex items-center gap-1 mb-1">
                        <i class="fas fa-map-marker-alt text-slate-500 text-xs">
                        </i>
                        Sungai Ngawi No. 69
                    </p>
                    <p class="flex items-center gap-1">
                        <i class="fas fa-phone-alt text-slate-500 text-xs">
                        </i>
                        +6269694646
                    </p>
                </div>
                <a class="bg-[#0F172A] text-white text-xs font-semibold py-2 px-6 rounded" type="button"
                    href="{{ route('customer.order') }}">
                    Pesan
                </a>
            </article>
        </section>
    </main>
@endsection

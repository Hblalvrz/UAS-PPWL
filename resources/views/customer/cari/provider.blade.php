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
            @foreach ($providers as $provider)
                <article class="border border-slate-300 rounded-md p-4 flex justify-between items-center">
                    <div class="text-sm text-slate-700">
                        <h2 class="font-semibold text-slate-900 mb-1">
                            {{ $provider->laundry_name }}
                        </h2>
                        <p class="flex items-center gap-1 mb-1">
                            <i class="fas fa-map-marker-alt text-slate-500 text-xs"></i>
                            {{ $provider->address }}
                        </p>
                        <p class="flex items-center gap-1">
                            <i class="fas fa-phone-alt text-slate-500 text-xs"></i>
                            {{ $provider->phone }}
                        </p>
                    </div>
                    <a class="bg-[#0F172A] text-white text-xs font-semibold py-2 px-6 rounded"
                        href="{{ route('customer.order', $provider->laundryProvider) }}">
                        Pesan
                    </a>
                </article>
            @endforeach
        </section>
    </main>
@endsection

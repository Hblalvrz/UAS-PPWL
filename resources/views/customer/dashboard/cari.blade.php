@extends('customer.layouts.app2')

@section('content2')
    <main class="text-center">
        <h1 class="text-[#0F172A] font-semibold text-lg mb-6">
            Cari laundry
            <span class="font-normal">
                terdekat
            </span>
        </h1>
        <img alt="Illustration of a woman doing laundry with washing machines and clothes rack in a laundry room with window"
            class="mx-auto mb-6" height="200"
            src="https://storage.googleapis.com/a1aa/image/40e40467-04d8-4b63-b5e0-0b15fc36c7b3.jpg" width="280" />
        <p class="text-xs text-[#475569] mb-6 px-6">
            Temukan laundry dengan pelayanan terbaik dengan hasil dan harga yang
            memuaskan
        </p>
        <a class="bg-[#0F172A] text-white text-xs font-semibold py-2 px-6 rounded" type="button"
            href="{{ route('provider.list') }}">
            Cari laundry
        </a>
    </main>
    </div>
    </body>

    </html>
@endsection

@extends('laundry.layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Order Laundry</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Pelanggan</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Provider Laundry</label>
            <select name="laundryProvider" class="form-control" required>
                <option value="">-- Pilih Provider --</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->laundryProvider }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Layanan Laundry</label>
            <select name="laundryService" class="form-control" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->laundryService }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Laundry</label>
            <input type="date" name="pickup_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="process">Process</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kuantitas (kg)</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Total Harga</label>
            <input type="number" name="total_price" class="form-control" min="0" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Order Laundry</h2>
    <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pelanggan</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}" {{ $order->user_id == $user->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Provider Laundry</label>
            <select name="laundryProvider" class="form-control" required>
                @foreach($providers as $provider)
                    <option value="{{ $provider->laundryProvider }}" {{ $order->laundryProvider == $provider->laundryProvider ? 'selected' : '' }}>
                        {{ $provider->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Layanan Laundry</label>
            <select name="laundryService" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{ $service->laundryService }}" {{ $order->laundryService == $service->laundryService ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Laundry</label>
            <input type="date" name="pickup_date" class="form-control" value="{{ $order->pickup_date->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>Process</option>
                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kuantitas (kg)</label>
            <input type="number" name="quantity" class="form-control" min="1" value="{{ $order->quantity }}" required>
        </div>

        <div class="mb-3">
            <label>Total Harga</label>
            <input type="number" name="total_price" class="form-control" min="0" value="{{ $order->total_price }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

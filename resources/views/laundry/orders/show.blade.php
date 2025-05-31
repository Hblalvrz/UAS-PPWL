@extends('laundry.layouts.app')

@section('content')
<div class="order-detail-container">
    <div class="order-detail-content">
        <div class="order-detail-card">
            <div class="order-info-section">
                <h3>Informasi Order</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>ID Order:</label>
                        <span>{{ $order->order_id }}</span>
                    </div>
                    <div class="info-item">
                        <label>Nama Customer:</label>
                        <span>{{ $order->user->name ?? $order->user->username ?? $order->user->email ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Order:</label>
                        <span>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Pickup:</label>
                        <span>{{ \Carbon\Carbon::parse($order->pickup_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Layanan:</label>
                        <span>{{ $order->service->name ?? $order->service->service_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Provider:</label>
                        <span>{{ $order->provider->name ?? $order->provider->provider_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Quantity:</label>
                        <span>{{ $order->quantity }} kg</span>
                    </div>
                    <div class="info-item">
                        <label>Total Harga:</label>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Status:</label>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ $order->status == 'process' ? 'Proses' : 'Selesai' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="order-actions">
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Kembali
                </a>
                <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus order ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
html, body {
    overflow: hidden;
    height: 100vh;
}

.order-detail-container {
    background-color: rgb(255, 255, 255);
    height: 100vh;
    padding: 40px;
    overflow: hidden;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 10px;
}

.order-detail-content {
    background-color: white;
    border-radius: 12px;
    padding: 5px;
    box-shadow: 0 1px 3px rgba(255, 255, 255, 0.1);
    max-width: 800px;
    width: 100%;
    max-height: 95vh; 
    overflow: hidden;
}

.order-detail-card {
    border: 1px solid #d1d5db;
    border-radius: 12px;
    overflow: hidden;
    background-color: #ffffff;
    height: 100%;
    display: flex;
    flex-direction: column;
    animation: slideInUp 0.6s ease-out;
}

.order-info-section {
    padding: 24px;
    flex: 1;
    overflow: hidden;
}

.order-info-section h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 20px; 
    padding-bottom: 10px; 
    border-bottom: 1px solid #e5e7eb;
    animation: slideInUp 0.7s ease-out;
}

.info-grid {
    display: block;
    height: calc(100% - 50px); 
    overflow: hidden;
    animation: slideInUp 0.8s ease-out;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0; 
    border-bottom: 1px solid #f3f4f6;
    transition: background-color 0.2s ease;
    animation: slideInUp 0.6s ease-out;
    animation-fill-mode: forwards;
    opacity: 0;
    transform: translateY(20px);
}

/* Staggered animation untuk setiap info-item */
.info-item:nth-child(1) { animation-delay: 0.1s; }
.info-item:nth-child(2) { animation-delay: 0.2s; }
.info-item:nth-child(3) { animation-delay: 0.3s; }
.info-item:nth-child(4) { animation-delay: 0.4s; }
.info-item:nth-child(5) { animation-delay: 0.5s; }
.info-item:nth-child(6) { animation-delay: 0.6s; }
.info-item:nth-child(7) { animation-delay: 0.7s; }
.info-item:nth-child(8) { animation-delay: 0.8s; }
.info-item:nth-child(9) { animation-delay: 0.9s; }

.info-item:hover {
    background-color: #f8fafc;
    padding-left: 8px;
    padding-right: 8px;
    border-radius: 6px;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
}

.info-item span {
    font-size: 16px;
    color: #1e293b;
    font-weight: 500;
    text-align: right;
}

.info-item:nth-child(3) span {
    color: #64748b; 
}

.info-item:nth-child(4) span {
    color: #059669; 
    font-weight: 600;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    display: inline-block;
    width: fit-content;
    border: 1px solid transparent;
}

.status-process {
    background-color: #fef3c7;
    color: #d97706;
    border-color: #f59e0b;
}

.status-done {
    background-color: #dcfce7;
    color: #16a34a;
    border-color: #22c55e;
}

.order-actions {
    padding: 20px 24px;
    background-color: #f9fafb;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 12px;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
    animation: slideInUp 1.0s ease-out;
}

.order-detail-card .status-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    display: inline-block;
    width: fit-content;
    border: 1px solid transparent;
}

.order-detail-card .status-process {
    background-color: #fef3c7;
    color: #ea580c !important;
    border-color: #f59e0b;
}

.order-detail-card .status-done {
    background-color: #dcfce7;
    color: #059669 !important;
    border-color: #22c55e;
}

.btn-back {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #6b7280;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-back:hover {
    background-color: #4b5563;
    color: white;
    text-decoration: none;
}

.btn-delete {
    background-color: #6b7280;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-delete:hover {
    background-color: #b91c1c;
}

/* Animation Keyframes */
@keyframes slideInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .order-detail-container {
        padding: 16px;
        padding-top: 40px;
    }
    
    .order-detail-content {
        padding: 20px;
        max-height: 90vh;
    }
    
    .order-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-back,
    .btn-delete {
        width: 100%;
        justify-content: center;
    }
    
    .info-item {
        padding: 12px 0;
    }
}
</style>
@endsection

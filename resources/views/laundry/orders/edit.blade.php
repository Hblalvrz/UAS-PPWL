@extends('laundry.layouts.app')

@section('content')
<div class="order-page-container">
    <div class="order-content">
        <div class="order-header">
            <h1 class="order-title">Edit Order Laundry</h1>
        </div>

        <div class="form-container">
            <!-- Order Info Section (Read Only) -->
            <div class="order-info-card">
                <h3 class="info-title">Informasi Order</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>ID Order</label>
                        <span>{{ $order->order_id }}</span>
                    </div>
                    <div class="info-item">
                        <label>Nama Customer</label>
                        <span>{{ $order->user->name ?? $order->user->username ?? $order->user->email ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Order</label>
                        <span>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Provider Laundry</label>
                        <span>{{ $order->provider->name ?? $order->provider->provider_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Layanan</label>
                        <span>{{ $order->service->name ?? $order->service->service_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Quantity</label>
                        <span>{{ $order->quantity }} kg</span>
                    </div>
                    <div class="info-item">
                        <label>Total Harga</label>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Editable Form Section -->
            <div class="edit-form-card">
                <h3 class="form-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L10.5 8.207l-3-3L12.146.146ZM11.207 9l-3-3L2.5 11.707V13.5a.5.5 0 0 0 .5.5h1.793L11.207 9Z"/>
                        <path d="M10.5 1.5 13.5 4.5 14 4l-3-3-.5.5ZM11.5 3.5 14.5 6.5 15 6l-3-3-.5.5Z"/>
                    </svg>
                    Edit Informasi
                </h3>
                
                <form action="{{ route('orders.update', $order->order_id) }}" method="POST" class="order-form">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                    <input type="hidden" name="laundryProvider" value="{{ $order->laundryProvider }}">
                    <input type="hidden" name="laundryService" value="{{ $order->laundryService }}">
                    <input type="hidden" name="quantity" value="{{ $order->quantity }}">
                    <input type="hidden" name="total_price" value="{{ $order->total_price }}">

                    <div class="editable-grid">
                        <div class="form-group highlight">
                            <label class="form-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                                Tanggal Pickup
                            </label>
                            <input type="date" name="pickup_date" class="form-control" value="{{ $order->pickup_date->format('Y-m-d') }}" required>
                            <small class="form-hint">Pilih tanggal untuk pengambilan laundry</small>
                        </div>

                        <div class="form-group highlight">
                            <label class="form-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                                Status Order
                            </label>
                            <select name="status" class="form-control status-select" required>
                                <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>
                                    PROSES
                                </option>
                                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>
                                    SELESAI
                                </option>
                            </select>
                            <small class="form-hint">Update status berdasarkan progress order</small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('orders.index') }}" class="btn-back">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
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

.order-page-container {
    background-color: white;
    min-height: 100vh;
    padding: 20px;
}

.order-content {
    background-color: white;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    max-width: 1000px;
    margin: 0 auto;
}

.order-header {
    margin-bottom: 32px;
    text-align: left; /* Ubah dari center ke left */
}

.order-title {
    font-size: 32px;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 8px 0;
    background-color: black;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 12px;
    display: 12px; 
}

.order-subtitle {
    color: #718096;
    font-size: 16px;
    margin: 0;
}

.form-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

/* Order Info Card (Read Only) */
.order-info-card {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-radius: 16px;
    padding: 24px;
    border: 2px solid #e2e8f0;
}

.info-title {
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-title::before {
    content: "📋";
    font-size: 20px;
}

.info-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.info-item label {
    font-size: 14px;
    font-weight: 500;
    color: #4a5568;
}

.info-item span {
    font-size: 14px;
    color: #2d3748;
    font-weight: 500;
}

/* Edit Form Card */
.edit-form-card {
    background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
    border-radius: 16px;
    padding: 24px;
    border: 2px solid #feb2b2;
}

.form-title {
    font-size: 18px;
    font-weight: 600;
    color: #c53030;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.editable-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 32px;
}

.form-group.highlight {
    background: white;
    padding: 20px;
    border-radius: 12px;
    border: 2px solid #e53e3e;
    box-shadow: 0 4px 12px rgba(229, 62, 62, 0.1);
    transition: all 0.3s ease;
}

.form-group.highlight:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(229, 62, 62, 0.15);
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    color: #2d3748;
    background-color: #f7fafc;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: scale(1.02);
}

.status-select {
    font-weight: 500;
}

.form-hint {
    color: #718096;
    font-size: 12px;
    margin-top: 4px;
    font-style: italic;
}

.form-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    padding-top: 20px;
    border-top: 2px solid #feb2b2; /* Ubah menjadi pink sesuai border form edit */
}

.btn-submit {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color:rgb(147, 152, 159); 
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
}

.btn-submit:hover {
    background-color: #48bb78; /* Hijau saat di hover */
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(72, 187, 120, 0.4);
}

.btn-back {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color:rgb(151, 160, 173); 
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
}

.btn-back:hover {
    background-color: #4a5568; 
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(74, 85, 104, 0.4);
}

/* Loading state */
.btn-submit:disabled {
    background: #a0aec0;
    cursor: not-allowed;
    transform: none;
}

/* Responsive design */
@media (max-width: 768px) {
    .order-page-container {
        padding: 16px;
    }
    
    .order-content {
        padding: 20px;
    }
    
    .form-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-submit,
    .btn-back {
        width: 100%;
        justify-content: center;
    }
}

/* Animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.order-info-card,
.edit-form-card {
    animation: slideInUp 0.6s ease-out;
}

.order-info-card {
    animation-delay: 0.1s;
}

.edit-form-card {
    animation-delay: 0.2s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.order-form');
    const submitBtn = document.querySelector('.btn-submit');
    const formControls = document.querySelectorAll('.form-control');
    
    // Form validation
    function validateForm() {
        let isValid = true;
        formControls.forEach(control => {
            if (control.hasAttribute('required') && !control.value.trim()) {
                isValid = false;
                control.style.borderColor = '#e53e3e';
                control.style.backgroundColor = '#fed7d7';
            } else {
                control.style.borderColor = '#e2e8f0';
                control.style.backgroundColor = '#f7fafc';
            }
        });
        
        submitBtn.disabled = !isValid;
        return isValid;
    }
    
    // Real-time validation
    formControls.forEach(control => {
        control.addEventListener('input', validateForm);
        control.addEventListener('blur', validateForm);
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi.');
            return;
        }
        
        // Loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
            </svg>
            Menyimpan...
        `;
    });
    
    // Date validation - tidak boleh masa lalu
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Status change animation
    const statusSelect = document.querySelector('.status-select');
    statusSelect.addEventListener('change', function() {
        this.style.transform = 'scale(1.05)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
    });
    
    // Initial validation
    validateForm();
});

// Add CSS for spinning animation
const style = document.createElement('style');
style.textContent = `
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
</script>
@endsection

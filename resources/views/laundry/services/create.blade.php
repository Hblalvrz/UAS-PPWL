@extends('laundry.layouts.app')

@section('content')
<div class="service-page-container">
    <div class="service-content">
        <div class="service-header">
            <h1 class="service-title">Tambah Layanan Baru</h1>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
                <div class="mt-2">
                    <a href="{{ route('services.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Layanan</a>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <!-- Service Preview Card (Navy Blue) -->
            <div class="service-preview-card">
                <h3 class="preview-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                    Preview Layanan
                </h3>
                <div class="preview-content">
                    <div class="preview-item">
                        <label>Nama Layanan:</label>
                        <span id="preview-name" class="preview-value">-</span>
                    </div>
                    <div class="preview-item">
                        <label>Harga per Kg:</label>
                        <span id="preview-price" class="preview-value">-</span>
                    </div>
                    <div class="preview-note">
                        <small>Preview akan muncul saat Anda mengisi form</small>
                    </div>
                </div>
            </div>

            <!-- Create Form Card (Gray) -->
            <div class="create-form-card">
                <h3 class="form-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Informasi Layanan
                </h3>
                
                <form action="{{ route('services.store') }}" method="POST" class="service-form">
                    @csrf

                    <div class="form-grid">
                        <div class="form-group highlight">
                            <label class="form-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z"/>
                                    <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z"/>
                                </svg>
                                Nama Layanan
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="service_name" 
                                   id="service_name"
                                   class="form-control" 
                                   value="{{ old('service_name') }}" 
                                   placeholder="Misal: Cuci Lipat"
                                   required>
                            <small class="form-hint">Masukkan nama layanan yang jelas dan mudah dipahami</small>
                        </div>

                        <div class="form-group highlight">
                            <label class="form-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                </svg>
                                Harga per Kg
                                <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   name="price_per_kg" 
                                   id="price_per_kg"
                                   step="0.01"
                                   class="form-control" 
                                   value="{{ old('price_per_kg') }}" 
                                   placeholder="Misal: 5000"
                                   required>
                            <small class="form-hint">Masukkan harga dalam rupiah per kilogram</small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('services.index') }}" class="btn-back">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                            </svg>
                            Simpan Layanan
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

.service-page-container {
    background-color: white;
    min-height: 100vh;
    padding: 20px;
}

.service-content {
    background-color: white;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    max-width: 1000px;
    margin: 0 auto;
}

.service-header {
    margin-bottom: 32px;
    text-align: left;
}

.service-title {
    font-size: 32px;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 8px 0;
    background: linear-gradient(135deg,rgb(0, 0, 0) 0%, #0066CC 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 12px;
    display: block;
}

.alert-success {
    margin-bottom: 24px;
    border: 1px solid #22c55e;
    background-color: #dcfce7;
    color: #16a34a;
    padding: 12px 16px;
    border-radius: 8px;
}

.alert-error {
    margin-bottom: 24px;
    border: 1px solid #ef4444;
    background-color: #fef2f2;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 8px;
}

.form-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

/* Service Preview Card - Navy Blue Theme */
.service-preview-card {
    background: linear-gradient(135deg,rgb(83, 83, 83) 0%,rgb(84, 84, 84) 100%);
    border-radius: 16px;
    padding: 24px;
    border: 2px solidrgb(0, 0, 0);
    box-shadow: 0 8px 25px rgba(0, 0, 128, 0.3);
}

.preview-title {
    font-size: 18px;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.preview-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.preview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.preview-item label {
    font-size: 14px;
    font-weight: 500;
    color:rgb(85, 85, 85);
}

.preview-value {
    font-size: 14px;
    color:rgb(85, 85, 85);
    font-weight: 600;
    min-width: 100px;
    text-align: right;
}

.preview-note {
    text-align: center;
    padding: 12px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    border: 1px dashed rgba(255, 255, 255, 0.5);
}

.preview-note small {
    color: #ffffff;
    font-style: italic;
}

.create-form-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 16px;
    padding: 24px;
    border: 2px solid #dee2e6;
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.2);
}

.form-title {
    font-size: 18px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 32px;
}

.form-group.highlight {
    background: white;
    padding: 20px;
    border-radius: 12px;
    border: 2px solid #dee2e6;
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
    transition: all 0.3s ease;
}

.form-group.highlight:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.15);
    border-color: #adb5bd;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.required {
    color: #dc3545;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #ced4da;
    border-radius: 8px;
    font-size: 14px;
    color: #495057;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #6c757d;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.1);
    transform: scale(1.02);
}

.form-control.error {
    border-color: #dc3545;
    background-color: #f8d7da;
}

.form-hint {
    color: #6c757d;
    font-size: 12px;
    margin-top: 4px;
    font-style: italic;
}

.form-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    padding-top: 20px;
    border-top: 2px solid #dee2e6;
}

.btn-submit {
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #000080 0%, #0066CC 100%);
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 128, 0.3);
}

.btn-submit:hover {
    background: linear-gradient(135deg, #0066CC 0%, #004499 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 128, 0.4);
}

.btn-back {
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

.btn-back:hover {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
}

/* Loading state */
.btn-submit:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
}

/* Responsive design */
@media (max-width: 768px) {
    .service-page-container {
        padding: 16px;
    }
    
    .service-content {
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

.service-preview-card,
.create-form-card {
    animation: slideInUp 0.6s ease-out;
}

.service-preview-card {
    animation-delay: 0.1s;
}

.create-form-card {
    animation-delay: 0.2s;
}

/* Pulse animation for empty preview */
.preview-value:empty::after {
    content: "Belum diisi";
    color: rgba(255, 255, 255, 0.7);
    font-style: italic;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.service-form');
    const submitBtn = document.querySelector('.btn-submit');
    const serviceNameInput = document.getElementById('service_name');
    const priceInput = document.getElementById('price_per_kg');
    const previewName = document.getElementById('preview-name');
    const previewPrice = document.getElementById('preview-price');
    
    // Real-time preview update
    function updatePreview() {
        const name = serviceNameInput.value.trim();
        const price = priceInput.value;
        
        previewName.textContent = name || '-';
        
        if (price) {
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
            previewPrice.textContent = formattedPrice + '/kg';
        } else {
            previewPrice.textContent = '-';
        }
    }
    
    // Form validation
    function validateForm() {
        let isValid = true;
        const formControls = document.querySelectorAll('.form-control');
        
        formControls.forEach(control => {
            if (control.hasAttribute('required') && !control.value.trim()) {
                isValid = false;
                control.classList.add('error');
            } else {
                control.classList.remove('error');
            }
        });
        
        submitBtn.disabled = !isValid;
        return isValid;
    }
    
    // Event listeners
    serviceNameInput.addEventListener('input', function() {
        updatePreview();
        validateForm();
    });
    
    priceInput.addEventListener('input', function() {
        updatePreview();
        validateForm();
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
    
    // Initial validation and preview
    validateForm();
    updatePreview();
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

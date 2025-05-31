@extends('laundry.layouts.app')

@section('content')
<<<<<<< HEAD
<div class="order-page-container">
    <div class="order-content">
        <div class="order-header">
            <h1 class="order-title">Order Masuk</h1>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('orders.index') }}" id="filterForm">
            <div class="order-filters">
                <div class="filter-left">
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
                        </svg>
                        <input type="text" 
                               class="search-input" 
                               placeholder="Cari nama atau layanan..." 
                               name="search" 
                               value="{{ request('search') }}"
                               id="searchInput">
                    </div>
                    
                    <div class="filter-container">
                        <span class="filter-label">Tampilkan</span>
                        <select class="filter-select" name="status" id="filterSelect">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Process</option>
                            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <!-- Table Container -->
        <div class="table-container">
            <table class="orders-table">
                <thead class="table-header">
                    <tr>
                        <th class="table-cell header-cell">Nama</th>
                        <th class="table-cell header-cell">Tanggal Order</th>
                        <th class="table-cell header-cell">Tanggal Pickup</th>
                        <th class="table-cell header-cell">Layanan yang dipilih</th>
                        <th class="table-cell header-cell">Status</th>
                        <th class="table-cell header-cell actions-header">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($orders as $index => $order)
                        <tr class="table-row data-row" data-index="{{ $index }}">
                            <td class="table-cell name-cell">
                                {{ $order->user->name ?? $order->user->username ?? $order->user->email ?? '-' }}
                            </td>
                            <td class="table-cell date-cell">
                                {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                            </td>
                            <td class="table-cell pickup-cell">
                                {{ \Carbon\Carbon::parse($order->pickup_date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="table-cell service-cell">
                                {{ $order->service->name ?? $order->service->service_name ?? '-' }}
                            </td>
                            <td class="table-cell status-cell">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ $order->status == 'process' ? 'Proses' : 'Selesai' }}
                                </span>
                            </td>
                            <td class="table-cell actions-cell">
                                <div class="actions-container">
                                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn-detail">Lihat Detail</a>
                                    <div class="dropdown-wrapper">
                                        <button type="button" class="btn-menu" onclick="toggleDropdown(this)">
                                            <span class="dots">⋯</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('orders.edit', $order->order_id) }}" class="dropdown-item">Edit</a>
                                            <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="dropdown-form" onsubmit="return confirm('Yakin hapus order ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item delete-item">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-row empty-row">
                            <td colspan="6" class="table-cell empty-cell">
                                @if(request('search') || request('status') != 'semua')
                                    Tidak ada order yang sesuai dengan filter.
                                @else
                                    Belum ada order masuk.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    
                    {{-- Fill empty rows to maintain consistent table height --}}
                    @for($i = count($orders); $i < 6; $i++)
                        <tr class="table-row empty-row">
                            <td class="table-cell">&nbsp;</td>
                            <td class="table-cell"></td>
                            <td class="table-cell"></td>
                            <td class="table-cell"></td>
                            <td class="table-cell"></td>
                            <td class="table-cell"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
html, body {
    overflow: hidden;
    height: 100vh;
}

.order-page-container {
    background-color: rgb(255, 255, 255);
    min-height: 100vh;
    padding: 15px;
    box-shadow: 0 1px 3px rgba(255, 255, 255, 0.1);
}

.order-content {
    background-color: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 1px 3px rgba(255, 255, 255, 0.1);
    max-width: 1400px;
    margin: 0 auto;
    border: 1px solid #d1d5db;
}

.order-header {
    margin-bottom: 32px;
}

.order-title {
    font-size: 28px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    border-bottom: 1px solid #e2e8f0; 
    padding-bottom: 12px; 
}


.order-filters {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
}

.filter-left {
    display: flex;
    align-items: center;
    gap: 24px;
    flex: 1;
}

.search-container {
    position: relative;
    max-width: 300px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    z-index: 1;
}

.search-input {
    width: 100%;
    padding: 10px 12px 10px 40px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background-color: #f1f5f9;
    font-size: 14px;
    color: #475569;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-label {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}

.filter-select {
    padding: 10px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background-color: #f1f5f9;
    font-size: 14px;
    color: #475569;
    cursor: pointer;
    min-width: 120px;
}

.filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: white;
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

.table-container {
    border-radius: 12px;
    overflow: hidden;
    border: 0.5px solid #e2e8f0;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
}

.table-header {
    background-color: #f8fafc;
}

.header-cell {
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #e2e8f0;
}

.actions-header {
    width: 200px;
}

.table-body .table-row {
    transition: background-color 0.2s ease;
}

.data-row:nth-child(odd) {
    background-color: white;
}

.data-row:nth-child(even) {
    background-color: #f8fafc;
}

.data-row:hover {
    background-color: #e2e8f0;
}

.table-cell {
    padding: 16px 20px;
    font-size: 14px;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.name-cell {
    font-weight: 500;
    color: #1e293b;
}

.date-cell {
    color: #64748b;
}

.pickup-cell {
    color: #059669;
    font-weight: 500;
}

.service-cell {
    color: #475569;
}

.empty-row {
    background-color: #f1f5f9 !important;
}

.empty-row:hover {
    background-color: #f1f5f9 !important;
}

.empty-cell {
    text-align: center;
    color: #94a3b8;
    font-style: italic;
}

.actions-container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-detail {
    background-color: #475569;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-detail:hover {
    background-color: #334155;
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.dropdown-wrapper {
    position: relative;
}

.btn-menu {
    background: none;
    border: none;
    padding: 8px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-menu:hover {
    background-color: #f1f5f9;
}

.dots {
    font-size: 18px;
    color: #64748b;
    font-weight: bold;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background-color: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    min-width: 140px;
    overflow: hidden;
    margin-top: 4px;
}

.dropdown-menu.show {
    display: block;
    animation: dropdownFadeIn 0.2s ease;
}

@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 12px 16px;
    text-decoration: none;
    color: #374151;
    font-size: 14px;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f3f4f6;
    text-decoration: none;
    color: #374151;
}

.delete-item {
    color: #dc2626;
}

.delete-item:hover {
    background-color: #fef2f2;
    color: #dc2626;
}

.dropdown-form {
    margin: 0;
}

.filter-info {
    margin-top: 16px;
    padding: 12px 16px;
    background-color: #f1f5f9;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.filter-text {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}

.filter-tag {
    background-color: #3b82f6;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.clear-filter {
    color: #dc2626;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.clear-filter:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .order-page-container {
        padding: 16px;
    }
    
    .order-content {
        padding: 20px;
    }
    
    .order-filters {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }
    
    .filter-left {
        flex-direction: column;
        gap: 16px;
    }
    
    .search-container {
        max-width: none;
    }
    
    .filter-container {
        justify-content: space-between;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .orders-table {
        min-width: 800px;
    }
    
    .actions-container {
        flex-direction: column;
        gap: 8px;
        align-items: stretch;
    }
}
</style>

<script>
function toggleDropdown(button) {
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    allDropdowns.forEach(dropdown => {
        if (dropdown !== button.nextElementSibling) {
            dropdown.classList.remove('show');
        }
    });

    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('show');
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown-wrapper')) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    const form = document.getElementById('filterForm');
    
    // Auto submit form when filter changes
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            form.submit();
        });
    }
    
    // Debounced search
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 500); // Wait 500ms after user stops typing
        });
    }
});

// Prevent form submission on enter in search
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('filterForm').submit();
    }
});
</script>
@endsection
=======
    <header class="flex flex-col gap-4 h-24">
        <div>
            <h1 class="text-2xl font-bold text-[#2D4559]">Orders</h1>
        </div>
    </header>
@endsection
>>>>>>> 7a342306476b5d12df384e6bfa45a2b06159672a

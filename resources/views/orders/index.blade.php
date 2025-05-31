@extends('layouts.app')

@section('content')
<div class="order-page-container">
    <!-- Main Content Area -->
    <div class="order-content">
        <div class="order-header">
            <h1 class="order-title">Order Masuk</h1>
        </div>

        <!-- Filter Section -->
        <div class="order-filters">
            <div class="search-container">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
                </svg>
                <input type="text" class="search-input" placeholder="Cari" id="searchInput">
            </div>
            
            <div class="filter-container">
                <span class="filter-label">Tampilkan</span>
                <select class="filter-select" id="filterSelect">
                    <option value="semua">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <table class="orders-table">
                <thead class="table-header">
                    <tr>
                        <th class="table-cell header-cell">Nama</th>
                        <th class="table-cell header-cell">Tanggal Order</th>
                        <th class="table-cell header-cell">Layanan yang dipilih</th>
                        <th class="table-cell header-cell actions-header">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($orders as $index => $order)
                        <tr class="table-row data-row" data-index="{{ $index }}">
                            <td class="table-cell name-cell">{{ $order->user->name ?? '-' }}</td>
                            <td class="table-cell date-cell">{{ \Carbon\Carbon::parse($order->pickup_date)->translatedFormat('d F Y') }}</td>
                            <td class="table-cell service-cell">{{ $order->service->name ?? '-' }}</td>
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
                            <td colspan="4" class="table-cell empty-cell">Belum ada order masuk.</td>
                        </tr>
                    @endforelse
                    
                    {{-- Fill empty rows to maintain consistent table height --}}
                    @for($i = count($orders); $i < 6; $i++)
                        <tr class="table-row empty-row">
                            <td class="table-cell">&nbsp;</td>
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
/* Main Container */
.order-page-container {
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 24px;
}

.order-content {
    background-color: white;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    max-width: 1400px;
    margin: 0 auto;
}

/* Header */
.order-header {
    margin-bottom: 32px;
}

.order-title {
    font-size: 28px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

/* Filters */
.order-filters {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.search-container {
    position: relative;
    flex: 1;
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

/* Table */
.table-container {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
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

/* Actions */
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

/* Dropdown */
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

/* Responsive */
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
        min-width: 600px;
    }
    
    .actions-container {
        flex-direction: column;
        gap: 8px;
        align-items: stretch;
    }
}
</style>

<script>
// Toggle dropdown functionality
function toggleDropdown(button) {
    // Close all other dropdowns
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    allDropdowns.forEach(dropdown => {
        if (dropdown !== button.nextElementSibling) {
            dropdown.classList.remove('show');
        }
    });
    
    // Toggle current dropdown
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown-wrapper')) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = filterSelect.value;
        const rows = document.querySelectorAll('.data-row');
        
        rows.forEach(row => {
            const name = row.querySelector('.name-cell').textContent.toLowerCase();
            const service = row.querySelector('.service-cell').textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchTerm) || service.includes(searchTerm);
            const matchesFilter = filterValue === 'semua'; // Add more filter logic as needed
            
            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }
    
    if (filterSelect) {
        filterSelect.addEventListener('change', filterTable);
    }
});

// Prevent form submission on enter in search
document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
});
</script>
@endsection

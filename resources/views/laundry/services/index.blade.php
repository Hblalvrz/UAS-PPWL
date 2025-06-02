@extends('laundry.layouts.app')

@section('content')
<div class="service-page-container">
    <div class="service-content">
        <div class="service-header">
            <h1 class="service-title">Daftar Layanan Laundry</h1>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form -->
        <form method="GET" action="{{ route('services.index') }}" id="filterForm">
            <div class="service-filters">
                <div class="filter-left">
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
                        </svg>
                        <input type="text" 
                               class="search-input" 
                               placeholder="Cari nama layanan..." 
                               name="search" 
                               value="{{ request('search') }}"
                               id="searchInput">
                    </div>
                </div>
                <div class="filter-right">
                    <a href="{{ route('services.create') }}" class="btn-add">+ Tambah Layanan</a>
                </div>
            </div>
        </form>

        <!-- Table Container -->
        <div class="table-container">
            <table class="services-table">
                <thead class="table-header">
                    <tr>
                        <th class="table-cell header-cell">No</th>
                        <th class="table-cell header-cell">Nama Layanan</th>
                        <th class="table-cell header-cell">Harga per Kg</th>
                        <th class="table-cell header-cell actions-header">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($services as $index => $service)
                        <tr class="table-row data-row" data-index="{{ $index }}">
                            <td class="table-cell number-cell">
                                {{ $loop->iteration }}
                            </td>
                            <td class="table-cell name-cell">
                                {{ $service->service_name }}
                            </td>
                            <td class="table-cell price-cell">
                                Rp {{ number_format($service->price_per_kg, 0, ',', '.') }}
                            </td>
                            <td class="table-cell actions-cell">
                                <div class="actions-container">
                                    <a href="{{ route('services.edit', $service->laundryService) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('services.destroy', $service->laundryService) }}" method="POST" class="delete-form" onsubmit="return confirm('Yakin hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-row empty-row">
                            <td colspan="4" class="table-cell empty-cell">
                                @if(request('search'))
                                    Tidak ada layanan yang sesuai dengan pencarian.
                                @else
                                    Belum ada layanan tersedia.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    
                    {{-- Fill empty rows to maintain consistent table height --}}
                    @for($i = count($services); $i < 6; $i++)
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
html, body {
    overflow: auto;
    height: 100vh;
}

.service-page-container {
    background-color: rgb(255, 255, 255);
    min-height: 100vh;
    padding: 15px;
    box-shadow: 0 1px 3px rgba(255, 255, 255, 0.1);
    position: relative;
}

.service-content {
    background-color: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 1px 3px rgba(255, 255, 255, 0.1);
    max-width: 1400px;
    margin: 0 auto;
    border: 1px solid #d1d5db;
}

.service-header {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 32px;
}

.service-title {
    font-size: 28px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    border-bottom: 1px solid #e2e8f0; 
    padding-bottom: 12px; 
    flex: 1;
}

.btn-add {
    background-color:rgb(115, 115, 115);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-add:hover {
    background-color:rgb(55, 55, 56);
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.alert-success {
    margin-bottom: 24px;
    border: 1px solid #22c55e;
    background-color: #dcfce7;
    color: #16a34a;
    padding: 12px 16px;
    border-radius: 8px;
}

.service-filters {
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

.filter-right {
    display: flex;
    align-items: center;
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
    height: 42px;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.table-container {
    max-height: 400px;
    overflow-y: auto;
    width: 100%;
}

.services-table {
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
    width: 150px;
    text-align: center;
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

.number-cell {
    font-weight: 500;
    color: #64748b;
    width: 60px;
}

.name-cell {
    font-weight: 500;
    color: #1e293b;
}

.price-cell {
    color: #059669;
    font-weight: 500;
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

.actions-cell {
    text-align: center;
}

.actions-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.btn-edit {
    background-color:rgb(92, 92, 92);
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

.btn-edit:hover {
    background-color:rgb(39, 39, 39);
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.delete-form {
    margin: 0;
    display: inline-block;
}

.btn-delete {
    background-color: #ef4444;
    color: white;
    padding: 8px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-delete:hover {
    background-color: #dc2626;
    transform: translateY(-1px);
}

.btn-delete svg {
    width: 16px;
    height: 16px;
}

@media (max-width: 768px) {
    .service-page-container {
        padding: 16px;
    }
    
    .service-content {
        padding: 20px;
    }
    
    .service-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .service-filters {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }
    
    .filter-left {
        flex-direction: column;
        gap: 16px;
    }
    
    .filter-right {
        justify-content: stretch;
    }
    
    .search-container {
        max-width: none;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .services-table {
        min-width: 500px;
    }
    
    .actions-container {
        flex-direction: row;
        gap: 8px;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const form = document.getElementById('filterForm');
    
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

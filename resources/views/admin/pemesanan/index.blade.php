@extends('admin.layouts.app')

@section('title', 'Daftar Pemesanan')
@section('page-title', 'Daftar Pemesanan')

@section('content')
<section class="section">
    {{-- Header dengan Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-start border-4 border-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="bi bi-clock-history fs-2 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Menunggu</h6>
                            <h4 class="mb-0">{{ $totalMenunggu ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-4 border-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="bi bi-arrow-repeat fs-2 text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Dalam Proses</h6>
                            <h4 class="mb-0">{{ $totalProses ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-4 border-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="bi bi-check-circle fs-2 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Selesai</h6>
                            <h4 class="mb-0">{{ $totalSelesai ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-4 border-danger shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded p-3">
                                <i class="bi bi-x-circle fs-2 text-danger"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Dibatalkan</h6>
                            <h4 class="mb-0">{{ $totalDibatalkan ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-list-ul me-2 text-primary"></i>Semua Pemesanan
                </h5>
                <a href="{{ route('admin.pemesanan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pemesanan
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Filter Section --}}
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.pemesanan.index') }}" id="filterForm">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>
                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>
                                        Dalam Proses
                                    </option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Layanan</label>
                                <select name="layanan_id" class="form-select">
                                    <option value="">Semua Layanan</option>
                                    @foreach($layanans as $layanan)
                                        <option value="{{ $layanan->id }}" {{ request('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                            {{ $layanan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Bulan</label>
                                <select name="bulan" class="form-select">
                                    <option value="">Semua Bulan</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Tahun</label>
                                <select name="tahun" class="form-select">
                                    <option value="">Semua Tahun</option>
                                    @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Kota</label>
                                <input type="text" name="kota" class="form-control" 
                                    placeholder="Cari kota..." value="{{ request('kota') }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label small fw-bold text-muted d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100" title="Terapkan Filter">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        @if(request()->anyFilled(['status', 'layanan_id', 'bulan', 'tahun', 'kota']))
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="small text-muted">Filter aktif:</span>
                                        @if(request('status'))
                                            <span class="badge bg-secondary">
                                                Status: {{ ucfirst(request('status')) }}
                                            </span>
                                        @endif
                                        @if(request('layanan_id'))
                                            <span class="badge bg-secondary">
                                                Layanan: {{ $layanans->find(request('layanan_id'))->nama ?? '' }}
                                            </span>
                                        @endif
                                        @if(request('bulan'))
                                            <span class="badge bg-secondary">
                                                Bulan: {{ DateTime::createFromFormat('!m', request('bulan'))->format('F') }}
                                            </span>
                                        @endif
                                        @if(request('tahun'))
                                            <span class="badge bg-secondary">
                                                Tahun: {{ request('tahun') }}
                                            </span>
                                        @endif
                                        @if(request('kota'))
                                            <span class="badge bg-secondary">
                                                Kota: {{ request('kota') }}
                                            </span>
                                        @endif
                                        <a href="{{ route('admin.pemesanan.index') }}" 
                                            class="btn btn-sm btn-outline-secondary ms-2">
                                            <i class="bi bi-x-circle me-1"></i>Reset Filter
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Info Pagination --}}
            @if($pemesanans->total() > 0)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">
                            Menampilkan <strong>{{ $pemesanans->firstItem() }}</strong> - 
                            <strong>{{ $pemesanans->lastItem() }}</strong> dari 
                            <strong>{{ $pemesanans->total() }}</strong> pemesanan
                        </small>
                    </div>
                    <div>
                        <select class="form-select form-select-sm" id="perPageSelect" style="width: auto;">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 per halaman</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per halaman</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per halaman</option>
                        </select>
                    </div>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 18%">Pelanggan</th>
                            <th style="width: 15%">Layanan</th>
                            <th style="width: 12%">Kota</th>
                            <th style="width: 12%">Tanggal Mulai</th>
                            <th style="width: 13%">Biaya Final</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $index => $pemesanan)
                        <tr>
                            <td>{{ $pemesanans->firstItem() + $index }}</td>
                            <td>
                                <div>
                                    <strong class="d-block">{{ $pemesanan->nama_pelanggan }}</strong>
                                    <small class="text-muted">
                                        <i class="bi bi-telephone me-1"></i>{{ $pemesanan->telepon_pelanggan }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info border border-info">
                                    {{ $pemesanan->layanan->nama }}
                                </span>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt text-danger me-1"></i>{{ $pemesanan->kota }}
                            </td>
                            <td>
                                <small>
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $pemesanan->tanggal_mulai->format('d M Y') }}
                                </small>
                            </td>
                            <td>
                                <strong class="text-success">
                                    Rp {{ number_format($pemesanan->harga_final, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td>
                                @php
                                    $statusConfig = [
                                        'pending' => ['bg' => 'warning', 'icon' => 'clock-history'],
                                        'proses' => ['bg' => 'info', 'icon' => 'arrow-repeat'],
                                        'selesai' => ['bg' => 'success', 'icon' => 'check-circle'],
                                        'dibatalkan' => ['bg' => 'danger', 'icon' => 'x-circle']
                                    ];
                                    $config = $statusConfig[$pemesanan->status] ?? ['bg' => 'secondary', 'icon' => 'circle'];
                                @endphp
                                <span class="badge bg-{{ $config['bg'] }}">
                                    <i class="bi bi-{{ $config['icon'] }} me-1"></i>{{ ucfirst($pemesanan->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}" 
                                       class="btn btn-sm btn-outline-info" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit Pemesanan">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                    <h5>Tidak Ada Data Pemesanan</h5>
                                    @if(request()->anyFilled(['status', 'layanan_id', 'bulan', 'tahun', 'kota']))
                                        <p class="mb-0">Tidak ditemukan pemesanan dengan filter yang dipilih.</p>
                                        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="bi bi-arrow-clockwise me-1"></i>Reset Filter
                                        </a>
                                    @else
                                        <p class="mb-0">Belum ada pemesanan yang terdaftar.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($pemesanans->hasPages())
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Halaman {{ $pemesanans->currentPage() }} dari {{ $pemesanans->lastPage() }}
                            </small>
                        </div>
                        <div>
                            {{ $pemesanans->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle per page change
        const perPageSelect = document.getElementById('perPageSelect');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('per_page', this.value);
                url.searchParams.set('page', '1'); // Reset to first page
                window.location.href = url.toString();
            });
        }

        // Highlight current page row on hover
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .btn-group .btn {
        border-radius: 0;
    }
    
    .btn-group .btn:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }
    
    .btn-group .btn:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .badge {
        font-weight: 500;
        padding: 0.375rem 0.75rem;
    }

    .form-select-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush
@endsection
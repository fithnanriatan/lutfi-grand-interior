@extends('admin.layouts.app')

@section('title', 'Manajemen Review')
@section('page-title', 'Manajemen Review')

@section('content')
    <section class="section">
        {{-- Header Section dengan Statistik --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="border-left: 4px solid #435ebe;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Review</h6>
                                <h3 class="mb-0">{{ $reviews->total() }}</h3>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border-left: 4px solid #5ddab4;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Ditampilkan</h6>
                                <h3 class="mb-0">{{ $reviews->where('tampilkan', 1)->count() }}</h3>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border-left: 4px solid #ffce31;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Rating Rata-rata</h6>
                                <h3 class="mb-0">{{ number_format($reviews->avg('rating'), 1) }}</h3>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border-left: 4px solid #9ca3af;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Disembunyikan</h6>
                                <h3 class="mb-0">{{ $reviews->where('tampilkan', 0)->count() }}</h3>
                            </div>
                            <div class="fs-1 opacity-50">
                                <i class="bi bi-eye-slash-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.review.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-funnel me-1"></i>Filter Rating
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="rating" id="rating-all" value="" 
                                    {{ request('rating') === null ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="rating-all">Semua</label>
                                
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" class="btn-check" name="rating" id="rating-{{ $i }}" 
                                        value="{{ $i }}" {{ request('rating') == $i ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning" for="rating-{{ $i }}">
                                        {{ str_repeat('⭐', $i) }}
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-eye me-1"></i>Status Tampilan
                            </label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="tampilkan" id="tampil-all" value="" 
                                    {{ request('tampilkan') === null ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="tampil-all">Semua</label>
                                
                                <input type="radio" class="btn-check" name="tampilkan" id="tampil-yes" value="1" 
                                    {{ request('tampilkan') === '1' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="tampil-yes">
                                    <i class="bi bi-eye"></i> Tampil
                                </label>
                                
                                <input type="radio" class="btn-check" name="tampilkan" id="tampil-no" value="0" 
                                    {{ request('tampilkan') === '0' ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="tampil-no">
                                    <i class="bi bi-eye-slash"></i> Sembunyi
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            @if (request('tampilkan') || request('rating'))
                                <a href="{{ route('admin.review.index') }}" class="btn btn-light w-100">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Review Cards Grid --}}
        <div class="row">
            @forelse($reviews as $review)
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 {{ !$review->tampilkan ? 'border-secondary' : '' }}">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">{{ $review->nama_pengguna }}</h5>
                                    <div class="text-muted small">
                                        <i class="bi bi-telephone me-1"></i>{{ $review->pemesanan->telepon_pelanggan }}
                                    </div>
                                </div>
                                <div class="text-end">
                                    @if ($review->tampilkan)
                                        <span class="badge bg-success">
                                            <i class="bi bi-eye"></i> Publik
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-eye-slash"></i> Private
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            {{-- Rating & Service --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="rating-stars fs-4">
                                    {{ str_repeat('⭐', $review->rating) }}
                                    <span class="badge bg-warning ms-2">{{ $review->rating }}/5</span>
                                </div>
                                <span class="badge bg-info">
                                    <i class="bi bi-box-seam me-1"></i>{{ $review->pemesanan->layanan->nama }}
                                </span>
                            </div>

                            {{-- Comment --}}
                            <div class="p-3 mb-3 border-start border-primary border-4 ps-3">
                                <p class="mb-0 text-secondary" style="line-height: 1.6;">
                                    "{{ Str::limit($review->komentar, 150) }}"
                                </p>
                            </div>

                            {{-- Meta Info --}}
                            <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                                <span>
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $review->tanggal_review->format('d M Y, H:i') }}
                                </span>
                                <span>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $review->pemesanan->kota }}
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-detail-review" 
                                        data-review-id="{{ $review->id }}">
                                        <i class="bi bi-info-circle me-1"></i>Detail Lengkap
                                    </button>
                                    
                                    <form action="{{ route('admin.review.toggle', $review->id) }}" 
                                        method="POST" class="form-toggle d-inline"
                                        data-action="{{ $review->tampilkan ? 'sembunyikan' : 'tampilkan' }}">
                                        @csrf
                                        <button type="submit" 
                                            class="btn {{ $review->tampilkan ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                            <i class="bi {{ $review->tampilkan ? 'bi-eye-slash' : 'bi-eye' }} me-1"></i>
                                            {{ $review->tampilkan ? 'Sembunyikan' : 'Tampilkan' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                            </div>
                            <h4 class="text-muted mb-2">Tidak Ada Review</h4>
                            <p class="text-muted mb-0">
                                @if (request('tampilkan') || request('rating'))
                                    Tidak ada review yang sesuai dengan filter Anda. Coba ubah filter.
                                @else
                                    Belum ada review yang tersedia saat ini.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($reviews->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $reviews->appends(request()->query())->links() }}
            </div>
        @endif
    </section>

    {{-- Detail Modal --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-text me-2"></i>Detail Review Lengkap
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailModalBody">
                    <!-- Dynamic content -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-submit form on filter change
                document.querySelectorAll('input[name="rating"], input[name="tampilkan"]').forEach(input => {
                    input.addEventListener('change', function() {
                        document.getElementById('filterForm').submit();
                    });
                });

                // Toggle confirmation
                document.querySelectorAll('.form-toggle').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const action = this.dataset.action;
                        const message = action === 'sembunyikan' 
                            ? 'Review akan disembunyikan dari publik. Lanjutkan?' 
                            : 'Review akan ditampilkan ke publik. Lanjutkan?';

                        if (confirm(message)) {
                            this.submit();
                        }
                    });
                });

                // Detail modal
                document.querySelectorAll('.btn-detail-review').forEach(button => {
                    button.addEventListener('click', function() {
                        const reviewId = this.dataset.reviewId;
                        const reviews = {!! json_encode($reviews->keyBy('id')->toArray()) !!};
                        const review = reviews[reviewId];
                        
                        if (review) {
                            const modalBody = document.getElementById('detailModalBody');
                            const ratingStars = '⭐'.repeat(review.rating);
                            
                            modalBody.innerHTML = `
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">${review.nama_pengguna}</h3>
                                            <div class="fs-3 mb-2">${ratingStars}</div>
                                            <span class="badge bg-warning text-dark px-3 py-2 fs-6">${review.rating} dari 5 Bintang</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <h6 class="text-primary mb-3 fw-bold">
                                                    <i class="bi bi-person-circle me-2"></i>Data Pelanggan
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="45%">Nama</td>
                                                        <td class="fw-bold">${review.nama_pengguna}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Telepon</td>
                                                        <td>
                                                            <a href="tel:${review.pemesanan.telepon_pelanggan}" class="text-decoration-none">
                                                                <i class="bi bi-telephone-fill text-success me-1"></i>
                                                                ${review.pemesanan.telepon_pelanggan}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Lokasi</td>
                                                        <td>
                                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                                            ${review.pemesanan.kota}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <h6 class="text-primary mb-3 fw-bold">
                                                    <i class="bi bi-box-seam me-2"></i>Data Pemesanan
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="45%">Layanan</td>
                                                        <td>
                                                            <span class="badge bg-info">${review.pemesanan.layanan.nama}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Harga</td>
                                                        <td class="fw-bold text-success">
                                                            Rp ${new Intl.NumberFormat('id-ID').format(review.pemesanan.harga_final)}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Tanggal Review</td>
                                                        <td>
                                                            <i class="bi bi-calendar-check me-1"></i>
                                                            ${new Date(review.tanggal_review).toLocaleDateString('id-ID', {
                                                                year: 'numeric', 
                                                                month: 'long', 
                                                                day: 'numeric'
                                                            })}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card border-primary">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0">
                                                    <i class="bi bi-chat-quote me-2"></i>Komentar Review
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0 fs-6" style="line-height: 1.8; white-space: pre-wrap;">
                                                    ${review.komentar}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="alert ${review.tampilkan ? 'alert-success' : 'alert-secondary'} mb-0">
                                            <i class="bi ${review.tampilkan ? 'bi-eye-fill' : 'bi-eye-slash-fill'} me-2"></i>
                                            <strong>Status:</strong> Review ini 
                                            ${review.tampilkan ? '<strong>ditampilkan</strong> di halaman publik' : '<strong>disembunyikan</strong> dari halaman publik'}
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                            modal.show();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
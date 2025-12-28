@extends('admin.layouts.app')

@section('title', 'Daftar Review')
@section('page-title', 'Daftar Review')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Semua Review</h5>
            </div>
            <div class="card-body">
                {{-- Pesan Flash --}}
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                {{-- Filter --}}
                <form method="GET" action="{{ route('admin.review.index') }}" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="filter-tampilkan" class="form-label">Status Tampilan</label>
                            <select name="tampilkan" id="filter-tampilkan" class="form-select">
                                <option value="">Semua Status Tampilan</option>
                                <option value="1" {{ request('tampilkan') === '1' ? 'selected' : '' }}>Ditampilkan
                                </option>
                                <option value="0" {{ request('tampilkan') === '0' ? 'selected' : '' }}>Disembunyikan
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="filter-rating" class="form-label">Rating</label>
                            <select name="rating" id="filter-rating" class="form-select">
                                <option value="">Semua Rating</option>
                                <option value="5" {{ request('rating') === '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)
                                </option>
                                <option value="4" {{ request('rating') === '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)
                                </option>
                                <option value="3" {{ request('rating') === '3' ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)
                                </option>
                                <option value="2" {{ request('rating') === '2' ? 'selected' : '' }}>⭐⭐ (2 Bintang)
                                </option>
                                <option value="1" {{ request('rating') === '1' ? 'selected' : '' }}>⭐ (1 Bintang)
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                                @if (request('tampilkan') || request('rating'))
                                    <a href="{{ route('admin.review.index') }}" class="btn btn-secondary"
                                        title="Reset Filter">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Informasi Total --}}
                @if ($reviews->total() > 0)
                    <div class="mb-3">
                        <small class="text-muted">
                            Menampilkan {{ $reviews->firstItem() }} - {{ $reviews->lastItem() }} dari
                            {{ $reviews->total() }} review
                        </small>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">Nama Pengguna</th>
                                <th style="width: 15%">Layanan</th>
                                <th style="width: 12%">Rating</th>
                                <th style="width: 25%">Komentar</th>
                                <th style="width: 10%">Tanggal</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 8%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $index => $review)
                                <tr>
                                    <td>{{ $reviews->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $review->nama_pengguna }}</strong><br>
                                        <small class="text-muted">
                                            <i class="bi bi-telephone"></i> {{ $review->pemesanan->telepon_pelanggan }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $review->pemesanan->layanan->nama }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span>{{ str_repeat('⭐', $review->rating) }}</span>
                                            <span class="badge bg-warning text-dark">{{ $review->rating }}/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($review->komentar, 60) }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $review->tanggal_review->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        @if ($review->tampilkan)
                                            <span class="badge bg-success">
                                                <i class="bi bi-eye"></i> Ditampilkan
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-eye-slash"></i> Disembunyikan
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Aksi Review">
                                            {{-- Tombol View Detail --}}
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal-{{ $review->id }}" title="Lihat Detail"
                                                aria-label="Lihat Detail Review">
                                                <i class="bi bi-info-circle"></i>
                                            </button>

                                            {{-- Tombol Toggle Tampilan --}}
                                            <form action="{{ route('admin.review.toggle', $review->id) }}" method="POST"
                                                class="d-inline form-toggle"
                                                data-action="{{ $review->tampilkan ? 'sembunyikan' : 'tampilkan' }}">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-sm {{ $review->tampilkan ? 'btn-warning' : 'btn-success' }}"
                                                    title="{{ $review->tampilkan ? 'Sembunyikan Review' : 'Tampilkan Review' }}"
                                                    aria-label="{{ $review->tampilkan ? 'Sembunyikan' : 'Tampilkan' }}">
                                                    <i class="bi {{ $review->tampilkan ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    {{-- <form action="{{ route('admin.review.destroy', $review->id) }}" 
                                  method="POST" 
                                  class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        title="Hapus Review"
                                        aria-label="Hapus Review">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            <p class="mb-0">Belum ada review yang tersedia</p>
                                            @if (request('tampilkan') || request('rating'))
                                                <small>Coba ubah filter pencarian Anda</small>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($reviews->hasPages())
                    <div class="mt-4">
                        {{ $reviews->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Modal Detail - Dipindahkan ke luar tabel --}}
    @foreach ($reviews as $review)
        <div class="modal fade" id="detailModal-{{ $review->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel-{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailModalLabel-{{ $review->id }}">
                            <i class="bi bi-info-circle me-2"></i>Detail Review
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-star-fill me-1"></i>Informasi Review
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%" class="fw-bold">Nama</td>
                                        <td>{{ $review->nama_pengguna }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Rating</td>
                                        <td>
                                            {{ str_repeat('⭐', $review->rating) }}
                                            <span class="badge bg-warning text-dark">({{ $review->rating }}/5)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tanggal</td>
                                        <td>{{ $review->tanggal_review->format('d F Y, H:i') }} WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Status</td>
                                        <td>
                                            @if ($review->tampilkan)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-eye"></i> Ditampilkan
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-eye-slash"></i> Disembunyikan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-box-seam me-1"></i>Informasi Pemesanan
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%" class="fw-bold">Layanan</td>
                                        <td>{{ $review->pemesanan->layanan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Telepon</td>
                                        <td>
                                            <a href="tel:{{ $review->pemesanan->telepon_pelanggan }}"
                                                class="text-decoration-none">
                                                <i class="bi bi-telephone"></i>
                                                {{ $review->pemesanan->telepon_pelanggan }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Kota</td>
                                        <td>
                                            <i class="bi bi-geo-alt"></i> {{ $review->pemesanan->kota }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Harga</td>
                                        <td class="text-success fw-bold">
                                            Rp {{ number_format($review->pemesanan->harga_final, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="fw-bold mb-2">
                                    <i class="bi bi-chat-left-text me-1"></i>Komentar:
                                </h6>
                                <div class="alert alert-light border">
                                    <p class="mb-0">{{ $review->komentar }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- JavaScript untuk Konfirmasi --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Konfirmasi hapus
                document.querySelectorAll('.form-delete').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        if (confirm(
                                'Apakah Anda yakin ingin menghapus review ini? Tindakan ini tidak dapat dibatalkan.'
                                )) {
                            this.submit();
                        }
                    });
                });

                // Konfirmasi toggle tampilan
                document.querySelectorAll('.form-toggle').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const action = this.dataset.action;
                        const message = action === 'sembunyikan' ?
                            'Review akan disembunyikan dari halaman publik. Lanjutkan?' :
                            'Review akan ditampilkan di halaman publik. Lanjutkan?';

                        if (confirm(message)) {
                            this.submit();
                        }
                    });
                });

                // Auto-dismiss alerts
                setTimeout(() => {
                    document.querySelectorAll('.alert').forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);
            });
        </script>
    @endpush
@endsection

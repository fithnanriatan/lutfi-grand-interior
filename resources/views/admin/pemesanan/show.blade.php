@extends('admin.layouts.app')

@section('title', 'Detail Pemesanan')
@section('page-title', 'Detail Pemesanan')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Pemesanan #{{ $pemesanan->id }}</h5>
                    <div>
                        <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Informasi Pemesanan -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Informasi Pemesanan</h6>

                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="fw-bold">ID Pemesanan</td>
                                <td>#{{ $pemesanan->id }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Layanan</td>
                                <td>
                                    <span class="badge bg-primary">{{ $pemesanan->layanan->nama }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status</td>
                                <td>
                                    <span class="badge {{ $pemesanan->status_badge }}">
                                        {{ $pemesanan->status_label }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Mulai</td>
                                <td>{{ $pemesanan->tanggal_mulai->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Selesai</td>
                                <td>
                                    @if ($pemesanan->tanggal_selesai)
                                        {{ $pemesanan->tanggal_selesai->format('d F Y') }}
                                    @else
                                        <span class="text-muted">Belum ditentukan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Harga Final</td>
                                <td class="text-success fw-bold">Rp
                                    {{ number_format($pemesanan->harga_final, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Dibuat</td>
                                <td>{{ $pemesanan->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Terakhir Diupdate</td>
                                <td>{{ $pemesanan->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>

                        @if ($pemesanan->catatan)
                            <div class="mt-3">
                                <h6 class="fw-bold">Catatan:</h6>
                                <div class="alert alert-light">
                                    {{ $pemesanan->catatan }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Informasi Pelanggan -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Informasi Pelanggan</h6>

                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="fw-bold">Nama</td>
                                <td>{{ $pemesanan->nama_pelanggan }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Telepon</td>
                                <td>
                                    <a href="tel:{{ $pemesanan->telepon_pelanggan }}" class="text-decoration-none">
                                        <i class="bi bi-telephone"></i> {{ $pemesanan->telepon_pelanggan }}
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pemesanan->telepon_pelanggan) }}"
                                        target="_blank" class="btn btn-success btn-sm ms-2">
                                        <i class="bi bi-whatsapp"></i> WhatsApp
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <h6 class="fw-bold mt-4">Alamat Lengkap:</h6>
                        <div class="alert alert-light">
                            <p class="mb-1"><strong>Jalan:</strong> {{ $pemesanan->jalan }}</p>
                            <p class="mb-1"><strong>Kelurahan/Desa:</strong> {{ $pemesanan->kelurahan }}</p>
                            <p class="mb-1"><strong>Kecamatan:</strong> {{ $pemesanan->kecamatan }}</p>
                            <p class="mb-0"><strong>Kota/Kabupaten:</strong> {{ $pemesanan->kota }}</p>
                        </div>

                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($pemesanan->alamat_lengkap) }}"
                            target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-geo-alt"></i> Lihat di Google Maps
                        </a>
                    </div>
                </div>

                <!-- Link Review (Jika Status Selesai) -->
                @if ($pemesanan->status == 'selesai')
                    @if ($pemesanan->hasReview())
                        <!-- Sudah Ada Review -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-success border-success">
                                    <h6 class="alert-heading">
                                        <i class="bi bi-check-circle-fill"></i> Review Sudah Diterima
                                    </h6>
                                    <p class="mb-2">Pelanggan sudah memberikan review untuk pemesanan ini.</p>
                                    <a href="{{ route('admin.review.index') }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-eye"></i> Lihat Review
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif($pemesanan->review_token)
                        <!-- Link Review Tersedia (Belum Diisi) -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info border-info">
                                    <h6 class="alert-heading">
                                        <i class="bi bi-link-45deg"></i> Link Review Tersedia
                                    </h6>
                                    <p class="mb-2">Kirimkan link berikut kepada pelanggan untuk memberikan review:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="reviewLink"
                                            value="{{ $pemesanan->review_link }}" readonly>
                                        <button class="btn btn-primary" type="button" onclick="copyReviewLink()">
                                            <i class="bi bi-clipboard"></i> Copy Link
                                        </button>
                                        <a href="{{ $pemesanan->review_link }}" target="_blank" class="btn btn-info">
                                            <i class="bi bi-box-arrow-up-right"></i> Buka
                                        </a>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="bi bi-info-circle"></i> Link ini hanya bisa digunakan sekali oleh
                                        pelanggan
                                    </small>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Token Habis Tapi Belum Ada Review (Edge Case) -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-warning border-warning">
                                    <h6 class="alert-heading">
                                        <i class="bi bi-exclamation-triangle"></i> Link Review Sudah Tidak Berlaku
                                    </h6>
                                    <p class="mb-0">Link review sudah diakses tetapi pelanggan belum menyelesaikan review.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Status Belum Selesai -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-secondary">
                                <i class="bi bi-info-circle"></i>
                                Link review akan otomatis dibuat ketika status pemesanan diubah menjadi 'Selesai'.
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Gambar Layanan -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">Gambar Layanan</h6>
                        @if ($pemesanan->layanan->gambar)
                            <img src="{{ asset('storage/' . $pemesanan->layanan->gambar) }}"
                                alt="{{ $pemesanan->layanan->nama }}" class="img-fluid rounded"
                                style="max-width: 400px; height: auto;">
                        @else
                            <p class="text-muted">Tidak ada gambar</p>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi Layanan -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">Deskripsi Layanan</h6>
                        <div class="alert alert-light">
                            {{ $pemesanan->layanan->deskripsi }}
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            @if ($pemesanan->status == 'selesai' && !$pemesanan->hasPortfolio())
                                <a href="{{ route('admin.portfolio.create', ['pemesanan_id' => $pemesanan->id]) }}"
                                    class="btn btn-success">
                                    <i class="bi bi-images"></i> Jadikan Portfolio
                                </a>
                            @elseif($pemesanan->hasPortfolio())
                                <a href="{{ route('admin.portfolio.show', $pemesanan->portfolio->id) }}"
                                    class="btn btn-info">
                                    <i class="bi bi-eye"></i> Lihat Portfolio
                                </a>
                            @endif

                            <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit Pemesanan
                            </a>
                            <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus Pemesanan
                                </button>
                            </form>
                            <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function copyReviewLink() {
                const reviewLink = document.getElementById('reviewLink');
                reviewLink.select();
                reviewLink.setSelectionRange(0, 99999); // For mobile devices

                navigator.clipboard.writeText(reviewLink.value).then(function() {
                    // Success - show alert
                    const originalBtnText = event.target.innerHTML;
                    event.target.innerHTML = '<i class="bi bi-check"></i> Copied!';
                    event.target.classList.remove('btn-primary');
                    event.target.classList.add('btn-success');

                    setTimeout(function() {
                        event.target.innerHTML = originalBtnText;
                        event.target.classList.remove('btn-success');
                        event.target.classList.add('btn-primary');
                    }, 2000);
                }, function(err) {
                    alert('Gagal menyalin link');
                });
            }
        </script>
    @endpush
@endsection

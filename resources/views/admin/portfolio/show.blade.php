@extends('admin.layouts.app')

@section('title', 'Detail Portfolio')
@section('page-title', 'Detail Portfolio')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Portfolio</h5>
                <div>
                    <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informasi Portfolio -->
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Portfolio</h6>
                    
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%" class="fw-bold">Judul</td>
                            <td>{{ $portfolio->judul }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Status</td>
                            <td>
                                @if($portfolio->tampilkan)
                                    <span class="badge bg-success">Ditampilkan</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Urutan</td>
                            <td><span class="badge bg-info">{{ $portfolio->urutan }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total Foto</td>
                            <td>
                                <span class="badge bg-primary">{{ $portfolio->total_images }} foto</span>
                                (1 cover + {{ count($portfolio->galeri ?? []) }} galeri)
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Dibuat</td>
                            <td>{{ $portfolio->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Terakhir Update</td>
                            <td>{{ $portfolio->updated_at->format('d F Y H:i') }}</td>
                        </tr>
                    </table>

                    @if($portfolio->pemesanan_id)
                        <div class="alert alert-info mt-3">
                            <h6 class="alert-heading">
                                <i class="bi bi-link-45deg"></i> Terkait Pemesanan
                            </h6>
                            <p class="mb-2">
                                <strong>ID Pemesanan:</strong> #{{ $portfolio->pemesanan->id }}<br>
                                <strong>Layanan:</strong> {{ $portfolio->pemesanan->layanan->nama }}<br>
                                <strong>Pelanggan:</strong> {{ $portfolio->pemesanan->nama_pelanggan }}
                            </p>
                            <a href="{{ route('admin.pemesanan.show', $portfolio->pemesanan->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Lihat Pemesanan
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Deskripsi -->
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Deskripsi Project</h6>
                    <div class="alert alert-light">
                        {{ $portfolio->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Gambar Cover -->
            <div class="row mt-4">
                <div class="col-12">
                    <h6 class="text-primary mb-3">Gambar Cover</h6>
                    <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}" 
                         alt="{{ $portfolio->judul }}" 
                         class="img-fluid rounded"
                         style="max-width: 600px; height: auto;">
                </div>
            </div>

            <!-- Galeri Foto -->
            @if($portfolio->galeri && count($portfolio->galeri) > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">Galeri Foto</h6>
                        <div class="row g-3">
                            @foreach($portfolio->galeri as $image)
                                <div class="col-md-3">
                                    <a href="{{ asset('storage/' . $image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             alt="Gallery" 
                                             class="img-fluid rounded"
                                             style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit Portfolio
                        </a>
                        <form action="{{ route('admin.portfolio.toggle', $portfolio->id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            <button type="submit" class="btn {{ $portfolio->tampilkan ? 'btn-secondary' : 'btn-success' }}">
                                <i class="bi {{ $portfolio->tampilkan ? 'bi-eye-slash' : 'bi-eye' }}"></i> 
                                {{ $portfolio->tampilkan ? 'Sembunyikan' : 'Tampilkan' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Hapus Portfolio
                            </button>
                        </form>
                        <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
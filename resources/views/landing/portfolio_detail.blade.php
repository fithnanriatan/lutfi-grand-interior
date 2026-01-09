@extends('landing.layout.app')
@section('title', 'Portfolio Detail')
@section('page-title', 'Portfolio Detail')

@section('content')

    <div class="untree_co-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-7 mb-5">

                    <div class="project-image-wrapper shadow-lg rounded overflow-hidden mb-4">
                        <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}" alt="{{ $portfolio->judul }}"
                            class="img-fluid w-100" style="object-fit: cover; height: 400px;">
                    </div>

                    @if (!empty($portfolio->galeri) && count($portfolio->galeri) > 0)
                        <div class="row g-2">
                            @foreach (array_slice($portfolio->galeri, 0, 4) as $foto)
                                <div class="col-3">
                                    <div class="gallery-thumb rounded overflow-hidden border">
                                        <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $foto) }}" class="img-fluid w-100"
                                                style="object-fit: cover; height: 80px;"
                                                alt="Galeri {{ $portfolio->judul }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-5 ps-lg-5">

                    <span class="d-block text-primary text-uppercase mb-2 fw-bold">
                        {{-- Kita ambil properti 'nama' dari objek layanan --}}
                        {{ $portfolio->pemesanan->layanan->nama ?? ($portfolio->pemesanan->layanan['NAMA'] ?? 'Custom Furniture') }}
                    </span>

                    <h2 class="section-title mb-4">{{ $portfolio->judul }}</h2>

                    <div class="project-description mb-5 text-muted">
                        {!! nl2br(e($portfolio->deskripsi)) !!}
                    </div>

                    <div class="p-4 bg-light rounded mb-4">
                        <h5 class="text-black mb-3">Detail Pengerjaan</h5>
                        <ul class="list-unstyled ul-check primary">

                            <li>
                                <strong>Waktu Penyelesaian:</strong>
                                {{ $portfolio->pemesanan ? \Carbon\Carbon::parse($portfolio->pemesanan->tanggal_selesai)->format('d F Y') : $portfolio->created_at->format('d F Y') }}
                            </li>

                            @if ($portfolio->pemesanan && $portfolio->pemesanan->catatan)
                                <li>
                                    <strong>Request Klien:</strong> {{ Str::limit($portfolio->pemesanan->catatan, 50) }}
                                </li>
                            @endif

                            <li><strong>Status:</strong> <span class="badge bg-success">Selesai</span></li>
                        </ul>
                    </div>

                    <div class="cta-section border-top pt-4">
                        <p class="mb-3">Tertarik membuat proyek serupa?</p>
                        <a href="https://wa.me/628111111111?text=Halo%20Admin,%20saya%20melihat%20portfolio%20'{{ urlencode($portfolio->judul) }}'%20dan%20tertarik%20membuat%20yang%20seperti%20itu."
                            target="_blank" class="btn btn-primary btn-block rounded-pill py-3 px-5">
                            <i class="fa-brands fa-whatsapp me-2"></i> Tanya Harga Desain Ini
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@extends('landing.layout.app')
@section('title', 'Portfolio')
@section('page-title', 'Portfolio')

@section('content')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title">Hasil Karya Kami</h2>
                    <p>Kumpulan proyek interior yang telah kami selesaikan dengan sepenuh hati.</p>
                </div>
            </div>

            <div class="row">
                @forelse($portfolios as $portfolio)
                    <div class="col-12 col-md-4 col-lg-3 mb-5">

                        <a class="product-item" href="{{ route('portfolios.show', $portfolio->id) }}"
                            style="text-decoration: none;">

                            <div style="height: 250px; overflow: hidden; border-radius: 10px; margin-bottom: 20px;">
                                @if (!empty($portfolio->gambar_cover))
                                    <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}"
                                        class="img-fluid product-thumbnail"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <img src="{{ asset('images/product-1.png') }}" class="img-fluid product-thumbnail"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @endif
                            </div>

                            <h3 class="product-title" style="font-size: 1.2rem; margin-bottom: 5px;">{{ $portfolio->judul }}
                            </h3>

                            <p class="text-muted" style="font-size: 0.9rem; line-height: 1.4;">
                                {{ Str::limit($portfolio->deskripsi, 50) }}
                            </p>

                            <span class="icon-arrow"
                                style="display: block; margin-top: 10px; font-size: 12px; color: #3b5d50; font-weight: bold;">
                                Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">Belum ada portofolio yang ditampilkan.</div>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    {{ $portfolios->links() }}
                </div>
            </div>

        </div>
    </div>
    @endsection

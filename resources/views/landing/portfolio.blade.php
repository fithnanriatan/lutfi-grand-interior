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
                    <div class="col-12 col-md-6 col-lg-3 mb-5">

                        <a class="product-item" href="{{ route('portfolios.show', $portfolio->id) }}"
                            style="text-decoration: none;">

                            <div class="img-wrapper mb-3 position-relative overflow-hidden rounded">
                                @if (!empty($portfolio->gambar_cover))
                                    <img src="{{ asset('storage/' . $portfolio->gambar_cover) }}" class="img-fluid w-100"
                                        style="object-fit: cover; height: 250px;">
                                @else
                                    <img src="{{ asset('images/product-1.png') }}" class="img-fluid w-100"
                                        style="object-fit: cover; height: 250px;">
                                @endif
                            </div>

                            <h3 class="product-title mt-2">{{ $portfolio->judul }}</h3>
                        </a>
                    </div>
                @empty
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

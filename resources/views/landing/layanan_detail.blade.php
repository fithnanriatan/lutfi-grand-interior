@extends('landing.layout.app')
@section('title', 'Layanan Kami')
@section('page-title', 'Layanan Kami')

@section('content')


<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-between">
            
            <div class="col-lg-7 mb-5">
                <div class="service-image-wrap shadow rounded overflow-hidden">
                     @if (!empty($service->gambar))
                        <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama }}" class="img-fluid w-100">
                    @else
                        <img src="{{ asset('images/product-1.png') }}" alt="Default" class="img-fluid w-100">
                    @endif
                </div>
            </div>

            <div class="col-lg-5 ps-lg-5">
                <h2 class="section-title mb-4">Tentang Layanan Ini</h2>
                
                <div class="service-description mb-5 text-muted">
                    {!! nl2br(e($service->deskripsi)) !!}
                </div>

                <div class="mb-5">
                    <ul class="list-unstyled ul-check primary">
                        <li>Konsultasi Gratis</li>
                        <li>Material Berkualitas Tinggi</li>
                        <li>Garansi Pengerjaan</li>
                    </ul>
                </div>

                <div class="cta-section border-top pt-4">
                    <p class="mb-3">Tertarik dengan layanan <strong>{{ $service->nama }}</strong>?</p>
                    
                    <a href="{{ route('kontak', ['layanan' => $service->nama]) }}" 
                       class="btn btn-primary btn-lg rounded-pill px-5">
                       Pesan Layanan Ini
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

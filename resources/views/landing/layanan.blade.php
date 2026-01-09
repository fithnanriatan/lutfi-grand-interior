@extends('landing.layout.app')
@section('title', 'Layanan Kami')
@section('page-title', 'Layanan Kami')

@section('content')
    <div class="why-choose-section">
        <div class="container">
            <div class="row my-5">
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="feature">
                        <div class="icon"><img src="{{ asset('untree/images/truck.svg') }}" alt="Image" class="imf-fluid">
                        </div>
                        <h3>Gratis Instalasi</h3>
                        <p>Kami antar dan rakit furnitur langsung di lokasi Anda hingga siap pakai.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3 mb-4">
                    <div class="feature">
                        <div class="icon"><img src="{{ asset('untree/images/bag.svg') }}" alt="Image"
                                class="imf-fluid"></div>
                        <h3>Desain Custom</h3>
                        <p>Sesuaikan ukuran, warna, dan bahan agar pas dengan ruangan Anda.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3 mb-4">
                    <div class="feature">
                        <div class="icon"><img src="{{ asset('untree/images/support.svg') }}" alt="Image"
                                class="imf-fluid"></div>
                        <h3>Konsultasi Ahli</h3>
                        <p>Diskusikan kebutuhan interior Anda dengan tim desainer berpengalaman kami.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3 mb-4">
                    <div class="feature">
                        <div class="icon"><img src="{{ asset('untree/images/return.svg') }}" alt="Image"
                                class="imf-fluid"></div>
                        <h3>Garansi Material</h3>
                        <p>Jaminan kualitas bahan kokoh dan pengerjaan yang presisi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="list-layanan" class="product-section pt-0">
        <div class="container">
            <div class="row">

                <div class="col-12 mb-5 text-center">
                    <h2 class="mb-4 section-title">Dikerjakan dengan material terbaik.</h2>
                    <p class="mb-4">Kami menyediakan berbagai jenis layanan restorasi dan pembuatan furniture dengan
                        standar kualitas tinggi.</p>
                    <p><a href="#" class="btn">Hubungi Kami</a></p>
                </div>

                @forelse($services as $service)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="{{ route('services.show', $service->id) }}"
                            style="text-decoration: none;">

                            <div style="height: 200px; overflow: hidden; border-radius: 10px; margin-bottom: 15px;">
                                @if (!empty($service->gambar))
                                    <img src="{{ asset('storage/' . $service->gambar) }}"
                                        class="img-fluid product-thumbnail"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <img src="{{ asset('images/product-1.png') }}" class="img-fluid product-thumbnail"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @endif
                            </div>

                            <h3 class="product-title" style="font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">
                                {{ $service->nama }}
                            </h3>

                            <p class="text-muted" style="font-size: 0.9rem; line-height: 1.4;">
                                {{ Str::limit($service->deskripsi, 60) }}
                            </p>

                            <span class="icon-arrow"
                                style="display: block; margin-top: 10px; font-size: 12px; color: #3b5d50; font-weight: bold;">
                                Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>
                        </a>
                    </div>
                @empty
                    <div class="col-12 col-md-9">
                        <div class="alert alert-info">Belum ada layanan yang tersedia saat ini.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Review Klien</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            @forelse($reviews as $review)
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">

                                                <div class="mb-3 text-warning fs-5">
                                                    {!! $review->star_rating !!}
                                                </div>

                                                <blockquote class="mb-5">
                                                    <p>&ldquo;{{ $review->komentar }}&rdquo;</p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{ $review->nama_pengguna }}</h3>

                                                    @if ($review->pemesanan && $review->pemesanan->layanan)
                                                        <span class="position d-block mb-3 small text-uppercase ls-1">
                                                            Project: {{ $review->pemesanan->layanan->nama }}
                                                        </span>
                                                    @else
                                                        <span class="position d-block mb-3">Customer</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <p>Belum ada review.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

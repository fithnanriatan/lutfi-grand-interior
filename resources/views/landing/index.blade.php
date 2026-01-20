@extends('landing.layout.app')
@section('title', 'Home')

@section('content')
    <div class="why-choose-section py-5">
        <div class="container">
            <div class="row justify-content-between align-items-center g-5">

                <div class="col-lg-6">
                    <h2 class="section-title">Track Record Kami</h2>
                    <p>Data nyata dari dedikasi kami dalam melayani kebutuhan interior Anda.</p>

                    <div class="row my-4 g-4">
                        <div class="col-6 col-md-6">
                            <div class="feature h-100">
                                <div class="icon mb-3">
                                    <img src="{{ asset('untree/images/return.svg') }}" alt="Projects" class="img-fluid"
                                        style="width: 40px;">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['proyek_selesai'] }}+</h3>
                                <p class="fw-bold mb-0">Proyek Selesai</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature h-100">
                                <div class="icon mb-3">
                                    <img src="{{ asset('untree/images/support.svg') }}" alt="Clients" class="img-fluid"
                                        style="width: 40px;">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['total_klien'] }}+</h3>
                                <p class="fw-bold mb-0">Klien Terdaftar</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature h-100">
                                <div class="icon mb-3">
                                    <img src="{{ asset('untree/images/bag.svg') }}" alt="Rating" class="img-fluid"
                                        style="width: 40px;">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['rating_rata_rata'] }} / 5.0</h3>
                                <p class="fw-bold mb-0">Kepuasan Klien</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature h-100">
                                <div class="icon mb-3">
                                    <img src="{{ asset('untree/images/truck.svg') }}" alt="Experience" class="img-fluid"
                                        style="width: 40px;">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['tahun_pengalaman'] }} Th</h3>
                                <p class="fw-bold mb-0">Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="img-wrap">
                        <img src="{{ asset('untree/images/why-choose-us-img.jpg') }}" alt="Team Working"
                            class="img-fluid rounded shadow-lg w-100" style="object-fit: cover; min-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-section py-5 bg-light" id="services">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-12 col-lg-3 mb-4 mb-lg-0">
                    <h2 class="mb-4 section-title">Layanan Kami.</h2>
                    <p class="mb-4">Solusi interior lengkap dengan standar kualitas tinggi untuk setiap kebutuhan ruang
                        Anda.</p>
                    <p><a href="{{ route('services') }}" class="btn btn-secondary">Lihat Selengkapnya</a></p>
                </div>

                @forelse($services as $service)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="product-item bg-white p-3 rounded h-100 shadow-sm transition-hover">
                            <div class="img-wrapper overflow-hidden rounded mb-3">
                                <img src="{{ asset('storage/' . $service->gambar) }}" class="img-fluid w-100"
                                    style="object-fit: cover; height: 180px;">
                            </div>
                            <h3 class="product-title fs-5 fw-bold">{{ $service->nama }}</h3>
                            <p class="mb-0 text-muted small">{{ Str::limit($service->deskripsi, 60) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada layanan yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="we-help-section py-5" id="portfolio">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-7 mb-5 mb-lg-0 order-2 order-lg-1">
                    <div class="imgs-grid">
                        @if ($portfolios->has(0))
                            <div class="grid grid-1">
                                <img src="{{ asset('storage/' . $portfolios->get(0)->gambar_cover) }}"
                                    alt="{{ $portfolios->get(0)->judul }}"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @endif

                        @if ($portfolios->has(1))
                            <div class="grid grid-2">
                                <img src="{{ asset('storage/' . $portfolios->get(1)->gambar_cover) }}"
                                    alt="{{ $portfolios->get(1)->judul }}"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @endif

                        @if ($portfolios->has(2))
                            <div class="grid grid-3">
                                <img src="{{ asset('storage/' . $portfolios->get(2)->gambar_cover) }}"
                                    alt="{{ $portfolios->get(2)->judul }}"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 ps-lg-5 order-1 order-lg-2 mb-4 mb-lg-0">
                    <h2 class="section-title mb-4">Portofolio Karya Terbaru</h2>
                    <p>Setiap goresan desain kami memiliki cerita. Berikut adalah beberapa proyek yang telah kami selesaikan
                        dengan sentuhan modern dan elegan.</p>

                    <ul class="list-unstyled custom-list my-4">
                        @forelse($portfolios->take(4) as $portfolio)
                            <li class="mb-3"> <span class="fw-bold text-dark">{{ $portfolio->judul }}</span>
                                <small class="text-muted d-block ms-4 fst-italic" style="font-size: 0.85rem;">
                                    — {{ $portfolio->pemesanan->layanan->nama ?? 'Interior Project' }}
                                </small>
                            </li>
                        @empty
                            <li>Belum ada data proyek.</li>
                        @endforelse
                    </ul>

                    <p><a href="{{ route('portfolios.index') }}" class="btn btn-primary">Lihat Semua Proyek</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Hubungi Kami</h2>
                    <p class="text-muted">Siap mewujudkan interior impian Anda? Konsultasikan sekarang.</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm h-100">
                        <form action="#" class="contact-form">
                            <div class="row">
                                <div class="col-md-6 mb-3"> <label class="text-black mb-2" for="nama">Nama
                                        Lengkap</label>
                                    <input type="text" class="form-control" id="nama" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-black mb-2" for="telepon">No. WhatsApp</label>
                                    <input type="number" class="form-control" id="telepon" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-black mb-2" for="alamat">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" rows="2" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="text-black mb-2" for="layanan">Layanan</label>
                                <select class="form-control" id="layanan" name="layanan" required>
                                    <option value="" disabled selected>-- Pilih Layanan --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->nama }}">{{ $service->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="text-black mb-2" for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" rows="3"></textarea>
                            </div>

                            <button type="button" onclick="kirimKeWhatsapp()"
                                class="btn btn-primary w-100 rounded-pill py-3">
                                <i class="fa-brands fa-whatsapp me-2"></i> Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 p-4 p-md-5 bg-white rounded shadow-sm">
                        <h5 class="text-black mb-4 font-weight-bold border-bottom pb-2">Lokasi & Kontak</h5>

                        <div class="ratio ratio-4x3 mb-4 rounded overflow-hidden shadow-sm"> <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9966611721065!2d109.9678876621569!3d-7.009674503189263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706abc0c96d323%3A0x4ec5736eac527ae!2sMasjid%20Darussalam%20Sikalong%20Kranggan!5e0!3m2!1sen!2sid!4v1767944274422!5m2!1sen!2sid"
                                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex">
                                <div class="me-3 text-primary"><i class="fa fa-map-marker fa-lg"></i></div>
                                <span>Dukuh Sikalong, Desa Kranggan, Kec. Tersono, Kab. Batang</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <div class="me-3 text-primary"><i class="fa fa-phone fa-lg"></i></div>
                                <span>+62 831-5710-0105</span>
                            </li>
                            <li class="d-flex">
                                <div class="me-3 text-primary"><i class="fa fa-envelope fa-lg"></i></div>
                                <span>Fuadlutfi63@yahoo.co.id</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

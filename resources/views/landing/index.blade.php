@extends('landing.layout.app')
@section('title', 'Home')

@section('content')
    <div class="why-choose-section py-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Track Record Kami</h2>
                    <p>Data nyata dari dedikasi kami dalam melayani kebutuhan interior Anda.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('untree/images/return.svg') }}" alt="Projects" class="img-fluid">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['proyek_selesai'] }}+</h3>
                                <p class="fw-bold">Proyek Selesai</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('untree/images/support.svg') }}" alt="Clients" class="img-fluid">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['total_klien'] }}+</h3>
                                <p class="fw-bold">Klien Terdaftar</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('untree/images/bag.svg') }}" alt="Rating" class="img-fluid">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['rating_rata_rata'] }} / 5.0</h3>
                                <p class="fw-bold">Rata-rata Kepuasan</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('untree/images/truck.svg') }}" alt="Experience" class="img-fluid">
                                </div>
                                <h3 class="display-6 fw-bold text-primary">{{ $stats['tahun_pengalaman'] }} Th</h3>
                                <p class="fw-bold">Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('untree/images/why-choose-us-img.jpg') }}" alt="Team Working"
                            class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Layanan Kami.</h2>
                    <p class="mb-4">Solusi interior lengkap dengan standar kualitas tinggi untuk setiap kebutuhan
                        ruang Anda.</p>
                    <p><a href="{{ route('services') }}" class="btn">Konsultasi Gratis</a></p>
                </div>

                @forelse($services as $service)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <div class="product-item">
                            <img src="{{ asset('storage/' . $service->gambar) }}" class="img-fluid product-thumbnail"
                                style="object-fit: cover; height: 200px; width: 100%; border-radius: 10px;">
                            <h3 class="product-title mt-3">{{ $service->nama }}</h3>
                            <p class="mb-0 text-muted small">{{ Str::limit($service->deskripsi, 80) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Belum ada layanan yang tersedia.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <div class="we-help-section" id="portfolio">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
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

                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">Portofolio Karya Terbaru</h2>
                    <p>Setiap goresan desain kami memiliki cerita. Berikut adalah beberapa proyek yang telah kami
                        selesaikan dengan sentuhan modern dan elegan.</p>

                    <ul class="list-unstyled custom-list my-4">
                        @forelse($portfolios as $portfolio)
                            <li>
                                {{ $portfolio->judul }}
                                <small class="text-muted d-block ms-2 fst-italic">
                                    - {{ $portfolio->pemesanan->layanan->nama ?? 'Interior Project' }}
                                </small>
                            </li>
                        @empty
                            <li>Belum ada data proyek.</li>
                        @endforelse
                    </ul>

                    <p><a href="{{ route('portfolios.index') }}" class="btn">Lihat Semua Proyek</a></p>
                </div>
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
    <div class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Hubungi Kami</h2>
                    <p>Siap mewujudkan interior impian Anda? Konsultasikan sekarang.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <form action="#" class="contact-form p-4 bg-white shadow-sm rounded">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="text-black" for="nama">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama"
                                        placeholder="Contoh: Andi Pratama" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="text-black" for="telepon">No. WhatsApp <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="telepon" placeholder="08..."
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-black" for="alamat">Alamat Lengkap <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" rows="2" placeholder="Jalan, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-black" for="layanan">Layanan yang Diminati <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="layanan" name="layanan" required>
                                <option value="" disabled selected>-- Pilih Layanan --</option>
                                @forelse($services as $service)
                                    <option value="{{ $service->nama }}">{{ $service->nama }}</option>
                                @empty
                                    <option value="" disabled>Layanan tidak tersedia</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="text-black" for="tgl_mulai">Rencana Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="text-black" for="tgl_selesai">Target Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-black" for="catatan">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" rows="3"
                                placeholder="Contoh: Saya ingin warna kayu yang gelap..."></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" onclick="kirimKeWhatsapp()"
                                class="btn btn-primary btn-lg rounded-pill">
                                <i class="fa-brands fa-whatsapp me-2"></i> Kirim Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 p-4 bg-white rounded shadow-sm">
                        <h5 class="text-black mb-4 font-weight-bold">Lokasi Workshop</h5>

                        <div
                            style="width: 100%; height: 350px; background-color: #ddd; border-radius: 10px; overflow: hidden; margin-bottom: 20px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9966611721065!2d109.9678876621569!3d-7.009674503189263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706abc0c96d323%3A0x4ec5736eac527ae!2sMasjid%20Darussalam%20Sikalong%20Kranggan!5e0!3m2!1sen!2sid!4v1767944274422!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <h5 class="text-black mb-3">Kontak Resmi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <span class="fa fa-map-marker mt-1 me-3 text-primary"></span>
                                <span>Dukuh Sikalong,Desa Kranggan, Kec. Tersono, Kabupaten Batang, Jawa Tengah 51272</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span class="fa fa-phone me-3 text-primary"></span>
                                <span>+62 831-5710-0105</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <span class="fa fa-envelope me-3 text-primary"></span>
                                <span>Fuadlutfi63@yahoo.co.id</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

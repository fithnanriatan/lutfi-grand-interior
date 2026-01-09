@extends('landing.layout.app')
@section('title', 'Kontak Kami')
@section('page-title', 'Kontak Kami')

@section('content')

    <div class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Formulir Pemesanan & Kontak</h2>
                    <p>Isi data di bawah untuk konsultasi atau pemesanan langsung via WhatsApp.</p>
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
                                    <input type="number" class="form-control" id="telepon" placeholder="08..." required>
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
                            <textarea class="form-control" id="catatan" rows="3" placeholder="Contoh: Saya ingin warna kayu yang gelap..."></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" onclick="kirimKeWhatsapp()" class="btn btn-primary btn-lg rounded-pill">
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
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9966611721065!2d109.9678876621569!3d-7.009674503189263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706abc0c96d323%3A0x4ec5736eac527ae!2sMasjid%20Darussalam%20Sikalong%20Kranggan!5e0!3m2!1sen!2sid!4v1767944274422!5m2!1sen!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
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

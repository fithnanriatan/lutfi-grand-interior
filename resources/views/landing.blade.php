<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('untree/favicon.png') }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link href="{{ asset('untree/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('untree/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('untree/css/style.css') }}" rel="stylesheet">
    <title>Lutfi Grand Interior</title>
    <style>
        /* Custom Styling khusus Halaman Login agar lebih Premium */
        #auth-left {
            /* Membuat form berada di tengah secara vertikal */
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            padding: 2rem 4rem;
            /* Memberi ruang napas yang lega */
        }

        #auth-right {
            /* Mengisi sisi kanan dengan gambar Interior */
            /* Ganti URL ini dengan gambar interior terbaik Anda nanti */
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2000&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .auth-title {
            font-size: 2.5rem;
            color: #2c3e50;
            /* Warna gelap elegan */
        }

        .btn-primary {
            /* Menyesuaikan tombol agar senada dengan tema interior (misal: nuansa biru/emas/abu) */
            background-color: #435ebe;
            border-color: #435ebe;
            padding: 0.8rem 2rem;
            font-weight: 600;
        }

        .form-control-xl {
            padding: 0.8rem 1rem;
            font-size: 1rem;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 767px) {
            #auth-left {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>

    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="{{ asset('untree/index.html') }}">Lutfi Grand Interior<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active"><a class="nav-link" href="#home">Home</a></li>
                    <li><a class="nav-link" href="#services">Layanan</a></li>
                    <li><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li><a class="nav-link" href="#contact">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Wujudkan Ruang <span class="d-block">Impian Anda</span></h1>
                        <p class="mb-4">Kami mengubah rumah biasa menjadi hunian dengan estetika tinggi dan
                            fungsionalitas maksimal. Desain interior profesional untuk kenyamanan hidup Anda.</p>
                        <p><a href="#portfolio" class="btn btn-secondary me-2">Lihat Karya Kami</a><a href="#contact"
                                class="btn btn-white-outline">Konsultasi Gratis</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('untree/images/couch.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-section">
        <div class="container relative">
            <div class="sofa-img">
                <img src="{{ asset('untree/images/sofa.png') }}" alt="Image" class="img-fluid">
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Lutfi Grand
                            Interior<span>.</span></a></div>
                    <p class="mb-4">Menciptakan ruang yang tidak hanya indah dipandang, tetapi juga nyaman
                        ditinggali. Solusi interior terpercaya Anda.</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#services">Layanan</a></li>
                                <li><a href="#portfolio">Portfolio</a></li>
                                <li><a href="#contact">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>. All Rights Reserved. &mdash; Designed with love by <a
                                href="https://untree.co">Untree.co</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('untree/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('untree/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('untree/js/custom.js') }}"></script>
    <script>
        function kirimKeWhatsapp() {
            // 1. Ambil nilai dari form
            var nama = document.getElementById('nama').value;
            var telepon = document.getElementById('telepon').value;
            var alamat = document.getElementById('alamat').value;
            var kelurahan = "";
            var kecamatan = "";
            var kota = "";
            var tglMulai = "";
            var tglSelesai = "";
            var catatan = "";



            var layanan = document.getElementById('layanan').value;


            // 2. Validasi Sederhana (Opsional - agar data tidak kosong)
            if (nama === "" || telepon === "" || layanan === "") {
                alert("Mohon lengkapi Nama, Nomor Telepon, dan Layanan.");
                return;
            }

            // 3. Format Pesan WhatsApp (Gunakan \n untuk baris baru)
            var pesan = "*Halo Admin, saya ingin melakukan pemesanan baru.*%0A%0A" +
                "*DATA PELANGGAN* %0A" +
                "Nama: " + nama + "%0A" +
                "No. HP: " + telepon + "%0A" +
                "Alamat: " + alamat + ", " + kelurahan + ", " + kecamatan + ", " + kota + "%0A%0A" +
                "*DATA PESANAN* %0A" +
                "Layanan: " + layanan + "%0A" +
                "Tgl Mulai: " + tglMulai + "%0A" +
                "Tgl Selesai: " + tglSelesai + "%0A" +
                "Catatan: " + catatan;

            // 4. Kirim ke API WhatsApp
            // GANTI NOMOR INI DENGAN NOMOR TUJUAN (Gunakan kode negara 62, tanpa +)
            var nomorTujuan = "62895422473134";

            var url = "https://wa.me/" + nomorTujuan + "?text=" + pesan;

            // 5. Buka tab baru
            window.open(url, '_blank');
        }
    </script>
</body>

</html>

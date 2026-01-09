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
    <title>Lutfi Grand Interior - @yield('title', 'Dashboard') </title>
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
            <a class="navbar-brand" href="{{ route('landing') }}">Lutfi Grand Interior<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                    <li class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('landing') }}">Home</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('services') }}">Layanan</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('portfolios.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('portfolios.index') }}">Portfolio</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                    <li ></li>
                        <a href="{{ route('login') }}" class="btn btn-secondary me-2">Login Admin</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="hero" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>
                            @hasSection('page-title')
                                @yield('page-title')
                            @else
                                Wujudkan Ruang <span class='d-block'>Impian Anda</span>
                            @endif
                        </h1>
                        <p class="mb-4">
                            Kami mengubah rumah biasa menjadi hunian dengan estetika tinggi dan fungsionalitas maksimal.
                            Desain interior profesional untuk kenyamanan hidup Anda.
                        </p>
                        <p>
                            @if (!request()->routeIs('portfolios.*'))
                                <a href="{{ route('portfolios.index') }}" class="btn btn-secondary me-2">Lihat Karya
                                    Kami</a>
                            @endif

                            @if (request()->routeIs('kontak') || request()->routeIs('landing'))
                                    <a href="#contact" class="btn btn-white-outline">Konsultasi Gratis</a>
                            @else
                                <a href="{{ route('kontak') }}" class="btn btn-white-outline">Konsultasi Gratis</a>
                            @endif
                        </p>
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

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lutfi Grand Interior - Jasa Desain Interior Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-purple-600">
                    <i class="fas fa-couch mr-2"></i>Lutfi Grand Interior
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#services" class="text-gray-700 hover:text-purple-600 transition">Layanan</a>
                    <a href="#portfolio" class="text-gray-700 hover:text-purple-600 transition">Portfolio</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-purple-600 transition">Testimoni</a>
                    <a href="#contact" class="text-gray-700 hover:text-purple-600 transition">Kontak</a>
                </div>
                <div>
                    <a href="#contact"
                        class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient text-white pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Wujudkan Hunian Impian Anda
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Jasa desain interior profesional dengan sentuhan modern dan elegan.
                        Kami hadir untuk mengubah ruang Anda menjadi tempat yang nyaman dan indah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#services"
                            class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                            Lihat Layanan
                        </a>
                        <a href="#portfolio"
                            class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                            Portfolio Kami
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800" alt="Interior Design"
                        class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($services as $service)
                <div class="bg-white rounded-lg shadow-lg p-8 card-hover flex flex-col">
                    <div class="h-48 mb-4 overflow-hidden rounded">
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-gray-200 flex items-center justify-center text-purple-600 text-5xl">
                                <i class="fas fa-couch"></i>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-2xl font-bold mb-4">{{ $service->name }}</h3>

                    <p class="text-gray-600 mb-4 flex-grow">
                        {{ Str::limit($service->description, 100) }}
                    </p>

                    <p class="text-purple-600 font-bold text-lg mb-4">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </p>

                    <a href="#contact" class="text-purple-600 font-semibold hover:text-purple-800 mt-auto">
                        Pesan Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                <p class="text-gray-600 text-lg">Berbagai layanan desain interior untuk kebutuhan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($portfolios as $portfolio)
                    <div class="relative overflow-hidden rounded-lg shadow-lg card-hover group h-64">
                        @php
                            $images = is_string($portfolio->images)
                                ? json_decode($portfolio->images)
                                : $portfolio->images;
                            $firstImage = $images[0] ?? null;
                        @endphp

                        @if ($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $portfolio->project_name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">No Image</div>
                        @endif

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="text-xl font-bold mb-2">{{ $portfolio->project_name }}</h3>
                                <p class="text-sm">
                                    {{ $portfolio->category }} • {{ $portfolio->location }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Portfolio Proyek</h2>
                <p class="text-gray-600 text-lg">Karya terbaik kami yang telah kami selesaikan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($reviews as $review)
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 text-sm">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 italic">
                            "{{ $review->comment }}"
                        </p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                {{ substr($review->customer_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold">{{ $review->customer_name }}</div>
                                <div class="text-gray-500 text-sm">Customer</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 text-lg">Konsultasikan proyek interior Anda bersama kami</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="text-purple-600 text-2xl mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Alamat</div>
                                <div class="text-gray-600">Jl. Tersono Timbang Km2,5 Desa/Kelurahan Kranggan Kab.Batang
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-purple-600 text-2xl mr-4">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Telepon</div>
                                <div class="text-gray-600">+62 831-5710-0105</div>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-purple-600 text-2xl mr-4">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Email</div>
                                <div class="text-gray-600">Fuadlutfi63@yahoo.co.id</div>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-purple-600 text-2xl mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Jam Operasional</div>
                                <div class="text-gray-600">Setiap Hari: 08:00 - 16:00</div>
                                <div class="text-gray-600">Jumat: Libur</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600"
                                placeholder="Nama Anda">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600"
                                placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">No. Telepon</label>
                            <input type="tel"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600"
                                placeholder="+62 812-xxxx-xxxx">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Jenis Layanan</label>
                            <select
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                                <option>Pilih Layanan</option>
                                <option>Desain Residential</option>
                                <option>Desain Commercial</option>
                                <option>Desain F&B</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                            <textarea rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600"
                                placeholder="Ceritakan tentang proyek Anda..."></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Lutfi Grand Interior</h3>
                    <p class="text-gray-400">
                        Menghadirkan solusi desain interior terbaik untuk hunian dan bisnis Anda.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Desain Residential</a></li>
                        <li><a href="#" class="hover:text-white transition">Desain Commercial</a></li>
                        <li><a href="#" class="hover:text-white transition">Desain F&B</a></li>
                        <li><a href="#" class="hover:text-white transition">Konsultasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Portfolio</a></li>
                        <li><a href="#" class="hover:text-white transition">Testimoni</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Dapatkan inspirasi desain terbaru</p>
                    <div class="flex">
                        <input type="email" class="px-4 py-2 rounded-l-lg focus:outline-none text-gray-900"
                            placeholder="Email Anda">
                        <button class="bg-purple-600 px-4 py-2 rounded-r-lg hover:bg-purple-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Lutfi Grand Interior. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop"
        class="fixed bottom-8 right-8 bg-purple-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-purple-700 transition hidden">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>

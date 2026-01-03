<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // 1. DATA LAYANAN
        // Ambil layanan yang statusnya aktif (true)
       $services = Layanan::orderBy('nama', 'asc')->get();

        // 2. DATA PORTFOLIO
        // Ambil portfolio yang 'tampilkan' = true, urutkan dari urutan terkecil (atau terbaru)
        // Kita eager load 'pemesanan.layanan' untuk mendapatkan nama kategori layanan
        $portfolios = Portfolio::with('pemesanan.layanan')
            ->where('tampilkan', true)
            ->orderBy('urutan', 'asc') // atau latest()
            ->limit(6)
            ->get();

        // 3. DATA REVIEW
        // Ambil review yang 'tampilkan' = true & rating minimal 4 bintang (biar bagus di depan)
        $reviews = Review::where('tampilkan', true)
            ->where('rating', '>=', 4)
            ->latest()
            ->limit(5)
            ->get();

        // 4. DATA STATISTIK (DINAMIS)
        // Menghitung langsung dari database agar real-time
        $stats = [
            'proyek_selesai' => Pemesanan::where('status', 'selesai')->count(),
            // Menghitung pelanggan unik berdasarkan nama/no hp
            'total_klien' => Pemesanan::distinct('telepon_pelanggan')->count(), 
            // Hardcoded karena tidak ada di DB, atau bisa hitung tahun sejak proyek pertama
            'tahun_pengalaman' => 5, 
            // Hitung rata-rata rating
            'rating_rata_rata' => number_format(Review::avg('rating'), 1)
        ];

        return view('landing.index', compact('services', 'portfolios', 'reviews', 'stats'));
    }
}
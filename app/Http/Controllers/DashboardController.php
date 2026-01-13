<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Layanan;
use App\Models\Portfolio;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Utama
        $totalPemesanan = Pemesanan::count();
        $pemesananBulanIni = Pemesanan::whereMonth('tanggal_mulai', Carbon::now()->month)
                                      ->whereYear('tanggal_mulai', Carbon::now()->year)
                                      ->count();
        
        // Pemasukan bulan ini (hanya yang selesai)
        $pemasukanBulanIni = Pemesanan::where('status', 'selesai')
                                       ->whereMonth('tanggal_selesai', Carbon::now()->month)
                                       ->whereYear('tanggal_selesai', Carbon::now()->year)
                                       ->sum('harga_final');
        
        // Pemasukan tahun ini
        $pemasukanTahunIni = Pemesanan::where('status', 'selesai')
                                       ->whereYear('tanggal_selesai', Carbon::now()->year)
                                       ->sum('harga_final');
        
        $pemesananMenunggu = Pemesanan::where('status', 'menunggu')->count();
        $pemesananProses = Pemesanan::where('status', 'proses')->count();
        $pemesananSelesai = Pemesanan::where('status', 'selesai')->count();
        $pemesananDibatalkan = Pemesanan::where('status', 'dibatalkan')->count();

        // 2. Grafik Pemasukan 6 Bulan Terakhir
        $pemasukanPerBulan = [];
        $bulanLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan = $date->format('M Y');
            $pemasukan = Pemesanan::where('status', 'selesai')
                                   ->whereMonth('tanggal_selesai', $date->month)
                                   ->whereYear('tanggal_selesai', $date->year)
                                   ->sum('harga_final');
            
            $bulanLabels[] = $bulan;
            $pemasukanPerBulan[] = $pemasukan;
        }

        // 3. Top Layanan Terpopuler
        $topLayanan = Layanan::withCount('pemesanans')
                             ->having('pemesanans_count', '>', 0)
                             ->orderBy('pemesanans_count', 'desc')
                             ->take(5)
                             ->get();

        // 4. Sebaran Pemesanan per Kota
        $sebaranKota = Pemesanan::select('kota', DB::raw('count(*) as total'))
                                 ->groupBy('kota')
                                 ->orderBy('total', 'desc')
                                 ->take(10)
                                 ->get();

        // 5. Status Pemesanan (untuk pie chart)
        $statusPemesanan = [
            'menunggu' => Pemesanan::where('status', 'menunggu')->count(),
            'proses' => Pemesanan::where('status', 'proses')->count(),
            'selesai' => Pemesanan::where('status', 'selesai')->count(),
            'dibatalkan' => Pemesanan::where('status', 'dibatalkan')->count(),
        ];

        // Bonus: Rata-rata rating
        $rataRating = Review::avg('rating') ?? 0;
        $totalReview = Review::count();

        return view('admin.dashboard', compact(
            'totalPemesanan',
            'pemesananBulanIni',
            'pemasukanBulanIni',
            'pemasukanTahunIni',
            'pemesananMenunggu',
            'pemesananProses',
            'pemesananSelesai',
            'pemesananDibatalkan',
            'pemasukanPerBulan',
            'bulanLabels',
            'topLayanan',
            'sebaranKota',
            'statusPemesanan',
            'rataRating',
            'totalReview'
        ));
    }
}
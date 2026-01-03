<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PorfoliosController extends Controller
{
    public function index()
    {
        // LOGIKA: Ambil data, urutkan dari yang terbaru, lalu batasi per halaman.
        // 'latest()' sama dengan 'orderBy('created_at', 'desc')'
        // 'paginate(8)' karena layout Anda 4 kolom, jadi 8 item (2 baris) terlihat rapi.
        $portfolios = Portfolio::latest()->paginate(8);

        return view('landing.portfolio', compact('portfolios'));
    }

    public function show($id)
    {
        // Ambil portfolio beserta data pemesanannya
        // Menggunakan findOrFail untuk handle 404 jika ID tidak ada
        $portfolio = Portfolio::with('pemesanan')->findOrFail($id);

        return view('landing.portfolio_detail', compact('portfolio'));
    }
}

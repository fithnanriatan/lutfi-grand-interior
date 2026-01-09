<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Review;

class ServiceController extends Controller
{
    public function index()
    {
        // Mengambil semua layanan
        $services = Layanan::all();
        $reviews = Review::where('tampilkan', true)
            ->where('rating', '>=', 4)
            ->latest()
            ->limit(5)
            ->get();


        // Return view dengan data
        return view('landing.layanan', compact('services', 'reviews'));
    }

    public function show($id)
    {
        // Cari service berdasarkan ID, jika tidak ada tampilkan 404
        $service = Layanan::findOrFail($id);
        $service = Layanan::findOrFail($id);

        return view('landing.layanan_detail', compact('service'));
    }
}

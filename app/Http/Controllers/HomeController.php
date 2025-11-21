<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Service yang aktif
        $services = Service::where('is_active', true)->get();

        // 2. Ambil 6 Portfolio terbaru (diurutkan dari yang paling baru)
        $portfolios = Portfolio::latest('completion_date')->take(6)->get();

        // 3. Ambil Review yang approved & memiliki rating tinggi (opsional)
        $reviews = Review::where('is_approved', true)
                         ->orderBy('rating', 'desc')
                         ->take(3)
                         ->get();

        // Kirim semua variabel ke view 'home'
        return view('home', compact('services', 'portfolios', 'reviews'));
    }
}
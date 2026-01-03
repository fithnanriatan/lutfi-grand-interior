<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class KontakController extends Controller
{
    public function index()
    {
        $services = Layanan::all();

        return view('landing.kontak', compact('services'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        // Hitung total keseluruhan per status (tanpa pagination)
        $totalMenunggu = \App\Models\Pemesanan::where('status', 'menunggu')->count();
        $totalProses = \App\Models\Pemesanan::where('status', 'proses')->count();
        $totalSelesai = \App\Models\Pemesanan::where('status', 'selesai')->count();
        $totalDibatalkan = \App\Models\Pemesanan::where('status', 'dibatalkan')->count();

        // Query pemesanan dengan filter
        $query = \App\Models\Pemesanan::with('layanan');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter layanan
        if ($request->filled('layanan_id')) {
            $query->where('layanan_id', $request->layanan_id);
        }

        // Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_mulai', $request->bulan);
        }

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        // Filter kota
        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }

        // Urutkan berdasarkan status: menunggu -> proses -> selesai -> dibatalkan
        // Kemudian urutkan berdasarkan tanggal_mulai terbaru
        $query->orderByRaw("FIELD(status, 'menunggu', 'proses', 'selesai', 'dibatalkan')")
            ->orderBy('tanggal_mulai', 'desc');

        // Pagination
        $perPage = $request->get('per_page', 10);
        $pemesanans = $query->paginate($perPage);

        // Get all layanan untuk dropdown filter
        $layanans = \App\Models\Layanan::all();

        return view('admin.pemesanan.index', compact(
            'pemesanans',
            'layanans',
            'totalMenunggu',
            'totalProses',
            'totalSelesai',
            'totalDibatalkan'
        ));
    }


    public function create()
    {
        $layanans = Layanan::where('status', true)->get();
        return view('admin.pemesanan.create', compact('layanans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'nama_pelanggan' => 'required|string|max:255',
            'telepon_pelanggan' => 'required|string|max:20',
            'jalan' => 'required|string',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'harga_final' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
            'status' => 'required|in:menunggu,proses,selesai,dibatalkan'
        ]);

        Pemesanan::create($validated);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil ditambahkan!');
    }

    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load('layanan');
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        $layanans = Layanan::where('status', true)->get();
        return view('admin.pemesanan.edit', compact('pemesanan', 'layanans'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'nama_pelanggan' => 'required|string|max:255',
            'telepon_pelanggan' => 'required|string|max:20',
            'jalan' => 'required|string',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'harga_final' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
            'status' => 'required|in:menunggu,proses,selesai,dibatalkan'
        ]);

        $pemesanan->update($validated);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil diperbarui!');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil dihapus!');
    }
}

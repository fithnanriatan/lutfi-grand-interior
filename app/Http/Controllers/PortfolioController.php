<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('pemesanan')->orderBy('urutan')->latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create(Request $request)
    {
        $pemesanan = null;
        
        // Jika dari pemesanan
        if ($request->filled('pemesanan_id')) {
            $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);
            
            // Cek apakah pemesanan sudah jadi portfolio
            if ($pemesanan->hasPortfolio()) {
                return redirect()->route('admin.pemesanan.show', $pemesanan->id)
                    ->with('error', 'Pemesanan ini sudah dijadikan portfolio!');
            }
        }
        
        return view('admin.portfolio.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemesanan_id' => 'nullable|exists:pemesanans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tampilkan' => 'boolean',
            'urutan' => 'nullable|integer'
        ]);

        // Upload gambar cover
        if ($request->hasFile('gambar_cover')) {
            $validated['gambar_cover'] = $request->file('gambar_cover')->store('portfolio', 'public');
        }

        // Upload galeri (max 4 gambar)
        $galeriPaths = [];
        if ($request->hasFile('galeri')) {
            $galeriFiles = array_slice($request->file('galeri'), 0, 4); // Maksimal 4 gambar
            foreach ($galeriFiles as $file) {
                $galeriPaths[] = $file->store('portfolio', 'public');
            }
        }
        $validated['galeri'] = !empty($galeriPaths) ? $galeriPaths : null;

        // Handle checkbox
        $validated['tampilkan'] = $request->has('tampilkan') ? true : false;
        
        // Set urutan default jika kosong
        if (empty($validated['urutan'])) {
            $validated['urutan'] = Portfolio::max('urutan') + 1;
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load('pemesanan');
        return view('admin.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'tampilkan' => 'boolean',
            'urutan' => 'nullable|integer'
        ]);

        // Upload gambar cover baru jika ada
        if ($request->hasFile('gambar_cover')) {
            // Hapus cover lama
            if ($portfolio->gambar_cover) {
                Storage::disk('public')->delete($portfolio->gambar_cover);
            }
            $validated['gambar_cover'] = $request->file('gambar_cover')->store('portfolio', 'public');
        }

        // Handle galeri
        $galeriPaths = $portfolio->galeri ?? [];
        
        // Upload galeri baru jika ada
        if ($request->hasFile('galeri')) {
            $newGaleri = $request->file('galeri');
            $availableSlots = 4 - count($galeriPaths);
            $galeriFiles = array_slice($newGaleri, 0, $availableSlots);
            
            foreach ($galeriFiles as $file) {
                $galeriPaths[] = $file->store('portfolio', 'public');
            }
        }
        
        $validated['galeri'] = !empty($galeriPaths) ? $galeriPaths : null;

        // Handle checkbox
        $validated['tampilkan'] = $request->has('tampilkan') ? true : false;

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Hapus gambar cover
        if ($portfolio->gambar_cover) {
            Storage::disk('public')->delete($portfolio->gambar_cover);
        }

        // Hapus galeri
        if ($portfolio->galeri) {
            foreach ($portfolio->galeri as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil dihapus!');
    }

    // Hapus gambar galeri individual
    public function deleteGalleryImage(Portfolio $portfolio, $index)
    {
        $galeri = $portfolio->galeri ?? [];
        
        if (isset($galeri[$index])) {
            // Hapus file
            Storage::disk('public')->delete($galeri[$index]);
            
            // Hapus dari array
            unset($galeri[$index]);
            $galeri = array_values($galeri); // Re-index array
            
            $portfolio->update([
                'galeri' => !empty($galeri) ? $galeri : null
            ]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    // Toggle tampilkan
    public function toggleTampilkan(Portfolio $portfolio)
    {
        $portfolio->update([
            'tampilkan' => !$portfolio->tampilkan
        ]);

        return redirect()->back()
            ->with('success', 'Status tampilkan portfolio berhasil diubah!');
    }
}
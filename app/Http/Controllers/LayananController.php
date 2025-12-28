<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle status checkbox
        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($validated);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        // Handle status checkbox
        $validated['status'] = $request->has('status') ? true : false;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($layanan->gambar) {
                Storage::disk('public')->delete($layanan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Layanan $layanan)
    {
        // Hapus gambar
        if ($layanan->gambar) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
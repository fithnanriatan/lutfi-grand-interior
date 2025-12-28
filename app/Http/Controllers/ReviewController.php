<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    // Admin: List semua review
    public function index(Request $request)
    {
        $query = Review::with('pemesanan.layanan')->latest();

        // Filter berdasarkan tampilkan
        if ($request->filled('tampilkan')) {
            $query->where('tampilkan', $request->tampilkan);
        }

        // Filter berdasarkan rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->paginate(10);
        
        return view('admin.review.index', compact('reviews'));
    }

    // Admin: Toggle tampilkan review
    public function toggleTampilkan(Review $review)
    {
        $review->update([
            'tampilkan' => !$review->tampilkan
        ]);

        return redirect()->back()
            ->with('success', 'Status tampilkan review berhasil diubah!');
    }

    // Admin: Hapus review
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.review.index')
            ->with('success', 'Review berhasil dihapus!');
    }

    // Public: Form review untuk customer (via link token)
    public function showForm($token)
    {
        // Cari pemesanan berdasarkan token
        $pemesanan = Pemesanan::where('review_token', $token)
            ->where('status', 'selesai')
            ->first();

        // Jika token tidak valid atau pemesanan tidak ditemukan
        if (!$pemesanan) {
            abort(404, 'Link review tidak valid atau sudah tidak berlaku.');
        }

        // Jika sudah ada review untuk pemesanan ini
        if ($pemesanan->hasReview()) {
            return view('review-submitted', [
                'message' => 'Terima kasih! Anda sudah memberikan review untuk pemesanan ini.'
            ]);
        }

        return view('review-form', compact('pemesanan'));
    }

    // Public: Proses submit review
    public function submitForm(Request $request, $token)
    {
        // Cari pemesanan berdasarkan token
        $pemesanan = Pemesanan::where('review_token', $token)
            ->where('status', 'selesai')
            ->first();

        // Validasi token dan pemesanan
        if (!$pemesanan) {
            abort(404, 'Link review tidak valid atau sudah tidak berlaku.');
        }

        // Cek apakah sudah pernah review
        if ($pemesanan->hasReview()) {
            return redirect()->route('review.form', $token)
                ->with('error', 'Anda sudah memberikan review untuk pemesanan ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10|max:1000',
        ], [
            'rating.required' => 'Rating harus dipilih',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'komentar.required' => 'Komentar harus diisi',
            'komentar.min' => 'Komentar minimal 10 karakter',
            'komentar.max' => 'Komentar maksimal 1000 karakter',
        ]);

        // Simpan review
        Review::create([
            'pemesanan_id' => $pemesanan->id,
            'nama_pengguna' => $pemesanan->nama_pelanggan,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
            'tanggal_review' => Carbon::now(),
            'tampilkan' => true,
        ]);

        // Hapus review token (agar tidak bisa digunakan lagi)
        $pemesanan->update([
            'review_token' => null
        ]);

        return view('review-submitted', [
            'message' => 'Terima kasih atas review Anda! Feedback Anda sangat berarti bagi kami.',
            'success' => true
        ]);
    }
}
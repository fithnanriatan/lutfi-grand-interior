<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    protected $fillable = [
        'layanan_id',
        'nama_pelanggan',
        'telepon_pelanggan',
        'jalan',
        'kelurahan',
        'kecamatan',
        'kota',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga_final',
        'catatan',
        'status',
        'review_token'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'harga_final' => 'decimal:2'
    ];

    // Relasi ke Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    // Relasi ke Portfolio
    public function portfolio()
    {
        return $this->hasOne(Portfolio::class);
    }

    // Helper untuk cek apakah sudah jadi portfolio
    public function hasPortfolio()
    {
        return $this->portfolio()->exists();
    }

    // Relasi ke Review
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Helper untuk cek apakah sudah ada review
    public function hasReview()
    {
        return $this->review()->exists();
    }

    // Auto generate review token ketika status berubah ke 'selesai'
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($pemesanan) {
            // Jika status diubah ke 'selesai' dan belum ada review_token
            if (
                $pemesanan->isDirty('status') &&
                $pemesanan->status === 'selesai' &&
                empty($pemesanan->review_token)
            ) {
                $pemesanan->review_token = Str::random(32);
            }
        });
    }

    // Helper untuk mendapatkan link review
    public function getReviewLinkAttribute()
    {
        if ($this->review_token) {
            return route('review.form', $this->review_token);
        }
        return null;
    }

    // Helper untuk alamat lengkap
    public function getAlamatLengkapAttribute()
    {
        return "{$this->jalan}, Kel. {$this->kelurahan}, Kec. {$this->kecamatan}, {$this->kota}";
    }

    // Helper untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning',
            'proses' => 'bg-info',
            'selesai' => 'bg-success',
            'dibatalkan' => 'bg-danger'
        ];

        return $badges[$this->status] ?? 'bg-secondary';
    }

    // Helper untuk status label
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pending',
            'proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan'
        ];

        return $labels[$this->status] ?? $this->status;
    }
}

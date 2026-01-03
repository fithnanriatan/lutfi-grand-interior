<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'pemesanan_id',
        'nama_pengguna',
        'rating',
        'komentar',
        'tanggal_review',
        'tampilkan'
    ];

    protected $casts = [
        'tanggal_review' => 'date',
        'tampilkan' => 'boolean'
    ];

    // Relasi ke Pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    // Helper untuk star rating HTML
   public function getStarRatingAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fa-solid fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="fa-solid fa-star text-muted" style="opacity: 0.3;"></i>';
            }
        }
        return $stars;
    }
}
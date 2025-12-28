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
                $stars .= '<i class="bi bi-star-fill text-warning"></i>';
            } else {
                $stars .= '<i class="bi bi-star text-warning"></i>';
            }
        }
        return $stars;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'pemesanan_id',
        'judul',
        'deskripsi',
        'gambar_cover',
        'galeri',
        'tampilkan',
        'urutan'
    ];

    protected $casts = [
        'galeri' => 'array',
        'tampilkan' => 'boolean'
    ];

    // Relasi ke Pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    // Helper untuk mendapatkan semua gambar (cover + galeri)
    public function getAllImagesAttribute()
    {
        $images = [$this->gambar_cover];
        
        if ($this->galeri) {
            $images = array_merge($images, $this->galeri);
        }
        
        return $images;
    }

    // Helper untuk hitung total gambar
    public function getTotalImagesAttribute()
    {
        return 1 + (is_array($this->galeri) ? count($this->galeri) : 0);
    }
}
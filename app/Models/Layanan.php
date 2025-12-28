<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'gambar',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relasi ke Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    // Auto generate slug dari nama
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->nama);
            }
        });

        static::updating(function ($layanan) {
            if ($layanan->isDirty('nama')) {
                $layanan->slug = Str::slug($layanan->nama);
            }
        });
    }
}
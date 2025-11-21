<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    // Field yang boleh diisi secara mass-assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'image',
        'is_active',
    ];

    // Casting untuk mengubah field ke tipe tertentu
    protected $casts = [
        'price' => 'decimal:2', // Harga otomatis menjadi format decimal 2 digit
        'is_active' => 'boolean', // True/false
    
    ];

     // Relasi: 1 service punya banyak booking
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
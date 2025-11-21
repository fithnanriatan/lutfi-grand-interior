<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    // Field yang boleh diisi
    protected $fillable = [
        'booking_id',
        'customer_name',
        'customer_email',
        'rating',
        'comment',
        'is_approved',
    ];

    // Casting untuk mengubah field menjadi tipe data tertentu
    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    // Relasi: 1 booking dimiliki oleh 1 service
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    //Daftar kolom yang boleh diisi secara bersamaan
    protected $fillable = [
        'service_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'booking_date',
        'status',
        'notes',
    ];

    //Relasi: Booking -> Service (many to one)
    protected $casts = [
        'booking_date' => 'date',
    ];

    public function Service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    //Relasi: Booking -> Review (one to one)
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
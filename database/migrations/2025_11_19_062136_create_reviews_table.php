<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel "reviews".
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null'); // Relasi ke tabel bookings (opsional).
            // Jika booking dihapus, nilai booking_id menjadi null.

            $table->string('customer_name'); // Nama pelanggan yang memberi review
            $table->string('customer_email')->nullable(); // Email pelanggan (boleh kosong)
            $table->integer('rating'); //  rate 1-5
            $table->text('comment'); // Isi ulasan dari pelanggan
            $table->boolean('is_approved')->default(false); // Status review disetujui admin atau tidak 
            $table->timestamps(); 
        });
    }

    //Menghapus tabel "reviews".
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
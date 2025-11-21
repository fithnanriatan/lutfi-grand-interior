<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Membuat tabel "bookings".
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('service_id')->constrained()->onDelete('cascade');  // Relasi ke tabel services (1 layanan memiliki banyak booking)
            // Jika layanan dihapus, booking juga ikut terhapus
            $table->string('customer_name'); // Nama pelanggan yang melakukan booking
            $table->string('customer_email'); // Email pelanggan
            $table->string('customer_phone'); // Nomor telepon pelanggan
            $table->text('customer_address'); // Alamat lengkap pelanggan
            $table->date('booking_date'); // Tanggal pelanggan melakukan booking
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
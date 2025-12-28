<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('telepon_pelanggan');
            $table->text('jalan');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->decimal('harga_final', 15, 2);
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('review_token')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
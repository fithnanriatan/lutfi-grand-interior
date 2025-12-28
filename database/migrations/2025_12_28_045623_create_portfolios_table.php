<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()->constrained('pemesanans')->onDelete('set null');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar_cover');
            $table->json('galeri')->nullable();
            $table->boolean('tampilkan')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
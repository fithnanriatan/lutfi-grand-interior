<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Membuat tabel "portfolios".
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('project_name'); // Nama proyek (judul portfolio)
            $table->text('description');  // Deskripsi lengkap mengenai proyek
            $table->string('client_name');   // Nama klien yang memesan proyek
            $table->string('location'); // Lokasi proyek dikerjakan
            $table->date('completion_date'); // Menyimpan multiple image dalam bentuk array JSON
            $table->json('images')->nullable(); // array gambar
            $table->string('category'); // contoh: "Residential", "Commercial", "Office"
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
    //Menghapus tabel 

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};